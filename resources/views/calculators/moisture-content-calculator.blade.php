<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12">
                    <label for="wet" class="font-s-14 text-blue">{{ $lang['wet'] }} :</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="wet" id="wet" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wet']) ? $_POST['wet'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="wet_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wet_unit_dropdown')">{{ isset($_POST['wet_unit'])?$_POST['wet_unit']:'mg' }} ▾</label>
                        <input type="text" name="wet_unit" value="{{ isset($_POST['wet_unit'])?$_POST['wet_unit']:'mg' }}" id="wet_unit" class="hidden">
                        <div id="wet_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wet_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wet_unit', 'mg')">mg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wet_unit', 'g')">g</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wet_unit', 'oz')">oz</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wet_unit', 'kg')">kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wet_unit', 'lb')">lb</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12">
                    <label for="dry" class="font-s-14 text-blue">
                        {{ $lang['dry'] }} :
                </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="dry" id="dry" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dry']) ? $_POST['dry'] : '1.5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dry_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dry_unit_dropdown')">{{ isset($_POST['dry_unit'])?$_POST['dry_unit']:'mg' }} ▾</label>
                        <input type="text" name="dry_unit" value="{{ isset($_POST['dry_unit'])?$_POST['dry_unit']:'mg' }}" id="dry_unit" class="hidden">
                        <div id="dry_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dry_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dry_unit', 'mg')">mg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dry_unit', 'g')">g</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dry_unit', 'oz')">oz</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dry_unit', 'kg')">kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dry_unit', 'lb')">lb</p>
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
                <div class="col-12 bg-light-blue  p-3 radius-10 mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['moisture']}}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3"><strong class="text-blue">{{$detail['mc']}} %</strong></p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endisset
</form>