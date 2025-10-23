<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_des')">
    <link rel="canonical" href="{{ url($page) }}/" />
    <link href="{{ url('favicon.webp') }}" rel="icon" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ url('css/style.css?v=1.0.9') }}">
    <meta name="robots" content="noindex">
</head>
<body>
    <div id="snackbar">Your Result is copied!</div>
    <div class="row">
        <h1 class="text-blue mt-2 font-s-25">{{ $cal_name }}</h1>
        <div class="calculator-box bg-light-blue radius-10 p-2 p-lg-3 mt-2">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="row">
                        <div class="col-lg-6 col-12 px-2 px-lg-3">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="from" class="text-blue font-s-14">{{ $lang['from'] }}:</label>
                                    <div class="w-100 pt-2 position-relative">
                                        <input type="number" type="any" name="from" id="from" onkeyup="calculate();" class="input" aria-label="input" placeholder="00" />
                                        <span class="text-blue input-unit">{{ $lang['unit1'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 px-2 px-lg-3 mt-3 mt-lg-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="to" class="text-blue font-s-14">{{ $lang['to'] }}:</label>
                                    <div class="w-100 pt-2 position-relative">
                                        <input type="number" type="any" name="to" id="to" onkeyup="rev_cal();" class="input" aria-label="input" placeholder="00" />
                                        <span class="text-blue input-unit">{{ $lang['unit2'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 px-2 px-lg-3 d-flex justify-content-end mt-3">
                            <div value="{{ $lang['convert'] }}" class="font-s-16 bg-theme text-white px-3 py-2 radius-10 cursor-pointer">{{ $lang['convert'] }}</div>
                        </div>
                        <div class="col-6 px-2 px-lg-3 d-flex mt-3">
                            <div value="{{ $lang['clear'] }}" class="font-s-16 bg-white border px-4 py-2 radius-10 cursor-pointer" onclick="reset()">{{ $lang['clear'] }}</div>
                        </div>
                        <div class="col-lg-10 col-12 mt-4 mx-auto res_ans" style="display: none">
                            <div class="d-flex align-items-center {{ $device=='desktop'?'':'flex-wrap' }}">
                                <strong class="text-blue font-s-20 me-2 {{ $device=='desktop'?'':'mb-2' }}">Result:</strong>
                                <div class="bg-white radius-10 p-2 border d-flex justify-content-between w-fit align-items-center">
                                    <div class="result border-end w-fit me-2"></div>
                                    <img src="{{ url('assets/icons/copy.png') }}"  alt="Copy Result" title="Copy Result" width="20" height="20" class="cursor-pointer copy_result" onclick="copyResult()">    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyElementText(className) {
            let text = document.querySelector(className).innerText;
            let elem = document.createElement("textarea");
            document.body.appendChild(elem);
            elem.value = text;
            elem.select();
            document.execCommand("copy");
            document.body.removeChild(elem);
        }
        function copyResult(){
            copyElementText('.result');
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }
        function get_final_res(final_res){
            var gniTotalDigits = 12;
            var gniPareSize = 12;
            var valStr = "" + final_res;
            if (valStr.indexOf("N")>=0 || (final_res == 2*final_res && final_res == 1+final_res)) return "Error ";
            var i = valStr.indexOf("e")
            if (i>=0){
                var expStr = valStr.substring(i+1,valStr.length);
                if (i>11) i=11;  // max 11 digits
                valStr = valStr.substring(0,i);
                if (valStr.indexOf(".")<0){
                    valStr += ".";
                }else{
                    j = valStr.length-1;
                    while (j>=0 && valStr.charAt(j)=="0") --j;
                    valStr = valStr.substring(0,j+1);
                }
                valStr += "E" + expStr;
            }else{
                var valNeg = false;
                if (final_res < 0){
                    final_res = -final_res;
                    valNeg = true;
                }
                var valInt = Math.floor(final_res);
                var valFrac = final_res - valInt;
                var prec = gniTotalDigits - (""+valInt).length - 1;
    
                var mult = " 1000000000000000000".substring(1,prec+2);
                if ((mult=="")||(mult==" ")){
                    mult = 1;
                }else{
                    mult = parseInt(mult);
                }
                var frac = Math.floor(valFrac * mult + 0.5);
                valInt = Math.floor(Math.floor(final_res * mult + .5) / mult);
                if (valNeg)
                    valStr = "-" + valInt;
                else
                    valStr = "" + valInt;
                var fracStr = "00000000000000"+frac;
                fracStr = fracStr.substring(fracStr.length-prec, fracStr.length);
                i = fracStr.length-1;
    
                while (i>=0 && fracStr.charAt(i)=="0") --i;
                fracStr = fracStr.substring(0,i+1);
                if (i>=0) valStr += "." + fracStr;
            }
            return valStr;
        }
        function rev_cal() {
            var from = parseFloat(document.getElementById('to').value);
            let ans={{isset($lang['formula1'])?'(':''}}from {{$lang['formula1']}};
            ans = get_final_res(ans);
            var answer = "<strong class='font-s-20'>" + ans + "</strong> {{$lang['unit1']}}";
            document.querySelector('.result').innerHTML = answer;
            document.getElementById('from').value = ans;
    
            if (ans === '' || isNaN(ans)) {
                document.querySelector('.res_ans').style.display = 'none';
                document.getElementById('from').value = '';
            } else {
                document.querySelector('.res_ans').style.display = 'block';
            }
        }
    
        function calculate() {
            var from = parseFloat(document.getElementById('from').value);
            let ans={{isset($lang['formula1'])?'(':''}}from {{$lang['formula1']}};
            ans = get_final_res(ans);
            var answer = "<strong class='font-s-20'>" + ans + "</strong> {{$lang['unit2']}}";
            document.querySelector('.result').innerHTML = answer;
            document.getElementById('to').value = ans;
    
            if (ans === '' || isNaN(ans)) {
                document.querySelector('.res_ans').style.display = 'none';
                document.getElementById('to').value = '';
            } else {
                document.querySelector('.res_ans').style.display = 'block';
            }
        }
        function reset(){
            document.getElementById('to').value = ''
            document.getElementById('from').value = ''
            document.querySelector('.res_ans').style.display = 'none';
        }
    </script>
</body>
</html>