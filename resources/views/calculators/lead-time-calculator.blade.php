<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1  gap-4">
                <div class="space-y-2 relative">
                    <label for="type" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <select class="input" name="type" id="type">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['24'], $lang['25'],$lang['26']];
                            $val = ["manufac","order","supply"];
                            optionsList($val,$name,isset(request()->type)?request()->type:'manufac');
                        @endphp
                    </select>
                </div>
            </div>
                <div class="grid grid-cols-1 mt-4  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 days">
                    <label for="pre_time" class="font-s-14 text-blue">{{$lang['2']}}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="pre_time" id="pre_time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pre_time'])?$_POST['pre_time']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pre_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pre_units_dropdown')">{{ isset($_POST['pre_units'])?$_POST['pre_units']:'days' }} ▾</label>
                        <input type="text" name="pre_units" value="{{ isset($_POST['pre_units'])?$_POST['pre_units']:'days' }}" id="pre_units" class="hidden">
                        <div id="pre_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-1 right-0 hidden">
                            @foreach (["days", "sec", "min", "hrs", "wks", "mos" , "yrs"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_units', '{{$name}}<')">{{$name}}<</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 days">
                    <label for="p_time" class="font-s-14 text-blue">{{$lang['3']}}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="p_time" id="p_time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p_time'])?$_POST['p_time']:'20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="p_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('p_units_dropdown')">{{ isset($_POST['p_units'])?$_POST['p_units']:'days' }} ▾</label>
                        <input type="text" name="p_units" value="{{ isset($_POST['p_units'])?$_POST['p_units']:'days' }}" id="p_units" class="hidden">
                        <div id="p_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-1 right-0 hidden">
                            @foreach (["days", "sec", "min", "hrs", "wks", "mos" , "yrs"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_units', '{{$name}}<')">{{$name}}<</p>
                           @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 days">
                    <label for="post_time" class="font-s-14 text-blue">{{$lang['4']}}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="post_time" id="post_time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['post_time'])?$_POST['post_time']:'25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="post_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('post_units_dropdown')">{{ isset($_POST['post_units'])?$_POST['post_units']:'days' }} ▾</label>
                        <input type="text" name="post_units" value="{{ isset($_POST['post_units'])?$_POST['post_units']:'days' }}" id="post_units" class="hidden">
                        <div id="post_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-1 right-0 hidden">
                            @foreach (["days", "sec", "min", "hrs", "wks", "mos" , "yrs"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('post_units', '{{$name}}<')">{{$name}}<</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 date {{ isset(request()->type) && request()->type == 'order'? 'd-block' : 'hidden' }}">
                    <label for="place_time" class="font-s-14 text-blue">{{$lang['5']}}:</label>
                    <input type="datetime-local" step="any" name="place_time" id="place_time" class="input" aria-label="input"
                        value="{{ isset(request()->place_time) ? request()->place_time :'' }}" />
                 </div>
                 <div class="space-y-2 date {{ isset(request()->type) && request()->type == 'order'? 'd-block' : 'hidden' }}">
                    <label for="receive_time" class="font-s-14 text-blue">{{$lang['6']}}:</label>
                    <input type="datetime-local" step="any" name="receive_time" id="receive_time" class="input" aria-label="input"
                    value="{{ isset(request()->receive_time) ? request()->receive_time :'' }}" />
                 </div>
                 <div class="space-y-2 supplys {{ isset(request()->type) && request()->type == 'supply'? 'd-block' : 'hidden' }}">
                    <label for="s_delay" class="font-s-14 text-blue">{{$lang['7']}}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="s_delay" id="s_delay" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['s_delay'])?$_POST['s_delay']:'25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="supply_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('supply_units_dropdown')">{{ isset($_POST['supply_units'])?$_POST['supply_units']:'tt' }} ▾</label>
                        <input type="text" name="supply_units" value="{{ isset($_POST['supply_units'])?$_POST['supply_units']:'tt' }}" id="supply_units" class="hidden">
                        <div id="supply_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-1 right-0 hidden">
                            @foreach (["days", "sec", "min", "hrs", "wks", "mos" , "yrs"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('supply_units', '{{$name}}<')">{{$name}}<</p>
                            @endforeach
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 supplys {{ isset(request()->type) && request()->type == 'supply'? 'd-block' : 'hidden' }}">
                    <label for="r_delay" class="font-s-14 text-blue">{{$lang['8']}}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="r_delay" id="r_delay" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['r_delay'])?$_POST['r_delay']:'25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="r_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('r_units_dropdown')">{{ isset($_POST['r_units'])?$_POST['r_units']:'tt' }} ▾</label>
                        <input type="text" name="r_units" value="{{ isset($_POST['r_units'])?$_POST['r_units']:'tt' }}" id="r_units" class="hidden">
                        <div id="r_units_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-1 right-0 hidden">
                            @foreach (["days", "sec", "min", "hrs", "wks", "mos" , "yrs"] as $name)
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('r_units', '{{$name}}<')">{{$name}}<</p>
                            @endforeach
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
                        <div class="w-full my-2">
                            <div class="col-lg-7 font-s-18">
                                <?php if (isset($detail['type'])) { ?>
                                    @if (request()->type == 'manufac') 
                                        @php 
                                            $manufac = round($detail['manufac'], 2);
                                        @endphp
                                        <table class="w-100">
                                            <tr>
                                                <td width="60%" class="border-b py-2"><strong><?= $lang['9'] ?> :</strong></td>
                                                <td class="border-b py-2"><?= $manufac ?> <?= $lang['10'] ?></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?><?= $lang['12'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= $manufac * 86400 ?> <?= $lang['13'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?><?= $lang['14'] ?>  :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= $manufac * 1440 ?> <?= $lang['15'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['16'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= $manufac * 24 ?> <?= $lang['17'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['18'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= round(($manufac / 7),4) ?> <?= $lang['19'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['20'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= round(($manufac / 30.417),4) ?> <?= $lang['21'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['22'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= round(($manufac / 365),4) ?> <?= $lang['23'] ?>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                    @if (request()->type == 'order')
                                        @php 
                                            $timeDiff = $detail['diff_minutes'];
                                        @endphp
                                        <p><span><strong><?= $detail['timeDiff'] ?></strong></p>
                                        <table class="w-100">
                                            <tr>
                                                <td width="60%" class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['12'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= $timeDiff * 60 ?> <?= $lang['13'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['14'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= $timeDiff *  1 ?> <?= $lang['15'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['10'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= round($timeDiff / 1440) ?> <?= $lang['10'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['18'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= round($timeDiff / 10080,6) ?> <?= $lang['19'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['20'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= round($timeDiff / 43800,6) ?> <?= $lang['21'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['22'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                   <?= round($timeDiff / 525600,6) ?> <?= $lang['23'] ?>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                    @if(request()->type == 'supply')
                                        @php
                                            $supply = round($detail['supply'], 2); 
                                        @endphp
                                        <p><span><strong><?= $supply ?> <?= $lang['10'] ?></strong></p>
                                        <table class="w-100">
                                            <tr>
                                                <td  width="60%" class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['12'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                    <?= $supply * 86400 ?> <?= $lang['13'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['14'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                    <?= $supply * 1440 ?> <?= $lang['15'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['16'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                    <?= $supply * 24 ?> <?= $lang['17'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['18'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                    <?= round($supply / 7,4) ?> <?= $lang['19'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['20'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                    <?= round(($supply / 30.417),4) ?> <?= $lang['21'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">
                                                    <?= $lang['11'] ?> <?= $lang['22'] ?> :
                                                </td>
                                                <td class="border-b py-2">
                                                    <?= round(($supply / 365),4) ?> <?= $lang['23'] ?>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
                var value = document.getElementById("type").value;
                if (value == "manufac") {
                    document.querySelectorAll(".days").forEach(function(element){
                        element.style.display = "block";
                    });
                    document.querySelectorAll(".date, .supplys").forEach(function(element) {
                        element.style.display = "none";
                    });
                }
            @if(isset($detail) || isset($error))
                var value = document.getElementById("type").value;
                if (value == "manufac") {
                    document.querySelectorAll(".days").forEach(function(element){
                        element.style.display = "block";
                    });
                    document.querySelectorAll(".date, .supplys").forEach(function(element) {
                        element.style.display = "none";
                    });
                    
                } else if(value == "supply"){
                    document.querySelectorAll(".date, .days").forEach(function(element) {
                        element.style.display = "none";
                    });
                    document.querySelectorAll(".supplys").forEach(function(element){
                        element.style.display = "block";
                    });
                }else{
                    document.querySelectorAll(".supplys, .days").forEach(function(element) {
                        element.style.display = "none";
                    });
                    document.querySelectorAll(".date").forEach(function(element){
                        element.style.display = "block";
                    });
                }

            @endif
            document.getElementById("type").addEventListener("change", function() {
                var value = this.value;
                if (value == "manufac") {
                    document.querySelectorAll(".date, .supplys").forEach(function(element) {
                        element.style.display = "none";
                    });
                    document.querySelectorAll(".days").forEach(function(element){
                        element.style.display = "block";
                    })
                } else if(value == "supply"){
                    document.querySelectorAll(".date, .days").forEach(function(element) {
                        element.style.display = "none";
                    });
                    document.querySelectorAll(".supplys").forEach(function(element){
                        element.style.display = "block";
                    })
                }else{
                    document.querySelectorAll(".supplys, .days").forEach(function(element) {
                        element.style.display = "none";
                    });
                    document.querySelectorAll(".date").forEach(function(element){
                        element.style.display = "block";
                    })
                }
            });

        </script>
    @endpush
</form>
