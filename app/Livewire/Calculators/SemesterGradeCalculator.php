<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class SemesterGradeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $f_grade = 100;
    public $f_weight = 43;
    public $s_grade = 25;
    public $s_weight = 41;
    public $l_grade = 10;
    public $l_weight = 16; // Changed from -10 to 16 to sum to 100 (43+41+16=100)

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->f_grade = $inputs->f_grade ?? 100;
            $this->f_weight = $inputs->f_weight ?? 43;
            $this->s_grade = $inputs->s_grade ?? 25;
            $this->s_weight = $inputs->s_weight ?? 41;
            $this->l_grade = $inputs->l_grade ?? 10;
            $this->l_weight = $inputs->l_weight ?? 16;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->f_grade = 100;
        $this->f_weight = 43;
        $this->s_grade = 25;
        $this->s_weight = 41;
        $this->l_grade = 10;
        $this->l_weight = 16;
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $request = (object)[
            'f_grade'  => $this->f_grade,
            'f_weight' => $this->f_weight,
            's_grade'  => $this->s_grade,
            's_weight' => $this->s_weight,
            'l_grade'  => $this->l_grade,
            'l_weight' => $this->l_weight,
        ];

        $model = new EverydayLife();
        $result = $model->semester($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            
            $chartData = [
                ['name' => $this->lang['1'] ?? 'First Quarter', 'y' => (float)$this->f_weight],
                ['name' => $this->lang['4'] ?? 'Second Quarter', 'y' => (float)$this->s_weight],
                ['name' => $this->lang['5'] ?? 'Final Exam', 'y' => (float)$this->l_weight],
            ];

            $result['chartData'] = $chartData;
            $this->detail = $result;
            $this->error = null;

            $this->dispatch('chart-updated', $chartData);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->current());
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
        }
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
        }
        return view('livewire.calculators.semester-grade-calculator');
    }
}
