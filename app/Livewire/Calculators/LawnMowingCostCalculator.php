<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class LawnMowingCostCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $calc_type = 'lawn_mowed';
    public $charges = 'area';
    public $mow_price = 12;
    public $m_p_units = '';
    public $area_mow = 10;
    public $a_m_units = 'km²';
    public $hours_work = 10;
    public $mow_speed = 10;
    public $mow_speed_units = 'km/h';
    public $mow_width = 6;
    public $mow_width_units = 'km';
    public $mow_pro = 80;
    public $to_mow = 6;
    public $to_mow_units = 'ft²/to mow';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = session('currency', '$');
        $this->m_p_units = $this->currancy . ' km²';
        
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calc_type = $inputs->type ?? 'lawn_mowed';
            $this->charges = $inputs->charges ?? 'area';
            $this->mow_price = $inputs->mow_price ?? 12;
            $this->m_p_units = $inputs->m_p_units ?? $this->currancy . ' km²';
            $this->area_mow = $inputs->area_mow ?? 10;
            $this->a_m_units = $inputs->a_m_units ?? 'km²';
            $this->hours_work = $inputs->hours_work ?? 10;
            $this->mow_speed = $inputs->mow_speed ?? 10;
            $this->mow_speed_units = $inputs->mow_speed_units ?? 'km/h';
            $this->mow_width = $inputs->mow_width ?? 6;
            $this->mow_width_units = $inputs->mow_width_units ?? 'km';
            $this->mow_pro = $inputs->mow_pro ?? 80;
            $this->to_mow = $inputs->to_mow ?? 6;
            $this->to_mow_units = $inputs->to_mow_units ?? 'ft²/to mow';
        }
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

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
            'type'            => $this->calc_type,
            'charges'         => $this->charges,
            'mow_price'       => $this->mow_price,
            'm_p_units'       => $this->m_p_units,
            'currancy'        => $this->currancy,
            'area_mow'        => $this->area_mow,
            'a_m_units'       => $this->a_m_units,
            'hours_work'      => $this->hours_work,
            'mow_speed'       => $this->mow_speed,
            'mow_speed_units' => $this->mow_speed_units,
            'mow_width'       => $this->mow_width,
            'mow_width_units' => $this->mow_width_units,
            'mow_pro'         => $this->mow_pro,
            'to_mow'          => $this->to_mow,
            'to_mow_units'    => $this->to_mow_units,
        ];

        $model = new EverydayLife();
        $result = $model->lawn((object)$requestData);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', (object)$requestData);
                $this->error = null;

                return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
                $this->error = null;
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
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
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
    
        return view('livewire.calculators.lawn-mowing-cost-calculator');
    }
}
