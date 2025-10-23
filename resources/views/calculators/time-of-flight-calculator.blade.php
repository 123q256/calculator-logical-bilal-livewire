<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
        
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="a" class="font-s-14 text-blue">{{ $lang['1'] }} (α)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="a" id="a" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['a']) ? $_POST['a'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="a_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('a_unit_dropdown')">{{ isset($_POST['a_unit'])?$_POST['a_unit']:'deg' }} ▾</label>
                       <input type="text" name="a_unit" value="{{ isset($_POST['a_unit'])?$_POST['a_unit']:'deg' }}" id="a_unit" class="hidden">
                       <div id="a_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="a_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'deg')">deg</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'rad')">rad</p>
                       </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="h" class="font-s-14 text-blue">{{ $lang['2'] }} (h)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="h" id="h" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['h']) ? $_POST['h'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="h_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('h_unit_dropdown')">{{ isset($_POST['h_unit'])?$_POST['h_unit']:'cm' }} ▾</label>
                       <input type="text" name="h_unit" value="{{ isset($_POST['h_unit'])?$_POST['h_unit']:'cm' }}" id="h_unit" class="hidden">
                       <div id="h_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="h_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'cm')">cm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'm')">m</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'km')">km</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'in')">in</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'ft')">ft</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'yd')">yd</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'mi')">mi</p>
                       </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="v" class="font-s-14 text-blue">{{ $lang['3'] }} (V)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="v" id="v" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v']) ? $_POST['v'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="v_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v_unit_dropdown')">{{ isset($_POST['v_unit'])?$_POST['v_unit']:'ms' }} ▾</label>
                       <input type="text" name="v_unit" value="{{ isset($_POST['v_unit'])?$_POST['v_unit']:'ms' }}" id="v_unit" class="hidden">
                       <div id="v_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="v_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'ms')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'kmh')">km/h</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'fts')">ft/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'mph')">mph</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'ft')">ft</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'yd')">yd</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'mi')">mi</p>
                       </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="g" class="font-s-14 text-blue">{{ $lang['4'] }} (V)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="g" id="g" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['g']) ? $_POST['g'] : '9.80665' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="g_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('g_unit_dropdown')">{{ isset($_POST['g_unit'])?$_POST['g_unit']:'msms2' }} ▾</label>
                       <input type="text" name="g_unit" value="{{ isset($_POST['g_unit'])?$_POST['g_unit']:'msms2' }}" id="g_unit" class="hidden">
                       <div id="g_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="g_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('g_unit', 'msms2')">m/s²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('g_unit', 'g')">g</p>
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
</div>
            

    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-fullfont-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['tof'] }} sec</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[6] }} (Vx)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['vx'] }} m/s</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }} (Vy)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['vy'] }} m/s</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[8] }}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['g'] }} m/s²</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full font-s-16 overflow-auto">
                            <p class="mt-2"><span >{{$lang['9'] }} </p>
                        @if ($detail['h'] == 0)
                          <p class="mt-2">\(\text{∴ <?=$lang['10']?> = 0}\)</p>
                          <p class="mt-2">\(t = \dfrac{2 V_o sin(α)}{g}\)</p>
                          <p class="mt-2">{{$lang['11']}}</p>
                          <p class="mt-2">\(V_o -  \text{{{$lang['3']}}} = {{$detail['v']}} m/s\)</p>
                          <p class="mt-2">\(α -  \text{{{$lang['13']}}} = {{$detail['a']}} deg\)</p>
                          <p class="mt-2">\(g -  \text{ {{$lang['14']}}} = {{$detail['g']}} m/s²\)</p>
                          <p class="mt-2">{{$lang['12']}}</p>
                          <p class="mt-2">\(t = \dfrac{2 V_o sin(α)}{g}\)</p>
                          <p class="mt-2">\(t = \dfrac{2 \times {{$detail['v']}} \times sin({{$detail['a']}})}{{{$detail['g']}}}\)</p>
                          <p class="mt-2">\(t = \dfrac{2 \times {{$detail['v']}} \times {{$detail['sin']}}}{{{$detail['g']}}}\)</p>
                          <p class="mt-2">\(t = \dfrac{2 \times {{$detail['v']}} \times {{$detail['sin']}}}{{{$detail['g']}}}\)</p>
                          <p class="mt-2">\(t = \dfrac{{{$detail['res']}}}{{{$detail['g']}}}\)</p>
                          <p class="mt-2">\(\text{t = {{$detail['tof']}} sec}\)</p>
                        @endif
                        @if ($detail['h'] > 0)
                          <p class="mt-2">\(\text{∴ {{$lang['10']}} > 0}\)</p>
                          <p class="mt-2">\(t = \dfrac{V_o sin(α) + \sqrt{(V_o sin(α))^2 + 2gh}}{g}\)</p>
                          <p class="mt-2"><{{$lang['11']}}</p>
                          <p class="mt-2">\(V_o -  \text{<?=$lang['3']?>} = <?=$detail['v']?> m/s\)</p>
                          <p class="mt-2">\(α -  \text{<?=$lang['13']?>} = <?=$detail['a']?> deg\)</p>
                          <p class="mt-2">\(g -  \text{ <?=$lang['14']?>} = <?=$detail['g']?> m/s²\)</p>
                          <p class="mt-2"><?=$lang['12']?></p>
                          <p class="mt-2">\(t = \dfrac{V_o sin(α) + \sqrt{(V_o sin(α))^2 + 2gh}}{g}\)</p>
                          <p class="mt-2">\(t = \dfrac{ {{$detail['v']}} \times sin({{$detail['a']}}) + \sqrt{({{$detail['v']}} \times sin({{$detail['a']}}))^2 + 2 \times{{$detail['g']}}\times{{$detail['h']}}}}{{{$detail['g']}}}\)</p>
                          <p class="mt-2">\(t = \dfrac{ {{$detail['v']}} \times {{$detail['sin']}} + \sqrt{({{$detail['v']}} \times {{$detail['sin']}})^2 + 2 \times{{$detail['g']}}\times{{$detail['h']}}}}{{{$detail['g']}}}\)</p>
                          <p class="mt-2">\(t = \dfrac{ {{$detail['vy']}} + \sqrt{({{$detail['vy']}})^2 + {{$detail['gh']}}}}{{{$detail['g']}}}\)</p>
                          <p class="mt-2">\(t = \dfrac{ {{$detail['vy']}} + \sqrt{{{$detail['vs2gh']}}}}{{{$detail['g']}}}\)</p>
                          <p class="mt-2">\(t = \dfrac{{{$detail['vysqrt']}}}{{{$detail['g']}}}\)</p>
                          <p class="mt-2">\(\text{t = {{$detail['tof']}} sec}\)</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        @if(isset($detail))
            <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
            <script type="text/x-mathjax-config">
                MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
            </script>
        @endif
    @endpush
</form>


<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>