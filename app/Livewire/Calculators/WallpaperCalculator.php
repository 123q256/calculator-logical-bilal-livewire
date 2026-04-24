<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\Construction;

class WallpaperCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form fields
    public $calc_type = '1';
    public $room_length = '22';
    public $room_length_unit = 'cm';
    public $room_width = '22';
    public $room_width_unit = 'cm';
    public $room_height = '12';
    public $room_height_unit = 'm';
    public $wall_width = '12';
    public $wall_width_unit = 'm';
    public $wall_height = '20';
    public $wall_height_unit = 'm';
    public $door_height = '20';
    public $door_height_unit = 'm';
    public $door_width = '20';
    public $door_width_unit = 'm';
    public $no_of_doors = '15';
    public $window_height = '6';
    public $window_height_unit = 'm';
    public $window_width = '8';
    public $window_width_unit = 'm';
    public $no_of_windows = '10';
    public $roll_length = '8';
    public $roll_length_unit = 'm';
    public $roll_width = '8';
    public $roll_width_unit = 'm';
    public $cost = '7';
    public $pattern = '0.1';
    public $pattern_unit = 'm';
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
            $this->calc_type = $inputs->type ?? '1';
            $this->room_length = $inputs->room_length ?? '22';
            $this->room_length_unit = $inputs->room_length_unit ?? 'cm';
            $this->room_width = $inputs->room_width ?? '22';
            $this->room_width_unit = $inputs->room_width_unit ?? 'cm';
            $this->room_height = $inputs->room_height ?? '12';
            $this->room_height_unit = $inputs->room_height_unit ?? 'm';
            $this->wall_width = $inputs->wall_width ?? '12';
            $this->wall_width_unit = $inputs->wall_width_unit ?? 'm';
            $this->wall_height = $inputs->wall_height ?? '20';
            $this->wall_height_unit = $inputs->wall_height_unit ?? 'm';
            $this->door_height = $inputs->door_height ?? '20';
            $this->door_height_unit = $inputs->door_height_unit ?? 'm';
            $this->door_width = $inputs->door_width ?? '20';
            $this->door_width_unit = $inputs->door_width_unit ?? 'm';
            $this->no_of_doors = $inputs->no_of_doors ?? '15';
            $this->window_height = $inputs->window_height ?? '6';
            $this->window_height_unit = $inputs->window_height_unit ?? 'm';
            $this->window_width = $inputs->window_width ?? '8';
            $this->window_width_unit = $inputs->window_width_unit ?? 'm';
            $this->no_of_windows = $inputs->no_of_windows ?? '10';
            $this->roll_length = $inputs->roll_length ?? '8';
            $this->roll_length_unit = $inputs->roll_length_unit ?? 'm';
            $this->roll_width = $inputs->roll_width ?? '8';
            $this->roll_width_unit = $inputs->roll_width_unit ?? 'm';
            $this->cost = $inputs->cost ?? '7';
            $this->pattern = $inputs->pattern ?? '0.1';
            $this->pattern_unit = $inputs->pattern_unit ?? 'm';
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

    public function resetForm()
    {
        $this->reset([
            'error', 'detail', 'calc_type', 'room_length', 'room_length_unit', 'room_width', 'room_width_unit', 'room_height', 'room_height_unit', 
            'wall_width', 'wall_width_unit', 'wall_height', 'wall_height_unit', 'door_height', 'door_height_unit', 'door_width', 'door_width_unit', 
            'no_of_doors', 'window_height', 'window_height_unit', 'window_width', 'window_width_unit', 'no_of_windows', 'roll_length', 
            'roll_length_unit', 'roll_width', 'roll_width_unit', 'cost', 'pattern', 'pattern_unit', 'showDropdown'
        ]);

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
            'type' => $this->calc_type,
            'room_length' => $this->room_length,
            'room_length_unit' => $this->room_length_unit,
            'room_width' => $this->room_width,
            'room_width_unit' => $this->room_width_unit,
            'room_height' => $this->room_height,
            'room_height_unit' => $this->room_height_unit,
            'door_height' => $this->door_height,
            'door_height_unit' => $this->door_height_unit,
            'door_width' => $this->door_width,
            'door_width_unit' => $this->door_width_unit,
            'no_of_doors' => $this->no_of_doors,
            'window_height' => $this->window_height,
            'window_height_unit' => $this->window_height_unit,
            'window_width' => $this->window_width,
            'window_width_unit' => $this->window_width_unit,
            'no_of_windows' => $this->no_of_windows,
            'roll_length' => $this->roll_length,
            'roll_length_unit' => $this->roll_length_unit,
            'roll_width' => $this->roll_width,
            'roll_width_unit' => $this->roll_width_unit,
            'cost' => $this->cost,
            'pattern' => $this->pattern,
            'pattern_unit' => $this->pattern_unit,
            'wall_width' => $this->wall_width,
            'wall_width_unit' => $this->wall_width_unit,
            'wall_height' => $this->wall_height,
            'wall_height_unit' => $this->wall_height_unit,
            'currancy' => $this->currancy,
        ];

        $model = new Construction();
        $result = $model->wallpaper($request);

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
        return view('livewire.calculators.wallpaper-calculator');
    }
}
