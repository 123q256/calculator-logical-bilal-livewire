<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class AverageTimeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $rows = [
        ['hour' => '', 'min' => '', 'sec' => '', 'milli' => ''],
        ['hour' => '', 'min' => '', 'sec' => '', 'milli' => ''],
    ];

    public $showHours = true;
    public $showMinutes = true;
    public $showSeconds = true;
    public $showMilli = true;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->rows = $inputs['rows'] ?? $this->rows;
            $this->showHours = $inputs['checkbox1'] ?? true;
            $this->showMinutes = $inputs['checkbox2'] ?? true;
            $this->showSeconds = $inputs['checkbox3'] ?? true;
            $this->showMilli = $inputs['checkbox4'] ?? true;
        }
    }

    public function addRow()
    {
        if (count($this->rows) < 20) {
            $this->rows[] = ['hour' => '', 'min' => '', 'sec' => '', 'milli' => ''];
        } else {
            $this->error = 'Max Limit Reached';
        }
    }

    public function removeRow($index)
    {
        if (count($this->rows) > 2) {
            unset($this->rows[$index]);
            $this->rows = array_values($this->rows);
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->rows = [
            ['hour' => '', 'min' => '', 'sec' => '', 'milli' => ''],
            ['hour' => '', 'min' => '', 'sec' => '', 'milli' => ''],
        ];

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
        $inhour = [];
        $inminutes = [];
        $inseconds = [];
        $inmiliseconds = [];

        foreach ($this->rows as $row) {
            $inhour[] = $row['hour'];
            $inminutes[] = $row['min'];
            $inseconds[] = $row['sec'];
            $inmiliseconds[] = $row['milli'];
        }

        $data = (object)[
            'count_val' => count($this->rows),
            'inhour' => $inhour,
            'inminutes' => $inminutes,
            'inseconds' => $inseconds,
            'inmiliseconds' => $inmiliseconds,
            'checkbox1' => $this->showHours,
            'checkbox2' => $this->showMinutes,
            'checkbox3' => $this->showSeconds,
            'checkbox4' => $this->showMilli,
        ];

        $model = new EverydayLife();
        $result = $model->average($data);
        // dd($result);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'rows' => $this->rows,
                'checkbox1' => $this->showHours,
                'checkbox2' => $this->showMinutes,
                'checkbox3' => $this->showSeconds,
                'checkbox4' => $this->showMilli,
            ]);

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
            $this->detail = $result;
            $this->error = null;
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
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
        return view('livewire.calculators.average-time-calculator');
    }
}
