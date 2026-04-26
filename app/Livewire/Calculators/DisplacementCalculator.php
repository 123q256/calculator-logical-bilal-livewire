<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class DisplacementCalculator extends Component
{
    public $known = '1';
    public $sldsp = 'm';
    public $av = 10;
    public $slav = 'm/s';
    public $tm = 10;
    public $sltm = 'sec';
    public $iv = 10;
    public $sliv = 'm/s';
    public $fv = 10;
    public $slfv = 'm/s';
    public $acc = 10;
    public $slacc = 'm/s²';

    public $vloc = [];
    public $slvloc = [];
    public $timi = [];
    public $sltimi = [];

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $showDropdown = null;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;

        for ($i = 0; $i < 10; $i++) {
            $this->vloc[$i] = 10;
            $this->slvloc[$i] = 'm/s';
            $this->timi[$i] = 10;
            $this->sltimi[$i] = 'sec';
        }

        if (session()->has('calculator_result')) {
            $this->detail = session('calculator_result');
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
    }

    public function toggleOverlay($name)
    {
        $this->showDropdown = ($this->showDropdown === $name) ? null : $name;
    }

    public function setUnit($field, $value)
    {
        if (str_contains($field, '.')) {
            $parts = explode('.', $field);
            $this->{$parts[0]}[$parts[1]] = $value;
        } else {
            $this->$field = $value;
        }
        $this->showDropdown = null;
        $this->detail = null;
    }

    public function calculate()
    {
        $requestData = [
            'known' => $this->known,
            'sldsp' => $this->sldsp,
            'av' => $this->av,
            'slav' => $this->slav,
            'tm' => $this->tm,
            'sltm' => $this->sltm,
            'iv' => $this->iv,
            'sliv' => $this->sliv,
            'fv' => $this->fv,
            'slfv' => $this->slfv,
            'acc' => $this->acc,
            'slacc' => $this->slacc,
        ];

        for ($i = 0; $i < 10; $i++) {
            $requestData['vloc_' . $i] = $this->vloc[$i];
            $requestData['slvloc_' . $i] = $this->slvloc[$i];
            $requestData['timi_' . $i] = $this->timi[$i];
            $requestData['sltimi_' . $i] = $this->sltimi[$i];
        }

        $request = (object)$requestData;

        $model = new Physics();
        $result = $model->displacement($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->current());
            }

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = 30;
                        const top = el.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top: top, behavior: 'smooth' });
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
            const offset = 30;
            const top = el.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
        }
    JS);
        }
        return view('livewire.calculators.displacement-calculator');
    }
}
