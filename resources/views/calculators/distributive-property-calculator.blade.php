<style>
    .own_steps p{
        margin-top: 10px;
    }
</style>
<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

            <p class="col-span-12 my-2 text-[14px]"><strong>{{$lang['2']}}: {{$lang['3']}}</strong></p>
            <div class="col-span-12">
                <label for="EnterEq" class="label">{{$lang['1']}}:</label>
                <div class="w-100 py-2">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($_POST['EnterEq'])?$_POST['EnterEq']:'3*(13 + 7)' }}" aria-label="input"/>
                </div>
            </div>
            <p class="col-span-12 my-2 text-[14px]"><strong>Examples:</strong> (2-13+4)/(9), 3*(13-7), (13-3-2)*(12-5), (5*(7-3))*(16*(13-3)+5)</p>
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
                        <div class="text-center pt-1 pb-2">
                            <p class=" bg-gradient-to-r  relative inline-block rounded-full p-3">
                                {!! $lang['4'] !!}
                            </p>
                            <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">{{round($detail['ans'],5)}}</p>
                        </div>
                    </div>

                        <div class="w-full text-[16px]">
                                <p class="text-danger"><strong>{{$lang['5']}} :</strong> </p>
                                <p class="text-danger">{{$lang['6']}} : {{$detail['input']}} </p>
                                <p class="text-danger"> ={{round($detail['ans'],5)}} </p>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>