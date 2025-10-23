<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 ">
                    <label for="pq1" class="font-s-14 text-blue" >{{ $lang['1']}} 1</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="pq1" id="pq1" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pq1']) ? $_POST['pq1'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pq1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pq1_unit_dropdown')">{{ isset($_POST['pq1_unit'])?$_POST['pq1_unit']:'mm' }} ▾</label>
                        <input type="text" name="pq1_unit" value="{{ isset($_POST['pq1_unit'])?$_POST['pq1_unit']:'mm' }}" id="pq1_unit" class="hidden">
                        <div id="pq1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pq1_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq1_unit', 'mm')">mm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq1_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq1_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq1_unit', 'km')">km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq1_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq1_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq1_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq1_unit', 'mi')">mi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq1_unit', 'fur')">fur</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 ">
                    <label for="pq2" class="font-s-14 text-blue" >{{ $lang['1']}} 2</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="pq2" id="pq2" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pq2']) ? $_POST['pq2'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pq2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pq2_unit_dropdown')">{{ isset($_POST['pq2_unit'])?$_POST['pq2_unit']:'mm' }} ▾</label>
                        <input type="text" name="pq2_unit" value="{{ isset($_POST['pq2_unit'])?$_POST['pq2_unit']:'mm' }}" id="pq2_unit" class="hidden">
                        <div id="pq2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pq2_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq2_unit', 'mm')">mm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq2_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq2_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq2_unit', 'km')">km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq2_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq2_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq2_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq2_unit', 'mi')">mi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pq2_unit', 'fur')">fur</p>
                        </div>
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full font-s-18">
                            <tr>
                                <td class="py-2 border-b" width="40%"><strong>{{ $lang[3] }} </strong></td>
                                <td class="py-2 border-b"> {{ $detail['upr'] }} : {{ $detail['btm']}}</td>
                            </tr>
                            <tr>
                            <td class="py-2 border-b" width="40%"><strong>{{$lang['1']}} 1 {{$lang['9']}} </strong></td>
                                <td class="py-2 border-b"> <span>{{$detail['res']}}</span> {{$lang['2']}} {{$lang['1']}} 2</td>
                            </tr>
                            <tr>
                            <td class="py-2 border-b" width="40%"><strong>{{$lang['1']}} 2 {{$lang['9']}} </strong></td>
                                <td class="py-2 border-b"> <span>{{$detail['res1']}}</span> {{$lang['2']}} {{$lang['1']}} 1</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12  text-[16px]">
                            <p class="mt-2"><b>{{$lang['4']}}:</b></p>
                            @if(isset($detail['check']))
                                <p class="mt-2"><strong>{{$lang['6']}}</strong> {{$detail['pq1'].' : '.$detail['pq2']}}</p>
                            @else
                                @if(isset($detail['cnvrt1']))
                                    <p class="mt-2"><strong>{{$lang['7']}}</strong></p>
                                    <p class="mt-2">{{$lang['1']}} 1 = {{$detail['cnvrt1']}}</p>
                                    <p class="mt-2"><strong>{{$lang['6']}}</strong> {{$detail['cnvrt1'].' : '.$detail['pq2']}}{{$detail['cnvrt1'].' : '.$detail['pq2']}}</p>
                                @else
                                    <p class="mt-2"><strong>{{$lang['7']}}</strong></p>
                                    <p class="mt-2">{{$lang['1']}} 2 = {{$detail['cnvrt2']}}</p>
                                    <p class="mt-2"><strong>{{$lang['6']}}</strong> {{$detail['pq1'].' : '.$detail['cnvrt2']}}</p>
                                @endif
                            @endif
                            <p class="mt-2"><strong>{{$lang['8']}}</strong>  {{$detail['upr'].' : '.$detail['btm']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>