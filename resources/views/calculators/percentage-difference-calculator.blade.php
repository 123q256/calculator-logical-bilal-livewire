<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


            <div class="col-span-12">
                <label for="start" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="start" id="start" class="input" value="{{ isset($_POST['start'])?$_POST['start']:'21' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="final" class="font-s-14 text-blue">{{$lang['2']}}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="final" id="final" class="input" value="{{ isset($_POST['final'])?$_POST['final']:'25' }}" aria-label="input"/>
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
                                <table class="w-100 text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['ans'],5)}}%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                        <td class="py-2 border-b">{{ round($detail['dif'],5)}}</td>
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