<div>
 <form wire:submit.prevent="calculate">
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
                <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2 relative">
                        <label for="seprateby" class="font-s-14 text-blue">{{ $lang['no'] ?? 'Separate By' }}:</label>
                        <select name="seprateby" id="seprateby" class="input" wire:model.live="seprateby">
                            <option value="space">{{ $lang['Space'] ?? 'Space' }}</option>
                            <option value=",">{{ $lang['comma'] ?? 'Comma' }}</option>
                            <option value="user">{{ $lang['user'] ?? 'User Define' }}</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                        <input type="text" name="seprate" id="seprate" class="input readonly" aria-label="input" placeholder=" " wire:model.live="seprate" {{ $seprateby != 'user' ? 'readonly' : '' }} />
                    </div>

                </div>
                <div class="grid grid-cols-1  gap-4">
                    <div class="space-y-2">
                        <label for="textarea" class="font-s-14 text-blue">{{ $lang['enter'] ?? 'Enter Numbers' }}:</label>
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 55 62 35 32 50 57 54" wire:model.live="x"></textarea>
                    </div>
                </div>
            </div>
            @if ($type == 'calculator')
            @include('inc.button')
            @endif
            @if ($type=='widget')
            @include('inc.widget-button')
            @endif
        </div>
    @isset($detail)
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                        @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 ">
                            <div class="">
                                <div class="rounded-lg  ">
                                    <div class="w-full lg:p-3 md:p-3  mt-3">
                                        <div class="w-full text-center font-s-16">
                                            <p><strong>{{ $lang['ans'] ?? 'Answer' }} {{ $lang['stat'] ?? 'Statistical' }}</strong></p>
                                            <p class="my-3"><strong class="bg-[#2845F5] text-white text-[24px] rounded-lg px-3 py-2 ">{{ $detail['ss'] }} </strong></p>
                                        </div>
                                        <div class="w-full text-center font-s-16">
                                            <p><strong>{{ $lang['ans'] ?? 'Answer' }} {{ $lang['algbra'] ?? 'Algebraic' }}</strong></p>
                                            <p class="my-3"><strong class="bg-[#2845F5] text-white text-[24px] rounded-lg px-3 py-2">{{ $detail['su'] }} </strong></p>
                                        </div>
                                        <div class="row  lg:p-5 md:p-5 p-2 border rounded-lg bg-white mt-3">
                                            <p class="col-12 mt-2 px-lg-2 px-0 font-s-20 text-center"> <b>Step by Step Solution</b></p>
                                            <p class="col-12 mt-2 px-lg-2 px-0 font-s-18 text-center"> <strong class="text-blue">{{ $lang['stat'] ?? 'Statistical' }}</strong> </p>
                                            <p class="col-12 mt-2 px-lg-2 px-0"> <strong>{{ $lang['sdata'] ?? 'Sample Data' }} </strong> = ({{ $x }})</p>
                                            <p class="col-12 mt-2 px-lg-2 px-0"><strong>{{ $lang['tdata'] ?? 'Total Data' }} </strong>: {{ $detail['n'] }}</p>
                                            <p class="col-12 mt-2 px-lg-2 px-0"><strong>{{ $lang['mean'] ?? 'Mean' }} (X̄)</strong> = {{ $detail['so'] }} / {{ $detail['n'] }} = {{ $detail['s'] }}</p>
                                            <p class="col-12 mt-2 px-lg-2 px-0"> <strong>{{ $lang['sum'] ?? 'Sum' }}</strong> = Σ (Xi - X̄)</p>
                                            <p class=" col-12 mt-2 px-lg-2 px-0">= {!! $detail['sns'] !!}</p>
                                            <p class="col-12 mt-2 px-lg-2 px-0">= {{ $detail['snns'] }}</p>
                                            <p class="col-12 mt-2 px-lg-2 px-0">= "{{ $detail['ss'] }}"</p>
                                            <p class="col-12 mt-2 px-lg-2 px-0 font-s-18 text-center"> <strong class="text-blue">{{ $lang['algbra'] ?? 'Algebraic' }}</strong> </p>
                                            <p class="col-12 mt-2 px-lg-2 px-0">= {!! $detail['soa'] !!}</p>
                                            <p class="col-12 mt-2 px-lg-2 px-0">= {{ $detail['soas'] }}</p>
                                            <p class="col-12 mt-2 px-lg-2 px-0">= "{{ $detail['su'] }}"</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    @endisset
</form>

</div>
