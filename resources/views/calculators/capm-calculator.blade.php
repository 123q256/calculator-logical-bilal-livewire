<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="cal" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 relative">
                    <select name="cal" id="cal" class="input">
                        <option value="R"  {{ isset($_POST['cal']) && $_POST['cal']=='R'?'selected':''}}   >{{ $lang['2']." (R)" }}</option>
                        <option value="Bi"  {{ isset($_POST['cal']) && $_POST['cal']=='Bi'?'selected':''}}  >{{ $lang['3']." (βᵢ)"}}</option>
                        <option value="Rf"  {{ isset($_POST['cal']) && $_POST['cal']=='Rf'?'selected':''}}  >{{ $lang['4']." (Rf)"}}</option>
                        <option value="Rm"  {{ isset($_POST['cal']) && $_POST['cal']=='Rm'?'selected':''}}  >{{ $lang['5']." (Rm)"}}</option>
                    </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="rx">
                    <label for="r" class="label">{{ $lang['2'] }} (R)</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="r" id="r" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['r'])?$_POST['r']:'50' }}" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="rfx">
                    <label for="rf" class="label">{{ $lang['4'] }} (Rf)</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="rf" id="rf" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['rf'])?$_POST['rf']:'50' }}" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6"  id="rmx">
                    <label for="rm" class="label">{{ $lang['5'] }} (Rm)</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="rm" id="rm" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['rm'])?$_POST['rm']:'50' }}" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6"  id="bix">
                    <label for="bi" class="label">{{ $lang['5'] }} (βi)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="bi" id="bi" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['bi'])?$_POST['bi']:'50' }}" />
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
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-100 font-s-18">
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>
                                @if($detail['cal'])
                                    {{$lang['6']}}
                                @elseif($detail['cal']==='Bi')
                                    {{$lang['7']}}
                                @elseif($detail['cal']==='Rf')
                                    {{$lang['8']}}
                                @elseif($detail['cal']==='Rm')
                                    {{$lang['9']}}
                                @endif
                            </strong></td>
                            <td class="py-2 border-b"> 
                                @if($detail['cal'])
                                {{$detail['R']}}
                                @elseif($detail['cal']==='Bi')
                                {{$detail['Bi']}}
                                @elseif($detail['cal']==='Rf')
                                {{$detail['Rf']}}
                                @elseif($detail['cal']==='Rm')
                                {{$detail['Rm']}}
                                @endif
                              %
                        </td>
                        </tr>
                        </table>
                    </div>
                    <div class="w-full  text-[16px]">
                        <div class="col s12 margin_top_10">
                            <p class="mt-4"><strong>{{$lang['10']}}:</strong></p>
                            @if($detail['cal']==='R')
                            <p class="mt-2"><strong>{{$lang['6']}}</strong></p>
                            <p class="mt-2">{{$lang['11']}} = Rf + Bi * (Rm - Rf)</p>
                            <p class="mt-2">{{$lang['11']}} = {{$detail['Rf']}} + {{$detail['Bi']}} * ({{ $detail['Rm'] }} − {{$detail['Rf']}})</p>
                            <p class="mt-2">{{$lang['11']}} = {{$detail['Rf']}} + ({{$detail['Bi']}} * {{$detail['Emp']}})</p>
                            <p class="mt-2">{{$lang['11']}} = {{$detail['Rf']}} + {{$detail['Rp']}} = <strong>{{$detail['R'] }}%</strong></p>
                             @elseif($detail['cal']==='Bi')
                            <p class="mt-2"><strong><?=$lang['12']?></strong></p>
                            <p class="mt-2">{{$lang['13']}} = (R - Rf) / (Rm - Rf)</p>
                            <p class="mt-2">{{$lang['13']}} = ({{$detail['R']}} - {{$detail['Rf']}}) / ({{ $detail['Rm'] }} − {{$detail['Rf']}})</p>
                            <p class="mt-2">{{$lang['13']}} = {{$detail['s1']}} / {{$detail['Emp']}} = <strong>{{ $detail['Bi']}}%</strong></p>
                             @elseif($detail['cal']==='Rf')
                            <p class="mt-2"><strong><?=$lang['8']?></strong></p>
                            <p class="mt-2">{{$lang['14']}} = ((Bi * Rm) - R) / (Bi - 1)</p>
                            <p class="mt-2">{{$lang['14']}} = (({{ $detail['Bi'] }} * {{ $detail['Rm'] }}) - {{$detail['R']}}) / ({{ $detail['Bi'] }} − 1)</p>
                            <p class="mt-2">{{$lang['14']}} = ({{$detail['s1']}} - {{$detail['R']}}) / ({{ $detail['Bi'] }} − 1)</p>
                            <p class="mt-2">{{$lang['14']}} = {{$detail['s2']}} / {{$detail['s3']}} = <strong>{{ $detail['Rf']}}%</strong></p>
                            @elseif($detail['cal']==='Rm')
                            <p class="mt-2"><strong><?=$lang['9']?></strong></p>
                            <p class="mt-2">{{$lang['15']}} = (Rf * (Bi - 1) + R) / Bi</p>
                            <p class="mt-2">{{$lang['15']}} = ({{$detail['Rf']}} * ({{ $detail['Bi'] }} - 1) + {{$detail['R']}}) / {{ $detail['Bi'] }}</p>
                            <p class="mt-2">{{$lang['15']}} = (({{$detail['Rf']}} * {{$detail['s1']}}) + {{$detail['R']}}) / {{ $detail['Bi'] }}</p>
                            <p class="mt-2">{{$lang['15']}} = ({{$detail['s2']}} + {{$detail['R']}}) / {{ $detail['Bi'] }}</p>
                            <p class="mt-2">{{$lang['15']}} = {{$detail['s3']}} / {{ $detail['Bi'] }} = <strong>{{ $detail['Rm'] }}%</strong></p>
                            @endif
                            <p class="mt-2"><strong><?=$lang['16']?></strong></p>
                            <p class="mt-2">{{$lang['17']}} = Bi * (Rm - Rf)</p>
                            <p class="mt-2">{{$lang['17']}} = {{ $detail['Bi'] }} * ({{ $detail['Rm'] }} − {{$detail['Rf']}}) = <strong>{{ $detail['Rp'] }}%</strong></p>
                            <p class="mt-2"><strong>{{$lang['18'] }}</strong></p>
                            <p class="mt-2">{{$lang['18'] }} = Rm - Rf</p>
                            <p class="mt-2">{{$lang['18'] }} = {{ $detail['Rm'] }} − {{$detail['Rf']}} = <strong>{{$detail['Emp']}}%</strong></p>
                            <p class="mt-2"><strong>{{$lang['19'] }}</strong></p>
                            <p class="mt-2">{{$lang['11']}} = (Rf + Bi * (Rm - Rf)) + ((Rm * Bi) / Rf)</p>
                            <p class="mt-2">{{$lang['11']}} = ({{$detail['Rf']}} + {{ $detail['Bi'] }} * ({{ $detail['Rm'] }} − {{$detail['Rf']}})) + (({{ $detail['Rm'] }} * {{$detail['Bi']}}) / {{$detail['Rf']}})</p>
                            <p class="mt-2">{{$lang['11']}} = {{$detail['R']}} + {{$detail['Rmr']}} = <strong>{{ $detail['Rmrp'] }}%</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
    @isset($detail)
        <script>
            let dropVal = "{{$detail['cal']}}";
            if (dropVal === 'R') {
                document.getElementById('rfx').style.display = 'block';
                document.getElementById('rmx').style.display = 'block';
                document.getElementById('bix').style.display = 'block';
                document.getElementById('rx').style.display = 'none';
            } else if (dropVal === 'Bi') {
                document.getElementById('rfx').style.display = 'block';
                document.getElementById('rmx').style.display = 'block';
                document.getElementById('rx').style.display = 'block';
                document.getElementById('bix').style.display = 'none';
            } else if (dropVal === 'Rf') {
                document.getElementById('rmx').style.display = 'block';
                document.getElementById('rx').style.display = 'block';
                document.getElementById('bix').style.display = 'block';
                document.getElementById('rfx').style.display = 'none';
            } else if (dropVal === 'Rm') {
                document.getElementById('rfx').style.display = 'block';
                document.getElementById('rx').style.display = 'block';
                document.getElementById('bix').style.display = 'block';
                document.getElementById('rmx').style.display = 'none';
            }
        </script>
    @endisset
    <script>
        document.getElementById('cal').addEventListener('change', function() {
            var selectedValue = this.value;
            if (selectedValue === 'R') {
                document.getElementById('rfx').style.display = 'block';
                document.getElementById('rmx').style.display = 'block';
                document.getElementById('bix').style.display = 'block';
                document.getElementById('rx').style.display = 'none';
            } else if (selectedValue === 'Bi') {
                document.getElementById('rfx').style.display = 'block';
                document.getElementById('rmx').style.display = 'block';
                document.getElementById('rx').style.display = 'block';
                document.getElementById('bix').style.display = 'none';
            } else if (selectedValue === 'Rf') {
                document.getElementById('rmx').style.display = 'block';
                document.getElementById('rx').style.display = 'block';
                document.getElementById('bix').style.display = 'block';
                document.getElementById('rfx').style.display = 'none';
            } else if (selectedValue === 'Rm') {
                document.getElementById('rfx').style.display = 'block';
                document.getElementById('rx').style.display = 'block';
                document.getElementById('bix').style.display = 'block';
                document.getElementById('rmx').style.display = 'none';
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>