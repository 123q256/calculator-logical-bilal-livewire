<style>
    .inp-set1{
    width:120px;
    float:left;
    position:absolute;
    left:-140px;
    bottom:14px
	}
	.sqr{
    font-size:3em;
    position:absolute;
    left:-22px;
    bottom:0px
  }
	.inp-set2{
    width:58%;
    border-top:2px solid #000;
    padding:5px 0px 0px 5px;
    margin-top:18px;
		float:right;
    position:relative
  }
  .inp-set{
  	width:100% !important
  }
  .t-set{
  	margin-top:15px
  } 

</style>
<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

           <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[80%] w-full">
            <input type="hidden" name="selection" id="calculator_time" value="{{ isset(request()->selection) ? request()->selection : '1' }}">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  {{ isset(request()->selection) && request()->selection !== '1'  ? '' :'tagsUnit' }} pacetab" id="btw_first" onclick="change_tab(tab_val='f_tab')">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab {{ isset(request()->selection) && request()->selection === '2'  ? 'tagsUnit' :'' }}" id="btw_second" onclick="change_tab(tab_val='s_tab')">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
        </div>

            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 inp_wrap mt-2 {{ isset(request()->selection) && request()->selection !== '1'  ? 'hidden' :'block' }}" id="sr">
                    <div class="col-12">
                        <div class="inp-set2 inp-set ">
                            <span class="sqr">√</span>
                            <input type="text" name="n" value="<?=isset($_POST['n'])?$_POST['n']:16?>" class="input">
                        </div>
                    </div>
                </div>
                <div class="col-span-12 inp_wrap1 {{ isset(request()->selection) && request()->selection === '2'  ? 'block' :'hidden' }} mt-2" id="gr">
                    <div class="col-12">
                        <div class="inp-set2">
                            <div class="inp-set1 pt-3 pe-2">
                                <input type="text" name="rt" value="<?=isset($_POST['rt'])?$_POST['rt']:3?>" class="input">
                            </div>
                            <span class="sqr">√</span>
                            <input type="text" name="n1" value="<?=isset($_POST['n1'])?$_POST['n1']:16?>" class="input inp-2">
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
    
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <?php if(isset($detail) ){
                        $result=$detail['result'];
                        $n=request()->n;
                        $n1=request()->n1;
                        $rt=request()->rt;
                        $selection=request()->selection;
                        $num=$detail['num'];
                        $iota=isset($detail['iota']) ? $detail['iota'] : '' ;
                        if(($result - floor($result)) == 0){
                            $ps='Perfect Square';
                        }
                    ?>
                    <div class="w-full text-center text-[18px]">
                        <div class="text-center">
                            <p class="text-[20px]"><strong> <?=($detail['check']=='sr')?$lang['1'].' of '.$n:$lang['2'].' of '.$n1?></strong></p>
                            <div class="flex justify-center">
                            <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"  id="res"><strong class="text-blue"><?=round($result,2)?><?=isset($detail['iota'])?'i':''?></strong></p>
                        </div>
                    </div>
                        <div class="col-12 mt-2">
                            <p class="text-[20px] "><?=$lang['3']?></p>
                            <?php if($detail['check']=='sr'){
                                if(isset($detail['factor'])){
                            ?>
                            <p class="mt-2">
                                √<?=$n?> = <?=$detail['sqr_show']."√".$detail['product']?><?=isset($detail['iota'])?'i':''?>
                            </p>
                            <?php }}elseif($detail['check']=='gr'){ 
                                $root=$detail['root'];
                                ?>
                            <p class="mt-2">
                                <?= "√$n1 = √<span class='res'>$result</span><sup>$root</sup>" . (isset($iota) ? 'i' : '') ?>
                            </p>
                            <?php }if(!isset($detail['factor']) && $detail['check']=='sr'){ ?>
                            <p class="mt-2">
                                √<?=$n?> = √<?=($result)."<sup>2</sup> "?><?=isset($detail['iota'])?'i':''?>
                            </p>
                            <?php } ?>
                            <p class="mt-2">
                                <strong> = <span class="res"><?=$result?><?=isset($detail['iota'])?'i':''?></span></strong>
                            </p>
                            <?php if($detail['check']=='sr'){ ?>
                            <p class="mt-2">
                                <strong><?=isset($ps)?abs($n).' is a perfect square':abs($n).' is not a perfect square'?></strong>
                            </p>
                            <?php } ?>
                        <?php } ?>
            
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
		 function change_tab(element) {
            if (element === "f_tab") {
                document.getElementById("btw_first").classList.add('tagsUnit');
                document.getElementById("btw_second").classList.remove('tagsUnit');
                document.getElementById("sr").style.display = "block";
                document.getElementById("gr").style.display = "none";
                document.querySelector('[name="selection"]').value = "1";
            } else if (element === "s_tab") {
                document.getElementById("btw_second").classList.add('tagsUnit');
                document.getElementById("btw_first").classList.remove('tagsUnit');
                document.getElementById("sr").style.display = "none";
                document.getElementById("gr").style.display = "block";
                document.querySelector('[name="selection"]').value = "2";
            } 
        }
    </script>
    
@endpush