<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class SquareMeterCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form fields
    public $volume_select = 1;
    public $length = 4;
    public $l_units = 'cm';
    public $width = 4;
    public $w_units = 'm';
    public $side = 4;
    public $s_units = 'm';
    public $quantity = 1;
    public $price = null;
    public $currancy = '$';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = null)
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy ?? $lang['currency'] ?? '$';
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->volume_select = $inputs->volume_select ?? 1;
            $this->length = $inputs->length ?? 8;
            $this->l_units = $inputs->l_units ?? 'cm';
            $this->width = $inputs->width ?? 4;
            $this->w_units = $inputs->w_units ?? 'cm';
            $this->side = $inputs->side ?? 4;
            $this->s_units = $inputs->s_units ?? 'cm';
            $this->quantity = $inputs->quantity ?? 1;
            $this->price = $inputs->price ?? null;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
    }

    public function toggleDropdown($name)
    {
        if ($this->showDropdown === $name) {
            $this->showDropdown = null;
        } else {
            $this->showDropdown = $name;
        }
    }

    public function setUnit($dropdown, $unit)
    {
        $this->$dropdown = $unit;
        $this->showDropdown = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'volume_select', 'length', 'l_units', 'width', 'w_units', 'side', 's_units', 'quantity', 'price'
        ]);

        $this->resetErrorBag();
        $this->resetValidation();

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
        $request = (object)[
            'volume_select' => $this->volume_select,
            'length'        => $this->length,
            'l_units'       => $this->l_units,
            'width'         => $this->width,
            'w_units'       => $this->w_units,
            'side'          => $this->side,
            's_units'       => $this->s_units,
            'quantity'      => $this->quantity,
            'price'         => $this->price,
        ];

        $model = new Construction();
        $result = $model->square_meter($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                $this->error = null;
                return redirect()->to(url()->previous() ?? '/');
            } else {
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
                return;
            }
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->flash('validation_error', $this->error);
            return redirect()->to(url()->previous() ?? '/');
        } else {
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
        return view('livewire.calculators.square-meter-calculator');
    }
}
