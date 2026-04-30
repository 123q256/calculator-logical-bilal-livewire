<?php

namespace App\Livewire\Calculators;
use App\Models\Physics;
use Livewire\Component;

class DensityAltitudeCalculator extends Component
{
    public $air_temp = 30;
    public $air_temp_unit = '°C';
    public $dewpoint = 16;
    public $dewpoint_unit = '°C';
    public $altimeter_setting = 890;
    public $altimeter_setting_unit = 'mb';
    public $station_elevation = 1300;
    public $station_elevation_unit = 'm';

    public $dropdowns = [];

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->air_temp = $inputs->air_temp ?? 30;
            $this->air_temp_unit = $inputs->air_temp_unit ?? '°C';
            $this->dewpoint = $inputs->dewpoint ?? 16;
            $this->dewpoint_unit = $inputs->dewpoint_unit ?? '°C';
            $this->altimeter_setting = $inputs->altimeter_setting ?? 890;
            $this->altimeter_setting_unit = $inputs->altimeter_setting_unit ?? 'mb';
            $this->station_elevation = $inputs->station_elevation ?? 1300;
            $this->station_elevation_unit = $inputs->station_elevation_unit ?? 'm';
        }
    }

    public function updated($propertyName)
    {
        if (strpos($propertyName, 'dropdowns') === false) {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function toggleDropdown($id)
    {
        $this->dropdowns[$id] = !($this->dropdowns[$id] ?? false);
    }

    public function setUnit($property, $unit, $dropdownId = null)
    {
        $this->{$property} = $unit;
        if ($dropdownId) {
            $this->dropdowns[$dropdownId] = false;
        }
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->air_temp = 30;
        $this->air_temp_unit = '°C';
        $this->dewpoint = 16;
        $this->dewpoint_unit = '°C';
        $this->altimeter_setting = 890;
        $this->altimeter_setting_unit = 'mb';
        $this->station_elevation = 1300;
        $this->station_elevation_unit = 'm';

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
            'air_temp'               => (float)$this->air_temp,
            'air_temp_unit'          => $this->air_temp_unit,
            'dewpoint'               => (float)$this->dewpoint,
            'dewpoint_unit'          => $this->dewpoint_unit,
            'altimeter_setting'      => (float)$this->altimeter_setting,
            'altimeter_setting_unit' => $this->altimeter_setting_unit,
            'station_elevation'      => (float)$this->station_elevation,
            'station_elevation_unit' => $this->station_elevation_unit,
        ];

        $model = new Physics();
        $result = $model->density_altitude($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);

            $this->dispatch('chartUpdated', data: $result['chartData']);

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
            $this->detail = null;
            session()->flash('validation_error', $this->error);
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
   
        return view('livewire.calculators.density-altitude-calculator');
    }
}
