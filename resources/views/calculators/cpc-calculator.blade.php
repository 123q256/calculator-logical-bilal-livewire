<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12">
                <label for="method" class="font-s-14 text-blue">{{ $lang['chose'] }}:</label>
                    <select name="method" id="method" class="input mt-2">
                    <option value="cost"  {{ isset($_POST['method']) && $_POST['method']=='cost'?'selected':''}}>{{ $lang['cost'] }}</option>
                    <option value="cpc" {{ isset($_POST['method']) && $_POST['method']=='cpc'?'selected':''}}>{{ $lang['cpc'] }}</option>
                    <option value="click" {{ isset($_POST['method']) && $_POST['method']=='click'?'selected':''}}>{{ $lang['click'] }}</option>
                </select>
            </div>
            <div class="col-span-12">
                <label for="x" class="font-s-14 text-blue" id="xx"></label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="x" id="x" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['x'])?$_POST['x']:'50' }}" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="y" class="font-s-14 text-blue" id="yy"></label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="y" id="y" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['y'])?$_POST['y']:'50' }}" />
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
                        <div class="w-full text-center text-[20px]">
                            <p><span id="ans"></span></p>
                          <div class="flex justify-center">
                            <p class="my-3">
                                <strong class="bg-[#2845F5] rounded-lg text-white px-3 py-2 text-[25px] ">
                                    @if($detail['ans'])
                                    {{$detail['ans']}}
                                    @else
                                    <span>0.0</span>
                                    @endif
                                </strong>
                            </p>
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
    var method;
    @if(isset($detail))
        method = '{{$_POST['method']}}';
        if (method === 'cost') {
            var x = "{{$lang['cpc']}}";
            var y = "{{$lang['click']}}";
            var z = "{{$lang['cost']}}";
            document.getElementById('xx').innerHTML = x;
            document.getElementById('yy').innerHTML = y;
            document.getElementById('ans').innerHTML = z;
            } else if (method === 'cpc') {
            var x = "{{$lang['cost']}}";
            var y = "{{$lang['click']}}";
            var z = "{{$lang['cpc']}}";
            document.getElementById('xx').innerHTML = x;
            document.getElementById('yy').innerHTML = y;
            document.getElementById('ans').innerHTML = z;
            } else {
            var x = "{{$lang['cost']}}";
            var y = "{{$lang['cpc']}}";
            var z = "{{$lang['click']}}";
            document.getElementById('xx').innerHTML = x;
            document.getElementById('yy').innerHTML = y;
            document.getElementById('ans').innerHTML = z;
            }
        @else
            method = document.getElementById('method').value;
            if (method === 'cost') {
            var x = "{{$lang['cpc']}}";
            var y = "{{$lang['click']}}";
            var z = "{{$lang['cost']}}";
            document.getElementById('xx').innerHTML = x;
            document.getElementById('yy').innerHTML = y;
        } else if (method === 'cpc') {
            var x = "{{$lang['cost']}}";
            var y = "{{$lang['click']}}";
            var z = "{{$lang['cpc']}}";
            document.getElementById('xx').innerHTML = x;
            document.getElementById('yy').innerHTML = y;
        } else {
            var x = "{{$lang['cost']}}";
            var y = "{{$lang['cpc']}}";
            var z = "{{$lang['click']}}";
            document.getElementById('xx').innerHTML = x;
            document.getElementById('yy').innerHTML = y;
        }
        @endif
    document.getElementById('method').addEventListener('change', function() {
        var method = document.getElementById('method').value;
        var x, y, z;
        if (method === 'cost') {
            x = "{{ $lang['cpc'] }}";
            y = "{{ $lang['click'] }}";
            z = "{{ $lang['cost'] }}";
        } else if (method === 'cpc') {
            x = "{{ $lang['cost'] }}";
            y = "{{ $lang['click'] }}";
            z = "{{ $lang['cpc'] }}";
        } else {
            x = "{{ $lang['cost'] }}";
            y = "{{ $lang['cpc'] }}";
            z = "{{ $lang['click'] }}";
        }
        document.getElementById('xx').innerHTML  = x;
        document.getElementById('yy').innerHTML  = y;
        @if(isset($detail))
        document.getElementById('ans').innerHTML  = z;
        @endif
    });
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>