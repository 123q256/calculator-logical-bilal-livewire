<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class BiologicalAgeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $m1 = 'm';
    public $m2 = 'oth';
    public $m3 = '00';
    public $m5 = '00';
    public $m6 = '00';
    public $m7 = '005';
    public $m8 = '00';
    public $m11 = '001';
    public $m12 = '001';
    public $m13 = '001';
    public $m14 = '00';
    public $m16 = '00';
    public $m17 = '00';
    public $m18 = '00';
    public $m19 = '00';
    public $m20 = '00';
    public $m21 = '00';
    public $m22 = '00';
    public $m23 = '00';
    public $m24 = '00';
    public $m27 = '00';
    public $m28 = '00';
    public $m30 = '00';
    public $m31 = '00';
    public $m34 = '00';
    public $m35 = '00';
    public $m36 = '00';
    public $age = '30';

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
        // Clear results when any input changes
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        
        $this->m1 = 'm';
        $this->m2 = 'oth';
        $this->m3 = '00';
        $this->m5 = '00';
        $this->m6 = '00';
        $this->m7 = '005';
        $this->m8 = '00';
        $this->m11 = '001';
        $this->m12 = '001';
        $this->m13 = '001';
        $this->m14 = '00';
        $this->m16 = '00';
        $this->m17 = '00';
        $this->m18 = '00';
        $this->m19 = '00';
        $this->m20 = '00';
        $this->m21 = '00';
        $this->m22 = '00';
        $this->m23 = '00';
        $this->m24 = '00';
        $this->m27 = '00';
        $this->m28 = '00';
        $this->m30 = '00';
        $this->m31 = '00';
        $this->m34 = '00';
        $this->m35 = '00';
        $this->m36 = '00';
        $this->age = '30';

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
            'm1'  => $this->m1,
            'm2'  => $this->m2,
            'm3'  => $this->m3,
            'm5'  => $this->m5,
            'm6'  => $this->m6,
            'm7'  => $this->m7,
            'm8'  => $this->m8,
            'm11' => $this->m11,
            'm12' => $this->m12,
            'm13' => $this->m13,
            'm14' => $this->m14,
            'm16' => $this->m16,
            'm17' => $this->m17,
            'm18' => $this->m18,
            'm19' => $this->m19,
            'm20' => $this->m20,
            'm21' => $this->m21,
            'm22' => $this->m22,
            'm23' => $this->m23,
            'm24' => $this->m24,
            'm27' => $this->m27,
            'm28' => $this->m28,
            'm30' => $this->m30,
            'm31' => $this->m31,
            'm34' => $this->m34,
            'm35' => $this->m35,
            'm36' => $this->m36,
            'age' => (float)$this->age,
        ];

        $model = new Health();
        $result = $model->biological($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
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
        return view('livewire.calculators.biological-age-calculator');
    }
}
