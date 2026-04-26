<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <!-- Mode Selection -->
                    <div class="space-y-2 relative">
                        <label for="cal" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                        <select wire:model.live="cal" id="cal" class="input">
                            <option value="c1">{!! $lang['2'] !!} ({!! $lang['3'] !!}) (C₁)</option>
                            <option value="v1">{!! $lang['4'] !!} ({!! $lang['3'] !!}) (V₁)</option>
                            <option value="c2">{!! $lang['2'] !!} ({!! $lang['5'] !!}) (C₂)</option>
                            <option value="v2">{!! $lang['4'] !!} ({!! $lang['5'] !!}) (V₂)</option>
                        </select>
                    </div>

                    @if($cal !== 'c1')
                        <!-- C1 -->
                        <div class="space-y-2 c1">
                            <label for="c1" class="font-s-14 text-blue">{{ $lang['2'] }} 1:</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="c1" id="c1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('c1_unit_dropdown')">{{ $c1_unit }} ▾</label>
                                @if ($showDropdown === 'c1_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['fM', 'pM', 'nM', 'μM', 'mM', 'M'] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('c1_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($cal !== 'v1')
                        <!-- V1 -->
                        <div class="space-y-2 v1">
                            <label for="v1" class="font-s-14 text-blue">{{ $lang['4'] }} 1:</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="v1" id="v1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('v1_unit_dropdown')">{{ $v1_unit }} ▾</label>
                                @if ($showDropdown === 'v1_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['nL', 'μL', 'mL', 'L'] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('v1_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($cal !== 'c2')
                        <!-- C2 -->
                        <div class="space-y-2 c2">
                            <label for="c2" class="font-s-14 text-blue">{{ $lang['2'] }} 2:</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="c2" id="c2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('c2_unit_dropdown')">{{ $c2_unit }} ▾</label>
                                @if ($showDropdown === 'c2_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['fM', 'pM', 'nM', 'μM', 'mM', 'M'] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('c2_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($cal !== 'v2')
                        <!-- V2 -->
                        <div class="space-y-2 v2">
                            <label for="v2" class="font-s-14 text-blue">{{ $lang['4'] }} 2:</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="v2" id="v2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('v2_unit_dropdown')">{{ $v2_unit }} ▾</label>
                                @if ($showDropdown === 'v2_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['nL', 'μL', 'mL', 'L'] as $unit)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('v2_unit', '{{ $unit }}')">{{ $unit }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-center gap-4">
                @if ($type == 'calculator')
                    @include('inc.button')
                @else
                    @include('inc.widget-button')
                @endif
            </div>
        </div>

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full result p-3 radius-10 mt-3">
                            @php
                                $ans = $detail['ans'];
                                if($cal === 'c1'){
                                    $head = $lang['6']." (".$lang['3'].")";
                                } elseif($cal === 'v1'){
                                    $head = $lang['4']." (".$lang['3'].")";
                                } elseif($cal === 'c2'){
                                    $head = $lang['6']." (".$lang['5'].")";
                                } elseif($cal === 'v2'){
                                    $head = $lang['4']." (".$lang['5'].")";
                                }
                            @endphp
                            <div class="w-full">
                                <p class=""><strong>{{ $head }}</strong></p>
                                <p class=""><strong class="text-green lg:text-[32px] md:text-[24px] text-[20px]">{!! $ans !!}</strong></p>
                                <p class="my-2"><strong>{{ $lang['6'] }}</strong></p>
                                <div class=" w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        @if($cal === 'c1' || $cal === 'c2')
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_fm'] }}</strong></td></tr>
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_pm'] }}</strong></td></tr>
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_nm'] }}</strong></td></tr>
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_um'] }}</strong></td></tr>
                                            <tr><td class="py-2">{{ $head }}</td><td class='py-2'><strong>{{ $detail['ans_m'] }}</strong></td></tr>
                                        @elseif($cal === 'v1' || $cal === 'v2')
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_nl'] }}</strong></td></tr>
                                            <tr><td class="border-b py-2">{{ $head }}</td><td class='border-b py-2'><strong>{{ $detail['ans_ul'] }}</strong></td></tr>
                                            <tr><td class="py-2">{{ $head }}</td><td class='py-2'><strong>{{ $detail['ans_l'] }}</strong></td></tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
