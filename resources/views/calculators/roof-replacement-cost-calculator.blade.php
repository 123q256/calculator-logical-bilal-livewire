<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
   
 <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="size1" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <input type="number" step="any" name="size1" id="size1" class="input" aria-label="input"  value="{{ isset($_POST['size1'])?$_POST['size1']:'46' }}" />
                    <span class="input_unit text-blue">ft</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="size2" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <input type="number" step="any" name="size2" id="size2" class="input" aria-label="input"  value="{{ isset($_POST['size2'])?$_POST['size2']:'44' }}" />
                    <span class="input_unit text-blue">ft</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="slop" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <select class="input" name="slop" id="slop">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'], $lang['5'], $lang['6'], $lang['7'],$lang['8'],$lang['9'],$lang['10']];
                            $val = ["zero","three","five","seven","nine","ten","twelve"];
                            optionsList($val,$name,isset($_POST['slop'])?$_POST['slop']:'seven');
                        @endphp
                    </select>
                </div>
              
                <div class="space-y-2 relative">
                    <label for="difficulty" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                    <select class="input" name="difficulty" id="difficulty">
                        @php
                            $name = [$lang['12'],$lang['13'], $lang['14']];
                            $val = ["Simple","Medium","Difficult"];
                            optionsList($val,$name,isset($_POST['difficulty'])?$_POST['difficulty']:'Medium');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="existing" class="font-s-14 text-blue">{{ $lang['15'] }}:</label>
                    <select class="input" name="existing" id="existing">
                        @php
                            $name = ["YES - 1 layer", "YES - 2 layers", "NO tear-off"];
                            $val = ["yes","yes2","no"];
                            optionsList($val,$name,isset($_POST['existing'])?$_POST['existing']:'yes');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="floor" class="font-s-14 text-blue">{{ $lang['16'] }}:</label>
                    <select class="input" name="floor" id="floor">
                        @php
                            $name = [$lang['17'],$lang['18'],$lang['19']];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset($_POST['floor'])?$_POST['floor']:'2');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="material" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                    <select class="input" name="material" id="material">
                        @php
                            $name = [$lang['21'],$lang['22'], $lang['23'], $lang['24'],$lang['25'],$lang['26'],$lang['27'],$lang['28'],$lang['29'],$lang['30']];
                            $val = ["0","1","11","4","5","6","7","12","13","14"];
                            optionsList($val,$name,isset($_POST['material'])?$_POST['material']:'1');
                        @endphp
                    </select>
                </div>
              
                <div class="space-y-2 relative">
                    <label for="region" class="font-s-14 text-blue">{{ $lang['31'] }}:</label>
                    <select class="input" name="region" id="region" autocomplete="off">
                        @php
                            $name = [$lang['32'],$lang['33'],$lang['34'],$lang['35'],$lang['36'],$lang['37'],$lang['38'],$lang['39'],$lang['40'],$lang['41']];
                            $val = ["na","ne","ma","sa","esc","wsc","wnc","wnc","m","p"];
                            optionsList($val,$name,isset($_POST['region'])?$_POST['region']:'na');
                        @endphp
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
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full mt-2">
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18 ">
                                <table class="w-100">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['42']}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['result'][0] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['43'] }} :</strong></td>
                                        <td class="border-b py-2">{{ $detail['result'][1] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{ $lang['44'] }} :</strong></td>
                                        <td class="border-b py-2">{{ $detail['result'][2] }}</td>
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