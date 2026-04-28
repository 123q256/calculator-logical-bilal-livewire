<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class TransformerCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $phase_unit = '1';
    public $transformer_rating = '12';
    public $transformer_rating_unit = 'VA';
    public $primary_transformer_voltage = '12';
    public $primary_transformer_unit = 'V';
    public $secondary_transformer_voltage = '12';
    public $secondary_transformer_unit = 'V';
    public $primary_current = '50';
    public $secondary_current = '50';
    public $primary_winding = '50';
    public $secondary_winding = '50';
    public $calculation_unit = '1';
    public $kva = '50';
    public $volts = '50';
    public $amperes = '50';
    public $impedance = '50';
    public $eddy_current = '50';
    public $thickness = '50';
    public $flux_density = '50';
    public $frequency = '50';
    public $hysteresis_constant = '50';
    public $number_of_turns = '50';
    public $location = '1';

    public $openDropdown = null;

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

    public function toggleDropdown($id)
    {
        $this->openDropdown = ($this->openDropdown === $id) ? null : $id;
    }

    public function setUnit($field, $value)
    {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        }
        $this->openDropdown = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'calculation_unit') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function calculate()
    {
        $rules = [
            'calculation_unit' => 'required',
        ];

        // Specific validation based on calculation mode
        switch ($this->calculation_unit) {
            case '1':
                $rules['primary_winding'] = 'required|numeric';
                $rules['secondary_winding'] = 'required|numeric';
                $rules['primary_transformer_voltage'] = 'required|numeric';
                break;
            case '2':
                $rules['primary_winding'] = 'required|numeric';
                $rules['secondary_winding'] = 'required|numeric';
                $rules['secondary_transformer_voltage'] = 'required|numeric';
                break;
            case '3':
                $rules['primary_winding'] = 'required|numeric';
                $rules['secondary_transformer_voltage'] = 'required|numeric';
                $rules['primary_transformer_voltage'] = 'required|numeric';
                break;
            case '4':
                $rules['secondary_winding'] = 'required|numeric';
                $rules['secondary_transformer_voltage'] = 'required|numeric';
                $rules['primary_transformer_voltage'] = 'required|numeric';
                break;
            case '5':
                $rules['primary_current'] = 'required|numeric';
                $rules['primary_winding'] = 'required|numeric';
                $rules['secondary_winding'] = 'required|numeric';
                break;
            case '6':
                $rules['secondary_current'] = 'required|numeric';
                $rules['primary_winding'] = 'required|numeric';
                $rules['secondary_winding'] = 'required|numeric';
                break;
            case '7':
                $rules['secondary_current'] = 'required|numeric';
                $rules['primary_current'] = 'required|numeric';
                $rules['primary_winding'] = 'required|numeric';
                break;
            case '8':
                $rules['secondary_current'] = 'required|numeric';
                $rules['primary_current'] = 'required|numeric';
                $rules['secondary_winding'] = 'required|numeric';
                break;
            case '9':
                $rules['transformer_rating'] = 'required|numeric';
                $rules['primary_transformer_voltage'] = 'required|numeric';
                $rules['secondary_transformer_voltage'] = 'required|numeric';
                $rules['impedance'] = 'required|numeric';
                break;
            case '10':
                $rules['volts'] = 'required|numeric';
                $rules['kva'] = 'required|numeric';
                break;
            case '11':
                $rules['volts'] = 'required|numeric';
                $rules['amperes'] = 'required|numeric';
                break;
            case '12':
                $rules['kva'] = 'required|numeric';
                $rules['amperes'] = 'required|numeric';
                break;
            case '13':
                $rules['primary_current'] = 'required|numeric';
                $rules['secondary_current'] = 'required|numeric';
                $rules['primary_winding'] = 'required|numeric';
                $rules['secondary_winding'] = 'required|numeric';
                $rules['eddy_current'] = 'required|numeric';
                $rules['thickness'] = 'required|numeric';
                $rules['flux_density'] = 'required|numeric';
                $rules['frequency'] = 'required|numeric';
                $rules['hysteresis_constant'] = 'required|numeric';
                break;
            case '14':
                $rules['frequency'] = 'required|numeric';
                $rules['number_of_turns'] = 'required|numeric';
                $rules['flux_density'] = 'required|numeric';
                break;
        }

        $this->validate($rules, [
            'required' => 'Please fill all fields.',
            'numeric' => 'Please enter valid numbers.',
        ]);

        $requestData = [
            'phase_unit' => $this->phase_unit,
            'transformer_rating' => $this->transformer_rating,
            'transformer_rating_unit' => $this->transformer_rating_unit,
            'primary_transformer_voltage' => $this->primary_transformer_voltage,
            'primary_transformer_unit' => $this->primary_transformer_unit,
            'secondary_transformer_voltage' => $this->secondary_transformer_voltage,
            'secondary_transformer_unit' => $this->secondary_transformer_unit,
            'primary_current' => $this->primary_current,
            'secondary_current' => $this->secondary_current,
            'primary_winding' => $this->primary_winding,
            'secondary_winding' => $this->secondary_winding,
            'calculation_unit' => $this->calculation_unit,
            'kva' => $this->kva,
            'volts' => $this->volts,
            'amperes' => $this->amperes,
            'impedance' => $this->impedance,
            'eddy_current' => $this->eddy_current,
            'thickness' => $this->thickness,
            'flux_density' => $this->flux_density,
            'frequency' => $this->frequency,
            'hysteresis_constant' => $this->hysteresis_constant,
            'number_of_turns' => $this->number_of_turns,
            'location' => $this->location,
        ];

        $model = new Physics();
        $result = $model->transformer((object)$requestData);

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

        $this->phase_unit = '1';
        $this->transformer_rating = '12';
        $this->transformer_rating_unit = 'VA';
        $this->primary_transformer_voltage = '12';
        $this->primary_transformer_unit = 'V';
        $this->secondary_transformer_voltage = '12';
        $this->secondary_transformer_unit = 'V';
        $this->primary_current = '50';
        $this->secondary_current = '50';
        $this->primary_winding = '50';
        $this->secondary_winding = '50';
        $this->calculation_unit = '1';
        $this->kva = '50';
        $this->volts = '50';
        $this->amperes = '50';
        $this->impedance = '50';
        $this->eddy_current = '50';
        $this->thickness = '50';
        $this->flux_density = '50';
        $this->frequency = '50';
        $this->hysteresis_constant = '50';
        $this->number_of_turns = '50';
        $this->location = '1';

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

        return view('livewire.calculators.transformer-calculator');
    }
}
