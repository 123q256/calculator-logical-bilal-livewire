<?php
 
namespace App\Livewire\Calculators;
 
use App\Models\Physics;
use Livewire\Component;
 
class ParallelResistorCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type_calc = 'calculator';
    public $lang = [];
 
    // Form properties
    public $mode = 1; // 1: Total Resistance, 2: Missing Resistor
    public $missing = 500;
    public $mis_unit = 'mΩ';
    public $resistors = [
        ['val' => 50, 'unit' => 1],
        ['val' => 50, 'unit' => 1],
    ];
 
    public $openDropdown = null;
 
    public function mount($type = 'calculator', $lang = [])
    {
        $this->type_calc = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
 
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->mode = $inputs['mode'] ?? 1;
            $this->missing = $inputs['missing'] ?? 500;
            $this->mis_unit = $inputs['mis_unit'] ?? 'mΩ';
            
            if (isset($inputs['res_val']) && isset($inputs['unit'])) {
                $this->resistors = [];
                foreach ($inputs['res_val'] as $index => $val) {
                    $this->resistors[] = [
                        'val' => $val,
                        'unit' => $inputs['unit'][$index] ?? 1,
                    ];
                }
            }
        }
    }
 
    public function toggleDropdown($name)
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }
 
    public function setUnit($name, $value)
    {
        if ($name === 'mis_unit') {
            $this->mis_unit = $value;
        }
        $this->openDropdown = null;
    }
 
    public function addResistor()
    {
        if (count($this->resistors) < 30) {
            $this->resistors[] = ['val' => 50, 'unit' => 1];
        } else {
            $this->error = $this->lang[12] ?? 'Maximum 30 resistors allowed.';
        }
    }
 
    public function removeResistor($index)
    {
        if (count($this->resistors) > 2) {
            unset($this->resistors[$index]);
            $this->resistors = array_values($this->resistors);
        }
    }
 
    public function resetForm()
    {
        $this->reset(['error', 'detail', 'mode', 'missing', 'mis_unit', 'resistors']);
        $this->resistors = [
            ['val' => 50, 'unit' => 1],
            ['val' => 50, 'unit' => 1],
        ];
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }
 
    public function calculate()
    {
        $resVals = [];
        $units = [];
        foreach ($this->resistors as $res) {
            $resVals[] = $res['val'];
            $units[] = $res['unit'];
        }
 
        $requestData = [
            'mode'     => $this->mode,
            'res_val'  => $resVals,
            'unit'     => $units,
            'missing'  => $this->missing,
            'mis_unit' => $this->mis_unit,
        ];
 
        $request = (object)$requestData;
 
        $model = new Physics();
        $result = $model->parallel($request);
 
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
 
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $requestData);
 
            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
 
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
            session()->flash('validation_error', $this->error);
            $this->detail = null;
        }
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
        return view('livewire.calculators.parallel-resistor-calculator');
    }
}
