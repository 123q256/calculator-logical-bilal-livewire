<?php
namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class GasCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $calc_mode = 'first';
    public $trip_type = 1;
    public $distance = 250;
    public $distance_unit = 'km';
    public $week_day = 5;
    public $price = 250;
    public $price_unit = 'liter';
    public $peoples = 4;
    public $name_v1 = 'Toyota Grande';
    public $fule_effi_v1 = 250;
    public $fule_effi_v1_unit = 'kmpl';
    public $name_v2 = 'Honda Civic';
    public $fule_effi_v2 = 250;
    public $fule_effi_v2_unit = 'kmpl';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = session('currancy', '$');
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        
        $this->price_unit = $this->currancy . ' ' . ($this->lang['14'] ?? 'liter');

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
        $this->reset(['calc_mode', 'trip_type', 'distance', 'distance_unit', 'week_day', 'price', 'price_unit', 'peoples', 'name_v1', 'fule_effi_v1', 'fule_effi_v1_unit', 'name_v2', 'fule_effi_v2', 'fule_effi_v2_unit', 'detail', 'error']);

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
            'type' => $this->calc_mode,
            'trip_type' => $this->trip_type,
            'distance' => $this->distance,
            'distance_unit' => $this->distance_unit,
            'week_day' => $this->week_day,
            'price' => $this->price,
            'price_unit' => $this->price_unit,
            'peoples' => $this->peoples,
            'name_v1' => $this->name_v1,
            'fule_effi_v1' => $this->fule_effi_v1,
            'fule_effi_v1_unit' => $this->fule_effi_v1_unit,
            'name_v2' => $this->name_v2,
            'fule_effi_v2' => $this->fule_effi_v2,
            'fule_effi_v2_unit' => $this->fule_effi_v2_unit,
            'currancy' => $this->currancy,
        ];

        $model = new EverydayLife();
        $result = $model->gas((object)$requestData);

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
        return view('livewire.calculators.gas-calculator');
    }
}
