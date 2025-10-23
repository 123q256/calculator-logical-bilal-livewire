<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                <label for="kills" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <input type="text" name="kills" id="kills" class="input" aria-label="input" value="{{ isset($_POST['kills']) ? $_POST['kills'] : '12' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                <label for="deaths" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 ">
                    <input type="text" name="deaths" id="deaths" class="input" aria-label="input" value="{{ isset($_POST['deaths']) ? $_POST['deaths'] : '23' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4">
                <label for="assists" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="text" name="assists" id="assists" class="input" aria-label="input" value="{{ isset($_POST['assists']) ? $_POST['assists'] : '' }}" />
                    <span class="input_unit text-blue">Optional</span>
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
                                        <td width="60%" class="border-b py-2"><strong>{{$lang['4']}}</strong></td>
                                        <td class="border-b py-2">{{round($detail['kd_ratio'],4)}}</td>
                                    </tr>
                                    @if(!empty($detail['kda_ratio']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['5']}}</strong></td>
                                            <td class="border-b py-2">{{round($detail['kda_ratio'],4)}}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
