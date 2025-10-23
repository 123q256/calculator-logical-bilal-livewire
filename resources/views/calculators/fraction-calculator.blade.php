@php 
    $request = request();
    function gcd($a,$b) {
        $a = abs($a); $b = abs($b);

        if( $a < $b)
        { 
            list($b,$a) = Array($a,$b);
        }
        if( $b == 0){
            return 1;
        }
        $r = $a % $b;
        while($r > 0): 
            $a = $b;
            $b = $r;
            $r = $a % $b;
        endwhile;
        return $b;

    }
    function lcmofn($numbers, $n){
        $ans = $numbers[0];
        for ($i = 1; $i < $n; $i++)
        $ans = ((($numbers[$i] * $ans)) / (gcd($numbers[$i], $ans)));
        return $ans;
    }
@endphp
<style>
    @media (max-width: 380px) {
        .calculator-box{
            padding-left: 0.5rem; 
            padding-right: 0.5rem; 
        }   
    }
    .bdr-top{
        border-top:2px solid var(--light-blue);
    }
    .gap-3{
        gap: 5px;
    }
    .units_active{
        background: var(--light-blue)
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="col-12 col-lg-10 mx-auto">
        <div class="row">
            @if(isset($error))
                <p class="font-s-18 text-center"><strong class="text-danger">{{ $error }}</strong></p>
            @endif
            <div class="col-12 text-center">
                <div class="d-inline-flex align-items-center justify-content-center bg-white text-center border radius-10 p-1">
                    <p class="py-1 px-4 cursor-pointer radius-5 fractionTabs {{ isset($request->calculate_type) && $request->calculate_type === 'mixed_type' ? '' : 'units_active' }}" onclick="fractionTabs(this)" id="fraction_type">Fractions Calculator</p>
                    <p class="py-1 px-4 cursor-pointer radius-5 fractionTabs {{ isset($request->calculate_type) && $request->calculate_type === 'mixed_type' ? 'units_active' : '' }}" onclick="fractionTabs(this)" id="mixed_type">{{$lang['44'] }}</p>
                    <input type="hidden" name="calculate_type" id="calculate_type" value="fraction_type">
                </div>
            </div>
            <div class="col-12 {{ isset($request->calculate_type) && $request->calculate_type === 'mixed_type' ? 'hidden' : '' }}" id="fractionInputs">
                @if($device === "desktop")
                    <div class="col-12 mt-3 mb-4 text-center">
                        <div class="my-2 d-flex justify-content-center align-items-center gap-3">
                            <input type="radio" name="stype" id="one" value="one_frac" class="cursor-pointer" {{ isset($request->fraction_types) && $request->fraction_types === 'one_frac' ? 'checked':'' }}>
                            <label for="one" class="font-s-14 text-blue cursor-pointer pe-lg-3 pe-2">1 Fraction </label>
                            
                            <input type="radio" name="stype" id="first" value="simple_frac" class="cursor-pointer" {{ isset($request->fraction_types) && $request->fraction_types !== 'simple_frac' ? '':'checked' }}>
                            <label for="first" class="font-s-14 text-blue cursor-pointer pe-lg-3 pe-2">2 {!! $lang[47] !!}</label>
                            
                            <input type="radio" name="stype" id="second" value="three_frac" class="cursor-pointer" {{ isset($request->fraction_types) && $request->fraction_types === 'three_frac' ? 'checked':'' }}>
                            <label for="second" class="font-s-14 text-blue pe-lg-3 pe-2 cursor-pointer">3 {!! $lang[47] !!}</label>
                            
                            <input type="radio" name="stype" id="three" value="four_frac" class="cursor-pointer" {{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? 'checked':'' }}>
                            <label for="three" class="font-s-14 text-blue cursor-pointer">4 {!! $lang[47] !!}</label>
                            
                            <input type="hidden" name="fraction_types" value="{{ isset($request->fraction_types) ? $request->fraction_types : 'simple_frac' }}" id="fraction_types">
                        </div>
                    </div>
                @else
                    <div class="col-8 mx-auto my-2 row mt-3">
                        <div class="col-6 text-center">
                            <input type="radio" name="stype" id="one" value="one_frac" class="cursor-pointer" {{ isset($request->fraction_types) && $request->fraction_types === 'one_frac' ? 'checked':'' }}>
                            <label for="one" class="font-s-14 text-blue cursor-pointer pe-lg-3 pe-2">1 Fraction&nbsp;&nbsp;</label>
                        </div>
                        <div class="col-6">
                            <input type="radio" name="stype" id="first" value="simple_frac" class="cursor-pointer" {{ isset($request->fraction_types) && $request->fraction_types !== 'simple_frac' ? '':'checked' }}>
                            <label for="first" class="font-s-14 text-blue cursor-pointer pe-lg-3 pe-2">2 {!! $lang[47] !!}</label>
                        </div>
                    </div>
                    <div class="col-8 mx-auto mt-2 row mt-2 mb-3">
                        <div class="col-6 text-center">
                            <input type="radio" name="stype" id="second" value="three_frac" class="cursor-pointer" {{ isset($request->fraction_types) && $request->fraction_types === 'three_frac' ? 'checked':'' }}>
                            <label for="second" class="font-s-14 text-blue pe-lg-3 pe-2 cursor-pointer">3 {!! $lang[47] !!}</label>
                        </div>
                        <div class="col-6">
                            <input type="radio" name="stype" id="three" value="four_frac" class="cursor-pointer" {{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? 'checked':'' }}>
                            <label for="three" class="font-s-14 text-blue cursor-pointer">4 {!! $lang[47] !!}</label>
                        </div>
                    </div>
                    <input type="hidden" name="fraction_types" value="{{ isset($request->fraction_types) ? $request->fraction_types : 'simple_frac' }}" id="fraction_types">
                @endif
                <div class="n_one {{ isset($request->fraction_types) && $request->fraction_types === 'one_frac' ? '' : 'hidden' }}">
                    <div class="row">
                        <div class="col-lg-4 col-6 d-flex align-items-center mx-auto">
                            <div class="pe-2">
                                <input type="number" step="any" name="ne1" id="ne1" class="input mb-2" value="{{ isset($_POST['ne1'])?$_POST['ne1']:'' }}" aria-label="input" placeholder="optional"/>
                            </div>
                            <div class="ps-2">
                                <input type="number" step="any" name="neo2" id="neo2" class="input mb-2" value="{{ isset($_POST['neo2'])?$_POST['neo2']:'5' }}" aria-label="input"/>
                                <hr>
                                <input type="number" step="any" name="du1" oninput="validateInput(this)" pattern="^(?!0$).+" id="du1" class="input mt-2" value="{{ isset($_POST['du1'])?$_POST['du1']:'6' }}" aria-label="input"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="{{ isset($request->fraction_types) && $request->fraction_types === 'one_frac' ? 'hidden' : '' }} {{ isset($request->fraction_types) && $request->fraction_types === 'simple_frac' ? 'col-lg-6 col-8' : ($request->fraction_types == 'three_frac' ? 'col-lg-9 col-12' : ($request->fraction_types == 'four_frac' ? 'col-12' : 'col-lg-6 col-8'))}} div_width mx-auto">
                    <table class="mx-auto">
                        <tbody>
                            <tr>
                                <td>
                                    <input required type="number" step="any" name="N1" oninput="validateInput(this)" pattern="^(?!0$).+"  value="{!! ((isset($request->N1)) ? $request->N1 : '3') !!}" class="input mb-1" aria-label="input field">
                                </td>
                                <td rowspan="2" style="width: 80px;padding: 0px 10px">
                                    <select name="action" class="input action" aria-label="input select">
                                        @php
                                            function optionsList($arr1,$arr2,$unit){
                                            foreach($arr1 as $index => $name){
                                        @endphp
                                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                                {!! $arr2[$index] !!}
                                            </option>
                                        @php
                                            }}
                                            if(isset($request->fraction_types) && ($request->fraction_types == 'three_frac' || $request->fraction_types == 'four_frac')) {
                                                $name = ["+","-","×","÷"];
                                                $val = ["+","-","×","÷"];
                                            } else {
                                                // $name = ["+","-","×","÷","of","^"];
                                                // $val = ["+","-","×","÷","of","^"];
                                                $name = ["+","-","×","÷"];
                                                $val = ["+","-","×","÷"];
                                            }
                                            optionsList($val,$name,isset($request->action)?$request->action:'+');
                                        @endphp
                                    </select>
                                </td>
                                <td>
                                    <input required type="number" step="any" name="N2" oninput="validateInput(this)" pattern="^(?!0$).+" required class="input mb-1" value="{!! ((isset($request->N2)) ? $request->N2 : '5') !!}" aria-label="input field">
                                </td>
                                <td rowspan="2" style="width: 80px;padding: 0px 10px" class="{{ isset($request->fraction_types) && ($request->fraction_types === 'three_frac' || $request->fraction_types === 'four_frac') ? '':'hidden' }} fraction_three_inputs">
                                    <select name="action1" class="input" aria-label="input select">
                                        <?php
                                            $name = ["+","-","×","÷"];
                                            $val = ["+","-","×","÷"];
                                            optionsList($val,$name,isset($request->action1)?$request->action1:'+');
                                        ?>
                                    </select>
                                </td>
                                <td class="{{ isset($request->fraction_types) && ($request->fraction_types === 'three_frac' || $request->fraction_types === 'four_frac') ? '':'hidden' }} fraction_three_inputs">
                                    <input type="number" step="any"  name="N3" oninput="validateInput(this)" pattern="^(?!0$).+" value="{!! ((isset($request->N3)) ? $request->N3 : '7') !!}" class="input mb-1" aria-label="input field">
                                </td>
                                @if($device == 'desktop') 
                                    <td rowspan="2" style="width: 80px;padding: 0px 10px" class="{{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'hidden' }} fraction_four_inputs">
                                        <select name="action2" class="input" aria-label="input select">
                                            <?php
                                                $name = ["+","-","×","÷"];
                                                $val = ["+","-","×","÷"];
                                                optionsList($val,$name,isset($request->action2)?$request->action2:'+');
                                            ?>
                                        </select>
                                    </td>
                                    <td class="{{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'hidden' }} fraction_four_inputs">
                                        <input type="number" step="any"  name="N4" oninput="validateInput(this)" pattern="^(?!0$).+" value="{!! ((isset($request->N4)) ? $request->N4 : '9') !!}" class="input mb-1" aria-label="input field">
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <td class="bdr-top">
                                    <input required type="number" step="any" name="D1" oninput="validateInput(this)" pattern="^(?!0$).+" aria-label="input field" value="{!! ((isset($request->D1)) ? $request->D1 : '13') !!}"  class="input mt-1">
                                </td>
                                <td class="bdr-top">
                                    <input required type="number" step="any" name="D2" oninput="validateInput(this)" pattern="^(?!0$).+" value="{!! ((isset($request->D2)) ? $request->D2 : '15') !!}"  class="input mt-1" aria-label="input field">
                                </td>
                                <td class="bdr-top {{ isset($request->fraction_types) && ($request->fraction_types === 'three_frac' || $request->fraction_types === 'four_frac') ? '':'hidden' }} fraction_three_inputs">
                                    <input type="number" step="any"  name="D3" oninput="validateInput(this)" pattern="^(?!0$).+" value="{!! ((isset($request->D3)) ? $request->D3 : '17') !!}" class="input mt-1" aria-label="input field">
                                </td>
                                @if ($device == 'desktop') 
                                    <td class="bdr-top {{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'hidden' }} fraction_four_inputs">
                                        <input type="number" step="any"  name="D4" oninput="validateInput(this)" pattern="^(?!0$).+" value="{!! ((isset($request->D4)) ? $request->D4 : '19') !!}" class="input mt-1" aria-label="input field">
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($device == 'mobile') 
                    <div class="col-12 mt-2">
                        <table style="width: 40%">
                            <tbody>
                                <tr>
                                    <td rowspan="2" style="width: 65px;" class="{{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'hidden' }} fraction_four_inputs">
                                        <select name="action2"  class="input" aria-label="input select">
                                            <?php
                                                $name = ["+","-","×","÷"];
                                                $val = ["+","-","×","÷"];
                                                optionsList($val,$name,isset($request->action2)?$request->action2:'+');
                                            ?>
                                        </select>
                                    </td>
                                    <td class="{{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'hidden' }} fraction_four_inputs">
                                        <input type="number" step="any"  name="N4" value="{!! ((isset($request->N4)) ? $request->N4 : '9') !!}" class="input mb-1" aria-label="input field">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bdr-top {{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'hidden' }} fraction_four_inputs">
                                        <input type="number" step="any"  name="D4" value="{!! ((isset($request->D4)) ? $request->D4 : '19') !!}" class="input mt-1" aria-label="input field">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            <div class="col-12 {{ isset($request->calculate_type) && $request->calculate_type === 'mixed_type' ? '' : 'hidden' }}" id="mixedInputs">
                <div class="col-lg-10 col-12 mx-auto row">
                    <div class="col-lg-5 mt-lg-4 mt-3 ps-2 pe-lg-3">
                        <div class="d-flex align-items-center">
                            <div class="pe-2">
                                <input required type="number" name="s1" id="s1" class="input mb-2" value="{{ isset($request->s1)?$request->s1:'-3' }}" aria-label="input"/>
                            </div>
                            <div class="ps-lg-2">
                                <input required type="number" name="nu1" id="nu1" class="input mb-2" value="{{ isset($request->nu1)?$request->nu1:'2' }}" aria-label="input"/>
                                <hr>
                                <input required type="number" name="de1" oninput="validateInput(this)" pattern="^(?!0$).+" id="de1" class="input mt-2" value="{{ isset($request->de1)?$request->de1:'5' }}" aria-label="input"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-3 px-lg-2 px-3 mt-lg-4 mt-3" >
                        <label for="actions" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-100 py-2">
                            <select name="actions" class="input" id="actions" aria-label="select">
                                <option value="+">+</option>
                                <option value="-" {{ isset($request->actions) && $request->actions=='-'?'selected':'' }}>-</option>
                                <option value="×" {{ isset($request->actions) && $request->actions=='×'?'selected':'' }}>×</option>
                                <option value="÷" {{ isset($request->actions) && $request->actions=='÷'?'selected':'' }}>÷</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-lg-4 mt-3 pe-2 ps-lg-3">
                        <div class="d-flex align-items-center">
                            <div class="pe-2">
                                <input required type="number" name="s2" id="s2" class="input mb-2" value="{{ isset($request->s2)?$request->s2:'5' }}" aria-label="input"/>
                            </div>
                            <div class="ps-lg-2">
                                <input required type="number" name="nu2" id="nu2" class="input mb-2" value="{{ isset($request->nu2)?$request->nu2:'2' }}" aria-label="input"/>
                                <hr>
                                <input required type="number" name="de2" oninput="validateInput(this)" pattern="^(?!0$).+" id="de2" class="input mt-2" value="{{ isset($request->de2)?$request->de2:'7' }}" aria-label="input"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($type=='calculator')
                @include('inc.button')
            @endif
            @if ($type=='widget')
                @include('inc.widget-button')
            @endif
        </div>
    </div>
    @isset($detail)
        <div class="col-12 bg-light-blue result p-3 radius-10 mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-blue font-s-21"><strong>{{ $lang['res'] }}:</strong></p>
                @if ($type=='calculator')
                    @include('inc.copy-pdf')
                @endif      
            </div>
            @if($request->calculate_type == 'fraction_type')
                @php
                    $fraction_types = $request->fraction_types;
                    $N1 = $request->N1;
                    $N2 = $request->N2;
                    $N3 = $request->N3;
                    $N4 = $request->N4;
                    $D1 = $request->D1;
                    $D2 = $request->D2;
                    $D3 = $request->D3;
                    $D4 = $request->D4;
                    $action = $request->action;
                    $action1 = $request->action1;
                    $action2 = $request->action2;
                @endphp
                <div class="row">
                    @if($request->fraction_types === "simple_frac")
                        <div class="col-12 bg-sky border radius-10 font-s-20 px-3 py-2 mt-2" style="line-height: 4;">
                            \(
                                @if($action=='^')
                                    \left(\dfrac{{!! $N1 !!}}{{!! $D1 !!}}\right) {!! $action !!} {\dfrac{{!! $N2 !!}}{{!! $D2 !!}}} =
                                @else
                                    \dfrac{{!! $N1 !!}}{{!! $D1 !!}} {!! $action !!} \dfrac{{!! $N2 !!}}{{!! $D2 !!}} =
                                @endif
                                @if($detail['btm']!=1 && $detail['upr']!=0)
                                    \dfrac{{!! $detail['upr'] !!}}{{!! $detail['btm'] !!}}
                                @else
                                    {!! $detail['upr'] !!}
                                @endif
                            \)
                        </div>
                        <div class="col-12 mt-2">
                            <p class="font-s-20 mt-2"><strong>{!! $lang['ex'] !!}:</strong></p>
                            @if($action=='of')
                                <p class="mt-2">"{!! $lang[41] !!}" {!! $lang[3] !!}</p>
                            @endif
                            @php
                                $gN1 = $N1;
                                $gD1 = $D1;
                                $gN2 = $N2;
                                $gD2 = $D2;
                                $gAct = $action;
                            @endphp
                            @if($N2<0 && $action == '+')
                                <p class="text-center mt-2">
                                    \( \dfrac{ {!! $N1 !!} }{ {!! $D1 !!} } {!! $action !!} \dfrac{ {!! $N2 !!} }{ {!! $D2 !!} } = ? \)
                                </p>
                                <p class="mt-2">{!! $lang[5] !!}:</p>
                                @php
                                    $action = '-';
                                    $N2 = abs($N2);
                                    $change = "{!! $lang[6] !!}";
                                @endphp
                            @elseif($N2<0 && $action == '-')
                                <p class="text-center mt-2">
                                    \( \dfrac{ {!! $N1 !!} }{ {!! $D1 !!} } {!! $action !!} \dfrac{ {!! $N2 !!} }{ {!! $D2 !!} } = ? \)
                                </p>
                                <p class="mt-2">{!! $lang[5] !!}:</p>
                                @php
                                    $action = '+';
                                    $N2 = abs($N2);
                                    $change = "{!! $lang[6] !!}";
                                @endphp
                            @endif
                            <p class="text-center mt-2">
                                @if($action=='^')
                                    \( \left(\dfrac{ {!! $N1 !!} }{ {!! $D1 !!} }\right) {!! $action !!} {\dfrac{ {!! $N2 !!} }{ {!! $D2 !!} }} = ? \)
                                @else
                                    \( \dfrac{ {!! $N1 !!} }{ {!! $D1 !!} } {!! $action !!} \dfrac{ {!! $N2 !!} }{ {!! $D2 !!} } = ? \)
                                @endif
                            </p>
                            @if($action=='+' || $action=='-')
                                @include('calculators/frac.two-add-sub')
                            @elseif($action=='×' || $action=='of' || $action=='÷')
                                @include('calculators/frac.two-mul')
                            @elseif($action=='^')
                                @include('calculators/frac.power')
                            @endif
                            <p class="font-s-20 mt-2"><strong>{!! $lang['dec'] !!}:</strong></p>
                            <p class="mt-2 text-center">
                                \( = {!! $detail['upr']/$detail['btm'] !!} \)
                            </p>
                            <p class="font-s-20 mt-2"><strong>{!! $lang[7] !!}:</strong></p>
                            <div class="col-12 overflow-auto mt-3">
                                <table class="col-12" cellspacing="0">
                                    <tr>
                                        <td>
                                            <div id="firstFrac"></div>
                                        </td>
                                        <td class="font-s-32 px-3"><strong>{!! $gAct !!}</strong></td>
                                        <td>
                                            <div id="secondFrac"></div>
                                        </td>
                                        <td class="font-s-32 px-3"><strong>=</strong></td>
                                        <td>
                                            <div id="ansFrac"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @elseif($request->fraction_types === "three_frac")
                        <div class="bg-sky border radius-10 font-s-20 px-3 py-2 mt-2" style="line-height: 4;">
                            \( \dfrac{ {!! $N1 !!} }{ {!! $D1 !!} } {!! $action !!} \dfrac{ {!! $N2 !!} }{ {!! $D2 !!} } {!! $action1 !!} \dfrac{ {!! $N3 !!} }{ {!! $D3 !!} } =
                            @if($detail['btm']!=1 && $detail['upr']!=0)
                                \dfrac{ {!! $detail['upr'] !!} }{ {!! $detail['btm'] !!} }
                            @else
                                {!! $detail['upr'] !!}
                            @endif
                            \)
                        </div>
                        {{-- <p>--------------------</p> --}}
                        <div class="col-12 mt-2">
                            <p class="font-s-20"><strong>{!! $lang['ex'] !!}:</strong></p>
                            @php
                                $gN1=$N1;
                                $gD1=$D1;
                                $gN2=$N2;
                                $gD2=$D2;
                                $gN3=$N3;
                                $gD3=$D3;
                                $gAct = $action;
                                $gAct1 = $action1;
                            @endphp
                            @php
                                if (($action=='+' || $action=='-') && ($action1=='+' || $action1=='-')) {
                                    require resource_path('views/calculators/frac/three-add-sub.php');
                                }elseif (($action=='÷' || $action=='×') && ($action1=='÷' || $action1=='×')) {
                                    require resource_path('views/calculators/frac/three-mul-div.php');
                                }elseif (($action=='÷' || $action=='×') && ($action1=='+' || $action1=='-')) {
                                    @require resource_path('views/calculators/frac/three-mul-add.php');
                                }elseif (($action1=='÷' || $action1=='×') && ($action=='+' || $action=='-')) {
                                    require resource_path('views/calculators/frac/three-div-sub.php');
                                }
                            @endphp
                            <p class="font-s-20 mt-2"><strong>{!! $lang['dec'] !!}:</strong></p>
                            <p class="font-s-18 text-center mt-2">\( = {!! $detail['upr']/$detail['btm'] !!} \)</p>
                            <p class="font-s-20 mt-2"><strong>{!! $lang[7] !!}:</strong></p>
                            <div class="col-12 overflow-auto mt-3">
                                <table class="col-12" cellspacing="0">
                                    <tr>
                                        <td>
                                            <div id="firstFrac"></div>
                                        </td>
                                        <td class="font-s-32"><b>{!! $gAct !!}</b></td>
                                        <td>
                                            <div id="secondFrac"></div>
                                        </td>
                                        <td class="font-s-32"><b>{!! $gAct1 !!}</b></td>
                                        <td>
                                            <div id="thirdFrac"></div>
                                        </td>
                                        <td class="font-s-32"><b>=</b></td>
                                        <td>
                                            <div id="ansFrac"></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    @elseif($request->fraction_types === "four_frac")
                        <div class="col-12 bg-sky border radius-10 font-s-20 px-3 py-2 mt-2" style="line-height: 4;">
                            \(
                                \dfrac{{!! $N1 !!}}{{!! $D1 !!}} {!! $action !!}
                                \dfrac{{!! $N2 !!}}{{!! $D2 !!}} {!! $action1 !!} 
                                \dfrac{{!! $N3 !!}}{{!! $D3 !!}} {!! $action2 !!} 
                                \dfrac{{!! $N4 !!}}{{!! $D4 !!}} =
                                @if($detail['btm']!=1 && $detail['upr']!=0)
                                    \dfrac{{!! $detail['upr'] !!}}{{!! $detail['btm'] !!}}
                                @else
                                    {!! $detail['upr'] !!}
                                @endif
                            \)
                        </div>
                        <div class="mt-2">
                            @php
                                if (($action==='+' || $action==='-') && ($action1==='+' || $action1==='-') && ($action2==='+' || $action2==='-')) {
                                    require resource_path('views/calculators/frac/four-add-sub-add.php');
                                }elseif (($action==='÷' || $action==='×') && ($action1==='÷' || $action1==='×') && ($action2==='÷' || $action2==='×')) {
                                    require resource_path('views/calculators/frac/four-mul-div-mul.php');
                                }elseif (($action==='÷' || $action==='×') && ($action1==='+' || $action1==='-') && ($action2==='+' || $action2==='-')) {
                                    require resource_path('views/calculators/frac/four-mul-sub-add.php');
                                }elseif (($action==='+' || $action==='-') && ($action1==='÷' || $action1==='×') && ($action2==='+' || $action2==='-')) {
                                    require resource_path('views/calculators/frac/four-add-mul-sub.php');
                                }elseif (($action==='+' || $action==='-') && ($action1==='+' || $action1==='-') && ($action2==='÷' || $action2==='×')) {
                                    require resource_path('views/calculators/frac/four-add-sub-mul.php');
                                }elseif (($action==='÷' || $action==='×') && ($action1==='÷' || $action1==='×') && ($action2==='+' || $action2==='-')) {
                                    require resource_path('views/calculators/frac/four-mul-div-add.php');
                                }elseif (($action==='÷' || $action==='×') && ($action1==='+' || $action1==='-') && ($action2==='÷' || $action2==='×')) {
                                    require resource_path('views/calculators/frac/four-mul-add-div.php');
                                }elseif (($action==='+' || $action==='-') && ($action1==='÷' || $action1==='×') && ($action2==='÷' || $action2==='×')) {
                                    // dd('s');
                                    require resource_path('views/calculators/frac/four-add-mul-div.php');
                                }
                            @endphp
                        </div>
                    @else
                        {{-- <div class="text-center">
                            <p class="font-s-32 bg-white px-3 py-2 radius-10 d-inline-block my-3"><strong class="text-blue">{{$detail['answer']}}</strong></p>
                        </div> --}}
                        <div class="col-12 font-s-16">
                            <p class="mt-2 font-s-18">
                                \( 
                                    {{(isset($_POST['ne1'])?$_POST['ne1']:'')}} \dfrac{ {{$_POST['neo2']}} }{ {{$_POST['du1']}} } = \dfrac{ {{$detail['upr']}} }{ {{$detail['btm']}} }
                                \)
                            </p>
                            <p class="mt-2"><strong>{{$lang['ex']}}:</strong></p>
                            <p class="mt-2">
                                {{$lang['input']}}:
                                \(
                                    {{(isset($_POST['ne1'])?$_POST['ne1']:'')}}  \dfrac{ {{$_POST['neo2']}} }{ {{$_POST['du1']}} }
                                \)
                            </p>
                            <p class="mt-2">
                                {{$lang['step']}} # 1 
                                \( = \dfrac{ {{$detail['totalN']}} }{ {{$detail['totalD']}} } \)
                            </p>
                            <p class="mt-2">
                                {{$lang['step']}} # 2 
                                \( = \dfrac{ ({{$detail['totalN'].'÷'.$detail['g']}}) }{ {{$detail['totalD'].'÷'.$detail['g']}} } \)
                            </p>
                            @if($detail['btm']=='1')
                                <p class="mt-2">
                                    {{$lang['an']}} = {{$detail['upr']}}
                                </p>
                            @else
                                <p class="mt-2">
                                    {{$lang['an']}} 
                                    \( = \dfrac{ {{$detail['upr']}} }{ {{$detail['btm']}} } \)
                                </p>
                            @endif
                            @if($detail['upr']>$detail['btm'] && $detail['btm']!='1')
                                @php
                                    $bta=$detail['upr'] % $detail['btm'];
                                    $shi=floor($detail['upr'] / $detail['btm']);
                                @endphp
                                <p class="mt-2">
                                    {{$lang['or']}} 
                                    \( = {{$shi}} \dfrac{ {{$bta}} }{ {{$detail['btm']}} } \)
                                </p>
                            @endif
                            @if($detail['btm']!='1')
                                <p class="mt-2">
                                    {{$lang['dec']}} = {{round($detail['upr']/$detail['btm'],4)}}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            @else
                <div class="col-12 font-s-16">
                    <p class="mt-3 font-s-21">
                        <strong>\(
                            {{(isset($_POST['s1'])?$_POST['s1']:'')}} \frac{ {{$_POST['nu1']}} }{ {{$_POST['de1']}} } {{$_POST['actions']}} {{(isset($_POST['s2'])?$_POST['s2']:'')}} \frac{ {{$_POST['nu2']}} }{ {{$_POST['de2']}} } = \frac{ {{$detail['upr']}} }{ {{$detail['btm']}} }
                        \)</strong>
                    </p>
                    <p class="mt-3">{{$lang['ex']}}:</p>
                    <p class="mt-3">
                        {{$lang['input']}}:
                        \(
                            {{(isset($_POST['s1'])?$_POST['s1']:'')}} \frac{ {{$_POST['nu1']}} }{ {{$_POST['de1']}} } {{$_POST['actions']}} {{(isset($_POST['s2'])?$_POST['s2']:'')}} \frac{ {{$_POST['nu2']}} }{ {{$_POST['de2']}} } 
                        \)
                    </p>
                    @if(is_numeric($_POST['s1']) || is_numeric($_POST['s2']))
                        <p class="mt-3">{{$lang['step']}} # 1 :
                            \(
                                \frac{ {{$detail['N1']}} }{ {{$detail['D1']}} } {{$_POST['actions']}} \frac{ {{$detail['N2']}} }{ {{$detail['D2']}} }
                            \)
                        </p>
                    @endif
                    @if($_POST['actions']=='×')
                        <p class="mt-3">
                            {{$lang['step']}} # 2 =
                            \(
                                \frac{ {{$detail['N1'].$_POST['actions'].$detail['N2']}} }{ {{$detail['D1'].$_POST['actions'].$detail['D2']}} }
                            \)
                        </p>
                    @elseif($_POST['actions']=='÷')
                        <p class="mt-3">
                            {{$lang['step']}} # 2 =
                            \(
                                \frac{ ({{$detail['N1'].'×'.$detail['D2']}}) }{ ({{$detail['N2'].'×'.$detail['D1']}}) }
                            \)
                        </p>
                    @else
                        <p class="mt-3">
                            {{$lang['step']}} # 2 =
                            \(
                                \frac{ ({{$detail['N1'].'×'.$detail['D2']}}) {{$_POST['actions']}} {{$detail['N2'].'×'.$detail['D1']}} }{ {{$detail['D1'].'×'.$detail['D2']}} }
                            \)
                        </p>
                    @endif
                    <p class="mt-3">
                        {{$lang['step']}} # 3 =
                        \(
                            \frac{ {{$detail['totalN']}} }{ {{$detail['totalD']}} }
                        \)
                    </p>
                    <p class="mt-3">
                        {{$lang['step']}} # 4 =
                        \(
                            \frac{ ({{$detail['totalN'].'÷'.$detail['g']}}) }{ ({{$detail['totalD'].'÷'.$detail['g']}}) }
                        \)
                    </p>
                    @if($detail['btm']=='1')
                        <p class="mt-3">
                            {{$lang['an']}} = 
                            \( {{$detail['upr']}} \)
                        </p>
                    @else
                        <p class="mt-3">
                            {{$lang['an']}} = 
                            \( \frac{ {{$detail['upr']}} }{ {{$detail['btm']}} } \)
                        </p>
                    @endif
                    @if($detail['upr']>$detail['btm'] && $detail['btm']!='1')
                        @php $bta=$detail['upr'] % $detail['btm']; $shi=floor($detail['upr'] / $detail['btm']); @endphp
                        <p class="mt-3">
                            {{$lang['or']}} = {{$shi}} 
                            \( \frac{ {{$bta}} }{ {{$detail['btm']}} } \)
                        </p>
                    @endif
                    @if($detail['btm']!='1')
                        <p class="mt-3">{{$lang['dec']}}: {{round($detail['upr']/$detail['btm'],4)}}</p>
                    @endif
                </div>
            @endif
        </div>
    @endisset
</form>
@push('calculatorJS')
    @isset($detail)
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" 
        onload="renderMathInElement(document.body);"></script>     
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="{{ url('js/jquery.fractionpainter.js') }}"></script>
    @endisset
    <script>
        function fractionTabs(element) {
            let fractionID = element.id;
            document.getElementById('calculate_type').value = fractionID;
            document.querySelectorAll('.fractionTabs').forEach(tab => {
                tab.classList.remove('units_active');
            });
            element.classList.add('units_active');
            if(fractionID == "mixed_type"){
                document.getElementById('mixedInputs').classList.remove('hidden');    
                document.getElementById('fractionInputs').classList.add('hidden');
            }else{
                document.getElementById('mixedInputs').classList.add('hidden');    
                document.getElementById('fractionInputs').classList.remove('hidden');
            }
        }
        document.getElementById('one').addEventListener('click',function(){
            document.getElementById('fraction_types').value = 'one_frac';
            document.querySelectorAll('.fraction_three_inputs').forEach(el =>{
                el.classList.add('hidden')
            });
            document.querySelectorAll('.fraction_four_inputs').forEach(element => {
            element.classList.add('hidden'); 
            });
            document.querySelector('.n_one').style.display = 'block';
            document.querySelector('.div_width').style.display = 'none';
            ["neo2", "du1"].forEach(name =>
                Array.from(document.getElementsByName(name)).forEach(el => el.setAttribute('required', ''))
            );
            ["N1", "D1", "N2", "D2", "N3", "D3", "N4", "D4"].forEach(name =>
                Array.from(document.getElementsByName(name)).forEach(el => el.removeAttribute('required'))
            );
        });
        document.getElementById('first').addEventListener('click',function(){
            document.getElementById('fraction_types').value = 'simple_frac';
            document.querySelectorAll('.fraction_three_inputs').forEach(el =>{
                el.classList.add('hidden')
            });
            document.querySelectorAll('.fraction_four_inputs').forEach(element => {
                element.classList.add('hidden'); 
            });
            document.querySelector('.n_one').style.display = 'none';
            document.querySelector('.div_width').style.display = 'block';
            document.querySelector('.div_width').classList.add('col-lg-6');
            document.querySelector('.div_width').classList.remove('col-lg-9');
            document.querySelector('.div_width').classList.remove('col-12');
            document.querySelector('.div_width').classList.add('col-7');
            ["N1", "D1", "N2", "D2"].forEach(name =>
                Array.from(document.getElementsByName(name)).forEach(el => el.setAttribute('required', ''))
            );
            ["neo2", "du1", "N3", "D3", "N4", "D4"].forEach(name =>
                Array.from(document.getElementsByName(name)).forEach(el => el.removeAttribute('required'))
            );
        });
        document.getElementById('second').addEventListener('click',function(){
            document.getElementById('fraction_types').value = 'three_frac';
            document.querySelectorAll('.fraction_three_inputs').forEach(el =>{
                el.classList.remove('hidden');
            });
            document.querySelectorAll('.fraction_four_inputs').forEach(element => {
                element.classList.add('hidden'); 
            });
            document.querySelector('.n_one').style.display = 'none';
            document.querySelector('.div_width').style.display = 'block';
            document.querySelector('.div_width').classList.remove('col-7');
            document.querySelector('.div_width').classList.add('col-lg-9');
            document.querySelector('.div_width').classList.remove('col-lg-6');
            document.querySelector('.div_width').classList.remove('col-8');
            ["N1", "D1", "N2", "D2", "N3", "D3"].forEach(name =>
                Array.from(document.getElementsByName(name)).forEach(el => el.setAttribute('required', ''))
            );
            ["neo2", "du1", "N4", "D4"].forEach(name =>
                Array.from(document.getElementsByName(name)).forEach(el => el.removeAttribute('required'))
            );
        });
        document.getElementById('three').addEventListener('click',function(){
            document.getElementById('fraction_types').value = 'four_frac';
            document.querySelectorAll('.fraction_three_inputs').forEach(el =>{
                el.classList.remove('hidden');
            });
            document.querySelectorAll('.fraction_four_inputs').forEach(element => {
                element.classList.remove('hidden');; 
            });
            document.querySelector('.n_one').style.display = 'none';
            document.querySelector('.div_width').style.display = 'block';
            document.querySelector('.div_width').classList.add('col-12');
            document.querySelector('.div_width').classList.remove('col-lg-9');
            document.querySelector('.div_width').classList.remove('col-lg-6');
            document.querySelector('.div_width').classList.remove('col-7');
            document.querySelector('.div_width').classList.remove('col-8');
            ["N1", "D1", "N2", "D2", "N3", "D3", "N4", "D4"].forEach(name =>
                Array.from(document.getElementsByName(name)).forEach(el => el.setAttribute('required', ''))
            );
            ["neo2", "du1"].forEach(name =>
                Array.from(document.getElementsByName(name)).forEach(el => el.removeAttribute('required'))
            );
        });
    </script>
    @if(isset($request->fraction_types))
        <script>
            var fraction_value = document.getElementById('fraction_types').value;
            if(fraction_value == 'one_frac'){
                document.querySelectorAll('.fraction_three_inputs').forEach(el =>{
                    el.classList.add('hidden')
                });
                document.querySelectorAll('.fraction_four_inputs').forEach(element => {
                    element.classList.add('hidden'); 
                });
                document.querySelector('.div_width').style.display = 'none';
                ["neo2", "du1"].forEach(name =>
                    Array.from(document.getElementsByName(name)).forEach(el => el.setAttribute('required', ''))
                );
                ["N1", "D1", "N2", "D2", "N3", "D3", "N4", "D4"].forEach(name =>
                    Array.from(document.getElementsByName(name)).forEach(el => el.removeAttribute('required'))
                );
            }else if(fraction_value == 'simple_frac'){
                ["N1", "D1", "N2", "D2"].forEach(name =>
                    Array.from(document.getElementsByName(name)).forEach(el => el.setAttribute('required', ''))
                );
                ["neo2", "du1", "N3", "D3", "N4", "D4"].forEach(name =>
                    Array.from(document.getElementsByName(name)).forEach(el => el.removeAttribute('required'))
                );
            }else if(fraction_value == 'three_frac'){
                ["N1", "D1", "N2", "D2", "N3", "D3"].forEach(name =>
                    Array.from(document.getElementsByName(name)).forEach(el => el.setAttribute('required', ''))
                );
                ["neo2", "du1", "N4", "D4"].forEach(name =>
                    Array.from(document.getElementsByName(name)).forEach(el => el.removeAttribute('required'))
                );
            }else if(fraction_value == 'four_frac'){
                ["N1", "D1", "N2", "D2", "N3", "D3", "N4", "D4"].forEach(name =>
                    Array.from(document.getElementsByName(name)).forEach(el => el.setAttribute('required', ''))
                );
                ["neo2", "du1"].forEach(name =>
                    Array.from(document.getElementsByName(name)).forEach(el => el.removeAttribute('required'))
                );
            }
        </script>
    @endif
    @if(isset($detail) && $device === "desktop")
        <script>
            $(document).ready(function(){
                @if(($fraction_types !== "four_frac") && ($fraction_types !== "one_frac"))
                    $("#firstFrac").fractionPainter({
                        numerator: {!! $gN1 !!},
                        denominator: {!! $gD1 !!},
                        width:110,
                        height:110
                    });
                    $("#secondFrac").fractionPainter({
                        numerator: {!! $gN2 !!},
                        denominator: {!! $gD2 !!},
                        width:110,
                        height:110
                    });
                @endif
                @if($fraction_types !== "one_frac")
                    $("#ansFrac").fractionPainter({
                        numerator: {!! $detail['upr'] !!},
                        denominator: {!! $detail['btm'] !!},
                        width:110,
                        height:110
                    });
                @endif
            });
        </script>
    @elseif(isset($detail) && $device === "mobile")
        <script>
            $(document).ready(function(){
                @if(($fraction_types !== "four_frac") && ($fraction_types !== "one_frac"))
                    $("#firstFrac").fractionPainter({
                        numerator: {!! $gN1 !!},
                        denominator: {!! $gD1 !!},
                        width:50,
                        height:50
                    });
                    $("#secondFrac").fractionPainter({
                        numerator: {!! $gN2 !!},
                        denominator: {!! $gD2 !!},
                        width:50,
                        height:50
                    });
                @endif
                @if($fraction_types !== "one_frac")
                    $("#ansFrac").fractionPainter({
                        numerator: {!! $detail['upr'] !!},
                        denominator: {!! $detail['btm'] !!},
                        width:50,
                        height:50
                    });
                @endif
            });
        </script>
    @endif
@endpush