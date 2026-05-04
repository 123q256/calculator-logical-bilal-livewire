<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class ArvCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $method_unit; // Will be initialized in mount
    public $property = '20000';
    public $value = '20000';
    public $area = '10000';
    public $area_unit = 'm²';
    public $total = '10000';
    public $total_unit = 'm²';
    public $average = '10000';
    public $average_unit = 'm²';
    public $cost = '1000';
    public $purchase = '50';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        $this->method_unit = $lang[11] ?? 'Value of the property';
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->method_unit = $inputs->method_unit ?? ($lang[11] ?? 'Value of the property');
            $this->property = $inputs->property ?? '20000';
            $this->value = $inputs->value ?? '20000';
            $this->area = $inputs->area ?? '10000';
            $this->area_unit = $inputs->area_unit ?? 'm²';
            $this->total = $inputs->total ?? '10000';
            $this->total_unit = $inputs->total_unit ?? 'm²';
            $this->average = $inputs->average ?? '10000';
            $this->average_unit = $inputs->average_unit ?? 'm²';
            $this->cost = $inputs->cost ?? '1000';
            $this->purchase = $inputs->purchase ?? '50';
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
        $this->method_unit = $this->lang[11] ?? 'Value of the property';
        $this->property = '20000';
        $this->value = '20000';
        $this->area = '10000';
        $this->area_unit = 'm²';
        $this->total = '10000';
        $this->total_unit = 'm²';
        $this->average = '10000';
        $this->average_unit = 'm²';
        $this->cost = '1000';
        $this->purchase = '50';

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

    public function setUnit($property, $value)
    {
        $this->{$property} = $value;
        $this->updated($property);
    }

    public function calculate()
    {
        $requestData = [
            'method_unit'  => $this->method_unit,
            'property'     => $this->property,
            'value'        => $this->value,
            'area'         => $this->area,
            'area_unit'    => $this->area_unit,
            'total'        => $this->total,
            'total_unit'   => $this->total_unit,
            'average'      => $this->average,
            'average_unit' => $this->average_unit,
            'cost'         => $this->cost,
            'purchase'     => $this->purchase,
        ];

        $model = new Finance();
        $result = $model->arv((object)$requestData);

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
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
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
        return view('livewire.calculators.arv-calculator');
    }
}
