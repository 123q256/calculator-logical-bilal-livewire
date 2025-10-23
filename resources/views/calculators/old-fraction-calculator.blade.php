@php
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
    .calculate{
        background: var(--light-blue);
        color: var(--white);
        border-radius: 7px;
        padding: 9px 12px;
        font-size: 14px;
        text-transform: uppercase;
        border: none;
        outline: 0;
    }
    .reset{
        padding: 9px 12px;
        font-size: 14px;
    }
    button.calculate{
        padding: 9px 12px;
        font-size: 14px;
    }
    .velocitytab .v_active{
        border-bottom: 3px solid var(--light-blue);
    }
    .velocitytab .v_active strong{
        color: var(--light-blue);
    }
    .veloTabs:hover{
        background-color : gainsboro;
    }
    .velocitytab p{
        position: relative;
        top: 2px;
    }
    .active{
        background-color: var(--light-blue);;
        color: white;
    }
    .bdr-top{
        border-top:2px solid var(--light-blue);
    }
    .gap-3{
        gap: 5px;
    }
    .border-top-gray{
        border-top : 1px solid #80808042;
    }
    .text-underline{
        text-decoration: underline;
    }
</style>


<div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg shadow-md space-y-6 mb-3">
    @if (isset($error))
    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
   @endif

    <form class="row" method="POST" action="{{ url()->current() }}/">
        @csrf
        <div class="container mx-auto">
            <div class="row">
                @php 
                    $request = request(); 
                    $submit = $request->submit;
                @endphp
                <div class="row" id="fraction">
                    <h2 class="text-[#3c7c54] text-center mt-4 mb-2 text-2xl font-semibold">{{$cal_name}}</h2>
                    @if($submit == 'calculate_fraction')
                        @if(isset($error))
                            <p class="font-s-18 text-center"><strong class="text-danger">{{ $error }}</strong></p>
                        @endif
                    @endif
                    <div class="col-12 mt-3 mb-4 text-center">
                        <div class="my-2 d-flex justify-content-center align-items-center gap-3">
                            <input type="radio" name="stype" id="one" value="one_frac" class="cursor-pointer d-none" {{ isset($request->fraction_types) && $request->fraction_types === 'one_frac' ? 'checked':'' }}>
                            <label for="one" class="font-s-14 text-blue cursor-pointer pe-lg-3 pe-2  d-none">1 {!! $lang[47] !!} </label>
                            
                            <input type="radio" name="stype" id="first" value="simple_frac" class="cursor-pointer" {{ isset($request->fraction_types) && $request->fraction_types !== 'simple_frac' ? '':'checked' }}>
                            <label for="first" class="font-s-14 text-blue cursor-pointer pe-lg-3 pe-2">2 {!! $lang[47] !!}</label>
                            
                            <input type="radio" name="stype" id="second" value="three_frac" class="cursor-pointer" {{ isset($request->fraction_types) && $request->fraction_types === 'three_frac' ? 'checked':'' }}>
                            <label for="second" class="font-s-14 text-blue pe-lg-3 pe-2 cursor-pointer">3 {!! $lang[47] !!}</label>
                            
                            <input type="radio" name="stype" id="three" value="four_frac" class="cursor-pointer" {{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? 'checked':'' }}>
                            <label for="three" class="font-s-14 text-blue cursor-pointer">4 {!! $lang[47] !!}</label>
                            
                            <input type="hidden" name="fraction_types" value="{{ isset($request->fraction_types) ? $request->fraction_types : 'simple_frac' }}" id="fraction_types">
                        </div>
                    </div>

                    <div class="n_one {{ isset($request->fraction_types) && $request->fraction_types === 'one_frac' ? '' : 'd-none' }}">
                        <table class="mx-auto" width="20%">
                            <tr>
                                <td>
                                    <input required type="number" step="any" name="a1"  value="{!! ((isset($request->a1)) ? $request->a1 : '3') !!}" class="input mb-1" aria-label="input field">
                                </td>
                            </tr>
                            <tr>
                                <td class="bdr-top">
                                    <input required type="number" step="any" name="b1"  value="{!! ((isset($request->b1)) ? $request->b1 : '8') !!}" class="input mt-1" aria-label="input field">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="{{ isset($request->fraction_types) && $request->fraction_types === 'one_frac' ? 'd-none' : '' }} {{ isset($request->fraction_types) && $request->fraction_types === 'simple_frac' ? 'col-lg-6 col-8' : ($request->fraction_types == 'three_frac' ? 'col-lg-9 col-12' : ($request->fraction_types == 'four_frac' ? 'col-12' : 'col-lg-6 col-8'))}} div_width mx-auto">
                    
                        <table class="mx-auto">
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" step="any" name="N1" tabindex="2" value="{!! ((isset($request->N1)) ? $request->N1 : '2') !!}" class="lg:w-[100px] md:w-[100px] w-[40px] input mb-1" aria-label="input field">
                                    </td>
                                    <td rowspan="2" style="width: 80px;padding: 0px 10px">
                                        <select name="action" tabindex="4" class="w-[50px] input action" aria-label="input select">
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
                                                    $name = ["+","-","×","÷"];
                                                    $val = ["+","-","×","÷"];
                                                }
                                                optionsList($val,$name,isset($request->action)?$request->action:'+');
                                            @endphp
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" step="any" name="N2" tabindex="6" class="lg:w-[100px] md:w-[100px] w-[40px] input mb-1" value="{!! ((isset($request->N2)) ? $request->N2 : '7') !!}" aria-label="input field">
                                    </td>
                                    <td rowspan="2" style="width: 80px;padding: 0px 10px" class="{{ isset($request->fraction_types) && ($request->fraction_types === 'three_frac' || $request->fraction_types === 'four_frac') ? '':'d-none' }} fraction_three_inputs">
                                        <select name="action1" tabindex="4" class=" w-[40px] input" aria-label="input select">
                                            <?php
                                                $name = ["+","-","×","÷"];
                                                $val = ["+","-","×","÷"];
                                                optionsList($val,$name,isset($request->action1)?$request->action1:'+');
                                            ?>
                                        </select>
                                    </td>
                                    <td class="{{ isset($request->fraction_types) && ($request->fraction_types === 'three_frac' || $request->fraction_types === 'four_frac') ? '':'d-none' }} fraction_three_inputs">
                                        <input type="number" step="any" tabindex="10" name="N3" value="{!! ((isset($request->N3)) ? $request->N3 : '10') !!}" class="lg:w-[100px] md:w-[100px] w-[40px] input mb-1" aria-label="input field">
                                    </td>
                                    @if($device == 'desktop') 
                                        <td rowspan="2" style="width: 80px;padding: 0px 10px" class="{{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'d-none' }} fraction_four_inputs">
                                            <select name="action2" tabindex="4" class=" w-[40px] input" aria-label="input select">
                                                <?php
                                                    $name = ["+","-","×","÷"];
                                                    $val = ["+","-","×","÷"];
                                                    optionsList($val,$name,isset($request->action2)?$request->action2:'+');
                                                ?>
                                            </select>
                                        </td>
                                        <td class="{{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'d-none' }} fraction_four_inputs">
                                            <input type="number" step="any" tabindex="10" name="N4" value="{!! ((isset($request->N4)) ? $request->N4 : '6') !!}" class="lg:w-[100px] md:w-[100px] w-[40px] input mb-1" aria-label="input field">
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="bdr-top">
                                        <input type="number" step="any" name="D1" aria-label="input field" value="{!! ((isset($request->D1)) ? $request->D1 : '11') !!}" tabindex="3" class="lg:w-[100px] md:w-[100px] w-[40px] input mt-1">
                                    </td>
                                    <td class="bdr-top">
                                        <input type="number" step="any" name="D2" value="{!! ((isset($request->D2)) ? $request->D2 : '10') !!}" tabindex="7" class="lg:w-[100px] md:w-[100px] w-[40px] input mt-1" aria-label="input field">
                                    </td>
                                    <td class="bdr-top {{ isset($request->fraction_types) && ($request->fraction_types === 'three_frac' || $request->fraction_types === 'four_frac') ? '':'d-none' }} fraction_three_inputs">
                                        <input type="number" step="any" tabindex="11" name="D3" value="{!! ((isset($request->D3)) ? $request->D3 : '22') !!}" class="lg:w-[100px] md:w-[100px] w-[40px] input mt-1" aria-label="input field">
                                    </td>
                                    @if ($device == 'desktop') 
                                        <td class="bdr-top {{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'d-none' }} fraction_four_inputs">
                                            <input type="number" step="any" tabindex="11" name="D4" value="{!! ((isset($request->D4)) ? $request->D4 : '16') !!}" class="lg:w-[100px] md:w-[100px] w-[40px] input mt-1" aria-label="input field">
                                        </td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if ($device == 'mobile') 
                        <div class="col-12 mt-2 flex  justify-center">
                            <table style="width: 40%">
                                <tbody>
                                    <tr>
                                        <td rowspan="2" style="width: 65px;" class="{{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'d-none' }} fraction_four_inputs">
                                            <select name="action2"  class="input" aria-label="input select">
                                                <?php
                                                    $name = ["+","-","×","÷"];
                                                    $val = ["+","-","×","÷"];
                                                    optionsList($val,$name,isset($request->action2)?$request->action2:'+');
                                                ?>
                                            </select>
                                        </td>
                                        <td class="{{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'d-none' }} fraction_four_inputs">
                                            <input required type="number" step="any"  name="N4" value="{!! ((isset($request->N4)) ? $request->N4 : '13') !!}" class="lg:w-[100px] md:w-[100px] w-[40px] input mb-1" aria-label="input field">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bdr-top {{ isset($request->fraction_types) && $request->fraction_types === 'four_frac' ? '':'d-none' }} fraction_four_inputs">
                                            <input required type="number" step="any"  name="D4" value="{!! ((isset($request->D4)) ? $request->D4 : '38') !!}" class="lg:w-[100px] md:w-[100px] w-[40px] input mb-1" aria-label="input field">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="col-lg-7 col-12 text-center mt-lg-4 mt-3 d-flex justify-content-center flex-wrap mx-auto">
                        <button type="submit" name="submit" value="calculate_fraction" class=" text-[#ffffff] bg-[#2845F5] rounded-[30px] px-4 py-2 ">{{ $lang['calculate'] }}</button>
                        <span id="resetButton" class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg cursor-pointer reset">Clear</span>
                    </div>
                </div>
            </div>
        </div>
        @if($submit == 'calculate_fraction')
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg p-4 flex items-center justify-center">
                    <div class="w-full  p-3 rounded-lg mt-3">
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
                            @if($fraction_types === "simple_frac")
                                <div class="col-span-12 bg-[#2845F5] text-white border rounded-lg text-lg px-3 py-2 mt-2">
                                    \(
                                        @if($action == '^')
                                            \left(\dfrac{{!! $N1 !!}}{{!! $D1 !!}}\right) {!! $action !!} {\dfrac{{!! $N2 !!}}{{!! $D2 !!}}} =
                                        @else
                                            \dfrac{{!! $N1 !!}}{{!! $D1 !!}} {!! $action !!} \dfrac{{!! $N2 !!}}{{!! $D2 !!}} =
                                        @endif
                                        @if($detail['btm'] != 1 && $detail['upr'] != 0)
                                            \dfrac{{!! $detail['upr'] !!}}{{!! $detail['btm'] !!}}
                                        @else
                                            {!! $detail['upr'] !!}
                                        @endif
                                    \)
                                </div>
                                <div class="col-span-12 mt-2">
                                    <p class="text-lg mt-2 font-bold">{!! $lang['ex'] !!}:</p>
                                    @if($action == 'of')
                                        <p class="mt-2">"{!! $lang[41] !!}" {!! $lang[3] !!}</p>
                                    @endif
                                    @php
                                        $gN1 = $N1;
                                        $gD1 = $D1;
                                        $gN2 = $N2;
                                        $gD2 = $D2;
                                        $gAct = $action;
                                    @endphp
                                    @if($N2 < 0 && $action == '+')
                                        <p class="text-center mt-2">
                                            \( \dfrac{ {!! $N1 !!} }{ {!! $D1 !!} } {!! $action !!} \dfrac{ {!! $N2 !!} }{ {!! $D2 !!} } = ? \)
                                        </p>
                                        <p class="mt-2">{!! $lang[5] !!}:</p>
                                        @php
                                            $action = '-';
                                            $N2 = abs($N2);
                                            $change = "{!! $lang[6] !!}";
                                        @endphp
                                    @elseif($N2 < 0 && $action == '-')
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
                                        @if($action == '^')
                                            \( \left(\dfrac{ {!! $N1 !!} }{ {!! $D1 !!} }\right) {!! $action !!} {\dfrac{ {!! $N2 !!} }{ {!! $D2 !!} }} = ? \)
                                        @else
                                            \( \dfrac{ {!! $N1 !!} }{ {!! $D1 !!} } {!! $action !!} \dfrac{ {!! $N2 !!} }{ {!! $D2 !!} } = ? \)
                                        @endif
                                    </p>
                                    <p class="text-lg mt-2 font-bold">{!! $lang['dec'] !!}:</p>
                                    <p class="mt-2 text-center">
                                        \( = {!! $detail['upr'] / $detail['btm'] !!} \)
                                    </p>
                                </div>
                                <div class="w-full lg:w-7/12 text-center gap-x-4 mt-4 flex justify-center flex-wrap mx-auto">
                                    <a href="{{ url()->current() }}/" class="bg-[#2845F5] text-white rounded-[30px] px-4 py-2 rounded-lg">
                                        Re{{ $lang['calculate'] }}
                                    </a>
                                </div>
                            @elseif($fraction_types === "three_frac")
                                <div class="col-span-12 bg-[#2845F5] text-white border rounded-lg text-lg px-3 py-2 mt-2">
                                    \( \dfrac{ {!! $N1 !!} }{ {!! $D1 !!} } {!! $action !!} \dfrac{ {!! $N2 !!} }{ {!! $D2 !!} } {!! $action1 !!} \dfrac{ {!! $N3 !!} }{ {!! $D3 !!} } =
                                    @if($detail['btm']!=1 && $detail['upr']!=0)
                                        \dfrac{ {!! $detail['upr'] !!} }{ {!! $detail['btm'] !!} }
                                    @else
                                        {!! $detail['upr'] !!}
                                    @endif
                                    \)
                                </div>
                                <div class="col-span-12 mt-2">
                                    <p class="text-xl font-semibold">{!! $lang['ex'] !!}:</p>
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
                                        } elseif (($action=='÷' || $action=='×') && ($action1=='÷' || $action1=='×')) {
                                            require resource_path('views/calculators/frac/three-mul-div.php');
                                        } elseif (($action=='÷' || $action=='×') && ($action1=='+' || $action1=='-')) {
                                            require resource_path('views/calculators/frac/three-mul-add.php');
                                        } elseif (($action1=='÷' || $action1=='×') && ($action=='+' || $action=='-')) {
                                            require resource_path('views/calculators/frac/three-div-sub.php');
                                        }
                                    @endphp
                                    <p class="text-xl font-semibold mt-2">{!! $lang['dec'] !!}:</p>
                                    <p class="text-lg text-center mt-2">\( = {!! $detail['upr']/$detail['btm'] !!} \)</p>
                                </div>
                                <div class="w-full lg:w-7/12 text-center gap-x-4 mt-4 flex justify-center flex-wrap mx-auto">
                                    <a href="{{ url()->current() }}/" class="bg-[#2845F5] text-white rounded-[30px] px-4 py-2 rounded-lg">
                                        Re{{ $lang['calculate'] }}
                                    </a>
                                </div>
                            @elseif($fraction_types === "four_frac")
                                <div class="col-span-12 bg-[#2845F5] text-white border rounded-lg text-lg px-3 py-2 mt-2">
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
                                            require resource_path('views/calculators/frac/four-add-mul-div.php');
                                        }
                                    @endphp
                                </div>
                                <div class="w-full lg:w-7/12 text-center gap-x-4 mt-4 flex justify-center flex-wrap mx-auto">
                                    <a href="{{ url()->current() }}/" class="bg-[#2845F5] text-white rounded-[30px] px-4 py-2 rounded-lg">
                                        Re{{ $lang['calculate'] }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </form>

    <form class="row" action="{{ url()->current() }}/" method="POST" id="myForm">
        @csrf
        <span class="mt-4 border-t border-gray-300 w-10/12 mx-auto block"></span>
        <div class="w-full lg:w-8/12 mx-auto">
            <h2 class="text-[#3c7c54] text-center mt-4 mb-2 text-2xl font-semibold">{{ $lang['44'] }}</h2>
            <div class="flex flex-wrap" id="mixed">
                @if($submit == 'calculate_mixed')
                    @if(isset($error))
                        <p class="text-lg text-center"><strong class="text-red-500">{{ $error }}</strong></p>
                    @endif
                @endif
                <div class="w-full lg:w-10/12 mx-auto">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-4/12 mt-3 lg:mt-4 px-2 lg:pr-3">
                            <div class="flex items-center justify-center">
                                <div class="pr-2">
                                    <input required type="number" name="s1" id="s1" class="input mb-2 w-full" value="{{ isset($request->s1) ? $request->s1 : '6' }}" aria-label="input" />
                                </div>
                                <div class="pl-2">
                                    <input required type="number" name="nu1" id="nu1" class="input mb-2 w-full" value="{{ isset($request->nu1) ? $request->nu1 : '1' }}" aria-label="input" />
                                    <hr class="my-2">
                                    <input required type="number" name="de1" id="de1" class="input mt-2 w-full" value="{{ isset($request->de1) ? $request->de1 : '8' }}" aria-label="input" />
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center lg:w-2/12 px-2 lg:px-4 mt-3 lg:mt-4 " style="align-items: center">
                            <label for="actions" class="block text-sm text-blue-500">&nbsp;</label>
                            <div class="w-full py-2">
                                <select name="actions" class="input w-full" id="actions" aria-label="select">
                                    <option value="+">+</option>
                                    <option value="-" {{ isset($request->actions) && $request->actions == '-' ? 'selected' : '' }}>-</option>
                                    <option value="×" {{ isset($request->actions) && $request->actions == '×' ? 'selected' : '' }}>×</option>
                                    <option value="÷" {{ isset($request->actions) && $request->actions == '÷' ? 'selected' : '' }}>÷</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full lg:w-4/12 mt-3 lg:mt-4 px-2 lg:pr-3">
                            <div class="flex items-center  justify-center">
                                <div class="pr-2">
                                    <input required type="number" name="s2" id="s2" class="input mb-2 w-full" value="{{ isset($request->s2) ? $request->s2 : '3' }}" aria-label="input" />
                                </div>
                                <div class="pl-2">
                                    <input required type="number" name="nu2" id="nu2" class="input mb-2 w-full" value="{{ isset($request->nu2) ? $request->nu2 : '6' }}" aria-label="input" />
                                    <hr class="my-2">
                                    <input required type="number" name="de2" id="de2" class="input mt-2 w-full" value="{{ isset($request->de2) ? $request->de2 : '9' }}" aria-label="input" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="w-full lg:w-7/12 text-center gap-x-4 mt-4 flex justify-center flex-wrap mx-auto">
                        <button type="submit" name="submit" value="calculate_mixed" class=" text-[#ffffff] bg-[#2845F5] rounded-[30px] px-4 py-2">{{ $lang['calculate'] }}</button>
                        <span id="resetButton2" class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg cursor-pointer reset">Clear</span>
                    </div>
            
            </div>
        </div>
        
        @if($submit == 'calculate_mixed')
        @isset($detail)
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                        @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                        @endif
                    <div class="rounded-lg p-4 flex items-center justify-center">
                        <div class=" p-4 rounded-lg mt-4">
                            <div class="grid grid-cols-1 gap-4">
                                @if($submit == 'calculate_mixed')
                                    <div class="text-base">
                                        <p class="mt-4 text-xl font-semibold">
                                            <strong>\(
                                                {{ isset($_POST['s1']) ? $_POST['s1'] : '' }} 
                                                \frac{{ $_POST['nu1'] }}{{ $_POST['de1'] }} 
                                                {{ $_POST['actions'] }} 
                                                {{ isset($_POST['s2']) ? $_POST['s2'] : '' }} 
                                                \frac{{ $_POST['nu2'] }}{{ $_POST['de2'] }} = 
                                                \frac{{ $detail['upr'] }}{{ $detail['btm'] }}
                                            \)</strong>
                                        </p>
                                        <p class="mt-4">{{$lang['ex']}}:</p>
                                        <p class="mt-3">
                                            {{$lang['input']}}:
                                            \(
                                                {{ isset($_POST['s1']) ? $_POST['s1'] : '' }} 
                                                \frac{{ $_POST['nu1'] }}{{ $_POST['de1'] }} 
                                                {{ $_POST['actions'] }} 
                                                {{ isset($_POST['s2']) ? $_POST['s2'] : '' }} 
                                                \frac{{ $_POST['nu2'] }}{{ $_POST['de2'] }} 
                                            \)
                                        </p>
                                        @if(is_numeric($_POST['s1']) || is_numeric($_POST['s2']))
                                            <p class="mt-3">{{$lang['step']}} # 1:
                                                \(
                                                    \frac{{ $detail['N1'] }}{{ $detail['D1'] }} 
                                                    {{ $_POST['actions'] }} 
                                                    \frac{{ $detail['N2'] }}{{ $detail['D2'] }}
                                                \)
                                            </p>
                                        @endif
                                        @if($_POST['actions'] == '×')
                                            <p class="mt-3">{{$lang['step']}} # 2 =
                                                \(
                                                    \frac{{ $detail['N1'] . '×' . $detail['N2'] }}{{ $detail['D1'] . '×' . $detail['D2'] }}
                                                \)
                                            </p>
                                        @elseif($_POST['actions'] == '÷')
                                            <p class="mt-3">{{$lang['step']}} # 2 =
                                                \(
                                                    \frac{{ $detail['N1'] . '×' . $detail['D2'] }}{{ $detail['N2'] . '×' . $detail['D1'] }}
                                                \)
                                            </p>
                                        @else
                                            <p class="mt-3">{{$lang['step']}} # 2 =
                                                \(
                                                    \frac{{ $detail['N1'] . '×' . $detail['D2'] }} {{ $_POST['actions'] }} 
                                                    {{ $detail['N2'] . '×' . $detail['D1'] }} 
                                                    \frac{{ $detail['D1'] . '×' . $detail['D2'] }}
                                                \)
                                            </p>
                                        @endif
                                        <p class="mt-3">{{$lang['step']}} # 3 =
                                            \(
                                                \frac{{ $detail['totalN'] }}{{ $detail['totalD'] }}
                                            \)
                                        </p>
                                        <p class="mt-3">{{$lang['step']}} # 4 =
                                            \(
                                                \frac{{ $detail['totalN'] . '÷' . $detail['g'] }}{{ $detail['totalD'] . '÷' . $detail['g'] }}
                                            \)
                                        </p>
                                        @if($detail['btm'] == '1')
                                            <p class="mt-3">{{$lang['an']}} =
                                                \({{ $detail['upr'] }}\)
                                            </p>
                                        @else
                                            <p class="mt-3">{{$lang['an']}} =
                                                \(\frac{{ $detail['upr'] }}{{ $detail['btm'] }}\)
                                            </p>
                                        @endif
                                        @if($detail['upr'] > $detail['btm'] && $detail['btm'] != '1')
                                            @php 
                                                $bta = $detail['upr'] % $detail['btm']; 
                                                $shi = floor($detail['upr'] / $detail['btm']); 
                                            @endphp
                                            <p class="mt-3">{{$lang['or']}} = {{$shi}}
                                                \(\frac{{ $bta }}{{ $detail['btm'] }}\)
                                            </p>
                                        @endif
                                        @if($detail['btm'] != '1')
                                            <p class="mt-3">{{$lang['dec']}}: {{ round($detail['upr'] / $detail['btm'], 4) }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="w-full lg:w-7/12 text-center gap-x-4 mt-4 flex justify-center flex-wrap mx-auto">
                                <a href="{{ url()->current() }}/" class="bg-[#2845F5] text-white rounded-[30px] px-4 py-2 ">
                                    Re{{ $lang['calculate'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        @endif

        @if ($type=='widget')
            @include('inc.widget-button')
        @endif
    </form>

    <form class="grid grid-cols-1" action="{{ url()->current() }}/" method="POST">
        @csrf
        <span class="mt-4 border-t border-gray-300 w-10/12 mx-auto"></span>
        <div class="w-full lg:w-4/12 mx-auto">
            <div class="grid grid-cols-1" id="simple">
                <h2 class="text-[#3c7c54] text-center mt-4 mb-2 text-2xl font-semibold ">{{$lang['45']}}</h2>
                @if($submit == 'calculate_simple')
                    @if(isset($error))
                        <p class="text-lg text-center">
                            <strong class="text-red-500">{{ $error }}</strong>
                        </p>
                    @endif
                @endif
                    <!-- Input fields -->
                    <div class="flex grid-cols-1 lg:grid-cols-1 lg:flex-row justify-center items-center mt-3 w-full">
                        <div class="w-full lg:pr-2">
                            <input required type="number" step="any" name="ne1" id="ne1" class="w-full p-2 border rounded-lg mb-2" value="{{ isset($_POST['ne1'])?$_POST['ne1']:'' }}" aria-label="input"/>
                        </div>
                        <div class="w-full lg:pl-2">
                            <input required type="number" step="any" name="neo2" id="neo2" class="w-full p-2 border rounded-lg mb-2" value="{{ isset($_POST['neo2'])?$_POST['neo2']:'' }}" aria-label="input"/>
                            <hr class="my-4 lg:hidden"> <!-- Only show hr on mobile -->
                            <input required type="number" step="any" name="du1" id="du1" class="w-full p-2 border rounded-lg mt-2" value="{{ isset($_POST['du1'])?$_POST['du1']:'' }}" aria-label="input"/>
                        </div>
                    </div>
                <!-- Submit and Clear buttons -->
                <div class=" flex-row lg:flex-row justify-center items-center mt-4 flex space-x-4 lg:space-y-0">
                    <button type="submit" name="submit" value="calculate_simple" class=" text-[#ffffff] bg-[#2845F5] rounded-[30px] px-4 py-2 ">{{ $lang['calculate'] }}</button>
                    <span id="resetButton3" class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 cursor-pointer rounded-lg reset">Clear</span>
                </div>
            </div>
        </div>
        
        @if($submit == 'calculate_simple')
            @isset($detail)
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                    <div class="rounded-lg p-4 flex items-center justify-center">
                        <div class="w-full   rounded-lg mt-6">
                            <div class="mt-4">
                                @if($submit == 'calculate_simple')
                                    <div class="text-lg">
                                        <p class="mt-2">
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
                                            {{$lang['step']}} #1 
                                            \( = \dfrac{ {{$detail['totalN']}} }{ {{$detail['totalD']}} } \)
                                        </p>
                                        <p class="mt-2">
                                            {{$lang['step']}} #2 
                                            \( = \dfrac{ ({{$detail['totalN'].' ÷ '.$detail['g']}}) }{ {{$detail['totalD'].' ÷ '.$detail['g']}} } \)
                                        </p>
                                        @if($detail['btm'] == '1')
                                            <p class="mt-2">
                                                {{$lang['an']}} = {{$detail['upr']}}
                                            </p>
                                        @else
                                            <p class="mt-2">
                                                {{$lang['an']}} 
                                                \( = \dfrac{ {{$detail['upr']}} }{ {{$detail['btm']}} } \)
                                            </p>
                                        @endif
                                        @if($detail['upr'] > $detail['btm'] && $detail['btm'] != '1')
                                            @php
                                                $bta=$detail['upr'] % $detail['btm'];
                                                $shi=floor($detail['upr'] / $detail['btm']);
                                            @endphp
                                            <p class="mt-2">
                                                {{$lang['or']}} 
                                                \( = {{$shi}} \dfrac{ {{$bta}} }{ {{$detail['btm']}} } \)
                                            </p>
                                        @endif
                                        @if($detail['btm'] != '1')
                                            <p class="mt-2">
                                                {{$lang['dec']}} = {{round($detail['upr'] / $detail['btm'], 4)}}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="w-full lg:w-7/12 text-center gap-x-4 mt-4 flex justify-center flex-wrap mx-auto">
                                <a href="{{ url()->current() }}/" class="bg-[#2845F5] text-white px-4 py-2 rounded-lg">
                                    Re{{ $lang['calculate'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endisset
        @endif
    </form>

</div>

@push('calculatorJS')
    @isset($detail)
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" 
        onload="renderMathInElement(document.body);"></script>     
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ url('js/jquery.fractionpainter.js') }}"></script>
    @endisset
    <script>
              document.getElementById('resetButton').addEventListener('click', function(event) {
                // event.preventDefault(); 
                var inputs = document.querySelectorAll('#fraction input');
                inputs.forEach(function(input) {
                    if (input.type !== 'hidden') {
                        input.removeAttribute('required'); // Remove the required attribute
                        input.value = ''; // Set the value property to an empty string
                        // input.setAttribute('required', ''); // Re-add the required attribute
                    }
                });
            });
            document.getElementById('resetButton2').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default behavior if needed
                var inputs = document.querySelectorAll('#mixed input');
                inputs.forEach(function(input) {
                    if (input.type !== 'hidden') {
                        input.value = ''; // Set the value property to an empty string
                    }
                });
            });
            document.getElementById('resetButton3').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default behavior if needed
                var inputs = document.querySelectorAll('#simple input');
                inputs.forEach(function(input) {
                    if (input.type !== 'hidden') {
                        input.value = ''; // Set the value property to an empty string
                    }
                });
            });

        document.getElementById('one').addEventListener('click',function(){
            document.getElementById('fraction_types').value = 'one_frac';
            document.querySelectorAll('.fraction_three_inputs').forEach(el =>{
                el.classList.add('d-none')
            });
            document.querySelectorAll('.fraction_four_inputs').forEach(element => {
            element.classList.add('d-none'); 
            });
            document.querySelector('.n_one').style.display = 'block';
            document.querySelector('.div_width').style.display = 'none';
        });
        document.getElementById('first').addEventListener('click',function(){
            document.getElementById('fraction_types').value = 'simple_frac';
            document.querySelectorAll('.fraction_three_inputs').forEach(el =>{
                el.classList.add('d-none')
            });
            document.querySelectorAll('.fraction_four_inputs').forEach(element => {
            element.classList.add('d-none'); 
            });
            document.querySelector('.n_one').style.display = 'none';
            document.querySelector('.div_width').style.display = 'block';
            document.querySelector('.div_width').classList.add('col-lg-6');
            document.querySelector('.div_width').classList.remove('col-lg-9');
            document.querySelector('.div_width').classList.remove('col-12');
            document.querySelector('.div_width').classList.add('col-7');
        });
        document.getElementById('second').addEventListener('click',function(){
            document.getElementById('fraction_types').value = 'three_frac';
            document.querySelectorAll('.fraction_three_inputs').forEach(el =>{
                el.classList.remove('d-none');
            });
            document.querySelectorAll('.fraction_four_inputs').forEach(element => {
            element.classList.add('d-none'); 
            });
            document.querySelector('.n_one').style.display = 'none';
            document.querySelector('.div_width').style.display = 'block';
            document.querySelector('.div_width').classList.remove('col-7');
            document.querySelector('.div_width').classList.add('col-lg-9');
            document.querySelector('.div_width').classList.remove('col-lg-6');
            document.querySelector('.div_width').classList.remove('col-8');
        });
        document.getElementById('three').addEventListener('click',function(){
            document.getElementById('fraction_types').value = 'four_frac';
            document.querySelectorAll('.fraction_three_inputs').forEach(el =>{
                el.classList.remove('d-none');
            });
            document.querySelectorAll('.fraction_four_inputs').forEach(element => {
            element.classList.remove('d-none');; 
            });
            document.querySelector('.n_one').style.display = 'none';
            document.querySelector('.div_width').style.display = 'block';
            document.querySelector('.div_width').classList.add('col-12');
            document.querySelector('.div_width').classList.remove('col-lg-9');
            document.querySelector('.div_width').classList.remove('col-lg-6');
            // document.querySelector('.div_width').classList.remove('col-12');
            document.querySelector('.div_width').classList.remove('col-7');
            document.querySelector('.div_width').classList.remove('col-8');
        });
        @if($submit == 'calculate_fraction')
            @if(isset($detail))
                var fraction_value = document.getElementById('fraction_types').value;
                if(fraction_value == 'one_frac'){
                    document.querySelectorAll('.fraction_three_inputs').forEach(el =>{
                        el.classList.add('d-none')
                    });
                    document.querySelectorAll('.fraction_four_inputs').forEach(element => {
                        element.classList.add('d-none'); 
                    });
                    document.querySelector('.div_width').style.display = 'none';
                }
            @endif
            @isset($detail)
                @if($device === "desktop")
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
                @else
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
                @endif
            @endisset
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>