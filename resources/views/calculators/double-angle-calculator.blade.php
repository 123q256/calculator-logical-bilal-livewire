<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                if (!isset($detail)) {
                    $_POST['dem'] = "2";
                }
            @endphp
            <div class="col-span-12">
                <label for="unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="unit" id="unit">
                        <option value="1">deg °</option>
                        <option value="2" {{ isset($_POST['unit']) && $_POST['unit']=='2'?'selected':'' }}>rad</option>
                        <option value="3" {{ isset($_POST['unit']) && $_POST['unit']=='3'?'selected':'' }}>3* π radD</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="angle" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="angle" id="angle" value="{{ isset($_POST['angle'])?$_POST['angle']:'45' }}" class="input" aria-label="input" />
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
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['sin']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['cos']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['tan']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full">
                                <p class="mt-2"><strong>Solution</strong></p>
                                <p class="mt-2">
                                    {{$lang['2']}} = 
                                    @if($detail['unit']==='1')
                                        {{$detail['angle']}}°
                                    @elseif($detail['unit']==='2')
                                        {{$detail['angle']}} rad = {{$detail['deg']}}°
                                    @else
                                        {{$detail['angle']}} π = {{$detail['deg']}}°
                                    @endif
                                </p>
                                <p class="mt-2">{{$lang[3]}}</p>
                                <p class="mt-2">sin(2θ) = 2.sin(θ) - cos(θ)</p>
                                <p class="mt-2">sin(2 × {{$detail['deg']}}°) = 2.sin({{$detail['deg']}}°) - cos({{$detail['deg']}}°)</p>
                                <p class="mt-2">= 2 × {{round(sin($detail['red']),5)}} × {{round(cos($detail['red']),5)}}</p>
                                <p class="mt-2">= {{$detail['sin']}}</p>
                                <p class="mt-2">{{$lang[4]}}</p>
                                <p class="mt-2">cos(2θ) = 1 - 2.sin²(θ)</p>
                                <p class="mt-2">cos(2 × {{$detail['deg']}}°) = 1 - 2.sin²({{$detail['deg']}}°)</p>
                                <p class="mt-2">= 1 - 2 × {{round(sin($detail['red']),5)}} × {{round(sin($detail['red']),5)}}</p>
                                <p class="mt-2">= {{$detail['cos']}}</p>
                                <p class="mt-2">{{$lang[5]}}</p>
                                <p class="mt-2">
                                    tan(2θ) = 
                                    <span class="quadratic_fraction">
                                        <span class="num">2.tan(θ)</span>
                                        <span>1 - tan²(θ)</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    tan(2 × {{$detail['deg']}}°) = 
                                    <span class="quadratic_fraction">
                                        <span class="num">2.tan({{$detail['deg']}}°)</span>
                                        <span>1 - tan²({{$detail['deg']}}°)</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    =  
                                    <span class="quadratic_fraction">
                                        <span class="num">2 × {{round(tan($detail['red']),5)}}</span>
                                        <span>1 - ({{round(tan($detail['red']),5)}})²</span>
                                    </span>
                                </p>
                                <p class="mt-2">= {{$detail['tan']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>