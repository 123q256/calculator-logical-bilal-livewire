<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class TruthTableCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $eq = '(p & q) -> ~r';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $request = request();
        if ($request->has('eq')) {
            $this->eq = $request->eq;
        }
    }

    public function resetForm()
    {
        $this->eq = '(p & q) -> ~r';
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function loadExample()
    {
        $examples = [
            "~A",
            "(A & B)",
            "(# -> (B v ~A))",
            "A<->(BvC), A, (~B->C)",
            "(p & q) -> ~r",
            "(p | q) -> ~r",
            "(p & q) -> (~r | s)"
        ];
        $this->eq = $examples[array_rand($examples)];
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $this->error = null;
        $this->detail = null;

        try {
            $tableData = $this->make_table($this->eq);

            $request = request();
            $request->merge([
                'eq' => $this->eq,
                'submit' => 'Calculate'
            ]);

            $model = new Math();
            $result = $model->truth($request);

            if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
                $this->detail = [
                    'eq' => $this->eq,
                    'tableData' => $tableData
                ];

                session()->flash('calculator_result', $this->detail);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', ['eq' => $this->eq]);
                $this->error = null;

                if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                     return redirect()->to(url()->previous() ?? '/');
                } else {
                    $this->js(<<<'JS'
                        setTimeout(() => {
                            const el = document.getElementById('result-section');
                            if (el) {
                                const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                                window.scrollTo({ top: offset, behavior: 'smooth' });
                            }
                        }, 100);
                    JS);
                }
                return;
            }

            $this->error = $result['error'] ?? 'Please Check Your Input.';
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
        }

        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    // --- Parser Engine ---

    public function make_table($eq_str)
    {
        $eq_str = str_replace(' ', '', $eq_str);
        if ($eq_str === '') {
            throw new \Exception("You have to enter an Expression.");
        }
        $r = $this->badchar($eq_str);
        if ($r >= 0) {
            throw new \Exception("This " . $eq_str[$r] . " symbol is unrecognized!");
        }

        $eq_arr = explode(',', $eq_str);
        $trees = [];
        foreach ($eq_arr as $i => $item) {
            $parsed = $this->parse_val($item);
            if (empty($parsed)) {
                $eq_arr[$i] = '(' . $item . ')';
                $parsed = $this->parse_val($eq_arr[$i]);
            }
            if (empty($parsed)) {
                throw new \Exception("The string is not well formed");
            }
            $trees[] = $parsed;
        }

        $table = $this->make_tab($eq_arr, $trees);
        return $this->truthtable_data($table, $trees);
    }

    public function char_set($c)
    {
        if ($c === true) return 'T';
        if ($c === false) return 'F';
        if ($c === '~') return '~';
        if ($c === '&') return '&amp;';
        if ($c === 'v') return '&or;';
        if ($c === '->') return '&rarr;';
        if ($c === '<->') return '&harr;';
        if ($c === '|') return '|';
        if ($c === '#') return '&perp;';
        return $c;
    }

    public function make_tab($fs, $ts)
    {
        $lhs = $this->mk_lhs($fs);
        $rhs = [];
        for ($i = 0; $i < count($fs); $i++) {
            $rhs[] = $this->t_seg($fs[$i], $ts[$i], $lhs);
        }
        return array_merge([$lhs], $rhs);
    }

    public function mk_lhs($fs)
    {
        $atm = [];
        for ($i = 0; $i < count($fs); $i++) {
            $atm = array_merge($atm, $this->get_atm($fs[$i]));
        }
        $atm = $this->asorted($this->rem_dup($atm));
        $tvrows = [];
        if (in_array('#', $atm)) {
            $tvrows = $this->tv_comb(count($atm) - 1);
            foreach ($tvrows as &$row) {
                $row = array_merge([false], $row);
            }
        } else {
            $tvrows = $this->tv_comb(count($atm));
        }
        return array_merge([$atm], $tvrows);
    }

    public function t_seg($f, $t, $mk_lhs)
    {
        $tbl_rows = [];
        for ($i = 1; $i < count($mk_lhs); $i++) {
            $a = $this->assign($mk_lhs[0], $mk_lhs[$i]);
            $row = $this->eval_tree($t, $a);
            $row = $this->d1($row);
            $tbl_rows[] = $row;
        }
        return array_merge([$this->d1($t)], $tbl_rows);
    }

    public function get_atm($s)
    {
        $out = [];
        for ($i = 0; $i < strlen($s); $i++) {
            if ($this->is_atm($s[$i])) {
                $out[] = $s[$i];
            }
        }
        return $out;
    }

    public function tv_comb($n)
    {
        if ($n == 0) {
            return [[]];
        }
        $prev = $this->tv_comb($n - 1);
        $res = [];
        foreach ($prev as $x) {
            $res[] = array_merge([true], $x);
        }
        foreach ($prev as $x) {
            $res[] = array_merge([false], $x);
        }
        return $res;
    }

    public function assign($s, $b)
    {
        $a = [];
        for ($i = 0; $i < count($s); $i++) {
            $a[$s[$i]] = $b[$i];
        }
        return $a;
    }

    public function d1($t)
    {
        if (count($t) == 5) {
            return array_merge([$t[0]], $this->d1($t[1]), [$t[2]], $this->d1($t[3]), [$t[4]]);
        } elseif (count($t) == 2) {
            return array_merge([$t[0]], $this->d1($t[1]));
        } elseif (count($t) == 1) {
            return [$t[0]];
        }
        return [];
    }

    public function eval_tree($t, $a)
    {
        if (count($t) == 5) {
            $t1 = $this->eval_tree($t[1], $a);
            $t3 = $this->eval_tree($t[3], $a);
            return ['', $t1, $this->get_tvs([$t[2], $t1, $t3]), $t3, ''];
        } elseif (count($t) == 2) {
            $t1 = $this->eval_tree($t[1], $a);
            return [$this->get_tvs([$t[0], $t1]), $t1];
        } elseif (count($t) == 1) {
            return [$a[$t[0]]];
        }
        return [];
    }

    public function get_tvs($arr)
    {
        switch ($arr[0]) {
            case '~':
                return !$this->tvs($arr[1]);
            case '&':
                return $this->tvs($arr[1]) && $this->tvs($arr[2]);
            case 'v':
                return $this->tvs($arr[1]) || $this->tvs($arr[2]);
            case '->':
                return (!$this->tvs($arr[1]) || $this->tvs($arr[2]));
            case '<->':
                return ($this->tvs($arr[1]) === $this->tvs($arr[2]));
            case '|':
                return (!($this->tvs($arr[1]) && $this->tvs($arr[2])));
        }
        return false;
    }

    private function tvs($x)
    {
        switch (count($x)) {
            case 5:
                return $x[2];
            case 2:
                return $x[0];
            case 1:
                return $x[0];
        }
        return false;
    }

    public function rem_dup($a)
    {
        return array_values(array_unique($a));
    }

    public function asorted($a)
    {
        sort($a);
        return $a;
    }

    public function parse_val($s)
    {
        if (strlen($s) == 0) {
            return [];
        }
        if ($this->is_unary($s[0])) {
            $s1 = $this->parse_val(substr($s, 1));
            return !empty($s1) ? [$s[0], $s1] : [];
        }
        if ($s[0] == '(' && $s[strlen($s) - 1] == ')') {
            $a = $this->g_sub($s);
            if (in_array(null, $a) || in_array('', $a)) {
                return [];
            } else {
                $s1 = $this->parse_val($a[0]);
                $s2 = $this->parse_val($a[2]);
                if (!empty($s1) && !empty($s2)) {
                    return ['(', $s1, $a[1], $s2, ')'];
                } else {
                    return [];
                }
            }
        } else {
            return $this->is_atm($s) ? [$s] : [];
        }
    }

    public function is_atm($s)
    {
        if (strlen($s) != 1) {
            return false;
        }
        $pr = '#ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz';
        return strpos($pr, $s) !== false;
    }

    public function is_unary($s)
    {
        return strpos($s, '~') === 0;
    }

    public function g_sub($s)
    {
        $stk = [];
        $l = 0;
        for ($i = 0; $i < strlen($s); $i++) {
            if ($s[$i] == '(') {
                $stk[] = '(';
            } elseif ($s[$i] == ')' && count($stk) > 0) {
                array_pop($stk);
            } elseif (count($stk) == 1 && ($l = $this->isB(substr($s, $i))) > 0) {
                return [substr($s, 1, $i - 1), substr($s, $i, $l), substr($s, $i + $l, strlen($s) - $i - $l - 1)];
            }
        }
        return [null, null, null];
    }

    public function isB($s)
    {
        $bc = ['&', 'v', '->', '<->', '|'];
        foreach ($bc as $op) {
            if (strpos($s, $op) === 0) {
                return strlen($op);
            }
        }
        return 0;
    }

    public function badchar($s)
    {
        $x = ',()~v&<>-|#ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuwxyz';
        for ($i = 0; $i < strlen($s); $i++) {
            if (strpos($x, $s[$i]) === false) {
                return $i;
            }
        }
        return -1;
    }

    public function res_index($t)
    {
        if (count($t) == 2 || count($t) == 1) {
            return 0;
        } else {
            return $this->nl($t[1]) + 1;
        }
    }

    public function nl($t)
    {
        $out = 0;
        for ($i = 0; $i < count($t); $i++) {
            if (is_array($t[$i])) {
                $out += $this->nl($t[$i]);
            } else {
                $out += 1;
            }
        }
        return $out;
    }

    public function truthtable_data($table, $trees)
    {
        $res_indices = [];
        for ($i = 0; $i < count($trees); $i++) {
            $res_indices[] = $this->res_index($trees[$i]);
        }

        $cols = [];
        $cols[] = [
            'type' => 'atoms',
            'headers' => $table[0][0],
            'rows' => array_slice($table[0], 1),
            'res_index' => null
        ];

        for ($i = 1; $i < count($table); $i++) {
            $cols[] = [
                'type' => 'formula',
                'headers' => $table[$i][0],
                'rows' => array_slice($table[$i], 1),
                'res_index' => $res_indices[$i - 1]
            ];
        }

        return [
            'cols' => $cols,
            'row_count' => count($table[0]) - 1
        ];
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.truth-table-calculator');
    }
}
