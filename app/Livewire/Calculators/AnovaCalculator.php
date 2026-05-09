<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class AnovaCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $calculator_type = 'one_way'; // 'one_way' or 'two_way'
    public $groups = []; // For One-Way ANOVA
    public $table_data = []; // For Two-Way ANOVA
    public $rows = 3;
    public $columns = 4;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        // Initial state for One-Way
        $this->groups = [
            1 => '5, 1, 11, 2, 8',
            2 => '0, 1, 4, 6, 3',
            3 => '0, 1, 4, 6, 3'
        ];

        // Initial state for Two-Way
        $this->table_data = [
            0 => ['4,6,8', '4,8,9', '8,9,13', '7,6,5'],
            1 => ['6,6,9', '7,10,13', '12,14,16', '3,7,9'],
            2 => ['6,9,4', '5,7,12', '16,8,1', '2,3,4']
        ];

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calculator_type = $inputs->type ?? 'one_way';
            if ($this->calculator_type === 'one_way') {
                $this->groups = (array)$inputs->groups;
            } else {
                $this->rows = $inputs->rows;
                $this->columns = $inputs->columns;
                $this->table_data = array_map(function($row) { return (array)$row; }, (array)$inputs->table_data);
            }
        }
    }

    public function setCalculatorType($type)
    {
        $this->calculator_type = $type;
    }

    public function addGroup()
    {
        if (count($this->groups) >= 10) {
            $this->error = "Only 10 fields are allowed";
            return;
        }
        $nextIndex = count($this->groups) + 1;
        $this->groups[$nextIndex] = '';
    }

    public function removeGroup()
    {
        if (count($this->groups) > 2) {
            array_pop($this->groups);
        }
    }

    public function addRow()
    {
        if ($this->rows < 10) {
            $this->rows++;
            $this->table_data[$this->rows - 1] = array_fill(0, $this->columns, '');
        }
    }

    public function removeRow()
    {
        if ($this->rows > 2) {
            unset($this->table_data[$this->rows - 1]);
            $this->rows--;
        }
    }

    public function addColumn()
    {
        if ($this->columns < 10) {
            $this->columns++;
            for ($i = 0; $i < $this->rows; $i++) {
                $this->table_data[$i][$this->columns - 1] = '';
            }
        }
    }

    public function removeColumn()
    {
        if ($this->columns > 2) {
            for ($i = 0; $i < $this->rows; $i++) {
                unset($this->table_data[$i][$this->columns - 1]);
            }
            $this->columns--;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'type'    => $this->calculator_type,
            'k'       => count($this->groups),
            'groups'  => $this->groups,
            'rows'    => $this->rows,
            'columns' => $this->columns,
            'table_data' => $this->table_data,
        ];

        $model = new Statistics();
        $result = $model->anova($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->dispatch('math-updated');
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        if ($this->detail) {
            $this->js('setTimeout(() => { window.calculateANOVA('.json_encode($this->detail).'); }, 100);');
        }

        return view('livewire.calculators.anova-calculator');
    }
}
