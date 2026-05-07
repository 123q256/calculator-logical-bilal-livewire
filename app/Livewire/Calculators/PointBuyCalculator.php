<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class PointBuyCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $choice = '1';
    public $racial_choice = '1.1.1.1.1.1';
    public $points_budget = 27;
    public $smallest_score = 8;
    public $largest_score = 15;
    
    // Cost settings
    public $s1 = -9;
    public $s2 = -6;
    public $s3 = -4;
    public $s4 = -2;
    public $s5 = -1;
    public $s6 = 0;
    public $s7 = 1;
    public $s8 = 2;
    public $s9 = 3;
    public $s10 = 4;
    public $s11 = 5;
    public $s12 = 7;
    public $s13 = 9;
    public $s14 = 12;
    public $s15 = 15;
    public $s16 = 19;

    // Base Scores
    public $strength = 8;
    public $dexerity = 8;
    public $intelligence = 8;
    public $wisdom = 8;
    public $charisma = 8;
    public $constitution = 8;

    // Custom racial bonuses
    public $strength1 = 6;
    public $dexerity1 = 6;
    public $intelligence1 = 6;
    public $wisdom1 = 6;
    public $charisma1 = 6;
    public $constitution1 = 6;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
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

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        // Check for score limits
        if (in_array($propertyName, ['smallest_score', 'largest_score'])) {
            $val = floatval($this->$propertyName);
            if ($val <= 3 || $val >= 18) {
                $this->error = "Values less than 3 and greater than 18 are not allowed";
            }
        }
    }

    public function resetForm()
    {
        $this->reset(['choice', 'racial_choice', 'points_budget', 'smallest_score', 'largest_score', 'strength', 'dexerity', 'intelligence', 'wisdom', 'charisma', 'constitution', 'strength1', 'dexerity1', 'intelligence1', 'wisdom1', 'charisma1', 'constitution1', 'detail', 'error']);

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
            'choice' => $this->choice,
            'racial_choice' => $this->racial_choice,
            'points_budget' => $this->points_budget,
            'smallest_score' => $this->smallest_score,
            'largest_score' => $this->largest_score,
            'strength' => $this->strength,
            'dexerity' => $this->dexerity,
            'intelligence' => $this->intelligence,
            'wisdom' => $this->wisdom,
            'charisma' => $this->charisma,
            'constitution' => $this->constitution,
            'strength1' => $this->strength1,
            'dexerity1' => $this->dexerity1,
            'intelligence1' => $this->intelligence1,
            'wisdom1' => $this->wisdom1,
            'charisma1' => $this->charisma1,
            'constitution1' => $this->constitution1,
            's1' => $this->s1,
            's2' => $this->s2,
            's3' => $this->s3,
            's4' => $this->s4,
            's5' => $this->s5,
            's6' => $this->s6,
            's7' => $this->s7,
            's8' => $this->s8,
            's9' => $this->s9,
            's10' => $this->s10,
            's11' => $this->s11,
            's12' => $this->s12,
            's13' => $this->s13,
            's14' => $this->s14,
            's15' => $this->s15,
            's16' => $this->s16,
        ];

        $model = new EverydayLife();
        $result = $model->point((object)$requestData);

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
        return view('livewire.calculators.point-buy-calculator');
    }
}
