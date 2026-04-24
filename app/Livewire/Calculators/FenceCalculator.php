<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class FenceCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Form inputs with default values from blade
    public $f_length = '5';
    public $fl_units = 'km';
    public $post_space = '1';
    public $po_units = 'km';
    public $drop1 = '2'; // 1: Fence Height, 2: Post Height
    public $first = '13';
    public $units1 = 'km';
    public $p_width = '9';
    public $pw_units = 'km';
    public $p_spacing = '2';
    public $ps_units = 'km';
    public $drop2 = '2'; // 1: Rails per Section, 2: Total Rails
    public $second = '7'; // Rails count
    public $drop3 = '1'; // 1: Square Post, 2: Round Post
    public $third = '4';
    public $units3 = 'km';
    public $four = '6';
    public $units4 = 'km';

    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;
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

    public function toggleOverlay($dropdown)
    {
        $this->showDropdown = ($this->showDropdown === $dropdown) ? null : $dropdown;
    }

    public function setUnit($field, $value)
    {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        }
        $this->showDropdown = null;
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;
        
        $this->f_length = '5';
        $this->fl_units = 'km';
        $this->post_space = '1';
        $this->po_units = 'km';
        $this->drop1 = '2';
        $this->first = '13';
        $this->units1 = 'km';
        $this->p_width = '9';
        $this->pw_units = 'km';
        $this->p_spacing = '2';
        $this->ps_units = 'km';
        $this->drop2 = '2';
        $this->second = '7';
        $this->drop3 = '1';
        $this->third = '4';
        $this->units3 = 'km';
        $this->four = '6';
        $this->units4 = 'km';

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
        $requestData = [
            'f_length' => $this->f_length,
            'fl_units' => $this->fl_units,
            'post_space' => $this->post_space,
            'po_units' => $this->po_units,
            'drop1' => $this->drop1,
            'first' => $this->first,
            'units1' => $this->units1,
            'p_width' => $this->p_width,
            'pw_units' => $this->pw_units,
            'p_spacing' => $this->p_spacing,
            'ps_units' => $this->ps_units,
            'drop2' => $this->drop2,
            'second' => $this->second,
            'drop3' => $this->drop3,
            'third' => $this->third,
            'units3' => $this->units3,
            'four' => $this->four,
            'units4' => $this->units4,
        ];

        $request = (object)$requestData;

        $model = new Construction();
        $result = $model->fence($request);

        if (!isset($result['error'])) {
            $result['RESULT'] = 1; // Mark as successful
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->previous() ?? '/');
            } else {
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.fence-calculator');
    }
}

