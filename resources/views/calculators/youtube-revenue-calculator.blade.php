<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="video" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="video" id="video" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['video'])?$_POST['video']:'500000' }}" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="average" class="font-s-12 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="average" id="average" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['average'])?$_POST['average']:'50' }}" />
                        <span class="text-blue input_unit"><?= $currancy ?></span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="click" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="click" id="click" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['click'])?$_POST['click']:'50' }}" />
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
                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                    <table class="w-full text-[18px]">
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['4'] }} </strong></td>
                            <td class="py-2 border-b">{{ $detail['averageClicks'] }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong> {{ $lang['5'] }} </strong></td>
                            <td class="py-2 border-b"> {{ $currancy}} {{ abs($detail['averageRevenue']) }}</td>
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