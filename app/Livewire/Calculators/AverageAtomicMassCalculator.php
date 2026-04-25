<?php

namespace App\Livewire\Calculators;

use App\Models\Chemistry;
use Livewire\Component;

class AverageAtomicMassCalculator extends Component
{
    // Default Values
    public $isotopes_no = 2;
    public $per = [30, 70];
    public $per_unit = ['%', '%'];
    public $mass = [89, 92];

    public $showDropdown = null;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        // Initialize arrays based on default count
        $this->initializeArrays();
    }

    public function initializeArrays()
    {
        $currentCount = count($this->per);
        if ($this->isotopes_no > $currentCount) {
            for ($i = $currentCount; $i < $this->isotopes_no; $i++) {
                $this->per[$i] = 0;
                $this->per_unit[$i] = '%';
                $this->mass[$i] = 0;
            }
        } elseif ($this->isotopes_no < $currentCount) {
            $this->per = array_slice($this->per, 0, $this->isotopes_no);
            $this->per_unit = array_slice($this->per_unit, 0, $this->isotopes_no);
            $this->mass = array_slice($this->mass, 0, $this->isotopes_no);
        }
    }

    public function updatedIsotopesNo()
    {
        $this->initializeArrays();
        $this->detail = null;
    }

    public function toggleOverlay($id)
    {
        $this->showDropdown = ($this->showDropdown === $id) ? null : $id;
    }

    public function setUnit($index, $unit)
    {
        $this->per_unit[$index] = $unit;
        $this->showDropdown = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->isotopes_no = 2;
        $this->per = [30, 70];
        $this->per_unit = ['%', '%'];
        $this->mass = [89, 92];
        $this->error = null;
        $this->detail = null;
        $this->showDropdown = null;
    }

    public function calculate()
    {
        $request = (object)[
            'isotopes_no' => $this->isotopes_no,
            'per' => $this->per,
            'per_unit' => $this->per_unit,
            'mass' => $this->mass,
        ];

        $model = new Chemistry();
        $result = $model->average($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            $this->dispatch('result-updated');
            
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
            $this->error = $result['error'] ?? 'Please check your input.';
            $this->detail = null;
        }
    }

    public function render()
    {
        return view('livewire.calculators.average-atomic-mass-calculator');
    }
}
