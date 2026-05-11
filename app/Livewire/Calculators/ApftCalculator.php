<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class ApftCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $method = 'score';
    public $age = 25;
    public $gender = 'Male';
    public $push = 45;
    public $sit = 55;
    public $min = 14;
    public $sec = 35;
    public $number = '';
    public $weight = '1';
    public $submit_type = '';
    public $pass = '60';

    // Multi-personnel data
    public $personnel = [];

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
            if (isset($inputs->personnel)) {
                $this->personnel = $inputs->personnel;
            }
        }
    }

    public function updatedMethod()
    {
        $this->detail = null;
        $this->submit_type = '';
        $this->personnel = [];
    }

    public function updatedNumber()
    {
        $this->submit_type = '';
        $this->personnel = [];
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->method = 'score';
        $this->age = 25;
        $this->gender = 'Male';
        $this->push = 45;
        $this->sit = 55;
        $this->min = 14;
        $this->sec = 35;
        $this->number = '';
        $this->weight = '1';
        $this->submit_type = '';
        $this->personnel = [];

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
        if ($this->age < 17 && $this->method !== 'multi') {
            $this->error = 'Age must be at least 17.';
            return;
        }

        // If we are in multi mode and haven't generated inputs yet
        if ($this->method === 'multi' && empty($this->submit_type)) {
            if (empty($this->number) || !is_numeric($this->number)) {
                $this->error = 'Please enter a valid number of personnel.';
                return;
            }

            $this->submit_type = ($this->weight === '1') ? 'dis' : 'enable';
            $this->personnel = [];
            for ($i = 1; $i <= $this->number; $i++) {
                $this->personnel[$i] = [
                    'name' => $i,
                    'age' => 25,
                    'gender' => 'Male',
                    'push' => 45,
                    'sit' => 55,
                    'height' => '',
                    'weight' => '',
                    '2mile' => '14:35'
                ];
            }
            
            // We need to call the model once to get the 'disable' or 'enable' state in detail
            // so the Blade knows to show the personnel list
            $request = (object)[
                'method' => $this->method,
                'number' => $this->number,
                'weight' => $this->weight,
                'submit_type' => '',
            ];
            
            $model = new Health();
            $result = $model->apft($request);
            
            if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
                $this->detail = $result;
                $this->error = null;
                // No redirect here, we want to show the inputs
                return;
            }
        }

        // Prepare request for actual calculation
        $requestData = [
            'method' => $this->method,
            'age' => $this->age,
            'gender' => $this->gender,
            'push' => $this->push,
            'sit' => $this->sit,
            'min' => $this->min,
            'sec' => $this->sec,
            'number' => $this->number,
            'weight' => $this->weight,
            'submit_type' => $this->submit_type ?? '',
            'pass' => $this->pass,
            'total' => $this->number, // Model uses $request->total for multi
        ];

        // If multi, flatten personnel data
        if ($this->method === 'multi' && !empty($this->submit_type)) {
            for ($i = 1; $i <= $this->number; $i++) {
                $data = $this->personnel[$i] ?? [];
                $requestData["name$i"] = $data['name'] ?? '';
                $requestData["age$i"] = $data['age'] ?? '';
                $requestData["gender$i"] = $data['gender'] ?? 'Male';
                $requestData["push$i"] = $data['push'] ?? '';
                $requestData["sit$i"] = $data['sit'] ?? '';
                $requestData["height$i"] = $data['height'] ?? '';
                $requestData["weight$i"] = $data['weight'] ?? '';
                $requestData["2mile$i"] = $data['2mile'] ?? '';
            }
        }

        $request = (object)$requestData;
        $model = new Health();
        $result = $model->apft($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1 && !isset($result['error'])) {
            // For multi mode, we want to keep the personnel data in session too
            if ($this->method === 'multi') {
                $request->personnel = $this->personnel;
            }

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    public function render()
    {
        return view('livewire.calculators.apft-calculator');
    }
}
