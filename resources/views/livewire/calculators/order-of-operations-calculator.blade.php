<div>
 <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="expression" class="label"><?=$lang['1']?> :  ( <i><?=$lang['3']?> + - * / ^ r . ( ) [ ] { } )</i>:</label>
                <div class="w-100 py-2">
                    <input type="text" wire:model.live="expression" id="expression" class="input" aria-label="input" />
                </div>
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full font-s-16">
                                <style>
                                    .hitman{
                                        display:block;
                                    }
                                    .dk{
                                        margin-bottom:40px;
                                    }
                                    .pp{
                                        padding-left:18px;
                                    }
                                </style>
                                @if($finalAnswer !== null)
                                    <p class="mt-2 text-[18px]"><strong><span id="final_ans">{{ $finalAnswer }}</span></strong></p>
                                @endif
                                <p class="mt-2"><strong>Solution</strong></p>
                                <p class="mt-2">{{ $lang['5'] ?? 'Expression' }}:</p>
                                <p class="mt-2">{{ $detail['expression'] ?? '' }}</p>
                                <p class="mt-2">{{ $lang['6'] ?? 'Steps' }}</p>
                                <div class="col-12" id="stepsAndSolution">
                                    <div id="solution">
                                        <div id="solutionField">
                                            @foreach($calculationSteps as $step)
                                                @if($step['type'] === 'error')
                                                    <br><span class="step">{{ $step['message'] }}</span>
                                                    <br><span class="stepOp">{!! $step['html'] !!}</span>
                                                    <br><br>
                                                @else
                                                    <span class="step mt-3"></span>
                                                    <strong><span class="step mt-3"> Step {{ $step['stepNumber'] }}</strong> : </span>
                                                    <span class="stepOp">{!! $step['html'] !!}</span>
                                                    <span class="stepOp hitman mt-3">{{ $step['operation'] }}</span>
                                                @endif
                                            @endforeach
                                            @if($finalAnswer !== null)
                                                <strong>Answer : <span class="solutionNum text-blue dk">{{ $finalAnswer }}</span></strong>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            // We kept the MathJax re-render for formulas if necessary.
            document.addEventListener("DOMContentLoaded", () => {
                if (typeof MJrerender === "function") MJrerender();
            });
        </script>
    @endpush
</form>
</div>
