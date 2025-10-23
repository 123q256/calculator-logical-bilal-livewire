<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="want" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="want" id="want">
                        <option value="1" {{ isset($_POST['want']) && $_POST['want']=='1'?'selected':'' }}>{{$lang['2']}}</option>
                        <option value="2" {{ isset($_POST['want']) && $_POST['want']=='2'?'selected':'' }}>{{$lang['3']}} (%)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="x" class="font-s-14 text-blue" id="changeText">
                    {{ isset($_POST['want']) && $_POST['want']=='2' ? "Doubling Time:" : "$lang[3] (%):" }}
                </label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x" id="x" class="input" value="{{ isset($_POST['x'])?$_POST['x']:'5' }}" aria-label="input"/>
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
                        <div class="w-full text-center text-[20px]">
                            <p>
                                @if ($_POST['want'] === "1")
                                    {{$lang['2']}}
                                @else
                                    {{$lang['3']}}
                                @endif
                            </p>
                            <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">{{round($detail['ans'],5)}} @if($_POST['want'] === "2") (%)@endif</strong></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('want').addEventListener('change', function() {
                if(this.value === "1"){
                    document.getElementById('changeText').textContent = '{{$lang[3]}} (%):';
                }else{
                    document.getElementById('changeText').textContent = 'Doubling Time:';
                }
            });
        </script>
    @endpush
</form>