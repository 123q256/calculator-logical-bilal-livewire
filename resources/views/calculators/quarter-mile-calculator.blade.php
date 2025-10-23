<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
                    <div class="col-span-12 equation">
                        <label for="equation" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select class="input" name="equation" id="equation">
                                <option value="1" {{ isset($_POST['equation']) && $_POST['equation'] == '1' ? 'selected' : '' }}>
                                    {{ $lang['2'] }}</option>
                                <option value="2" {{ isset($_POST['equation']) && $_POST['equation'] == '2' ? 'selected' : '' }}>
                                    {{ $lang['3'] }}</option>
                                <option value="3" {{ isset($_POST['equation']) && $_POST['equation'] == '3' ? 'selected' : '' }}>
                                    {{ $lang['4'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 selection">
                        <label for="selection" class="font-s-14 text-blue">{{ $lang['17'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select class="input" name="selection" id="selection">
                                <option value="1" {{ isset($_POST['selection']) && $_POST['selection'] == '1' ? 'selected' : '' }}>
                                    {{ $lang['6'] }}</option>
                                <option value="2" {{ isset($_POST['selection']) && $_POST['selection'] == '2' ? 'selected' : '' }}>
                                    {{ $lang['7'] }}</option>
                                <option value="3" {{ isset($_POST['selection']) && $_POST['selection'] == '3' ? 'selected' : '' }}>
                                    {{ $lang['8'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12  power_units">
                        <label for="power" class="font-s-14 text-blue">{{ $lang['15'] }} (HP)</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="power" id="power" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['power'])?$_POST['power']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="power_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('power_unit_dropdown')">{{ isset($_POST['power_unit'])?$_POST['power_unit']:'watts (W)' }} ▾</label>
                           <input type="text" name="power_unit" value="{{ isset($_POST['power_unit'])?$_POST['power_unit']:'watts (W)' }}" id="power_unit" class="hidden">
                           <div id="power_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="power_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'watts (W)')">watts (W)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'kilowatts (kW)')">kilowatts (kW)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'megawatts (mW)')">megawatts (mW)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'mechanical horsepowers hp (l)')">mechanical horsepowers hp (l)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'metric horsepowers hp (M)')">metric horsepowers hp (M)</p>
                           </div>
                        </div>
                    </div>
                    <div class="col-span-12 sample_units hidden" >
                        <label for="powers" class="font-s-14 text-blue">{{ $lang['15'] }} (HP)</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="powers" id="powers" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['powers'])?$_POST['powers']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="sample_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sample_unit_dropdown')">{{ isset($_POST['sample_unit'])?$_POST['sample_unit']: $lang['18'] }} ▾</label>
                           <input type="text" name="sample_unit" value="{{ isset($_POST['sample_unit'])?$_POST['sample_unit']:$lang['18'] }}" id="sample_unit" class="hidden">
                           <div id="sample_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sample_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sample_unit', '{{ $lang['18']}}')">{{ $lang['18']}}</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sample_unit', '{{$lang['19']}}')">{{$lang['19']}}</p>
                              
                           </div>
                        </div>
                    </div>
                    <div class="col-span-12 weight" >
                        <label for="weight" class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="weight" id="weight" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']: '(t)' }} ▾</label>
                           <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']: '(t)' }}" id="weight_unit" class="hidden">
                           <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', '(kg)')">(kg)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', '(t)')">(t)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', '(lb)')">(lb)</p>
                           </div>
                        </div>
                    </div>
                   
                    <div class="col-span-12 mph hidden">
                        <label for="trap" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="trap" id="trap" class="input" aria-label="input" placeholder="23" value="{{ isset($_POST['trap'])?$_POST['trap']:'23' }}" />
                        </div>
                    </div>
                    <div class="col-span-12 et hidden">
                        <label for="et" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="et" id="et" class="input" aria-label="input" placeholder="2" value="{{ isset($_POST['et'])?$_POST['et']:'2' }}" />
                            <span class="text-blue input_unit">sec</span>
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                            
                            @if(isset($detail['one_eight']) && $detail['one_eight'] != "" && isset($detail['sixty']) && $detail['sixty'] != "")
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>60 {{$lang['12']}} </strong></td>
                                <td class="py-2 border-b"> {{round($detail['sixty'], 2)}}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>1/8  {{$lang['13']}} </strong></td>
                                <td class="py-2 border-b"> {{round($detail['one_eight'], 2)}}</td>
                            </tr>
                            @endif
                            @if(isset($detail['elapsed_time']) && $detail['elapsed_time'] != "")
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>1/4  {{$lang['14']}} </strong></td>
                                <td class="py-2 border-b"> {{round($detail['elapsed_time'], 2)}} (sec)</td>
                            </tr>
                           @endif
                           @if(isset($detail['trap_speed']) && $detail['trap_speed'] != "")
                           <tr>
                            <td class="py-2 border-b" width="70%"><strong>1/4  {{$lang['13']}} </strong></td>
                            <td class="py-2 border-b"> {{round($detail['trap_speed'], 2)}} (mph)</td>
                           </tr>
                           @endif
                           @if(isset($detail['final_value']) && $detail['final_value'] != "")
                           <tr>
                            <td class="py-2 border-b" width="70%"><strong>1/4  {{$lang['13']}}</strong></td>
                            <td class="py-2 border-b"> {{round($detail['final_value'], 2)}} (lb)</td>
                           </tr>
                           @endif
                        </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('selection').addEventListener('change', function() {
            var a = this.value;
            var y = document.getElementById('equation').value;

            var mphElements = document.querySelectorAll('.mph');
            var etElements = document.querySelectorAll('.et');
            var sampleUnitsElements = document.querySelectorAll('.sample_units');
            var weightElements = document.querySelectorAll('.weight');
            var powersElements = document.querySelectorAll('.powers');
            var powerUnitsElements = document.querySelectorAll('.power_units');

            function hideElements(elements) {
                elements.forEach(function(element) {
                    element.style.display = 'none';
                });
            }

            function showElements(elements) {
                elements.forEach(function(element) {
                    element.style.display = 'block';
                });
            }

            if (a === "1") {
                hideElements(mphElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                showElements(weightElements);
                showElements(powersElements);
                showElements(powerUnitsElements);

                if (y === "3") {
                    hideElements(mphElements);
                    hideElements(etElements);
                    hideElements(powersElements);
                    hideElements(powerUnitsElements);
                    showElements(weightElements);
                    showElements(sampleUnitsElements);
                }
            } else if (a === "2") {
                hideElements(powersElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                hideElements(powerUnitsElements);
                showElements(weightElements);
                showElements(mphElements);
            } else if (a === "3") {
                hideElements(powerUnitsElements);
                hideElements(mphElements);
                hideElements(powersElements);
                hideElements(sampleUnitsElements);
                showElements(etElements);
                showElements(weightElements);
            }
        });
    });

    @if(isset($detail))
        var a = "{{$_POST['equation']}}";

        var y = document.getElementById('equation').value;

        var mphElements = document.querySelectorAll('.mph');
        var etElements = document.querySelectorAll('.et');
        var sampleUnitsElements = document.querySelectorAll('.sample_units');
        var weightElements = document.querySelectorAll('.weight');
        var powersElements = document.querySelectorAll('.powers');
        var powerUnitsElements = document.querySelectorAll('.power_units');

        function hideElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'none';
            });
        }

        function showElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'block';
            });
        }

        if (a === "1") {
            hideElements(mphElements);
            hideElements(etElements);
            hideElements(sampleUnitsElements);
            showElements(weightElements);
            showElements(powersElements);
            showElements(powerUnitsElements);

            if (y === "3") {
                hideElements(mphElements);
                hideElements(etElements);
                hideElements(powersElements);
                hideElements(powerUnitsElements);
                showElements(weightElements);
                showElements(sampleUnitsElements);
            }
        } else if (a === "2") {
            hideElements(powersElements);
            hideElements(etElements);
            hideElements(sampleUnitsElements);
            hideElements(powerUnitsElements);
            showElements(weightElements);
            showElements(mphElements);
        } else if (a === "3") {
            hideElements(powerUnitsElements);
            hideElements(mphElements);
            hideElements(powersElements);
            hideElements(sampleUnitsElements);
            showElements(etElements);
            showElements(weightElements);
        }

    @endif

    @if(isset($error))
        var a = "{{$_POST['equation']}}";

        var y = document.getElementById('equation').value;

        var mphElements = document.querySelectorAll('.mph');
        var etElements = document.querySelectorAll('.et');
        var sampleUnitsElements = document.querySelectorAll('.sample_units');
        var weightElements = document.querySelectorAll('.weight');
        var powersElements = document.querySelectorAll('.powers');
        var powerUnitsElements = document.querySelectorAll('.power_units');

        function hideElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'none';
            });
        }

        function showElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'block';
            });
        }

        if (a === "1") {
            hideElements(mphElements);
            hideElements(etElements);
            hideElements(sampleUnitsElements);
            showElements(weightElements);
            showElements(powersElements);
            showElements(powerUnitsElements);

            if (y === "3") {
                hideElements(mphElements);
                hideElements(etElements);
                hideElements(powersElements);
                hideElements(powerUnitsElements);
                showElements(weightElements);
                showElements(sampleUnitsElements);
            }
        } else if (a === "2") {
            hideElements(powersElements);
            hideElements(etElements);
            hideElements(sampleUnitsElements);
            hideElements(powerUnitsElements);
            showElements(weightElements);
            showElements(mphElements);
        } else if (a === "3") {
            hideElements(powerUnitsElements);
            hideElements(mphElements);
            hideElements(powersElements);
            hideElements(sampleUnitsElements);
            showElements(etElements);
            showElements(weightElements);
        }

    @endif

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('equation').addEventListener('change', function() {
            var b = this.value;
            var w = document.getElementById('selection').value;

            var sampleUnitsElements = document.querySelectorAll('.sample_units');
            var equationElements = document.querySelectorAll('.equation');
            var powersElements = document.querySelectorAll('.powers');
            var powerUnitsElements = document.querySelectorAll('.power_units');
            var mphElements = document.querySelectorAll('.mph');
            var etElements = document.querySelectorAll('.et');
            var weightElements = document.querySelectorAll('.weight');

            function hideElements(elements) {
                elements.forEach(function(element) {
                    element.style.display = 'none';
                });
            }

            function showElements(elements) {
                elements.forEach(function(element) {
                    element.style.display = 'block';
                });
            }

            if (b === "1") {
                showElements(sampleUnitsElements);
                showElements(equationElements);
                showElements(powersElements);
                hideElements(powerUnitsElements);

                if (w === "1") {
                    hideElements(mphElements);
                    hideElements(etElements);
                    hideElements(sampleUnitsElements);
                    hideElements(powersElements);
                    showElements(weightElements);
                    showElements(powersElements);
                    showElements(powerUnitsElements);
                } else if (w === "2") {
                    hideElements(powersElements);
                    hideElements(etElements);
                    hideElements(sampleUnitsElements);
                    hideElements(powerUnitsElements);
                    showElements(weightElements);
                    showElements(mphElements);
                } else if (w === "3") {
                    hideElements(powerUnitsElements);
                    hideElements(mphElements);
                    hideElements(powersElements);
                    hideElements(sampleUnitsElements);
                    showElements(etElements);
                    showElements(weightElements);
                }
            } else if (b === "2") {
                showElements(powerUnitsElements);
                showElements(equationElements);
                showElements(powersElements);
                hideElements(sampleUnitsElements);

                if (w === "1") {
                    hideElements(mphElements);
                    hideElements(etElements);
                    hideElements(sampleUnitsElements);
                    showElements(weightElements);
                    showElements(powersElements);
                    showElements(powerUnitsElements);
                } else if (w === "2") {
                    hideElements(powersElements);
                    hideElements(etElements);
                    hideElements(sampleUnitsElements);
                    hideElements(powerUnitsElements);
                    showElements(weightElements);
                    showElements(mphElements);
                } else if (w === "3") {
                    hideElements(powerUnitsElements);
                    hideElements(mphElements);
                    hideElements(powersElements);
                    showElements(etElements);
                    showElements(weightElements);
                }
            } else if (b === "3") {
                showElements(weightElements);
                showElements(powersElements);
                showElements(sampleUnitsElements);
                hideElements(mphElements);
                hideElements(etElements);
                hideElements(powerUnitsElements);

                if (w === "1") {
                    hideElements(mphElements);
                    hideElements(etElements);
                    hideElements(powerUnitsElements);
                    showElements(weightElements);
                    showElements(powersElements);
                    showElements(sampleUnitsElements);
                } else if (w === "2") {
                    hideElements(powersElements);
                    hideElements(etElements);
                    hideElements(sampleUnitsElements);
                    hideElements(powerUnitsElements);
                    showElements(weightElements);
                    showElements(mphElements);
                } else if (w === "3") {
                    showElements(etElements);
                    showElements(weightElements);
                    hideElements(powerUnitsElements);
                    hideElements(powersElements);
                    hideElements(sampleUnitsElements);
                }
            }
        });
    });

    @if(isset($detail))
        var b = "{{$_POST['equation']}}";

        var w = document.getElementById('selection').value;

        var sampleUnitsElements = document.querySelectorAll('.sample_units');
        var equationElements = document.querySelectorAll('.equation');
        var powersElements = document.querySelectorAll('.powers');
        var powerUnitsElements = document.querySelectorAll('.power_units');
        var mphElements = document.querySelectorAll('.mph');
        var etElements = document.querySelectorAll('.et');
        var weightElements = document.querySelectorAll('.weight');

        function hideElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'none';
            });
        }

        function showElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'block';
            });
        }

        if (b === "1") {
            showElements(sampleUnitsElements);
            showElements(equationElements);
            showElements(powersElements);
            hideElements(powerUnitsElements);

            if (w === "1") {
                hideElements(mphElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                hideElements(powersElements);
                showElements(weightElements);
                showElements(powersElements);
                showElements(powerUnitsElements);
            } else if (w === "2") {
                hideElements(powersElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                hideElements(powerUnitsElements);
                showElements(weightElements);
                showElements(mphElements);
            } else if (w === "3") {
                hideElements(powerUnitsElements);
                hideElements(mphElements);
                hideElements(powersElements);
                hideElements(sampleUnitsElements);
                showElements(etElements);
                showElements(weightElements);
            }
        } else if (b === "2") {
            showElements(powerUnitsElements);
            showElements(equationElements);
            showElements(powersElements);
            hideElements(sampleUnitsElements);

            if (w === "1") {
                hideElements(mphElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                showElements(weightElements);
                showElements(powersElements);
                showElements(powerUnitsElements);
            } else if (w === "2") {
                hideElements(powersElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                hideElements(powerUnitsElements);
                showElements(weightElements);
                showElements(mphElements);
            } else if (w === "3") {
                hideElements(powerUnitsElements);
                hideElements(mphElements);
                hideElements(powersElements);
                showElements(etElements);
                showElements(weightElements);
            }
        } else if (b === "3") {
            showElements(weightElements);
            showElements(powersElements);
            showElements(sampleUnitsElements);
            hideElements(mphElements);
            hideElements(etElements);
            hideElements(powerUnitsElements);

            if (w === "1") {
                hideElements(mphElements);
                hideElements(etElements);
                hideElements(powerUnitsElements);
                showElements(weightElements);
                showElements(powersElements);
                showElements(sampleUnitsElements);
            } else if (w === "2") {
                hideElements(powersElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                hideElements(powerUnitsElements);
                showElements(weightElements);
                showElements(mphElements);
            } else if (w === "3") {
                showElements(etElements);
                showElements(weightElements);
                hideElements(powerUnitsElements);
                hideElements(powersElements);
                hideElements(sampleUnitsElements);
            }
        }
    @endif

    @if(isset($error))
        var b = "{{$_POST['equation']}}";

        var w = document.getElementById('selection').value;

        var sampleUnitsElements = document.querySelectorAll('.sample_units');
        var equationElements = document.querySelectorAll('.equation');
        var powersElements = document.querySelectorAll('.powers');
        var powerUnitsElements = document.querySelectorAll('.power_units');
        var mphElements = document.querySelectorAll('.mph');
        var etElements = document.querySelectorAll('.et');
        var weightElements = document.querySelectorAll('.weight');

        function hideElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'none';
            });
        }

        function showElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'block';
            });
        }

        if (b === "1") {
            showElements(sampleUnitsElements);
            showElements(equationElements);
            showElements(powersElements);
            hideElements(powerUnitsElements);

            if (w === "1") {
                hideElements(mphElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                hideElements(powersElements);
                showElements(weightElements);
                showElements(powersElements);
                showElements(powerUnitsElements);
            } else if (w === "2") {
                hideElements(powersElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                hideElements(powerUnitsElements);
                showElements(weightElements);
                showElements(mphElements);
            } else if (w === "3") {
                hideElements(powerUnitsElements);
                hideElements(mphElements);
                hideElements(powersElements);
                hideElements(sampleUnitsElements);
                showElements(etElements);
                showElements(weightElements);
            }
        } else if (b === "2") {
            showElements(powerUnitsElements);
            showElements(equationElements);
            showElements(powersElements);
            hideElements(sampleUnitsElements);

            if (w === "1") {
                hideElements(mphElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                showElements(weightElements);
                showElements(powersElements);
                showElements(powerUnitsElements);
            } else if (w === "2") {
                hideElements(powersElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                hideElements(powerUnitsElements);
                showElements(weightElements);
                showElements(mphElements);
            } else if (w === "3") {
                hideElements(powerUnitsElements);
                hideElements(mphElements);
                hideElements(powersElements);
                showElements(etElements);
                showElements(weightElements);
            }
        } else if (b === "3") {
            showElements(weightElements);
            showElements(powersElements);
            showElements(sampleUnitsElements);
            hideElements(mphElements);
            hideElements(etElements);
            hideElements(powerUnitsElements);

            if (w === "1") {
                hideElements(mphElements);
                hideElements(etElements);
                hideElements(powerUnitsElements);
                showElements(weightElements);
                showElements(powersElements);
                showElements(sampleUnitsElements);
            } else if (w === "2") {
                hideElements(powersElements);
                hideElements(etElements);
                hideElements(sampleUnitsElements);
                hideElements(powerUnitsElements);
                showElements(weightElements);
                showElements(mphElements);
            } else if (w === "3") {
                showElements(etElements);
                showElements(weightElements);
                hideElements(powerUnitsElements);
                hideElements(powersElements);
                hideElements(sampleUnitsElements);
            }
        }
    @endif
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>