<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class NetherPortalCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $cal_name = 'Simple';

    // Inputs
    public $sim_adv = 'simple';
    public $cal = '1';
    public $x = 100;
    public $y = 200;
    public $z = 300;
    public $x1 = 200;
    public $x2 = 300;
    public $y1 = 400;
    public $y2 = 500;
    public $z1 = 600;
    public $z2 = 700;

    public function mount($type = 'calculator', $lang = [], $cal_name = 'Simple')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->cal_name = $cal_name;
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

    public function setTab($tab)
    {
        $this->sim_adv = $tab;
        $this->updated('sim_adv');
    }

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);
    }

    public function resetForm()
    {
        $this->reset(['sim_adv', 'cal', 'x', 'y', 'z', 'x1', 'x2', 'y1', 'y2', 'z1', 'z2', 'detail', 'error']);

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
            'sim_adv' => $this->sim_adv,
            'cal' => $this->cal,
            'x' => $this->x,
            'y' => $this->y,
            'z' => $this->z,
            'x1' => $this->x1,
            'x2' => $this->x2,
            'y1' => $this->y1,
            'y2' => $this->y2,
            'z1' => $this->z1,
            'z2' => $this->z2,
        ];

        $model = new EverydayLife();
        $result = $model->nether((object)$requestData);

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
            session()->flash('validation_error', $this->error);
            $this->detail = null;
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
        return view('livewire.calculators.nether-portal-calculator');
    }
}
