<?php

namespace App\Livewire\Calculators;

use Livewire\Component;

class TorqueCalculator extends Component
{
    // ─── Core Props ───────────────────────────────────────────────
    public $error   = null;
    public $detail  = null;
    public $type    = 'calculator';
    public $lang    = [];
    public $calName;
    public $calLink;

    // ─── Method Select ────────────────────────────────────────────
    public $to = '1'; // 1=torque | 2=coil | 3=vector

    // ─── Torque Fields ────────────────────────────────────────────
    public $distance = '5';
    public $dis_u    = 'm';
    public $force    = '10';
    public $for_u    = 'N';
    public $angle    = '15';
    public $ang_u    = 'deg';
    public $torque   = '';
    public $tor_u    = 'Nm';

    // ─── Coil Fields ──────────────────────────────────────────────
    public $loop     = '2';
    public $angle_c  = '4';
    public $angc_u   = 'deg';
    public $current  = '6';
    public $cur_u    = 'A';
    public $area     = '8';
    public $area_u   = 'm²';
    public $mag      = '10';
    public $mag_u    = 'T';
    public $tor      = '';
    public $torc_u   = 'Nm';

    // ─── Vector Fields ────────────────────────────────────────────
    public $ax = '00';
    public $ay = '00';
    public $az = '00';
    public $bx = '00';
    public $by = '00';
    public $bz = '00';

    // ─── Dropdown ─────────────────────────────────────────────────
    public $openDropdown = null;

    // ─── Mount ────────────────────────────────────────────────────
    public function mount($type = 'calculator', $lang = [], $calName = null, $calLink = null)
    {
        $this->calName = $calName;
        $this->calLink = $calLink;
        $this->type    = $type;
        $this->lang    = $lang;
        $this->detail  = session('calculator_result');
        $this->error   = session('validation_error');

        if ($back = session('calculator_back_inputs')) {
            $this->to       = $back->to       ?? '1';
            // torque
            $this->distance = $back->distance ?? '5';
            $this->dis_u    = $back->dis_u    ?? 'm';
            $this->force    = $back->force    ?? '10';
            $this->for_u    = $back->for_u    ?? 'N';
            $this->angle    = $back->angle    ?? '15';
            $this->ang_u    = $back->ang_u    ?? 'deg';
            $this->torque   = $back->torque   ?? '';
            $this->tor_u    = $back->tor_u    ?? 'Nm';
            // coil
            $this->loop     = $back->loop     ?? '2';
            $this->angle_c  = $back->angle_c  ?? '4';
            $this->angc_u   = $back->angc_u   ?? 'deg';
            $this->current  = $back->current  ?? '6';
            $this->cur_u    = $back->cur_u    ?? 'A';
            $this->area     = $back->area     ?? '8';
            $this->area_u   = $back->area_u   ?? 'm²';
            $this->mag      = $back->mag      ?? '10';
            $this->mag_u    = $back->mag_u    ?? 'T';
            $this->tor      = $back->tor      ?? '';
            $this->torc_u   = $back->torc_u   ?? 'Nm';
            // vector
            $this->ax = $back->ax ?? '00';
            $this->ay = $back->ay ?? '00';
            $this->az = $back->az ?? '00';
            $this->bx = $back->bx ?? '00';
            $this->by = $back->by ?? '00';
            $this->bz = $back->bz ?? '00';
        }
    }

    // ─── Dropdown Helpers ─────────────────────────────────────────
    public function toggleDropdown(string $name): void
    {
        $this->openDropdown = ($this->openDropdown === $name) ? null : $name;
    }

    public function setUnit(string $field, string $unit): void
    {
        if (property_exists($this, $field)) {
            $this->$field = $unit;
        }
        $this->openDropdown = null;
    }

    public function updatedTo(): void
    {
        $this->detail = null;
        session()->forget('calculator_result');
    }

    public function closeDropdown(): void
    {
        $this->openDropdown = null;
    }

    // ─── Reset ────────────────────────────────────────────────────
    public function resetForm(): void
    {
        $this->resetErrorBag();
        session()->forget(['calculator_result', 'calculator_back_inputs', 'validation_error']);

        $this->error    = null;
        $this->detail   = null;
        $this->to       = '1';
        $this->distance = '5';
        $this->dis_u    = 'm';
        $this->force    = '10';
        $this->for_u    = 'N';
        $this->angle    = '15';
        $this->ang_u    = 'deg';
        $this->torque   = '';
        $this->tor_u    = 'Nm';
        $this->loop     = '2';
        $this->angle_c  = '4';
        $this->angc_u   = 'deg';
        $this->current  = '6';
        $this->cur_u    = 'A';
        $this->area     = '8';
        $this->area_u   = 'm²';
        $this->mag      = '10';
        $this->mag_u    = 'T';
        $this->tor      = '';
        $this->torc_u   = 'Nm';
        $this->ax = '00';
        $this->ay = '00';
        $this->az = '00';
        $this->bx = '00';
        $this->by = '00';
        $this->bz = '00';
    }

    // ─── Calculate ────────────────────────────────────────────────
    public function calculate()
    {
        $this->error = null;

        $request = (object)[
            'to'       => $this->to,
            // ── torque
            'distance' => $this->distance,
            'dis_u'    => $this->dis_u,
            'force'    => $this->force,
            'for_u'    => $this->for_u,
            'angle'    => $this->angle,
            'ang_u'    => $this->ang_u,
            'torque'   => $this->torque,
            'tor_u'    => $this->tor_u,
            // ── coil
            'loop'     => $this->loop,
            'angle_c'  => $this->angle_c,
            'angc_u'   => $this->angc_u,
            'current'  => $this->current,
            'cur_u'    => $this->cur_u,
            'area'     => $this->area,
            'area_u'   => $this->area_u,
            'mag'      => $this->mag,
            'mag_u'    => $this->mag_u,
            'tor'      => $this->tor,
            'torc_u'   => $this->torc_u,
            // ── vector
            'ax'       => $this->ax,
            'ay'       => $this->ay,
            'az'       => $this->az,
            'bx'       => $this->bx,
            'by'       => $this->by,
            'bz'       => $this->bz,
        ];

        $model  = new \App\Models\Physics();
        $result = $model->torque($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->put('calculator_back_inputs', $request);
            $this->error = null;
            return redirect()->to(url()->previous() ?? '/');
        }

        $this->error  = $result['error'] ?? 'Something went wrong.';
        $this->detail = null;
        session()->flash('validation_error', $this->error);
    }

    // ─── Render ───────────────────────────────────────────────────
    public function render()
    {
        if (session('scroll_to_result')) {
            $this->js(<<<'JS'
                const el = document.getElementById('result-section');
                if (el) el.scrollIntoView({ behavior: 'smooth' });
            JS);
        }

        return view('livewire.calculators.torque-calculator');
    }
}