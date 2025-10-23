<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
           

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                @php
                if (!isset($detail)) {
                    $_POST['rof'] = "3";
                }
            @endphp
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="to_calculate" class="font-s-14 text-blue">{{ $lang['know'] }}:</label>
                    <select class="input" aria-label="select" name="to_calculate" id="to_calculate">
                        <option value="rad" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='rad'?'selected':'' }}><?=$lang['rad']?></option>
                        <option value="tsa" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='tsa'?'selected':'' }}><?=$lang['tsa']?></option>
                        <option value="vol" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='vol'?'selected':'' }}><?=$lang['vol']?></option>
                        <option value="csa" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='csa'?'selected':'' }}><?=$lang['cfa']?></option>
                        <option value="cf" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='cf'?'selected':'' }}><?=$lang['bc']?></option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="value" class="font-s-14 text-blue">
                        {{$lang['enter']}} 
                        <span id="textChanged">
                            @if(isset($_POST['to_calculate']) && $_POST['to_calculate']=='tsa')
                                {{$lang['tsa']}}
                            @elseif(isset($_POST['to_calculate']) && $_POST['to_calculate']=='vol')
                                {{$lang['vol']}}
                            @elseif(isset($_POST['to_calculate']) && $_POST['to_calculate']=='csa')
                                {{$lang['cfa']}}
                            @elseif(isset($_POST['to_calculate']) && $_POST['to_calculate']=='cf')
                                {{$lang['bc']}}
                            @else
                                {{$lang['rad']}}
                            @endif
                        </span>
                    </label>
                    <div class="relative w-full ">
                        <input type="number" name="value" id="value" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['value'])?$_POST['value']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'in' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'in' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'm')">meters (m)</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="rof" class="font-s-14 text-blue">{{ $lang['round'] }}:</label>
                    <select class="input" aria-label="select" name="rof" id="rof">
                        <option value="0" {{ isset($_POST['rof']) && $_POST['rof']=='0'?'selected':'' }}>0</option>
                        <option value="1" {{ isset($_POST['rof']) && $_POST['rof']=='1'?'selected':'' }}>1</option>
                        <option value="2" {{ isset($_POST['rof']) && $_POST['rof']=='2'?'selected':'' }}>2</option>
                        <option value="3" {{ isset($_POST['rof']) && $_POST['rof']=='3'?'selected':'' }}>3</option>
                        <option value="4" {{ isset($_POST['rof']) && $_POST['rof']=='4'?'selected':'' }}>4</option>
                        <option value="5" {{ isset($_POST['rof']) && $_POST['rof']=='5'?'selected':'' }}>5</option>
                        <option value="6" {{ isset($_POST['rof']) && $_POST['rof']=='6'?'selected':'' }}>6</option>
                        <option value="7" {{ isset($_POST['rof']) && $_POST['rof']=='7'?'selected':'' }}>7</option>
                        <option value="8" {{ isset($_POST['rof']) && $_POST['rof']=='8'?'selected':'' }}>8</option>
                        <option value="9" {{ isset($_POST['rof']) && $_POST['rof']=='9'?'selected':'' }}>9</option>
                        <option value="10" {{ isset($_POST['rof']) && $_POST['rof']=='10'?'selected':'' }}>10</option>
                    </select>
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
        <div>
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg flex items-center ">
                <div class="w-full md:w-[50%] lg:w-[50%] rounded-lg mt-3">
                    <div class=" flex-col space-y-3">
                        <div class="w-full mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['rad']}}</td>
                                    <td class="py-2 border-b border-gray-300">{{$detail['radi']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['bc']}}</td>
                                    <td class="py-2 border-b border-gray-300">{{$detail['cs']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['vol']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['vs']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['cfa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['as']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['bsa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['as']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['tsa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['tsas']!!}</td>
                                </tr>
                            </table>
                        </div>
                        <p class="mt-3 text-lg"><strong>In terms of Pi π</strong></p>
                        <div class="w-full mt-3">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['bc']}}</td>
                                    <td class="py-2 border-b border-gray-300">{{$detail['pcs']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['vol']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['pvs']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['cfa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['pas']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['bsa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['pbs']!!}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-gray-300 w-3/5">{{$lang['tsa']}}</td>
                                    <td class="py-2 border-b border-gray-300">{!!$detail['ptsas']!!}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('to_calculate').addEventListener('change', function() {
                if(this.value === "rad"){
                    document.getElementById('textChanged').textContent = "{{$lang['rad']}}";
                }else if(this.value === "tsa"){
                    document.getElementById('textChanged').textContent = "{{$lang['tsa']}}";
                }else if(this.value === "vol"){
                    document.getElementById('textChanged').textContent = "{{$lang['vol']}}";
                }else if(this.value === "csa"){
                    document.getElementById('textChanged').textContent = "{{$lang['cfa']}}";
                }else{
                    document.getElementById('textChanged').textContent = "{{$lang['bc']}}";
                }
            });
        </script>
    @endpush
</form>