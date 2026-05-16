<?php

namespace App\Livewire\Calculators;

use App\Models\Math;
use Livewire\Component;

class CotangentCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';

    // Inputs
    public $angle = '60';
    public $angle_unit = 'deg';

    public function mount($type = 'calculator')
    {
        $this->type = $type;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->angle = $inputs['angle'] ?? '60';
            $this->angle_unit = $inputs['angle_unit'] ?? 'deg';
        }
    }

    public function resetForm()
    {
        $this->angle = '60';
        $this->angle_unit = 'deg';
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

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        if ($this->angle === '' || $this->angle === null) {
            $this->error = 'Please! Check Your Input.';
            return;
        }

        $request = (object)[
            'angle' => $this->angle,
            'angle_unit' => $this->angle_unit,
        ];

        $model = new Math();
        $result = $model->Cotangent($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                 session()->flash('scroll_to_result', true);
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->dispatch('math-updated');
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
            return;
        }

        $this->error = $result['error'] ?? 'Please! Check Your Input.';
        $this->detail = null;
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->dispatch('math-updated');
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

        $lang = [];
        $file = 'cotangent-calculator';
        if (app()->getLocale() != 'en') {
            $file = app()->getLocale() . '-' . $file;
        }
        
        $path = public_path("keys/{$file}.txt");
        if (file_exists($path)) {
            $data = json_decode(file_get_contents($path), true);
            if (isset($data['lang_keys'])) {
                $lang = json_decode($data['lang_keys'], true);
            }
        }

        return view('livewire.calculators.cotangent-calculator', [
            'lang' => $lang
        ]);
    }
}
