<?php

namespace App\Livewire\Calculators;

use App\Models\Finance;
use Livewire\Component;

class WeddingBudgetCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $currancy = '$';

    // Form fields
    public $spend = 5000000;
    public $guest = 500;
    public $dress = 90000;
    public $jewelery = 350000;
    public $accessories = 100000;
    public $ring = 75000;
    public $makeup = 275000;
    
    // Sub-categories
    public $stationery = 0;
    public $photography = 0;
    public $florist = 0;
    public $planner = 0;
    
    public $venue = 0;
    public $dinner = 0;
    public $catering = 0;
    public $cake = 0;
    public $DJs = 0;
    public $liquors = 0;
    
    public $ceremony = 0;
    public $officiant = 0;
    
    public $hotel = 0;
    public $transportation = 0;
    
    public $other = 0;
    
    // Track open details
    public $clickvalue1 = 0;
    public $clickvalue2 = 0;
    public $clickvalue3 = 0;
    public $clickvalue4 = 0;
    public $clickvalue5 = 0;

    public function mount($type = 'calculator', $lang = [], $currancy = '$')
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->currancy = $currancy;

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = (object)session('calculator_back_inputs');
            foreach ($inputs as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->error = null;
        $this->detail = null;

        $this->spend = 5000000;
        $this->guest = 500;
        $this->dress = 90000;
        $this->jewelery = 350000;
        $this->accessories = 100000;
        $this->ring = 75000;
        $this->makeup = 275000;
        
        $this->stationery = 0;
        $this->photography = 0;
        $this->florist = 0;
        $this->planner = 0;
        $this->venue = 0;
        $this->dinner = 0;
        $this->catering = 0;
        $this->cake = 0;
        $this->DJs = 0;
        $this->liquors = 0;
        $this->ceremony = 0;
        $this->officiant = 0;
        $this->hotel = 0;
        $this->transportation = 0;
        $this->other = 0;
        
        $this->clickvalue1 = 0;
        $this->clickvalue2 = 0;
        $this->clickvalue3 = 0;
        $this->clickvalue4 = 0;
        $this->clickvalue5 = 0;

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

    public function toggleDetail($index)
    {
        $prop = "clickvalue$index";
        $this->$prop = $this->$prop == 0 ? $index : 0;
    }

    public function calculate()
    {
        $request = (object)[
            'spend' => $this->spend,
            'guest' => $this->guest,
            'dress' => $this->dress,
            'jewelery' => $this->jewelery,
            'accessories' => $this->accessories,
            'ring' => $this->ring,
            'makeup' => $this->makeup,
            'stationery' => $this->stationery,
            'photography' => $this->photography,
            'florist' => $this->florist,
            'planner' => $this->planner,
            'venue' => $this->venue,
            'dinner' => $this->dinner,
            'catering' => $this->catering,
            'cake' => $this->cake,
            'DJs' => $this->DJs,
            'liquors' => $this->liquors,
            'ceremony' => $this->ceremony,
            'officiant' => $this->officiant,
            'hotel' => $this->hotel,
            'transportation' => $this->transportation,
            'other' => $this->other,
            'clickvalue1' => $this->clickvalue1,
            'clickvalue2' => $this->clickvalue2,
            'clickvalue3' => $this->clickvalue3,
            'clickvalue4' => $this->clickvalue4,
            'clickvalue5' => $this->clickvalue5,
            'currency' => $this->currancy,
        ];

        $model = new Finance();
        $result = $model->wedding($request);

        if (!empty($result['average_cost']) || isset($result['budget_balance'])) {
            $result['RESULT'] = 1; 

            // Prepare Chart Data for Highcharts
            $chartData = [];
            if ($result['bride_groom'] > 0) $chartData[] = ['name' => $this->lang['3'] ?? 'Bride & Groom', 'y' => (float)$result['bride_groom'], 'color' => '#2563eb'];
            if ($result['sub_contractors'] > 0) $chartData[] = ['name' => $this->lang['9'] ?? 'Contractors', 'y' => (float)$result['sub_contractors'], 'color' => '#f59e0b'];
            if ($result['food_drinks'] > 0) $chartData[] = ['name' => $this->lang['14'] ?? 'Food & Drinks', 'y' => (float)$result['food_drinks'], 'color' => '#10b981'];
            if ($result['ceremony_total'] > 0) $chartData[] = ['name' => $this->lang['21'] ?? 'Ceremony', 'y' => (float)$result['ceremony_total'], 'color' => '#ef4444'];
            if ($result['trans_accomo'] > 0) $chartData[] = ['name' => $this->lang['24'] ?? 'Transport', 'y' => (float)$result['trans_accomo'], 'color' => '#8b5cf6'];
            if ($result['other'] > 0) $chartData[] = ['name' => $this->lang['34'] ?? 'Other', 'y' => (float)$result['other'], 'color' => '#64748b'];
            
            $result['chartData'] = json_encode($chartData);

            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', (array)$request);
            session()->flash('scroll_to_result', true);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->dispatch('chart-updated', $result['chartData']);

            $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
        } else {
            $this->error = $result['error'] ?? 'Please fill all fields.';
            $this->detail = null;
            session()->flash('validation_error', $this->error);
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

        return view('livewire.calculators.wedding-budget-calculator');
    }
}
