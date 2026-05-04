<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class SalaryToHourlyCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type_ui = 'calculator'; // renamed to avoid conflict with $type input
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $type = 'an';
    public $salary = '30000';
    public $hweek = '40';
    public $hyear = '52';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type_ui = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->type = $inputs->type ?? 'an';
            $this->salary = $inputs->salary ?? '30000';
            $this->hweek = $inputs->hweek ?? '40';
            $this->hyear = $inputs->hyear ?? '52';
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
        $this->type = 'an';
        $this->salary = '30000';
        $this->hweek = '40';
        $this->hyear = '52';

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
        $requestData = [
            'type'     => $this->type,
            'salary'   => $this->salary,
            'hweek'    => $this->hweek,
            'hyear'    => $this->hyear,
            'currency' => $this->currancy,
        ];

        $model = new Finance();
        $result = $model->salarytohur((object)$requestData);

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
        return view('livewire.calculators.salary-to-hourly-calculator');
    }
}
