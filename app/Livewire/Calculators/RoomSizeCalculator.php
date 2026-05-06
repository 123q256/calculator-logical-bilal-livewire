<?php

namespace App\Livewire\Calculators;
use Livewire\Component;
use App\Models\Construction;

class RoomSizeCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];

    // Form fields
    public $name = 'feet'; // selection: feet or meter
    public $perce = 0;
    public $rooms = [];

    public function mount($type = 'calculator', $lang = [], $currancy = null)
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');

        if (empty($this->rooms)) {
            $this->addRoom();
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
    }

    public function setTab($val)
    {
        if ($this->name !== $val) {
            $this->name = $val;
            $this->detail = null;
            // Reset rooms if switching tabs to ensure clean state
            $this->rooms = [];
            $this->addRoom();
        }
    }


    public function addRoom()
    {
        if (count($this->rooms) >= 5) {
            return;
        }

        if ($this->name == 'feet') {
            $this->rooms[] = [
                'lenght_f' => 7,
                'lenght_in' => 4,
                'width_f' => 7,
                'width_in' => 4,
            ];
        } else {
            $this->rooms[] = [
                'lenght_m' => 7,
                'width_m' => 4,
            ];
        }
    }

    public function removeRoom($index)
    {
        if (count($this->rooms) > 1) {
            unset($this->rooms[$index]);
            $this->rooms = array_values($this->rooms);
            $this->detail = null;
        }
    }

    public function resetForm()
    {
        $this->reset(['error', 'detail', 'name', 'perce', 'rooms']);
        $this->addRoom();
        $this->resetErrorBag();
        $this->resetValidation();

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
        // Build request object with arrays as expected by the model
        $reqData = [
            'name'      => $this->name,
            'perce'     => $this->perce,
            'lenght_f'  => [],
            'lenght_in' => [],
            'width_f'   => [],
            'width_in'  => [],
            'lenght_m'  => [],
            'width_m'   => [],
        ];

        if ($this->name == 'feet') {
            $reqData['lenght_f'] = array_column($this->rooms, 'lenght_f');
            $reqData['lenght_in'] = array_column($this->rooms, 'lenght_in');
            $reqData['width_f'] = array_column($this->rooms, 'width_f');
            $reqData['width_in'] = array_column($this->rooms, 'width_in');
        } else {
            $reqData['lenght_m'] = array_column($this->rooms, 'lenght_m');
            $reqData['width_m'] = array_column($this->rooms, 'width_m');
        }

        $request = (object)$reqData;

        $model = new Construction();
        $result = $model->room($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('calculator_result', $result);
                session()->flash('scroll_to_result', true);
                session()->flash('calculator_back_inputs', $request);
                $this->error = null;
              return redirect()->to(url()->previous() ?? '/');
            } else {
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
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->flash('validation_error', $this->error);
            return redirect()->to(url()->previous() ?? '/');
        } else {
            $this->detail = null;
        }
    }

    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                }
            JS);
        }
        return view('livewire.calculators.room-size-calculator');
    }
}
