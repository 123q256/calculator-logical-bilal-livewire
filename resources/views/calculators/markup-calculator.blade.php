<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="to_cal" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 relative">
                    <select class="input" name="to_cal" id="to_cal">
                        <option value="1"  {{ isset($_POST['to_cal']) && $_POST['to_cal']=='1'?'selected':''}}> {{$lang['c']}} &  {{$lang['d']}}</option>
                        <option value="2"  {{ isset($_POST['to_cal']) && $_POST['to_cal']=='2'?'selected':''}}> {{$lang['b']}} &  {{$lang['d']}}</option>
                        <option value="3"  {{ isset($_POST['to_cal']) && $_POST['to_cal']=='3'?'selected':''}} selected> {{$lang['b']}} &  {{$lang['c']}}</option>
                        <option value="4"  {{ isset($_POST['to_cal']) && $_POST['to_cal']=='4'?'selected':''}} > {{$lang['a']}} &  {{$lang['d']}}</option>
                        <option value="5"  {{ isset($_POST['to_cal']) && $_POST['to_cal']=='5'?'selected':''}}> {{$lang['a']}} &  {{$lang['c']}}</option>
                        <option value="6"  {{ isset($_POST['to_cal']) && $_POST['to_cal']=='6'?'selected':''}}> {{$lang['a']}} &  {{$lang['b']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 a">
                <label for="a" class="label">{{ $lang['a'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="a" id="a" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['a'])?$_POST['a']:'10' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden b">
                <label for="b" class="label">{{ $lang['b'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="b" id="b" class="input" aria-label="input" placeholder="20" value="{{ isset($_POST['b'])?$_POST['b']:'20' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hiddenc">
                <label for="c" class="label">{{ $lang['c'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="c" id="c" class="input" aria-label="input" placeholder="30" value="{{ isset($_POST['c'])?$_POST['c']:'30' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 d">
                <label for="d" class="label">{{ $lang['d'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="d" id="d" class="input" aria-label="input" placeholder="40" value="{{ isset($_POST['d'])?$_POST['d']:'40' }}" />
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
                        <table class="w-full  text-[18px]">
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['a'] }} </strong></td>
                            <td class="py-2 border-b"> {{ $currancy }}{{ (($detail['cost']!='')?$detail['cost']:'0.0') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['b'] }} </strong></td>
                            <td class="py-2 border-b"> {{ (($detail['markup']!='')?$detail['markup']:'0.0') }}%</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['c'] }} </strong></td>
                            <td class="py-2 border-b"> {{ $currancy }}{{ (($detail['revenue']!='')?$detail['revenue']:'0.0') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['d'] }} </strong></td>
                            <td class="py-2 border-b"> {{ $currancy }}{{ (($detail['profit']!='')?$detail['profit']:'0.0') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['e'] }} </strong></td>
                            <td class="py-2 border-b"> {{ (($detail['margin']!='')?$detail['margin']:'0.0') }}%</td>
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

    @if(isset($_POST['to_cal']))
    var val = document.getElementById('to_cal').value;
    if (val == 1) {
        document.querySelectorAll('.a, .b').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.c, .d').forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (val == 2) {
        document.querySelectorAll('.a, .c').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.b, .d').forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (val == 3) {
        document.querySelectorAll('.a, .d').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.b, .c').forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (val == 4) {
        document.querySelectorAll('.a, .d').forEach(function(element) {
            element.style.display = 'none';
        });
        document.querySelectorAll('.b, .c').forEach(function(element) {
            element.style.display = 'block';
        });
    } else if (val == 5) {
        document.querySelectorAll('.b, .d').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.a, .c').forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (val == 6) {
        document.querySelectorAll('.a, .b').forEach(function(element) {
            element.style.display = 'none';
        });
        document.querySelectorAll('.d, .c').forEach(function(element) {
            element.style.display = 'block';
        });
    }
@endif

    document.getElementById('to_cal').addEventListener('change', function() {
    var val = this.value;

    if (val == 1) {
        document.querySelectorAll('.a, .b').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.c, .d').forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (val == 2) {
        document.querySelectorAll('.a, .c').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.b, .d').forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (val == 3) {
        document.querySelectorAll('.a, .d').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.b, .c').forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (val == 4) {
        document.querySelectorAll('.b, .c').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.a, .d').forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (val == 5) {
        document.querySelectorAll('.b, .d').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.a, .c').forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (val == 6) {
        document.querySelectorAll('.d, .c').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.a, .b').forEach(function(element) {
            element.style.display = 'none';
        });
    }
});

</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>