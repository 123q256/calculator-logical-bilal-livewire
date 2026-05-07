<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class AquariumCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $shape = '1';
    public $length = 12;
    public $length_unit = 'cm';
    public $width = 12;
    public $width_unit = 'cm';
    public $height = 12;
    public $height_unit = 'cm';
    public $fill_depth = 12;
    public $fill_depth_unit = 'cm';
    public $front_pane = 16;
    public $front_pane_unit = 'cm';
    public $end_pane = 16;
    public $end_pane_unit = 'cm';
    public $radius = 16;
    public $radius_unit = 'cm';
    public $radius_one = 16;
    public $radius_one_unit = 'cm';
    public $radius_two = 16;
    public $radius_two_unit = 'cm';
    public $long_side = 16;
    public $long_side_unit = 'cm';
    public $short_side = 16;
    public $short_side_unit = 'cm';
    public $len_one = 16;
    public $len_one_unit = 'cm';
    public $len_two = 16;
    public $len_two_unit = 'cm';
    public $wid_one = 16;
    public $wid_one_unit = 'cm';
    public $wid_two = 16;
    public $wid_two_unit = 'cm';
    public $full_width = 16;
    public $full_width_unit = 'cm';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
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

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);
    }

    public function setUnit($property, $value)
    {
        $this->$property = $value;
        $this->updated(null);
    }

    public function resetForm()
    {
        $this->reset(['shape', 'length', 'length_unit', 'width', 'width_unit', 'height', 'height_unit', 'fill_depth', 'fill_depth_unit', 'front_pane', 'front_pane_unit', 'end_pane', 'end_pane_unit', 'radius', 'radius_unit', 'radius_one', 'radius_one_unit', 'radius_two', 'radius_two_unit', 'long_side', 'long_side_unit', 'short_side', 'short_side_unit', 'len_one', 'len_one_unit', 'len_two', 'len_two_unit', 'wid_one', 'wid_one_unit', 'wid_two', 'wid_two_unit', 'full_width', 'full_width_unit', 'detail', 'error']);

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
            'shape' => $this->shape,
            'length' => $this->length,
            'length_unit' => $this->length_unit,
            'width' => $this->width,
            'width_unit' => $this->width_unit,
            'height' => $this->height,
            'height_unit' => $this->height_unit,
            'fill_depth' => $this->fill_depth,
            'fill_depth_unit' => $this->fill_depth_unit,
            'front_pane' => $this->front_pane,
            'front_pane_unit' => $this->front_pane_unit,
            'end_pane' => $this->end_pane,
            'end_pane_unit' => $this->end_pane_unit,
            'radius' => $this->radius,
            'radius_unit' => $this->radius_unit,
            'radius_one' => $this->radius_one,
            'radius_one_unit' => $this->radius_one_unit,
            'radius_two' => $this->radius_two,
            'radius_two_unit' => $this->radius_two_unit,
            'long_side' => $this->long_side,
            'long_side_unit' => $this->long_side_unit,
            'short_side' => $this->short_side,
            'short_side_unit' => $this->short_side_unit,
            'len_one' => $this->len_one,
            'len_one_unit' => $this->len_one_unit,
            'len_two' => $this->len_two,
            'len_two_unit' => $this->len_two_unit,
            'wid_one' => $this->wid_one,
            'wid_one_unit' => $this->wid_one_unit,
            'wid_two' => $this->wid_two,
            'wid_two_unit' => $this->wid_two_unit,
            'full_width' => $this->full_width,
            'full_width_unit' => $this->full_width_unit,
        ];

        $model = new EverydayLife();
        $result = $model->aquarium((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
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
        return view('livewire.calculators.aquarium-calculator');
    }
}
