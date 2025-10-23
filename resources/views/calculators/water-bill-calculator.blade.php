@php
    if (isset($_POST['submit'])) {
        $water = trim($_POST['water']);
        $gallon = trim($_POST['gallon']);
    } elseif (isset($_GET['res_link'])) {
        $water = trim($_GET['water']);
        $gallon = trim($_GET['gallon']);
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="water" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2"> 
                        <input type="number" step="any" name="water" id="water" class="input" aria-label="input"  value="{{ isset($_POST['water'])?$_POST['water']:'100' }}" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="gallon" class="font-s-14 text-blue">
                            {{ $lang['2'] }} ({{$currancy}} /{{ $lang['3'] }}):
                    </label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="gallon" id="gallon" class="input" aria-label="input"  value="{{ isset($_POST['gallon'])?$_POST['gallon']:'25' }}" />
                    </div>
                </div>
            </div>
            @if ($type=='calculator')
                @include('inc.button')
            @endif
            @if ($type=='widget')
                @include('inc.widget-button')
            @endif
       </div>
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
                            <p class="text-[20px]"><strong>{{$lang['4']}}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                         {{$currancy}} {{round($detail['bill'], 3)  }}</strong></p>
                        </div>
                    </div>
                        <div class="w-full">
                            <p class="text-[20px]"><strong>{{ $lang['5'] }}</strong></p>
                            <p class="mt-2">{{ $lang['6'] }}:</p>
                            <p class="mt-2">{{ $lang['4'] }} = {{ $lang['7'] }} * {{ $lang['2'] }} ({{ $lang['8'] }})</p>
                            <p class="mt-2">{{ $lang['4'] }} = <?php echo $water; ?> * <?php echo $gallon; ?></p>
                            <p class="mt-2">{{ $lang['4'] }} = {{ round($detail['bill'], 3) }} {{$currancy}}</p>
                          </div>
                    </div>
                </div>
    
                </div>
            </div>
        </div>
    
    @endisset
</form>