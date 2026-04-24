<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class TankVolumeCalculator extends Component
{
   public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $operations = '3';
    public $first = '24';
    public $second = '10';
    public $third = '16';
    public $four = '15';
    public $units1 = 'm';
    public $units2 = 'm';
    public $units3 = 'mm';
    public $units4 = 'm';
    public $fill = '';
    public $fill_units = 'ft';
    public $showDropdown = null;

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->operations = $inputs->operations ?? '3';
            $this->first = $inputs->first ?? '24';
            $this->second = $inputs->second ?? '10';
            $this->third = $inputs->third ?? '16';
            $this->four = $inputs->four ?? '15';
            $this->units1 = $inputs->units1 ?? 'm';
            $this->units2 = $inputs->units2 ?? 'm';
            $this->units3 = $inputs->units3 ?? 'mm';
            $this->units4 = $inputs->units4 ?? 'm';
            $this->fill = $inputs->fill ?? '';
            $this->fill_units = $inputs->fill_units ?? 'ft';
        }
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
    }

    public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'operations', 'first', 'second', 'third', 'four', 
            'units1', 'units2', 'units3', 'units4', 'fill', 'fill_units', 'showDropdown'
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
            'operations' => $this->operations,
            'first' => $this->first,
            'second' => $this->second,
            'third' => $this->third,
            'four' => $this->four,
            'units1' => $this->units1,
            'units2' => $this->units2,
            'units3' => $this->units3,
            'units4' => $this->units4,
            'fill' => $this->fill,
            'fill_units' => $this->fill_units,
        ];

        $model = new Construction();
        $result = $model->tank($request);

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
    
        return view('livewire.calculators.tank-volume-calculator');
    }
}
