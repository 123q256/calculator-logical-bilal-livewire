<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class TipCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $for = 'share';
    public $x = '4';
    public $y = '2';
    public $z = '1';
    public $round = 'yes';
    public $xs = '4';
    public $rounds = 'yes';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->for = $inputs->for ?? 'share';
            $this->x = $inputs->x ?? '4';
            $this->y = $inputs->y ?? '2';
            $this->z = $inputs->z ?? '1';
            $this->round = $inputs->round ?? 'yes';
            $this->xs = $inputs->xs ?? '4';
            $this->rounds = $inputs->rounds ?? 'yes';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->for = 'share';
        $this->x = '4';
        $this->y = '2';
        $this->z = '1';
        $this->round = 'yes';
        $this->xs = '4';
        $this->rounds = 'yes';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'for' => $this->for,
            'x' => $this->x,
            'y' => $this->y,
            'z' => $this->z,
            'round' => $this->round,
            'xs' => $this->xs,
            'rounds' => $this->rounds,
        ];

        $model = new Finance();
        $result = $model->tip((object)$requestData);
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->previous() ?? '/');
            } else {
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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.tip-calculator');
    }
}
