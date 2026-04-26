<?php

namespace App\Livewire\Calculators;

use App\Models\Physics;
use Livewire\Component;

class CrossProductCalculator extends Component
{
    public $a_rep = 'coor';
    public $ax = 50, $ay = 50, $az = 50;
    public $a1 = 2, $a2 = 3, $a3 = 4, $b1 = 2, $b2 = 3, $b3 = 4;

    public $b_rep = 'coor';
    public $bx = 7, $by = 8, $bz = 9;
    public $aa1 = 2, $aa2 = 3, $aa3 = 4, $bb1 = 2, $bb2 = 3, $bb3 = 4;

    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $device = 'desktop';

    // Calculation results
    public $res_ax, $res_ay, $res_az;
    public $res_bx, $res_by, $res_bz;
    public $ans_a1, $ans_a2, $ans_a3;
    public $megni, $polar, $phi;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->device = is_numeric(strpos(request()->header('User-Agent'), 'Mobile')) ? 'mobile' : 'desktop';

        if (session()->has('calculator_result')) {
            $this->calculate(false); // Re-calculate based on inputs
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
    }

    public function calculate($shouldScroll = true)
    {
        $requestData = [
            'a_rep' => $this->a_rep,
            'ax' => $this->ax,
            'ay' => $this->ay,
            'az' => $this->az,
            'a1' => $this->a1,
            'a2' => $this->a2,
            'a3' => $this->a3,
            'b1' => $this->b1,
            'b2' => $this->b2,
            'b3' => $this->b3,
            'b_rep' => $this->b_rep,
            'bx' => $this->bx,
            'by' => $this->by,
            'bz' => $this->bz,
            'aa1' => $this->aa1,
            'aa2' => $this->aa2,
            'aa3' => $this->aa3,
            'bb1' => $this->bb1,
            'bb2' => $this->bb2,
            'bb3' => $this->bb3,
        ];

        $request = (object)$requestData;
        $model = new Physics();
        $result = $model->cross($request);

        if (empty($result['RESULT']) || $result['RESULT'] != 1) {
            $this->error = $result['error'] ?? 'Please fill all fields.';
            return;
        }

        $this->error = null;

        // Vector A
        if ($this->a_rep === 'coor') {
            $this->res_ax = $this->ax;
            $this->res_ay = $this->ay;
            $this->res_az = $this->az;
        } else {
            $this->res_ax = $this->b1 - $this->a1;
            $this->res_ay = $this->b2 - $this->a2;
            $this->res_az = $this->b3 - $this->a3;
        }

        // Vector B
        if ($this->b_rep === 'coor') {
            $this->res_bx = $this->bx;
            $this->res_by = $this->by;
            $this->res_bz = $this->bz;
        } else {
            $this->res_bx = $this->bb1 - $this->aa1;
            $this->res_by = $this->bb2 - $this->aa2;
            $this->res_bz = $this->bb3 - $this->aa3;
        }

        // Cross Product: a x b = (ay*bz - by*az)i - (ax*bz - bx*az)j + (ax*by - bx*ay)k
        $this->ans_a1 = ($this->res_ay * $this->res_bz) - ($this->res_by * $this->res_az);
        $this->ans_a2 = (($this->res_ax * $this->res_bz) - ($this->res_bx * $this->res_az)) * (-1);
        $this->ans_a3 = ($this->res_ax * $this->res_by) - ($this->res_bx * $this->res_ay);

        // Magnitude
        $this->megni = round(sqrt(pow($this->ans_a1, 2) + pow($this->ans_a2, 2) + pow($this->ans_a3, 2)), 4);

        // Spherical Coordinates
        if ($this->megni == 0) {
            $this->polar = 0;
        } else {
            $this->polar = rad2deg(acos($this->ans_a3 / $this->megni));
        }

        if ($this->res_ax == 0) {
            $this->phi = 0;
        } else {
            $this->phi = rad2deg(atan($this->res_ay / $this->res_ax));
        }

        $this->detail = ['RESULT' => 1];
        
        $this->dispatch('math-rendered');

        if ($shouldScroll) {
            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = 30;
                        const top = el.getBoundingClientRect().top + window.scrollY - offset;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                }, 100);
            JS);
        }
    }

    public function render()
    {
        return view('livewire.calculators.cross-product-calculator');
    }
}
