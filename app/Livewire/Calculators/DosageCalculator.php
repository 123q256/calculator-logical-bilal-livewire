<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class DosageCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $w = ''; // Weight
    public $w1 = 'kg'; // Weight unit
    public $d = ''; // Dosage
    public $d1 = 'µg/kg'; // Dosage unit
    public $f = '1'; // Frequency
    public $mc = ''; // Concentration
    public $mc1 = 'g/L'; // Concentration unit

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

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['w', 'w1', 'd', 'd1', 'f', 'mc', 'mc1'])) {
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->w = '';
        $this->w1 = 'kg';
        $this->d = '';
        $this->d1 = 'µg/kg';
        $this->f = '1';
        $this->mc = '';
        $this->mc1 = 'g/L';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'w'   => $this->w,
            'w1'  => $this->w1,
            'd'   => $this->d,
            'd1'  => $this->d1,
            'f'   => $this->f,
            'mc'  => $this->mc,
            'mc1' => $this->mc1,
        ];

        $model = new Health();
        $result = $model->dosage($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    public function render()
    {
        return view('livewire.calculators.dosage-calculator');
    }
}
