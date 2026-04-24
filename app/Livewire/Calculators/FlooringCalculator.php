<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class FlooringCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $rooms = [
        ['length' => '22', 'width' => '13', 'length_unit' => 'cm', 'width_unit' => 'cm']
    ];
    public $cost = '';
    public $cost_unit = '$ m²';
    public $waste_factor = '';
    public $currancy = '$';
    public $showDropdown = null;

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            
            // Restore rooms from inputs
            if (isset($inputs->room_length) && is_array($inputs->room_length)) {
                $this->rooms = [];
                foreach ($inputs->room_length as $key => $length) {
                    $this->rooms[] = [
                        'length' => $length,
                        'width' => $inputs->room_width[$key] ?? '',
                        'length_unit' => $inputs->room_length_unit[$key] ?? 'cm',
                        'width_unit' => $inputs->room_width_unit[$key] ?? 'cm',
                    ];
                }
            }
            $this->cost = $inputs->cost ?? '';
            $this->cost_unit = $inputs->cost_unit ?? '$ m²';
            $this->waste_factor = $inputs->waste_factor ?? '';
            $this->currancy = $inputs->currancy ?? '$';
        }
    }

    public function addRoom()
    {
        if (count($this->rooms) < 5) {
            $this->rooms[] = ['length' => '', 'width' => '', 'length_unit' => 'cm', 'width_unit' => 'cm'];
        } else {
            $this->dispatch('alert', message: 'Only Five Fields are Allowed');
        }
    }

    public function removeRoom($index)
    {
        if (count($this->rooms) > 1) {
            unset($this->rooms[$index]);
            $this->rooms = array_values($this->rooms);
        }
    }

    public function toggleDropdown($name)
    {
        if ($this->showDropdown === $name) {
            $this->showDropdown = null;
        } else {
            $this->showDropdown = $name;
        }
    }

    public function setUnit($dropdown, $unit)
    {
        $this->$dropdown = $unit;
        $this->showDropdown = null;
    }

    public function setRoomUnit($index, $field, $unit)
    {
        $this->rooms[$index][$field] = $unit;
        $this->showDropdown = null;
    }

    public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'rooms', 'cost', 'cost_unit', 'waste_factor', 'showDropdown'
        ]);
        $this->rooms = [
            ['length' => '22', 'width' => '13', 'length_unit' => 'cm', 'width_unit' => 'cm']
        ];
        
        $this->resetErrorBag();
        $this->resetValidation();

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
        $request = (object)[
            'room_length' => array_column($this->rooms, 'length'),
            'room_width' => array_column($this->rooms, 'width'),
            'room_length_unit' => array_column($this->rooms, 'length_unit'),
            'room_width_unit' => array_column($this->rooms, 'width_unit'),
            'cost' => $this->cost,
            'cost_unit' => $this->cost_unit,
            'waste_factor' => $this->waste_factor,
            'currancy' => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->flooring($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                $this->error = null;
                return redirect()->to(url()->previous() ?? '/');
            } else {
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
                return;
            }
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->flash('validation_error', $this->error);
            return redirect()->to(url()->previous() ?? '/');
        } else {
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
        return view('livewire.calculators.flooring-calculator');
    }

  
}
