<style>
    @media (min-width: 992px) {
        .font-lg-14{
            font-size: 14px;
        }
    }
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
    #onetw{
        background: transparent;
        border: none;
        color: #1670a7;
        outline: none;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
            <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[80%] w-full">
                <input type="hidden" name="choice" id="velo_value" value="{{ isset($_POST['choice'])?$_POST['choice']:'1' }}">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 velocitytab">
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags {{ isset($_POST['choice']) && $_POST['choice'] !== '1' ? ''  : 'tagsUnit' }}  hover:text-white  veloTabs" id="scale_fec">
                                {{ $lang['6'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags {{ isset($_POST['choice']) && $_POST['choice'] == '2' ? 'tagsUnit'  : '' }}  hover:text-white veloTabs" id="scale_len">
                                {{ $lang['7'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags {{ isset($_POST['choice']) && $_POST['choice'] == '3' ? 'tagsUnit'  : '' }} hover:text-white veloTabs" id="real_len">
                                {{ $lang['8'] }}
                        </div>
                    </div>
                </div>
            </div>

       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
  

                <div class="col-span-12 md:col-span-6 lg:col-span-6 scaled_fector {{ isset($_POST['choice']) && $_POST['choice'] !== '1' ? 'hidden'  : 'block' }}">
                    <label for="scaled_length" class="font-s-14 text-blue">{{ $lang['7'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="scaled_length" id="scaled_length" step="any" min="1"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['scaled_length']) ? $_POST['scaled_length'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="scaled_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('scaled_length_unit_dropdown')">{{ isset($_POST['scaled_length_unit'])?$_POST['scaled_length_unit']:'m' }} ▾</label>
                        <input type="text" name="scaled_length_unit" value="{{ isset($_POST['scaled_length_unit'])?$_POST['scaled_length_unit']:'m' }}" id="scaled_length_unit" class="hidden">
                        <div id="scaled_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="scaled_length_unit">
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('scaled_length_unit', 'mm')">mm</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('scaled_length_unit', 'cm')">cm</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('scaled_length_unit', 'm')">m</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('scaled_length_unit', 'km')">km</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('scaled_length_unit', 'in')">in</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('scaled_length_unit', 'ft')">ft</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('scaled_length_unit', 'yd')">yd</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('scaled_length_unit', 'mi')">mi</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 other_fector {{ isset($_POST['choice']) && $_POST['choice'] !== '1' ? 'block'  : 'hidden' }}">
                    <label for="y11" class="font-s-14 text-blue" id="y1">{{ $lang['6'] }}</label>
                    <div class="w-full py-2 flex justify-center items-center">
                        <input type="number" type="any" name="y1" id="y11" class="input" value="{{ isset($_POST['y1'])?$_POST['y1']:'' }}" aria-label="input" placeholder="00" /> 
                        <span class="px-1 ">:</span>
                        <input type="number" type="any" name="y2" class="input" value="{{ isset($_POST['y2'])?$_POST['y2']:'' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="real_length" class="font-s-14 text-blue" id="y2">{{ $lang['8'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="real_length" min="1"  id="real_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['real_length']) ? $_POST['real_length'] : '1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="real_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('real_length_unit_dropdown')">{{ isset($_POST['real_length_unit'])?$_POST['real_length_unit']:'m' }} ▾</label>
                        <input type="text" name="real_length_unit" value="{{ isset($_POST['real_length_unit'])?$_POST['real_length_unit']:'m' }}" id="real_length_unit" class="hidden">
                        <div id="real_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="real_length_unit">
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('real_length_unit', 'mm')">mm</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('real_length_unit', 'cm')">cm</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('real_length_unit', 'm')">m</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('real_length_unit', 'km')">km</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('real_length_unit', 'in')">in</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('real_length_unit', 'ft')">ft</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('real_length_unit', 'yd')">yd</p>
                          <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('real_length_unit', 'mi')">mi</p>
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
                        @php
                            $choice = request()->choice;
                        @endphp
                        <div class="w-full my-2">
                            @if($choice == '1')
                                <div class="w-full text-center text-[20px]">
                                    <p>{{ $lang[6] }}</p>
                                    <div class="flex justify-center">
                                        <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">{{($detail['v5'])}}</strong></p>
                                </div>
                            </div>
                            @elseif($choice == '2')
                                <div class="w-full text-center text-[20px]">
                                    <p>{{ $lang[7] }}</p>
                                    <div class="my-3 bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg d-inline-block">
                                        <strong class=""  id="circle_result">{{round($detail['answer'],4)}}</strong>
                                        <span class="text-[16px]  ">
                                            {{ isset($_POST['real_length_unit']) ? $_POST['real_length_unit'] : '' }}
                                        </span>
                                    </div>
                                </div>  
                            @else
                                <div class="w-full text-center text-[20px]">
                                    <p>{{ $lang[8] }}</p>
                                    <div class="my-3 bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg d-inline-block">
                                        <strong  id="circle_result">{{round($detail['answer'],4)}}</strong>
                                        <span class="text-[16px]  ">
                                            {{ isset($_POST['real_length_unit']) ? $_POST['real_length_unit'] : '' }}
                                        </span>
                                    </div>
                                </div>                   
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
        document.getElementById('scale_fec').addEventListener('click', function() {
            document.querySelectorAll('.veloTabs').forEach(function(el) {
                el.classList.remove('tagsUnit');
            });
            document.getElementById('velo_value').value = '1';
            this.classList.add('tagsUnit');

            document.querySelector('.scaled_fector').style.display = 'block';
            document.querySelector('.other_fector').style.display = 'none';
            document.getElementById('y2').innerHTML = '{{ $lang['8'] }}'

        });
        document.getElementById('scale_len').addEventListener('click', function() {
            document.querySelectorAll('.veloTabs').forEach(function(el) {
                el.classList.remove('tagsUnit');
            });
            document.getElementById('velo_value').value = '2';
            this.classList.add('tagsUnit');

            document.querySelector('.scaled_fector').style.display = 'none';
            document.querySelector('.other_fector').style.display = 'block';
            document.getElementById('y1').innerHTML = '{{ $lang['6'] }}';
            document.getElementById('y2').innerHTML = '{{ $lang['8'] }}'
        });
        document.getElementById('real_len').addEventListener('click', function() {
            document.querySelectorAll('.veloTabs').forEach(function(el) {
                el.classList.remove('tagsUnit');
            });
            document.getElementById('velo_value').value = '3';
            this.classList.add('tagsUnit');

            document.querySelector('.scaled_fector').style.display = 'none';
            document.querySelector('.other_fector').style.display = 'block';
            document.getElementById('y1').innerHTML = '{{ $lang['6'] }}';
            document.getElementById('y2').innerHTML = '{{ $lang['7'] }}';
        });

    </script>
@endpush