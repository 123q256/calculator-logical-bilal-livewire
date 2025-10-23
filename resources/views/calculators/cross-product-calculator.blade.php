<style>
    .calculator-box .katex-display {
        margin: 0rem !important;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">


            <div class="col-span-12">
                <label for="a_rep" class="font-s-14 text-blue">{{ $lang['vec'] }}(A) {{$lang['rep']}}:</label>
                <div class="w-100 py-2 relative">
                    <select class="input" name="a_rep" id="a_rep">
                        <option value="coor"  {{ isset($_POST['a_rep']) && $_POST['a_rep']=='coor'?'selected':''}}> {{$lang['coor']}}</option>
                        <option value="point"  {{ isset($_POST['a_rep']) && $_POST['a_rep']=='point'?'selected':''}}> {{$lang['point']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <p><strong>{{ $lang['a']}}</strong></p>
            </div>
            <div class="col-span-12 a_coor">
                <div class="grid grid-cols-12   gap-2">
                <div class="col-span-4">
                    <label for="ax" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="ax" id="ax" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['ax'])?$_POST['ax']:'50' }}" />
                        <span class="text-blue input_unit">$$\vec i$$</span>
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="ay" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="ay" id="ay" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['ay'])?$_POST['ay']:'50' }}" />
                        <span class="text-blue input_unit">$$\vec j$$</span>
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="az" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="az" id="az" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['az'])?$_POST['az']:'50' }}" />
                        <span class="text-blue input_unit">$$\vec k$$</span>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-span-12 d-none a_points">
                <div class="grid grid-cols-12   gap-2">
                <div class="col-span-12">
                    <p><strong>{{ $lang['ini']}} (A)</strong></p>
                </div>
                <div class="col-span-4 ">
                    <label for="a1" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="a1" id="a1" class="input" aria-label="input" placeholder="Ax" value="{{ isset($_POST['a1'])?$_POST['a1']:'2' }}" />
                    </div>
                </div>
                <div class="col-span-4 ">
                    <label for="a2" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="a2" id="a2" class="input" aria-label="input" placeholder="Ay" value="{{ isset($_POST['a2'])?$_POST['a2']:'3' }}" />
                    </div>
                </div>
                <div class="col-span-4 ">
                    <label for="a3" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="a3" id="a3" class="input" aria-label="input" placeholder="Az" value="{{ isset($_POST['a3'])?$_POST['a3']:'4' }}" />
                    </div>
                </div>
                <div class="col-span-12">
                    <p><strong>{{ $lang['ter']}} (B)</strong></p>
                </div>
                <div class="col-span-4 ">
                    <label for="b1" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="b1" id="b1" class="input" aria-label="input" placeholder="Ax" value="{{ isset($_POST['b1'])?$_POST['b1']:'2' }}" />
                    </div>
                </div>
                <div class="col-span-4 ">
                    <label for="b2" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="b2" id="b2" class="input" aria-label="input" placeholder="Ay" value="{{ isset($_POST['b2'])?$_POST['b2']:'3' }}" />
                    </div>
                </div>
                <div class="col-span-4 ">
                    <label for="b3" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="b3" id="b3" class="input" aria-label="input" placeholder="Az" value="{{ isset($_POST['b3'])?$_POST['b3']:'4' }}" />
                    </div>
                </div>
                </div>
            </div>

            <div class="col-span-12">
                <label for="b_rep" class="font-s-14 text-blue">{{ $lang['vec'] }}(B) {{$lang['rep']}}:</label>
                <div class="w-100 py-2 relative">
                    <select class="input" name="b_rep" id="b_rep">
                        <option value="coor"  {{ isset($_POST['b_rep']) && $_POST['b_rep']=='coor'?'selected':''}}> {{$lang['coor']}}</option>
                        <option value="point"  {{ isset($_POST['b_rep']) && $_POST['b_rep']=='point'?'selected':''}}> {{$lang['point']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <p><strong>{{ $lang['b']}}</strong></p>
            </div>
            <div class="col-span-12 b_coor">
                <div class="grid grid-cols-12   gap-2">
                <div class="col-span-4 ">
                    <label for="bx" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="bx" id="bx" class="input" aria-label="input" placeholder="x" value="{{ isset($_POST['bx'])?$_POST['bx']:'7' }}" />
                        <span class="text-blue input_unit">$$\vec i$$</span>
                    </div>
                </div>
                <div class="col-span-4 ">
                    <label for="by" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="by" id="by" class="input" aria-label="input" placeholder="y" value="{{ isset($_POST['by'])?$_POST['by']:'8' }}" />
                        <span class="text-blue input_unit">$$\vec j$$</span>
                    </div>
                </div>
                <div class="col-span-4 ">
                    <label for="bz" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="bz" id="bz" class="input" aria-label="input" placeholder="z" value="{{ isset($_POST['bz'])?$_POST['bz']:'9' }}" />
                        <span class="text-blue input_unit">$$\vec k$$</span>
                    </div>
                </div>
            </div>
            </div>

            <div class="col-span-12  d-none b_points">
                <div class="grid grid-cols-12   gap-2">
                <div class="col-span-12">
                    <p><strong>{{ $lang['ini']}} (A)</strong></p>
                </div>
                <div class="col-span-4 ">
                    <label for="aa1" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="aa1" id="aa1" class="input" aria-label="input" placeholder="Ax" value="{{ isset($_POST['aa1'])?$_POST['aa1']:'2' }}" />
                    </div>
                </div>
                <div class="col-span-4 ">
                    <label for="aa2" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="aa2" id="aa2" class="input" aria-label="input" placeholder="Ay" value="{{ isset($_POST['aa2'])?$_POST['aa2']:'3' }}" />
                    </div>
                </div>
                <div class="col-span-4 ">
                    <label for="aa3" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="aa3" id="aa3" class="input" aria-label="input" placeholder="Az" value="{{ isset($_POST['aa3'])?$_POST['aa3']:'4' }}" />
                    </div>
                </div>
                <div class="col-span-12">
                    <p><strong>{{ $lang['ter']}} (B)</strong></p>
                </div>
                <div class="col-span-4 ">
                    <label for="bb1" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="bb1" id="bb1" class="input" aria-label="input" placeholder="Bx" value="{{ isset($_POST['bb1'])?$_POST['bb1']:'2' }}" />
                    </div>
                </div>
                <div class="col-span-4 ">
                    <label for="bb2" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="bb2" id="bb2" class="input" aria-label="input" placeholder="By" value="{{ isset($_POST['bb2'])?$_POST['bb2']:'3' }}" />
                    </div>
                </div>
                <div class="col-span-4 ">
                    <label for="bb3" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="bb3" id="bb3" class="input" aria-label="input" placeholder="Bz" value="{{ isset($_POST['bb3'])?$_POST['bb3']:'4' }}" />
                    </div>
                </div>
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
                    <div class="col-12">
                        <div class="overflow-auto">
                            <p class="mt-2">{{ $lang['input']}}</p>
                        </div>
                        @if($_POST['a_rep']=='coor')
                            @php
                                $ax=$_POST['ax'];
                                $ay=$_POST['ay'];
                                $az=$_POST['az'];
                            @endphp
                            <p class="mt-2">$$\vec a = {{$_POST['ax']}} \vec i {{(($_POST['ay']<0)?$_POST['ay']:"+".$_POST['ay'])}} \vec j {{(($_POST['az']<0)?$_POST['az']:"+".$_POST['az'])}} \vec k$$</p>
                        @else
                            @php
                            $ax=$_POST['b1']-$_POST['a1'];
                            $ay=$_POST['b2']-$_POST['a2'];
                            $az=$_POST['b3']-$_POST['a3']; 
                            @endphp
                            <div class="overflow-auto">
                            <p class="mt-4">$$\vec a = \vec {AB} = (B_x-A_x , B_y-A_y , B_z-A_z)$$</p>
                            </div>
                            <div class="overflow-auto">
                            <p class="mt-4">$$\vec a = \vec {AB} = ({{$_POST['b1']}}-({{$_POST['a1']}}) , {{$_POST['b2']}}-({{$_POST['a2']}}) , {{$_POST['b3']}}-({{$_POST['a3']}}))$$</p>
                            </div>
                            <div class="overflow-auto">
                            <p class="mt-4">$$\vec a = \vec {AB} = ({{$_POST['b1']-$_POST['a1']}} , {{$_POST['b2']-$_POST['a2']}} , {{$_POST['b3']-$_POST['a3']}})$$</p>
                            </div>
                            <p class="mt-4">$$\vec a = {{$ax}} \vec i {{(($ay<0)?$ay:"+".$ay)}} \vec j {{(($az<0)?$az:"+".$az)}} \vec k$$</p>
                        @endif
                        @if($_POST['b_rep']=='coor')
                            @php
                            $bx=$_POST['bx'];
                            $by=$_POST['by'];
                            $bz=$_POST['bz'];
                            @endphp
                            <p class="mt-4">$$\vec b = {{$_POST['bx']}}\vec i {{(($_POST['by']<0)?$_POST['by']:"+".$_POST['by'])}}\vec j {{(($_POST['bz']<0)?$_POST['bz']:"+".$_POST['bz'])}}\vec k$$</p>
                      @else
                        @php
                        $bx=$_POST['bb1']-$_POST['aa1'];
                        $by=$_POST['bb2']-$_POST['aa2'];
                        $bz=$_POST['bb3']-$_POST['aa3']; 
                        @endphp
                        <div class="overflow-auto">
                        <p class="mt-4">$$\vec b = \vec {AB} = (B_x-A_x , B_y-A_y , B_z-A_z)$$</p>
                        </div>
                        <div class="overflow-auto">
                            <p class="mt-4">$$\vec b = \vec {AB} = ({{$_POST['bb1']}}-({{$_POST['aa1']}}) , {{$_POST['bb2']}}-({{$_POST['aa2']}}) , {{ $_POST['bb3']}}-({{ $_POST['aa3']}}))$$</p>
                        </div>
                            <div class="overflow-auto">
                            <p class="mt-4">$$\vec b = \vec {AB} = ({{ $_POST['bb1']-$_POST['aa1']}} , {{ $_POST['bb2']-$_POST['aa2']}} , {{ $_POST['bb3']-$_POST['aa3']}})$$</p>
                        </div>
                        <div class="overflow-auto">
                            <p class="mt-4">$$\vec b = {{ $bx}} \vec i {{ (($by<0)?$by:"+".$by)}} \vec j {{ (($bz<0)?$bz:"+".$bz)}} \vec k$$</p>
                        </div>
                       @endif
                        <p class="mt-4">{{$lang['sol']}}</p>
                            <p class="mt-4">$$\vec a \times \vec b = \begin{vmatrix} i&amp; j&amp; k&amp;\\ a_2&amp; a_2&amp; a_3&amp; \\ b_1&amp; b_2&amp; b_3&amp; \end{vmatrix}$$</p>
                            <p class="mt-4">$$\vec a \times \vec b = \begin{vmatrix} i&amp; j&amp; k&amp;\\ {{$ax}}&amp; {{$ay}}&amp; {{$az}}&amp; \\ {{$bx}}&amp; {{$by}}&amp; {{$bz}}&amp; \end{vmatrix}$$</p>
                        @if($device=='desktop')
                            <p class="mt-4">$$ = \begin{vmatrix}  {{$ay}}&amp; {{$az}}&amp; \\ {{$by}}&amp; {{$bz}}&amp; \end{vmatrix} \vec i -\begin{vmatrix}  {{$ax}}&amp; {{$az}}&amp; \\ {{$bx}}&amp; {{$bz}}&amp; \end{vmatrix} \vec j +\begin{vmatrix}  {{$ax}}&amp; {{$ay}}&amp; \\ {{$bx}}&amp; {{$by}}&amp; \end{vmatrix} \vec k$$</p>
                        @else
                        <div class="overflow-auto">
                            <p class="mt-4">$$ = \begin{vmatrix}  {{$ay}}&amp; {{$az}}&amp; \\ {{$by}}&amp; {{$bz}}&amp; \end{vmatrix} \vec i -\begin{vmatrix}  {{$ax}}&amp; {{$az}}&amp; \\ {{$bx}}&amp; {{$bz}}&amp; \end{vmatrix} \vec j$$</p>
                        </div>
                        <p class="mt-4">$$ +\begin{vmatrix}  {{$ax}}&amp; {{$ay}}&amp; \\ {{$bx}}&amp; {{$by}}&amp; \end{vmatrix} \vec k$$</p>
            
                       @endif
                        @if($device=='desktop')
                        <p class="mt-4">$$ = (({{$ay}} \times {{$bz}}) - ({{$by}} \times {{$az}}))\vec i - (({{$ax}} \times {{$bz}}) - ({{$bx}} \times {{$az}}))\vec j + (({{$ax}} \times {{$by}}) - ({{$bx}} \times {{$ay}}))\vec k$$</p>
                       @else
                       <div class="overflow-auto">
                        <p class="mt-4">$$ = (({{$ay}} \times {{$bz}}) - ({{$by}} \times {{$az}}))\vec i - (({{$ax}} \times {{$bz}}) $$</p>
                       </div>
                       <div class="overflow-auto">
                        <p class="mt-4">$$- ({{$bx}} \times {{$az}}))\vec j + (({{$ax}} \times {{$by}}) - ({{$bx}} \times {{$ay}}))\vec k$$</p>
                       </div>
                       @endif
                        @php
                            $ans_a1=($ay * $bz)-($by*$az);
                            $ans_a2=(($ax*$bz) - ($bx*$az))*(-1);
                            $ans_a3=($ax*$by) - ($bx*$ay);
                        @endphp
                        {{-- <div class="overflow-auto"> --}}
                            <p class="mt-4">$$ = {{$ans_a1}} \vec i {{(($ans_a2<0)?$ans_a2:"+".$ans_a2)}}\vec j {{(($ans_a3<0)?$ans_a3:"+".$ans_a3)}}\vec k$$</p>
                        {{-- </div> --}}
                        <p class="mt-4">$$\vec a \times \vec b = ({{$ans_a1}},{{$ans_a2}},{{$ans_a3}})$$</p>
                        @if($device=='desktop')
                        <p class="mt-4">$$\text{ {{$lang['ans']}}: } ({{$ax}},{{$ay}},{{$az}}) \times ({{$bx}},{{$by}},{{$bz}}) = ({{$ans_a1}},{{$ans_a2}},{{$ans_a3}})$$</p>
                        @endif
                        <div class="overflow-auto">
                        <p class="mt-4">$$\text{ {{$lang['vecm']}} } = {{round(sqrt((pow($ans_a1, 2)+pow($ans_a2, 2)+pow($ans_a3, 2))),4)}}$$</p>
                        </div>
                        <p class="mt-4">{{$lang['nor']}}:</p>
                        <div class="overflow-auto">
                        <p class="mt-4">$$ \frac{{{$ans_a1}}} { \sqrt {{{pow($ans_a1, 2)+pow($ans_a2, 2)+pow($ans_a3, 2)}}}},\frac{{{$ans_a2}}} { \sqrt {{{pow($ans_a1, 2)+pow($ans_a2, 2)+pow($ans_a3, 2)}}}},\frac{{{$ans_a3}}} { \sqrt {{{pow($ans_a1, 2)+pow($ans_a2, 2)+pow($ans_a3, 2)}}}}$$</p>
                        </div>
                        <p class="mt-4"><{{$lang['scoor']}}:</p>
                        {{-- <div class="overflow-auto"> --}}
                        <p class="mt-4">$$\text{ {{$lang['rad']}} } r = {{round(sqrt((pow($ans_a1, 2)+pow($ans_a2, 2)+pow($ans_a3, 2))),4)}}$$</p>
                        {{-- </div> --}}
                        @php $megni=round(sqrt((pow($ans_a1, 2)+pow($ans_a2, 2)+pow($ans_a3, 2))),4);
                            if($megni == 0){
            
                                $polar= 0;
                            } else{
                                $polar=rad2deg(acos($ans_a3/$megni));
                            }
                            if($ans_a1 == 0){
                                $phi= 0;
                            }
                            else{
                                $phi=rad2deg(atan($ans_a2/$ans_a1));
                            }
                        @endphp
                            
                        <p class="mt-4">$$\text{  {{$lang['pol']}} } \theta =  {{round($polar,4)}}^\circ$$</p>
                        <div class="overflow-auto">
                        <p class="mt-4">$$\text{  {{$lang['angle']}} } \phi =  {{round($phi,4)}}^\circ$$</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    @endisset
</form>

@push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" 
        onload="renderMathInElement(document.body);"></script>
    <script>
    @if(isset($error))
            var type = "{{$_POST['a_rep']}}";
            var types = "{{$_POST['b_rep']}}";
        if (type == 'coor') {
                document.querySelectorAll('.a_coor').forEach(function(element) {
                    element.classList.remove('d-none');
                });
                document.querySelectorAll('.a_points').forEach(function(element) {
                    element.classList.add('d-none');
                });
            } else {
                document.querySelectorAll('.a_coor').forEach(function(element) {
                    element.classList.add('d-none');
                });
                document.querySelectorAll('.a_points').forEach(function(element) {
                    element.classList.remove('d-none');
                });
            }

            if (types == 'coor') {
                document.querySelectorAll('.b_coor').forEach(function(element) {
                    element.classList.remove('d-none');
                });
                document.querySelectorAll('.b_points').forEach(function(element) {
                    element.classList.add('d-none');
                });
            } else {
                document.querySelectorAll('.b_coor').forEach(function(element) {
                    element.classList.add('d-none');
                });
                document.querySelectorAll('.b_points').forEach(function(element) {
                    element.classList.remove('d-none');
                });
            }
    @endif
    @if(isset($detail))
            var type = "{{$_POST['a_rep']}}";
            var types = "{{$_POST['b_rep']}}";
        if (type == 'coor') {
                document.querySelectorAll('.a_coor').forEach(function(element) {
                    element.classList.remove('d-none');
                });
                document.querySelectorAll('.a_points').forEach(function(element) {
                    element.classList.add('d-none');
                });
            } else {
                document.querySelectorAll('.a_coor').forEach(function(element) {
                    element.classList.add('d-none');
                });
                document.querySelectorAll('.a_points').forEach(function(element) {
                    element.classList.remove('d-none');
                });
            }

            if (types == 'coor') {
                document.querySelectorAll('.b_coor').forEach(function(element) {
                    element.classList.remove('d-none');
                });
                document.querySelectorAll('.b_points').forEach(function(element) {
                    element.classList.add('d-none');
                });
            } else {
                document.querySelectorAll('.b_coor').forEach(function(element) {
                    element.classList.add('d-none');
                });
                document.querySelectorAll('.b_points').forEach(function(element) {
                    element.classList.remove('d-none');
                });
            }
    @endif
    document.getElementById('a_rep').addEventListener('change', function() {
        var a_rep = this.value;
        if (a_rep == 'coor') {
            document.querySelectorAll('.a_coor').forEach(function(element) {
                element.classList.remove('d-none');
            });
            document.querySelectorAll('.a_points').forEach(function(element) {
                element.classList.add('d-none');
            });
        } else {
            document.querySelectorAll('.a_coor').forEach(function(element) {
                element.classList.add('d-none');
            });
            document.querySelectorAll('.a_points').forEach(function(element) {
                element.classList.remove('d-none');
            });
        }
    });
    document.getElementById('b_rep').addEventListener('change', function() {
        var b_rep = this.value;
        if (b_rep == 'coor') {
            document.querySelectorAll('.b_coor').forEach(function(element) {
                element.classList.remove('d-none');
            });
            document.querySelectorAll('.b_points').forEach(function(element) {
                element.classList.add('d-none');
            });
        } else {
            document.querySelectorAll('.b_coor').forEach(function(element) {
                element.classList.add('d-none');
            });
            document.querySelectorAll('.b_points').forEach(function(element) {
                element.classList.remove('d-none');
            });
        }
    });
	
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>