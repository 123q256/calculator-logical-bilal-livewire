<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class OnlineMathCalculator extends Component
{
   public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

  public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
      
    }

   public function render()
    {
        return view('livewire.calculators.online-math-calculator');
    }
}
