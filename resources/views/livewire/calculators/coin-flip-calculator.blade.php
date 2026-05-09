<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="flips" class="font-s-14 text-blue">{{ $lang['1'] }} (n):</label>
                        <input type="number" step="any" wire:model.live="flips" id="flips" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2">
                        <label for="heads" class="font-s-14 text-blue">{{ $lang['2'] }} (X):</label>
                        <input type="number" step="any" wire:model.live="heads" id="heads" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2">
                        <label for="probablity" class="font-s-14 text-blue">{{ $lang['3'] }} (p):</label>
                        <input type="number" step="any" wire:model.live="probablity" id="probablity" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2">
                        <label for="type_input" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <select wire:model.live="type_input" id="type_input" class="input">
                            <option value="1">{{ $lang['5'] }} X {{ $lang['6'] }}</option>
                            <option value="2">{{ $lang['7'] }} X {{ $lang['6'] }}</option>
                            <option value="3">{{ $lang['8'] }} X {{ $lang['6'] }}</option>
                        </select>
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
                        <div class="w-full">
                            @if ($detail['type'] == "1")
                                <div class="col-lg-7 mt-2 overflow-auto">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b">P({{ $detail['heads'] }}) {{ $lang['9'] }} {{ $detail['heads'] }} {{ $lang['6'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $detail['ans'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">P({{ $detail['heads'] }}) {{ $lang['9'] }} {{ $detail['heads'] }} {{ $lang['20'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ 1 - $detail['ans'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['11'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $detail['ans'] * 100 }}%</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($detail['type'] == "2")
                                <div class="col-lg-7 mt-2 overflow-auto">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b">P(X≥{{ $detail['heads'] }}) {{ $lang['10'] }}{{ $detail['heads'] }} {{ $lang['6'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['summer'] + $detail['ans'], 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">P(X≥{{ $detail['heads'] }}) {{ $lang['10'] }}{{ $detail['heads'] }} {{ $lang['20'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ 1 - round($detail['summer'] + $detail['ans'], 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['11'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ round(($detail['summer'] + $detail['ans']) * 100) }}%</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($detail['type'] == "3")
                                <div class="col-lg-7 mt-2 overflow-auto">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b">P(X≤{{ $detail['heads'] }}) {{ $lang['12'] }} {{ $detail['heads'] }} {{ $lang['6'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $detail['summer'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">P(X≤{{ $detail['heads'] }}) {{ $lang['12'] }} {{ $detail['heads'] }} {{ $lang['20'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ 1 - $detail['summer'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['11'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $detail['summer'] * 100 }}%</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @endif

                            <p class="col-12 mt-3 font-s-20">{{ $lang['13'] }}:</p>
                            <p class="col-12 mt-2">{{ $lang['14'] }}:</p>
                            
                            @if ($detail['type'] == "1" || $detail['type'] == "2")
                                <p class="col-12 mt-2">$$ P(X) = \dfrac{n!}{X!(n-X)!} \cdot p^X \cdot (1-p)^{n-X} $$</p>
                                @if ($detail['type'] == "2")
                                    <p class="col-12 mt-2">{{ $lang['15'] }} P({{ $detail['heads'] }})</p>
                                @endif
                                <p class="col-12 mt-2">{{ $lang['16'] }} : n={{ $detail['flips'] }} , X={{ $detail['heads'] }} , p={{ $detail['probablity'] }} {{ $lang['21'] }}</p>
                                <p class="col-12 mt-2">\( P({{ $detail['heads'] }}) = \dfrac{ {{ $detail['flips'] }}! }{ {{ $detail['heads'] }}!( {{ $detail['flips'] }} - {{ $detail['heads'] }} )! } \cdot ( {{ $detail['probablity'] }} )^{ {{ $detail['heads'] }} } \cdot (1 - {{ $detail['probablity'] }} )^{ {{ $detail['flips'] }} - {{ $detail['heads'] }} } \)</p>
                                <p class="col-12 mt-2">{{ $lang['17'] }}</p>
                                <p class="col-12 mt-3">$$ P({{ $detail['heads'] }}) = {{ $detail['ans'] }} $$</p>
                                
                                @if ($detail['type'] == "2")
                                    <p class="col-12 mt-3 font-s-20 text-blue">{{ $lang['18'] }}:</p>
                                    <p class="col-12 mt-2">{{ $lang['19'] }}:</p>
                                    <p class="col-12 mt-2">P(X≥{{ $detail['heads'] }}) = 
                                        @for ($i = $detail['heads']; $i <= $detail['flips']; $i++)
                                            P({{ $i }}) @if ($i < $detail['flips']) + @endif
                                        @endfor
                                    </p>
                                    <p class="col-12 mt-2">
                                        P(X≥{{ $detail['heads'] }}) = {{ $detail['ans'] }} + {{ implode(' + ', $detail['array_awa'] ?? []) }}
                                    </p>
                                    <p class="col-12 mt-2">
                                        <span class="text-blue font-s-20">P(X≥{{ $detail['heads'] }}) = {{ round($detail['summer'] + $detail['ans'], 5) }}</span>
                                    </p>
                                @endif
                            @else
                                <p class="col-12 mt-2">$$ P(X) = \dfrac{n!}{X!(n-X)!} \cdot p^X \cdot (1-p)^{n-X} $$</p>
                                <p class="col-12 mt-2">{{ $lang['15'] }} P(0)</p>
                                <p class="col-12 mt-2">{{ $lang['16'] }}: n={{ $detail['flips'] }} , X=0 , p={{ $detail['probablity'] }} {{ $lang['21'] }}</p>
                                <p class="col-12 mt-2">$$ P(0) = \dfrac{ {{ $detail['flips'] }}! }{ 0!( {{ $detail['flips'] }} - 0 )! } \cdot ( {{ $detail['probablity'] }} )^0 \cdot (1 - {{ $detail['probablity'] }} )^{ {{ $detail['flips'] }} - 0 } $$</p>
                                <p class="col-12 mt-2">{{ $lang['17'] }}</p>
                                <p class="col-12 mt-2">$$ P(0) = {{ $detail['ans'] }} $$</p>
                                <p class="col-12 mt-3 font-s-20 text-blue">{{ $lang['18'] }}:</p>
                                <p class="col-12 mt-2">{{ $lang['19'] }}:</p>
                                <p class="col-12 mt-2">P(X≤{{ $detail['heads'] }}) = 
                                    @for ($i = 0; $i <= $detail['heads']; $i++)
                                        P({{ $i }}) @if ($i < $detail['heads']) + @endif
                                    @endfor
                                </p>
                                <p class="col-12 mt-2">
                                    P(X≤{{ $detail['heads'] }}) = {{ implode(' + ', $detail['array_awa'] ?? []) }}
                                </p>
                                <p class="col-12 mt-2">
                                    <span class="text-blue font-s-20">P(X≤{{ $detail['heads'] }}) = {{ round($detail['summer'], 5) }}</span>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    @endpush
</div>
