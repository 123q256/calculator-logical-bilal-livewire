<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class FoodCostCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Form inputs
    public $food_type = 'food_piece';
    public $menu = 45;
    public $measure_unit = 'Units';
    public $units_case = 45;
    public $cost_unit = 45;
    public $serving_size = 45;
    public $other = 45;
    public $menu_price = 45;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function setFoodType($value)
    {
        $this->food_type = $value;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset(['food_type', 'menu', 'measure_unit', 'units_case', 'cost_unit', 'serving_size', 'other', 'menu_price', 'detail', 'error']);
        
        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->current());
        }
    }

    public function calculate()
    {
        $this->error = null;

        $request = (object)[
            'food_type'    => $this->food_type,
            'menu'         => (float)$this->menu,
            'measure_unit' => $this->measure_unit,
            'units_case'   => (float)$this->units_case,
            'cost_unit'    => (float)$this->cost_unit,
            'serving_size' => (float)$this->serving_size,
            'other'        => (float)$this->other,
            'menu_price'   => (float)$this->menu_price,
        ];

        $model = new Health();
        $result = $model->food($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            return;
        }

        $this->error = $result['error'] ?? 'Please check your inputs.';
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
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
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.food-cost-calculator');
    }
}
