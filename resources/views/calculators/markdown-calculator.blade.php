<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="osp" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="osp" id="osp" class="input" aria-label="input" placeholder="12" value="{{ isset($_POST['osp'])?$_POST['osp']:'12' }}" />
                        <span class="text-blue input_unit">{{$currancy }}</span>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="asp" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="asp" id="asp" class="input" aria-label="input" placeholder="11" value="{{ isset($_POST['asp'])?$_POST['asp']:'1' }}" />
                        <span class="text-blue input_unit">{{$currancy }}</span>
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
                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2">
                        <table class="w-100 text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }} </strong></td>
                                <td class="py-2 border-b"> {{$currancy }} {{ $detail['markdown'] }} </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }} </strong></td>
                                <td class="py-2 border-b"> {{ $detail['markdown_percent'] }} %</td>
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