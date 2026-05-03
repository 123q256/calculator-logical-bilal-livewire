<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class LaborCostCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currency = '$';

    public $h_p_w = 40;
    public $p_r = 10;
    public $a_d_p_y = 15;
    public $tax = 900;
    public $insurance = 600;
    public $benefits = 1200;
    public $overtime = 800;
    public $supplies = 400;
    public $total_revenue = 80000;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->h_p_w = $inputs->h_p_w ?? 40;
            $this->p_r = $inputs->p_r ?? 10;
            $this->a_d_p_y = $inputs->a_d_p_y ?? 15;
            $this->tax = $inputs->tax ?? 900;
            $this->insurance = $inputs->insurance ?? 600;
            $this->benefits = $inputs->benefits ?? 1200;
            $this->overtime = $inputs->overtime ?? 800;
            $this->supplies = $inputs->supplies ?? 400;
            $this->total_revenue = $inputs->total_revenue ?? 80000;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->h_p_w = 40;
        $this->p_r = 10;
        $this->a_d_p_y = 15;
        $this->tax = 900;
        $this->insurance = 600;
        $this->benefits = 1200;
        $this->overtime = 800;
        $this->supplies = 400;
        $this->total_revenue = 80000;

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
            'h_p_w' => (float)$this->h_p_w,
            'p_r' => (float)$this->p_r,
            'a_d_p_y' => (float)$this->a_d_p_y,
            'tax' => (float)$this->tax,
            'insurance' => (float)$this->insurance,
            'benefits' => (float)$this->benefits,
            'overtime' => (float)$this->overtime,
            'supplies' => (float)$this->supplies,
            'total_revenue' => (float)$this->total_revenue,
        ];

        $model = new Finance();
        $result = $model->labor($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            session()->flash('scroll_to_result', true);

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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
            session()->flash('validation_error', $this->error);
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
        return view('livewire.calculators.labor-cost-calculator');
    }
}
