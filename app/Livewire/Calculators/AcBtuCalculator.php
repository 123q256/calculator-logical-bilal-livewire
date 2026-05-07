<?php
namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class AcBtuCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Inputs
    public $calc_type = 'ac';
    public $height = 20;
    public $height_unit = 'ft';
    public $width = 20;
    public $width_unit = 'ft';
    public $length = 20;
    public $length_unit = 'ft';
    public $temperature = 20;
    public $temperature_unit = 'ft';
    public $peoples = 8;
    public $room_type = 'bedroom';
    public $insulation_condition = 'average';
    public $sun_exposure = 'average';
    public $climate = 'average';

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

    public function updated($propertyName)
    {
        $this->error = null;
        $this->detail = null;

        session()->forget([
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);
    }

    public function resetForm()
    {
        $this->reset(['calculate', 'height', 'height_unit', 'width', 'width_unit', 'length', 'length_unit', 'temperature', 'temperature_unit', 'peoples', 'room_type', 'insulation_condition', 'sun_exposure', 'climate', 'detail', 'error']);

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
            'calculate' => $this->calc_type,
            'height' => $this->height,
            'height_unit' => $this->height_unit,
            'width' => $this->width,
            'width_unit' => $this->width_unit,
            'length' => $this->length,
            'length_unit' => $this->length_unit,
            'temperature' => $this->temperature,
            'temperature_unit' => $this->temperature_unit,
            'peoples' => $this->peoples,
            'type' => $this->room_type,
            'insulation_condition' => $this->insulation_condition,
            'sun_exposure' => $this->sun_exposure,
            'climate' => $this->climate,
        ];

        $model = new EverydayLife();
        $result = $model->ac((object)$requestData);

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
            session()->flash('validation_error', $this->error);
            $this->detail = null;
        }
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
                }, 100);
            JS);
        }
        return view('livewire.calculators.ac-btu-calculator');
    }
}
