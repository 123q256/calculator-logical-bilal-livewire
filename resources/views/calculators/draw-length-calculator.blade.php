<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1 mt-3  gap-4">

            <div class="col-12 mt-0 mt-lg-2">
                <label for="length" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2"> 
                    <input type="number" step="any" name="length" id="length" class="input" aria-label="input"  value="{{ isset($_POST['length'])?$_POST['length']:'7' }}" />
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
                        <div class="w-full my-2">
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['2']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['draw'], 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['3']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['arrow'], 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['4']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['draw_cm'], 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['5']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['arrow_cm'], 2)}}</td>
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