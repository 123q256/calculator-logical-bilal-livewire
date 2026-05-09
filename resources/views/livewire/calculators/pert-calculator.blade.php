<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-6">
                    
                    <!-- Optimistic -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <div class="grid grid-cols-12 gap-2" x-data="{ unit: $wire.entangle('optimistic_unit') }">
                            <div class="col-span-8">
                                <label class="font-s-14 text-blue">{{ $lang['1'] ?? 'Optimistic' }}:</label>
                                <div class="w-full py-2">
                                    <template x-if="!['yrs/mos', 'wks/days', 'days/hrs'].includes(unit)">
                                        <input type="number" step="any" wire:model.live="optimistic" class="input" />
                                    </template>
                                    <template x-if="['yrs/mos', 'wks/days', 'days/hrs'].includes(unit)">
                                        <div class="grid grid-cols-2 gap-2">
                                            <input type="number" step="any" wire:model.live="optimistic_one" class="input" />
                                            <input type="number" step="any" wire:model.live="optimistic_sec" class="input" />
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label class="font-s-14">&nbsp;</label>
                                <div class="w-full py-2">
                                    <select wire:model.live="optimistic_unit" class="input">
                                        @foreach(['hrs', 'days', 'wks', 'mos', 'yrs', 'yrs/mos', 'wks/days', 'days/hrs'] as $u)
                                            <option value="{{ $u }}">{{ $u }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pessimistic -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <div class="grid grid-cols-12 gap-2" x-data="{ unit: $wire.entangle('pessimistic_unit') }">
                            <div class="col-span-8">
                                <label class="font-s-14 text-blue">{{ $lang['2'] ?? 'Pessimistic' }}:</label>
                                <div class="w-full py-2">
                                    <template x-if="!['yrs/mos', 'wks/days', 'days/hrs'].includes(unit)">
                                        <input type="number" step="any" wire:model.live="pessimistic" class="input" />
                                    </template>
                                    <template x-if="['yrs/mos', 'wks/days', 'days/hrs'].includes(unit)">
                                        <div class="grid grid-cols-2 gap-2">
                                            <input type="number" step="any" wire:model.live="pessimistic_one" class="input" />
                                            <input type="number" step="any" wire:model.live="pessimistic_sec" class="input" />
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label class="font-s-14">&nbsp;</label>
                                <div class="w-full py-2">
                                    <select wire:model.live="pessimistic_unit" class="input">
                                        @foreach(['hrs', 'days', 'wks', 'mos', 'yrs', 'yrs/mos', 'wks/days', 'days/hrs'] as $u)
                                            <option value="{{ $u }}">{{ $u }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Most Likely -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <div class="grid grid-cols-12 gap-2" x-data="{ unit: $wire.entangle('most_unit') }">
                            <div class="col-span-8">
                                <label class="font-s-14 text-blue">{{ $lang['3'] ?? 'Most Likely' }}:</label>
                                <div class="w-full py-2">
                                    <template x-if="!['yrs/mos', 'wks/days', 'days/hrs'].includes(unit)">
                                        <input type="number" step="any" wire:model.live="most" class="input" />
                                    </template>
                                    <template x-if="['yrs/mos', 'wks/days', 'days/hrs'].includes(unit)">
                                        <div class="grid grid-cols-2 gap-2">
                                            <input type="number" step="any" wire:model.live="most_one" class="input" />
                                            <input type="number" step="any" wire:model.live="most_sec" class="input" />
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label class="font-s-14">&nbsp;</label>
                                <div class="w-full py-2">
                                    <select wire:model.live="most_unit" class="input">
                                        @foreach(['hrs', 'days', 'wks', 'mos', 'yrs', 'yrs/mos', 'wks/days', 'days/hrs'] as $u)
                                            <option value="{{ $u }}">{{ $u }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desired -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <div class="grid grid-cols-12 gap-2" x-data="{ unit: $wire.entangle('desired_unit') }">
                            <div class="col-span-8">
                                <label class="font-s-14 text-blue">{{ $lang['4'] ?? 'Desired' }}:</label>
                                <div class="w-full py-2">
                                    <template x-if="!['yrs/mos', 'wks/days', 'days/hrs'].includes(unit)">
                                        <input type="number" step="any" wire:model.live="desired" class="input" />
                                    </template>
                                    <template x-if="['yrs/mos', 'wks/days', 'days/hrs'].includes(unit)">
                                        <div class="grid grid-cols-2 gap-2">
                                            <input type="number" step="any" wire:model.live="desired_one" class="input" />
                                            <input type="number" step="any" wire:model.live="desired_sec" class="input" />
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label class="font-s-14">&nbsp;</label>
                                <div class="w-full py-2">
                                    <select wire:model.live="desired_unit" class="input">
                                        @foreach(['hrs', 'days', 'wks', 'mos', 'yrs', 'yrs/mos', 'wks/days', 'days/hrs'] as $u)
                                            <option value="{{ $u }}">{{ $u }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Output Units -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="output_unit" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Output Unit' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="output_unit" id="output_unit" class="input">
                                @foreach(['hrs', 'days', 'wks', 'mos', 'yrs', 'yrs/mos', 'wks/days', 'days/hrs'] as $u)
                                    <option value="{{ $u }}">{{ $u }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="deviation_unit" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Deviation Unit' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="deviation_unit" id="deviation_unit" class="input">
                                @foreach(['hrs', 'days', 'wks', 'mos', 'yrs', 'yrs/mos', 'wks/days', 'days/hrs'] as $u)
                                    <option value="{{ $u }}">{{ $u }}</option>
                                @endforeach
                            </select>
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
                            <div class="w-full text-[12px] md:text-[16px] lg:text-[16px]">
                                <div class="lg:w-[80%] w-full mt-2 px-2 overflow-auto">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="text-blue py-2 border-b">{{ $lang['7'] }}:</td>
                                            <td class="py-2 border-b"><strong>{{ round($detail['main_answer'], 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b">{{ $lang['8'] }}:</td>
                                            <td class="py-2 border-b"><strong>{{ round($detail['sub_answer'], 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b">{{ $lang['9'] }}:</td>
                                            <td class="py-2 border-b"><strong>{{ round($detail['ans'], 2) }}%</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="overflow-auto">
                                <p class="w-full mt-2 text-[20px]"><strong class="text-blue">{{ $lang['10'] }}</strong></p>
                                <p class="w-full mt-3">{{ $lang['11'] }}.</p>
                                <p class="w-full mt-3">{{ $lang['7'] }} =\(\dfrac{\text{ {{ $lang['1'] }} } +(4 \times \text{ {{ $lang['3'] }} })+ \text{ {{ $lang['2'] }} }}{6} \)</p>
                                <p class="w-full mt-3">{{ $lang['7'] }} =\(\dfrac{ {{ (in_array($optimistic_unit, ['yrs/mos', 'wks/days', 'days/hrs'])) ? round($detail['optimistic'], 4) : $optimistic }} + (4 \times {{ (in_array($most_unit, ['yrs/mos', 'wks/days', 'days/hrs'])) ? round($detail['most'], 4) : $most }}) + {{ (in_array($pessimistic_unit, ['yrs/mos', 'wks/days', 'days/hrs'])) ? round($detail['pessimistic'], 4) : $pessimistic }} }{6} \)</p>
                                
                                <p class="w-full mt-3">{{ $lang['7'] }} =\(\dfrac{ {{ round($detail['add']) }} }{6} \)</p>
                                <p class="w-full mt-3">{{ $lang['7'] }} = {{ round($detail['main_answer'], 2) }}</p>
                                <p class="w-full mt-3">{{ $lang['12'] }}.</p>
                                <p class="w-full mt-3">{{ $lang['8'] }} =\(\dfrac{\text{ {{ $lang['2'] }} } - \text{ {{ $lang['1'] }} }}{6} \)</p>
                                <p class="w-full mt-3">{{ $lang['8'] }} =\(\dfrac{ {{ (in_array($pessimistic_unit, ['yrs/mos', 'wks/days', 'days/hrs'])) ? round($detail['pessimistic'], 4) : $pessimistic }} - {{ (in_array($optimistic_unit, ['yrs/mos', 'wks/days', 'days/hrs'])) ? round($detail['optimistic'], 4) : $optimistic }} }{6} \)</p>
                                
                                <p class="w-full mt-3">{{ $lang['8'] }} = {{ round($detail['sub_answer'], 2) }}</p>
                                <p class="w-full mt-3">{{ $lang['13'] }}.</p>
                                <p class="w-full mt-3 ">{{ $lang['9'] }} =\(\dfrac{\text{ {{ $lang['4'] }} } - \text{ {{ $lang['7'] }} }}{\text{ {{ $lang['8'] }} }}\)</p>
                                <p class="w-full mt-3">{{ $lang['9'] }} =\(\dfrac{ {{ (in_array($desired_unit, ['yrs/mos', 'wks/days', 'days/hrs'])) ? round($detail['desired'], 4) : $desired }} - {{ round($detail['main_answer'], 2) }} }{ {{ round($detail['sub_answer'], 2) }} } \)</p>
                                <p class="w-full mt-3">{{ $lang['9'] }} = {{ round($detail['ans'], 2) }}<span class="black-text font_size18 ">%</span></p>
                            </div>
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
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('math-updated', () => {
                setTimeout(() => {
                    if (typeof renderMathInElement !== 'undefined') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            });
        });
    </script>
@endpush
