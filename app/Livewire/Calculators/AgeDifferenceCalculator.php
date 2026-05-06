<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class AgeDifferenceCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $selection = '1';
    public $dob_f = '1999-11-05';
    public $dob_s = '1999-08-07';
    public $year_1 = '2002';
    public $year_2;
    public $age_1 = '21';
    public $age_2 = '25';

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->year_2 = date("Y");
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function resetForm()
    {
        $this->reset(['selection', 'dob_f', 'dob_s', 'year_1', 'age_1', 'age_2', 'detail', 'error']);
        $this->year_2 = date("Y");

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
            'selection' => $this->selection,
            'dob_f'     => $this->dob_f,
            'dob_s'     => $this->dob_s,
            'year_1'    => $this->year_1,
            'year_2'    => $this->year_2,
            'age_1'     => $this->age_1,
            'age_2'     => $this->age_2,
        ];

        $model = new EverydayLife();
        $result = $model->age_diff((object)$requestData);

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
        return view('livewire.calculators.age-difference-calculator');
    }
}
