<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class UfGpaCalculator extends Component
{
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
            $this->courses = $inputs['courses'] ?? [];
        }

        if (empty($this->courses)) {
            $this->addCourse();
            $this->addCourse();
            $this->addCourse();
            $this->addCourse();
        }
    }

    public function addCourse()
    {
        $this->courses[] = ['subject' => '', 'grade' => '', 'credit' => '3', 'points' => ''];
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
        if (str_contains($propertyName, 'courses')) {
            $parts = explode('.', $propertyName);
            if (count($parts) === 3) {
                $index = $parts[1];
                $field = $parts[2];

                if ($field === 'grade' || $field === 'credit') {
                    $grade = (float)($this->courses[$index]['grade'] ?? 0);
                    $credit = (float)($this->courses[$index]['credit'] ?? 0);
                    if ($grade > 0 && $credit > 0) {
                        $this->courses[$index]['points'] = number_format($grade * $credit, 3, '.', '');
                    } else {
                        $this->courses[$index]['points'] = '';
                    }
                }
            }
        }
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $totalGradePoints = 0;
        $totalCredits = 0;
        $courseResults = [];

        foreach ($this->courses as $index => $course) {
            if ($course['grade'] !== '' && is_numeric($course['credit'])) {
                $gradeVal = (float)$course['grade'];
                $credit = (float)$course['credit'];
                $points = $gradeVal * $credit;

                $courseResults[] = [
                    'subject' => $course['subject'] ?: 'Course ' . ($index + 1),
                    'grade' => number_format($gradeVal, 2),
                    'credit' => $credit,
                    'points' => number_format($points, 2),
                ];

                $totalGradePoints += $points;
                $totalCredits += $credit;
            }
        }

        if ($totalCredits > 0) {
            $gpa = $totalGradePoints / $totalCredits;
            $deficitPoints = 0;
            if ($gpa < 2.0) {
                $deficitPoints = ($totalCredits * 2.0) - $totalGradePoints;
            }

            $result = [
                'RESULT' => 1,
                'gpa' => number_format($gpa, 2),
                'totalGradePoints' => number_format($totalGradePoints, 2),
                'totalCredits' => number_format($totalCredits, 2),
                'deficitPoints' => number_format($deficitPoints, 2),
                'courses' => $courseResults,
            ];

            session()->flash('calculator_result', $result);
            $this->flashInputs();
            
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

    public function resetForm()
    {
        $this->courses = [];
        $this->detail = null;
        $this->error = null;
        $this->addCourse();
        $this->addCourse();
        $this->addCourse();
        $this->addCourse();
        session()->forget(['calculator_result', 'calculator_back_inputs']);
    }

    private function flashInputs()
    {
        session()->flash('calculator_back_inputs', [
            'courses' => $this->courses,
        ]);
    }

    public function render()
    {
        return view('livewire.calculators.uf-gpa-calculator');
    }
}
