<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 text-center">
                <input type="radio" name="stype" id="bedtime" value="bedtime" checked {{ isset($_POST['stype']) && $_POST['stype'] === 'bedtime' ? 'checked' : '' }}>
                <label for="bedtime" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['1'] }}:</label>
                <input type="radio" name="stype" id="wkup" value="wkup" {{ isset($_POST['stype']) && $_POST['stype'] === 'wkup' ? 'checked' : '' }}>
                <label for="wkup" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
            </div>
            <div class="col-span-12">
                <label for="h" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <input type="time" step="any" max="23" min="0" name="h" id="h" class="input" aria-label="input"  value="{{ isset($_POST['h'])?$_POST['h']:'09:26:56' }}" />
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
                        @if($detail['stype'] == 'bedtime')
                            <p class="text-center text-[20px]"><strong>{{$lang[1]}}</strong></p>
                            <p class="mt-3">
                               {{$lang['5']}}
                            </p>
                            <p class="mt-3">
                                {{$lang['6']}}
                            </p>
                        @else
                            <p class="mt-3">
                               {{$lang['5']}}
                            </p>
                            <p class="mt-3">
                                {{$lang['7']}}
                            </p>
                            <p class="text-center text-[20px] mt-2"><strong>{{$lang[2]}}</strong></p>
                        @endif
                        <div class="grid grid-cols-12 gap-5 my-3">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6" style="border: 1px solid #c1b8b899">
                                <div class="flex bg-[#F6FAFC] rounded-lg px-3 py-2 justify-between">
                                    <p><strong class="text-[#119154]">{{ $detail['time']}}</strong></p>
                                    <p><strong>{{$lang[4]}}</strong></p>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6" style="border: 1px solid #c1b8b899">
                                <div class="flex bg-[#F6FAFC] rounded-lg px-3 py-2 justify-between">
                                    <p><strong class="text-[#119154]">{{ $detail['time2']}}</strong></p>
                                    <p><strong>{{$lang[4]}}</strong></p>
                                </div>
                            </div>

                        </div>
                        <div class="grid grid-cols-12 gap-5">
                            <div class="col-span-12 md:col-span-3 lg:col-span-3 text-center" style="border: 1px solid #c1b8b899">
                                <p class="bg-[#F6FAFC] px-3 py-2 rounded-lg"><strong class="text-[#119154]">{{$detail['time3']}}</strong></p>
                            </div>
                            <div class="col-span-12 md:col-span-3 lg:col-span-3 text-center" style="border: 1px solid #c1b8b899">
                                <p class="bg-[#F6FAFC] px-3 py-2 rounded-lg"><strong class="text-[#119154]">{{$detail['time4']}}</strong></p>
                            </div>
                            <div class="col-span-12 md:col-span-3 lg:col-span-3 text-center" style="border: 1px solid #c1b8b899">
                                <p class="bg-[#F6FAFC] px-3 py-2 rounded-lg"><strong class="text-[#119154]">{{$detail['time5']}}</strong></p>
                            </div>
                            <div class="col-span-12 md:col-span-3 lg:col-span-3 text-center" style="border: 1px solid #c1b8b899">
                                <p class="bg-[#F6FAFC] px-3 py-2 rounded-lg"><strong class="text-[#119154]">{{$detail['time6']}}</strong></p>
                            </div>
                        </div>
                        @if($detail['stype'] == 'bedtime')
                            <p class="mt-3">
                                {{$lang['8']}}
                            </p>
                            <p class="mt-3">
                                {{$lang['9']}}
                            </p>
                        @else
                            <p class="mt-3">
                                {{$lang['8']}}
                            </p>
                            <p class="mt-3">
                                {{$lang['9']}}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>