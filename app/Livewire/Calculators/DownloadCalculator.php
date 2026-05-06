<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class DownloadCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $operations = '1';
    public $first = '12';
    public $f_unit = 'MB';
    public $second = '12';
    public $s_unit = 'MB';
    public $third = '12';
    public $t_unit = 'min';

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

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

        // Standard keys for inc.button
        $this->lang['calculate'] = $this->lang['calculate'] ?? ($this->lang['calculate_btn'] ?? 'Calculate');
        $this->lang['reset'] = $this->lang['reset'] ?? ($this->lang['reset_btn'] ?? 'Reset');
    }

    public function resetForm()
    {
        $this->reset(['operations', 'first', 'f_unit', 'second', 's_unit', 'third', 't_unit', 'detail', 'error']);

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
            'operations' => $this->operations,
            'first' => $this->first,
            'f_unit' => $this->f_unit,
            'second' => $this->second,
            's_unit' => $this->s_unit,
            'third' => $this->third,
            't_unit' => $this->t_unit,
        ];

        $model = new EverydayLife();
        $result = $model->download((object)$requestData);

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
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->updated($property);
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.download-calculator');
    }
}
