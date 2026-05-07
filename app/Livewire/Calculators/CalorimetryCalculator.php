<?php

namespace App\Livewire\Calculators;
use App\Models\Chemistry;
use Livewire\Component;

class CalorimetryCalculator extends Component
{
    public $state_change = 'a chemical reaction in a cofee cup calorimeter';
    public $obj_units = '2';
    public $state = 'No';
    public $formula = 'Heat Energy';
    public $type_radio = 'temp_change';

    // Single Object Inputs
    public $mass = 10, $m_units = 'grams (g)';
    public $heat_capacity = 25, $s_heat_units = 'joules per gram per kelvin (J/(g.K)';
    public $temp_change = 20, $t_c_units = 'kelvin K';
    public $energy = 20, $units = 'joules (J)';
    public $subtance_mass = 15, $s_m_units = 'grams (g)';
    public $molar_mass = 20;
    public $in_temp = 20, $i_t_units = 'kelvin K';
    public $s_fin_temp = 30, $S_f_t_units = 'kelvin K';

    // 2 Objects Inputs
    public $formula_2obj = 'm1';
    public $two_time = 'm1_two';
    public $mass_1 = 10, $m_units1 = 'grams (g)';
    public $mass_2 = 20, $m_units2 = 'grams (g)';
    public $heat_capacity_1 = 25, $s_heat_units1 = 'joules per gram per kelvin (J/(g.k)';
    public $heat_capacity_2 = 50, $s_heat_units2 = 'joules per gram per kelvin (J/(g.k)';
    public $in_temp_1 = 20, $i_t_units1 = 'kelvin K';
    public $in_temp_2 = 20, $i_t_units2 = 'kelvin K';
    public $fin_temp_1 = 30, $f_t_units1 = 'kelvin K';
    public $fin_temp_2 = 30, $f_t_units2 = 'kelvin K';
    public $fin_temp = 50, $f_t_units = 'kelvin K';
    public $t_fusion = 40, $t_units = 'kelvin K';
    public $h_fusion = 30, $h_fusion_unit = 'joules per gram per kelvin (J/(g.k)';

