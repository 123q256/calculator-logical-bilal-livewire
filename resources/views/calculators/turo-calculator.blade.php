<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  gap-4 my-3" >
                    @if(isset($error))
                    <div class="col-lg-12 col-12 mt-0 mt-lg-2 my-2 d-flex align-items-center">
                        <p class="font-s-16 text-blue">Calculate: </p>  
                        <label class="mx-2" for="firsts">
                            <input class="with-gap " name="type"  id="firsts" value="first" type="radio" {{ $_POST['type'] == 'first' ? 'checked' : '' }} />
                            <span>{{ $lang[12]}}</span>
                        </label>
                        <label class="mx-2" for="seconds">
                            <input class="with-gap " name="type" id="seconds" value="second" type="radio" {{ $_POST['type'] == 'second' ? 'checked' : '' }}/>
                            <span>{{ $lang[13]}}</span>
                        </label>
                    </div>
                    @else
                        @isset($detail)
                            <div class="col-lg-12 col-12 mt-0 mt-lg-2 my-2 d-flex align-items-center">
                                <p class="font-s-16 text-blue">Calculate: </p>  
                                <label class="mx-2" for="firsts">
                                    <input class="with-gap " name="type"  id="firsts" value="first" type="radio" {{ $detail['type'] == 'first' ? 'checked' : '' }} />
                                    <span>{{ $lang[12]}}</span>
                                </label>
                                <label class="mx-2" for="seconds">
                                    <input class="with-gap " name="type" id="seconds" value="second" type="radio" {{ $detail['type'] == 'second' ? 'checked' : '' }}/>
                                    <span>{{ $lang[13]}}</span>
                                </label>
                            </div>
                        @else
                            <div class="col-lg-12 col-12 mt-0 mt-lg-2 my-2 d-flex align-items-center">
                                <p class="font-s-16 text-blue">Calculate: </p>
                                <label for="firsts" class="mx-2">
                                    <input class="with-gap " name="type" id="firsts" value="first" type="radio" checked />
                                    <span>{{ $lang[12]}}</span>
                                </label>
                                <label for="seconds" class="mx-2">
                                    <input class="with-gap " name="type" id="seconds" value="second" type="radio"/>
                                    <span>{{ $lang[13]}}</span>
                                </label>
                            </div>
                        @endisset
                    @endif
                </div>

                <div class="grid grid-cols-1 hidden gap-4 mt-3" id="calculator">
                    <div class="space-y-2">
                        <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select class="input" name="operations" id="operations">
                            <option value="1"  {{ isset($_POST['operations']) && $_POST['operations']=='1'?'selected':''}}>{{$lang[2]}}</option>
                            <option value="2" {{ isset($_POST['operations']) && $_POST['operations']=='2'?'selected':''}}>{{$lang[3]}}</option>
                            <option value="3" {{ isset($_POST['operations']) && $_POST['operations']=='3'?'selected':''}}>{{$lang[4]}}</option>
                        </select>
                    </div>
                    <div class="space-y-2 relative" id="i1">
                        <label for="first" class="font-s-14 text-blue"  id="pak1">{{  $lang[5] }}:</label>
                        <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="12" value="{{ isset($_POST['first'])?$_POST['first']:'12' }}" />
                        <span class="text-blue input_unit" id="txt1">{{ $currancy}}/day</span>
                    </div>
                    <div class="space-y-2 relative" id="i2">
                        <label for="second" class="font-s-14 text-blue" id="pak2">{{  $lang[6] }}:</label>
                        <input type="number" step="any" name="second" id="second" class="input" aria-label="input" placeholder="12" value="{{ isset($_POST['second'])?$_POST['second']:'12' }}" />
                        <span class="text-blue input_unit" id="txt2">{{ $currancy}}/month</span>
                    </div>
                    <div class="space-y-2 relative" id="i3">
                        <label for="third" class="font-s-14 text-blue" id="pak3">{{  $lang[7] }}:</label>
                        <input type="number" step="any" name="third" id="third" class="input" aria-label="input" placeholder="12" value="{{ isset($_POST['third'])?$_POST['third']:'12' }}" />
                        <span class="text-blue input_unit" id="txt3">{{ $currancy}}/month</span>
                    </div>
                    <div class="space-y-2 relative" id="i4">
                        <label for="four" class="font-s-14 text-blue" id="pak4">{{  $lang[8] }}:</label>
                        <input type="number" step="any" name="four" id="four" class="input" aria-label="input" placeholder="12" value="{{ isset($_POST['four'])?$_POST['four']:'12' }}" />
                        <span class="text-blue input_unit" id="txt4">{{ $currancy}}/month</span>
                    </div>
                </div>
                <div class="grid grid-cols-1  gap-4 mt-3" id="converter">
                    <div class="space-y-2 relative">
                        <label for="f_first" class="font-s-14 text-blue" id="txt1">{{  $lang[9] }}:</label>
                        <input type="number" step="any" name="f_first" id="f_first" class="input" aria-label="input" placeholder="1500" value="{{ isset($_POST['f_first'])?$_POST['f_first']:'1500' }}" />
                        <span class="text-blue input_unit" id="txt1">{{ $currancy}}/month</span>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="f_second" class="font-s-14 text-blue" id="txt2">{{  $lang[10] }}:</label>
                        <input type="number" step="any" name="f_second" id="f_second" class="input" aria-label="input" placeholder="1500" value="{{ isset($_POST['f_second'])?$_POST['f_second']:'1500' }}" />
                        <span class="text-blue input_unit" id="txt1">{{ $currancy}}/day</span>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="f_third" class="font-s-14 text-blue" id="txt2">{{  $lang[11] }}:</label>
                        <input type="number" step="any" name="f_third" id="f_third" class="input" aria-label="input" placeholder="1500" value="{{ isset($_POST['f_third'])?$_POST['f_third']:'1500' }}" />
                        <span class="text-blue input_unit" id="txt1">days</span>
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
                <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                    <div class="w-full text-center text-xl">
                        <p class="mb-5">{{ $detail['heading'] }}</p>
                        <p class="my-3" id="jawab">
                            <strong class="bg-[#2845F5] px-3 py-2 lg:text-4xl rounded-lg text-white">{{ $detail['answer'] }} {{$currancy}}/month</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
