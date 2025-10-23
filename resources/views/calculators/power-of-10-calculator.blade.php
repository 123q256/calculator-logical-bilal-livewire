<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <p class="col-span-12 text-center my-2 text-[21px]"><strong>10<sup class="font-s-14">x</sup> = a</strong></p>
            <div class="col-span-12 mt-0 mt-lg-2">
                <label for="input" class="font-s-14 text-blue">{{$lang['1']}} (x):</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="input" id="input" class="input" value="{{ isset($_POST['input'])?$_POST['input']:'7' }}" aria-label="input"/>
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
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['2']}} (a)</strong></td>
                                        <td class="py-2 border-b">{{ $detail['result'] }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['5']}}</strong></p>
                                <p class="mt-2">(10)<sup class="font-s-14">x</sup> = (10)<sup class="font-s-14">{{$_POST['input']}}</sup></p>
                                <p class="mt-2">{{$lang[6]}}</p>
                                <p class="mt-2">
                                    (10)<sup class="font-s-14">{{$_POST['input']}}</sup> = 
                                    @php
                                        for($i=0; $i < round($_POST['input']); $i++){
                                            $mul='×';
                                            if($i+1==$_POST['input']){
                                                $mul='';
                                            }
                                            echo " 10 ".$mul;
                                        }   
                                    @endphp
                                </p>
                                <p class="mt-2">{{$lang[4]}} (a)</p>
                                <p class="mt-2">(10)<sup class="font-s-14">{{$_POST['input']}}</sup> = {{ $detail['result'] }}</p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>