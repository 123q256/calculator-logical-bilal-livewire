<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use App\Models\EverydayLife;
class TaperCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $major = 12;
    public $major_unit = 'm';
    public $minor = 3;
    public $minor_unit = 'm';
    public $length = 3;
    public $length_unit = 'm';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->major = $inputs->major ?? 12;
            $this->major_unit = $inputs->major_unit ?? 'm';
            $this->minor = $inputs->minor ?? 3;
            $this->minor_unit = $inputs->minor_unit ?? 'm';
            $this->length = $inputs->length ?? 3;
            $this->length_unit = $inputs->length_unit ?? 'm';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->major = 12;
        $this->major_unit = 'm';
        $this->minor = 3;
        $this->minor_unit = 'm';
        $this->length = 3;
        $this->length_unit = 'm';
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
            'major'       => $this->major,
            'major_unit'  => $this->major_unit,
            'minor'       => $this->minor,
            'minor_unit'  => $this->minor_unit,
            'length'      => $this->length,
            'length_unit' => $this->length_unit,
        ];

        $model = new EverydayLife();
        $result = $model->taper($request);

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
        return view('livewire.calculators.taper-calculator');
    }
}
