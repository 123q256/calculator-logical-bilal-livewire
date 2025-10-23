<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="pay" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select name="pay" id="pay" class="input" onchange="change_text(this)">
                        <option  value="1" {{ isset($_POST['pay']) && $_POST['pay']=='1'?'selected':''}}>{{ $lang['1']}}</option>
                        <option value="2" {{ isset($_POST['pay']) && $_POST['pay']=='2'?'selected':''}}>{{ $lang['2'] }}</option>
                        <option value="3" {{ isset($_POST['pay']) && $_POST['pay']=='3'?'selected':''}}>{{ $lang['3'] }}</option>
                        <option value="4" {{ isset($_POST['pay']) && $_POST['pay']=='4'?'selected':''}}>{{ $lang['4'] }}</option>
                        <option value="5" {{ isset($_POST['pay']) && $_POST['pay']=='5'?'selected':''}}>{{ $lang['5'] }}</option>
                        <option value="6" {{ isset($_POST['pay']) && $_POST['pay']=='6'?'selected':''}}>{{ $lang['6'] }}</option>
                        <option value="7" {{ isset($_POST['pay']) && $_POST['pay']=='7'?'selected':''}}>{{ $lang['7'] }}</option>
                    </select>
                </div>
                <div class="space-y-2 relative" id="f_input">
                    <label for="first" class="font-s-14 text-blue" id="txt1">{{ $lang['9'] }}:</label>
                    <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="35" value="{{ isset($_POST['first'])?$_POST['first']:'50' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
                <div class="space-y-2 relative" id="s_input">
                    <label for="second" class="font-s-14 text-blue" id="txt2">{{ $lang['10'] }}:</label>
                    <input type="number" step="any" name="second" id="second" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['second'])?$_POST['second']:'40' }}" />
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
                    <div class="w-full bg-light-blue rounded-lg mt-3">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b border-[#99EA48] w-1/2"><strong>{{ $lang[11] }}</strong></td>
                                    <td class="py-2 border-b border-[#99EA48]">{{ $currancy }} {{ $detail['monthly_income'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-[#99EA48] w-1/2">{{ $lang[12] }}</td>
                                    <td class="py-2 border-b border-[#99EA48]"><strong>{{ $currancy }} {{ $detail['hourly_income'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-[#99EA48] w-1/2">{{ $lang[13] }}</td>
                                    <td class="py-2 border-b border-[#99EA48]"><strong>{{ $currancy }} {{ $detail['daily_income'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-[#99EA48] w-1/2">{{ $lang[14] }}</td>
                                    <td class="py-2 border-b border-[#99EA48]"><strong>{{ $currancy }} {{ $detail['weekly_income'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-[#99EA48] w-1/2">{{ $lang[15] }}</td>
                                    <td class="py-2 border-b border-[#99EA48]"><strong>{{ $currancy }} {{ $detail['bi_weekly_income'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-[#99EA48] w-1/2">{{ $lang[16] }}</td>
                                    <td class="py-2 border-b border-[#99EA48]"><strong>{{ $currancy }} {{ $detail['sami_monthly_income'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-[#99EA48] w-1/2">{{ $lang[17] }}</td>
                                    <td class="py-2 border-b border-[#99EA48]"><strong>{{ $currancy }} {{ $detail['quarterly_income'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b border-[#99EA48] w-1/2">{{ $lang[18] }}</td>
                                    <td class="py-2 border-b border-[#99EA48]"><strong>{{ $currancy }} {{ $detail['annual_income'] }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
</form>
<script>

@if(isset($detail))
 @if(isset($_POST['pay']) && $_POST['pay'] === '1')
    document.getElementById("txt1").innerText = "{{$lang[9]}}";
    document.getElementById("s_input").style.display = "block";
    document.getElementById("txt2").innerText = "{{$lang[10]}}";
    document.getElementsByName("second")[0].value = '40';
 @elseif(isset($_POST['pay']) && $_POST['pay'] === '2')
    document.getElementById("txt1").innerText = "{{$lang[19]}}";
    document.getElementById("s_input").style.display = "block";
    document.getElementById("txt2").innerText = "{{$lang[20]}}";
    document.getElementsByName("second")[0].value = '5';
 @elseif(isset($_POST['pay']) && $_POST['pay'] === '3')
    document.getElementById("txt1").innerText = "{{$lang[21]}}";
    document.getElementById("s_input").style.display = "none";
 @elseif(isset($_POST['pay']) && $_POST['pay'] === '4')
    document.getElementById("txt1").innerText = "{{$lang[22]}}";
    document.getElementById("s_input").style.display = "none";
 @elseif(isset($_POST['pay']) && $_POST['pay'] === '5')
    document.getElementById("txt1").innerText = "{{$lang[23]}}";
    document.getElementById("s_input").style.display = "none";
 @elseif(isset($_POST['pay']) && $_POST['pay'] === '6')
    document.getElementById("txt1").innerText = "{{$lang[24]}}";
    document.getElementById("s_input").style.display = "none";
@else
    document.getElementById("txt1").innerText = "{{$lang[25]}}";
    document.getElementById("s_input").style.display = "none";

 @endif
 @endisset


 @if(isset($error))
    var textVal = '{{ isset($_POST['pay']) ? $_POST['pay'] : '' }}';
    if (textVal === "1") {
        document.getElementById("txt1").innerText = "{{$lang[9]}}";
        document.getElementById("s_input").style.display = "block";
        document.getElementById("txt2").innerText = "{{$lang[10]}}";
        document.getElementsByName("second")[0].value = '40';
    } else if (textVal === "2") {
        document.getElementById("txt1").innerText = "{{$lang[19]}}";
        document.getElementById("s_input").style.display = "block";
        document.getElementById("txt2").innerText = "{{$lang[20]}}";
        document.getElementsByName("second")[0].value = '5';
    } else if (textVal === "3") {
        document.getElementById("txt1").innerText = "{{$lang[21]}}";
        document.getElementById("s_input").style.display = "none";
    } else if (textVal === "4") {
        document.getElementById("txt1").innerText = "{{$lang[22]}}";
        document.getElementById("s_input").style.display = "none";
    } else if (textVal === "5") {
        document.getElementById("txt1").innerText = "{{$lang[23]}}";
        document.getElementById("s_input").style.display = "none";
    } else if (textVal === "6") {
        document.getElementById("txt1").innerText = "{{$lang[24]}}";
        document.getElementById("s_input").style.display = "none";
    } else {
        document.getElementById("txt1").innerText = "{{$lang[25]}}";
        document.getElementById("s_input").style.display = "none";
    }
    @endif
    function change_text(element) {
    var textVal = element.value;
    if (textVal === "1") {
        document.getElementById("txt1").innerText = "{{$lang[9]}}";
        document.getElementById("s_input").style.display = "block";
        document.getElementById("txt2").innerText = "{{$lang[10]}}";
        document.getElementsByName("second")[0].value = '40';
    } else if (textVal === "2") {
        document.getElementById("txt1").innerText = "{{$lang[19]}}";
        document.getElementById("s_input").style.display = "block";
        document.getElementById("txt2").innerText = "{{$lang[20]}}";
        document.getElementsByName("second")[0].value = '5';
    } else if (textVal === "3") {
        document.getElementById("txt1").innerText = "{{$lang[21]}}";
        document.getElementById("s_input").style.display = "none";
    } else if (textVal === "4") {
        document.getElementById("txt1").innerText = "{{$lang[22]}}";
        document.getElementById("s_input").style.display = "none";
    } else if (textVal === "5") {
        document.getElementById("txt1").innerText = "{{$lang[23]}}";
        document.getElementById("s_input").style.display = "none";
    } else if (textVal === "6") {
        document.getElementById("txt1").innerText = "{{$lang[24]}}";
        document.getElementById("s_input").style.display = "none";
    } else {
        document.getElementById("txt1").innerText = "{{$lang[25]}}";
        document.getElementById("s_input").style.display = "none";
    }
}



</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>