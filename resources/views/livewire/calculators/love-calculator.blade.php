<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-1 md:p-1  rounded-lg my-3">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="you" class="label">{{ $lang['your_name'] }}</label>
                        <input type="text" wire:model.live="you" id="you" class="input" aria-label="input"
                            placeholder="{{ $lang['your_name'] }}">
                    </div>
                    @if (app()->getLocale() == 'en')
                        <div class="space-y-2">
                            <label for="gender" class="label">{{ $lang['gender'] }}:</label>
                            <select wire:model.live="gender" id="gender" class="input my-2">
                                <option value="Male">{{ $lang['male'] }}</option>
                                <option value="Female">{{ $lang['female'] }}</option>
                            </select>
                        </div>
                    @endif
                    <div class="space-y-2">
                        <label for="lover" class="label">{{ $lang['lover'] }}</label>
                        <input type="text" wire:model.live="lover" id="lover" class="input" aria-label="input"
                            placeholder="{{ $lang['lover'] }}">
                    </div>
                    @if (app()->getLocale() == 'en')
                        <div class="space-y-2">
                            <label for="gender_" class="label">{{ $lang['gender'] }}:</label>
                            <select wire:model.live="gender_" id="gender_" class="input my-2">
                                <option value="Male">{{ $lang['male'] }}</option>
                                <option value="Female">{{ $lang['female'] }}</option>
                            </select>
                        </div>
                    @endif
                </div>

                @if ($type == 'calculator')
                    @include('inc.button')
                @endif
                @if ($type == 'widget')
                    @include('inc.widget-button')
                @endif
            </div>
        </div>
    </div>
<hr>
        @isset($detail)
            {{-- result --}}
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full bg-light-blue  rounded-[10px] mt-3 overflow-auto">
                            <div class="flex flex-col items-center mt-2">
                                <p class="text-[20px] text-center">
                                    {{ $you . ' & ' . $lover }}
                                </p>
                                <p class="my-3">
                                    <strong
                                        class="lg:text-[32px]  md:text-[32px] text-blue bg-white px-3 py-2 rounded-[10px]">{{ $lang['have'] }}
                                        {{ $detail['RESULT'] }}% {{ $lang['lv'] }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
</form>

</div>
