<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class RecessedLightingCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form inputs
    public $a = 2;
    public $b = 2;
    public $columns_fixture = 2;
    public $rows_fixture = 2;
    public $include = 'no';
    public $units = 'cm';
    public $image_path = 'images/recessed_image/2_2.webp';

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
        $this->updateImage();
    }

    public function updated($name, $value)
    {
        if (in_array($name, ['a', 'b', 'columns_fixture', 'rows_fixture', 'include', 'units'])) {
            $this->detail = null;
            $this->updateImage();
        }
    }

    public function updateImage()
    {
        $include_suffix = ($this->include === 'yes' && $this->columns_fixture == 2 && $this->rows_fixture == 2) ? '_yes' : '';
        $this->image_path = "images/recessed_image/{$this->columns_fixture}_{$this->rows_fixture}{$include_suffix}.webp";
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

    public function calculate()
    {
        $request = (object)[
            'a' => $this->a,
            'b' => $this->b,
            'columns_fixture' => $this->columns_fixture,
            'rows_fixture' => $this->rows_fixture,
            'include' => $this->include,
            'units' => $this->units,
        ];

        $model = new EverydayLife();
        $result = $model->recessed($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
              if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
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
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.recessed-lighting-calculator');
    }
}
