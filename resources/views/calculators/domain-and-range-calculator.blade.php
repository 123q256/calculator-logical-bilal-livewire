<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="eq" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="w-100 py-2">
                    <input type="text" name="eq" id="eq" class="input" value="{{ isset($_POST['eq']) ? $_POST['eq'] : '(x^2+1)/(x^2-1)' }}" aria-label="input" />
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
                    <div class="row">
                        <div class="col-lg-8 mt-2">
                            <table class="w-full  text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="30%"><strong>{{$lang[3]}}</strong></td>
                                    <td class="py-2 border-b">\( {{ $detail['domain'] }} \)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="30%"><strong>{{$lang[4]}}</strong></td>
                                    <td class="py-2 border-b">\( {{ $detail['range'] }} \)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[17px]">
                            <p class="mt-2"><strong>{{$lang[5]}}</strong></p>
                            <p class="mt-2">
                                {{$lang[7]}}:
                                <a href="https://technical-calculator.com/graphing-calculator/" class="text-blue-500 underline" target="_blank">{{$lang[6]}}</a>
                            </p>
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