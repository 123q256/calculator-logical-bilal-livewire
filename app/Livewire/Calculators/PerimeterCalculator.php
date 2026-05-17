<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class PerimeterCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $shape = '4'; // default to Circle
    public $given = '1';
    public $givena = '1';
    public $nbr = '5';
    public $r = '7';
    public $r_unit = 'm';
    public $b = '7';
    public $b_unit = 'm';
    public $c = '7';
    public $c_unit = 'm';
    public $d = '7';
    public $d_unit = 'm';
    public $angle = '7';
    public $angle_unit = 'deg';
    public $angleb = '7';
    public $angleb_unit = 'deg';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        $request = request();
        if ($request->has('shape')) { $this->shape = $request->shape; }
        if ($request->has('given')) { $this->given = $request->given; }
        if ($request->has('givena')) { $this->givena = $request->givena; }
        if ($request->has('nbr')) { $this->nbr = $request->nbr; }
        if ($request->has('r')) { $this->r = $request->r; }
        if ($request->has('r_unit')) { $this->r_unit = $request->r_unit; }
        if ($request->has('b')) { $this->b = $request->b; }
        if ($request->has('b_unit')) { $this->b_unit = $request->b_unit; }
        if ($request->has('c')) { $this->c = $request->c; }
        if ($request->has('c_unit')) { $this->c_unit = $request->c_unit; }
        if ($request->has('d')) { $this->d = $request->d; }
        if ($request->has('d_unit')) { $this->d_unit = $request->d_unit; }
        if ($request->has('angle')) { $this->angle = $request->angle; }
        if ($request->has('angle_unit')) { $this->angle_unit = $request->angle_unit; }
        if ($request->has('angleb')) { $this->angleb = $request->angleb; }
        if ($request->has('angleb_unit')) { $this->angleb_unit = $request->angleb_unit; }
    }

    public function updatedShape($value)
    {
        $this->detail = null;
        $this->error = null;
        $this->given = '1';
        $this->givena = '1';
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'shape') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function getFormConfigProperty()
    {
        $r_label = 'a';
        $b_label = 'b';
        $c_label = 'c';
        $d_label = 'd';
        $angle_label = 'Angle α';
        $angleb_label = 'Angle γ';

        $show_given = false;
        $show_givena = false;
        $show_nbr = false;
        $show_r = true;
        $show_b = false;
        $show_c = false;
        $show_d = false;
        $show_angle = false;
        $show_angleb = false;

        $img = 'circle.svg';

        switch ($this->shape) {
            case '1': // Square
                $r_label = 'a';
                $img = 'square.svg';
                break;
            case '2': // Rectangle
                $r_label = 'a';
                $b_label = 'b';
                $show_b = true;
                $img = 'rectangle.svg';
                break;
            case '3': // Triangle
                $show_given = true;
                $show_b = true;
                if ($this->given === '1') {
                    $r_label = 'a';
                    $b_label = 'b';
                    $c_label = 'c';
                    $show_c = true;
                    $img = 'triangle1.svg';
                } elseif ($this->given === '2') {
                    $r_label = 'a';
                    $b_label = 'b';
                    $angleb_label = 'Angle γ';
                    $show_angleb = true;
                    $img = 'triangle2.svg';
                } else {
                    $r_label = 'a';
                    $angle_label = 'Angle β';
                    $angleb_label = 'Angle γ';
                    $show_angle = true;
                    $show_angleb = true;
                    $show_b = false; // Hide side b
                    $img = 'triangle3.svg';
                }
                break;
            case '4': // Circle
                $r_label = 'r';
                $img = 'circle.svg';
                break;
            case '5': // Semicircle
                $r_label = 'r';
                $img = 'semicircle-p.svg';
                break;
            case '6': // Sector
                $r_label = 'r';
                $angle_label = 'Angle α';
                $show_angle = true;
                $img = 'sector.svg';
                break;
            case '7': // Ellipse
                $r_label = 'a';
                $b_label = 'b';
                $show_b = true;
                $img = 'ellipse.svg';
                break;
            case '8': // Trapezoid
                $r_label = 'a';
                $b_label = 'b';
                $c_label = 'c';
                $d_label = 'd';
                $show_b = true;
                $show_c = true;
                $show_d = true;
                $img = 'trapezoid.svg';
                break;
            case '9': // Parallelogram
                $show_givena = true;
                $show_b = true;
                if ($this->givena === '1') {
                    $r_label = 'a';
                    $b_label = 'b';
                    $img = 'parallelogram1.svg';
                } elseif ($this->givena === '2') {
                    $r_label = 'b';
                    $b_label = 'e';
                    $c_label = 'f';
                    $show_c = true;
                    $img = 'parallelogram2.svg';
                } else {
                    $r_label = 'b';
                    $b_label = 'h';
                    $angle_label = 'Angle α';
                    $show_angle = true;
                    $img = 'parallelogram3.svg';
                }
                break;
            case '10': // Rhombus
                $r_label = 'a';
                $img = 'rhombus1.svg';
                break;
            case '11': // Kite
                $r_label = 'a';
                $b_label = 'b';
                $show_b = true;
                $img = 'kite.svg';
                break;
            case '12': // Annulus
                $r_label = 'R';
                $b_label = 'r';
                $show_b = true;
                $img = 'annulus4.svg';
                break;
            case '13': // Polygon
                $r_label = 'a';
                $show_nbr = true;
                $img = 'polygon.svg';
                break;
        }

        return [
            'r_label' => $r_label,
            'b_label' => $b_label,
            'c_label' => $c_label,
            'd_label' => $d_label,
            'angle_label' => $angle_label,
            'angleb_label' => $angleb_label,
            'show_given' => $show_given,
            'show_givena' => $show_givena,
            'show_nbr' => $show_nbr,
            'show_r' => $show_r,
            'show_b' => $show_b,
            'show_c' => $show_c,
            'show_d' => $show_d,
            'show_angle' => $show_angle,
            'show_angleb' => $show_angleb,
            'img' => $img
        ];
    }

    public function resetForm()
    {
        $this->shape = '4';
        $this->given = '1';
        $this->givena = '1';
        $this->nbr = '5';
        $this->r = '7';
        $this->r_unit = 'm';
        $this->b = '7';
        $this->b_unit = 'm';
        $this->c = '7';
        $this->c_unit = 'm';
        $this->d = '7';
        $this->d_unit = 'm';
        $this->angle = '7';
        $this->angle_unit = 'deg';
        $this->angleb = '7';
        $this->angleb_unit = 'deg';

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

    public function calculate()
    {
        $request = request();
        $request->merge([
            'shape' => $this->shape,
            'given' => $this->given,
            'givena' => $this->givena,
            'r' => $this->r,
            'r_unit' => $this->r_unit,
            'b' => $this->b,
            'b_unit' => $this->b_unit,
            'c' => $this->c,
            'c_unit' => $this->c_unit,
            'd' => $this->d,
            'd_unit' => $this->d_unit,
            'angle' => $this->angle,
            'angle_unit' => $this->angle_unit,
            'angleb' => $this->angleb,
            'angleb_unit' => $this->angleb_unit,
            'nbr' => $this->nbr,
        ]);

        $model = new Math();
        $result = $model->perimeter($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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
        session()->flash('validation_error', $this->error);
        $this->detail = null;
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
        return view('livewire.calculators.perimeter-calculator', [
            'config' => $this->form_config
        ]);
    }
}
