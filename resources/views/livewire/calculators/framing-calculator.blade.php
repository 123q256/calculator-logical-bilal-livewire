<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 lg:col-span-6 md:col-span-6 space-y-4">
                        <div class="space-y-2">
                            <label for="wall" class="label">{{ $lang['1'] ?? 'Total wall length' }}</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="wall" id="wall" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('wall_unit_dropdown')">{{ $wall_unit }} ▾</label>
                                @if ($showDropdown === 'wall_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["cm", "mm", "m", "in", "ft", "yd"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('wall_unit', '{{ $u }}')">
                                                {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : 'yards (yd)')))) }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="spacing" class="label">{{ $lang['2'] ?? 'On-center spacing' }}</label>
                            <div class="relative w-full">
                                <input type="number" wire:model="spacing" id="spacing" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleOverlay('spacing_unit_dropdown')">{{ $spacing_unit }} ▾</label>
                                @if ($showDropdown === 'spacing_unit_dropdown')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (["cm", "mm", "m", "in", "ft", "yd"] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('spacing_unit', '{{ $u }}')">
                                                {{ $u == 'cm' ? 'centimeters (cm)' : ($u == 'mm' ? 'millimeters (mm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : 'yards (yd)')))) }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="price" class="label">{{ $lang['3'] ?? 'Price per stud' }}</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model="price" id="price" class="input" placeholder="00" />
                                <span class="input_unit text-blue">{{ $currancy }}</span>
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="estimated" class="label">{{ $lang['4'] ?? 'Estimated wastage' }}</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model="estimated" id="estimated" class="input" placeholder="00" />
                                <span class="input_unit text-blue">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-6 md:col-span-6 flex items-center justify-center p-4">
                        <img src="{{ asset('images/framing_length.webp') }}" alt="Framing" class="max-w-full h-auto rounded-lg shadow-sm" style="max-height: 250px;">
                    </div>
                </div>
            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 text-[18px]">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['5'] ?? 'Number of studs' }} :</strong></td>
                                            <td class="border-b py-2">{{ number_format($detail['answer'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b pt-4 pb-2"><strong>{{ $lang['6'] ?? 'Total cost' }} :</strong></td>
                                            <td class="border-b pt-4 pb-2">{{ $currancy . number_format($detail['sub_answer'], 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                                    <p class="font-s-20 mb-3 text-blue"><strong>{{ $lang['7'] ?? 'How to calculate' }}</strong></p>
                                    <p class="mb-2 italic">{{ $lang[8] ?? 'To calculate the number of studs needed' }}.</p>
                                    <p class="mb-2 text-sm bg-white p-2 rounded inline-block border">
                                        {{ $lang['5'] ?? 'Number of studs' }} = ({{ $lang['1'] ?? 'Wall length' }} / {{ $lang['2'] ?? 'Spacing' }}) + 1
                                    </p>
                                    <p class="mt-2">
                                        {{ $lang['5'] ?? 'Number of studs' }} = ({{ $wall }}{{ $wall_unit }} / {{ $spacing }}{{ $spacing_unit }}) + 1 = <strong>{{ number_format($detail['answer'], 2) }}</strong>
                                    </p>
                                    
                                    <p class="mt-4 mb-2 italic border-t pt-4">{{ $lang[9] ?? 'To calculate total cost including wastage' }}.</p>
                                    <p class="mb-2 text-sm bg-white p-2 rounded inline-block border">
                                        {{ $lang['6'] ?? 'Total cost' }} = ({{ $lang['5'] ?? 'Studs' }} * {{ $lang['4'] ?? 'Wastage' }}% * {{ $lang['3'] ?? 'Price' }}) + ({{ $lang['3'] ?? 'Price' }} * {{ $lang['5'] ?? 'Studs' }})
                                    </p>
                                    <p class="mt-2">
                                        {{ $lang['6'] ?? 'Total cost' }} = ({{ number_format($detail['answer'], 2) }} * {{ $estimated }}% * {{ $price }}) + ({{ $price }} * {{ number_format($detail['answer'], 2) }})
                                    </p>
                                    <p class="mt-2 text-lg font-bold text-blue">
                                        {{ $lang['6'] ?? 'Total cost' }} = {{ $currancy }}{{ number_format($detail['sub_answer'], 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
