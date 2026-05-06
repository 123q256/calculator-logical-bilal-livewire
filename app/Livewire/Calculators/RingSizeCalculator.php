<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class RingSizeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $unit = 'millimeters';
    public $to_measure = 'd_o_r';
    public $d_o_r_mm = '10.72';
    public $d_o_r_in = '0.442';
    public $c_o_f_mm = '33.68';
    public $c_o_f_in = '1.39';

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
        $this->reset(['unit', 'to_measure', 'd_o_r_mm', 'd_o_r_in', 'c_o_f_mm', 'c_o_f_in', 'detail', 'error']);

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
            'unit' => $this->unit,
            'to_measure' => $this->to_measure,
            'd_o_r_mm' => $this->d_o_r_mm,
            'd_o_r_in' => $this->d_o_r_in,
            'c_o_f_mm' => $this->c_o_f_mm,
            'c_o_f_in' => $this->c_o_f_in,
        ];

        $model = new EverydayLife();
        $result = $model->ring((object)$requestData);

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
        return view('livewire.calculators.ring-size-calculator');
    }
}
