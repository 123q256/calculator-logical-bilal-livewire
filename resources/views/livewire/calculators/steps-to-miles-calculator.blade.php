<div>
  <style>
    .content table, .content th, .content td {
        border: 1px solid #9f9d9d;
        border-collapse: collapse;
        padding: 5px;
        text-align: center;
    }
    .content table tr:hover td {
        color: #fff !important;
        background-color: rgb(0, 0, 0) !important;
    }
</style>
<form class="row" wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="methods" class="font-s-14 text-blue">Methods:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="methods" id="methods" class="input">
                            <option value="1">Average Stride Length</option>
                            <option value="2">Your Height</option>
                            <option value="3">Your Stride Length</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="sex" class="font-s-14 text-blue">Gender:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="sex" id="sex" class="input">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="first" class="font-s-14 text-blue">Your Height:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="first" id="first" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                            {{ $unit }} ▾
                        </label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                            @foreach(['cm' => 'centimeters (cm)', 'dm' => 'decimeters (dm)', 'm' => 'meters (m)', 'in' => 'inches (in)', 'ft' => 'feet (ft)', 'mi' => 'miles (mi)'] as $val => $label)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', '{{ $val }}'); open = false">{{ $label }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="steps" class="font-s-14 text-blue">Steps:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" wire:model.live="steps" id="steps" class="input" aria-label="input" placeholder="00" />
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

    @if($detail)
    <hr>
        <div id="result-section" wire:key="result-{{ rand() }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full p-3 mt-3">
                        <div class="col-12 text-center">
                            <p><strong>Distance</strong></p>
                            <p>
                                <strong class="text-[32px] text-green-700">{{ round($detail['answer'], 6) }}</strong>
                                <strong class="text-[18px] text-blue-700">(mi)</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>
</div>
