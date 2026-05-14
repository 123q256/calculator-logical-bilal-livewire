<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Health;
class NetCarbsCalculator extends Component
{
    public $serving = 'per serving';
    public $location = 'yes';
    public $carbohydrates = '5';
    public $fiber = '5';
    public $alcohol = '30';
    public $contains = 'no';
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
            $this->serving = $inputs['serving'] ?? 'per serving';
            $this->location = $inputs['location'] ?? 'yes';
            $this->carbohydrates = $inputs['carbohydrates'] ?? '5';
            $this->fiber = $inputs['fiber'] ?? '5';
            $this->alcohol = $inputs['alcohol'] ?? '30';
            $this->contains = $inputs['contains'] ?? 'no';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->serving = 'per serving';
        $this->location = 'yes';
        $this->carbohydrates = '5';
        $this->fiber = '5';
        $this->alcohol = '30';
        $this->contains = 'no';
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
        $request = (object)[
            'serving' => $this->serving,
            'location' => $this->location,
            'carbohydrates' => $this->carbohydrates,
            'fiber' => $this->fiber,
            'alcohol' => $this->alcohol,
            'contains' => $this->contains,
        ];

        $model = new Health();
        $result = $model->net($request);

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
        return view('livewire.calculators.net-carbs-calculator');
    }
}
