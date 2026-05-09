<?php

namespace App\Livewire\Calculators;
use App\Models\Statistics;
use Livewire\Component;

class FiveNumberSummaryCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $seprateby = 'space';
    public $textarea = '3 8 10 17 24 27';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->seprateby = $inputs['seprateby'] ?? 'space';
            $this->textarea = $inputs['textarea'] ?? '3 8 10 17 24 27';
        }
    }

    public function updated($property)
    {
        $this->error = null;
        $this->detail = null;
        
        if ($property === 'seprateby') {
            if ($this->seprateby === 'space') {
                $this->textarea = str_replace(',', ' ', $this->textarea);
                // clean up multiple spaces
                $this->textarea = preg_replace('/\s+/', ' ', $this->textarea);
            } else if ($this->seprateby === ',') {
                // replace spaces with commas
                $this->textarea = preg_replace('/\s+/', ',', trim($this->textarea));
                // clean up multiple commas
                $this->textarea = preg_replace('/,+/', ',', $this->textarea);
            }
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->seprateby = 'space';
        $this->textarea = '3 8 10 17 24 27';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'seprateby' => $this->seprateby,
            'textarea'  => $this->textarea,
        ];

        $model = new Statistics();
        $result = $model->_5($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'seprateby' => $this->seprateby,
                'textarea'  => $this->textarea
            ]);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            // Dispatch event to render chart and katex
            $this->dispatch('render-five-number-chart', [
                'min' => $result['min'],
                'q1' => $result['first'],
                'median' => $result['second'],
                'q3' => $result['third'],
                'max' => $result['max'],
            ]);

            $this->js(sprintf(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }
                }, 400);
            JS));
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        }
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
        return view('livewire.calculators.five-number-summary-calculator');
    }
}
