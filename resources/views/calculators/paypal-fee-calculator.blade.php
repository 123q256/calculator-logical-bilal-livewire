<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 gap-4">
                <div class="space-y-2">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['x'] }}</label>
                    <input type="number" step="any" name="x" id="x" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['x'])?$_POST['x']:'413' }}" />
                    <span class="text-blue input-unit">{{ $currancy}}</span>
                </div>
                <div class="space-y-2">
                    <label for="rate" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select id="rate" name="rate" class="input mt-2">
                        @if(isset($_POST['rate']))
                            @if($_POST['rate']=='1')
                                <optgroup label="{{$lang['dom']}}">
                                    <option value="0">2.9% + $.30 ({{$lang['online']}})</option>
                                    <option value="1" selected>2.7% + $.30 ({{$lang['store']}})</option>
                                    <option value="2">2.2% + $.30 ({{$lang['non']}})</option>
                                    <option value="3">5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['inter']}}">
                                    <option value="4">4.4% + $.30 ({{$lang['online']}})</option>
                                    <option value="5">4.2% + $.30 ({{$lang['store']}})</option>
                                    <option value="6">3.7% + $.30 ({{$lang['non']}})</option>
                                    <option value="7">6.5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['mob']}}">
                                    <option value="8">2.7% ({{$lang['swip']}})</option>
                                    <option value="9">3.5% + $.15 ({{$lang['key']}})</option>
                                </optgroup><optgroup label="{{$lang['vir']}}">
                                    <option value="10">3.1% + $.30</option>
                                </optgroup>
                                @elseif($_POST['rate']=='0')
                                <optgroup label="{{$lang['dom']}}">
                                    <option value="0" selected="">2.9% + $.30 ({{$lang['online']}})</option>
                                    <option value="1">2.7% + $.30 ({{$lang['store']}})</option>
                                    <option value="2">2.2% + $.30 ({{$lang['non']}})</option>
                                    <option value="3">5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['inter']}}">
                                    <option value="4">4.4% + $.30 ({{$lang['online']}})</option>
                                    <option value="5">4.2% + $.30 ({{$lang['store']}})</option>
                                    <option value="6">3.7% + $.30 ({{$lang['non']}})</option>
                                    <option value="7">6.5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['mob']}}">
                                    <option value="8">2.7% ({{$lang['swip']}})</option>
                                    <option value="9">3.5% + $.15 ({{$lang['key']}})</option>
                                </optgroup><optgroup label="{{$lang['vir']}}">
                                    <option value="10">3.1% + $.30</option>
                                </optgroup>
                                @elseif($_POST['rate']=='2')
                                <optgroup label="{{$lang['dom']}}">
                                    <option value="0">2.9% + $.30 ({{$lang['online']}})</option>
                                    <option value="1">2.7% + $.30 ({{$lang['store']}})</option>
                                    <option value="2" selected>2.2% + $.30 ({{$lang['non']}})</option>
                                    <option value="3">5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['inter']}}">
                                    <option value="4">4.4% + $.30 ({{$lang['online']}})</option>
                                    <option value="5">4.2% + $.30 ({{$lang['store']}})</option>
                                    <option value="6">3.7% + $.30 ({{$lang['non']}})</option>
                                    <option value="7">6.5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['mob']}}">
                                    <option value="8">2.7% ({{$lang['swip']}})</option>
                                    <option value="9">3.5% + $.15 ({{$lang['key']}})</option>
                                </optgroup><optgroup label="{{$lang['vir']}}">
                                    <option value="10">3.1% + $.30</option>
                                </optgroup>
                                @elseif($_POST['rate']=='3')
                                <optgroup label="{{$lang['dom']}}">
                                    <option value="0">2.9% + $.30 ({{$lang['online']}})</option>
                                    <option value="1">2.7% + $.30 ({{$lang['store']}})</option>
                                    <option value="2">2.2% + $.30 ({{$lang['non']}})</option>
                                    <option value="3" selected="">5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['inter']}}">
                                    <option value="4">4.4% + $.30 ({{$lang['online']}})</option>
                                    <option value="5">4.2% + $.30 ({{$lang['store']}})</option>
                                    <option value="6">3.7% + $.30 ({{$lang['non']}})</option>
                                    <option value="7">6.5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['mob']}}">
                                    <option value="8">2.7% ({{$lang['swip']}})</option>
                                    <option value="9">3.5% + $.15 ({{$lang['key']}})</option>
                                </optgroup><optgroup label="{{$lang['vir']}}">
                                    <option value="10">3.1% + $.30</option>
                                </optgroup>
                                @elseif($_POST['rate']=='4')
                                <optgroup label="{{$lang['dom']}}">
                                    <option value="0">2.9% + $.30 ({{$lang['online']}})</option>
                                    <option value="1">2.7% + $.30 ({{$lang['store']}})</option>
                                    <option value="2">2.2% + $.30 ({{$lang['non']}})</option>
                                    <option value="3">5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['inter']}}">
                                    <option value="4" selected="">4.4% + $.30 ({{$lang['online']}})</option>
                                    <option value="5">4.2% + $.30 ({{$lang['store']}})</option>
                                    <option value="6">3.7% + $.30 ({{$lang['non']}})</option>
                                    <option value="7">6.5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['mob']}}">
                                    <option value="8">2.7% ({{$lang['swip']}})</option>
                                    <option value="9">3.5% + $.15 ({{$lang['key']}})</option>
                                </optgroup><optgroup label="{{$lang['vir']}}">
                                    <option value="10">3.1% + $.30</option>
                                </optgroup>
                                @elseif($_POST['rate']=='5')
                                <optgroup label="{{$lang['dom']}}">
                                    <option value="0">2.9% + $.30 ({{$lang['online']}})</option>
                                    <option value="1">2.7% + $.30 ({{$lang['store']}})</option>
                                    <option value="2">2.2% + $.30 ({{$lang['non']}})</option>
                                    <option value="3">5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['inter']}}">
                                    <option value="4">4.4% + $.30 ({{$lang['online']}})</option>
                                    <option value="5" selected="">4.2% + $.30 ({{$lang['store']}})</option>
                                    <option value="6">3.7% + $.30 ({{$lang['non']}})</option>
                                    <option value="7">6.5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['mob']}}">
                                    <option value="8">2.7% ({{$lang['swip']}})</option>
                                    <option value="9">3.5% + $.15 ({{$lang['key']}})</option>
                                </optgroup><optgroup label="{{$lang['vir']}}">
                                    <option value="10">3.1% + $.30</option>
                                </optgroup>
                                @elseif($_POST['rate']=='6')
                                <optgroup label="{{$lang['dom']}}">
                                    <option value="0">2.9% + $.30 ({{$lang['online']}})</option>
                                    <option value="1">2.7% + $.30 ({{$lang['store']}})</option>
                                    <option value="2">2.2% + $.30 ({{$lang['non']}})</option>
                                    <option value="3">5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['inter']}}">
                                    <option value="4">4.4% + $.30 ({{$lang['online']}})</option>
                                    <option value="5">4.2% + $.30 ({{$lang['store']}})</option>
                                    <option value="6" selected="">3.7% + $.30 ({{$lang['non']}})</option>
                                    <option value="7">6.5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['mob']}}">
                                    <option value="8">2.7% ({{$lang['swip']}})</option>
                                    <option value="9">3.5% + $.15 ({{$lang['key']}})</option>
                                </optgroup><optgroup label="{{$lang['vir']}}">
                                    <option value="10">3.1% + $.30</option>
                                </optgroup>
                                @elseif($_POST['rate']=='7')
                                <optgroup label="{{$lang['dom']}}">
                                    <option value="0">2.9% + $.30 ({{$lang['online']}})</option>
                                    <option value="1">2.7% + $.30 ({{$lang['store']}})</option>
                                    <option value="2">2.2% + $.30 ({{$lang['non']}})</option>
                                    <option value="3">5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['inter']}}">
                                    <option value="4">4.4% + $.30 ({{$lang['online']}})</option>
                                    <option value="5">4.2% + $.30 ({{$lang['store']}})</option>
                                    <option value="6">3.7% + $.30 ({{$lang['non']}})</option>
                                    <option value="7" selected="">6.5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['mob']}}">
                                    <option value="8">2.7% ({{$lang['swip']}})</option>
                                    <option value="9">3.5% + $.15 ({{$lang['key']}})</option>
                                </optgroup><optgroup label="{{$lang['vir']}}">
                                    <option value="10">3.1% + $.30</option>
                                </optgroup>
                                @elseif($_POST['rate']=='8')
                                <optgroup label="{{$lang['dom']}}">
                                    <option value="0">2.9% + $.30 ({{$lang['online']}})</option>
                                    <option value="1">2.7% + $.30 ({{$lang['store']}})</option>
                                    <option value="2">2.2% + $.30 ({{$lang['non']}})</option>
                                    <option value="3">5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['inter']}}">
                                    <option value="4">4.4% + $.30 ({{$lang['online']}})</option>
                                    <option value="5">4.2% + $.30 ({{$lang['store']}})</option>
                                    <option value="6">3.7% + $.30 ({{$lang['non']}})</option>
                                    <option value="7">6.5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['mob']}}">
                                    <option value="8" selected="">2.7% ({{$lang['swip']}})</option>
                                    <option value="9">3.5% + $.15 ({{$lang['key']}})</option>
                                </optgroup><optgroup label="{{$lang['vir']}}">
                                    <option value="10">3.1% + $.30</option>
                                </optgroup>
                                @elseif($_POST['rate']=='9')
                                <optgroup label="{{$lang['dom']}}">
                                    <option value="0">2.9% + $.30 ({{$lang['online']}})</option>
                                    <option value="1">2.7% + $.30 ({{$lang['store']}})</option>
                                    <option value="2">2.2% + $.30 ({{$lang['non']}})</option>
                                    <option value="3">5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['inter']}}">
                                    <option value="4">4.4% + $.30 ({{$lang['online']}})</option>
                                    <option value="5">4.2% + $.30 ({{$lang['store']}})</option>
                                    <option value="6">3.7% + $.30 ({{$lang['non']}})</option>
                                    <option value="7">6.5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['mob']}}">
                                    <option value="8">2.7% ({{$lang['swip']}})</option>
                                    <option value="9" selected="">3.5% + $.15 ({{$lang['key']}})</option>
                                </optgroup><optgroup label="{{$lang['vir']}}">
                                    <option value="10">3.1% + $.30</option>
                                </optgroup>
                                @elseif($_POST['rate']=='10')
                                <optgroup label="{{$lang['dom']}}">
                                    <option value="0">2.9% + $.30 ({{$lang['online']}})</option>
                                    <option value="1">2.7% + $.30 ({{$lang['store']}})</option>
                                    <option value="2">2.2% + $.30 ({{$lang['non']}})</option>
                                    <option value="3">5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['inter']}}">
                                    <option value="4">4.4% + $.30 ({{$lang['online']}})</option>
                                    <option value="5">4.2% + $.30 ({{$lang['store']}})</option>
                                    <option value="6">3.7% + $.30 ({{$lang['non']}})</option>
                                    <option value="7">6.5% + $.05 ({{$lang['micro']}})</option>
                                </optgroup>
                                <optgroup label="{{$lang['mob']}}">
                                    <option value="8">2.7% ({{$lang['swip']}})</option>
                                    <option value="9">3.5% + $.15 ({{$lang['key']}})</option>
                                </optgroup><optgroup label="{{$lang['vir']}}">
                                    <option value="10" selected="">3.1% + $.30</option>
                                </optgroup>
                                @endif
                            @else
                            <optgroup label="{{$lang['dom']}}">
                                <option value="0" selected="">2.9% + $.30 ({{$lang['online']}})</option>
                                <option value="1">2.7% + $.30 ({{$lang['store']}})</option>
                                <option value="2">2.2% + $.30 ({{$lang['non']}})</option>
                                <option value="3">5% + $.05 ({{$lang['micro']}})</option>
                            </optgroup>
                            <optgroup label="{{$lang['inter']}}">
                                <option value="4">4.4% + $.30 ({{$lang['online']}})</option>
                                <option value="5">4.2% + $.30 ({{$lang['store']}})</option>
                                <option value="6">3.7% + $.30 ({{$lang['non']}})</option>
                                <option value="7">6.5% + $.05 ({{$lang['micro']}})</option>
                            </optgroup>
                            <optgroup label="{{$lang['mob']}}">
                                <option value="8">2.7% ({{$lang['swip']}})</option>
                                <option value="9">3.5% + $.15 ({{$lang['key']}})</option>
                            </optgroup><optgroup label="{{$lang['vir']}}">
                                <option value="10">3.1% + $.30</option>
                            </optgroup>
                            @endif
                    </select>
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
    
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue  rounded-lg mt-6">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-4">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 w-3/4"><strong>{{ $lang['want'] }} {{ isset($_POST['x'])?$_POST['x']:'' }} {{ $currancy }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-3/4"><strong>{{ $lang['ask_for'] }}</strong></td>
                                    <td class="py-2 border-b">{{$currancy }} {{$detail['send']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-3/4"><strong>{{ $lang['s_fee'] }}</strong></td>
                                    <td class="py-2 border-b">{{$currancy }} {{$detail['fee1']}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-4">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 w-3/4"><strong>{{ $lang['ask'] }} {{ isset($_POST['x'])?$_POST['x']:'' }} {{ $currancy }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-3/4"><strong>{{ $lang['get'] }}</strong></td>
                                    <td class="py-2 border-b">{{$currancy }} {{$detail['receive']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-3/4"><strong>{{ $lang['s_fee'] }}</strong></td>
                                    <td class="py-2 border-b">{{$currancy }} {{$detail['fee']}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>