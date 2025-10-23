<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="w-full lg:w-9/12 mx-auto">
            <div class="flex flex-col">
                @if(isset($error))
                    <p class="text-lg text-center text-red-500 font-bold"><strong>{{ $error }}</strong></p>
                @endif
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-5">
                    <div class="px-2 lg:px-4">
                        <label for="first" class="label">{!! $lang['1'] !!}:</label>
                        <div class="relative py-2">
                            <input type="number" step="any" name="first" id="first" class="input w-full" aria-label="input" placeholder="00" value="{{ isset($_POST['first']) ? $_POST['first'] : '31' }}" />
                            <span class="absolute right-2 top-4 text-[#3E9960] input-unit">mlU/ml</span>
                        </div>
                    </div>
                    <div class="px-2 lg:px-4">
                        <label for="second" class="label">{!! $lang['2'] !!}:</label>
                        <div class="relative py-2">
                            <input type="number" step="any" name="second" id="second" class="input w-full" aria-label="input" placeholder="00" value="{{ isset($_POST['second']) ? $_POST['second'] : '54' }}" />
                            <span class="absolute right-2 top-4  input-unit">mlU/ml</span>
                        </div>
                    </div>
                    <div class="w-full px-2 lg:pl-4">
                        <label for="third" class="label">{!! $lang['3'] !!}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="third" id="third" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-[#3E9960] w-full" value="{{ isset($_POST['third'])?$_POST['third']:'160' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit3_dropdown')">{{ isset($_POST['unit3'])?$_POST['unit3']: $lang['4'] }} ▾</label>
                            <input type="text" name="unit3" value="{{ isset($_POST['unit3'])?$_POST['unit3']: $lang['4'] }}" id="unit3" class="hidden">
                            <div id="unit3_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', '{{ $lang['4'] }}')">{{ $lang['4'] }}</p>
                                <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', '{{ $lang['5'] }}')">{{ $lang['5'] }}</p>
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
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full  rounded-lg mt-3">
                        <div class="w-full mt-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div class="px-3" style="min-height: 70px;">
                                    <div class="flex items-center bg-[#F6FAFC] text-black border rounded-lg px-3 py-2 h-full">
                                        <p class="w-1/2"><strong>{{ $lang['7'] }}</strong></p>
                                        <p class="w-1/2 text-right">
                                            <strong class="text-green text-2xl">{{ $detail['difference'] }}</strong>
                                            <span class="text-green ml-2">(mlU/ml)</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 mt-3 md:mt-0" style="min-height: 70px;">
                                    <div class="flex items-center bg-[#F6FAFC] text-black border rounded-lg px-3 py-2 h-full">
                                        <p class="w-1/2"><strong>{{ $lang['8'] }}</strong></p>
                                        <p class="w-1/2 text-right">
                                            <strong class="text-green text-2xl">{{ round($detail['percent'], 2) }}</strong>
                                            <span class="text-green ml-2">(%)</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 mt-3" style="min-height: 70px;">
                                    <div class="flex items-center bg-[#F6FAFC] text-black border rounded-lg px-3 py-2 h-full">
                                        <p class="w-1/2"><strong>{{ $lang['9'] }}</strong></p>
                                        <p class="w-1/2 text-right">
                                            <strong class="text-green text-2xl">{{ round($detail['t2'], 2) }}</strong>
                                            <span class="text-green ml-2">(days)</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 mt-3" style="min-height: 70px;">
                                    <div class="flex items-center bg-[#F6FAFC] text-black border rounded-lg px-3 py-2 h-full">
                                        <p class="w-1/2"><strong>{{ $lang['10'] }}</strong></p>
                                        <p class="w-1/2 text-right">
                                            <strong class="text-green text-2xl">{{ round($detail['i1'], 2) }}</strong>
                                            <span class="text-green ml-2">(%)</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 mt-3" style="min-height: 70px;">
                                    <div class="flex items-center bg-[#F6FAFC] text-black border rounded-lg px-3 py-2 h-full">
                                        <p class="w-1/2"><strong>{{ $lang['11'] }}</strong></p>
                                        <p class="w-1/2 text-right">
                                            <strong class="text-green text-2xl">{{ round($detail['i2'], 2) }}</strong>
                                            <span class="text-green ml-2">(%)</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>