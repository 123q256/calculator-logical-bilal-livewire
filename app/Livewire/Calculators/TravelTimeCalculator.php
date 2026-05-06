<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class TravelTimeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $distance = '240';
    public $distance_unit = 'km';
    public $speed = '60';
    public $speed_unit = 'km'; // Actually speed unit in km/h or mi/h
    public $break_hrs = '1';
    public $break_min = '30';
    public $dep_time = '';
    public $fule_effi = '15';
    public $fule_effi_unit = 'kmpl';
    public $price = '150';
    public $price_unit = 'liter';
    public $passenger = '1';
    public $currancy = '$';
    public $device = 'desktop';
    
    // Dropdown state is now handled by Alpine.js for faster UI response

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        $this->dep_time = date('Y-m-d\TH:i');
        $this->currancy = $this->lang['currancy'] ?? '$';
        $this->price_unit = $this->currancy . ' liter';
        
        // Simple device detection for layout parity
        $this->device = (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/Mobile|Android|BlackBerry|iPhone|Windows Phone/i', $_SERVER['HTTP_USER_AGENT'])) ? 'mobile' : 'desktop';

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

        // Standard keys for inc.button
        $this->lang['calculate'] = $this->lang['calculate'] ?? ($this->lang['calculate_btn'] ?? 'Calculate');
        $this->lang['reset'] = $this->lang['reset'] ?? ($this->lang['reset_btn'] ?? 'Reset');
    }

    public function resetForm()
    {
        $this->reset(['distance', 'distance_unit', 'speed', 'speed_unit', 'break_hrs', 'break_min', 'dep_time', 'fule_effi', 'fule_effi_unit', 'price', 'price_unit', 'passenger', 'detail', 'error']);
        $this->dep_time = date('Y-m-d\TH:i');
        
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
            'distance' => $this->distance,
            'distance_unit' => $this->distance_unit,
            'speed' => $this->speed,
            'speed_unit' => $this->speed_unit,
            'break_hrs' => $this->break_hrs,
            'break_min' => $this->break_min,
            'dep_time' => $this->dep_time,
            'fule_effi' => $this->fule_effi,
            'fule_effi_unit' => $this->fule_effi_unit,
            'price' => $this->price,
            'price_unit' => $this->price_unit,
            'passenger' => $this->passenger,
            'currancy' => $this->currancy,
        ];

        $model = new EverydayLife();
        $result = $model->travel((object)$requestData);

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
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
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
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            session()->forget('scroll_to_result');
        }
        return view('livewire.calculators.travel-time-calculator');
    }
}
