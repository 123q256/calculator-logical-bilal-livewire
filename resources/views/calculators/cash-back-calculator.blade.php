<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <label for="purchase" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="purchase" id="purchase" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['purchase'])?$_POST['purchase']:'413' }}" />
                    <span class="text-blue input-unit">{{$currancy }}</span>
                </div>
            </div>
            <div class="col-span-12">
                <label for="cash" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="cash" id="cash" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['cash'])?$_POST['cash']:'50' }}" />
                    <span class="input_unit">%</span>
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
                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto 6 mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                <td class="py-2 border-b">{{ $currancy}} {{round($detail['answer'], 2)}} </td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                        <p class="mt-2"><strong>{{ $lang[5] }}</strong></p>
                        <p class="mt-2">{{ $lang[6] }} = {{ $lang[7] }} * ({{ $lang[2] }} / 100)</p>
                        <p class="mt-2">{{ $lang[3] }} = {{ isset($_POST['purchase'])?$_POST['purchase']:'' }}  * ({{ isset($_POST['cash'])?$_POST['cash']:'' }} / 100)</p>
                        <p class="mt-2">{{ $lang[3] }} = {{ $currancy }} {{ round($detail['answer'], 2) }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>