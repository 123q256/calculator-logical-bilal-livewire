@php
    if ( isset( $_POST[ 'submit' ] ) ) {
        $solve = $_POST['solve'];
    } elseif ( isset( $_GET[ 'res_link' ] ) ) {
        $solve = $_GET['solve'];
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">

            <div class="col-12 px-2">
                <label for="solve" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2"> 
                    <select class="input" name="solve" id="solve" >
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang[2],$lang[3],$lang[4]];
                            $val = ['1','2','3'];
                            optionsList($val,$name,isset($_POST['solve'])?$_POST['solve']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-12 px-2 mt-0 mt-lg-2 ">
                <label for="input_f" class="label" id="cc_hp1">
                    @if (isset($_POST['solve']) && $_POST['solve'] == 2)
                        {{$lang[4]}}:
                    @elseif(isset($_POST['solve']) && $_POST['solve'] == 3)
                        {{$lang[3]}}:
                    @else
                        {{ $lang['4'] }}:
                    @endif
                </label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="input_f" id="input_f" class="input" aria-label="input"  value="{{ isset($_POST['input_f'])?$_POST['input_f']:'7' }}" />
                    <span class="input_unit text-blue cr_sign {{isset($_POST['solve']) && $_POST['solve'] == '3' ? 'd-none':'d-block'}}">{{$currancy}}</span>
                </div>
            </div> 
            <div class="col-12 px-2 mt-0 mt-lg-2">
                <label for="input_s" class="label" id="cc_hp2">
                    @if (isset($_POST['solve']) && $_POST['solve'] == 2)
                        {{$lang[2]}}:
                    @elseif(isset($_POST['solve']) && $_POST['solve'] == 3)
                        {{$lang[2]}}:
                    @else
                        {{ $lang['3'] }}:
                    @endif
                </label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="input_s" id="input_s" class="input" aria-label="input"  value="{{ isset($_POST['input_s'])?$_POST['input_s']:'4' }}" />
                    <span class="input_unit text-blue signf {{isset($_POST['solve']) && $_POST['solve'] !== '1' ? 'd-block':'d-none'}}">{{$currancy}}</span>
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
                        <div class="w-full text-center">
                            <p class="text-[]20px">
                                <strong>
                                    @php
                                        if ($solve === "1") {
                                            echo $lang[2];
                                            $money = $currancy;
                                        }else if ($solve === "2") {
                                            echo $lang[3];
                                            $money = '';
                                        }else{
                                            echo $lang[4];
                                            $money = $currancy;
                                        }
                                    @endphp
                                </strong>
                            </p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">

                                <strong class="text-[25px]">{{round($detail['answer'], 4)}}<span class="font-s-20"> {{$money}} </span>
                                </strong></p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
    <script>
        document.getElementById('solve').addEventListener('change',function(){
            var solve_val = this.value;
            var cr_sign = document.querySelector('.cr_sign');
            var signf = document.querySelector('.signf');
            var cc_hp1 = document.getElementById("cc_hp1");
            var cc_hp2 = document.getElementById("cc_hp2");

            if (solve_val === "1") {
                cr_sign.style.display = "block";
                signf.style.display = "none";
                cc_hp1.innerHTML = "{{$lang[4]}}";
                cc_hp2.innerHTML = "{{$lang[3]}}";
            } else if (solve_val === "2") {
                cr_sign.style.display = "block";
                signf.style.display = "block";
                cc_hp1.innerHTML = "{{$lang[4]}}";
                cc_hp2.innerHTML = "{{$lang[2]}}";
            } else {
                cr_sign.style.display = "none";
                signf.style.display = "block";
                cc_hp1.innerHTML = "{{$lang[3]}}";
                cc_hp2.innerHTML = "{{$lang[2]}}";
            }
        });
    </script>
@endpush