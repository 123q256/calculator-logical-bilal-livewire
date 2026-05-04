 <div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-6">
                        <label for="total_rent" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2 relative flex items-center">
                            <input type="number" step="any" wire:model.live="total_rent" id="total_rent" class="input pr-10" aria-label="input" />
                            <span class="absolute right-3 text-blue font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="total_area" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                        <div class="w-full py-2 relative flex items-center">
                            <input type="number" step="any" wire:model.live="total_area" id="total_area" class="input pr-16" aria-label="input" />
                            <span class="absolute right-3 text-blue font-semibold">ft<sup>2</sup></span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="bedrooms" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="1" wire:model.live="bedrooms" id="bedrooms" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-12 overflow-auto">
                        <table class="w-full min-w-[500px]" id="rooms">
                            <thead>
                                <tr>
                                    <td class="text-center" width="10%"><strong>{{ $lang[15] }} #</strong></td>
                                    <td class="text-center" width="30%"><strong>{{ $lang[16] }} (ft<sup>2</sup>)</strong></td>
                                    <td class="text-center" width="30%"><strong>{{ $lang[17] }}</strong></td>
                                    <td class="text-center" width="30%"><strong>{{ $lang[18] }}</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= $bedrooms; $i++)
                                    <tr wire:key="room-{{ $i }}">
                                        <td class="text-center">{{ $i }}</td>
                                        <td>
                                            <div class="w-full py-2 relative flex items-center">
                                                <input type="number" step="any" wire:model.live="room_area.{{ $i }}" id="room_area_{{ $i }}" class="input pr-16" aria-label="input" />
                                                <span class="absolute right-3 text-blue font-semibold">ft<sup>2</sup></span>
                                            </div>
                                        </td>
                                        <td class="px-lg-2">
                                            <div class="w-full py-2">
                                                <input type="number" step="1" wire:model.live="persons.{{ $i }}" id="persons_{{ $i }}" class="input" aria-label="input" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="w-full py-2">
                                                <select class="input" wire:model.live="bath.{{ $i }}" id="bath_{{ $i }}">
                                                    <option value="100">{{ $lang[12] }}</option>
                                                    <option value="50">{{ $lang[13] }}</option>
                                                    <option value="0">{{ $lang[14] }}</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
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
                            <div class="row my-2">
                                <div class="w-full lg:w-[80%] overflow-auto text-[18px]">
                                    <table class="w-full">
                                        @foreach ($detail['room_rent'] as $key => $val)
                                            <tr>
                                                <td width="60%" class="border-b py-2"><strong>{{ $lang[10] }} {{ $key }} {{ $lang[11] }}</strong></td>
                                                <td class="border-b py-2">{{ $currancy }} {{ number_format($val, 4) }}</td>
                                            </tr>
                                        @endforeach
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
