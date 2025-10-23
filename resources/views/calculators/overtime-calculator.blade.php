<style>
    #onetw{
       background: transparent;
       border: none;
       color: #1670a7;
       outline: none;
   }
   @media (max-width: 430px) {
       .calculator-box{
           padding-right: 0.5rem;
           padding-left: 0.5rem;
       }
   }
   .orange_color{
       color: #CC6E29;
   }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
   @csrf
 
         
         

   <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[90%] md:w-[90%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2">
                        <label for="pay" class="font-s-14 text-blue">{{ $lang['2'] }} {{ $currancy}}</label>
                        <div class="relative w-full ">
                            <input type="number" name="pay" id="pay" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pay'])?$_POST['pay']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="per" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('per_dropdown')">{{ isset($_POST['per'])?$_POST['per']:'tt' }} ▾</label>
                            <input type="text" name="per" value="{{ isset($_POST['per'])?$_POST['per']:'tt' }}" id="per" class="hidden">
                            <div id="per_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[25%] md:w-[25%] w-[25%] mt-1 right-0 hidden">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per', 'hour')">{{isset($lang['hrs']) ? $lang['hrs']:"hour"}}</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per', 'day')">{{isset($lang['dys']) ? $lang['dys']:"day"}}</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per', 'week')">{{isset($lang['wks']) ? $lang['wks']:"week"}}</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per', 'month')">{{isset($lang['mos']) ? $lang['mos']:"month"}}</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per', 'anualy')">{{isset($lang['yrs']) ? $lang['yrs']:"anualy"}}</p>

                            </div>
                        </div>
                    </div>


                    <div class="grid grid-cols-5 lg:grid-cols-5 md:grid-cols-5 gap-4">
                        <div class="col-span-3 space-y-2">
                            <label for="per" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                            <select name="overtime" id="overtime" class="input mt-2">
                                <option value="half" {{ isset($_POST['overtime']) && $_POST['overtime'] == 'half' ? '':'selected'}}>{{isset($lang['half_t']) ? $lang['half_t'] :"Time and a Half"}}</option>
                                <option value="double" {{ isset($_POST['overtime']) && $_POST['overtime'] == 'double' ? 'selected':''}}>{{isset($lang['duble_t']) ? $lang['duble_t'] :"Double Time"}}</option>
                                <option value="triple" {{ isset($_POST['overtime']) && $_POST['overtime'] == 'triple' ? 'selected':''}}>{{isset($lang['triple_t']) ? $lang['triple_t'] :"Triple Time"}}</option>
                                <option value="other" {{ isset($_POST['overtime']) && $_POST['overtime'] == 'other' ? 'selected':''}}>{{isset($lang['other']) ?  $lang['other']:"Other"}}</option>
                            </select>
                        </div>
                        <div class="col-span-2 space-y-2">
                            <label class="block text-sm font-medium text-gray-700">&nbsp;</label>
                            <input type="number" step="any" name="multi" min="0" readOnly id="multi" class="input" aria-label="input" placeholder="0" value="{{ isset($_POST['multi']) ? $_POST['multi'] : '1.5' }}" />
                        </div>
                    </div>
                    
                    <div class="space-y-2 relative">
                        <label for="time" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <input type="number" step="any" name="time" id="time" class="input" placeholder="{{$lang['opt']}}" aria-label="input" value="{{ isset($_POST['time'])?$_POST['time']:'' }}" />
                        <span class="input_unit text-blue">hrs</span>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="over" class="font-s-14 text-blue">{{ $lang['12'] }}</label>
                        <input type="number" step="any" name="over" min="0" id="over" class="input" placeholder="{{$lang['opt']}}" aria-label="input" value="{{ isset($_POST['over'])?$_POST['over']:'' }}" />
                             <span class="input_unit text-blue">hrs</span>
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
            <div class="w-full p-3 radius-10 mt-3">
                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1  mt-2">
                    @if($device == 'mobile')
                        <div>
                            <p><strong>{{ $lang['13'] }}</strong></p>
                            <p class="pb-1 border-b d-flex justify-content-between">
                                <span class="or1">
                                    {{$currancy}}
                                    <strong class="orange_color font-s-18">  {{ $detail['overPayPerHour'] }} </strong>
                                </span>
                                <span>
                                    <img src="{{ url('assets/icons/copy.png') }}" alt="Copy" title="Copy" width="20" height="20" class="me-3 cursor-pointer copy_result" onclick="copyResult()">
                                </span>
                            </p>
                        </div>
                        @if(request()->over)
                            <div class="pt-2">
                                <p><strong>{{$lang['18']}}</strong></p>
                                <p class="pb-1 border-b d-flex justify-content-between">
                                    <span class="or2">    
                                        {{$currancy}} <strong class="orange_color font-s-18">  {{ $detail['overTotalPay'] }}</strong> 
                                    </span>
                                    <span>
                                        <img src="{{ url('assets/icons/copy.png') }}" alt="Copy" title="Copy" width="20" height="20" class="me-3 cursor-pointer copy_result" onclick="copyResult2()">
                                    </span></p>
                            </div>
                        @endif
                        @if(request()->time)
                            <div class="pt-2">
                                <p><strong>{{$lang['19']}}</strong></p>
                                <p class="pb-1 border-b  d-flex justify-content-between">
                                    <span class="or3">
                                        {{$currancy}} <strong class="orange_color font-s-18"> {{ $detail['regPay'] }}</strong>   
                                    </span>
                                    <span>
                                        <img src="{{ url('assets/icons/copy.png') }}" alt="Copy" title="Copy" width="20" height="20" class="me-3 cursor-pointer copy_result" onclick="copyResult3()">
                                    </span>
                                </p>
                            </div>
                        @endif
                        @if(request()->time && request()->over)
                            <div class="pt-2">
                                <p><strong>{{$lang['14']}}</strong></p>
                                <p class=" d-flex justify-content-between"> 
                                    <span class="or4">
                                        {{$currancy}} <strong class="orange_color font-s-18" id="circle_result">{{ $detail['total'] }}</strong> 
                                        <select name="circle_unit_result" id="onetw" class="d-inline">
                                            @php
                                                function optionsList($arr1,$arr2,$unit){
                                                foreach($arr1 as $index => $name){
                                            @endphp
                                                <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                                    {{ $arr2[$index] }}
                                                </option>
                                            @php
                                                }}
                                                $name = ["Per Week","Per Month","Per Year"];
                                                $val = ["week","month","year"];
                                                optionsList($val,$name,isset($_POST['circle_unit_result'])?$_POST['circle_unit_result']:'month');
                                            @endphp
                                        </select>
                                    </span>
                                    <span>
                                        <img src="{{ url('assets/icons/copy.png') }}" alt="Copy" title="Copy" width="20" height="20" class="me-3 cursor-pointer copy_result" onclick="copyResult4()">
                                    </span>
                                </p>
                            </div>
                        @endif
                    @else
                        <table class="w-100">
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['13'] }}</strong></td>
                                <td class="py-2 border-b"> {{$currancy}} {{ $detail['overPayPerHour'] }} <span class="font-s-14">{{ $lang['15']}}</span></td>
                            </tr>
                            <tr>
                            @if(request()->over)
                            <td class="py-2 border-b"><strong>{{$lang['18']}}</strong></td>
                                <td class="py-2 border-b"> {{$currancy}} {{ $detail['overTotalPay'] }} <span class="font-s-14">{{ $lang['16']}}</span></td>
                            </tr>
                            @endif
                            @if(request()->time)
                            <tr>
                                <td class="py-2 border-b"><strong>{{$lang['19']}}</strong></td>
                                <td class="py-2 border-b"> {{$currancy}} {{ $detail['regPay'] }} <span class="font-s-14">{{ $lang['16']}}</span></td>
                            </tr>
                            @endif
                            @if(request()->time && request()->over)
                            <tr>
                                <td class="py-2 border-b"><strong>{{$lang['14']}}</strong></td>
                                <td class="py-2 border-b"> {{$currancy}} <span id="circle_result">{{ $detail['total'] }}</span> 
                                    <select name="circle_unit_result" id="onetw" class="d-inline">
                                        @php
                                            function optionsList($arr1,$arr2,$unit){
                                            foreach($arr1 as $index => $name){
                                        @endphp
                                            <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                                {{ $arr2[$index] }}
                                            </option>
                                        @php
                                            }}
                                            $name = ["Per Week","Per Month","Per Year"];
                                            $val = ["week","month","year"];
                                            optionsList($val,$name,isset($_POST['circle_unit_result'])?$_POST['circle_unit_result']:'month');
                                        @endphp
                                    </select>
                                </td>
                            </tr>
                            @endif
                        </table>   
                    @endif
              </div>
            </div>
        </div>
    </div>
