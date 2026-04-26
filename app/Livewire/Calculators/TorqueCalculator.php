<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class TorqueCalculator extends Component
{
    public $error   = null;
    public $detail  = null;
    public $type    = 'calculator';
    public $lang    = [];

    public $to = '1'; // 1=torque | 2=coil | 3=vector

    public $distance = '5';
    public $dis_u    = 'm';
    public $force    = '10';
    public $for_u    = 'N';
    public $angle    = '30';
    public $ang_u    = 'deg';
    public $torque   = '';
    public $tor_u    = 'Nm';

    public $loop     = '2';
    public $angle_c  = '4';
    public $angc_u   = 'deg';
    public $current  = '5';
    public $cur_u    = 'A';
    public $area     = '12';
    public $area_u   = 'm²';
    public $mag      = '10';
    public $mag_u    = 'T';
    public $field    = '10'; // alias
    public $fie_u    = 'T';  // alias
    public $tor      = '';
    public $torc_u   = 'Nm';

    public $ax = '00';
    public $ay = '00';
    public $az = '00';
    public $bx = '00';
    public $by = '00';
    public $bz = '00';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'openDropdown') {
            $this->detail = null;
        }

        // Sync aliases
        if ($propertyName === 'mag') $this->field = $this->mag;
        if ($propertyName === 'field') $this->mag = $this->field;
        if ($propertyName === 'mag_u') $this->fie_u = $this->mag_u;
        if ($propertyName === 'fie_u') $this->mag_u = $this->fie_u;
    }

    public function toggleDropdown(string $name): void
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function closeDropdown(): void
    {
        $this->openDropdown = null;
    }

    public function setUnit(string $field, string $unit): void
    {
        if (property_exists($this, $field)) {
            $this->$field = $unit;
            
            // Sync aliases
            if ($field === 'mag_u') $this->fie_u = $unit;
            if ($field === 'fie_u') $this->mag_u = $unit;
        }
        $this->openDropdown = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error   = null;
        $this->detail  = null;

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

        $requestData = [
            'to'       => $this->to,
            'distance' => $this->distance,
            'dis_u'    => $this->dis_u,
            'force'    => $this->force,
            'for_u'    => $this->for_u,
            'angle'    => $this->angle,
            'ang_u'    => $this->ang_u,
            'torque'   => $this->torque,
            'tor_u'    => $this->tor_u,
            'loop'     => $this->loop,
            'angle_c'  => $this->angle_c,
            'angc_u'   => $this->angc_u,
            'current'  => $this->current,
            'cur_u'    => $this->cur_u,
            'area'     => $this->area,
            'area_u'   => $this->area_u,
            'mag'      => $this->mag,
            'mag_u'    => $this->mag_u,
            'tor'      => $this->tor,
            'torc_u'   => $this->torc_u,
            'ax'       => $this->ax,
            'ay'       => $this->ay,
            'az'       => $this->az,
            'bx'       => $this->bx,
            'by'       => $this->by,
            'bz'       => $this->bz,
        ];

        $request = (object)$requestData;
        $model = new Physics();
        $result = $model->torque($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
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
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);
                 return redirect()->to(url()->previous() ?? '/');
            }
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

        return view('livewire.calculators.torque-calculator');
    }
}