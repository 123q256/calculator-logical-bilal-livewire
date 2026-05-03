<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class NpsCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $score_ten = 10;
    public $score_nine = 20;
    public $score_eight = 30;
    public $score_seven = 40;
    public $score_six = 50;
    public $score_five = 10;
    public $score_four = 20;
    public $score_three = 30;
    public $score_two = 40;
    public $score_one = 40;
    public $score_zero = 40;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->score_ten = $inputs->score_ten ?? 10;
            $this->score_nine = $inputs->score_nine ?? 20;
            $this->score_eight = $inputs->score_eight ?? 30;
            $this->score_seven = $inputs->score_seven ?? 40;
            $this->score_six = $inputs->score_six ?? 50;
            $this->score_five = $inputs->score_five ?? 10;
            $this->score_four = $inputs->score_four ?? 20;
            $this->score_three = $inputs->score_three ?? 30;
            $this->score_two = $inputs->score_two ?? 40;
            $this->score_one = $inputs->score_one ?? 40;
            $this->score_zero = $inputs->score_zero ?? 40;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        $this->score_ten = 10;
        $this->score_nine = 20;
        $this->score_eight = 30;
        $this->score_seven = 40;
        $this->score_six = 50;
        $this->score_five = 10;
        $this->score_four = 20;
        $this->score_three = 30;
        $this->score_two = 40;
        $this->score_one = 40;
        $this->score_zero = 40;

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

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function calculate()
    {
        $request = (object)[
            'score_ten' => $this->score_ten,
            'score_nine' => $this->score_nine,
            'score_eight' => $this->score_eight,
            'score_seven' => $this->score_seven,
            'score_six' => $this->score_six,
            'score_five' => $this->score_five,
            'score_four' => $this->score_four,
            'score_three' => $this->score_three,
            'score_two' => $this->score_two,
            'score_one' => $this->score_one,
            'score_zero' => $this->score_zero,
        ];

        $model = new Finance();
        $result = $model->nps($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $result['chartData'] = json_encode([
                ['name' => $this->lang[3] ?? 'Promoters', 'y' => (float)$result['good'], 'color' => '#10b981'],
                ['name' => $this->lang[5] ?? 'Passives', 'y' => (float)$result['neutral'], 'color' => '#9ca3af'],
                ['name' => $this->lang[7] ?? 'Detractors', 'y' => (float)$result['bad'], 'color' => '#ef4444'],
            ]);
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
            $this->error = $result['error'] ?? 'Something went wrong.';
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

        return view('livewire.calculators.nps-calculator');
    }
}
