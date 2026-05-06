<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[50%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="d_units" class="font-s-14 text-blue one_text">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="units" id="d_units" class="input">
                                <option value="Centimeters">Centimeters</option>
                                <option value="Feet and Inches">Feet and Inches</option>
                            </select>
                        </div>
                    </div>

                    @if ($units == 'Centimeters')
                        <div class="col-span-12">
                            <label for="height" class="font-s-14 text-blue">{{ $lang['2'] }} ({{ $lang['3'] }}):</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="height" id="height" class="input">
                                    @for ($cm = 150; $cm <= 205; $cm++)
                                        <option value="{{ $cm }}">{{ $cm }} cm</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12">
                            <label for="height2" class="font-s-14 text-blue">{{ $lang['2'] }} ({{ $lang['3'] }}):</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="height2" id="height2" class="input">
                                    @php
                                        $feet_inches = [
                                            "149.86" => "4' 11", "151.13" => "4' 11 ½", "152.4" => "5", "153.67" => "5' ½", 
                                            "154.94" => "5' 1", "156.21" => "5' 1½", "157.48" => "5' 2", "158.75" => "5' 2½", 
                                            "160.02" => "5' 3", "161.29" => "5' 3½", "162.56" => "5' 4", "163.83" => "5' 4½", 
                                            "165.1" => "5' 5", "166.37" => "5' 5½", "167.64" => "5' 6", "168.91" => "5' 6½", 
                                            "170.18" => "5' 7", "171.45" => "5' 7½", "172.72" => "5' 8", "173.99" => "5' 8½", 
                                            "175.26" => "5' 9", "176.53" => "5' 9½", "177.8" => "5' 10", "179.07" => "5' 10½", 
                                            "180.34" => "5' 11", "181.61" => "5' 11½", "182.88" => "6", "184.15" => "6' ½", 
                                            "185.42" => "6' 1", "186.69" => "6' 1½", "187.96" => "6' 2", "189.23" => "6' 2½", 
                                            "190.5" => "6' 3", "191.77" => "6' 3½", "193.04" => "6' 4", "194.31" => "6' 4½", 
                                            "195.58" => "6' 5", "196.85" => "6' 5½", "198.12" => "6' 6", "199.39" => "6' 6½", 
                                            "200.66" => "6' 7", "201.93" => "6' 7½", "203.2" => "6' 8", "204.47" => "6' 8½", "205.74" => "6' 9"
                                        ];
                                    @endphp
                                    @foreach ($feet_inches as $val => $name)
                                        <option value="{{ $val }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="col-span-12">
                        <label for="position" class="font-s-14 text-blue">{{ $lang['4'] }} ({{ $lang['5'] }}):</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="position" id="position" class="input">
                                <option value="0">{{ $lang['6'] }}</option>
                                <option value="1">{{ $lang['7'] }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
        <hr>
        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full mt-3">
                                <div class="grid grid-cols-12 mt-3 gap-8">
                                    <div class="col-span-12 md:col-span-7 lg:col-span-8">
                                        @php
                                            $u = $detail['units'] == "Centimeters" ? "cm" : "in";
                                        @endphp
                                        <p class="text-[22px] font-bold text-gray-800 mb-4">{{ $lang['8'] }}</p>
                                        
                                        @if ($detail['position'] == "0")
                                            <div class="mb-6">
                                                <div class="flex justify-between border-b py-3">
                                                    <strong class="text-blue-700">* {{ $lang['9'] }} :</strong>
                                                    <span class="text-[20px] font-bold">{{ $detail['ans1'] }} <span class="text-sm font-normal">{{ $u }}</span></span>
                                                </div>
                                                <p class="mt-2 text-sm">{{ $lang['10'] }} 90-110°</p>
                                            </div>
                                        @endif

                                        <div class="mb-6">
                                            <div class="flex justify-between border-b py-3">
                                                <strong class="text-blue-700">* {{ $lang['11'] }} :</strong>
                                                <span class="text-[20px] font-bold">{{ $detail['ans2'] }} <span class="text-sm font-normal">{{ $u }}</span></span>
                                            </div>
                                            <p class="mt-2 text-sm">
                                                @if ($detail['position'] == "0")
                                                    {{ $lang['12'] }} 90-110°. {{ $lang['13'] }}.
                                                @else
                                                    {{ $lang['14'] }} 90-110°
                                                @endif
                                            </p>
                                        </div>

                                        <div class="mb-6">
                                            <div class="flex justify-between border-b py-3">
                                                <strong class="text-blue-700">* {{ $lang['15'] }} :</strong>
                                                <span class="text-[20px] font-bold">{{ $detail['ans3'] }} <span class="text-sm font-normal">{{ $u }}</span></span>
                                            </div>
                                            <p class="mt-2 text-sm">{{ $lang['16'] }}.</p>
                                        </div>

                                        <div class="mt-8 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                                            <p class="text-[16px] leading-relaxed">
                                                <span class="font-bold text-blue-900">{{ $lang['17'] }} : </span>{{ $lang['18'] }}.
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-span-12 md:col-span-5 lg:col-span-4 flex flex-col items-center justify-center rounded-xl p-6">
                                        @if ($detail['position'] == "0")
                                            <img src="{{ asset('images/desk1.svg') }}" class="w-full max-w-[230px] h-auto drop-shadow-lg" alt="Sitting Posture">
                                            <p class="mt-4 text-sm font-bold uppercase">Sitting Guide</p>
                                        @else
                                            <img src="{{ asset('images/desk2.svg') }}" class="w-full max-w-[200px] h-auto drop-shadow-lg" alt="Standing Posture">
                                            <p class="mt-4 text-sm font-bold uppercase">Standing Guide</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>
