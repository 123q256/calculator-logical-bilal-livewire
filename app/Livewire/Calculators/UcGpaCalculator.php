<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class UcGpaCalculator extends Component
{
    public $currentGpa = '';
    public $currentCredits = '';
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
                ['subject' => '', 'grade' => '', 'credit' => '1', 'isHonors' => false],
                ['subject' => '', 'grade' => '', 'credit' => '1', 'isHonors' => false],
                ['subject' => '', 'grade' => '', 'credit' => '1', 'isHonors' => false],
                ['subject' => '', 'grade' => '', 'credit' => '1', 'isHonors' => false],
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
        $this->semesters[$sIndex]['courses'][] = ['subject' => '', 'grade' => '', 'credit' => '1', 'isHonors' => false];
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
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $totalUnweightedPoints = 0;
        $totalHonorsPoints = 0;
        $totalCredits = 0;
        $semesterResults = [];

        foreach ($this->semesters as $sIndex => $semester) {
            $sUnweightedPoints = 0;
            $sHonorsPoints = 0;
            $sCredits = 0;
            $courseResults = [];

            foreach ($semester['courses'] as $cIndex => $course) {
                if ($course['grade'] !== '' && is_numeric($course['credit'])) {
                    $gradeVal = (float)$course['grade'];
                    $credit = (float)$course['credit'];
                    
                    $points = $gradeVal * $credit;
                    $honorsPoint = 0;
                    
                    if ($course['isHonors'] && $gradeVal >= 2.0) { // C or better
                        $honorsPoint = 1 * $credit;
                    }

                    $courseResults[] = [
                        'subject' => $course['subject'] ?: 'Course ' . ($cIndex + 1),
                        'grade' => number_format($gradeVal, 2),
                        'credit' => $credit,
                        'points' => number_format($points, 2),
                        'isHonors' => $course['isHonors']
                    ];

                    $sUnweightedPoints += $points;
                    $sHonorsPoints += $honorsPoint;
                    $sCredits += $credit;
                }
            }

            if ($sCredits > 0) {
                $semesterResults[] = [
                    'name' => 'Semester ' . ($sIndex + 1),
                    'courses' => $courseResults,
                    'totalCredits' => $sCredits,
                    'gpa' => number_format($sUnweightedPoints / $sCredits, 3),
                ];
                $totalUnweightedPoints += $sUnweightedPoints;
                $totalHonorsPoints += $sHonorsPoints;
                $totalCredits += $sCredits;
            }
        }

        if (is_numeric($this->currentGpa) && is_numeric($this->currentCredits)) {
            $totalUnweightedPoints += (float)$this->currentGpa * (float)$this->currentCredits;
            $totalCredits += (float)$this->currentCredits;
        }

        if ($totalCredits > 0) {
            // UC Capped GPA: max 8 honors semesters (usually 8 points if credits are 1)
            // Note: UC honors points are usually capped at 8 semesters for 10th-11th grade.
            // If credit is 1 per semester, it's 8 points.
            $cappedHonorsPoints = min($totalHonorsPoints, 8);
            
            $unweightedGpa = $totalUnweightedPoints / $totalCredits;
            $weightedGpa = ($totalUnweightedPoints + $totalHonorsPoints) / $totalCredits;
            $cappedGpa = ($totalUnweightedPoints + $cappedHonorsPoints) / $totalCredits;

            $color = '#B71919';
            if ($cappedGpa >= 3.5) $color = '#13699E';
            elseif ($cappedGpa >= 3.0) $color = '#54B725';

            $result = [
                'RESULT' => 1,
                'unweightedGpa' => number_format($unweightedGpa, 2),
                'weightedGpa' => number_format($weightedGpa, 2),
                'cappedGpa' => number_format($cappedGpa, 2),
                'totalGradePoints' => number_format($totalUnweightedPoints, 2),
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

    public function resetForm()
    {
        $this->semesters = [];
        $this->currentGpa = '';
        $this->currentCredits = '';
        $this->detail = null;
        $this->error = null;
        $this->addSemester();
        session()->forget(['calculator_result', 'calculator_back_inputs']);
    }

    private function flashInputs()
    {
        session()->flash('calculator_back_inputs', [
            'currentGpa' => $this->currentGpa,
            'currentCredits' => $this->currentCredits,
            'semesters' => $this->semesters,
        ]);
    }

    public function render()
    {
        return view('livewire.calculators.uc-gpa-calculator');
    }
}
