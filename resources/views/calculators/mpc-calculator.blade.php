<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12">
                    <label for="income" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="income" id="income" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['income'])?$_POST['income']:'100' }}" />
                        <span class="text-blue input_unit">{{ $currancy}}</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="save" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="save" id="save" class="input" aria-label="input" placeholder="13" value="{{ isset($_POST['save'])?$_POST['save']:'13' }}" />
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
                <div class="col-12 bg-light-blue  p-3 radius-10 mt-3">
                    <div class="col-12 text-center font-s-20">
                        <p>{{ $lang[3] }}</p>
                        <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]">{{ $currancy}} {{ $detail['ans'] }}</strong></p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>