<script>
  @if(isset($detail))
    var dropVals = "{{$detail['operations']}}";
    var type = "{{$detail['type']}}";

    if(dropVals=='1'){
        document.getElementById('i1').style.display = 'block';
        document.getElementById('i2').style.display = 'block';
        document.getElementById('i3').style.display = 'none';
        document.getElementById('i4').style.display = 'none';
        document.getElementById('pak1').textContent = "{{$lang[5]}}:";
        document.getElementById('txt1').textContent = "{{$currancy }}/day";
        document.getElementById('pak2').textContent = "{{$lang[6]}}:";
        document.getElementById('txt2').textContent = "/month";
    } else if(dropVals=='2'){
        document.getElementById('i1').style.display = 'block';
        document.getElementById('i2').style.display = 'block';
        document.getElementById('i3').style.display = 'block';
        document.getElementById('i4').style.display = 'none';
        document.getElementById('pak1').textContent = "{{$lang[14]}}:";
        document.getElementById('txt1').textContent = "{{$currancy }}";
        document.getElementById('pak2').textContent = "{{$lang[15]}}:";
        document.getElementById('txt2').textContent = "{{$currancy }}/month";
        document.getElementById('pak3').textContent = "{{$lang[7]}}:";
        document.getElementById('txt3').textContent = "#months";
    } else if(dropVals=='3'){
        document.getElementById('i1').style.display = 'block';
        document.getElementById('i2').style.display = 'block';
        document.getElementById('i3').style.display = 'block';
        document.getElementById('i4').style.display = 'block';
        document.getElementById('pak1').textContent = "{{$lang[16]}}:";
        document.getElementById('txt1').textContent = "{{$currancy }}/month";
        document.getElementById('pak2').textContent = "{{$lang[17]}}:";
        document.getElementById('txt2').textContent = "{{$currancy }}/month";
        document.getElementById('pak3').textContent = "{{$lang[18]}}:";
        document.getElementById('txt3').textContent = "{{$currancy }}/month";
        document.getElementById('pak4').textContent = "{{$lang[8]}}:";
        document.getElementById('txt4').textContent = "{{$currancy }}/month";
    }

    if(type=='first'){
        document.getElementById('converter').style.display = 'block';
        document.getElementById('calculator').style.display = 'none';
    } else if(type=='second'){
        document.getElementById('converter').style.display = 'none';
        document.getElementById('calculator').style.display = 'block';
    }

@endif



@if(isset($error))
var dropVals = "{{$_POST['operations']}}";
var type = "{{$_POST['type']}}";

