<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
                <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                    <div class="col-lg-2 py-2 font-s-14">{{ $lang['to_calc'] }}:</div>
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $method == '1' ? 'bg-blue-600 text-white' : 'bg-white hover:bg-blue-50' }}"
                                wire:click="setMethod('1')">
                                {{ $lang['ave_vel'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $method == '2' ? 'bg-blue-600 text-white' : 'bg-white hover:bg-blue-50' }}"
                                wire:click="setMethod('2')">
                                {{ $lang['iv'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 {{ $method == '3' ? 'bg-blue-600 text-white' : 'bg-white hover:bg-blue-50' }}"
                                wire:click="setMethod('3')">
                                {{ $lang['fv'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="font-s-14 text-blue">
                            @if($method == '1') {{ $lang['iv'] }} @else {{ $lang['ave_vel'] }} @endif:
                        </label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="x" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('iv_dropdown')">{{ $iv }} ▾</label>
                            @if($openDropdown === 'iv_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['m/s', 'ft/s', 'km/h', 'km/s', 'mi/s', 'mph'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('iv', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="font-s-14 text-blue">
                            @if($method == '1' || $method == '2') {{ $lang['fv'] }} @else {{ $lang['iv'] }} @endif:
                        </label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="y" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('fv_dropdown')">{{ $fv }} ▾</label>
                            @if($openDropdown === 'fv_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['m/s', 'ft/s', 'km/h', 'km/s', 'mi/s', 'mph'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('fv', '{{ $u }}')">{{ $u }}</p>
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
    </form>

    <hr>

    @isset($detail)
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full text-center text-[20px]">
                        @if($method == '1')
                            <p>{{ $lang['ave_vel'] }}</p>
                        @elseif($method == '2')
                            <p>{{ $lang['iv'] }}</p>
                        @elseif($method == '3')
                            <p>{{ $lang['fv'] }}</p>
                        @endif
                        <p class="my-3">
                            <strong class="bg-[#2845F5] px-4 py-2 text-[25px] text-white rounded-lg shadow-md inline-block">
                                {{ $detail['ave'] }}
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</div>
