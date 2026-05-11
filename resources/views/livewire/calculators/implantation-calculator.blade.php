<div>
    <style>
        .clr_0 th, .clr_0 td { color: #dac600; }
        .clr_1 th, .clr_1 td { color: #c0627a; }
        .clr_2 th, .clr_2 td { color: #62d616; }
        .clr_3 th, .clr_3 td { color: #328210; }
        .clr_4 th, .clr_4 td { color: #292828; }
        .bg-gradient {
            background: #2845F5 !important;
            color: #ffffff;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Know Ovulation Date --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="know" class="label">Do you know your ovulation date?:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="know" id="know" class="input">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    {{-- Ovulation Date (if Yes) --}}
                    @if ($know === 'yes')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="ovd" class="label">Ovulation Date:</label>
                            <div class="w-100 py-2">
                                <input type="date" wire:model.live="ovd" id="ovd" class="input" required />
                            </div>
                        </div>
                    @endif

                    {{-- Last Period (if No) --}}
                    @if ($know === 'no')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="lp" class="label">Your Last Period:</label>
                            <div class="w-100 py-2">
                                <input type="date" wire:model.live="lp" id="lp" class="input" required />
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="mcl" class="label">Menstrual Cycle Length:</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="mcl" id="mcl" class="input">
                                    @for ($i = 21; $i <= 35; $i++)
                                        <option value="{{ $i }}">{{ $i }} days</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="col-span-12 pt-4">
                        <p class="font-s-20"><strong class="text-blue-700">Fertility Treatment</strong></p>
                    </div>

                    {{-- IVF Transfer Day --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="ivf" class="label">IVF Transfer Day (Optional):</label>
                        <div class="w-100 py-2">
                            <input type="date" wire:model.live="ivf" id="ivf" class="input" />
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @if ($detail)
        <hr class="my-6">
        <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full mt-2">
                            <div class="w-full overflow-auto my-4 implantation-table">
                                {!! $detail['table'] !!}
                            </div>
                            
                            @if(isset($detail['ivf']))
                                <div class="bg-blue-50/50 border rounded-lg p-6 text-center mt-6">
                                    <p class="text-[18px] uppercase tracking-wider text-blue-900 font-semibold">According to IVF Transfer Date</p>
                                    <p class="text-[18px] mt-2"><strong class="text-blue-700">Implantation Date</strong></p>
                                    <p class="text-[32px] mt-2"><strong class="text-green-700">{{ $detail['ivf'] }}</strong></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
