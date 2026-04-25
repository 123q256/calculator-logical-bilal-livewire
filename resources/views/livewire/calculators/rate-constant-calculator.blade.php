<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                {{-- Reaction Type Selection --}}
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2 relative">
                        <label class="label font-bold text-blue uppercase text-xs tracking-wider">{!! $lang['1'] ?? 'ELEMENTARY STEP::' !!}:</label>
                        <select wire:model.live="unit_x" class="input border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none bg-white">
                            <option value="uni">{!! $lang['5'] ?? 'Unimolecular' !!}</option>
                            <option value="bi">{!! $lang['6'] ?? 'Bimolecular' !!}</option>
                            <option value="tri">{!! $lang['7'] ?? 'Termolecular' !!}</option>
                        </select>
                    </div>
                </div>

                {{-- Equation Display --}}
                <div class="text-center my-6 p-4 bg-gray-50 rounded-lg border border-gray-100">
                    @if($unit_x == 'uni')
                        <p class="text-xl"><strong>rate = K [A] @if($module_x == '2') <sup>2</sup> @endif</strong></p>
                    @elseif($unit_x == 'bi')
                        <p class="text-xl"><strong>rate = K [A] @if($module_x == '2') <sup>2</sup> @endif [B] @if($module_y == '2') <sup>2</sup> @endif</strong></p>
                    @elseif($unit_x == 'tri')
                        <p class="text-xl"><strong>rate = K [A] @if($module_x == '2') <sup>2</sup> @endif [B] @if($module_y == '2') <sup>2</sup> @endif [C] @if($module_z == '2') <sup>2</sup> @endif</strong></p>
                    @endif
                </div>

                {{-- Component A --}}
                <div class="space-y-6">
                    <div class="bg-white">
                        <p class="font-bold text-blue mb-4 text-sm border-b pb-2 uppercase">COMPONENT [A]</p>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <label class="label text-sm font-medium">{!! $lang['4'] ?? 'Order Of Reaction (Molecule A):' !!}:</label>
                                <select wire:model.live="module_x" class="input border border-gray-300 p-3 rounded-lg w-full outline-none mt-1 bg-white">
                                    @if($unit_x == 'uni')
                                        <option value="0">{!! $lang['8'] ?? 'Zero' !!}</option>
                                    @endif
                                    <option value="1">{!! $lang['9'] ?? 'First' !!}</option>
                                    <option value="2">{!! $lang['10'] ?? 'Second' !!}</option>
                                </select>
                            </div>
                            <div class="col-span-6">
                                <label class="label text-sm font-medium">{{ $lang['11'] ?? 'Concentration [A]' }}:</label>
                                <div class="relative w-full mt-1">
                                    <input type="number" step="any" wire:model.live="con_a" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('unit_a_dropdown')">
                                        {{ $unit_a }} ▾
                                    </label>
                                    @if ($showDropdown === 'unit_a_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[80px]">
                                            @foreach(['M', 'mM', 'μM', 'nM'] as $unit)
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('unit_a', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label class="label text-sm font-medium">{{ $lang['12'] ?? 'Half life T1/2' }}:</label>
                                <div class="relative w-full mt-1">
                                    <input type="number" step="any" wire:model.live="half_a" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('time_a_dropdown')">
                                        {{ $time_a }} ▾
                                    </label>
                                    @if ($showDropdown === 'time_a_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto min-w-[100px]">
                                            @foreach(['μs', 'ms', 'sec', 'min', 'min/sec', 'hrs'] as $unit)
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('time_a', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Component B --}}
                    @if($unit_x == 'bi' || $unit_x == 'tri')
                    <div class="bg-white">
                        <p class="font-bold text-blue mb-4 text-sm border-b pb-2 uppercase">COMPONENT [B]</p>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <label class="label text-sm font-medium">{!! $lang['13'] ?? 'Order Of Reaction (Molecule B):' !!}:</label>
                                <select wire:model.live="module_y" class="input border border-gray-300 p-3 rounded-lg w-full outline-none mt-1 bg-white">
                                    <option value="1">{!! $lang['9'] ?? 'First' !!}</option>
                                    <option value="2">{!! $lang['10'] ?? 'Second' !!}</option>
                                </select>
                            </div>
                            <div class="col-span-6">
                                <label class="label text-sm font-medium">{{ $lang['14'] ?? 'Concentration [B]' }}:</label>
                                <div class="relative w-full mt-1">
                                    <input type="number" step="any" wire:model.live="con_b" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('unit_b_dropdown')">
                                        {{ $unit_b }} ▾
                                    </label>
                                    @if ($showDropdown === 'unit_b_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[80px]">
                                            @foreach(['M', 'mM', 'μM', 'nM'] as $unit)
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('unit_b', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label class="label text-sm font-medium">{{ $lang['12'] ?? 'Half life T1/2' }}:</label>
                                <div class="relative w-full mt-1">
                                    <input type="number" step="any" wire:model.live="half_b" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('time_b_dropdown')">
                                        {{ $time_b }} ▾
                                    </label>
                                    @if ($showDropdown === 'time_b_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto min-w-[100px]">
                                            @foreach(['μs', 'ms', 'sec', 'min', 'min/sec', 'hrs'] as $unit)
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('time_b', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($unit_x == 'tri')
                    <div class="bg-white">
                        <p class="font-bold text-blue mb-4 text-sm border-b pb-2 uppercase">COMPONENT [C]</p>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <label class="label text-sm font-medium">{!! $lang['15'] ?? 'Order Of Reaction (Molecule C):' !!}:</label>
                                <select wire:model.live="module_z" class="input border border-gray-300 p-3 rounded-lg w-full outline-none mt-1 bg-white">
                                    <option value="1">{!! $lang['9'] ?? 'First' !!}</option>
                                    <option value="2">{!! $lang['10'] ?? 'Second' !!}</option>
                                </select>
                            </div>
                            <div class="col-span-6">
                                <label class="label text-sm font-medium">{{ $lang['16'] ?? 'Concentration [C]' }}:</label>
                                <div class="relative w-full mt-1">
                                    <input type="number" step="any" wire:model.live="con_c" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('unit_c_dropdown')">
                                        {{ $unit_c }} ▾
                                    </label>
                                    @if ($showDropdown === 'unit_c_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[80px]">
                                            @foreach(['M', 'mM', 'μM', 'nM'] as $unit)
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('unit_c', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label class="label text-sm font-medium">{{ $lang['12'] ?? 'Half life T1/2' }}:</label>
                                <div class="relative w-full mt-1">
                                    <input type="number" step="any" wire:model.live="half_c" class="border border-gray-300 p-3 rounded-lg focus:ring-2 w-full outline-none" placeholder="00">
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4 font-bold" wire:click="toggleOverlay('time_c_dropdown')">
                                        {{ $time_c }} ▾
                                    </label>
                                    @if ($showDropdown === 'time_c_dropdown')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-48 overflow-y-auto min-w-[100px]">
                                            @foreach(['μs', 'ms', 'sec', 'min', 'min/sec', 'hrs'] as $unit)
                                                <p class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('time_c', '{{ $unit }}')">{{ $unit }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="flex justify-center items-center space-x-4 mt-8">
                    @if ($type == 'calculator')
                        @include('inc.button')
                    @elseif ($type == 'widget')
                        @include('inc.widget-button')
                    @endif
                </div>
            </div>
        </div>

        <hr>

        @if($detail)
            <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="bg-light-blue p-6 radius-10 border border-blue/10 text-center">
                            <p class="font-bold text-blue tracking-wide uppercase text-xs mb-1">{!! $lang['17'] ?? 'Rate Constant' !!} (K):</p>
                            <p class="font-black text-[32px] text-green">
                                {{ round($detail['k_res'], 5) }}
                                <span class="text-sm font-bold text-gray-500 ml-1">sec<sup>-1</sup></span>
                            </p>
                        </div>
                        <div class="bg-light-blue p-6 radius-10 border border-blue/10 text-center">
                            <p class="font-bold text-blue tracking-wide uppercase text-xs mb-1">{!! $lang['18'] ?? 'Initial Reaction Rate' !!}:</p>
                            <p class="font-black text-[32px] text-green">
                                {{ round($detail['rate_res'], 5) }}
                                <span class="text-sm font-bold text-gray-500 ml-1">M s<sup>-1</sup></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
