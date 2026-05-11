<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Gender --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="gender" class="font-s-14 text-blue">{!! $lang['gen'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="gender" id="gender" class="input">
                                <option value="male">{{ $lang['male'] }}</option>
                                <option value="female">{{ $lang['female'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Waist Circumference --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="w" class="font-s-14 text-blue">{{ $lang['w'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="w" id="w" step="any" class="input pr-12" placeholder="00" />
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                    {{ $unit }} ▾
                                </button>
                            </div>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit', 'in'); open = false">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit', 'cm'); open = false">centimeters (cm)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Hip Circumference --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="h" class="font-s-14 text-blue">{{ $lang['h'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="h" id="h" step="any" class="input pr-12" placeholder="00" />
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                    {{ $unit1 }} ▾
                                </button>
                            </div>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit1', 'in'); open = false">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit1', 'cm'); open = false">centimeters (cm)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <p class="w-full text-[20px] mt-2"><strong>{{ $lang['ans'] }}</strong></p>
                                <p class="w-full flex items-center mt-2">
                                    <img src="{{ asset('images/waist.png') }}" width="55" height="55" alt="waist to hip ratio calculator">
                                    @if(isset($detail['ans']))
                                        <strong class="text-green-700 text-[32px] ms-3">{{ $detail['ans'] }}</strong>
                                    @else
                                        <strong class="text-green-700 text-[32px] ms-3">00.0</strong>
                                    @endif
                                </p>

                                @if(($detail['request']->gender ?? '') == 'male')
                                    <div class="lg:w-[70%] md:w-[70%] w-full overflow-auto grid-cols-1">
                                        <table class="w-full mt-3">
                                            <thead>
                                                <tr>
                                                    <th class="text-start text-blue-600 border-b py-2">{{ $lang['male'] }}</th>
                                                    <th class="text-start text-blue-600 border-b py-2">{{ $lang['hr'] }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-b py-2">0.95 {{ $lang['ol'] }}</td>
                                                    <td class="border-b py-2">{{ $lang['lhr'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">0.96 to 1.0</td>
                                                    <td class="border-b py-2">{{ $lang['mr'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2">1.0 {{ $lang['oh'] }}</td>
                                                    <td class="py-2">{{ $lang['hhr'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="w-full mt-2"><strong>0.9 {{ $lang['men'] }}</strong></p>
                                @elseif(($detail['request']->gender ?? '') == 'female')
                                    <div class="lg:w-[70%] md:w-[70%] w-full overflow-auto grid-cols-1">
                                        <table class="w-full mt-3">
                                            <thead>
                                                <tr>
                                                    <th class="text-start text-blue-600 border-b py-2">{{ $lang['female'] }}</th>
                                                    <th class="text-start text-blue-600 border-b py-2">{{ $lang['hr'] }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-b py-2">0.80 {{ $lang['ol'] }}</td>
                                                    <td class="border-b py-2">{{ $lang['lhr'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">0.81 to 0.84</td>
                                                    <td class="border-b py-2">{{ $lang['mr'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2">0.85 {{ $lang['oh'] }}</td>
                                                    <td class="py-2">{{ $lang['hhr'] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="w-full mt-2"><strong>0.85 {{ $lang['women'] }}</strong></p>
                                @endif

                                <p class="text-start text-[20px] mt-6"><strong class="text-blue-600">{{ $lang['whc'] }}</strong></p>
                                <div class="lg:w-[70%] md:w-[70%] w-full overflow-auto grid-cols-1">
                                    <table class="w-full mt-2 border" cellspacing="0">
                                        <thead>
                                            <tr class="bg-[#2845F5] text-white">
                                                <td class="py-3 ps-3">{{ $lang['gen'] }}</td>
                                                <td class="py-3">{{ $lang['health'] }}</td>
                                                <td class="py-3">{{ $lang['inc'] }}</td>
                                                <td class="py-3">{{ $lang['hhr'] }}</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(($detail['request']->gender ?? '') == 'female')
                                                <tr>
                                                    <td class="py-3 ps-3">{{ $lang['female'] }}</td>
                                                    <td class="py-3">80 cm {{ $lang['orl'] }}</td>
                                                    <td class="py-3">from 80 to 88 cm</td>
                                                    <td class="py-3">88 cm {{ $lang['oo'] }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="py-3 ps-3">{{ $lang['male'] }}</td>
                                                    <td class="py-3">90 cm {{ $lang['orl'] }}</td>
                                                    <td class="py-3">from 90 to 102 cm</td>
                                                    <td class="py-3">102 cm {{ $lang['oo'] }}</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
