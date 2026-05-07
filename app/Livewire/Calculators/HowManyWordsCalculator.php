<?php

namespace App\Livewire\Calculators;

use App\Models\EverydayLife;
use Livewire\Component;

class HowManyWordsCalculator extends Component
{
    public $error = null;
    public $detail = null;
    public $type = 'calculator';
    public $lang = [];
    public $result_key = 1;
    public $device = 'desktop';

    // Inputs
    public $main = 1;
    public $page = '';
    public $size = 12;
    public $font = 'Times';
    public $custom_font = '';
    public $space = 'single';
    public $title = 'Quran';
    public $sp_title = 'Perfect';
    public $title2 = '';
    public $page2 = '';
    public $lang_select = 'English';

    public function mount($type = 'calculator', $lang = [])
    {
        $this->type = $type;
        $this->lang = $lang;
        $this->detail = session('calculator_result');
        $this->error = session('validation_error');
        $this->device = is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "mobile")) ? 'mobile' : 'desktop';

        if (session()->has('calculator_back_inputs')) {
            $inputs = session('calculator_back_inputs');
            $this->main = $inputs->main ?? 1;
            $this->page = $inputs->page ?? '';
            $this->size = $inputs->size ?? 12;
            $this->font = $inputs->font ?? 'Times';
            $this->custom_font = $inputs->custom_font ?? '';
            $this->space = $inputs->space ?? 'single';
            $this->title = $inputs->title ?? 'Quran';
            $this->sp_title = $inputs->sp_title ?? 'Perfect';
            $this->title2 = $inputs->title2 ?? '';
            $this->page2 = $inputs->page2 ?? '';
            $this->lang_select = $inputs->lang ?? 'English';
        }
    }

    public function updated($propertyName)
    {
        $this->detail = null;
        $this->error = null;
    }

    public function switchTab($val)
    {
        $this->main = $val;
        $this->detail = null;
        $this->error = null;
    }

    public function resetForm()
    {
        $this->error = null;
        $this->detail = null;
        $this->main = 1;
        $this->page = '';
        $this->size = 12;
        $this->font = 'Times';
        $this->space = 'single';
        $this->title = 'Quran';
        $this->sp_title = 'Perfect';
        $this->page2 = '';
        $this->lang_select = 'English';

        session()->forget([
            'calculator_back_inputs',
            'calculator_result',
            'validation_error',
            'scroll_to_result'
        ]);

        if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
            return redirect()->to(url()->previous() ?? '/');
        }
    }

    public function calculate()
    {
        $this->result_key++;
        $this->detail = null;
        $this->error = null;

        $request = (object)[
            'main' => $this->main,
            'page' => (is_numeric($this->page) && $this->page > 0) ? floatval($this->page) : null,
            'size' => $this->size,
            'font' => $this->font,
            'space' => $this->space,
            'page2' => (is_numeric($this->page2) && $this->page2 > 0) ? floatval($this->page2) : null,
            'title' => $this->title,
            'sp_title' => $this->sp_title,
            'title2' => $this->title2,
            'custom_font' => $this->custom_font,
            'lang' => $this->lang_select,
        ];

        $model = new EverydayLife();
        $result = $model->word_count($request);

        if (!empty($result['RESULT']) && $result['RESULT'] == 1) {
            $this->detail = $result;
            $this->error = null;

            session()->flash('calculator_result', $result);
            session()->flash('scroll_to_result', true);
            session()->flash('calculator_back_inputs', $request);

            if (env('LIVEWIRE_CALCULATOR_RELOAD')) {
                return redirect()->to(url()->previous() ?? '/');
            }
        } else {
            $this->error = $result['error'] ?? 'Something went wrong.';
            session()->flash('validation_error', $this->error);
            $this->detail = null;
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
        return view('livewire.calculators.how-many-words-calculator');
    }
}
