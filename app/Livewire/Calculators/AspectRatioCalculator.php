<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class AspectRatioCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $ratios = '1920x1080';
    public $w1 = '1920';
    public $h1 = '1080';
    public $w2 = '400';
    public $h2 = '';

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;

        if ($propertyName == 'ratios') {
            if ($this->ratios !== 'custom') {
                $parts = explode('x', str_replace(' × ', 'x', $this->ratios));
                if (count($parts) == 2) {
                    $this->w1 = trim($parts[0]);
                    $this->h1 = trim($parts[1]);
                }
            }
        }

        if ($propertyName == 'w1' || $propertyName == 'h1') {
            $current = "{$this->w1}x{$this->h1}";
            // Try to match preset
            $found = false;
            $presets = ["7680x4320","5120x2880","3840x2160","2048x1536","1920x1200","1920x1080","1334x750","1200x630","1136x640","1024x768","1024x512","960x640","800x600","728x90","720x576","640x480","576x486","320x480"];
            if (in_array($current, $presets)) {
                $this->ratios = $current;
            } else {
                $this->ratios = 'custom';
            }
        }
    }

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function resetForm()
    {
        $this->reset(['ratios', 'w1', 'h1', 'w2', 'h2', 'detail', 'error']);

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
            'ratios' => $this->ratios,
            'w1' => $this->w1,
            'h1' => $this->h1,
            'w2' => $this->w2,
            'h2' => $this->h2,
        ];

        $model = new EverydayLife();
        $result = $model->aspect((object)$requestData);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $requestData);
                return redirect()->to(url()->previous() ?? '/');
            } else {
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
        return view('livewire.calculators.aspect-ratio-calculator');
    }
}
