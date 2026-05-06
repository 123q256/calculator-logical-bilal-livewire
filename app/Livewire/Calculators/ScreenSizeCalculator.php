<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class ScreenSizeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $screen = '16:9';
    public $ratio_1 = 16;
    public $ratio_2 = 9;
    public $screen_type = 'flat'; // Renamed from type to avoid conflict with component $type
    public $curvature = '1500';
    public $radius = 12;
    public $radius_units = 'in';
    public $select_one = 'diagonal';
    public $select_two = 'Width';
    public $flat_dimensions = 12;
    public $flat_dimensions_units = 'in';
    public $curved_dimensions = 12;
    public $curved_dimensions_units = 'in';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }
        
        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

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

    public function updated($name, $value)
    {
        // List of properties that should trigger a result reset
        $inputProperties = [
            'screen', 'ratio_1', 'ratio_2', 'screen_type', 'curvature', 
            'radius', 'radius_units', 'select_one', 'select_two', 
            'flat_dimensions', 'flat_dimensions_units', 
            'curved_dimensions', 'curved_dimensions_units'
        ];

        if (in_array($name, $inputProperties)) {
            $this->detail = null;
        }
    }

    public function updatedRatio1($value)
    {
        $this->screen = 'custom';
    }

    public function updatedRatio2($value)
    {
        $this->screen = 'custom';
    }

    public function updatedScreen($value)
    {
        if ($value !== 'custom') {
            $ratios = explode(':', $value);
            if (count($ratios) === 2) {
                $this->ratio_1 = $ratios[0];
                $this->ratio_2 = $ratios[1];
            }
        } else {
            $this->ratio_1 = '';
            $this->ratio_2 = '';
        }
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->detail = null;
    }

    public function calculate()
    {
        // Preparation for model
        $request = (object)[
            'screen' => $this->screen,
            'ratio_1' => $this->ratio_1,
            'ratio_2' => $this->ratio_2,
            'type' => $this->screen_type,
            'curvature' => ($this->curvature === 'enter') ? $this->radius : $this->curvature,
            'radius' => ($this->curvature === 'enter') ? $this->radius : $this->curvature,
            'radius_units' => $this->radius_units,
            'select_one' => $this->select_one,
            'select_two' => $this->select_two,
            'curved_dimensions' => $this->curved_dimensions,
            'curved_dimensions_units' => $this->curved_dimensions_units,
            'flat_dimensions' => $this->flat_dimensions,
            'flat_dimensions_units' => $this->flat_dimensions_units,
        ];

        $model = new EverydayLife();
        $result = $model->screen($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                session()->flash('calculator_result', $result);
                session()->flash('calculator_back_inputs', (array)$request->all());
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->dispatch('scroll-to-result');
        } else {
            $this->error = $result['error'] ?? 'Please check your input.';
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
        return view('livewire.calculators.screen-size-calculator');
    }
}
