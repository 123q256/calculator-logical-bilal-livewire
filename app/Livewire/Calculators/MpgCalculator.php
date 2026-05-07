<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class MpgCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $calc_type = 'first'; // wed/rel in blade
    public $operations = '3';
    public $first = 23;
    public $units1 = '1';
    public $second = 8;
    public $units2 = '1';
    public $third = 3;
    public $units3 = '1';
    public $four = '';
    public $units4 = '1';
    public $currancy = '';

    // Advanced Inputs
    public $ad_first = 2105;
    public $ad_second = 2251;
    public $ad_third = 4;
    public $ad_units3 = '1';
    public $ad_four = '';
    public $ad_units4 = '1';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        $this->currancy = $lang['currency'] ?? '$';

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function setTab($tab)
    {
        $this->calc_type = $tab;
        $this->updated(null);
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->updated(null);
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);
    }

    public function resetForm()
    {
        $this->reset(['calc_type', 'operations', 'first', 'units1', 'second', 'units2', 'third', 'units3', 'four', 'units4', 'ad_first', 'ad_second', 'ad_third', 'ad_units3', 'ad_four', 'ad_units4', 'detail', 'error']);

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
            'type' => $this->calc_type,
            'operations' => $this->operations,
            'first' => $this->first,
            'units1' => $this->units1,
            'second' => $this->second,
            'units2' => $this->units2,
            'third' => $this->third,
            'units3' => $this->units3,
            'four' => $this->four,
            'units4' => $this->units4,
            'ad_first' => $this->ad_first,
            'ad_second' => $this->ad_second,
            'ad_third' => $this->ad_third,
            'ad_units3' => $this->ad_units3,
            'ad_four' => $this->ad_four,
            'ad_units4' => $this->ad_units4,
            'currancy' => $this->currancy,
        ];

        $model = new EverydayLife();
        $result = $model->mpg((object)$requestData);

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
        return view('livewire.calculators.mpg-calculator');
    }
}
