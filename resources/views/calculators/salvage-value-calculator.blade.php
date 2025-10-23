<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="original" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="original" id="original" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['original'])?$_POST['original']:'100' }}" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="rate" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="rate" id="rate" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['rate'])?$_POST['rate']:'10' }}" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="year" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="year" id="year" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['year'])?$_POST['year']:'10' }}" />
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
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }} </strong></td>
                                <td class="py-2 border-b"> {{round($detail['answer'], 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 text-[16px]">
                        <p class="mt-2"><strong>{{ $lang['5'] }}</strong></p>
                        <p class="mt-2"><?= $lang['6'] ?>.</p>
                        <p class="mt-2">{{ $lang['4']}} = P(1-i)<sup>y</sup></p>
                        <p class="mt-2">{{ $lang['7']}}</p>
                        <p class="mt-2">P = {{ $lang['1']}}</p>
                        <p class="mt-2">i = {{ $lang['2']}}</p>
                        <p class="mt-2">y = {{ $lang['3']}}</p>
                        <p class="mt-2">{{ $lang['4']}} = {{ isset($_POST['original'])?$_POST['original']:'' }}(1-{{ isset($_POST['rate'])?$_POST['rate']:'' }})<sup> {{ isset($_POST['year'])?$_POST['year']:'' }}</sup></p>
                        <p class="mt-2">{{ $lang['4']}} = {{ round($detail['answer'], 2) }}</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>