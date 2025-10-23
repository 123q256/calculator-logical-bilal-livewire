<style>
    img{
        object-fit: contain;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    {{-- <div class="col-12 col-lg-8 mx-auto">
        <div class="row">
          
            <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2">
                <label for="calculate" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2" >
                    <select name="calculate" id="calculate" class="input">
                        <option  value="1" {{ isset($_POST['calculate']) && $_POST['calculate']=='1'?'selected':''}}>{{ $lang['2']." & ".$lang['3']}}</option>
                        <option value="2" {{ isset($_POST['calculate']) && $_POST['calculate']=='2'?'selected':''}}>{{ $lang['4']." & ".$lang['5']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 ps-lg-4 mt-0 mt-lg-2 employed_people">
                <label for="employed_people" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="employed_people" id="employed_people" class="input" aria-label="input" placeholder="40" value="{{ isset($_POST['employed_people'])?$_POST['employed_people']:'40' }}" />
                    <span class="input_unit">{{ $lang['7']}}</span>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2 unemployed_people">
                <label for="unemployed_people" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="unemployed_people" id="unemployed_people" class="input" aria-label="input" placeholder="40" value="{{ isset($_POST['unemployed_people'])?$_POST['unemployed_people']:'40' }}" />
                    <span class="input_unit">{{ $lang['7']}}</span>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 ps-lg-4 mt-0 mt-lg-2 hidden labor_force">
                <label for="labor_force" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="labor_force" id="labor_force" class="input" aria-label="input" placeholder="1.44" value="{{ isset($_POST['labor_force'])?$_POST['labor_force']:'1.44' }}" />
                    <span class="input_unit">{{ $lang['7']}}</span>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 pe-lg-4 mt-0 mt-lg-2 hidden unemployment_rate">
                <label for="unemployment_rate" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="unemployment_rate" id="unemployment_rate" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['unemployment_rate'])?$_POST['unemployment_rate']:'50' }}" />
                    <span class="input_unit">%</span>
                </div>
            </div>
            <div class="col-lg-6 col-12 px-2 ps-lg-4 mt-0 mt-lg-2">
                <label for="adult_population" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="adult_population" id="adult_population" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['adult_population'])?$_POST['adult_population']:'' }}" />
                    <span class="input_unit">%</span>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="calculate" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select name="calculate" id="calculate" class="input">
                        <option  value="1" {{ isset($_POST['calculate']) && $_POST['calculate']=='1'?'selected':''}}>{{ $lang['2']." & ".$lang['3']}}</option>
                        <option value="2" {{ isset($_POST['calculate']) && $_POST['calculate']=='2'?'selected':''}}>{{ $lang['4']." & ".$lang['5']}}</option>
                    </select>
                </div>
                <div class="space-y-2 relative employed_people">
                    <label for="employed_people" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <input type="number" step="any" name="employed_people" id="employed_people" class="input" aria-label="input" placeholder="40" value="{{ isset($_POST['employed_people'])?$_POST['employed_people']:'40' }}" />
                    <span class="input_unit">{{ $lang['7']}}</span>
                </div>
                <div class="space-y-2 relative unemployed_people">
                    <label for="unemployed_people" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <input type="number" step="any" name="unemployed_people" id="unemployed_people" class="input" aria-label="input" placeholder="40" value="{{ isset($_POST['unemployed_people'])?$_POST['unemployed_people']:'40' }}" />
                    <span class="input_unit">{{ $lang['7']}}</span>
                </div>
                <div class="space-y-2 relative hidden labor_force">
                    <label for="labor_force" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <input type="number" step="any" name="labor_force" id="labor_force" class="input" aria-label="input" placeholder="1.44" value="{{ isset($_POST['labor_force'])?$_POST['labor_force']:'1.44' }}" />
                    <span class="input_unit">{{ $lang['7']}}</span>
                </div>
                <div class="space-y-2 relative hidden unemployment_rate">
                    <label for="unemployment_rate" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <input type="number" step="any" name="unemployment_rate" id="unemployment_rate" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['unemployment_rate'])?$_POST['unemployment_rate']:'50' }}" />
                    <span class="input_unit">%</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="adult_population" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                    <input type="number" step="any" name="adult_population" id="adult_population" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['adult_population'])?$_POST['adult_population']:'' }}" />
                    <span class="input_unit">%</span>
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
          {{-- result --}}
          <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue  rounded-lg mt-6">
                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-4">
                        <table class="w-full text-lg">
                
                            @if($detail['method'] == "1")
                            <tr>
                                <td class="py-2 border-b w-4/5"><strong>{{ $lang['2'] }} </strong></td>
                                <td class="py-2 border-b"> {{ $detail['labor_force']}} ({{ $lang['7'] }})</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5"><strong>{{ $lang['3'] }} </strong></td>
                                <td class="py-2 border-b"> {{ $detail['unemployment_rate']}} (%)</td>
                            </tr>
                            @endif
                
                            @if($detail['method'] == "2")
                            <tr>
                                <td class="py-2 border-b w-4/5"><strong>{{ $lang['6'] }} </strong></td>
                                <td class="py-2 border-b"> {{ $detail['unemployment']}} ({{ $lang['7'] }})</td>
                            </tr>
                            <tr>   
                                <td class="py-2 border-b w-4/5"><strong>{{ $lang['5'] }} ({{ $lang['7'] }}) </strong></td>
                                <td class="py-2 border-b"> {{ $detail['employment']}} ({{ $lang['7'] }})</td>
                            </tr>
                            @endif
                
                            @if(isset($detail['labor_force_participation']) && $detail['labor_force_participation'] != "")
                            <tr>
                                <td class="py-2 border-b w-4/5"><strong>{{ $lang['9'] }} </strong></td>
                                <td class="py-2 border-b"> {{ $detail['labor_force_participation']}} (%)</td>
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
@push('calculatorJS')

<script>
    @if(isset($detail))
    if({{ $detail['method'] }} == '1') {
        document.querySelectorAll('.employed_people, .unemployed_people').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.labor_force, .unemployment_rate').forEach(function(element) {
            element.style.display = 'none';
        });
    } else {
        document.querySelectorAll('.employed_people, .unemployed_people').forEach(function(element) {
            element.style.display = 'none';
        });
        document.querySelectorAll('.labor_force, .unemployment_rate').forEach(function(element) {
            element.style.display = 'block';
        });
    }
@endif
    document.getElementById('calculate').addEventListener('change', function() {
    var selectedValue = this.value;

    if (selectedValue === '1') {
        document.querySelectorAll('.employed_people, .unemployed_people').forEach(function(element) {
            element.style.display = 'block';
        });
        document.querySelectorAll('.labor_force, .unemployment_rate').forEach(function(element) {
            element.style.display = 'none';
        });
    } else if (selectedValue === '2') {
        document.querySelectorAll('.employed_people, .unemployed_people').forEach(function(element) {
            element.style.display = 'none';
        });
        document.querySelectorAll('.labor_force, .unemployment_rate').forEach(function(element) {
            element.style.display = 'block';
        });
    }
});
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>