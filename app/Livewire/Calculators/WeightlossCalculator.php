<?php

namespace App\Livewire\Calculators;
use App\Models\Health;
use Livewire\Component;

class WeightlossCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $gender = 'Male';
    public $age = 25;
    public $height_ft = 5;
    public $height_in = 8;
    public $height_cm = 175.26;
    public $hightUnit = 'ft/in';
    public $weight = 158;
    public $unit = 'lbs';
    public $lose_w = 130;
    public $lose_unit = 'lbs';
    public $activity = '0.55';
    public $choose = 'by_date';
    public $start;
    public $target;
    public $enter_calories = '';
    public $unit_ft_in = 'ft/in';
    public $from = 'from_day';
    public $time_duration = '4';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->start = date('Y-m-d');
        $this->target = date('Y-m-d', strtotime('+90 days'));

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        // Check country/locale rules
        $countryName = "Pakistan";
        $metricCountries = [
            "United States",
            "Canada",
            "United Kingdom",
            "Pakistan",
        ];
        if (!in_array($countryName, $metricCountries)) {
            $this->unit = 'kg';
            $this->lose_unit = 'kg';
            $this->hightUnit = 'cm';
            $this->weight = 75;
            $this->lose_w = 65;
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array) session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function setWeightUnit($value)
    {
        if ($this->unit !== $value) {
            $this->unit = $value;
            $this->lose_unit = $value;
            if ($value === 'kg') {
                $this->weight = round($this->weight / 2.205, 2);
                $this->lose_w = round($this->lose_w / 2.205, 2);
            } else {
                $this->weight = round($this->weight * 2.205, 2);
                $this->lose_w = round($this->lose_w * 2.205, 2);
            }
        }
        $this->detail = null;
    }

    public function setHeightUnit($value)
    {
        if ($this->hightUnit !== $value) {
            $this->hightUnit = $value;
            if ($value === 'cm') {
                $inches = ($this->height_ft * 12) + $this->height_in;
                $this->height_cm = round($inches * 2.54, 2);
            } else {
                $totalInches = $this->height_cm / 2.54;
                $this->height_ft = floor($totalInches / 12);
                $this->height_in = round($totalInches - ($this->height_ft * 12));
            }
        }
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->gender = 'Male';
        $this->age = 25;
        $this->height_ft = 5;
        $this->height_in = 8;
        $this->height_cm = 175.26;
        $this->hightUnit = 'ft/in';
        $this->weight = 158;
        $this->unit = 'lbs';
        $this->lose_w = 130;
        $this->lose_unit = 'lbs';
        $this->activity = '0.55';
        $this->choose = 'by_date';
        $this->start = date('Y-m-d');
        $this->target = date('Y-m-d', strtotime('+90 days'));
        $this->enter_calories = '';
        $this->unit_ft_in = 'ft/in';
        $this->from = 'from_day';
        $this->time_duration = '4';

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

    public function updated($propertyName)
    {
        if ($propertyName !== 'time_duration') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        $this->from = ($this->choose === 'by_date') ? 'from_day' : 'from_kal';

        $request = (object)[
            'unit' => $this->unit,
            'gender' => $this->gender,
            'age' => $this->age,
            'height_ft' => $this->height_ft,
            'height_in' => $this->height_in,
            'height_cm' => $this->height_cm,
            'hightUnit' => $this->hightUnit,
            'weight' => $this->weight,
            'lose_w' => $this->lose_w,
            'lose_unit' => $this->lose_unit,
            'activity' => $this->activity,
            'start' => $this->start,
            'target' => $this->target,
            'choose' => $this->choose,
            'enter_calories' => $this->enter_calories,
            'from' => $this->from,
            'unit_ft_in' => $this->unit_ft_in,
        ];

        $model = new Health();
        $result = $model->weightloss($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $chartData = [];
            $chartCategories = [];
            $w = (float)$result['ans_weight'];
            for ($i = 1; $i <= $result['days']; $i++) {
                $chartData[] = round($w, 2);
                $chartCategories[] = date('d M', strtotime("+" . $i . " day"));
                $w = $w - $result['PoundsDaily'];
            }

            $result['chartData'] = $chartData;
            $result['chartCategories'] = $chartCategories;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->dispatch('chart-updated',
                    chartData: $chartData,
                    chartCategories: $chartCategories,
                    suffix: $result['submit']
                );
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
            return;
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
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
            if ($this->detail) {
                $this->dispatch('chart-updated',
                    chartData: $this->detail['chartData'],
                    chartCategories: $this->detail['chartCategories'],
                    suffix: $this->detail['submit']
                );
            }
        }
        return view('livewire.calculators.weightloss-calculator');
    }
}
