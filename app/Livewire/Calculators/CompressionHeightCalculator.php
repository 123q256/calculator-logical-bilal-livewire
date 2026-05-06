<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class CompressionHeightCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $height = 7;
    public $height_unit = 'm';
    public $stone = 5;
    public $stone_unit = 'in';
    public $length = 12;
    public $length_unit = 'in';
    public $deck = 2;
    public $deck_unit = 'm';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->height = $inputs->height ?? 7;
            $this->height_unit = $inputs->height_unit ?? 'm';
            $this->stone = $inputs->stone ?? 5;
            $this->stone_unit = $inputs->stone_unit ?? 'in';
            $this->length = $inputs->length ?? 12;
            $this->length_unit = $inputs->length_unit ?? 'in';
            $this->deck = $inputs->deck ?? 2;
            $this->deck_unit = $inputs->deck_unit ?? 'm';
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
        $request = (object)[
            'height'      => $this->height,
            'height_unit' => $this->height_unit,
            'stone'       => $this->stone,
            'stone_unit'  => $this->stone_unit,
            'length'      => $this->length,
            'length_unit' => $this->length_unit,
            'deck'        => $this->deck,
            'deck_unit'   => $this->deck_unit,
        ];

        $model = new EverydayLife();
        $result = $model->compression($request);
        
        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
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
        return view('livewire.calculators.compression-height-calculator');
    }
}
