<div x-data x-on:math-updated.window="
    $nextTick(() => {
        setTimeout(() => {
            if (typeof renderMathInElement !== 'undefined') {
                renderMathInElement($el);
            }
        }, 50);
    });
" x-init="
    setTimeout(() => {
        if (typeof renderMathInElement !== 'undefined') {
            renderMathInElement($el);
        }
    }, 100);
">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 px-2">
                        <label for="optionSelect" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Select Operation' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="optionSelect" id="optionSelect" class="input" autocomplete="off">
                                <option value="addition">Addition</option>
                                <option value="subtraction">Subtraction</option>
                                <option value="multiplication">Multiplication</option>
                                <option value="division">Division</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-span-12 py-4 bg-gray-50 rounded-lg border border-gray-100" wire:key="formula-display-{{ $optionSelect }}">
                        @if($optionSelect === 'addition')
                            <p class="w-full mt-2 text-center text-[18px]">\( Z = X + Y \)</p>
                            <p class="w-full my-3 text-center text-[18px]">\( ΔZ = \sqrt{(ΔX)^2 + (ΔY)^2} \)</p>
                        @elseif($optionSelect === 'subtraction')
                            <p class="w-full mt-2 text-center text-[18px]">\( Z = X - Y \)</p>
                            <p class="w-full my-3 text-center text-[18px]">\( ΔZ = \sqrt{(ΔX)^2 + (ΔY)^2} \)</p>
                        @elseif($optionSelect === 'multiplication')
                            <p class="w-full mt-2 text-center text-[18px]">\( Z = X \cdot Y \)</p>
                            <p class="w-full my-3 text-center text-[18px]">\( ΔZ = Z \cdot \sqrt{(\frac{ΔX}{X})^2 + (\frac{ΔY}{Y})^2} \)</p>
                        @elseif($optionSelect === 'division')
                            <p class="w-full mt-2 text-center text-[18px]">\( Z = \frac{X}{Y} \)</p>
                            <p class="w-full my-3 text-center text-[18px]">\( ΔZ = Z \cdot \sqrt{(\frac{ΔX}{X})^2 + (\frac{ΔY}{Y})^2} \)</p>
                        @endif
                    </div>

                    <div class="col-span-6 px-2">
                        <label for="x" class="font-s-14 text-blue">{{ $lang[2] ?? 'Value X' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="x" id="x" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 px-2">
                        <label for="delta_x" class="font-s-14 text-blue">{{ $lang[3] ?? 'Error ΔX' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="delta_x" id="delta_x" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 px-2">
                        <label for="y" class="font-s-14 text-blue">{{ $lang[4] ?? 'Value Y' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="y" id="y" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 px-2">
                        <label for="delta_y" class="font-s-14 text-blue">{{ $lang[5] ?? 'Error ΔY' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="delta_y" id="delta_y" class="input" aria-label="input" placeholder="00" />
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
                            <div class="w-full">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                    <table class="w-fill text-[20px]">
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['6'] ?? 'Value Z' }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ $detail['z'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['7'] ?? 'Error ΔZ' }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['delta_z'] ,2) }}</strong></td>
                                        </tr>                        
                                    </table>
                                </div>
                                <p class="w-full mt-3 text-[20px]"><strong class="text-blue">{{ $lang['8'] ?? 'Input Data' }}</strong></p>
                                <p class="w-full mt-2">{{ $lang['2'] ?? 'Value X' }} : {{ $x }}</p>
                                <p class="w-full mt-2">{{ $lang['3'] ?? 'Error ΔX' }} : {{ $delta_x }}</p>
                                <p class="w-full mt-2">{{ $lang['4'] ?? 'Value Y' }} : {{ $y }}</p>
                                <p class="w-full mt-2">{{ $lang['5'] ?? 'Error ΔY' }} : {{ $delta_y }}</p>
                    
                                <!-- -------------------------- Solution ----------------------- -->
                                <p class="w-full mt-3 text-[20px]"><strong class="text-blue">{{ $lang['9'] ?? 'Solution' }}</strong></p>
                    
                                @if($optionSelect === 'addition')
                                    <p class="w-full mt-2">{{ $lang['10'] ?? 'For addition, the result is calculated as:' }}</p>
                                    <p class="w-full mt-3">\( Z = X + Y = {{ $x }} + {{ $y }} = {{ $detail['z'] }} \)</p>
                                    <p class="w-full mt-3">\( ΔZ = \sqrt{(ΔX)^2 + (ΔY)^2} = \sqrt{({{ $delta_x }})^2 + ({{ $delta_y }})^2} = {{ round($detail['delta_z'], 2) }} \)</p>
                                @elseif($optionSelect === 'subtraction')
                                    <p class="w-full mt-2">{{ $lang['11'] ?? 'For subtraction, the result is calculated as:' }}</p>
                                    <p class="w-full mt-3">\( Z = X - Y = {{ $x }} - {{ $y }} = {{ $detail['z'] }} \)</p>
                                    <p class="w-full mt-3">\( ΔZ = \sqrt{(ΔX)^2 + (ΔY)^2} = \sqrt{({{ $delta_x }})^2 + ({{ $delta_y }})^2} = {{ round($detail['delta_z'], 2) }} \)</p>
                                @elseif($optionSelect === 'multiplication')
                                    <p class="w-full mt-2">{{ $lang['12'] ?? 'For multiplication, the result is calculated as:' }}</p>
                                    <p class="w-full mt-3">\( Z = X \cdot Y = {{ $x }} \cdot {{ $y }} = {{ $detail['z'] }} \)</p>
                                    <p class="w-full mt-3">\( ΔZ = Z \cdot \sqrt{(\frac{ΔX}{X})^2 + (\frac{ΔY}{Y})^2} = {{ $detail['z'] }} \cdot \sqrt{(\frac{ {{ $delta_x }} }{ {{ $x }} })^2 + (\frac{ {{ $delta_y }} }{ {{ $y }} })^2} = {{ round($detail['delta_z'], 2) }} \)</p>
                                @elseif($optionSelect === 'division')      
                                    <p class="w-full mt-2">{{ $lang['13'] ?? 'For division, the result is calculated as:' }}</p>
                                    <p class="w-full mt-3">\( Z = \frac{X}{Y} = \frac{ {{ $x }} }{ {{ $y }} } = {{ $detail['z'] }} \)</p>
                                    <p class="w-full mt-3">\( ΔZ = Z \cdot \sqrt{(\frac{ΔX}{X})^2 + (\frac{ΔY}{Y})^2} = {{ $detail['z'] }} \cdot \sqrt{(\frac{ {{ $delta_x }} }{ {{ $x }} })^2 + (\frac{ {{ $delta_y }} }{ {{ $y }} })^2} = {{ round($detail['delta_z'], 2) }} \)</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>

@push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
@endpush