    // 3 Objects Inputs
    public $formula_3obj = 'm1';
    public $three_time = 'm1';
    public $mass_1_3 = 10, $m_units1_3 = 'grams (g)';
    public $mass_2_3 = 10, $m_units2_3 = 'grams (g)';
    public $mass_3_3 = 40, $m_units3_3 = 'grams (g)';
    public $heat_capacity_1_3 = 25, $s_heat_units1_3 = 'joules per gram per kelvin (J/(g.k)';
    public $heat_capacity_2_3 = 50, $s_heat_units2_3 = 'joules per gram per kelvin (J/(g.k)';
    public $heat_capacity_3_3 = 70, $s_heat_units3_3 = 'joules per gram per kelvin (J/(g.k)';
    public $in_temp_1_3 = 60, $i_t_units1_3 = 'kelvin K';
    public $in_temp_2_3 = 40, $i_t_units2_3 = 'kelvin K';
    public $in_temp_3_3 = 20, $i_t_units3_3 = 'kelvin K';
    public $fin_temp_1_3 = 80, $f_t_units1_3 = 'kelvin K';
    public $fin_temp_2_3 = 10, $f_t_units2_3 = 'kelvin K';
    public $fin_temp_3_3 = 25, $f_t_units3_3 = 'kelvin K';
    public $fin_temp_3 = 50, $f_t_units_3 = 'kelvin K';
    public $t_fusion_3 = 30, $t_units_3 = 'kelvin K';
    public $h_fusion_3 = 30, $h_units3 = 'joules per gram per kelvin (J/(g.k)';

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
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->reset();
        $this->mount($this->type, $this->lang);
        session()->forget(['calculator_result', 'validation_error', 'scroll_to_result']);
          if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'state_change' => $this->state_change,
            'obj_units' => $this->obj_units,
            'state' => $this->state,
            'formula' => $this->formula,
            'type' => $this->type_radio,
            'mass' => $this->mass,
            'm_units' => $this->m_units,
            'heat_capacity' => $this->heat_capacity,
            's_heat_units' => $this->s_heat_units,
            'temp_change' => $this->temp_change,
            't_c_units' => $this->t_c_units,
            'energy' => $this->energy,
            'units' => $this->units,
            'subtance_mass' => $this->subtance_mass,
            's_m_units' => $this->s_m_units,
            'molar_mass' => $this->molar_mass,
            'in_temp' => $this->in_temp,
            'i_t_units' => $this->i_t_units,
            's_fin_temp' => $this->s_fin_temp,
            'S_f_t_units' => $this->S_f_t_units,
            'formula_2obj' => $this->formula_2obj,
            'two_time' => $this->two_time,
            'mass_1' => $this->mass_1,
            'm_units1' => $this->m_units1,
            'mass_2' => $this->mass_2,
            'm_units2' => $this->m_units2,
            'heat_capacity_1' => $this->heat_capacity_1,
            's_heat_units1' => $this->s_heat_units1,
            'heat_capacity_2' => $this->heat_capacity_2,
            's_heat_units2' => $this->s_heat_units2,
            'in_temp_1' => $this->in_temp_1,
            'i_t_units1' => $this->i_t_units1,
            'in_temp_2' => $this->in_temp_2,
            'i_t_units2' => $this->i_t_units2,
            'fin_temp_1' => $this->fin_temp_1,
            'f_t_units1' => $this->f_t_units1,
            'fin_temp_2' => $this->fin_temp_2,
            'f_t_units2' => $this->f_t_units2,
            'fin_temp' => $this->fin_temp,
            'f_t_units' => $this->f_t_units,
            't_fusion' => $this->t_fusion,
            't_units' => $this->t_units,
            'h_fusion' => $this->h_fusion,
            'h_fusion_unit' => $this->h_fusion_unit,
            'formula_3obj' => $this->formula_3obj,
            'three_time' => $this->three_time,
            'mass_1_3' => $this->mass_1_3,
            'm_units1_3' => $this->m_units1_3,
            'mass_2_3' => $this->mass_2_3,
            'm_units2_3' => $this->m_units2_3,
            'mass_3_3' => $this->mass_3_3,
            'm_units3_3' => $this->m_units3_3,
            'heat_capacity_1_3' => $this->heat_capacity_1_3,
            's_heat_units1_3' => $this->s_heat_units1_3,
            'heat_capacity_2_3' => $this->heat_capacity_2_3,
            's_heat_units2_3' => $this->s_heat_units2_3,
            'heat_capacity_3_3' => $this->heat_capacity_3_3,
            's_heat_units3_3' => $this->s_heat_units3_3,
            'in_temp_1_3' => $this->in_temp_1_3,
            'i_t_units1_3' => $this->i_t_units1_3,
            'in_temp_2_3' => $this->in_temp_2_3,
            'i_t_units2_3' => $this->i_t_units2_3,
            'in_temp_3_3' => $this->in_temp_3_3,
            'i_t_units3_3' => $this->i_t_units3_3,
            'fin_temp_1_3' => $this->fin_temp_1_3,
            'f_t_units1_3' => $this->f_t_units1_3,
            'fin_temp_2_3' => $this->fin_temp_2_3,
            'f_t_units2_3' => $this->f_t_units2_3,
            'fin_temp_3_3' => $this->fin_temp_3_3,
            'f_t_units3_3' => $this->f_t_units3_3,
            'fin_temp_3' => $this->fin_temp_3,
            'f_t_units_3' => $this->f_t_units_3,
            't_fusion_3' => $this->t_fusion_3,
            't_units_3' => $this->t_units_3,
            'h_fusion_3' => $this->h_fusion_3,
            'h_units3' => $this->h_units3,
        ];

        $model = new Chemistry();
        $result = $model->calorimetry($request);

       if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);

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
        return view('livewire.calculators.calorimetry-calculator');
    }

}
