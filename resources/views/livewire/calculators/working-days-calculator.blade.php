<div>
    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2 relative">
                        <label for="start_date"
                            class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <input type="date" name=""  wire:model="start_date" id="start_date" class="input" aria-label="input" />
                    </div>
                    <div class="space-y-2 relative">
                        <label for="end_date" 
                            class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <input type="date" wire:model="end_date" id="end_date" class="input" aria-label="input" />
                    </div>
                    <div class="space-y-2 relative">
                        <label for="working_days" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <select name="" wire:model="working_days" id="working_days" class="input">
                            <option value="Include all days of week">Include all days of week</option>
                            <option value="Exclude weekends">Exclude weekends</option>
                            <option value="Exclude only sunday">Exclude only sunday</option>

                        </select>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="include_end_date" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <select name="" wire:model="include_end_date" id="include_end_date" class="input">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
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
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full rounded-lg p-4 mt-4">
                            <div class="text-center">
                                <p class="text-xl font-bold">{{ $lang['5'] }}</p>
                                <p class="text-4xl bg-[#2845F5] text-white px-4 py-2 rounded-lg inline-block mt-4">
                                    <strong>{{ $detail['answer'] }}</strong>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        @endisset
    </form>
</div>
