<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <label for="amount" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="amount" id="amount" class="input" aria-label="input" placeholder="500" value="{{ isset($_POST['amount'])?$_POST['amount']:'500' }}" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="reference" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="reference" id="reference" class="input" aria-label="input" placeholder="1913" value="{{ isset($_POST['reference'])?$_POST['reference']:'1913' }}" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="target" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="target" id="target" class="input" aria-label="input" placeholder="2018" value="{{ isset($_POST['target'])?$_POST['target']:'2018' }}" />
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
                <div class="col-12 bg-light-blue  p-3 radius-10 mt-3">
                    <div class="col-12 text-center font-s-20">
                        <p>{{ $lang[4] }}</p>
                        <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]">{{ $currancy}} {{ $detail['result'] }}</strong></p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>