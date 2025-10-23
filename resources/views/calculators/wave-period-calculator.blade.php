
<style>
    .velocitytab .v_active {
        border-bottom: 3px solid var(--light-blue);
    }
    </style>
<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
           <input type="hidden" name="sim_adv" value="{{ isset(request()->sim_adv) ? request()->sim_adv : 'simple' }}" id="sim_adv">
            <div class="grid grid-cols-1  mt-3  gap-4">
            @if($device == 'desktop')
                <div class="row align-items-center text-end hidden">
                    <div class="col-lg-6 pb-2  mx-auto">
                        <div class="d-flex text-center justify-content-center gap-10 font-s-14 velocitytab border-b-dark position-relative">
                            <p id="tab1" class="col-lg-6 cursor-pointer tab1 v_active p-2 {{ isset($_POST['unit_type']) && $_POST['unit_type'] !== 'Simple' ? ''  : 'v_active' }} "id="initalVelocity"><strong>{{ $lang['1'] }}</strong></p>
                            <p id="tab2"  class="col-lg-6 cursor-pointer tab2  p-2 {{ isset($_POST['unit_type']) && $_POST['unit_type'] == 'advance' ? 'v_active'  : '' }} " ><strong>{{ $lang['2'] }}</strong></p>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-8 pb-2 mx-auto hidden">
                    <div class="d-flex justify-content-around text-center font-s-13 velocitytab border-b-dark  position-relative">
                        <p id="tab1"  class="col-lg-6 cursor-pointer tab1 v_active  p-2 {{ isset($_POST['unit_type']) && $_POST['unit_type'] !== 'Simple' ? ''  : 'v_active' }} "id="initalVelocity"><strong>{{ $lang['1'] }}</strong></p>
                        <p id="tab2"  class="col-lg-6 cursor-pointer tab2  p-2  {{ isset($_POST['unit_type']) && $_POST['unit_type'] == 'advance' ? 'v_active'  : '' }} " ><strong>{{ $lang['2'] }}</strong></p>
        
                    </div>
                </div>
            @endif
                <div class="simple  {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'hidden' :'d-block' }}" id="simple">
                    <div class="row d-flex justify-content-center">
                        {{-- <div class="col-lg-6 col-12 mt-lg-4 mt-2 pe-lg-4"> --}}
                        <div class="col-lg-6 col-12">
                            <label for="frequency" class="font-s-14 text-blue">{{$lang['3']}} (Hz):</label>
                            <div class="w-full py-2">                                  
                                <input type="number" step="any" name="frequency" id="frequency" class="input" aria-label="input"
                                value="{{ isset(request()->frequency) ? request()->frequency : '20' }}"/>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- advance --}}
                <div class="advance  {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'd-block' :'hidden' }}" id="advance">
                    <div class="row d-flex justify-content-cente">
                        <div class="col-lg-6 col-12 mt-lg-4 mt-2 pe-lg-4">
                            <label for="wavelength" class="font-s-14 text-blue">{{$lang['4']}} (m):</label>
                            <div class="w-full py-2">                                  
                                <input type="number" step="any" name="wavelength" id="wavelength" class="input" aria-label="input"
                                value="{{ isset(request()->wavelength) ? request()->wavelength : '15' }}"/>
                            </div>
                        </div> 
                        <div class="col-lg-6 col-12 mt-lg-4 mt-2 pe-lg-4">
                            <label for="wave_speed" class="font-s-14 text-blue">{{$lang['5']}} (m/s):</label>
                            <div class="w-full py-2">                                  
                                <input type="number" step="any" name="wave_speed" id="wave_speed" class="input" aria-label="input"
                                value="{{ isset(request()->wave_speed) ? request()->wave_speed : '50' }}"/>
                            </div>
                        </div> 
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



    @if(isset($detail))
    
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="row my-2">
                        @if($detail['sim_adv'] == 'simple')
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                <table class="w-full">
                                    <tr class="col">
                                        <td class="border-b py-2"><strong>{{$lang['wave']}} :</strong></td>
                                        <td class="border-b py-2"> {{$detail['wavePeriod']}} {{$lang['sec']}}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['sim_adv'] == 'advance')
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                <table class="w-full">
                                    <tr>
                                        <td width="60%" class="border-b py-2"><strong>{{$lang['wave']}} :</strong></td> 
                                        <td class="border-b py-2">{{$detail['wave_period']}} {{$lang['sec']}}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
    @push('calculatorJS')
        <script>
           
           document.addEventListener("DOMContentLoaded", function() {
       document.querySelectorAll('.tab1').forEach(function(element) {
           element.addEventListener('click', function() {
               this.classList.add('v_active')
               document.querySelectorAll('.tab2').forEach(function(metricElement) {
                   metricElement.classList.remove('v_active')
               })
               document.getElementById('sim_adv').value = "simple"
               var simple = document.getElementById('simple');
               var advance = document.getElementById('advance');

               if (simple && advance) {
                   simple.classList.remove('hidden');
                   advance.classList.add('hidden');
               }
           })
       })
       document.querySelectorAll('.tab2').forEach(function(element) {
           element.addEventListener('click', function() {
               this.classList.add('v_active')
               document.querySelectorAll('.tab1').forEach(function(imperialElement) {
                   imperialElement.classList.remove('v_active')
               })

               document.getElementById('sim_adv').value = "advance"
               var simple = document.getElementById('simple');
               var advance = document.getElementById('advance');
             

               if (simple && advance) {
                   simple.classList.add('hidden');
                   advance.classList.remove('hidden');
               }
           })
       })
   });

   @if (isset($error))
   var type = "{{ $_POST['sim_adv'] }}";
       if (type == "simple") {
        document.querySelectorAll('.tab2').forEach(function(metricElement) {
               metricElement.classList.remove('v_active')
           })
           document.getElementById('sim_adv').value = "simple"
           var simple = document.getElementById('simple');
           var advance = document.getElementById('advance');

           if (simple && advance) {
               simple.classList.remove('hidden');
               advance.classList.add('hidden');
           }

       } else {
        document.querySelectorAll('.tab1').forEach(function(imperialElement) {
               imperialElement.classList.remove('v_active')
           })
           document.getElementById('sim_adv').value = "advance"
           var simple = document.getElementById('simple');
           var advance = document.getElementById('advance');
           var v_actives = document.getElementById('tab2');
           if (simple && advance) {
               simple.classList.add('hidden');
               v_actives.classList.add('v_active');
               advance.classList.remove('hidden');
           }
       }
   @endif

   @if (isset($detail))
       var type = "{{ $_POST['sim_adv'] }}";
       if (type == "simple") {
        document.querySelectorAll('.tab2').forEach(function(metricElement) {
               metricElement.classList.remove('v_active')
           })
           document.getElementById('sim_adv').value = "simple"
           var simple = document.getElementById('simple');
           var advance = document.getElementById('advance');

           if (simple && advance) {
               simple.classList.remove('hidden');
               advance.classList.add('hidden');
           }

       } else {
        document.querySelectorAll('.tab1').forEach(function(imperialElement) {
               imperialElement.classList.remove('v_active')
           })
           document.getElementById('sim_adv').value = "advance"
           var simple = document.getElementById('simple');
           var advance = document.getElementById('advance');
           var v_actives = document.getElementById('tab2');
           if (simple && advance) {
               simple.classList.add('hidden');
               v_actives.classList.add('v_active');
               advance.classList.remove('hidden');
           }
       }
   @endif

       
        </script>
    @endpush
</form>

