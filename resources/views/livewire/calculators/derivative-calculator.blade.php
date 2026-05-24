<div>
<style>
    .res_step ol {
    list-style-type: decimal;
    border-left: 1px solid #FF8080;
    padding: 0 30px;
}
.res_step li {
    min-width: 300px;
}
.res_step ol ol {
    list-style-type: upper-alpha;
    border-left: 1px solid #92D169;
}
.res_step ol ol ol {
    list-style-type: upper-roman;
    border-left: 1px solid #78BEF0;
}
.res_step ol ol ol ol {
    list-style-type: lower-alpha;
    border-left: 1px solid #CC66C9;
}
.res_step ol ol ol ol ol {
    list-style-type: lower-roman;
    border-left: 1px solid #F2A279;
}
</style>

 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4" x-data="{ showKeyboard: false }">
           
                <div class="col-span-8">
                    <label for="EnterEq" class="text-sm text-blue-500">{{$lang['1']}}:</label>
                    <div class="w-full py-2 relative">
                        <input type="text" wire:model.live="EnterEq" id="EnterEq" class="input w-full py-2 px-3 border border-gray-300 rounded-md" aria-label="input"/>
                        <img src="{{ asset('images/keyboard.png') }}" @click="showKeyboard = !showKeyboard" style="cursor: pointer;" class="absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9" alt="keyboard" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="with" class="text-sm text-blue-500">W.R.T:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="with" class="input w-full py-2 px-3 border border-gray-300 rounded-md" id="with" aria-label="select">
                            <option value="a">a</option>
                            <option value="b">b</option>
                            <option value="c">c</option>
                            <option value="n">n</option>
                            <option value="x">x</option>
                            <option value="y">y</option>
                            <option value="z">z</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 px-2 keyboard" x-show="showKeyboard" style="display: none;">
                    <button type="button" @click="if(confirm('Are you sure you want to clear Equation?')) { $wire.EnterEq = ''; }" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">CLS</button>
                    <button type="button" @click="$wire.EnterEq += '+'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">+</button>
                    <button type="button" @click="$wire.EnterEq += '-'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">-</button>
                    <button type="button" @click="$wire.EnterEq += '/'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">/</button>
                    <button type="button" @click="$wire.EnterEq += '*'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">*</button>
                    <button type="button" @click="$wire.EnterEq += '^'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">^</button>
                    <button type="button" @click="$wire.EnterEq += 'sqrt('" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">√</button>
                    <button type="button" @click="$wire.EnterEq += '('" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">(</button>
                    <button type="button" @click="$wire.EnterEq += ')'" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600">)</button>
                </div>
                <div class="col-span-12">
                    <label for="how" class="font-s-14 text-blue">{{$lang['4']}}:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="how" class="input" id="how" aria-label="select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
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
                <div class="w-full bg-light-blue  p-3 radius-10 mt-3">
                    <div class="w-full">
                    <div class="w-full">
                        <div class="col-12 font-16">
                            @if($how > 1)
                                @php $j="'"; @endphp
                                @for($i=1; $i < count($detail['final_res']); $i++)
                                    <p class="mt-3 font-s-18"><strong>\( f{{$j}} (x)\) {{$lang['3']}}</strong></p>
                                    <p class="mt-3 font-s-18">\( {{$detail['final_res'][$i]}} \)</p>
                                    @php $i++;$j.="'"; @endphp
                                    <p class="mt-3 font-s-18"><strong>{{$lang['7']}}</strong></p>
                                    <p class="mt-3 font-s-18">\( {{$detail['final_res'][$i]}} \)</p>
                                    @php $i++; @endphp
                                    <div class="col-12 mt-3" x-data="{ openStep: false }">
                                        <button type="button" @click="openStep = !openStep" class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-700 transition font-medium" style="font-size: 14px; cursor: pointer;">{{$lang['8']}}</button>
                                        <div class="mt-3 res_step" x-show="openStep" style="display: none;" x-collapse>
                                            <p class="mt-3">{!!$detail['final_res'][$i]!!}</p>
                                        </div>
                                    </div>
                                @endfor
                            @else
                                <p class="mt-3 font-s-18"><strong>{{$lang['3']}}</strong></p>
                                <p class="mt-3 font-s-18">\( {{$detail['ans']}} \)</p>
                                <p class="mt-3 font-s-18"><strong>{{$lang['7']}}</strong></p>
                                <p class="mt-3 font-s-18">\( {{$detail['simple']}} \)</p>
                                <p class="mt-3 font-s-18"><strong>Solution:</strong></p>
                                <div class="col-12 mt-3 res_step">
                                    <p class="mt-3">{!!$detail['buffer']!!}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

    @endisset
    @push('calculatorJS')
       <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    @endpush
</form>
</div>
