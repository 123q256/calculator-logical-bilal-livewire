<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class VolumeOfCapsule extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $choose = 'a_r';
    public $first = '15';
    public $first_unit = 'cm';
    public $second = '15';
    public $second_unit = 'cm';
    public $pi_val = '3.14159265359';
    public $units = 'cm';


  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');

        }
    }

    public function resetForm()
    {
        $lang = $this->lang;
        $type = $this->type;
        $this->reset();
        $this->lang = $lang;
        $this->type = $type;
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

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
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

        public function calculate()
    {
        $requestData = get_object_vars($this);
        $request = new \Illuminate\Http\Request();
        $request->replace($requestData);

        $model = new Math();
        $result = $model->capsule_volume($request);

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

        $result = $this->sanitizeForLivewire($result);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', (array)$request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                 return redirect()->to(url()->previous() ?? '/');
            } else {
                $this->detail = $result;
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
        return view('livewire.calculators.volume-of-capsule');
    }
}
