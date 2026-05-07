<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto space-y-6">
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
                @if (isset($error))
                    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
                @endif
                <div class="lg:w-[70%] md:w-[70%] mt-4 w-full mx-auto">
                    <div class="w-full mx-auto my-2">
                        <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-3 lg:gap-4 md:gap-4 flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                            <div class="space-y-2 px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $one === 'one' ? 'tagsUnit' : '' }}"
                                    wire:click="setTab('one')">
                                    {{ $lang['2'] }}
                                </div>
                            </div>
                            <div class="space-y-2 px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $one === 'two' ? 'tagsUnit' : '' }}"
                                    wire:click="setTab('two')">
                                    {{ $lang['3'] }}
                                </div>
                            </div>
                            <div class="space-y-2 px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $one === 'three' ? 'tagsUnit' : '' }}"
                                    wire:click="setTab('three')">
                                    {{ $lang['4'] }}
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 mt-5 lg:grid-cols-2 md:grid-cols-2 gap-4">
                            <div class="space-y-2 relative">
                                <label for="date" class="font-s-14 text-blue label">
                                    @if ($one === 'one')
                                        {{ $lang['5'] }}
                                    @elseif ($one === 'two')
                                        {{ $lang['38'] }}
                                    @else
                                        {{ $lang['39'] }}
                                    @endif
                                    :
                                </label>
                                <input type="date" wire:model.live="date" id="date" class="input" />
                            </div>
                            <div class="space-y-2 relative">
                                <label for="current_date" class="font-s-14 text-blue">{{ $lang['37'] }}:</label>
                                <input type="date" step="any" wire:model.live="current_date" id="current_date" class="input" />
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
            </div>
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                            <div class="flex flex-col md:flex-row">
                                <div class="w-full text-lg overflow-auto">
                                    @if ($one === 'one')
                                        <table class="w-full">
                                            <tr>
                                                <td class="w-3/5 border-b py-2 font-semibold">{{ $lang['7'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['anniversaryDate'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 font-semibold">{{ $lang['8'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['daysUntilAnniversary'] }} Days</td>
                                            </tr>
                                        </table>
                                        <table class="w-full mt-3">
                                            <tr>
                                                <td class="w-3/5 border-b py-2">{{ $lang['9'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }} {{ $lang['10'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['11'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }} {{ $lang['12'] }}, {{ $detail['monthsMarried'] }} {{ $lang['13'] }}, and {{ $detail['daysMarried'] }} {{ $lang['14'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['15'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] + 1 }} {{ $lang['16'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['17'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }} {{ $lang['12'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['18'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['monthsMarried'] }} {{ $lang['13'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['19'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_weeks'] - 1 }} {{ $lang['20'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['21'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_days'] }} {{ $lang['14'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['22'] }}:</td>
                                                <td class="border-b py-2">{{ $lang['23'] }}</td>
                                            </tr>
                                        </table>
                                    @elseif($one === 'two')
                                        <table class="w-full">
                                            <tr>
                                                <td class="w-3/5 border-b py-2 font-semibold">{{ $lang['7'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['anniversaryDate'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 font-semibold">{{ $lang['8'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['daysUntilAnniversary'] }} Days</td>
                                            </tr>
                                        </table>
                                        <table class="w-full mt-3">
                                            <tr>
                                                <td class="w-3/5 border-b py-2">{{ $lang['9'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }} {{ $lang['24'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['25'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }} {{ $lang['12'] }}, {{ $detail['monthsMarried'] }} {{ $lang['13'] }}, and {{ $detail['daysMarried'] }} {{ $lang['14'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['26'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] + 1 }} {{ $lang['16'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['27'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }} {{ $lang['12'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['28'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['monthsMarried'] }} {{ $lang['13'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['29'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_weeks'] - 1 }} {{ $lang['20'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['30'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_days'] }} Days</td>
                                            </tr>
                                        </table>
                                    @else
                                        <table class="w-full">
                                            <tr>
                                                <td class="w-3/5 border-b py-2 font-semibold">{{ $lang['7'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['anniversaryDate'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 font-semibold">{{ $lang['8'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['daysUntilAnniversary'] }} Days</td>
                                            </tr>
                                        </table>
                                        <table class="w-full mt-3">
                                            <tr>
                                                <td class="w-3/5 border-b py-2">{{ $lang['9'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }} {{ $lang['31'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['32'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }} {{ $lang['12'] }}, {{ $detail['monthsMarried'] }} {{ $lang['13'] }}, and {{ $detail['daysMarried'] }} {{ $lang['14'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['33'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }} {{ $lang['12'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['34'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['monthsMarried'] }} {{ $lang['13'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['35'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_weeks'] - 1 }} {{ $lang['20'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['36'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_days'] }} {{ $lang['14'] }}</td>
                                            </tr>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
