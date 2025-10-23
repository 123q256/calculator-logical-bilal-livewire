<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <p class="col-span-12 text-center my-2 text-[18px]"><strong>{{$lang['1']}}</strong></p>
                <div class="col-span-4">
                    <div class="w-full py-2">
                        <input type="text" step="any" name="first" id="first" class="input" value="{{ isset($_POST['first']) ? $_POST['first'] : '2 3/5' }}" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-4 text-center text-[18px]">
                    <div class="w-full py-2 mt-1"><p><strong>{{$lang['2']}}</strong></p></div>
                </div>
                <div class="col-span-4">
                    <div class="w-full py-2">
                        <input type="text" step="any" name="second" id="second" class="input" value="{{ isset($_POST['second']) ? $_POST['second'] : '33.33%' }}" aria-label="input" />
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
                                        <td class="py-2 border-b" width="50%"><strong>{{$lang['3']}}</strong></td>
                                        <td class="py-2 border-b">{{$_POST['first']}} {{$detail['sign']}} {{$_POST['second']}}</td>
                                    </tr>    
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-2">{{$lang['6']}}:</p>
                                <p class="mt-2">{{$detail['nbr1']}} , {{$detail['nbr2']}}</p>
                                <p class="mt-2">{{$lang['7']}}:</p>
                                <p class="mt-2">{{$detail['nbr1']}} {{$detail['sign']}} {{$detail['nbr2']}}</p>
                                <p class="mt-2">{{$lang['8']}}:</p>
                                <p class="mt-2">{{$_POST['first']}} {{$detail['sign']}} {{$_POST['second']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
