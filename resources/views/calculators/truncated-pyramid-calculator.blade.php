<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="ubl" class="label">{{$lang['1']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="ubl" id="ubl" class="input" value="{{ isset($_POST['ubl'])?$_POST['ubl']:'15' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="ubw" class="label">{{$lang['2']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="ubw" id="ubw" class="input" value="{{ isset($_POST['ubw'])?$_POST['ubw']:'13' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="lbl" class="label">{{$lang['3']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="lbl" id="lbl" class="input" value="{{ isset($_POST['lbl'])?$_POST['lbl']:'11' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="lbw" class="label">{{$lang['4']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="lbw" id="lbw" class="input" value="{{ isset($_POST['lbw'])?$_POST['lbw']:'9' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="height" class="label">{{$lang['5']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="height" id="height" class="input" value="{{ isset($_POST['height'])?$_POST['height']:'7' }}" aria-label="input"/>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['6']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['DL']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['7']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['DT']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['HL']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}} a</strong></td>
                                    <td class="py-2 border-b">{{$detail['a']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}} b</strong></td>
                                    <td class="py-2 border-b">{{$detail['b']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}} c</strong></td>
                                    <td class="py-2 border-b">{{$detail['c']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['10']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['slA']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['slB']}}</td>
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