@php
    if ( isset( $_POST[ 'submit' ] ) ) {
        $bill_amount = $_POST['bill_amount'];
        $split = $_POST['split'];
    } elseif ( isset( $_GET[ 'res_link' ] ) ) {
        $bill_amount = $_GET['bill_amount'];
        $split = $_GET['split'];
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1   mt-3  gap-4">
            <div class="col-12 mt-0 mt-lg-2">
                <label for="bill_amount" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 relative"> 
                    <input type="number" step="any" name="bill_amount" id="bill_amount" class="input" aria-label="input"  value="{{ isset($_POST['bill_amount'])?$_POST['bill_amount']:'7' }}" />
                    <span class="input_unit text-blue">{{$currancy}}</span>
                </div>
            </div>
            <div class="col-12 mt-0 mt-lg-2">
                <label for="split" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="split" id="split" class="input" aria-label="input" value="{{ isset($_POST['split'])?$_POST['split']:'5' }}" />
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
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['3']}}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                                <strong class="text-blue">{{$currancy}} {{ round($detail['answer'], 7) }}</strong></p>
                        </div>
                    </div>
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{ $lang[4] }}</strong></p>
                            <p class="mt-2">{{ $lang[5] }}.</p>
                            <p class="mt-2">{{ $lang[3] }} = {{ $lang[1] }}({{ $currancy }})/{{ $lang[2] }}</p>
                            <p class="mt-2">{{ $lang[3] }} = {{ $bill_amount }} ({{ $currancy }})/ {{$split }}</p>
                            <p class="mt-2">{{ $lang[3] }} = {{ $detail['answer'] }}{{ $currancy }}</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>