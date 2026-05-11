<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;
use Illuminate\Support\Facades\App;

class SixMinuteWalkTest extends Component
{
    // Basic State
    public $type = 'calculator';
    public $detail = null;
    public $error = null;

    // Inputs
    public $age = null;
    public $gender = 'Male';
    public $height_ft = null;
    public $height_in = 0;
    public $height_cm = null;
    public $weight = null;
    public $distance = null;
    
    // Units
    public $unit = 'lbs';
    public $unit_ft_in = 'ft/in';
    public $dis_unit = 'ft';

    public function mount($type = 'calculator')
    {
        $this->type = $type;

        // Restore from session if available
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->age = $inputs['age'] ?? null;
            $this->gender = $inputs['gender'] ?? 'Male';
            $this->height_ft = $inputs['height-ft'] ?? null;
            $this->height_in = $inputs['height-in'] ?? 0;
            $this->height_cm = $inputs['height-cm'] ?? null;
            $this->weight = $inputs['weight'] ?? null;
            $this->distance = $inputs['distance'] ?? null;
            $this->unit = $inputs['unit'] ?? 'lbs';
            $this->unit_ft_in = $inputs['unit_ft_in'] ?? 'ft/in';
            $this->dis_unit = $inputs['dis_unit'] ?? 'ft';
        }

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['age', 'height_ft', 'height_in', 'height_cm', 'weight', 'distance', 'detail', 'error']);
        
        // Reset defaults
        $this->gender = 'Male';
        $this->unit = 'lbs';
        $this->unit_ft_in = 'ft/in';
        $this->dis_unit = 'ft';
        $this->height_in = 0;
        
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
        $request = [
            'age' => $this->age,
            'gender' => $this->gender,
            'height-ft' => $this->height_ft,
            'height-in' => $this->height_in,
            'height-cm' => $this->height_cm,
            'weight' => $this->weight,
            'distance' => $this->distance,
            'unit' => $this->unit,
            'unit_ft_in' => $this->unit_ft_in,
            'dis_unit' => $this->dis_unit,
        ];

        $model = new Health();
        $result = $model->walk((object)$request);
       
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Calculation failed. Please check your inputs.';
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
        // Load lang keys dynamically to avoid payload corruption
        $lang = [];
        $file = 'six-minute-walk-test';
        if (App::getLocale() != 'en') {
            $file = App::getLocale() . '-' . $file;
        }
        
        $path = public_path("keys/{$file}.txt");
        if (file_exists($path)) {
            $data = json_decode(file_get_contents($path), true);
            if (isset($data['lang_keys'])) {
                $lang = json_decode($data['lang_keys'], true);
            }
        }

        return view('livewire.calculators.six-minute-walk-test', [
            'lang' => $lang
        ]);
    }
}
