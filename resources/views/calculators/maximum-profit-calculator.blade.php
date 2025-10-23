<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <label for="p" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="p" id="p" class="input" aria-label="input" placeholder="12" value="{{ isset($_POST['p'])?$_POST['p']:'413' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12">
                <label for="Q" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="Q" id="Q" class="input" aria-label="input" placeholder="7" value="{{ isset($_POST['Q'])?$_POST['Q']:'50' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12">
                <label for="C" class="label">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="C" id="C" class="input" aria-label="input" placeholder="7" value="{{ isset($_POST['C'])?$_POST['C']:'13' }}" />
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
            <div class="w-full mt-3">
                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                    <table class="w-full text-[18px]">
                        <tr>
                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                            <td class="py-2 border-b">{{ $currancy}} {{round($detail['R'],2)}} </td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] }}</strong></td>
                            <td class="py-2 border-b">{{ $currancy}} {{round($detail['profit'],2)}} </td>
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