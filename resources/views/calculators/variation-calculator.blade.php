<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                if (!isset($detail)) {
                    $_POST['unit'] = "m";
                }
            @endphp
            <div class="col-span-12">
                <label for="select" class="label">Y:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="select" id="select">
                        <option value="1" {{ isset($_POST['select']) && $_POST['select']=='1'?'selected':'' }}>{{$lang['1']}} (X)</option>
                        <option value="2" {{ isset($_POST['select']) && $_POST['select']=='2'?'selected':'' }}>{{$lang['2']}} (X)</option>
                        <option value="3" {{ isset($_POST['select']) && $_POST['select']=='3'?'selected':'' }}>{{$lang['3']}} (X)</option>
                        <option value="4" {{ isset($_POST['select']) && $_POST['select']=='4'?'selected':'' }}>{{$lang['4']}} (X)</option>
                        <option value="5" {{ isset($_POST['select']) && $_POST['select']=='5'?'selected':'' }}>{{$lang['5']}} (X)</option>
                        <option value="6" {{ isset($_POST['select']) && $_POST['select']=='6'?'selected':'' }}>{{$lang['6']}} (X)</option>
                        <option value="7" {{ isset($_POST['select']) && $_POST['select']=='7'?'selected':'' }}>{{$lang['7']}} (X)</option>
                        <option value="8" {{ isset($_POST['select']) && $_POST['select']=='8'?'selected':'' }}>{{$lang['8']}} (X)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="y" class="label">{{$lang['9']}}  Y = </label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y" id="y" class="input" value="{{ isset($_POST['y'])?$_POST['y']:'31' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="x" class="label">{{$lang['10']}}  X = </label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x" id="x" class="input" value="{{ isset($_POST['x'])?$_POST['x']:'3' }}" aria-label="input"/>
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
                        <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                            <table class="w-full text-[16px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}} (k)</strong></td>
                                    <td class="py-2 border-b">{{round($detail['ans'],5)}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                    <td class="py-2 border-b">
                                        y = {{round($detail['ans'],5)}}
                                        @if($_POST['select']==='1')
                                            x
                                        @elseif($_POST['select']==='2')
                                            / x
                                        @elseif($_POST['select']==='3')
                                            x<sup class="font-s-14">2</sup>
                                        @elseif($_POST['select']==='4')
                                            x<sup class="font-s-14">3</sup>
                                        @elseif($_POST['select']==='5')
                                            √x
                                        @elseif($_POST['select']==='6')
                                            / x<sup class="font-s-14">2</sup>
                                        @elseif($_POST['select']==='7')
                                            / x<sup class="font-s-14">3</sup>
                                        @else
                                            / √x
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full  text-[16px] mt-3">
                            <p><strong>{{$lang[22]}}</strong></p>
                            @if($_POST['select']==='1')
                                <p class="mt-2">Y {{$lang[1]}} (X), y = {{$_POST['y']}} and x = {{$_POST['x']}}</p>
                                <p class="mt-2">{{$lang[13]}}:</p>
                                <p class="mt-2">y = kx</p>
                                <p class="mt-2">{{$lang[14]}} x = {{$_POST['x']}} and y = {{$_POST['y']}}</p>
                                <p class="mt-2">{{$_POST['y']}} = {{$_POST['x']}}k</p>
                                <p class="mt-2">k = {{$_POST['y']}} / {{$_POST['x']}}</p>
                                <p class="mt-2">{{$lang[11]}} (k) = {{round($detail['ans'],5)}}</p>
                                <p class="mt-2">{{$lang[12]}}: y = {{round($detail['ans'],5)}}x</p>
                            @elseif($_POST['select']==='2')
                                <p class="mt-2">Y {{$lang[2]}} (X), y = {{$_POST['y']}} and x = {{$_POST['x']}}</p>
                                <p class="mt-2">{{$lang[15]}}:</p>
                                <p class="mt-2">y = k/x</p>
                                <p class="mt-2">{{$lang[14]}} x = {{$_POST['x']}} and y = {{$_POST['y']}}</p>
                                <p class="mt-2">{{$_POST['y']}} = k/{{$_POST['x']}}</p>
                                <p class="mt-2">k = {{$_POST['y']}} * {{$_POST['x']}}</p>
                                <p class="mt-2">{{$lang[11]}} (k) = {{round($detail['ans'],5)}}</p>
                                <p class="mt-2">{{$lang[12]}}: y = {{round($detail['ans'],5)}} / x</p>
                            @elseif($_POST['select']==='3')
                                <p class="mt-2">Y {{$lang[3]}} (X), y = {{$_POST['y']}} and x = {{$_POST['x']}}</p>
                                <p class="mt-2">{{$lang[16]}}:</p>
                                <p class="mt-2">y = kx<sup class="font-s-14">2</sup></p>
                                <p class="mt-2">{{$lang[14]}} x = {{$_POST['x']}} and y = {{$_POST['y']}}</p>
                                <p class="mt-2">{{$_POST['y']}} = k({{$_POST['x']}})<sup class="font-s-14">2</sup></p>
                                <p class="mt-2">k = {{$_POST['y']}} / {{ pow($_POST['x'], 2) }}</p>
                                <p class="mt-2">{{$lang[11]}} (k) = {{round($detail['ans'],5)}}</p>
                                <p class="mt-2">{{$lang[12]}}: y = {{round($detail['ans'],5)}}x<sup class="font-s-14">2</sup></p>
                            @elseif($_POST['select']==='4')
                                <p class="mt-2">Y {{$lang[4]}} (X), y = {{$_POST['y']}} and x = {{$_POST['x']}}</p>
                                <p class="mt-2">{{$lang[17]}}:</p>
                                <p class="mt-2">y = kx<sup class="font-s-14">3</sup></p>
                                <p class="mt-2">{{$lang[14]}} x = {{$_POST['x']}} and y = {{$_POST['y']}}</p>
                                <p class="mt-2">{{$_POST['y']}} = k({{$_POST['x']}})<sup class="font-s-14">3</sup></p>
                                <p class="mt-2">k = {{$_POST['y']}} / {{ pow($_POST['x'], 3) }}</p>
                                <p class="mt-2">{{$lang[11]}} (k) = {{round($detail['ans'],5)}}</p>
                                <p class="mt-2">{{$lang[12]}}: y = {{round($detail['ans'],5)}}x<sup class="font-s-14">3</sup></p>
                            @elseif($_POST['select']==='5')
                                <p class="mt-2">Y {{$lang[5]}} (X), y = {{$_POST['y']}} and x = {{$_POST['x']}}</p>
                                <p class="mt-2">{{$lang[18]}}:</p>
                                <p class="mt-2">y = k√x</p>
                                <p class="mt-2">{{$lang[14]}} x = {{$_POST['x']}} and y = {{$_POST['y']}}</p>
                                <p class="mt-2">{{$_POST['y']}} = k√({{$_POST['x']}})</p>
                                <p class="mt-2">k = {{$_POST['y']}} / {{ pow($_POST['x'], 1/2) }}</p>
                                <p class="mt-2">{{$lang[11]}} (k) = {{round($detail['ans'],5)}}</p>
                                <p class="mt-2">{{$lang[12]}}: y = {{round($detail['ans'],5)}}√x</p>
                            @elseif($_POST['select']==='6')
                                <p class="mt-2">Y {{$lang[6]}} (X), y = {{$_POST['y']}} and x = {{$_POST['x']}}</p>
                                <p class="mt-2">{{$lang[19]}}:</p>
                                <p class="mt-2">y = k / x<sup class="font-s-14">2</sup></p>
                                <p class="mt-2">{{$lang[14]}} x = {{$_POST['x']}} and y = {{$_POST['y']}}</p>
                                <p class="mt-2">{{$_POST['y']}} = k / ({{$_POST['x']}})<sup class="font-s-14">2</sup></p>
                                <p class="mt-2">k = {{$_POST['y']}} * {{ pow($_POST['x'], 2) }}</p>
                                <p class="mt-2">{{$lang[11]}} (k) = {{round($detail['ans'],5)}}</p>
                                <p class="mt-2">{{$lang[12]}}: y = {{round($detail['ans'],5)}} / x<sup class="font-s-14">2</sup></p>
                            @elseif($_POST['select']==='7')
                                <p class="mt-2">Y {{$lang[7]}} (X), y = {{$_POST['y']}} and x = {{$_POST['x']}}</p>
                                <p class="mt-2">{{$lang[20]}}:</p>
                                <p class="mt-2">y = k / x<sup class="font-s-14">3</sup></p>
                                <p class="mt-2">{{$lang[14]}} x = {{$_POST['x']}} and y = {{$_POST['y']}}</p>
                                <p class="mt-2">{{$_POST['y']}} = k / ({{$_POST['x']}})<sup class="font-s-14">3</sup></p>
                                <p class="mt-2">k = {{$y.' * '.pow($x,3)}}</p>
                                <p class="mt-2">{{$lang[11]}} (k) = {{round($detail['ans'],5)}}</p>
                                <p class="mt-2">{{$lang[12]}}: y = {{round($detail['ans'],5)}} / x<sup class="font-s-14">3</sup></p>
                            @else
                                <p class="mt-2">Y {{$lang[8]}} (X), y = {{$_POST['y']}} and x = {{$_POST['x']}}</p>
                                <p class="mt-2">{{$lang[21]}}:</p>
                                <p class="mt-2">y = k / √x</p>
                                <p class="mt-2">{{$lang[14]}} x = {{$_POST['x']}} and y = {{$_POST['y']}}</p>
                                <p class="mt-2">{{$_POST['y']}} = k / √({{$_POST['x']}})</p>
                                <p class="mt-2">k = {{$y.' * '.pow($x,1/2)}}</p>
                                <p class="mt-2">{{$lang[11]}} (k) = {{round($detail['ans'],5)}}</p>
                                <p class="mt-2">{{$lang[12]}}: y = {{round($detail['ans'],5)}} / √x</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>