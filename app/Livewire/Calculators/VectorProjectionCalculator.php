<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class VectorProjectionCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $dem = '2'; // Dimension
    public $vector_representation = 'coor'; // Representation A
    public $vector_b = 'coor'; // Representation B

    // Coordinates A
    public $ax = '3';
    public $ay = '4';
    public $az = '5';

    // Points A (Point A and Point B for Vector A)
    public $first_a = '2';  // x1
    public $second_a = '3'; // y1
    public $third_a = '4';  // z1
    public $first_b = '5';  // x2
    public $second_b = '6'; // y2
    public $third_b = '7';  // z2

    // Coordinates B
    public $bx = '7';
    public $by = '8';
    public $bz = '9';

    // Points B (Point A and Point B for Vector B)
    public $first_aa = '6';  // x1
    public $second_aa = '7'; // y1
    public $third_aa = '8';  // z1
    public $first_bb = '9';  // x2
    public $second_bb = '10'; // y2
    public $third_bb = '11';  // z2

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
        if (in_array($propertyName, ['dem', 'vector_representation', 'vector_b'])) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        $rules = [
            'dem' => 'required',
            'vector_representation' => 'required',
            'vector_b' => 'required',
        ];

        // Dynamic validation based on representation
        if ($this->vector_representation == 'coor') {
            $rules['ax'] = 'required|numeric';
            $rules['ay'] = 'required|numeric';
            if ($this->dem == '3') $rules['az'] = 'required|numeric';
        } else {
            $rules['first_a'] = 'required|numeric';
            $rules['second_a'] = 'required|numeric';
            $rules['first_b'] = 'required|numeric';
            $rules['second_b'] = 'required|numeric';
            if ($this->dem == '3') {
                $rules['third_a'] = 'required|numeric';
                $rules['third_b'] = 'required|numeric';
            }
        }

        if ($this->vector_b == 'coor') {
            $rules['bx'] = 'required|numeric';
            $rules['by'] = 'required|numeric';
            if ($this->dem == '3') $rules['bz'] = 'required|numeric';
        } else {
            $rules['first_aa'] = 'required|numeric';
            $rules['second_aa'] = 'required|numeric';
            $rules['first_bb'] = 'required|numeric';
            $rules['second_bb'] = 'required|numeric';
            if ($this->dem == '3') {
                $rules['third_aa'] = 'required|numeric';
                $rules['third_bb'] = 'required|numeric';
            }
        }

        $this->validate($rules, [
            'required' => 'Please fill all fields.',
            'numeric' => 'Please enter a valid number.',
        ]);

        $requestData = [
            'dem' => $this->dem,
            'vector_representation' => $this->vector_representation,
            'vector_b' => $this->vector_b,
            'ax' => $this->ax,
            'ay' => $this->ay,
            'az' => $this->az,
            'bx' => $this->bx,
            'by' => $this->by,
            'bz' => $this->bz,
            '1a' => $this->first_a,
            '2a' => $this->second_a,
            '3a' => $this->third_a,
            '1b' => $this->first_b,
            '2b' => $this->second_b,
            '3b' => $this->third_b,
            '1aa' => $this->first_aa,
            '2aa' => $this->second_aa,
            '3aa' => $this->third_aa,
            '1bb' => $this->first_bb,
            '2bb' => $this->second_bb,
            '3bb' => $this->third_bb,
        ];

        $model = new Physics();
        $result = $model->vector_projection($requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->error = null;
            $this->dispatch('mathRendered');
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

        $this->dem = '2';
        $this->vector_representation = 'coor';
        $this->vector_b = 'coor';
        $this->ax = '3';
        $this->ay = '4';
        $this->az = '5';
        $this->first_a = '2';
        $this->second_a = '3';
        $this->third_a = '4';
        $this->first_b = '5';
        $this->second_b = '6';
        $this->third_b = '7';
        $this->bx = '7';
        $this->by = '8';
        $this->bz = '9';
        $this->first_aa = '6';
        $this->second_aa = '7';
        $this->third_aa = '8';
        $this->first_bb = '9';
        $this->second_bb = '10';
        $this->third_bb = '11';

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);
    }

    public function render()
    {
        if (session()->pull('scroll_to_result')) {
            $this->dispatch('mathRendered');
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

        return view('livewire.calculators.vector-projection-calculator');
    }
}
