<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class AreaCalculator extends Component
{
   
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $shapes = 'square';
    public $radius = '4';
    public $radius_unit = 'm';
    public $bara_radius = '4';
    public $bara_radius_unit = 'm';
    public $number_of_sides = '13';
    public $find_triangle = '1';
    public $find_triangle_two = '1';
    public $find_triangle_three = '1';
    public $find_triangle_four = '1';
    public $angle_alpha = '4';
    public $angle_alpha_unit = 'deg';
    public $angle_beta = '4';
    public $angle_beta_unit = 'deg';
    public $angle_theta = '4';
    public $angle_theta_unit = 'deg';
    public $angle_gamma = '4';
    public $angle_gamma_unit = 'deg';
    public $e = '4';
    public $e_unit = 'm';
    public $area = '4';
    public $area_unit = 'm';
    public $box = '4';
    public $box_unit = 'm';
    public $f = '4';
    public $f_unit = 'm';
    public $height = '4';
    public $height_unit = 'm';
    public $c = '4';
    public $c_unit = 'm';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function resetForm()
    {
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

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->updated();
    }

    public function getDisplayConfigProperty()
    {
        $fields = [
            'radius' => false, 'bara_radius' => false, 'area' => false, 'boxes' => false,
            'height' => false, 'angle_alpha' => false, 'angle_beta' => false, 'angle_gamma' => false,
            'angle_theta' => false, 'e' => false, 'f' => false, 'c' => false, 'no_of_sides' => false,
            'test1' => false, 'test2' => false, 'test3' => false, 'test4' => false,
        ];
        $img = 'images/sav1.svg';

        switch($this->shapes) {
            case 'square':
                $fields['area'] = true;
                $img = 'images/sav1.svg';
                break;
            case 'rectangle':
                $fields['area'] = true;
                $fields['boxes'] = true;
                $img = 'images/sav2.svg';
                break;
            case 'triangle':
                $fields['test1'] = true;
                switch($this->find_triangle) {
                    case '1':
                        $fields['height'] = true; $fields['boxes'] = true;
                        $img = 'images/sav12.svg'; break;
                    case '2':
                        $fields['area'] = true; $fields['boxes'] = true; $fields['c'] = true;
                        $img = 'images/sav4.svg'; break;
                    case '3':
                        $fields['area'] = true; $fields['boxes'] = true; $fields['angle_gamma'] = true;
                        $img = 'images/sav5.svg'; break;
                    case '4':
                        $fields['area'] = true; $fields['angle_beta'] = true; $fields['angle_gamma'] = true;
                        $img = 'images/sav6.svg'; break;
                }
                break;
            case 'circle':
                $fields['radius'] = true; $img = 'images/sav7.svg'; break;
            case 'semicircle':
                $fields['radius'] = true; $img = 'images/sav8.svg'; break;
            case 'sector':
                $fields['radius'] = true; $fields['angle_alpha'] = true; $img = 'images/sav8.svg'; break;
            case 'ellipse':
                $fields['area'] = true; $fields['boxes'] = true; $img = 'images/sav9.svg'; break;
            case 'trapezoid':
                $fields['area'] = true; $fields['boxes'] = true; $fields['height'] = true; $img = 'images/sav10.svg'; break;
            case 'parallelogram':
                $fields['test2'] = true;
                switch($this->find_triangle_two) {
                    case '1':
                        $fields['height'] = true; $fields['boxes'] = true; $img = 'images/sav12.svg'; break;
                    case '2':
                        $fields['area'] = true; $fields['boxes'] = true; $fields['angle_alpha'] = true; $img = 'images/sav13.svg'; break;
                    case '3':
                        $fields['e'] = true; $fields['f'] = true; $fields['angle_theta'] = true; $img = 'images/sav14.svg'; break;
                }
                break;
            case 'rhombus':
                $fields['test3'] = true;
                switch($this->find_triangle_three) {
                    case '1':
                        $fields['height'] = true; $fields['area'] = true; $img = 'images/sav16.svg'; break;
                    case '2':
                        $fields['e'] = true; $fields['f'] = true; $img = 'images/sav17.svg'; break;
                    case '3':
                        $fields['area'] = true; $fields['angle_alpha'] = true; $img = 'images/sav15.svg'; break;
                }
                break;
            case 'kite':
                $fields['test4'] = true;
                switch($this->find_triangle_four) {
                    case '1':
                        $fields['e'] = true; $fields['f'] = true; $img = 'images/sav18.svg'; break;
                    case '2':
                        $fields['area'] = true; $fields['angle_alpha'] = true; $fields['boxes'] = true; $img = 'images/sav19.svg'; break;
                }
                break;
            case 'regular pentagon':
                $fields['area'] = true; $img = 'images/sav20.svg'; break;
            case 'regular hexagon':
                $fields['area'] = true; $img = 'images/sav21.svg'; break;
            case 'regular octagon':
                $fields['area'] = true; $img = 'images/sav22.svg'; break;
            case 'annulus (ring)':
                $fields['radius'] = true; $fields['bara_radius'] = true; $img = 'images/sav23.svg'; break;
            case 'irregular quadrilateral':
                $fields['area'] = true; $fields['boxes'] = true; $fields['c'] = true;
                $fields['height'] = true; $fields['angle_alpha'] = true; $fields['angle_beta'] = true;
                $img = 'images/sav24.svg'; break;
            case 'regular polygon':
                $fields['area'] = true; $fields['no_of_sides'] = true; $img = 'images/sav25.svg'; break;
        }

        return ['fields' => $fields, 'img' => $img];
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $request = new \Illuminate\Http\Request();
        $request->merge([
            'shapes' => $this->shapes,
            'radius' => $this->radius,
            'radius_unit' => $this->radius_unit,
            'bara_radius' => $this->bara_radius,
            'bara_radius_unit' => $this->bara_radius_unit,
            'number_of_sides' => $this->number_of_sides,
            'find_triangle' => $this->find_triangle,
            'find_triangle_two' => $this->find_triangle_two,
            'find_triangle_three' => $this->find_triangle_three,
            'find_triangle_four' => $this->find_triangle_four,
            'angle_alpha' => $this->angle_alpha,
            'angle_alpha_unit' => $this->angle_alpha_unit,
            'angle_beta' => $this->angle_beta,
            'angle_beta_unit' => $this->angle_beta_unit,
            'angle_theta' => $this->angle_theta,
            'angle_theta_unit' => $this->angle_theta_unit,
            'angle_gamma' => $this->angle_gamma,
            'angle_gamma_unit' => $this->angle_gamma_unit,
            'e' => $this->e,
            'e_unit' => $this->e_unit,
            'area' => $this->area,
            'area_unit' => $this->area_unit,
            'box' => $this->box,
            'box_unit' => $this->box_unit,
            'f' => $this->f,
            'f_unit' => $this->f_unit,
            'height' => $this->height,
            'height_unit' => $this->height_unit,
            'c' => $this->c,
            'c_unit' => $this->c_unit,
        ]);

        $model = new Math();
        $result = $model->areaa($request);

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
    
        return view('livewire.calculators.area-calculator');
    }
}
