<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4"> 

            <div class="col-span-12">
                <label for="myselection" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="type" id="myselection">
                        <option value="average_cost"  {{ isset($_POST['type']) && $_POST['type']=='average_cost'?'selected':''}}> Average Variable Cost </option>
                        <option value="variable_cost"  {{ isset($_POST['type']) && $_POST['type']=='variable_cost'?'selected':''}}> Variable Costs </option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="cost" class="label vc">{{ $lang['2'] }} (VC):</label>
                <label for="cost" class="label hidden c">{{ $lang['3'] }}</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="cost" id="cost" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['cost'])?$_POST['cost']:'50' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12">
                <label for="output" class="label q">{{ $lang['4'] }} (Q):</label>
                <label for="output" class="label hidden fc">{{ $lang['5'] }}</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="output" id="output" class="input" aria-label="input" placeholder="40" value="{{ isset($_POST['output'])?$_POST['output']:'50' }}" />
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
                    @if(isset($detail['type']))
                    @if($detail['type'] == 'average_cost')
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full text-[18px]">
                           <tr>
                              <td class="py-2 border-b" width="70%"><strong>{{ $lang['6'] }} (AVC)</strong></td>
                               <td class="py-2 border-b"> {{$currancy }} {{ round($detail['av_cost'],4) }}</td>
                           </tr>
                        </table>
                    </div>
                    <div class="col-12 text-[16px]">
                        <p class="mt-3"><strong>{{ $lang['7']  }}</strong></p>
                        <p >
                            AvgCost<sub>variable</sub>  = 
                                <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                    <span class="num">Cost <sub>variable</sub></span>
                                    <span class="visually-hidden"> / </span>
                                    <span class="den">Output <sub>total</sub></span>
                                </span>
                                
                        </p>
                        <p class="mt-2"><?= $lang['8'] ?></p>
                        <p >
                            AvgCost<sub>variable</sub>  = 
                                <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                    <span class="num">Cost <sub>variable</sub></span>
                                    <span class="visually-hidden"> / </span>
                                    <span class="den">Output <sub>total</sub></span>
                                </span>
                        </p>
                        <p >
                        AvgCost<sub>variable</sub>  = 
                            <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                <span class="num">{{round($detail['cost'])}}</span>
                                <span class="visually-hidden"> / </span>
                                <span class="den">{{round($detail['output'])}}</span>
                            </span>
                        </p>
                        </p>
                        <p class="mt-2">AvgCost<sub>variable</sub>= <strong>{{ $currancy }}{{round($detail['av_cost'],4)}}</strong></p>
                    </div>
                    @endif
                    @if($detail['type'] == 'variable_cost')
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full font-s-18">
                           <tr>
                              <td class="py-2 border-b" width="70%"><strong>{{ $lang['2'] }} (AVC)</strong></td>
                               <td class="py-2 border-b"> {{$currancy }} {{ round($detail['v_cost'],4) }}</td>
                           </tr>
                        </table>
                    </div>
                    <div class="col-12 font-s-16">
                        <p class="mt-3"><strong>{{  $lang['7'] }}</strong></p>
                        <p class="mt-2">{{ $lang['2'] }} = {{  $lang['3'] }}-{{  $lang['5'] }}</p>
                        <p class="mt-2">{{ $lang['8'] }}</p>
                        <p class="mt-2">{{ $lang['2'] }} = {{  $lang['3'] }} - {{  $lang['5'] }}</p>
                        <p class="mt-2">{{ $lang['2'] }} = {{ round($detail['cost'])}} - {{ round($detail['output'])}}</p>
                        <p class="mt-2">{{ $lang['2'] }} = <strong>{{ round($detail['v_cost'],4)}} {{ $currancy}}</strong></p>
                    </div>
                    @endif
                    @endif
        
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script>

    @if(isset($detail))
    var type = "{{$detail['type']}}";

    if (type === 'average_cost') {
        var vcElements = document.querySelectorAll('.vc');
        var qElements = document.querySelectorAll('.q');
        var cElements = document.querySelectorAll('.c');
        var fcElements = document.querySelectorAll('.fc');

        vcElements.forEach(function(element) {
            element.style.display = 'block';
        });
        qElements.forEach(function(element) {
            element.style.display = 'block';
        });
        cElements.forEach(function(element) {
            element.style.display = 'none';
        });
        fcElements.forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (type === 'variable_cost') {
        var vcElements = document.querySelectorAll('.vc');
        var qElements = document.querySelectorAll('.q');
        var cElements = document.querySelectorAll('.c');
        var fcElements = document.querySelectorAll('.fc');

        vcElements.forEach(function(element) {
            element.style.display = 'none';
        });
        qElements.forEach(function(element) {
            element.style.display = 'none';
        });
        cElements.forEach(function(element) {
            element.style.display = 'block';
        });
        fcElements.forEach(function(element) {
            element.style.display = 'block';
        });
    }
@endif



@if(isset($error))
var types = "{{$_POST['type']}}";
if (types === 'average_cost') {
        var vcElements = document.querySelectorAll('.vc');
        var qElements = document.querySelectorAll('.q');
        var cElements = document.querySelectorAll('.c');
        var fcElements = document.querySelectorAll('.fc');

        vcElements.forEach(function(element) {
            element.style.display = 'block';
        });
        qElements.forEach(function(element) {
            element.style.display = 'block';
        });
        cElements.forEach(function(element) {
            element.style.display = 'none';
        });
        fcElements.forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (types === 'variable_cost') {
        var vcElements = document.querySelectorAll('.vc');
        var qElements = document.querySelectorAll('.q');
        var cElements = document.querySelectorAll('.c');
        var fcElements = document.querySelectorAll('.fc');

        vcElements.forEach(function(element) {
            element.style.display = 'none';
        });
        qElements.forEach(function(element) {
            element.style.display = 'none';
        });
        cElements.forEach(function(element) {
            element.style.display = 'block';
        });
        fcElements.forEach(function(element) {
            element.style.display = 'block';
        });
    }
 @endif
 

    document.getElementById('myselection').addEventListener('change', function() {
    var demovalue = this.value;
    var vcElements = document.querySelectorAll('.vc');
    var qElements = document.querySelectorAll('.q');
    var cElements = document.querySelectorAll('.c');
    var fcElements = document.querySelectorAll('.fc');

    if (demovalue === 'average_cost') {
        vcElements.forEach(function(element) {
            element.style.display = 'block';
        });
        qElements.forEach(function(element) {
            element.style.display = 'block';
        });
        cElements.forEach(function(element) {
            element.style.display = 'none';
        });
        fcElements.forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (demovalue === 'variable_cost') {
        vcElements.forEach(function(element) {
            element.style.display = 'none';
        });
        qElements.forEach(function(element) {
            element.style.display = 'none';
        });
        cElements.forEach(function(element) {
            element.style.display = 'block';
        });
        fcElements.forEach(function(element) {
            element.style.display = 'block';
        });
    }
});

</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>