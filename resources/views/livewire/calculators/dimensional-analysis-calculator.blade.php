<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    {{-- Quantity 1 --}}
                    <div class="col-span-12 ">
                        <label for="pq1" class="font-s-14 text-blue">{{ $lang['1'] }} 1</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="pq1" step="any" min="1"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click.stop="toggleDropdown('pq1_unit')">{{ $pq1_unit }} ▾</label>
                            @if ($openDropdown === 'pq1_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi', 'fur'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            wire:click.stop="setUnit('pq1_unit', '{{ $unit }}')">{{ $unit }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Quantity 2 --}}
                    <div class="col-span-12 ">
                        <label for="pq2" class="font-s-14 text-blue">{{ $lang['1'] }} 2</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="pq2" step="any" min="1"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click.stop="toggleDropdown('pq2_unit')">{{ $pq2_unit }} ▾</label>
                            @if ($openDropdown === 'pq2_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi', 'fur'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                            wire:click.stop="setUnit('pq2_unit', '{{ $unit }}')">{{ $unit }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif
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

        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2 overflow-x-auto">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>{{ $lang[3] }} </strong></td>
                                        <td class="py-2 border-b"> {{ $detail['upr'] }} : {{ $detail['btm'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>{{ $lang['1'] }} 1
                                                {{ $lang['9'] }} </strong></td>
                                        <td class="py-2 border-b"> <span>{{ $detail['res'] }}</span> {{ $lang['2'] }}
                                            {{ $lang['1'] }} 2</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>{{ $lang['1'] }} 2
                                                {{ $lang['9'] }} </strong></td>
                                        <td class="py-2 border-b"> <span>{{ $detail['res1'] }}</span> {{ $lang['2'] }}
                                            {{ $lang['1'] }} 1</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12  text-[16px]">
                                <p class="mt-4"><b>{{ $lang['4'] }}:</b></p>
                                <div class="mt-2" wire:ignore wire:key="steps-{{ md5(json_encode($detail)) }}">
                                    @if (isset($detail['check']))
                                        <p class="mt-2"><strong>{{ $lang['6'] }}</strong>
                                            {{ $detail['pq1'] . ' : ' . $detail['pq2'] }}</p>
                                    @else
                                        @if (isset($detail['cnvrt1']))
                                            <p class="mt-2"><strong>{{ $lang['7'] }}</strong></p>
                                            <p class="mt-2">{{ $lang['1'] }} 1 = {{ $detail['cnvrt1'] }}</p>
                                            <p class="mt-2"><strong>{{ $lang['6'] }}</strong>
                                                {{ $detail['cnvrt1'] . ' : ' . $detail['pq2'] }}</p>
                                        @else
                                            <p class="mt-2"><strong>{{ $lang['7'] }}</strong></p>
                                            <p class="mt-2">{{ $lang['1'] }} 2 = {{ $detail['cnvrt2'] }}</p>
                                            <p class="mt-2"><strong>{{ $lang['6'] }}</strong>
                                                {{ $detail['pq1'] . ' : ' . $detail['cnvrt2'] }}</p>
                                        @endif
                                    @endif
                                    <p class="mt-2"><strong>{{ $lang['8'] }}</strong>
                                        {{ $detail['upr'] . ' : ' . $detail['btm'] }}</p>
                                </div>
                                <div class="col-12 text-center mt-[20px]">
                                    <button type="button" wire:click="resetForm"
                                        class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3">
                                        RE-CALCULATE
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