</div>


   @endisset
</form>
@push('calculatorJS')
   <script>
       function copyElementText(className) {
           var a = document.createRange();
           a.selectNode(document.querySelector(className)),
           window.getSelection().removeAllRanges(),
           window.getSelection().addRange(a),
           document.execCommand("copy"),
           window.getSelection().removeAllRanges();
       }
       function copyResult(){
           copyElementText('.or1');
           var x = document.getElementById("snackbar");
           x.className = "show";
           setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
       }
       function copyElementText2(className) {
           var a = document.createRange();
           a.selectNode(document.querySelector(className)),
           window.getSelection().removeAllRanges(),
           window.getSelection().addRange(a),
           document.execCommand("copy"),
           window.getSelection().removeAllRanges();
       }
       function copyResult2(){
           copyElementText2('.or2');
           var x = document.getElementById("snackbar");
           x.className = "show";
           setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
       }
       function copyElementText3(className) {
           var a = document.createRange();
           a.selectNode(document.querySelector(className)),
           window.getSelection().removeAllRanges(),
           window.getSelection().addRange(a),
           document.execCommand("copy"),
           window.getSelection().removeAllRanges();
       }
       function copyResult3(){
           copyElementText3('.or3');
           var x = document.getElementById("snackbar");
           x.className = "show";
           setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
       }
       function copyElementText4(className) {
           var a = document.createRange();
           a.selectNode(document.querySelector(className)),
           window.getSelection().removeAllRanges(),
           window.getSelection().addRange(a),
           document.execCommand("copy"),
           window.getSelection().removeAllRanges();
       }
       function copyResult4(){
           copyElementText4('.or4');
           var x = document.getElementById("snackbar");
           x.className = "show";
           setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
       }

       document.getElementById('overtime').addEventListener('change',function(){
           var overtime = this.value;
           if(overtime == 'half'){
               document.getElementById('multi').value = '1.5'; 
               document.getElementById('multi').readOnly = true;
           }else if(overtime == 'double'){
               document.getElementById('multi').value = '2'; 
               document.getElementById('multi').readOnly = true;
           }else if(overtime == 'triple'){
               document.getElementById('multi').value = '3'; 
               document.getElementById('multi').readOnly = true;
           }else{
               document.getElementById('multi').value = ''; 
               document.getElementById('multi').readOnly = false;
           }
       });
       var total = "{{$detail['total']}}"
       @if(isset($detail))
               var overtime = document.getElementById('overtime').value;
               if(overtime == 'half'){
                   document.getElementById('multi').value = '1.5'; 
                   document.getElementById('multi').readOnly = true;
               }else if(overtime == 'double'){
                   document.getElementById('multi').value = '2'; 
                   document.getElementById('multi').readOnly = true;
               }else if(overtime == 'triple'){
                   document.getElementById('multi').value = '3'; 
                   document.getElementById('multi').readOnly = true;
               }else{
                   document.getElementById('multi').value = '{{ isset($_POST['multi']) ? $_POST['multi'] : '' }}'; 
                   document.getElementById('multi').readOnly = false;
               }
               @if(request()->time && request()->over)
                   document.addEventListener("DOMContentLoaded", () => {
                       const conversionFactors = {
                           'week': 4.344, 
                           'month': 1, 
                           'year': 12, 
                       };
                       const circleResultDiv = document.getElementById('circle_result');
                       const initialValue = parseFloat(circleResultDiv.innerHTML);
                       circleResultDiv.setAttribute('data-initial-value', initialValue);
           
                       document.getElementById('onetw').addEventListener('change', event => {
                           const unit = event.target.value;
                           const conversionFactor = conversionFactors[unit];
                               const originalValue = parseFloat(circleResultDiv.getAttribute('data-initial-value'));
                           if( unit == 'year'){
                               const newValue = originalValue * conversionFactor;
                               circleResultDiv.innerHTML = Number(newValue.toFixed(4)).toString() 
                           }else if(conversionFactor !== undefined) {
                               const newValue = originalValue / conversionFactor;
                               circleResultDiv.innerHTML = Number(newValue.toFixed(4)).toString()  // Set the new value with unit
                           } else {
                               console.error("Invalid conversion factor: " + unit);
                           }
                       });
                   });
               @endif
       @endif

   </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>