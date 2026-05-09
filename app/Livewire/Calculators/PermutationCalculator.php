<?php

namespace App\Livewire\Calculators;
use App\Models\Statistics;
use Livewire\Component;

class PermutationCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $name = 0;
    public $n = 6;
    public $r = 2;
    public $find = 2;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->name = $inputs['name'] ?? 0;
            $this->n = $inputs['n'] ?? 6;
            $this->r = $inputs['r'] ?? 2;
            $this->find = $inputs['find'] ?? 2;
        }
    }

    public function updated($property)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->name = 0;
        $this->n = 6;
        $this->r = 2;
        $this->find = 2;

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
            'name' => $this->name,
            'n'    => $this->n,
            'r'    => $this->r,
            'find' => $this->find,
        ];

        $model = new Statistics();
        $result = $model->permutation($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Convert GMP objects to strings
            $gmpFields = ['perm', 'n_fact', 'r_fact', 'nr_fact', 'comb', 'comb_rep', 'perm_rep'];
            foreach ($gmpFields as $field) {
                if (isset($result[$field]) && $result[$field] instanceof \GMP) {
                    $result[$field] = gmp_strval($result[$field]);
                }
            }

            $this->detail = $result;
            $this->error = null;
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', [
                'name' => $this->name,
                'n'    => $this->n,
                'r'    => $this->r,
                'find' => $this->find
            ]);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->js(sprintf(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 400);
            JS));
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
        return view('livewire.calculators.permutation-calculator');
    }
}
