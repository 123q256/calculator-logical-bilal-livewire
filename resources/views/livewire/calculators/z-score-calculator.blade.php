<div>
 <style>
    [x-cloak] { display: none !important; }
</style>

<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3"
         x-data="{ to_calculate: @entangle('to_calculate') }">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                
                <div class="col-span-12 ">
                    <label for="to_calculate" class="font-s-14 text-blue">{{ $lang['1'] ?? 'To Calculate' }}:</label>
                    <div class="w-100 py-2">
                        <select name="to_calculate" id="to_calculate" class="input" wire:model.live="to_calculate">
                            <option value="dp">{{ $lang['2'] ?? 'Data Point' }}</option>
                            <option value="sm">{{ $lang['3'] ?? 'Sample Mean' }}</option>
                            <option value="ds">{{ $lang['4'] ?? 'Dataset' }}</option>
                            <option value="p">{{ $lang['5'] ?? 'P-value' }}</option>
                        </select>
                    </div>
                </div>
                <p class="col-span-12 text-center my-2" id="eq" x-show="to_calculate != 'p'" x-text="to_calculate == 'dp' ? 'Z = (X − μ) / σ' : 'Z = (x̄ - μ) / σ / √n'">Z = (X − μ) / σ</p>
                
                <div class="col-span-12" x-show="to_calculate == 'p'" x-cloak>
                    <label for="pvalue" class="font-s-14 text-blue">{{ $lang['6'] ?? 'P-value' }} (0 - 1):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="pvalue" id="pvalue" class="input " aria-label="input" placeholder="0.13" wire:model.live="pvalue" />
                    </div>
                </div>
                <div class="col-span-12" x-show="to_calculate == 'ds'" x-cloak>
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['7'] ?? 'Data Set' }}: ({{ $lang['8'] ?? 'comma separated' }})</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 2, 4, 6, 8, 10, 12" wire:model.live="x"></textarea>
                    </div>
                </div>
                <div class="col-span-6" x-show="to_calculate == 'sm'" x-cloak>
                    <label for="smvalue" class="font-s-14 text-blue">{{ $lang['9'] ?? 'Sample Mean' }}: x̄</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="smvalue" id="smvalue" class="input " aria-label="input" placeholder="6" wire:model.live="smvalue" />
                    </div>
                </div>
                <div class="col-span-6" x-show="to_calculate == 'sm'" x-cloak>
                    <label for="snvalue" class="font-s-14 text-blue">{{ $lang['10'] ?? 'Sample Size' }}: n</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="snvalue" id="snvalue" class="input " aria-label="input" placeholder="00" wire:model.live="snvalue" />
                    </div>
                </div>
                <div class="col-span-6" x-show="to_calculate == 'dp'">
                    <label for="dsvalue" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Data Point' }}: x</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="dsvalue" id="dsvalue" class="input " aria-label="input" placeholder="00" wire:model.live="dsvalue" />
                    </div>
                </div>
                <div class="col-span-6" x-show="to_calculate != 'p'">
                    <label for="pmvalue" class="font-s-14 text-blue">{{ $lang['11'] ?? 'Population Mean' }}: μ</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="pmvalue" id="pmvalue" class="input " aria-label="input" placeholder="00" wire:model.live="pmvalue" />
                    </div>
                </div>
                <div class="col-span-6" x-show="to_calculate != 'p'">
                    <label for="psdvalue" class="font-s-14 text-blue">{{ $lang['12'] ?? 'Population Standard Deviation' }}: σ</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="psdvalue" id="psdvalue" class="input " aria-label="input" placeholder="00" wire:model.live="psdvalue" />
                    </div>
                </div>            </div>
       </div>
        @if ($type == 'calculator')
        @include('inc.button')
       @endif
       @if ($type=='widget')
       @include('inc.widget-button')
        @endif
    </div>

    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        @if($to_calculate=='dp')
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{ $lang['13'] ?? 'Z-Score Result' }} (x = {{ $dsvalue }} , μ = {{ $pmvalue }}, σ = {{ $psdvalue }})</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">Z = {{ $detail['rz'] }}</strong>
                                </p>
                            </div>
                        </div>
                            <div class="text-center w-full">
                                <img src="{{ url('assets/img/z_score/'.$detail['z_url'].'.png') }}" alt="Z-Score Graph" width="70%">
                            </div>
                            <p class="w-full text-center mt-2"><strong>Z-score graph refers to the left-tailed p-value in blue</strong></p>
                            <div class="col-lg-10 mt-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="text-blue py-2 border-b">Left tailed p value</td>
                                        <td class='py-2 border-b'>{{ $detail['ltpv'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">Right tailed p value</td>
                                        <td class='py-2 border-b'>{{ $detail['rtpv'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">Two tailed p value</td>
                                        <td class='py-2 border-b'>{{ $detail['ttpv'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b">Two tailed confidence level</td>
                                        <td class='py-2 border-b'>{{ $detail['ttcl'] }}</td>
                                    </tr>
                                </table>
                            </div>
                            <p class="w-full mt-3 text-blue text-[20px]"> <b>{{ $lang['14'] ?? 'Calculation' }}:</b></p>
                            <p class="w-full mt-2"> {{ $lang['15'] ?? 'Input Data' }}: </p>
                            <p class="w-full mt-2"> x = {{ $dsvalue }}</p>
                            <p class="w-full mt-2"> μ = {{ $pmvalue }}</p>
                            <p class="w-full mt-2"> σ = {{ $psdvalue }}</p>
                            <p class="w-full mt-2"> {{ $lang['16'] ?? 'Formula' }} Z : </p>
                            <p class="w-full mt-2"> Z = (X − μ) / σ </p>
                            <p class="w-full mt-2"> {{ $lang['17'] ?? 'Solution' }} </p>
                            <p class="w-full mt-2"> Z =  ({{ $dsvalue }} - {{ $pmvalue }}) / {{ $psdvalue }}</p>
                            <p class="w-full mt-2"> Z = {{ $detail['ms'] }} / {{ $psdvalue }}</p>
                            <p class="w-full mt-2 text-blue"> <strong>Z = {{ $detail['rz'] }} </strong></p>
                        @endif

                        @if($to_calculate=='sm')
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{ $lang['13'] ?? 'Z-Score Result' }} (x̄ = {{ $smvalue }} , n = {{ $snvalue }} , μ = {{ $pmvalue }}, σ = {{ $psdvalue }})</strong></p>
                                <p class="text-[32px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">Z = {{ $detail['rz'] }}</strong>
                                </p>
                            </div>
                            <p class="w-full mt-3 text-blue text-[20px]"> <b>{{ $lang['14'] ?? 'Calculation' }}:</b></p>
                            <p class="w-full mt-2"> {{ $lang['15'] ?? 'Input Data' }}: </p>
                            <p class="w-full mt-2"> x̄ = {{ $smvalue }}</p>
                            <p class="w-full mt-2"> n = {{ $snvalue }}</p>
                            <p class="w-full mt-2"> μ = {{ $pmvalue }}</p>
                            <p class="w-full mt-2"> σ = {{ $psdvalue }}</p>
                            <p class="w-full mt-2"> {{ $lang['16'] ?? 'Formula' }} Z : </p>
                            <p class="w-full mt-2"> Z = (x̄ - μ) / (σ / √n) </p>
                            <p class="w-full mt-2"> {{ $lang['17'] ?? 'Solution' }} </p>
                            <p class="w-full mt-2"> Z =  ({{ $smvalue }} - {{ $pmvalue }}) / ({{ $psdvalue }} / √{{ $snvalue }})</p>
                            <p class="w-full mt-2"> Z = ({{ $detail['ms'] }}) / ({{ $psdvalue }} / {{ $detail['sq'] }})</p>
                            <p class="w-full mt-2"> Z = ({{ $detail['ms'] }}) / ({{ $detail['mv'] }})</p>
                            <p class="w-full mt-2 text-blue"> <strong>Z = {{ $detail['rz'] }} </strong></p>
                        @endif

                        @if($to_calculate=='ds')
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{ $lang['15'] ?? 'Input Data' }} (x = {{ $x }}, μ = {{ $pmvalue }}, σ = {{ $psdvalue }})</strong></p>
                                <div class="w-full text-center">
                                    <p class="text-[32px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-2">
                                        <strong class="text-white">Z = {{ $detail['rz'] }}</strong>
                                    </p>
                                </div>
                                <div class="w-full text-center">
                                    <p class="text-[32px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-2">
                                        <strong class="text-white">x̄ = {{ $detail['avg'] }}</strong>
                                    </p>
                                </div>
                                <div class="w-full text-center">
                                    <p class="text-[32px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-2">
                                        <strong class="text-white">n = {{ $detail['n'] }}</strong>
                                    </p>
                                </div>
                            </div>
                            <p class="w-full mt-3 text-blue text-[20px]"> <b>{{ $lang['14'] ?? 'Calculation' }}:</b></p>
                            <p class="w-full mt-2"> {{ $lang['15'] ?? 'Input Data' }}: </p>
                            <p class="w-full mt-2"> x = {{ $x }}</p>
                            <p class="w-full mt-2"> n = {{ $lang['18'] ?? 'Count' }} = {{ $detail['n'] }}</p>
                            <p class="w-full mt-2"> μ = {{ $pmvalue }}</p>
                            <p class="w-full mt-2"> σ = {{ $psdvalue }}</p>
                            <p class="w-full mt-2"> {{ $lang['16'] ?? 'Formula' }} Z : </p>
                            <p class="w-full mt-2"> Z = (x̄ - μ) / (σ / √n) </p>
                            <p class="w-full mt-2">x̄ = {{ $lang['19'] ?? 'Average' }}</p>
                            <p class="w-full mt-2">x̄ = {!! $detail['a'] !!} / {{ $detail['n'] }}</p>
                            <p class="w-full mt-2">x̄ = {{ $detail['sum'] }} / {{ $detail['n'] }}</p>
                            <p class="w-full mt-2">x̄ = {{ $detail['avg'] }}</p>
                            <p class="w-full mt-2"> {{ $lang['17'] ?? 'Solution' }} </p>
                            <p class="w-full mt-2"> Z =  ({{ $detail['avg'] }} - {{ $pmvalue }}) / ({{ $psdvalue }} / √{{ $detail['n'] }})</p>
                            <p class="w-full mt-2"> Z = ({{ $detail['sm'] }}) / ({{ $psdvalue }} / {{ $detail['sq'] }})</p>
                            <p class="w-full mt-2"> Z = ({{ $detail['sm'] }}) / ({{ $detail['dv'] }})</p>
                            <p class="w-full mt-2 text-blue"> <strong>Z = {{ $detail['rz'] }} </strong></p>
                        @endif

                        @if($to_calculate=='p')
                            <div class="text-center" x-data="{ 
                                pva: @js($detail['pva'] ?? null),
                                ans1: '',
                                ans2: '',
                                calculateZ() {
                                    if(!this.pva) return;
                                    this.ans1 = Math.abs(clczzv1(this.pva)).toFixed(7);
                                    this.ans2 = (1 - (1 - 1 * Math.abs(clczzv1(0.5 * this.pva)))).toFixed(7);
                                }
                            }" x-init="calculateZ()">
                                <p class="text-[20px]"><strong>{{ $lang['13'] ?? 'Z-Score Result' }} (P = {{ $pvalue }})</strong></p>
                                <div class="w-full text-center">
                                    <p class="text-[32px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-2">
                                        <strong class="text-white">Z = <span x-text="ans1"></span></strong>
                                    </p>
                                </div>
                                <div class="w-full text-center">
                                    <p class="text-[32px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-2">
                                        <strong class="text-white">Z = <span x-text="ans2"></span></strong>
                                    </p>
                                </div>
                            </div>
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
    </script>
@endpush
</div>
