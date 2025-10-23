<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
        <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
            <input type="hidden" name="type" id="type" value="{{ isset($_POST['type'])?$_POST['type']:'whpToHp' }}">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit whpTab" onclick="change_tab('whpToHp')" id="imperial">
                        WHP to HP
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white hpTab"  onclick="change_tab('hpToWhp')" id="metric">
                        HP to WHP
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12 mt-5  gap-4">
                <div class="col-span-12 whpToHp">
                    <div class="grid grid-cols-12">
                        <div class="col-span-12">
                            <label for="whp" class="font-s-14 text-blue">{{ $lang[1] }} (WHP):</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="whp" id="whp" class="input" value="{{ isset($_POST['whp'])?$_POST['whp']:'230' }}" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="dt" class="font-s-14 text-blue">{{ $lang['2'] }} (DL):</label>
                            <div class="w-100 py-2 position-relative">
                                <select name="dt" id="dt" class="input">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                            {!! $arr2[$index] !!}
                                        </option>
                                    @php
                                        }}
                                        $name = [$lang[3],$lang[4],$lang[5]];
                                        $val = [".10",".15",".25"];
                                        optionsList($val,$name,isset($_POST['dt'])?$_POST['dt']:'.10');
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 hpToWhp hidden">
                    <div class="rgrid grid-cols-12ow">
                        <div class="col-span-12">
                            <label for="ehp" class="font-s-14 text-blue">{{ $lang[6] }} (HP):</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="ehp" id="ehp" class="input" value="{{ isset($_POST['ehp'])?$_POST['ehp']:'230' }}" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="dtlf" class="font-s-14 text-blue">{{ $lang['2'] }} (DLTF):</label>
                            <div class="w-100 py-2 position-relative">
                                <select name="dtlf" id="dtlf" class="input">
                                    @php
                                        $name = [$lang[3],$lang[4],$lang[5]];
                                        $val = ["1.1","1.15","1.2"];
                                        optionsList($val,$name,isset($_POST['dtlf'])?$_POST['dtlf']:'1.1');
                                    @endphp
                                </select>
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
                        @if ($detail['submit'] === 'whpToHp')    
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['6']}} (HP)</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] p-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $detail['hp'] }}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="w-full mt-3 text-[18px]"><?=$lang['7']?></p>
                            <p class="w-full mt-2"><?=$lang['8']?> (WHP) = <?= $detail['whp'] ?></p>
                            <p class="w-full mt-2"><?=$lang['9']?> (DL) = 
                                <?php 
                                    if ($detail['dt'] == .10) {
                                        echo "10%";
                                    }
                                    elseif ($detail['dt'] == .15){
                                        echo "15%";
                                    }
                                    else{
                                        echo "25%";
                                    }
                                ?>
                            </p>
                            <p class="w-full mt-3 text-[18px]"><?=$lang['10']?></p>
                            <p class="w-full mt-2">HP = WHP * 1 / (1 – DL )</p>
                            <p class="w-full mt-2">HP = <?= $detail['whp'] ?> * 1 / (1 – <?= $detail['dt'] ?> )</p>
                            <p class="w-full mt-2">HP = <?= $detail['hp'] ?> </p>
                        @else
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['8']}} (WHP)</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] p-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $detail['whp'] }}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="w-full mt-3 text-[18px]"><?=$lang['7']?></p>
                            <p class="w-full mt-2"><?=$lang['6']?> (HP) = <?= $detail['ehp'] ?></p>
                            <p class="w-full mt-2"><?=$lang['9']?> (DTLF) = <?= $detail['dtlf'] ?> </p>
            
                            <p class="w-full mt-3 text-[18px]"><?=$lang['10']?></p>
                            <p class="w-full mt-2">WHP = HP / DTLF</p>
                            <p class="w-full mt-2">WHP = <?= $detail['ehp'] ?> / <?= $detail['dtlf'] ?> </p>
                            <p class="w-full mt-2">WHP = <?= $detail['whp'] ?> </p>
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
        function change_tab(type) {
            const whpToHpElements = document.querySelectorAll('.whpToHp');
            const hpToWhpElements = document.querySelectorAll('.hpToWhp');
            const hpTabElement = document.querySelector('.hpTab');
            const whpTabElement = document.querySelector('.whpTab');
            const typeElement = document.getElementById('type');

            if (type === 'whpToHp') {
                whpToHpElements.forEach(element => element.style.display = 'block');
                hpToWhpElements.forEach(element => element.style.display = 'none');
                hpTabElement.classList.remove('tagsUnit');
                whpTabElement.classList.add('tagsUnit');
                typeElement.value = 'whpToHp';
            } else {
                hpToWhpElements.forEach(element => element.style.display = 'block');
                whpToHpElements.forEach(element => element.style.display = 'none');
                whpTabElement.classList.remove('tagsUnit');
                hpTabElement.classList.add('tagsUnit');
                typeElement.value = 'hpToWhp';
            }
        }
        @if (isset($_POST['type']) && $_POST['type']=='whpToHp')
            change_tab('whpToHp')
        @endif
        @if (isset($_POST['type']) && $_POST['type']=='hpToWhp')
            change_tab('hpToWhp')
        @endif

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>