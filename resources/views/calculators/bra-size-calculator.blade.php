<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="w-full lg:w-7/12 mx-auto">
            <div class="flex flex-col">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-5">
                    <div class="px-2">
                        <label for="bust" class="label">{{ $lang['1'] }}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="bust" id="bust" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-[#3E9960] w-full" value="{{ isset($_POST['bust'])?$_POST['bust']:'34' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'in' }} ▾</label>
                            <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'in' }}" id="unit" class="hidden">
                            <div id="unit_dropdown" class="absolute z-10 p-2 bg-white border border-gray-300 rounded-md lg:w-[70%] md:w-[70%] w-[70%] mt-1 right-0 hidden">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'in')">inches (in)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'cm')">centimeters (cm)</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <label for="band" class="label">{{ $lang['2'] }}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="band" id="band" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-[#3E9960] w-full" value="{{ isset($_POST['band'])?$_POST['band']:'32' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'in' }} ▾</label>
                            <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'in' }}" id="unit1" class="hidden">
                            <div id="unit1_dropdown" class="absolute z-10 p-2 bg-white border border-gray-300 rounded-md lg:w-[70%] md:w-[70%] w-[70%] mt-1 right-0 hidden">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'in')">inches (in)</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'cm')">centimeters (cm)</p>
                            </div>
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
        {{-- result --}}
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full  p-3 rounded-lg mt-3 result">
                        <div class="w-full mt-2">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr>
                                        <th class="text-[#2845F5] text-left border-b py-3">{{ $lang['3'] }}</th>
                                        <th class="text-[#2845F5] text-left border-b py-3">{{ $lang['4'] }}</th>
                                        <th class="text-[#2845F5] text-left border-b py-3">{{ $lang['5'] }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-b py-3"><strong>US/CA</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['band'] }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][0] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong>UK</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['band'] }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][2] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong>US/CA ({{ $lang['6'] }} +4)</strong></td>
                                        <td class="border-b py-3"><strong>{{ (int)$detail['band'] + 4 }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][0] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong>UK ({{ $lang['6'] }} +4)</strong></td>
                                        <td class="border-b py-3"><strong>{{ (int)$detail['band'] + 4 }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][2] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong>EU</strong></td>
                                        <td class="border-b py-3"><strong>{{ (is_numeric($detail['eu']) ? $detail['eu'].' cm' : $detail['eu']) }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][3] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3"><strong>FR/ES/BE</strong></td>
                                        <td class="border-b py-3"><strong>{{ (is_numeric($detail['fr']) ? $detail['fr'].' cm' : $detail['fr']) }}</strong></td>
                                        <td class="border-b py-3"><strong>{{ $detail['ans'][4] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-3"><strong>Australia/New Zealand</strong></td>
                                        <td class="py-3"><strong>{{ (is_numeric($detail['aus']) ? 'dress code '.$detail['aus'] : $detail['aus']) }}</strong></td>
                                        <td class="py-3"><strong>{{ $detail['ans'][1] }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
    @endisset
</form>