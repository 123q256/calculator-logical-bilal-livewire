<?php

namespace App\Livewire\Calculators;
use App\Models\Finance;
use Livewire\Component;

class RentSplitCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Inputs
    public $total_rent = '1000';
    public $total_area = '1200';
    public $bedrooms = 2;
    public $room_area = [1 => 350, 2 => 275];
    public $persons = [1 => 5, 2 => 3];
    public $bath = [1 => 100, 2 => 100];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $lang['currency'] ?? '$';
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            $this->total_rent = $inputs->total_rent ?? '1000';
            $this->total_area = $inputs->total_area ?? '1200';
            $this->bedrooms = $inputs->bedrooms ?? 2;
            $this->room_area = $inputs->room_area ?? [1 => 350, 2 => 275];
            $this->persons = $inputs->persons ?? [1 => 5, 2 => 3];
            $this->bath = $inputs->bath ?? [1 => 100, 2 => 100];
        }
    }

    public function updatedBedrooms($value)
    {
        $count = (int)$value;
        if ($count > 0 && $count < 100) {
            $currentCount = count($this->room_area);
            if ($count > $currentCount) {
                for ($i = $currentCount + 1; $i <= $count; $i++) {
                    $this->room_area[$i] = 275;
                    $this->persons[$i] = 2;
                    $this->bath[$i] = 100;
                }
            } else {
                $this->room_area = array_slice($this->room_area, 0, $count, true);
                $this->persons = array_slice($this->persons, 0, $count, true);
                $this->bath = array_slice($this->bath, 0, $count, true);
            }
        }
        $this->updatedInputs();
    }

    public function updated($propertyName)
    {
        if ($propertyName !== 'bedrooms') {
            $this->updatedInputs();
        }
    }

    protected function updatedInputs()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->total_rent = '1000';
        $this->total_area = '1200';
        $this->bedrooms = 2;
        $this->room_area = [1 => 350, 2 => 275];
        $this->persons = [1 => 5, 2 => 3];
        $this->bath = [1 => 100, 2 => 100];

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
            'total_rent' => $this->total_rent,
            'total_area' => $this->total_area,
            'bedrooms'   => $this->bedrooms,
            'room_area'  => $this->room_area,
            'persons'    => $this->persons,
            'bath'       => $this->bath,
        ];

        $model = new Finance();
        $result = $model->rent_split((object)$requestData);

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
        return view('livewire.calculators.rent-split-calculator');
    }
}
