<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                @php
                    if(!isset($detail)) {
                        $_POST['method'] = "Pf";
                    }
                @endphp
                <div class="col-span-12">
                    <label for="x" class="label">{{$lang['enter']}} {{$lang['comoa']}}:</label>
                    <div class="w-100 py-2">
                        <textarea aria-label="textarea input" id="x" name="x" class="textareaInput" id="textarea" placeholder="10, 20, 30">{{ isset($_POST['x'])?$_POST['x']:'12, 44, 10, 8, 18, 20, 26' }}</textarea>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="method" class="label">{{$lang['m']}}:</label>
                    <div class="w-100 py-2">
                        <select name="method" class="input" id="method" aria-label="select">
                            <option value="none">{{$lang['none']}}</option>
                            <option value="lm" {{ isset($_POST['method']) && $_POST['method']=='lm'?'selected':'' }}>{{$lang['list']}}</option>
                            <option value="Pf" {{ isset($_POST['method']) && $_POST['method']=='Pf'?'selected':'' }}>{{$lang['prime']}}</option>
                            <option value="gcf" {{ isset($_POST['method']) && $_POST['method']=='gcf'?'selected':'' }}>{{$lang['gcf']}}</option>
                            <option value="cl" {{ isset($_POST['method']) && $_POST['method']=='cl'?'selected':'' }}>{{$lang['cake']}}</option>
                            <option value="dm" {{ isset($_POST['method']) && $_POST['method']=='dm'?'selected':'' }}>{{$lang['divi']}}</option>
                        </select>
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
                            @if($_POST['method']=='none')
                                <div class="w-full text-center font-s-20">
                                    <p>{{$lang['of_']}} {{$_POST['x']}}</p>
                                    <p class="my-3"><strong class="bg-white px-3 py-2 font-s-32 radius-10 text-blue">{{$detail['lcm']}}</strong></p>
                                </div>
                            @elseif($_POST['method']=='lm')
                                <div class="w-full md:w-[80%] lg:w-[80%]">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="80%"><strong>{{$lang['of_']}} {{$_POST['x']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['lcm']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full text-[16px]">
                                    <p class="mt-2"><strong>{{$lang['sol']}} ({{$lang['list']}}) :</strong></p> 
                                    <p class="mt-2">{{$lang['find']}}.</p>
                                    <p class="mt-2">{{$lang['val']}} : ({{$_POST['x']}})</p>
                                    <p class="mt-2">{{$lang['to_f']}}</p>
                                    <p class="mt-2"> {{$lang['multi']}} {{$_POST['x']}}:</p>
                                    <p class="mt-2"> {!!$detail['sl']!!}</p>
                                    <p class="mt-2">{{$lang['there']}} ({{$_POST['x']}}) {{$lang['hc']}} "{{$detail['lcm']}}".</p>
                                    <p class="mt-2">{{$lang['so']}} ({{$_POST['x']}}) = "{{$detail['lcm']}}"</p>
                                </div>
                            @elseif($_POST['method']=='Pf')
                                <div class="w-full md:w-[80%] lg:w-[80%]">
                                    <table class="w-full text-[16px]">
                                        <tr>
                                            <td class="py-2 border-b" width="80%"><strong>{{$lang['of_']}} {{$_POST['x']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['lcm']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full text-[16px]">
                                    <p class="mt-2"><strong>{{$lang['sol']}}  ({{$lang['prime']}}):</strong></p> 
                                    <p class="mt-2">{{$lang['val']}} : ({{$_POST['x']}})</p>
                                    <p class="mt-2">{{$lang['to_f']}}</p>
                                    <p class="mt-2">{{$lang['list_p']}}:</p>
                                    <p class="mt-2">{!!$detail['sl']!!}</p>
                                    <p class="mt-2">{{$lang['for_']}}</p>
                                    <p class="mt-2">{{$lang['new']}} = {{$detail['ss']}} = {{$detail['lcm']}}</p>
                                    <p class="mt-2">{{$lang['of_']}} ({{$_POST['x']}}) {{$lang['is']}} "{{$detail['lcm']}}"</p>
                                </div>
                            @elseif($_POST['method']=='gcf')
                                <div class="w-full md:w-[80%] lg:w-[80%]">
                                    <table class="w-full text-[16px]">
                                        <tr>
                                            <td class="py-2 border-b" width="80%"><strong>{{$lang['of_']}} {{$_POST['x']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['lcm']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full text-[16px]">
                                    <p class="mt-2"><strong>{{$lang['sol']}}  ({{$lang['gcf']}}) :</strong></p> 
                                    <p class="mt-2">{{$lang['val']}} : ({{$_POST['x']}})</p>
                                    <p class="mt-2">{{$lang['to_f']}}</p>
                                    <p class="mt-2">LCM= (a x b)/ GCF (a,b)</p>
                                    <p class="mt-2">{!!$detail['lce']!!}</p>
                                    <p class="mt-2">{{$lang['of_']}} ({{$_POST['x']}}) =  "{{$detail['lcm']}}"</p>
                                </div>
                            @elseif($_POST['method']=='cl')
                                <div class="w-full md:w-[80%] lg:w-[80%]">
                                    <table class="w-full text-[16px]">
                                        <tr>
                                            <td class="py-2 border-b" width="80%"><strong>LCM of {{$_POST['x']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['lcm']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full text-[16px]">
                                    <p class="mt-2"><strong>{{$lang['sol']}}  ({{$lang['cake'].' '.$lang['m']}}) :</strong></p> 
                                    <p class="mt-2">{{$lang['val']}} : ({{$_POST['x']}})</p>
                                    <p class="mt-2">{{$lang['to_f']}}</p>
                                    <p class="mt-2">{{$lang['cake']}}</p>
                                    <table class="col-8">
                                        @php
                                            $forPrint = -1;
                                        @endphp
                                        @foreach ($detail['fd'] as $key => $item)
                                            @if($key === 0)
                                                <tr>
                                                    <td class="py-2 border-b text-center"><strong>{{$item}}</strong></td>
                                                    @foreach ($detail['ev'] as $evValue)
                                                        <td class="py-2 border-b text-center">{{$evValue}}</td>
                                                    @endforeach
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="py-2 border-b text-center"><strong>{{$item}}</strong></td>
                                                    @for ($i = 0; $i < count($detail['ev']); $i++)
                                                        @php
                                                            $forPrint += 1;
                                                        @endphp
                                                        @if (isset($detail['sd'][$forPrint]))
                                                            <td class="py-2 border-b text-center">{{$detail['sd'][$forPrint]}}</td>
                                                        @endif
                                                    @endfor
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td class="py-2 border-b text-center">&nbsp;</td>
                                            @for ($i = 0; $i < count($detail['ev']); $i++)
                                                @php
                                                    $forPrint += 1;
                                                @endphp
                                                @if (isset($detail['sd'][$forPrint]))
                                                    <td class="py-2 border-b text-center">{{$detail['sd'][$forPrint]}}</td>
                                                @endif
                                            @endfor
                                        </tr>
                                    </table>
                                    <p class="mt-2"> {{$lang['lcm_is']}}. </p>
                                    <p class="mt-2">
                                        LCM = {{$detail['sl']}}
                                    </p>
                                    <p class="mt-2"> LCM = {{$detail['lcm']}}</p>
                                    <p class="mt-2"> {{$lang['of_']}} ({{$_POST['x']}}) = "{{$detail['lcm']}}"</p>
                                </div>
                            @else
                                <div class="w-full md:w-[80%] lg:w-[80%]">
                                    <table class="w-full text-[16px]">
                                        <tr>
                                            <td class="py-2 border-b" width="80%"><strong>{{$lang['of_']}} {{$_POST['x']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['lcm']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full text-[16px]">
                                    <p class="mt-2"><strong>{{$lang['sol']}}  ({{$lang['divi']}}) :</strong></p> 
                                    <p class="mt-2">{{$lang['write']}}.</p>
                                    <p class="mt-2">{{$lang['simply']}}</p>
                                    <p class="mt-2">{{$lang['divis']}}:</p>
                                    <table class="col-8">
                                        @php
                                            $forPrint = -1;
                                        @endphp
                                        @foreach ($detail['fd'] as $key => $item)
                                            @if($key === 0)
                                                <tr>
                                                    <td class="py-2 border-b text-center"><strong>{{$item}}</strong></td>
                                                    @foreach ($detail['ev'] as $evValue)
                                                        <td class="py-2 border-b text-center">{{$evValue}}</td>
                                                    @endforeach
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="py-2 border-b text-center"><strong>{{$item}}</strong></td>
                                                    @for ($i = 0; $i < count($detail['ev']); $i++)
                                                        @php
                                                            $forPrint += 1;
                                                        @endphp
                                                        @if (isset($detail['sd'][$forPrint]))
                                                            <td class="py-2 border-b text-center">{{$detail['sd'][$forPrint]}}</td>
                                                        @endif
                                                    @endfor
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td class="py-2 border-b text-center">&nbsp;</td>
                                            @for ($i = 0; $i < count($detail['ev']); $i++)
                                                @php
                                                    $forPrint += 1;
                                                @endphp
                                                @if (isset($detail['sd'][$forPrint]))
                                                    <td class="py-2 border-b text-center">{{$detail['sd'][$forPrint]}}</td>
                                                @endif
                                            @endfor
                                        </tr>
                                    </table>
                                    <p class="mt-2">{{$lang['need']}}</p>
                                    <p class="mt-2">{{$lang['rem']}}</p>
                                    <p class="mt-2">{{$lang['you_n']}}</p>
                                    <p class="mt-2">LCM = {{$detail['sl']}}</p>
                                    <p class="mt-2">LCM = {{$detail['lcm']}}</p>
                                    <p class="mt-2">{{$lang['of_']}} ({{$_POST['x']}}) = "{{$detail['lcm']}}"</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    
    @endisset
</form>