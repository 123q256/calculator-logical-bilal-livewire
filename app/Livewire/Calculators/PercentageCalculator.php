<?php

namespace App\Livewire\Calculators;
use App\Models\Math;
use Livewire\Component;

class PercentageCalculator extends Component
{
    // ─── Core Props ───────────────────────────────────────────────
    public $error  = null;
    public $detail = null;
    public $type   = 'calculator';
    public $lang   = [];
    public $calName;
    public $calLink;
    public $device = 'desktop';

    // ─── ID Locale Fields (to=1..4) ───────────────────────────────
    public $angka_1     = '';
    public $angka_2     = '';
    public $angka_3     = '';
    public $angka_4     = '';
    public $pembilang_1 = '';
    public $penyebut_1  = '';
    public $perubahan_1 = '';
    public $perubahan_2 = '';

    // ─── EN Locale Fields ─────────────────────────────────────────
    public $method = '1';
    public $p      = '';
    public $x      = '';

    // ─── Mount ────────────────────────────────────────────────────
    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type    = $type;
        $this->lang    = $lang;
        $this->detail  = session('calculator_result');
        $this->error   = session('validation_error');
        $this->device  = session('device', 'desktop');

        if ($back = session('calculator_back_inputs')) {
            // ID
            $this->angka_1     = $back->angka_1     ?? '';
            $this->angka_2     = $back->angka_2     ?? '';
            $this->angka_3     = $back->angka_3     ?? '';
            $this->angka_4     = $back->angka_4     ?? '';
            $this->pembilang_1 = $back->pembilang_1 ?? '';
            $this->penyebut_1  = $back->penyebut_1  ?? '';
            $this->perubahan_1 = $back->perubahan_1 ?? '';
            $this->perubahan_2 = $back->perubahan_2 ?? '';
            // EN
            $this->method = $back->method ?? '1';
            $this->p      = $back->p      ?? '';
            $this->x      = $back->x      ?? '';
        }
    }

    // ─── Reset ────────────────────────────────────────────────────
    public function resetForm(): void
    {
        $this->resetErrorBag();
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
            session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error']);

        $this->error       = null;
        $this->detail      = null;
        $this->angka_1     = '';
        $this->angka_2     = '';
        $this->angka_3     = '';
        $this->angka_4     = '';
        $this->pembilang_1 = '';
        $this->penyebut_1  = '';
        $this->perubahan_1 = '';
        $this->perubahan_2 = '';
        $this->method      = '1';
        $this->p           = '';
        $this->x           = '';
    }

    // ─── Calculate ────────────────────────────────────────────────
    public function calculate($submit = null)
    {
        $this->error = null;

        $locale = app()->getLocale();

        if ($locale === 'id') {
            $request = (object)[
                'angka_1'     => $this->angka_1,
                'angka_2'     => $this->angka_2,
                'angka_3'     => $this->angka_3,
                'angka_4'     => $this->angka_4,
                'pembilang_1' => $this->pembilang_1,
                'penyebut_1'  => $this->penyebut_1,
                'perubahan_1' => $this->perubahan_1,
                'perubahan_2' => $this->perubahan_2,
                'submit'      => $submit,
            ];
        } else {
            $request = (object)[
                'method' => $this->method,
                'p'      => $this->p,
                'x'      => $this->x,
            ];
        }

        $model  = new \App\Models\Math();
        $result = $model->percentage($request);
    if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;
            if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->put('calculator_back_inputs', $request);
                                    return;
            // return redirect()->to(url()->previous() ?? '/');
        }
                    } else {
                $this->js(<<<'JS'
                    setTimeout(() => {
                        const el = document.getElementById('result-section');
                        if (el) {
                            const offset = el.getBoundingClientRect().top + window.scrollY - 100;
                            window.scrollTo({ top: offset, behavior: 'smooth' });
                        }
                    }, 100);
                JS);
            }
        }

        $this->error = $result['error'] ?? 'Something went wrong.';
        $this->detail = null;
        if (env('LIVEWIRE_CALCULATOR_RELOAD', false)) {
                session()->flash('validation_error', $this->error);            return redirect()->to(url()->previous() ?? '/');
        }
    }

    // ─── Render ───────────────────────────────────────────────────
    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) {
                    const offset = 30;
                    const top = el.getBoundingClientRect().top + window.scrollY - offset;
                    window.scrollTo({ top: top, behavior: 'smooth' });
                }
            JS);
        }

        return view('livewire.calculators.percentage-calculator');
    }
}