<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class GpaCalculator extends Component
{
    public $mode = '1'; // 1: Weighted, 2: Unweighted
    public $gradeFormat = '1'; // 1: Letter, 2: Percentage, 3: Point Value
    
    public $currentGpa = '';
    public $currentCredits = '';
    public $semesters = [];
    
    // Planning inputs
    public $pGpa = '3.0';
    public $pHours = '30';
    public $tGpa = '3.5';
    public $tHours = '15';
    
    public $error = null;
    public $detail = null;
    public $planningDetail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->planningDetail = session('planning_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->mode = $inputs['mode'] ?? '1';
            $this->gradeFormat = $inputs['gradeFormat'] ?? '1';
            $this->currentGpa = $inputs['currentGpa'] ?? '';
            $this->currentCredits = $inputs['currentCredits'] ?? '';
            $this->semesters = $inputs['semesters'] ?? [];
            $this->pGpa = $inputs['pGpa'] ?? '3.0';
            $this->pHours = $inputs['pHours'] ?? '30';
            $this->tGpa = $inputs['tGpa'] ?? '3.5';
            $this->tHours = $inputs['tHours'] ?? '15';
        }

        if (empty($this->semesters)) {
            $this->addSemester();
        }
    }

    public function addSemester()
    {
        $this->semesters[] = [
            'courses' => [
                ['subject' => '', 'grade' => '', 'credit' => '', 'weight' => '0.0'],
                ['subject' => '', 'grade' => '', 'credit' => '', 'weight' => '0.0'],
                ['subject' => '', 'grade' => '', 'credit' => '', 'weight' => '0.0'],
                ['subject' => '', 'grade' => '', 'credit' => '', 'weight' => '0.0'],
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

    public function addCourse($sIndex)
    {
        $this->semesters[$sIndex]['courses'][] = ['subject' => '', 'grade' => '', 'credit' => '', 'weight' => '0.0'];
        $this->detail = null;
    }

    public function removeCourse($sIndex, $cIndex)
    {
        if (count($this->semesters[$sIndex]['courses']) > 1) {
            unset($this->semesters[$sIndex]['courses'][$cIndex]);
            $this->semesters[$sIndex]['courses'] = array_values($this->semesters[$sIndex]['courses']);
            $this->detail = null;
        }
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'pGpa') || str_starts_with($propertyName, 'pHours') || str_starts_with($propertyName, 'tGpa') || str_starts_with($propertyName, 'tHours')) {
            $this->planningDetail = null;
        } else {
            $this->detail = null;
        }
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['currentGpa', 'currentCredits', 'semesters', 'detail', 'error', 'planningDetail']);
        $this->addSemester();
        session()->forget(['calculator_result', 'planning_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->current());
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
                if ($course['grade'] !== '' && is_numeric($course['credit'])) {
                    $gradeVal = 0;
                    
                    if ($this->gradeFormat == '1') { // Letter
                        $gradeVal = (float)$course['grade'];
                    } elseif ($this->gradeFormat == '2') { // Percentage
                        $percent = (float)$course['grade'];
                        if ($percent >= 93) $gradeVal = 4.0;
                        elseif ($percent >= 90) $gradeVal = 3.7;
                        elseif ($percent >= 87) $gradeVal = 3.3;
                        elseif ($percent >= 83) $gradeVal = 3.0;
                        elseif ($percent >= 80) $gradeVal = 2.7;
                        elseif ($percent >= 77) $gradeVal = 2.3;
                        elseif ($percent >= 73) $gradeVal = 2.0;
                        elseif ($percent >= 70) $gradeVal = 1.7;
                        elseif ($percent >= 67) $gradeVal = 1.3;
                        elseif ($percent >= 65) $gradeVal = 1.0;
                        else $gradeVal = 0.0;
                    } elseif ($this->gradeFormat == '3') { // Point Value
                        $gradeVal = (float)$course['grade'];
                    }

                    // Add weight if mode is Weighted
                    if ($this->mode == '1' && is_numeric($course['weight'])) {
                        $gradeVal += (float)$course['weight'];
                    }

                    $points = $gradeVal * (float)$course['credit'];
                    
                    $courseResults[] = [
                        'subject' => $course['subject'] ?: 'Course ' . ($cIndex + 1),
                        'grade' => number_format($gradeVal, 2),
                        'credit' => (float)$course['credit'],
                        'points' => number_format($points, 2),
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
                    'gpa' => number_format($sGradePoints / $sCredits, 3),
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
            $cgpa = $totalGradePoints / $totalCredits;
            
            $color = '#B71919'; // Default Red
            if ($cgpa >= 3.5) $color = '#13699E'; // Blue
            elseif ($cgpa >= 3.0) $color = '#54B725'; // Green

            $result = [
                'RESULT' => 1,
                'cgpa' => number_format($cgpa, 2),
                'totalGradePoints' => number_format($totalGradePoints, 2),
                'totalCredits' => number_format($totalCredits, 2),
                'semesters' => $semesterResults,
                'color' => $color,
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

    public function calculatePlanning()
    {
        if (is_numeric($this->pGpa) && is_numeric($this->pHours) && is_numeric($this->tGpa) && is_numeric($this->tHours) && $this->tHours > 0) {
            $pPoints = (float)$this->pGpa * (float)$this->pHours;
            $totalTargetHours = (float)$this->pHours + (float)$this->tHours;
            $totalTargetPoints = (float)$this->tGpa * $totalTargetHours;
            
            $requiredGpa = ($totalTargetPoints - $pPoints) / (float)$this->tHours;
            
            $color = '#B71919';
            if ($requiredGpa >= 3.5) $color = '#13699E';
            elseif ($requiredGpa >= 3.0) $color = '#54B725';

            $result = [
                'pGpa' => $this->pGpa,
                'pHours' => $this->pHours,
                'tGpa' => $this->tGpa,
                'tHours' => $this->tHours,
                'requiredGpa' => number_format($requiredGpa, 3),
                'color' => $color,
            ];

            session()->flash('planning_result', $result);
            $this->flashInputs();
            $this->planningDetail = $result;

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('planning-result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
    }

    private function flashInputs()
    {
        session()->flash('calculator_back_inputs', [
            'mode' => $this->mode,
            'gradeFormat' => $this->gradeFormat,
            'currentGpa' => $this->currentGpa,
            'currentCredits' => $this->currentCredits,
            'semesters' => $this->semesters,
            'pGpa' => $this->pGpa,
            'pHours' => $this->pHours,
            'tGpa' => $this->tGpa,
            'tHours' => $this->tHours,
        ]);
    }

    public function render()
    {
        return view('livewire.calculators.gpa-calculator');
    }

    public function resetCalculator()
    {
        $this->semesters = [
            [
                'courses' => [
                    ['subject' => '', 'credit' => '', 'grade' => '', 'weight' => '0.0'],
                    ['subject' => '', 'credit' => '', 'grade' => '', 'weight' => '0.0'],
                    ['subject' => '', 'credit' => '', 'grade' => '', 'weight' => '0.0'],
                    ['subject' => '', 'credit' => '', 'grade' => '', 'weight' => '0.0'],
                ]
            ]
        ];
        $this->currentGpa = '';
        $this->currentCredits = '';
        $this->detail = null;
        $this->error = null;
        session()->forget('calculator_result');
    }

    public function resetPlanning()
    {
        $this->pGpa = '3';
        $this->pHours = '3';
        $this->tGpa = '3';
        $this->tHours = '1';
        $this->planningDetail = null;
        session()->forget('planning_result');
    }
}
