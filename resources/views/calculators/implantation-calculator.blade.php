<style> 
    .clr_0 th, .clr_0 td{
        color: #dac600
    }
    .clr_1 th, .clr_1 td{
        color: #c0627a
    }
    .clr_2 th, .clr_2 td{
        color: #62d616
    }
    .clr_3 th, .clr_3 td{
        color: #328210
    }
    .clr_4 th, .clr_4 td{
        color: #292828
    }
    .bg-gradient{
        background: #2845F5 !important;
        color: #ffffff;
     
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6 pe-lg-4">
                <label for="know" class="label">Do you know your ovulation date?:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="know" id="know" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["Yes","No"];
                            $val = ["yes","no"];
                            optionsList($val,$name,isset($_POST['know'])?$_POST['know']:'yes');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 ovd">
                <label for="ovd" class="label">Ovulation Date:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="date" name="ovd" id="ovd" class="input" aria-label="input" value="" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden lp">
                <label for="lp" class="label">Your Last Period:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="date" name="lp" id="lp" class="input" aria-label="input" value="" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 pe-lg-4 hidden mcl">
                <label for="mcl" class="label">Menstrual Cycle Length:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="mcl" id="mcl" class="input">
                        @php
                            $name = ["21","22","23","24","25","26","27","28","29","30","31","32","33","34","35"];
                            $val = ["21","22","23","24","25","26","27","28","29","30","31","32","33","34","35"];
                            optionsList($val,$name,isset($_POST['mcl'])?$_POST['mcl']:'28');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 ">
                <p class="font-s-20 ps-2"><strong class="text-blue">Fertility Treatment</strong></p>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 ivf">
                <label for="ivf" class="label">IVF Transfer Day (Optional):</label>
                <div class="w-100 py-2 position-relative">
                    <input type="date" name="ivf" id="ivf" class="input" aria-label="input" value="" />
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
                        <div class="w-full mt-2">
                            <div class="w-full overflow-auto my-4">
                                {!! $detail['table'] !!}
                                <table class="col-12" cellspacing="0">
                                    <tr class="bg-[#2845F5] ">
                                    </tr>
                                </table>
                            </div>
                            @if(isset($detail['ivf']))
                                <p class="text-center text-[18px]"><strong>According to IVF Transfer Date</strong></p>
                                <p class="text-center text-[18px]"><strong class="text-blue-700">Implantation Date</strong></p>
                                <p class="text-center text-[28px]"><strong class="text-green-700">{{ $detail['ivf'] }}</strong></p>
                            @endif
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            let val = "{{ request()->know }}";
            if (val === "yes") {
                document.querySelectorAll('.ovd').forEach(function(elem) {
                    elem.style.display = 'block';
                });
                document.querySelectorAll('.lp, .mcl').forEach(function(elem) {
                    elem.style.display = 'none';
                });
            } else if (val === "no") {
                document.querySelectorAll('.lp, .mcl').forEach(function(elem) {
                    elem.style.display = 'block';
                });
                document.querySelectorAll('.ovd').forEach(function(elem) {
                    elem.style.display = 'none';
                });
            }
            document.getElementById("ovd").defaultValue = "2021-06-01";
            document.getElementById("lp").defaultValue = "2021-05-18";

            document.getElementById('know').addEventListener('change', function() {
                let val = this.value;
                if (val === "yes") {
                    document.querySelectorAll('.ovd').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelectorAll('.lp, .mcl').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                } else if (val === "no") {
                    document.querySelectorAll('.lp, .mcl').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelectorAll('.ovd').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                }
            });
        </script>
    @endpush
</form>