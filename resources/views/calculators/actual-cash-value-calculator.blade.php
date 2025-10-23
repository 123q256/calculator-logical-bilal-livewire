<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="price" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="price" id="price" class="input" aria-label="input" placeholder="35" value="{{ isset($_POST['price'])?$_POST['price']:'35' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="expected" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="expected" id="expected" class="input" aria-label="input" placeholder="7" value="{{ isset($_POST['expected'])?$_POST['expected']:'7' }}" />
                        <span class="text-blue input_unit">yrs</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="current" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="current" id="current" class="input" aria-label="input" placeholder="5" value="{{ isset($_POST['current'])?$_POST['current']:'5' }}" />
                        <span class="text-blue input_unit">yrs</span>
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
                    <div class="col-12 text-center">
                        <p>{{ $lang[4] }}</p>
                        <p class="my-3"><strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]">{{ $currancy}}  {{ round($detail['acv'], 2) }}</strong></p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>