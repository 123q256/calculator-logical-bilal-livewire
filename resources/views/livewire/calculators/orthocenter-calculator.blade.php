<div x-data="{
    x1: @entangle('x1').live,
    y1: @entangle('y1').live,
    x2: @entangle('x2').live,
    y2: @entangle('y2').live,
    x3: @entangle('x3').live,
    y3: @entangle('y3').live
}">
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif

        <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                
                <!-- Point A -->
                <p class="col-span-12"><strong>{{ $lang[1] ?? 'Point' }} A:</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="x1" class="font-s-14 text-blue">x₁</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x1" id="x1" class="input" x-model="x1" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="y1" class="font-s-14 text-blue">y₁</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="y1" id="y1" class="input" x-model="y1" aria-label="input"/>
                    </div>
                </div>

                <!-- Point B -->
                <p class="col-span-12"><strong>{{ $lang[1] ?? 'Point' }} B:</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="x2" class="font-s-14 text-blue">x₂</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x2" id="x2" class="input" x-model="x2" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="y2" class="font-s-14 text-blue">y₂</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="y2" id="y2" class="input" x-model="y2" aria-label="input"/>
                    </div>
                </div>

                <!-- Point C -->
                <p class="col-span-12"><strong>{{ $lang[1] ?? 'Point' }} C:</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="x3" class="font-s-14 text-blue">x₃</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x3" id="x3" class="input" x-model="x3" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="y3" class="font-s-14 text-blue">y₃</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="y3" id="y3" class="input" x-model="y3" aria-label="input"/>
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

    @isset($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div>
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full lg:w-[80%] mt-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>x = </strong></td>
                                        <td class="py-2 border-b">{{ $detail['x'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>y = </strong></td>
                                        <td class="py-2 border-b">{{ $detail['y'] }}</td>
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
