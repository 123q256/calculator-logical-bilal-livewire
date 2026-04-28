<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class MomentOfInertiaCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $selection = '1';
    public $b_width = '1';
    public $height = '1';
    public $dis_to_height = '1';
    public $radius = '1';
    public $radius2 = '1';
    public $tfw = '1';
    public $tft = '1';
    public $bfw = '1';
    public $bft = '1';
    public $wh = '1';
    public $wt = '1';
    public $r = '1';
    public $h1 = '1';
    public $b1 = '1';
    public $lft = '1';
    public $lfh = '1';
    public $unit = 'mm';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session()->pull('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session()->pull('calculator_back_inputs');
            foreach ($inputs as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['selection', 'unit']) || property_exists($this, $propertyName)) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        $rules = [
            'selection' => 'required',
            'unit' => 'required',
        ];

        // Dynamic rules based on selection
        switch ($this->selection) {
            case '1': // Triangle
                $rules['b_width'] = 'required|numeric|gt:0';
                $rules['height'] = 'required|numeric|gt:0';
                $rules['dis_to_height'] = 'required|numeric|gt:0';
                break;
            case '2': // Rectangle
                $rules['b_width'] = 'required|numeric|gt:0';
                $rules['height'] = 'required|numeric|gt:0';
                break;
            case '3': // Hollow Circle
                $rules['radius'] = 'required|numeric|gt:0';
                $rules['radius2'] = 'required|numeric|gt:0';
                break;
            case '4': // Circle
                $rules['radius'] = 'required|numeric|gt:0';
                break;
            case '7': // Hollow Rectangle
                $rules['b_width'] = 'required|numeric|gt:0';
                $rules['height'] = 'required|numeric|gt:0';
                $rules['h1'] = 'required|numeric|gt:0';
                $rules['b1'] = 'required|numeric|gt:0';
                break;
            case '8': // I-Beam
                $rules['bfw'] = 'required|numeric|gt:0';
                $rules['bft'] = 'required|numeric|gt:0';
                $rules['tft'] = 'required|numeric|gt:0';
                $rules['tfw'] = 'required|numeric|gt:0';
                $rules['wt'] = 'required|numeric|gt:0';
                $rules['wh'] = 'required|numeric|gt:0';
                break;
            case '9': // L-Beam
                $rules['bfw'] = 'required|numeric|gt:0';
                $rules['bft'] = 'required|numeric|gt:0';
                $rules['lfh'] = 'required|numeric|gt:0';
                $rules['lft'] = 'required|numeric|gt:0';
                break;
            case '10': // T-Beam
                $rules['tfw'] = 'required|numeric|gt:0';
                $rules['tft'] = 'required|numeric|gt:0';
                $rules['wh'] = 'required|numeric|gt:0';
                $rules['wt'] = 'required|numeric|gt:0';
                break;
            case '11': // Channel
                $rules['bfw'] = 'required|numeric|gt:0';
                $rules['bft'] = 'required|numeric|gt:0';
                $rules['tfw'] = 'required|numeric|gt:0';
                $rules['tft'] = 'required|numeric|gt:0';
                $rules['wt'] = 'required|numeric|gt:0';
                $rules['h1'] = 'required|numeric|gt:0';
                break;
        }

        $this->validate($rules, [
            'required' => 'Please fill all fields.',
            'numeric' => 'Please enter valid numbers.',
            'gt' => 'Value must be greater than zero.',
        ]);

        $requestData = [
            'selection' => $this->selection,
            'b_width' => $this->b_width,
            'height' => $this->height,
            'dis_to_height' => $this->dis_to_height,
            'radius' => $this->radius,
            'radius2' => $this->radius2,
            'tfw' => $this->tfw,
            'tft' => $this->tft,
            'bfw' => $this->bfw,
            'bft' => $this->bft,
            'wh' => $this->wh,
            'wt' => $this->wt,
            'r' => $this->r,
            'h1' => $this->h1,
            'b1' => $this->b1,
            'lft' => $this->lft,
            'lfh' => $this->lfh,
            'unit' => $this->unit,
        ];

        $model = new Physics();
        $result = $model->moment((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
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

        $this->selection = '1';
        $this->unit = 'mm';
        $this->b_width = '1';
        $this->height = '1';
        $this->dis_to_height = '1';
        $this->radius = '1';
        $this->radius2 = '1';
        $this->tfw = '1';
        $this->tft = '1';
        $this->bfw = '1';
        $this->bft = '1';
        $this->wh = '1';
        $this->wt = '1';
        $this->r = '1';
        $this->h1 = '1';
        $this->b1 = '1';
        $this->lft = '1';
        $this->lfh = '1';

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

        return view('livewire.calculators.moment-of-inertia-calculator');
    }
}
