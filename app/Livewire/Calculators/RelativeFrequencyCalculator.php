<?php

namespace App\Livewire\Calculators;
use App\Models\Statistics;
use Livewire\Component;

class RelativeFrequencyCalculator extends Component
{
    public $freq = 'ind';
    public $st_val = '';
    public $k = '';
    public $data = '4, 14, 16, 22, 24, 25, 37, 38, 38, 40, 42, 42, 45, 44';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->freq = $inputs->freq ?? 'ind';
            $this->st_val = $inputs->st_val ?? '';
            $this->k = $inputs->k ?? '';
            $this->data = $inputs->data ?? '4, 14, 16, 22, 24, 25, 37, 38, 38, 40, 42, 42, 45, 44';
        }
    }

    public function resetForm()
    {
        $this->freq = 'ind';
        $this->st_val = '';
        $this->k = '';
        $this->data = '4, 14, 16, 22, 24, 25, 37, 38, 38, 40, 42, 42, 45, 44';
        
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'freq' => $this->freq,
            'st_val' => $this->st_val,
            'k' => $this->k,
            'data' => $this->data,
        ];

        $model = new Statistics();
        $result = $model->relative($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
            
            $chartCategories = $this->freq === 'ind' ? array_keys($result['count']) : $result['group'];
            $seriesData = $this->freq === 'ind' ? $result['rf_values'] : $result['rf1_values'];
            $groupNames = $this->freq === 'ind' ? array_keys($result['count']) : $result['group'];

            $result['chartCategories'] = json_encode($chartCategories);
            $result['seriesData'] = json_encode($seriesData);
            $result['groupNames'] = json_encode($groupNames);

            $this->detail = $result;
            $this->dispatch('chart-updated', detail: $this->detail);
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
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
        return view('livewire.calculators.relative-frequency-calculator');
    }
}
