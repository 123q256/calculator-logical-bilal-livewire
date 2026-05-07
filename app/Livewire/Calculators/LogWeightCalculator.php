<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class LogWeightCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $result_key = 1;

    // Inputs
    public $category = 'log';
    public $woodSelector = '46@';
    public $custom = 12;
    public $custom_unit = 'kg/m³';
    public $small_end = 12;
    public $small_unit = 'in';
    public $length = 12;
    public $length_unit = 'm';
    public $large_end = 12;
    public $large_unit = 'in';
    public $stack_w = 12;
    public $stackw_unit = 'in';
    public $stack_h = 12;
    public $stackh_unit = 'in';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->category = $inputs->category ?? 'log';
            $this->woodSelector = $inputs->woodSelector ?? '46@';
            $this->custom = $inputs->custom ?? 12;
            $this->custom_unit = $inputs->custom_unit ?? 'kg/m³';
            $this->small_end = $inputs->small_end ?? 12;
            $this->small_unit = $inputs->small_unit ?? 'in';
            $this->length = $inputs->length ?? 12;
            $this->length_unit = $inputs->length_unit ?? 'm';
            $this->large_end = $inputs->large_end ?? 12;
            $this->large_unit = $inputs->large_unit ?? 'in';
            $this->stack_w = $inputs->stack_w ?? 12;
            $this->stackw_unit = $inputs->stackw_unit ?? 'in';
            $this->stack_h = $inputs->stack_h ?? 12;
            $this->stackh_unit = $inputs->stackh_unit ?? 'in';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->category = 'log';
        $this->woodSelector = '46@';
        $this->custom = 12;
        $this->custom_unit = 'kg/m³';
        $this->small_end = 12;
        $this->small_unit = 'in';
        $this->length = 12;
        $this->length_unit = 'm';
        $this->large_end = 12;
        $this->large_unit = 'in';
        $this->stack_w = 12;
        $this->stackw_unit = 'in';
        $this->stack_h = 12;
        $this->stackh_unit = 'in';

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
        $this->result_key++;
        $this->detail = null;
        $this->error = null;

        $request = (object)[
            'category' => $this->category,
            'woodSelector' => $this->woodSelector,
            'custom' => $this->custom,
            'custom_unit' => $this->custom_unit,
            'small_end' => $this->small_end,
            'small_unit' => $this->small_unit,
            'large_end' => $this->large_end,
            'large_unit' => $this->large_unit,
            'length' => $this->length,
            'length_unit' => $this->length_unit,
            'stack_w' => $this->stack_w,
            'stackw_unit' => $this->stackw_unit,
            'stack_h' => $this->stack_h,
            'stackh_unit' => $this->stackh_unit,
            'submit' => true,
        ];

        $model = new EverydayLife();
        $result = $model->log($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
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
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.log-weight-calculator');
    }
}
