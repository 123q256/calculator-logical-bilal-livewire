<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Illuminate\Validation\ValidationException;

class IdealGasLawCalculator extends Component
{
    // ─── Core Props ───────────────────────────────────────────────
    public $error;
    public $detail = null;
    public $type   = 'calculator';
    public $lang   = [];
    public $calName;
    public $calLink;

    // ─── Form Fields ──────────────────────────────────────────────
    public $method = 'press'; // press | volume | temp | sub
    public $x      = '3';
    public $y      = '2';
    public $z      = '2';
    public $R      = '8.3144626';

    // ─── Unit Fields ──────────────────────────────────────────────
    public $x_v_unit = 'm³';
    public $x_t_unit = '°C';
    public $y_s_unit = 'mol';
    public $y_p_unit = 'Pa';
    public $z_t_unit = '°C';
    public $z_p_unit = 'Pa';

    // ─── Dropdown ─────────────────────────────────────────────────
    public $openDropdown = null;

    // ─── Mount ────────────────────────────────────────────────────
    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type    = $type;
        $this->lang    = $lang;
        $this->detail  = session('calculator_result');
        $this->error   = session('validation_error');

        // Back button se wapas aane pe inputs restore karo
        if ($back = session('calculator_back_inputs')) {
            $this->method   = $back->method   ?? 'press';
            $this->x        = $back->x        ?? '3';
            $this->y        = $back->y        ?? '2';
            $this->z        = $back->z        ?? '2';
            $this->R        = $back->R        ?? '8.3144626';
            $this->x_v_unit = $back->x_v_unit ?? 'm³';
            $this->x_t_unit = $back->x_t_unit ?? '°C';
            $this->y_s_unit = $back->y_s_unit ?? 'mol';
            $this->y_p_unit = $back->y_p_unit ?? 'Pa';
            $this->z_t_unit = $back->z_t_unit ?? '°C';
            $this->z_p_unit = $back->z_p_unit ?? 'Pa';
        }
    }

    // ─── Dropdown Helpers ─────────────────────────────────────────
    public function toggleDropdown(string $name): void
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit(string $field, string $unit): void
    {
        if (property_exists($this, $field)) {
            $this->$field = $unit;
        }
        $this->openDropdown = null;
    }

    public function closeDropdown(): void
    {
        $this->openDropdown = null;
    }

    // ─── Reset ────────────────────────────────────────────────────
    public function resetForm(): void
    {
        $this->resetErrorBag();
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error']);

        $this->error    = null;
        $this->detail   = null;
        $this->x        = '2';
        $this->y        = '3';
        $this->z        = '4';
        $this->R        = '8.3144626';
        $this->x_v_unit = 'm³';
        $this->x_t_unit = '°C';
        $this->y_s_unit = 'mol';
        $this->y_p_unit = 'Pa';
        $this->z_t_unit = '°C';
        $this->z_p_unit = 'Pa';
    }

    // ─── Calculate ────────────────────────────────────────────────
    public function calculate()  // void nahi — redirect return karna hai
    {
             try {
              $this->validate([
            'method' => 'required|in:press,volume,temp,sub',
            'x'      => 'required|numeric',
            'y'      => 'required|numeric',
            'z'      => 'required|numeric',
            'R'      => 'required|numeric',
        ]);
        } catch (ValidationException $e) {
            $this->error = 'Please! Check your input.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
            return;
        }


    

        $request = (object)[
            'method'   => $this->method,
            'x'        => $this->x,
            'y'        => $this->y,
            'z'        => $this->z,
            'R'        => $this->R,
            'x_v_unit' => $this->x_v_unit,  // press / temp / sub ke liye
            'x_t_unit' => $this->x_t_unit,  // volume ke liye
            'y_s_unit' => $this->y_s_unit,  // press / volume / temp ke liye
            'y_p_unit' => $this->y_p_unit,  // sub ke liye
            'z_t_unit' => $this->z_t_unit,  // press / sub ke liye
            'z_p_unit' => $this->z_p_unit,  // volume / temp ke liye
        ];

        $model  = new \App\Models\Chemistry();
        $result = $model->gas($request);
       if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;
            $this->detail = $result;
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
        //    return redirect()->to(url()->previous() ?? '/'); 
        }
        // dd($result);
         $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
   
    }

    // ─── Render ───────────────────────────────────────────────────
    public function render()
    {
        return view('livewire.calculators.ideal-gas-law-calculator');
    }
}