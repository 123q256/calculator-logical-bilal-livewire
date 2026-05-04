<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class VaDisabilityCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $right_arm = 0;
    public $left_arm = 0;
    public $right_leg = 0;
    public $left_leg = 0;
    public $right_foot = 0;
    public $left_foot = 0;
    public $back = 0;
    public $ssd = 0;
    public $ptsd = 0;
    public $tinnitus = 0;
    public $migraines = 0;
    public $sleep_apnea = 0;
    public $bilateral_upper = 0;
    public $bilateral_lower = 0;
    public $others = 0;
    public $status = 'Single';
    public $under_age = 0;
    public $over_age = 0;
    public $parent = 0;
    public $attendance = 'No';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        $this->status = $lang[19] ?? 'Single';

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;

        session()->forget([
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->right_arm = 0;
        $this->left_arm = 0;
        $this->right_leg = 0;
        $this->left_leg = 0;
        $this->right_foot = 0;
        $this->left_foot = 0;
        $this->back = 0;
        $this->ssd = 0;
        $this->ptsd = 0;
        $this->tinnitus = 0;
        $this->migraines = 0;
        $this->sleep_apnea = 0;
        $this->bilateral_upper = 0;
        $this->bilateral_lower = 0;
        $this->others = 0;
        $this->status = $this->lang[19] ?? 'Single';
        $this->under_age = 0;
        $this->over_age = 0;
        $this->parent = 0;
        $this->attendance = 'No';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect(request()->header('Referer'));
        }
    }

    public function calculate()
    {
        $requestData = [
            'right_arm' => $this->right_arm,
            'left_arm' => $this->left_arm,
            'right_leg' => $this->right_leg,
            'left_leg' => $this->left_leg,
            'right_foot' => $this->right_foot,
            'left_foot' => $this->left_foot,
            'back' => $this->back,
            'ssd' => $this->ssd,
            'ptsd' => $this->ptsd,
            'tinnitus' => $this->tinnitus,
            'migraines' => $this->migraines,
            'sleep_apnea' => $this->sleep_apnea,
            'bilateral_upper' => $this->bilateral_upper,
            'bilateral_lower' => $this->bilateral_lower,
            'others' => $this->others,
            'status' => $this->status,
            'under_age' => $this->under_age,
            'over_age' => $this->over_age,
            'parent' => $this->parent,
            'attendance' => $this->attendance,
        ];

        $model = new Finance();
        $result = $model->va((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect(request()->header('Referer'));
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.va-disability-calculator');
    }
}
