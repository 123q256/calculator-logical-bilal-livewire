<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class CenterOfMassCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $dem = 1;
    public $how = 2;
    public $res_unit = 'cm';

    // Masses and Positions
    public $m = [];
    public $x = [];
    public $y = [];
    public $z = [];
    public $m_unit = [];
    public $x_unit = [];
    public $y_unit = [];
    public $z_unit = [];

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        // Initialize defaults for 10 points
        for ($i = 1; $i <= 10; $i++) {
            $this->m[$i] = '12';
            $this->x[$i] = '5';
            $this->y[$i] = '5';
            $this->z[$i] = '5';
            $this->m_unit[$i] = 'g';
            $this->x_unit[$i] = 'cm';
            $this->y_unit[$i] = 'cm';
            $this->z_unit[$i] = 'cm';
        }

        if (session()->has('calculator_result')) {
            $this->detail = session()->pull('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = session()->pull('calculator_back_inputs');
            $this->dem = $inputs['dem'] ?? 1;
            $this->how = $inputs['how'] ?? 2;
            $this->res_unit = $inputs['res_unit'] ?? 'cm';
            for ($i = 1; $i <= 10; $i++) {
                if (isset($inputs["m$i"])) $this->m[$i] = $inputs["m$i"];
                if (isset($inputs["x$i"])) $this->x[$i] = $inputs["x$i"];
                if (isset($inputs["y$i"])) $this->y[$i] = $inputs["y$i"];
                if (isset($inputs["z$i"])) $this->z[$i] = $inputs["z$i"];
                if (isset($inputs["m{$i}_unit"])) $this->m_unit[$i] = $inputs["m{$i}_unit"];
                if (isset($inputs["x{$i}_unit"])) $this->x_unit[$i] = $inputs["x{$i}_unit"];
                if (isset($inputs["y{$i}_unit"])) $this->y_unit[$i] = $inputs["y{$i}_unit"];
                if (isset($inputs["z{$i}_unit"])) $this->z_unit[$i] = $inputs["z{$i}_unit"];
            }
        }
    }

    public function toggleDropdown($id)
    {
        $this->openDropdown = ($this->openDropdown === $id) ? null : $id;
    }

    public function setUnit($field, $index, $value)
    {
        $this->{$field}[$index] = $value;
        $this->openDropdown = null;
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['dem', 'how', 'res_unit']) || str_starts_with($propertyName, 'm.') || str_starts_with($propertyName, 'x.') || str_starts_with($propertyName, 'y.') || str_starts_with($propertyName, 'z.')) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        $rules = [
            'dem' => 'required',
            'how' => 'required|integer|min:2|max:10',
            'res_unit' => 'required',
        ];

        for ($i = 1; $i <= $this->how; $i++) {
            $rules["m.$i"] = 'required|numeric';
            $rules["x.$i"] = 'required|numeric';
            if ($this->dem >= 2) $rules["y.$i"] = 'required|numeric';
            if ($this->dem == 3) $rules["z.$i"] = 'required|numeric';
        }

        $this->validate($rules, [
            'required' => 'Please fill all fields.',
            'numeric' => 'Please enter valid numbers.',
        ]);

        $data = [
            'dem' => $this->dem,
            'how' => $this->how,
            'res_unit' => $this->res_unit,
        ];

        for ($i = 1; $i <= 10; $i++) {
            $data["m$i"] = $this->m[$i];
            $data["x$i"] = $this->x[$i];
            $data["y$i"] = $this->y[$i];
            $data["z$i"] = $this->z[$i];
            $data["m{$i}_unit"] = $this->m_unit[$i];
            $data["x{$i}_unit"] = $this->x_unit[$i];
            $data["y{$i}_unit"] = $this->y_unit[$i];
            $data["z{$i}_unit"] = $this->z_unit[$i];
        }

        // Mock request object for Physics model
        $mockRequest = new class($data) {
            private $data;
            public function __construct($data) { $this->data = $data; }
            public function input($key, $default = null) { return $this->data[$key] ?? $default; }
            public function __get($key) { return $this->data[$key] ?? null; }
        };

        $model = new Physics();
        $result = $model->center($mockRequest);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $data, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }

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
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->dem = 1;
        $this->how = 2;
        $this->res_unit = 'cm';
        
        for ($i = 1; $i <= 10; $i++) {
            $this->m[$i] = '12';
            $this->x[$i] = '5';
            $this->y[$i] = '5';
            $this->z[$i] = '5';
        }

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
    }

    public function render()
    {
        if (session()->pull('scroll_to_result')) {
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

        return view('livewire.calculators.center-of-mass-calculator');
    }
}
