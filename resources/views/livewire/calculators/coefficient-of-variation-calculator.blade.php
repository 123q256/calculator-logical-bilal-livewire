<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 gap-4">
                    <div class="w-full raw">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="space-y-2 px-2">
                                <div class="pt-2 pb-3 d-lg-flex justify-content-between align-items-center">
                                    <input id="type_1" value="1" type="radio" wire:model.live="type_" class="r_data cursor-pointer" />
                                    <label for="type_1" class="label pe-lg-0 pe-4 cursor-pointer">{{ $lang['sample'] }}</label>
                                    <input id="type_2" value="2" type="radio" wire:model.live="type_" class="r_data cursor-pointer" />
                                    <label for="type_2" class="label cursor-pointer">{{ $lang['pop'] }}</label>
                                </div>
                            </div>
                            <div class="space-y-2 raw_mean">
                                <label for="x" class="label">{{ $lang['x'] }} ({{ $lang['note_value'] }})</label>
                                <div class="w-100 py-2">
                                    <textarea id="x" wire:model.live="x" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="row">
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{ $lang['d'] }}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] w-auto bg-[#2845F5] text-white px-3 py-2 rounded d-inline-block my-3">
                                            <strong class="text-white">
                                                {{ $detail['c'] }}
                                            </strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2">
                                    <table class="w-full">
                                        <tr>
                                            <td class="py-2 border-b"><img src="{{ url('images/sample.webp') }}" alt="{{ $lang['a'] }}" loading="lazy" width="25" height="25"></td>
                                            <td class="py-2 border-b">{{ $lang['a'] }}</td>
                                            <td class="py-2 border-b"><b>{{ $detail['t_n'] ?? '0' }}</b></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><img src="{{ url('images/mean.webp') }}" alt="{{ $lang['b'] }}" loading="lazy" width="25" height="25"></td>
                                            <td class="py-2 border-b">{{ $lang['b'] }}</td>
                                            <td class="py-2 border-b"><b>{{ $detail['m'] ?? '0' }}</b></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><img src="{{ url('images/deviation.webp') }}" alt="{{ $lang['c'] }}" loading="lazy" width="25" height="25"></td>
                                            <td class="py-2 border-b">{{ $lang['c'] }}</td>
                                            <td class="py-2 border-b"><b>{{ $detail['d'] ?? '0' }}</b></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><img src="{{ url('images/coeffi.webp') }}" alt="{{ $lang['d'] }}" loading="lazy" width="25" height="25"></td>
                                            <td class="py-2 border-b">{{ $lang['d'] }} %</td>
                                            <td class="py-2 border-b"><b>{{ isset($detail['c']) ? ($detail['c'] * 100) . ' %' : '0 %' }}</b></td>
                                        </tr>
                                    </table>
                                    @php
                                        $arr = $detail['arr'] ?? [];
                                        $m = $detail['m'] ?? 0;
                                        $sum = 0;
                                        foreach ($arr as $value) {
                                            $sum += pow($value - $m, 2);
                                        }
                                    @endphp
                                    <p class="mt-3">
                                        <strong>{{ $lang['1'] }}</strong>
                                    </p>
                                    <div>
                                        <p class="mt-3">
                                            {{ $lang['2'] }} = {{ $x }}
                                        </p>
                                        <p class="mt-3">
                                            {{ $lang['3'] }} = {{ $detail['count'] ?? 0 }}
                                        </p>
                                    </div>
                                    <p class="mt-2">
                                        <span class="mb-5"> 
                                            @if($type_ == 1) x&#772; @else μ @endif =
                                        </span>
                                        <span class="fraction"> 
                                            <span class="num">{{ $lang['4'] }}</span>
                                            <span class="den">{{ $lang['5'] }}</span>
                                        </span>
                                    </p>
                                    <p>
                                        <span class="mb-5"> 
                                            @if($type_ == 1) x&#772; @else μ @endif =
                                        </span>
                                        <span class="fraction"> 
                                            <span class="num">{{ $detail['replace'] ?? '' }}</span>
                                            <span class="den">{{ $detail['count'] ?? 0 }}</span>
                                        </span>
                                    </p>
                                    <p>
                                        <span class="mb-5"> 
                                            @if($type_ == 1) x&#772; @else μ @endif =
                                        </span>
                                        <span class="fraction"> 
                                            <span class="num">{{ $detail['sum'] ?? 0 }}</span>
                                            <span class="den">{{ $detail['count'] ?? 0 }}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">
                                        @if($type_ == 1) x&#772; @else μ @endif = {{ $detail['m'] ?? 0 }}
                                    </p>
                                    @if ($type_ == '1')
                                        <p class="mt-4">\(s = \sqrt{\frac{\sum_{i=1}^{n}(x_i - \bar{x})^2}{n-1}}\)</p>
                                        <p class="mt-4">
                                            \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = 
                                            <span class="mt-2">
                                                @foreach ($arr as $key => $value)
                                                    ({{ $value }} - {{ $m }})<sup>2</sup> @if($key < count($arr) - 1) + @endif
                                                @endforeach
                                            </span>
                                        </p>
                                        <p class="mt-4">
                                            \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = 
                                            <span class="mt-2">
                                                @foreach ($arr as $key => $value)
                                                    ({{ $value - $m }})<sup>2</sup> @if($key < count($arr) - 1) + @endif
                                                @endforeach
                                            </span>
                                        </p>
                                        <p class="mt-4">\(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = {{ $sum }}</p>
                                        <p class="mt-4">S.D = \(\sqrt{\frac{ {{ $sum }} }{ {{ ($detail['count'] ?? 1) }} - 1 }}\)</p>
                                        <p class="mt-4">S.D = \(\sqrt{\frac{ {{ $sum }} }{ {{ ($detail['count'] ?? 1) - 1 }} }}\)</p>
                                        <p class="mt-4">S.D = \(\sqrt{ {{ ($detail['count'] ?? 1) > 1 ? ($sum / ($detail['count'] - 1)) : 0 }} }\)</p>
                                        <p class="mt-4">S.D = {{ $detail['d'] ?? 0 }}</p>
                                        <p>
                                            <span class="mb-5">{{ $lang['6'] }} (CV) =</span>
                                            <span class="fraction">
                                                <span class="num">s</span>
                                                <span class="den">x</span>
                                            </span>
                                        </p>
                                        <p>
                                            <span class="mb-5">CV =</span>
                                            <span class="fraction">
                                                <span class="num">{{ $detail['d'] ?? 0 }}</span>
                                                <span class="den">{{ $detail['m'] ?? 0 }}</span>
                                            </span>
                                        </p>
                                        <p>CV = {{ $detail['c'] ?? 0 }}</p>
                                    @else
                                        <p class="mt-4">\(s = \sqrt{\frac{\sum_{i=1}^{n}(x_i - \mu)^2}{n}}\)</p>
                                        <p class="mt-4">
                                            \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = 
                                            <span class="mt-2">
                                                @foreach ($arr as $key => $value)
                                                    ({{ $value }} - {{ $m }})<sup>2</sup> @if($key < count($arr) - 1) + @endif
                                                @endforeach
                                            </span>
                                        </p>
                                        <p class="mt-4">
                                            \(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = 
                                            <span class="mt-2">
                                                @foreach ($arr as $key => $value)
                                                    ({{ $value - $m }})<sup>2</sup> @if($key < count($arr) - 1) + @endif
                                                @endforeach
                                            </span>
                                        </p>
                                        <p class="mt-4">\(\sum_{i=1}^{n} (x_i - \bar{x})^2\) = {{ $sum }}</p>
                                        <p class="mt-4">σ = \(\sqrt{\frac{ {{ $sum }} }{ {{ ($detail['count'] ?? 1) }} }}\)</p>
                                        <p class="mt-4">σ = \(\sqrt{ {{ ($detail['count'] ?? 0) > 0 ? ($sum / $detail['count']) : 0 }} }\)</p>
                                        <p class="mt-4">σ = {{ $detail['d'] ?? 0 }}</p>
                                        <p>
                                            <span class="mb-5">{{ $lang['6'] }} (CV) =</span>
                                            <span class="fraction">
                                                <span class="num">σ</span>
                                                <span class="den">μ</span>
                                            </span>
                                        </p>
                                        <p>
                                            <span class="mb-5">CV =</span>
                                            <span class="fraction">
                                                <span class="num">{{ $detail['d'] ?? 0 }}</span>
                                                <span class="den">{{ $detail['m'] ?? 0 }}</span>
                                            </span>
                                        </p>
                                        <p>CV = {{ $detail['c'] ?? 0 }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:navigated', () => {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
            window.addEventListener('scroll_to_result', () => {
                 setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            });
        </script>
    @endpush
</div>
