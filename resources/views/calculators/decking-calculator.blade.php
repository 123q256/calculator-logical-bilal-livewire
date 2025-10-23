<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
   
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <p class="col-span-12"><strong>{{ $lang['1'] }}</strong></p>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="deck_length" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="deck_length" id="deck_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['deck_length'])?$_POST['deck_length']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="deck_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('deck_length_unit_dropdown')">{{ isset($_POST['deck_length_unit'])?$_POST['deck_length_unit']:'cm' }} ▾</label>
                        <input type="text" name="deck_length_unit" value="{{ isset($_POST['deck_length_unit'])?$_POST['deck_length_unit']:'cm' }}" id="deck_length_unit" class="hidden">
                        <div id="deck_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="deck_length_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deck_length_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deck_length_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deck_length_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deck_length_unit', 'ft')">feet (ft)</p>
                        </div>
                    </div>
                 </div>
                 <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="deck_width" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="deck_width" id="deck_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['deck_width'])?$_POST['deck_width']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="deck_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('deck_width_unit_dropdown')">{{ isset($_POST['deck_width_unit'])?$_POST['deck_width_unit']:'cm' }} ▾</label>
                        <input type="text" name="deck_width_unit" value="{{ isset($_POST['deck_width_unit'])?$_POST['deck_width_unit']:'cm' }}" id="deck_width_unit" class="hidden">
                        <div id="deck_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="deck_width_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deck_width_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deck_width_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deck_width_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deck_width_unit', 'ft')">feet (ft)</p>
                        </div>
                    </div>
                 </div>
               
                <p class="col-span-12 mt-1"><strong>{{ $lang['4'] }}</strong></p>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="board_length" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="board_length" id="board_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['board_length'])?$_POST['board_length']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="board_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('board_length_unit_dropdown')">{{ isset($_POST['board_length_unit'])?$_POST['board_length_unit']:'cm' }} ▾</label>
                        <input type="text" name="board_length_unit" value="{{ isset($_POST['board_length_unit'])?$_POST['board_length_unit']:'cm' }}" id="board_length_unit" class="hidden">
                        <div id="board_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="board_length_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('board_length_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('board_length_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('board_length_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('board_length_unit', 'ft')">feet (ft)</p>
                        </div>
                    </div>
                 </div>
    
                 <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="board_width" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="board_width" id="board_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['board_width'])?$_POST['board_width']:'1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="board_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('board_width_unit_dropdown')">{{ isset($_POST['board_width_unit'])?$_POST['board_width_unit']:'cm' }} ▾</label>
                        <input type="text" name="board_width_unit" value="{{ isset($_POST['board_width_unit'])?$_POST['board_width_unit']:'cm' }}" id="board_width_unit" class="hidden">
                        <div id="board_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="board_width_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('board_width_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('board_width_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('board_width_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('board_width_unit', 'ft')">feet (ft)</p>
                        </div>
                    </div>
                 </div>
             
              
                <p class="col-span-12 mt-1"><strong>{{ $lang['5'] }}</strong></p>
                <div class="col-span-12  flex align-items-center mt-2 font-s-14">
                    <p class="col-span-12 text-blue">{{ $lang['6'] }}:</p>
                    <input type="radio" class="mx-2" name="material" id="first" value="screws" checked {{ isset(request()->material) && request()->material === 'screws' ? 'checked' : '' }}>
                    <label for="first" class="font-s-14 text-blue ps-lg-1 pe-2">{{ $lang['7'] }}</label>
                    <input type="radio" class="mx-2" name="material" id="second" value="hidden" {{ isset(request()->material) && request()->material === 'hidden' ? 'checked' : '' }}>
                    <label for="second" class="font-s-14 ps-lg-1 text-blue">{{ $lang['8'] }}</label>
                </div>
                <p class="col-span-12 mt-1"><strong>{{ $lang['9'] }}</strong></p>
            
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="price" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                    <div class="w-100 py-2 relative"> 
                        <input type="number" step="any" name="price" id="price" class="input" aria-label="input"  value="{{ isset(request()->price)?request()->price:'17' }}" />
                        <span class="input_unit text-blue">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="Cost" class="font-s-14 text-blue">{{ $lang['11'] }}</label>
                    <div class="w-100 py-2 relative"> 
                        <input type="number" step="any" name="Cost" id="Cost" class="input" aria-label="input"  value="{{ isset(request()->Cost)?request()->Cost:'196' }}" />
                        <span class="input_unit text-blue">{{$currancy}}</span>
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


               
                    


    @else
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result mt-5">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full mb-2">
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td width="50%" class="border-b py-2"><strong><?= $lang['12'] ?> :</strong></td>
                                        <td class="border-b py-2"><?= $detail['size_deck'] ?> <span class="font-s-14">ft² (<?= $lang['14'] ?>)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="pt-3 pb-2" colspan="2">{{$lang['15']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">cm² :</td>
                                        <td class="border-b py-2">{{round($detail['size_deck'] * 929, 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">m² :</td>
                                        <td class="border-b py-2">{{round($detail['size_deck'] / 10.764, 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">In² :</td>
                                        <td class="py-2">{{ round($detail['size_deck']  * 144, 4)}}</td>
                                    </tr>
                                        {{--  --}}
                                    <tr>
                                        <td class="border-b pt-3 pb-2"><strong><?= $lang['16'] ?> :</strong></td>
                                        <td class="border-b pt-3 pb-2"><?= $detail['size_board'] ?> <span class="font-s-14">ft² (<?= $lang['14'] ?>)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="pt-3 pb-2" colspan="2">{{$lang['17']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">cm² :</td>
                                        <td class="border-b py-2">{{round($detail['size_board'] * 929, 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">m² :</td>
                                        <td class="border-b py-2">{{round($detail['size_board'] / 10.764, 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">In² :</td>
                                        <td class="py-2">{{ round($detail['size_board']  * 144, 4)}}</td>
                                    </tr>
                                        {{--  --}}
                                    <tr>
                                        <td class="border-b pb-2 pt-4"><strong><?= $lang['5'] ?> :</strong></td>
                                        <td class="border-b pb-2 pt-4"><?= $detail['numbers'] ?> <span class="font-s-14"><?= $lang['18'] ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['5'] ?> :</strong></td>
                                        @if((request()->material === 'hidden'))
                                            <td class="border-b py-2"><?= $detail['clips'] ?> <span class="font-s-14"><?= $lang['19'] ?></span></td>
                                        @else
                                            <td class="border-b py-2"><?= $detail['nails'] ?> <span class="font-s-14"><?= $lang['20'] ?></span></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['9'] ?> :</strong></td>
                                        <td class="border-b py-2"><?=$currancy .' '. $detail['price_boards'] ?> <span class="font-s-14"><?= $lang['21'] ?></span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['9'] ?> :</strong></td>
                                        <td class="border-b py-2"><?= $currancy .' '.$detail['Cost_boards'] ?> <span class="font-s-14"><?= $lang['22'] ?></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-[20px]">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                @if (app()->getLocale() == 'en')
                                    RESET
                                @else
                                    {{ $lang['reset'] ?? 'RESET' }}
                                @endif
                            </a>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    @endif
</form>