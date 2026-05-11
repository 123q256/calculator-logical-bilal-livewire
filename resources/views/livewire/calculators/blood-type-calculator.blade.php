<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    {{-- Parent 1 --}}
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="selection" class="label">{{ $lang['1'] ?? "Mother's Blood Type" }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="selection" id="selection" class="input">
                                <option value="0">O</option>
                                <option value="1">A</option>
                                <option value="2">B</option>
                                <option value="3">AB</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="c_unit" class="label">&nbsp;</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="c_unit" id="c_unit" class="input">
                                <option value="0">Rh+</option>
                                <option value="1">Rh-</option>
                            </select>
                        </div>
                    </div>

                    {{-- Parent 2 --}}
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="selection3" class="label">{!! $lang['2'] ?? "Father's Blood Type" !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="selection3" id="selection3" class="input">
                                <option value="0">O</option>
                                <option value="1">A</option>
                                <option value="2">B</option>
                                <option value="3">AB</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="d_unit" class="label">&nbsp;</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="d_unit" id="d_unit" class="input">
                                <option value="0">Rh+</option>
                                <option value="1">Rh-</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @if ($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-5">
                        <div class="w-full mt-2">
                            <div class="grid grid-cols-12 gap-3">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <span class="text-[18px]">{{ $lang['3'] }} A</span>
                                        <strong class="text-green font-s-25 ps-2">{{ $detail['A'] }} %</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <span class="text-[18px]">{{ $lang['3'] }} B</span>
                                        <strong class="text-green font-s-25 ps-2">{{ $detail['B'] }} %</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <span class="text-[18px]">{{ $lang['3'] }} AB</span>
                                        <strong class="text-green font-s-25 ps-2">{{ $detail['AB'] }} %</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <span class="text-[18px]">{{ $lang['3'] }} O</span>
                                        <strong class="text-green font-s-25 ps-2">{{ $detail['O'] }} %</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <span class="text-[18px]">{{ $lang['3'] }} RH+</span>
                                        <strong class="text-green font-s-25 ps-2">{{ $detail['rhpos'] }} %</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <span class="text-[18px]">{{ $lang['3'] }} RH-</span>
                                        <strong class="text-green font-s-25 ps-2">{{ $detail['rhneg'] }} %</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="my-5 overflow-auto">
                                <table class="w-full md:w-[80%] lg:w-[80%] px-lg-2">
                                    <tr>
                                        <td class="border-b py-3"><strong class="text-blue">{{ $lang['4'] }}</strong></td>
                                        <td class="border-b py-3"><strong class="text-blue">{{ $lang['5'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3">A</td>
                                        <td class="border-b py-3">AO or AA</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3">B</td>
                                        <td class="border-b py-3">BO or BB</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3">AB</td>
                                        <td class="border-b py-3">AB</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3">O</td>
                                        <td class="py-3">OO</td>
                                    </tr>
                                </table>
                            </div>
                            <p class="text-[18px] px-lg-2 mt-2"><strong>{{ $lang['6'] }}</strong> {{ $lang['7'] }}</p>
                            <div class="overflow-auto">
                            <table class="w-full md:w-[80%] lg:w-[80%] px-lg-2">
                                <tr>
                                    <td class="border-b py-3"><strong class="text-blue">♂️\♀️ </strong></td>
                                    <td class="border-b py-3"><strong class="text-blue">A</strong></td>
                                    <td class="border-b py-3"><strong class="text-blue">O</strong></td>
                                    <td class="border-b py-3"><strong class="text-blue">A</strong></td>
                                    <td class="border-b py-3"><strong class="text-blue">A</strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-3">A</td>
                                    <td class="border-b py-3">AO</td>
                                    <td class="border-b py-3">AA</td>
                                    <td class="border-b py-3">AA</td>
                                    <td class="border-b py-3">>AA</td>
                                </tr>
                                <tr>
                                    <td class="py-3">B</td>
                                    <td class="py-3">BB</td>
                                    <td class="py-3">BO</td>
                                    <td class="py-3">AB</td>
                                    <td class="py-3">AB</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
