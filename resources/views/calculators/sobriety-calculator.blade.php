<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="input" class="text-[14px text-blue one_text">{{$lang['1']}}:</label>
                    <div class="w-100 py-2">
                        <input type="date" step="any" name="input" id="input" class="input" aria-label="input"
                            value="{{ isset(request()->input) ? request()->input : date('Y-m-d', strtotime('+ 170 days')) }}" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="input2" class="text-[14px text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="date" step="any" name="input2" id="input2" class="input" aria-label="input"
                            value="{{ isset(request()->input2) ? request()->input2 : date('Y-m-d') }}" />
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
                        <div class="w-full md:w-[60%] lg:w-[60%] ">
                            <div class="grid grid-cols-12 mt-3  gap-4 ">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 bg-[#F6FAFC] text-center p-3" style="border: 1px solid #c1b8b899;">
                                    <div class="border-r">
                                        <p class="text-[18px]">{{$lang['1']}}</p>
                                        <p><strong class="text-[#119154] font-s-25">{{$detail['from']}}</strong></p>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 bg-[#F6FAFC] text-center p-3"  style="border: 1px solid #c1b8b899;">
                                    <div class="ps-lg-4 ps-2 ">
                                        <p class="text-[18px]">{{$lang['3']}}</p>
                                        <p><strong class="text-[#119154] font-s-25">{{$detail['to']}}</strong></p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-[18px] mt-3 mb-2"> <strong class="text-[#119154] text-[22px]">{{$detail['years']}} </strong> {{$lang[4]}} , <strong class="text-green-700 text-[22px]">{{$detail['months']}}</strong> {{$lang[5]}} {{$lang[6]}} <strong class="text-green-700 text-[22px]">{{$detail['days']}}</strong> {{$lang[7]}}</p>
                            </div>
            
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td width="60%" class="border-b py-2">{{$detail['years']}} <span class="text-[14px">{{$lang[4]}}</span></td>
                                    <td class="border-b py-2">{{floor($detail['d1_ans'])}} <span class="text-[14px">{{$lang[7]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$detail['mon_ans']}} <span class="text-[14px">{{$lang[5]}}</span></td>
                                    <td class="border-b py-2">{{floor($detail['days'])}} <span class="text-[14px">{{$lang[7]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$detail['weeks']}} <span class="text-[14px">{{$lang[9]}}</span></td>
                                    <td class="border-b py-2">{{floor($detail['wd_ans'])}} <span class="text-[14px">{{$lang[7]}}</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{floor($detail['days_ans'])}}</td>
                                    <td class="border-b py-2">{{$lang[7]}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{floor($detail['hours_ans'])}}</td>
                                    <td class="border-b py-2">{{$lang[10]}}</td>
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
