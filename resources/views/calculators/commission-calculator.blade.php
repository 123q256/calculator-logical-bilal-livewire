<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">

            <div class="col-span-12">
                <label for="method" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 relative">
                    <select class="input" name="find" id="method">
                        <option value="1"  {{ isset($_POST['find']) && $_POST['find']=='1'?'selected':''}}> {{$lang['2']}}</option>
                        <option value="2"  {{ isset($_POST['find']) && $_POST['find']=='2'?'selected':''}}> {{$lang['3']}}</option>
                    </select>
                </div>
            </div>
            <div class="input-field  col-span-12 m-set" id="g-hide">
                <p class="col med-set">
                <label class="font_size16"><strong>{{ $lang['4']}} : </strong></label>
                </p>
                @if(isset($error))
                    <p class="med-set1 flex justify-between">
                        <label class="g1">
                            <input class="with-gap checking" id="g1" name="select1" type="radio" value="commission"  {{ $_POST['select1'] == 'commission' ? 'checked' : '' }}>
                        <span>{{ $lang['5']}}</span>
                        </label>
                        <label class="g2">
                            <input class="with-gap" id="g2" name="select1" type="radio" value="sale_price" {{ $_POST['select1'] == 'sale_price' ? 'checked' : '' }} >
                            <span>{{ $lang['6']}}</span>
                        </label>
                        <label class="g3">
                            <input class="with-gap" id="g3" name="select1" type="radio" value="commission_rate" {{ $_POST['select1'] == 'commission_rate' ? 'checked' : '' }} >
                            <span>{{ $lang['7'] }}</span>
                        </label>
                    </p>
                @else
                    @isset($detail)
                        <p class="med-set1 flex justify-between">
                            <label class="g1">
                                <input class="with-gap checking" id="g1" name="select1" type="radio" value="commission"  {{ $detail['select1'] == 'commission' ? 'checked' : '' }}>
                            <span>{{ $lang['5']}}</span>
                            </label>
                            <label class="g2">
                                <input class="with-gap" id="g2" name="select1" type="radio" value="sale_price" {{ $detail['select1'] == 'sale_price' ? 'checked' : '' }} >
                                <span>{{ $lang['6']}}</span>
                            </label>
                            <label class="g3">
                                <input class="with-gap" id="g3" name="select1" type="radio" value="commission_rate" {{ $detail['select1'] == 'commission_rate' ? 'checked' : '' }} >
                                <span>{{ $lang['7'] }}</span>
                            </label>
                        </p>
                    @else
                        <p class="med-set1 flex justify-between">
                            <label class="g1">
                                <input class="with-gap checking" id="g1" name="select1" type="radio" value="commission" checked>
                            <span>{{ $lang['5']}}</span>
                            </label>
                            <label class="g2">
                                <input class="with-gap" id="g2" name="select1" type="radio" value="sale_price" >
                                <span>{{ $lang['6']}}</span>
                            </label>
                            <label class="g3">
                                <input class="with-gap" id="g3" name="select1" type="radio" value="commission_rate" >
                                <span>{{ $lang['7'] }}</span>
                            </label>
                        </p>
                    @endisset
                @endif
           </div>
            <div class="col-span-12" id="sp">
                <label for="sale_price" class="label">{{ $lang['6'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="sale_price" id="sale_price" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['sale_price'])?$_POST['sale_price']:'10' }}" />
                </div>
            </div>
            <div class="col-span-12" id="cr">
                <label for="commission_rate" class="label">{{ $lang['7'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="commission_rate" id="commission_rate" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['commission_rate'])?$_POST['commission_rate']:'20' }}" />
                    <span class="text-blue input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 hidden" id="c">
                <label for="commission_amount" class="label">{{ $lang['5'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="commission_amount" id="commission_amount" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['commission_amount'])?$_POST['commission_amount']:'30' }}" />
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
                    @if($detail['calculate']=="1" || $detail['calculate']=="2")
                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto  mt-2">
                       
                        @if($detail['find']=="1")
                        <table class="w-full font-s-18">
                            @if($detail['calculate']=="1")
                                <tr>
                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['5'] }} </strong></td>
                                    <td class="py-2 border-b"> {{$currancy }} {{ round($detail['ans'],3)}}</td>
                                </tr>
                           @endif
                           @if($detail['calculate']=="2")
                                <tr>
                                <td class="py-2 border-b" width="80%"><strong>{{ $lang['8'] }} </strong></td>
                                <td class="py-2 border-b"> {{$currancy }} {{ round($detail['ans'],3)}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['9'] }} </strong></td>
                                    <td class="py-2 border-b"> {{$currancy }} {{ $detail['sale_price']-$detail['ans'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['10'] }} </strong></td>
                                    <td class="py-2 border-b"> {{$currancy }} {{ $detail['sale_price']+$detail['ans'] }}</td>
                                </tr>
                           @endif 
                        </table>
                        @endif
                        @if($detail['find']=="2")
                        <table class="w-full text-[18px]">
                            @if($detail['calculate']=="1" || $detail['calculate']=="2")
                                <tr>
                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['6'] }} </strong></td>
                                    <td class="py-2 border-b"> {{$currancy }} {{ round($detail['ans'],3)}}</td>
                                </tr>
                           @endif
                           @if($detail['calculate']=="2")
                                <tr>
                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['9'] }} </strong></td>
                                    <td class="py-2 border-b"> {{$currancy }} {{ $detail['ans']-$detail['commission_amount']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['10'] }} </strong></td>
                                    <td class="py-2 border-b"> {{$currancy }} {{ $detail['ans']+$detail['commission_amount']}}</td>
                                </tr>
                           @endif 
                        </table>
                        @endif
            
                        @if($detail['find']=="3")
                        <table class="w-full text-[18px]">
                            @if($detail['calculate']=="1")
                                <tr>
                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['7'] }} </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['ans'],2)}} % </td>
                                </tr>
                           @endif
                           @if($detail['calculate']=="2")
                                <tr>
                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['11'] }} </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['ans'],2)}} % </td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['9'] }} </strong></td>
                                    <td class="py-2 border-b"> {{$currancy }} {{ round($detail['sale_price']-$detail['commission_amount'],2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['10'] }} </strong></td>
                                    <td class="py-2 border-b"> {{$currancy }} {{ round($detail['sale_price']+$detail['commission_amount'],2) }}</td>
                                </tr>
                           @endif 
                        </table>
                        @endif
                  </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
  <script>
    @if(isset($detail))
    var dropVals = "{{$detail['select1']}}";

    if(dropVals === 'commission ') {
        document.getElementById("sp").style.display = "block";
        document.getElementById("cr").style.display = "block";
        document.getElementById("c").style.display = "none";
    } else if(dropVals === 'sale_price') {
        document.getElementById("c").style.display = "block";
        document.getElementById("cr").style.display = "block";
        document.getElementById("sp").style.display = "none";
    } else if(dropVals === 'commission_rate') {
        document.getElementById("c").style.display = "block";
        document.getElementById("sp").style.display = "block";
        document.getElementById("cr").style.display = "none";
    }
@endif


@if(isset($error))
var dropVals = "{{$_POST['select1']}}";
if(dropVals === 'commission') {
        document.getElementById("sp").style.display = "block";
        document.getElementById("cr").style.display = "block";
        document.getElementById("c").style.display = "none";
    } else if(dropVals === 'sale_price') {
        document.getElementById("c").style.display = "block";
        document.getElementById("cr").style.display = "block";
        document.getElementById("sp").style.display = "none";
    } else if(dropVals === 'commission_rate') {
        document.getElementById("c").style.display = "block";
        document.getElementById("sp").style.display = "block";
        document.getElementById("cr").style.display = "none";
    }
 @endif


  document.getElementById("g1").addEventListener("click", function() {
    document.getElementById("sp").style.display = "block";
    document.getElementById("cr").style.display = "block";
    document.getElementById("c").style.display = "none";
});

document.getElementById("g2").addEventListener("click", function() {
    document.getElementById("c").style.display = "block";
    document.getElementById("cr").style.display = "block";
    document.getElementById("sp").style.display = "none";
});

document.getElementById("g3").addEventListener("click", function() {
    document.getElementById("c").style.display = "block";
    document.getElementById("sp").style.display = "block";
    document.getElementById("cr").style.display = "none";
});

</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>