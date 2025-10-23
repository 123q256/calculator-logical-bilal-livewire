<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4"> 

            @php $request = request(); @endphp

            <div class="col-span-6 hidden">
                <label for="selection" class="font-s-14 text-blue one_text">{{$lang['1']}}:</label>
                <div class="w-100 py-2">
                    <select name="tool" id="selection" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'],$lang['3']];
                            $val = ["calculator","converter"];
                            optionsList($val,$name,isset(request()->tool)?request()->tool:'calculator');
                        @endphp
                    </select>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6 tno">
                <label for="bnr_third" class="font-s-14 text-blue">{{$lang[4]}}:</label>
                <div class="py-2">
                    <input class="input" type="number" step="any" id="bnr_third" min="0" name="bnr_third" value="<?=((isset($_POST['bnr_third']))?$_POST['bnr_third']: '101')?>" >
                </div>
            </div>
            
            <div class="col-span-12 md:col-span-6 lg:col-span-6 base mx-auto">
                <label for="bnr_tpe1" class="font-s-14 text-blue select_base"><?=$lang['5']?>:</label>
                <div class="w-100 py-2 position-relative"> 
                    <select name="select_base" id="bnr_tpe1" class="input">
                        @php
                           $name = ["2 (Binary)","3","4","5","6","7","8 (Octal)","9","10 (Decimal)","11","12","13","14","15","16 (Hexadecimal)","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36"];
                            $val = ["2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36"];
                            optionsList($val,$name,isset(request()->select_base)?request()->select_base:'2');
                        @endphp
                    </select>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6 to_number">
                <label for="to_number" class="font-s-14 text-blue"><?=$lang['9']?>:</label>
                <div class="w-100 py-2 position-relative"> 
                    <select name="to_number" id="to_number" class="input">
                        @php
                           $name = ["1","2 (Binary)","3","4","5","6","7","8 (Octal)","9","10 (Decimal)","11","12","13","14","15","16 (Hexadecimal)","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36"];
                            $val = ["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36"];
                            optionsList($val,$name,isset(request()->to_number)?request()->to_number:'2');
                        @endphp
                    </select>
                </div>
            </div>

            <div class="col-span-12  mt-2">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4"> 
                <div class="col-span-5 fno">
                    <label for="bnr_frs" class="font-s-14 text-blue">{{$lang[6]}}:</label>
                    <div class="py-2">
                        <input class="input bnry_inputs bnr_frs" type="text" id="bnr_frs" min="0" name="bnr_frs" value="<?=((isset($_POST['bnr_frs']))?$_POST['bnr_frs']: '101')?>" >
                    </div>
                </div>
                <div class="col-span-2 operation">
                    <label for="bnr_slc" class="font-s-14 text-blue"><?=$lang['7']?>:</label>
                    <div class="w-100 py-2 position-relative"> 
                        <select name="bnr_slc" id="bnr_slc" class="input">
                            @php
                               $name = ["+","-","×","÷","mod"];
                                $val = ["add","sub","mul","divd","mod"];
                                optionsList($val,$name,isset(request()->bnr_slc)?request()->bnr_slc:'add');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-5 sno">
                    <label for="bnr_sec" class="font-s-14 text-blue">{{$lang[8]}}:</label>
                    <div class="py-2">
                        <input class="input bnry_inputs bnr_sec" type="text" id="bnr_sec" min="0" name="bnr_sec" value="<?=((isset($_POST['bnr_sec']))?$_POST['bnr_sec']: '101')?>" >
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['10']}}</strong></p>
                            <p class="text-[32px] bg-sky px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue" id="main_answer"></strong></p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        function hideElements(selectors) {
            selectors.forEach(selector => {
                document.querySelectorAll(selector).forEach(element => {
                    element.style.display = 'none';
                });
            });
        }

        function showElements(selectors) {
            selectors.forEach(selector => {
                document.querySelectorAll(selector).forEach(element => {
                    element.style.display = 'block';
                });
            });
        }

        var section = document.getElementById("selection").value;
        if (section === "calculator") {
            hideElements([".to_number", ".tno"]);
            showElements([".operation", ".sno", ".fno"]);
            document.querySelectorAll(".select_base").forEach(element => {
                element.textContent = "Select Base";
            });
            document.querySelectorAll(".base").forEach(element => {
                element.classList.add("ps-lg-3");
                element.classList.remove("pe-lg-3");
            });
        }

        document.querySelectorAll("#bnr_tpe1, #bnr_tpe2").forEach(function(element) {
            element.addEventListener("change", function() {
                var ink = this.value;
                if (["2", "3", "4", "5", "6", "7"].includes(ink)) {
                    document.getElementById("bnr_frs").value = "101";
                    document.getElementById("bnr_sec").value = "101";
                } else if (["8", "9"].includes(ink)) {
                    document.getElementById("bnr_frs").value = "123";
                    document.getElementById("bnr_sec").value = "123";
                } else if (ink === "10") {
                    document.getElementById("bnr_frs").value = "23";
                    document.getElementById("bnr_sec").value = "23";
                } else {
                    document.getElementById("bnr_frs").value = "54f";
                    document.getElementById("bnr_sec").value = "54f";
                }
            });
        });

        document.getElementById("selection").addEventListener("change", function() {
            var w = this.value;
            if (w === "calculator") {
                hideElements([".to_number", ".tno"]);
                showElements([".operation", ".sno", ".fno"]);
                document.querySelectorAll(".select_base").forEach(element => {
                    element.textContent = "Select Base";
                });
                document.querySelectorAll(".base").forEach(element => {
                    element.classList.add("ps-lg-3");
                    element.classList.remove("pe-lg-3");
                });
            } else if (w === "converter") {
                hideElements([".operation", ".sno", ".fno"]);
                showElements([".tno", ".to_number"]);
                document.querySelectorAll(".select_base").forEach(element => {
                    element.textContent = "From Base";
                });
                document.querySelectorAll(".base").forEach(element => {
                    element.classList.add("pe-lg-3");
                    element.classList.remove("ps-lg-3");
                });
            }
        });

        @if(isset($detail) || isset($error))
            if (section === "calculator") {
                hideElements([".to_number", ".tno"]);
                showElements([".operation", ".sno", ".fno"]);
                document.querySelectorAll(".select_base").forEach(element => {
                    element.textContent = "Select Base";
                });
                document.querySelectorAll(".base").forEach(element => {
                    element.classList.add("ps-lg-3");
                    element.classList.remove("pe-lg-3");
                });
            } else if (section === "converter") {
                hideElements([".operation", ".sno", ".fno"]);
                showElements([".tno", ".to_number"]);
                document.querySelectorAll(".select_base").forEach(element => {
                    element.textContent = "From Base";
                });
                document.querySelectorAll(".base").forEach(element => {
                    element.classList.add("pe-lg-3");
                    element.classList.remove("ps-lg-3");
                });
            }
        @endif

        document.getElementById("bnr_frs").addEventListener("keypress", function(e) {
            handleKeypress(e);
        });

        document.getElementById("bnr_sec").addEventListener("keypress", function(e) {
            handleKeypress(e);
        });

        document.getElementById("bnr_third").addEventListener("keypress", function(e) {
            handleKeypress(e);
        });

        function handleKeypress(e) {
            var bnr_tpe1 = document.getElementById("bnr_tpe1").value;
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
            }else if (bnr_tpe1 === "8") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55];
            } else if (bnr_tpe1 === "9") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56];
            } else if (bnr_tpe1 === "10") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57];
            } else if (bnr_tpe1 === "11") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65];
            } else if (bnr_tpe1 === "12") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66];
            } else if (bnr_tpe1 === "13") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67];
            } else if (bnr_tpe1 === "14") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68];
            } else if (bnr_tpe1 === "15") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69];
            } else if (bnr_tpe1 === "16") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70];
            } else if (bnr_tpe1 === "17") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71];
            } else if (bnr_tpe1 === "18") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72];
            } else if (bnr_tpe1 === "19") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73];
            } else if (bnr_tpe1 === "20") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74];
            } else if (bnr_tpe1 === "21") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75];
            } else if (bnr_tpe1 === "22") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76];
            } else if (bnr_tpe1 === "23") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77];
            } else if (bnr_tpe1 === "24") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78];
            } else if (bnr_tpe1 === "25") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79];
            } else if (bnr_tpe1 === "26") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80];
            } else if (bnr_tpe1 === "27") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81];
            } else if (bnr_tpe1 === "28") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82];
            } else if (bnr_tpe1 === "29") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83];
            } else if (bnr_tpe1 === "30") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84];
            } else if (bnr_tpe1 === "31") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85];
            } else if (bnr_tpe1 === "32") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86];
            } else if (bnr_tpe1 === "33") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87];
            } else if (bnr_tpe1 === "34") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88];
            } else if (bnr_tpe1 === "35") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89];
            } else if (bnr_tpe1 === "36") {
                allowedKeys = [48, 49, 8, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90];
            }

            if (!allowedKeys.includes(e.which)) {
                e.preventDefault();
            }
        }
    </script>
    @isset($detail)
        <script src="{{ asset('js/bignumber.js') }}"></script>
        <script src="{{ asset('js/math.js') }}"></script>
        <script>
            const base = document.getElementById("bnr_tpe1");
            const opelem = document.getElementById("bnr_slc");
            const x1elem = document.getElementById("bnr_frs");
            const x2elem = document.getElementById("bnr_sec");
            var b = {{$request->select_base}};
            // var b = 14;
            var op = "{{$request->bnr_slc}}";
            var x1 = {{$request->bnr_frs}};
            var x2 = {{$request->bnr_sec}};
            var y;
			x1 = new BigNumber(x1, b);
            x2 = new BigNumber(x2, b);
            switch(op) {
                case "add":
                    y = x1.plus(x2);
                    break;
                case "sub":
                    y = x1.minus(x2);
                    break;
                case "mul":
                    y = x1.times(x2);
                    break;
                case "divd":
                    y = x1.div(x2);
                    break;
                case "mod":
                    y = x1.mod(x2);
                    break;
            }
            BigNumber.set({ DECIMAL_PLACES: 16 });
            y = y.toString(b).toUpperCase();
            document.getElementById("main_answer").innerText = y;
        </script>
    @endisset
@endpush