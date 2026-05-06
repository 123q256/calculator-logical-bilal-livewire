<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class PpiCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $h = '1920';
    public $v = '1080';
    public $d = '21.5';
    public $unit = 'cm';
    public $myName = 'empty';
    public $myName2 = 'empty';
    public $myName3 = 'empty';

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function updatedMyName($value)
    {
        $this->handlePreset($value);
    }

    public function updatedMyName2($value)
    {
        $this->handlePreset($value);
    }

    public function updatedMyName3($value)
    {
        $this->handlePreset($value);
    }

    private function handlePreset($value)
    {
        if ($value !== 'empty') {
            $parts = explode('x', $value);
            $this->h = $parts[0];
            $this->v = $parts[1];
            $diagonalInches = (float)$parts[2];

            if ($this->unit === 'cm') {
                $this->d = round($diagonalInches * 2.54, 5);
            } elseif ($this->unit === 'm') {
                $this->d = round($diagonalInches / 39.37, 5);
            } elseif ($this->unit === 'ft') {
                $this->d = round($diagonalInches / 12, 5);
            } elseif ($this->unit === 'yd') {
                $this->d = round($diagonalInches / 36, 5);
            } else {
                $this->d = $diagonalInches;
            }
        }
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function resetForm()
    {
        $this->reset(['h', 'v', 'd', 'unit', 'myName', 'myName2', 'myName3', 'detail', 'error']);

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

    public function calculate()
    {
        $requestData = [
            'h'    => $this->h,
            'v'    => $this->v,
            'd'    => $this->d,
            'unit' => $this->unit,
            'submit' => true,
        ];

        $model = new EverydayLife();
        $result = $model->ppi((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->previous() ?? '/');
            } else {
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
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
        return view('livewire.calculators.ppi-calculator');
    }
}
