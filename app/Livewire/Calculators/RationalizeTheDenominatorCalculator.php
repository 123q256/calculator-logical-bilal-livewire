<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class RationalizeTheDenominatorCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $activeType = 'first';
    public $operations = 1;
    public $a = 15;
    public $b = 13;
    public $n = 11;
    public $c = 7;
    public $d = 5;
    public $m = 4;
    public $x = 7;
    public $y = 13;
    public $k = 5;
    public $u = 5;
    public $n1 = 'x^3-2x+1';
    public $d1 = 'x^2-1';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = $this->sanitizeForLivewire(session('calculator_result'));
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->activeType = $inputs['activeType'] ?? 'first';
            $this->operations = $inputs['operations'] ?? 1;
            $this->a = $inputs['a'] ?? 15;
            $this->b = $inputs['b'] ?? 13;
            $this->n = $inputs['n'] ?? 11;
            $this->c = $inputs['c'] ?? 7;
            $this->d = $inputs['d'] ?? 5;
            $this->m = $inputs['m'] ?? 4;
            $this->x = $inputs['x'] ?? 7;
            $this->y = $inputs['y'] ?? 13;
            $this->k = $inputs['k'] ?? 5;
            $this->u = $inputs['u'] ?? 5;
            $this->n1 = $inputs['n1'] ?? 'x^3-2x+1';
            $this->d1 = $inputs['d1'] ?? 'x^2-1';
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->activeType = 'first';
        $this->operations = 1;
        $this->a = 15;
        $this->b = 13;
        $this->n = 11;
        $this->c = 7;
        $this->d = 5;
        $this->m = 4;
        $this->x = 7;
        $this->y = 13;
        $this->k = 5;
        $this->u = 5;
        $this->n1 = 'x^3-2x+1';
        $this->d1 = 'x^2-1';

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
    }

    private function isInteger($n)
    {
        return is_numeric($n) && (floor($n) == $n);
    }

    private function primeFactorization($num, $result = [])
    {
        if ($num <= 1) {
            return $result;
        }
        $root = sqrt($num);
        $x = 2;
        if (fmod($num, $x) != 0) {
            $x = 3;
            while ((fmod($num, $x) != 0) && ($x + 2 <= $root)) {
                $x += 2;
            }
        }
        $x = ($x <= $root) ? $x : $num;
        $result[] = $x;
        return ($x == $num) ? $result : $this->primeFactorization($num / $x, $result);
    }

    private function toPower($primeFactors)
    {
        $array = [];
        $power = 1;
        $isShorter = false;
        $exponents = [];
        $uniquePrimes = [];
        $count = count($primeFactors);
        for ($i = 0; $i < $count; $i++) {
            if ($i != $count - 1 && $primeFactors[$i] == $primeFactors[$i + 1]) {
                $power++;
            } else {
                if ($power != 1) {
                    $array[] = $primeFactors[$i] . '<sup class="font-s-14">' . $power . '</sup>';
                    $isShorter = true;
                } else {
                    $array[] = $primeFactors[$i];
                }
                $uniquePrimes[] = $primeFactors[$i];
                $exponents[] = $power;
                $power = 1;
            }
        }
        return [$array, $isShorter, $exponents, $uniquePrimes];
    }

    private function roundPrice($rnum, $rlength)
    {
        if (!is_numeric($rnum)) {
            return $rnum;
        }
        $rnum = (float)$rnum;
        $str = (string)$rnum;
        if (strpos($str, '.') === false) {
            return $rnum;
        }
        $factor = pow(10, $rlength - 1);
        $newnumber = ceil($rnum * $factor) / $factor;
        return (float)number_format($newnumber, $rlength, '.', '');
    }

    private function getSimplification($x, $root)
    {
        $simplification = [];
        $primeFactors = $this->primeFactorization($x);
        $index = 1;

        if (count($primeFactors) === 1) {
            $simplification[] = 'prime';
        } else {
            $simplification[] = implode(' * ', $primeFactors);
            $to_power = $this->toPower($primeFactors);
            $index += 1;

            if ($to_power[1]) {
                $simplification[] = implode(' * ', $to_power[0]);

                $valuesPulled = [];
                for ($i = 0; $i < count($to_power[2]); $i++) {
                    $prime = $to_power[3][$i];
                    $pulledCount = (int)floor($to_power[2][$i] / $root);
                    for ($j = 0; $j < $pulledCount; $j++) {
                        $valuesPulled[] = $prime;
                    }
                }

                $numberInFront = 1;
                foreach ($valuesPulled as $val) {
                    $numberInFront *= $val;
                }
                $numberUnder = $this->roundPrice($x / pow($numberInFront, $root), 4);

                $factorizationRoot = $this->primeFactorization($root);
                $factorizationUnder = $this->primeFactorization($numberUnder);
                $to_powerUnderAfter = $this->toPower($factorizationUnder);

                $divideRootBy = 1;
                $simplifyRoot = [];
                foreach ($factorizationRoot as $fRoot) {
                    foreach ($to_powerUnderAfter[2] as $expVal) {
                        if (fmod($expVal, $fRoot) == 0) {
                            $simplifyRoot[] = 1;
                        } else {
                            $simplifyRoot[] = 0;
                        }
                    }
                    if (!in_array(0, $simplifyRoot, true) && count($simplifyRoot) > 0) {
                        $divideRootBy *= $fRoot;
                        foreach ($to_powerUnderAfter[2] as &$expVal) {
                            $expVal /= $fRoot;
                        }
                        unset($expVal);
                    }
                    $simplifyRoot = [];
                }

                $newRoot = $this->roundPrice($root / $divideRootBy, 4);
                $newUnder = $this->roundPrice(pow($numberUnder, 1 / $divideRootBy), 4);

                if ($numberInFront != 1 || $newRoot != $root) {
                    $index += 1;
                    $simplification[] = [
                        $numberInFront,
                        implode(' * ', $to_powerUnderAfter[0])
                    ];
                    if ($newRoot != $root) {
                        $index += 1;
                        $simplification[] = [
                            $numberInFront,
                            $newRoot,
                            $newUnder
                        ];
                    }
                }
            }
        }
        return [$simplification, $index];
    }

    private function find_gcf($a, $b)
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

    private function find_lcm($a, $b)
    {
        $gcf = $this->find_gcf($a, $b);
        if ($gcf == 0) return 0;
        return abs(($a * $b) / $gcf);
    }

    private function getSimplified($x, $root)
    {
        $a = $x;
        $n = $root;
        $simplificationAll = $this->getSimplification($a, $n);
        $simplification = $simplificationAll[0];

        if ($simplificationAll[1] > 3) {
            return $simplification[3];
        } else if ($simplificationAll[1] > 2) {
            $val1 = $simplification[2][0];
            $under = $this->roundPrice($x / pow($val1, $root), 4);
            return [$val1, $root, $under];
        } else {
            return [1, $root, $x];
        }
    }

    private function calculateSteps($expression, $a, $b, $c, $d, $n, $m, $x, $y, $k, $u, $z = 0)
    {
        $newRoot = $n;
        $newRoot1st = $n;
        $newRoot2nd = $m;
        $newRootWrite = '';
        $newRootWrite1st = '';
        $newRootWrite2nd = '';
        $nWrite = $n;
        $kWrite = $k;
        $mWrite = $m;
        
        $aWrite = '';
        $aWrite2nd = '';
        $xWrite = '';
        $bWrite = '';
        $cWrite = '';
        $dWrite = '';
        $yWrite = '';
        $uWrite = '';
        $zWrite = '';
        $fWrite = '';
        $hWrite = '';

        $firstLine = '';
        $secondLine = '';
        $thirdLine = '';
        $lastLine = '';
        
        $resultWritten1st = '<table class="font-s-16"><tr class="bn">';
        $resultWritten2nd = '<table class="font-s-16"><tr class="bn">';
        $resultWritten3rd = '<table class="font-s-16"><tr class="bn">';
        $resultWritten4th = '';
        $signUp = ' + ';
        $signUp2nd = '';
        $signUp3rd = '';
        $signDown = ' + ';
        $signDownInverse = ' - ';
        $showLastLine = true;
        $oneSummand = false;
        $sthChanged = false;
        $a2nd = 0;
        $e = 0;
        $f = 0;
        $g = 0;
        $h = 0;
        $eWrite = '';
        $gWrite = '';
        $kill3rd = false;
        $kill4th = false;

        $all_result_html = '';
        $main_jawab_html = '';

        $addHtml = function($argument) use (&$all_result_html) {
            $all_result_html .= $argument;
        };

        $jawab = function($argument) use (&$main_jawab_html) {
            $main_jawab_html .= $argument;
        };

        if ($expression > 2) {
            $n = 2;
            $m = 2;
            $k = 2;
        }

        if ($n == 2) {
            $nWrite = '';
        }
        if ($m == 2) {
            $mWrite = '';
        }
        if ($k == 2) {
            $kWrite = '';
        }

        if (is_nan((float)$a) || $a == 1) {
            $a = 1;
            $aWrite = '';
        } else if ($b == 1) {
            $aWrite = $a;
        } else if ($a == -1) {
            $aWrite = '-';
        } else {
            $aWrite = $a . ' * ';
        }
        if (is_nan((float)$x) || $x == 1) {
            $x = 1;
            $xWrite = '';
        } else if ($y == 1) {
            $xWrite = $x;
        } else if ($x == -1) {
            $xWrite = '-';
        } else {
            $xWrite = $x . ' * ';
        }
        if (is_nan((float)$c) || $c == 1) {
            $c = 1;
            $cWrite = '';
        } else if ($d == 1) {
            $cWrite = $c;
        } else if ($c == -1) {
            $cWrite = '-';
        } else {
            $cWrite = $c . ' * ';
        }
        if (is_nan((float)$z) || $z == 1) {
            $z = 1;
            $zWrite = '';
        } else if ($u == 1) {
            $zWrite = $z;
        } else if ($z == -1) {
            $zWrite = '-';
        } else {
            $zWrite = $z . ' * ';
        }

        if ($b == 1) {
            $bWrite = '';
        } else {
            $bWrite = '<sup class="font-s-14">' . $nWrite . '</sup>√' . $b;
        }
        if ($d == 1) {
            $dWrite = '';
        } else {
            $dWrite = '<sup class="font-s-14">' . $mWrite . '</sup>√' . $d;
        }
        if ($y == 1) {
            $yWrite = '';
        } else {
            $yWrite = '<sup class="font-s-14">' . $kWrite . '</sup>√' . $y;
        }
        if ($u == 1) {
            $uWrite = '';
        } else {
            $uWrite = '√' . $u;
        }

        if ($a == 1 && $b == 1) {
            $bWrite = 1;
        }
        if ($c == 1 && $d == 1) {
            $dWrite = 1;
        }
        if ($x == 1 && $y == 1) {
            $yWrite = 1;
        }
        if ($z == 1 && $u == 1) {
            $uWrite = 1;
        }

        if ($c < 0) {
            $signUp = ' ';
        }
        if ($z < 0) {
            $signDown = ' ';
            $signDownInverse = ' + ';
        }

        if ($k == 2) {
            $reducedMultiplier = $yWrite;
        } else {
            $reducedMultiplier = '<sup class="font-s-14">' . $k . '</sup>√(' . $y . '<sup class="font-s-14">' . ($k - 1) . '</sup>)';
        }

        ////////////////////////////////////////////////
        /////////////////EXPRESSION 1///////////////////
        ////////////////////////////////////////////////
        if ($expression == 1) {
            if (!is_nan((float)$b) && !is_nan((float)$n) && !is_nan((float)$y) && !is_nan((float)$k)) {
                $resultWritten1st .= '<td rowspan="3" class="py-2">=</td>';
                $resultWritten1st .= '<td rowspan="3" class="bn py-2"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                    '<br><hr noshade>' . $xWrite . $yWrite . '</th></table></td>';
                $resultWritten1st .= '</tr></table>';
                $addHtml($resultWritten1st);
                $resultWritten2nd .= '<td  rowspan="3" class="py-2">=</td>';

                //////////No need for rationalization/////////
                if ($this->isInteger($this->roundPrice(pow($y, 1 / $k), 4))) {
                    if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                        $bWrite = $this->roundPrice(pow($b, 1 / $n), 4);
                        if ($a == 1 && $b == 1) {
                            $bWrite = 1;
                        } else if ($b == 1) {
                            $bWrite = '';
                        }
                        $yWrite = $this->roundPrice(pow($y, 1 / $k), 4);
                        if ($x == 1 && $y == 1) {
                            $yWrite = 1;
                        } else if ($y == 1) {
                            $yWrite = '';
                        }
                        $resultWritten2nd .= '<td  rowspan="3" class="py-2"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                            '<br><hr noshade>' . $xWrite . $yWrite;
                        $resultWritten2nd .= '<td class="py-2"  rowspan="3">=</td>';
                        $resultWritten2nd .= '</th></table></td>';

                        $resultWritten3rd = $this->roundPrice(($a * pow($b, 1 / $n)) / ($x * pow($y, 1 / $k)), 4);
                        $b = 1;
                    } else {
                        $yWrite = $this->roundPrice(pow($y, 1 / $k), 4);
                        if ($x == 1 && $y == 1) {
                            $yWrite = 1;
                        } else if ($y == 1) {
                            $yWrite = '';
                        }
                        $resultWritten2nd .= '<td  rowspan="3" class="py-2"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                            '<br><hr noshade>' . $xWrite . $yWrite;
                        $resultWritten2nd .= '</th></table></td>';

                        $a = $this->roundPrice($a / ($x * pow($y, 1 / $k)), 4);
                        if ($a == 1) {
                            $aWrite = '';
                        } else {
                            $aWrite = $a . ' * ';
                        }
                        $resultWritten3rd = $aWrite . $bWrite;
                    }
                    $resultWritten2nd .= '</tr></table>';
                    $addHtml($resultWritten2nd);
                    $jawab($resultWritten3rd);
                }
                ////////////////Rationalization///////////////
                else {
                    if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                        $bWrite = $this->roundPrice(pow($b, 1 / $n), 4);
                        if ($a == 1 && $b == 1) {
                            $bWrite = 1;
                        } else if ($b == 1) {
                            $bWrite = '';
                        }
                        $a *= $this->roundPrice(pow($b, 1 / $n), 4);
                        $b = 1;
                    }
                    $resultWritten2nd .= '<td class="py-2" rowspan="3" class="bn py-2"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                        '<br><hr noshade>' . $xWrite . $yWrite . '</th></table></td>';
                    $resultWritten2nd .= '<td  rowspan="3" class="py-2">*</td>';
                    $resultWritten2nd .= '<td  rowspan="3" class="py-2"><table><th class="py-2" rowspan="3">' . $reducedMultiplier .
                        '<br><hr noshade>' . $reducedMultiplier . '</th></table></td>';

                    $newRoot = $this->find_lcm($n, $k);
                    if ($newRoot == 2) {
                        $newRootWrite = '';
                    } else {
                        $newRootWrite = $newRoot;
                    }
                    if ($b != 1 && $this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                        $bWrite = '<sup class="font-s-14">' . $newRootWrite . '</sup>√(' . pow($b, $newRoot / $n);
                        $bWrite .= ' * ';
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                        $bWrite .= ' * <sup class="font-s-14">' . $newRootWrite . '</sup>√(';
                    } else {
                        $bWrite = '<sup class="font-s-14">' . $newRootWrite . '</sup>√(' . $bWrite;
                    }

                    $resultWritten3rd .= '<td  rowspan="3" class="py-2">=</td>';
                    $resultWritten3rd .= '<td  rowspan="3" class="py-2"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . pow($y, (($k - 1) * $newRoot) / $k) . ')<br><hr noshade>' . $xWrite . $y . '</th></table></td>';

                    $a = $this->roundPrice($a / ($x * $y), 4);
                    $b = $this->roundPrice(pow($b, $newRoot / $n) * pow($y, $newRoot / $k), 4);
                    $n = $newRoot;
                    if ($a == 1) {
                        $aWrite = '';
                    } else if ($a == -1) {
                        $aWrite = '-';
                    } else {
                        $aWrite = $a . ' * ';
                    }
                    $resultWritten4th .= $aWrite . '<sup class="font-s-14">' . $newRootWrite . '</sup>√' . $b;
                    $finalResult = $this->getSimplified($b, $n);
                    if ($finalResult[1] == $n && $finalResult[2] == $b) {
                        $showLastLine = false;
                    }
                    $finalResult[0] = $this->roundPrice($finalResult[0] * $a, 4);
                    if ($finalResult[0] == 1 && $finalResult[2] != 1) {
                        $finalResult[0] = '';
                    } else if ($finalResult[0] == -1 && $finalResult[2] != 1) {
                        $finalResult[0] = '-';
                    } else if ($finalResult[2] != 1) {
                        $finalResult[0] .= ' * ';
                    }
                    if ($finalResult[1] == 2) {
                        $finalResult[1] = '';
                    }
                    if ($finalResult[2] == 1) {
                        $finalResult[2] = '';
                    } else {
                        $finalResult[2] = '<sup class="font-s-14">' . $finalResult[1] . '</sup>√' . $finalResult[2];
                    }
                    if ($showLastLine) {
                        $resultWritten4th .= $finalResult[0] . $finalResult[2];
                    }
                    $resultWritten2nd .= '</tr></table>';
                    $addHtml($resultWritten2nd);

                    $resultWritten3rd .= '</tr></table>';
                    $addHtml($resultWritten3rd);

                    $jawab($resultWritten4th);
                }
            }
        }

        ////////////////////////////////////////////////
        /////////////////EXPRESSION 2///////////////////
        ////////////////////////////////////////////////
        elseif ($expression == 2) {
            if (!is_nan((float)$b) && !is_nan((float)$n) && !is_nan((float)$d) && !is_nan((float)$m) && !is_nan((float)$y) && !is_nan((float)$k)) {
                $resultWritten1st .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp . $cWrite .
                    $dWrite . '<br><hr noshade>' . $xWrite . $yWrite . '</th></table></td>';
                $resultWritten1st .= '</tr></table>';
                $addHtml($resultWritten1st);
                $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';

                //////////No need for rationalization/////////
                if ($this->isInteger($this->roundPrice(pow($y, 1 / $k), 4))) {
                    if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4)) && $this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                        $bWrite = $this->roundPrice(pow($b, 1 / $n), 4);
                        if ($a == 1 && $b == 1) {
                            $bWrite = 1;
                        } else if ($b == 1) {
                            $bWrite = '';
                        }
                        $dWrite = $this->roundPrice(pow($d, 1 / $m), 4);
                        if ($c == 1 && $d == 1) {
                            $dWrite = 1;
                        } else if ($d == 1) {
                            $dWrite = '';
                        }
                        $yWrite = $this->roundPrice(pow($y, 1 / $k), 4);
                        if ($x == 1 && $y == 1) {
                            $yWrite = 1;
                        } else if ($y == 1) {
                            $yWrite = '';
                        }
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                            $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite;
                        $resultWritten2nd .= '</th></table></td>';

                        $resultWritten3rd = $this->roundPrice(($a * pow($b, 1 / $n) + $c * pow($d, 1 / $m)) / ($x * pow($y, 1 / $k)), 4);

                        $addHtml($resultWritten2nd);
                        $resultWritten2nd .= '</tr></table>';
                        $addHtml($resultWritten2nd);
                        $jawab($resultWritten3rd);
                        return [
                            'all_result' => $all_result_html,
                            'main_jawab' => $main_jawab_html
                        ];
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                        $bWrite = $this->roundPrice(pow($b, 1 / $n), 4);
                        if ($a == 1 && $b == 1) {
                            $bWrite = 1;
                        } else if ($b == 1) {
                            $bWrite = '';
                        }
                        $yWrite = $this->roundPrice(pow($y, 1 / $k), 4);
                        if ($x == 1 && $y == 1) {
                            $yWrite = 1;
                        } else if ($y == 1) {
                            $yWrite = '';
                        }
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                            $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite;
                        $resultWritten2nd .= '</th></table></td>';

                        $resultWritten3rd = $this->roundPrice(($a * pow($b, 1 / $n)) / ($x * pow($y, 1 / $k)), 4);
                        $c /= $this->roundPrice($x * pow($y, 1 / $k), 4);
                        $b = 1;
                        if ($c < 0) {
                            $signUp = ' ';
                        } else {
                            $signUp = ' + ';
                        }
                        if ($c == 1) {
                            $cWrite = '';
                        } else if ($c == -1) {
                            $cWrite = '-';
                        } else {
                            $cWrite = $this->roundPrice($c, 5) . ' * ';
                        }
                        $resultWritten3rd .= $signUp . $cWrite . $dWrite;
                        $resultWritten2nd .= '</tr></table>';
                        $addHtml($resultWritten2nd);
                        $jawab($resultWritten3rd);
                    } else if ($this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                        $dWrite = $this->roundPrice(pow($d, 1 / $m), 4);
                        if ($c == 1 && $d == 1) {
                            $dWrite = 1;
                        } else if ($d == 1) {
                            $dWrite = '';
                        }
                        $yWrite = $this->roundPrice(pow($y, 1 / $k), 4);
                        if ($x == 1 && $y == 1) {
                            $yWrite = 1;
                        } else if ($y == 1) {
                            $yWrite = '';
                        }
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                            $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite;
                        $resultWritten2nd .= '</th></table></td>';

                        $a = $this->roundPrice($a / ($x * pow($y, 1 / $k)), 4);
                        $c = $this->roundPrice(($c * pow($d, 1 / $m)) / ($x * pow($y, 1 / $k)), 4);
                        $d = 1;
                        if ($c < 0) {
                            $signUp = ' ';
                        } else {
                            $signUp = ' + ';
                        }
                        if ($a == 1) {
                            $aWrite = '';
                        } else if ($a == -1) {
                            $aWrite = '-';
                        } else {
                            $aWrite = $a . ' * ';
                        }
                        $resultWritten3rd = $aWrite . $bWrite . $signUp . $c;
                        $resultWritten2nd .= '</tr></table>';
                        $addHtml($resultWritten2nd);
                        $jawab($resultWritten3rd);
                    } else {
                        $yWrite = $this->roundPrice(pow($y, 1 / $k), 4);
                        if ($x == 1 && $y == 1) {
                            $yWrite = 1;
                        } else if ($y == 1) {
                            $yWrite = '';
                        }
                        if ($n == $m && $b == $d) {
                            $oneSummand = true;
                            $a += $c;
                            if ($a == 1) {
                                $aWrite = '';
                            } else {
                                $aWrite = $a . ' * ';
                            }
                            $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                                '<br><hr noshade>' . $xWrite . $yWrite;
                            $resultWritten2nd .= '</th></table></td>';

                            $a = $this->roundPrice($a / ($x * pow($y, 1 / $k)), 4);
                            if ($a == 1) {
                                $aWrite = '';
                            } else {
                                $aWrite = $a . ' * ';
                            }
                            $resultWritten3rd = $aWrite . $bWrite;
                            $resultWritten2nd .= '</tr></table>';
                            $addHtml($resultWritten2nd);
                            $jawab($resultWritten3rd);
                        } else {
                            $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                                $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite;
                            $resultWritten2nd .= '</th></table></td>';

                            $a = $this->roundPrice($a / ($x * pow($y, 1 / $k)), 4);
                            $c = $this->roundPrice($c / ($x * pow($y, 1 / $k)), 4);
                            if ($a == 1) {
                                $aWrite = '';
                            } else {
                                $aWrite = $a . ' * ';
                            }
                            if ($c == 1) {
                                $cWrite = '';
                            } else {
                                $cWrite = $c . ' * ';
                            }
                            if ($c < 0) {
                                $signUp = ' ';
                            } else {
                                $signUp = ' + ';
                            }
                            $resultWritten3rd = $aWrite . $bWrite . $signUp . $cWrite . $dWrite;
                            $resultWritten2nd .= '</tr></table>';
                            $addHtml($resultWritten2nd);
                            $jawab($resultWritten3rd);
                        }
                    }
                }
                ////////////////Rationalization///////////////
                else {
                    if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4)) && $this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                        $oneSummand = true;
                        $bWrite = $this->roundPrice(pow($b, 1 / $n), 4);
                        if ($a == 1 && $b == 1) {
                            $bWrite = 1;
                        } else if ($b == 1) {
                            $bWrite = '';
                        }
                        $dWrite = $this->roundPrice(pow($d, 1 / $m), 4);
                        if ($c == 1 && $d == 1) {
                            $dWrite = 1;
                        } else if ($d == 1) {
                            $dWrite = '';
                        }
                        $a = $this->roundPrice($a * pow($b, 1 / $n) + $c * pow($d, 1 / $m), 4);
                        $b = 1;
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                        $bWrite = $this->roundPrice(pow($b, 1 / $n), 4);
                        if ($a == 1 && $b == 1) {
                            $bWrite = 1;
                        } else if ($b == 1) {
                            $bWrite = '';
                        }
                        $a = $this->roundPrice($a * pow($b, 1 / $n), 4);
                        $b = 1;
                    } else if ($this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                        $dWrite = $this->roundPrice(pow($d, 1 / $m), 4);
                        if ($c == 1 && $d == 1) {
                            $dWrite = 1;
                        } else if ($d == 1) {
                            $dWrite = '';
                        }
                        $c = $this->roundPrice($c * pow($d, 1 / $m), 4);
                        $d = 1;
                    }
                    $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp . $cWrite .
                        $dWrite . '<br><hr noshade>' . $xWrite . $yWrite . '</th></table></td>';

                    $resultWritten2nd .= '<td class="py-2" rowspan="3">*</td>';
                    $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $reducedMultiplier .
                        '<br><hr noshade>' . $reducedMultiplier . '</th></table></td>';

                    if ($a == 1 && $b != 1) {
                        $aWrite = '';
                    } else if ($a == -1 && $b != -1) {
                        $aWrite = '-';
                    } else if ($b != 1) {
                        $aWrite = $a . ' * ';
                    } else {
                        $aWrite = $a;
                    }
                    if ($c == 1) {
                        $cWrite = '';
                    } else if ($d != 1) {
                        $cWrite = $c . ' * ';
                    } else {
                        $cWrite = $c;
                    }

                    $newRoot1st = $this->find_lcm($n, $k);
                    $newRoot2nd = $this->find_lcm($m, $k);
                    if ($newRoot1st == 2) {
                        $newRootWrite1st = '';
                    } else {
                        $newRootWrite1st = $newRoot1st;
                    }
                    if ($newRoot2nd == 2) {
                        $newRootWrite2nd = '';
                    } else {
                        $newRootWrite2nd = $newRoot2nd;
                    }
                    if ($b != 1 && $this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                        $bWrite = '<sup class="font-s-14">' . $newRootWrite1st . '</sup>√(' . pow($b, $newRoot1st / $n) . ' * ';
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                        $bWrite = ' * <sup class="font-s-14">' . $newRootWrite1st . '</sup>√(';
                    } else {
                        $bWrite = '<sup class="font-s-14">' . $newRootWrite1st . '</sup>√(' . $bWrite;
                    }
                    if ($d != 1 && $this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                        $dWrite = '<sup class="font-s-14">' . $newRootWrite2nd . '</sup>√(' . pow($d, $newRoot2nd / $m) . ' * ';
                    } else if ($this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                        $dWrite = ' * <sup class="font-s-14">' . $newRootWrite2nd . '</sup>√(';
                    } else {
                        $dWrite = '<sup class="font-s-14">' . $newRootWrite2nd . '</sup>√(' . $dWrite;
                    }

                    $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';
                    $resultWritten3rd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . pow($y, $newRoot1st / $k) . ')';
                    if (!$oneSummand) {
                        $resultWritten3rd .= $signUp . $cWrite . $dWrite . pow($y, $newRoot2nd / $k) . ')';
                    }
                    $resultWritten3rd .= '<br><hr noshade>' . $xWrite . $y . '</th></table></td>';

                    $a = $this->roundPrice($a / ($x * $y), 4);
                    $c = $this->roundPrice($c / ($x * $y), 4);
                    $b = $this->roundPrice(pow($b, $newRoot1st / $n) * pow($y, $newRoot1st / $k), 4);
                    $d = $this->roundPrice(pow($d, $newRoot2nd / $m) * pow($y, $newRoot2nd / $k), 4);
                    $n = $newRoot1st;
                    $m = $newRoot2nd;
                    if ($a == 1) {
                        $aWrite = '';
                    } else if ($a == -1) {
                        $aWrite = '-';
                    } else {
                        $aWrite = $a . ' * ';
                    }
                    if ($c == 1) {
                        $cWrite = '';
                    } else if ($c == -1) {
                        $cWrite = '-';
                    } else {
                        $cWrite = $c . ' * ';
                    }
                    if ($c < 0) {
                        $signUp = ' ';
                    } else {
                        $signUp = ' + ';
                    }
                    $resultWritten4th .= $aWrite . '<sup class="font-s-14">' . $newRootWrite1st . '</sup>√' . $b;
                    if (!$oneSummand) {
                        $resultWritten4th .= $signUp . $cWrite . '<sup class="font-s-14">' . $newRootWrite2nd . '</sup>√' . $d;
                    }
                    $finalResult1st = $this->getSimplified($b, $n);
                    $finalResult2nd = $this->getSimplified($d, $m);
                    if ($finalResult1st[1] == $n && $finalResult1st[2] == $b && $finalResult2nd[1] == $m && $finalResult2nd[2] == $d) {
                        $showLastLine = false;
                    }
                    $finalResult1st[0] = $this->roundPrice($finalResult1st[0] * $a, 4);
                    $finalResult2nd[0] = $this->roundPrice($finalResult2nd[0] * $c, 4);
                    if ($finalResult1st[0] == 1 && $finalResult1st[2] != 1) {
                        $finalResult1st[0] = '';
                    } else if ($finalResult1st[0] == -1 && $finalResult1st[2] != 1) {
                        $finalResult1st[0] = '-';
                    } else if ($finalResult1st[2] != 1) {
                        $finalResult1st[0] .= ' * ';
                    }
                    if ($finalResult2nd[0] == 1 && $finalResult2nd[2] != 1) {
                        $finalResult2nd[0] = '';
                    } else if ($finalResult2nd[0] == -1 && $finalResult2nd[2] != 1) {
                        $finalResult2nd[0] = '-';
                    } else if ($finalResult2nd[2] != 1) {
                        $finalResult2nd[0] .= ' * ';
                    }
                    if ($finalResult1st[1] == 2) {
                        $finalResult1st[1] = '';
                    }
                    if ($finalResult2nd[1] == 2) {
                        $finalResult2nd[1] = '';
                    }
                    if ($finalResult1st[2] == 1) {
                        $finalResult1st[2] = '';
                    } else {
                        $finalResult1st[2] = '<sup class="font-s-14">' . $finalResult1st[1] . '</sup>√' . $finalResult1st[2];
                    }
                    if ($finalResult2nd[2] == 1) {
                        $finalResult2nd[2] = '';
                    } else {
                        $finalResult2nd[2] = '<sup class="font-s-14">' . $finalResult2nd[1] . '</sup>√' . $finalResult2nd[2];
                    }
                    if ($showLastLine) {
                        $resultWritten4th .= $finalResult1st[0] . $finalResult1st[2];
                        if (!$oneSummand) {
                            $resultWritten4th .= $signUp . $finalResult2nd[0] . $finalResult2nd[2];
                        }
                    }

                    $resultWritten2nd .= '</tr></table>';
                    $addHtml($resultWritten2nd);

                    $resultWritten3rd .= '</tr></table>';
                    $addHtml($resultWritten3rd);

                    $jawab($resultWritten4th);
                }
            }
        }

        ////////////////////////////////////////////////
        /////////////////EXPRESSION 3///////////////////
        ////////////////////////////////////////////////
        elseif ($expression == 3) {
            if (!is_nan((float)$b) && !is_nan((float)$y) && !is_nan((float)$u)) {
                $resultWritten1st .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . '<br><hr noshade>' .
                    $xWrite . $yWrite . $signDown . $zWrite . $uWrite . '</th></table></td>';
                $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';

                //////////No need for rationalization/////////
                if ($this->isInteger($this->roundPrice(pow($y, 1 / 2), 4)) && $this->isInteger($this->roundPrice(pow($u, 1 / 2), 4))) {
                    $yWrite = $this->roundPrice(pow($y, 1 / 2), 4);
                    if ($x == 1 && $y == 1) {
                        $yWrite = 1;
                    } else if ($y == 1) {
                        $yWrite = '';
                    }
                    $uWrite = $this->roundPrice(pow($u, 1 / 2), 4);
                    if ($z == 1 && $u == 1) {
                        $uWrite = 1;
                    } else if ($u == 1) {
                        $uWrite = '';
                    }
                    if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                        $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten1st .= '</tr></table>';
                        $addHtml($resultWritten1st);
                        $bWrite = $this->roundPrice(pow($b, 1 / 2), 4);
                        if ($a == 1 && $b == 1) {
                            $bWrite = 1;
                        } else if ($b == 1) {
                            $bWrite = '';
                        }
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                            '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite;
                        $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten2nd .= '</th></table></td>';

                        $resultWritten3rd = '= ' . $this->roundPrice(($a * pow($b, 1 / 2)) / ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)), 4);
                        $addHtml($resultWritten2nd);
                        $addHtml($resultWritten3rd);
                        return [
                            'all_result' => $all_result_html,
                            'main_jawab' => $main_jawab_html
                        ];
                    } else {
                        $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten1st .= '</tr></table>';
                        $addHtml($resultWritten1st);
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                            '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite;
                        $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten2nd .= '</th></table></td>';

                        $a = $this->roundPrice($a / ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)), 4);
                        if ($a == 1) {
                            $aWrite = '';
                        } else {
                            $aWrite = $a . ' * ';
                        }
                        $resultWritten3rd = '= ' . $aWrite . $bWrite;
                    }
                }
                ////////////////Rationalization///////////////
                elseif ($y == $u) {
                    $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                    $resultWritten1st .= '</tr></table>';
                    $addHtml($resultWritten1st);
                    $y += $u;
                    if ($y == 1) {
                        $yWrite = '';
                    } else {
                        $yWrite = $y . ' * ';
                    }
                    if ($b == 1) {
                        $bWrite = '';
                    } elseif ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                        $bWrite = $this->roundPrice(pow($b, 1 / 2), 4);
                        $a *= $this->roundPrice(pow($b, 1 / 2), 4);
                        $b = 1;
                    }
                    $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                        '<br><hr noshade>' . $xWrite . $yWrite . '</th></table></td>';

                    $resultWritten2nd .= '<td class="py-2" rowspan="3">*</td>';
                    $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $reducedMultiplier .
                        '<br><hr noshade>' . $reducedMultiplier . '</th></table></td>';
                    $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';

                    if ($b != 1 && $this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                        $bWrite = '√(' . $b;
                        $bWrite .= ' * ';
                    } elseif ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                        $bWrite .= '√(';
                    } else {
                        $bWrite = '√(' . $bWrite;
                    }

                    $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';
                    $resultWritten3rd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $y .
                        ')<br><hr noshade>' . $xWrite . $y . '</th></table></td>';
                    $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';

                    $a = $this->roundPrice($a / ($x * $y), 4);
                    $b = $this->roundPrice($b * $y, 4);
                    if ($a == 1) {
                        $aWrite = '';
                    } else {
                        $aWrite = $a . ' * ';
                    }
                    $resultWritten4th .= $aWrite . '√' . $b;
                } else {
                    if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                        if ($b == 1) {
                            $bWrite = '';
                            $aWrite = $a;
                        } else {
                            $sthChanged = true;
                            $bWrite = $this->roundPrice(pow($b, 1 / 2), 4);
                            $a *= $this->roundPrice(pow($b, 1 / 2), 4);
                            $b = 1;
                        }
                    }
                    if ($this->isInteger($this->roundPrice(pow($y, 1 / 2), 4))) {
                        if ($y == 1) {
                            $yWrite = '';
                            $xWrite = $x;
                        } else {
                            $sthChanged = true;
                            $yWrite = $this->roundPrice(pow($y, 1 / 2), 4);
                            $x *= $this->roundPrice(pow($y, 1 / 2), 4);
                            $y = 1;
                        }
                    }
                    if ($this->isInteger($this->roundPrice(pow($u, 1 / 2), 4))) {
                        if ($u == 1) {
                            $uWrite = '';
                            $zWrite = $z;
                        } else {
                            $sthChanged = true;
                            $uWrite = $this->roundPrice(pow($u, 1 / 2), 4);
                            $z *= $this->roundPrice(pow($u, 1 / 2), 4);
                            $u = 1;
                        }
                    }
                    if ($sthChanged) {
                        $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten1st .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                            '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite . '</th></table></td>';
                        if ($b == 1) {
                            $bWrite = '';
                            $aWrite = $a;
                        }
                        if ($y == 1) {
                            $yWrite = '';
                            $xWrite = $x;
                        }
                        if ($u == 1) {
                            $uWrite = '';
                            $zWrite = $z;
                        }
                    }
                    $zAbs = abs($z);
                    if ($zAbs == 1 && $u != 1) {
                        $zAbs = '';
                    } else if ($u != 1) {
                        $zAbs .= ' * ';
                    }
                    $resultWritten1st .= '</tr></table>';
                    $addHtml($resultWritten1st);

                    $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                        '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite . '</th></table></td>';

                    $resultWritten2nd .= '<td class="py-2" rowspan="3">*</td>';
                    $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $xWrite . $yWrite . $signDownInverse .
                        $zAbs . $uWrite . '<br><hr noshade>' . $xWrite . $yWrite . $signDownInverse . $zAbs . $uWrite .
                        '</th></table></td>';

                    if ($b != 1 && $this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $y != 1) {
                        $bWrite = '√(' . $b;
                        $bWrite .= ' * ' . $y . ')';
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $y != 1) {
                        $bWrite = ' * √' . $y;
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $y == 1) {
                        $bWrite = '√' . $b;
                    } else {
                        $bWrite = '';
                    }

                    if ($b != 1 && $this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $u != 1) {
                        $dWrite = '√(' . $b;
                        $dWrite .= ' * ' . $u . ')';
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $u != 1) {
                        $dWrite = ' * √' . $u;
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $u == 1) {
                        $dWrite = '√' . $b;
                    } else {
                        $dWrite = '';
                    }

                    $a2nd = $a * $z;
                    $a *= $x;
                    if ($z > 0) {
                        $a2nd *= (-1);
                    }
                    if ($a2nd == 1) {
                        $aWrite2nd = '';
                    } else if ($a2nd == -1) {
                        $aWrite2nd = '-';
                    } else {
                        $aWrite2nd = $a2nd;
                    }
                    if ($a2nd < 0) {
                        $signUp = ' ';
                    } else {
                        $signUp = ' + ';
                    }
                    if ($a == 1 && $bWrite != '') {
                        $aWrite = '';
                    } else if ($a == 1 && $bWrite == '') {
                        $aWrite = 1;
                    } else if ($a != 1 && $bWrite == '') {
                        $aWrite = $a;
                    } else {
                        $aWrite = $a . ' * ';
                    }
                    if ($a2nd == 1 && $dWrite != '') {
                        $aWrite2nd = '';
                    } else if ($a2nd == 1 && $dWrite == '') {
                        $aWrite2nd = 1;
                    } else {
                        $aWrite2nd = $a2nd;
                    }

                    $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';
                    $resultWritten3rd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                        $aWrite2nd . $dWrite . '<br><hr noshade>' . $this->roundPrice($x * $x * $y, 4) . ' - ' .
                        $this->roundPrice($z * $z * $u, 4) . '</th></table></td>';

                    $a = $this->roundPrice(($a) / ($x * $x * $y - $z * $z * $u), 4);
                    $a2nd = $this->roundPrice(($a2nd) / ($x * $x * $y - $z * $z * $u), 4);
                    $b = $this->roundPrice($b * $y, 4);
                    $d = $this->roundPrice($b * $u, 4);
                    if ($a == 1 && $b != 1) {
                        $aWrite = '';
                    } else if ($a == -1 && $b != -1) {
                        $aWrite = '-';
                    } else if ($b != 1) {
                        $aWrite = $a . ' * ';
                    } else {
                        $aWrite = $a;
                    }
                    if ($a2nd == 1 && $d != 1) {
                        $aWrite2nd = '';
                    } else if ($a2nd == -1 && $d != 1) {
                        $aWrite2nd = '-';
                    } else if ($d != 1) {
                        $aWrite2nd = $a2nd . ' * ';
                    } else {
                        $aWrite2nd = $a2nd;
                    }
                    if (($x * $x * $y - $z * $z * $u < 0 && $signUp == ' ') || ($x * $x * $y - $z * $z * $u > 0 && $signUp == ' + ')) {
                        $signUp = ' + ';
                    } else {
                        $signUp = ' ';
                    }
                    if ($b != 1) {
                        $bWrite = '√' . $b;
                    }
                    if ($d != 1) {
                        $dWrite = '√' . $d;
                    }
                    $resultWritten4th .= $aWrite . $bWrite . $signUp . $aWrite2nd . $dWrite;

                    $finalResult1st = $this->getSimplified($b, 2);
                    $finalResult2nd = $this->getSimplified($d, 2);

                    if ($finalResult1st[1] == $n && $finalResult1st[2] == $b && $finalResult2nd[1] == $m && $finalResult2nd[2] == $d) {
                        $showLastLine = false;
                    }
                    $finalResult1st[0] = $this->roundPrice($finalResult1st[0] * $a, 4);
                    $finalResult2nd[0] = $this->roundPrice($finalResult2nd[0] * $a2nd, 4);
                    if ($finalResult1st[0] == 1 && $finalResult1st[2] != 1) {
                        $finalResult1st[0] = '';
                    } else if ($finalResult1st[0] == -1 && $finalResult1st[2] != 1) {
                        $finalResult1st[0] = '-';
                    } else if ($finalResult1st[2] != 1) {
                        $finalResult1st[0] .= ' * ';
                    }
                    if ($finalResult2nd[0] == 1 && $finalResult2nd[2] != 1) {
                        $finalResult2nd[0] = '';
                    } else if ($finalResult2nd[0] == -1 && $finalResult2nd[2] != 1) {
                        $finalResult2nd[0] = '-';
                    } else if ($finalResult2nd[2] != 1) {
                        $finalResult2nd[0] .= ' * ';
                    }
                    $finalResult1st[1] = '';
                    $finalResult2nd[1] = '';
                    if ($finalResult1st[2] == 1) {
                        $finalResult1st[2] = '';
                    } else {
                        $finalResult1st[2] = '<sup class="font-s-14">' . $finalResult1st[1] . '</sup>√' . $finalResult1st[2];
                    }
                    if ($finalResult2nd[2] == 1) {
                        $finalResult2nd[2] = '';
                    } else {
                        $finalResult2nd[2] = '<sup class="font-s-14">' . $finalResult2nd[1] . '</sup>√' . $finalResult2nd[2];
                    }
                    if ($showLastLine) {
                        $resultWritten4th .= $finalResult1st[0] . $finalResult1st[2] . $signUp . $finalResult2nd[0] . $finalResult2nd[2];
                    }
                }

                $resultWritten2nd .= '</tr></table>';
                $addHtml($resultWritten2nd);

                $resultWritten3rd .= '</tr></table>';
                $addHtml($resultWritten3rd);

                $jawab($resultWritten4th);
            }
        }

        ////////////////////////////////////////////////
        /////////////////EXPRESSION 4///////////////////
        ////////////////////////////////////////////////
        elseif ($expression == 4) {
            if (!is_nan((float)$b) && !is_nan((float)$d) && !is_nan((float)$y) && !is_nan((float)$u)) {
                $resultWritten1st .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp . $cWrite .
                    $dWrite . '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite . '</th></table></td>';
                $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';

                //////////No need for rationalization/////////
                if ($this->isInteger($this->roundPrice(pow($y, 1 / 2), 4)) && $this->isInteger($this->roundPrice(pow($u, 1 / 2), 4))) {
                    $addHtml($resultWritten1st);
                    $yWrite = $this->roundPrice(pow($y, 1 / 2), 4);
                    if ($x == 1 && $y == 1) {
                        $yWrite = 1;
                    } else if ($y == 1) {
                        $yWrite = '';
                    }
                    $uWrite = $this->roundPrice(pow($u, 1 / 2), 4);
                    if ($z == 1 && $u == 1) {
                        $uWrite = 1;
                    } else if ($u == 1) {
                        $uWrite = '';
                    }
                    if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $this->isInteger($this->roundPrice(pow($d, 1 / 2), 4))) {
                        $bWrite = $this->roundPrice(pow($b, 1 / 2), 4);
                        if ($a == 1 && $b == 1) {
                            $bWrite = 1;
                        } else if ($b == 1) {
                            $bWrite = '';
                        }
                        $dWrite = $this->roundPrice(pow($d, 1 / 2), 4);
                        if ($c == 1 && $d == 1) {
                            $dWrite = 1;
                        } else if ($d == 1) {
                            $dWrite = '';
                        }
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                            $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite;
                        $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten2nd .= '</th></table></td>';
                        $resultWritten3rd = '= ' . $this->roundPrice(($a * pow($b, 1 / 2) + $c * pow($d, 1 / 2)) / ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)), 4);
                        return [
                            'all_result' => $all_result_html,
                            'main_jawab' => $main_jawab_html
                        ];
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                        $bWrite = $this->roundPrice(pow($b, 1 / 2), 4);
                        if ($a == 1 && $b == 1) {
                            $bWrite = 1;
                        } else if ($b == 1) {
                            $aWrite = $a;
                            $bWrite = '';
                        }
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                            $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite;
                        $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten2nd .= '</th></table></td>';
                        if ($c * ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)) < 0) {
                            $signUp = ' ';
                        } else {
                            $signUp = ' + ';
                        }
                        $a = $this->roundPrice(($a * pow($b, 1 / 2)) / ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)), 4);
                        $b = 1;
                        $bWrite = '';
                        $c = $this->roundPrice($c / ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)), 4);
                        $aWrite = $a;
                        if ($c == 1) {
                            $cWrite = '';
                        } else {
                            $cWrite = $c . ' * ';
                        }
                        $resultWritten3rd = '= ' . $aWrite . $bWrite . $signUp . $cWrite . $dWrite;
                    } else if ($this->isInteger($this->roundPrice(pow($d, 1 / 2), 4))) {
                        $dWrite = $this->roundPrice(pow($d, 1 / 2), 4);
                        if ($c == 1 && $d == 1) {
                            $dWrite = 1;
                        } else if ($d == 1) {
                            $cWrite = $c;
                            $dWrite = '';
                        }
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                            $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite;
                        $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten2nd .= '</th></table></td>';
                        if ($c * ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)) < 0) {
                            $signUp = ' ';
                        } else {
                            $signUp = ' + ';
                        }
                        $c = $this->roundPrice(($c * pow($d, 1 / 2)) / ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)), 4);
                        $d = 1;
                        $dWrite = '';
                        $a = $this->roundPrice($a / ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)), 4);
                        $cWrite = $c;
                        if ($a == 1) {
                            $aWrite = '';
                        } else {
                            $aWrite = $a . ' * ';
                        }
                        $resultWritten3rd = '= ' . $aWrite . $bWrite . $signUp . $cWrite . $dWrite;
                    } else {
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                            $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite;
                        $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten2nd .= '</th></table></td>';

                        if ($c * ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)) < 0) {
                            $signUp = ' ';
                        } else {
                            $signUp = ' + ';
                        }
                        $a = $this->roundPrice($a / ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)), 4);
                        if ($a == 1) {
                            $aWrite = '';
                        } else {
                            $aWrite = $a . ' * ';
                        }
                        $c = $this->roundPrice($c / ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)), 4);
                        if ($c == 1) {
                            $cWrite = '';
                        } else {
                            $cWrite = $c . ' * ';
                        }
                        $resultWritten3rd = '= ' . $aWrite . $bWrite . $signUp . $cWrite . $dWrite;
                    }

                    $finalResult1st = $this->getSimplified($b, 2);
                    $finalResult2nd = $this->getSimplified($d, 2);
                    if ($finalResult1st[1] == $n && $finalResult1st[2] == $b && $finalResult2nd[1] == $m && $finalResult2nd[2] == $d) {
                        $showLastLine = false;
                    }
                    $finalResult1st[0] = $this->roundPrice($finalResult1st[0] * $a, 4);
                    $finalResult2nd[0] = $this->roundPrice($finalResult2nd[0] * $a2nd, 4);
                    if ($finalResult1st[0] == 1 && $finalResult1st[2] != 1) {
                        $finalResult1st[0] = '';
                    } else if ($finalResult1st[0] == -1 && $finalResult1st[2] != 1) {
                        $finalResult1st[0] = '-';
                    } else if ($finalResult1st[2] != 1) {
                        $finalResult1st[0] .= ' * ';
                    }
                    if ($finalResult2nd[0] == 1 && $finalResult2nd[2] != 1) {
                        $finalResult2nd[0] = '';
                    } else if ($finalResult2nd[0] == -1 && $finalResult2nd[2] != 1) {
                        $finalResult2nd[0] = '-';
                    } else if ($finalResult2nd[2] != 1) {
                        $finalResult2nd[0] .= ' * ';
                    }
                    $finalResult1st[1] = '';
                    $finalResult2nd[1] = '';
                    if ($finalResult1st[2] == 1) {
                        $finalResult1st[2] = '';
                    } else {
                        $finalResult1st[2] = '<sup class="font-s-14">' . $finalResult1st[1] . '</sup>√' . $finalResult1st[2];
                    }
                    if ($finalResult2nd[2] == 1) {
                        $finalResult2nd[2] = '';
                    } else {
                        $finalResult2nd[2] = '<sup class="font-s-14">' . $finalResult2nd[1] . '</sup>√' . $finalResult2nd[2];
                    }
                    if ($showLastLine) {
                        $resultWritten4th .= ' = ' . $finalResult1st[0] . $finalResult1st[2] . $signUp . $finalResult2nd[0] . $finalResult2nd[2];
                    }
                }
                ////////////////Rationalization///////////////
                elseif ($y == $u) {
                    $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                    $resultWritten1st .= '</tr></table>';
                    $addHtml($resultWritten1st);
                    $x += $z;
                    if ($x == 1) {
                        $xWrite = '';
                    } else {
                        $xWrite = $x . ' * ';
                    }

                    //////////Proceed as in Expression 2///////////
                    $n = 2;
                    $m = 2;
                    $k = 2;

                    $resultWritten1st .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp . $cWrite .
                        $dWrite . '<br><hr noshade>' . $xWrite . $yWrite . '</th></table></td>';
                    $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                    $resultWritten1st .= '</tr></table>';
                    $addHtml($resultWritten1st);
                    $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';

                    //////////No need for rationalization/////////
                    if ($this->isInteger($this->roundPrice(pow($y, 1 / $k), 4))) {
                        if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4)) && $this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                            $bWrite = $this->roundPrice(pow($b, 1 / $n), 4);
                            if ($a == 1 && $b == 1) {
                                $bWrite = 1;
                            } else if ($b == 1) {
                                $bWrite = '';
                            }
                            $dWrite = $this->roundPrice(pow($d, 1 / $m), 4);
                            if ($c == 1 && $d == 1) {
                                $dWrite = 1;
                            } else if ($d == 1) {
                                $dWrite = '';
                            }
                            $yWrite = $this->roundPrice(pow($y, 1 / $k), 4);
                            if ($x == 1 && $y == 1) {
                                $yWrite = 1;
                            } else if ($y == 1) {
                                $yWrite = '';
                            }
                            $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                                $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite;
                            $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                            $resultWritten2nd .= '</th></table></td>';

                            $resultWritten3rd = '= ' . $this->roundPrice(($a * pow($b, 1 / $n) + $c * pow($d, 1 / $m)) / ($x * pow($y, 1 / $k)), 4);

                            $addHtml($resultWritten2nd);
                            $addHtml($resultWritten3rd);
                            return [
                                'all_result' => $all_result_html,
                                'main_jawab' => $main_jawab_html
                            ];
                        } else if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                            $bWrite = $this->roundPrice(pow($b, 1 / $n), 4);
                            if ($a == 1 && $b == 1) {
                                $bWrite = 1;
                            } else if ($b == 1) {
                                $bWrite = '';
                            }
                            $yWrite = $this->roundPrice(pow($y, 1 / $k), 4);
                            if ($x == 1 && $y == 1) {
                                $yWrite = 1;
                            } else if ($y == 1) {
                                $yWrite = '';
                            }
                            $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                                $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite;
                            $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                            $resultWritten2nd .= '</th></table></td>';

                            $resultWritten3rd = '= ' . $this->roundPrice(($a * pow($b, 1 / $n)) / ($x * pow($y, 1 / $k)), 4);
                            $c /= $x * pow($y, 1 / $k);
                            if ($c < 0) {
                                $signUp = ' ';
                            } else {
                                $signUp = ' + ';
                            }
                            if ($c == 1) {
                                $cWrite = '';
                            } else {
                                $cWrite = $this->roundPrice($c, 5) . ' * ';
                            }
                            $resultWritten3rd .= $signUp . $cWrite . $dWrite;
                        } else if ($this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                            $dWrite = $this->roundPrice(pow($d, 1 / $m), 4);
                            if ($c == 1 && $d == 1) {
                                $dWrite = 1;
                            } else if ($d == 1) {
                                $dWrite = '';
                            }
                            $yWrite = $this->roundPrice(pow($y, 1 / $k), 4);
                            if ($x == 1 && $y == 1) {
                                $yWrite = 1;
                            } else if ($y == 1) {
                                $yWrite = '';
                            }
                            $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                                $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite;
                            $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                            $resultWritten2nd .= '</th></table></td>';

                            $a = $this->roundPrice($a / ($x * pow($y, 1 / $k)), 4);
                            $c = $this->roundPrice(($c * pow($d, 1 / $m)) / ($x * pow($y, 1 / $k)), 4);
                            if ($c < 0) {
                                $signUp = ' ';
                            } else {
                                $signUp = ' + ';
                            }
                            if ($a == 1) {
                                $aWrite = '';
                            } else {
                                $aWrite = $a . ' * ';
                            }
                            $resultWritten3rd = '= ' . $aWrite . $bWrite . $signUp . $c;
                        } else {
                            $yWrite = $this->roundPrice(pow($y, 1 / $k), 4);
                            if ($x == 1 && $y == 1) {
                                $yWrite = 1;
                            } else if ($y == 1) {
                                $yWrite = '';
                            }
                            if ($n == $m && $b == $d) {
                                $oneSummand = true;
                                $a += $c;
                                if ($a == 1) {
                                    $aWrite = '';
                                } else {
                                    $aWrite = $a . ' * ';
                                }
                                $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                                    '<br><hr noshade>' . $xWrite . $yWrite;
                                $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                                $resultWritten2nd .= '</th></table></td>';

                                $a = $this->roundPrice($a / ($x * pow($y, 1 / $k)), 4);
                                if ($a == 1) {
                                    $aWrite = '';
                                } else {
                                    $aWrite = $a . ' * ';
                                }
                                $resultWritten3rd = '= ' . $aWrite . $bWrite;
                            } else {
                                $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                                    $signUp . $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite;
                                $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                                $resultWritten2nd .= '</th></table></td>';

                                $a = $this->roundPrice($a / ($x * pow($y, 1 / $k)), 4);
                                $c = $this->roundPrice($c / ($x * pow($y, 1 / $k)), 4);
                                if ($a == 1) {
                                    $aWrite = '';
                                } else {
                                    $aWrite = $a . ' * ';
                                }
                                if ($c == 1) {
                                    $cWrite = '';
                                } else {
                                    $cWrite = $c . ' * ';
                                }
                                if ($c < 0) {
                                    $signUp = ' ';
                                } else {
                                    $signUp = ' + ';
                                }
                                $resultWritten3rd = '= ' . $aWrite . $bWrite . $signUp . $cWrite . $dWrite;
                            }
                        }
                        $addHtml($resultWritten2nd);
                        $addHtml($resultWritten3rd);
                    }
                    ////////////////Rationalization///////////////
                    else {
                        if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4)) && $this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                            $oneSummand = true;
                            $bWrite = $this->roundPrice(pow($b, 1 / $n), 4);
                            if ($a == 1 && $b == 1) {
                                $bWrite = 1;
                            } else if ($b == 1) {
                                $bWrite = '';
                            }
                            $dWrite = $this->roundPrice(pow($d, 1 / $m), 4);
                            if ($c == 1 && $d == 1) {
                                $dWrite = 1;
                            } else if ($d == 1) {
                                $dWrite = '';
                            }
                            $a = $this->roundPrice($a * pow($b, 1 / $n) + $c * pow($d, 1 / $m), 4);
                            $b = 1;
                        } else if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                            $bWrite = $this->roundPrice(pow($b, 1 / $n), 4);
                            if ($a == 1 && $b == 1) {
                                $bWrite = 1;
                            } else if ($b == 1) {
                                $bWrite = '';
                            }
                            $a = $this->roundPrice($a * pow($b, 1 / $n), 4);
                            $b = 1;
                        } else if ($this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                            $dWrite = $this->roundPrice(pow($d, 1 / $m), 4);
                            if ($c == 1 && $d == 1) {
                                $dWrite = 1;
                            } else if ($d == 1) {
                                $dWrite = '';
                            }
                            $c = $this->roundPrice($c * pow($d, 1 / $m), 4);
                            $d = 1;
                        }
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                            $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite . '</th></table></td>';

                        $resultWritten2nd .= '<td class="py-2" rowspan="3">*</td>';
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $reducedMultiplier .
                            '<br><hr noshade>' . $reducedMultiplier . '</th></table></td>';
                        $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';

                        if ($a == 1) {
                            $aWrite = '';
                        } else if ($b != 1) {
                            $aWrite = $a . ' * ';
                        } else {
                            $aWrite = $a;
                        }
                        if ($c == 1) {
                            $cWrite = '';
                        } else if ($d != 1) {
                            $cWrite = $c . ' * ';
                        } else {
                            $cWrite = $c;
                        }

                        $newRoot1st = $this->find_lcm($n, $k);
                        $newRoot2nd = $this->find_lcm($m, $k);
                        if ($newRoot1st == 2) {
                            $newRootWrite1st = '';
                        } else {
                            $newRootWrite1st = $newRoot1st;
                        }
                        if ($newRoot2nd == 2) {
                            $newRootWrite2nd = '';
                        } else {
                            $newRootWrite2nd = $newRoot2nd;
                        }
                        if ($b != 1 && $this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                            $bWrite = '<sup class="font-s-14">' . $newRootWrite1st . '</sup>√(' . pow($b, $newRoot1st / $n) . ' * ';
                        } else if ($this->isInteger($this->roundPrice(pow($b, 1 / $n), 4))) {
                            $bWrite = ' * <sup class="font-s-14">' . $newRootWrite1st . '</sup>√(';
                        } else {
                            $bWrite = '<sup class="font-s-14">' . $newRootWrite1st . '</sup>√(' . $bWrite;
                        }
                        if ($d != 1 && $this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                            $dWrite = '<sup class="font-s-14">' . $newRootWrite2nd . '</sup>√(' . pow($d, $newRoot2nd / $m) . ' * ';
                        } else if ($this->isInteger($this->roundPrice(pow($d, 1 / $m), 4))) {
                            $dWrite = ' * <sup class="font-s-14">' . $newRootWrite2nd . '</sup>√(';
                        } else {
                            $dWrite = '<sup class="font-s-14">' . $newRootWrite2nd . '</sup>√(' . $dWrite;
                        }

                        $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten3rd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . pow($y, $newRoot1st / $k) . ')';
                        if (!$oneSummand) {
                            $resultWritten3rd .= $signUp . $cWrite . $dWrite . pow($y, $newRoot2nd / $k) . ')';
                        }
                        $resultWritten3rd .= '<br><hr noshade>' . $xWrite . $y . '</th></table></td>';
                        $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';

                        $a = $this->roundPrice($a / ($x * $y), 4);
                        $c = $this->roundPrice($c / ($x * $y), 4);
                        $b = $this->roundPrice(pow($b, $newRoot1st / $n) * pow($y, $newRoot1st / $k), 4);
                        $d = $this->roundPrice(pow($d, $newRoot2nd / $m) * pow($y, $newRoot2nd / $k), 4);
                        $n = $newRoot1st;
                        $m = $newRoot2nd;
                        if ($a == 1) {
                            $aWrite = '';
                        } else {
                            $aWrite = $a . ' * ';
                        }
                        if ($c == 1) {
                            $cWrite = '';
                        } else {
                            $cWrite = $c . ' * ';
                        }
                        if ($c < 0) {
                            $signUp = ' ';
                        } else {
                            $signUp = ' + ';
                        }
                        $resultWritten4th .= $aWrite . '<sup class="font-s-14">' . $newRootWrite1st . '</sup>√' . $b . $signUp . $cWrite .
                            '<sup class="font-s-14">' . $newRootWrite2nd . '</sup>√' . $d;
                    }
                    $finalResult1st = $this->getSimplified($b, $n);
                    $finalResult2nd = $this->getSimplified($d, $m);
                    if ($finalResult1st[2] == $b && $finalResult2nd[2] == $d) {
                        $showLastLine = false;
                    }
                    $finalResult1st[0] = $this->roundPrice($finalResult1st[0] * $a, 4);
                    $finalResult2nd[0] = $this->roundPrice($finalResult2nd[0] * $c, 4);
                    if ($finalResult1st[0] == 1 && $finalResult1st[2] != 1) {
                        $finalResult1st[0] = '';
                    } else if ($finalResult1st[0] == -1 && $finalResult1st[2] != 1) {
                        $finalResult1st[0] = '-';
                    } else if ($finalResult1st[2] != 1) {
                        $finalResult1st[0] .= ' * ';
                    }
                    if ($finalResult2nd[0] == 1 && $finalResult2nd[2] != 1) {
                        $finalResult2nd[0] = '';
                    } else if ($finalResult2nd[0] == -1 && $finalResult2nd[2] != 1) {
                        $finalResult2nd[0] = '-';
                    } else if ($finalResult2nd[2] != 1) {
                        $finalResult2nd[0] .= ' * ';
                    }
                    if ($finalResult1st[1] == 2) {
                        $finalResult1st[1] = '';
                    }
                    if ($finalResult2nd[1] == 2) {
                        $finalResult2nd[1] = '';
                    }
                    if ($finalResult1st[2] == 1) {
                        $finalResult1st[2] = '';
                    } else {
                        $finalResult1st[2] = '<sup class="font-s-14">' . $finalResult1st[1] . '</sup>√' . $finalResult1st[2];
                    }
                    if ($finalResult2nd[2] == 1) {
                        $finalResult2nd[2] = '';
                    } else {
                        $finalResult2nd[2] = '<sup class="font-s-14">' . $finalResult2nd[1] . '</sup>√' . $finalResult2nd[2];
                    }
                    if ($showLastLine) {
                        $resultWritten4th .= $finalResult1st[0] . $finalResult1st[2] . $signUp . $finalResult2nd[0] . $finalResult2nd[2];
                    }

                    $resultWritten2nd .= '</tr></table>';
                    $addHtml($resultWritten2nd);

                    $resultWritten3rd .= '</tr></table>';
                    $addHtml($resultWritten3rd);

                    $jawab($resultWritten4th);
                } elseif ($b == $d) {
                    $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                    $addHtml($resultWritten1st);
                    $a += $c;
                    if ($a == 1) {
                        $aWrite = '';
                    } else {
                        $aWrite = $a . ' * ';
                    }

                    //////////Proceed as in Expression 3///////////
                    $resultWritten1st .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                        '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite . '</th></table></td>';
                    $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';

                    //////////No need for rationalization/////////
                    if ($this->isInteger($this->roundPrice(pow($y, 1 / 2), 4)) && $this->isInteger($this->roundPrice(pow($u, 1 / 2), 4))) {
                        $yWrite = $this->roundPrice(pow($y, 1 / 2), 4);
                        if ($x == 1 && $y == 1) {
                            $yWrite = 1;
                        } else if ($y == 1) {
                            $yWrite = '';
                        }
                        $uWrite = $this->roundPrice(pow($u, 1 / 2), 4);
                        if ($z == 1 && $u == 1) {
                            $uWrite = 1;
                        } else if ($u == 1) {
                            $uWrite = '';
                        }
                        if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                            $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                            $resultWritten1st .= '</tr></table>';
                            $addHtml($resultWritten1st);
                            $bWrite = $this->roundPrice(pow($b, 1 / 2), 4);
                            if ($a == 1 && $b == 1) {
                                $bWrite = 1;
                            } else if ($b == 1) {
                                $bWrite = '';
                            }
                            $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                                '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite;
                            $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                            $resultWritten2nd .= '</th></table></td>';

                            $resultWritten3rd = '= ' . $this->roundPrice(($a * pow($b, 1 / 2)) / ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)), 4);
                            $addHtml($resultWritten2nd);
                            $addHtml($resultWritten3rd);
                            return [
                                'all_result' => $all_result_html,
                                'main_jawab' => $main_jawab_html
                            ];
                        } else {
                            $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                            $resultWritten1st .= '</tr></table>';
                            $addHtml($resultWritten1st);
                            $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                                '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite;
                            $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';
                            $resultWritten2nd .= '</th></table></td>';

                            $a = $this->roundPrice($a / ($x * pow($y, 1 / 2) + $z * pow($u, 1 / 2)), 4);
                            if ($a == 1) {
                                $aWrite = '';
                            } else {
                                $aWrite = $a . ' * ';
                            }
                            $resultWritten3rd = '= ' . $aWrite . $bWrite;
                        }
                    }
                    ////////////////Rationalization///////////////
                    elseif ($y == $u) {
                        $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten1st .= '</tr></table>';
                        $addHtml($resultWritten1st);
                        $y += $u;
                        if ($y == 1) {
                            $yWrite = '';
                        } else {
                            $yWrite = $y . ' * ';
                        }
                        if ($b == 1) {
                            $bWrite = '';
                        } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                            $bWrite = $this->roundPrice(pow($b, 1 / 2), 4);
                            $a *= $this->roundPrice(pow($b, 1 / 2), 4);
                            $b = 1;
                        }
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                            '<br><hr noshade>' . $xWrite . $yWrite . '</th></table></td>';

                        $resultWritten2nd .= '<td class="py-2" rowspan="3">*</td>';
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $reducedMultiplier .
                            '<br><hr noshade>' . $reducedMultiplier . '</th></table></td>';
                        $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';

                        if ($b != 1 && $this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                            $bWrite = '√(' . $b;
                            $bWrite .= ' * ';
                        } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                            $bWrite .= '√(';
                        } else {
                            $bWrite = '√(' . $bWrite;
                        }

                        $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten3rd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $y .
                            ')<br><hr noshade>' . $xWrite . $y . '</th></table></td>';
                        $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';

                        $a = $this->roundPrice($a / ($x * $y), 4);
                        $b = $this->roundPrice($b * $y, 4);
                        if ($a == 1) {
                            $aWrite = '';
                        } else {
                            $aWrite = $a . ' * ';
                        }
                        $resultWritten4th .= $aWrite . '√' . $b;
                    } else {
                        if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                            if ($b == 1) {
                                $bWrite = '';
                                $aWrite = $a;
                            } else {
                                $sthChanged = true;
                                $bWrite = $this->roundPrice(pow($b, 1 / 2), 4);
                                $a *= $this->roundPrice(pow($b, 1 / 2), 4);
                                $b = 1;
                            }
                        }
                        if ($this->isInteger($this->roundPrice(pow($y, 1 / 2), 4))) {
                            if ($y == 1) {
                                $yWrite = '';
                                $xWrite = $x;
                            } else {
                                $sthChanged = true;
                                $yWrite = $this->roundPrice(pow($y, 1 / 2), 4);
                                $x *= $this->roundPrice(pow($y, 1 / 2), 4);
                                $y = 1;
                            }
                        }
                        if ($this->isInteger($this->roundPrice(pow($u, 1 / 2), 4))) {
                            if ($u == 1) {
                                $uWrite = '';
                                $zWrite = $z;
                            } else {
                                $sthChanged = true;
                                $uWrite = $this->roundPrice(pow($u, 1 / 2), 4);
                                $z *= $this->roundPrice(pow($u, 1 / 2), 4);
                                $u = 1;
                            }
                        }
                        if ($sthChanged) {
                            $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                            $resultWritten1st .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                                '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite .
                                '</th></table></td>';
                            if ($b == 1) {
                                $bWrite = '';
                                $aWrite = $a;
                            }
                            if ($y == 1) {
                                $yWrite = '';
                                $xWrite = $x;
                            }
                            if ($u == 1) {
                                $uWrite = '';
                                $zWrite = $z;
                            }
                        }
                        $zAbs = abs($z);
                        if ($zAbs == 1 && $u != 1) {
                            $zAbs = '';
                        } else if ($u != 1) {
                            $zAbs .= ' * ';
                        }
                        $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten1st .= '</tr></table>';
                        $addHtml($resultWritten1st);

                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite .
                            '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite . '</th></table></td>';

                        $resultWritten2nd .= '<td class="py-2" rowspan="3">*</td>';
                        $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $xWrite . $yWrite .
                            $signDownInverse . $zAbs . $uWrite . '<br><hr noshade>' . $xWrite . $yWrite . $signDownInverse .
                            $zAbs . $uWrite . '</th></table></td>';
                        $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';

                        if ($b != 1 && $this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $y != 1) {
                            $bWrite = '√(' . $b;
                            $bWrite .= ' * ' . $y . ')';
                        } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $y != 1) {
                            $bWrite = ' * √' . $y;
                        } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $y == 1) {
                            $bWrite = '√' . $b;
                        } else {
                            $bWrite = '';
                        }

                        if ($b != 1 && $this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $u != 1) {
                            $dWrite = '√(' . $b;
                            $dWrite .= ' * ' . $u . ')';
                        } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $u != 1) {
                            $dWrite = ' * √' . $u;
                        } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $u == 1) {
                            $dWrite = '√' . $b;
                        } else {
                            $dWrite = '';
                        }

                        $a2nd = $a * $z;
                        $a *= $x;
                        if ($z > 0) {
                            $a2nd *= (-1);
                        }
                        if ($a2nd == 1) {
                            $aWrite2nd = '';
                        } else if ($a2nd == -1) {
                            $aWrite2nd = '-';
                        } else {
                            $aWrite2nd = $a2nd;
                        }
                        if ($a2nd < 0) {
                            $signUp = ' ';
                        } else {
                            $signUp = ' + ';
                        }
                        if ($a == 1 && $bWrite != '') {
                            $aWrite = '';
                        } else if ($a == 1 && $bWrite == '') {
                            $aWrite = 1;
                        } else if ($a != 1 && $bWrite == '') {
                            $aWrite = $a;
                        } else {
                            $aWrite = $a . ' * ';
                        }
                        if ($a2nd == 1 && $dWrite != '') {
                            $aWrite2nd = '';
                        } else if ($a2nd == 1 && $dWrite == '') {
                            $aWrite2nd = 1;
                        } else {
                            $aWrite2nd = $a2nd;
                        }

                        $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';
                        $resultWritten3rd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp;
                        $resultWritten3rd .= $aWrite2nd . $dWrite . '<br><hr noshade>' . $this->roundPrice($x * $x * $y, 4) . ' - ' .
                            $this->roundPrice($z * $z * $u, 4) . '</th></table></td>';
                        $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';

                        $a = $this->roundPrice(($a) / ($x * $x * $y - $z * $z * $u), 4);
                        $a2nd = $this->roundPrice(($a2nd) / ($x * $x * $y - $z * $z * $u), 4);
                        $b = $this->roundPrice($b * $y, 4);
                        $d = $this->roundPrice($b * $u, 4);
                        if ($a == 1) {
                            $aWrite = '';
                        } else if ($b != 1) {
                            $aWrite = $a . ' * ';
                        } else {
                            $aWrite = $a;
                        }
                        if ($a2nd == 1) {
                            $aWrite2nd = '';
                        } else if ($d != 1) {
                            $aWrite2nd = $a2nd . ' * ';
                        } else {
                            $aWrite2nd = $a2nd;
                        }
                        if (($x * $x * $y - $z * $z * $u < 0 && $signUp == ' ') || ($x * $x * $y - $z * $z * $u > 0 && $signUp == ' + ')) {
                            $signUp = ' + ';
                        } else {
                            $signUp = ' ';
                        }
                        if ($b != 1) {
                            $bWrite = '√' . $b;
                        }
                        if ($d != 1) {
                            $dWrite = '√' . $d;
                        }
                        $resultWritten4th .= $aWrite . $bWrite . $signUp . $aWrite2nd . $dWrite;

                        $finalResult1st = $this->getSimplified($b, 2);
                        $finalResult2nd = $this->getSimplified($d, 2);

                        if ($finalResult1st[1] == $n && $finalResult1st[2] == $b && $finalResult2nd[1] == $m && $finalResult2nd[2] == $d) {
                            $showLastLine = false;
                        }
                        $finalResult1st[0] = $this->roundPrice($finalResult1st[0], 4);
                        $finalResult2nd[0] = $this->roundPrice($finalResult2nd[0], 4);
                        if ($finalResult1st[0] == 1 && $finalResult1st[2] != 1) {
                            $finalResult1st[0] = '';
                        } else if ($finalResult1st[0] == -1 && $finalResult1st[2] != 1) {
                            $finalResult1st[0] = '-';
                        } else if ($finalResult1st[2] != 1) {
                            $finalResult1st[0] .= ' * ';
                        }
                        if ($finalResult2nd[0] == 1 && $finalResult2nd[2] != 1) {
                            $finalResult2nd[0] = '';
                        } else if ($finalResult2nd[0] == -1 && $finalResult2nd[2] != 1) {
                            $finalResult2nd[0] = '-';
                        } else if ($finalResult2nd[2] != 1) {
                            $finalResult2nd[0] .= ' * ';
                        }
                        $finalResult1st[1] = '';
                        $finalResult2nd[1] = '';
                        if ($finalResult1st[2] == 1) {
                            $finalResult1st[2] = '';
                        } else {
                            $finalResult1st[2] = '<sup class="font-s-14">' . $finalResult1st[1] . '</sup>√' . $finalResult1st[2];
                        }
                        if ($finalResult2nd[2] == 1) {
                            $finalResult2nd[2] = '';
                        } else {
                            $finalResult2nd[2] = '<sup class="font-s-14">' . $finalResult2nd[1] . '</sup>√' . $finalResult2nd[2];
                        }
                        if ($showLastLine) {
                            $resultWritten4th .= $finalResult1st[0] . $finalResult1st[2] . $signUp . $finalResult2nd[0] . $finalResult2nd[2];
                        }
                    }

                    $resultWritten2nd .= '</tr></table>';
                    $addHtml($resultWritten2nd);

                    $resultWritten3rd .= '</tr></table>';
                    $addHtml($resultWritten3rd);

                    $jawab($resultWritten4th);
                }
                //////////Sums above and below/////////////
                else {
                    if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4))) {
                        if ($b != 1) {
                            $sthChanged = true;
                        }
                        $bWrite = $this->roundPrice(pow($b, 1 / 2), 4);
                        $a *= $this->roundPrice(pow($b, 1 / 2), 4);
                        $b = 1;
                    }
                    if ($this->isInteger($this->roundPrice(pow($d, 1 / 2), 4))) {
                        if ($d != 1) {
                            $sthChanged = true;
                        }
                        $dWrite = $this->roundPrice(pow($d, 1 / 2), 4);
                        $a *= $this->roundPrice(pow($d, 1 / 2), 4);
                        $d = 1;
                    }
                    if ($this->isInteger($this->roundPrice(pow($y, 1 / 2), 4))) {
                        if ($y != 1) {
                            $sthChanged = true;
                        }
                        $yWrite = $this->roundPrice(pow($y, 1 / 2), 4);
                        $x *= $this->roundPrice(pow($y, 1 / 2), 4);
                        $y = 1;
                    }
                    if ($this->isInteger($this->roundPrice(pow($u, 1 / 2), 4))) {
                        if ($u != 1) {
                            $sthChanged = true;
                        }
                        $uWrite = $this->roundPrice(pow($u, 1 / 2), 4);
                        $z *= $this->roundPrice(pow($u, 1 / 2), 4);
                        $u = 1;
                    }
                    if ($sthChanged) {
                        $resultWritten1st .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                            $cWrite . $dWrite . '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite . '</th></table></td>';
                        $resultWritten1st .= '<td class="py-2" rowspan="3">=</td>';
                    }
                    if ($b == 1) {
                        $bWrite = '';
                        $aWrite = $a;
                    }
                    if ($d == 1) {
                        $dWrite = '';
                        $cWrite = $c;
                    }
                    if ($y == 1) {
                        $yWrite = '';
                        $xWrite = $x;
                    }
                    if ($u == 1) {
                        $uWrite = '';
                        $zWrite = $z;
                    }
                    $zAbs = abs($z);
                    if ($zAbs == 1 && $u != 1) {
                        $zAbs = '';
                    } else if ($u != 1) {
                        $zAbs .= ' * ';
                    }
                    $resultWritten1st .= '</tr></table>';
                    $addHtml($resultWritten1st);

                    $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp . $cWrite .
                        $dWrite . '<br><hr noshade>' . $xWrite . $yWrite . $signDown . $zWrite . $uWrite . '</th></table></td>';
                    $resultWritten2nd .= '<td class="py-2" rowspan="3">*</td>';
                    $resultWritten2nd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $xWrite . $yWrite . $signDownInverse .
                        $zAbs . $uWrite . '<br><hr noshade>' . $xWrite . $yWrite . $signDownInverse . $zAbs . $uWrite . '</th></table></td>';
                    $resultWritten2nd .= '<td class="py-2" rowspan="3">=</td>';

                    if ($b != 1 && $this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $y != 1) {
                        $bWrite = '√(' . $b . ' * ' . $y . ')';
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $y != 1) {
                        $bWrite = '√' . $y;
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $y == 1) {
                        $bWrite = '√' . $b;
                    } else {
                        $bWrite = '';
                    }

                    if ($b != 1 && $this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $u != 1) {
                        $dWrite = '√(' . $b . ' * ' . $u . ')';
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $u != 1) {
                        $dWrite = ' * √' . $u;
                    } else if ($this->isInteger($this->roundPrice(pow($b, 1 / 2), 4)) && $u == 1) {
                        $dWrite = '√' . $b;
                    } else {
                        $dWrite = '';
                    }

                    if ($d != 1 && $this->isInteger($this->roundPrice(pow($d, 1 / 2), 4)) && $y != 1) {
                        $fWrite = '√(' . $d . ' * ' . $y . ')';
                    } else if ($this->isInteger($this->roundPrice(pow($d, 1 / 2), 4)) && $y != 1) {
                        $fWrite = ' * √' . $y;
                    } else if ($this->isInteger($this->roundPrice(pow($d, 1 / 2), 4)) && $y == 1) {
                        $fWrite = '√' . $d;
                    } else {
                        $fWrite = '';
                    }

                    if ($d != 1 && $this->isInteger($this->roundPrice(pow($d, 1 / 2), 4)) && $u != 1) {
                        $hWrite = '√(' . $d . ' * ' . $u . ')';
                    } else if ($this->isInteger($this->roundPrice(pow($d, 1 / 2), 4)) && $u != 1) {
                        $hWrite = ' * √' . $u;
                    } else if ($this->isInteger($this->roundPrice(pow($d, 1 / 2), 4)) && $u == 1) {
                        $hWrite = '√' . $d;
                    } else {
                        $hWrite = '';
                    }

                    $a2nd = $a * $z * (-1);
                    $a *= $x;
                    $e = $c * $x;
                    $g = $c * $z * (-1);

                    if ($a2nd < 0) {
                        $signUp = ' ';
                    } else {
                        $signUp = ' + ';
                    }
                    if ($e < 0) {
                        $signUp2nd = ' ';
                    } else {
                        $signUp2nd = ' + ';
                    }
                    if ($g < 0) {
                        $signUp3rd = ' ';
                    } else {
                        $signUp3rd = ' + ';
                    }
                    if ($a == 1 && $bWrite != '') {
                        $aWrite = '';
                    } else if ($a == 1 && $bWrite == '') {
                        $aWrite = 1;
                    } else if ($a != 1 && $bWrite == '') {
                        $aWrite = $a;
                    } else {
                        $aWrite = $a . ' * ';
                    }
                    if ($a2nd == 1 && $dWrite != '') {
                        $aWrite2nd = '';
                    } else if ($a2nd == 1 && $dWrite == '') {
                        $aWrite2nd = 1;
                    } else {
                        $aWrite2nd = $a2nd;
                    }
                    if ($e == 1 && $fWrite != '') {
                        $eWrite = '';
                    } else if ($e == 1 && $fWrite == '') {
                        $eWrite = 1;
                    } else if ($e != 1 && $fWrite == '') {
                        $eWrite = $e;
                    } else {
                        $eWrite = $e . ' * ';
                    }
                    if ($g == 1 && $hWrite != '') {
                        $gWrite = '';
                    } else if ($g == 1 && $hWrite == '') {
                        $gWrite = 1;
                    } else if ($g != 1 && $hWrite == '') {
                        $gWrite = $g;
                    } else {
                        $gWrite = $g . ' * ';
                    }

                    $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';
                    $resultWritten3rd .= '<td class="py-2" rowspan="3"><table><th class="py-2" rowspan="3">' . $aWrite . $bWrite . $signUp .
                        $aWrite2nd . $dWrite . $signUp2nd . $eWrite . $fWrite . $signUp3rd . $gWrite . $hWrite .
                        '<br><hr noshade>' . $this->roundPrice($x * $x * $y, 4) . ' - ' . $this->roundPrice($z * $z * $u, 4) . '</th></table></td>';
                    $resultWritten3rd .= '<td class="py-2" rowspan="3">=</td>';

                    $a = $this->roundPrice($a / ($x * $x * $y - $z * $z * $u), 4);
                    $a2nd = $this->roundPrice($a2nd / ($x * $x * $y - $z * $z * $u), 4);
                    $e = $this->roundPrice($e / ($x * $x * $y - $z * $z * $u), 4);
                    $g = $this->roundPrice($g / ($x * $x * $y - $z * $z * $u), 4);
                    $f = $this->roundPrice($d * $y, 4);
                    $h = $this->roundPrice($d * $u, 4);
                    $d = $this->roundPrice($b * $u, 4);
                    $b = $this->roundPrice($b * $y, 4);
                    if ($a == 1 && $b != 1) {
                        $aWrite = '';
                    } else if ($a == -1 && $b != -1) {
                        $aWrite = '-';
                    } else if ($b != 1) {
                        $aWrite = $a . ' * ';
                    } else {
                        $aWrite = $a;
                    }
                    if ($a2nd == 1 && $d != 1) {
                        $aWrite2nd = '';
                    } else if ($a2nd == -1 && $d != 1) {
                        $aWrite2nd = '-';
                    } else if ($d != 1) {
                        $aWrite2nd = $a2nd . ' * ';
                    } else {
                        $aWrite2nd = $a2nd;
                    }
                    if ($e == 1) {
                        $eWrite = '';
                    } else if ($f != 1) {
                        $eWrite = $e . ' * ';
                    } else {
                        $eWrite = $e;
                    }
                    if ($g == 1) {
                        $gWrite = '';
                    } else if ($h != 1) {
                        $gWrite = $g . ' * ';
                    } else {
                        $gWrite = $g;
                    }
                    if (($x * $x * $y - $z * $z * $u < 0 && $signUp == ' ') || ($x * $x * $y - $z * $z * $u > 0 && $signUp == ' + ')) {
                        $signUp = ' + ';
                    } else {
                        $signUp = ' ';
                    }
                    if (($x * $x * $y - $z * $z * $u < 0 && $signUp2nd == ' ') || ($x * $x * $y - $z * $z * $u > 0 && $signUp2nd == ' + ')) {
                        $signUp2nd = ' + ';
                    } else {
                        $signUp2nd = ' ';
                    }
                    if (($x * $x * $y - $z * $z * $u < 0 && $signUp3rd == ' ') || ($x * $x * $y - $z * $z * $u > 0 && $signUp3rd == ' + ')) {
                        $signUp3rd = ' + ';
                    } else {
                        $signUp3rd = ' ';
                    }
                    if ($b != 1) {
                        $bWrite = '√' . $b;
                    }
                    if ($d != 1) {
                        $dWrite = '√' . $d;
                    }
                    if ($f != 1) {
                        $fWrite = '√' . $f;
                    }
                    if ($d != 1) {
                        $hWrite = '√' . $h;
                    }
                    $resultWritten4th .= $aWrite . $bWrite . $signUp . $aWrite2nd . $dWrite . $signUp2nd . $eWrite . $fWrite .
                        $signUp3rd . $gWrite . $hWrite;

                    $finalResult1st = $this->getSimplified($b, 2);
                    $finalResult2nd = $this->getSimplified($d, 2);
                    $finalResult3rd = $this->getSimplified($f, 2);
                    $finalResult4th = $this->getSimplified($h, 2);

                    if ($finalResult1st[2] == $b && $finalResult2nd[2] == $d && $finalResult3rd[2] == $f && $finalResult4th[2] == $h) {
                        $showLastLine = false;
                    }
                    $finalResult1st[0] = $this->roundPrice($finalResult1st[0] * $a, 4);
                    $finalResult2nd[0] = $this->roundPrice($finalResult2nd[0] * $a2nd, 4);
                    $finalResult3rd[0] = $this->roundPrice($finalResult3rd[0] * $e, 4);
                    $finalResult4th[0] = $this->roundPrice($finalResult4th[0] * $g, 4);
                    if ($finalResult1st[2] == $finalResult4th[2]) {
                        $finalResult1st[0] += $finalResult4th[0];
                        $kill4th = true;
                    }
                    if ($finalResult2nd[2] == $finalResult3rd[2]) {
                        $finalResult2nd[0] += $finalResult3rd[0];
                        $kill3rd = true;
                        if ($finalResult2nd[0] > 0) {
                            $signUp = ' + ';
                        } else {
                            $signUp = ' ';
                        }
                    }
                    if ($finalResult1st[0] == 1 && $finalResult1st[2] != 1) {
                        $finalResult1st[0] = '';
                    } else if ($finalResult1st[0] == -1 && $finalResult1st[2] != 1) {
                        $finalResult1st[0] = '-';
                    } else if ($finalResult1st[2] != 1) {
                        $finalResult1st[0] .= ' * ';
                    }
                    if ($finalResult2nd[0] == 1 && $finalResult2nd[2] != 1) {
                        $finalResult2nd[0] = '';
                    } else if ($finalResult2nd[0] == -1 && $finalResult2nd[2] != 1) {
                        $finalResult2nd[0] = '-';
                    } else if ($finalResult2nd[2] != 1) {
                        $finalResult2nd[0] .= ' * ';
                    }
                    if ($finalResult3rd[0] == 1 && $finalResult3rd[2] != 1) {
                        $finalResult3rd[0] = '';
                    } else if ($finalResult3rd[0] == -1 && $finalResult3rd[2] != 1) {
                        $finalResult3rd[0] = '-';
                    } else if ($finalResult3rd[2] != 1) {
                        $finalResult3rd[0] .= ' * ';
                    }
                    if ($finalResult4th[0] == 1 && $finalResult4th[2] != 1) {
                        $finalResult4th[0] = '';
                    } else if ($finalResult4th[0] == -1 && $finalResult4th[2] != 1) {
                        $finalResult4th[0] = '-';
                    } else if ($finalResult4th[2] != 1) {
                        $finalResult4th[0] .= ' * ';
                    }
                    $finalResult1st[1] = '';
                    $finalResult2nd[1] = '';
                    $finalResult3rd[1] = '';
                    $finalResult4th[1] = '';
                    if ($finalResult1st[2] == 1) {
                        $finalResult1st[2] = '';
                    } else {
                        $finalResult1st[2] = '√' . $finalResult1st[2];
                    }
                    if ($finalResult2nd[2] == 1) {
                        $finalResult2nd[2] = '';
                    } else {
                        $finalResult2nd[2] = '√' . $finalResult2nd[2];
                    }
                    if ($finalResult3rd[2] == 1) {
                        $finalResult3rd[2] = '';
                    } else {
                        $finalResult3rd[2] = '√' . $finalResult3rd[2];
                    }
                    if ($finalResult4th[2] == 1) {
                        $finalResult4th[2] = '';
                    } else {
                        $finalResult4th[2] = '√' . $finalResult4th[2];
                    }
                    if ($kill3rd) {
                        $signUp2nd = '';
                        $finalResult3rd[0] = '';
                        $finalResult3rd[2] = '';
                    }
                    if ($kill4th) {
                        $signUp3rd = '';
                        $finalResult4th[0] = '';
                        $finalResult4th[2] = '';
                    }
                    if ($showLastLine || $kill3rd || $kill4th) {
                        $resultWritten4th .= ' = ' . $finalResult1st[0] . $finalResult1st[2] . $signUp . $finalResult2nd[0] .
                            $finalResult2nd[2] . $signUp2nd . $finalResult3rd[0] . $finalResult3rd[2] . $signUp3rd .
                            $finalResult4th[0] . $finalResult4th[2];
                    }
                }

                $resultWritten2nd .= '</tr></table>';
                $addHtml($resultWritten2nd);

                $resultWritten3rd .= '</tr></table>';
                $addHtml($resultWritten3rd);

                $jawab($resultWritten4th);
            }
        }

        return [
            'all_result' => $all_result_html,
            'main_jawab' => $main_jawab_html
        ];
    }

    public function calculate()
    {
        // Build the request object for Model validator
        $request = new class(
            $this->activeType,
            $this->operations,
            $this->a,
            $this->b,
            $this->n,
            $this->c,
            $this->d,
            $this->m,
            $this->x,
            $this->y,
            $this->k,
            $this->u,
            $this->n1,
            $this->d1
        ) {
            public $type;
            public $operations;
            public $a;
            public $b;
            public $n;
            public $c;
            public $d;
            public $m;
            public $x;
            public $y;
            public $k;
            public $u;
            public $n1;
            public $d1;

            public function __construct($type, $operations, $a, $b, $n, $c, $d, $m, $x, $y, $k, $u, $n1, $d1) {
                $this->type = $type;
                $this->operations = $operations;
                $this->a = $a;
                $this->b = $b;
                $this->n = $n;
                $this->c = $c;
                $this->d = $d;
                $this->m = $m;
                $this->x = $x;
                $this->y = $y;
                $this->k = $k;
                $this->u = $u;
                $this->n1 = $n1;
                $this->d1 = $d1;
            }

            public function all() {
                return [
                    'type' => $this->type,
                    'operations' => $this->operations,
                    'a' => $this->a,
                    'b' => $this->b,
                    'n' => $this->n,
                    'c' => $this->c,
                    'd' => $this->d,
                    'm' => $this->m,
                    'x' => $this->x,
                    'y' => $this->y,
                    'k' => $this->k,
                    'u' => $this->u,
                    'n1' => $this->n1,
                    'd1' => $this->d1,
                ];
            }
        };

        $model = new Math();
        $result = $model->rationalize($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Check if activeType is first, then run the ported JS calculation step-by-step logic
            if ($this->activeType === 'first') {
                // Ensure z is passed as k for operation 3 and 4
                $z = ($this->operations == 3 || $this->operations == 4) ? $this->k : 0;
                $steps = $this->calculateSteps(
                    $this->operations,
                    $this->a,
                    $this->b,
                    $this->c,
                    $this->d,
                    $this->n,
                    $this->m,
                    $this->x,
                    $this->y,
                    $this->k,
                    $this->u,
                    $z
                );
                $result['all_result'] = $steps['all_result'];
                $result['main_jawab'] = $steps['main_jawab'];
            }

            // Perform NAN/INF check on floats
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

            $sanitizedResult = $this->sanitizeForLivewire($result);

            session()->flash('calculator_result', $sanitizedResult);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'activeType' => $this->activeType,
                'operations' => $this->operations,
                'a' => $this->a,
                'b' => $this->b,
                'n' => $this->n,
                'c' => $this->c,
                'd' => $this->d,
                'm' => $this->m,
                'x' => $this->x,
                'y' => $this->y,
                'k' => $this->k,
                'u' => $this->u,
                'n1' => $this->n1,
                'd1' => $this->d1,
            ]);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $sanitizedResult;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
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

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    /**
     * Prevents Livewire CorruptComponentPayloadException caused by:
     * 1. Un-serializable objects (stdClass)
     * 2. Javascript Float Precision Loss (converting floats to strings)
     */
    private function sanitizeForLivewire($data)
    {
        if (is_null($data)) return null;
        
        $sanitized = json_decode(json_encode($data), true);
        if (is_array($sanitized)) {
            array_walk_recursive($sanitized, function (&$item) {
                if (is_float($item)) {
                    $item = (string) $item;
                }
            });
        }
        return $sanitized;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
    
        return view('livewire.calculators.rationalize-the-denominator-calculator');
    }
}
