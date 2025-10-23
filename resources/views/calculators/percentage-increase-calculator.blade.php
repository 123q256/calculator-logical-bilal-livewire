<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 bg-white rounded-lg shadow-md space-y-6 mb-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="start" class="label">{{$lang['1']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="start" id="start" class="input" value="{{ isset($_POST['start'])?$_POST['start']:'21' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="final" class="label">{{$lang['2']}}</label>
                <div class="w-full py-2">
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 bg-white rounded-lg shadow-md space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-fill  text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['3']}}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['ans'],5)}} %</td>
                                </tr>
                                @if($detail['ans'] < 0)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['4'] }}</strong></td>
                                        <td class="py-2 border-b">{{round(abs($detail['ans']),5)}} %</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['5'] }}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['dif'],5)}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full font-s-">
                            <p class="mt-2"><strong class="font-s-20">{{$lang['6']}}:</strong></p>
                            <p class="mt-3">{{$lang['1']}} = {{request()->start}}<br>
                            </p>
                            <p class="my-3">{{$lang['2']}} = {{request()->final}} </p>
                            <p>
                                <span class="fraction">
                                    <span class="num">{{$lang['8']}} - {{$lang['7']}}</span>
                                    <span class="visually-hidden"></span>
                                    <span class="den">|{{$lang['7']}}|</span>
                                </span> x 100
                            </p>
                            <p>
                                <span class="fraction">
                                    <span class="num">{{request()->final}} - {{request()->start}}</span>
                                    <span class="visually-hidden"></span>
                                    <span class="den">|{{request()->start}}|</span>
                                </span> x 100
                            </p>
                            <p>
                                <span class="fraction">
                                    <span class="num">{{$detail['dif']}}</span>
                                    <span class="visually-hidden"></span>
                                    <span class="den">{{request()->start}}</span>
                                </span> x 100
                            </p>
                            <p class="mt-3">{{$detail['ans1']}} x 100</p>
                            <p class="mt-3">
                                <span>{{$lang['3']}} = </span>
                                <span>{{round($detail['ans'],5)}} %</span>
                            </p>
                            @if($detail['ans'] < 0)
                                <p class="mt-3">
                                    <span>{{ $lang['4'] }} = </span>
                                    <span>{{round(abs($detail['ans']),5)}} %</span>
                                </p>
                            @endif
                            <p class="mt-3">
                                <span>{{ $lang['5'] }} = </span>
                                <span>{{round($detail['dif'],5)}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>