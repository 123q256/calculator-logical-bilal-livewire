<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class BodyFatPercentageCalculator extends Component
{
    public $gender = 'Male';
    public $method = '7';
    public $age = '25';
    public $weight = '150';
    public $unit = 'lbs';
    public $height_ft = '5';
    public $height_in = '9';
    public $height_cm = '175';
    public $unit_ft_in = 'ft/in';
    
    // Circumference measurements
    public $neck = '19';
    public $unit_n = 'in';
    public $waist = '30';
    public $unit_w = 'in';
    public $hip = '30';
    public $unit_hip = 'in';

    // Skinfold measurements (Caliper)
    public $chest = '';
    public $unit_chest = 'mm';
    public $abd = '';
    public $unit_abd = 'mm';
    public $thigh = '';
    public $unit_thigh = 'mm';
    public $tricep = '';
    public $unit_tricep = 'mm';
    public $sub = '';
    public $unit_sub = 'mm';
    public $sup = '';
    public $unit_sup = 'mm';
    public $mid = '';
    public $unit_mid = 'mm';
    public $bicep = '';
    public $unit_bicep = 'mm';
    public $back = '';
    public $unit_back = 'mm';
    public $calf = '';
    public $unit_calf = 'mm';

    public $calculator_type = 'simple';
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->gender = $inputs['gender'] ?? 'Male';
            $this->method = $inputs['method'] ?? '7';
            $this->age = $inputs['age'] ?? '25';
            $this->weight = $inputs['weight'] ?? '150';
            $this->unit = $inputs['unit'] ?? 'lbs';
            $this->height_ft = $inputs['height-ft'] ?? '5';
            $this->height_in = $inputs['height-in'] ?? '9';
            $this->height_cm = $inputs['height-cm'] ?? '175';
            $this->unit_ft_in = $inputs['unit_ft_in'] ?? 'ft/in';
            $this->neck = $inputs['neck'] ?? '19';
            $this->unit_n = $inputs['unit_n'] ?? 'in';
            $this->waist = $inputs['waist'] ?? '30';
            $this->unit_w = $inputs['unit_w'] ?? 'in';
            $this->hip = $inputs['hip'] ?? '30';
            $this->unit_hip = $inputs['unit_hip'] ?? 'in';
            $this->chest = $inputs['chest'] ?? '';
            $this->unit_chest = $inputs['unit_chest'] ?? 'mm';
            $this->abd = $inputs['abd'] ?? '';
            $this->unit_abd = $inputs['unit_abd'] ?? 'mm';
            $this->thigh = $inputs['thigh'] ?? '';
            $this->unit_thigh = $inputs['unit_thigh'] ?? 'mm';
            $this->tricep = $inputs['tricep'] ?? '';
            $this->unit_tricep = $inputs['unit_tricep'] ?? 'mm';
            $this->sub = $inputs['sub'] ?? '';
            $this->unit_sub = $inputs['unit_sub'] ?? 'mm';
            $this->sup = $inputs['sup'] ?? '';
            $this->unit_sup = $inputs['unit_sup'] ?? 'mm';
            $this->mid = $inputs['mid'] ?? '';
            $this->unit_mid = $inputs['unit_mid'] ?? 'mm';
            $this->bicep = $inputs['bicep'] ?? '';
            $this->unit_bicep = $inputs['unit_bicep'] ?? 'mm';
            $this->back = $inputs['back'] ?? '';
            $this->unit_back = $inputs['unit_back'] ?? 'mm';
            $this->calf = $inputs['calf'] ?? '';
            $this->unit_calf = $inputs['unit_calf'] ?? 'mm';
            $this->calculator_type = $inputs['calculator_type'] ?? 'simple';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
        
        // Auto-switch method if calculator type changes
        if ($propertyName === 'calculator_type') {
            if ($this->calculator_type === 'simple') {
                $this->method = '7';
            } else {
                $this->method = '1'; // Default to Navy if advance
            }
        }
    }

    public function resetForm()
    {
        $this->reset(['gender', 'method', 'age', 'weight', 'unit', 'height_ft', 'height_in', 'height_cm', 'unit_ft_in', 'neck', 'unit_n', 'waist', 'unit_w', 'hip', 'unit_hip', 'chest', 'abd', 'thigh', 'tricep', 'sub', 'sup', 'mid', 'bicep', 'back', 'calf', 'calculator_type', 'detail', 'error']);
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
          $this->detail = null;
        $this->error = null;
        $requestData = [
            'gender' => $this->gender,
            'method' => $this->method,
            'age' => $this->age,
            'weight' => $this->weight,
            'unit' => $this->unit,
            'height-ft' => $this->height_ft,
            'height-in' => $this->height_in,
            'height-cm' => $this->height_cm,
            'unit_ft_in' => $this->unit_ft_in,
            'hightUnit' => $this->unit_ft_in,
            'neck' => $this->neck,
            'unit_n' => $this->unit_n,
            'waist' => $this->waist,
            'unit_w' => $this->unit_w,
            'hip' => $this->hip,
            'unit_hip' => $this->unit_hip,
            'chest' => $this->chest,
            'unit_chest' => $this->unit_chest,
            'abd' => $this->abd,
            'unit_abd' => $this->unit_abd,
            'thigh' => $this->thigh,
            'unit_thigh' => $this->unit_thigh,
            'tricep' => $this->tricep,
            'unit_tricep' => $this->unit_tricep,
            'sub' => $this->sub,
            'unit_sub' => $this->unit_sub,
            'sup' => $this->sup,
            'unit_sup' => $this->unit_sup,
            'mid' => $this->mid,
            'unit_mid' => $this->unit_mid,
            'bicep' => $this->bicep,
            'unit_bicep' => $this->unit_bicep,
            'back' => $this->back,
            'unit_back' => $this->unit_back,
            'calf' => $this->calf,
            'unit_calf' => $this->unit_calf,
            'calculator_type' => $this->calculator_type,
        ];

        // Compatible wrapper for model validation
        $request = new class($requestData) {
            private $data;
            public function __construct($data) {
                $this->data = $data;
                foreach ($data as $key => $value) { $this->{$key} = $value; }
            }
            public function toArray() { return $this->data; }
            public function all() { return $this->data; }
        };

        $model = new Health();
        $result = $model->body($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->current());
            } else {
                $this->detail = $result;
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
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
        return view('livewire.calculators.body-fat-percentage-calculator');
    }
}
