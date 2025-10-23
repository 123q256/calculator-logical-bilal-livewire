<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-6">
                <label for="initial_re" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="initial_re" id="initial_re" class="input" aria-label="input" placeholder="11" value="{{ isset($_POST['initial_re'])?$_POST['initial_re']:'11' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="initial_qu" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="initial_qu" id="initial_qu" class="input" aria-label="input" placeholder="9" value="{{ isset($_POST['initial_qu'])?$_POST['initial_qu']:'9' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="final_re" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="final_re" id="final_re" class="input" aria-label="input" placeholder="7" value="{{ isset($_POST['final_re'])?$_POST['final_re']:'7' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="final_qu" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="final_qu" id="final_qu" class="input" aria-label="input" placeholder="3" value="{{ isset($_POST['final_qu'])?$_POST['final_qu']:'3' }}" />
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
                    <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] }}</strong></td>
                                <td class="py-2 border-b">{{ $currancy}} {{round($detail['marginal_rev'], 3)}} </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] }}</strong></td>
                                <td class="py-2 border-b">{{ $currancy}} {{round($detail['total_rev'], 3)}} </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }}</strong></td>
                                <td class="py-2 border-b">{{round($detail['quantity'], 3)}} </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>