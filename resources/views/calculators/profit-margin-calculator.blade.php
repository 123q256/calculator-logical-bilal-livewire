<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['chose'] }}:</label>
                    <select name="method" id="method" class="input mt-2">
                        <option value="Gross" {{ isset($_POST['method']) && $_POST['method']=='Gross'?'selected':''}} >{{ $lang['g_m']}}</option>
                        <option value="Net" {{ isset($_POST['method']) && $_POST['method']=='Net'?'selected':''}}>{{ $lang['n_p_m']}}</option>
                        <option value="Operating" {{ isset($_POST['method']) && $_POST['method']=='Operating'?'selected':''}}>{{ $lang['o_p_m']}}</option>
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="x" class="font-s-14 text-blue" id="x"></label>
                    <input type="number" step="any" name="x" id="x" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['x'])?$_POST['x']:'50' }}" />
                    <span class="input_unit">{{ $currancy}}</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="y" class="font-s-14 text-blue" id="y"></label>
                    <input type="number" step="any" name="y" id="y" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['y'])?$_POST['y']:'50' }}" />
                    <span class="input_unit">{{ $currancy}}</span>
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
                                <td class="py-2 border-b w-7/10 font-bold">{{ $lang['margin'] }}</td>
                                <td class="py-2 border-b">
                                    @if(isset($detail['margin']))
                                    {{$detail['margin']}}
                                    @else
                                    0.0 %
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-7/10 font-bold">{{ $lang['profit'] }}</td>
                                <td class="py-2 border-b">
                                    @if(isset($detail['profit']))
                                    {{$detail['profit']}}
                                    @else
                                    {{$currancy}} 0.0
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-7/10 font-bold">{{ $lang['mark'] }}</td>
                                <td class="py-2 border-b">
                                    @if(isset($detail['mark']))
                                    {{$detail['mark']}}
                                    @else
                                    0.0 %
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b w-7/10 font-bold">{{ $lang['o_margin'] }}</td>
                                <td class="py-2 border-b">
                                    @if(isset($detail['operating']))
                                    {{ $detail['operating'] }}
                                    @else
                                    0.0 %
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
<script>
    var method;
    @if(isset($detail))
        method = '{{$_POST['method']}}';
    @else
        method = document.getElementById('method').value;
    @endif
    var x, y, z;
    if (method == 'Gross') {
        x = "{{$lang['cost']}}";
        y = "{{$lang['rev']}}";
        z = "{{$lang['g_m']}}";
    } else if (method == 'Net') {
        x = "{{$lang['total_s']}}";
        y = "{{$lang['net_profit']}}";
        z = "{{$lang['n_p_m']}}";
    } else {
        x = "{{$lang['o_i']}}";
        y = "{{$lang['s_r']}}";
        z = "{{$lang['o_p_m']}}";
    }
    // document.getElementById('ans').textContent = z;
    document.getElementById('x').textContent = x;
    document.getElementById('y').textContent = y;

    document.getElementById('method').addEventListener('change', function() {
    var method = document.getElementById('method').value;
    var x, y;
    if (method == 'Gross') {
        x = "{{ $lang['cost']}}";
        y = "{{ $lang['rev']}}";
    } else if (method == 'Net') {
        x = "{{ $lang['total_s']}}";
        y = "{{ $lang['net_profit']}}";
    } else {
        x = "{{ $lang['o_i']}}";
        y = "{{ $lang['s_r']}}";
    }
    document.getElementById('x').textContent = x;
    document.getElementById('y').textContent = y;
});

</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>