<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4"> 
                    
                    <div class="col-span-6 hidden">
                        <label for="selection" class="font-s-14 text-blue one_text">{{$lang['1']}}:</label>
                        <div class="w-100 py-2">
                            <select id="selection" wire:model.live="tool" class="input">
                                <option value="calculator">{{ $lang['2'] }}</option>
                                <option value="converter">{{ $lang['3'] }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6 tno" x-show="$wire.tool === 'converter'" style="{{ $tool === 'converter' ? '' : 'display: none;' }}">
                        <label for="bnr_third" class="font-s-14 text-blue">{{$lang[4]}}:</label>
                        <div class="py-2">
                            <input class="input" type="text" id="bnr_third" wire:model.live="bnr_third" x-on:keypress="handleKeypress($event, $wire.select_base)">
                        </div>
                    </div>
                    
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 base mx-auto" :class="$wire.tool === 'calculator' ? 'ps-lg-3' : 'pe-lg-3'">
                        <label for="bnr_tpe1" class="font-s-14 text-blue select_base" x-text="$wire.tool === 'calculator' ? 'Select Base' : 'From Base'"></label>
                        <div class="w-100 py-2 position-relative"> 
                            <select id="bnr_tpe1" wire:model.live="select_base" class="input">
                                @foreach(range(2, 36) as $base)
                                    <option value="{{ $base }}">
                                        @if($base == 2) 2 (Binary)
                                        @elseif($base == 8) 8 (Octal)
                                        @elseif($base == 10) 10 (Decimal)
                                        @elseif($base == 16) 16 (Hexadecimal)
                                        @else {{ $base }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6 to_number" x-show="$wire.tool === 'converter'" style="{{ $tool === 'converter' ? '' : 'display: none;' }}">
                        <label for="to_number" class="font-s-14 text-blue">{{$lang['9']}}:</label>
                        <div class="w-100 py-2 position-relative"> 
                            <select id="to_number" wire:model.live="to_number" class="input">
                                @foreach(range(2, 36) as $base)
                                    <option value="{{ $base }}">
                                        @if($base == 2) 2 (Binary)
                                        @elseif($base == 8) 8 (Octal)
                                        @elseif($base == 10) 10 (Decimal)
                                        @elseif($base == 16) 16 (Hexadecimal)
                                        @else {{ $base }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 mt-2" x-show="$wire.tool === 'calculator'" style="{{ $tool === 'calculator' ? '' : 'display: none;' }}">
                        <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4"> 
                            <div class="col-span-5 fno">
                                <label for="bnr_frs" class="font-s-14 text-blue">{{$lang[6]}}:</label>
                                <div class="py-2">
                                    <input class="input bnry_inputs bnr_frs" type="text" id="bnr_frs" wire:model.live="bnr_frs" x-on:keypress="handleKeypress($event, $wire.select_base)">
                                </div>
                            </div>
                            <div class="col-span-2 operation">
                                <label for="bnr_slc" class="font-s-14 text-blue">{{$lang['7']}}:</label>
                                <div class="w-100 py-2 position-relative"> 
                                    <select id="bnr_slc" wire:model.live="bnr_slc" class="input">
                                        <option value="add">+</option>
                                        <option value="sub">-</option>
                                        <option value="mul">×</option>
                                        <option value="divd">÷</option>
                                        <option value="mod">mod</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-5 sno">
                                <label for="bnr_sec" class="font-s-14 text-blue">{{$lang[8]}}:</label>
                                <div class="py-2">
                                    <input class="input bnry_inputs bnr_sec" type="text" id="bnr_sec" wire:model.live="bnr_sec" x-on:keypress="handleKeypress($event, $wire.select_base)">
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
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center" 
                         x-init="
                            if ($wire.tool === 'calculator') {
                                try {
                                    let b = parseInt($wire.select_base);
                                    let x1 = new BigNumber($wire.bnr_frs, b);
                                    let x2 = new BigNumber($wire.bnr_sec, b);
                                    let op = $wire.bnr_slc;
                                    let y;
                                    switch(op) {
                                        case 'add': y = x1.plus(x2); break;
                                        case 'sub': y = x1.minus(x2); break;
                                        case 'mul': y = x1.times(x2); break;
                                        case 'divd': y = x1.div(x2); break;
                                        case 'mod': y = x1.mod(x2); break;
                                    }
                                    BigNumber.set({ DECIMAL_PLACES: 16 });
                                    document.getElementById('main_answer').innerText = y.toString(b).toUpperCase();
                                } catch (e) {
                                    document.getElementById('main_answer').innerText = 'Error';
                                }
                            }
                         ">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{$lang['10']}}</strong></p>
                                    <p class="text-[32px] bg-sky px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-blue" id="main_answer">
                                            @if($tool === 'converter')
                                                {{ strtoupper($detail['bi'] ?? '') }}
                                            @else
                                                {{ $detail['bn'] ?? '' }}
                                            @endif
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <script src="{{ asset('js/bignumber.js') }}"></script>
        <script src="{{ asset('js/math.js') }}"></script>
        <script>
            function handleKeypress(e, select_base) {
                var bnr_tpe1 = select_base.toString();
                var allowedKeys = [];

                if (bnr_tpe1 === "2") {
                    allowedKeys = [48, 49, 8];
                } else if (bnr_tpe1 === "3") {
                    allowedKeys = [48, 49, 8, 50];
                } else if (bnr_tpe1 === "4") {
                    allowedKeys = [48, 49, 8, 50, 51];
                } else if (bnr_tpe1 === "5") {
                    allowedKeys = [48, 49, 8, 50, 51, 52];
                } else if (bnr_tpe1 === "6") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53];
                } else if (bnr_tpe1 === "7") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54];
                } else if (bnr_tpe1 === "8") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55];
                } else if (bnr_tpe1 === "9") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56];
                } else if (bnr_tpe1 === "10") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57];
                } else if (bnr_tpe1 === "11") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 97];
                } else if (bnr_tpe1 === "12") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 97, 98];
                } else if (bnr_tpe1 === "13") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 97, 98, 99];
                } else if (bnr_tpe1 === "14") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 97, 98, 99, 100];
                } else if (bnr_tpe1 === "15") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 97, 98, 99, 100, 101];
                } else if (bnr_tpe1 === "16") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 97, 98, 99, 100, 101, 102];
                } else if (bnr_tpe1 === "17") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 97, 98, 99, 100, 101, 102, 103];
                } else if (bnr_tpe1 === "18") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 97, 98, 99, 100, 101, 102, 103, 104];
                } else if (bnr_tpe1 === "19") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 97, 98, 99, 100, 101, 102, 103, 104, 105];
                } else if (bnr_tpe1 === "20") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106];
                } else if (bnr_tpe1 === "21") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107];
                } else if (bnr_tpe1 === "22") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108];
                } else if (bnr_tpe1 === "23") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109];
                } else if (bnr_tpe1 === "24") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110];
                } else if (bnr_tpe1 === "25") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111];
                } else if (bnr_tpe1 === "26") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112];
                } else if (bnr_tpe1 === "27") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113];
                } else if (bnr_tpe1 === "28") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114];
                } else if (bnr_tpe1 === "29") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115];
                } else if (bnr_tpe1 === "30") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116];
                } else if (bnr_tpe1 === "31") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117];
                } else if (bnr_tpe1 === "32") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118];
                } else if (bnr_tpe1 === "33") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119];
                } else if (bnr_tpe1 === "34") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120];
                } else if (bnr_tpe1 === "35") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121];
                } else if (bnr_tpe1 === "36") {
                    allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 97, 98, 99, 100, 101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122];
                }

                var key = e.which || e.keyCode;
                if (!allowedKeys.includes(key)) {
                    e.preventDefault();
                }
            }
        </script>
    @endpush
</div>
