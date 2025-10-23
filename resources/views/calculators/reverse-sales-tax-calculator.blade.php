<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="final" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="final" id="final" class="input" aria-label="input" placeholder="8" value="{{ isset($_POST['final'])?$_POST['final']:'8' }}" />
                        <span class="text-blue input_unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="sale" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="sale" id="sale" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['sale'])?$_POST['sale']:'4' }}" />
                        <span class="text-blue input_unit">%</span>
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
                    <div class="w-full md:w-[60%] lg:w-[60%] 5 mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong> {{ $lang[3] }} </strong></td>
                                <td class="py-2 border-b"> {{$currancy}} {{ round($detail['reverse'], 4) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 font-s-16">
                        <p class="mt-2"><strong>{{ $lang[4] }}</strong></p>
                        <p class="mt-2">{{ $lang[5] }}.</p>
                        <p class="mt-2">{{ $lang[3] }} = {{ $lang[1] }} / (1 + ({{ $lang[2] }}/100))</p>
                        <p class="mt-2">{{ $lang[3] }} = {{ isset($_POST['final'])?$_POST['final']:'' }} / (1 + ({{ isset($_POST['sale'])?$_POST['sale']:'4' }}/100))</p>
                        <p class="mt-2">{{ $lang[3] }}  = {{ $currancy }} {{ round($detail['reverse'], 4) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>