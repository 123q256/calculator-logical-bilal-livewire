@php
    if (isset($_POST['submit'])) {
        $hits = trim($_POST['hits']);
        $bases = trim($_POST['bases']);
        $pitch = trim($_POST['pitch']);
        $bats = trim($_POST['bats']);
        $flies = trim($_POST['flies']);
    } elseif (isset($_GET['res_link'])) {
        $hits = trim($_GET['hits']);
        $bases = trim($_GET['bases']);
        $pitch = trim($_GET['pitch']);
        $bats = trim($_GET['bats']);
        $flies = trim($_GET['flies']);
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="hits" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2"> 
                    <input type="number" step="any" name="hits" id="hits" class="input" aria-label="input"  value="{{ isset($_POST['hits'])?$_POST['hits']:'7' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="bases" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="bases" id="bases" class="input" aria-label="input" value="{{ isset($_POST['bases'])?$_POST['bases']:'5' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="pitch" class="label">{{ $lang['3'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="pitch" id="pitch" class="input" aria-label="input" value="{{ isset($_POST['pitch'])?$_POST['pitch']:'5' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="bats" class="label">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="bats" id="bats" class="input" aria-label="input" value="{{ isset($_POST['bats'])?$_POST['bats']:'3' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="flies" class="label">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="flies" id="flies" class="input" aria-label="input" value="{{ isset($_POST['flies'])?$_POST['flies']:'2' }}" />
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
                        <div class="w-full my-2">
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['6']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">{{ round($detail['answer'], 4) }}</strong></p>
                            </div>
                        </div>
                            <div class="">
                                <p class="text-[20px]"><strong>{{$lang['7'] }}</strong></p>
                                <p class="mt-2">{{ $lang['8'] }}.</p>
                                <p class="mt-2">OBP = (H + BB + HBP) / (AB + BB + HBP + SF)</p>
                                <p class="mt-2">{{ $lang['9'] }}</p>
                                <p class="mt-2">{{ $lang['10'] }}</p>
                                <p class="mt-2">{{ $lang['11'] }}</p>
                                <p class="mt-2">{{ $lang['12'] }}</p>
                                <p class="mt-2">{{ $lang['13'] }}</p>
                                <p class="mt-2">{{ $lang['14'] }}</p>
                                <p class="mt-2">OBP = ({{ $hits}} + {{ $bases}} + {{ $pitch}}) / ( {{ $bats}} +  {{ $bases}} +  {{ $pitch}} +  {{ $flies}})</p>
                                <p class="mt-2">OTD = {{ round($detail['answer'], 4) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>