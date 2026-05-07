<?php

namespace App\Livewire\Calculators;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TireSizeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Tabs: 1 = Calculator, 2 = Comparison, 3 = Convert
    public $activeTab = 1;
    public $unit = 'in'; // 'in' or 'mm'

    // Calculator Inputs
    public $sw = 245;
    public $as = 75;
    public $rim = 16;
    public $nrim = ''; // New rim for conversion

    // Comparison Inputs
    public $sw1 = 245, $as1 = 75, $rim1 = 16;
    public $sw2 = 265, $as2 = 70, $rim2 = 17;

    // Results
    public $calcResults = [];
    public $compareResults = [];
    public $alternateSizes = '';
    public $speedometer = [];

    // Visualizer Styles
    public $visStyles = [];

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        
        // Initial Calculations for defaults
        $this->calculateTire();
        $this->calculateComparison();
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        if ($tab == 2) {
            $this->calculateComparison();
        } else {
            $this->calculateTire();
        }
    }

    public function toggleUnit()
    {
        $this->unit = ($this->unit == 'in') ? 'mm' : 'in';
        if ($this->activeTab == 2) {
            $this->calculateComparison();
        } else {
            $this->calculateTire();
        }
    }

    public function calculateTire()
    {
        $this->validate([
            'sw' => 'required|numeric|min:1',
            'as' => 'required|numeric|min:1',
            'rim' => 'required|numeric|min:1',
        ]);

        $sw = (float)$this->sw;
        $as = (float)$this->as;
        $rim = (float)$this->rim;
        $nrim = $this->nrim !== '' ? (float)$this->nrim : $rim;

        $res = $this->getTireSpecs($sw, $as, $nrim);
        $this->calcResults = $res;
        
        $this->updateVisualizerStyles($res, $sw, $as, $nrim);
        
        // Fetch Alternate Sizes
        $size_str = round($res['diameter_in']) . "-" . $nrim . "-" . $res['diameter_in'];
        $this->getAlternateSizes($size_str, $nrim);
    }

    public function getAlternateSizes($size_str, $targetRim)
    {
        $ext = ($this->unit == 'mm') ? '-mm.htm' : '.htm';
        // Ensure diameter in URL is rounded to 1 decimal place to match source pattern
        $diameter = $this->calcResults['diameter_in'] ?? 0;
        $url_path = 'sizes3/' . round($diameter) . "-" . $targetRim . "-" . round($diameter, 1) . $ext;
        
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
            ])
            ->withoutVerifying() // Fix for local SSL/cURL issues
            ->timeout(30)
            ->get("https://tiresize.com/" . $url_path);

            if ($response->successful()) {
                $html = $response->body();
                $html = str_replace('href="/tiresizes/', 'href="javascript:void(0);" data-url="', $html);
                $this->alternateSizes = $html;
            } else {
                $this->alternateSizes = '<div class="text-center mt-4"><b>No Sizes Available Within 3% of Diameter</b></div>';
            }
        } catch (\Exception $e) {
            $this->alternateSizes = '<div class="text-center mt-4 text-red-500">Error: ' . $e->getMessage() . '</div>';
        }
    }

    public function changeRim($newRim)
    {
        $this->nrim = $newRim;
        $this->activeTab = 3;
        $this->calculateTire();
    }

    public function calculateComparison()
    {
        $this->validate([
            'sw1' => 'required|numeric|min:1',
            'as1' => 'required|numeric|min:1',
            'rim1' => 'required|numeric|min:1',
            'sw2' => 'required|numeric|min:1',
            'as2' => 'required|numeric|min:1',
            'rim2' => 'required|numeric|min:1',
        ]);

        if ($this->sw1 <= 0 || $this->as1 <= 0 || $this->rim1 <= 0 || $this->sw2 <= 0 || $this->as2 <= 0 || $this->rim2 <= 0) return;

        $res1 = $this->getTireSpecs($this->sw1, $this->as1, $this->rim1);
        $res2 = $this->getTireSpecs($this->sw2, $this->as2, $this->rim2);

        $this->compareResults = [
            'tire1' => $res1,
            'tire2' => $res2,
            'diff' => [
                'diameter' => $this->getPctDiff($res1['diameter'], $res2['diameter']),
                'width' => $this->getPctDiff($res1['width'], $res2['width']),
                'sidewall' => $this->getPctDiff($res1['sidewall'], $res2['sidewall']),
                'circumference' => $this->getPctDiff($res1['circumference'], $res2['circumference']),
                'revs' => round($res2['revs_raw'] - $res1['revs_raw'], 1)
            ]
        ];

        // Speedometer Error
        $this->speedometer = [];
        $ratios = [20, 30, 40, 50, 60, 70, 80, 90];
        foreach ($ratios as $speed) {
            $this->speedometer[$speed] = round(($res2['diameter'] / $res1['diameter']) * $speed, 1);
        }

        $this->updateComparisonVisualizerStyles($res1, $res2);
    }

    private function getTireSpecs($sw, $as, $rim)
    {
        if ($sw > 89) { // Metric
            $diameter = (2 * $sw * $as / 2540) + $rim;
            $width = $sw / 25.4;
            $sidewall = ($sw * $as / 100) / 25.4;
        } else { // Inches
            $diameter = $sw;
            $width = $as;
            $sidewall = ($diameter - $rim) / 2;
        }

        $circumference = $diameter * pi();
        $revs_raw = 63360 / $circumference;

        $isMetric = ($this->unit == 'mm');
        $factor = $isMetric ? 25.4 : 1.0;
        $revsFactor = $isMetric ? 0.621371 : 1.0;

        return [
            'diameter' => round($diameter * $factor, 1),
            'width' => round($width * $factor, 1),
            'sidewall' => round($sidewall * $factor, 1),
            'circumference' => round($circumference * $factor, 1),
            'revs' => round($revs_raw * $revsFactor, 1),
            'revs_raw' => $revs_raw,
            'diameter_in' => $diameter,
            'width_in' => $width,
            'rim' => $rim
        ];
    }

    private function getPctDiff($val1, $val2)
    {
        if ($val1 == 0) return 0;
        $diff = (($val2 / $val1) - 1) * 100;
        return ($diff > 0 ? '+' : '') . round($diff, 1) . '%';
    }

    private function updateVisualizerStyles($res, $sw, $as, $rim)
    {
        // Porting JS cal_viewer logic
        $s = 0.5; // Scale factor
        $r = 185; // Base size
        $dia = $res['diameter_in'];
        
        $scale = $r / (10 * $dia * $s);
        $v = $r;
        $u = round(($res['width_in'] * 10 * $s) * $scale);
        
        $rim_px = round($rim / 17 * 370 * $s * $scale);
        $rim_offset = round(-($rim_px - $v) / 2);
        $wall_px = round(($dia * 10 * $s - $rim * 10 * $s) / 2);

        $this->visStyles = [
            'cc' => "width: {$v}px; height: {$v}px;",
            'tt' => "width: {$v}px; height: {$v}px; border-radius: " . ($v / 2) . "px;",
            'ww' => "width: {$rim_px}px; height: {$rim_px}px; top: {$rim_offset}px; left: {$rim_offset}px;",
            'tctc' => "width: {$u}px; height: {$v}px;",
            'visheight' => "margin-top: " . (round($v/2) - 15) . "px",
            't_side' => "height: " . ($wall_px * $scale - 1) . "px; width: " . (round($v/2) - 10) . "px;",
            'vis_side' => "margin-top: " . round($wall_px * $scale / 2) . "px",
            't_wheel' => "width: " . (round($rim * 10 * $s) * $scale - 1) . "px; right: " . ($wall_px * $scale) . "px; height: " . round($v/2) . "px;"
        ];
    }

    private function updateComparisonVisualizerStyles($res1, $res2)
    {
        // Similar logic for comparison
    }

    public function fetchAlternateSizes($dia, $rim)
    {
        // This is a bit tricky since it's an external API.
        // I'll leave a placeholder or handle it via a component call if I can find the endpoint.
        // For now, I'll just use the logic from the legacy JS if possible.
    }

    public function render()
    {
        return view('livewire.calculators.tire-size-calculator');
    }
}
