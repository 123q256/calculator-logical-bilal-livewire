<div>

    <form wire:submit.prevent="calculate" class="row">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2 relative">
                        <label for="e_date" class="font-s-14 text-blue">{!! $lang['1'] ?? 'Enter Date' !!}:</label>
                        <input type="date" id="e_date" wire:model.defer="e_date" class="input" aria-label="input"
                            placeholder="mm/dd/yyyy" />
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
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
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full  lg:p-6 md:p-6 px-2 rounded-lg mt-6">
                            <div class="w-full text-center mt-4">
                                <p class="text-lg font-bold">{{ $lang[2] }}</p>
                                <p
                                    class="lg:text-3xl md:text-3xl text-md my-3 bg-[#2845F5] text-white rounded-lg px-4 py-2 font-bold">
                                    {{ $detail['date'] }}</p>
                                <p class="text-blue-500 text-2xl pt-1">{{ $lang[3] }}</p>

                                <div class="lg:w-3/4 bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4 mx-auto">
                                    <p class="font-bold">{{ $detail['line'] }}</p>
                                    <p>{{ $lang[4] }}</p>
                                </div>

                                <div class="lg:w-3/4 bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4 mx-auto">
                                    <p class="font-bold">{{ $detail['line0'] }}</p>
                                    <p>{{ $lang[5] }}</p>
                                </div>

                                <div class="lg:w-3/4 bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4 mx-auto">
                                    <p class="font-bold">{{ $detail['line1'] }}</p>
                                    <p>{{ $lang[6] }}</p>
                                </div>

                                <div class="lg:w-3/4 bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4 mx-auto">
                                    <p class="font-bold">{{ $detail['line2'] }}</p>
                                    <p>{{ $lang[7] }}</p>
                                </div>

                                <div class="lg:w-3/4 bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4 mx-auto">
                                    <p class="font-bold">{{ $detail['line3'] }}</p>
                                    <p>{{ $lang[8] }}</p>
                                </div>

                                <div class="lg:w-3/4 bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4 mx-auto">
                                    <p class="font-bold">{{ $detail['line4'] }}</p>
                                    <p>{{ $lang[9] }}</p>
                                </div>

                                <div class="lg:w-3/4 bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4 mx-auto">
                                    <p class="font-bold">{{ $detail['line5'] }}</p>
                                    <p>{{ $lang[10] }}</p>
                                </div>

                                <div class="lg:w-3/4 bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4 mx-auto">
                                    <p class="font-bold">{{ $detail['line6'] }}</p>
                                    <p>{{ $lang[11] }}</p>
                                </div>

                                <div class="lg:w-3/4 bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4 mx-auto">
                                    <p class="font-bold">{{ $detail['line7'] }}</p>
                                    <p>{{ $lang[12] }}</p>
                                </div>

                                <div class="lg:w-3/4 bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4 mx-auto">
                                    <p class="font-bold">{{ $lang[13] }}</p>
                                    <p>{{ $lang[14] }}</p>
                                </div>

                                <div class="lg:w-3/4 bg-[#F6FAFC] text-black border rounded-lg p-4 mt-4 mx-auto">
                                    <p class="font-bold">{{ $detail['line_l'] }}</p>
                                    <p>{{ $lang[15] }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        @endisset
    </form>
</div>
