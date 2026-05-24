<div>
    
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3" x-data="{ type: @entangle('data.type').live, dimen: @entangle('data.dimen').live }">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2">
                        <label for="type" class="font-s-14 text-blue">{{ $lang['type'] }}:</label>
                        <select class="input" id="type" wire:model.live="data.type">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}">
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ["2 ".$lang['point'],"3 ". $lang['point'],$lang['sl'],$lang['pl']];
                                $val = ["2P","3P","PS","PL"];
                                optionsList($val,$name,$data['type']);
                            @endphp
                        </select>
                    </div>
                    <div class="space-y-2 dimen">
                        <label for="dimen" class="font-s-14 text-blue">{{ $lang['dim'] }} :</label>
                        <select class="input" id="dimen" wire:model.live="data.dimen" x-bind:disabled="type === 'PS' || type === 'PL'">
                            @php
                               $name = ["1D","2D","3D","4D"];
                                $val = ["1D","2D","3D","4D"];
                                optionsList($val,$name,$data['dimen']);
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2 gap-4 twopoint1" x-show="type === '2P' && dimen === '1D'" style="{{ ($data['type'] === '2P' && $data['dimen'] === '1D') ? '' : 'display: none;' }}">
                    <div class="space-y-2">
                        <label for="2px1" class="font-s-14 text-blue"><?=$lang['f_point']?>:</label>
                        <input type="number" class="input" id="2px1" step="any" wire:model="data.2px1"  placeholder="x₁">
                    </div>

                    <div class="space-y-2">
                        <label for="2px2" class="font-s-14 text-blue"><?=$lang['s_point']?>:</label>
                        <input type="number" class="input" id="2px2" step="any" wire:model="data.2px2"  placeholder="x₂">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 threepoint1" x-show="type === '3P' && dimen === '1D'" style="{{ ($data['type'] === '3P' && $data['dimen'] === '1D') ? '' : 'display: none;' }}">
                    <div class="space-y-2">
                        <label for="3px1" class=" font-s-14 text-blue"><?=$lang['f_point']?>:</label>
                        <input type="number" class="input" id="3px1" step="any" wire:model="data.3px1"  placeholder="x₁">
                    </div>
                    <div class="space-y-2">
                        <label for="3px2" class=" font-s-14 text-blue"><?=$lang['s_point']?>:</label>
                        <input type="number" class="input" id="3px2" step="any" wire:model="data.3px2"  placeholder="x₂">
                    </div>
                    <div class="space-y-2">
                        <label for="3px3" class=" font-s-14 text-blue"><?=$lang['t_point']?>:</label>
                        <input type="number" class="input" id="3px3" step="any" wire:model="data.3px3"  placeholder="x₃">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 threepoint2d twopoint2d sline" x-show="((type === '2P' || type === '3P') && dimen === '2D') || type === 'PS'" style="{{ ((($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '2D') || $data['type'] === 'PS') ? '' : 'display: none;' }}">
                    <p class="font-s-14 text-blue py-2"><?=$lang['f_point']?>:</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 threepoint2d twopoint2d sline" x-show="((type === '2P' || type === '3P') && dimen === '2D') || type === 'PS'" style="{{ ((($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '2D') || $data['type'] === 'PS') ? '' : 'display: none;' }}">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.x1"  placeholder="x₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.y1"  placeholder="y₁">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 sline pline" x-show="type === 'PS' || type === 'PL'" style="{{ ($data['type'] === 'PS' || $data['type'] === 'PL') ? '' : 'display: none;' }}">
                    <p class="font-s-14 text-blue py-2"><?=$lang['line']?> [y = mx + b]:</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 sline pline" x-show="type === 'PS' || type === 'PL'" style="{{ ($data['type'] === 'PS' || $data['type'] === 'PL') ? '' : 'display: none;' }}">
                   
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.m"  placeholder="m">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.b"  placeholder="b">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 pline" x-show="type === 'PL'" style="{{ ($data['type'] === 'PL') ? '' : 'display: none;' }}">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['sline']?> [y = m₂x + b₂]:</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 pline" x-show="type === 'PL'" style="{{ ($data['type'] === 'PL') ? '' : 'display: none;' }}">
                  
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.m2"  placeholder="m₂">
                    </div>

                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.b2"  placeholder="b₂">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 twopoint3d" x-show="((type === '2P' || type === '3P') && dimen === '3D')" style="{{ (($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '3D') ? '' : 'display: none;' }}">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['f_point']?>:</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 twopoint3d" x-show="((type === '2P' || type === '3P') && dimen === '3D')" style="{{ (($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '3D') ? '' : 'display: none;' }}">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.3x1"  placeholder="x₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.3y1"  placeholder="y₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.3z1"  placeholder="z₁">
                    </div>
                       
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 twopoint4d" x-show="((type === '2P' || type === '3P') && dimen === '4D')" style="{{ (($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '4D') ? '' : 'display: none;' }}">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['f_point']?>:</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 twopoint4d" x-show="((type === '2P' || type === '3P') && dimen === '4D')" style="{{ (($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '4D') ? '' : 'display: none;' }}">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4x1"  placeholder="x₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4y1"  placeholder="y₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4z1"  placeholder="z₁">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4k1"  placeholder="k₁">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 twopoint2d" x-show="((type === '2P' || type === '3P') && dimen === '2D')" style="{{ (($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '2D') ? '' : 'display: none;' }}">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['s_point']?>:</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 twopoint2d" x-show="((type === '2P' || type === '3P') && dimen === '2D')" style="{{ (($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '2D') ? '' : 'display: none;' }}">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.x2"  placeholder="x₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.y2"  placeholder="y₂">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 twopoint3d" x-show="((type === '2P' || type === '3P') && dimen === '3D')" style="{{ (($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '3D') ? '' : 'display: none;' }}">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['s_point']?>:</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 twopoint3d" x-show="((type === '2P' || type === '3P') && dimen === '3D')" style="{{ (($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '3D') ? '' : 'display: none;' }}">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.3x2"  placeholder="x₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.3y2"  placeholder="y₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.3z2"  placeholder="z₂">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 twopoint4d" x-show="((type === '2P' || type === '3P') && dimen === '4D')" style="{{ (($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '4D') ? '' : 'display: none;' }}">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['s_point']?>:</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 twopoint4d" x-show="((type === '2P' || type === '3P') && dimen === '4D')" style="{{ (($data['type'] === '2P' || $data['type'] === '3P') && $data['dimen'] === '4D') ? '' : 'display: none;' }}">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4x2"  placeholder="x₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4y2"  placeholder="y₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4z2"  placeholder="z₂">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4k2"  placeholder="k₂">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 threepoint2d" x-show="type === '3P' && dimen === '2D'" style="{{ ($data['type'] === '3P' && $data['dimen'] === '2D') ? '' : 'display: none;' }}">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['t_point']?>:</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 threepoint2d" x-show="type === '3P' && dimen === '2D'" style="{{ ($data['type'] === '3P' && $data['dimen'] === '2D') ? '' : 'display: none;' }}">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.x3"  placeholder="x₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.y3"  placeholder="y₃">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 threepoint3d" x-show="type === '3P' && dimen === '3D'" style="{{ ($data['type'] === '3P' && $data['dimen'] === '3D') ? '' : 'display: none;' }}">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['t_point']?>:</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 threepoint3d" x-show="type === '3P' && dimen === '3D'" style="{{ ($data['type'] === '3P' && $data['dimen'] === '3D') ? '' : 'display: none;' }}">
                    
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.3x3"  placeholder="x₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.3y3"  placeholder="x₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.3z3"  placeholder="z₃">
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 threepoint4d" x-show="type === '3P' && dimen === '4D'" style="{{ ($data['type'] === '3P' && $data['dimen'] === '4D') ? '' : 'display: none;' }}">
                    <p class="py-2 font-s-14 text-blue"><?=$lang['t_point']?>:</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2 mt-2  gap-4 threepoint4d" x-show="type === '3P' && dimen === '4D'" style="{{ ($data['type'] === '3P' && $data['dimen'] === '4D') ? '' : 'display: none;' }}">
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4x3"  placeholder="x₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4y3"  placeholder="x₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4z3"  placeholder="z₃">
                    </div>
                    <div class="space-y-2">
                        <input type="number" class="input" step="any" wire:model="data.4k3"  placeholder="k₃">
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
    @php
        if (!function_exists('safe_round')) {
            function safe_round($val, $precision = 5) {
                if ($val === 'NAN' || $val === 'NaN' || (is_numeric($val) && is_nan((float)$val))) {
                    return 'NAN';
                }
                if ($val === 'INF' || $val === 'INF' || $val === 'infinity' || $val === 'Infinity' || (is_numeric($val) && is_infinite((float)$val))) {
                    return 'INF';
                }
                return is_numeric($val) ? round((float)$val, $precision) : $val;
            }
        }
    @endphp
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg   items-center justify-center">
                <div class="w-full  bg-light-blue  p-3 radius-10 mt-3">
                    <?php if($data['type']=='PS'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=safe_round($detail['ans'])?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , y₁) = (<?=$data['x1']." , ".$data['y1']?>)</p>
                        <p class="mt-2">(m , b) = (<?=$data['m']." , ".$data['b']?>)</p>
                        <p class="mt-2">\( d = \frac{|(mx1-y1+b)|}{ \sqrt {(m^2 + 1^2) }} \)</p>
                        <p class="mt-2">\( d = \frac{|(<?=$data['m']."*(".$data['x1']?>)-(<?=$data['y1']?>)+<?=$data['b']?>)|}{ \sqrt {(<?=$data['m']?>^2 + 1^2) }} \)</p>
                        <p class="mt-2">\( d = \frac{|(<?=$data['m']*$data['x1']-$data['y1'] + $data['b']?>)|}{ \sqrt {<?=pow($data['m'],2) + 1?> }} \)</p>
                        <p class="mt-2">\( d = \frac{<?=abs($data['m']*$data['x1']-$data['y1'] + $data['b'])?>}{<?=round(sqrt((pow($data['m'],2) + 1)),4)?>} \)</p>
                        <p class="mt-2">\( d = <?=safe_round($detail['ans'])?> \)</p>
                    <?php } ?>
                    <?php if($data['type']=='PL'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=safe_round($detail['ans'])?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(m₂ , b₂) = (<?=$data['m2']." , ".$data['b2']?>)</p>
                        <p class="mt-2">(m , b) = (<?=$data['m']." , ".$data['b']?>)</p>
                        <p class="mt-2">\( d = \frac{(b₂ - b)}{ \sqrt {(m^2 + 1^2) }} \)</p>
                        <p class="mt-2">\( d = \frac{<?=$data['b2']?>-(<?=$data['b']?>)}{ \sqrt {(<?=$data['m']?>^2 + 1^2) }} \)</p>
                        <p class="mt-2">\( d = \frac{<?=$data['b2'] - $data['b']?>}{ \sqrt {<?=pow($data['m'],2) + 1?> }} \)</p>
                        <p class="mt-2">\( d = \frac{<?=$data['b2'] - $data['b']?>}{<?=round(sqrt((pow($data['m'],2) + 1)),4)?>} \)</p>
                        <p class="mt-2">\( d = <?=safe_round($detail['ans'])?> \)</p>
                    <?php } ?>
                    <?php if($data['type']=='2P' && $data['dimen']=='1D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=safe_round($detail['ans'])?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , x₂) = (<?=$data['2px1']." , ".$data['2px2']?>)</p>
                        <p class="mt-2">\( d = \sqrt {(x₂ - x₁)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$data['2px2']?> - (<?=$data['2px1']?>))^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$data['2px2']-$data['2px1']?>)^2 } \)</p>
                        <p class="mt-2">\( d = <?=safe_round($detail['ans'])?> \)</p>
                    <?php } ?>
                    <?php if($data['type']=='2P' && $data['dimen']=='2D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=safe_round($detail['ans'])?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , x₂) = (<?=$data['x1']." , ".$data['x2']?>)</p>
                        <p class="mt-2">(y₁ , y₂) = (<?=$data['y1']." , ".$data['y2']?>)</p>
                        <p class="mt-2">\( d = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$data['x2']?> - (<?=$data['x1']?>))^2 + (<?=$data['y2']?> - (<?=$data['y1']?>))^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$data['x2']-$data['x1']?>)^2 + (<?=$data['y2']-$data['y1']?>)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=pow(($data['x2']-$data['x1']),2)?>) + (<?=pow(($data['y2']-$data['y1']),2)?>) } \)</p>
                        <p class="mt-2">\( d = \sqrt {<?=pow(($data['x2']-$data['x1']),2) + pow(($data['y2']-$data['y1']),2)?> } \)</p>
                        <p class="mt-2">\( d = <?=safe_round($detail['ans'])?> \)</p>
                    <?php } ?>
                    <?php if($data['type']=='2P' && $data['dimen']=='3D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=safe_round($detail['ans'])?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , x₂) = (<?=$data['3x1']." , ".$data['3x2']?>)</p>
                        <p class="mt-2">(y₁ , y₂) = (<?=$data['3y1']." , ".$data['3y2']?>)</p>
                        <p class="mt-2">(z₁ , z₂) = (<?=$data['3z1']." , ".$data['3z2']?>)</p>
                        <p class="mt-2">\( d = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 + (z₂ - z₁)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$data['3x2']?> - (<?=$data['3x1']?>))^2 + (<?=$data['3y2']?> - (<?=$data['3y1']?>))^2 + (<?=$data['3z2']?> - (<?=$data['3z1']?>))^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$data['3x2']-$data['3x1']?>)^2 + (<?=$data['3y2']-$data['3y1']?>)^2 + (<?=$data['3z2']-$data['3z1']?>)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=pow(($data['3x2']-$data['3x1']),2)?>) + (<?=pow(($data['3y2']-$data['3y1']),2)?>) + (<?=pow(($data['3z2']-$data['3z1']),2)?>) } \)</p>
                        <p class="mt-2">\( d = \sqrt {<?=pow(($data['3x2']-$data['3x1']),2) + pow(($data['3y2']-$data['3y1']),2) + pow(($data['3z2']-$data['3z1']),2)?> } \)</p>
                        <p class="mt-2">\( d = <?=safe_round($detail['ans'])?> \)</p>
                    <?php } ?>
                    <?php if($data['type']=='2P' && $data['dimen']=='4D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?> = <strong class="text-blue"><?=safe_round($detail['ans'])?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , x₂) = (<?=$data['4x1']." , ".$data['4x2']?>)</p>
                        <p class="mt-2">(y₁ , y₂) = (<?=$data['4y1']." , ".$data['4y2']?>)</p>
                        <p class="mt-2">(z₁ , z₂) = (<?=$data['4z1']." , ".$data['4z2']?>)</p>
                        <p class="mt-2">(k₁ , k₂) = (<?=$data['4k1']." , ".$data['4k2']?>)</p>
                        <p class="mt-2">\( d = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 + (z₂ - z₁)^2 + (k₂ - k₁)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$data['4x2']?> - (<?=$data['4x1']?>))^2 + (<?=$data['4y2']?> - (<?=$data['4y1']?>))^2 + (<?=$data['4z2']?> - (<?=$data['4z1']?>))^2 + (<?=$data['4k2']?> - (<?=$data['4k1']?>))^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=$data['4x2']-$data['4x1']?>)^2 + (<?=$data['4y2']-$data['4y1']?>)^2 + (<?=$data['4z2']-$data['4z1']?>)^2 + (<?=$data['4k2']-$data['4k1']?>)^2 } \)</p>
                        <p class="mt-2">\( d = \sqrt {(<?=pow(($data['4x2']-$data['4x1']),2)?>) + (<?=pow(($data['4y2']-$data['4y1']),2)?>) + (<?=pow(($data['4z2']-$data['4z1']),2)?>) + (<?=pow(($data['4k2']-$data['4k1']),2)?>) } \)</p>
                        <p class="mt-2">\( d = \sqrt {<?=pow(($data['4x2']-$data['4x1']),2) + pow(($data['4y2']-$data['4y1']),2) + pow(($data['4z2']-$data['4z1']),2) + pow(($data['4k2']-$data['4k1']),2)?> } \)</p>
                        <p class="mt-2">\( d = <?=safe_round($detail['ans'])?> \)</p>
                    <?php } ?>
                    <?php if($data['type']=='3P' && $data['dimen']=='1D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?>(1-2) = <strong class="text-blue"><?=safe_round($detail['ans1'])?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(3-2) = <strong class="text-blue"><?=safe_round($detail['ans2'])?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(1-3) = <strong class="text-blue"><?=safe_round($detail['ans3'])?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , x₂ , x₃) = (<?=$data['3px1']." , ".$data['3px2']." , ".$data['3px3']?>)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(x₂ - x₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$data['3px2']?> - (<?=$data['3px1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$data['3px2']-$data['3px1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = <?=safe_round($detail['ans1'])?> \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(x₃ - x₂)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$data['3px3']?> - (<?=$data['3px2']?>))^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$data['3px3']-$data['3px2']?>)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = <?=safe_round($detail['ans2'])?> \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(x₃ - x₂)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$data['3px3']?> - (<?=$data['3px1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$data['3px3']-$data['3px1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = <?=safe_round($detail['ans3'])?> \)</p>
                    <?php } ?>
                    <?php if($data['type']=='3P' && $data['dimen']=='2D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?>(1-2) = <strong class="text-blue"><?=safe_round($detail['ans1'])?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(3-2) = <strong class="text-blue"><?=safe_round($detail['ans2'])?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(1-3) = <strong class="text-blue"><?=safe_round($detail['ans3'])?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , y₁) = (<?=$data['x1']." , ".$data['y1']?>)</p>
                        <p class="mt-2">(x₂ , y₂) = (<?=$data['x2']." , ".$data['y2']?>)</p>
                        <p class="mt-2">(x₃ , y₃) = (<?=$data['x3']." , ".$data['y3']?>)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$data['x2']?> - (<?=$data['x1']?>))^2 + <?=$data['y2']?> - (<?=$data['y1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$data['x2']-$data['x1']?>)^2 + (<?=$data['y2']-$data['y1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($data['x2']-$data['x1']),2)?>) + (<?=pow(($data['y2']-$data['y1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($data['x2']-$data['x1']),2) + pow(($data['y2']-$data['y1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = <?=safe_round($detail['ans1'])?> \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(x₃ - x₂)^2 + (x₃ - y₂)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$data['x3']?> - (<?=$data['x2']?>))^2 + <?=$data['y3']?> - (<?=$data['y2']?>))^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$data['x3']-$data['x2']?>)^2 + (<?=$data['y3']-$data['y2']?>)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($data['x3']-$data['x2']),2)?>) + (<?=pow(($data['y3']-$data['y2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($data['x3']-$data['x2']),2) + pow(($data['y3']-$data['y2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = <?=safe_round($detail['ans2'])?> \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(x₃ - x₁)^2 + (y₃ - y₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$data['x3']?> - (<?=$data['x1']?>))^2 + <?=$data['y3']?> - (<?=$data['y1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$data['x3']-$data['x1']?>)^2 + (<?=$data['y3']-$data['y1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($data['x3']-$data['x1']),2)?>) + (<?=pow(($data['y3']-$data['y1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($data['x3']-$data['x1']),2) + pow(($data['y3']-$data['y1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = <?=safe_round($detail['ans3'])?> \)</p>
                    <?php } ?>
                    <?php if($data['type']=='3P' && $data['dimen']=='3D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?>(1-2) = <strong class="text-blue"><?=safe_round($detail['ans1'])?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(3-2) = <strong class="text-blue"><?=safe_round($detail['ans2'])?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(1-3) = <strong class="text-blue"><?=safe_round($detail['ans3'])?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , y₁ , z₁) = (<?=$data['3x1']." , ".$data['3y1']." , ".$data['3z1']?>)</p>
                        <p class="mt-2">(x₂ , y₂ , z₂) = (<?=$data['3x2']." , ".$data['3y2']." , ".$data['3z2']?>)</p>
                        <p class="mt-2">(x₃ , y₃ , z₃) = (<?=$data['3x3']." , ".$data['3y3']." , ".$data['3z3']?>)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 + (z₂ - z₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$data['3x2']?> - (<?=$data['3x1']?>))^2 + <?=$data['3y2']?> - (<?=$data['3y1']?>))^2 + <?=$data['3z2']?> - (<?=$data['3z1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$data['3x2']-$data['3x1']?>)^2 + (<?=$data['3y2']-$data['3y1']?>)^2 + (<?=$data['3z2']-$data['3z1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($data['3x2']-$data['3x1']),2)?>) + (<?=pow(($data['3y2']-$data['3y1']),2)?>) + (<?=pow(($data['3z2']-$data['3z1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($data['3x2']-$data['3x1']),2) + pow(($data['3y2']-$data['3y1']),2) + pow(($data['3z2']-$data['3z1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = <?=safe_round($detail['ans1'])?> \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(x₃ - x₂)^2 + (x₃ - y₂)^2 + (z₃ - z₂)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$data['3x3']?> - (<?=$data['3x2']?>))^2 + <?=$data['3y3']?> - (<?=$data['3y2']?>))^2 + <?=$data['3z3']?> - (<?=$data['3z2']?>))^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$data['3x3']-$data['3x2']?>)^2 + (<?=$data['3y3']-$data['3y2']?>)^2 + (<?=$data['3z3']-$data['3z2']?>)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($data['3x3']-$data['3x2']),2)?>) + (<?=pow(($data['3y3']-$data['3y2']),2)?>) + (<?=pow(($data['3z3']-$data['3z2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($data['3x3']-$data['3x2']),2) + pow(($data['3y3']-$data['3y2']),2) + pow(($data['3z3']-$data['3z2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = <?=safe_round($detail['ans2'])?> \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(x₃ - x₁)^2 + (y₃ - y₁)^2 + (z₃ - z₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$data['3x3']?> - (<?=$data['3x1']?>))^2 + <?=$data['3y3']?> - (<?=$data['3y1']?>))^2 + <?=$data['3z3']?> - (<?=$data['3z1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$data['3x3']-$data['3x1']?>)^2 + (<?=$data['3y3']-$data['3y1']?>)^2 + (<?=$data['3z3']-$data['3z1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($data['3x3']-$data['3x1']),2)?>) + (<?=pow(($data['3y3']-$data['3y1']),2)?>) + (<?=pow(($data['3z3']-$data['3z1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($data['3x3']-$data['3x1']),2) + pow(($data['3y3']-$data['3y1']),2) + pow(($data['3z3']-$data['3z1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = <?=safe_round($detail['ans3'])?> \)</p>
                    <?php } ?>
                    <?php if($data['type']=='3P' && $data['dimen']=='4D'){ ?>
                        <p class="font-s-25"><?=$lang['dis']?>(1-2) = <strong class="text-blue"><?=safe_round($detail['ans1'])?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(3-2) = <strong class="text-blue"><?=safe_round($detail['ans2'])?></strong></p>
                        <p class="font-s-25"><?=$lang['dis']?>(1-3) = <strong class="text-blue"><?=safe_round($detail['ans3'])?></strong></p>
                        <p class="font-s-20 text-start"><strong><?=$lang['sol']?>:</strong></p>
                        <p class="mt-2">(x₁ , y₁ , z₁ , k₁) = (<?=$data['4x1']." , ".$data['4y1']." , ".$data['4k1']." , ".$data['4k1']?>)</p>
                        <p class="mt-2">(x₂ , y₂ , z₂ , k₂) = (<?=$data['4x2']." , ".$data['4y2']." , ".$data['4z2']." , ".$data['4k2']?>)</p>
                        <p class="mt-2">(x₃ , y₃ , z₃ , k₃) = (<?=$data['4x3']." , ".$data['4y3']." , ".$data['4z3']." , ".$data['4k3']?>)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(x₂ - x₁)^2 + (y₂ - y₁)^2 + (z₂ - z₁)^2 + (k₂ - k₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$data['4x2']?> - (<?=$data['4x1']?>))^2 + <?=$data['4y2']?> - (<?=$data['4y1']?>))^2 + <?=$data['4z2']?> - (<?=$data['4z1']?>))^2 + <?=$data['4k2']?> - (<?=$data['4k1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=$data['4x2']-$data['4x1']?>)^2 + (<?=$data['4y2']-$data['4y1']?>)^2 + (<?=$data['4z2']-$data['4z1']?>)^2 + (<?=$data['4k2']-$data['4k1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($data['4x2']-$data['4x1']),2)?>) + (<?=pow(($data['4y2']-$data['4y1']),2)?>) + (<?=pow(($data['4z2']-$data['4z1']),2)?>) + (<?=pow(($data['4k2']-$data['4k1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = \sqrt {(<?=pow(($data['4x2']-$data['4x1']),2) + pow(($data['4y2']-$data['4y1']),2) + pow(($data['4z2']-$data['4z1']),2) + pow(($data['4k2']-$data['4k1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-2) = <?=safe_round($detail['ans1'])?> \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(x₃ - x₂)^2 + (x₃ - y₂)^2 + (z₃ - z₂)^2 + (k₃ - k₂)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$data['4x3']?> - (<?=$data['4x2']?>))^2 + <?=$data['4y3']?> - (<?=$data['4y2']?>))^2 + <?=$data['4z3']?> - (<?=$data['4z2']?>))^2 + <?=$data['4k3']?> - (<?=$data['4k2']?>))^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=$data['4x3']-$data['4x2']?>)^2 + (<?=$data['4y3']-$data['4y2']?>)^2 + (<?=$data['4z3']-$data['4z2']?>)^2 + (<?=$data['4k3']-$data['4k2']?>)^2 } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($data['4x3']-$data['4x2']),2)?>) + (<?=pow(($data['4y3']-$data['4y2']),2)?>) + (<?=pow(($data['4z3']-$data['4z2']),2)?>) + (<?=pow(($data['4k3']-$data['4k2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = \sqrt {(<?=pow(($data['4x3']-$data['4x2']),2) + pow(($data['4y3']-$data['4y2']),2) + pow(($data['4z3']-$data['4z2']),2) + pow(($data['4k3']-$data['4k2']),2)?>) } \)</p>
                        <p class="mt-2">\( d (3-2) = <?=safe_round($detail['ans2'])?> \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(x₃ - x₁)^2 + (y₃ - y₁)^2 + (z₃ - z₁)^2 + (k₃ - k₁)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$data['4x3']?> - (<?=$data['4x1']?>))^2 + <?=$data['4y3']?> - (<?=$data['4y1']?>))^2 + <?=$data['4z3']?> - (<?=$data['4z1']?>))^2 + <?=$data['4k3']?> - (<?=$data['4k1']?>))^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=$data['4x3']-$data['4x1']?>)^2 + (<?=$data['4y3']-$data['4y1']?>)^2 + (<?=$data['4z3']-$data['4z1']?>)^2 + (<?=$data['4k3']-$data['4k1']?>)^2 } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($data['4x3']-$data['4x1']),2)?>) + (<?=pow(($data['4y3']-$data['4y1']),2)?>) + (<?=pow(($data['4z3']-$data['4z1']),2)?>) + (<?=pow(($data['4k3']-$data['4k1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = \sqrt {(<?=pow(($data['4x3']-$data['4x1']),2) + pow(($data['4y3']-$data['4y1']),2) + pow(($data['4z3']-$data['4z1']),2) + pow(($data['4k3']-$data['4k1']),2)?>) } \)</p>
                        <p class="mt-2">\( d (1-3) = <?=safe_round($detail['ans3'])?> \)</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
  
    @endif
</form>
  @push('calculatorJS')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                // Initial render
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</div>
