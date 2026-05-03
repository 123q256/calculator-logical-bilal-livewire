<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class EmployeeCostCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Form fields
    public $unit_type = 'salary'; // 'salary' or 'hourly'
    public $rate = 413;
    public $hour_worked = 40;
    public $month = 10;
    public $benefits = 10;
    public $health = 10;
    public $dental = 10;
    public $vision = 10;

    // Dynamic Perks
    public $perks = [];

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
            if (isset($inputs->perks)) {
                $this->perks = $inputs->perks;
            }
        }
    }

    public function changeUnit($unit)
    {
        $this->unit_type = $unit;
    }

    public function addPerk()
    {
        if (count($this->perks) < 5) {
            $this->perks[] = ['name' => '', 'contribution' => 10];
        } else {
            $this->js("alert('Only Five Fields are Allowed')");
        }
    }

    public function removePerk($index)
    {
        unset($this->perks[$index]);
        $this->perks = array_values($this->perks);
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->unit_type = 'salary';
        $this->rate = 413;
        $this->hour_worked = 40;
        $this->month = 10;
        $this->benefits = 10;
        $this->health = 10;
        $this->dental = 10;
        $this->vision = 10;
        $this->perks = [];

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
        $perk_names = [];
        $perk_contributions = [];
        foreach ($this->perks as $perk) {
            if (!empty($perk['name'])) {
                $perk_names[] = $perk['name'];
                $perk_contributions[] = $perk['contribution'];
            }
        }

        $request = (object)[
            'unit_type' => $this->unit_type,
            'rate' => $this->rate,
            'hour_worked' => $this->hour_worked,
            'month' => $this->month,
            'benefits' => $this->benefits,
            'health' => $this->health,
            'dental' => $this->dental,
            'vision' => $this->vision,
            'perk_name' => $perk_names,
            'annual_contribution' => $perk_contributions,
            'perks' => $this->perks, // for persistence
        ];

        $model = new Finance();
        $result = $model->employee($request);

        if (empty($result['error'])) {
            $result['submit'] = $this->unit_type; // Match legacy result check
            $result['RESULT'] = 1;
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);

        } else {
            $this->error = $result['error'];
            $this->detail = null;
            session()->flash('validation_error', $this->error);
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

        return view('livewire.calculators.employee-cost-calculator');
    }
}
