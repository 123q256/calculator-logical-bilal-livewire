<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1    gap-4">
                <div class="space-y-2">
                    <label for="to_calculate" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select class="input" aria-label="select" name="to_calculate" id="to_calculate">
                        <option value="f" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='f'?'selected':'' }}>{{$lang['2']}}</option>
                        <option value="af" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='af'?'selected':'' }}>{{$lang['3']}}</option>
                        <option value="sf" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='sf'?'selected':'' }}>{{$lang['4']}}</option>
                        <option value="mf" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='mf'?'selected':'' }}>{{$lang['5']}}</option>
                        <option value="df" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='df'?'selected':'' }}>{{$lang['6']}}</option>
                    </select>
                </div>
                <p class="w-full  mt-3 text-center">
                    <strong id="textChanged">
                        @if(isset($_POST['to_calculate']) && $_POST['to_calculate']==='af')
                            {{ $lang['7'] }} (n! + m!)
                        @elseif(isset($_POST['to_calculate']) && $_POST['to_calculate']==='sf')
                            {{ $lang['7'] }} (n! - m!)
                        @elseif(isset($_POST['to_calculate']) && $_POST['to_calculate']==='mf')
                            {{ $lang['7'] }} (n! x m!)
                        @elseif(isset($_POST['to_calculate']) && $_POST['to_calculate']==='df')
                            {{ $lang['7'] }} (n! / m!)
                        @else
                            {{ $lang['7'] }} n!
                        @endif
                    </strong>
                </p>
                <div class="space-y-2">
                    <label for="nvalue" class="font-s-14 text-blue">n</label>
                    <input type="number" step="any" name="nvalue" id="nvalue" min="0" class="input" value="{{ isset($_POST['nvalue'])?$_POST['nvalue']:'5' }}" aria-label="input"/>
                </div>
                <div class="space-y-2 {{ isset($_POST['to_calculate']) && ($_POST['to_calculate']==='af' || $_POST['to_calculate']==='sf' || $_POST['to_calculate']==='mf' || $_POST['to_calculate']==='df') ? 'd-block':'hidden' }}" id="mInput">
                    <label for="mvalue" class="font-s-14 text-blue">m</label>
                    <input type="number" step="any" name="mvalue" id="mvalue" min="0" class="input" value="{{ isset($_POST['mvalue'])?$_POST['mvalue']:'7' }}" aria-label="input"/>
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
                
                <div class="w-full radius-10 mt-3">
                    <div class="w-full">
                        @if($_POST['to_calculate']=='f' && $detail['fa']!='INF')
                            <div class="w-full mt-2">
                                <table class="w-full md:w-[30%] lg:w-[30%] font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}} {{$_POST['nvalue']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['fa']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 font-s-16 mt-2">
                                <p><strong>{{$lang['9']}}</strong></p>
                                <p class="mt-2">{{$lang['10']}}:</p>
                                <p class="mt-2">n = {{$_POST['nvalue']}}</p>
                                <p class="mt-2">n ! = {{$detail['a']}}</p>
                                <p class="mt-2">n ! = {{$detail['fa']}}</p>
                            </div>
                        @elseif($_POST['to_calculate']=='af' && $detail['add']!='INF')
                            <div class="w-full mt-2">
                                <table class="w-full md:w-[30%] lg:w-[30%] font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fa']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fam']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n! + m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['add']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 font-s-16 mt-2">
                                <p><strong>{{$lang['9']}}:</strong></p>
                                <p class="mt-2">{{$lang['10']}}:</p>
                                <p class="mt-2">n = {{$_POST['nvalue']}}</p>
                                <p class="mt-2">m = {{$_POST['mvalue']}}</p>
                                <p class="mt-2">n ! = {{$detail['a']}}</p>
                                <p class="mt-2">n ! = {{$detail['fa']}}</p>
                                <p class="mt-2">m ! = {{$detail['b']}}</p>
                                <p class="mt-2">m ! = {{$detail['fam']}}</p>
                                <p class="mt-2">n ! + m ! = {{$detail['fa']}} + {{$detail['fam']}}</p>
                                <p class="mt-2">n ! + m ! = {{$detail['add']}}</p>
                            </div>
                        @elseif($_POST['to_calculate']=='sf' && $detail['sub']!='INF')
                            <div class="w-full mt-2">
                                <table class="w-full md:w-[30%] lg:w-[30%] font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fa']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fam']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n! - m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['sub']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 font-s-16 mt-2">
                                <p><strong>{{$lang['9']}}:</strong></p>
                                <p class="mt-2">{{$lang['10']}}:</p>
                                <p class="mt-2">n = {{$_POST['nvalue']}}</p>
                                <p class="mt-2">m = {{$_POST['mvalue']}}</p>
                                <p class="mt-2">n ! = {{$detail['a']}}</p>
                                <p class="mt-2">n ! = {{$detail['fa']}}</p>
                                <p class="mt-2">m ! = {{$detail['b']}}</p>
                                <p class="mt-2">m ! = {{$detail['fam']}}</p>
                                <p class="mt-2">n !- m ! = {{$detail['fa']}}- {{$detail['fam']}}</p>
                                <p class="mt-2">n ! - m ! = {{$detail['sub']}}</p>
                            </div>
                        @elseif($_POST['to_calculate']=='mf' && $detail['mul']!='INF')
                            <div class="w-full mt-2">
                                <table class="w-full md:w-[30%] lg:w-[30%] font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fa']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fam']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n! x m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['mul']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 font-s-16 mt-2">
                                <p><strong>{{$lang['9']}}:</strong></p>
                                <p class="mt-2">{{$lang['10']}}:</p>
                                <p class="mt-2">n = {{$_POST['nvalue']}}</p>
                                <p class="mt-2">m = {{$_POST['mvalue']}}</p>
                                <p class="mt-2">n ! = {{$detail['a']}}</p>
                                <p class="mt-2">n ! = {{$detail['fa']}}</p>
                                <p class="mt-2">m ! = {{$detail['b']}}</p>
                                <p class="mt-2">m ! = {{$detail['fam']}}</p>
                                <p class="mt-2">n ! x m ! = {{$detail['fa']}} x {{$detail['fam']}}</p>
                                <p class="mt-2">n ! x m ! = {{$detail['mul']}}</p>
                            </div>
                        @else
                            <div class="w-full mt-2">
                                <table class="w-full md:w-[30%] lg:w-[30%] font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fa']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['fam']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n! / m!</strong></td>
                                        <td class="py-2 border-b">{{$detail['div']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 font-s-16 mt-2">
                                <p><strong>{{$lang['9']}}:</strong></p>
                                <p class="mt-2">{{$lang['10']}}:</p>
                                <p class="mt-2"> n = {{$_POST['nvalue']}}</p>
                                <p class="mt-2"> m = {{$_POST['mvalue']}}</p>
                                <p class="mt-2"> n ! = {{$detail['a']}}</p>
                                <p class="mt-2"> n ! = {{$detail['fa']}}</p>
                                <p class="mt-2"> m ! = {{$detail['b']}}</p>
                                <p class="mt-2"> m ! = {{$detail['fam']}}</p>
                                <p class="mt-2">n ! / m ! = {{$detail['fa']}} / {{$detail['fam']}}</p>
                                <p class="mt-2">n ! / m ! = {{$detail['div']}}</p>
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
            document.getElementById('to_calculate').addEventListener("change", function() {
                var selectedValue = this.value;
                switch(selectedValue) {
                    case 'f':
                        document.getElementById('textChanged').textContent = '{{ $lang['7'] }} n!';
                        document.getElementById('mInput').style.display = 'none';
                        break;
                    case 'af':
                        document.getElementById('textChanged').textContent = '{{ $lang['7'] }} (n! + m!)';
                        document.getElementById('mInput').style.display = 'block';
                        break;
                    case 'sf':
                        document.getElementById('textChanged').textContent = '{{ $lang['7'] }} (n! - m!)';
                        document.getElementById('mInput').style.display = 'block';
                        break;
                    case 'mf':
                        document.getElementById('textChanged').textContent = '{{ $lang['7'] }} (n! x m!)';
                        document.getElementById('mInput').style.display = 'block';
                        break;
                    case 'df':
                        document.getElementById('textChanged').textContent = '{{ $lang['7'] }} (n! / m!)';
                        document.getElementById('mInput').style.display = 'block';
                        break;
                }
            });
        </script>
    @endpush
</form>