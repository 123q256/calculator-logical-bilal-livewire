<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class AstAltRatioCalculator extends Component
{
    public $ast = '12';
    public $ast_unit = 'U / liter';
    public $alt = '12';
    public $alt_unit = 'U / liter';
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
            $this->ast = $inputs['ast'] ?? '12';
            $this->ast_unit = $inputs['ast_unit'] ?? 'U / liter';
            $this->alt = $inputs['alt'] ?? '12';
            $this->alt_unit = $inputs['alt_unit'] ?? 'U / liter';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->ast = '12';
        $this->ast_unit = 'U / liter';
        $this->alt = '12';
        $this->alt_unit = 'U / liter';
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

    public function calculate()
    {
        if (empty($this->alt) || $this->alt == 0) {
            $this->error = 'ALT cannot be zero or empty.';
            return;
        }

        $request = (object)[
            'ast' => $this->ast,
            'ast_unit' => $this->ast_unit,
            'alt' => $this->alt,
            'alt_unit' => $this->alt_unit,
        ];

        $model = new Health();
        $result = $model->ast($request);

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
        return view('livewire.calculators.ast-alt-ratio-calculator');
    }
}
