@php
    if ( isset( $_POST[ 'submit' ] ) ) {
        $f_input = $_POST['f_input'];
        $s_input = $_POST['s_input'];
    } elseif ( isset( $_GET[ 'res_link' ] ) ) {
        $f_input = $_GET['f_input'];
        $s_input = $_GET['s_input'];
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1 mt-3  gap-4">

            <div class="col-12 mt-0 mt-lg-2">
                <label for="f_input" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative"> 
                    <input type="number" step="any" name="f_input" id="f_input" class="input" aria-label="input"  value="{{ isset($_POST['f_input'])?$_POST['f_input']:'7' }}" />
                </div>
            </div>
            <div class="col-12 mt-0 mt-lg-2">
                <label for="s_input" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="s_input" id="s_input" class="input" aria-label="input" value="{{ isset($_POST['s_input'])?$_POST['s_input']:'5' }}" />
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
                <div class="col-12 bg-light-blue  p-3 radius-10 mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['6']}}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                                
                                <strong class="text-blue">{{ $detail['answer']  }}</strong></p>
                        </div>
                    </div>
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{ $lang[3] }}</strong></p>
                            <p class="mt-2">{{ $lang[1] }} = {{ $f_input }}</p>
                            <p class="mt-2">{{ $lang[2] }} = {{ $s_input }}</p>
                            <p class="text-[20px] my-3"><strong>{{ $lang[4] }}</strong></p>
                            <p>{{ $lang[5] }} = {{ $lang[1] }} * {{ $lang[2] }}</p>
                            <p class="mt-2">{{ $lang[6] }} = {{ $f_input }} * {{ $s_input }}</p>
                            <p class="mt-2">{{ $lang[6] }} = {{ round($detail['answer']) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    @endisset
</form>