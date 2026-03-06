<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
       

            <div class="lg:w-[80%] md:w-[90%] w-full mx-auto space-y-4">

                {{-- Row 1: Full width select --}}
                <div class="grid grid-cols-1">
                    <div class="space-y-2 relative">
                        <label for="method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select class="input" wire:model="method" wire:change="changeMethod" name="method"
                            id="method">
                            <option value="1">{{ $lang['2'] }}</option>
                            <option value="2">{{ $lang['3'] }}</option>
                        </select>
                    </div>
                </div>

                {{-- Row 2: Two columns --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="year" class="font-s-14 text-blue cat">
                            @if ($method === '2')
                                {{ $lang['5'] }}
                            @else
                                {{ $lang['4'] }}
                            @endif
                            ({{ $lang['6'] }})
                            :
                        </label>
                        <input type="number" wire:model="year" id="year" class="input" aria-label="input" />
                    </div>

                    <div class="space-y-2">
                        <label for="month" class="font-s-14 text-blue">({{ $lang['7'] }}):</label>
                        <input type="number" wire:model="month" id="month" class="input" aria-label="input" />
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
        <hr style="height: 1px; background-color: #e5e7eb;">
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full bg-light-blue result p-3 rounded-lg mt-3">
                            <div class="flex justify-center">
                                <div class="w-full lg:w-auto text-center text-lg">
                                    @if ($method == 1)
                                        <p>{{ $lang[8] }}</p>
                                    @else
                                        <p>{{ $lang[9] }}</p>
                                    @endif
                                    <p class="bg-[#2845F5] text-white inline-block rounded-lg px-3 py-2 my-3">
                                        <strong class="text-blue lg:text-4xl md:text-4xl">{{ $detail['ans'] }}
                                            {{ $lang['6'] }}</strong>
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
