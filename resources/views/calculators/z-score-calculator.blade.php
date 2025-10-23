<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                
                <div class="col-span-12 ">
                    <label for="to_calculate" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <select name="to_calculate" id="to_calculate" class="input">
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
                                $val = ['dp','sm','ds','p'];
                                optionsList($val,$name,isset($_POST['to_calculate'])?$_POST['to_calculate']:'dp');
                            @endphp
                        </select>
                    </div>
                </div>
                <p class="col-span-12 text-center my-2" id="eq">Z = (X − μ) / σ</p>
                <div class="col-span-12  pv hidden">
                    <label for="pvalue" class="font-s-14 text-blue"><?=$lang['6']?> (0 - 1):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="pvalue" id="pvalue"  value="{{ isset($_POST['pvalue'])?$_POST['pvalue']:'0.13' }}" class="input " aria-label="input" placeholder="0.13" />
                    </div>
                </div>
                <div class="col-span-12  vc4 hidden">
                    <label for="pvalue" class="font-s-14 text-blue"><?=$lang['7']?>: (<?=$lang['8']?>)</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 2, 4, 6, 8, 10, 12">{{ isset($_POST['x'])?$_POST['x']:'2, 4, 6, 8, 10, 12' }}</textarea>
                    </div>
                </div>
                <div class="col-span-6 vc3 hidden">
                    <label for="smvalue" class="font-s-14 text-blue"><?=$lang['9']?>: x̄</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="smvalue" id="smvalue" value="{{ isset($_POST['smvalue'])?$_POST['smvalue']:'6' }}" class="input " aria-label="input" placeholder="6" />
                    </div>
                </div>
                <div class="col-span-6 vc3b hidden">
                    <label for="snvalue" class="font-s-14 text-blue"><?=$lang['9']?>: x̄</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="snvalue" id="snvalue" value="{{ isset($_POST['snvalue'])?$_POST['snvalue']:'12' }}" class="input " aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6 vc2">
                    <label for="dsvalue" class="font-s-14 text-blue"><?=$lang['2']?>: x</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="dsvalue" id="dsvalue" value="{{ isset($_POST['dsvalue'])?$_POST['dsvalue']:'5' }}" class="input " aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6 vc1">
                    <label for="pmvalue" class="font-s-14 text-blue"><?=$lang['11']?>: μ</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="pmvalue" id="pmvalue" value="{{ isset($_POST['pmvalue'])?$_POST['pmvalue']:'3' }}" class="input " aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6 vc">
                    <label for="psdvalue" class="font-s-14 text-blue"><?=$lang['12']?>: σ</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="psdvalue" id="psdvalue" value="{{ isset($_POST['psdvalue'])?$_POST['psdvalue']:'2' }}" class="input " aria-label="input" placeholder="00" />
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
                        @php
                            $request = request();
                        @endphp
                        <?php if($request->to_calculate=='dp'){?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['13']?> (x = <?=$request->dsvalue?> , μ = <?=$request->pmvalue ?>, σ = <?=$request->psdvalue?>)</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">Z = <?=$detail['rz']?></strong>
                                </p>
                            </div>
                        </div>
                            <div class="text-center w-full">
                                <img src="<?=url('assets/img/z_score/'.$detail['z_url'].'.png')?>" alt="Z-Score Graph" width="70%">
                            </div>
                            <p class="w-full text-center mt-2"><strong>Z-score graph refers to the left-tailed p-value in blue</strong></p>
                            <div class="col-lg-10 mt-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b">Left tailed p value</td>
                                        <td class='py-2 border-b'><?=$detail['ltpv']?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">Right tailed p value</td>
                                        <td class='py-2 border-b'><?=$detail['rtpv']?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">Two tailed p value</td>
                                        <td class='py-2 border-b'><?=$detail['ttpv']?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">Two tailed confidence level</td>
                                        <td class='py-2 border-b'><?=$detail['ttcl']?></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="w-full mt-3 text-blue text-[20px]"> <b><?=$lang['14']?>:</b></p>
                            <p class="w-full mt-2"> <?=$lang['15']?>: </p>
                            <p class="w-full mt-2"> x = <?=$request->dsvalue?></p>
                            <p class="w-full mt-2"> μ = <?=$request->pmvalue?></p>
                            <p class="w-full mt-2"> σ = <?=$request->psdvalue?></p>
                            <p class="w-full mt-2"> <?=$lang['16']?> Z : </p>
                            <p class="w-full mt-2"> Z = (X − μ) / σ </p>
                            <p class="w-full mt-2"> <?=$lang['17']?> </p>
                            <p class="w-full mt-2"> Z =  (<?=$request->dsvalue?> - <?=$request->pmvalue ?>) / <?=$request->psdvalue?></p>
                            <p class="w-full mt-2"> Z = <?=$detail['ms']?> / <?=$request->psdvalue?></p>
                            <p class="w-full mt-2 text-blue"> <strong>Z = <?=$detail['rz']?> </strong></p>
                        <?php }?>
                        <?php if($request->to_calculate=='sm'){?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['13']?> (x̄ = <?=$request->smvalue?> , n = <?=$request->snvalue?> , μ = <?=$request->pmvalue ?>, σ = <?=$request->psdvalue?>)</strong></p>
                                <p class="text-[32px] bg-sky px-3 py-2 radius-10 d-inline-block my-3">
                                    <strong class="text-blue">Z = <?=$detail['rz']?></strong>
                                </p>
                            </div>
                            <p class="w-full mt-3 text-blue text-[20px]"> <b><?=$lang['14']?>:</b></p>
                            <p class="w-full mt-2"> <?=$lang['15']?>: </p>
                            <p class="w-full mt-2"> x̄ = <?=$request->smvalue?></p>
                            <p class="w-full mt-2"> n = <?=$request->snvalue?></p>
                            <p class="w-full mt-2"> μ = <?=$request->pmvalue?></p>
                            <p class="w-full mt-2"> σ = <?=$request->psdvalue?></p>
                            <p class="w-full mt-2"> <?=$lang['16']?> Z : </p>
                            <p class="w-full mt-2"> Z = (x̄ - μ) / (σ / √n) </p>
                            <p class="w-full mt-2"> <?=$lang['17']?> </p>
                            <p class="w-full mt-2"> Z =  (<?=$request->smvalue?> - <?=$request->pmvalue ?>) / (<?=$request->psdvalue?> / √<?=$request->snvalue?>)</p>
                            <p class="w-full mt-2"> Z = (<?=$detail['ms']?>) / (<?=$request->psdvalue?> / <?=$detail['sq']?>)</p>
                            <p class="w-full mt-2"> Z = (<?=$detail['ms']?>) / (<?=$detail['mv']?>)</p>
                            <p class="w-full mt-2 text-blue"> <strong>Z = <?=$detail['rz']?> </strong></p>
                        <?php }?>
                        <?php if($request->to_calculate=='ds'){?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['15']?> (x = <?=$request->x?>, μ = <?=$request->pmvalue ?>, σ = <?=$request->psdvalue?>)</strong></p>
                                <div class="w-full text-center">
                                    <p class="text-[32px] bg-sky px-3 py-2 radius-10 d-inline-block my-2">
                                        <strong class="text-blue">Z = <?=$detail['rz']?></strong>
                                    </p>
                                </div>
                                <div class="w-full text-center">
                                    <p class="text-[32px] bg-sky px-3 py-2 radius-10 d-inline-block my-2">
                                        <strong class="text-blue">x̄ = <?=$detail['avg']?></strong>
                                    </p>
                                </div>
                                <div class="w-full text-center">
                                    <p class="text-[32px] bg-sky px-3 py-2 radius-10 d-inline-block my-2">
                                        <strong class="text-blue">n = <?=$detail['n']?></strong>
                                    </p>
                                </div>
                            </div>
                            <p class="w-full mt-3 text-blue text-[20px]"> <b><?=$lang['14']?>:</b></p>
                            <p class="w-full mt-2"> <?=$lang['15']?>: </p>
                            <p class="w-full mt-2"> x = <?=$request->x?></p>
                            <p class="w-full mt-2"> n = <?=$lang['18']?> = <?=$detail['n']?></p>
                            <p class="w-full mt-2"> μ = <?=$request->pmvalue?></p>
                            <p class="w-full mt-2"> σ = <?=$request->psdvalue?></p>
                            <p class="w-full mt-2"> <?=$lang['16']?> Z : </p>
                            <p class="w-full mt-2"> Z = (x̄ - μ) / (σ / √n) </p>
                            <p class="w-full mt-2">x̄ = <?=$lang['19']?></p>
                            <p class="w-full mt-2">x̄ = <?=$detail['a']?> / <?=$detail['n']?></p>
                            <p class="w-full mt-2">x̄ = <?=$detail['sum']?> / <?=$detail['n']?></p>
                            <p class="w-full mt-2">x̄ = <?=$detail['avg']?></p>
                            <p class="w-full mt-2"> <?=$lang['17']?> </p>
                            <p class="w-full mt-2"> Z =  (<?=$detail['avg']?> - <?=$request->pmvalue ?>) / (<?=$request->psdvalue?> / √<?=$detail['n']?>)</p>
                            <p class="w-full mt-2"> Z = (<?=$detail['sm']?>) / (<?=$request->psdvalue?> / <?=$detail['sq']?>)</p>
                            <p class="w-full mt-2"> Z = (<?=$detail['sm']?>) / (<?=$detail['dv']?>)</p>
                            <p class="w-full mt-2 text-blue"> <strong>Z = <?=$detail['rz']?> </strong></p>
                        <?php }?>
                        <?php if($request->to_calculate=='p'){?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang['13']?> (P = <?=$request->pvalue?>)</strong></p>
                                <div class="w-full text-center">
                                    <p class="text-[32px] bg-sky px-3 py-2 radius-10 d-inline-block my-2">
                                        <strong class="text-blue">Z = <span id="rs"></strong>
                                    </p>
                                </div>
                                <div class="w-full text-center">
                                    <p class="text-[32px] bg-sky px-3 py-2 radius-10 d-inline-block my-2">
                                        <strong class="text-blue">Z = <span id="rst"></span></strong>
                                    </p>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        function clczzv1(r) {
	    var t,
	        a = -7,
	        n = 7,
	        e = 0;
	    if (0 > r || r > 0.9999999) return -1;
	    for (; n - a > 1e-7; ) (t = clcpv1(e)), t > r ? (n = e) : (a = e), (e = 0.5 * (n + a));
	    return e;
		}
		function clcpv1(r) {
		    var t, a, n;
		    return (
		        0 == r
		            ? (a = 0)
		            : ((t = 0.5 * Math.abs(r)),
		              t > 3.5
		                  ? (a = 1)
		                  : 1 > t
		                  ? ((n = t * t),
		                    (a = ((((((((0.000124818987 * n - 0.001075204047) * n + 0.005198775019) * n - 0.019198292004) * n + 0.059054035642) * n - 0.151968751364) * n + 0.319152932694) * n - 0.5319230073) * n + 0.797884560593) * t * 2))
		                  : ((t -= 2),
		                    (a =
		                        (((((((((((((-45255659e-12 * t + 0.00015252929) * t - 19538132e-12) * t - 0.000676904986) * t + 0.001390604284) * t - 0.00079462082) * t - 0.002034254874) * t + 0.006549791214) * t - 0.010557625006) * t +
		                            0.011630447319) *
		                            t -
		                            0.009279453341) *
		                            t +
		                            0.005353579108) *
		                            t -
		                            0.002141268741) *
		                            t +
		                            0.000535310849) *
		                            t +
		                        0.999936657524))),
		        r > 0 ? 0.5 * (a + 1) : 0.5 * (1 - a)
		    );
		}
		function sceround1(r, t) {
		    var a, n, e;
		    if (((r += ""), (a = r.indexOf(".")), -1 != a)) {
		        for (n = r.substring(0, a + 1), a++, e = 0; t > e && a < r.length; e++) (n += r.charAt(a)), a++;
		        if (a < r.length && r.charAt(a) >= "5" && r.charAt(a) <= "9") {
		            var l,
		                c = 0.1;
		            for (l = 1; t > l; l++) c *= 0.1;
		            (c += parseFloat(n)), (c += ""), (n = c.substring(0, n.length)), (n += "");
		        }
		        for (; n.length > 0 && "0" == n.charAt(n.length - 1); ) n = n.substring(0, n.length - 1);
		        for (; a < r.length && r.charAt(a) >= "0" && r.charAt(a) <= "9"; ) a++;
		        a < r.length && (n += r.substring(a, r.length)), (r = n);
		    }
		    return r;
		}
		<?php if (isset($detail['pva'])) { ?>
		function zpcalc1(){
		    var r,
		        t = parseInt(1),
		        a = <?=$detail['pva']?>;
		    1 == t ? (r = sceround1(Math.abs(clczzv1(a)), 7)) : 2 == t && (r = sceround1(1 - (1 - 1 * Math.abs(clczzv1(0.5 * a))), 7));
          	return r;
		    }
		var ans1=zpcalc1();
		document.getElementById('rs').innerHTML=ans1;
		function zcpcalc1(){
		    var r,
		        t = parseInt(2),
		        a = <?=$detail['pva']?>;
		    1 == t ? (r = sceround1(Math.abs(clczzv1(a)), 7)) : 2 == t && (r = sceround1(1 - (1 - 1 * Math.abs(clczzv1(0.5 * a))), 7));
          	return r;
		    }
		var ans2=zcpcalc1();
		document.getElementById('rst').innerHTML=ans2;
		<?php } ?>
        var toCalculateDropdown = document.getElementById('to_calculate');
        var val = toCalculateDropdown.value;
        var equation = document.getElementById('eq');
        var pvElements = document.querySelectorAll('.pv');
        var vc4Elements = document.querySelectorAll('.vc4');
        var vc3bElements = document.querySelectorAll('.vc3b');
        var vc3Elements = document.querySelectorAll('.vc3');
        var vc2Elements = document.querySelectorAll('.vc2');
        var vc1Elements = document.querySelectorAll('.vc1');
        var vcElements = document.querySelectorAll('.vc');

        function updateDisplay(val) {
            if (val == 'dp') {
                equation.textContent = 'Z = (X − μ) / σ';
                hideElements(pvElements);
                hideElements(vc4Elements);
                hideElements(vc3bElements);
                hideElements(vc3Elements);
                showElements(vc2Elements);
                showElements(vc1Elements);
                showElements(vcElements);
            } else if (val == 'sm') {
                equation.textContent = 'Z = (x̄ - μ) / σ / √n';
                hideElements(pvElements);
                hideElements(vc4Elements);
                showElements(vc3bElements);
                showElements(vc3Elements);
                hideElements(vc2Elements);
                showElements(vc1Elements);
                showElements(vcElements);
            } else if (val == 'ds') {
                equation.textContent = 'Z = (x̄ - μ) / σ / √n';
                hideElements(pvElements);
                showElements(vc4Elements);
                hideElements(vc3bElements);
                hideElements(vc3Elements);
                hideElements(vc2Elements);
                showElements(vc1Elements);
                showElements(vcElements);
            } else if (val == 'p') {
                equation.style.display = 'none';
                showElements(pvElements);
                hideElements(vc4Elements);
                hideElements(vc3bElements);
                hideElements(vc3Elements);
                hideElements(vc2Elements);
                hideElements(vc1Elements);
                hideElements(vcElements);
            }
        }

        function hideElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'none';
            });
        }

        function showElements(elements) {
            elements.forEach(function(element) {
                element.style.display = 'block';
            });
        }

        // Initial update based on the initial value
        updateDisplay(val);

        // Event listener for dropdown change
        toCalculateDropdown.addEventListener('change', function() {
            var newVal = this.value;
            updateDisplay(newVal);
        });

    </script>
@endpush