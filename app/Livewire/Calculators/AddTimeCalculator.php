<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Timedate;

class AddTimeCalculator extends Component
{
    public $inputs = [];
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';
    public $maxRows = 18;
    public $total_time = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_back_inputs')) {
            $this->inputs = (array)session('calculator_back_inputs');
        } else {
            $this->inputs = [
                'rows' => [
                    ['inhour' => null, 'inminutes' => null, 'inseconds' => null, 'inmiliseconds' => null],
                    ['inhour' => null, 'inminutes' => null, 'inseconds' => null, 'inmiliseconds' => null],
                ],
                'count_val' => 2,
                'hours_check' => true,
                'min_check' => true,
                'sec_check' => true,
                'milli_check' => true,
            ];
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function toggleColumn($column)
    {
        // UI only disabling — no resetting of values
    }

    public function addRow()
    {
        if (count($this->inputs['rows']) < $this->maxRows) {
            $this->inputs['rows'][] = [
                'inhour' => null,
                'inminutes' => null,
                'inseconds' => null,
                'inmiliseconds' => null
            ];
            $this->inputs['count_val'] = count($this->inputs['rows']);
        } else {
            $this->dispatch('alert', message: 'Max Limit Reached');
        }
    }

    public function removeRow($index)
    {
        if (count($this->inputs['rows']) > 2) {
            unset($this->inputs['rows'][$index]);
            $this->inputs['rows'] = array_values($this->inputs['rows']);
            $this->inputs['count_val'] = count($this->inputs['rows']);
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->error = null;
        $this->detail = null;

        $this->inputs = [
            'rows' => [
                ['inhour' => null, 'inminutes' => null, 'inseconds' => null, 'inmiliseconds' => null],
                ['inhour' => null, 'inminutes' => null, 'inseconds' => null, 'inmiliseconds' => null],
            ],
            'count_val' => 2,
            'hours_check' => true,
            'min_check' => true,
            'sec_check' => true,
            'milli_check' => true,
        ];

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)$this->inputs;

        $model = new Timedate();
        $result = $model->add($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $this->inputs);
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
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $this->inputs);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = 30;
                        const top = el.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.add-time-calculator');
    }
}
