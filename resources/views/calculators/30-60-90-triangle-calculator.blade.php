<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php $request = request(); @endphp
            <div class="col-span-6">
                <div class="col-span-12">
                    <label for="sides" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                    <div class="w-100 py-2">
                        <select name="sides" class="input" id="sides" aria-label="select" onchange="text_change(this)">
                            <option value="a">{{$lang[3]." (a)"}}</option>
                            <option value="b" {{ isset($_POST['sides']) && $_POST['sides']=='b'?'selected':'' }}>{{$lang[3]." (b)"}}</option>
                            <option value="c" {{ isset($_POST['sides']) && $_POST['sides']=='c'?'selected':'' }}>{{$lang[17]." (c)"}}</option>
                            <option value="h" {{ isset($_POST['sides']) && $_POST['sides']=='h'?'selected':'' }}>{{$lang[4]." (h)"}}</option>
                            <option value="A" {{ isset($_POST['sides']) && $_POST['sides']=='A'?'selected':'' }}>{{$lang[5]." (A)"}}</option>
                            <option value="p" {{ isset($_POST['sides']) && $_POST['sides']=='p'?'selected':'' }}>{{$lang[6]." (p)"}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                     <label for="input" class="font-s-14 text-blue" id="changeText">
                            @if(isset($_POST['sides']) && $_POST['sides'] === "b")
                                Enter leg (b)
                            @elseif(isset($_POST['sides']) && $_POST['sides'] === "c")
                                Enter Hypotenuse (c)
                            @elseif(isset($_POST['sides']) && $_POST['sides'] === "h")
                                Enter Height (h)
                            @elseif(isset($_POST['sides']) && $_POST['sides'] === "A")
                                Enter Area (A)
                            @elseif(isset($_POST['sides']) && $_POST['sides'] === "p")
                                Enter Perimeter (p)
                            @else
                                Enter leg (a)
                            @endif
                     </label>
                     <div class="relative w-full mt-[7px]">
                        <input type="number" name="input" id="input" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['input']) ? $_POST['input'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <div class="linear_unit {{ isset($request->sides) && $request->sides === 'A' ? 'd-none' : '' }}">

                            <label for="linear_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('linear_unit_dropdown')">{{ isset($_POST['linear_unit'])?$_POST['linear_unit']:'cm' }} ▾</label>
                            <input type="text" name="linear_unit" value="{{ isset($_POST['linear_unit'])?$_POST['linear_unit']:'cm' }}" id="linear_unit" class="hidden">
                            <div id="linear_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="linear_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'mm')">millimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'km')">kilometers (km)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'ft')">feets (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'yd')">yards (yd)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'mi')">miles (mi)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('linear_unit', 'nmi')">nautical miles (nmi)</p>
                            </div>
                        </div>
                        <div class="square_unit {{ isset($request->sides) && $request->sides === 'A' ? '' : 'd-none' }}">
                            <label for="square_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('square_unit_dropdown')">{{ isset($_POST['square_unit'])?$_POST['square_unit']:'cm²' }} ▾</label>
                            <input type="text" name="square_unit" value="{{ isset($_POST['square_unit'])?$_POST['square_unit']:'cm²' }}" id="square_unit" class="hidden">
                            <div id="square_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="square_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_unit', 'mm²')">square millimeters (mm²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_unit', 'cm²')">square centimeters (cm²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_unit', 'm²')">square meters (m²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_unit', 'km²')">square kilometers (km²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_unit', 'in²')">square inches (in²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_unit', 'ft²')">square feets (ft²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_unit', 'yd²')">square yards (yd²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_unit', 'mi²')">square miles (mi²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_unit', 'nmi²')">square nautical miles (nmi²)</p>

                        </div>
                     </div>
                </div>
            </div>
            </div>
            <div class="col-span-6 my-auto">
                <div class="col-12 text-center mt-3">
                    <img src="{{asset('images/qsqs.png')}}" height="100%" width="80%" alt="30 60 90 Triangle Image" loading="lazy" decoding="async">
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    @if($detail['method'] != "1")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }} (a)</strong></td>
                                            <td class="py-2 border-b">{{$detail['a']}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['method'] != "2")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['3']}} (b)</strong></td>
                                            <td class="py-2 border-b">{{$detail['b']}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['method'] != "3")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['17']}} (c)</strong></td>
                                            <td class="py-2 border-b">{{$detail['c']}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['method'] != "4")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}} (h)</strong></td>
                                            <td class="py-2 border-b">{{$detail['height']}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['method'] != "5")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['5']}} (A)</strong></td>
                                            <td class="py-2 border-b">{{$detail['aa']}} cm²</td>
                                        </tr>
                                    @endif
                                    @if($detail['method'] != "6")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}} (p)</strong></td>
                                            <td class="py-2 border-b">{{$detail['peri']}} cm</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}} (r)</strong></td>
                                        <td class="py-2 border-b">{{$detail['in_radius']}} cm</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}} (R)</strong></td>
                                        <td class="py-2 border-b">{{$detail['radius']}} cm</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{ $lang['10'] }}:</strong></p>
                                @if($detail['method'] == "1")
                                    <p class="mt-2">{{ $lang['11'] }} b:</p>
                                    <p class="mt-2">\( b=a*\sqrt(3) \)</p>
                                    <p class="mt-2">\( b={{ $detail['a']; }}*{{sqrt(3); }} \)</p>
                                    <p class="mt-2">\( b={{ $detail['b']; }} \)</p>
                                @elseif($detail['method'] == "2")
                                    <p class="mt-2">{{ $lang['11'] }} a:</p>
                                    <p class="mt-2">\( a=\dfrac{b}{\sqrt{3}} \)</p>
                                    <p class="mt-2">\( a=\dfrac{{{$detail['b'] }}}{{{sqrt(3) }}} \)</p>
                                    <p class="mt-2">\( a={{ $detail['a']; }} \)</p>
                                @elseif($detail['method'] == "3")
                                    <p class="mt-2">{{ $lang['11'] }} a:</p>
                                    <p class="mt-2">\( a=\dfrac{c}{2} \)</p>
                                    <p class="mt-2">\( a=\dfrac{{{$detail['c'] }}}{2} \)</p>
                                    <p class="mt-2">\( a={{$detail['a']; }} \)</p>
                                    <p class="mt-2">{{ $lang['11'] }} b:</p>
                                    <p class="mt-2">\( b=a*\sqrt(3) \)</p>
                                    <p class="mt-2">\( b={{$detail['a'] }}*{{sqrt(3) }} \)</p>
                                    <p class="mt-2">\( b={{$detail['b']; }} \)</p>
                                @elseif($detail['method'] == "4")
                                    <p class="mt-2">{{ $lang['11'] }} b:</p>
                                    <p class="mt-2">\( b=h*2 \)</p>
                                    <p class="mt-2">\( b={{$detail['height'] }}*2 \)</p>
                                    <p class="mt-2">\( b={{$detail['b'] }} \)</p>
                                    <p class="mt-2">{{ $lang['11'] }} a:</p>
                                    <p class="mt-2">\( a=\dfrac{b}{\sqrt{3}} \)</p>
                                    <p class="mt-2">\( a=\dfrac{{{$detail['b'] }}}{{{sqrt(3); }}} \)</p>
                                    <p class="mt-2">\( a={{$detail['a']; }} \)</p>
                                @elseif($detail['method'] == "5")
                                    <p class="mt-2">{{ $lang['11'] }} a:</p>
                                    <p class="mt-2">\( a=\sqrt{2*area/\sqrt{3}} \)</p>
                                    <p class="mt-2">\( a=\sqrt{2*{{$detail['aa'] }}/{{sqrt(3); }}} \)</p>
                                    <p class="mt-2">\( a={{$detail['a']; }} \)</p>
                                    <p class="mt-2">{{ $lang['11'] }} b:</p>
                                    <p class="mt-2">\( b=a*\sqrt(3) \)</p>
                                    <p class="mt-2">\( b={{$detail['a'] }}*{{sqrt(3); }} \)</p>
                                    <p class="mt-2">\( b={{$detail['b']; }} \)</p>
                                @elseif($detail['method'] == "6")
                                    <p class="mt-2">{{ $lang['11'] }} a:</p>
                                    <p class="mt-2">\( a=\dfrac{perimeter}{3+\sqrt(3)} \)</p>
                                    <p class="mt-2">\( a=\dfrac{{{$detail['peri'] }}}{3+{{sqrt(3); }}} \)</p>
                                    <p class="mt-2">\( a={{$detail['a']; }} \)</p>
                                    <p class="mt-2">{{ $lang['11'] }} b:</p>
                                    <p class="mt-2">\( b=a*\sqrt(3) \)</p>
                                    <p class="mt-2">\( b={{$detail['a'] }}*{{sqrt(3); }} \)</p>
                                    <p class="mt-2">\( b={{$detail['b']; }} \)</p>
                                @endif
                                <p class="mt-2">{{ $lang['11'] }} c:</p>
                                <p class="mt-2">\( c=2a \)</p>
                                <p class="mt-2">\( c=2*{{ $detail['a'] }} \)</p>
                                <p class="mt-2">\( c={{ $detail['c']; }} \)</p>
                                <p class="mt-2">{{ $lang['12'] }} (h):</p>
                                <p class="mt-2">\( h=\dfrac{a*b}{c} \)</p>
                                <p class="mt-2">\( h=\dfrac{ {{ $detail['a'] }}*{{ $detail['b'] }}}{{{ $detail['c'] }}} \)</p>
                                <p class="mt-2">\( h=\dfrac{{{ $detail['a'] * $detail['b'] }}}{{{ $detail['c'] }}} \)</p>
                                <p class="mt-2">\( h={{ $detail['height'] }} \)</p>
                                <p class="mt-2">{{ $lang['13'] }} (A):</p>
                                <p class="mt-2">\( A=\dfrac{a^2*\sqrt(3)}{2} \)</p>
                                <p class="mt-2">\( A=\dfrac{ {{$detail['a'] }}^2*\sqrt(3)}{2} \)</p>
                                <p class="mt-2">\( A=\dfrac{ {{$detail['a'] * $detail['a'] }}*{{sqrt(3) }}}{2} \)</p>
                                <p class="mt-2">\( A={{$detail['aa'] }} \)</p>
                                <p class="mt-2">{{ $lang['14'] }} (p):</p>
                                <p class="mt-2">\( p=a+b+c \)</p>
                                <p class="mt-2">\( p={{$detail['a'] }}+{{$detail['b'] }}+{{$detail['c']; }} \)</p>
                                <p class="mt-2">\( p={{$detail['peri'] }} \)</p>
                                <p class="mt-2">{{ $lang['15'] }} (r):</p>
                                <p class="mt-2">\( r=\dfrac{a*b}{perimeter} \)</p>
                                <p class="mt-2">\( r=\dfrac{ {{$detail['a'] }}*{{$detail['b'] }}}{{{$detail['peri']; }}} \)</p>
                                <p class="mt-2">\( r={{$detail['in_radius']; }} \)</p>
                                <p class="mt-2">{{ $lang['16'] }} (R):</p>
                                <p class="mt-2">\( R=\dfrac{c}{2} \)</p>
                                <p class="mt-2">\( R=\dfrac{{{$detail['c'] }}}{2} \)</p>
                                <p class="mt-2">\( R={{$detail['radius'] }} \)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        <script>
            function text_change(element) {
                var side_val = element.value;
                var changeText = document.getElementById('changeText');
                var linearUnit = document.querySelector('.linear_unit');
                var squareUnit = document.querySelector('.square_unit');
                switch (side_val) {
                    case 'a':
                        changeText.textContent = "Enter leg (a)";
                        toggleUnits(true);
                        break;
                    case 'b':
                        changeText.textContent = "Enter leg (b)";
                        toggleUnits(true);
                        break;
                    case 'c':
                        changeText.textContent = "Enter Hypotenuse (c)";
                        toggleUnits(true);
                        break;
                    case 'h':
                        changeText.textContent = "Enter Height (h)";
                        toggleUnits(true);
                        break;
                    case 'A':
                        changeText.textContent = "Enter Area (A)";
                        toggleUnits(false);
                        break;
                    default:
                        changeText.textContent = "Enter Perimeter (p)";
                        toggleUnits(true);
                        break;
                }

                function toggleUnits(isLinear) {
                    if (isLinear) {
                        linearUnit.style.display = 'block';
                        squareUnit.style.display = 'none';
                    } else {
                        linearUnit.style.display = 'none';
                        squareUnit.style.display = 'block';
                    }
                }
            }
        </script>
    @endpush
</form>