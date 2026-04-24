<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class SquareFootageCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Top Level Inputs
    public $room_unit = '1'; // 1: Single Room, 2: Multiple Rooms
    public $quantity = 1;
    public $price = 8;
    public $price_unit = 'ft²';

    // Dynamic Rooms Data
    public $rooms = [];

    // UI State
    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        // Initialize first room
        $this->addRoom();

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

    public function removeRoom($index)
    {
        if (count($this->rooms) > 1) {
            unset($this->rooms[$index]);
            $this->rooms = array_values($this->rooms); // Re-index array
            $this->detail = null;
        }
    }

    public function addRoom()
    {
        if (count($this->rooms) >= 10) {
            $this->error = $this->lang[45] ?? 'You can add up to 10 rooms.';
            return;
        }

        $this->rooms[] = [
            'shape' => 'sq',
            'length' => 6,
            'length_unit' => 'ft',
            'width' => 6,
            'width_unit' => 'ft',
            'inner_length' => 6,
            'inner_length_unit' => 'ft',
            'inner_width' => 6,
            'inner_width_unit' => 'ft',
            'border_width' => 6,
            'border_width_unit' => 'ft',
            'sidealength' => 6,
            'sidealength_unit' => 'ft',
            'sideblength' => 6,
            'sideblength_unit' => 'ft',
            'sideclength' => 6,
            'sideclength_unit' => 'ft',
            'height' => 6,
            'height_unit' => 'ft',
            'diameter' => 6,
            'diameter_unit' => 'ft',
            'base' => 6,
            'base_unit' => 'ft',
            'axisa' => 6,
            'axisa_unit' => 'ft',
            'axisb' => 6,
            'axisb_unit' => 'ft',
            'radius' => 6,
            'radius_unit' => 'ft',
            'angle' => 6,
            'inner_diameter' => 6,
            'inner_diameter_unit' => 'ft',
            'outer_diameter' => 6,
            'outer_diameter_unit' => 'ft',
            'sides' => 6,
        ];
    }

    public function setRoomUnit($val)
    {
        $this->room_unit = $val;
        if ($val == '1' && count($this->rooms) > 1) {
            $this->rooms = array_slice($this->rooms, 0, 1);
        }
    }

    public function toggleOverlay($dropdown)
    {
        $this->showDropdown = ($this->showDropdown === $dropdown) ? null : $dropdown;
    }

    public function setUnit($field, $value, $roomIndex = null)
    {
        if ($roomIndex !== null) {
            $this->rooms[$roomIndex][$field] = $value;
        } else {
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
        $this->room_unit = '1';
        $this->quantity = 1;
        $this->price = 8;
        $this->price_unit = 'ft²';
        $this->rooms = [];
        $this->addRoom();
        $this->showDropdown = null;

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

        // Prepare arrays for the model
        $requestData = [
            'room_unit' => $this->room_unit,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'price_unit' => $this->price_unit,
            'shape_unit' => [],
            'length' => [],
            'length_unit' => [],
            'width' => [],
            'width_unit' => [],
            'inner_length' => [],
            'inner_length_unit' => [],
            'inner_width' => [],
            'inner_width_unit' => [],
            'border_width' => [],
            'border_width_unit' => [],
            'sidealength' => [],
            'sidealength_unit' => [],
            'sideblength' => [],
            'sideblength_unit' => [],
            'sideclength' => [],
            'sideclength_unit' => [],
            'height' => [],
            'height_unit' => [],
            'diameter' => [],
            'diameter_unit' => [],
            'base' => [],
            'base_unit' => [],
            'axisa' => [],
            'axisa_unit' => [],
            'axisb' => [],
            'axisb_unit' => [],
            'radius' => [],
            'radius_unit' => [],
            'angle' => [],
            'inner_diameter' => [],
            'inner_diameter_unit' => [],
            'outer_diameter' => [],
            'outer_diameter_unit' => [],
            'sides' => [],
        ];

        foreach ($this->rooms as $room) {
            $requestData['shape_unit'][] = $room['shape'];
            $requestData['length'][] = $room['length'];
            $requestData['length_unit'][] = $room['length_unit'];
            $requestData['width'][] = $room['width'];
            $requestData['width_unit'][] = $room['width_unit'];
            $requestData['inner_length'][] = $room['inner_length'];
            $requestData['inner_length_unit'][] = $room['inner_length_unit'];
            $requestData['inner_width'][] = $room['inner_width'];
            $requestData['inner_width_unit'][] = $room['inner_width_unit'];
            $requestData['border_width'][] = $room['border_width'];
            $requestData['border_width_unit'][] = $room['border_width_unit'];
            $requestData['sidealength'][] = $room['sidealength'];
            $requestData['sidealength_unit'][] = $room['sidealength_unit'];
            $requestData['sideblength'][] = $room['sideblength'];
            $requestData['sideblength_unit'][] = $room['sideblength_unit'];
            $requestData['sideclength'][] = $room['sideclength'];
            $requestData['sideclength_unit'][] = $room['sideclength_unit'];
            $requestData['height'][] = $room['height'];
            $requestData['height_unit'][] = $room['height_unit'];
            $requestData['diameter'][] = $room['diameter'];
            $requestData['diameter_unit'][] = $room['diameter_unit'];
            $requestData['base'][] = $room['base'];
            $requestData['base_unit'][] = $room['base_unit'];
            $requestData['axisa'][] = $room['axisa'];
            $requestData['axisa_unit'][] = $room['axisa_unit'];
            $requestData['axisb'][] = $room['axisb'];
            $requestData['axisb_unit'][] = $room['axisb_unit'];
            $requestData['radius'][] = $room['radius'];
            $requestData['radius_unit'][] = $room['radius_unit'];
            $requestData['angle'][] = $room['angle'];
            $requestData['inner_diameter'][] = $room['inner_diameter'];
            $requestData['inner_diameter_unit'][] = $room['inner_diameter_unit'];
            $requestData['outer_diameter'][] = $room['outer_diameter'];
            $requestData['outer_diameter_unit'][] = $room['outer_diameter_unit'];
            $requestData['sides'][] = $room['sides'];
        }

        $request = (object)$requestData;

        $model = new Construction();
        $result = $model->square_footage($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $this->all());
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
        return view('livewire.calculators.square-footage-calculator');
    }
}
