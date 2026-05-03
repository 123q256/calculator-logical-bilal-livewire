<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class RoiCalculator extends Component
{
    public $invest = 10;
    public $return = 20;
    public $find = 1;
    public $date = 1;
    public $annualized = 20;
    public $s_date;
    public $e_date;
    public $length = 30;
    public $length_unit = 'days';
    public $compare = 1;

    // Comparison inputs
    public $invest_compare = 5000;
    public $return_compare = 3000;
    public $find_compare = 1;
    public $annualized_compare = 3000;
    public $date_compare = 1;
    public $s_date_compare;
    public $e_date_compare;
    public $length_compare = 30;
    public $length_unit_compare = 'days';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    public $calName = null;
    public $calLink = null;

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$', $calName = null, $calLink = null)
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
        $this->calName = $calName;
        $this->calLink = $calLink;

        $this->s_date = date('Y-m-d');
        $this->e_date = date('Y-m-d', strtotime('+7 days'));
        $this->s_date_compare = date('Y-m-d');
        $this->e_date_compare = date('Y-m-d', strtotime('+7 days'));

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->invest = $inputs->invest ?? $this->invest;
            $this->return = $inputs->return ?? $this->return;
            $this->find = $inputs->find ?? $this->find;
            $this->date = $inputs->date ?? $this->date;
            $this->annualized = $inputs->annualized ?? $this->annualized;
            $this->s_date = $inputs->s_date ?? $this->s_date;
            $this->e_date = $inputs->e_date ?? $this->e_date;
            $this->length = $inputs->length ?? $this->length;
            $this->length_unit = $inputs->length_unit ?? $this->length_unit;
            $this->compare = $inputs->compare ?? $this->compare;

            $this->invest_compare = $inputs->invest_compare ?? $this->invest_compare;
            $this->return_compare = $inputs->return_compare ?? $this->return_compare;
            $this->find_compare = $inputs->find_compare ?? $this->find_compare;
            $this->annualized_compare = $inputs->annualized_compare ?? $this->annualized_compare;
            $this->date_compare = $inputs->date_compare ?? $this->date_compare;
            $this->s_date_compare = $inputs->s_date_compare ?? $this->s_date_compare;
            $this->e_date_compare = $inputs->e_date_compare ?? $this->e_date_compare;
            $this->length_compare = $inputs->length_compare ?? $this->length_compare;
            $this->length_unit_compare = $inputs->length_unit_compare ?? $this->length_unit_compare;
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function updated($propertyName)
    {
        $dropdowns = [
            'find', 'date', 'compare', 'find_compare', 'date_compare', 
            'length_unit', 'length_unit_compare'
        ];

        if (in_array($propertyName, $dropdowns)) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->openDropdown = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->invest = 10;
        $this->return = 20;
        $this->find = 1;
        $this->date = 1;
        $this->annualized = 20;
        $this->s_date = date('Y-m-d');
        $this->e_date = date('Y-m-d', strtotime('+7 days'));
        $this->length = 30;
        $this->length_unit = 'days';
        $this->compare = 1;

        $this->error = null;
        $this->detail = null;

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
        $requestData = [
            'invest' => $this->invest,
            'return' => $this->return,
            'find' => $this->find,
            'date' => $this->date,
            'annualized' => $this->annualized,
            's_date' => $this->s_date,
            'e_date' => $this->e_date,
            'length' => $this->length,
            'length_unit' => $this->length_unit,
            'compare' => $this->compare,

            'invest_compare' => $this->invest_compare,
            'return_compare' => $this->return_compare,
            'find_compare' => $this->find_compare,
            'annualized_compare' => $this->annualized_compare,
            'date_compare' => $this->date_compare,
            's_date_compare' => $this->s_date_compare,
            'e_date_compare' => $this->e_date_compare,
            'length_compare' => $this->length_compare,
            'length_unit_compare' => $this->length_unit_compare,
        ];

        $request = (object)$requestData;

        $model = new Finance();
        $result = $model->roi($request);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            
            // Prepare chart data for standard
            if ($this->invest <= $this->return) {
                $invest_per = ($this->invest / $this->return) * 100;
                $profit = 100 - $invest_per;
                $result['chartData'] = [
                    ['label' => 'Investment', 'y' => $invest_per],
                    ['label' => 'Profit', 'y' => $profit],
                ];
            } else {
                $invest_per = ($this->return / $this->invest) * 100;
                $profit = 100 - $invest_per;
                $result['chartData'] = [
                    ['label' => 'Remaining', 'y' => $invest_per],
                    ['label' => 'Loss', 'y' => $profit],
                ];
            }

            // Prepare chart data for comparison
            if ($this->compare == 2) {
                if ($this->invest_compare <= $this->return_compare) {
                    $invest_per2 = ($this->invest_compare / $this->return_compare) * 100;
                    $profit2 = 100 - $invest_per2;
                    $result['chartData2'] = [
                        ['label' => 'Investment', 'y' => $invest_per2],
                        ['label' => 'Profit', 'y' => $profit2],
                    ];
                } else {
                    $invest_per2 = ($this->return_compare / $this->invest_compare) * 100;
                    $profit2 = 100 - $invest_per2;
                    $result['chartData2'] = [
                        ['label' => 'Remaining', 'y' => $invest_per2],
                        ['label' => 'Loss', 'y' => $profit2],
                    ];
                }
            }

            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->dispatch('calculator-calculated');
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.roi-calculator');
    }
}
