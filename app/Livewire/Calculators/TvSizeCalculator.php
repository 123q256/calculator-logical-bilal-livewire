<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class TvSizeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $selection = 'size';
    public $size = 24;
    public $size_unit = 'in';
    public $resolution = '1080p';
    public $angle = 30;
    public $angle_unit = 'deg';
    public $distance = 24;
    public $distance_unit = 'in';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->selection = $inputs->selection ?? 'size';
            $this->size = $inputs->size ?? 24;
            $this->size_unit = $inputs->size_unit ?? 'in';
            $this->resolution = $inputs->resolution ?? '1080p';
            $this->angle = $inputs->angle ?? 30;
            $this->angle_unit = $inputs->angle_unit ?? 'deg';
            $this->distance = $inputs->distance ?? 24;
            $this->distance_unit = $inputs->distance_unit ?? 'in';
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

        // Reset Inputs to Defaults
        $this->selection = 'size';
        $this->size = 24;
        $this->size_unit = 'in';
        $this->resolution = '1080p';
        $this->angle = 30;
        $this->angle_unit = 'deg';
        $this->distance = 24;
        $this->distance_unit = 'in';

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
            'selection'     => $this->selection,
            'size'          => $this->size,
            'size_unit'     => $this->size_unit,
            'resolution'    => $this->resolution,
            'angle'         => $this->angle,
            'angle_unit'    => $this->angle_unit,
            'distance'      => $this->distance,
            'distance_unit' => $this->distance_unit,
        ];

        $model = new EverydayLife();
        $result = $model->tv((object)$requestData);
        
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
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
    
        return view('livewire.calculators.tv-size-calculator');
    }
}
