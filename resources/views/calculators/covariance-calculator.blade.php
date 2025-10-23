<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1    gap-4">
                <div class="space-y-2 relative">
                    <label for="formula" class="font-s-14 text-blue">{{ $lang['cal_for'] }}:</label>
                    <select name="formula" id="formula" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['dataset'],$lang['from'],$lang['matrix']];
                            $val = [1,2,3];
                            optionsList($val,$name,isset($_POST['formula'])?$_POST['formula']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 for1">
                    <label for="set_x" class="font-s-14 text-blue">{{ $lang['set'] }} x</label>
                    <textarea name="set_x" id="set_x" class="textareaInput" aria-label="input" placeholder="Enter numbers & separate by comma ','">{{ isset($_POST['set_x'])?$_POST['set_x']:'5, 12, 18, 23, 45' }}</textarea>
                </div>
                <div class="space-y-2 for1">
                    <label for="set_y" class="font-s-14 text-blue">{{ $lang['set'] }} y</label>
                    <textarea name="set_y" id="set_y" class="textareaInput" aria-label="input" placeholder="Enter numbers & separate by comma ','">{{ isset($_POST['set_y'])?$_POST['set_y']:'2, 8, 18, 20, 28' }}</textarea>
                </div>
                <div class="space-y-2 hidden for2">
                    <label for="between" class="font-s-14 text-blue" title="{{ $lang['tool'] }}">{{ $lang['xy'] }}</label>
                    <input type="number" step="any" min="-0.99999" max="0.99999" name="between" id="between" value="{{ isset($_POST['between'])?$_POST['between']:'0.5' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 hidden for2">
                    <label for="devi_x" class="font-s-14 text-blue">{{ $lang['devi'] }} X:</label>
                    <input type="number" step="any" name="devi_x" id="devi_x" value="{{ isset($_POST['devi_x'])?$_POST['devi_x']:'10' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 hidden for2">
                    <label for="devi_y" class="font-s-14 text-blue">{{ $lang['devi'] }} Y:</label>
                    <input type="number" step="any" name="devi_y" id="devi_y" value="{{ isset($_POST['devi_y'])?$_POST['devi_y']:'4' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="grid grid-cols-1  gap-4">
                    <div class="space-y-2 hidden for3">
                        <label for="matrix" class="font-s-14 text-blue">{{ $lang['input'] }}</label>
                        <textarea name="matrix" id="matrix" class="textareaInput" aria-label="input" placeholder="[13 , 44 , 25],[43 , 65 , 76],[12 , 54 , 8] Enter Matrix Value in this form">{{ isset($_POST['matrix'])?$_POST['matrix']:'[13 , 44 , 25],[43 , 65 , 76],[12 , 54 , 8]' }}</textarea>
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
            <div class="rounded-lg mt-4   items-center justify-center">
                <div class="row">
                    @if ($detail['formula']==1)    
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['s']?> X</td>
                                    <td class="py-2 border-b"><strong><?=((isset($detail))?$_POST['set_x']:'0')?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['s']?> Y</td>
                                    <td class="py-2 border-b"><strong><?=((isset($detail))?$_POST['set_y']:'0')?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['sample']?></td>
                                    <td class="py-2 border-b"><strong><?=((isset($detail['nbr']))?$detail['nbr']:'0')?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['Mean']?> X̄</td>
                                    <td class="py-2 border-b"><strong><?=((isset($detail['mean_x']))?$detail['mean_x']:'0')?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['Mean']?> Ȳ</td>
                                    <td class="py-2 border-b"><strong><?=((isset($detail['mean_y']))?$detail['mean_y']:'0')?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['s_cov']?></td>
                                    <td class="py-2 border-b"><strong><?=((isset($detail['population']))?$detail['population']:'0')?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['p_cov']?></td>
                                    <td class="py-2 border-b"><strong><?=((isset($detail['sample']))?$detail['sample']:'0')?></strong></td>
                                </tr>
                            </table>
                        </div>
                    @endif
                    @if ($detail['formula']==2)
                        <div class="text-center">
                            <p class="font-s-20"><strong>{{ $lang['cov_val'] }}</strong></p>
                            <p class="font-s-32  px-3 py-2 radius-10 d-inline-block my-3"><strong class="bg-black text-white p-4 rounded-lg">{{ ((isset($detail['ans_2']))?$detail['ans_2']:'00') }}</strong></p>
                        </div>
                    @endif
                    @if ($detail['formula']==3)
                        <div class="text-center bg-[#2845F5] text-white p-4 rounded-lg">
                            <p class="font-s-20"><strong>{{ $lang['matrix'] }}</strong></p>
                            <p class=" px-3 py-2 radius-10 d-inline-block my-3"><strong class="">{!! ((isset($detail['output']))?$detail['output']:'00') !!}</strong></p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        // Initial setup based on value of '#formula'
        var formula = document.getElementById('formula').value;
        updateFormulaDisplay(formula);

        // Event listener for '#formula' change event
        document.getElementById('formula').addEventListener('change', function() {
            var formula = this.value;
            updateFormulaDisplay(formula);
        });

        // Function to update formula display
        function updateFormulaDisplay(formula) {
            var for1 = document.querySelectorAll('.for1');
            var for2 = document.querySelectorAll('.for2');
            var for3 = document.querySelectorAll('.for3');

            for1.forEach(function(element) {
                element.style.display = formula === '1' ? 'block' : 'none';
            });
            for2.forEach(function(element) {
                element.style.display = formula === '2' ? 'block' : 'none';
            });
            for3.forEach(function(element) {
                element.style.display = formula === '3' ? 'block' : 'none';
            });
        }

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>