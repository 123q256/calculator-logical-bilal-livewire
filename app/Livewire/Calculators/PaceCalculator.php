<?php

namespace App\Livewire\Calculators;

use App\Models\Health;
use Livewire\Component;

class PaceCalculator extends Component
{
    public $type = 'calculator'; 
    public $calculator_name = 'calculator1';
    public $sub_type = 'pace'; // For calculator1: pace, time, distance
    
    // Calculator 1 Fields
    public $time = '00:05:13';
    public $dis = '12';
    public $dis_unit = 'mi';
    public $event = '';
    public $pace = '00:07:33';
    public $per = '1';

    // Calculator 2 Fields (Splits - using an array for cleaner management)
    public $splits = [
        ['dis' => '1', 'unit' => 'mi', 'time' => '00:03:13'],
        ['dis' => '2', 'unit' => 'mi', 'time' => '00:06:26'],
        ['dis' => '3', 'unit' => 'mi', 'time' => '00:09:55'],
        ['dis' => '4', 'unit' => 'mi', 'time' => '00:12:13'],
        ['dis' => '', 'unit' => 'mi', 'time' => ''],
        ['dis' => '', 'unit' => 'mi', 'time' => ''],
        ['dis' => '', 'unit' => 'mi', 'time' => ''],
        ['dis' => '', 'unit' => 'mi', 'time' => ''],
    ];

    // Calculator 3 Fields (Converter)
    public $conv_from = '00:07:33';
    public $fromu = '1';
    public $to = '2';

    // Calculator 4 Fields (Predictor)
    public $p_fdis = '12';
    public $p_fdis_unit = 'mi';
    public $p_ftime = '00:05:13';
    public $p_ffdis = '5';
    public $p_ffdis_unit = 'mi';

    public $error = null;
    public $detail = null;
    public $lang = [];
    public $cal_name = 'Pace Calculator';

    public function mount($type = 'calculator', $lang = [])
    {
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

    public function updatedEvent($value)
    {
        $events = [
            '1' => ['dis' => '42.195', 'unit' => 'km'],
            '2' => ['dis' => '21.0975', 'unit' => 'km'],
            '3' => ['dis' => '1', 'unit' => 'km'],
            '4' => ['dis' => '5', 'unit' => 'km'],
            '5' => ['dis' => '10', 'unit' => 'km'],
            '6' => ['dis' => '1', 'unit' => 'mi'],
            '7' => ['dis' => '5', 'unit' => 'mi'],
            '8' => ['dis' => '10', 'unit' => 'mi'],
            '9' => ['dis' => '800', 'unit' => 'm'],
            '10' => ['dis' => '1500', 'unit' => 'm'],
        ];

        if (isset($events[$value])) {
            $this->dis = $events[$value]['dis'];
            $this->dis_unit = $events[$value]['unit'];
        }
    }

    public function setTab($tab)
    {
        $this->calculator_name = $tab;
        $this->detail = null;
        $this->error = null;
    }

    public function setSubtype($type)
    {
        $this->sub_type = $type;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->calculator_name = 'calculator1';
        $this->sub_type = 'pace';
        $this->time = '00:05:13';
        $this->dis = '12';
        $this->dis_unit = 'mi';
        $this->event = '';
        $this->pace = '00:07:33';
        $this->per = '1';
        $this->splits = [
            ['dis' => '1', 'unit' => 'mi', 'time' => '00:03:13'],
            ['dis' => '2', 'unit' => 'mi', 'time' => '00:06:26'],
            ['dis' => '3', 'unit' => 'mi', 'time' => '00:09:55'],
            ['dis' => '4', 'unit' => 'mi', 'time' => '00:12:13'],
            ['dis' => '', 'unit' => 'mi', 'time' => ''],
            ['dis' => '', 'unit' => 'mi', 'time' => ''],
            ['dis' => '', 'unit' => 'mi', 'time' => ''],
            ['dis' => '', 'unit' => 'mi', 'time' => ''],
        ];
        $this->conv_from = '00:07:33';
        $this->fromu = '1';
        $this->to = '2';
        $this->p_fdis = '12';
        $this->p_fdis_unit = 'mi';
        $this->p_ftime = '00:05:13';
        $this->p_ffdis = '5';
        $this->p_ffdis_unit = 'mi';

        $this->detail = null;
        $this->error = null;

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error'
        ]);
    }

    public function updated()
    {
        $this->detail = null;
        $this->error = null;
    }

    public function calculate()
    {
        $request = [
            'calculator_name' => $this->calculator_name,
            'type' => $this->sub_type,
            'time' => $this->time,
            'dis' => $this->dis,
            'dis_unit' => $this->dis_unit,
            'event' => $this->event,
            'pace' => $this->pace,
            'per' => $this->per,
            'from' => $this->conv_from,
            'fromu' => $this->fromu,
            'to' => $this->to,
            'fdis' => $this->p_fdis,
            'fdis_unit' => $this->p_fdis_unit,
            'ftime' => $this->p_ftime,
            'ffdis' => $this->p_ffdis,
            'ffdis_unit' => $this->p_ffdis_unit,
        ];

        // Map splits to the format expected by Health model
        foreach ($this->splits as $i => $split) {
            $idx = $i + 1;
            $request["dis$idx"] = $split['dis'];
            $request["dis_unit$idx"] = $split['unit'];
            $request["time$idx"] = $split['time'];
            
            if ($i === 0) {
                $request['fdis'] = $split['dis'];
            }
        }

        $model = new Health();
        $result = $model->pace((object)$request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('calculator_back_inputs', $request);
            
            $this->detail = $result;
            $this->error = null;

            $this->js(<<<'JS'
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            JS);
            return;
        }

        $this->error = $result['error'] ?? 'Please fill all required fields correctly.';
        $this->detail = null;
    }

    public $showDropdown = null;

    public function toggleOverlay($id)
    {
        $this->showDropdown = ($this->showDropdown === $id) ? null : $id;
    }

    public function setUnit($field, $value)
    {
        if (str_contains($field, 'splits.')) {
            $parts = explode('.', $field);
            $index = $parts[1];
            $subfield = $parts[2];
            $this->splits[$index][$subfield] = $value;
        } else {
            $this->$field = $value;
        }
        $this->showDropdown = null;
        $this->detail = null;
    }

    public function resetForm()
    {
        $this->detail = null;
        $this->error = null;
        session()->forget(['calculator_result', 'calculator_back_inputs']);
        // Optional: Reset properties to defaults
    }

    public function gethours($total_sec)
    {
        return str_pad(floor($total_sec / 3600), 2, "0", STR_PAD_LEFT);
    }

    public function getmins($total_sec)
    {
        $mins = $total_sec - ($this->gethours($total_sec) * 3600);
        return str_pad(floor($mins / 60), 2, "0", STR_PAD_LEFT);
    }

    public function getsecs($value)
    {
        return str_pad(round($value - ($this->gethours($value) * 3600) - ($this->getmins($value) * 60)), 2, "0", STR_PAD_LEFT);
    }

    public function gettime($seconds)
    {
        $hour = $this->gethours($seconds);
        $mins = $this->getmins($seconds);
        $sec = $this->getsecs($seconds);
        return "$hour : $mins : $sec";
    }

    public function render()
    {
        return view('livewire.calculators.pace-calculator');
    }
}
