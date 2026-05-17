<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="seq1" class="label">{{$lang[1]}} (,):</label>
                    <div class="w-100 py-2">
                        <textarea aria-label="textarea input" id="seq1" name="seq1" class="textareaInput" wire:model.live="seq1"></textarea>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="seq2" class="label">{{$lang[2]}} (,):</label>
                    <div class="w-100 py-2">
                        <textarea aria-label="textarea input" id="seq2" name="seq2" class="textareaInput" wire:model.live="seq2"></textarea>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result overflow-auto">
            <div class="">
                @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                        @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="row">
                            <div class="col-12 text-center text-[20px]">
                                <p>{{$lang['4']}}</p>
                                <p class="my-3">
                                    <strong class="bg-[#2845F5] px-3 py-2 font-s-22 rounded-lg text-white">
                                        {!! implode(', ', $detail['conv']) !!}
                                    </strong>
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
