<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="temperature" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="temperature" id="temperature" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temperature']) ? $_POST['temperature'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="temperature_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temperature_unit_dropdown')">{{ isset($_POST['temperature_unit'])?$_POST['temperature_unit']:'°C' }} ▾</label>
                        <input type="text" name="temperature_unit" value="{{ isset($_POST['temperature_unit'])?$_POST['temperature_unit']:'°C' }}" id="temperature_unit" class="hidden">
                        <div id="temperature_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="temperature_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temperature_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temperature_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temperature_unit', 'K')">K</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12">
                    <label for="point" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="point" id="point" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['point']) ? $_POST['point'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="point_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('point_unit_dropdown')">{{ isset($_POST['point_unit'])?$_POST['point_unit']:'°C' }} ▾</label>
                        <input type="text" name="point_unit" value="{{ isset($_POST['point_unit'])?$_POST['point_unit']:'°C' }}" id="point_unit" class="hidden">
                        <div id="point_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="point_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('point_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('point_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('point_unit', 'K')">K</p>
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
                        <div class="w-full">
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['3']}}</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded d-inline-block my-3">

                                    <strong class="text-white">{{ round($detail['answer'], 2) }}%</strong>
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@push('calculatorJS')
    
@endpush
