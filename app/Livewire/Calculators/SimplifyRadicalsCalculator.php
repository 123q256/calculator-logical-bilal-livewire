<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class SimplifyRadicalsCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $expression_unit = '1';
    public $num1 = '5';
    public $num2 = '7';
    public $num3 = '7';
    public $num4 = '7';
    public $num5 = '7';
    public $num6 = '7';

    // Output steps
    public $result_steps = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->expression_unit = $inputs['expression_unit'] ?? '1';
            $this->num1 = $inputs['num1'] ?? '5';
            $this->num2 = $inputs['num2'] ?? '7';
            $this->num3 = $inputs['num3'] ?? '7';
            $this->num4 = $inputs['num4'] ?? '7';
            $this->num5 = $inputs['num5'] ?? '7';
            $this->num6 = $inputs['num6'] ?? '7';
        }

        if ($this->detail) {
            $this->runCalculation();
        }
    }

    public function resetForm()
    {
        $this->expression_unit = '1';
        $this->num1 = '5';
        $this->num2 = '7';
        $this->num3 = '7';
        $this->num4 = '7';
        $this->num5 = '7';
        $this->num6 = '7';
        $this->error = null;
        $this->detail = null;
        $this->result_steps = [];

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

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
        $this->result_steps = [];
    }

    public function calculate()
    {
        $request = \Illuminate\Http\Request::create('', 'POST', [
            'expression_unit' => $this->expression_unit,
            'num1' => $this->num1,
            'num2' => $this->num2,
            'num3' => $this->num3,
            'num4' => $this->num4,
            'num5' => $this->num5,
            'num6' => $this->num6,
        ]);

        $model = new Math();
        $result = $model->simplify_radicals($request);

        if (is_array($result)) {
            foreach ($result as $key => $val) {
                if (is_float($val)) {
                    if (is_nan($val)) {
                        $result[$key] = 'NAN';
                    } elseif (is_infinite($val)) {
                        $result[$key] = 'INF';
                    }
                }
            }
        }

        if (!empty($result) && !isset($result['error'])) {
            $result['RESULT'] = 1;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'expression_unit' => $this->expression_unit,
                'num1' => $this->num1,
                'num2' => $this->num2,
                'num3' => $this->num3,
                'num4' => $this->num4,
                'num5' => $this->num5,
                'num6' => $this->num6,
            ]);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->runCalculation();
                $this->js("
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                ");
            }
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
        $this->result_steps = [];
    }

    private function runCalculation()
    {
        $this->calculateSteps(
            $this->num1,
            $this->num2,
            $this->num4,
            $this->num5,
            $this->num3,
            $this->num6,
            $this->expression_unit
        );
    }

    private function addHtml($argument)
    {
        $this->result_steps[] = $argument;
    }

    private function isInteger($n)
    {
        return is_numeric($n) && ($n == (int)$n);
    }

    private function primesimplify($num, $result = [])
    {
        if (is_infinite($num) || is_nan($num)) {
            return [$num];
        }
        if ($num <= 1) {
            return [$num];
        }
        $root = sqrt($num);
        $x = 2;
        if (fmod($num, $x) != 0) {
            $x = 3;
            while ((fmod($num, $x) != 0) && (($x = $x + 2) < $root)) {}
        }
        $x = ($x <= $root) ? $x : $num;
        $result[] = $x;

        return ($x == $num) ? $result : $this->primesimplify($num / $x, $result);
    }

    private function forpower($primeFactors)
    {
        $array = [];
        $power = 1;
        $isShorter = false;
        $exponents = [];
        $bases = [];
        $count = count($primeFactors);
        for ($i = 0; $i < $count; $i++) {
            if ($i != $count - 1 && $primeFactors[$i] == $primeFactors[$i + 1]) {
                $power++;
            } else {
                if ($power != 1) {
                    $array[] = $primeFactors[$i] . '<sup>' . $power . '</sup>';
                    $isShorter = true;
                } else {
                    $array[] = $primeFactors[$i];
                }

                $exponents[] = $power;
                $bases[] = $primeFactors[$i];
                $power = 1;
            }
        }
        return [$array, $isShorter, $exponents, $bases];
    }

    private function getSimplification($x, $root)
    {
        if (is_infinite($x) || is_infinite($root) || is_nan($x) || is_nan($root)) {
            return [];
        }
        $simplification = [];
        $primeFactors = $this->primesimplify($x);
        
        if (count($primeFactors) === 1) {
            $simplification[] = 'prime';
        } else {
            $simplification[] = implode(' * ', $primeFactors);
            $to_power = $this->forpower($primeFactors);

            if ($to_power[1]) {
                $simplification[] = implode(' * ', $to_power[0]);

                $valuesPulled = [];
                for ($i = 0; $i < count($to_power[2]); $i++) {
                    $times = floor($to_power[2][$i] / $root);
                    for ($j = 0; $j < $times; $j++) {
                        $valuesPulled[] = $to_power[3][$i];
                    }
                }

                $numberInFront = 1;
                for ($i = 0; $i < count($valuesPulled); $i++) {
                    $numberInFront *= $valuesPulled[$i];
                }
                $numberUnder = round($x / pow($numberInFront, $root), 5);

                $factorizationRoot = $this->primesimplify($root);
                $factorizationUnder = $this->primesimplify($numberUnder);
                $to_powerUnderAfter = $this->forpower($factorizationUnder);

                $simplifyRoot = [];
                $divideRootBy = 1;
                for ($i = 0; $i < count($factorizationRoot); $i++) {
                    for ($j = 0; $j < count($to_powerUnderAfter[2]); $j++) {
                        if ($to_powerUnderAfter[2][$j] % $factorizationRoot[$i] == 0) {
                            $simplifyRoot[] = 1;
                        } else {
                            $simplifyRoot[] = 0;
                        }
                    }
                    if (!in_array(0, $simplifyRoot)) {
                        $divideRootBy *= $factorizationRoot[$i];
                        for ($j = 0; $j < count($to_powerUnderAfter[2]); $j++) {
                            $to_powerUnderAfter[2][$j] /= $factorizationRoot[$i];
                        }
                    }
                    $simplifyRoot = [];
                }

                $newRoot = round($root / $divideRootBy, 5);
                $newUnder = round(pow($numberUnder, 1 / $divideRootBy), 5);

                if ($numberInFront != 1 || $newRoot !== $root) {
                    $simplification[2] = [];
                    $simplification[2][] = $numberInFront;
                    $simplification[2][] = implode(' * ', $to_powerUnderAfter[0]);
                    if ($newRoot !== $root) {
                        $simplification[3] = [];
                        $simplification[3][] = $numberInFront;
                        $simplification[3][] = $newRoot;
                        $simplification[3][] = $newUnder;
                    }
                }
            }
        }
        return $simplification;
    }

    private function simplify_gcf($a, $b)
    {
        $a = abs($a);
        $b = abs($b);
        if ($b > $a) {
            $temp = $a;
            $a = $b;
            $b = $temp;
        }
        while (true) {
            if ($b == 0) {
                return $a;
            }
            $a = $a % $b;
            if ($a == 0) {
                return $b;
            }
            $b = $b % $a;
        }
    }

    private function simply_lcm($a, $b)
    {
        $gcf = $this->simplify_gcf($a, $b);
        if ($gcf == 0) {
            return 0;
        }
        return abs(($a * $b) / $gcf);
    }

    private function calculateSteps($a, $b, $c, $d, $n, $m, $option)
    {
        $this->result_steps = [];

        if (is_infinite((float)$a) || is_infinite((float)$b) || is_infinite((float)$c) || is_infinite((float)$d) || is_infinite((float)$n) || is_infinite((float)$m) ||
            is_nan((float)$a) || is_nan((float)$b) || is_nan((float)$c) || is_nan((float)$d) || is_nan((float)$n) || is_nan((float)$m)) {
            $this->addHtml("The numbers are too large or invalid to process.");
            return;
        }

        $newRoot = $n;
        $simplification_first = null;
        $simplification_second = null;
        $numberwrite = $n;
        $mWrite = $m;
        $num1Write = '';
        $cWrite = '';
        $fline = '';
        $sline = '';
        $tline = '';
        $lline = '';
        $number_in_front = 0;
        $expresssion_first = [];
        $expression_second = [];
        $operation = '';

        if ($n == 2) {
            $numberwrite = '';
        }
        if ($m == 2) {
            $mWrite = '';
        }
        if (!is_numeric($a) || $a == 1 || $a === '') {
            $a = 1;
            $num1Write = '';
        } else {
            $num1Write = $a . ' * ';
        }
        if (!is_numeric($c) || $c == 1 || $c === '') {
            $c = 1;
            $cWrite = '';
        } else {
            $cWrite = $c . ' * ';
        }

        $expresssion_first = [$a, $n, $b];
        $expression_second = [$c, $m, $d];

        if (is_numeric($b)) {
            $pow_val = pow($b, 1 / $n);
            if ($this->isInteger($pow_val) && $option == 1) {
                $this->addHtml($num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ' = ' . ($a * $pow_val));
                return;
            } else {
                if (is_numeric($n)) {
                    $simplification_first = $this->getSimplification($b, $n);
                }
            }
        }

        if (is_numeric($d)) {
            if (is_numeric($m)) {
                $simplification_second = $this->getSimplification($d, $m);
            }
        }

        if (is_numeric($b) && is_numeric($n) && ($option == 1 || (is_numeric($d) && is_numeric($m)))) {
            if ($option == 1) {
                $fline .= $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b;

                if (count($simplification_first) > 2) {
                    $fline .= ' = ' . $num1Write . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[1] . ') =';
                    $this->addHtml($fline);

                    $sline .= '= ' . $num1Write . $simplification_first[2][0] . ' * ' . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[2][1] . ')';
                    $expresssion_first[0] = $a * $simplification_first[2][0];
                    $expresssion_first[2] = $b / pow($simplification_first[2][0], $n);

                    if (count($simplification_first) > 3) {
                        $sline .= ' =';
                        if ($simplification_first[2][0] != 1) {
                            $this->addHtml($sline);
                        }

                        if ($simplification_first[3][1] == 2) {
                            $numberwrite = '';
                        } else {
                            $numberwrite = $simplification_first[3][1];
                        }
                        if ($a * $simplification_first[3][0] == 1) {
                            $num1Write = '';
                        } else {
                            $num1Write = $a * $simplification_first[3][0];
                        }
                        $tline .= '= ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $simplification_first[3][2];
                        $this->addHtml($tline);
                        $expresssion_first[2] = pow($expresssion_first[2], 1 / ($expresssion_first[1] / $simplification_first[3][1]));
                        $expresssion_first[1] = $simplification_first[3][1];
                    } else {
                        $this->addHtml($sline);
                    }

                    if ($expresssion_first[0] == 1) {
                        $expresssion_first[0] = '';
                    } else {
                        $expresssion_first[0] .= ' * ';
                    }
                    if ($expresssion_first[1] == 2) {
                        $expresssion_first[1] = '';
                    }

                    $lline .= '= ' . $expresssion_first[0] . '<sup>' . $expresssion_first[1] . '</sup>√' . $expresssion_first[2];
                    if ($lline != $sline && $lline != $tline) {
                        $this->addHtml($lline);
                    }
                } else {
                    $this->addHtml($fline);
                    $this->addHtml($this->lang[8] . '.');
                }
            }

            else if ($option == 2) {
                if ($c >= 0) {
                    $operation = ' + ';
                } else {
                    $operation = ' ';
                }
                $pow_b = pow($b, 1 / $n);
                $pow_d = pow($d, 1 / $m);
                if ($this->isInteger($pow_b) && $this->isInteger($pow_d)) {
                    $this->addHtml($num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ' = ' . ($a * $pow_b) . ' + ' . ($c * $pow_d) . ' = ' . ($a * $pow_b + $c * $pow_d));
                }
                elseif ($this->isInteger($pow_b)) {
                    $fline .= $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d;
                    if (count($simplification_second) > 2) {
                        $fline .= ' = ' . $pow_b . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√(' . $simplification_second[1] . ') =';
                        $this->addHtml($fline);

                        $sline .= '= ' . $pow_b . $operation . $cWrite . $simplification_second[2][0] . ' * ' . '<sup>' . $mWrite . '</sup>√(' . $simplification_second[2][1] . ')';
                        $expression_second[0] = $c * $simplification_second[2][0];
                        $expression_second[2] = $d / pow($simplification_second[2][0], $m);

                        if (count($simplification_second) > 3) {
                            $sline .= ' =';
                            if ($simplification_second[2][0] != 1) {
                                $this->addHtml($sline);
                            }

                            if ($simplification_second[3][1] == 2) {
                                $mWrite = '';
                            } else {
                                $mWrite = $simplification_second[3][1];
                            }
                            if ($c * $simplification_second[3][0] == 1) {
                                $cWrite = '';
                            } else {
                                $cWrite = $c * $simplification_second[3][0];
                            }
                            $tline .= '= ' . $pow_b . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $simplification_second[3][2];
                            $this->addHtml($tline);
                            $expression_second[2] = pow($expression_second[2], 1 / ($expression_second[1] / $simplification_second[3][1]));
                            $expression_second[1] = $simplification_second[3][1];
                        } else {
                            $this->addHtml($sline);
                        }

                        if ($expression_second[0] == 1) {
                            $expression_second[0] = '';
                        } else {
                            $expression_second[0] .= ' * ';
                        }
                        if ($expression_second[1] == 2) {
                            $expression_second[1] = '';
                        }

                        $lline .= '= ' . $pow_b . $operation . $expression_second[0] . '<sup>' . $expression_second[1] . '</sup>√' . $expression_second[2];
                        if ($lline != $sline && $lline != $tline) {
                            $this->addHtml($lline);
                        }
                    } else {
                        $fline .= ' = ' . $pow_b . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d;
                        $this->addHtml($fline);
                    }
                }
                elseif ($this->isInteger($pow_d)) {
                    $fline .= $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d;
                    if (count($simplification_first) > 2) {
                        $fline .= ' = ' . $num1Write . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[1] . ')' . $operation . $pow_d . ' =';
                        $this->addHtml($fline);

                        $sline .= '= ' . $num1Write . $simplification_first[2][0] . ' * ' . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[2][1] . ')' . $operation . $pow_d;
                        $expresssion_first[0] = $a * $simplification_first[2][0];
                        $expresssion_first[2] = $b / pow($simplification_first[2][0], $n);

                        if (count($simplification_first) > 3) {
                            $sline .= ' =';
                            if ($simplification_first[2][0] != 1) {
                                $this->addHtml($sline);
                            }

                            if ($simplification_first[3][1] == 2) {
                                $numberwrite = '';
                            } else {
                                $numberwrite = $simplification_first[3][1];
                            }
                            if ($a * $simplification_first[3][0] == 1) {
                                $num1Write = '';
                            } else {
                                $num1Write = $a * $simplification_first[3][0];
                            }
                            $tline .= '= ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $simplification_first[3][2] . $operation . $pow_d;
                            $this->addHtml($tline);
                            $expresssion_first[2] = pow($expresssion_first[2], 1 / ($expresssion_first[1] / $simplification_first[3][1]));
                            $expresssion_first[1] = $simplification_first[3][1];
                        } else {
                            $this->addHtml($sline);
                        }

                        if ($expresssion_first[0] == 1) {
                            $expresssion_first[0] = '';
                        } else {
                            $expresssion_first[0] .= ' * ';
                        }
                        if ($expresssion_first[1] == 2) {
                            $expresssion_first[1] = '';
                        }

                        $lline .= '= ' . $expresssion_first[0] . '<sup>' . $expresssion_first[1] . '</sup>√' . $expresssion_first[2] . $operation . $pow_d;
                        if ($lline != $sline && $lline != $tline) {
                            $this->addHtml($lline);
                        }
                    } else {
                        $fline .= ' = ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . $operation . $pow_d;
                        $this->addHtml($fline);
                    }
                }
                else {
                    $fline .= $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ' = ';

                    if (count($simplification_first) > 2 && count($simplification_second) > 2) {
                        $fline .= $num1Write . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[1] . ')' . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√(' . $simplification_second[1] . ') =';
                        $this->addHtml($fline);
                        $sline .= '= ' . $num1Write . $simplification_first[2][0] . ' * ' . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[2][1] . ')' . $operation . $cWrite . $simplification_second[2][0] . ' * ' . '<sup>' . $mWrite . '</sup>√(' . $simplification_second[2][1] . ')';

                        $expresssion_first[0] = $a * $simplification_first[2][0];
                        $expresssion_first[2] = $b / pow($simplification_first[2][0], $n);
                        $expression_second[0] = $c * $simplification_second[2][0];
                        $expression_second[2] = $d / pow($simplification_second[2][0], $m);
                        if ($expresssion_first[0] == 1) {
                            $expresssion_first[0] = '';
                        }
                        if ($expresssion_first[1] == 2) {
                            $expresssion_first[1] = '';
                        }
                        if ($expression_second[0] == 1) {
                            $expression_second[0] = '';
                        }
                        if ($expression_second[1] == 2) {
                            $expression_second[1] = '';
                        }

                        if (count($simplification_first) > 3 && count($simplification_second) > 3) {
                            $sline .= ' =';
                            if ($simplification_first[2][0] != 1 && $simplification_second[2][0] != 1) {
                                $this->addHtml($sline);
                            }
                            if ($simplification_first[3][1] == 2) {
                                $numberwrite = '';
                            } else {
                                $numberwrite = $simplification_first[3][1];
                            }
                            if ($a * $simplification_first[3][0] == 1) {
                                $num1Write = '';
                            } else {
                                $num1Write = $a * $simplification_first[3][0];
                            }
                            if ($simplification_second[3][1] == 2) {
                                $mWrite = '';
                            } else {
                                $mWrite = $simplification_second[3][1];
                            }
                            if ($a * $simplification_second[3][0] == 1) {
                                $cWrite = '';
                            } else {
                                $cWrite = $c * $simplification_second[3][0];
                            }

                            $expresssion_first[2] = pow($expresssion_first[2], 1 / ($expresssion_first[1] / $simplification_first[3][1]));
                            $expresssion_first[1] = $simplification_first[3][1];
                            $expression_second[2] = pow($expression_second[2], 1 / ($expression_second[1] / $simplification_second[3][1]));
                            $expression_second[1] = $simplification_second[3][1];

                            $tline .= '= ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $simplification_first[3][2] . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $simplification_second[3][2];
                            $this->addHtml($tline);
                        } elseif (count($simplification_first) > 3 && count($simplification_second) <= 3) {
                            if ($simplification_first[2][0] != 1 && $simplification_second[2][0] != 1) {
                                $this->addHtml($sline);
                            }
                            if ($simplification_first[3][1] == 2) {
                                $numberwrite = '';
                            } else {
                                $numberwrite = $simplification_first[3][1];
                            }
                            if ($a * $simplification_first[3][0] == 1) {
                                $num1Write = '';
                            } else {
                                $num1Write = $a * $simplification_first[3][0];
                            }

                            $expresssion_first[2] = pow($expresssion_first[2], 1 / ($expresssion_first[1] / $simplification_first[3][1]));
                            $expresssion_first[1] = $simplification_first[3][1];

                            $tline .= '= ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $simplification_first[3][2] . $operation . $expression_second[0] . '<sup>' . $expression_second[1] . '</sup>√' . $expression_second[2];
                            $this->addHtml($tline);
                        } elseif (count($simplification_first) <= 3 && count($simplification_second) > 3) {
                            if ($simplification_first[2][0] != 1 && $simplification_second[2][0] != 1) {
                                $this->addHtml($sline);
                            }
                            if ($simplification_second[3][1] == 2) {
                                $mWrite = '';
                            } else {
                                $mWrite = $simplification_second[3][1];
                            }
                            if ($a * $simplification_second[3][0] == 1) {
                                $cWrite = '';
                            } else {
                                $cWrite = $c * $simplification_second[3][0];
                            }

                            $expression_second[2] = pow($expression_second[2], 1 / ($expression_second[1] / $simplification_second[3][1]));
                            $expression_second[1] = $simplification_second[3][1];

                            $tline .= '= ' . $expresssion_first[0] . '<sup>' . $expresssion_first[1] . '</sup>√' . $expresssion_first[2] . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $simplification_second[3][2];
                            $this->addHtml($tline);
                        } else {
                            $this->addHtml($sline);
                        }
                    } elseif (count($simplification_first) > 2 && count($simplification_second) <= 2) {
                        if ($c == 1) {
                            $cWrite = '';
                        }
                        $fline .= $num1Write . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[1] . ')' . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ' =';
                        $this->addHtml($fline);
                        $sline .= '= ' . $num1Write . $simplification_first[2][0] . ' * ' . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[2][1] . ')' . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d;

                        $expresssion_first[0] = $a * $simplification_first[2][0];
                        $expresssion_first[2] = $b / pow($simplification_first[2][0], $n);

                        if (count($simplification_first) > 3) {
                            $sline .= ' =';
                            $expresssion_first[2] = pow($expresssion_first[2], 1 / ($expresssion_first[1] / $simplification_first[3][1]));
                            $expresssion_first[1] = $simplification_first[3][1];

                            if ($simplification_first[2][0] != 1) {
                                $this->addHtml($sline);
                            }
                            if ($simplification_first[3][1] == 2) {
                                $numberwrite = '';
                            } else {
                                $numberwrite = $simplification_first[3][1];
                            }
                            if ($a * $simplification_first[3][0] == 1) {
                                $num1Write = '';
                            } else {
                                $num1Write = $a * $simplification_first[3][0];
                            }
                            $tline .= '= ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $simplification_first[3][2] . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d;
                            $this->addHtml($tline);
                        } else {
                            $this->addHtml($sline);
                        }
                    } elseif (count($simplification_first) <= 2 && count($simplification_second) > 2) {
                        if ($a == 1) {
                            $num1Write = '';
                        }
                        $fline .= $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√(' . $simplification_second[1] . ') =';
                        $this->addHtml($fline);
                        $sline .= '= ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . $operation . $cWrite . $simplification_second[2][0] . ' * ' . '<sup>' . $mWrite . '</sup>√(' . $simplification_second[2][1] . ')';

                        $expression_second[0] = $c * $simplification_second[2][0];
                        $expression_second[2] = $d / pow($simplification_second[2][0], $m);

                        if (count($simplification_second) > 3) {
                            $sline .= ' =';
                            $expression_second[2] = pow($expression_second[2], 1 / ($expression_second[1] / $simplification_second[3][1]));
                            $expression_second[1] = $simplification_second[3][1];

                            if ($simplification_second[2][0] != 1) {
                                $this->addHtml($sline);
                            }
                            if ($simplification_second[3][1] == 2) {
                                $mWrite = '';
                            } else {
                                $mWrite = $simplification_second[3][1];
                            }
                            if ($a * $simplification_second[3][0] == 1) {
                                $cWrite = '';
                            } else {
                                $cWrite = $c * $simplification_second[3][0];
                            }
                            $tline .= '= ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $simplification_second[3][2];
                            $this->addHtml($tline);
                        } else {
                            $this->addHtml($sline);
                        }
                    } elseif ($b == $d && $n == $m) {
                        $this->addHtml($num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ' = ' . ($a + $c) . '<sup>' . $numberwrite . '</sup>√' . $b);
                        return;
                    } else {
                        $this->addHtml($num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . $operation . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d);
                        $this->addHtml($this->lang[8] . '.');
                    }

                    if (count($simplification_first) > 2 || count($simplification_second) > 2) {
                        $number_in_front = $expresssion_first[0] + $expression_second[0];

                        if ($expresssion_first[0] == 1) {
                            $expresssion_first[0] = '';
                        } else {
                            $expresssion_first[0] .= ' * ';
                        }
                        if ($expresssion_first[1] == 2) {
                            $expresssion_first[1] = '';
                        }
                        if ($expression_second[0] == 1) {
                            $expression_second[0] = '';
                        } else {
                            $expression_second[0] .= ' * ';
                        }
                        if ($expression_second[1] == 2) {
                            $expression_second[1] = '';
                        }

                        $lline .= '= ' . $expresssion_first[0] . '<sup>' . $expresssion_first[1] . '</sup>√' . $expresssion_first[2] . $operation . $expression_second[0] . '<sup>' . $expression_second[1] . '</sup>√' . $expression_second[2];
                        if ($lline != $sline && $lline != $tline) {
                            $this->addHtml($lline);
                        }
                    }

                    if ($expresssion_first[1] == $expression_second[1] && $expresssion_first[2] == $expression_second[2]) {
                        $this->addHtml('= ' . $number_in_front . '<sup>' . $expresssion_first[1] . '</sup>√' . $expresssion_first[2]);
                    }
                }
            }

            else if ($option == 3) {
                $pow_b = pow($b, 1 / $n);
                $pow_d = pow($d, 1 / $m);
                if ($this->isInteger($pow_b) && $this->isInteger($pow_d)) {
                    $this->addHtml($num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ' * ' . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ' = ' . $num1Write . $pow_b . ' * ' . $cWrite . $pow_d . ' = ' . ($a * $pow_b * $c * $pow_d));
                    return;
                } elseif ($this->isInteger($pow_b)) {
                    $this->addHtml($num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ' * ' . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ' = ' . $num1Write . $pow_b . ' * ' . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ' =');
                    $a = $a * $pow_b * $c;
                    $num1Write = $a . ' * ';
                    if ($a == 1) {
                        $num1Write = '';
                    }
                    $b = $d;
                    $n = $m;
                    $numberwrite = $mWrite;
                } elseif ($this->isInteger($pow_d)) {
                    $this->addHtml($num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ' * ' . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ' = ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ' * ' . $cWrite . $pow_d . ' =');
                    $a = $a * $c * $pow_d;
                    $num1Write = $a . ' * ';
                    if ($a == 1) {
                        $num1Write = '';
                    }
                } else {
                    $newRoot = $this->simply_lcm($n, $m);
                    if ($newRoot == 2) {
                        $newRoot = '';
                    }
                    $number_in_front = $a * $c;
                    if ($number_in_front == 1) {
                        $number_in_front = '';
                    } else {
                        $number_in_front .= ' * ';
                    }
                    $pow_b_term = pow($b, $this->simply_lcm($n, $m) / $n);
                    $pow_d_term = pow($d, $this->simply_lcm($n, $m) / $m);
                    $this->addHtml($num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ' * ' . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ' = ' . $number_in_front . '<sup>' . $newRoot . '</sup>√(' . $pow_b_term . ' * ' . $pow_d_term . ') = ');

                    $b = $pow_b_term * $pow_d_term;
                    if (is_infinite($b) || is_nan($b)) {
                        return;
                    }
                    $a = $a * $c;
                    $num1Write = $a . ' * ';
                    $n = $this->simply_lcm($n, $m);
                    $numberwrite = $n;
                    $expresssion_first = [$a, $n, $b];
                    if ($a == 1) {
                        $num1Write = '';
                    }
                    if ($n == 2) {
                        $numberwrite = '';
                    }
                }
                $fline .= '= ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b;

                $simplification_first = $this->getSimplification($b, $n);

                if ($this->isInteger(round(pow($b, 1 / $n), 5))) {
                    $fline .= ' = ' . round(pow($b, 1 / $n), 5);
                    $this->addHtml($fline);
                    return;
                } elseif (count($simplification_first) > 2) {
                    $fline .= ' = ' . $num1Write . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[1] . ') =';
                    $this->addHtml($fline);

                    $sline .= '= ' . $num1Write . $simplification_first[2][0] . ' * ' . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[2][1] . ')';
                    $expresssion_first[0] = $a * $simplification_first[2][0];
                    $expresssion_first[2] = $b / pow($simplification_first[2][0], $n);

                    if (count($simplification_first) > 3) {
                        $sline .= ' =';
                        if ($simplification_first[2][0] != 1) {
                            $this->addHtml($sline);
                        }

                        if ($simplification_first[3][1] == 2) {
                            $numberwrite = '';
                        } else {
                            $numberwrite = $simplification_first[3][1];
                        }
                        if ($a * $simplification_first[3][0] == 1) {
                            $num1Write = '';
                        } else {
                            $num1Write = $a * $simplification_first[3][0];
                        }
                        $tline .= '= ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $simplification_first[3][2];
                        $this->addHtml($tline);
                        $expresssion_first[2] = pow($expresssion_first[2], 1 / ($expresssion_first[1] / $simplification_first[3][1]));
                        $expresssion_first[1] = $simplification_first[3][1];
                    } else {
                        $this->addHtml($sline);
                    }

                    if ($expresssion_first[0] == 1) {
                        $expresssion_first[0] = '';
                    } else {
                        $expresssion_first[0] .= ' * ';
                    }
                    if ($expresssion_first[1] == 2) {
                        $expresssion_first[1] = '';
                    }

                    $lline .= '= ' . $expresssion_first[0] . '<sup>' . $expresssion_first[1] . '</sup>√' . $expresssion_first[2];
                    if ($lline != $sline && $lline != $tline) {
                        $this->addHtml($lline);
                    }
                } else {
                    $this->addHtml($fline);
                }
            }

            else if ($option == 4) {
                $pow_b = pow($b, 1 / $n);
                $pow_d = pow($d, 1 / $m);
                if ($n == $m && $b == $d) {
                    $this->addHtml('(' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ') / (' . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ') = ' . ($a / $c));
                    return;
                } elseif ($this->isInteger($pow_b) && $this->isInteger($pow_d)) {
                    $this->addHtml('(' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ') / (' . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ' = (' . $num1Write . $pow_b . ') / (' . $cWrite . $pow_d . ') = ' . (round(($a * $pow_b) / ($c * $pow_d), 3)));
                    return;
                } elseif ($this->isInteger($pow_b)) {
                    $this->addHtml('(' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ') / (' . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ') = (' . $num1Write . $pow_b . ') * (' . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ') =');
                    $a = round($a * $pow_b / ($c * $d), 5);
                    $num1Write = $a . ' * ';
                    if ($a == 1) {
                        $num1Write = '';
                    }
                    $b = pow($d, $m - 1);
                    $n = $m;
                    $numberwrite = $mWrite;
                } elseif ($this->isInteger($pow_d)) {
                    $this->addHtml('(' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ') / (' . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ') = (' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ') / (' . $cWrite . $pow_d . ') =');
                    $a = round($a / ($c * $pow_d), 5);
                    $num1Write = $a . ' * ';
                    if ($a == 1) {
                        $num1Write = '';
                    }
                } else {
                    $newRoot = $this->simply_lcm($n, $m);
                    if ($newRoot == 2) {
                        $newRoot = '';
                    }
                    $number_in_front = round($a / ($c * $d), 5);
                    if ($number_in_front == 1) {
                        $number_in_front = '';
                    } else {
                        $number_in_front .= ' * ';
                    }
                    $pow_b_term = pow($b, $this->simply_lcm($n, $m) / $n);
                    $pow_d_term = pow($d, $this->simply_lcm($n, $m) / $m);
                    
                    $pow_d_display = $pow_d_term;
                    if (!is_infinite($pow_d_term)) {
                        $pow_d_display .= '<sup>' . ($m - 1) . '</sup>';
                    } else {
                        $pow_d_display = 'INF';
                    }
                    
                    $this->addHtml('(' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b . ') / (' . $cWrite . '<sup>' . $mWrite . '</sup>√' . $d . ') = ' . $number_in_front . '<sup>' . $newRoot . '</sup>√(' . $pow_b_term . ' * ' . $pow_d_display . ') = ');

                    $b = round($pow_b_term * pow($pow_d_term, $m - 1), 5);
                    if (is_infinite($b) || is_nan($b)) {
                        return;
                    }
                    $a = round($a / ($c * $d), 5);
                    $num1Write = $a . ' * ';
                    $n = $this->simply_lcm($n, $m);
                    $numberwrite = $n;
                    $expresssion_first = [$a, $n, $b];
                    if ($a == 1) {
                        $num1Write = '';
                    }
                    if ($n == 2) {
                        $numberwrite = '';
                    }
                }
                $fline .= '= ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $b;

                $simplification_first = $this->getSimplification($b, $n);

                if (count($simplification_first) > 2) {
                    $fline .= ' = ' . $num1Write . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[1] . ') =';
                    $this->addHtml($fline);
                    $sline .= '= ' . $num1Write . $simplification_first[2][0] . ' * ' . '<sup>' . $numberwrite . '</sup>√(' . $simplification_first[2][1] . ')';
                    $expresssion_first[0] = round($a * $simplification_first[2][0], 5);
                    $expresssion_first[2] = $b / pow($simplification_first[2][0], $n);

                    if (count($simplification_first) > 3) {
                        $sline .= ' =';
                        if ($simplification_first[2][0] != 1) {
                            $this->addHtml($sline);
                        }

                        if ($simplification_first[3][1] == 2) {
                            $numberwrite = '';
                        } else {
                            $numberwrite = $simplification_first[3][1];
                        }
                        if ($a * $simplification_first[3][0] == 1) {
                            $num1Write = '';
                        } else {
                            $num1Write = round($a * $simplification_first[3][0], 5);
                        }
                        $tline .= '= ' . $num1Write . '<sup>' . $numberwrite . '</sup>√' . $simplification_first[3][2];
                        $this->addHtml($tline);
                        $expresssion_first[2] = round(pow($expresssion_first[2], 1 / ($expresssion_first[1] / $simplification_first[3][1])), 5);
                        $expresssion_first[1] = $simplification_first[3][1];
                    } else {
                        $this->addHtml($sline);
                    }

                    if ($expresssion_first[0] == 1) {
                        $expresssion_first[0] = '';
                    } else {
                        $expresssion_first[0] .= ' * ';
                    }
                    if ($expresssion_first[1] == 2) {
                        $expresssion_first[1] = '';
                    }

                    $lline .= '= ' . $expresssion_first[0] . '<sup>' . $expresssion_first[1] . '</sup>√' . $expresssion_first[2];
                    if ($lline != $sline && $lline != $tline) {
                        $this->addHtml($lline);
                    }
                } else {
                    $this->addHtml($fline);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.calculators.simplify-radicals-calculator');
    }
}
