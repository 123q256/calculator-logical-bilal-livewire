<?php
namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class PlantSpacingCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $bed = 'grid';
    public $grid = 'square';
    public $hedgerows = '1';
    public $length = 24;
    public $length_unit = 'm';
    public $width = 10;
    public $width_unit = 'm';
    public $want = 'amount';
    public $border = 10;
    public $border_unit = 'cm';
    public $plant_spacing = 10;
    public $plant_spacing_unit = 'cm';
    public $row_spacing = 10;
    public $row_spacing_unit = 'cm';
    public $hedge = 10;
    public $hedge_unit = 'm';
    public $total_plants = 50;
    public $total_rows = 110;
    public $no_of_plant = 5;
    public $plant_price = 110;

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
        $this->reset(['bed', 'grid', 'hedgerows', 'length', 'length_unit', 'width', 'width_unit', 'want', 'border', 'border_unit', 'plant_spacing', 'plant_spacing_unit', 'row_spacing', 'row_spacing_unit', 'hedge', 'hedge_unit', 'total_plants', 'total_rows', 'no_of_plant', 'plant_price', 'detail', 'error']);

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
            'bed' => $this->bed,
            'grid' => $this->grid,
            'hedgerows' => $this->hedgerows,
            'length' => $this->length,
            'length_unit' => $this->length_unit,
            'width' => $this->width,
            'width_unit' => $this->width_unit,
            'want' => $this->want,
            'border' => $this->border,
            'border_unit' => $this->border_unit,
            'plant_spacing' => $this->plant_spacing,
            'plant_spacing_unit' => $this->plant_spacing_unit,
            'row_spacing' => $this->row_spacing,
            'row_spacing_unit' => $this->row_spacing_unit,
            'hedge' => $this->hedge,
            'hedge_unit' => $this->hedge_unit,
            'total_plants' => $this->total_plants,
            'total_rows' => $this->total_rows,
            'no_of_plant' => $this->no_of_plant,
            'plant_price' => $this->plant_price,
        ];

        $model = new EverydayLife();
        $result = $model->plant((object)$requestData);

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
        return view('livewire.calculators.plant-spacing-calculator');
    }
}
