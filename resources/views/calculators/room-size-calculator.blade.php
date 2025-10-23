<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!(isset($detail)))
      
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">
                <div class="col-span-12">
                    <img src="<?= asset('images/room_size.svg') ?>"
                    alt="beam image" class="w-full md:w-[50%] lg:w-[50%]" height="100%" class="set_img">
                </div>
                <div class="col-span-12">
                    <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                        <input type="hidden"  name="name" value="feet" id="h_element">
                        <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  wed {{isset(request()->name)&& request()->name !== 'feet'? '' : 'tagsUnit'}}" id="wed">
                                    {{$lang['2']}}
                                </div>
                            </div>
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white rel {{isset(request()->name)&& request()->name !== 'feet'? 'tagsUnit' : ''}}" id="rel">
                                    {{$lang['1']}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <p class="col-span-12">{{$lang['3']}}</p>
                <div class="col-span-12  round {{isset(request()->name)&& request()->name !== 'feet'? 'hidden' : 'd-block'}}">
                    <div class="grid grid-cols-12 mt-3  gap-2">
                        <div class="col-span-5 md:col-span-2  ">
                            <label for="lenght_f[]" class="label" id="cc_hp1">
                                {{ $lang['4'] }} (ft) :
                            </label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="lenght_f[]" id="lenght_f[]" class="input" aria-label="input"  value="{{ isset($_POST['lenght_f[]'])?$_POST['lenght_f[]']:'7' }}" />
                            </div>
                        </div>
                        <div class="col-span-5 md:col-span-2 ">
                            <label for="lenght_in[]" class="label" id="cc_hp2">
                                {{ $lang['4'] }} (in) :
                            </label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="lenght_in[]" id="lenght_in[]" class="input" aria-label="input"  value="{{ isset($_POST['lenght_in[]'])?$_POST['lenght_in[]']:'4' }}" />
                            </div>
                        </div>
                        <span class="pt-[40px] col-span-1 text-center">x</span>
                        <div class="col-span-5 md:col-span-2  ">
                            <label for="width_f[]" class="label" id="cc_hp1">
                                {{ $lang['5'] }} (ft) :
                            </label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="width_f[]" id="width_f[]" class="input" aria-label="input"  value="{{ isset($_POST['width_f[]'])?$_POST['width_f[]']:'7' }}" />
                            </div>
                        </div>
                        <div class="col-span-5 md:col-span-2 ">
                            <label for="width_in[]" class="label" id="cc_hp2">
                                {{ $lang['5'] }} (in) :
                            </label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="width_in[]" id="width_in[]" class="input" aria-label="input"  value="{{ isset($_POST['width_in[]'])?$_POST['width_in[]']:'4' }}" />
                            </div>
                        </div>
                    </div>
                    <div class="newrow ">
            
                    </div>
                </div>

                <div class="col-span-12 round1 {{isset(request()->name)&& request()->name !== 'feet'? 'd-block' : 'hidden'}} ">
                    <div class="grid grid-cols-12 mt-3  gap-2">
                        <div class="col-span-5 md:col-span-2  ">
                            <label for="lenght_m[]" class="label">
                                {{ $lang['4'] }} (m) :
                            </label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="lenght_m[]" id="lenght_m[]" class="input" aria-label="input"  value="{{ isset($_POST['lenght_m[]'])?$_POST['lenght_m[]']:'7' }}" />
                            </div>
                        </div>
                        <div class="pt-[40px] col-span-1 text-center">x</div>
                        <div class="col-span-5 md:col-span-2  ">
                            <label for="width_m[]" class="label">
                                {{ $lang['5'] }} (m) :
                            </label>
                            <div class="w-100 py-2 position-relative ">
                                <input type="number" step="any" name="width_m[]" id="width_m[]" class="input" aria-label="input"  value="{{ isset($_POST['width_m[]'])?$_POST['width_m[]']:'4' }}" />
                            </div>
                        </div>
                    </div>
                    <div class="meterrow ">
                    </div>
                </div>
                
                <div class="col-span-5 md:col-span-4">
                    <label for="perce" class="label" id="cc_hp2">
                        {{ $lang['6'] }}:
                    </label>
                    <div class="w-100 py-2 position-relative">
                        <select id="perce" name="perce" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = ["0 %","5 %", "10 %","15 %"];
                                $val = ["0", "5","10","15"];
                                optionsList($val,$name,isset($_POST['perce'])?$_POST['perce']:'0');
                            @endphp
                        </select>
                    </div>
                </div>

                <div class="col-span-12 feet_row "  style="display: block;cursor:pointer">
                    <a id="newRow" title="Add Another room"><b><span class="font_size20">+</span> <?= $lang['7']?></b></a>
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
            <div class="rounded-lg  w-full items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full md:w-[70%] g:w-[70%] font-s-18">
                            <?php  if (request()->name == 'feet'){ ?>
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2"><strong> <?= $lang['8']?></strong></td>
                                        <td class="border-b py-2"><?= round($detail['f_r_s'],3) ?> ft²</sup></td>
                                    </tr>
                                    <?php if (request()->perce != 0){ ?>
                                        <tr>
                                            <td class="border-b py-2"><strong><?= $lang['8']?> <?= $lang['9']?>  <?= $detail['perce'] ?>% <?= $lang['10']?> </strong></td>
                                            <td class="border-b py-2"><?= round($detail['perc'],3) ?> ft²</sup></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="border-b py-2"><?= $lang['8']?> (<?= $lang['11']?>)</td>
                                        <td class="border-b py-2"><?= round($detail['f_r_s'] * 144,3) ?> in<sup>2</sup></td>
                                    </tr>
                                    <?php if (request()->perce != 0){ ?>
                                        <tr>
                                            <td class="border-b py-2"><?= $lang['8']?> <?= $lang['10']?> (<?= $lang['11']?>)</td>
                                            <td class="border-b py-2"><?= round($detail['perc'] * 144,3)?> in<sup>2</sup></td>
                                        </tr>
                                    <?php } ?>	
                                    <tr>
                                        <td class="border-b py-2"><?= $lang['8']?> (<?= $lang['12']?>)</td>
                                        <td class="border-b py-2"><?= round($detail['f_r_s'] / 10.764,3)?> m<sup>2</sup></td>
                                    </tr>
                                    <?php if (request()->perce != 0){ ?>
                                        <tr>
                                            <td class="border-b py-2"><?= $lang['8']?> <?= $lang['10']?> (<?= $lang['12']?>)</td>
                                            <td class="border-b py-2"><?= round($detail['perc'] / 10.764,3)?> m<sup>2</sup></td>
                                        </tr>
                                    <?php } ?>
                                </table>    
                            <?php } ?>
            
                            <?php  if (request()->name == 'meter'){ ?>
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2"><strong> <?= $lang['8']?></strong></td>
                                        <td class="border-b py-2"><?= round($detail['m_r_s'],3) ?> ft²</sup></td>
                                    </tr>
                                    <?php if (request()->perce != 0){ ?>
                                        <tr>
                                            <td class="border-b py-2"><strong><?= $lang['8']?> with <?= $detail['perce'] ?>% <?= $lang['10']?> </strong></td>
                                            <td class="border-b py-2"><?= round($detail['perc'],3) ?> m<sup>2</sup></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="border-b py-2"><?= $lang['8']?> </td>
                                        <td class="border-b py-2"><?= round($detail['m_r_s'] * 10.764,3) ?> ft²</td>
                                    </tr>
                                    <?php if (request()->perce != 0){ ?>
                                        <tr>
                                            <td class="border-b py-2"><?= $lang['8']?> <?= $lang['10']?></td>
                                            <td class="border-b py-2"><?= round($detail['perc'] * 10.764,3)?> ft²</td>
                                        </tr>
                                    <?php } ?>	
                                    <tr>
                                        <td class="border-b py-2"><?= $lang['8']?> </td>
                                        <td class="border-b py-2"><?= round($detail['m_r_s'] * 1550,3)?> in<sup>2</sup></td>
                                    </tr>
                                    <?php if (request()->perce != 0){ ?>
                                        <tr>
                                            <td class="border-b py-2"><?= $lang['8']?> <?= $lang['10']?> </td>
                                            <td class="border-b py-2"><?= round($detail['perc'] * 1550,3)?> in<sup>2</sup></td>
                                        </tr>
                                    <?php } ?>
                                </table>    
                            <?php } ?>
                        </div>
                    </div>
                    <div class="w-full text-center mt-[40px]">
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
<script>
	var y = 2;
    document.getElementById("newRow").addEventListener("click", function() {
        var length = document.getElementsByClassName("append").length;
        if (length < 4) {
            var html = 
            `
            <div class="col-span-12  append  {{isset(request()->name)&& request()->name !== 'feet'? 'd-none' : 'd-block'}}">
                 <p class="col-span-12">Area ${y} </p>
                  <div class="grid grid-cols-12 mt-3  gap-2">
                    <div class="col-span-5 md:col-span-2">
                        <label for="lenght_f[]" class="label" id="cc_hp1">
                            {{ $lang['4'] }} (ft) :
                        </label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="lenght_f[]" id="lenght_f[]" class="input" aria-label="input" value="{{ isset($_POST['lenght_f[]'])?$_POST['lenght_f[]']:'7' }}" />
                        </div>
                    </div>
                    <div class="col-span-5 md:col-span-2">
                        <label for="lenght_in[]" class="label" id="cc_hp2">
                            {{ $lang['4'] }} (in) :
                        </label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="lenght_in[]" id="lenght_in[]" class="input" aria-label="input" value="{{ isset($_POST['lenght_in[]'])?$_POST['lenght_in[]']:'4' }}" />
                        </div>
                    </div>
                    <span class="pt-[40px] col-span-1 text-center">x</span>
                    <div class="col-span-5 md:col-span-2">
                        <label for="width_f[]" class="label" id="cc_hp1">
                            {{ $lang['5'] }} (ft) :
                        </label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" name="width_f[]" id="width_f[]" class="input" aria-label="input" value="{{ isset($_POST['width_f[]'])?$_POST['width_f[]']:'7' }}" />
                        </div>
                    </div>
                    <div class="col-span-5 md:col-span-2 relative">
                        <div class="flex justify-between" >
                        <label for="width_in[]" class="label" id="cc_hp2">
                            {{ $lang['5'] }} (in) :
                        </label>
                        <img src="<?=asset('images/close.png')?>" alt="Remove" class="remove right object-contain">
                        </div>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="width_in[]" id="width_in[]" class="input" aria-label="input" value="{{ isset($_POST['width_in[]'])?$_POST['width_in[]']:'4' }}" />
                        </div>
                    </div>
                </div>
            </div>`;
            document.querySelector(".newrow").insertAdjacentHTML('beforeend', html);

            var mhtml = `
            <div class="col-span-12  append1 {{isset(request()->name)&& request()->name !== 'feet'? 'd-block' : 'd-none'}} ">
               <p class="col-span-12">Area ${y} </p>
               <div class="grid grid-cols-12 mt-3  gap-2">
                    <div class="col-span-5 md:col-span-2">
                        <label for="lenght_m[]" class="label">
                            {{ $lang['4'] }} (m) :
                        </label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="lenght_m[]" id="lenght_m[]" class="input" aria-label="input" value="{{ isset($_POST['lenght_m[]'])?$_POST['lenght_m[]']:'7' }}" />
                        </div>
                    </div>
                    <div class="pt-[40px] col-span-1 text-center">x</div>
                    <div class="col-span-5 md:col-span-2 relative">
                        <div class="flex justify-between" >
                        <label for="width_m[]" class="label">
                            {{ $lang['5'] }} (m) :
                        </label>
                        <img src="<?=asset('images/close.png')?>" alt="Remove" class="remove right object-contain">
                        </div>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="width_m[]" id="width_m[]" class="input" aria-label="input" value="{{ isset($_POST['width_m[]'])?$_POST['width_m[]']:'4' }}" />
                        </div>
                    </div
                </div>
            </div>`;
            document.querySelector(".meterrow").insertAdjacentHTML('beforeend', mhtml);
        } else {
            alert('<?=$lang[14]?>');
        }
        y++;
        updateAreaNumbers();
    });
    function updateAreaNumbers() {
        var areaElements = document.querySelectorAll('.newrow p, .meterrow p');
        areaElements.forEach(function(el, index) {
            el.textContent = 'Area ' + (index + 2);
        });
    }
    function updateAreaNumbers() {
        document.querySelectorAll('.append').forEach(function(element, index) {
            var areaNum = index + 2;
            element.querySelector('.area strong').textContent = 'Area ' + areaNum;
        });
        document.querySelectorAll('.append1').forEach(function(element, index) {
            var areaNum = index + 2;
            element.querySelector('.area1 strong').textContent = 'Area ' + areaNum;
        });
    }
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove')) {
            var parentDiv = event.target.closest('.append, .append1');
            var ind = Array.from(parentDiv.parentElement.children).indexOf(parentDiv);

            var newRowElement = document.querySelector('.newrow .append:nth-child(' + (ind + 1) + ')');
            if (newRowElement) {
                newRowElement.remove();
            }

            var meterRowElement = document.querySelector('.meterrow .append1:nth-child(' + (ind + 1) + ')');
            if (meterRowElement) {
                meterRowElement.remove();
            }

            updateAreaNumbers();
        }
    });

    document.querySelectorAll('.wed').forEach(function(element) {
        element.addEventListener('click', function() {
            this.classList.add('tagsUnit');
            document.getElementById('h_element').value = "feet";
            document.querySelectorAll('.rel').forEach(function(element) {
                element.classList.remove('tagsUnit')
            });
            document.querySelectorAll('.round1').forEach(function(element) {
                element.style.display = "none";
            });
            document.querySelectorAll('.round').forEach(function(element) {
                element.style.display = "block";
            });
        });
    });
    document.querySelectorAll('.rel').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit');
                document.getElementById('h_element').value = "meter";
                document.querySelectorAll('.wed').forEach(function(element) {
                    element.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.round1').forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll('.round').forEach(function(element) {
                    element.style.display = "none";
                });
            });
        });
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>