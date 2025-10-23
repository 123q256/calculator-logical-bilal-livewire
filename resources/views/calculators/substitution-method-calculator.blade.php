<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-8 ">
                    <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 ">
                        <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select class="input" aria-label="select" name="operations" id="operations">
                                <option value="1">{{$lang['2']}}</option>
                                <option value="2" {{ isset($_POST['operations']) && $_POST['operations']=='2'?'selected':'' }}>{{$lang['3']}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 {{ isset($_POST['operations']) && $_POST['operations'] === '2' ? 'hidden':'' }} math_1">
                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-4">
                                <label for="a1_f" class="font-s-14 text-blue">a<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="a1_f" id="a1_f" class="input" value="{{ isset($_POST['a1_f'])?$_POST['a1_f']:'1' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="b1_f" class="font-s-14 text-blue">b<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="b1_f" id="b1_f" class="input" value="{{ isset($_POST['b1_f'])?$_POST['b1_f']:'3' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="k1_f" class="font-s-14 text-blue">k<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="k1_f" id="k1_f" class="input" value="{{ isset($_POST['k1_f'])?$_POST['k1_f']:'5' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="a2_f" class="font-s-14 text-blue">a<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="a2_f" id="a2_f" class="input" value="{{ isset($_POST['a2_f'])?$_POST['a2_f']:'7' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="b2_f" class="font-s-14 text-blue">b<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="b2_f" id="b2_f" class="input" value="{{ isset($_POST['b2_f'])?$_POST['b2_f']:'9' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="k2_f" class="font-s-14 text-blue">k<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="k2_f" id="k2_f" class="input" value="{{ isset($_POST['k2_f'])?$_POST['k2_f']:'11' }}" aria-label="input"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 {{ isset($_POST['operations']) && $_POST['operations'] === '2' ? '':'hidden' }} math_2">
                        <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-3">
                                <label for="a1_s" class="font-s-14 text-blue">a<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="a1_s" id="a1_s" class="input" value="{{ isset($_POST['a1_s'])?$_POST['a1_s']:'1' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="b1_s" class="font-s-14 text-blue">b<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="b1_s" id="b1_s" class="input" value="{{ isset($_POST['b1_s'])?$_POST['b1_s']:'2' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="c1_s" class="font-s-14 text-blue">c<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="c1_s" id="c1_s" class="input" value="{{ isset($_POST['c1_s'])?$_POST['c1_s']:'3' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="k1_s" class="font-s-14 text-blue">k<sub class="font-s-14 text-blue">1</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="k1_s" id="k1_s" class="input" value="{{ isset($_POST['k1_s'])?$_POST['k1_s']:'4' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="a2_s" class="font-s-14 text-blue">a<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="a2_s" id="a2_s" class="input" value="{{ isset($_POST['a2_s'])?$_POST['a2_s']:'5' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="b2_s" class="font-s-14 text-blue">b<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="b2_s" id="b2_s" class="input" value="{{ isset($_POST['b2_s'])?$_POST['b2_s']:'6' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="c2_s" class="font-s-14 text-blue">c<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="c2_s" id="c2_s" class="input" value="{{ isset($_POST['c2_s'])?$_POST['c2_s']:'7' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="k2_s" class="font-s-14 text-blue">k<sub class="font-s-14 text-blue">2</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="k2_s" id="k2_s" class="input" value="{{ isset($_POST['k2_s'])?$_POST['k2_s']:'8' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="a3_s" class="font-s-14 text-blue">a<sub class="font-s-14 text-blue">3</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="a3_s" id="a3_s" class="input" value="{{ isset($_POST['a3_s'])?$_POST['a3_s']:'9' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="b3_s" class="font-s-14 text-blue">b<sub class="font-s-14 text-blue">3</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="b3_s" id="b3_s" class="input" value="{{ isset($_POST['b3_s'])?$_POST['b3_s']:'10' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="c3_s" class="font-s-14 text-blue">c<sub class="font-s-14 text-blue">3</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="c3_s" id="c3_s" class="input" value="{{ isset($_POST['c3_s'])?$_POST['c3_s']:'11' }}" aria-label="input"/>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="k3_s" class="font-s-14 text-blue">k<sub class="font-s-14 text-blue">3</sub></label>
                                <div class="w-full py-2">
                                    <input type="number" step="any" name="k3_s" id="k3_s" class="input" value="{{ isset($_POST['k3_s'])?$_POST['k3_s']:'12' }}" aria-label="input"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-span-4  text-[20px] flex items-center">
                    <div class="col-12 {{ isset($_POST['operations']) && $_POST['operations'] === '2' ? 'hidden':'' }} math_1">
                        <p>
                            <strong>
                                a<sub class="font-s-16">1</sub> x + b<sub class="font-s-16">1</sub>y = k<sub class="font-s-16">1</sub>
                            </strong>
                        </p>
                        <p class="mt-1">
                            <strong>
                                a<sub class="font-s-16">2</sub> x + b<sub class="font-s-16">2</sub>y = k<sub class="font-s-16">2</sub>
                            </strong>
                        </p>
                    </div>
                    <div class="col-12 {{ isset($_POST['operations']) && $_POST['operations'] === '2' ? '':'hidden' }} math_2">
                        <p>
                            <strong>
                                a<sub class="font-s-16">1</sub> x + b<sub class="font-s-16">1</sub>y + c<sub class="font-s-16">1</sub>z = k<sub class="font-s-16">1</sub>
                            </strong>
                        </p>
                        <p class="mt-1">
                            <strong>
                                a<sub class="font-s-16">2</sub> x + b<sub class="font-s-16">2</sub>y + c<sub class="font-s-16">2</sub>z = k<sub class="font-s-16">2</sub>
                            </strong>
                        </p>
                        <p class="mt-1">
                            <strong>
                                a<sub class="font-s-16">3</sub> x + b<sub class="font-s-16">3</sub>y + c<sub class="font-s-16">3</sub>z = k<sub class="font-s-16">3</sub>
                            </strong>
                        </p>
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
                        @if($_POST['operations'] === "1")
                            @php
                                $a1_f = $_POST['a1_f'];
                                $b1_f = $_POST['b1_f'];
                                $k1_f = $_POST['k1_f'];
                                $a2_f = $_POST['a2_f'];
                                $b2_f = $_POST['b2_f'];
                                $k2_f = $_POST['k2_f'];
                            @endphp
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full font-s-18"> 
                                    <tr>
                                        <td class="py-2 border-b" width="35%"><strong>{{$lang[4]}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$detail['main_ans']}}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang[5]}}</strong></p>
                                <p class="mt-2">{{$lang[6]}}:</p>
                                <p class="mt-2">{{$detail['f1_equation']}}</p>
                                <p class="mt-2">{{$detail['f2_equation']}}</p>
                                <p class="mt-2">{{$detail['first']}}</p>
                                <p class="mt-2">{{$detail['second']}}</p>
                                <p class="mt-2">{{$detail['third']}}</p>
                                <p class="mt-2">{{$detail['four']}}</p>
                                <p class="mt-2">{{$detail['five']}}</p>
                                <p class="mt-2">{{$detail['six']}}</p>
                                @isset($detail['seven'])
                                    <p class="mt-2">{{$detail['seven']}}</p>
                                @endisset
                                <p class="mt-2">{{$detail['answer1']}}</p>
                                <p class="mt-2">{{$detail['answer2']}}</p>
                                <p class="mt-2">{{$detail['answer3']}}</p>
                                <p class="mt-2">{{$detail['answer4']}}</p>
                                <p class="mt-2">{{$detail['answer5']}}</p>
                                <p class="mt-2">{{$detail['answer6']}}</p>
                                <p class="mt-2">{{$detail['answer7']}}</p>
                                <p class="mt-2">{{$detail['answer8']}}</p>
                            </div>
                        @else
                            <div class="w-full text-center text-[20px]">
                                <p>{{$lang[4]}}</p>
                                <p class="font-s-16">{{$detail['s_fans']}}</p>
                                @isset($detail['s_fans2'])
                                    <p class="my-3">
                                        <strong class="bg-white px-3 py-2 radius-10 text-blue">
                                            {{$detail['s_fans2']}}
                                        </strong>
                                    </p>
                                @endisset
                                @isset($detail['s_fans3'])
                                    <p class="my-3 font-s-16">{{$detail['s_fans3']}}</p>
                                @endisset
                                @isset($detail['s_fans4'])
                                    <p class="my-3 font-s-16">{{$detail['s_fans4']}}</p>
                                @endisset
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('operations').addEventListener('change', function() {
                if (this.value === '1') {
                    ['.math_1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.math_2'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                } else {
                    ['.math_1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.math_2'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>