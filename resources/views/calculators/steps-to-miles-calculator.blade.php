<style>
    .content table, .content th, .content td {
        border: 1px solid #9f9d9d;
        border-collapse: collapse;
        padding: 5px;
        text-align: center;
    }
    .content table tr:hover td {
        color: #fff !important;
        background-color: rgb(0, 0, 0) !important;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="methods" class="font-s-14 text-blue">Methods:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="methods" id="methods" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ['Average Stride Length','Your Height','Your Stride Length'];
                            $val = ["1","2",'3'];
                            optionsList($val,$name,isset(request()->methods)?request()->methods:'2');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="sex" class="font-s-14 text-blue">Gender:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="sex" id="sex" class="input">
                        @php
                            $name = ['Male','Female'];
                            $val = ["1","2"];
                            optionsList($val,$name,isset(request()->sex)?request()->sex:'1');
                        @endphp
                    </select>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="first" class="font-s-14 text-blue">Your Height:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'cm' }} ▾</label>
                    <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'cm' }}" id="unit" class="hidden">
                    <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'dm')">decimeters (dm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'ft')">feet (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'mi')">miles (mi)</p>
                    </div>
                 </div>
            </div>
           
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="steps" class="font-s-14 text-blue">Steps:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="steps" id="steps" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->steps)?request()->steps:'25' }}" />
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
                <div class="w-full p-3 mt-3">
                    <div class="col-12 text-center">
                        <p><strong>Distance</strong></p>
                        <p>
                            <strong class="text-[32px] text-green-700">{{ round($detail['answer'], 6) }}</strong>
                            <strong class="text-[18px] text-blue-700">(mi)</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>