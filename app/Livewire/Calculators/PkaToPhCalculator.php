<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class PkaToPhCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $convert = '1'; // 1: ka to ph, 2: ph to pka
    public $buf_unit = '1'; // 1: Acidic, 2: Basic
    public $ka = '0.0000001';
    public $acid = '20';
    public $acid_unit = '1';
    public $salt = '25';
    public $salt_unit = '1';
    public $ph = '7';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $request = (object)[
            'convert' => $this->convert,
            'buf_unit' => $this->buf_unit,
            'ka' => $this->ka,
            'acid' => $this->acid,
            'acid_unit' => $this->acid_unit,
            'salt' => $this->salt,
            'salt_unit' => $this->salt_unit,
            'ph' => $this->ph,
        ];

        $model = new Chemistry();
        $result = $model->pka($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->reset(['ka', 'acid', 'salt', 'ph', 'error', 'detail']);
    }

    public function render()
    {
        return view('livewire.calculators.pka-to-ph-calculator');
    }
}
