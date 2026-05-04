<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class DistanceCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Decimal inputs
    public $lat1 = '31.4504';
    public $long1 = '73.1350';
    public $lat2 = '30.7659';
    public $long2 = '72.4376';

    // DMS inputs
    public $deg1 = '31.4504';
    public $mint1 = '73.1350';
    public $sec1 = '73.1350';
    public $dir1 = 'N';

    public $deg2 = '31.4504';
    public $mint2 = '73.1350';
    public $sec2 = '73.1350';
    public $dir2 = 'E';

    public $deg21 = '31';
    public $mint21 = '73';
    public $sec21 = '73';
    public $dir21 = 'N';

    public $deg22 = '31';
    public $mint22 = '73';
    public $sec22 = '7';
    public $dir22 = 'E';

    public $to_cal = 'decimal';

    public function updatedToCal()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function updated($propertyName)
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
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function resetForm()
    {
        $this->reset([
            'lat1', 'long1', 'lat2', 'long2',
            'deg1', 'mint1', 'sec1', 'dir1',
            'deg2', 'mint2', 'sec2', 'dir2',
            'deg21', 'mint21', 'sec21', 'dir21',
            'deg22', 'mint22', 'sec22', 'dir22',
            'to_cal', 'detail', 'error'
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

    public function calculate()
    {
        $requestData = [
            'lat1' => $this->lat1,
            'long1' => $this->long1,
            'lat2' => $this->lat2,
            'long2' => $this->long2,
            'deg1' => $this->deg1,
            'mint1' => $this->mint1,
            'sec1' => $this->sec1,
            'dir1' => $this->dir1,
            'deg2' => $this->deg2,
            'mint2' => $this->mint2,
            'sec2' => $this->sec2,
            'dir2' => $this->dir2,
            'deg21' => $this->deg21,
            'mint21' => $this->mint21,
            'sec21' => $this->sec21,
            'dir21' => $this->dir21,
            'deg22' => $this->deg22,
            'mint22' => $this->mint22,
            'sec22' => $this->sec22,
            'dir22' => $this->dir22,
            'to_cal' => $this->to_cal,
            'submit' => true,
        ];

        $model = new EverydayLife();
        $result = $model->distance((object)$requestData);

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
        return view('livewire.calculators.distance-calculator');
    }
}

