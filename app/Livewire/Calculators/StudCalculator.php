<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class StudCalculator extends Component
{
   public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form fields
    public $want = 'stud';
    public $wall_end_stud = '2';
    public $wall_on = 'subfloor';
    public $hight = '5';
    public $hight_unit = 'ft';
    public $length = '5';
    public $length_unit = 'ft';
    public $stud_spacing = '16';
    public $stud_spacing_unit = 'in';
    public $rim_joist_width = '6';
    public $rim_joist_width_unit = 'in';
    public $subfloor_thickness = '6';
    public $subfloor_thickness_unit = 'in';
    public $stud_width = '3.5';
    public $stud_width_unit = 'in';
    public $stud_price = '10';
    public $estimated_waste = '15';
    public $currancy = '$';

    public $showDropdown = null;

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->want = $inputs->want ?? 'stud';
            $this->wall_end_stud = $inputs->wall_end_stud ?? '2';
            $this->wall_on = $inputs->wall_on ?? 'subfloor';
            $this->hight = $inputs->hight ?? '5';
            $this->hight_unit = $inputs->hight_unit ?? 'ft';
            $this->length = $inputs->length ?? '5';
            $this->length_unit = $inputs->length_unit ?? 'ft';
            $this->stud_spacing = $inputs->stud_spacing ?? '16';
            $this->stud_spacing_unit = $inputs->stud_spacing_unit ?? 'in';
            $this->rim_joist_width = $inputs->rim_joist_width ?? '6';
            $this->rim_joist_width_unit = $inputs->rim_joist_width_unit ?? 'in';
            $this->subfloor_thickness = $inputs->subfloor_thickness ?? '6';
            $this->subfloor_thickness_unit = $inputs->subfloor_thickness_unit ?? 'in';
            $this->stud_width = $inputs->stud_width ?? '3.5';
            $this->stud_width_unit = $inputs->stud_width_unit ?? 'in';
            $this->stud_price = $inputs->stud_price ?? '10';
            $this->estimated_waste = $inputs->estimated_waste ?? '15';
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
            'error', 'detail', 'want', 'wall_end_stud', 'wall_on', 'hight', 'hight_unit', 'length', 'length_unit',
            'stud_spacing', 'stud_spacing_unit', 'rim_joist_width', 'rim_joist_width_unit', 'subfloor_thickness',
            'subfloor_thickness_unit', 'stud_width', 'stud_width_unit', 'stud_price', 'estimated_waste', 'showDropdown'
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
            'want' => $this->want,
            'wall_end_stud' => $this->wall_end_stud,
            'wall_on' => $this->wall_on,
            'hight' => $this->hight,
            'hight_unit' => $this->hight_unit,
            'length' => $this->length,
            'length_unit' => $this->length_unit,
            'stud_spacing' => $this->stud_spacing,
            'stud_spacing_unit' => $this->stud_spacing_unit,
            'rim_joist_width' => $this->rim_joist_width,
            'rim_joist_width_unit' => $this->rim_joist_width_unit,
            'subfloor_thickness' => $this->subfloor_thickness,
            'subfloor_thickness_unit' => $this->subfloor_thickness_unit,
            'stud_width' => $this->stud_width,
            'stud_width_unit' => $this->stud_width_unit,
            'stud_price' => $this->stud_price,
            'estimated_waste' => $this->estimated_waste,
        ];

        $model = new Construction();
        $result = $model->stud($request);

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
     return view('livewire.calculators.stud-calculator');
    }
}
