<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12">
                <label for="solve_change" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="Solve_unit" id="solve_change" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'],$lang['3'],$lang['4']];
                            $val = ['Joules','Volts','Coulombs'];
                            optionsList($val,$name,isset($_POST['Solve_unit'])?$_POST['Solve_unit']:'Joules');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12" id="volte">
                <label for="volts" class="font-s-14 text-blue"><?= $lang[5] ?>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="volts" id="volts" class="input" value="{{ isset($_POST['volts'])?$_POST['volts']:'5' }}" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-12" id="coulomb">
                <label for="coulombs" class="font-s-14 text-blue"><?= $lang[6] ?>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="coulombs" id="coulombs" class="input" value="{{ isset($_POST['coulombs'])?$_POST['coulombs']:'12' }}" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-12 hidden" id="joule">
                <label for="joules" class="font-s-14 text-blue"><?= $lang[7] ?>:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="joules" id="joules" class="input" value="{{ isset($_POST['joules'])?$_POST['joules']:'15' }}" aria-label="input" placeholder="00" />
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
                    @php
                        $request = request();
                        $volts = trim($request->volts);
                        $coulombs = trim($request->coulombs);
                        $joules = trim($request->joules);
                        $Solve_unit = trim($request->Solve_unit);
                    @endphp 
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[18px]"><strong>{{$Solve_unit}}</strong></p>
                            <div class="flex justify-center">
                            <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-white">{{ round($detail['answer'], 7) }}</strong>
                            </p>
                        </div>
                    </div>
                        @if($Solve_unit == "Joules")
                            <p class="col-12 mt-3 text=[18px]"><strong>{{ $lang[8] }}</strong></p>
                            <p class="col-12 mt-2">{{ $lang[9] }}</p>
                            <p class="col-12 mt-2"> {{ $lang[10] }}.</p>
                            <p class="col-12 mt-2">{{ $lang[7] }}={{ $lang[5] }} ∗ {{ $lang[6] }}</p>
                            <p class="col-12 mt-2">{{ $lang[7] }}={{ $volts; }} ∗ {{ $coulombs; }}</p>
                            <p class="col-12 mt-2">{{ $lang[7] }}={{ round($detail['answer'], 7) }}</p>
                        @elseif($Solve_unit == "Volts")
                            <p class="col-12 mt-3 text=[18px]"><strong>{{ $lang[8] }}</strong></p>
                            <p class="col-12 mt-2">{{ $lang[11] }}</p>
                            <p class="col-12 mt-2">{{ $lang[12] }}.</p>
                            <p class="col-12 mt-2">{{ $lang[5] }}= {{ $lang[7] }} / {{ $lang[6] }}</p>
                            <p class="col-12 mt-2">{{ $lang[5] }}={{ $joules; }} / {{ $coulombs; }}</p>
                            <p class="col-12 mt-2">{{ $lang[5] }}={{ round($detail['answer'], 7) }}</p>
                        @elseif($Solve_unit == "Coulombs")
                            <p class="col-12 mt-3 text=[18px]"><strong>{{ $lang[8] }}</strong></p>
                            <p class="col-12 mt-2">{{ $lang[13] }}</p>
                            <p class="col-12 mt-2">{{ $lang[14] }}.</p>
                            <p class="col-12 mt-2">{{ $lang[6] }}= {{ $lang[7] }} / {{ $lang[5] }}</p>
                            <p class="col-12 mt-2">{{ $lang[6] }}={{ $joules; }} / {{ $volts; }}</p>
                            <p class="col-12 mt-2">{{ $lang[6] }}={{ round($detail['answer'], 7) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var solveChange = document.getElementById('solve_change');
            var volte = document.getElementById('volte');
            var joule = document.getElementById('joule');
            var coulomb = document.getElementById('coulomb');

            function checkSolveChangeValue(value) {
                if (value === 'Volts') {
                    volte.style.display = 'none';
                    joule.style.display = 'block';
                    coulomb.style.display = 'block';
                } else if (value === 'Coulombs') {
                    coulomb.style.display = 'none';
                    joule.style.display = 'block';
                    volte.style.display = 'block';
                } else {
                    volte.style.display = 'block';
                    coulomb.style.display = 'block';
                    joule.style.display = 'none';
                }
            }

            checkSolveChangeValue(solveChange.value);

            solveChange.addEventListener('change', function() {
                checkSolveChangeValue(solveChange.value);
            });
        });

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>