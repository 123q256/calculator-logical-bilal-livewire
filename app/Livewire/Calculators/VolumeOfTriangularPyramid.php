<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class VolumeOfTriangularPyramid extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    
    public $selection = '1';
    public $triangle_type = '1';
    public $base_height = '12';
    public $base_height_unit = 'm';
    public $pyramid_base_area = '12';
    public $pyramid_base_area_unit = 'm²';
    public $base = '12';
    public $base_unit = 'm';
    public $sidea = '12';
    public $sidea_length_unit = 'm';
    public $sideb = '12';
    public $sideb_length_unit = 'm';
    public $sidec = '12';
    public $sidec_length_unit = 'm';
    public $angle_beta = '12';
    public $angle_beta_unit = 'rad';
    public $angle_gamma = '1';
    public $angle_gamma_unit = 'rad';
    public $pyramid_height = '1';
    public $pyramid_height_unit = 'm';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->selection = $inputs['selection'] ?? '1';
            $this->triangle_type = $inputs['triangle_type'] ?? '1';
            $this->base_height = $inputs['base_height'] ?? '12';
            $this->base_height_unit = $inputs['base_height_unit'] ?? 'm';
            $this->pyramid_base_area = $inputs['pyramid_base_area'] ?? '12';
            $this->pyramid_base_area_unit = $inputs['pyramid_base_area_unit'] ?? 'm';
            $this->base = $inputs['base'] ?? '12';
            $this->base_unit = $inputs['base_unit'] ?? 'm';
            $this->sidea = $inputs['sidea'] ?? '12';
            $this->sidea_length_unit = $inputs['sidea_length_unit'] ?? 'm';
            $this->sideb = $inputs['sideb'] ?? '12';
            $this->sideb_length_unit = $inputs['sideb_length_unit'] ?? 'm';
            $this->sidec = $inputs['sidec'] ?? '12';
            $this->sidec_length_unit = $inputs['sidec_length_unit'] ?? 'm';
            $this->angle_beta = $inputs['angle_beta'] ?? '12';
            $this->angle_beta_unit = $inputs['angle_beta_unit'] ?? 'rad';
            $this->angle_gamma = $inputs['angle_gamma'] ?? '1';
            $this->angle_gamma_unit = $inputs['angle_gamma_unit'] ?? 'rad';
            $this->pyramid_height = $inputs['pyramid_height'] ?? '1';
            $this->pyramid_height_unit = $inputs['pyramid_height_unit'] ?? 'm';
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

  public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        if ($this->selection == '1' && $this->triangle_type == '4') {
            $b_val = (float)$this->angle_beta;
            $g_val = (float)$this->angle_gamma;
            
            $b_deg = $this->angle_beta_unit === 'rad' ? $b_val * 57.2958 : $b_val;
            $g_deg = $this->angle_gamma_unit === 'rad' ? $g_val * 57.2958 : $g_val;
            
            if (($b_deg + $g_deg) >= 180) {
                $this->error = 'The sum of two angles cannot exceed 180 degrees.';
                session()->flash('validation_error', $this->error);
                $this->detail = null;
                return;
            }
        }
        
        $request = new \Illuminate\Http\Request();
        $request->merge([
            'selection' => $this->selection,
            'triangle_type' => $this->triangle_type,
            'base_height' => $this->base_height,
            'base_height_unit' => $this->base_height_unit,
            'pyramid_base_area' => $this->pyramid_base_area,
            'pyramid_base_area_unit' => $this->pyramid_base_area_unit,
            'base' => $this->base,
            'base_unit' => $this->base_unit,
            'sidea' => $this->sidea,
            'sidea_length_unit' => $this->sidea_length_unit,
            'sideb' => $this->sideb,
            'sideb_length_unit' => $this->sideb_length_unit,
            'sidec' => $this->sidec,
            'sidec_length_unit' => $this->sidec_length_unit,
            'angle_beta' => $this->angle_beta,
            'angle_beta_unit' => $this->angle_beta_unit,
            'angle_gamma' => $this->angle_gamma,
            'angle_gamma_unit' => $this->angle_gamma_unit,
            'pyramid_height' => $this->pyramid_height,
            'pyramid_height_unit' => $this->pyramid_height_unit,
        ]);

        $model = new Math();
        $result = $model->triangular_pyramid($request);

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
            session()->flash('calculator_back_inputs', $request->all());
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
        return view('livewire.calculators.volume-of-triangular-pyramid');
    }
}
