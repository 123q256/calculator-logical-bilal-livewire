<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12">
                <label for="item" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="item" id="item" class="input" aria-label="input" placeholder="2000" value="{{ isset($_POST['item'])?$_POST['item']:'2000' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
            </div>
            <div class="col-span-12">
                <label for="sale" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="sale" id="sale" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['sale'])?$_POST['sale']:'50' }}" />
                    <span class="text-blue input-unit">{{ $currancy }}</span>
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
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }} </strong></td>
                                <td class="py-2 border-b"> {{round($detail['answer'], 2) }} %</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-12 text-[18px]">
                        <p class="mt-2"><strong>{{ $lang[4] }}</strong></p>
                        <p class="mt-2">{{ $lang[5] }}.</p>
                        <p class="mt-2">{{ $lang[3] }} = {{ $lang[1] }} / {{ $lang[2] }} x 100</p>
                        <p class="mt-2">{{ $lang[3] }} = {{ isset($_POST['item'])?$_POST['item']:'' }} / {{ isset($_POST['sale'])?$_POST['sale']:'' }} x 100</p>
                        <p class="mt-2">{{ $lang[3] }} = {{ round($detail['answer'], 2) }} %</sup></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>