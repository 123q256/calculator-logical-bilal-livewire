<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
    @if (isset($error))
    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
    @endif
    <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        <div class="grid grid-cols-12 mt-3  gap-4">
            
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="ratios" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2"> 
                    <select name="ratios" id="ratios" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'],"7680 x 4320 ".$lang['3'],"5120 x 2880 ".$lang['4'],"3840 × 2160 ".$lang['5'],"2048 x 1536 ".$lang['6'],"1920 x 1200 ".$lang['7'],"1920 x 1080 ".$lang['8'],"1334 x 750 ".$lang['9'],"1200 x 630 ".$lang['10'],"1136 x 640 ".$lang['11'],"1024 x 768 ".$lang['12'],"1024 x 512 ".$lang['13'],"960 x 640 ".$lang['14'],"800 x 600","728 x 90 ".$lang['15'],"720 x 576 ".$lang['16'],"640 x 480 ".$lang['17'],"576 x 486 ".$lang['18'],"320 x 480 ".$lang['19']];
                            $val = ["custom","7680x4320","5120x2880","3840 × 2160","2048x1536","1920x1200","1920x1080","1334x750","1200x630","1136x640","1024x768","1024x512","960x640","800x600","728x90","720x576","640x480","576x486","320x480"];
                            optionsList($val,$name,isset($_POST['ratios'])?$_POST['ratios']:'1920x1080');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 w1 {{ isset($_POST['m-shape']) && $_POST['m-shape'] !== '0'?'d-none':'d-block' }} {{ isset($_POST['check']) && $_POST['check'] === 'g2'?'d-none':'d-block' }} ">
                <label for="w1" class="label"><?=$lang['20']?> (W₁):</label>
                <div class="w-100 py-2"> 
                    <input type="number" step="any" name="w1" id="w1" class="input" aria-label="input"  value="{{ isset($_POST['w1'])?$_POST['w1']: '1920'}}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 h1 {{ isset($_POST['m-shape']) && $_POST['m-shape'] !== '0'?'d-none':'d-block' }} {{ isset($_POST['check']) && $_POST['check'] === 'g2'?'d-none':'d-block' }} ">
                <label for="h1" class="label"><?=$lang['21']?> (H₁):</label>
                <div class="w-100 py-2"> 
                    <input type="number" step="any" name="h1" id="h1" class="input" aria-label="input"  value="{{ isset($_POST['h1'])?$_POST['h1']: '1080'}}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 w2 {{ isset($_POST['m-shape']) && $_POST['m-shape'] !== '0'?'d-none':'d-block' }} {{ isset($_POST['check']) && $_POST['check'] === 'g2'?'d-none':'d-block' }} ">
                <label for="w2" class="label"><?=$lang['20']?> (W₂) <?=$lang['22']?>:</label>
                <div class="w-100 py-2"> 
                    <input type="number" step="any" name="w2" id="w2" class="input" aria-label="input"  value="{{ isset($_POST['w2'])?$_POST['w2']: '400'}}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 w2 {{ isset($_POST['m-shape']) && $_POST['m-shape'] !== '0'?'d-none':'d-block' }} {{ isset($_POST['check']) && $_POST['check'] === 'g2'?'d-none':'d-block' }} ">
                <label for="h2" class="label"><?=$lang['21']?> (H₂) <?=$lang['22']?>:</label>
                <div class="w-100 py-2"> 
                    <input type="number" step="any" name="h2" id="h2" class="input" aria-label="input"  value="{{ isset($_POST['h2'])?$_POST['h2']: ''}}" />
                </div>
            </div>
             <p class="col-span-12"><strong><?=$lang['23']?>: </strong><?=$lang['24']?>.</p>

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
                    <div class="w-full my-1">
                        <div class="w-full md:w-[80%] lg:w-[80%]  font-s-18">
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong>{{ $lang['25']}} :</strong></td>
                                    <td class="border-b py-2">{{$detail['asp_ratio']}} (cu yd)</td>
                                </tr>  
                                <?php if(isset($detail['ans'])){ ?>    
                                    <tr>
                                        <td class="border-b py-2"><strong><?=($detail['check']==='h2')?'New Height':'New Width'?> :</strong></td>
                                        <td class='border-b py-2'><?=$detail['ans']?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" class="pt-2 pb-1"><strong>{{$lang['26']}}</strong></td>
                                </tr>                      
                                <tr>
                                    <td class="border-b py-2"><?=(isset($detail['ans']))?'Original':''?> <?=$lang['27']?> :</td>
                                    @php
                                        $w1 = request()->w1;
                                        $h1 = request()->h1;
                                        $w2 = request()->w2;
                                        $h2 = request()->h2;
                                    @endphp
                                    <td class='border-b py-2'><?="$w1 x $h1"?></td>
                                </tr>
                                <?php if(isset($detail['ans'])){ ?>    
                                    <tr>
                                        <td class="border-b py-2"><?=$lang['28']?> :</td>
                                        <td class='border-b py-2'><?=($detail['check']==='h2')?"$w2 x ".$detail['ans']:$detail['ans']." x $h2"?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td class="border-b py-2">{{$lang['29']}} :</td>
                                    <td class='border-b py-2'>{{$detail['pixels']}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang['30']}} :</td>
                                    <td class='border-b py-2'>{{$detail['mode']}}</td>
                                </tr>
                            </table>
                            <p class="mt-4"><strong><?=$lang['31']?>:</strong></p>
                            <p class="text-center bg-[#ffffff] mt-3" style="<?=$detail['vsl_ratio']?>"><?=$lang['25']?></p>
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
       document.getElementById('ratios').addEventListener('change', function() {
            var values = this.value;
            var value = values.split('x');
            document.getElementById('w1').value = value[0];
            document.getElementById('h1').value = value[1];
        });
        document.querySelectorAll('.check').forEach(function(element) {
            element.addEventListener('input', function() {
                var value = document.getElementById('w1').value + 'x' + document.getElementById('h1').value;
                var ratios = document.getElementById('ratios');
                ratios.value = value;
                if (ratios.value === null) {
                    ratios.value = 'custom';
                }
            });
        });
    </script>
@endpush