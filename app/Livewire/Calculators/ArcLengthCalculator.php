<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class ArcLengthCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $find = '0';
    public $angle = 12;
    public $angle_unit = 'deg';
    public $rad = 12;
    public $rad_unit = 'm';
    public $diameter = 20;
    public $diameter_unit = 'm';
    public $area = 20;
    public $area_unit = 'cm²';
    public $chrd_len = 100;
    public $chrd_len_unit = 'm';
    public $seg_height = 100;
    public $seg_height_unit = 'm';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        if (session()->has('calculator_result')) {
            $this->detail = $this->sanitizeForLivewire(session('calculator_result'));
        } else {
            $this->detail = null;
        }
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->find = $inputs['find'] ?? $this->find;
            $this->angle = $inputs['angle'] ?? $this->angle;
            $this->angle_unit = $inputs['angle_unit'] ?? $this->angle_unit;
            $this->rad = $inputs['rad'] ?? $this->rad;
            $this->rad_unit = $inputs['rad_unit'] ?? $this->rad_unit;
            $this->diameter = $inputs['diameter'] ?? $this->diameter;
            $this->diameter_unit = $inputs['diameter_unit'] ?? $this->diameter_unit;
            $this->area = $inputs['area'] ?? $this->area;
            $this->area_unit = $inputs['area_unit'] ?? $this->area_unit;
            $this->chrd_len = $inputs['chrd_len'] ?? $this->chrd_len;
            $this->chrd_len_unit = $inputs['chrd_len_unit'] ?? $this->chrd_len_unit;
            $this->seg_height = $inputs['seg_height'] ?? $this->seg_height;
            $this->seg_height_unit = $inputs['seg_height_unit'] ?? $this->seg_height_unit;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;

        $this->reset([
            'find', 'angle', 'angle_unit', 'rad', 'rad_unit', 
            'diameter', 'diameter_unit', 'area', 'area_unit', 
            'chrd_len', 'chrd_len_unit', 'seg_height', 'seg_height_unit'
        ]);

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

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $request = (object)[
            'find' => $this->find,
            'angle' => $this->angle,
            'angle_unit' => $this->angle_unit,
            'rad' => $this->rad,
            'rad_unit' => $this->rad_unit,
            'diameter' => $this->diameter,
            'diameter_unit' => $this->diameter_unit,
            'area' => $this->area,
            'area_unit' => $this->area_unit,
            'chrd_len' => $this->chrd_len,
            'chrd_len_unit' => $this->chrd_len_unit,
            'seg_height' => $this->seg_height,
            'seg_height_unit' => $this->seg_height_unit,
        ];

        $model = new Math();
        $result = $model->arc($request);
        
        if (is_array($result)) {
            foreach ($result as $key => $val) {
                if (is_float($val)) {
                    if (is_nan($val)) {
                        $result[$key] = 'NAN';
                    } elseif (is_infinite($val)) {
                        $result[$key] = 'INF';
                    }
                }
            }
        }

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $this->sanitizeForLivewire($result);
                $this->js(<<<'JS'
                    setTimeout(() => {
                        if (typeof MJrerender === 'function') MJrerender();
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
        return view('livewire.calculators.arc-length-calculator');
    }

    /**
     * Prevents Livewire CorruptComponentPayloadException caused by:
     * 1. Un-serializable objects (stdClass)
     * 2. Javascript Float Precision Loss (converting floats to strings)
     */
    private function sanitizeForLivewire($data)
    {
        if (is_null($data)) return null;
        
        $sanitized = json_decode(json_encode($data), true);
        if (is_array($sanitized)) {
            array_walk_recursive($sanitized, function (&$item) {
                if (is_float($item)) {
                    $item = (string) $item;
                }
            });
        }
        return $sanitized;
    }
}
