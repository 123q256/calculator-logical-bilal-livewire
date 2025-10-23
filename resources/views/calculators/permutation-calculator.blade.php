<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 px-2">
                    <label for="name" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2">
                        <select name="name" id="name" class="input" autocomplete="off">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'],$lang['3'],$lang['4'],$lang['5']];
                                $val = ['0','1','2','3'];
                                optionsList($val,$name,isset($_POST['name'])?$_POST['name']:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="n" class="label n_text">{{ $lang['6'] }}?</label>
                    <div class="w-full py-2 relative">
                        <input type="number" name="n" id="n" value="{{ isset($_POST['n'])?$_POST['n']:'6' }}" class="input " aria-label="input" placeholder="00" />
                        <span class=" input_unit n_icon">(n)</span>
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="r" class="label r_text">{{ $lang['7'] }}?</label>
                    <div class="w-full py-2 relative">
                        <input type="number" name="r" id="r" value="{{ isset($_POST['r'])?$_POST['r']:'2' }}" class="input " aria-label="input" placeholder="00" />
                        <span class="input_unit n_icon">(r)</span>
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="find" class="label">{{ $lang['12'] }}:</label>
                    <div class="w-full py-2">
                        <select name="find" id="find" class="input">
                            @php
                                $name = [$lang['8'],$lang['9']];
                                $val = ['2','3'];
                                optionsList($val,$name,isset($_POST['find'])?$_POST['find']:'2');
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full">
                        @php
                            $perm=$detail['perm'];
                            $s1=$detail['s1'];
                            $s2=$detail['s2'];
                            $nr=$detail['nr'];
                            $n=$detail['n'];
                            $r=$detail['r'];
                            $find=$detail['find'];
                            $n_fact=$detail['n_fact'];
                            $r_fact=$detail['r_fact'];
                            $nr_fact=$detail['nr_fact'];
                        @endphp 
                        @if (isset($detail['perms']))
                            @php
                                $perms=$detail['perms'];
                            @endphp
                            <div class="text-center mt-4">
                                <p class="text-[22px]"><strong>{{$lang['8']}}</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[30px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $perm }}</strong>
                                </p>
                            </div>
                        </div>
                            @if (isset($detail['show_steps']))
                                <p class="w-full mt-2"><strong><?=$lang['11']?></strong></p>
                                <p class="w-full mt-2">P(n, r) = n! / (n - r)!</p>
                                <p class="w-full mt-2"><strong><?=$lang['12']?> n!</strong></p>
                                <p class="w-full mt-2"><?=$n?>! = <?=$s1?></p>
                                <p class="w-full mt-2"><?=$n?>! = <?=$n_fact?></p>
                                <p class="w-full mt-2"><strong><?=$lang['12']?> (n - r)!</strong></p>
                                <p class="w-full mt-2">(n - r)! = <?='('.$n.'-'.$r.')! = '.$nr?></p>
                                <p class="w-full mt-2"><?=$nr.'! = '.$s2?></p>
                                <p class="w-full mt-2"><?=$nr.'! = '.$nr_fact?></p>
                                <p class="w-full mt-2"><strong><?=$lang['13']?></strong></p>
                                <p class="w-full mt-2">P(n, r) = n! / (n - r)!</p>
                                <p class="w-full mt-2"><?='P('.$n.', '.$r.') = '.$n_fact.' / '.$nr_fact?></p>
                                <p class="w-full mt-2"><strong><?='P('.$n.', '.$r.') = '.$perm?></strong></p>
                            @else
                                <p class="w-full mt-2">P(n, r) = n! / (n - r)!</p>
                                <p class="w-full mt-2"><?='P('.$n.', '.$r.') = '.$n.'! / ('.$n.' - '.$r.')!'?></p>
                                <p class="w-full mt-2"><strong><?='P('.$n.', '.$r.') = '.$perm?></strong></p>
                            @endif
                        @elseif(isset($detail['p_w_r']))
                            @php
                                $p_w_r=$detail['p_w_r'];
                                $perm_rep=$detail['perm_rep'];
                            @endphp
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['9']}}</strong></p>
                                <p class="text-[25px] bg-white px-3 py-2 radius-10 d-inline-block my-3">
                                    <strong class="text-blue">{{ $perm_rep }}</strong>
                                </p>
                            </div>
                            <p class="col-12 mt-3 text-[20px]"><strong class="text-blue"><?=$lang['10']?>:</strong></p>
                            <p class="w-full mt-2"><strong><?=$lang['14']?></strong></p>
                            <p class="w-full mt-2"><span class="text_set">P</span>(n, r) = n<sup>r</sup></p>
                            <p class="w-full mt-2"><strong><?=$lang['12']?> n<sup>r</sup></strong></p>
                            <p class="w-full mt-2"><?=$n."<sup>".$r."</sup> = ".$perm_rep?></p>
                            <p class="w-full mt-2"><strong><?=$lang['13']?></strong></p>
                            <p class="w-full mt-2"><span class="text_set">P</span>(n, r) = n<sup>r</sup></p>
                            <p class="w-full mt-2"><?='<span class="text_set">P</span>('.$n.', '.$r.') = '.$n."<sup>".$r."</sup>"?></p>
                            <p class="w-full mt-2"><strong><?='<span class="text_set">P</span>('.$n.', '.$r.') = '.$perm_rep?></strong></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        let name = document.getElementById('name').value;
        if (name === '0') {
            document.querySelectorAll('.n_text').forEach(function(element) {
                element.textContent = "Types to choose from?";
            });
            document.querySelectorAll('.r_text').forEach(function(element) {
                element.textContent = "Number Chosen?";
            });
        } else if (name === '1') {
            document.querySelectorAll('.n_text').forEach(function(element) {
                element.textContent = "How many different numbers are possible?";
            });
            document.querySelectorAll('.r_text').forEach(function(element) {
                element.textContent = "How many numbers are used?";
            });
        } else if (name === '2') {
            document.querySelectorAll('.n_text').forEach(function(element) {
                element.textContent = "How many different balls can be selected?";
            });
            document.querySelectorAll('.r_text').forEach(function(element) {
                element.textContent = "How many balls do you select?";
            });
        } else {
            document.querySelectorAll('.n_text').forEach(function(element) {
                element.textContent = "How many different Objects are there?";
            });
            document.querySelectorAll('.r_text').forEach(function(element) {
                element.textContent = "How many Objects will you choose?";
            });
        }

        document.getElementById('name').addEventListener('change', function() {
            let name = document.getElementById('name').value;
            if (name === '0') {
                document.querySelectorAll('.n_text').forEach(function(element) {
                    element.textContent = "Types to choose from?";
                });
                document.querySelectorAll('.r_text').forEach(function(element) {
                    element.textContent = "Number Chosen?";
                });
            } else if (name === '1') {
                document.querySelectorAll('.n_text').forEach(function(element) {
                    element.textContent = "How many different numbers are possible?";
                });
                document.querySelectorAll('.r_text').forEach(function(element) {
                    element.textContent = "How many numbers are used?";
                });
            } else if (name === '2') {
                document.querySelectorAll('.n_text').forEach(function(element) {
                    element.textContent = "How many different balls can be selected?";
                });
                document.querySelectorAll('.r_text').forEach(function(element) {
                    element.textContent = "How many balls do you select?";
                });
            } else {
                document.querySelectorAll('.n_text').forEach(function(element) {
                    element.textContent = "How many different Objects are there?";
                });
                document.querySelectorAll('.r_text').forEach(function(element) {
                    element.textContent = "How many Objects will you choose?";
                });
            }
        });

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>