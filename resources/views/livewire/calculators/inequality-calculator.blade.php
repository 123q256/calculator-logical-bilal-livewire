<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 flex justify-center items-center" style="gap: 20px">
                <p class="flex justify-center items-center">
                    <input type="radio" name="select" id="one" value="2" wire:model.live="select">
                    <label for="one" class="text-blue ps-1 cursor-pointer">{{ $lang[3] }}</label>
                </p>
                <p class="flex justify-center items-center">
                    <input type="radio" name="select" id="first" value="1" wire:model.live="select">
                    <label for="first" class="text-blue ps-1 cursor-pointer">{{ $lang[2] }}</label>
                </p>
            </div>
            <div class="@if($select == '1') md:col-span-5 lg:col-span-5 @endif col-span-12 mt-0  oneSide">
                <label for="equ1" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2">
                    <input type="text" name="equ1" id="equ1" class="input" aria-label="input" wire:model.live="equ1" />
                </div>
            </div>
            
            @if($select == '1')
            <div class="col-span-12 md:col-span-2 lg:col-span-2  twoSide flex items-center">
                <label for="con" class="font-s-14 text-blue d-lg-inline hidden">&nbsp;</label>
                <div class="w-full py-2">
                    <label for="" >&nbsp;</label>
                    <select name="con" class="input" id="con" aria-label="select" wire:model.live="con">
                        <option value="1">{{$lang['5']}}</option>
                        <option value="2">{{$lang['6']}}</option>
                    </select>
                </div>
            </div>
            <div class="md:col-span-5 lg:col-span-5   col-span-12 mt-0  twoSide">
                <label for="equ2" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2">
                    <input type="text" name="equ2" id="equ2" class="input" aria-label="input" wire:model.live="equ2" />
                </div>
            </div>
            @endif
        </div>
    </div>
     @if ($type == 'calculator')
     @include('inc.button')
    @endif
    @if ($type=='widget')
    @include('inc.widget-button')
     @endif
 </div>

    @if(isset($detail) && isset($detail['solution_inequality']))
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full overflow-auto">
                                @if($select == "2")
                                    <p class="mt-2 text-25px">\( \color{#1670a7}{ {{$detail['solution_inequality']}} } \)</p>
                                @else
                                    <p class="mt-2 font-s-22">
                                        \( ({{$detail['solution_inequality']}}) {{ $con === "1" ? '∩' : 'U' }} ({{$detail['latex_solution_eq_sec']}}) \)
                                    </p>
                                @endif
                            </div>
                            <div class="w-full text-[18px] overflow-auto mt-3">
                                @isset($detail['steps'])
                                    <p class="mt-3"><strong>Steps to solve \( {{$equ1}} \)</strong></p>
                                    @foreach ($detail['steps'] as $item)
                                        <p class="mt-2">{{$item}}</p>
                                    @endforeach
                                @endisset
                                @isset($detail['steps_sec'])
                                    <p class="mt-3"><strong>Steps to solve \( {{$equ2}} \)</strong></p>
                                    @foreach ($detail['steps_sec'] as $item)
                                        <p class="mt-2">{{$item}}</p>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>

@push('calculatorJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
    </script>
    <script>
        window.MJrerender = function() {
            if (typeof MathJax !== 'undefined' && MathJax.Hub) {
                MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
            }
        }
    </script>
@endpush
</div>
