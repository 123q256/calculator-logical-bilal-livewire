<?php

namespace App\Livewire\Calculators;

class Token {
    public $value;
    public $startIndex;
    public $endIndex;
    public function __construct($str, $stIndex, $enIndex) {
        $this->value = (string)$str;
        $this->startIndex = $stIndex;
        $this->endIndex = $enIndex;
    }
}

class OrderOfOperationsSolver {
    public $steps = [];
    public $stepNumber = 1;
    public $errorMessage = null;
    public $finalAnswer = null;

    public function solve($input) {
        $this->steps = [];
        $this->stepNumber = 1;
        $this->errorMessage = null;
        $this->finalAnswer = null;

        $input = preg_replace('/\s+/', '', $input);
        if (!preg_match('/\d/', $input) && $input !== '') {
            $this->displayInvalidInput('Input must contain numbers', '', '', '');
            return false;
        }
        if ($input === "") {
            return false;
        }

        try {
            $ans = $this->calculate_expr($input);
            $this->displaySolution($ans);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function calculate_expr($input) {
        $input = $this->parentheses($input);
        $input = $this->exponents($input);
        $input = $this->multiplication($input);
        $input = $this->addition($input);
        return $input;
    }

    private function mb_charAt($string, $index) {
        if ($index < 0 || $index >= mb_strlen($string, 'UTF-8')) return '';
        return mb_substr($string, $index, 1, 'UTF-8');
    }

    private function isOperator($operator) {
        return mb_strpos('-+*/√^%', $operator, 0, 'UTF-8') !== false && mb_strlen($operator, 'UTF-8') === 1;
    }

    private function isNum($number) {
        if ($number === '-') return false;
        for ($x = 0; $x < mb_strlen($number, 'UTF-8'); $x++) {
            if (mb_strpos('1234567890.-', $this->mb_charAt($number, $x), 0, 'UTF-8') === false) return false;
        }
        return true;
    }

    private function isNegativeSign($minus, $charBefore, $charAfter) {
        return $minus === '-' && (($this->isOperator($charBefore) && $charBefore !== '%') || $charBefore === '(' || $charBefore === '') && $this->isNum($charAfter);
    }

    private function isSuperScript($superScript) {
        $isSuperScript = true;
        for ($x = 0; $x < mb_strlen($superScript, 'UTF-8'); $x++) {
            if (mb_strpos('⁰¹²³⁴⁵⁶⁷⁸⁹', $this->mb_charAt($superScript, $x), 0, 'UTF-8') === false) {
                $isSuperScript = false;
            }
        }
        return $isSuperScript && mb_strlen($superScript, 'UTF-8') > 0;
    }

    private function invert($script) {
        switch ($script) {
            case '⁰': return '0';
            case '¹': return '1';
            case '²': return '2';
            case '³': return '3';
            case '⁴': return '4';
            case '⁵': return '5';
            case '⁶': return '6';
            case '⁷': return '7';
            case '⁸': return '8';
            case '⁹': return '9';
            case '0': return '⁰';
            case '1': return '¹';
            case '2': return '²';
            case '3': return '³';
            case '4': return '⁴';
            case '5': return '⁵';
            case '6': return '⁶';
            case '7': return '⁷';
            case '8': return '⁸';
            case '9': return '⁹';
        }
        return '';
    }

    private function scriptInvert($script) {
        $inversion = '';
        for ($x = 0; $x < mb_strlen($script, 'UTF-8'); $x++) {
            $inversion .= $this->invert($this->mb_charAt($script, $x));
        }
        return $inversion;
    }

    private function tokenize($input) {
        $tokens = [];
        $len = mb_strlen($input, 'UTF-8');
        for ($x = 0; $x < $len; $x++) {
            $char = $this->mb_charAt($input, $x);
            $charBefore = $x === 0 ? '' : $this->mb_charAt($input, $x - 1);
            $charAfter = $x === $len - 1 ? '' : $this->mb_charAt($input, $x + 1);

            if (($this->isOperator($char) || $char == '(' || $char == ')') && !$this->isNegativeSign($char, $charBefore, $charAfter)) {
                if ($char === '%') {
                    $tokens[] = new Token('/', $x, $x);
                    $tokens[] = new Token('100', $x, $x);
                    continue;
                } else if ($char === '(' && $x !== 0 && ($this->isNum($this->mb_charAt($input, $x - 1)) || (count($tokens) > 0 && is_numeric($tokens[count($tokens) - 1]->value)) || $this->mb_charAt($input, $x - 1) === ')')) {
                    $tokens[] = new Token('*', $x, $x);
                    $tokens[] = new Token($char, $x, $x);
                    continue;
                } else if ($char === ')' && $x !== $len - 1 && ($this->mb_charAt($input, $x + 1) === '√' || $this->isSuperScript($this->mb_charAt($input, $x + 1)))) {
                    $tokens[] = new Token($char, $x, $x);
                    $tokens[] = new Token('*', $x + 1, $x + 1);
                    continue;
                } else if ($char === '√' && (($x !== 0 && !$this->isSuperScript($this->mb_charAt($input, $x - 1))) || $x === 0)) {
                    if ($x !== 0 && $this->isNum($this->mb_charAt($input, $x - 1))) {
                        $tokens[] = new Token('*', $x, $x);
                    }
                    $tokens[] = new Token('²', $x, $x);
                }
                $tokens[] = new Token($char, $x, $x);
                continue;
            }
            if ($this->isNum($char) || $this->isNegativeSign($char, $charBefore, $charAfter)) {
                $substring = $char;
                $z = $x + 1;
                for ($y = $x + 1; $y < $len; $z = ++$y) {
                    $yChar = $this->mb_charAt($input, $y);
                    if ($this->isNum($yChar) && $yChar !== '-') {
                        $substring .= $yChar;
                    } else {
                        break;
                    }
                }
                $tokens[] = new Token($substring, $x, $z - 1);
                $x = $z - 1;
                continue;
            }
            if ($this->isSuperScript($char)) {
                $substring = $char;
                $z = $x + 1;
                for ($y = $x + 1; $y < $len; $z = ++$y) {
                    $yChar = $this->mb_charAt($input, $y);
                    if ($this->isSuperScript($yChar)) {
                        $substring .= $yChar;
                    } else {
                        break;
                    }
                }
                if (count($tokens) > 0 && $this->isNum($tokens[count($tokens) - 1]->value)) {
                    $tokens[] = new Token('*', $x, $z - 1);
                }
                $tokens[] = new Token($substring, $x, $z - 1);
                $x = $z - 1;
                continue;
            }
        }
        
        $newTokens = [];
        for ($i = 0; $i < count($tokens); $i++) {
            if ($i + 2 < count($tokens) && $tokens[$i]->value == '(' && $tokens[$i+2]->value == ')') {
                $newTokens[] = new Token($tokens[$i+1]->value, $tokens[$i]->startIndex, $tokens[$i+2]->endIndex);
                $i += 2;
            } else {
                $newTokens[] = $tokens[$i];
            }
        }
        return $newTokens;
    }

    private function round_num($number) {
        $number = round((float)$number, 5);
        $strNumber = (string)$number;
        return $strNumber;
    }

    private function displayInvalidInput($errorMessage, $prefix = '', $errorText = '', $suffix = '') {
        $this->errorMessage = "Invalid Input: " . $errorMessage;
        $this->steps[] = [
            'type' => 'error',
            'message' => "Invalid Input: {$errorMessage}",
            'html' => "{$prefix}<span style=\"color: red;\">{$errorText}</span>{$suffix}"
        ];
        throw new \Exception('Invalid Input');
    }

    private function displayValidInput(&$input, $startTokenIndex, $endTokenIndex, $operation, $prefix = '', $suffix = '') {
        $tokens = $this->tokenize($input);
        
        $inputCopy = $input;
        foreach ($tokens as $i => $token) {
            if (is_numeric($token->value)) {
                $pos = mb_strpos($inputCopy, $token->value, 0, 'UTF-8');
                if ($pos !== false) {
                    $inputCopy = mb_substr($inputCopy, 0, $pos, 'UTF-8') . $this->round_num($token->value) . mb_substr($inputCopy, $pos + mb_strlen($token->value, 'UTF-8'), null, 'UTF-8');
                }
            }
        }
        $input = $inputCopy;
        $tokens = $this->tokenize($input);
        
        $startIndex = $tokens[$startTokenIndex]->startIndex;
        $endIndex = $tokens[$endTokenIndex]->endIndex;

        $this->steps[] = [
            'type' => 'step',
            'stepNumber' => $this->stepNumber++,
            'html' => "{$prefix}" . mb_substr($input, 0, $startIndex, 'UTF-8') . "<span class=\"text-blue mt-3\">" . mb_substr($input, $startIndex, $endIndex - $startIndex + 1, 'UTF-8') . "</span>" . mb_substr($input, $endIndex + 1, null, 'UTF-8') . "{$suffix}",
            'operation' => $operation
        ];
    }

    private function displaySolution($input) {
        $this->finalAnswer = $this->round_num((float)$input);
    }

    private function checkNumbers($opIndex, $tokens, $input, $prefix = '', $suffix = '') {
        $num1 = $tokens[$opIndex - 1]->value;
        $num2 = $tokens[$opIndex + 1]->value;
        if ($this->isSuperScript($num1)) $num1 = $this->scriptInvert($num1);
        if ($this->isSuperScript($num2)) $num2 = $this->scriptInvert($num2);
        
        if ($opIndex < count($tokens) - 3 && count($tokens) > $opIndex + 1 && $this->isSuperScript($tokens[$opIndex + 1]->value)) {
            $this->displayInvalidInput('<span class="red-text left-align font_size18">To raise a number to a root wrap the root in parentheses</span>', 
                mb_substr($input, 0, $tokens[$opIndex + 1]->startIndex, 'UTF-8'), 
                mb_substr($input, $tokens[$opIndex + 1]->startIndex, $tokens[$opIndex + 3]->endIndex - $tokens[$opIndex + 1]->startIndex + 1, 'UTF-8'), 
                mb_substr($input, $tokens[$opIndex + 3]->endIndex + 1, null, 'UTF-8')
            );
        }
        if (!is_numeric($num1)) {
            $this->displayInvalidInput('<span class="red-text left-align font_size18">Not a Number</span>', 
                $prefix . mb_substr($input, 0, $tokens[$opIndex - 1]->startIndex, 'UTF-8'), 
                $tokens[$opIndex - 1]->value, 
                mb_substr($input, $tokens[$opIndex - 1]->endIndex + 1, null, 'UTF-8') . $suffix
            );
        }
        if (!is_numeric($num2)) {
            $this->displayInvalidInput('<span class="red-text left-align font_size18">>Not a Number</span>', 
                $prefix . mb_substr($input, 0, $tokens[$opIndex + 1]->startIndex, 'UTF-8'), 
                $tokens[$opIndex + 1]->value, 
                mb_substr($input, $tokens[$opIndex + 1]->endIndex + 1, null, 'UTF-8') . $suffix
            );
        }
        return is_numeric($num1) && is_numeric($num2);
    }

    private function addition($input, $prefix = '', $suffix = '') {
        $tokens = $this->tokenize($input);
        for ($x = 0; $x < count($tokens); $x++) {
            if ($tokens[$x]->value == '+' && $this->checkNumbers($x, $tokens, $input, $prefix, $suffix)) {
                $this->displayValidInput($input, $x - 1, $x + 1, '', $prefix, $suffix);
                $input = mb_substr($input, 0, $tokens[$x - 1]->startIndex, 'UTF-8') . ((float)$tokens[$x - 1]->value + (float)$tokens[$x + 1]->value) . mb_substr($input, $tokens[$x + 1]->endIndex + 1, null, 'UTF-8');
                $tokens = $this->tokenize($input);
                $x = -1;
                continue;
            } else if ($tokens[$x]->value == '-' && $this->checkNumbers($x, $tokens, $input, $prefix, $suffix)) {
                $this->displayValidInput($input, $x - 1, $x + 1, '', $prefix, $suffix);
                $input = mb_substr($input, 0, $tokens[$x - 1]->startIndex, 'UTF-8') . ((float)$tokens[$x - 1]->value - (float)$tokens[$x + 1]->value) . mb_substr($input, $tokens[$x + 1]->endIndex + 1, null, 'UTF-8');
                $tokens = $this->tokenize($input);
                $x = -1;
                continue;
            }
        }
        return count($tokens) == 1 ? $tokens[0]->value : $input;
    }

    private function multiplication($input, $prefix = '', $suffix = '') {
        $tokens = $this->tokenize($input);
        if (mb_strpos($input, '%', 0, 'UTF-8') !== false && mb_strpos($input, '%', 0, 'UTF-8') != mb_strlen($input, 'UTF-8') && is_numeric($this->mb_charAt($input, mb_strpos($input, '%', 0, 'UTF-8') + 1))) {
            for ($y = 0; $y < count($tokens) - 2; $y++) {
                if ($tokens[$y]->value == '/' && $tokens[$y]->startIndex == mb_strpos($input, '%', 0, 'UTF-8')) {
                    $this->displayInvalidInput('<span class="red-text left-align font_size18">Not an Operator</span>', 
                        mb_substr($input, 0, $tokens[$y + 2]->startIndex, 'UTF-8'), 
                        $tokens[$y + 2]->value, 
                        mb_substr($input, $tokens[$y + 2]->endIndex + 1, null, 'UTF-8')
                    );
                }
            }
        }
        for ($x = 0; $x < count($tokens); $x++) {
            if ($tokens[$x]->value == '*' && $this->checkNumbers($x, $tokens, $input, $prefix, $suffix)) {
                $this->displayValidInput($input, $x - 1, $x + 1, '', $prefix, $suffix);
                $input = mb_substr($input, 0, $tokens[$x - 1]->startIndex, 'UTF-8') . ((float)$tokens[$x - 1]->value * (float)$tokens[$x + 1]->value) . mb_substr($input, $tokens[$x + 1]->endIndex + 1, null, 'UTF-8');
                $tokens = $this->tokenize($input);
                $x = -1;
                continue;
            } else if ($tokens[$x]->value == '/' && $this->checkNumbers($x, $tokens, $input, $prefix, $suffix)) {
                $this->displayValidInput($input, $x - 1, $x + 1, '', $prefix, $suffix);
                $input = mb_substr($input, 0, $tokens[$x - 1]->startIndex, 'UTF-8') . ((float)$tokens[$x - 1]->value / (float)$tokens[$x + 1]->value) . mb_substr($input, $tokens[$x + 1]->endIndex + 1, null, 'UTF-8');
                $tokens = $this->tokenize($input);
                $x = -1;
                continue;
            }
        }
        return $input;
    }

    private function exponents($input, $prefix = '', $suffix = '') {
        $tokens = $this->tokenize($input);
        for ($x = 0; $x < count($tokens); $x++) {
            if (mb_strpos($input, 'ʸ', 0, 'UTF-8') !== false) {
                $this->displayInvalidInput("To use the 'ʸ√' button enter the number for the value of 'y' first, then click the 'ʸ√' button", 
                    mb_substr($input, 0, mb_strpos($input, 'ʸ', 0, 'UTF-8'), 'UTF-8'), 
                    'ʸ', 
                    mb_substr($input, mb_strpos($input, 'ʸ', 0, 'UTF-8') + 1, null, 'UTF-8')
                );
                return $input;
            }
            if ($tokens[$x]->value === '√' && $this->checkNumbers($x, $tokens, $input, $prefix, $suffix)) {
                $this->displayValidInput($input, $x - 1, $x + 1, '', $prefix, $suffix);
                if ($x >= 3 && (is_numeric($tokens[$x - 3]->value) || $this->mb_charAt($input, $tokens[$x - 2]->endIndex) == ')')) {
                    $val = pow((float)$tokens[$x + 1]->value, (1 / (float)$this->scriptInvert($tokens[$x - 1]->value)));
                    $input = mb_substr($input, 0, $tokens[$x - 2]->endIndex, 'UTF-8') . '(' . $val . ')' . mb_substr($input, $tokens[$x + 1]->endIndex + 1, null, 'UTF-8');
                } else {
                    $val = pow((float)$tokens[$x + 1]->value, (1 / (float)$this->scriptInvert($tokens[$x - 1]->value)));
                    $input = mb_substr($input, 0, $tokens[$x - 1]->startIndex, 'UTF-8') . $val . mb_substr($input, $tokens[$x + 1]->endIndex + 1, null, 'UTF-8');
                }
                $tokens = $this->tokenize($input);
                $x = -1;
                continue;
            } else if ($tokens[$x]->value === '^' && $this->checkNumbers($x, $tokens, $input, $prefix, $suffix)) {
                $this->displayValidInput($input, $x - 1, $x + 1, '', $prefix, $suffix);
                $val = pow((float)$tokens[$x - 1]->value, (float)$tokens[$x + 1]->value);
                $input = mb_substr($input, 0, $tokens[$x - 1]->startIndex, 'UTF-8') . $val . mb_substr($input, $tokens[$x + 1]->endIndex + 1, null, 'UTF-8');
                $tokens = $this->tokenize($input);
                $x = -1;
                continue;
            }
        }
        return $input;
    }

    private function parentheses($input) {
        $tokens = $this->tokenize($input);
        if (count($tokens) > 0 && $this->isOperator($tokens[count($tokens) - 1]->value)) {
            $this->displayInvalidInput('<span class="red-text left-align font_size18">Operators must be followed by a number</span>', 
                mb_substr($input, 0, $tokens[count($tokens) - 1]->startIndex, 'UTF-8'), 
                mb_substr($input, $tokens[count($tokens) - 1]->startIndex, null, 'UTF-8')
            );
        }
        
        while (count(array_filter($tokens, function($t) { return $t->value == '(' || $t->value == ')'; })) > 0) {
            $insideParentheses = '';
            $openParenthesisIndex = -1;
            $openParenthesisTokenIndex = -1;
            $closedParenthesisIndex = -1;
            $closedParenthesisTokenIndex = -1;
            for ($y = 0; $y < count($tokens) && $closedParenthesisIndex == -1; $y++) {
                if ($tokens[$y]->value == ')') {
                    $closedParenthesisIndex = $tokens[$y]->endIndex;
                    $closedParenthesisTokenIndex = $y;
                }
            }
            for ($x = 0; $x < count($tokens) && $openParenthesisIndex == -1; $x++) {
                if ($tokens[$x]->value == '(' && ($tokens[$x]->startIndex > $closedParenthesisIndex && $closedParenthesisIndex != -1)) {
                    break;
                } else if ($tokens[$x]->value == '(') {
                    $openParenthesisIndex = $tokens[$x]->startIndex;
                    $openParenthesisTokenIndex = $x;
                }
            }
            if ($openParenthesisIndex === -1) {
                $this->displayInvalidInput('<span class="red-text left-align font_size18">Unbalanced Closed Parenthesis</span>', 
                    mb_substr($input, 0, $closedParenthesisIndex, 'UTF-8'), 
                    $this->mb_charAt($input, $closedParenthesisIndex), 
                    mb_substr($input, $closedParenthesisIndex + 1, null, 'UTF-8')
                );
            }
            if ($closedParenthesisIndex === -1) {
                $this->displayInvalidInput('<span class="red-text left-align font_size18">Unbalanced Open Parenthesis</span>', 
                    mb_substr($input, 0, $openParenthesisIndex, 'UTF-8'), 
                    $this->mb_charAt($input, $openParenthesisIndex), 
                    mb_substr($input, $openParenthesisIndex + 1, null, 'UTF-8')
                );
            }
            
            $this->displayValidInput($input, $openParenthesisTokenIndex, $closedParenthesisTokenIndex, '');
            $prefix = mb_substr($input, 0, $openParenthesisIndex + 1, 'UTF-8');
            $suffix = mb_substr($input, $closedParenthesisIndex, null, 'UTF-8');
            $insideParentheses = mb_substr($input, $openParenthesisIndex + 1, $closedParenthesisIndex - ($openParenthesisIndex + 1), 'UTF-8');
            
            $insideParentheses = $this->exponents($insideParentheses, $prefix, $suffix);
            $insideParentheses = $this->multiplication($insideParentheses, $prefix, $suffix);
            $insideParentheses = $this->addition($insideParentheses, $prefix, $suffix);
            
            $input = mb_substr($input, 0, $openParenthesisIndex + 1, 'UTF-8') . $insideParentheses . mb_substr($input, $closedParenthesisIndex, null, 'UTF-8');
            $tokens = $this->tokenize($input);
        }
        return $input;
    }
}
