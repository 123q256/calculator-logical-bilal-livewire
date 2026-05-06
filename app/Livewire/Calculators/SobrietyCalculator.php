<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class SobrietyCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $input = '';
    public $input2 = '';

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        $this->input = date('Y-m-d', strtotime('- 170 days'));
        $this->input2 = date('Y-m-d');

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
        $this->reset(['input', 'input2', 'detail', 'error']);
        $this->input = date('Y-m-d', strtotime('- 170 days'));
        $this->input2 = date('Y-m-d');

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
            'input' => $this->input,
            'input2' => $this->input2,
        ];

        $model = new EverydayLife();
        $result = $model->sobriety((object)$requestData);

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
        return view('livewire.calculators.sobriety-calculator');
    }
}
