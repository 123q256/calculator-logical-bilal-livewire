

<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1    gap-4">
                <div class="space-y-2 relative">
                    <label for="isotopes_no" class="label">{!! $lang['1'] !!}:</label>
                    <select name="isotopes_no" id="isotopes_no" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["2","3","4","5","6","7","8","9","10"];
                            $val = ["2","3","4","5","6","7","8","9","10"];
                            optionsList($val,$name,isset(request()->isotopes_no)?request()->isotopes_no:'2');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1    gap-4">
            <div class="w-full isotopes">
                    <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="per0" class="label">{{ $lang['2'] }} (f<sub>1</sub>):</label>
                            <div class="relative w-full ">
                                <input type="number" name="per[0]" id="per" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['per[0]'])?$_POST['per[0]']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="per_unit0" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('per_unit0_dropdown')">{{ isset(request()->per_unit[0])?request()->per_unit[0]:'%' }} ▾</label>
                                <input type="text" name="per_unit[0]" value="{{ isset(request()->per_unit[0])?request()->per_unit[0]:'%' }}" id="per_unit0" class="hidden">
                                <div id="per_unit0_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="per_unit0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit0', 'decimal')">{!! $lang['3'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit0', '%')">%</p>
                                </div>
                            </div>
                         </div>
                      
                        <div class="space-y-2 ">
                            <label for="mass0" class="label">{!! $lang['4'] !!} (m<sub>1</sub>):</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="mass[0]" id="mass0" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass[0])?request()->mass[0]:'89' }}" />
                                <span class="text-blue input_unit">amu</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="per1" class="label">{{ $lang['5'] }} (f<sub>2</sub>):</label>
                            <div class="relative w-full ">
                                <input type="number" name="per[1]" id="per1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['per[1]'])?$_POST['per[1]']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="per_unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('per_unit1_dropdown')">{{ isset(request()->per_unit[1])?request()->per_unit[1]:'%' }} ▾</label>
                                <input type="text" name="per_unit[1]" value="{{ isset(request()->per_unit[1])?request()->per_unit[1]:'%' }}" id="per_unit1" class="hidden">
                                <div id="per_unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="per_unit1">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit1', 'decimal')">{!! $lang['3'] !!}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit1', '%')">%</p>
                                </div>
                            </div>
                         </div>
                        <div class="space-y-2 ">
                            <label for="mass1" class="label">{!! $lang['6'] !!} (m<sub>2</sub>):</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="mass[1]" id="mass1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mass[1])?request()->mass[1]:'92' }}" />
                                <span class="text-blue input_unit">amu</span>
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


    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="bg-[#F6FAFC] border radius-10 px-3 py-2">
                            <strong>{!! $lang['7'] !!} =</strong>
                            <strong class="text-green font-s-28">{!! $detail['amSum'] !!}</strong>
                            <strong>amu</strong>
                        </div>
                        <div class="col-12">
                            <p class="mt-3"><strong class="font-s-18">{!! $lang['8'] !!}</strong></p>
                            <p class="mt-2">{!! $lang['9'] !!} (f) = @foreach(request()->per as $key => $value) {!! $value.', ' !!} @endforeach</p>
                            <p class="mt-2">{!! $lang['10'] !!} (m) = @foreach(request()->mass as $key => $value) {!! $value.', ' !!} @endforeach</p>
                            <p class="mt-3"><strong class="font-s-18">{!! $lang['11'] !!}</strong></p>
                            @if(request()->per_unit[0] == "decimal")
                                <p class="mt-2">AM = f<sub>1</sub>m<sub>1</sub> + f<sub>2</sub>m<sub>2</sub> + f<sub>3</sub>m<sub>3</sub> ... + f<sub>n</sub>m<sub>n</sub></p>
                                <p class="mt-2">AM =
                                    @for($i = 0; $i < $isotopes_no; $i++)
                                        {!! ($i == 0) ? "(".$per[$i]." x ".$mass[$i].")" : " + (".$per[$i]." x ".$mass[$i].")" !!}
                                    @endfor
                                </p>
                            @else
                                <p class="mt-2"><strong>{!! $lang['13'] !!}: </strong>{!! $lang['12'] !!}</p>
                                <p class="mt-2">AM = (f<sub>1</sub>m<sub>1</sub> + f<sub>2</sub>m<sub>2</sub> + f<sub>3</sub>m<sub>3</sub> ... + f<sub>n</sub>m<sub>n</sub>) / 100</p>
                                <p class="mt-2">AM = [
                                    @for($i = 0; $i < request()->isotopes_no; $i++)
                                        {!! ($i == 0) ? "(".request()->per[$i]." x ".request()->mass[$i].")" : " + (".request()->per[$i]." x ".request()->mass[$i].")" !!}
                                    @endfor
                                    ] / 100
                                </p>
                            @endif
                            <p class="mt-2">AM = <strong>{!! $detail['amSum'] !!}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var isotopesNoElement = document.getElementById('isotopes_no');
                var isotopesContainer = document.querySelector('.isotopes');

                isotopesNoElement.addEventListener('change', function() {
                    isotopesContainer.innerHTML = "";
                    var isotopesNo = parseInt(this.value, 10);

                    for (let i = 0; i < isotopesNo; i++) {
                        let num = i + 1;
                        let append = `
                          <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                                <div class="space-y-2">
                                    <label for="per${num}" class="label">{{ $lang["14"] }} ${num} {{ $lang["15"] }} (f<sub>${num}</sub>):</label>
                                    <div class="relative w-full">
                                        <input type="number" name="per[${i}]" id="per${num}" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="{{ request()->input('per[${i}]', '30') }}" aria-label="input" placeholder="00" oninput="checkInput()">
                                        <label for="per_unit${num}" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('per_unit${num}_dropdown')">{{ request()->input('per_unit${num}', '%') }} ▾</label>
                                        <input type="text" name="per_unit[${i}]" value="{{ request()->input('per_unit${num}', '%') }}" id="per_unit${num}" class="hidden">
                                        <div id="per_unit${num}_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden per_unit${num}" to="per_unit${num}">
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit${num}', 'decimal')">{!! $lang['3'] !!}</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit${num}', '%')">%</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2 ">
                                    <label for="mass${num}" class="label">{{ $lang["16"] }} ${num} {{ $lang["17"] }} (m<sub>${num}</sub>):</label>
                                   <div class="w-full py-2 relative">

                                    <input type="number" step="any" name="mass[${i}]" id="mass${num}" class="input" aria-label="input" placeholder="00" value="{{ request()->input('mass[${i}]', '92') }}">
                                    <span class="text-blue input_unit">amu</span>
                                    </div>
                                </div></div>`;


                        isotopesContainer.insertAdjacentHTML('beforeend', append);
                    }
                });

                @if(isset($detail) || isset($error))
                    isotopesContainer.innerHTML = "";
                    var isotopesNo = parseInt(isotopesNoElement.value, 10);

                    const perValues = @json(request()->per ?? []);
                    const massValues = @json(request()->mass ?? []);
                    const perUnitValues = @json(request()->per_unit ?? []);

                    for (let i = 0; i < isotopesNo; i++) {
                        let num = i + 1;
                        const perValue = perValues[i] ?? '0';
                        const perUnitValue = perUnitValues[i] ?? '%';
                        const massValue = massValues[i] ?? '0';

                        let append = `
                         <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                                <div class="space-y-2">
                                    <label for="per${num}" class="label">{{ $lang["14"] }} ${num} {{ $lang["15"] }} (f<sub>${num}</sub>):</label>
                                    <div class="relative w-full">
                                        <input type="number" name="per[${i}]" id="per${num}" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" value="${perValue}" aria-label="input" placeholder="00" oninput="checkInput()">
                                        <label for="per_unit${num}" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('per_unit${num}_dropdown')">${perUnitValue}  ▾</label>
                                        <input type="text" name="per_unit[${i}]" value="${perUnitValue} " id="per_unit${num}" class="hidden">
                                        <div id="per_unit${num}_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden per_unit${num}" to="per_unit${num}">
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit${num}', 'decimal')">{!! $lang['3'] !!}</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit${num}', '%')">%</p>
                                        </div>
                                    </div>
                                </div>
                            <div class="space-y-2 relative">
                                    <label for="mass${num}" class="label">{{ $lang["16"] }} ${num} {{ $lang["17"] }} (m<sub>${num}</sub>):</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" name="mass[${i}]" id="mass${num}" class="input" aria-label="input" placeholder="00" value="${massValue}">
                                    <span class="text-blue input_unit">amu</span>
                                    </div>
                                </div>
                           </div>`;

                        isotopesContainer.insertAdjacentHTML('beforeend', append);
                    }
                @endif
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>