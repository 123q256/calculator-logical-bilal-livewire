<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="solve" class="label">{!! $lang['1'] !!}:</label>
                    <select name="solve" id="solve" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang[3],$lang[2],$lang[1]];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset(request()->solve)?request()->solve:'1');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="f_input" class="label" id="f_text">{!! $lang['2'] !!}:</label>
                    <input type="number" step="any" name="f_input" id="f_input" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->f_input)?request()->f_input:'7' }}" />
                </div>
                <div class="space-y-2 relative">
                    <label for="s_input" class="label" id="s_text">{!! $lang['1'] !!}:</label>
                    <input type="number" step="any" name="s_input" id="s_input" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->s_input)?request()->s_input:'8' }}" />
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="bg-sky border rounded px-3 py-2">
                            <strong>
                                @if(request()->solve === "1")
                                    {!! $lang[3] !!}
                                @elseif(request()->solve === "2")
                                    {!! $lang[2] !!}
                                @else
                                    {!! $lang[1] !!}
                                @endif
                                =
                            </strong>
                            <strong class="text-[#119154] md:text-[25px] lg:text-[25px]">{!! round($detail['answer'], 2) !!}</strong>
                        </div>
                        <div class="col-12">
                            <p class="mt-3"><strong>{!! $lang[5] !!}</strong></p>
                            @if(request()->solve === "1")
                                <p class="mt-2">{!! $lang[2] !!} = {!! request()->f_input !!} </p>
                                <p class="mt-2">{!! $lang[1] !!} = {!! request()->s_input !!}</p>
                                <p class="mt-3"><strong>{!! $lang[6] !!}</strong></p>
                                <p class="mt-2">{!! $lang[7] !!} = 1/2 * (Be - Ae)</p>
                                <p class="mt-2">Bo = 0.5 * ({!! request()->f_input !!} - {!! request()->s_input !!})</p>
                                <p class="mt-2">Bo = {!! $detail['answer'] !!} </p>
                            @elseif(request()->solve === "2")
                                <p class="mt-2">{!! $lang[3] !!} = {!! request()->f_input !!} </p>
                                <p class="mt-2">{!! $lang[1] !!} = {!! request()->s_input !!}</p>
                                <p class="mt-3"><strong>{!! $lang[6] !!}</strong></p>
                                <p class="mt-2">{!! $lang[7] !!} = (2 * Bo) + Ae</p>
                                <p class="mt-2">Be = (2 * {!! request()->f_input !!}) + {!! request()->s_input !!}</p>
                                <p class="mt-2">Be = {!! $detail['answer'] !!} </p>
                            @else
                                <p class="mt-2">{!! $lang[3] !!} = {!! request()->f_input !!} </p>
                                <p class="mt-2">{!! $lang[2] !!} = {!! request()->s_input !!}</p>
                                <p class="mt-3"><strong>{!! $lang[6] !!}</strong></p>
                                <p class="mt-2">{!! $lang[7] !!} = -1 * ((Bo * 2) - Be)</p>
                                <p class="mt-2">Ae = -1 * (({!! request()->f_input !!} * 2) - {!! request()->s_input !!})</p>
                                <p class="mt-2">Ae = {!! $detail['answer'] !!} </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var solveElement = document.getElementById('solve');
                var fTextElement = document.getElementById('f_text');
                var sTextElement = document.getElementById('s_text');

                function updateText() {
                    let solve_val = solveElement.value;
                    if (solve_val === "1") {
                        fTextElement.textContent = "{!! $lang[2] !!}";
                        sTextElement.textContent = "{!! $lang[1] !!}";
                    } else if (solve_val === "2") {
                        fTextElement.textContent = "{!! $lang[3] !!}";
                        sTextElement.textContent = "{!! $lang[1] !!}";
                    } else {
                        fTextElement.textContent = "{!! $lang[3] !!}";
                        sTextElement.textContent = "{!! $lang[2] !!}";
                    }
                }

                updateText();

                solveElement.addEventListener('change', function() {
                    updateText();
                });
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>