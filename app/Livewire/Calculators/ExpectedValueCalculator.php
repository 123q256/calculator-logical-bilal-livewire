<?php

namespace App\Livewire\Calculators;
use App\Models\Statistics;
use Livewire\Component;

class ExpectedValueCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $xx = [2, 3];
    public $px = [0.2, 0.8];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->xx = $inputs['xx'] ?? [2, 3];
            $this->px = $inputs['px'] ?? [0.2, 0.8];
        }
    }

    public function addRow()
    {
        if (count($this->xx) < 10) {
            $this->xx[] = '';
            $this->px[] = '';
        }
    }

    public function removeRow($index)
    {
        if (count($this->xx) > 1) {
            unset($this->xx[$index]);
            unset($this->px[$index]);
            $this->xx = array_values($this->xx);
            $this->px = array_values($this->px);
        }
        $this->error = null;
        $this->detail = null;
    }

    public function updated($property)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->xx = [2, 3];
        $this->px = [0.2, 0.8];

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
        // Filter out empty rows before calculating
        $xx_filtered = [];
        $px_filtered = [];
        foreach ($this->xx as $key => $val) {
            if ($val !== '' && $this->px[$key] !== '') {
                $xx_filtered[] = $val;
                $px_filtered[] = $this->px[$key];
            }
        }

        if (empty($xx_filtered)) {
            $this->error = "Please fill at least one row.";
            return;
        }

        $request = (object)[
            'check' => 'txtar',
            'xx'    => $xx_filtered,
            'px'    => $px_filtered,
            'show_val' => 0
        ];

        $model = new Statistics();
        $result = $model->expected($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'xx' => $this->xx,
                'px' => $this->px
            ]);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(sprintf(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
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
        return view('livewire.calculators.expected-value-calculator');
    }
}
