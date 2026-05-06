<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class OnBasePercentageCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $hits = 7;
    public $bases = 5;
    public $pitch = 5;
    public $bats = 3;
    public $flies = 2;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->hits = $inputs->hits ?? 7;
            $this->bases = $inputs->bases ?? 5;
            $this->pitch = $inputs->pitch ?? 5;
            $this->bats = $inputs->bats ?? 3;
            $this->flies = $inputs->flies ?? 2;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->hits = 7;
        $this->bases = 5;
        $this->pitch = 5;
        $this->bats = 3;
        $this->flies = 2;
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $request = (object)[
            'hits'  => $this->hits,
            'bases' => $this->bases,
            'pitch' => $this->pitch,
            'bats'  => $this->bats,
            'flies' => $this->flies,
        ];

        $model = new EverydayLife();
        $result = $model->on_base($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->current());
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
        return view('livewire.calculators.on-base-percentage-calculator');
    }
}
