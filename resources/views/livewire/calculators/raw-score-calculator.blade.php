<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="col-12 px-2 mb-3 mt-0 mt-lg-2 text-center d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <input wire:model.live="type_input" id="type_population" value="first" type="radio" class="cursor-pointer" />
                        <label for="type_population" class="font-s-14 text-blue pe-lg-3 px-1 cursor-pointer">{{ $lang['1'] }}</label>
                        
                        <input wire:model.live="type_input" id="type_sample" value="second" type="radio" class="cursor-pointer" />
                        <label for="type_sample" class="font-s-14 text-blue ps-1 cursor-pointer">{{ $lang['2'] }}</label>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="mean" class="font-s-14 text-blue">
                            @if ($type_input == 'second')
                                {{ $lang[13] }} (<span style="border-top: 1px solid;">X</span>)
                            @else
                                {{ $lang[12] }} (μ)
                            @endif
                        </label>
                        <input type="number" step="any" wire:model.live="mean" id="mean" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2">
                        <label for="standard_daviation" class="font-s-14 text-blue">
                            @if ($type_input == 'second')
                                {{ $lang[4] }} (s)
                            @else
                                {{ $lang[4] }} (σ)
                            @endif
                        </label>
                        <input type="number" step="any" wire:model.live="standard_daviation" id="standard_daviation" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2">
                        <label for="z_score" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <input type="number" step="any" wire:model.live="z_score" id="z_score" class="input" aria-label="input" placeholder="00" />
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
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="text-center">
                                    <p class="font-s-20">
                                        {{ $lang['6'] }}
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[30px] w-auto bg-[#2845F5] px-3 py-2 text-white rounded-lg d-inline-block my-3">
                                            {{ $detail['res'] }}
                                        </p>
                                    </div>
                                </div>
                                <p class="col-12 mt-3 font-s-20 text-blue">
                                    {{ $lang[7] }}:
                                </p>
                
                                <p class="col-12 mt-2">
                                    <b>{{ $lang[8] }}:</b>
                                </p>
                                @if ($detail['type'] == 'first')
                                    <p class="col-12 mt-2">μ = Population Mean</p>
                                    <p class="col-12 mt-2">z = Z Score</p>
                                    <p class="col-12 mt-2">σ = Standard Deviation</p>
                                    <p class="col-12 mt-2">Inputs:</p>
                                    <p class="col-12 mt-2">μ = {{ $detail['mean'] }}</p>
                                    <p class="col-12 mt-2">z = {{ $detail['z_score'] }}</p>
                                    <p class="col-12 mt-2">σ = {{ $detail['standard_daviation'] }}</p>
                                @else
                                    <p class="col-12 mt-2"><span style="border-top:1px solid !important">x</span> = Sample Mean</p>
                                    <p class="col-12 mt-2">z = Z Score</p>
                                    <p class="col-12 mt-2">s = Standard Deviation</p>
                                    <p class="col-12 mt-2">Inputs:</p>
                                    <p class="col-12 mt-2"><span style="border-top: 1px solid;"> x </span> = {{ $detail['mean'] }}</p>
                                    <p class="col-12 mt-2">z = {{ $detail['z_score'] }}</p>
                                    <p class="col-12 mt-2">s = {{ $detail['standard_daviation'] }}</p>
                                @endif
                
                                <p class="col-12 mt-2">
                                    <b>{{ $lang[14] }}:</b>
                                </p>
                
                                @if ($detail['type'] == 'first')
                                    <p class="col-12 mt-2 ">X = μ + z(σ)</p>
                                @else
                                    <p class="col-12 mt-2 ">X = <span style="border-top:1px solid">x</span> + zs</p>
                                @endif
                
                                <p class="col-12 mt-2">
                                    <b>{{ $lang[15] }}:</b>
                                </p>
                
                                <p class="col-12 mt-2">
                                    X = {{ $detail['mean'] }} + ({{ $detail['z_score'] }})({{ $detail['standard_daviation'] }})
                                </p>
                                <p class="col-12 mt-2">
                                    X = {{ $detail['mean'] }} + {{ $detail['z_score'] * $detail['standard_daviation'] }}
                                </p>
                                <p class="col-12 mt-2">
                                    X = {{ $detail['res'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
