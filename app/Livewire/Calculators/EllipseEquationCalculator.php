<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class EllipseEquationCalculator extends Component
{
    public $selection = '1';
    public $d1 = '3';
    public $second_value = '6';
    public $n2 = '8';
    public $c1 = '4';
    public $c2 = '4';
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->selection = $inputs['selection'] ?? $this->selection;
            $this->d1 = $inputs['d1'] ?? $this->d1;
            $this->second_value = $inputs['second_value'] ?? $this->second_value;
            $this->n2 = $inputs['n2'] ?? $this->n2;
            $this->c1 = $inputs['c1'] ?? $this->c1;
            $this->c2 = $inputs['c2'] ?? $this->c2;
        }
    }

    public function resetForm()
    {
        $this->selection = '1';
        $this->d1 = '3';
        $this->second_value = '6';
        $this->n2 = '8';
        $this->c1 = '4';
        $this->c2 = '4';
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

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
        session()->forget([
            'calculator_result',
            'validation_error'
        ]);
    }

    public function simplifyExpression($number)
    {
        $a = intval($number);
        if ($a <= 0) {
            return [1, 1];
        }
        $newnum = $a;
        $newtext = '';
        $checker = 2;
        while ($checker * $checker <= $newnum) {
            if ($newnum % $checker == 0) {
                $newtext .= $checker . ',';
                $newnum = $newnum / $checker;
            } else {
                $checker++;
            }
        }
        $newtext .= $newnum;
        $r = explode(',', $newtext);
        $results = [];
        foreach ($r as $val) {
            $key = strval($val);
            if (trim($key) === '') continue;
            if (!isset($results[$key])) {
                $results[$key] = 1;
            } else {
                $results[$key]++;
            }
        }
        $r1 = [];
        $r2 = [];
        foreach ($results as $j => $count) {
            $r1[] = $count;
            $r2[] = $j;
        }
        $r3 = [];
        $r4 = [];
        for ($t = 0; $t < count($r1); $t++) {
            $count = $r1[$t];
            $j = intval($r2[$t]);
            if ($count == 1) {
                $r4[] = $j;
            } elseif ($count == 2) {
                $r3[] = $j;
            } elseif ($count == 3) {
                $r3[] = $j;
                $r4[] = $j;
            } elseif ($count == 4) {
                $r3[] = $j * $j;
            } elseif ($count == 5) {
                $r3[] = $j * $j;
                $r4[] = $j;
            } elseif ($count == 6) {
                $r3[] = $j * $j * $j;
            } elseif ($count == 7) {
                $r3[] = $j * $j * $j;
                $r4[] = $j;
            } elseif ($count == 8) {
                $r3[] = $j * $j * $j * $j;
            } elseif ($count == 9) {
                $r3[] = $j * $j * $j * $j;
                $r4[] = $j;
            } elseif ($count == 10) {
                $r3[] = $j * $j * $j * $j * $j;
            } elseif ($count == 11) {
                $r3[] = $j * $j * $j * $j * $j;
                $r4[] = $j;
            } elseif ($count == 12) {
                $r3[] = $j * $j * $j * $j * $j * $j;
            } elseif ($count == 13) {
                $r3[] = $j * $j * $j * $j * $j * $j;
                $r4[] = $j;
            } elseif ($count == 14) {
                $r3[] = $j * $j * $j * $j * $j * $j * $j;
            } elseif ($count == 15) {
                $r3[] = $j * $j * $j * $j * $j * $j * $j;
                $r4[] = $j;
            } elseif ($count == 16) {
                $r3[] = $j * $j * $j * $j * $j * $j * $j * $j;
            } elseif ($count == 17) {
                $r3[] = $j * $j * $j * $j * $j * $j * $j * $j;
                $r4[] = $j;
            } elseif ($count == 18) {
                $r3[] = $j * $j * $j * $j * $j * $j * $j * $j * $j;
            } elseif ($count == 19) {
                $r3[] = $j * $j * $j * $j * $j * $j * $j * $j * $j;
                $r4[] = $j;
            } elseif ($count == 20) {
                $r3[] = $j * $j * $j * $j * $j * $j * $j * $j * $j * $j;
            } elseif ($count == 21) {
                $r3[] = $j * $j * $j * $j;
                $r4[] = $j;
            }
        }
        $p = 1;
        $p1 = 1;
        foreach ($r4 as $val) {
            if ($val) $p *= $val;
        }
        foreach ($r3 as $val) {
            if ($val) $p1 *= $val;
        }
        return [$p1, $p];
    }

    public function calculate()
    {
        $request = (object)[
            'selection' => $this->selection,
            'd1' => $this->d1,
            'second_value' => $this->second_value,
            'n2' => $this->n2,
            'c1' => $this->c1,
            'c2' => $this->c2,
        ];

        $model = new Math();
        $result = $model->ellipse($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if ($this->selection == '1') {
                $upr = $result['upr'];
                $btm = $result['btm'];
                $upr1 = $result['upr1'];
                $btm1 = $result['btm1'];

                $w = $this->simplifyExpression($upr);
                $x = $this->simplifyExpression($btm);
                $y = $this->simplifyExpression($upr1);
                $z = $this->simplifyExpression($btm1);

                $first_value = $upr / $btm;
                $second_value = $upr1 / $btm1;

                $value_a = 0.0;
                $value_b = 0.0;
                $sheikh = '';
                $sheikh2 = '';

                $print_a = '';
                $print_b = '';
                $first_vertex = '';
                $second_vertex = '';
                $x_intercepts = '';
                $domain = '';
                $major_axis = '';
                $semi_major_axis = '';
                $first_co_vertex = '';
                $second_co_vertex = '';
                $minor_axis = '';
                $semi_minor_axis = '';
                $y_intercepts = '';
                $range = '';
                $linear_eccentricity = '';
                $eccentricity = '';
                $first_latus_rectum = '';
                $second_latus_rectum = '';
                $first_focus = '';
                $second_focus = '';
                $area = '';
                $first_directix = '';
                $second_directix = '';
                $latera_recta = '';
                $circumference = '';
                $focal_parameter = '';

                // Solve for a (using w and x)
                if ($w[0] == 1 && $w[1] != 1) {
                    $n = $btm;
                    if (ceil(sqrt($n)) == floor(sqrt($n))) {
                        $sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "}\\Bigg)^2}";
                        $print_a = "a=\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "}";
                        $divide = (sqrt($w[1])) / $x[0];
                        $value_a = $divide;
                        if ($first_value > $second_value) {
                            $first_vertex = "\\Bigg(-\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($divide, 5, '.', '') . ",0\\Bigg)";
                            $second_vertex = "\\Bigg(\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($divide, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($divide, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($divide, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "},\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "}\\right]≈\\left[-" . number_format($divide, 5, '.', '') . "," . number_format($divide, 5, '.', '') . "\\right]";
                            $major_axis = "2a=\\dfrac{2\\sqrt{" . $w[1] . "}}{" . $x[0] . "}≈" . number_format(2 * $divide, 5, '.', '') . "";
                            $semi_major_axis = "=\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "}≈" . number_format($divide, 5, '.', '') . "";
                        } else {
                            $first_co_vertex = "\\Bigg(-\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($divide, 5, '.', '') . ",0\\Bigg)";
                            $second_co_vertex = "\\Bigg(\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($divide, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($divide, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($divide, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "},\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "}\\right]≈\\left[-" . number_format($divide, 5, '.', '') . "," . number_format($divide, 5, '.', '') . "\\right]";
                            $minor_axis = "2a=\\dfrac{2\\sqrt{" . $w[1] . "}}{" . $x[0] . "}≈" . number_format(2 * $divide, 5, '.', '') . "";
                            $semi_minor_axis = "=\\dfrac{\\sqrt{" . $w[1] . "}}{" . $x[0] . "}≈" . number_format($divide, 5, '.', '') . "";
                        }
                    } else {
                        $sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "}\\Bigg)^2}";
                        $value_a = (sqrt($w[1] * $x[1])) / ($x[0] * $x[1]);
                        $print_a = "a=\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "}";
                        $tree = $value_a;
                        if ($first_value > $second_value) {
                            $first_vertex = "\\Bigg(-\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(-" . number_format($tree, 5, '.', '') . ",0\\Bigg)";
                            $second_vertex = "\\Bigg(\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(" . number_format($tree, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(-" . number_format($tree, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(" . number_format($tree, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "},\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "}\\right]≈\\left[-" . number_format($tree, 5, '.', '') . "," . number_format($tree, 5, '.', '') . "\\right]";
                            $major_axis = "2a=\\dfrac{2\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "}≈" . number_format($tree * 2, 5, '.', '') . "";
                            $semi_major_axis = "\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "}≈" . number_format($tree, 5, '.', '') . "";
                        } else {
                            $first_co_vertex = "\\Bigg(-\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(-" . number_format($tree, 5, '.', '') . ",0\\Bigg)";
                            $second_co_vertex = "\\Bigg(\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(" . number_format($tree, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(-" . number_format($tree, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(" . number_format($tree, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "},\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "}\\right]≈\\left[-" . number_format($tree, 5, '.', '') . "," . number_format($tree, 5, '.', '') . "\\right]";
                            $minor_axis = "2a=\\dfrac{2\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "}≈" . number_format($tree * 2, 5, '.', '') . "";
                            $semi_minor_axis = "\\dfrac{\\sqrt{" . ($w[1] * $x[1]) . "}}{" . ($x[0] * $x[1]) . "}≈" . number_format($tree, 5, '.', '') . "";
                        }
                    }
                } elseif ($w[0] != 1 && $w[1] == 1) {
                    $divide = $w[0] / $x[0];
                    $n = $btm;
                    $value_a = $divide;
                    if (ceil(sqrt($n)) == floor(sqrt($n))) {
                        $sheikh = "\\dfrac{x^2}{\\Bigg(" . $divide . "\\Bigg)^2}";
                        if ($first_value > $second_value) {
                            $print_a = "a=" . $divide;
                            $first_vertex = "\\Bigg(-" . $divide . ",0\\Bigg)";
                            $second_vertex = "\\Bigg(" . $divide . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-" . $divide . ",0\\Bigg), \\Bigg(" . $divide . ",0\\Bigg)";
                            $domain = "\\left[-" . $divide . "," . $divide . "\\right]";
                            $major_axis = "2a=" . ($divide * 2);
                            $semi_major_axis = "" . $divide;
                        } else {
                            $print_a = "a=" . $divide;
                            $first_co_vertex = "\\Bigg(-" . $divide . ",0\\Bigg)";
                            $second_co_vertex = "\\Bigg(" . $divide . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-" . $divide . ",0\\Bigg), \\Bigg(" . $divide . ",0\\Bigg)";
                            $domain = "\\left[-" . $divide . "," . $divide . "\\right]";
                            $minor_axis = "2a=" . ($divide * 2);
                            $semi_minor_axis = "" . $divide;
                        }
                    } else {
                        $sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . ($x[1] * $x[0]) . "}\\Bigg)^2}";
                        $value_a = ($w[0] * (sqrt($x[1]))) / ($x[1] * $x[0]);
                        $print_a = "a=\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . ($x[1] * $x[0]) . "}";
                        $first_vertex_val = ($w[0] * sqrt($x[1])) / $x[1];
                        if ($first_value > $second_value) {
                            $first_vertex = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(-" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                            $second_vertex = "\\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(-" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "},\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "}\\right]≈\\left[-" . number_format($first_vertex_val, 5, '.', '') . "," . number_format($first_vertex_val, 5, '.', '') . "\\right]";
                            $major_axis = "2a=\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . ($x[1] / 2) . "}≈" . number_format($first_vertex_val * 2, 5, '.', '') . "";
                            $semi_major_axis = "\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "}≈" . number_format($first_vertex_val, 5, '.', '') . "";
                        } else {
                            $first_co_vertex = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(-" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                            $second_co_vertex = "\\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(-" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "},\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "}\\right]≈\\left[-" . number_format($first_vertex_val, 5, '.', '') . "," . number_format($first_vertex_val, 5, '.', '') . "\\right]";
                            $minor_axis = "2a=\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . ($x[1] / 2) . "}≈" . number_format($first_vertex_val * 2, 5, '.', '') . "";
                            $semi_minor_axis = "\\dfrac{" . $w[0] . "\\sqrt{" . $x[1] . "}}{" . $x[1] . "}≈" . number_format($first_vertex_val, 5, '.', '') . "";
                        }
                    }
                } elseif ($w[0] == 1 && $w[1] == 1) {
                    $n = $btm;
                    if (ceil(sqrt($n)) == floor(sqrt($n))) {
                        $sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{" . $w[0] . "}{" . $x[0] . "}\\Bigg)^2}";
                        $value_a = $w[0] / $x[0];
                        $print_a = "a=\\dfrac{" . $w[0] . "}{" . $x[0] . "}";
                        $first_vertex_val = $w[0] / $x[0];
                        if ($first_value > $second_value) {
                            $first_vertex = "\\Bigg(-\\dfrac{" . $w[0] . "}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                            $second_vertex = "\\Bigg(\\dfrac{" . $w[0] . "}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                            $major_axis = "2a=\\dfrac{2\\cdot" . $w[0] . "}{" . $x[0] . "}=" . number_format(2 * $first_vertex_val, 5, '.', '') . "";
                            $semi_major_axis = "=\\dfrac{" . $w[0] . "}{" . $x[0] . "}=" . number_format($first_vertex_val, 5, '.', '') . "";
                            $domain = "\\left[-\\dfrac{" . $w[0] . "}{" . $x[0] . "},\\dfrac{" . $w[0] . "}{" . $x[0] . "}\\right]≈\\left[-" . number_format($first_vertex_val, 5, '.', '') . "," . number_format($first_vertex_val, 5, '.', '') . "\\right]";
                            $x_intercepts = "\\Bigg(-\\dfrac{" . $w[0] . "}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{" . $w[0] . "}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                        } else {
                            $minor_axis = "2a=\\dfrac{2\\cdot" . $w[0] . "}{" . $x[0] . "}=" . number_format(2 * $first_vertex_val, 5, '.', '') . "";
                            $semi_minor_axis = "=\\dfrac{" . $w[0] . "}{" . $x[0] . "}=" . number_format($first_vertex_val, 5, '.', '') . "";
                            $first_co_vertex = "\\Bigg(-\\dfrac{" . $w[0] . "}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                            $second_co_vertex = "\\Bigg(\\dfrac{" . $w[0] . "}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{" . $w[0] . "}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{" . $w[0] . "}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($first_vertex_val, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{" . $w[0] . "}{" . $x[0] . "},\\dfrac{" . $w[0] . "}{" . $x[0] . "}\\right]≈\\left[-" . number_format($first_vertex_val, 5, '.', '') . "," . number_format($first_vertex_val, 5, '.', '') . "\\right]";
                        }
                    } else {
                        $sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "}\\Bigg)^2}";
                        $value_a = (sqrt($x[1])) / ($x[0] * $x[1]);
                        $print_a = "a=\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "}";
                        $dividing = ((sqrt($x[1])) / (($x[0] * $x[1]) / 2));
                        if ($first_value > $second_value) {
                            $major_axis = "=\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1] / 2) . "}≈" . number_format($dividing, 5, '.', '') . "";
                            $semi_major_axis = "=\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "}≈" . number_format($dividing / 2, 5, '.', '') . "";
                            $x_intercepts = "\\Bigg(-\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(-" . number_format($dividing, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(" . number_format($dividing, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "},\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "}\\right]≈\\left[-" . number_format($dividing, 5, '.', '') . "," . number_format($dividing, 5, '.', '') . "\\right]";
                        } else {
                            $minor_axis = "=\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1] / 2) . "}≈" . number_format($dividing, 5, '.', '') . "";
                            $semi_minor_axis = "=\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "}≈" . number_format($dividing / 2, 5, '.', '') . "";
                            $first_co_vertex = "\\Bigg(-\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(-" . number_format($dividing / 2, 5, '.', '') . ",0\\Bigg)";
                            $second_co_vertex = "\\Bigg(\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(" . number_format($dividing / 2, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(-" . number_format($dividing, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "},0\\Bigg)≈\\Bigg(" . number_format($dividing, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "},\\dfrac{\\sqrt{" . $x[1] . "}}{" . ($x[0] * $x[1]) . "}\\right]≈\\left[-" . number_format($dividing, 5, '.', '') . "," . number_format($dividing, 5, '.', '') . "\\right]";
                        }
                    }
                } elseif ($w[0] != 1 && $w[1] != 1) {
                    $n = $btm;
                    if (ceil(sqrt($n)) == floor(sqrt($n))) {
                        $sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "}\\Bigg)^2}";
                        $zain = ($w[0]) * (sqrt($w[1])) / $x[0];
                        $value_a = $zain;
                        $print_a = "a=\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "}";
                        if ($first_value > $second_value) {
                            $first_vertex = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($zain, 5, '.', '') . ",0\\Bigg)";
                            $second_vertex = "\\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($zain, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($zain, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($zain, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "},\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "}\\right]≈\\left[-" . number_format($zain, 5, '.', '') . "," . number_format($zain, 5, '.', '') . "\\right]";
                        } else {
                            $first_co_vertex = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($zain, 5, '.', '') . ",0\\Bigg)";
                            $second_co_vertex = "\\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($zain, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(-" . number_format($zain, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "},0\\Bigg)≈\\Bigg(" . number_format($zain, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "},\\dfrac{" . $w[0] . "\\sqrt{" . $w[1] . "}}{" . $x[0] . "}\\right]≈\\left[-" . number_format($zain, 5, '.', '') . "," . number_format($zain, 5, '.', '') . "\\right]";
                        }
                    } else {
                        $sheikh = "\\dfrac{x^2}{\\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "}\\Bigg)^2}";
                        $value_a = ($w[0] * sqrt($w[1] * $x[1])) / $x[1];
                        $print_a = "a=\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "}";
                        $calculate_second_vertex = $value_a;
                        if ($first_value > $second_value) {
                            $first_vertex = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(-" . number_format($calculate_second_vertex, 5, '.', '') . ",0\\Bigg)";
                            $second_vertex = "\\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(" . number_format($calculate_second_vertex, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(-" . number_format($calculate_second_vertex, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(" . number_format($calculate_second_vertex, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "},\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "}\\right]≈\\left[-" . number_format($calculate_second_vertex, 5, '.', '') . "," . number_format($calculate_second_vertex, 5, '.', '') . "\\right]";
                            $major_axis = "2a=\\dfrac{" . ($w[0] * 2) . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "}≈" . number_format($calculate_second_vertex * 2, 5, '.', '') . "";
                            $semi_major_axis = "\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "}≈" . number_format($calculate_second_vertex, 5, '.', '') . "";
                        } else {
                            $first_co_vertex = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(-" . number_format($calculate_second_vertex, 5, '.', '') . ",0\\Bigg)";
                            $second_co_vertex = "\\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(" . number_format($calculate_second_vertex, 5, '.', '') . ",0\\Bigg)";
                            $x_intercepts = "\\Bigg(-\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(-" . number_format($calculate_second_vertex, 5, '.', '') . ",0\\Bigg), \\Bigg(\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "},0\\Bigg)≈\\Bigg(" . number_format($calculate_second_vertex, 5, '.', '') . ",0\\Bigg)";
                            $domain = "\\left[-\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "},\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "}\\right]≈\\left[-" . number_format($calculate_second_vertex, 5, '.', '') . "," . number_format($calculate_second_vertex, 5, '.', '') . "\\right]";
                            $minor_axis = "2b=\\dfrac{" . ($w[0] * 2) . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "}≈" . number_format($calculate_second_vertex * 2, 5, '.', '') . "";
                            $semi_minor_axis = "\\dfrac{" . $w[0] . "\\sqrt{" . ($w[1] * $x[1]) . "}}{" . $x[1] . "}≈" . number_format($calculate_second_vertex, 5, '.', '') . "";
                        }
                    }
                }

                // Solve for b (using y and z)
                if ($y[0] == 1 && $y[1] != 1) {
                    $n = $btm1;
                    if (ceil(sqrt($n)) == floor(sqrt($n))) {
                        $sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)^2}";
                        $print_b = "b=\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}";
                        $divide = (sqrt($y[1])) / $z[0];
                        $value_b = $divide;
                        if ($second_value > $first_value) {
                            $first_vertex = "\\Bigg(0,-\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈\\Bigg(0,-" . number_format($divide, 5, '.', '') . "\\Bigg)";
                            $second_vertex = "\\Bigg(0,\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈\\Bigg(0," . number_format($divide, 5, '.', '') . "\\Bigg)";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈\\Bigg(0,-" . number_format($divide, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈\\Bigg(0," . number_format($divide, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "},\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\right]≈\\left[-" . number_format($divide, 5, '.', '') . "," . number_format($divide, 5, '.', '') . "\\right]";
                            $major_axis = "2a=\\dfrac{2\\sqrt{" . $y[1] . "}}{" . $z[0] . "}≈" . number_format(2 * $divide, 5, '.', '') . "";
                            $semi_major_axis = "=\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}≈" . number_format($divide, 5, '.', '') . "";
                        } else {
                            $first_co_vertex = "\\Bigg(0,-\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈\\Bigg(0,-" . number_format($divide, 5, '.', '') . "\\Bigg)";
                            $second_co_vertex = "\\Bigg(0,\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈\\Bigg(0," . number_format($divide, 5, '.', '') . "\\Bigg)";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈\\Bigg(0,-" . number_format($divide, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈\\Bigg(0," . number_format($divide, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "},\\dfrac{\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\right]≈\\left[-" . number_format($divide, 5, '.', '') . "," . number_format($divide, 5, '.', '') . "\\right]";
                            $minor_axis = "2a=\\dfrac{2\\sqrt{" . $y[1] . "}}{" . $z[0] . "}≈" . number_format(2 * $divide, 5, '.', '') . "";
                            $semi_minor_axis = "=\\dfrac{2\\sqrt{" . $y[1] . "}}{" . $z[0] . "}≈" . number_format($divide, 5, '.', '') . "";
                        }
                    } else {
                        $sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)^2}";
                        $value_b = (sqrt($y[1] * $z[1])) / ($z[0] * $z[1]);
                        $print_b = "b=\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}";
                        $tree = $value_b;
                        if ($second_value > $first_value) {
                            $first_vertex = "\\Bigg(0,-\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0,-" . number_format($tree, 5, '.', '') . "\\Bigg)";
                            $second_vertex = "\\Bigg(0,\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0," . number_format($tree, 5, '.', '') . "\\Bigg)";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0,-" . number_format($tree, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0," . number_format($tree, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "},\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}\\right]≈\\left[-" . number_format($tree, 5, '.', '') . "," . number_format($tree, 5, '.', '') . "\\right]";
                            $major_axis = "2a=\\dfrac{2\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1] / 2) . "}≈" . number_format($tree * 2, 5, '.', '') . "";
                            $semi_major_axis = "\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}≈" . number_format($tree, 5, '.', '') . "";
                        } else {
                            $first_co_vertex = "\\Bigg(0,-\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0,-" . number_format($tree, 5, '.', '') . "\\Bigg)";
                            $second_co_vertex = "\\Bigg(0,\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0," . number_format($tree, 5, '.', '') . "\\Bigg)";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0,-" . number_format($tree, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0," . number_format($tree, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "},\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}\\right]≈\\left[-" . number_format($tree, 5, '.', '') . "," . number_format($tree, 5, '.', '') . "\\right]";
                            $minor_axis = "2a=\\dfrac{2\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1] / 2) . "}≈" . number_format($tree * 2, 5, '.', '') . "";
                            $semi_minor_axis = "\\dfrac{\\sqrt{" . ($y[1] * $z[1]) . "}}{" . ($z[0] * $z[1]) . "}≈" . number_format($tree, 5, '.', '') . "";
                        }
                    }
                } elseif ($y[0] != 1 && $y[1] == 1) {
                    $n = $btm1;
                    $value_b = $y[0] / $z[0];
                    if (ceil(sqrt($n)) == floor(sqrt($n))) {
                        $divide = $y[0] / $z[0];
                        $sheikh2 = "\\dfrac{y^2}{\\Bigg(" . $divide . "\\Bigg)^2}";
                        if ($second_value > $first_value) {
                            $print_b = "b=" . $divide;
                            $first_vertex = "\\Bigg(0,-" . $divide . "\\Bigg)";
                            $second_vertex = "\\Bigg(0," . $divide . "\\Bigg)";
                            $y_intercepts = "\\Bigg(0,-" . $divide . "\\Bigg), \\Bigg(0," . $divide . "\\Bigg)";
                            $range = "\\left[-" . $divide . "," . $divide . "\\right]";
                            $major_axis = "2a=" . ($divide * 2);
                            $semi_major_axis = "" . $divide;
                        } else {
                            $print_b = "b=" . $divide;
                            $first_co_vertex = "\\Bigg(0,-" . $divide . "\\Bigg)";
                            $second_co_vertex = "\\Bigg(0," . $divide . "\\Bigg)";
                            $y_intercepts = "\\Bigg(0,-" . $divide . "\\Bigg), \\Bigg(0," . $divide . "\\Bigg)";
                            $range = "\\left[-" . $divide . "," . $divide . "\\right]";
                            $minor_axis = "2a=" . ($divide * 2);
                            $semi_minor_axis = "" . $divide;
                        }
                    } else {
                        $sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . ($z[1] * $z[0]) . "}\\Bigg)^2}";
                        $value_b = ($y[0] * (sqrt($z[1]))) / ($z[1] * $z[0]);
                        $print_b = "b=\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . ($z[1] * $z[0]) . "}";
                        $first_vertex_val = ($y[0] * sqrt($z[1])) / $z[1];
                        if ($second_value > $first_value) {
                            $first_vertex = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0,-" . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $second_vertex = "\\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0," . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0,-" . number_format($first_vertex_val, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0," . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "},\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}\\right]≈\\left[-" . number_format($first_vertex_val, 5, '.', '') . "," . number_format($first_vertex_val, 5, '.', '') . "\\right]";
                            $major_axis = "2a=\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . ($z[1] / 2) . "}≈" . number_format($first_vertex_val * 2, 5, '.', '') . "";
                            $semi_major_axis = "\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}≈" . number_format($first_vertex_val, 5, '.', '') . "";
                        } else {
                            $first_co_vertex = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0,-" . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $second_co_vertex = "\\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0," . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0,-" . number_format($first_vertex_val, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0," . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "},\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}\\right]≈\\left[-" . number_format($first_vertex_val, 5, '.', '') . "," . number_format($first_vertex_val, 5, '.', '') . "\\right]";
                            $minor_axis = "2a=\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . ($z[1] / 2) . "}≈" . number_format($first_vertex_val * 2, 5, '.', '') . "";
                            $semi_minor_axis = "\\dfrac{" . $y[0] . "\\sqrt{" . $z[1] . "}}{" . $z[1] . "}≈" . number_format($first_vertex_val, 5, '.', '') . "";
                        }
                    }
                } elseif ($y[0] == 1 && $y[1] == 1) {
                    $n = $btm1;
                    if (ceil(sqrt($n)) == floor(sqrt($n))) {
                        $sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{" . $y[0] . "}{" . $z[0] . "}\\Bigg)^2}";
                        $value_b = $y[0] / $z[0];
                        $print_b = "b=\\dfrac{" . $y[0] . "}{" . $z[0] . "}";
                        $first_vertex_val = $y[0] / $z[0];
                        if ($second_value > $first_value) {
                            $first_vertex = "\\Bigg(0,-\\dfrac{" . $y[0] . "}{" . $z[0] . "}\\Bigg)≈\\Bigg(0,-" . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $second_vertex = "\\Bigg(0,\\dfrac{" . $y[0] . "}{" . $z[0] . "}\\Bigg)≈\\Bigg(0," . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $major_axis = "=\\dfrac{" . (2 * $y[0]) . "}{" . $z[0] . "}≈" . number_format(2 * $first_vertex_val, 5, '.', '') . "";
                            $semi_major_axis = "=\\dfrac{" . $y[0] . "}{" . $z[0] . "}≈" . number_format($first_vertex_val, 5, '.', '') . "";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{" . $y[0] . "}{" . $z[0] . "}\\Bigg)≈\\Bigg(0,-" . number_format($first_vertex_val, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{" . $y[0] . "}{" . $z[0] . "}\\Bigg)≈\\Bigg(0," . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{" . $y[0] . "}{" . $z[0] . "},\\dfrac{" . $y[0] . "}{" . $z[0] . "}\\right]≈\\left[-" . number_format($first_vertex_val, 5, '.', '') . "," . number_format($first_vertex_val, 5, '.', '') . "\\right]";
                        } else {
                            $first_co_vertex = "\\Bigg(0,-\\dfrac{" . $y[0] . "}{" . $z[0] . "}\\Bigg)≈\\Bigg(0,-" . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $second_co_vertex = "\\Bigg(0,\\dfrac{" . $y[0] . "}{" . $z[0] . "}\\Bigg)≈\\Bigg(0," . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{" . $y[0] . "}{" . $z[0] . "}\\Bigg)≈\\Bigg(0,-" . number_format($first_vertex_val, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{" . $y[0] . "}{" . $z[0] . "}\\Bigg)≈\\Bigg(0," . number_format($first_vertex_val, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{" . $y[0] . "}{" . $z[0] . "},\\dfrac{" . $y[0] . "}{" . $z[0] . "}\\right]≈\\left[-" . number_format($first_vertex_val, 5, '.', '') . "," . number_format($first_vertex_val, 5, '.', '') . "\\right]";
                        }
                    } else {
                        $sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)^2}";
                        $value_b = (sqrt($z[1])) / ($z[0] * $z[1]);
                        $print_b = "b=\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}";
                        $dividing = ((sqrt($z[1])) / (($z[0] * $z[1]) / 2));
                        if ($second_value > $first_value) {
                            $first_vertex = "\\Bigg(0,-\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0,-" . number_format($dividing, 5, '.', '') . "\\Bigg)";
                            $second_vertex = "\\Bigg(0,\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0," . number_format($dividing, 5, '.', '') . "\\Bigg)";
                            $major_axis = "=\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1] / 2) . "}≈" . number_format($dividing, 5, '.', '') . "";
                            $semi_major_axis = "=\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}≈" . number_format($dividing / 2, 5, '.', '') . "";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0,-" . number_format($dividing, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0," . number_format($dividing, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "},\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}\\right]≈\\left[-" . number_format($dividing, 5, '.', '') . "," . number_format($dividing, 5, '.', '') . "\\right]";
                        } else {
                            $first_co_vertex = "\\Bigg(0,-\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈-" . number_format($dividing / 2, 5, '.', '') . "";
                            $second_co_vertex = "\\Bigg(0,\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈" . number_format($dividing / 2, 5, '.', '') . "";
                            $minor_axis = "=\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1] / 2) . "}≈" . number_format($dividing, 5, '.', '') . "";
                            $semi_minor_axis = "=\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}≈" . number_format($dividing / 2, 5, '.', '') . "";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0,-" . number_format($dividing, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}\\Bigg)≈\\Bigg(0," . number_format($dividing, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "},\\dfrac{\\sqrt{" . $z[1] . "}}{" . ($z[0] * $z[1]) . "}\\right]≈\\left[-" . number_format($dividing, 5, '.', '') . "," . number_format($dividing, 5, '.', '') . "\\right]";
                        }
                    }
                } elseif ($y[0] != 1 && $y[1] != 1) {
                    $n = $btm1;
                    if (ceil(sqrt($n)) == floor(sqrt($n))) {
                        $sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)^2}";
                        $zain = ($y[0]) * (sqrt($y[1])) / $z[0];
                        $value_b = $zain;
                        $print_b = "b=\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}";
                        if ($second_value > $first_value) {
                            $first_vertex = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈-" . number_format($zain, 5, '.', '') . "";
                            $second_vertex = "\\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈" . number_format($zain, 5, '.', '') . "";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈-" . number_format($zain, 5, '.', '') . ", \\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈" . number_format($zain, 5, '.', '') . "";
                            $range = "\\left[-\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "},\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\right]≈\\left[-" . number_format($zain, 5, '.', '') . "," . number_format($zain, 5, '.', '') . "\\right]";
                        } else {
                            $first_co_vertex = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈-" . number_format($zain, 5, '.', '') . "";
                            $second_co_vertex = "\\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈" . number_format($zain, 5, '.', '') . "";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈-" . number_format($zain, 5, '.', '') . ", \\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\Bigg)≈" . number_format($zain, 5, '.', '') . "";
                            $range = "\\left[-\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "},\\dfrac{" . $y[0] . "\\sqrt{" . $y[1] . "}}{" . $z[0] . "}\\right]≈\\left[-" . number_format($zain, 5, '.', '') . "," . number_format($zain, 5, '.', '') . "\\right]";
                        }
                    } else {
                        $sheikh2 = "\\dfrac{y^2}{\\Bigg(\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}\\Bigg)^2}";
                        $value_b = ($y[0] * (sqrt($y[1] * $z[1]))) / $z[1];
                        $print_b = "b=\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}";
                        $calculate_second_vertex = $value_b;
                        if ($second_value > $first_value) {
                            $first_vertex = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0,-" . number_format($calculate_second_vertex, 5, '.', '') . "\\Bigg)";
                            $second_vertex = "\\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0," . number_format($calculate_second_vertex, 5, '.', '') . "\\Bigg)";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0,-" . number_format($calculate_second_vertex, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0," . number_format($calculate_second_vertex, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "},\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}\\right]≈\\left[-" . number_format($calculate_second_vertex, 5, '.', '') . "," . number_format($calculate_second_vertex, 5, '.', '') . "\\right]";
                            $major_axis = "2a=\\dfrac{" . ($y[0] * 2) . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}≈" . number_format($calculate_second_vertex * 2, 5, '.', '') . "";
                            $semi_major_axis = "\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}≈" . number_format($calculate_second_vertex, 5, '.', '') . "";
                        } else {
                            $first_co_vertex = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0,-" . number_format($calculate_second_vertex, 5, '.', '') . "\\Bigg)";
                            $second_co_vertex = "\\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0," . number_format($calculate_second_vertex, 5, '.', '') . "\\Bigg)";
                            $y_intercepts = "\\Bigg(0,-\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0,-" . number_format($calculate_second_vertex, 5, '.', '') . "\\Bigg), \\Bigg(0,\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}\\Bigg)≈\\Bigg(0," . number_format($calculate_second_vertex, 5, '.', '') . "\\Bigg)";
                            $range = "\\left[-\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "},\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}\\right]≈\\left[-" . number_format($calculate_second_vertex, 5, '.', '') . "," . number_format($calculate_second_vertex, 5, '.', '') . "\\right]";
                            $minor_axis = "2b=\\dfrac{" . ($y[0] * 2) . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}≈" . number_format($calculate_second_vertex * 2, 5, '.', '') . "";
                            $semi_minor_axis = "\\dfrac{" . $y[0] . "\\sqrt{" . ($y[1] * $z[1]) . "}}{" . $z[1] . "}≈" . number_format($calculate_second_vertex, 5, '.', '') . "";
                        }
                    }
                }

                $standard_form = "$$" . $sheikh . "+" . $sheikh2 . "=1$$";

                if ($first_value > $second_value) {
                    $d = (($value_a * $value_a) - ($value_b * $value_b));
                    $ecc = $value_a != 0 ? sqrt(abs($d)) / $value_a : 0;
                    $linear_eccentricity = "\$\$=\\sqrt{\\mathstrut a^2-b^2} = \\sqrt{\\mathstrut(" . number_format($value_a, 5, '.', '') . ")^{2} - (" . number_format($value_b, 5, '.', '') . ")^{2}} = \\sqrt{\\mathstrut" . number_format($value_a * $value_a, 5, '.', '') . "-" . number_format($value_b * $value_b, 5, '.', '') . "} = \\sqrt{\\mathstrut" . number_format($d, 5, '.', '') . "} ≈" . number_format(sqrt(abs($d)), 5, '.', '') . "\$\$";
                    $eccentricity = "\$\$=\\dfrac{c}{b} = \\dfrac{" . number_format(sqrt(abs($d)), 5, '.', '') . "}{" . number_format($value_a, 5, '.', '') . "} ≈" . number_format($ecc, 5, '.', '') . "\$\$";
                    $first_latus_rectum = "\$\$≈-" . number_format(sqrt(abs($d)), 5, '.', '') . "\$\$";
                    $second_latus_rectum = "\$\$≈-" . number_format(sqrt(abs($d)), 5, '.', '') . "\$\$";
                    $first_focus = "\$\$\\Bigg(≈-" . number_format(sqrt(abs($d)), 5, '.', '') . ",0\\Bigg)\$\$";
                    $second_focus = "\$\$\\Bigg(≈" . number_format(sqrt(abs($d)), 5, '.', '') . ",0\\Bigg)\$\$";
                    $area = "\$\$≈\\pi ab ≈ \\pi\\cdot" . number_format($value_a, 5, '.', '') . "\\cdot" . number_format($value_b, 5, '.', '') . " ≈ " . number_format(3.14 * $value_a * $value_b, 5, '.', '') . "\$\$";
                    $first_directix = $d != 0 ? "\$\$k-\\dfrac{a^2}{c} ≈ \\dfrac{0-(" . number_format($value_a * $value_a, 5, '.', '') . ")}{" . number_format(sqrt(abs($d)), 5, '.', '') . "} ≈" . number_format((0 - ($value_a * $value_a)) / sqrt(abs($d)), 5, '.', '') . "\$\$" : "\$\$0\$\$";
                    $second_directix = $d != 0 ? "\$\$k+\\dfrac{a^2}{c} ≈ \\dfrac{0+(" . number_format($value_a * $value_a, 5, '.', '') . ")}{" . number_format(sqrt(abs($d)), 5, '.', '') . "} ≈" . number_format(($value_a * $value_a) / sqrt(abs($d)), 5, '.', '') . "\$\$" : "\$\$0\$\$";
                    $latera_recta = $value_a != 0 ? "\$\$=\\dfrac{2b^2}{a} ≈ \\dfrac{2\\cdot(" . number_format($value_b * $value_b, 5, '.', '') . ")}{" . number_format($value_a, 5, '.', '') . "} ≈" . number_format((2 * $value_b * $value_b) / $value_a, 5, '.', '') . "\$\$" : "$$0$$";
                    $circumference = "\$\$≈4\\cdot a\\cdot E\\Bigg(\\dfrac{\\pi}{2}|e^2\\Bigg) ≈" . number_format(4 * $value_a * exp(3.14 / 2), 5, '.', '') . "\$\$";
                    $focal_parameter = $d != 0 ? "\$\$=\\dfrac{b^2}{c} = \\dfrac{(" . number_format($value_b * $value_b, 5, '.', '') . ")}{" . number_format(sqrt(abs($d)), 5, '.', '') . "} ≈" . number_format(($value_b * $value_b) / sqrt(abs($d)), 5, '.', '') . "\$\$" : "\$\$0\$\$";
                    $calculation1 = $value_a;
                    $calculation2 = $value_b;
                } else {
                    $d = (($value_b * $value_b) - ($value_a * $value_a));
                    $ecc = $value_b != 0 ? sqrt(abs($d)) / $value_b : 0;
                    $linear_eccentricity = "\$\$=\\sqrt{\\mathstrut b^2-a^2} = \\sqrt{\\mathstrut(" . number_format($value_b, 5, '.', '') . ")^{2} - (" . number_format($value_a, 5, '.', '') . ")^{2}} = \\sqrt{\\mathstrut" . number_format($value_b * $value_b, 5, '.', '') . "-" . number_format($value_a * $value_a, 5, '.', '') . "} = \\sqrt{\\mathstrut" . number_format($d, 5, '.', '') . "} ≈" . number_format(sqrt(abs($d)), 5, '.', '') . "\$\$";
                    $eccentricity = "\$\$=\\dfrac{c^2}{b^2} = \\dfrac{" . number_format(sqrt(abs($d)), 5, '.', '') . "}{" . number_format($value_b, 5, '.', '') . "} ≈" . number_format($ecc, 5, '.', '') . "\$\$";
                    $first_latus_rectum = "\$\$≈-" . number_format(sqrt(abs($d)), 5, '.', '') . "\$\$";
                    $second_latus_rectum = "\$\$≈-" . number_format(sqrt(abs($d)), 5, '.', '') . "\$\$";
                    $first_focus = "\$\$≈\\Bigg(0,-" . number_format(sqrt(abs($d)), 5, '.', '') . "\\Bigg)\$\$";
                    $second_focus = "\$\$≈\\Bigg(0," . number_format(sqrt(abs($d)), 5, '.', '') . "\\Bigg)\\$\$";
                    $area = "\$\$≈\\pi ab ≈ \\pi\\cdot" . number_format($value_a, 5, '.', '') . "\\cdot" . number_format($value_b, 5, '.', '') . " ≈ " . number_format(3.14 * $value_a * $value_b, 5, '.', '') . "\$\$";
                    $first_directix = $d != 0 ? "\$\$k-\\dfrac{b^2}{c} ≈ \\dfrac{0-(" . number_format($value_b * $value_b, 5, '.', '') . ")}{" . number_format(sqrt(abs($d)), 5, '.', '') . "} ≈" . number_format((0 - ($value_b * $value_b)) / sqrt(abs($d)), 5, '.', '') . "\$\$" : "\$\$0\$\$";
                    $second_directix = $d != 0 ? "\$\$k+\\dfrac{b^2}{c} ≈ \\dfrac{0+(" . number_format($value_b * $value_b, 5, '.', '') . ")}{" . number_format(sqrt(abs($d)), 5, '.', '') . "} ≈" . number_format(($value_b * $value_b) / sqrt(abs($d)), 5, '.', '') . "\$\$" : "\$\$0\$\$";
                    $latera_recta = $value_b != 0 ? "\$\$=\\dfrac{2a^2}{b} ≈ \\dfrac{2\\cdot(" . number_format($value_a * $value_a, 5, '.', '') . ")}{" . number_format($value_b, 5, '.', '') . "} ≈" . number_format((2 * $value_a * $value_a) / $value_b, 5, '.', '') . "\$\$" : "\$\$0\$\$";
                    $circumference = "\$\$≈4\\cdot b\\cdot E\\Bigg(\\dfrac{\\pi}{2}|e^2\\Bigg) ≈" . number_format(4 * $value_b * exp(3.14 / 2), 5, '.', '') . "\$\$";
                    $focal_parameter = $d != 0 ? "\$\$=\\dfrac{a^2}{c} = \\dfrac{(" . number_format($value_a * $value_a, 5, '.', '') . ")}{" . number_format(sqrt(abs($d)), 5, '.', '') . "} ≈" . number_format(($value_a * $value_a) / sqrt(abs($d)), 5, '.', '') . "\$\$" : "\$\$0\$\$";
                    $calculation1 = $value_b;
                    $calculation2 = $value_a;
                }

                $result['print_a'] = "\$\$ " . $print_a . " \$\$";
                $result['print_b'] = "\$\$ " . $print_b . " \$\$";
                $result['standard_form'] = $standard_form;
                $result['linear_eccentricity'] = $linear_eccentricity;
                $result['eccentricity'] = $eccentricity;
                $result['first_vertex'] = "\$\$" . $first_vertex . "\$\$";
                $result['second_vertex'] = "\$\$" . $second_vertex . "\$\$";
                $result['first_co_vertex'] = "\$\$" . $first_co_vertex . "\$\$";
                $result['second_co_vertex'] = "\$\$" . $second_co_vertex . "\$\$";
                $result['first_focus'] = $first_focus;
                $result['second_focus'] = $second_focus;
                $result['area_val'] = $area;
                $result['domain'] = "\$\$" . $domain . "\$\$";
                $result['range'] = "\$\$" . $range . "\$\$";
                $result['major_axis'] = $major_axis;
                $result['semi_major_axis'] = $semi_major_axis;
                $result['minor_axis'] = $minor_axis;
                $result['semi_minor_axis'] = $semi_minor_axis;
                $result['first_latus_rectum'] = $first_latus_rectum;
                $result['second_latus_rectum'] = $second_latus_rectum;
                $result['x_intercepts'] = "$$" . $x_intercepts . "$$";
                $result['y_intercepts'] = "$$" . $y_intercepts . "$$";
                $result['circumference'] = $circumference;
                $result['first_directix'] = $first_directix;
                $result['second_directix'] = $second_directix;
                $result['focal_parameter'] = $focal_parameter;
                $result['latera_recta'] = $latera_recta;
                $result['calculation1'] = $calculation1;
                $result['calculation2'] = $calculation2;
            }

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $calc1 = $result['calculation1'] ?? 0;
                $calc2 = $result['calculation2'] ?? 0;
                $this->js("
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
                        if (typeof window.drawEllipseGraph === 'function') {
                            window.drawEllipseGraph({$calc1}, {$calc2});
                        }
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
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $calc1 = $this->detail['calculation1'] ?? 0;
            $calc2 = $this->detail['calculation2'] ?? 0;
            $this->js("
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                    if (typeof MJrerender === 'function') MJrerender();
                    if (typeof window.drawEllipseGraph === 'function') {
                        window.drawEllipseGraph({$calc1}, {$calc2});
                    }
                }, 100);
            ");
        }
        return view('livewire.calculators.ellipse-equation-calculator');
    }
}
