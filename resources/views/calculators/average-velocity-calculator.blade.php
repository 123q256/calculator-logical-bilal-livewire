<style>
    @media (min-width: 992px) {
        .font-lg-14{
            font-size: 14px;
        }
    }
    /* .velocitytab {
        min-width: 500px;
    } */
    .velocitytab .tagsUnit{
        border-bottom: 3px solid var(--light-blue);
    }
    .velocitytab .tagsUnit strong{
        color: var(--light-blue);
    }
    .velocitytab p{
        position: relative;
        top: 2px
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
               <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                <div class="col-lg-2 py-2 font-s-14">{{$lang['to_calc']}}:</div>
                <input type="hidden" name="method" id="method" value="{{ isset($_POST['method'])?$_POST['method']:'1' }}">
                <div class="flex flex-wrap items-center bg-blue-100 border blue-green-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  imperial {{ isset($_POST['method']) && $_POST['method'] !== '1' ? ''  : 'tagsUnit' }}" id="one">
                                {{ $lang['ave_vel'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric {{ isset($_POST['method']) && $_POST['method'] == '2' ? 'tagsUnit'  : '' }}" id="two">
                                {{ $lang['iv'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric {{ isset($_POST['method']) && $_POST['method'] == '3' ? 'tagsUnit'  : '' }}" id="three">
                                {{ $lang['fv'] }}
                        </div>
                    </div>
                </div>
            </div>




                <div class="grid grid-cols-12 mt-3  gap-2">
                    <div class="col-span-6">
                        <label for="x" class="font-s-14 text-blue" id="x">{{ $lang['iv']}}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="x" id="x" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['x'])?$_POST['x']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="iv" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('iv_dropdown')">{{ isset($_POST['iv'])?$_POST['iv']:'m/s' }} ▾</label>
                            <input type="text" name="iv" value="{{ isset($_POST['iv'])?$_POST['iv']:'m/s' }}" id="iv" class="hidden">
                            <div id="iv_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="iv">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv', 'm/s')">m/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv', 'ft/s')">ft/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv', 'km/h')">km/h</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv', 'km/s')">km/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv', 'mi/s')">mi/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv', 'mph')">mph</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="y" class="font-s-14 text-blue" id="y">{{ $lang['fv']}}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="y" id="y" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['y'])?$_POST['y']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="fv" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fv_dropdown')">{{ isset($_POST['fv'])?$_POST['fv']:'m/s' }} ▾</label>
                            <input type="text" name="fv" value="{{ isset($_POST['fv'])?$_POST['fv']:'m/s' }}" id="fv" class="hidden">
                            <dfv id="fv_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fv">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv', 'm/s')">m/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv', 'ft/s')">ft/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv', 'km/h')">km/h</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv', 'km/s')">km/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv', 'mi/s')">mi/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv', 'mph')">mph</p>
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
                    <div class="w-full mt-3 ">
                        @if($_POST['method']=='1')
                        <div class="w-full text-center text-[20px]">
                            <p>{{ $lang['ave_vel'] }} </p>
                            <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2 text-[25px] text-white rounded-lg">{{ $detail['ave'] }}</strong></p>
                        </div>
                        @elseif($_POST['method']=='2')
                        <div class="w-full  text-center text-[20px]">
                            <p>{{ $lang['iv'] }} </p>
                            <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2 text-[25px] text-white rounded-lg">{{ $detail['ave'] }}</strong></p>
                        </div>
                        @elseif($_POST['method']=='3')
                        <div class="w-full  text-center text-[20px]">
                            <p>{{ $lang['fv'] }} </p>
                            <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2 text-[25px] text-white rounded-lg">{{ $detail['ave'] }}</strong></p>
                        </div>
                        @endif
                    </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
<script>
    var xElement = document.getElementById('x');
    var yElement = document.getElementById('y');
    var method = document.getElementById('method');
    var one = document.getElementById('one');
    var two = document.getElementById('two');
    var three = document.getElementById('three');
   // var four = document.getElementById('four');

    document.getElementById('one').addEventListener('click', function() {
        method.value = "1";
        one.classList.add('tagsUnit');
        two.classList.remove('tagsUnit');
        three.classList.remove('tagsUnit');
        // four.classList.remove('tagsUnit');
        xElement.textContent = '{{$lang['iv']}}';
        yElement.textContent = '{{$lang['fv']}}';
    });
    document.getElementById('two').addEventListener('click', function() {
        two.classList.add('tagsUnit');
        one.classList.remove('tagsUnit');
        three.classList.remove('tagsUnit');
        // four.classList.remove('tagsUnit');
        method.value = "2";
        xElement.textContent = '{{$lang['ave_vel']}}';
        yElement.textContent = '{{$lang['fv']}}';
    });
    document.getElementById('three').addEventListener('click', function() {
        method.value = "3";
        one.classList.remove('tagsUnit');
        two.classList.remove('tagsUnit');
        three.classList.add('tagsUnit');
        // four.classList.remove('tagsUnit');
        xElement.textContent = '{{$lang['ave_vel']}}';
        yElement.textContent = '{{$lang['iv']}}';
    });
    // document.getElementById('four').addEventListener('click', function() {
    //     one.classList.remove('tagsUnit');
    //     two.classList.remove('tagsUnit');
    //     three.classList.remove('tagsUnit');
    //     four.classList.add('tagsUnit');
    //     method.value = "4";
    //     xElement.textContent = '{{$lang['qv']}}';
    //     yElement.textContent = '{{$lang['rv']}}';
    // });

    @if(isset($detail) || isset($error))
   
        if (method.value == '1') {
            xElement.textContent = '{{$lang['iv']}}';
            yElement.textContent = '{{$lang['fv']}}';
        } else if (method.value == '2') {
            xElement.textContent = '{{$lang['ave_vel']}}';
            yElement.textContent = '{{$lang['fv']}}';
        } else if (method.value == '3') {
            xElement.textContent = '{{$lang['ave_vel']}}';
            yElement.textContent = '{{$lang['iv']}}';
        } 
       // else if (method == '4') {
        //    xElement.textContent = '{{$lang['qv']}}';
        //    yElement.textContent = '{{$lang['rv']}}';
       // }
    @endif
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>