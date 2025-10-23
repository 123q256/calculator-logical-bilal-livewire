<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class=" col-span-12">
                <label for="d_units" class="font-s-14 text-blue one_text">{{$lang['1']}}:</label>
                <div class="w-100 py-2">
                    <select name="units" id="d_units" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = ["Centimeters","Feet and Inches"];
                            $val = ["Centimeters","Feet and Inches"];
                            optionsList($val,$name,isset(request()->units)?request()->units:'Centimeters');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 saman2">
                <label for="height" class="font-s-14 text-blue"><?=$lang['2']?> (<?=$lang['3']?>):</label>
                <div class="w-100 py-2 position-relative"> 
                    <select name="height" id="height" class="input">
                        @php
                            $name=["150 cm","151cm","152cm","153cm","154cm","155cm","156cm","157cm","158cm","159cm","160cm","161cm","162cm","163cm","164cm","165cm","166cm","167cm","168cm","169cm","170cm","171cm","172cm","173cm","174cm","175cm","176cm","177cm","178cm","179cm","180cm","181cm","182cm","183cm","184cm","185cm","186cm","187cm","188cm","189cm","190cm","191cm","192cm","193cm","194cm","195cm","196cm","197cm","198cm","199cm","200cm","201cm","202cm","203cm","204cm","205cm"];
                            $val = ["150","151","152","153","154","155","156","157","158","159","160","161","162","163","164","165","166","167","168","169","170","171","172","173","174","175","176","177","178","179","180","181","182","183","184","185","186","187","188","189","190","191","192","193","194","195","196","197","198","199","200","201","202","203","204","205"];
                            optionsList($val,$name,isset(request()->height)?request()->height:'150');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 saman1 hidden">
                <label for="height2" class="font-s-14 text-blue"><?=$lang['2']?> (<?=$lang['3']?>):</label>
                <div class="w-100 py-2 position-relative"> 
                    <select name="height2" id="height2" class="input">
                        @php
                            $name = ["4' 11","4' 11 ½","5","5' ½","5' 1","5' 1½","5' 2","5' 2½","5' 3","5' 3½","5' 4","5' 4½","5' 5","5' 5½","5' 6","5' 6½","5' 7","5' 7½","5' 8","5' 8½","5' 9","5' 9½","5' 10","5' 10½","5' 11","5' 11½","6","6' ½","6' 1","6' 1½","6' 2","6' 2½","6' 3","6' 3½","6' 4","6' 4½","6' 4","6' 5½","6' 6","6' 6½","6' 7","6' 7½","6' 8","6' 8½","6' 9"];
                            $val=["149.86","151.13","152.4","153.67","154.94","156.21","157.48","158.75","160.02","161.29","162.56","163.83","165.1","166.37","167.64","168.91","170.18","171.45","172.72","173.99","175.26","176.53","177.8","179.07","180.34","181.61","182.88","184.15","185.42","186.69","187.96","189.23","190.5","191.77","193.04","194.31","195.58","196.85","198.12","199.39","200.66","201.93","203.2","204.47","205.74"];
                            optionsList($val,$name,isset(request()->height2)?request()->height2:'149.86');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="position" class="font-s-14 text-blue"><?=$lang['4']?> (<?=$lang['5']?>):</label>
                <div class="w-100 py-2 position-relative"> 
                    <select name="position" id="position" class="input">
                        @php
                            $name=[$lang['6'],$lang['7']];
                            $val = ["0","1"];
                            optionsList($val,$name,isset(request()->position)?request()->position:'0');
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
                <div class="w-full mt-3">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-12 md:col-span-8 lg:col-span-8 lg:text-[18px] md:text-[18px] text-[16px]">
                            <?php
                                if($detail['units']=="Centimeters"):
                                    $u="<span class='font_size16 black-text'>cm</span>";
                                else:
                                    $u="<span class='font_size16 black-text'>in</span>";
                                endif;
                            ?>
                            <p class="mt-lg-0 mt-2"><?=$lang['8']?></p>
                            <?php if($detail['position']=="0"): ?>
                                <table class="w-100">
                                    <tr>
                                        <td class="border-b py-2"><strong>* <?=$lang['9']?> : </strong></td>
                                        <td class="border-b py-2"><span><?php echo $detail['ans1'] ?></span> (<?php echo $u ?>)</td>
                                    </tr>
                                </table>
                                <p class="mt-2">
                                    <?=$lang['10']?> 90-110°
                                </p>
                            <?php endif; ?>
                            <table class="w-100">
                                <tr>
                                    <td class="border-b py-2"><strong>* <?=$lang['11']?> : </strong></td>
                                    <td class="border-b py-2"><span> <?php echo $detail['ans2'] ?></span> (<?php echo $u; ?>)</td>
                                </tr>
                            </table>
                            <p class="mt-2">
                                <?php if($detail['position']=="0"){ ?>
                                <?=$lang['12']?> 90-110°. <?=$lang['13']?>.
                                <?php }else if($detail['position']=="1"){ ?>
                                <?=$lang['14']?> 90-110°
                                <?php }?>
                            </p>
                            <table class="w-100">
                                <tr>
                                    <td class="border-b py-2"><strong>* <?=$lang['15']?> :</strong> </td>
                                    <td class="border-b py-2"><span><?php echo $detail['ans3']?></span> (<?php echo $u; ?>)</td>
                                </tr>
                            </table>
                            <p class="mt-2">
                                <?php if($detail['position']=="0" || $detail['position']=="1"){ ?>
                                <?=$lang['16']?>.
                                <?php }?>
                            </p>
                            
                        </div>
                        <div class="col-span-12 md:col-span-4 lg:col-span-4 ps-lg-2 flex items-center">
                                <?php if($detail['position']=="0"){ ?>
                                    <img src="<?=asset('images/desk1.svg')?>" class="img_set responsive sett" width="230px" height="300px">
                                <?php }else{?>
                                    <img src="<?=asset('images/desk2.svg')?>" class="img_set responsive sett" width="200px" height="200px">
                                <?php }?>
                        </div>
                        <p class="mt-2 col-span-12 text-[18px]">
                            <span><strong><?=$lang['17']?> : </strong></span><?=$lang['18']?>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        var saman1 = document.querySelectorAll('.saman1');
        var saman2 = document.querySelectorAll('.saman2');
        document.getElementById('d_units').addEventListener('change',function(){
            var d_units = this.value;
            if(d_units === 'Centimeters'){
                saman1.forEach(element => {
                    element.style.display = "none";
                });
                saman2.forEach(element => {
                    element.style.display = "block";
                });
            }else{
                saman1.forEach(element => {
                    element.style.display = "block";
                });
                saman2.forEach(element => {
                    element.style.display = "none";
                });
            }
        });
        @if(isset($error) || isset($detail))
            var d_units = document.getElementById('d_units').value;
            if(d_units == 'Centimeters'){
                saman1.forEach(element => {
                    element.style.display = "none";
                });
                saman2.forEach(element => {
                    element.style.display = "block";
                });
            }else{
                saman1.forEach(element => {
                    element.style.display = "block";
                });
                saman2.forEach(element => {
                    element.style.display = "none";
                });
            }
        @endif  
    </script>
@endpush