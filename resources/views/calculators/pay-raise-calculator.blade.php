<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-6">
                <label for="period" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="period" id="period">
                        <option value="1"  {{ isset($_POST['period']) && $_POST['period']=='1'?'selected':''}}> {{$lang['2']}} </option>
                        <option value="2"  {{ isset($_POST['period']) && $_POST['period']=='2'?'selected':''}}> {{$lang['3']}} </option>
                        <option value="3"  {{ isset($_POST['period']) && $_POST['period']=='3'?'selected':''}}> {{$lang['4']}}</option>
                        <option value="4"  {{ isset($_POST['period']) && $_POST['period']=='4'?'selected':''}} > {{$lang['5']}} </option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="pay" class="label">{{ $lang['6'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="pay" id="pay" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['pay'])?$_POST['pay']:'50' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="hour" class="label">{{ $lang['7'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="hour" id="hour" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['hour'])?$_POST['hour']:'40' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="type" class="label">{{ $lang['8'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="type" id="type">
                        <option value="1"  {{ isset($_POST['type']) && $_POST['type']=='1'?'selected':''}}> {{$lang['9']}} </option>
                        <option value="2"  {{ isset($_POST['type']) && $_POST['type']=='2'?'selected':''}}> {{$lang['10']}} </option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="new" class="label">Pay Raise: (<span class="type">%</span>)</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="new" id="new" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['new'])?$_POST['new']:'40' }}" />
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
                              <td class="py-2 border-b" width="70%"><strong>{{ $lang[9] }} (R) </strong></td>
                               <td class="py-2 border-b"> {{ round($detail['percent'],2) }} %</td>
                           </tr>
                        </table>
                    </div>
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-full font-s-16">
                            <tr>
                                <td class="py-2 mt-2" width="70%"><strong>{{ $lang['11'] }} </strong></td>
                            </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['2'] }} </strong></td>
                            <td class="py-2 border-b"> {{$currancy}} {{ number_format($detail['hourly'],2) }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['3'] }} </strong></td>
                            <td class="py-2 border-b"> {{$currancy}} {{ number_format($detail['weekly'],2) }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['4'] }} </strong></td>
                            <td class="py-2 border-b"> {{$currancy}} {{ number_format($detail['monthly'],2) }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['5'] }} </strong></td>
                            <td class="py-2 border-b"> {{$currancy}} {{ number_format($detail['yearly'],2)}}</td>
                        </tr>
                        </table>
                        <table class="w-full font-s-16">
                            <tr>
                                <td class="py-2 mt-2" width="70%"><strong>{{ $lang['12'] }} </strong></td>
                            </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%">{{ $lang['2'] }} </td>
                            <td class="py-2 border-b"> <strong> {{$currancy}} {{ number_format(($detail['hourly']+$detail['incHour']),2) }}<strong></td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%">{{ $lang['3'] }} </td>
                            <td class="py-2 border-b"> <strong> {{$currancy}} {{ number_format(($detail['weekly']+$detail['incWeek']),2) }}<strong></td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%">{{ $lang['4'] }} </td>
                            <td class="py-2 border-b"> <strong> {{$currancy}} {{ number_format(($detail['monthly']+$detail['incMonth']),2) }}<strong></td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%">{{ $lang['5'] }} </td>
                            <td class="py-2 border-b"> <strong> {{$currancy}} {{ number_format(($detail['yearly']+$detail['incYear']),2)}}<strong></td>
                        </tr>
                        </table>
                        <table class="w-100 font-s-16">
                            <tr>
                                <td class="py-2 mt-2" width="70%"><strong>{{ $lang['13'] }} </strong></td>
                            </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['2'] }} </strong></td>
                            <td class="py-2 border-b"> {{$currancy}} {{ number_format($detail['incHour'],2) }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['3'] }} </strong></td>
                            <td class="py-2 border-b"> {{$currancy}} {{ number_format($detail['incWeek'],2) }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['4'] }} </strong></td>
                            <td class="py-2 border-b"> {{$currancy}} {{ number_format($detail['incMonth'],2) }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['5'] }} </strong></td>
                            <td class="py-2 border-b"> {{$currancy}} {{ number_format($detail['incYear'],2)}}</td>
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
    var dropVals = "{{$detail['type']}}";
    var otherElements = document.querySelectorAll('.type');

    if (dropVals === '1') {
        otherElements.forEach(function(element) {
            element.textContent = '%';
        });
    } else if (dropVals === '2') {
        otherElements.forEach(function(element) {
            element.textContent = '{{$currancy}}';
        });
    }
    @endif

    document.getElementById('type').addEventListener('change', function() {
        var type = this.value;
        var typeElements = document.querySelectorAll('.type');

        if (type === '1') {
            typeElements.forEach(function(element) {
                element.textContent = '%';
            });
        } else {
            typeElements.forEach(function(element) {
                element.textContent = '{{$currancy}}';
            });
        }
    });
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>