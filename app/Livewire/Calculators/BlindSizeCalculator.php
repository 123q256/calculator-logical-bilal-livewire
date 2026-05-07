<?php
namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class BlindSizeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $blind_type = 'inside';
    public $top = 31;
    public $t_units = 'cm';
    public $width = 31;
    public $w_units = 'cm';
    public $bottom = 42;
    public $b_units = 'cm';
    public $h_left = 42;
    public $l_units = 'cm';
    public $h_center = 50;
    public $c_units = 'cm';
    public $h_right = 50;
    public $r_units = 'cm';

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
        $this->reset(['blind_type', 'top', 't_units', 'width', 'w_units', 'bottom', 'b_units', 'h_left', 'l_units', 'h_center', 'c_units', 'h_right', 'r_units', 'detail', 'error']);

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
            'type' => $this->blind_type,
            'top' => $this->top,
            't_units' => $this->t_units,
            'width' => $this->width,
            'w_units' => $this->w_units,
            'bottom' => $this->bottom,
            'b_units' => $this->b_units,
            'h_left' => $this->h_left,
            'l_units' => $this->l_units,
            'h_center' => $this->h_center,
            'c_units' => $this->c_units,
            'h_right' => $this->h_right,
            'r_units' => $this->r_units,
        ];

        $model = new EverydayLife();
        $result = $model->blind((object)$requestData);

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
        return view('livewire.calculators.blind-size-calculator');
    }
}
