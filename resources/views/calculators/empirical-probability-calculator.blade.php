<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_formv rounded-lg  space-y-6 my-3">
        @if (isset($error))
    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2 relative">
                    <label for="first" class="font-s-14 text-blue" title="{!! $lang[2] !!}"><?= $lang['1'] ?>?</label>
                    <input type="number" step="any" name="first" id="first" value="{{ isset($_POST['first'])?$_POST['first']:'7' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2">
                    <label for="second" class="font-s-14 text-blue" title="{!! $lang[4] !!}"><?= $lang['3'] ?>?</label>
                    <input type="number" step="any" name="second" id="second" value="{{ isset($_POST['second'])?$_POST['second']:'3' }}" class="input" aria-label="input" placeholder="00" />
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
            <div class="rounded-lg  flex items-center mt-4 justify-center">
                <div class="w-full">
                    <div class="text-center">
                        <p class="font-s-18"><strong>{{$lang['5']}}</strong></p>
                        <p class="font-s-21 px-3 py-2 radius-10 d-inline-block my-3">
                            <strong class="bg-[#2845F5] text-white  p-4 rounded-xl">{{ $detail['answer'] }}</strong>
                        </p>
                    </div>
                    @php
                        $request = request();
                        $first = $request->first;
                        $second = $request->second;
                    @endphp
                    <p class="col-12 mt-3 font-s-18"><strong class="text-blue">Formula:</strong></p>
                    <p class="col-12 mt-3 font-s-14">
                        <span>Empirical Probability =</span>
                        <span class="fraction">
                            <span class="num">Number of Times Event Occurs</span>
                            <span class="visually-hidden"></span>
                            <span class="den">Number of Times Experiment Performed</span>
                        </span>
                    </p>
                    <p class="col-12 mt-3">
                        \( = \dfrac {<?=$first?>}{<?=$second?>} \)
                    </p>
                    <p class="col-12 mt-3">
                        \( = <?= $detail['answer'] ?> \)
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script>
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        </script>
    @endif
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>