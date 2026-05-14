<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class UogGpaCalculator extends Component
{
    public $currentGpa = '';
    public $currentCredits = '';
    public $gradeFormat = '1'; // 1: Letter, 2: Percentage, 3: Point Value
    public $semesters = [];
    
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
            $this->gradeFormat = $inputs['gradeFormat'] ?? '1';
            $this->semesters = $inputs['semesters'] ?? [];
        }

        if (empty($this->semesters)) {
            $this->addSemester();
        }
    }

    public function addSemester()
    {
        $this->semesters[] = [
            'courses' => [
                ['subject' => '', 'grade' => '', 'credit' => ''],
                ['subject' => '', 'grade' => '', 'credit' => ''],
                ['subject' => '', 'grade' => '', 'credit' => ''],
            ]
        ];
        $this->detail = null;
    }

    public function removeSemester($index)
    {
        if (count($this->semesters) > 1) {
            unset($this->semesters[$index]);
            $this->semesters = array_values($this->semesters);
            $this->detail = null;
        }
    }

    public function addCourse($semesterIndex)
    {
        $this->semesters[$semesterIndex]['courses'][] = ['subject' => '', 'grade' => '', 'credit' => ''];
        $this->detail = null;
    }

    public function removeCourse($semesterIndex, $courseIndex)
    {
        unset($this->semesters[$semesterIndex]['courses'][$courseIndex]);
        $this->semesters[$semesterIndex]['courses'] = array_values($this->semesters[$semesterIndex]['courses']);
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['currentGpa', 'currentCredits', 'gradeFormat', 'semesters', 'detail', 'error']);
        $this->addSemester();
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    private function getGradeValue($grade)
    {
        if ($this->gradeFormat == '1') { // Letter
            return (float)$grade;
        } elseif ($this->gradeFormat == '2') { // Percentage
            $grade = (float)$grade;
            if ($grade < 50) return 0.0;
            if ($grade <= 54) return 1.0;
            if ($grade <= 59) return 1.5;
            if ($grade <= 64) return 2.0;
            if ($grade <= 69) return 2.5;
            if ($grade <= 74) return 3.0;
            if ($grade <= 79) return 3.4;
            if ($grade <= 84) return 3.7;
            return 4.0;
        } else { // Point Value
            return (float)$grade;
        }
    }

    public function calculate()
    {
        $totalGradePoints = 0;
        $totalCredits = 0;
        $semesterResults = [];

        foreach ($this->semesters as $sIndex => $semester) {
            $sGradePoints = 0;
            $sCredits = 0;
            $courseResults = [];

            foreach ($semester['courses'] as $cIndex => $course) {
                if (is_numeric($course['grade']) && is_numeric($course['credit'])) {
                    $gradeVal = $this->getGradeValue($course['grade']);
                    $points = $gradeVal * (float)$course['credit'];
                    
                    $courseResults[] = [
                        'subject' => $course['subject'] ?: 'Course ' . ($cIndex + 1),
                        'grade' => $gradeVal,
                        'credit' => (float)$course['credit'],
                        'points' => round($points, 2),
                    ];

                    $sGradePoints += $points;
                    $sCredits += (float)$course['credit'];
                }
            }

            if ($sCredits > 0) {
                $semesterResults[] = [
                    'name' => 'Semester ' . ($sIndex + 1),
                    'courses' => $courseResults,
                    'totalCredits' => $sCredits,
                    'totalPoints' => round($sGradePoints, 2),
                    'gpa' => round($sGradePoints / $sCredits, 3),
                ];

                $totalGradePoints += $sGradePoints;
                $totalCredits += $sCredits;
            }
        }

        if (is_numeric($this->currentGpa) && is_numeric($this->currentCredits)) {
            $totalGradePoints += (float)$this->currentGpa * (float)$this->currentCredits;
            $totalCredits += (float)$this->currentCredits;
        }

        if ($totalCredits > 0) {
            $cgpa = round($totalGradePoints / $totalCredits, 3);
            
            $result = [
                'RESULT' => 1,
                'cgpa' => number_format($cgpa, 2),
                'totalGradePoints' => number_format($totalGradePoints, 2),
                'totalCredits' => number_format($totalCredits, 2),
                'semesters' => $semesterResults,
            ];

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'currentGpa' => $this->currentGpa,
                'currentCredits' => $this->currentCredits,
                'gradeFormat' => $this->gradeFormat,
                'semesters' => $this->semesters,
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
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.uog-gpa-calculator');
    }
}
