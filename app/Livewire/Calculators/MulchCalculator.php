<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class MulchCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $m_shape = '0'; // 0: Rectangular, 1: Circular, 2: Triangular
    public $g = 'g1'; // g1: By Dimensions, g2: By Area
    public $check = 'g1';
    public $length = '24';
    public $length1 = 'm';
    public $width = '10';
    public $width1 = 'm';
    public $side1 = '10';
    public $side11 = 'm';
    public $side2 = '10';
    public $side21 = 'm';
    public $diameter = '15';
    public $diameter1 = 'm';
    public $sqr_ft = '15';
    public $sqr_ft1 = 'sq-ft';
    public $depth = '15';
    public $depth1 = 'cm';
    public $m_type = '6'; // Pine Needles default
    public $price_bag = '';
    public $bag_size = '';
    public $bag_size1 = 'cm';

    public $showDropdown = null;
    public $showOptional = false;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';

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
        
        $this->updateOptionalVisibility();
    }

    public function toggleOverlay($dropdown)
    {
        $this->showDropdown = ($this->showDropdown === $dropdown) ? null : $dropdown;
    }

    public function setUnit($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        $this->showDropdown = null;
        $this->detail = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'm_type') {
            $this->updateOptionalVisibility();
        }
        
        if ($propertyName === 'g') {
            $this->check = $this->g;
        }

        $this->detail = null;
        $this->error = null;
    }

    public function updateOptionalVisibility()
    {
        // Equivalent to JS: if(type === '6' || type === '10'){ optional.style.display= 'none'; }else{ optional.style.display= 'block'; }
        $this->showOptional = !($this->m_type === '6' || $this->m_type === '10');
    }

    public function toggleOptional()
    {
        $this->showOptional = !$this->showOptional;
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'm_shape', 'g', 'check', 'length', 'width', 'side1', 'side2', 'diameter', 'sqr_ft', 'depth', 'price_bag', 'bag_size']);
        $this->resetErrorBag();

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $this->error = null;
        $request = (object)[
            'm_shape' => $this->m_shape,
            'length' => $this->length,
            'length1' => $this->length1,
            'width' => $this->width,
            'width1' => $this->width1,
            'side1' => $this->side1,
            'side11' => $this->side11,
            'side2' => $this->side2,
            'side21' => $this->side21,
            'diameter' => $this->diameter,
            'diameter1' => $this->diameter1,
            'sqr_ft' => $this->sqr_ft,
            'sqr_ft1' => $this->sqr_ft1,
            'depth' => $this->depth,
            'depth1' => $this->depth1,
            'm_type' => $this->m_type,
            'bag_size' => $this->bag_size,
            'bag_size1' => $this->bag_size1,
            'price_bag' => $this->price_bag,
            'check' => $this->check,
            'g' => $this->g,
        ];

        $model = new Construction();
        $result = $model->mulch($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (array)$request);
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
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
        return view('livewire.calculators.mulch-calculator');
    }
}
