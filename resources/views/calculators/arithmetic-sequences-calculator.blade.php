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
                    <div class="w-full py-2">
                        <input type="number" step="any" name="first" id="first" class="input" value="{{ isset($_POST['first'])?$_POST['first']:'1' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="diff" class="font-s-14 text-blue">{{$lang['2']}} (f):</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="diff" id="diff" class="input" value="{{ isset($_POST['diff'])?$_POST['diff']:'3' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="nth" class="font-s-14 text-blue">{{$lang['3']}}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="nth" id="nth" class="input" value="{{ isset($_POST['nth'])?$_POST['nth']:'20' }}" aria-label="input"/>
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
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['res']}}</td>
                                </tr>
                                <tr>
                                    @php
                                        function ordinalSuffix($number) {
                                            if (in_array($number % 100, [11, 12, 13])) {
                                                return $number . 'th';
                                            }
                                            switch ($number % 10) {
                                                case 1:
                                                    return $number . '<sup class="font-s-14">st</sup>';
                                                case 2:
                                                    return $number . '<sup class="font-s-14">nd</sup>';
                                                case 3:
                                                    return $number . '<sup class="font-s-14">rd</sup>';
                                                default:
                                                    return $number . '<sup class="font-s-14">th</sup>';
                                            }
                                        }
                                    @endphp
                                    <td class="py-2 border-b" width="60%"><strong>{!! ordinalSuffix($detail['nth']) !!} {{$lang['5']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['nth_v']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['6']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['total']}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>