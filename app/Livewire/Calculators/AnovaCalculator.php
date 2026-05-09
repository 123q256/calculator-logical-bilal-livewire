<?php

namespace App\Livewire\Calculators;

use App\Models\Statistics;
use Livewire\Component;

class AnovaCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form properties
    public $calculator_type = 'one_way'; // 'one_way' or 'two_way'
    public $groups = []; // For One-Way ANOVA
    public $table_data = []; // For Two-Way ANOVA
    public $rows = 3;
    public $columns = 4;

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        // Initial state for One-Way
        $this->groups = [
            1 => '5, 1, 11, 2, 8',
            2 => '0, 1, 4, 6, 3',
            3 => '0, 1, 4, 6, 3'
        ];

        // Initial state for Two-Way
        $this->table_data = [
            0 => ['4,6,8', '4,8,9', '8,9,13', '7,6,5'],
            1 => ['6,6,9', '7,10,13', '12,14,16', '3,7,9'],
            2 => ['6,9,4', '5,7,12', '16,8,1', '2,3,4']
        ];

        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->calculator_type = $inputs->type ?? 'one_way';
            if ($this->calculator_type === 'one_way') {
                $this->groups = (array)$inputs->groups;
            } else {
                $this->rows = $inputs->rows;
                $this->columns = $inputs->columns;
                $this->table_data = array_map(function($row) { return (array)$row; }, (array)$inputs->table_data);
            }
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function setCalculatorType($type)
    {
        $this->calculator_type = $type;
        $this->detail = null;
    }

    public function addGroup()
    {
        if (count($this->groups) >= 10) {
            $this->error = "Only 10 fields are allowed";
            return;
        }
        $nextIndex = count($this->groups) + 1;
        $this->groups[$nextIndex] = '';
        $this->detail = null;
    }

    public function removeGroup()
    {
        if (count($this->groups) > 2) {
            array_pop($this->groups);
            $this->detail = null;
        }
    }

    public function addRow()
    {
        if ($this->rows < 10) {
            $this->rows++;
            $this->table_data[$this->rows - 1] = array_fill(0, $this->columns, '');
            $this->detail = null;
        }
    }

    public function removeRow()
    {
        if ($this->rows > 2) {
            unset($this->table_data[$this->rows - 1]);
            $this->rows--;
            $this->detail = null;
        }
    }

    public function addColumn()
    {
        if ($this->columns < 10) {
            $this->columns++;
            for ($i = 0; $i < $this->rows; $i++) {
                $this->table_data[$i][$this->columns - 1] = '';
            }
            $this->detail = null;
        }
    }

    public function removeColumn()
    {
        if ($this->columns > 2) {
            for ($i = 0; $i < $this->rows; $i++) {
                unset($this->table_data[$i][$this->columns - 1]);
            }
            $this->columns--;
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->calculator_type = 'one_way';
        session()->forget(['calculator_back_inputs', 'calculator_result', 'validation_error', 'scroll_to_result']);
        
        // Reset to initial defaults
        $this->groups = [
            1 => '5, 1, 11, 2, 8',
            2 => '0, 1, 4, 6, 3',
            3 => '0, 1, 4, 6, 3'
        ];

        $this->table_data = [
            0 => ['4,6,8', '4,8,9', '8,9,13', '7,6,5'],
            1 => ['6,6,9', '7,10,13', '12,14,16', '3,7,9'],
            2 => ['6,9,4', '5,7,12', '16,8,1', '2,3,4']
        ];
        $this->rows = 3;
        $this->columns = 4;

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $request = (object)[
            'type'    => $this->calculator_type,
            'k'       => count($this->groups),
            'groups'  => $this->groups,
            'rows'    => $this->rows,
            'columns' => $this->columns,
            'table_data' => $this->table_data,
        ];

        $model = new Statistics();
        $result = $model->anova($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            // Calculate P-values in PHP to remove JS dependency
            if ($this->calculator_type === 'one_way') {
                $k = $result['k'];
                $N = $result['N'];
                $dfb = $k - 1;
                $dfw = $N - $k;
                $msb = $dfb > 0 ? $result['ssb'] / $dfb : 0;
                $msw = $dfw > 0 ? $result['ssw'] / $dfw : 0;
                $f = $msw > 0 ? $msb / $msw : 0;
                $result['p_value'] = number_format(1 - $this->fDistributionCDF($f, $dfb, $dfw), 4);
            } else {
                $rows = $result['rows'];
                $columns = $result['columns'];
                $n = $result['n'];
                $sst = $result['A'] - $result['E'];
                $ssa = $result['C'] - $result['E'];
                $ssb = $result['B'] - $result['E'];
                $ssab = $result['D'] - $result['E'] - $ssa - $ssb;
                $sse = $sst - $ssa - $ssb - $ssab;
                
                $dfa = $rows - 1;
                $dfb = $columns - 1;
                $dfab = ($rows - 1) * ($columns - 1);
                $dfe = $n - ($rows * $columns);
                
                $msa = $dfa > 0 ? $ssa / $dfa : 0;
                $msb = $dfb > 0 ? $ssb / $dfb : 0;
                $msab = $dfab > 0 ? $ssab / $dfab : 0;
                $mse = $dfe > 0 ? $sse / $dfe : 0;
                
                $fa = $mse > 0 ? $msa / $mse : 0;
                $fb = $mse > 0 ? $msb / $mse : 0;
                $fab = $mse > 0 ? $msab / $mse : 0;

                $result['p_value1'] = number_format(1 - $this->fDistributionCDF($fa, $dfa, $dfe), 4);
                $result['p_value2'] = number_format(1 - $this->fDistributionCDF($fb, $dfb, $dfe), 4);
                $result['p_value3'] = number_format(1 - $this->fDistributionCDF($fab, $dfab, $dfe), 4);
            }

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);
            $this->error = null;

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }

            $this->detail = $result;
            $this->dispatch('math-updated');
            return;
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        session()->flash('validation_error', $this->error);
        $this->detail = null;
    }

    private function fDistributionCDF($x, $df1, $df2) {
        if ($x <= 0) return 0;
        return $this->ibeta(($df1 * $x) / ($df1 * $x + $df2), $df1 / 2, $df2 / 2);
    }

    private function ibeta($x, $a, $b) {
        if ($x == 0) return 0;
        if ($x == 1) return 1;
        $bt = exp($this->lgamma($a + $b) - $this->lgamma($a) - $this->lgamma($b) + $a * log($x) + $b * log(1 - $x));
        if ($x < ($a + 1) / ($a + $b + 2)) {
            return $bt * $this->betacf($x, $a, $b) / $a;
        } else {
            return 1 - $bt * $this->betacf(1 - $x, $b, $a) / $b;
        }
    }

    private function lgamma($x) {
        $cof = [76.18009172947146, -86.50532032941677, 24.01409824083091, -1.231739572450155, 0.1208650973866179e-2, -0.5395239384953e-5];
        $y = $x;
        $tmp = $x + 5.5;
        $tmp -= ($x + 0.5) * log($tmp);
        $ser = 1.000000000190015;
        for ($j = 0; $j < 6; $j++) $ser += $cof[$j] / ++$y;
        return -$tmp + log(2.5066282746310005 * $ser / $x);
    }

    private function betacf($x, $a, $b) {
        $maxit = 100;
        $eps = 3e-7;
        $fpmin = 1e-30;
        $qab = $a + $b;
        $qap = $a + 1;
        $qam = $a - 1;
        $c = 1;
        $d = 1 - $qab * $x / $qap;
        if (abs($d) < $fpmin) $d = $fpmin;
        $d = 1 / $d;
        $h = $d;
        for ($m = 1; $m <= $maxit; $m++) {
            $m2 = 2 * $m;
            $aa = $m * ($b - $m) * $x / (($qam + $m2) * ($a + $m2));
            $d = 1 + $aa * $d;
            if (abs($d) < $fpmin) $d = $fpmin;
            $c = 1 + $aa / $c;
            if (abs($c) < $fpmin) $c = $fpmin;
            $d = 1 / $d;
            $h *= $d * $c;
            $aa = -($a + $m) * ($qab + $m) * $x / (($a + $m2) * ($qap + $m2));
            $d = 1 + $aa * $d;
            if (abs($d) < $fpmin) $d = $fpmin;
            $c = 1 + $aa / $c;
            if (abs($c) < $fpmin) $c = $fpmin;
            $d = 1 / $d;
            $h *= $d * $c;
            if (abs($d * $c - 1) < $eps) break;
        }
        return $h;
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

        // We no longer call window.calculateANOVA because we do it in PHP now.
        // But we still need to trigger KaTeX for the new content.
        if ($this->detail) {
            $this->dispatch('math-updated');
        }

        return view('livewire.calculators.anova-calculator');
    }
}
