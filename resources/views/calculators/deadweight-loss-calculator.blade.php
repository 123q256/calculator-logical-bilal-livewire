<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-6">
                    <label for="original_price" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="original_price" id="original_price" class="input" aria-label="input" placeholder="6" value="{{ isset($_POST['original_price'])?$_POST['original_price']:'6' }}" />
                        <span class="text-blue input_unit">{{ $lang['2'] }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="new_price" class="label">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="new_price" id="new_price" class="input" aria-label="input" placeholder="7" value="{{ isset($_POST['new_price'])?$_POST['new_price']:'7' }}" />
                        <span class="text-blue input_unit">{{ $lang['2'] }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="original_quantity" class="label">{{ $lang['4'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="original_quantity" id="original_quantity" class="input" aria-label="input" placeholder="2200" value="{{ isset($_POST['original_quantity'])?$_POST['original_quantity']:'2200' }}" />
                        <span class="text-blue input_unit">{{ $lang['5'] }}</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="new_quantity" class="label">{{ $lang['6'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="new_quantity" id="new_quantity" class="input" aria-label="input" placeholder="1760" value="{{ isset($_POST['new_quantity'])?$_POST['new_quantity']:'1760' }}" />
                        <span class="text-blue input_unit">{{ $lang['5'] }}</span>
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
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }} </strong></td>
                                <td class="py-2 border-b">Rs {{ round($detail['deadweight']) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                        <p class="mt-2"><strong>{{ $lang['12']}}</strong></p>
                        <p class="mt-2">{{ $lang['9'] }}</p>
                        <p class="mt-2"> {{$lang['10']}} = (Pn - Po) \ (Qo - Qn)2</p>
                        <p class="mt-2">Where:</p>
                        <p class="mt-2 mx-2">Po = {{ $lang['1'] }}</p>
                        <p class="mt-2 mx-2">Pn = {{ $lang['3'] }}</p>
                        <p class="mt-2 mx-2">Qo = {{ $lang['4'] }}</p>
                        <p class="mt-2 mx-2">Qn = {{ $lang['6'] }}</p>
                        <p class="mt-2">{{ $lang['10'] }} =  ({{ isset($_POST['new_price'])?$_POST['new_price']:'' }} - {{ isset($_POST['original_price'])?$_POST['original_price']:'6' }}) x ({{ isset($_POST['original_quantity'])?$_POST['original_quantity']:'' }} - {{ isset($_POST['new_quantity'])?$_POST['new_quantity']:'' }})/2</p>
                        <p class="mt-2">{{ $lang['10'] }} = {{$detail['total_price']}} x {{$detail['total_quantity']}} / 2</p>
                        <p class="mt-2">{{ $lang['10'] }} =  {{$detail['dead']}} /2 </p>
                        <p class="mt-2">{{ $lang['11'] }} {{ $lang['10'] }}: Rs {{ $detail['deadweight']}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>