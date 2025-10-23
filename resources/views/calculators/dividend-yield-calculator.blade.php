<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf



    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                <div class="space-y-2 relative">
                    <label for="first" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['first'])?$_POST['first']:'15' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
                </div>
                <div class="space-y-2">
                    <label for="operations" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <select name="operations" id="operations" class="input">
                        <option selected value="1" {{ isset($_POST['operations']) && $_POST['operations']=='1'?'selected':''}}>{{ $lang['3']}}</option>
                        <option value="2" {{ isset($_POST['operations']) && $_POST['operations']=='2'?'selected':''}}>{{ $lang['4'] }}</option>
                        <option value="3" {{ isset($_POST['operations']) && $_POST['operations']=='3'?'selected':''}}>{{ $lang['5'] }}</option>
                        <option value="4" {{ isset($_POST['operations']) && $_POST['operations']=='4'?'selected':''}}>{{ $lang['6'] }}</option>
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="second" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                    <input type="number" step="any" name="second" id="second" class="input" aria-label="input" placeholder="10" value="{{ isset($_POST['second'])?$_POST['second']:'160' }}" />
                    <span class="text-blue input_unit">{{ $currancy}}</span>
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
                            <tr>
                                <td class="py-2 border-b w-4/5"><strong>{{ $lang['8'] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy }} {{ round($detail['annual_div'], 2) }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-4/5"><strong>{{ $lang['9'] }} </strong></td>
                                <td class="py-2 border-b">{{ round($detail['dividend_yield'], 2) }} %</td>
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