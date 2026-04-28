<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class VoltageDropCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $calculate_unit = '1';
    public $find_unit = '1';
    public $wire_material_unit = 'cu';
    public $wire_material_unit_two = '0';
    public $resistivity = '1.72e-8';
    public $max_voltage_drop = '1';
    public $wire_size_unit = '600';
    public $cable_length = '300';
    public $cable_length_unit = 'ft';
    public $wire_length = '300';
    public $wire_length_unit = 'ft';
    public $gauge = '50';
    public $wire_diameter_size = '8';
    public $wire_diameter_size_unit = 'AWG';
    public $load_current = '1.2';
    public $load_current_unit = 'am';
    public $conductors = '1';
    public $voltage = '220';
    public $voltage_unit = 'volts';
    public $material_of_conduit = 'pvc';
    public $power_voltage = '0.1'; // Power Factor
    public $wire_resistance = '1.29';
    public $wire_resistance_unit = 'km';
    public $phase_unit = '1';
    public $insulation = '0';
    public $raceway = '0';

    public $openDropdown = null;

    public $materialLabels = [];
    public $standardLabels = [];
    public $findLabels = [];
    public $conduitLabels = [];
    public $phaseLabels = [];
    public $insulationLabels = [];
    public $racewayLabels = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        $this->materialLabels = [
            'cu' => $lang['10'] ?? 'Copper',
            'al' => $lang['11'] ?? 'Aluminum',
            'cs' => $lang['12'] ?? 'Copper-Clad Steel',
            'es' => $lang['13'] ?? 'Extra High Strength Steel',
            'go' => $lang['14'] ?? 'Gold',
            'ni' => $lang['15'] ?? 'Nickel',
            'nic' => $lang['16'] ?? 'Nichrome',
            'si' => $lang['17'] ?? 'Silver',
            '0' => $lang['10'] ?? 'Copper',
            '1' => $lang['11'] ?? 'Aluminum',
        ];

        $this->standardLabels = [
            '1' => $lang['2'] ?? 'General',
            '2' => 'NEC ' . ($lang['3'] ?? 'Standard'),
            '3' => $lang['4'] ?? 'Estimated Resistance',
        ];

        $this->findLabels = [
            '1' => $lang['6'] ?? 'Voltage Drop',
            '2' => $lang['7'] ?? 'Wire Size',
            '3' => $lang['8'] ?? 'Maximum Length',
        ];

        $this->conduitLabels = [
            'pvc' => 'PVC',
            'aluminium' => $lang[11] ?? 'Aluminum',
            'steel' => $lang[30] ?? 'Steel',
        ];

        $this->phaseLabels = [
            '1' => 'DC',
            '2' => 'AC single-phase',
            '3' => 'AC three-phase',
        ];

        $this->insulationLabels = [
            '0' => '60°C',
            '1' => '75°C',
            '2' => '90°C',
        ];

        $this->racewayLabels = [
            '0' => 'Raceway / Cable / Buried',
            '1' => 'Open Air',
        ];

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
        $this->detail = null;
        $this->error = null;

        if ($propertyName === 'wire_material_unit') {
            $resistivities = [
                'cu' => '1.72e-8',
                'al' => '2.82e-8',
                'cs' => '1.43e-7',
                'es' => '4.6e-7',
                'go' => '2.44e-8',
                'ni' => '1.1e-6',
                'nic' => '6.99e-8',
                'si' => '1.59e-8',
            ];
            if (isset($resistivities[$this->wire_material_unit])) {
                $this->resistivity = $resistivities[$this->wire_material_unit];
            }
        }
    }

    public function calculate()
    {
        $rules = [
            'calculate_unit' => 'required',
            'load_current' => 'required|numeric',
            'conductors' => 'required|numeric',
            'voltage' => 'required|numeric',
        ];

        if ($this->calculate_unit == '1') {
            $rules['wire_length'] = 'required|numeric';
            $rules['wire_diameter_size'] = 'required|numeric';
        } elseif ($this->calculate_unit == '2') {
            $rules['cable_length'] = 'required|numeric';
            $rules['power_voltage'] = 'required|numeric';
        } elseif ($this->calculate_unit == '3') {
            $rules['wire_length'] = 'required|numeric';
            $rules['wire_resistance'] = 'required|numeric';
        }

        $this->validate($rules, [
            'required' => 'Please fill all fields.',
            'numeric' => 'Please enter a valid number.',
        ]);

        $requestData = [
            'calculate_unit' => $this->calculate_unit,
            'find_unit' => $this->find_unit,
            'wire_material_unit' => $this->wire_material_unit,
            'wire_material_unit_two' => $this->wire_material_unit_two,
            'resistivity' => $this->resistivity,
            'max_voltage_drop' => $this->max_voltage_drop,
            'wire_size_unit' => $this->wire_size_unit,
            'cable_length' => $this->cable_length,
            'cable_length_unit' => $this->cable_length_unit,
            'wire_length' => $this->wire_length,
            'wire_length_unit' => $this->wire_length_unit,
            'gauge' => $this->gauge,
            'wire_diameter_size' => $this->wire_diameter_size,
            'wire_diameter_size_unit' => $this->wire_diameter_size_unit,
            'load_current' => $this->load_current,
            'load_current_unit' => $this->load_current_unit,
            'conductors' => $this->conductors,
            'voltage' => $this->voltage,
            'voltage_unit' => $this->voltage_unit,
            'material_of_conduit' => $this->material_of_conduit,
            'power_voltage' => $this->power_voltage,
            'wire_resistance' => $this->wire_resistance,
            'wire_resistance_unit' => $this->wire_resistance_unit,
            'phase_unit' => $this->phase_unit,
            'insulation' => $this->insulation,
            'raceway' => $this->raceway,
        ];

        $model = new Physics();
        $result = $model->voltage((object)$requestData);

        // Standardize result check - some modes might not set RESULT=1
        if (!empty($result['RESULT']) || isset($result['wire_size']) || isset($result['vv']) || isset($result['voltage_drop_formula'])) {
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
            $this->error = $result['error'] ?? 'No results found for these inputs.';
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->calculate_unit = '1';
        $this->find_unit = '1';
        $this->wire_material_unit = 'cu';
        $this->wire_material_unit_two = '0';
        $this->resistivity = '1.72e-8';
        $this->max_voltage_drop = '1';
        $this->wire_size_unit = '600';
        $this->cable_length = '300';
        $this->cable_length_unit = 'ft';
        $this->wire_length = '300';
        $this->wire_length_unit = 'ft';
        $this->gauge = '50';
        $this->wire_diameter_size = '8';
        $this->wire_diameter_size_unit = 'AWG';
        $this->load_current = '1.2';
        $this->load_current_unit = 'am';
        $this->conductors = '1';
        $this->voltage = '220';
        $this->voltage_unit = 'volts';
        $this->material_of_conduit = 'pvc';
        $this->power_voltage = '0.1';
        $this->wire_resistance = '1.29';
        $this->wire_resistance_unit = 'km';
        $this->phase_unit = '1';
        $this->insulation = '0';
        $this->raceway = '0';

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

        return view('livewire.calculators.voltage-drop-calculator');
    }
}
