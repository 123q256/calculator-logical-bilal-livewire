<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="select" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="select" id="select" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[2],"Chi-Square ".$lang[3],"F-".$lang[3],$lang[4]." t-".$lang[3],$lang[5],$lang[6],"t-".$lang[3],"(".$lang[7].") ".$lang[8]];
                                $val = [1,2,3,4,5,6,7,8];
                                optionsList($val,$name,isset($_POST['select'])?$_POST['select']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 one">
                    <label for="a1" class="font-s-14 text-blue" id="a">a:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="a" id="a1" value="{{ isset($_POST['a'])?$_POST['a']:'5' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 two">
                    <label for="b1" class="font-s-14 text-blue" id="b">b:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="b" id="b1" value="{{ isset($_POST['b'])?$_POST['b']:'3' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 three">
                    <label for="c1" class="font-s-14 text-blue" id="c">c:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="c" id="c1" value="{{ isset($_POST['c'])?$_POST['c']:'0.23' }}" class="input" aria-label="input" placeholder="00" />
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
                            <p class="text-[20px]">
                                <strong>{{ $lang['9'] }} (PDF)</strong>
                            </p>
                            <div class="flex justify-center">
                            <p class="text-[25px] bg-[#2845F5] w-auto px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-white">{{ $detail['ans'] }}</strong>
                            </p>
                        </div>
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
        // Initial setup
        let dis = document.getElementById('select').value;
        updateDisplay(dis);
        // Event listener for the 'change' event
        document.getElementById('select').addEventListener('change', function() {
            let dis = this.value;
            updateDisplay(dis);
        });
        // Function to update display based on value of 'dis'
        function updateDisplay(dis) {
            if (dis == 1 || dis == 8) {
                showElements([".one", ".two", ".three"]);
                setText('#a', 'a:');
                setText('#b', 'b:');
                setText('#c', 'x:');
            } else if (dis == 2) {
                showElements([".one", ".two"]);
                hideElements([".three"]);
                setText('#a', '<?=$lang[10]?>:');
                setText('#b', 'x:');
            } else if (dis == 3) {
                showElements([".one", ".two", ".three"]);
                setText('#a', '<?=$lang[10]?> 1:');
                setText('#b', '<?=$lang[10]?> 2:');
                setText('#c', 'x:');
            } else if (dis == 4) {
                showElements([".one", ".two", ".three"]);
                setText('#a', '<?=$lang[10]?>:');
                setText('#b', '<?=$lang[11]?> (δ):');
                setText('#c', 't-value:');
            } else if (dis == 5) {
                showElements([".one", ".two", ".three"]);
                setText('#a', '<?=$lang[12]?>:');
                setText('#b', '<?=$lang[13]?>:');
                setText('#c', 'x:');
            } else if (dis == 6) {
                showElements([".three"]);
                hideElements([".one", ".two"]);
                setText('#c', 'x:');
            } else if (dis == 7) {
                showElements([".one", ".two"]);
                hideElements([".three"]);
                setText('#a', '<?=$lang[10]?>:');
                setText('#b', 't-value:');
            }
        }
        // Function to hide elements
        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.style.display = 'none';
                });
            });
        }
        // Function to show elements
        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.style.display = 'block';
                });
            });
        }
        // Function to set text content
        function setText(selector, text) {
            document.querySelector(selector).textContent = text;
        }
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>