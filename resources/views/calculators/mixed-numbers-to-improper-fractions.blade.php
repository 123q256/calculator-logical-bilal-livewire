<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12  mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12  flex items-center">
                    <div class="pe-2">
                        <input type="number" step="any" name="whole" id="whole" class="input mb-2" value="{{ isset($_POST['whole'])?$_POST['whole']:'3' }}" aria-label="input"/>
                    </div>
                    <div class="ps-2">
                        <input type="number" step="any" name="uper" id="uper" class="input mb-2" value="{{ isset($_POST['uper'])?$_POST['uper']:'2' }}" aria-label="input"/>
                        <hr>
                        <input type="number" step="any" name="btm" id="btm" class="input mt-2" value="{{ isset($_POST['btm'])?$_POST['btm']:'5' }}" aria-label="input"/>
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full  text-[16px]">
                            <p class="mt-3 text-[18px]">\( \dfrac{ {{$detail['plus']}} }{ {{$_POST['btm']}} } \)</p>
                            <p class="mt-3">{{$lang['2']}}:</p>
                            <p class="mt-3">{{$lang['3']}}</p>
                            <p class="mt-3">\( {{$_POST['whole']}} = \dfrac{({{$_POST['whole']}}) \times ({{$_POST['btm']}})}{{{$_POST['btm']}}} \)</p>
                            <p class="mt-3">\( {{$_POST['whole']}} = \dfrac{{{$detail['multi']}}}{{{$_POST['btm']}}} \)</p>
                            <p class="mt-3">{{$lang['4']}}.</p>
                            <p class="mt-3">\( = \dfrac{({{$detail['multi']}}) + ({{$_POST['uper']}})}{{{$_POST['btm']}}} \)</p>
                            <p class="mt-3">\( = \dfrac{{{$detail['plus']}}}{{{$_POST['btm']}}} \)</p>
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