<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class IuGpaCalculator extends Component
{
    public $currentGpa = '';
    public $currentCredits = '';
    public $courses = [];
    
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->currentGpa = $inputs['currentGpa'] ?? '';
            $this->currentCredits = $inputs['currentCredits'] ?? '';
            $this->courses = $inputs['courses'] ?? [];
        }

        if (empty($this->courses)) {
            $this->addCourse();
            $this->addCourse();
            $this->addCourse();
        }
    }

    public function addCourse()
    {
        $this->courses[] = ['subject' => '', 'grade' => '', 'credit' => ''];
        $this->detail = null;
    }

    public function removeCourse($index)
    {
        if (count($this->courses) > 1) {
            unset($this->courses[$index]);
            $this->courses = array_values($this->courses);
            $this->detail = null;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['currentGpa', 'currentCredits', 'courses', 'detail', 'error']);
        $this->addCourse();
        $this->addCourse();
        $this->addCourse();
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $totalGradePoints = 0;
        $totalCredits = 0;
        $courseResults = [];

        foreach ($this->courses as $index => $course) {
            if (is_numeric($course['grade']) && is_numeric($course['credit'])) {
                $gradeVal = (float)$course['grade'];
                $points = $gradeVal * (float)$course['credit'];
                
                $courseResults[] = [
                    'subject' => $course['subject'] ?: 'Course ' . ($index + 1),
                    'grade' => $gradeVal,
                    'credit' => (float)$course['credit'],
                    'points' => number_format($points, 2),
                ];

                $totalGradePoints += $points;
                $totalCredits += (float)$course['credit'];
            }
        }

        if (is_numeric($this->currentGpa) && is_numeric($this->currentCredits)) {
            $totalGradePoints += (float)$this->currentGpa * (float)$this->currentCredits;
            $totalCredits += (float)$this->currentCredits;
        }

        if ($totalCredits > 0) {
            $gpa = round($totalGradePoints / $totalCredits, 3);
            
            $result = [
                'RESULT' => 1,
                'gpa' => number_format($gpa, 2),
                'totalGradePoints' => number_format($totalGradePoints, 2),
                'totalCredits' => number_format($totalCredits, 2),
                'courses' => $courseResults,
            ];

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'currentGpa' => $this->currentGpa,
                'currentCredits' => $this->currentCredits,
                'courses' => $this->courses,
            ]);
            
            $this->detail = $result;
            $this->error = null;

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            return;
        }

        $this->error = 'Please fill at least one course with grade and credits.';
        $this->detail = null;
    }

    public function render()
    {
        return view('livewire.calculators.iu-gpa-calculator');
    }
}
