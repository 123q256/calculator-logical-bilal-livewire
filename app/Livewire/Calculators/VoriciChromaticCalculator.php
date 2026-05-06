<?php

namespace App\Livewire\Calculators;
use App\Models\EverydayLife;
use Livewire\Component;

class VoriciChromaticCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    public $s_f = '4';
    public $str_f;
    public $dex_f = '137';
    public $int_f;
    public $r_f = '3';
    public $g_f;
    public $b_f;

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
        $this->reset(['s_f', 'str_f', 'dex_f', 'int_f', 'r_f', 'g_f', 'b_f', 'detail', 'error']);

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
        $this->validate([
            's_f' => 'required|numeric',
            'str_f' => 'nullable|numeric',
            'dex_f' => 'nullable|numeric',
            'int_f' => 'nullable|numeric',
            'r_f' => 'nullable|numeric',
            'g_f' => 'nullable|numeric',
            'b_f' => 'nullable|numeric',
        ]);

        $socks = (int)$this->s_f;
        $str = (int)($this->str_f ?: 0);
        $dex = (int)($this->dex_f ?: 0);
        $int = (int)($this->int_f ?: 0);
        $red = (int)($this->r_f ?: 0);
        $green = (int)($this->g_f ?: 0);
        $blue = (int)($this->b_f ?: 0);

        if ($str == 0 && $dex == 0 && $int == 0) {
            $this->error = "Please fill in stat requirements.";
            $this->detail = null;
            return;
        }

        if ($red + $green + $blue > $socks || $red + $green + $blue == 0) {
            $this->error = "Invalid desired socket colors.";
            $this->detail = null;
            return;
        }

        $requirements = (object)['red' => $str, 'green' => $dex, 'blue' => $int];
        $desired = (object)['red' => $red, 'green' => $green, 'blue' => $blue];

        $chances = $this->getColorChances($requirements);
        $recipes = $this->getRecipes();
        $results = [];

        foreach ($recipes as $recipe) {
            if ($recipe['red'] <= $desired->red && $recipe['green'] <= $desired->green && $recipe['blue'] <= $desired->blue) {
                $unvoricified = (object)[
                    'red' => $desired->red - $recipe['red'],
                    'green' => $desired->green - $recipe['green'],
                    'blue' => $desired->blue - $recipe['blue']
                ];
                $free = $socks - ($desired->red + $desired->green + $desired->blue);
                $chance = $this->multiNomial($chances, $unvoricified, $free);

                if ($recipe['name'] === "Chromatic") {
                    $bonus = $this->chromaticBonus($chances, $desired, $socks);
                    $chance /= (1 - $bonus);
                }

                if ($chance > 0) {
                    $avgCost = $recipe['cost'] / $chance;
                    $avgTries = 1 / $chance;
                    $stdDev = sqrt((1 - $chance) / ($chance * $chance));

                    $results[] = [
                        'name' => $recipe['name'],
                        'avgCost' => number_format($avgCost, 1),
                        'favg' => $avgCost,
                        'chance' => number_format($chance * 100, 5) . '%',
                        'avgTries' => number_format($avgTries, 1),
                        'cost' => $recipe['name'] === "Drop Rate" ? "-" : $recipe['cost'],
                        'stdDev' => number_format($stdDev, 2),
                    ];
                }
            }
        }

        usort($results, function ($a, $b) {
            $order = ['Drop Rate' => 1, 'Chromatic' => 2];
            $aOrder = $order[$a['name']] ?? 3;
            $bOrder = $order[$b['name']] ?? 3;

            if ($aOrder !== $bOrder) {
                return $aOrder <=> $bOrder;
            }

            return $b['favg'] <=> $a['favg'];
        });

        foreach ($results as &$res) {
            if ($res['name'] === 'Drop Rate') {
                $res['avgCost'] = '-';
            }
        }

        $this->detail = [
            'results' => $results,
            's_f' => $socks,
            'str_f' => $str,
            'dex_f' => $dex,
            'int_f' => $int,
            'r_f' => $red,
            'g_f' => $green,
            'b_f' => $blue,
        ];

        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->flash('calculator_result', $this->detail);
            session()->flash('scroll_to_result', true);
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
    }

    private function getColorChances($req)
    {
        $X = 5;
        $C = 5;
        $max = 0.9;
        $total = $req->red + $req->green + $req->blue;
        $count = ($req->red > 0 ? 1 : 0) + ($req->green > 0 ? 1 : 0) + ($req->blue > 0 ? 1 : 0);

        $calc = function ($r) use ($count, $total, $max, $X, $C) {
            if ($count === 1) {
                return ($r > 0) ? $max * ($X + $C + $r) / ($total + 3 * $X + $C) : (1 - $max) / 2 + $max * ($X / ($total + 3 * $X + $C));
            } elseif ($count === 2) {
                return ($r > 0) ? $max * $r / $total : (1 - $max);
            } else {
                return $r / $total;
            }
        };

        return (object)[
            'red' => $calc($req->red),
            'green' => $calc($req->green),
            'blue' => $calc($req->blue),
        ];
    }

    private function getRecipes()
    {
        return [
            ['red' => 0, 'green' => 0, 'blue' => 0, 'cost' => 1, 'name' => 'Drop Rate'],
            ['red' => 0, 'green' => 0, 'blue' => 0, 'cost' => 1, 'name' => 'Chromatic'],
            ['red' => 1, 'green' => 0, 'blue' => 0, 'cost' => 4, 'name' => 'Vorici 1R'],
            ['red' => 0, 'green' => 1, 'blue' => 0, 'cost' => 4, 'name' => 'Vorici 1G'],
            ['red' => 0, 'green' => 0, 'blue' => 1, 'cost' => 4, 'name' => 'Vorici 1B'],
            ['red' => 2, 'green' => 0, 'blue' => 0, 'cost' => 25, 'name' => 'Vorici 2R'],
            ['red' => 0, 'green' => 2, 'blue' => 0, 'cost' => 25, 'name' => 'Vorici 2G'],
            ['red' => 0, 'green' => 0, 'blue' => 2, 'cost' => 25, 'name' => 'Vorici 2B'],
            ['red' => 0, 'green' => 1, 'blue' => 1, 'cost' => 15, 'name' => 'Vorici 1G1B'],
            ['red' => 1, 'green' => 0, 'blue' => 1, 'cost' => 15, 'name' => 'Vorici 1R1B'],
            ['red' => 1, 'green' => 1, 'blue' => 0, 'cost' => 15, 'name' => 'Vorici 1R1G'],
            ['red' => 3, 'green' => 0, 'blue' => 0, 'cost' => 120, 'name' => 'Vorici 3R'],
            ['red' => 0, 'green' => 3, 'blue' => 0, 'cost' => 120, 'name' => 'Vorici 3G'],
            ['red' => 0, 'green' => 0, 'blue' => 3, 'cost' => 120, 'name' => 'Vorici 3B'],
            ['red' => 2, 'green' => 1, 'blue' => 0, 'cost' => 100, 'name' => 'Vorici 2R1G'],
            ['red' => 2, 'green' => 0, 'blue' => 1, 'cost' => 100, 'name' => 'Vorici 2R1B'],
            ['red' => 1, 'green' => 2, 'blue' => 0, 'cost' => 100, 'name' => 'Vorici 1R2G'],
            ['red' => 0, 'green' => 2, 'blue' => 1, 'cost' => 100, 'name' => 'Vorici 2G1B'],
            ['red' => 1, 'green' => 0, 'blue' => 2, 'cost' => 100, 'name' => 'Vorici 1R2B'],
            ['red' => 0, 'green' => 1, 'blue' => 2, 'cost' => 100, 'name' => 'Vorici 1G2B'],
        ];
    }

    private function factorial($n)
    {
        return ($n <= 1) ? 1 : $n * $this->factorial($n - 1);
    }

    private function multiNomial($chances, $desired, $free, $pos = 1)
    {
        if ($free > 0) {
            $res = 0;
            if ($pos <= 1) $res += $this->multiNomial($chances, (object)['red' => $desired->red + 1, 'green' => $desired->green, 'blue' => $desired->blue], $free - 1, 1);
            if ($pos <= 2) $res += $this->multiNomial($chances, (object)['red' => $desired->red, 'green' => $desired->green + 1, 'blue' => $desired->blue], $free - 1, 2);
            $res += $this->multiNomial($chances, (object)['red' => $desired->red, 'green' => $desired->green, 'blue' => $desired->blue + 1], $free - 1, 3);
            return $res;
        } else {
            $total = $desired->red + $desired->green + $desired->blue;
            $divisor = ($this->factorial($desired->red) * $this->factorial($desired->green) * $this->factorial($desired->blue));
            if ($divisor == 0) return 0;
            $fact = $this->factorial($total) / $divisor;
            return $fact * pow($chances->red, $desired->red) * pow($chances->green, $desired->green) * pow($chances->blue, $desired->blue);
        }
    }

    private function chromaticBonus($chances, $desired, $free, $rolled = null, $pos = 1)
    {
        if ($rolled === null) $rolled = (object)['red' => 0, 'green' => 0, 'blue' => 0];
        if ($rolled->red >= $desired->red && $rolled->green >= $desired->green && $rolled->blue >= $desired->blue) return 0;
        if ($free > 0) {
            $res = 0;
            if ($pos <= 1) $res += $this->chromaticBonus($chances, $desired, $free - 1, (object)['red' => $rolled->red + 1, 'green' => $rolled->green, 'blue' => $rolled->blue], 1);
            if ($pos <= 2) $res += $this->chromaticBonus($chances, $desired, $free - 1, (object)['red' => $rolled->red, 'green' => $rolled->green + 1, 'blue' => $rolled->blue], 2);
            $res += $this->chromaticBonus($chances, $desired, $free - 1, (object)['red' => $rolled->red, 'green' => $rolled->green, 'blue' => $rolled->blue + 1], 3);
            return $res;
        } else {
            $total = $rolled->red + $rolled->green + $rolled->blue;
            $divisor = ($this->factorial($rolled->red) * $this->factorial($rolled->green) * $this->factorial($rolled->blue));
            if ($divisor == 0) return 0;
            $fact = $this->factorial($total) / $divisor;
            return $fact * pow($chances->red, $rolled->red * 2) * pow($chances->green, $rolled->green * 2) * pow($chances->blue, $rolled->blue * 2);
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
        return view('livewire.calculators.vorici-chromatic-calculator');
    }
}
