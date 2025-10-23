<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="electric" class="label">{{ $lang[1] }} (|E|) V/m:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="electric" id="electric" class="input" value="{{ isset($_POST['electric'])?$_POST['electric']:'17' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="surface" class="label">{{ $lang[2] }} (|A|) m<sup class="text-blue">2</sup>:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="surface" id="surface" class="input" value="{{ isset($_POST['surface'])?$_POST['surface']:'9' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="degree" class="label">{{ $lang[3] }} (θ)°:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="degree" id="degree" class="input" value="{{ isset($_POST['degree'])?$_POST['degree']:'74' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-7 md:col-span-4 lg:col-span-4">
                    <label for="charge" class="label">{{ $lang[4] }} (Q):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="charge" id="charge" class="input" value="{{ isset($_POST['charge'])?$_POST['charge']:'1.79' }}" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-5 md:col-span-2 lg:col-span-2">
                    <label for="unit" class="label">&nbsp;</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="unit" id="unit" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['5'],$lang['6'],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12']];
                                $val = ["picocoulomb","nanocoulomb",'microcoulomb','millicoulomb','coulomb','elementry','ampere','milliampere'];
                                optionsList($val,$name,isset($_POST['unit'])?$_POST['unit']:'nanocoulomb');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-7   md:col-span-6 lg:col-span-6">
                    <label for="const" class="label">(ϵ<sub class="text-blue">0</sub>) C<sup class="text-blue">2</sup>/N∙m<sup class="text-blue">2</sup>:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="const" id="const" class="input" value="{{ isset($_POST['const'])?$_POST['const']:'8.854' }}" aria-label="input" placeholder="00" />
                        <span class="text-blue input_unit">× 10 <?= $lang['13']?></span>
                    </div>
                </div>
                <div class="col-span-5 md:col-span-6 lg:col-span-6">
                    <label for="power" class="label">&nbsp;</label>
                    <div class="w-100 py-2 position-relative" style="margin-top: 4px">
                        <input type="number" step="any" name="power" id="power" class="input" value="{{ isset($_POST['power'])?$_POST['power']:'-12' }}" aria-label="input" placeholder="00" />
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
                            <div class="text-center">
                                <p class="text-[18px]"><strong>{{$lang['14']}}</strong></p>
                                <div class="flex justify-center">
                                <p class="lg:text-[22px] md:text-[22px] text-[16px] bg-[#2845F5] rounded-lg px-3 py-2  my-3">
                                    <strong class="text-white">{{ $detail['flux'] }}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="w-full mt-3 text-[18px]"><?= $lang['15']?></p>
                            <p class="mt-3 w-full"><?= $lang['1']?> |E| = <?= $detail['electric']?> V/m</p>
                            <p class="mt-3 w-full"><?= $lang['2']?> |A| = <?= $detail['surface']?> m <sup>2</sup></p>
                            <p class="mt-3 w-full"><?= $lang['3']?> (θ) ° = <?= $detail['degree']?> θ</p>
                            <p class="mt-3 w-full"><?= $lang['4']?> (Q) = <?= $detail['charge']?> C</p>
                            <p class="mt-3 w-full">(ϵ0) C2/N∙m2 = \(<?= $detail['const']?> × 10^{<?= $detail['power']?>}\)</p>
                            <p class="w-full mt-3 text-[18px] text-blue"><?= $lang['16']?></p>
                            <p class="mt-3 w-full text-blue"><?= $lang['14']?> <?= $lang['17']?></p>
                            <p class="mt-3 w-full">Φ  = \( \dfrac{Q}{ϵ_0}\)</p>
                            <p class="mt-3 w-full"></p>Φ  = \( \dfrac{<?= $detail['charge']?>}{<?= $detail['const']?> × 10^{<?= $detail['power']?>}}\)</p>
                            <p class="mt-3 w-full text-[18px] text-blue">Φ  = <?= $detail['flux']?></p>
                            <p class="mt-3 w-full text-blue"><?= $lang['14']?> <?= $lang['18']?></p>
                            <p class="mt-3 w-full">Φ = |E<i class="arr">&#8407;</i>| &times;|A<i class="arr">&#8407;</i>| &times;cos(180 - θ)</p>
                            <p class="mt-3 w-full">Φ = <?= $detail['electric']?> | x <?= $detail['surface']?> x cos(180 - <?= $detail['degree']?>)</p>
                            <p class="mt-3 w-full">Φ = <?= $detail['electric']?> | x <?= $detail['surface']?> x cos(<?= $detail['sum']?>)</p>
                            <p class="mt-3 w-full">Φ = <?= $detail['electric']?> | x <?= $detail['surface']?> x <?= $detail['cos']?></p>
                            <p class="mt-3 w-full text-[18px] text-blue">Φ = <?= $detail['inward']?></p>
                            <p class="mt-3 w-full text-blue"><?= $lang['14']?> <?= $lang['19']?></p>
                            <p class="mt-3 w-full">Φ = |E<i class="arr">&#8407;</i>| &times;|A<i class="arr">&#8407;</i>| &times;cos(θ)</p>
                            <p class="mt-3 w-full">Φ = <?= $detail['electric']?> x <?= $detail['surface']?> x cos(<?= $detail['degree']?>)</p>
                            <p class="mt-3 w-full">Φ = <?= $detail['electric']?> x <?= $detail['surface']?> x <?= $detail['cosoutward']?></p>
                            <p class="mt-3 w-full text-[18px] text-blue">Φ = <?= $detail['outward']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    <script>
        @if (isset($detail))
            function loadMathJax() {
                var mathJaxScript = document.createElement('script');
                mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                document.querySelector('head').appendChild(mathJaxScript);

                var mathJaxConfigScript = document.createElement('script');
                mathJaxConfigScript.type = "text/x-mathjax-config";
                mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                document.querySelector('head').appendChild(mathJaxConfigScript);
            }

            window.addEventListener('load', function () {
                loadMathJax();
            });
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>