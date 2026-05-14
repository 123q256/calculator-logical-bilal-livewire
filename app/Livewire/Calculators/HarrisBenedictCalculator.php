<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class HarrisBenedictCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $age = 25;
    public $gender = 'male';
    public $height_ft = 5;
    public $height_in = 10;
    public $height_cm = 177.8;
    public $unit_h = 'ft/in';
    public $weight = 160;
    public $unit = 'lbs';
    public $activity = '1.55';

    // UI State
    public $showDropdown = null;

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
        // If any input changes, hide the results to avoid showing stale data
        // We exclude 'showDropdown' so opening/closing units doesn't hide results
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
        
        // Hide results when unit changes as well
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['age', 'gender', 'height_ft', 'height_in', 'height_cm', 'unit_h', 'weight', 'unit', 'activity', 'detail', 'error', 'showDropdown']);
        
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
            'age'          => (float)$this->age,
            'gender'       => $this->gender,
            'height_ft'    => (float)$this->height_ft,
            'height_in'    => (float)$this->height_in,
            'height_cm'    => (float)$this->height_cm,
            'unit_ft_in'   => $this->unit_h,
            'unit'         => $this->unit,
            'weight'       => (float)$this->weight,
            'activity'     => (float)$this->activity,
        ];

        $model = new Health();
        $result = $model->harris($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $chartData = [
                ['name' => 'Carbohydrates', 'y' => (float)$result['carb_per'], 'color' => '#2845F5'],
                ['name' => 'Protein', 'y' => (float)$result['pro_per'], 'color' => '#119154'],
                ['name' => 'Fat', 'y' => (float)$result['fats_per'], 'color' => '#FF8C00']
            ];
            
            $result['chartData'] = json_encode($chartData);

            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            
            $this->dispatch('chartUpdated', data: $result['chartData']);
            
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
        return view('livewire.calculators.harris-benedict-calculator');
    }
}
