<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
 
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                 <input type="hidden" name="calc" id="one" value="one">
                <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white   wed {{ isset(request()->one) && request()->one !== 'one'  ? '' :'tagsUnit' }} " id="wed">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white rel {{ isset(request()->one) && request()->one == 'two' ? 'tagsUnit' :'' }}" id="rel">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12 mt-4  gap-2">
                <div class="col-span-12 simple ">
                    <label for="appli" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-full py-2"> 
                        <select name="appli" id="appli" class="input">
                            <option value="a" selected>{{$lang[4]}}</option>
                            <option value="b">{{$lang[5]}}</option>
                            <option value="c">{{$lang[6]}}</option>
                            <option value="d">{{$lang[7]}}</option>
                            <option value="e">{{$lang[8]}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6 simple">
                    <div class="col-lg-6  pe-lg-4 ">
                        <div class="col-12  mt-0 mt-lg-2">
                            <label for="r_type" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                            <div class="w-full py-2"> 
                                <select name="r_type" id="r_type" class="input">
                                    <option value="st" selected>{{$lang[10]}}</option>
                                    <option value="dl">{{$lang[11]}}</option>
                                    <option value="sb">{{$lang[12]}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="no" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="no" id="no" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['no'])?$_POST['no']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'cm' }} ▾</label>
                                <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'cm' }}" id="unit" class="hidden">
                                <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('unit', '{{ $name }}')"> {{ $name }}</p>
                                   @endforeach
                                </div>
                            </div>
                         </div>
                       
                    </div>
                </div>
                <div class="col-span-6 flex items-center advance hidden">
                    <div class="col-lg-6  pe-lg-4 ">
                        <div class="col-12 mt-0 mt-lg-2">
                            <label for="no1" class="font-s-14 text-blue">{{ $lang['13'] }} (a):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="no1" id="no1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['no1'])?$_POST['no1']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit0" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit0_dropdown')">{{ isset($_POST['unit0'])?$_POST['unit0']:'m' }} ▾</label>
                                <input type="text" name="unit0" value="{{ isset($_POST['unit0'])?$_POST['unit0']:'m' }}" id="unit0" class="hidden">
                                <div id="unit0_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit0">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('unit0', '{{ $name }}')"> {{ $name }}</p>
                                   @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-12 mt-0 mt-lg-2">
                            <label for="no2" class="font-s-14 text-blue">{{ $lang['15'] }} (b):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="no2" id="no2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['no2'])?$_POST['no2']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'m' }} ▾</label>
                                <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'m' }}" id="unit1" class="hidden">
                                <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('unit1', '{{ $name }}')"> {{ $name }}</p>
                                   @endforeach
                                </div>
                            </div>
                         </div>
                         <div class="col-12 mt-0 mt-lg-2">
                            <label for="width" class="font-s-14 text-blue">{{ $lang['16'] }} (w):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width'])?$_POST['width']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit2_dropdown')">{{ isset($_POST['unit2'])?$_POST['unit2']:'m' }} ▾</label>
                                <input type="text" name="unit2" value="{{ isset($_POST['unit2'])?$_POST['unit2']:'m' }}" id="unit2" class="hidden">
                                <div id="unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit2">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('unit2', '{{ $name }}')"> {{ $name }}</p>
                                   @endforeach
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="col-span-6" style="display: flexjustify-items: center;align-items: center;">
                    <img src="{{asset('images/rampsimple.webp')}}" alt="Ramp Picture" class="max-width change_image" width="100%" height="80px">
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

            
    @else
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    @php
                        $calc = request()->calc;
                        $appli=request()->appli;
                        $r_type=request()->r_type;
                    @endphp
                    <div class="row py-2">
                        @if ($calc == 'one')
                            <div class="d-full">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto font-s-18  pe-lg-4">
                                  <div>
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2 d-flex align-items-center flex">
                                                <img src="{{asset('images/deg.webp')}}" alt="image of degree" width="30px" height="30px" class="max-width pe-2">
                                                {{$lang[18]}} :</td>
                                            <td class="border-b py-2">
                                                {{ $detail['deg']}}°
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 d-flex align-items-center flex">
                                                <img src="{{asset('images/percent.webp')}}" alt="image of grade" width="30px" height="30px" class="max-width pe-2">
                                                {{$lang[19]}} :
                                            </td>
                                            <td class="border-b py-2">
                                                {{ $detail['grade']}}%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 d-flex align-items-center flex">
                                                <img src="{{asset('images/lenght.webp')}}" alt="mode" width="30px" height="30px" class="max-width pe-2">
                                                {{$lang[20]}} :
                                            </td>
                                            <td class="border-b py-2">
                                                {{ $detail['ramplenght'] . $detail['unit']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class=" py-2 flex">
                                                <img src="{{asset('images/lenght.webp')}}" alt="image of grade" width="30px" height="30px" class="max-width pe-2">
                                                {{$lang[21]}} :
                                            </td>
                                            <td class=" py-2">{{ $detail['runs'].$detail['unit']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full flex items-center justify-center">
                                    @if($detail['appli'] == 'a')
                                        <img src="{{asset('images/ramp1.webp')}}" alt="image of lenght"
                                        width="250px" height="100px">
                                    @elseif($detail['appli'] == 'b')
                                        <img src="{{asset('images/ramp2.webp')}}" alt="image of lenght2"
                                        width="250px" height="100px">
                                    @elseif($detail['appli'] == 'c')
                                        <img src="{{asset('images/ramp3.webp')}}" alt="image of lenght3"
                                        width="250px" height="100px">
                                    @elseif($detail['appli'] == 'd')
                                        <img src="{{asset('images/ramp4.webp')}}" alt="image of lenght4"
                                        width="250px" height="100px">
                                    @else
                                        <img src="{{asset('images/ramp5.webp')}}" alt="image of lenght5"
                                        width="250px" height="100px">
                                    @endif
                                </div>
                            </div>
                        </div>
                            <div class="w-fill md:w-[70%] lg:w-[70%] my-3">
                                @if($detail['r_type'] == 'st')
                                    <img src="{{asset('images/ramp11.png')}}" alt="image of lenght" class="max-width"
                                    width="450px" height="60px" >
                                @elseif($detail['r_type'] == 'sb')
                                    <img src="{{asset('images/ramp180.png')}}" alt="image of lenght" class="max-width"
                                    width="450px" height="100px" >
                                @endif
                            </div>
                            <div class="w-full">
                                <div class="w-fill md:w-[70%] lg:w-[70%] font-s-18">
                                    <table class="w-full">
                                        <tr>
                                            <td colspan="2"><strong>{{$lang[22]}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[23]}} :</td>
                                            <td class="border-b py-2">{{ $detail['rad']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[24]}} :</td>
                                            <td class="border-b py-2">{{ $detail['millirad']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[25]}} :</td>
                                            <td class="border-b py-2">{{ $detail['microrad']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[26]}} :</td>
                                            <td class="border-b py-2">{{ $detail['pirad']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[27]}} :</td>
                                            <td class="border-b py-2">{{ $detail['gradian']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[28]}} :</td>
                                            <td class="border-b py-2">{{ $detail['turns']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[29]}} :</td>
                                            <td class="border-b py-2">{{ $detail['minarc']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">{{$lang[30]}} :</td>
                                            <td class="py-2">{{ $detail['secarc']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-5 d-flex justify-content-center align-items-center">
                                    @if($detail['r_type'] == 'dl')
                                        <img src="{{asset('images/ramp90.png')}}" alt="image of lenght" class="max-width"
                                        width="300px" height="430px" >
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="w-fill md:w-[70%] lg:w-[70%] font-s-18">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2 d-flex align-items-center">
                                            <img src="{{asset('images/hypotenuse.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[31]}} (c)
                                        </td>
                                        <td class="border-b py-2">
                                            {{ $detail['Hypotenuse']}} <span class="font-s-14">cm</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 d-flex align-items-center">
                                            <img src="{{asset('images/alpha2.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[32]}}
                                        </td>
                                        <td class="border-b py-2">
                                            {{ $detail['alpha']}}<sup>o</sup>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 d-flex align-items-center">
                                            <img src="{{asset('images/beta.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[33]}}
                                        </td>
                                        <td class="border-b py-2">
                                            {{ $detail['beta']}}<sup>o</sup>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 d-flex align-items-center">
                                            <img src="{{asset('images/area1.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[34]}}
                                        </td>
                                        <td class="border-b py-2">
                                            {{ $detail['area']}} <span class="font-s-14">cm</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 d-flex align-items-center">
                                            <img src="{{asset('images/volume.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[35]}}
                                        </td>
                                        <td class="border-b py-2">{{ $detail['volume']}} <span class="font-s-14">cm</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 d-flex align-items-center">
                                            <img src="{{asset('images/ratio2.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[36]}}
                                        </td>
                                        <td class="border-b py-2">
                                            {{ $detail['sv']}} <span class="font-s-14">cm</span>
                                        </td>
                                    </tr>
                                </table>
                                <div class="font-s-16">
                                    <p class="my-2 text-center"><strong><?=$lang[37]?></strong></p>
                                    <p class=""><strong><?=$lang[31]?>:</strong></p>
                                    <p class="mt-2 ">\(<?=$lang[31]?> \ (c) = \sqrt{a^2 + b^2} \)</p>
                                    <p class="mt-2 ">\(<?=$lang[31]?> \ (c) = \sqrt{(<?=$detail['no1']?>)^2 + (<?=$detail['no2']?>)^2} \)</p>
                                    <p class="mt-2 ">\(<?=$lang[31]?> \ (c) = \sqrt{<?=pow($detail['no1'],2)?> + <?=pow($detail['no2'],2)?>} \)</p>
                                    <p class="mt-2 ">\(<?=$lang[31]?> \ (c) = \sqrt{<?=$detail['Hypotenuse1']?>} \)</p>
                                    <p class="mt-2 ">\(<?=$lang[31]?> \ (c) = {<?=$detail['Hypotenuse']?>} \)</p>
                                    <p class="mt-2"><strong><?=$lang[32]?>:</strong></p>
                                    <p class="mt-2">\(<?=$lang[38]?> \ \alpha = \cos \theta^{-1} \ ({b^2 + c^2 - a^2}) \div (2bc) \)</p>
                                    <p class="mt-2 ">\(<?=$lang[38]?> \ \alpha = \cos \theta^{-1} \ ({(<?=$detail['no2']?>)^2 + (<?=$detail['Hypotenuse']?>)^2 - (<?=$detail['no1']?>)^2}) \div (2(<?=$detail['no2']?>)(<?=$detail['Hypotenuse']?>) \)</p>
                                    <p class="mt-2 ">\(<?=$lang[38]?> \ \alpha = \cos \theta^{-1} \ ({<?=(pow($detail['no2'],2) + pow($detail['Hypotenuse'],2)) - $detail['no1']?>)}) \div (<?=2*$detail['no2']*$detail['Hypotenuse']?>) \)</p>
                                    <p class="mt-2 ">\(<?=$lang[38]?> \ \alpha = \cos \theta^{-1} \ (<?=$detail['alpha2']?>)\)</p>
                                    <p class="mt-2 ">\(<?=$lang[38]?> \ \alpha = (<?=$detail['alpha']?>) \)</p>
                                    <p class="mt-2"><strong><?=$lang[33]?>:</strong></p>
                                    <p class="mt-2">\(<?=$lang[18]?> \ <?=$lang[38]?> \ \beta = 90^0 - \alpha \)</p>
                                    <p class="mt-2 ">\(<?=$lang[18]?> \ <?=$lang[38]?> \ \beta = (<?=90 - $detail['alpha']?>) \)</p>
                                    <p class="mt-2"><strong><?=$lang[34]?>:</strong></p>
                                    <p class="mt-2 ">\(<?=$lang[39]?> \ (A) = a \times b + w \times (a + b + c)\)</p>
                                    <p class="mt-2">\(<?=$lang[39]?> \ (A) = <?=$detail['no1']?> \times <?=$detail['no2']?>+ <?=$detail['width']?> \times (<?=$detail['no1']?> + <?=$detail['no2']?> + <?=$detail['Hypotenuse']?>)\)</p>
                                    <p class="mt-2 ">\(<?=$lang[39]?> \ (A) = <?=$detail['area']?>\)</p>
                                    <p class="mt-2"><strong><?=$lang[35]?>:</strong></p>
                                    <p class="mt-2 ">\(<?=$lang[35]?> \ (V) = (a \times b \times w) \div 2\)</p>
                                    <p class="mt-2 ">\(<?=$lang[35]?> \ (V) = (<?=$detail['no1']?> \times <?=$detail['no2']?> \times <?=$detail['width']?>) \div 2 \)</p>
                                    <p class="mt-2 ">\(<?=$lang[35]?> \ (V) = <?=$detail['volume']?>\)</p>
                                    <p class="mt-2"><strong><?=$lang[36]?>:</strong></p>
                                    <p class="mt-2"><strong>\(<?=$lang[40]?> \ (A/V)= <?=$detail['area']?> \div <?=$detail['volume']?> \)</strong></p>
                                    <p class="mt-2 "><strong>\(<?=$lang[40]?> \ (A/V)= <?=$detail['sv']?> \)</strong></p>
                                </div>
                            </div>
                            <script src="https://code.jquery.com/jquery-3.4.1.min.js"
                            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
                                                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
                                <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
                            <script type="text/x-mathjax-config">
                                MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
                            </script>
                        @endif
                    </div>
                    <div class="col-12 text-center mt-[20px]">
                        <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                            @if (app()->getLocale() == 'en')
                                RESET
                            @else
                                {{ $lang['reset'] ?? 'RESET' }}
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
@push('calculatorJS')
    <script>
        var change_image = document.querySelector('.change_image');
        document.querySelectorAll('.wed').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('one').value = 'one'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.rel').forEach(function(hours1) {
                    hours1.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.simple').forEach(function(simple) {
                    simple.style.display = "block";
                });
                document.querySelectorAll('.advance').forEach(function(advance) {
                    advance.style.display = "none";
                });
                change_image.setAttribute('src', "{{asset('images/rampsimple.webp')}}")
                change_image.setAttribute('height', "80px")
                change_image.setAttribute('width', "300px")
            })
        });
        document.querySelectorAll('.rel').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('one').value = 'two'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.wed').forEach(function(hours1) {
                    hours1.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.simple').forEach(function(simple) {
                    simple.style.display = "none";
                });
                document.querySelectorAll('.advance').forEach(function(advance) {
                    advance.style.display = "block";
                });
                change_image.setAttribute('src', "{{asset('images/advanceramp.webp')}}")
                change_image.setAttribute('height', "200px")
                change_image.setAttribute('width', "250px")
            })
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>