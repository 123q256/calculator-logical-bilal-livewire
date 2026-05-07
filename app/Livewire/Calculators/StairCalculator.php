<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class StairCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $calc_type = 'first'; // wed/rel tabs
    public $f_input = 12;
    public $f_units = 'cm';
    public $s_input = 12;
    public $s_units = 'm';
    public $rise = '1';
    public $t_input = 24;
    public $t_units = 'cm';
    public $tread = '1';
    public $tread_input = 24;
    public $tread_units = 'cm';
    public $headroom = '1';
    public $h_req = 24;
    public $hr_units = 'cm';
    public $f_thickness = 24;
    public $ft_units = 'cm';
    public $f_opening = 1;
    public $fo_units = 'cm';
    public $mount = '1';

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

    public function setTab($tab)
    {
        $this->calc_type = $tab;
        $this->updated('calc_type');
    }

    public function setUnit($property, $unit)
    {
        $this->$property = $unit;
        $this->updated($property);
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);
    }

    public function resetForm()
    {
        $this->reset(['calc_type', 'f_input', 'f_units', 's_input', 's_units', 'rise', 't_input', 't_units', 'tread', 'tread_input', 'tread_units', 'headroom', 'h_req', 'hr_units', 'f_thickness', 'ft_units', 'f_opening', 'fo_units', 'mount', 'detail', 'error']);

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
        $requestData = [
            'type' => $this->calc_type,
            'f_input' => $this->f_input,
            'f_units' => $this->f_units,
            's_input' => $this->s_input,
            's_units' => $this->s_units,
            'rise' => $this->rise,
            't_input' => $this->t_input,
            't_units' => $this->t_units,
            'tread' => $this->tread,
            'tread_input' => $this->tread_input,
            'tread_units' => $this->tread_units,
            'headroom' => $this->headroom,
            'h_req' => $this->h_req,
            'hr_units' => $this->hr_units,
            'f_thickness' => $this->f_thickness,
            'ft_units' => $this->ft_units,
            'f_opening' => $this->f_opening,
            'fo_units' => $this->fo_units,
            'mount' => $this->mount,
        ];

        $model = new EverydayLife();
        $result = $model->stair((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
        }
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
        }
        return view('livewire.calculators.stair-calculator');
    }
}
