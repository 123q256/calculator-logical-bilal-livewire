<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2">
                        <label for="type" class="font-s-14 text-blue">{{ $lang['type'] }}:</label>
                        <select class="input" id="type" name="type">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ["2 ".$lang['point'],"3 ". $lang['point'],$lang['sl'],$lang['pl']];
                                $val = ["2P","3P","PS","PL"];
                                optionsList($val,$name,isset($_POST['type'])?$_POST['type']:'2P');
                            @endphp
                        </select>
                    </div>
                    <div class="space-y-2 dimen">
                        <label for="dimen" class="font-s-14 text-blue">{{ $lang['dim'] }} :</label>
                        <select class="input" id="dimen" name="dimen">
                            @php
                               $name = ["1D","2D","3D","4D"];
                                $val = ["1D","2D","3D","4D"];
                                optionsList($val,$name,isset($_POST['dimen'])?$_POST['dimen']:'2D');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1  mt-2 gap-4 twopoint1">
                    <div class="space-y-2">
                        <label for="2px1" class="font-s-14 text-blue"><?=$lang['f_point']?>:</label>
                        <input type="number" class="input" id="2px1" step="any" name="2px1" value="{{ isset($_POST['2px1'])?$_POST['2px1']: '' }}" placeholder="x₁">
                    </div>

                    <div class="space-y-2">
                        <label for="2px2" class="font-s-14 text-blue"><?=$lang['s_point']?>:</label>
                        <input type="number" class="input" id="2px2" step="any" name="2px2" value="{{ isset($_POST['2px2'])?$_POST['2px2']: '' }}" placeholder="x₂">
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 threepoint1">
                    <div class="space-y-2">
                        <label for="3px1" class=" font-s-14 text-blue"><?=$lang['f_point']?>:</label>
                        <input type="number" class="input" id="3px1" step="any" name="3px1" value="{{ isset($_POST['3px1'])?$_POST['3px1']: '' }}" placeholder="x₁">
                    </div>
                    <div class="space-y-2">
                        <label for="3px2" class=" font-s-14 text-blue"><?=$lang['s_point']?>:</label>
                        <input type="number" class="input" id="3px2" step="any" name="3px2" value="{{ isset($_POST['3px2'])?$_POST['3px2']: '' }}" placeholder="x₂">
                    </div>
                    <div class="space-y-2">
                        <label for="3px3" class=" font-s-14 text-blue"><?=$lang['t_point']?>:</label>
                        <input type="number" class="input" id="3px3" step="any" name="3px3" value="{{ isset($_POST['3px3'])?$_POST['3px3']: '' }}" placeholder="x₃">
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 threepoint2d twopoint2d sline">
                    <p class="font-s-14 text-blue py-2"><?=$lang['f_point']?>:</p>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 threepoint2d twopoint2d sline">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="x1" value="{{ isset($_POST['x1'])?$_POST['x1']: '' }}" placeholder="x₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="y1" value="{{ isset($_POST['y1'])?$_POST['y1']: '' }}" placeholder="y₁">
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 sline pline">
                    <p class="font-s-14 text-blue py-2"><?=$lang['line']?> [y = mx + b]:</p>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 sline pline">
                   
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="m" value="{{ isset($_POST['m'])?$_POST['m']: '' }}" placeholder="m">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="b" value="{{ isset($_POST['b'])?$_POST['b']: '' }}" placeholder="b">
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 pline">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['sline']?> [y = m₂x + b₂]:</p>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 pline">
                  
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="m2" value="{{ isset($_POST['m2'])?$_POST['m2']: '' }}" placeholder="m₂">
                    </div>

                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="b2" value="{{ isset($_POST['b2'])?$_POST['b2']: '' }}" placeholder="b₂">
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 twopoint3d">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['f_point']?>:</p>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 twopoint3d">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="3x1" value="{{ isset($_POST['3x1'])?$_POST['3x1']: '' }}" placeholder="x₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="3y1" value="{{ isset($_POST['3y1'])?$_POST['3y1']: '' }}" placeholder="y₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="3z1" value="{{ isset($_POST['3z1'])?$_POST['3z1']: '' }}" placeholder="z₁">
                    </div>
                       
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 twopoint4d">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['f_point']?>:</p>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 twopoint4d">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4x1" value="{{ isset($_POST['4x1'])?$_POST['4x1']: '' }}" placeholder="x₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4y1" value="{{ isset($_POST['4y1'])?$_POST['4y1']: '' }}" placeholder="y₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4z1" value="{{ isset($_POST['4z1'])?$_POST['4z1']: '' }}" placeholder="z₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4k1" value="{{ isset($_POST['4k1'])?$_POST['4k1']: '' }}" placeholder="k₁">
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 twopoint2d">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['s_point']?>:</p>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 twopoint2d">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="x2" value="{{ isset($_POST['x2'])?$_POST['x2']: '' }}" placeholder="x₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="y2" value="{{ isset($_POST['y2'])?$_POST['y2']: '' }}" placeholder="y₂">
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 twopoint3d">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['s_point']?>:</p>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 twopoint3d">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="3x2" value="{{ isset($_POST['3x2'])?$_POST['3x2']: '' }}" placeholder="x₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="3y2" value="{{ isset($_POST['3y2'])?$_POST['3y2']: '' }}" placeholder="y₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="3z2" value="{{ isset($_POST['3z2'])?$_POST['3z2']: '' }}" placeholder="z₂">
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 twopoint4d">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['s_point']?>:</p>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 twopoint4d">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4x2" value="{{ isset($_POST['4x2'])?$_POST['4x2']: '' }}" placeholder="x₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4y2" value="{{ isset($_POST['4y2'])?$_POST['4y2']: '' }}" placeholder="y₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4z2" value="{{ isset($_POST['4z2'])?$_POST['4z2']: '' }}" placeholder="z₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4k2" value="{{ isset($_POST['4k2'])?$_POST['4k2']: '' }}" placeholder="k₂">
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 threepoint2d">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['t_point']?>:</p>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 threepoint2d">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="x3" value="{{ isset($_POST['x3'])?$_POST['x3']: '' }}" placeholder="x₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="y3" value="{{ isset($_POST['y3'])?$_POST['y3']: '' }}" placeholder="y₃">
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 threepoint3d">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['t_point']?>:</p>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 threepoint3d">
                    
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="3x3" value="{{ isset($_POST['3x3'])?$_POST['3x3']: '' }}" placeholder="x₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="3y3" value="{{ isset($_POST['3y3'])?$_POST['3y3']: '' }}" placeholder="x₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="3z3" value="{{ isset($_POST['3z3'])?$_POST['3z3']: '' }}" placeholder="z₃">
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 threepoint4d">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['t_point']?>:</p>
                </div>
                <div class="grid grid-cols-1 mt-2  gap-4 threepoint4d">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4x3" value="{{ isset($_POST['4x3'])?$_POST['4x3']: '' }}" placeholder="x₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4y3" value="{{ isset($_POST['4y3'])?$_POST['4y3']: '' }}" placeholder="x₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4z3" value="{{ isset($_POST['4z3'])?$_POST['4z3']: '' }}" placeholder="z₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" name="4k3" value="{{ isset($_POST['4k3'])?$_POST['4k3']: '' }}" placeholder="k₃">
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

    @if(isset($detail))
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg   items-center justify-center">
                <div class="w-full  bg-light-blue  p-3 radius-10 mt-3">
                    <?php if($_POST['type']=='PS'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=$detail['ans']?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , y₁) = (<?=$_POST['x1']." , ".$_POST['y1']?>)</p>
                        <p class="mt-2">(m , b) = (<?=$_POST['m']." , ".$_POST['b']?>)</p>
                        <p class="mt-2">\[ d = \frac{|(mx1-y1+b)|}{ \sqrt {(m^2 + 1^2) }} \]</p>
                        <p class="mt-2">\[ d = \frac{|(<?=$_POST['m']."*(".$_POST['x1']?>)-(<?=$_POST['y1']?>)+<?=$_POST['b']?>)|}{ \sqrt {(<?=$_POST['m']?>^2 + 1^2) }} \]</p>
                        <p class="mt-2">\[ d = \frac{|(<?=$_POST['m']*$_POST['x1']-$_POST['y1'] + $_POST['b']?>)|}{ \sqrt {<?=pow($_POST['m'],2) + 1?> }} \]</p>
                        <p class="mt-2">\[ d = \frac{<?=abs($_POST['m']*$_POST['x1']-$_POST['y1'] + $_POST['b'])?>}{<?=round(sqrt((pow($_POST['m'],2) + 1)),4)?>} \]</p>
                        <p class="mt-2">\( d = <?=$detail['ans']?> \)</p>
                    <?php } ?>
                    <?php if($_POST['type']=='PL'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=$detail['ans']?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(m₂ , b₂) = (<?=$_POST['m2']." , ".$_POST['b2']?>)</p>
                        <p class="mt-2">(m , b) = (<?=$_POST['m']." , ".$_POST['b']?>)</p>
                        <p class="mt-2">\[ d = \frac{(b₂ - b)}{ \sqrt {(m^2 + 1^2) }} \]</p>
                        <p class="mt-2">\[ d = \frac{<?=$_POST['b2']?>-(<?=$_POST['b']?>)}{ \sqrt {(<?=$_POST['m']?>^2 + 1^2) }} \]</p>
                        <p class="mt-2">\[ d = \frac{<?=$_POST['b2'] - $_POST['b']?>}{ \sqrt {<?=pow($_POST['m'],2) + 1?> }} \]</p>
                        <p class="mt-2">\[ d = \frac{<?=$_POST['b2'] - $_POST['b']?>}{<?=round(sqrt((pow($_POST['m'],2) + 1)),4)?>} \]</p>
                        <p class="mt-2">\( d = <?=$detail['ans']?> \)</p>
                    <?php } ?>
                    <?php if($_POST['type']=='2P' && $_POST['dimen']=='1D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=$detail['ans']?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , x₂) = (<?=$_POST['2px1']." , ".$_POST['2px2']?>)</p>
                        <p class="mt-2">\( d = \sqrt {(x₂ - x₁)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$_POST['2px2']?> - (<?=$_POST['2px1']?>))^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$_POST['2px2']-$_POST['2px1']?>)^2 } \)</p>
                        <p class="mt-2">\( d = <?=$detail['ans']?> \)</p>
                    <?php } ?>
                    <?php if($_POST['type']=='2P' && $_POST['dimen']=='2D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=$detail['ans']?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , x₂) = (<?=$_POST['x1']." , ".$_POST['x2']?>)</p>
                        <p class="mt-2">(y₁ , y₂) = (<?=$_POST['y1']." , ".$_POST['y2']?>)</p>
                        <p class="mt-2">\( d = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$_POST['x2']?> - (<?=$_POST['x1']?>))^2 + (<?=$_POST['y2']?> - (<?=$_POST['y1']?>))^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$_POST['x2']-$_POST['x1']?>)^2 + (<?=$_POST['y2']-$_POST['y1']?>)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=pow(($_POST['x2']-$_POST['x1']),2)?>) + (<?=pow(($_POST['y2']-$_POST['y1']),2)?>) } \)</p>
                        <p class="mt-2">\( d = \sqrt {<?=pow(($_POST['x2']-$_POST['x1']),2) + pow(($_POST['y2']-$_POST['y1']),2)?> } \)</p>
                        <p class="mt-2">\( d = <?=$detail['ans']?> \)</p>
                    <?php } ?>
                    <?php if($_POST['type']=='2P' && $_POST['dimen']=='3D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=$detail['ans']?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , x₂) = (<?=$_POST['3x1']." , ".$_POST['3x2']?>)</p>
                        <p class="mt-2">(y₁ , y₂) = (<?=$_POST['3y1']." , ".$_POST['3y2']?>)</p>
                        <p class="mt-2">(z₁ , z₂) = (<?=$_POST['3z1']." , ".$_POST['3z2']?>)</p>
                        <p class="mt-2">\( d = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 + (z₂ - z₁)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$_POST['3x2']?> - (<?=$_POST['3x1']?>))^2 + (<?=$_POST['3y2']?> - (<?=$_POST['3y1']?>))^2 + (<?=$_POST['3z2']?> - (<?=$_POST['3z1']?>))^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$_POST['3x2']-$_POST['3x1']?>)^2 + (<?=$_POST['3y2']-$_POST['3y1']?>)^2 + (<?=$_POST['3z2']-$_POST['3z1']?>)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=pow(($_POST['3x2']-$_POST['3x1']),2)?>) + (<?=pow(($_POST['3y2']-$_POST['3y1']),2)?>) + (<?=pow(($_POST['3z2']-$_POST['3z1']),2)?>) } \)</p>
                        <p class="mt-2">\( d = \sqrt {<?=pow(($_POST['3x2']-$_POST['3x1']),2) + pow(($_POST['3y2']-$_POST['3y1']),2) + pow(($_POST['3z2']-$_POST['3z1']),2)?> } \)</p>
                        <p class="mt-2">\( d = <?=$detail['ans']?> \)</p>
                    <?php } ?>
                    <?php if($_POST['type']=='2P' && $_POST['dimen']=='4D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=$detail['ans']?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , x₂) = (<?=$_POST['4x1']." , ".$_POST['4x2']?>)</p>
                        <p class="mt-2">(y₁ , y₂) = (<?=$_POST['4y1']." , ".$_POST['4y2']?>)</p>
                        <p class="mt-2">(z₁ , z₂) = (<?=$_POST['4z1']." , ".$_POST['4z2']?>)</p>
                        <p class="mt-2">(k₁ , k₂) = (<?=$_POST['4k1']." , ".$_POST['4k2']?>)</p>
                        <p class="mt-2">\( d = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 + (z₂ - z₁)^2 + (k₂ - k₁)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$_POST['4x2']?> - (<?=$_POST['4x1']?>))^2 + (<?=$_POST['4y2']?> - (<?=$_POST['4y1']?>))^2 + (<?=$_POST['4z2']?> - (<?=$_POST['4z1']?>))^2 + (<?=$_POST['4k2']?> - (<?=$_POST['4k1']?>))^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$_POST['4x2']-$_POST['4x1']?>)^2 + (<?=$_POST['4y2']-$_POST['4y1']?>)^2 + (<?=$_POST['4z2']-$_POST['4z1']?>)^2 + (<?=$_POST['4k2']-$_POST['4k1']?>)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=pow(($_POST['4x2']-$_POST['4x1']),2)?>) + (<?=pow(($_POST['4y2']-$_POST['4y1']),2)?>) + (<?=pow(($_POST['4z2']-$_POST['4z1']),2)?>) + (<?=pow(($_POST['4k2']-$_POST['4k1']),2)?>) } \)</p>
                        <p class="mt-2">\( d = \sqrt {<?=pow(($_POST['4x2']-$_POST['4x1']),2) + pow(($_POST['4y2']-$_POST['4y1']),2) + pow(($_POST['4z2']-$_POST['4z1']),2) + pow(($_POST['4k2']-$_POST['4k1']),2)?> } \)</p>
                        <p class="mt-2">\( d = <?=$detail['ans']?> \)</p>
                    <?php } ?>
                    <?php if($_POST['type']=='3P' && $_POST['dimen']=='1D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?>(1-2) = <strong class="text-blue"><?=$detail['ans1']?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(3-2) = <strong class="text-blue"><?=$detail['ans2']?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(1-3) = <strong class="text-blue"><?=$detail['ans3']?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , x₂ , x₃) = (<?=$_POST['3px1']." , ".$_POST['3px2']." , ".$_POST['3px3']?>)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(x₂ - x₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$_POST['3px2']?> - (<?=$_POST['3px1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$_POST['3px2']-$_POST['3px1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = <?=$detail['ans1']?> \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(x₃ - x₂)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$_POST['3px3']?> - (<?=$_POST['3px2']?>))^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$_POST['3px3']-$_POST['3px2']?>)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = <?=$detail['ans2']?> \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(x₃ - x₂)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$_POST['3px3']?> - (<?=$_POST['3px1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$_POST['3px3']-$_POST['3px1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = <?=$detail['ans3']?> \)</p>
                    <?php } ?>
                    <?php if($_POST['type']=='3P' && $_POST['dimen']=='2D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?>(1-2) = <strong class="text-blue"><?=$detail['ans1']?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(3-2) = <strong class="text-blue"><?=$detail['ans2']?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(1-3) = <strong class="text-blue"><?=$detail['ans3']?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , y₁) = (<?=$_POST['x1']." , ".$_POST['y1']?>)</p>
                        <p class="mt-2">(x₂ , y₂) = (<?=$_POST['x2']." , ".$_POST['y2']?>)</p>
                        <p class="mt-2">(x₃ , y₃) = (<?=$_POST['x3']." , ".$_POST['y3']?>)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$_POST['x2']?> - (<?=$_POST['x1']?>))^2 + <?=$_POST['y2']?> - (<?=$_POST['y1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$_POST['x2']-$_POST['x1']?>)^2 + (<?=$_POST['y2']-$_POST['y1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($_POST['x2']-$_POST['x1']),2)?>) + (<?=pow(($_POST['y2']-$_POST['y1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($_POST['x2']-$_POST['x1']),2) + pow(($_POST['y2']-$_POST['y1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = <?=$detail['ans1']?> \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(x₃ - x₂)^2 + (x₃ - y₂)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$_POST['x3']?> - (<?=$_POST['x2']?>))^2 + <?=$_POST['y3']?> - (<?=$_POST['y2']?>))^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$_POST['x3']-$_POST['x2']?>)^2 + (<?=$_POST['y3']-$_POST['y2']?>)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($_POST['x3']-$_POST['x2']),2)?>) + (<?=pow(($_POST['y3']-$_POST['y2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($_POST['x3']-$_POST['x2']),2) + pow(($_POST['y3']-$_POST['y2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = <?=$detail['ans2']?> \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(x₃ - x₁)^2 + (y₃ - y₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$_POST['x3']?> - (<?=$_POST['x1']?>))^2 + <?=$_POST['y3']?> - (<?=$_POST['y1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$_POST['x3']-$_POST['x1']?>)^2 + (<?=$_POST['y3']-$_POST['y1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($_POST['x3']-$_POST['x1']),2)?>) + (<?=pow(($_POST['y3']-$_POST['y1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($_POST['x3']-$_POST['x1']),2) + pow(($_POST['y3']-$_POST['y1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = <?=$detail['ans3']?> \)</p>
                    <?php } ?>
                    <?php if($_POST['type']=='3P' && $_POST['dimen']=='3D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?>(1-2) = <strong class="text-blue"><?=$detail['ans1']?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(3-2) = <strong class="text-blue"><?=$detail['ans2']?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(1-3) = <strong class="text-blue"><?=$detail['ans3']?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , y₁ , z₁) = (<?=$_POST['3x1']." , ".$_POST['3y1']." , ".$_POST['3z1']?>)</p>
                        <p class="mt-2">(x₂ , y₂ , z₂) = (<?=$_POST['3x2']." , ".$_POST['3y2']." , ".$_POST['3z2']?>)</p>
                        <p class="mt-2">(x₃ , y₃ , z₃) = (<?=$_POST['3x3']." , ".$_POST['3y3']." , ".$_POST['3z3']?>)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 + (z₂ - z₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$_POST['3x2']?> - (<?=$_POST['3x1']?>))^2 + <?=$_POST['3y2']?> - (<?=$_POST['3y1']?>))^2 + <?=$_POST['3z2']?> - (<?=$_POST['3z1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$_POST['3x2']-$_POST['3x1']?>)^2 + (<?=$_POST['3y2']-$_POST['3y1']?>)^2 + (<?=$_POST['3z2']-$_POST['3z1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($_POST['3x2']-$_POST['3x1']),2)?>) + (<?=pow(($_POST['3y2']-$_POST['3y1']),2)?>) + (<?=pow(($_POST['3z2']-$_POST['3z1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($_POST['3x2']-$_POST['3x1']),2) + pow(($_POST['3y2']-$_POST['3y1']),2) + pow(($_POST['3z2']-$_POST['3z1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = <?=$detail['ans1']?> \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(x₃ - x₂)^2 + (x₃ - y₂)^2 + (z₃ - z₂)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$_POST['3x3']?> - (<?=$_POST['3x2']?>))^2 + <?=$_POST['3y3']?> - (<?=$_POST['3y2']?>))^2 + <?=$_POST['3z3']?> - (<?=$_POST['3z2']?>))^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$_POST['3x3']-$_POST['3x2']?>)^2 + (<?=$_POST['3y3']-$_POST['3y2']?>)^2 + (<?=$_POST['3z3']-$_POST['3z2']?>)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($_POST['3x3']-$_POST['3x2']),2)?>) + (<?=pow(($_POST['3y3']-$_POST['3y2']),2)?>) + (<?=pow(($_POST['3z3']-$_POST['3z2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($_POST['3x3']-$_POST['3x2']),2) + pow(($_POST['3y3']-$_POST['3y2']),2) + pow(($_POST['3z3']-$_POST['3z2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = <?=$detail['ans2']?> \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(x₃ - x₁)^2 + (y₃ - y₁)^2 + (z₃ - z₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$_POST['3x3']?> - (<?=$_POST['3x1']?>))^2 + <?=$_POST['3y3']?> - (<?=$_POST['3y1']?>))^2 + <?=$_POST['3z3']?> - (<?=$_POST['3z1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$_POST['3x3']-$_POST['3x1']?>)^2 + (<?=$_POST['3y3']-$_POST['3y1']?>)^2 + (<?=$_POST['3z3']-$_POST['3z1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($_POST['3x3']-$_POST['3x1']),2)?>) + (<?=pow(($_POST['3y3']-$_POST['3y1']),2)?>) + (<?=pow(($_POST['3z3']-$_POST['3z1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($_POST['3x3']-$_POST['3x1']),2) + pow(($_POST['3y3']-$_POST['3y1']),2) + pow(($_POST['3z3']-$_POST['3z1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = <?=$detail['ans3']?> \)</p>
                    <?php } ?>
                    <?php if($_POST['type']=='3P' && $_POST['dimen']=='4D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?>(1-2) = <strong class="text-blue"><?=$detail['ans1']?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(3-2) = <strong class="text-blue"><?=$detail['ans2']?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(1-3) = <strong class="text-blue"><?=$detail['ans3']?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , y₁ , z₁ , k₁) = (<?=$_POST['4x1']." , ".$_POST['4y1']." , ".$_POST['4k1']." , ".$_POST['4k1']?>)</p>
                        <p class="mt-2">(x₂ , y₂ , z₂ , k₂) = (<?=$_POST['4x2']." , ".$_POST['4y2']." , ".$_POST['4z2']." , ".$_POST['4k2']?>)</p>
                        <p class="mt-2">(x₃ , y₃ , z₃ , k₃) = (<?=$_POST['4x3']." , ".$_POST['4y3']." , ".$_POST['4z3']." , ".$_POST['4k3']?>)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 + (z₂ - z₁)^2 + (k₂ - k₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$_POST['4x2']?> - (<?=$_POST['4x1']?>))^2 + <?=$_POST['4y2']?> - (<?=$_POST['4y1']?>))^2 + <?=$_POST['4z2']?> - (<?=$_POST['4z1']?>))^2 + <?=$_POST['4k2']?> - (<?=$_POST['4k1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$_POST['4x2']-$_POST['4x1']?>)^2 + (<?=$_POST['4y2']-$_POST['4y1']?>)^2 + (<?=$_POST['4z2']-$_POST['4z1']?>)^2 + (<?=$_POST['4k2']-$_POST['4k1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($_POST['4x2']-$_POST['4x1']),2)?>) + (<?=pow(($_POST['4y2']-$_POST['4y1']),2)?>) + (<?=pow(($_POST['4z2']-$_POST['4z1']),2)?>) + (<?=pow(($_POST['4k2']-$_POST['4k1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($_POST['4x2']-$_POST['4x1']),2) + pow(($_POST['4y2']-$_POST['4y1']),2) + pow(($_POST['4z2']-$_POST['4z1']),2) + pow(($_POST['4k2']-$_POST['4k1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = <?=$detail['ans1']?> \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(x₃ - x₂)^2 + (x₃ - y₂)^2 + (z₃ - z₂)^2 + (k₃ - k₂)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$_POST['4x3']?> - (<?=$_POST['4x2']?>))^2 + <?=$_POST['4y3']?> - (<?=$_POST['4y2']?>))^2 + <?=$_POST['4z3']?> - (<?=$_POST['4z2']?>))^2 + <?=$_POST['4k3']?> - (<?=$_POST['4k2']?>))^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$_POST['4x3']-$_POST['4x2']?>)^2 + (<?=$_POST['4y3']-$_POST['4y2']?>)^2 + (<?=$_POST['4z3']-$_POST['4z2']?>)^2 + (<?=$_POST['4k3']-$_POST['4k2']?>)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($_POST['4x3']-$_POST['4x2']),2)?>) + (<?=pow(($_POST['4y3']-$_POST['4y2']),2)?>) + (<?=pow(($_POST['4z3']-$_POST['4z2']),2)?>) + (<?=pow(($_POST['4k3']-$_POST['4k2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($_POST['4x3']-$_POST['4x2']),2) + pow(($_POST['4y3']-$_POST['4y2']),2) + pow(($_POST['4z3']-$_POST['4z2']),2) + pow(($_POST['4k3']-$_POST['4k2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = <?=$detail['ans2']?> \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(x₃ - x₁)^2 + (y₃ - y₁)^2 + (z₃ - z₁)^2 + (k₃ - k₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$_POST['4x3']?> - (<?=$_POST['4x1']?>))^2 + <?=$_POST['4y3']?> - (<?=$_POST['4y1']?>))^2 + <?=$_POST['4z3']?> - (<?=$_POST['4z1']?>))^2 + <?=$_POST['4k3']?> - (<?=$_POST['4k1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$_POST['4x3']-$_POST['4x1']?>)^2 + (<?=$_POST['4y3']-$_POST['4y1']?>)^2 + (<?=$_POST['4z3']-$_POST['4z1']?>)^2 + (<?=$_POST['4k3']-$_POST['4k1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($_POST['4x3']-$_POST['4x1']),2)?>) + (<?=pow(($_POST['4y3']-$_POST['4y1']),2)?>) + (<?=pow(($_POST['4z3']-$_POST['4z1']),2)?>) + (<?=pow(($_POST['4k3']-$_POST['4k1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($_POST['4x3']-$_POST['4x1']),2) + pow(($_POST['4y3']-$_POST['4y1']),2) + pow(($_POST['4z3']-$_POST['4z1']),2) + pow(($_POST['4k3']-$_POST['4k1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = <?=$detail['ans3']?> \)</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" async
            src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML">
        </script>
    @endif
</form>
<script>
        var type = document.getElementById('type').value;
        var dimen = document.getElementById('dimen').value;
        if (type === '2P' && dimen === '2D') {
            var elementsToHide = [
                '.twopoint3d', '.twopoint4d', '.pline', '.sline',
                '.threepoint2d', '.threepoint3d', '.threepoint4d',
                '.twopoint1', '.threepoint1'
            ];

            elementsToHide.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.style.display = 'none';
                });
            });

            document.querySelectorAll('.twopoint2d').forEach(function(element) {
                element.style.display = 'flex';
            });
        }

        @if(isset($detail) || isset($error))
            var type = document.getElementById('type').value;
            var dimen = document.getElementById('dimen').value;

            var dimenInputs = document.querySelectorAll('.dimen input');
            if (type === '2P' || type === '3P') {
                dimenInputs.forEach(function(input) {
                    input.removeAttribute('disabled');
                    input.style.cursor = 'pointer';
                });
            } else if (type === 'PS' || type === 'PL') {
                dimenInputs.forEach(function(input) {
                    input.setAttribute('disabled', 'disabled');
                    input.style.cursor = 'not-allowed';
                });
            }

            var elementsToHide = [
                '.twopoint2d', '.twopoint3d', '.twopoint4d', '.pline', '.sline',
                '.threepoint2d', '.threepoint3d', '.threepoint4d', '.twopoint1', '.threepoint1'
            ];
            elementsToHide.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.style.display = 'none';
                });
            });

            if (type === 'PS') {
                document.querySelectorAll('.sline').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === 'PL') {
                document.querySelectorAll('.pline').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '1D') {
                document.querySelectorAll('.twopoint1').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '2D') {
                document.querySelectorAll('.twopoint2d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '3D') {
                document.querySelectorAll('.twopoint3d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '4D') {
                document.querySelectorAll('.twopoint4d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '1D') {
                document.querySelectorAll('.threepoint1').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '2D') {
                document.querySelectorAll('.threepoint2d, .twopoint2d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '3D') {
                document.querySelectorAll('.threepoint3d, .twopoint3d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '4D') {
                document.querySelectorAll('.threepoint4d, .twopoint4d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            }
        @endif

        document.getElementById('type').addEventListener('change', function() {
            var type = document.getElementById('type').value;
            // var dimenInputs = document.getElementById('dimen');
            var dimen = document.getElementById('dimen').value;

            var dimenInputs = document.querySelectorAll('.dimen select');
            if (type === '2P' || type === '3P') {
                dimenInputs.forEach(function(input) {
                    input.removeAttribute('disabled');
                    input.style.cursor = 'pointer';
                });
            } else if (type === 'PS' || type === 'PL') {
                dimenInputs.forEach(function(input) {
                    input.setAttribute('disabled', 'disabled');
                    input.style.cursor = 'not-allowed';
                });
            }

            var elementsToHide = [
                '.twopoint2d', '.twopoint3d', '.twopoint4d', '.pline', '.sline',
                '.threepoint2d', '.threepoint3d', '.threepoint4d', '.twopoint1', '.threepoint1'
            ];
            elementsToHide.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.style.display = 'none';
                });
            });

            if (type === 'PS') {
                document.querySelectorAll('.sline').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === 'PL') {
                document.querySelectorAll('.pline').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '1D') {
                document.querySelectorAll('.twopoint1').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '2D') {
                document.querySelectorAll('.twopoint2d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '3D') {
                document.querySelectorAll('.twopoint3d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '4D') {
                document.querySelectorAll('.twopoint4d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '1D') {
                document.querySelectorAll('.threepoint1').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '2D') {
                document.querySelectorAll('.threepoint2d, .twopoint2d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '3D') {
                document.querySelectorAll('.threepoint3d, .twopoint3d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '4D') {
                document.querySelectorAll('.threepoint4d, .twopoint4d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            }
        });

        document.getElementById('dimen').addEventListener('change', function() {
            var type = document.getElementById('type').value;
            var dimen = document.getElementById('dimen').value;

            var dimenInputs = document.querySelectorAll('.dimen input');
            if (type === '2P' || type === '3P') {
                dimenInputs.forEach(function(input) {
                    input.removeAttribute('disabled');
                    input.style.cursor = 'pointer';
                });
            } else if (type === 'PS' || type === 'PL') {
                dimenInputs.forEach(function(input) {
                    input.setAttribute('disabled', 'disabled');
                    input.style.cursor = 'not-allowed';
                });
            }

            var elementsToHide = [
                '.twopoint2d', '.twopoint3d', '.twopoint4d', '.pline', '.sline',
                '.threepoint2d', '.threepoint3d', '.threepoint4d', '.twopoint1', '.threepoint1'
            ];
            elementsToHide.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.style.display = 'none';
                });
            });

            if (type === 'PS') {
                document.querySelectorAll('.sline').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === 'PL') {
                document.querySelectorAll('.pline').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '1D') {
                document.querySelectorAll('.twopoint1').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '2D') {
                document.querySelectorAll('.twopoint2d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '3D') {
                document.querySelectorAll('.twopoint3d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '2P' && dimen === '4D') {
                document.querySelectorAll('.twopoint4d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '1D') {
                document.querySelectorAll('.threepoint1').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '2D') {
                document.querySelectorAll('.threepoint2d, .twopoint2d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '3D') {
                document.querySelectorAll('.threepoint3d, .twopoint3d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            } else if (type === '3P' && dimen === '4D') {
                document.querySelectorAll('.threepoint4d, .twopoint4d').forEach(function(element) {
                    element.style.display = 'flex';
                });
            }
        });



</script>