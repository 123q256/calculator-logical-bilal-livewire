<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class FeetAndInchesCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $feet1 = 5;
    public $inches1 = 4;
    public $operations = '1';  // 1=+, 2=-, 3=×, 4=÷
    public $feet2 = 2;
    public $inches2 = 1;
    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            foreach (session('calculator_back_inputs') as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }


    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        return redirect()->to(url()->previous() ?? '/');
    }
    public function calculate()
    {
        $request = (object)[
            'type'       => $this->type,
            'feet1'      => $this->feet1,
            'inches1'    => $this->inches1,
            'operations' => $this->operations,
            'feet2'      => $this->feet2,
            'inches2'    => $this->inches2,
        ];

        // dd($request);
        $model = new Construction();
        $result = $model->feet($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            return redirect()->to(url()->previous() ?? '/');
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
            const offset = 40;
            const top = el.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
        }
    JS);
        }
        return view('livewire.calculators.feet-and-inches-calculator');
    }
}
