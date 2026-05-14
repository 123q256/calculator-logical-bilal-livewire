<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class ImplantationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $know = 'yes';
    public $ovd = '';
    public $lp = '';
    public $mcl = 28;
    public $ivf = '';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        // Set default dates to today if empty
        $this->ovd = date('Y-m-d');
        $this->lp = date('Y-m-d', strtotime('-14 days'));

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
        if (in_array($propertyName, ['know', 'ovd', 'lp', 'mcl', 'ivf'])) {
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->know = 'yes';
        $this->ovd = date('Y-m-d');
        $this->lp = date('Y-m-d', strtotime('-14 days'));
        $this->mcl = 28;
        $this->ivf = '';

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
            'know' => $this->know,
            'ovd'  => $this->ovd,
            'lp'   => $this->lp,
            'mcl'  => $this->mcl,
            'ivf'  => $this->ivf,
        ];

        $model = new Health();
        $result = $model->implantation($request);

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
        return view('livewire.calculators.implantation-calculator');
    }
}
