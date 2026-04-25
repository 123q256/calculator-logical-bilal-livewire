<?php
namespace App\Services;

class RedoxBalancer
{
    public static function balance($equationStr)
    {
        try {
            $tokenizer = new Tokenizer($equationStr);
            $eq = self::parseEquation($tokenizer);
            $matrix = self::createMatrix($eq);
            self::solve($matrix);
            $coeffs = self::extractCoefficients($matrix);
            self::checkAnswer($eq, $coeffs);
            
            $reactants = [];
            foreach ($eq->leftSide as $i => $term) {
                $reactants[] = [
                    'coeff' => $coeffs[$i],
                    'html' => $term->toHtml(),
                    'raw' => $term->toRaw()
                ];
            }
            
            $products = [];
            foreach ($eq->rightSide as $i => $term) {
                $idx = count($eq->leftSide) + $i;
                $products[] = [
                    'coeff' => $coeffs[$idx],
                    'html' => $term->toHtml(),
                    'raw' => $term->toRaw()
                ];
            }
            
            return [
                'success' => true,
                'reactants' => $reactants,
                'products' => $products
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    private static function parseEquation($tokenizer)
    {
        $left = [];
        $right = [];
        $left[] = self::parseTerm($tokenizer);
        while (true) {
            $peek = $tokenizer->peek();
            if ($peek === '=') break;
            if ($peek === null) throw new \Exception("Plus or equal sign expected");
            if ($peek !== '+') throw new \Exception("Plus expected");
            $tokenizer->take();
            $left[] = self::parseTerm($tokenizer);
        }
        if ($tokenizer->take() !== '=') throw new \Exception("Assertion error");
        $right[] = self::parseTerm($tokenizer);
        while (true) {
            $peek = $tokenizer->peek();
            if ($peek === null) break;
            if ($peek !== '+') throw new \Exception("Plus expected");
            $tokenizer->take();
            $right[] = self::parseTerm($tokenizer);
        }
        return new RedoxEquation($left, $right);
    }

    private static function parseTerm($tokenizer)
    {
        $items = [];
        while (true) {
            $peek = $tokenizer->peek();
            if ($peek === null) break;
            if ($peek === '(') {
                $items[] = self::parseGroup($tokenizer);
            } elseif (preg_match('/^[A-Za-z][a-z]*$/', $peek)) {
                $items[] = self::parseElement($tokenizer);
            } else {
                break;
            }
        }
        
        $charge = 0;
        $peek = $tokenizer->peek();
        if ($peek !== null && $peek === '^') {
            $tokenizer->take();
            $peek = $tokenizer->peek();
            if ($peek === null) throw new \Exception("Number or sign expected");
            if (preg_match('/^[0-9]+$/', $peek)) {
                $charge = (int)$peek;
                $tokenizer->take();
                $peek = $tokenizer->peek();
            } else {
                $charge = 1;
            }
            if ($peek === null) throw new \Exception("Sign expected");
            if ($peek === '+') {
                // charge remains positive
            } elseif ($peek === '-') {
                $charge = -$charge;
            } else {
                throw new \Exception("Sign expected");
            }
            $tokenizer->take();
        }
        
        $elements = [];
        foreach ($items as $item) {
            $elements = array_merge($elements, $item->getElements());
        }
        $elements = array_unique($elements);
        
        if (count($items) === 0) throw new \Exception("Invalid term");
        
        if (in_array('e', $elements)) {
            if (count($items) > 1 || ($charge !== 0 && $charge !== -1)) {
                throw new \Exception("Invalid term");
            }
            $items = [];
            $charge = -1;
        } else {
            foreach ($elements as $el) {
                if (preg_match('/^[a-z]+$/', $el)) {
                    throw new \Exception("Invalid element " . $el);
                }
            }
        }
        return new RedoxTerm($items, $charge);
    }

    private static function parseGroup($tokenizer)
    {
        if ($tokenizer->take() !== '(') throw new \Exception("Assertion error");
        $items = [];
        while (true) {
            $peek = $tokenizer->peek();
            if ($peek === null) throw new \Exception("Element, group, or closing parenthesis expected");
            if ($peek === '(') {
                $items[] = self::parseGroup($tokenizer);
            } elseif (preg_match('/^[A-Za-z][a-z]*$/', $peek)) {
                $items[] = self::parseElement($tokenizer);
            } elseif ($peek === ')') {
                break;
            } else {
                throw new \Exception("Element, group, or closing parenthesis expected");
            }
        }
        if ($tokenizer->take() !== ')') throw new \Exception("Assertion error");
        return new RedoxGroup($items, self::parseCount($tokenizer));
    }

    private static function parseElement($tokenizer)
    {
        $name = $tokenizer->take();
        if (!preg_match('/^[A-Za-z][a-z]*$/', $name)) throw new \Exception("Assertion error");
        return new RedoxElement($name, self::parseCount($tokenizer));
    }

    private static function parseCount($tokenizer)
    {
        $peek = $tokenizer->peek();
        if ($peek !== null && preg_match('/^[0-9]+$/', $peek)) {
            return (int)$tokenizer->take();
        }
        return 1;
    }

    private static function createMatrix($eq)
    {
        $elements = $eq->getElements();
        $rows = count($elements) + 1;
        $cols = count($eq->leftSide) + count($eq->rightSide) + 1;
        $matrix = new Matrix($rows, $cols);
        
        for ($r = 0; $r < count($elements); $r++) {
            $c = 0;
            foreach ($eq->leftSide as $term) {
                $matrix->set($r, $c, $term->countElement($elements[$r]));
                $c++;
            }
            foreach ($eq->rightSide as $term) {
                $matrix->set($r, $c, -$term->countElement($elements[$r]));
                $c++;
            }
        }
        return $matrix;
    }

    private static function solve($matrix)
    {
        $matrix->gaussJordanEliminate();
        $freeCol = 0;
        for ($freeCol = 0; $freeCol < $matrix->rowCount() - 1; $freeCol++) {
            if (self::countNonzeroCoeffs($matrix, $freeCol) > 1) {
                break;
            }
        }
        if ($freeCol === $matrix->rowCount() - 1) {
            throw new \Exception("Element combination incorrect");
        }
        $matrix->set($matrix->rowCount() - 1, $freeCol, 1);
        $matrix->set($matrix->rowCount() - 1, $matrix->columnCount() - 1, 1);
        $matrix->gaussJordanEliminate();
    }

    private static function countNonzeroCoeffs($matrix, $row)
    {
        $count = 0;
        for ($c = 0; $c < $matrix->columnCount(); $c++) {
            if ($matrix->get($row, $c) != 0) $count++;
        }
        return $count;
    }

    private static function extractCoefficients($matrix)
    {
        $rows = $matrix->rowCount();
        $cols = $matrix->columnCount();
        if ($cols - 1 > $rows || $matrix->get($cols - 2, $cols - 2) == 0) {
            throw new \Exception("No unique solution");
        }
        
        $lcm = 1;
        for ($r = 0; $r < $cols - 1; $r++) {
            $lcm = self::checkedMultiply((int)($lcm / self::gcd($lcm, $matrix->get($r, $r))), $matrix->get($r, $r));
        }
        
        $coeffs = [];
        $allZero = true;
        for ($r = 0; $r < $cols - 1; $r++) {
            $val = self::checkedMultiply((int)($lcm / $matrix->get($r, $r)), $matrix->get($r, $cols - 1));
            $coeffs[] = $val;
            if ($val != 0) $allZero = false;
        }
        if ($allZero) throw new \Exception("All zero solution");
        return $coeffs;
    }

    private static function checkAnswer($eq, $coeffs)
    {
        if (count($coeffs) !== count($eq->leftSide) + count($eq->rightSide)) {
            throw new \Exception("Assertion error: Mismatched length");
        }
        foreach ($coeffs as $c) {
            if (!is_int($c) || $c <= 0) throw new \Exception("Balance failed: Solution must be positive integers");
        }
        $elements = $eq->getElements();
        foreach ($elements as $el) {
            $sum = 0;
            $i = 0;
            foreach ($eq->leftSide as $term) {
                $sum += $term->countElement($el) * $coeffs[$i++];
            }
            foreach ($eq->rightSide as $term) {
                $sum -= $term->countElement($el) * $coeffs[$i++];
            }
            if ($sum !== 0) throw new \Exception("Assertion error: Balance failed");
        }
    }

    public static function gcd($a, $b)
    {
        $a = abs((int)$a);
        $b = abs((int)$b);
        while ($b != 0) {
            $temp = $a % $b;
            $a = $b;
            $b = $temp;
        }
        return $a;
    }

    public static function checkedMultiply($a, $b)
    {
        return $a * $b;
    }
}

class Tokenizer
{
    private $str;
    private $pos;
    public function __construct($str) {
        $this->str = $str;
        $this->pos = 0;
    }
    public function peek() {
        if ($this->pos >= strlen($this->str)) return null;
        if (preg_match('/^([A-Za-z][a-z]*|[0-9]+| +|[+\-^=()])/', substr($this->str, $this->pos), $matches)) {
            $token = $matches[1];
            if (trim($token) === '') {
                $this->pos += strlen($token);
                return $this->peek();
            }
            return $token;
        }
        throw new \Exception("Invalid symbol at position " . $this->pos);
    }
    public function take() {
        $token = $this->peek();
        $this->pos += strlen($token);
        return $token;
    }
}

class RedoxEquation
{
    public $leftSide;
    public $rightSide;
    public function __construct($l, $r) {
        $this->leftSide = $l;
        $this->rightSide = $r;
    }
    public function getElements() {
        $elems = [];
        foreach ($this->leftSide as $t) $elems = array_merge($elems, $t->getElements());
        foreach ($this->rightSide as $t) $elems = array_merge($elems, $t->getElements());
        return array_values(array_unique($elems));
    }
}

class RedoxTerm
{
    public $items;
    public $charge;
    public function __construct($items, $charge) {
        $this->items = $items;
        $this->charge = $charge;
    }
    public function getElements() {
        $elems = ['e'];
        foreach ($this->items as $i) $elems = array_merge($elems, $i->getElements());
        return array_values(array_unique($elems));
    }
    public function countElement($name) {
        if ($name === 'e') return -$this->charge;
        $sum = 0;
        foreach ($this->items as $i) $sum += $i->countElement($name);
        return $sum;
    }
    public function toHtml() {
        $html = '';
        if (count($this->items) === 0 && $this->charge === -1) {
            $html = 'e<sup class="text-red-500 font-bold ml-0.5">-</sup>';
        } else {
            foreach ($this->items as $i) $html .= $i->toHtml();
            if ($this->charge !== 0) {
                $sign = $this->charge > 0 ? '+' : '-';
                $val = abs($this->charge) == 1 ? '' : abs($this->charge);
                $html .= '<sup class="text-red-500 font-bold ml-0.5">' . $val . $sign . '</sup>';
            }
        }
        return $html;
    }
    public function toRaw() {
        $raw = '';
        if (count($this->items) === 0 && $this->charge === -1) {
            $raw = 'e^-';
        } else {
            foreach ($this->items as $i) $raw .= $i->toRaw();
            if ($this->charge !== 0) {
                $sign = $this->charge > 0 ? '+' : '-';
                $val = abs($this->charge) == 1 ? '' : abs($this->charge);
                $raw .= '^' . $val . $sign;
            }
        }
        return $raw;
    }
}

class RedoxGroup
{
    public $items;
    public $count;
    public function __construct($items, $count) {
        $this->items = $items;
        $this->count = $count;
    }
    public function getElements() {
        $elems = [];
        foreach ($this->items as $i) $elems = array_merge($elems, $i->getElements());
        return array_values(array_unique($elems));
    }
    public function countElement($name) {
        $sum = 0;
        foreach ($this->items as $i) $sum += $i->countElement($name) * $this->count;
        return $sum;
    }
    public function toHtml() {
        $html = '(';
        foreach ($this->items as $i) $html .= $i->toHtml();
        $html .= ')';
        if ($this->count !== 1) $html .= '<sub class="text-[#7E178C] font-bold ml-0.5">' . $this->count . '</sub>';
        return $html;
    }
    public function toRaw() {
        $raw = '(';
        foreach ($this->items as $i) $raw .= $i->toRaw();
        $raw .= ')';
        if ($this->count !== 1) $raw .= $this->count;
        return $raw;
    }
}

class RedoxElement
{
    public $name;
    public $count;
    public function __construct($name, $count) {
        $this->name = $name;
        $this->count = $count;
    }
    public function getElements() { return [$this->name]; }
    public function countElement($n) { return $n === $this->name ? $this->count : 0; }
    public function toHtml() {
        $html = $this->name;
        if ($this->count !== 1) $html .= '<sub class="text-[#346EE2] font-bold ml-0.5">' . $this->count . '</sub>';
        return $html;
    }
    public function toRaw() {
        $raw = $this->name;
        if ($this->count !== 1) $raw .= $this->count;
        return $raw;
    }
}

class Matrix
{
    private $rows;
    private $cols;
    private $grid;
    public function __construct($r, $c) {
        $this->rows = $r;
        $this->cols = $c;
        $this->grid = array_fill(0, $r, array_fill(0, $c, 0));
    }
    public function rowCount() { return $this->rows; }
    public function columnCount() { return $this->cols; }
    public function get($r, $c) { return $this->grid[$r][$c]; }
    public function set($r, $c, $v) { $this->grid[$r][$c] = $v; }
    
    private function swapRows($r1, $r2) {
        $temp = $this->grid[$r1];
        $this->grid[$r1] = $this->grid[$r2];
        $this->grid[$r2] = $temp;
    }
    
    private function simplifyRow($arr) {
        $sign = 0;
        foreach ($arr as $v) {
            if ($v > 0) { $sign = 1; break; }
            if ($v < 0) { $sign = -1; break; }
        }
        if ($sign === 0) return $arr;
        
        $g = 0;
        foreach ($arr as $v) $g = RedoxBalancer::gcd($v, $g);
        $g = $g * $sign;
        foreach ($arr as &$v) $v /= $g;
        return $arr;
    }

    public function gaussJordanEliminate() {
        for ($r = 0; $r < $this->rows; $r++) {
            $this->grid[$r] = $this->simplifyRow($this->grid[$r]);
        }
        $pvtRow = 0;
        for ($c = 0; $c < $this->cols; $c++) {
            $i = $pvtRow;
            while ($i < $this->rows && $this->grid[$i][$c] == 0) $i++;
            if ($i != $this->rows) {
                $pivot = $this->grid[$i][$c];
                $this->swapRows($pvtRow, $i);
                for ($r = $pvtRow + 1; $r < $this->rows; $r++) {
                    $val = $this->grid[$r][$c];
                    $g = RedoxBalancer::gcd($pivot, $val);
                    for ($j = 0; $j < $this->cols; $j++) {
                        $this->grid[$r][$j] = (int)($this->grid[$r][$j] * ($pivot / $g) - $this->grid[$pvtRow][$j] * ($val / $g));
                    }
                    $this->grid[$r] = $this->simplifyRow($this->grid[$r]);
                }
                $pvtRow++;
            }
        }
        for ($r = $this->rows - 1; $r >= 0; $r--) {
            $c = 0;
            while ($c < $this->cols && $this->grid[$r][$c] == 0) $c++;
            if ($c != $this->cols) {
                $pivot = $this->grid[$r][$c];
                for ($i = $r - 1; $i >= 0; $i--) {
                    $val = $this->grid[$i][$c];
                    $g = RedoxBalancer::gcd($pivot, $val);
                    for ($j = 0; $j < $this->cols; $j++) {
                        $this->grid[$i][$j] = (int)($this->grid[$i][$j] * ($pivot / $g) - $this->grid[$r][$j] * ($val / $g));
                    }
                    $this->grid[$i] = $this->simplifyRow($this->grid[$i]);
                }
            }
        }
    }
}
