<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="first" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                <div class="w-100 py-2">
                    <input type="text" name="first" id="first" value="{{ isset($_POST['first'])?$_POST['first']:'2x^2 + 5x - 7' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="second" class="font-s-14 text-blue">{{$lang['2']}}:</label>
                <div class="w-100 py-2">
                    <input type="text" name="second" id="second" value="{{ isset($_POST['second'])?$_POST['second']:'3x + 13' }}" class="input" aria-label="input" />
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
                        <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang['3'] }}</strong></td>
                                    <td class="py-2 border-b">\({{$detail['ans']}}\)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-3"><strong>{{$lang['4']}}</strong></p>
                            <p class="mt-3">{{$lang[5]}}: \( \text{ {{$lang[14]}}  }\left({{$detail['input1']}}\right) \text{ {{$lang[6]}} } \left({{$detail['input2']}}\right) \)</p>
                            <p class="mt-3">{{$lang[7]}}:</p>
                            <p class="mt-3">{{$lang[8]}}.</p>
                            <p class="mt-3">{{$lang[9]}}.</p>
                            <p class="mt-3">{{$lang[10]}}:</p>
                            <p class="mt-3">\(\left({{$detail['input1']}}\right) \times \left({{$detail['input2']}}\right) = {{$detail['step']}}\)</p>
                            <p class="mt-3">{{$lang[11]}}:</p>
                            <p class="mt-3">\(={{$detail['next']}}\)</p>
                            <p class="mt-3">{{$lang[12]}}:</p>
                            <p class="mt-3">\(={{$detail['ans']}}\)</p>
                            <p class="mt-3">{{$lang[13]}}:</p>
                            <p class="mt-3">\(\left({{$detail['input1']}}\right) \times \left({{$detail['input2']}}\right)={{$detail['ans']}}\)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @push('calculatorJS')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
            <script type="text/x-mathjax-config">
                MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
            </script>
        @endpush
    @endisset
</form>