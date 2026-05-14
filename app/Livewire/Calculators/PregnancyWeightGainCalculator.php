<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class PregnancyWeightGainCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $height_ft = 5;
    public $height_in = 9;
    public $unit_ft_in = 'ft/in';
    public $height_cm = 175.26;
    public $weight = 150;
    public $w_unit = 'lbs';
    public $week = 25;
    public $activity = '0'; // 0: Single, 1: Twins

    // UI State
    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'showDropdown') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleOverlay($id)
    {
        $this->showDropdown = ($this->showDropdown === $id) ? null : $id;
    }

    public function setUnit($field, $value)
    {
        $this->$field = $value;
        $this->showDropdown = null;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['height_ft', 'height_in', 'unit_ft_in', 'height_cm', 'weight', 'w_unit', 'week', 'activity', 'detail', 'error', 'showDropdown']);
        
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
        $this->error = null;

        $request = (object)[
            'height_ft'  => (float)$this->height_ft,
            'height_in'  => (float)$this->height_in,
            'height_cm'  => (float)$this->height_cm,
            'unit_ft_in' => $this->unit_ft_in,
            'weight'     => (float)$this->weight,
            'w_unit'     => $this->w_unit,
            'week'       => (int)$this->week,
            'activity'   => $this->activity,
        ];

        $model = new Health();
        $result = $model->pre_weight($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            
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

        $this->error = $result['error'] ?? 'Please check your inputs.';
        $this->detail = null;
    }

    public function render()
    {
        return view('livewire.calculators.pregnancy-weight-gain-calculator');
    }
}
