<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class ScatterPlotMaker extends Component
{
    public $x = '1, 13, 5, 7, 9';
    public $y = '2, 4, 6, 18, 10';
    public $title = 'Scatter Plot';
    public $xaxis = 'X';
    public $yaxis = 'Y';
    public $xmin = '';
    public $xmax = '';
    public $ymin = '';
    public $ymax = '';
    public $position = 'top';
    public $center = 'center';

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->x = $inputs->x ?? '1, 13, 5, 7, 9';
            $this->y = $inputs->y ?? '2, 4, 6, 18, 10';
            $this->title = $inputs->title ?? 'Scatter Plot';
            $this->xaxis = $inputs->xaxis ?? 'X';
            $this->yaxis = $inputs->yaxis ?? 'Y';
            $this->xmin = $inputs->xmin ?? '';
            $this->xmax = $inputs->xmax ?? '';
            $this->ymin = $inputs->ymin ?? '';
            $this->ymax = $inputs->ymax ?? '';
            $this->position = $inputs->position ?? 'top';
            $this->center = $inputs->center ?? 'center';
        }
    }

    public function resetForm()
    {
        $this->x = '1, 13, 5, 7, 9';
        $this->y = '2, 4, 6, 18, 10';
        $this->title = 'Scatter Plot';
        $this->xaxis = 'X';
        $this->yaxis = 'Y';
        $this->xmin = '';
        $this->xmax = '';
        $this->ymin = '';
        $this->ymax = '';
        $this->position = 'top';
        $this->center = 'center';
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
            'x' => $this->x,
            'y' => $this->y,
            'title' => $this->title,
            'xaxis' => $this->xaxis,
            'yaxis' => $this->yaxis,
            'xmin' => $this->xmin,
            'xmax' => $this->xmax,
            'ymin' => $this->ymin,
            'ymax' => $this->ymax,
            'position' => $this->position,
            'align' => $this->center,
        ];

        $model = new Statistics();
        $result = $model->scatter($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
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
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                    if (typeof renderMathInElement !== 'undefined') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            JS);
        }
        return view('livewire.calculators.scatter-plot-maker');
    }
}
