<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class DihybridCrossCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Genotype selection for Mother (Parent 1)
    public $mtype1 = '1'; // Gene A (0=AA, 1=Aa, 2=aa)
    public $mtype2 = '1'; // Gene B (0=BB, 1=Bb, 2=bb)

    // Genotype selection for Father (Parent 2)
    public $ftype1 = '1'; // Gene A (0=AA, 1=Aa, 2=aa)
    public $ftype2 = '1'; // Gene B (0=BB, 1=Bb, 2=bb)

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
        if (in_array($propertyName, ['mtype1', 'mtype2', 'ftype1', 'ftype2'])) {
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->mtype1 = '1';
        $this->mtype2 = '1';
        $this->ftype1 = '1';
        $this->ftype2 = '1';

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
            'mtype1' => $this->mtype1,
            'mtype2' => $this->mtype2,
            'ftype1' => $this->ftype1,
            'ftype2' => $this->ftype2,
        ];

        $model = new Health();
        $result = $model->dihybrid($request);

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
        return view('livewire.calculators.dihybrid-cross-calculator');
    }
}
