<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="EnterEq" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="w-full py-2">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($_POST['EnterEq']) ? $_POST['EnterEq'] : 'x^2+3x+4' }}" aria-label="input" />
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
                            @php
                                $buffer_zero=$detail['buffer_zero'];
                                $buffer_p=explode(",",$detail['buffer_one']);
                            @endphp
                            <div class="w-full mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="30%"><strong>{{$lang[4]}}</strong></td>
                                        <td class="py-2 border-b">
                                            \(
                                                @foreach ($buffer_zero as $value)
                                                    ({{$value}})\
                                                @endforeach 
                                            \)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="30%"><strong>{{$lang[5]}}</strong></td>
                                        <td class="py-2 border-b">\( {{ $detail['buffer_one'] }} \)</td>
                                    </tr>
                                </table>
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