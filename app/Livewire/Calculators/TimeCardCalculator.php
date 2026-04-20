<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Timedate;
use Illuminate\Support\Carbon;

class TimeCardCalculator extends Component
{
    public $inputs = [];
    public $error = null;
    public $detail = null;
    public $lang = [];
    public $type = 'calculator';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_back_inputs')) {
            $this->inputs = (array)session('calculator_back_inputs');
        } else {
            $this->inputs = [
                'naam' => 'Table1',
                'naam2' => 'Table2',
                'naam3' => 'Table3',
                'naam4' => 'Table4',
                'lunch' => '1',
                'table_selection' => '1',
                'advancedcheck' => false,
                'selection0' => '1', // Selection (Days/Lunch/Overtime/Sick)
                'selection1' => '7', // Hide Days
                'selection2' => '2', // Text Format
                'selection3' => '1', // Time Format (12h/24h)
                'checkbox' => false, // Advanced Option Checkbox
                'holiday_c' => 'no',
                'paid_lunch1' => '',
                'paid_lunch2' => '',
            ];
            
            // Merge with request if any
            $this->inputs = array_merge($this->inputs, request()->all());
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->error = null;
        $this->detail = null;

        $this->inputs = [
            'naam' => 'Table1',
            'naam2' => 'Table2',
            'naam3' => 'Table3',
            'naam4' => 'Table4',
            'lunch' => '1',
            'table_selection' => '1',
            'advancedcheck' => false,
            'selection0' => '1',
            'selection1' => '7',
            'selection2' => '2',
            'selection3' => '1',
            'checkbox' => false,
            'holiday_c' => 'no',
            'paid_lunch1' => '',
            'paid_lunch2' => '',
        ];

        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function getDayLabel($day, $selection2)
    {
        $labels = [
            'mon' => ['1', 'Mon', 'Sun', 'M', 'Mo'],
            'tue' => ['2', 'Tue', 'Mon', 'T', 'Tu'],
            'wed' => ['3', 'Wed', 'Tue', 'W', 'We'],
            'thu' => ['4', 'Thu', 'Wed', 'T', 'Th'],
            'fri' => ['5', 'Fri', 'Thu', 'F', 'Fr'],
            'sat' => ['6', 'Sat', 'Fri', 'S', 'Sa'],
            'sun' => ['7', 'Sun', 'Sat', 'S', 'Su'],
        ];

        return $labels[$day][($selection2 ?? 2) - 1] ?? $labels[$day][1];
    }

    public function calculate()
    {
        $sanitizedInputs = $this->inputs;
        $arraysToSanitize = [
            'inhour', 'inmin', 'inampm', 'outhour', 'outmin', 'outampm',
            'inhourl1', 'inminl1', 'inampml1', 'outhourl1', 'outminl1', 'outampml1',
            'inhourl2', 'inminl2', 'inampml2', 'outhourl2', 'outminl2', 'outampml2',
            'in', 'out', 'inlunch1', 'outlunch1', 'inlunch2', 'outlunch2',
            't2inhour', 't2inmin', 't2inampm', 't2outhour', 't2outmin', 't2outampm',
            't2inhourl1', 't2inminl1', 't2inampml1', 't2outhourl1', 't2outminl1', 't2outampml1',
            't2inhourl2', 't2inminl2', 't2inampml2', 't2outhourl2', 't2outminl2', 't2outampml2',
            't2in', 't2out', 't2inlunch1', 't2outlunch1', 't2inlunch2', 't2outlunch2',
            't3inhour', 't3inmin', 't3inampm', 't3outhour', 't3outmin', 't3outampm',
            't3inhourl1', 't3inminl1', 't3inampml1', 't3outhourl1', 't3outminl1', 't3outampml1',
            't3inhourl2', 't3inminl2', 't3inampml2', 't3outhourl2', 't3outminl2', 't3outampml2',
            't3in', 't3out', 't3inlunch1', 't3outlunch1', 't3inlunch2', 't3outlunch2',
            't4inhour', 't4inmin', 't4inampm', 't4outhour', 't4outmin', 't4outampm',
            't4inhourl1', 't4inminl1', 't4inampml1', 't4outhourl1', 't4outminl1', 't4outampml1',
            't4inhourl2', 't4inminl2', 't4inampml2', 't4outhourl2', 't4outminl2', 't4outampml2',
            't4in', 't4out', 't4inlunch1', 't4outlunch1', 't4inlunch2', 't4outlunch2'
        ];

        foreach ($arraysToSanitize as $key) {
            if (!isset($sanitizedInputs[$key]) || !is_array($sanitizedInputs[$key])) {
                $sanitizedInputs[$key] = array_fill(0, 7, '');
            } else {
                for ($i = 0; $i < 7; $i++) {
                    if (!isset($sanitizedInputs[$key][$i])) {
                        $sanitizedInputs[$key][$i] = '';
                    }
                }
            }
        }

        $request = new \Illuminate\Http\Request($sanitizedInputs);
        $model = new Timedate();
        $result = $model->time_card($request);
        // dd($result);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $this->inputs);
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                session()->flash('calculator_back_inputs', $this->inputs);
                return redirect()->to(url()->previous() ?? '/');
            }
        }
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = 30;
                        const top = el.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.time-card-calculator');
    }
}
