<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="pay" class="label">{{ $lang['1'] }}?</label>
                <div class="w-100 py-2 relative">
                    <select name="pay" id="pay" class="input">
                        <option value="1"  {{ isset($_POST['pay']) && $_POST['pay']=='1'?'selected':''}}  >{{ $lang['2'] }}</option>
                        <option value="2"  {{ isset($_POST['pay']) && $_POST['pay']=='2'?'selected':''}}  >{{ $lang['3'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 a">
                <label for="dividend_per_share" class="label">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="dividend_per_share" id="dividend_per_share" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['dividend_per_share'])?$_POST['dividend_per_share']:'50' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 a">
                <label for="current_market_value" class="label">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="current_market_value" id="current_market_value" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['current_market_value'])?$_POST['current_market_value']:'50' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 a">
                <label for="growth_rate_dividend" class="label">{{ $lang['6'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="growth_rate_dividend" id="growth_rate_dividend" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['growth_rate_dividend'])?$_POST['growth_rate_dividend']:'50' }}" />
                    <span class="text-blue input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 aa hidden">
                <label for="risk_rate_return" class="label">{{ $lang['7'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="risk_rate_return" id="risk_rate_return" class="input" aria-label="input" placeholder="7" value="{{ isset($_POST['risk_rate_return'])?$_POST['risk_rate_return']:'7' }}" />
                    <span class="text-blue input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 aa hidden">
                <label for="market_rate_return" class="label">{{ $lang['8'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="market_rate_return" id="market_rate_return" class="input" aria-label="input" placeholder="7" value="{{ isset($_POST['market_rate_return'])?$_POST['market_rate_return']:'7' }}" />
                    <span class="text-blue input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 aa hidden">
                <label for="beta" class="label">{{ $lang['9'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="beta" id="beta" class="input" aria-label="input" placeholder="0" value="{{ isset($_POST['beta'])?$_POST['beta']:'0' }}" />
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
                    <div class="w-ful mt-3">
                        <div class="cw-full text-center text-[20px]">
                            <p>{{ $lang['10']}}</p>
                            <p class="my-3"><strong class="bg-[#2845F5] rounded-lg text-white px-3 py-2 text-[25px]">{{ $detail['ans'] }} (%)</strong></p>
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
    if({{ $detail['pay'] }} != '2') {
        document.querySelectorAll('.a').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.aa').forEach(function(element) {
            element.style.display = 'none';
        });
    } else {
        document.querySelectorAll('.aa').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.a').forEach(function(element) {
            element.style.display = 'none';
        });
    }
@endif

document.getElementById('pay').addEventListener('change', function() {
    var selectedValue = this.value;

    if (selectedValue === '1') {
        document.querySelectorAll('.a').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.aa').forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (selectedValue === '2') {
        document.querySelectorAll('.aa').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.a').forEach(function(element) {
            element.style.display = 'none';
        });
    }
});
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>