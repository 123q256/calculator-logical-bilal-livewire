<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="operations1" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <select class="input mt-2" name="operations1" id="operations1">
                    <option value="1"  {{ isset($_POST['operations1']) && $_POST['operations1']=='1'?'selected':''}}>{{$lang[2]}}</option>
                    <option value="2"  {{ isset($_POST['operations1']) && $_POST['operations1']=='2'?'selected':''}}>{{$lang[3]}}</option>
                    <option value="3"  {{ isset($_POST['operations1']) && $_POST['operations1']=='3'?'selected':''}}>{{$lang[4]}}</option>
                  </select>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="first" class="font-s-14 text-blue" id="txt1">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['first'])?$_POST['first']:'50' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="second" class="font-s-14 text-blue" id="txt2">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="second" id="second" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['second'])?$_POST['second']:'50' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="can_city">
                <label for="operations2" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                <select class="input mt-2" id="operations2" name="operations2">
                    <option value="1"  {{ isset($_POST['operations2']) && $_POST['operations2']=='1'?'selected':''}}>{{$lang[6]}}</option>
                    <option value="2"  {{ isset($_POST['operations2']) && $_POST['operations2']=='2'?'selected':''}}>{{$lang[7]}}</option>
                    <option value="3"  {{ isset($_POST['operations2']) && $_POST['operations2']=='3'?'selected':''}}>{{$lang[8]}}</option>
                  </select>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="third" class="font-s-14 text-blue" id="txt3">{{ $lang['7'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="third" id="third" class="input" aria-label="input" placeholder="35" value="{{ isset($_POST['third'])?$_POST['third']:'35' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="four" class="font-s-14 text-blue" id="txt4">{{ $lang['8'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="four" id="four" class="input" aria-label="input" placeholder="20" value="{{ isset($_POST['four'])?$_POST['four']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="five" class="font-s-14 text-blue" id="txt5">{{ $lang['9'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="five" id="five" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['five'])?$_POST['five']:'10' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
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
                    <tr>
                        <td class="py-2 border-b" width="70%"><strong>{{$detail['line1']}}</strong></td>
                        <td class="py-2 border-b"> {{ $currancy }} {{ $detail['answer1'] }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 border-b" width="70%"><strong>{{$detail['line2']}}</strong></td>
                        <td class="py-2 border-b">  {{ $currancy }}{{ $detail['answer2'] }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 border-b" width="70%"><strong>{{$lang[9]}}</strong></td>
                        <td class="py-2 border-b"> {{ $currancy }} {{ $detail['ps'] }}</td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    @endisset
</form>

@push('calculatorJS')
<script>
    @if(isset($detail))
    var operations2 = {{ $detail['operations2'] }};
    if (operations2 === 1) {
        document.getElementById('txt3').textContent = '{{$lang[7]}}:';
        document.getElementById('txt4').textContent = '{{$lang[8]}}:';
    } else if (operations2 === 2) {
        document.getElementById('txt3').textContent = '{{$lang[6]}}:';
        document.getElementById('txt4').textContent = '{{$lang[8]}}:';
    } else {
        document.getElementById('txt3').textContent = '{{$lang[7]}}:';
        document.getElementById('txt4').textContent = '{{$lang[6]}}:';
    }
   @endif

   @if(isset($detail))
    var operations1 = {{ $detail['operations1'] }};
    if (operations1 === 1) {
        document.getElementById('txt1').textContent = '{{$lang[3]}}:';
        document.getElementById('txt2').textContent = '{{$lang[4]}}:';
    } else if (operations1 === 2) {
        document.getElementById('txt1').textContent = '{{$lang[2]}}:';
        document.getElementById('txt2').textContent = '{{$lang[4]}}:';
    } else {
        document.getElementById('txt1').textContent = '{{$lang[2]}}:';
        document.getElementById('txt2').textContent = '{{$lang[3]}}:';
    }
@endif

    var select = document.getElementById("operations1");
    select.addEventListener('change', function() {
    var cal = this.value;

    if (cal === '1') {
        document.getElementById('txt1').textContent = '{{$lang[3]}}:';
        document.getElementById('txt2').textContent = '{{$lang[4]}}:';
    } else if (cal === '2') {
        document.getElementById('txt1').textContent = '{{$lang[2]}}:';
        document.getElementById('txt2').textContent = '{{$lang[4]}}:';
    } else if (cal === '3') {
        document.getElementById('txt1').textContent = '{{$lang[2]}}:';
        document.getElementById('txt2').textContent = '{{$lang[3]}}:';
    }
});

var select = document.getElementById("operations2");
select.addEventListener('change', function() {
    var cal = this.value;

    if (cal === '1') {
        document.getElementById('txt3').textContent = '{{$lang[7]}}:';
        document.getElementById('txt4').textContent = '{{$lang[8]}}:';
    } else if (cal === '2') {
        document.getElementById('txt3').textContent = '{{$lang[6]}}:';
        document.getElementById('txt4').textContent = '{{$lang[8]}}:';
    } else if (cal === '3') {
        document.getElementById('txt3').textContent = '{{$lang[7]}}:';
        document.getElementById('txt4').textContent = '{{$lang[6]}}:';
    }
});

</script>

@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>