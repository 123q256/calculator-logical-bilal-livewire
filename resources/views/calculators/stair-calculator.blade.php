<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="  mt-2 lg:w-[50%] ">
            <input type="hidden" name="type" id="type" value="first">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  {{ isset($_POST['type']) && $_POST['type'] !== 'first'  ? '' :'tagsUnit' }} wed" id="wed">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white rel {{ isset($_POST['type']) && $_POST['type'] == 'second' ? 'tagsUnit' :'' }}" id="rel">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="f_input" class="font-s-14 text-blue textChange">
                        @if (isset($_POST['type']) && $_POST['type'] !== 'first')
                            {{ $lang['2'] }}
                        @else
                            {{ $lang['3'] }}
                        @endif
                    :</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="f_input" id="f_input" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_input']) ? $_POST['f_input'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="f_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_units_dropdown')">{{ isset($_POST['f_units'])?$_POST['f_units']:'cm' }} ▾</label>
                        <input type="text" name="f_units" value="{{ isset($_POST['f_units'])?$_POST['f_units']:'cm' }}" id="f_units" class="hidden">
                        <div id="f_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_units">
                            @foreach (["cm","in"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('f_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6  ">
                    <label for="s_input" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="s_input" id="s_input" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['s_input']) ? $_POST['s_input'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="s_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('s_units_dropdown')">{{ isset($_POST['s_units'])?$_POST['s_units']:'m' }} ▾</label>
                        <input type="text" name="s_units" value="{{ isset($_POST['s_units'])?$_POST['s_units']:'m' }}" id="s_units" class="hidden">
                        <div id="s_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="s_units">
                            @foreach (["cm","m","in","ft"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('s_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
            
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="rise" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2"> 
                    <select name="rise" id="rise" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['6'].' ('.$lang['7'].')', $lang['8']];
                            $val = ['1','2'];
                            optionsList($val,$name,isset($_POST['rise'])?$_POST['rise']:'0');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  ">
                <label for="t_input" class="font-s-14 text-blue rise_text">
                    @if (isset($_POST['rise']) && $_POST['rise'] !== '1')
                        {{ $lang['23'] }}
                    @else
                        {{ $lang['9'] }} ({{$lang['7']}})
                    @endif
                :</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="t_input" id="t_input" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t_input']) ? $_POST['t_input'] : '24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="t_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_units_dropdown')">{{ isset($_POST['t_units'])?$_POST['t_units']:'cm' }} ▾</label>
                    <input type="text" name="t_units" value="{{ isset($_POST['t_units'])?$_POST['t_units']:'cm' }}" id="t_units" class="hidden">
                    <div id="t_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_units">
                        @foreach (["cm","in"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('t_units', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
           
            <div class="col-span-12 md:col-span-6 lg:col-span-6  ">
                <label for="tread" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                <div class="w-100 py-2"> 
                    <select name="tread" id="tread" class="input">
                        @php
                            $name = [$lang['11'] , $lang['12']];
                            $val = ['1','2'];
                            optionsList($val,$name,isset($_POST['tread'])?$_POST['tread']:'0');
                        @endphp    
                </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 tread {{ isset($_POST['tread']) && $_POST['tread'] === '2' ? 'block':'hidden'}}">
                <label for="tread_input" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="tread_input" id="tread_input" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tread_input']) ? $_POST['tread_input'] : '24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="tread_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tread_units_dropdown')">{{ isset($_POST['tread_units'])?$_POST['tread_units']:'cm' }} ▾</label>
                    <input type="text" name="tread_units" value="{{ isset($_POST['tread_units'])?$_POST['tread_units']:'cm' }}" id="tread_units" class="hidden">
                    <div id="tread_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tread_units">
                        @foreach (["cm","in"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('tread_units', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
          
            <div class="col-span-12 md:col-span-6 lg:col-span-6  ">
                <label for="headroom" class="font-s-14 text-blue">{{ $lang['14'] }}:</label>
                <div class="w-100 py-2 position-relative"> 
                    <select name="headroom" id="headroom" class="input">
                        @php
                            $name = [$lang['15'] , $lang['16']];
                            $val = ['1','2'];
                            optionsList($val,$name,isset($_POST['headroom'])?$_POST['headroom']:'1');
                        @endphp    
                </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 headroom1 {{ isset($_POST['headroom']) && $_POST['headroom'] === '2'? 'block':'hidden'}}">
                <label for="h_req" class="font-s-14 text-blue">{{ $lang['17'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="h_req" id="h_req" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['h_req']) ? $_POST['h_req'] : '24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="hr_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hr_units_dropdown')">{{ isset($_POST['hr_units'])?$_POST['hr_units']:'cm' }} ▾</label>
                    <input type="text" name="hr_units" value="{{ isset($_POST['hr_units'])?$_POST['hr_units']:'cm' }}" id="hr_units" class="hidden">
                    <div id="hr_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hr_units">
                        @foreach (["cm","m","in","ft"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('hr_units', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 headroom1 {{ isset($_POST['headroom']) && $_POST['headroom'] === '2' ? 'block':'hidden'}}">
                <label for="f_thickness" class="font-s-14 text-blue">{{ $lang['18'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="f_thickness" id="f_thickness" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_thickness']) ? $_POST['f_thickness'] : '24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="ft_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ft_units_dropdown')">{{ isset($_POST['ft_units'])?$_POST['ft_units']:'cm' }} ▾</label>
                    <input type="text" name="ft_units" value="{{ isset($_POST['ft_units'])?$_POST['ft_units']:'cm' }}" id="ft_units" class="hidden">
                    <div id="ft_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ft_units">
                        @foreach (["cm","m","in","ft"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('ft_units', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 headroom1 {{ isset($_POST['headroom']) && $_POST['headroom'] === '2' ? 'block':'hidden'}}">
                <label for="f_opening" class="font-s-14 text-blue">{{ $lang['19'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="f_opening" id="f_opening" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_opening']) ? $_POST['f_opening'] : '1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="fo_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fo_units_dropdown')">{{ isset($_POST['fo_units'])?$_POST['fo_units']:'cm' }} ▾</label>
                    <input type="text" name="fo_units" value="{{ isset($_POST['fo_units'])?$_POST['fo_units']:'cm' }}" id="fo_units" class="hidden">
                    <div id="fo_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fo_units">
                        @foreach (["cm","m","in","ft"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('fo_units', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="mount" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                <div class="w-100 py-2 position-relative"> 
                    <select name="mount" id="mount" class="input">
                        @php
                            $name = [$lang['21'] , $lang['22']];
                            $val = ['1','2'];
                            optionsList($val,$name,isset($_POST['mount'])?$_POST['mount']:'1');
                        @endphp    
                </select>
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
        {{-- result --}}
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full my-2">
                            <div class="w-full md:w-[80%] lg:w-[80%] lg:text-[18px] md:text-[18px] text-[14px]">
                                <table class="highlight striped div_center">
                                    @if (!empty($detail['inch']))
                                      <tr>
                                        <td width="50%" class="border-b py-2"><strong>{{$lang[5]}}</strong></td>
                                        <td class="border-b py-2">{{$detail['inch']." ".$lang[29]." or ".$detail['inch']*2.54." cm"}}</td>
                                      </tr>
                                    @endif
                                    @if (!empty($detail['run_ans']))
                                      <tr>
                                        <td class="border-b py-2"><strong>{{$lang[3]}}</strong></td>
                                        <td class="border-b py-2">{{$detail['run_ans']." ".$lang[29]." or ".$detail['run_ans']*2.54." cm"}}</td>
                                      </tr>
                                    @endif
                                    @if (!empty($detail['step_ans']))
                                      <tr>
                                        <td class="border-b py-2"><strong>1st {{$lang[7]}}</strong></td>
                                        <td class="border-b py-2">{{$detail['step_ans']." ".$lang[29]." or ".$detail['step_ans']*2.54." cm"}}</td>
                                      </tr>
                                    @endif
                                    @if (!empty($detail['total_run_ans']))
                                      <tr>
                                        <td class="border-b py-2"><strong>{{$lang[2]}}</strong></td>
                                        <td class="border-b py-2">{{$detail['total_run_ans']." ".$lang[29]." or ".$detail['total_run_ans']*2.54." cm"}}</td>
                                      </tr>
                                    @endif
                                    @if (!empty($detail['stair_ans']))
                                      <tr>
                                        <td class="border-b py-2"><strong>{{$lang[23]}}</strong></td>
                                        <td class="border-b py-2">{{$detail['stair_ans']}}</td>
                                      </tr>
                                    @endif
                                    @if (!empty($detail['mount_ans']))
                                      <tr>
                                        <td class="border-b py-2"><strong>{{$lang[24]}}</strong></td>
                                        <td class="border-b py-2">{{$detail['mount_ans']." ".$lang[29]." or ".$detail['mount_ans']*2.54." cm"}}</td>
                                      </tr>
                                    @endif
                                    @if (!empty($detail['str']))
                                      <tr>
                                        <td class="border-b py-2"><strong>{{$lang[25]}}</strong></td>
                                        <td class="border-b py-2">{{$detail['str']." ".$lang[29]." or ".$detail['str']*2.54." cm"}}</td>
                                      </tr>
                                    @endif
                                    @if (!empty($detail['angle_ans']))
                                      <tr>
                                        <td class="border-b py-2"><strong>{{$lang[26]}}</strong></td>
                                        <td class="border-b py-2">{{$detail['angle_ans']."°"." or ".$detail['angle_ans']*0.017." rad"}}</td>
                                      </tr>
                                    @endif
                                    @if (!empty($detail['answ']))
                                      <tr>
                                        <td class="border-b py-2"><strong>{{$lang[14]}}</strong></td>
                                        <td class="border-b py-2">{{$detail['answ']." ".$lang[29]." or ".$detail['answ']*2.54." cm"}}</td>
                                      </tr>
                                    @endif
                                  </table>
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
        document.querySelectorAll('.wed').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('type').value = 'first'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.textChange').forEach(function(hours) {
                    hours.innerHTML = "{{$lang['3']}}:"
                });
                document.querySelectorAll('.rel').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.other').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                });
            })
        });
        document.querySelectorAll('.rel').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('type').value = 'second'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.textChange').forEach(function(hours1) {
                    hours1.innerHTML = "{{$lang['2']}}:"
                });
                document.querySelectorAll('.wed').forEach(function(hours1) {
                    hours1.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.other').forEach(function(hours1) {
                    hours1.classList.remove('tagsUnit')
                });
            })
        });

        var rise_text = document.querySelector('.rise_text');
        var rise_unit = document.querySelector('.rise_unit');
        var tread= document.querySelector('.tread');
        var headroom1 = document.querySelectorAll('.headroom1');

        document.getElementById('rise').addEventListener('change',function(){
            var value = this.value;
            if (value === "1") {
                rise_text.innerHTML = "{{ $lang['9'] }} ({{$lang['7']}}):";
                rise_unit.style.display = "block";
            } else if (value === "2") {
                rise_text.innerHTML = "{{$lang['23']}}:";
                rise_unit.style.display = "none";
            }
        });
        document.getElementById('tread').addEventListener('change',function(){
            var value = this.value;
            if (value === "1") {
                tread.style.display = "none";
            } else if (value === "2") {
                tread.style.display = "block";
            }
        });
        document.getElementById('headroom').addEventListener('change',function(){
            var value = this.value;
            if (value === "1") {
                headroom1.forEach(element => {
                    element.style.display = "none";
                });
            } else if (value === "2") {
                headroom1.forEach(element => {
                    element.style.display = "block";
                });
            }
        });
    </script>
@endpush