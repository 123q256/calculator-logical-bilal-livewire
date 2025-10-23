<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[45%] md:w-[45%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 text-center">

            <div class="col-span-12 text-left">
                <label for="shap" class="label">{{ $lang['select'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="shap" id="shap">
                        <option value="3"><?=$lang['tri']?></option>
                        <option value="4" {{ isset($_POST['shap']) && $_POST['shap']=='4'?'selected':'' }}>{{$lang['pol']}}</option>
                        <option value="n" {{ isset($_POST['shap']) && $_POST['shap']=='n'?'selected':'' }}>{{$lang['n']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 text-left {{ isset($_POST['shap']) && ($_POST['shap'] === '4' || $_POST['shap'] === 'n') ? '':'d-none' }} nInput">
                <span class="label">N:</span>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="total" min="2" max="10" id="nValue" value="{{ isset($_POST['total'])?$_POST['total']:'3' }}" class="input" aria-label="input" />
                </div>
            </div>
            <p class="col-span-12"><strong><?=$lang['x']?> (x<sub class="font-s-14">1</sub>, y<sub class="font-s-14">1</sub>)</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x1" id="x1" value="{{ isset($_POST['x1'])?$_POST['x1']:'7' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y1" id="y1" value="{{ isset($_POST['y1'])?$_POST['y1']:'5' }}" class="input" aria-label="input" />
                </div>
            </div>
            <p class="col-span-12"><strong><?=$lang['x']?> (x<sub class="font-s-14">2</sub>, y<sub class="font-s-14">2</sub>)</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x2" id="x2" value="{{ isset($_POST['x2'])?$_POST['x2']:'5' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y2" id="y2" value="{{ isset($_POST['y2'])?$_POST['y2']:'2' }}" class="input" aria-label="input" />
                </div>
            </div>
            <p class="col-span-12 {{ isset($_POST['total']) && $_POST['total'] === '2' ? 'd-none' : '' }} rowThree"><strong><?=$lang['x']?> (x<sub class="font-s-14">3</sub>, y<sub class="font-s-14">3</sub>)</strong></p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 {{ isset($_POST['total']) && $_POST['total'] === '2' ? 'd-none' : '' }} rowThree">
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x3" id="x3" value="{{ isset($_POST['x3'])?$_POST['x3']:'9' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 {{ isset($_POST['total']) && $_POST['total'] === '2' ? 'd-none' : '' }} rowThree">
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y3" id="y3" value="{{ isset($_POST['y3'])?$_POST['y3']:'11' }}" class="input" aria-label="input" />
                </div>
            </div>
            @isset($detail)
                @for ($i = 3; $i < $_POST['total']; $i++)
                    <p class="col-span-12"><strong><?=$lang['x']?> (x<sub class="font-s-14">{{($i+1)}}</sub>, y<sub class="font-s-14">{{($i+1)}}</sub>)</strong></p>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="x{{ ($i+1) }}" id="x{{ ($i+1) }}" value="{{ $_POST['x'.($i+1)] }}" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="y{{ ($i+1) }}" id="y{{ ($i+1) }}" value="{{ $_POST['y'.($i+1)] }}" class="input" aria-label="input" />
                        </div>
                    </div>
                @endfor
            @endisset
            <div class="row" id="newRows"></div>
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
                            <div class="w-full   mt-2">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['anst'] }}</strong></td>
                                        <td class="py-2 border-b">({{$detail['ans']}})</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>Solution</strong></p>
                                <p class="mt-2">Input Data:</p>
                                @if($_POST['shap']=='3' || $_POST['total']=='3')
                                    <p class="mt-2" >Point 1(x<sub class="font-s-14">1</sub>, y<sub class="font-s-14">1</sub>) = ({{$_POST['x1']}}, {{$_POST['y1']}})<br>Point 2(x<sub class="font-s-14">2</sub>, y<sub class="font-s-14">2</sub>) = ({{$_POST['x2']}}, {{$_POST['y2']}})<br>Point 3(x<sub class="font-s-14">3</sub>, y<sub class="font-s-14">3</sub>) = ({{$_POST['x3']}}, {{$_POST['y3']}})</p>
                                    <p class="mt-2">
                                        Formula of Centroid = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">x<sub class="font-s-14">1</sub> + x<sub class="font-s-14">2</sub> + x<sub class="font-s-14">3</sub></span>
                                            <span>3</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">y<sub class="font-s-14">1</sub> + y<sub class="font-s-14">2</sub> + y<sub class="font-s-14">3</sub></span>
                                            <span>3</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">{{$_POST['x1']}} + {{$_POST['x2']}} + {{$_POST['x3']}}</span>
                                            <span>3</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['y1']}} + {{$_POST['y2']}} + {{$_POST['y3']}}</span>
                                            <span>3</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">{{$_POST['x1'] + $_POST['x2'] + $_POST['x3']}}</span>
                                            <span>3</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['y1'] + $_POST['y2'] + $_POST['y3']}}</span>
                                            <span>3</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">{{$_POST['x1'] + $_POST['x2'] + $_POST['x3']}}</span>
                                            <span>3</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$_POST['y1'] + $_POST['y2'] + $_POST['y3']}}</span>
                                            <span>3</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = ({{$detail['ans']}})
                                    </p>
                                @else
                                    @for($i=1; $i<=$detail['n']; $i++)
                                        <p class="mt-2">Point {{$i}} (x<sub class="font-s-14">{{$i}}</sub>, y<sub class="font-s-14">{{$i}}</sub>) = ({{$_POST['x'.$i]}}, {{$_POST['y'.$i]}})</p>
                                    @endfor
                                    <p class="mt-2">
                                        Formula of Centroid = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">
                                                @for ($i=1; $i<=$detail['n']; $i++)
                                                    x<sub class="font-s-14">{{$i}}</sub>
                                                    @if($i <= ($detail['n']-1))
                                                        +
                                                    @endif 
                                                @endfor
                                            </span>
                                            <span>{{$detail['n']}}</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">
                                                @for ($i=1; $i<=$detail['n']; $i++)
                                                    y<sub class="font-s-14">{{$i}}</sub>
                                                    @if($i <= ($detail['n']-1))
                                                        +
                                                    @endif 
                                                @endfor
                                            </span>
                                            <span>{{$detail['n']}}</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">
                                                @for ($i=1; $i<=$detail['n']; $i++)
                                                    {{$_POST["x$i"]}}
                                                    @if($i <= ($detail['n']-1))
                                                        +
                                                    @endif 
                                                @endfor
                                            </span>
                                            <span>{{$detail['n']}}</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">
                                                @for ($i=1; $i<=$detail['n']; $i++)
                                                    {{$_POST["y$i"]}}
                                                    @if($i <= ($detail['n']-1))
                                                        +
                                                    @endif 
                                                @endfor
                                            </span>
                                            <span>{{$detail['n']}}</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = 
                                        (<span class="quadratic_fraction">
                                            <span class="num">
                                                {{$detail['x3']}}
                                            </span>
                                            <span>{{$detail['n']}}</span>
                                        </span> , 
                                        <span class="quadratic_fraction">
                                            <span class="num">{{$detail['y3']}}</span>
                                            <span>{{$detail['n']}}</span>
                                        </span>)
                                    </p>
                                    <p class="mt-2">
                                        = ({{$detail['ans']}})
                                    </p>
                                @endif
                                <div class="col-12 text-center mt-3">
                                    @if($_POST['shap'] === '3')
                                        <img src="{{asset('images/triangle.webp')}}" height="100%" width="200px" alt="trianle details image first" loading="lazy" decoding="async">
                                    @elseif($_POST['shap'] === '4')
                                        <img src="{{asset('images/pol.webp')}}" height="100%" width="200px" alt="trianle details image second" loading="lazy" decoding="async">
                                    @else
                                        <img src="{{asset('images/npoint.webp')}}" height="100%" width="200px" alt="trianle details image third" loading="lazy" decoding="async">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('shap').addEventListener('change', function() {
                if (this.value === '3') {
                    ['.nInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                } else {
                    ['.nInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }
            });
            document.addEventListener("DOMContentLoaded", function() {
                const inputField = document.getElementById("nValue");
                const inputContainer = document.getElementById("newRows");
                function updateInputs() {
                    const inputValue = parseInt(inputField.value);
                    if(inputValue < 2){
                        alert("Points must be equal or greather than 2");
                    }else if(inputValue === 2){
                        ['.rowThree'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('d-none');
                            });
                        });
                    }else if(inputValue === 3){
                        ['.rowThree'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('d-none');
                            });
                        });
                    }else{
                        inputContainer.innerHTML = '';
                        for (let i = {{ isset($detail['n']) ? ($detail['n']) : 3 }}; i < inputValue; i++) {
                            var inputElement = `
                                <p class="font-s-16 text-center my-2"><strong>{{$lang['x']}} (x<sub class="font-s-14">`+(i+1)+`</sub>, y<sub class="font-s-14">`+(i+1)+`</sub>)</strong></p>
                                <div class="col-6 mt-0 mt-lg-2 px-2">
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="x`+(i+1)+`" id="x`+(i+1)+`" value="`+(i*2)+`" class="input" aria-label="input" />
                                    </div>
                                </div>
                                <div class="col-6 mt-0 mt-lg-2 px-2">
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="y`+(i+1)+`" id="y`+(i+1)+`" value="`+(i*4)+`" class="input" aria-label="input" />
                                    </div>
                                </div>
                            `;
                            document.getElementById('newRows').insertAdjacentHTML('beforeend', inputElement);
                        }
                    }
                }
                inputField.addEventListener("input", updateInputs);
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>