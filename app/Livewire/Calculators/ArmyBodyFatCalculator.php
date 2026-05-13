<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class ArmyBodyFatCalculator extends Component
{
    public $activeDuty = 'yes';
    public $age = '23';
    public $gender = 'male';
    public $height_ft = '6';
    public $height_in = '0';
    public $height_cm = '183';
    public $units1 = 'cm';
    public $neck_ft = '0';
    public $neck_in = '0';
    public $neck_cm = '1';
    public $unit_h1 = 'cm';
    public $waist_ft = '0';
    public $waist_in = '0';
    public $waist_cm = '2';
    public $unit_h2 = 'cm';
    public $hip_ft = '1';
    public $hip_in = '2';
    public $hip_cm = '2';
    public $unit_h3 = 'cm';
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
            $this->activeDuty = $inputs['activeDuty'] ?? 'yes';
            $this->age = $inputs['age'] ?? '23';
            $this->gender = $inputs['gender'] ?? 'male';
            $this->height_ft = $inputs['height_ft'] ?? '6';
            $this->height_in = $inputs['height_in'] ?? '0';
            $this->height_cm = $inputs['height_cm'] ?? '183';
            $this->units1 = $inputs['unit_ft_in'] ?? 'cm';
            $this->neck_ft = $inputs['neck_ft'] ?? '0';
            $this->neck_in = $inputs['neck_in'] ?? '0';
            $this->neck_cm = $inputs['neck_cm'] ?? '1';
            $this->unit_h1 = $inputs['unit_ft_in1'] ?? 'cm';
            $this->waist_ft = $inputs['waist_ft'] ?? '0';
            $this->waist_in = $inputs['waist_in'] ?? '0';
            $this->waist_cm = $inputs['waist_cm'] ?? '2';
            $this->unit_h2 = $inputs['unit_ft_in2'] ?? 'cm';
            $this->hip_ft = $inputs['hip_ft'] ?? '1';
            $this->hip_in = $inputs['hip_in'] ?? '2';
            $this->hip_cm = $inputs['hip_cm'] ?? '2';
            $this->unit_h3 = $inputs['unit_ft_in3'] ?? 'cm';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->activeDuty = 'yes';
        $this->age = '23';
        $this->gender = 'male';
        $this->height_ft = '6';
        $this->height_in = '0';
        $this->height_cm = '183';
        $this->units1 = 'cm';
        $this->neck_ft = '0';
        $this->neck_in = '0';
        $this->neck_cm = '1';
        $this->unit_h1 = 'cm';
        $this->waist_ft = '0';
        $this->waist_in = '0';
        $this->waist_cm = '2';
        $this->unit_h2 = 'cm';
        $this->hip_ft = '1';
        $this->hip_in = '2';
        $this->hip_cm = '2';
        $this->unit_h3 = 'cm';
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $request = (object)[
            'activeDuty' => $this->activeDuty,
            'age' => $this->age,
            'gender' => $this->gender,
            'height_ft' => $this->height_ft,
            'height_in' => $this->height_in,
            'height_cm' => $this->height_cm,
            'unit_ft_in' => $this->units1,
            'neck_ft' => $this->neck_ft,
            'neck_in' => $this->neck_in,
            'neck_cm' => $this->neck_cm,
            'unit_ft_in1' => $this->unit_h1,
            'waist_ft' => $this->waist_ft,
            'waist_in' => $this->waist_in,
            'waist_cm' => $this->waist_cm,
            'unit_ft_in2' => $this->unit_h2,
            'hip_ft' => $this->hip_ft,
            'hip_in' => $this->hip_in,
            'hip_cm' => $this->hip_cm,
            'unit_ft_in3' => $this->unit_h3,
        ];

        $model = new Health();
        $result = $model->army($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (isset($result['bodyFatPercentage']) && is_nan($result['bodyFatPercentage'])) {
                $result['bodyFatPercentage'] = 'NAN %';
            }
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->current());
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
        return view('livewire.calculators.army-body-fat-calculator');
    }
}
