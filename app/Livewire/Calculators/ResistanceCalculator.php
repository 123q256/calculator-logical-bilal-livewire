<?php
 
namespace App\Livewire\Calculators;
 
use App\Models\Physics;
use Livewire\Component;
 
class ResistanceCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type_calc = 'calculator';
    public $lang = [];
 
    // Inputs
    public $operations = "1";
    public $band = "4";
    public $first = "yellow";
    public $second = "red";
    public $third = "blue";
    public $multi = "violet";
    public $tolerance = "orange";
    public $temp = "green";
    
    public $x = "12,32,12,4,55,12,13,5";
    
    public $length = 100;
    public $l_unit = "m";
    public $diameter = 0.05;
    public $d_unit = "cm";
    public $material = "58000000";
    public $conductivity = 58000000;
 
    public function mount($type = 'calculator', $lang = [])
    {
        $this->type_calc = $type;
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
 
    public function updatedMaterial($value)
    {
        $this->conductivity = $value;
    }
 
    public function resetForm()
    {
        $this->reset(['error', 'detail', 'operations', 'band', 'first', 'second', 'third', 'multi', 'tolerance', 'temp', 'x', 'length', 'l_unit', 'diameter', 'd_unit', 'material', 'conductivity']);
        
        $this->operations = "1";
        $this->band = "4";
        $this->first = "yellow";
        $this->second = "red";
        $this->third = "blue";
        $this->multi = "violet";
        $this->tolerance = "orange";
        $this->temp = "green";
        $this->x = "12,32,12,4,55,12,13,5";
        $this->length = 100;
        $this->l_unit = "m";
        $this->diameter = 0.05;
        $this->d_unit = "cm";
        $this->material = "58000000";
        $this->conductivity = 58000000;
 
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }
 
     public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $requestData = [
            'operations'   => $this->operations,
            'band'         => $this->band,
            'first'        => $this->first,
            'second'       => $this->second,
            'third'        => $this->third,
            'multi'        => $this->multi,
            'tolerance'    => $this->tolerance,
            'temp'         => $this->temp,
            'x'            => $this->x,
            'length'       => $this->length,
            'l_unit'       => $this->l_unit,
            'diameter'     => $this->diameter,
            'd_unit'       => $this->d_unit,
            'conductivity' => $this->conductivity,
        ];
 
        $request = (object)$requestData;
 
        $model = new Physics();
        $result = $model->resistance($request);
 
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
        return view('livewire.calculators.resistance-calculator');
    }
}
