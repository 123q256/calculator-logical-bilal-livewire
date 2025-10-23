<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4"> 

                <div class="col-12 mt-0 mt-lg-2">
                    <label for="cost" class="label">{{ $lang['1'] }} ({{$currancy}}) :</label>
                    <div class="w-100 py-2"> 
                        <input type="number" step="any" name="cost" id="cost" class="input" aria-label="input"  value="{{ isset($_POST['cost'])?$_POST['cost']:'' }}" />
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="weight" class="label">
                            {{ $lang['3'] }}(lbs):
                    </label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="weight" id="weight" class="input" aria-label="input"  value="{{ isset($_POST['weight'])?$_POST['weight']:'230' }}" />
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
                                
                                <strong class="text-blue">{{$currancy}} {{$detail['GCP']  }} <span class="font-s-18">/ lb</span></strong></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>