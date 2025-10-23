<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
            <div class="col-12 px-2">
                <label for="room_width" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" step="any" name="room_width" id="room_width" class="input" aria-label="input"  value="{{ isset($_POST['room_width'])?$_POST['room_width']:'7' }}" />
                    <span class="input_unit text-blue">ft</span>
                </div>
            </div>
            <div class="col-12 px-2 mt-0 mt-lg-2 ">
                <label for="room_length" class="font-s-14 text-blue">
                        {{ $lang['2'] }}:
                </label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="room_length" id="room_length" class="input" aria-label="input"  value="{{ isset($_POST['room_length'])?$_POST['room_length']:'7' }}" />
                    <span class="input_unit text-blue">ft</span>
                </div>
            </div> 
            <div class="col-12 px-2 mt-0 mt-lg-2">
                <label for="ceiling_height" class="font-s-14 text-blue">
                        {{ $lang['3'] }}:
                </label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="ceiling_height" id="ceiling_height" class="input" aria-label="input"  value="{{ isset($_POST['ceiling_height'])?$_POST['ceiling_height']:'4' }}" />
                    <span class="input_unit text-blue">ft</span>
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
                                        <td class="border-b py-2"><strong>{{ $lang['3']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['squareFootage'], 2)}} ft<sup>2</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['5'] }} :</strong></td>
                                        <td class="border-b py-2">{{  $detail['fanSize']  }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['6'] }} :</strong></td>
                                        <td class="border-b py-2">{{  $detail['downrodLength'] }}</td>
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