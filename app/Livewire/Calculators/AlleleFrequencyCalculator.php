<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class AlleleFrequencyCalculator extends Component
{
    public $type = 'calculator';
    public $lang = [];
    public $detail = null;
    public $error = null;

    // Inputs
    public $calc_type = 'frst'; // frst: Calculator, scnd: Converter
    public $first = '56'; // Homozygous dominant AA
    public $second = '54'; // Heterozygous Aa
    public $third = '7'; // Homozygous recessive aa
    public $operations = '1'; // 1: Frequency, 2: 1 in X
    public $four = '54.67'; // Converter input value

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

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->calc_type = 'frst';
        $this->first = '56';
        $this->second = '54';
        $this->third = '7';
        $this->operations = '1';
        $this->four = '54.67';
        
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error'
        ]);
    }

    public function calculate()
    {
        $request = (object)[
            'type' => $this->calc_type,
            'first' => $this->first,
            'second' => $this->second,
            'third' => $this->third,
            'operations' => $this->operations,
            'four' => $this->four,
        ];

        $model = new Health();
        $result = $model->allele($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.allele-frequency-calculator');
    }
}
