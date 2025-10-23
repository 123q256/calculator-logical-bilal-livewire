<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                    
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="win" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" name="win" id="win" class="input" aria-label="input" value="{{ isset($_POST['win'])?$_POST['win']:'2' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="loss" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" name="loss" id="loss" class="input" aria-label="input" value="{{ isset($_POST['loss'])?$_POST['loss']:'4' }}" />
                    </div>
                </div> 
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="tie" class="label">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" name="tie" id="tie" class="input" aria-label="input" value="{{ isset($_POST['tie'])?$_POST['tie']:'4' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="value" class="label">{{ $lang['4'] }}(Optional):</label>
                    <div class="w-100 py-2">
                        <input type="number" name="value" id="value" class="input" aria-label="input" value="{{ isset($_POST['value'])?$_POST['value']:'' }}" />
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
                        <div class="w-full md:w-[60%] lg:w-[60%] text-[18px]">
                            <table class="w-100">
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong>{{$lang['6']}} :</strong></td>
                                    <td class="border-b py-2">{{round($detail['ans'],2)}} %</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['7']}} :</strong></td>
                                    <td class="border-b py-2">{{$detail['no_games']}}</td>
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