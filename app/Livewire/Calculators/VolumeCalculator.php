<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class VolumeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $volume_select = 'Rectangular';
    public $circle_unit_result = 'cm³';

    // Rectangular Box
    public $rec_width = '12';
    public $rec_width_units = 'cm';
    public $rec_length = '3';
    public $rec_length_units = 'cm';
    public $rec_height = '3';
    public $rec_height_units = 'cm';

    // Cube
    public $cub_side = '3';
    public $cub_side_units = 'cm';

    // Cylinder
    public $cyl_height = '5';
    public $cyl_height_units = 'cm';
    public $cyl_diameter = '5';
    public $cyl_diameter_units = 'cm';

    // Cone
    public $con_height = '5';
    public $con_height_units = 'cm';
    public $con_diameter = '5';
    public $con_diameter_units = 'cm';

    // Sphere
    public $sph_diameter = '5';
    public $sph_diameter_units = 'cm';

    // Triangular Prism
    public $tri_base = '5';
    public $tri_base_units = 'cm';
    public $tri_length = '5';
    public $tri_length_units = 'cm';
    public $tri_height = '5';
    public $tri_height_units = 'cm';
    public $tri_h = '5';
    public $tri_h_units = 'cm';

    // Pyramid
    public $pyr_height = '5';
    public $pyr_height_units = 'cm';
    public $pyr_side = '5';
    public $pyr_side_units = 'cm';

    // Capsule
    public $cap_height = '5';
    public $cap_height_units = 'cm';
    public $cap_radius = '5';
    public $cap_radius_units = 'cm';

    // Hemisphere
    public $hem_radius = '5';
    public $hem_radius_units = 'cm';

    // Hollow cylinder / tube
    public $hol_inner_dia = '5';
    public $hol_inner_dia_units = 'cm';
    public $hol_outer_dia = '5';
    public $hol_outer_dia_units = 'cm';
    public $hol_height = '5';
    public $hol_height_units = 'cm';

    // Conical frustum
    public $coni_top_r = '5';
    public $coni_top_r_units = 'cm';
    public $coni_bottom_r = '5';
    public $coni_bottom_r_units = 'cm';
    public $coni_height = '5';
    public $coni_height_units = 'cm';

    // Truncated pyramid
    public $tru_top_side = '5';
    public $tru_top_side_units = 'cm';
    public $tru_base_side = '5';
    public $tru_base_side_units = 'cm';
    public $tru_height = '5';
    public $tru_height_units = 'cm';

    // Ellipsoid
    public $ell_sem_a = '5';
    public $ell_sem_a_units = 'cm';
    public $ell_sem_b = '5';
    public $ell_sem_b_units = 'cm';
    public $ell_sem_c = '5';
    public $ell_sem_c_units = 'cm';

    // Square
    public $square = '5';
    public $square_units = 'cm';

    // Column
    public $col_height = '5';
    public $col_height_units = 'cm';
    public $col_radi = '5';
    public $col_radi_units = 'cm';

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
        $lang = $this->lang;
        $type = $this->type;
        $this->reset();
        $this->lang = $lang;
        $this->type = $type;
        
        $this->volume_select = 'Rectangular';
        $this->circle_unit_result = 'cm³';
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
    }

    public function calculate()
    {
        $requestData = get_object_vars($this);
        $request = clone request();
        $request->replace($requestData);

        $model = new Math();
        $result = $model->volume_cal($request);
        // dd($result);
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
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('math-updated');
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
            // dd($result);
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
        return view('livewire.calculators.volume-calculator');
    }
}