if(dropVals=='1'){
        document.getElementById('i1').style.display = 'block';
        document.getElementById('i2').style.display = 'block';
        document.getElementById('i3').style.display = 'none';
        document.getElementById('i4').style.display = 'none';
        document.getElementById('pak1').textContent = "{{$lang[5]}}:";
        document.getElementById('txt1').textContent = "{{$currancy }}/day";
        document.getElementById('pak2').textContent = "{{$lang[6]}}:";
        document.getElementById('txt2').textContent = "/month";
    } else if(dropVals=='2'){
        document.getElementById('i1').style.display = 'block';
        document.getElementById('i2').style.display = 'block';
        document.getElementById('i3').style.display = 'block';
        document.getElementById('i4').style.display = 'none';
        document.getElementById('pak1').textContent = "{{$lang[14]}}:";
        document.getElementById('txt1').textContent = "{{$currancy }}";
        document.getElementById('pak2').textContent = "{{$lang[15]}}:";
        document.getElementById('txt2').textContent = "{{$currancy }}/month";
        document.getElementById('pak3').textContent = "{{$lang[7]}}:";
        document.getElementById('txt3').textContent = "#months";
    } else if(dropVals=='3'){
        document.getElementById('i1').style.display = 'block';
        document.getElementById('i2').style.display = 'block';
        document.getElementById('i3').style.display = 'block';
        document.getElementById('i4').style.display = 'block';
        document.getElementById('pak1').textContent = "{{$lang[16]}}:";
        document.getElementById('txt1').textContent = "{{$currancy }}/month";
        document.getElementById('pak2').textContent = "{{$lang[17]}}:";
        document.getElementById('txt2').textContent = "{{$currancy }}/month";
        document.getElementById('pak3').textContent = "{{$lang[18]}}:";
        document.getElementById('txt3').textContent = "{{$currancy }}/month";
        document.getElementById('pak4').textContent = "{{$lang[8]}}:";
        document.getElementById('txt4').textContent = "{{$currancy }}/month";
    }

    if(type=='first'){
        document.getElementById('converter').style.display = 'block';
        document.getElementById('calculator').style.display = 'none';
    } else if(type=='second'){
        document.getElementById('converter').style.display = 'none';
        document.getElementById('calculator').style.display = 'block';
    }


 @endif




  document.getElementById('operations').addEventListener('change', function() {
    var cal = this.value;
    var i1 = document.getElementById('i1');
    var i2 = document.getElementById('i2');
    var i3 = document.getElementById('i3');
    var i4 = document.getElementById('i4');
    var pak1 = document.getElementById('pak1');
    var pak2 = document.getElementById('pak2');
    var pak3 = document.getElementById('pak3');
    var pak4 = document.getElementById('pak4');
    var txt1 = document.getElementById('txt1');
    var txt2 = document.getElementById('txt2');
    var txt3 = document.getElementById('txt3');
    var txt4 = document.getElementById('txt4');
    
    if (cal === '1') {
        i1.style.display = 'block';
        i2.style.display = 'block';
        i3.style.display = 'none';
        i4.style.display = 'none';
        pak1.textContent = "{{$lang[5]}}:";
        txt1.textContent = "{{$currancy }}/day";
        pak2.textContent = "{{$lang[6]}}:";
        txt2.textContent = "/month";
    } else if (cal === '2') {
        i1.style.display = 'block';
        i2.style.display = 'block';
        i3.style.display = 'block';
        i4.style.display = 'none';
        pak1.textContent = "{{$lang[14]}}:";
        txt1.textContent = "{{$currancy }}";
        pak2.textContent = "{{$lang[15]}}:";
        txt2.textContent = "{{$currancy }}/month";
        pak3.textContent = "{{$lang[7]}}:";
        txt3.textContent = "#months";
    } else if (cal === '3') {
        i1.style.display = 'block';
        i2.style.display = 'block';
        i3.style.display = 'block';
        i4.style.display = 'block';
        pak1.textContent = "{{$lang[16]}}:";
        txt1.textContent = "{{$currancy }}/month";
        pak2.textContent = "{{$lang[17]}}:";
        txt2.textContent = "{{$currancy }}/month";
        pak3.textContent = "{{$lang[18]}}:";
        txt3.textContent = "{{$currancy }}/month";
        pak4.textContent = "{{$lang[8]}}:";
        txt4.textContent = "{{$currancy }}/month";
    }
});

  document.addEventListener('DOMContentLoaded', function() {
    var firstRadio = document.getElementById('firsts');
    var secondRadio = document.getElementById('seconds');
    var converter = document.getElementById('converter');
    var calculator = document.getElementById('calculator');

    firstRadio.addEventListener('click', function() {
        converter.style.display = 'block';
        calculator.style.display = 'none';
    });

    secondRadio.addEventListener('click', function() {
        converter.style.display = 'none';
        calculator.style.display = 'block';
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>