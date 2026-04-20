<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class ProbabilityCalculator extends Component
{
    public $error;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $calName;
    public $calLink;

    // Form inputs
    public $for = '1';
    public $nbr1 = '6';
    public $event = '1';
    public $nbr2 = '100';
    public $event_a = '10';
    public $event_b = '20';
    public $format = '1';
    public $pro_a = '0.5';
    public $pro_b = '0.4';
    public $eve_a = '0.0632';
    public $rep_a = '6';
    public $eve_b = '0.0341';
    public $rep_b = '4';
    public $andb = '0.2';
    public $prob_b = '0.5';

    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        
        if (session()->has('calculator_back_inputs')) {
            $backInputs = session('calculator_back_inputs');
            foreach ($backInputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    public function resetForm(): void
    {
        $this->reset([
            'error', 'detail', 'for', 'nbr1', 'event', 'nbr2', 'event_a', 'event_b',
            'format', 'pro_a', 'pro_b', 'eve_a', 'rep_a', 'eve_b', 'rep_b', 'andb', 'prob_b'
        ]);
        $this->resetErrorBag();
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error']);
    }



    public function calculate()
    {
        $request = (object)[
            'for'     => $this->for,
            'nbr1'    => $this->nbr1,
            'event'   => $this->event,
            'nbr2'    => $this->nbr2,
            'event_a' => $this->event_a,
            'event_b' => $this->event_b,
            'format'  => $this->format,
            'pro_a'   => $this->pro_a,
            'pro_b'   => $this->pro_b,
            'eve_a'   => $this->eve_a,
            'rep_a'   => $this->rep_a,
            'eve_b'   => $this->eve_b,
            'rep_b'   => $this->rep_b,
            'andb'    => $this->andb,
            'prob_b'  => $this->prob_b,
        ];

        $model  = new \App\Models\Statistics();
        $result = $model->probability($request);
         if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
                                      $this->js(<<<'JS'
                $nextTick(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const top = el.getBoundingClientRect().top + window.scrollY - 50;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                });
            JS);
                return;
           //return redirect()->to(url()->previous() ?? '/');
        } // fallback if referer not available
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
        }
        // dd($result);
         $this->error = $result['error'] ?? 'Something went wrong.';
        $this->detail = null;
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
        session()->flash('validation_error', $this->error);            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function render()
    {
        return view('livewire.calculators.probability-calculator');
    }
}
