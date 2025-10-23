<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="w-full py-2">
                        <select name="operations" id="operations" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[2],$lang[3],$lang[4]];
                                $val = ["1","2","3"];
                                optionsList($val,$name,isset($_POST['operations'])?$_POST['operations'] : '3');
                            @endphp
                        </select>
                    </div>
                </div>
                <p class="col-span-12 text-center my-3 txt" id="math_s">
                    <?=$lang[5]?>
                    <span class="fraction">
                        <span class="num"><?=$lang[6]?></span>
                        <span class="visually-hidden"></span>
                        <span class="den"><?=$lang[7]?></span>
                    </span>
                </p>
                <p class="col-span-12 text-center my-3 txt" id="math_d"> 
                    <span class="fraction">
                        <span class="num"><?=$lang[6]?></span>
                        <span class="visually-hidden"></span>
                        <span class="den"><?=$lang[7]?></span>
                    </span>       
                </p>
                <div class="col-span-6 pehli">
                    <label for="first" class="font-s-14 text-blue" id="txt"><?=$lang[5]?>:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="first" id="first" class="input" aria-label="input" value="{{ isset($_POST['first'])?$_POST['first']:'3' }}" />
                    </div>
                </div>
                <div class="col-span-6 pehli2">
                    <label for="second" class="font-s-14 text-blue r"><?=$lang[6]?>:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="second" id="second" class="input" aria-label="input"  value="{{ isset($_POST['second'])?$_POST['second']: '7' }}" />
                    </div>
                </div>
                <div class="col-span-6 pehli3">
                    <label for="third" class="font-s-14 text-blue r"><?=$lang[7]?>:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="third" id="third" class="input" aria-label="input"  value="{{ isset($_POST['third'])?$_POST['third']: '7' }}" />
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
                            $shape = request()->shape;
                        @endphp
                        <div class="w-full my-2 text-[18px]">
                            <?php
                            $operations = $detail['operations'];
                            if ($operations==1) {
                                ?>
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{$lang['ans']}}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><mathjax class="black-text">  # <?=$_POST['second'].'/'.$_POST['third']?> = <?=round($_POST['third']/$_POST['second'],4)?> # </mathjax></strong></p>
                                </div>
                                </div>
                                <p class="mb-2 text-[18px]"><strong><?=$lang['ex']?>:</strong></p>
                                <p class="text-[18px]"><?=$lang['input']?> :<mathjax class='black-text'>  # <?=$_POST['second'].'/'.$_POST['third']?># </mathjax></p>
                                <p class="text-[18px] mt-2"><?=$lang['step']?> # 1<mathjax> #=(<?=$detail['totalN'].'÷'.$detail['g']?>)/(<?=$detail['totalD'].'÷'.$detail['g']?>)# </mathjax></p>
                                <?php if($detail['btm']=='1'){ ?>
                                    <?php
                                        $xx = explode('.', $detail['upr']);
                                        if (count($xx)==1) {
                                             $upr = $detail['upr'];
                                        }else if (count($xx)==2) {
                                            $upr = number_format($detail['upr'], 3);
                                        } 
                                    ?>
                                    <p class="mt-2"><?=$lang['step']?> # 2 <mathjax> # = <?=$upr?># </mathjax></p>
                                    <table class="col-lg-8 w-full">
                                        <tr>
                                            <td><span> <?=$lang['step']?> # 3 <mathjax> # = <?=$upr.'/'.$detail['btm']?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?=$detail['btm'].'/'.$upr?># </mathjax></span></td>
                                        </tr>
                                        <tr >
                                            <td><span> <?=$lang['step']?> # 4 <mathjax> # = <?=round($detail['btm']/$detail['upr'],4)?># </mathjax></span></td>
                                        </tr>
                                    </table>
                                <?php }else{ ?>
                                    <p class="mt-2"><?=$lang['step']?> # 2 <mathjax> # = <?=$detail['upr'].'/'.$detail['btm']?># </mathjax></p>
                                    <table class="w-full">
                                        <tr>
                                            <td><span> <?=$lang['step']?> # 3 <mathjax> # = <?=$detail['upr'].'/'.$detail['btm']?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?=$detail['btm'].'/'.$detail['upr']?># </mathjax></span></td>
                                        </tr>
                                        <tr >
                                            <td><span> <?=$lang['step']?> # 4 <mathjax> # = <?=round($detail['btm']/$detail['upr'],4)?># </mathjax></span></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                            <?php 
                            }else if ($operations==2) {
                                ?>
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{$lang['ans']}}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><mathjax class="black-text">  # <?=$_POST['first']?> = <?=round($detail['answer'],4)?> # </mathjax></strong></p>
                                </div>
                                </div>
                                <p class="mb-2 text-[18px]"><strong><?=$lang['ex']?>:</strong></p>
                                <p class="text-[18px]"><?=$lang['input']?> :<mathjax class='black-text'>  # <?=$_POST['first']?># </mathjax></p>
                                <p class="text-[18px] mt-2"><?=$lang['step']?> # 1<mathjax> #=(<?=$_POST['first']?>)/1# </mathjax></p>
                                <table class="w-full">
                                    <?php
                                        $yy = explode('.', $_POST['first']);
                                        if (count($yy)==1) {
                                            ?>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 2 <mathjax> # = <?=$_POST['first'].'/'."1"?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?="1".'/'.$_POST['first'] ?># </mathjax></span></td>
                                            </tr>
                                            <tr class="col s12 font_size20">
                                                <td><span> <?=$lang['step']?> # 3 <mathjax> # = <?=round($detail['answer'],4)?># </mathjax></span></td>
                                            </tr>
                                            <?php
                                        }else if (count($yy)==2) {
                                            ?>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 2 <mathjax> # = <?=$_POST['first'].'/'."1"?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?="1".'/'.$_POST['first']?># </mathjax></span></td>
                                            </tr>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 3 <mathjax> # = <?=$detail['upper'].'/'.$detail['lower']?># </mathjax></span></td>
                                            </tr>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 4 <mathjax>  #=(<?=$detail['totalN'].'÷'.$detail['g']?>)/(<?=$detail['totalD'].'÷'.$detail['g']?>)# </mathjax></span></td>
                                            </tr>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 5 <mathjax>  #=(<?=$detail['upr'] ?>)/(<?=$detail['btm']?>)# </mathjax></span></td>
                                            </tr>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 6 <mathjax>  # = <?=round($detail['answer'],4)?># </mathjax></span></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </table>
                                <?php
                            }else if ($operations==3) {
                                ?>
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{$lang['ans']}}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><mathjax class="black-text">  #<?=(isset($_POST['first'])?$_POST['first']:'')?> <?=$_POST['second'].'/'.$_POST['third']?> = <?=round($detail['btm']/$detail['upr'],4)?> # </mathjax></strong></p>
                                </div>
                                </div>
                                <p class="mb-2 text-[18px]"><strong><?=$lang['ex']?>:</strong></p>
                                <p class="text-[18px]"><?=$lang['input']?> :<mathjax class='black-text'>  #<?=(isset($_POST['first'])?$_POST['first']:'')?> <?=$_POST['second'].'/'.$_POST['third']?># </mathjax></p>
                                <p class="text-[18px] mt-2"><?=$lang['step']?> # 1<mathjax> #=(<?=$detail['totalN']?>)/(<?=$detail['totalD']?>)# </mathjax></p>
                                <p class="text-[18px] mt-2"><?=$lang['step']?> # 2<mathjax> #=(<?=$detail['totalN'].'÷'.$detail['g']?>)/(<?=$detail['totalD'].'÷'.$detail['g']?>)# </mathjax></p>
                                <?php if($detail['btm']=='1'){ ?>
                                    <?php
                                        $xx = explode('.', $detail['upr']);
                                        if (count($xx)==1) {
                                             $upr = $detail['upr'];
                                        }else if (count($xx)==2) {
                                            $upr = number_format($detail['upr'], 3);
                                        } 
                                    ?>
                                    <p class="text-[18px] mt-2"><?=$lang['step']?> # 3 <mathjax> # = <?=$upr?># </mathjax></p>
                                    <table class="w-full">
                                        <tr class="mt-2">
                                            <td><span> <?=$lang['step']?> # 4 <mathjax> # = <?=$upr.'/'.$detail['btm']?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?=$detail['btm'].'/'.$upr?># </mathjax></span></td>
                                        </tr>
                                        <tr >
                                            <td><span> <?=$lang['step']?> # 5 <mathjax> # = <?=round($detail['btm']/$detail['upr'],4)?># </mathjax></span></td>
                                        </tr>
                                    </table>
                                <?php }else{ ?>
                                    <p class="text-[18px] mt-2"><?=$lang['step']?> # 3 <mathjax> # = <?=$detail['upr'].'/'.$detail['btm']?># </mathjax></p>
                                    <table class="w-full">
                                        <tr class="mt-2">
                                            <td><span> <?=$lang['step']?> # 4 <mathjax> # = <?=$detail['upr'].'/'.$detail['btm']?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?=$detail['btm'].'/'.$detail['upr']?># </mathjax></span></td>
                                        </tr>
                                        <tr >
                                            <td><span> <?=$lang['step']?> # 5 <mathjax> # = <?=round($detail['btm']/$detail['upr'],4)?># </mathjax></span></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    <script>
        var elements = {
            math_d: document.getElementById('math_d'),
            math_s: document.getElementById('math_s'),
            pehli: document.querySelector('.pehli'),
            pehli2: document.querySelector('.pehli2'),
            pehli3: document.querySelector('.pehli3'),
            txt: document.getElementById('txt')
        };

        function hideElements(selectors) {
            selectors.forEach(selector => {
                if (selector) selector.style.display = 'none';
            });
        }

        function showElements(selectors) {
            selectors.forEach(selector => {
                if (selector) selector.style.display = 'block';
            });
        }
        var unit = document.getElementById('operations').value;
        if(unit=="3"){
            showElements([elements.pehli, elements.pehli2, elements.pehli3, elements.math_s]);
            hideElements([elements.math_d]);
            elements.txt.innerHTML = '<?=$lang[5]?>:';
        }
        document.getElementById('operations').addEventListener('change', function() {
            var cal = this.value;
            switch (cal) {
                case '1':
                    showElements([elements.math_d, elements.pehli2, elements.pehli3]);
                    hideElements([elements.pehli, elements.math_s]);
                    break;
                case '2':
                    showElements([elements.pehli]);
                    hideElements([elements.math_s, elements.math_d, elements.pehli2, elements.pehli3]);
                    elements.txt.innerHTML = '<?=$lang[8]?>:';
                    break;
                case '3':
                    showElements([elements.pehli, elements.pehli2, elements.pehli3, elements.math_s]);
                    hideElements([elements.math_d]);
                    elements.txt.innerHTML = '<?=$lang[5]?>:';
                    break;
            }
        });
        @if(isset($detail))
            switch (unit) {
                case '1':
                    showElements([elements.math_d, elements.pehli2, elements.pehli3]);
                    hideElements([elements.pehli, elements.math_s]);
                    break;
                case '2':
                    showElements([elements.pehli]);
                    hideElements([elements.math_s, elements.math_d, elements.pehli2, elements.pehli3]);
                    elements.txt.innerHTML = '<?=$lang[8]?>:';
                    break;
                case '3':
                    showElements([elements.pehli, elements.pehli2, elements.pehli3, elements.math_s]);
                    hideElements([elements.math_d]);
                    elements.txt.innerHTML = '<?=$lang[5]?>:';
                    break;
            }
        @endif


    </script>
@endpush