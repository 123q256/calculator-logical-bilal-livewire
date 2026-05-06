<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class DriveTimeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $distance = 800;
    public $distance_unit = 'km';
    public $average_speed = 80;
    public $average_speed_unit = 'km/h';
    public $breaks = 30;
    public $breaks_unit = 'min';
    public $departure_time = '';
    public $fuel_e = 8;
    public $fuel_e_unit = 'L/100km';
    public $fuel_p = 1.22;
    public $fuel_p_unit = ''; // Will be initialized in mount
    public $passengers = 1;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        $this->currancy = session('currency_symbol', '$');
        $this->fuel_p_unit = $this->currancy . '/L';

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->distance = $inputs->distance ?? 800;
            $this->distance_unit = $inputs->distance_unit ?? 'km';
            $this->average_speed = $inputs->average_speed ?? 80;
            $this->average_speed_unit = $inputs->average_speed_unit ?? 'km/h';
            $this->breaks = $inputs->breaks ?? 30;
            $this->breaks_unit = $inputs->breaks_unit ?? 'min';
            $this->departure_time = $inputs->departure_time ?? '';
            $this->fuel_e = $inputs->fuel_e ?? 8;
            $this->fuel_e_unit = $inputs->fuel_e_unit ?? 'L/100km';
            $this->fuel_p = $inputs->fuel_p ?? 1.22;
            $this->fuel_p_unit = $inputs->fuel_p_unit ?? ($this->currancy . '/L');
            $this->passengers = $inputs->passengers ?? 1;
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->distance = 800;
        $this->distance_unit = 'km';
        $this->average_speed = 80;
        $this->average_speed_unit = 'km/h';
        $this->breaks = 30;
        $this->breaks_unit = 'min';
        $this->departure_time = '';
        $this->fuel_e = 8;
        $this->fuel_e_unit = 'L/100km';
        $this->fuel_p = 1.22;
        $this->fuel_p_unit = $this->currancy . '/L';
        $this->passengers = 1;
        $this->error = null;
        $this->detail = null;

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
        $request = (object)[
            'distance'           => $this->distance,
            'distance_unit'      => $this->distance_unit,
            'average_speed'      => $this->average_speed,
            'average_speed_unit' => $this->average_speed_unit,
            'breaks'             => $this->breaks,
            'breaks_unit'        => $this->breaks_unit,
            'departure_time'     => $this->departure_time,
            'fuel_e'             => $this->fuel_e,
            'fuel_e_unit'        => $this->fuel_e_unit,
            'fuel_p'             => $this->fuel_p,
            'fuel_p_unit'        => $this->fuel_p_unit,
            'passengers'         => $this->passengers,
            'currancy'           => $this->currancy,
        ];

        $model = new EverydayLife();
        $result = $model->drive($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                return redirect()->to(url()->current());
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
        return view('livewire.calculators.drive-time-calculator');
    }
}
