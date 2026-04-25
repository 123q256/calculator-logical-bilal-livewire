<?php

namespace App\Livewire\Calculators;
use App\Models\Chemistry;
use Livewire\Component;

class ElectronConfigurationCalculator extends Component
{
    public $element = 'H';
    public $el_name = 'Ca';
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
            if (is_object($inputs) || is_array($inputs)) {
                foreach ($inputs as $key => $value) {
                    if (property_exists($this, $key)) {
                        $this->$key = $value;
                    }
                }
            }
        }
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'element', 'el_name']);
        $this->resetErrorBag();

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
        $finalElement = ($this->element === 'Custom') ? $this->el_name : $this->element;

        $request = (object)[
            'element' => $finalElement,
            'el_name' => $this->el_name
        ];

        $model = new Chemistry();
        $result = $model->electron($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (object)['element' => $this->element, 'el_name' => $this->el_name]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->dispatch('math-updated');
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', (object)['element' => $this->element, 'el_name' => $this->el_name]);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function render()
    {
        return view('livewire.calculators.electron-configuration-calculator');
    }
}
