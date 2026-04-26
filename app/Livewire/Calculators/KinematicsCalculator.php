<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class KinematicsCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form Fields
    public $known = '1';
    public $cdis = '';
    public $cdisU = 'm';
    public $iv = '20';
    public $ivU = 'm/s';
    public $fv = '30';
    public $fvU = 'm/s';
    public $ct = '40';
    public $ctU = 'sec';
    public $cac = '';
    public $cacU = 'm/s²';

    public $openDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }

        if (session()->has('calculator_back_inputs')) {
            $inputs = (array)session('calculator_back_inputs');
            foreach ($inputs as $key => $val) {
                if (property_exists($this, $key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    public function toggleDropdown($id)
    {
        $this->openDropdown = ($this->openDropdown === $id) ? null : $id;
    }

    public function setUnit($field, $value)
    {
        if (property_exists($this, $field)) {
            $this->$field = $value;
        }
        $this->openDropdown = null;
        $this->detail = null;
    }

    public function updatedKnown($value)
    {
        $this->cdis = '';
        $this->iv = '';
        $this->fv = '';
        $this->ct = '';
        $this->cac = '';
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'known') {
            $this->detail = null;
            $this->error = null;
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->known = '1';
        $this->cdis = '';
        $this->cdisU = 'm';
        $this->iv = '20';
        $this->ivU = 'm/s';
        $this->fv = '30';
        $this->fvU = 'm/s';
        $this->ct = '40';
        $this->ctU = 'sec';
        $this->cac = '';
        $this->cacU = 'm/s²';

        $this->error = null;
        $this->detail = null;

        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error', 'scroll_to_result']);

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $requestData = [
            'known' => $this->known,
            'cdis' => $this->cdis,
            'cdisU' => $this->cdisU,
            'iv' => $this->iv,
            'ivU' => $this->ivU,
            'fv' => $this->fv,
            'fvU' => $this->fvU,
            'ct' => $this->ct,
            'ctU' => $this->ctU,
            'cac' => $this->cac,
            'cacU' => $this->cacU,
        ];

        $request = (object)$requestData;
        $model = new Physics();
        $result = $model->kinematics($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Structuring data for Blade
            $k = $this->known;
            $ans = [];
            $frms = [];
            $knowns = [];

            if ($k == 1) { // iv, fv, ct
                $ans = [['label' => $this->lang['12'], 'value' => $result['dis']], ['label' => $this->lang['16'], 'value' => $result['a']]];
                $frms = [['label' => 's = \frac{1}{2} (v + u)t', 'value' => 's = \frac{1}{2} (v + u)t'], ['label' => 'a = \frac{(v-u)}{t}', 'value' => 'a = \frac{(v-u)}{t}']];
                $knowns = [['label' => $this->lang['13'], 'value' => $result['iv']], ['label' => $this->lang['14'], 'value' => $result['fv']], ['label' => $this->lang['15'], 'value' => $result['time']]];
            } elseif ($k == 2) { // iv, fv, acc
                $ans = [['label' => $this->lang['12'], 'value' => $result['dis']], ['label' => $this->lang['15'], 'value' => $result['time']]];
                $frms = [['label' => 't = \frac{(v-u)}{a}', 'value' => 't = \frac{(v-u)}{a}'], ['label' => 's = \frac{1}{2} (v + u)t', 'value' => 's = \frac{1}{2} (v + u)t']];
                $knowns = [['label' => $this->lang['13'], 'value' => $result['iv']], ['label' => $this->lang['14'], 'value' => $result['fv']], ['label' => $this->lang['16'], 'value' => $result['a']]];
            } elseif ($k == 3) { // iv, ct, acc
                $ans = [['label' => $this->lang['12'], 'value' => $result['dis']], ['label' => $this->lang['14'], 'value' => $result['fv']]];
                $frms = [['label' => 'v = u+at', 'value' => 'v = u+at'], ['label' => 's = \frac{1}{2} (v + u)t', 'value' => 's = \frac{1}{2} (v + u)t']];
                $knowns = [['label' => $this->lang['13'], 'value' => $result['iv']], ['label' => $this->lang['15'], 'value' => $result['time']], ['label' => $this->lang['16'], 'value' => $result['a']]];
            } elseif ($k == 4) { // fv, ct, acc
                $ans = [['label' => $this->lang['12'], 'value' => $result['dis']], ['label' => $this->lang['13'], 'value' => $result['iv']]];
                $frms = [['label' => 'u = v-at', 'value' => 'u = v-at'], ['label' => 's = \frac{1}{2} (v + u)t', 'value' => 's = \frac{1}{2} (v + u)t']];
                $knowns = [['label' => $this->lang['14'], 'value' => $result['fv']], ['label' => $this->lang['15'], 'value' => $result['time']], ['label' => $this->lang['16'], 'value' => $result['a']]];
            } elseif ($k == 5) { // dis, iv, ct
                $ans = [['label' => $this->lang['14'], 'value' => $result['fv']], ['label' => $this->lang['16'], 'value' => $result['a']]];
                $frms = [['label' => 'v = \frac{2s}{t}-u', 'value' => 'v = \frac{2s}{t}-u'], ['label' => 'a = \frac{v-u}{t}', 'value' => 'a = \frac{v-u}{t}']];
                $knowns = [['label' => $this->lang['12'], 'value' => $result['dis']], ['label' => $this->lang['13'], 'value' => $result['iv']], ['label' => $this->lang['15'], 'value' => $result['time']]];
            } elseif ($k == 6) { // dis, fv, ct
                $ans = [['label' => $this->lang['13'], 'value' => $result['iv']], ['label' => $this->lang['16'], 'value' => $result['a']]];
                $frms = [['label' => 'u = \frac{2s}{t}-v', 'value' => 'u = \frac{2s}{t}-v'], ['label' => 'a = \frac{v-u}{t}', 'value' => 'a = \frac{v-u}{t}']];
                $knowns = [['label' => $this->lang['12'], 'value' => $result['dis']], ['label' => $this->lang['14'], 'value' => $result['fv']], ['label' => $this->lang['15'], 'value' => $result['time']]];
            } elseif ($k == 7) { // dis, iv, acc
                $ans = [['label' => $this->lang['14'], 'value' => $result['fv']], ['label' => $this->lang['15'], 'value' => $result['time']]];
                $frms = [['label' => 'v = \sqrt{u^2 + 2as}', 'value' => 'v = \sqrt{u^2 + 2as}'], ['label' => 't = \frac{v-u}{a}', 'value' => 't = \frac{v-u}{a}']];
                $knowns = [['label' => $this->lang['12'], 'value' => $result['dis']], ['label' => $this->lang['13'], 'value' => $result['iv']], ['label' => $this->lang['16'], 'value' => $result['a']]];
            } elseif ($k == 8) { // dis, fv, acc
                $ans = [['label' => $this->lang['13'], 'value' => $result['iv']], ['label' => $this->lang['15'], 'value' => $result['time']]];
                $frms = [['label' => 'u = \sqrt{v^2 - 2as}', 'value' => 'u = \sqrt{v^2 - 2as}'], ['label' => 't = \frac{v-u}{a}', 'value' => 't = \frac{v-u}{a}']];
                $knowns = [['label' => $this->lang['12'], 'value' => $result['dis']], ['label' => $this->lang['14'], 'value' => $result['fv']], ['label' => $this->lang['16'], 'value' => $result['a']]];
            } elseif ($k == 9) { // dis, iv, fv
                $ans = [['label' => $this->lang['16'], 'value' => $result['a']], ['label' => $this->lang['15'], 'value' => $result['time']]];
                $frms = [['label' => 't = \frac{2s}{v+u}', 'value' => 't = \frac{2s}{v+u}'], ['label' => 'a = \frac{v-u}{t}', 'value' => 'a = \frac{v-u}{t}']];
                $knowns = [['label' => $this->lang['12'], 'value' => $result['dis']], ['label' => $this->lang['13'], 'value' => $result['iv']], ['label' => $this->lang['14'], 'value' => $result['fv']]];
            } elseif ($k == 10) { // dis, ct, acc
                $ans = [['label' => $this->lang['13'], 'value' => $result['iv']], ['label' => $this->lang['14'], 'value' => $result['fv']]];
                $frms = [['label' => 'u = \frac{s}{t} - \frac{1}{2}at', 'value' => 'u = \frac{s}{t} - \frac{1}{2}at'], ['label' => 'v = u+at', 'value' => 'v = u+at']];
                $knowns = [['label' => $this->lang['12'], 'value' => $result['dis']], ['label' => $this->lang['15'], 'value' => $result['time']], ['label' => $this->lang['16'], 'value' => $result['a']]];
            }

            $result['ans'] = $ans;
            $result['frms'] = $frms;
            $result['knowns'] = $knowns;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session(['calculator_result' => $result, 'calculator_back_inputs' => $requestData, 'scroll_to_result' => true]);
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->error = null;
            $this->js(<<<'JS'
                setTimeout(() => {
                    if (window.MathJax) {
                        MathJax.typesetPromise();
                    }
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
                    if (window.MathJax) {
                        MathJax.typesetPromise();
                    }
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }

        return view('livewire.calculators.kinematics-calculator');
    }
}
