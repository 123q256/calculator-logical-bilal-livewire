<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class FinalGradeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $selection = '1';
    public $type_selection = 'first';
    public $grading_system = '2';
    public $current_grade = 4;
    public $final_exam_grade2 = 4;
    public $current_grade2 = [4];
    public $final_exam_weight2 = [4];
    public $current_letter = ['A+'];
    public $pollard = [4];
    public $target_letter = 'A+';
    public $target_grade2 = 4;
    public $total_weight2 = 8;
    public $final_exam_weight3 = 4;
    public $grading_system2 = '2';
    public $you_want = 4;
    public $final_exam_grade1 = 4;
    public $grade_was = [4];
    public $worth = [4];
    
    public $current_grade3 = 'A+';
    public $target_grade3 = 'A+';
    public $current_grade4 = 'A';
    public $target_grade4 = 'A';
    public $current_grade5 = 'Band6';
    public $target_grade5 = 'Band6';
    public $current_grade6 = 'HD';
    public $target_grade6 = 'HD';
    public $current_grade7 = 'A1';
    public $target_grade7 = 'A1';
    public $current_grade8 = 'A+';
    public $target_grade8 = 'A+';
    public $current_grade9 = 'A*';
    public $target_grade9 = 'A*';
    
    public $final_exam_weight = 6;
    
    public $c = ['A+'];
    public $grade_was2 = [4];
    public $undertaker = 'A+';
    
    public $c2 = ['A'];
    public $grade_was3 = [4];
    public $undertaker2 = 'A';
    
    public $c3 = ['A+'];
    public $grade_was4 = [4];
    public $undertaker3 = 'A+';
    
    public $c4 = ['A*'];
    public $grade_was5 = [4];
    public $undertaker4 = 'A*';
    
    public $c5 = ['Band6'];
    public $grade_was6 = [4];
    public $undertaker5 = 'Band6';
    
    public $c6 = ['HD'];
    public $grade_was7 = [4];
    public $undertaker6 = 'HD';
    
    public $c7 = ['A1'];
    public $grade_was8 = [4];
    public $undertaker7 = 'A1';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        if (session()->has('calculator_result')) {
            $this->detail = $this->sanitizeForLivewire(session('calculator_result'));
        }
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $val) {
                if (property_exists($this, $key) && $key !== 'type') {
                    $this->$key = $val;
                }
            }
            if(isset($inputs['type'])) {
                $this->type_selection = $inputs['type'];
            }
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->reset([
            'selection', 'type_selection', 'grading_system', 'current_grade', 'final_exam_grade2',
            'current_grade2', 'final_exam_weight2', 'current_letter', 'pollard', 'target_letter',
            'target_grade2', 'total_weight2', 'final_exam_weight3', 'grading_system2', 'you_want',
            'final_exam_grade1', 'grade_was', 'worth', 'current_grade3', 'target_grade3',
            'current_grade4', 'target_grade4', 'current_grade5', 'target_grade5', 'current_grade6',
            'target_grade6', 'current_grade7', 'target_grade7', 'current_grade8', 'target_grade8',
            'current_grade9', 'target_grade9', 'final_exam_weight', 'c', 'grade_was2', 'undertaker',
            'c2', 'grade_was3', 'undertaker2', 'c3', 'grade_was4', 'undertaker3', 'c4', 'grade_was5',
            'undertaker4', 'c5', 'grade_was6', 'undertaker5', 'c6', 'grade_was7', 'undertaker6',
            'c7', 'grade_was8', 'undertaker7'
        ]);

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

    public function addField($list)
    {
        if ($list == 'cd2') {
            $this->current_grade2[] = '';
            $this->final_exam_weight2[] = '';
        } elseif ($list == 'cd3') {
            $this->current_letter[] = 'A+';
            $this->pollard[] = '';
        } elseif ($list == 'cd4') {
            $this->grade_was[] = '';
            $this->worth[] = '';
        } elseif ($list == 'cd5') {
            $this->c[] = 'A+';
            $this->grade_was2[] = '';
        } elseif ($list == 'cd6') {
            $this->c2[] = 'A';
            $this->grade_was3[] = '';
        } elseif ($list == 'cd7') {
            $this->c3[] = 'A+';
            $this->grade_was4[] = '';
        } elseif ($list == 'cd8') {
            $this->c4[] = 'A*';
            $this->grade_was5[] = '';
        } elseif ($list == 'cd9') {
            $this->c5[] = 'Band6';
            $this->grade_was6[] = '';
        } elseif ($list == 'cd10') {
            $this->c6[] = 'HD';
            $this->grade_was7[] = '';
        } elseif ($list == 'cd11') {
            $this->c7[] = 'A1';
            $this->grade_was8[] = '';
        }
    }
    
    public function removeField($list, $index)
    {
        if ($list == 'cd2') {
            unset($this->current_grade2[$index]);
            unset($this->final_exam_weight2[$index]);
            $this->current_grade2 = array_values($this->current_grade2);
            $this->final_exam_weight2 = array_values($this->final_exam_weight2);
        } elseif ($list == 'cd3') {
            unset($this->current_letter[$index]);
            unset($this->pollard[$index]);
            $this->current_letter = array_values($this->current_letter);
            $this->pollard = array_values($this->pollard);
        } elseif ($list == 'cd4') {
            unset($this->grade_was[$index]);
            unset($this->worth[$index]);
            $this->grade_was = array_values($this->grade_was);
            $this->worth = array_values($this->worth);
        } elseif ($list == 'cd5') {
            unset($this->c[$index]);
            unset($this->grade_was2[$index]);
            $this->c = array_values($this->c);
            $this->grade_was2 = array_values($this->grade_was2);
        } elseif ($list == 'cd6') {
            unset($this->c2[$index]);
            unset($this->grade_was3[$index]);
            $this->c2 = array_values($this->c2);
            $this->grade_was3 = array_values($this->grade_was3);
        } elseif ($list == 'cd7') {
            unset($this->c3[$index]);
            unset($this->grade_was4[$index]);
            $this->c3 = array_values($this->c3);
            $this->grade_was4 = array_values($this->grade_was4);
        } elseif ($list == 'cd8') {
            unset($this->c4[$index]);
            unset($this->grade_was5[$index]);
            $this->c4 = array_values($this->c4);
            $this->grade_was5 = array_values($this->grade_was5);
        } elseif ($list == 'cd9') {
            unset($this->c5[$index]);
            unset($this->grade_was6[$index]);
            $this->c5 = array_values($this->c5);
            $this->grade_was6 = array_values($this->grade_was6);
        } elseif ($list == 'cd10') {
            unset($this->c6[$index]);
            unset($this->grade_was7[$index]);
            $this->c6 = array_values($this->c6);
            $this->grade_was7 = array_values($this->grade_was7);
        } elseif ($list == 'cd11') {
            unset($this->c7[$index]);
            unset($this->grade_was8[$index]);
            $this->c7 = array_values($this->c7);
            $this->grade_was8 = array_values($this->grade_was8);
        }
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function getLetterFromGPA($gpa)
    {
        $lettertbl = ['A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'D-', 'F'];
        $gpatbl = [4.33, 4.00, 3.67, 3.33, 3.00, 2.67, 2.33, 2.00, 1.67, 1.33, 1.00, 0.67, 0];
        foreach ($gpatbl as $i => $tblGpa) {
            if ($gpa >= $tblGpa) {
                return $lettertbl[$i];
            }
        }
        return 'F';
    }

    public function calculate()
    {
        $request = new \Illuminate\Http\Request();
        $request->replace([
            'selection' => $this->selection,
            'type' => $this->type_selection,
            'grading_system' => $this->grading_system,
            'current_grade' => $this->current_grade,
            'final_exam_grade2' => $this->final_exam_grade2,
            'current_grade2' => $this->current_grade2,
            'final_exam_weight2' => $this->final_exam_weight2,
            'current_letter' => $this->current_letter,
            'pollard' => $this->pollard,
            'target_letter' => $this->target_letter,
            'target_grade2' => $this->target_grade2,
            'total_weight2' => $this->total_weight2,
            'final_exam_weight3' => $this->final_exam_weight3,
            'grading_system2' => $this->grading_system2,
            'you_want' => $this->you_want,
            'final_exam_grade1' => $this->final_exam_grade1,
            'grade_was' => $this->grade_was,
            'worth' => $this->worth,
            'current_grade3' => $this->current_grade3,
            'target_grade3' => $this->target_grade3,
            'current_grade4' => $this->current_grade4,
            'target_grade4' => $this->target_grade4,
            'current_grade5' => $this->current_grade5,
            'target_grade5' => $this->target_grade5,
            'current_grade6' => $this->current_grade6,
            'target_grade6' => $this->target_grade6,
            'current_grade7' => $this->current_grade7,
            'target_grade7' => $this->target_grade7,
            'current_grade8' => $this->current_grade8,
            'target_grade8' => $this->target_grade8,
            'current_grade9' => $this->current_grade9,
            'target_grade9' => $this->target_grade9,
            'final_exam_weight' => $this->final_exam_weight,
            'c' => $this->c,
            'grade_was2' => $this->grade_was2,
            'undertaker' => $this->undertaker,
            'c2' => $this->c2,
            'grade_was3' => $this->grade_was3,
            'undertaker2' => $this->undertaker2,
            'c3' => $this->c3,
            'grade_was4' => $this->grade_was4,
            'undertaker3' => $this->undertaker3,
            'c4' => $this->c4,
            'grade_was5' => $this->grade_was5,
            'undertaker4' => $this->undertaker4,
            'c5' => $this->c5,
            'grade_was6' => $this->grade_was6,
            'undertaker5' => $this->undertaker5,
            'c6' => $this->c6,
            'grade_was7' => $this->grade_was7,
            'undertaker6' => $this->undertaker6,
            'c7' => $this->c7,
            'grade_was8' => $this->grade_was8,
            'undertaker7' => $this->undertaker7,
        ]);

        $model = new Math();
        $result = $model->final_grade($request);
        // dd($result);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request->all());
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $this->sanitizeForLivewire($result);
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
        }
        return view('livewire.calculators.final-grade-calculator');
    }
    
    private function sanitizeForLivewire($data)
    {
        if (is_null($data)) return null;
        $sanitized = json_decode(json_encode($data), true);
        if (is_array($sanitized)) {
            array_walk_recursive($sanitized, function (&$item) {
                if (is_float($item)) {
                    $item = (string) $item;
                }
            });
        }
        return $sanitized;
    }
}