<div>
    <form wire:submit.prevent="calculate">
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
                @if ($error)
                    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
                @endif
                <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                    <div class="grid grid-cols-12 mt-3 gap-4">
                        @foreach($forces as $index => $force)
                        <div class="col-span-12 relative">
                            <div class="grid grid-cols-12 gap-4">
                                <p class="col-span-12 text-[18px] px-2 mt-2 flex justify-between items-center">
                                    <strong># {{ $index + 1 }}</strong>
                                    @if(count($forces) > 2)
                                    <img src="{{url('assets/img/close.png')}}" alt="Remove" wire:click="removeForce({{ $index }})" width='13' class="cursor-pointer" style="filter: invert(18%) sepia(85%) saturate(7467%) hue-rotate(358deg) brightness(101%) contrast(115%);">
                                    @endif
                                </p>
                                <div class="col-span-6 px-2">
                                    <label for="force{{ $index }}" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model="forces.{{ $index }}" id="force{{ $index }}" class="input" placeholder="00" />
                                        <span class="text-blue input_unit">N</span>
                                    </div>
                                </div>
                                <div class="col-span-6 px-2">
                                    <label for="angle{{ $index }}" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model="angles.{{ $index }}" id="angle{{ $index }}" class="input" placeholder="00" />
                                        <span class="text-blue input_unit">deg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-span-12 flex justify-end px-2 mt-3">
                            <button type="button" wire:click="addForce" class="bg-[#2845F5] text-white border rounded px-4 py-1">
                                <strong class="text-blue"><span class="text-[18px] text-blue">+</span> &nbsp;Add</strong>
                            </button>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full md:w-[60%] lg:w-[60%] px-2 overflow-auto">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['4'] }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Horizontal'], 2) }} N</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['5'] }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Vertical'], 2) }} N</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['6'] }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Magnitude'], 2) }} N</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['7'] }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Direction'], 2) }} °</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="col-12 mt-3 px-2"><strong>{{ $lang['8'] }}</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%] px-2 overflow-auto">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['9'] }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Magnitude'] * 0.001, 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['10'] }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Magnitude'] * 0.2248, 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b">{{ $lang['11'] }}</td>
                                            <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['Magnitude'] * 100000, 2) }}</strong></td>
                                        </tr>
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
