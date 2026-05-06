<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto rounded-lg space-y-6 my-3">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="w-full mx-auto my-2">
                    <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-3 gap-4 flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="space-y-2 px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $selection === '1' ? 'tagsUnit' : '' }}" wire:click="$set('selection', '1')">
                                Birthdates
                            </div>
                        </div>
                        <div class="space-y-2 px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $selection === '2' ? 'tagsUnit' : '' }}" wire:click="$set('selection', '2')">
                                Years
                            </div>
                        </div>
                        <div class="space-y-2 px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $selection === '3' ? 'tagsUnit' : '' }}" wire:click="$set('selection', '3')">
                                Ages
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 mt-5 lg:grid-cols-2 md:grid-cols-2 gap-4">
                        @if ($selection === '1')
                            <div class="space-y-2">
                                <label for="dob_f" class="font-s-14 text-blue">Birthday of First Person:</label>
                                <input type="date" wire:model.live="dob_f" id="dob_f" class="input" aria-label="input" />
                            </div>
                            <div class="space-y-2">
                                <label for="dob_s" class="font-s-14 text-blue">Birthday of Second Person:</label>
                                <input type="date" wire:model.live="dob_s" id="dob_s" class="input" aria-label="input" />
                            </div>
                        @endif

                        @if ($selection === '2')
                            <div class="space-y-2">
                                <label for="year_1" class="font-s-14 text-blue">Birth Year 1:</label>
                                <select wire:model.live="year_1" id="year_1" class="input">
                                    @for ($year = date("Y"); $year >= 1910; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label for="year_2" class="font-s-14 text-blue">Birth Year 2:</label>
                                <select wire:model.live="year_2" id="year_2" class="input">
                                    @for ($year = date("Y"); $year >= 1910; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        @endif

                        @if ($selection === '3')
                            <div class="space-y-2">
                                <label for="age_1" class="font-s-14 text-blue">Age 1:</label>
                                <input type="number" wire:model.live="age_1" id="age_1" class="input" aria-label="input" />
                            </div>
                            <div class="space-y-2">
                                <label for="age_2" class="font-s-14 text-blue">Age 2:</label>
                                <input type="number" wire:model.live="age_2" id="age_2" class="input" aria-label="input" />
                            </div>
                        @endif
                    </div>
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
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                        <div class="my-2">
                            <div class="lg:w-3/4 w-full text-lg">
                                <table class="w-full">
                                    <tr>
                                        <td class="w-7/12 border-b py-2 font-semibold">Age Difference :</td>
                                        <td class="border-b py-2">
                                            <b>{{ $detail['age_diff_Year'] }}</b> Years 
                                            @if(isset($detail['age_diff_Month']))
                                                <b>{{ $detail['age_diff_Month'] }}</b> Months
                                            @endif
                                            @if(isset($detail['age_diff_Day']))
                                                <b>{{ $detail['age_diff_Day'] }}</b> Days
                                            @endif
                                        </td>
                                    </tr>
                                    @if(isset($detail['age_diff_remaining_days']))
                                        <tr>
                                            <td class="border-b py-2 font-semibold">Age Difference in Weeks :</td>
                                            <td class="border-b py-2">
                                                <b>{{ $detail['age_diff_weeks'] }}</b> Weeks <b>{{ $detail['age_diff_remaining_days'] }}</b> Days
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="border-b py-2 font-semibold">Age Difference in Days:</td>
                                        <td class="border-b py-2">
                                            <b class="text-2xl text-blue-500">{{ $detail['age_diff_in_days'] }}</b> Days
                                        </td>
                                    </tr>
                                    @if($selection === '1')
                                        <tr>
                                            <td class="w-7/12 border-b py-2 font-semibold">First Person is :</td>
                                            <td class="border-b py-2">{{ "{$detail['age_diff_Year']} Years {$detail['age_diff_Month']} Months {$detail['age_diff_Day']} Days" }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 font-semibold">Age of First Person :</td>
                                            <td class="border-b py-2">{{ "{$detail['ageFYear']} Years {$detail['ageFMonth']} Months {$detail['ageFDay']} Days" }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 font-semibold">Age of Second Person :</td>
                                            <td class="border-b py-2">{{ "{$detail['ageSYear']} Years {$detail['ageSMonth']} Months {$detail['ageSDay']} Days" }}</td>
                                        </tr>
                                    @endif
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
