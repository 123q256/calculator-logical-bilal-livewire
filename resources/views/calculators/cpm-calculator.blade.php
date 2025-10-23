<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
           <input type="hidden" value="{{$currancy }}" name="my_current">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <div class="w-100 py-2">
                    <label for="checkbox" class="font-s-17 text-blue">
                        <input type="checkbox" step="any" name="checkbox"
                            {{ isset($_POST['checkbox']) && $_POST['checkbox'] == 'on' ? 'checked' : '' }} id="checkbox"
                            class="filled-in" />
                        {{ $lang['comp'] }}:</label>
                </div>
            </div>
            <div class="single col-span-12">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-6 md:col-span-4 lg::col-span-4">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['t_cal'] }}</label>
                    <select name="method" id="method" class="input mt-2">
                        <option value="cpm" {{ isset($_POST['method']) && $_POST['method'] == 'cpm' ? 'selected' : '' }}>
                            {{ $lang['cpm'] }}</option>
                        <option value="im" {{ isset($_POST['method']) && $_POST['method'] == 'im' ? 'selected' : '' }}>
                            {{ $lang['im'] }}</option>
                        <option value="tc" {{ isset($_POST['method']) && $_POST['method'] == 'tc' ? 'selected' : '' }}>
                            {{ $lang['tc'] }}</option>
                    </select>
                </div>
                <div class="col-span-6 md:col-span-4 lg::col-span-4">
                    <label for="x" class="font-s-14 text-blue" id="x">{{ $lang['im'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="x" id="x" class="input"
                            aria-label="input" placeholder="00" value="{{ isset($_POST['x']) ? $_POST['x'] : '10' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-4 lg::col-span-4">
                    <label for="y" class="font-s-14 text-blue" id="y">{{ $lang['tc'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="y" id="y" class="input"
                            aria-label="input" placeholder="00" value="{{ isset($_POST['y']) ? $_POST['y'] : '20' }}" />
                    </div>
                </div>
                </div>
            </div>
            <div class="col col-span-12 hidden comp">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <p class="padding_5 col-span-12"> <strong>{{ $lang['first']}}</strong></p>
                <div class="col-span-6  md:col-span-4 lg::col-span-4">
                    <label for="methodf" class="font-s-14 text-blue">{{ $lang['t_cal'] }}:</label>
                    <select name="methodf" id="methodf" class="input mt-2">
                        <option value="cpm"
                            {{ isset($_POST['methodf']) && $_POST['methodf'] == 'cpm' ? 'selected' : '' }}>
                            {{ $lang['cpm'] }}</option>
                        <option value="im" {{ isset($_POST['methodf']) && $_POST['methodf'] == 'im' ? 'selected' : '' }}>
                            {{ $lang['im'] }}</option>
                        <option value="tc" {{ isset($_POST['methodf']) && $_POST['methodf'] == 'tc' ? 'selected' : '' }}>
                            {{ $lang['tc'] }}</option>
                    </select>
                </div>
                <div class="col-span-6  md:col-span-4 lg::col-span-4">
                    <label for="xf" class="font-s-14 text-blue" id="xf">{{ $lang['im'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="xf" id="xf" class="input"
                            aria-label="input" placeholder="00" value="{{ isset($_POST['xf']) ? $_POST['xf'] : '10' }}" />
                    </div>
                </div>
                <div class="col-span-6  md:col-span-4 lg::col-span-4">
                    <label for="yf" class="font-s-14 text-blue" id="yf"> {{ $lang['tc'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="yf" id="yf" class="input"
                            aria-label="input" placeholder="00" value="{{ isset($_POST['yf']) ? $_POST['yf'] : '20' }}" />
                    </div>
                </div>
                <p class="col col-span-12 s12 font_size18 color_blue"><strong>{{ $lang['second']}}</strong></p>
                <div class="col-span-6  md:col-span-4 lg::col-span-4">
                    <label for="methods" class="font-s-14 text-blue">{{ $lang['t_cal'] }}:</label>
                    <select name="methods" id="methods" class="input mt-2">
                        <option value="cpm" {{ isset($_POST['methods']) && $_POST['methods'] == 'cpm' ? 'selected' : '' }}>  {{ $lang['cpm'] }}</option>
                        <option value="im" {{ isset($_POST['methods']) && $_POST['methods'] == 'im' ? 'selected' : '' }}> {{ $lang['im'] }}</option>
                        <option value="tc" {{ isset($_POST['methods']) && $_POST['methods'] == 'tc' ? 'selected' : '' }}> {{ $lang['tc'] }}</option>
                    </select>
                </div>
                <div class="col-span-6  md:col-span-4 lg::col-span-4">
                    <label for="xs" class="font-s-14 text-blue" id="xs">{{ $lang['im'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="xs" id="xs" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['xs']) ? $_POST['xs'] : '50' }}" />
                    </div>
                </div>
                <div class="col-span-6  md:col-span-4 lg::col-span-4">
                    <label for="ys" class="font-s-14 text-blue" id="ys">{{ $lang['tc'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="ys" id="ys" class="input"
                            aria-label="input" placeholder="00"
                            value="{{ isset($_POST['ys']) ? $_POST['ys'] : '50' }}" />
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
                    @if (isset($_POST['checkbox']))
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <table class="w-ful text-[18px]">
                                <tr>
                                    <td class="py-2" width="70%"><strong>{{ $lang['first'] }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%" id="ansf"></td>
                                    <td class="py-2 border-b">
                                        @if (isset($detail['ansf']))
                                            <b>{{ $detail['ansf'] }}</b>
                                        @else
                                            <b>0.0</b>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 mt-3 " width="70%"><strong>{{ $lang['second'] }} </strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%" id="anss"></td>
                                    <td class="py-2 border-b">
                                        @if (isset($detail['anss']))
                                            <b>{{ $detail['anss'] }}</b>
                                        @else
                                            <b>0.0</b>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">
                                        @if ($detail['cpmf'] < $detail['cpms'])
                                            <b>Campaign 1 is less expensive.</b>
                                        @elseif($detail['cpmf'] > $detail['cpms'])
                                            <b>Campaign 2 is less expensive.</b>
                                        @else
                                            <b>The campaigns cost is the same.</b>
                                        @endif
                                    </td>
                                    <td class="py-2 border-b" width="70%"><strong></strong></td>
                                </tr>
                        </table>
                    </div>
                    @else
            
                    <div class="col-12 text-center text-[20px]">
                        <p id="ans"></p>
                        <p class="my-3"><strong class="text-white bg-[#2845F5] px-3 py-2 rounded-lg text-[30px]">
                            @if (isset($detail['ans']))
                                {{ $detail['ans'] }}
                            @else
                                0.0
                            @endif
                        </strong></p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
<script>
    document.getElementById('checkbox').addEventListener('click', function() {
        if (this.checked) {
            // Checkbox is checked
            var compElements = document.querySelectorAll('.comp');
            var singleElements = document.querySelectorAll('.single');

            compElements.forEach(function(element) {
                element.classList.remove('hidden');
            });

            singleElements.forEach(function(element) {
                element.classList.add('hidden');
            });
        } else {
            // Checkbox is unchecked
            var compElements = document.querySelectorAll('.comp');
            var singleElements = document.querySelectorAll('.single');

            compElements.forEach(function(element) {
                element.classList.add('hidden');
            });

            singleElements.forEach(function(element) {
                element.classList.remove('hidden');
            });
        }
    });
    document.getElementById('methods').addEventListener('change', function() {
        var methods = this.value;
        var lang = {
            'cpm': "{{ $lang['cpm'] }}",
            'im': "{{ $lang['im'] }}",
            'tc': "{{ $lang['tc'] }}"
        };

        if (methods == 'cpm') {
            var x = lang['im'];
            var y = lang['tc'];
            var z = lang['cpm'];
            document.getElementById('xs').textContent = x;
            document.getElementById('ys').textContent = y;
        } else if (methods == 'im') {
            var x = lang['cpm'];
            var y = lang['tc'];
            var z = lang['im'];
            document.getElementById('xs').textContent = x;
            document.getElementById('ys').textContent = y;
        } else {
            var x = lang['cpm'];
            var y = lang['im'];
            var z = lang['tc'];
            document.getElementById('xs').textContent = x;
            document.getElementById('ys').textContent = y;
        }
    });
    document.getElementById('method').addEventListener('change', function() {
        var method = document.getElementById('method').value;

        if (method === 'cpm') {
            var x = "{{ $lang['im'] }}";
            var y = "{{ $lang['tc'] }}";
            var z = "{{ $lang['cpm'] }}";
            document.getElementById('x').textContent = x;
            document.getElementById('y').textContent = y;
        } else if (method === 'im') {
            var x = "{{ $lang['cpm'] }}";
            var y = "{{ $lang['tc'] }}";
            var z = "{{ $lang['im'] }}";
            document.getElementById('x').textContent = x;
            document.getElementById('y').textContent = y;
        } else {
            var x = "{{ $lang['cpm'] }}";
            var y = "{{ $lang['im'] }}";
            var z = "{{ $lang['tc'] }}";
            document.getElementById('x').textContent = x;
            document.getElementById('y').textContent = y;
        }
    });
    document.getElementById('methodf').addEventListener('change', function() {
        var methodf = document.getElementById('methodf').value;

        if (methodf === 'cpm') {
            var x = "{{ $lang['im'] }}";
            var y = "{{ $lang['tc'] }}";
            var z = "{{ $lang['cpm'] }}";
			
            document.getElementById('xf').textContent = x;
            document.getElementById('yf').textContent = y;
        } else if (methodf === 'im') {
            var x = "{{ $lang['cpm'] }}";
            var y = "{{ $lang['tc'] }}";
            var z = "{{ $lang['im'] }}";
            document.getElementById('xf').textContent = x;
            document.getElementById('yf').textContent = y;
        } else {
            var x = "{{ $lang['cpm'] }}";
            var y = "{{ $lang['im'] }}";
            var z = "{{ $lang['tc'] }}";
            document.getElementById('xf').textContent = x;
            document.getElementById('yf').textContent = y;
        }
    });
	 // method
    @if (isset($detail))
		var checkbox = document.getElementById('checkbox');
		if (checkbox.checked) {
			var methods = '{{ $_POST['methods']}}';
			if (methods === 'cpm') {
				var x = "{{ $lang['im'] }}";
				var y = "{{ $lang['tc'] }}";
				var z = "{{ $lang['cpm'] }}";
				document.getElementById('xs').textContent = x;
				document.getElementById('ys').textContent = y;
				document.getElementById('anss').textContent = z;
			} else if (methods === 'im') {
				var x = "{{ $lang['cpm'] }}";
				var y = "{{ $lang['tc'] }}";
				var z = "{{ $lang['im'] }}";
				document.getElementById('xs').textContent = x;
				document.getElementById('ys').textContent = y;
				document.getElementById('anss').textContent = z;
			} else {
				var x = "{{ $lang['cpm'] }}";
				var y = "{{ $lang['im'] }}";
				var z = "{{ $lang['tc'] }}";
				document.getElementById('xs').textContent = x;
				document.getElementById('ys').textContent = y;
				document.getElementById('anss').textContent = z;
			}

			var methodf = '{{ $_POST['methodf'] }}';
			if (methodf === 'cpm') {
				var x = "{{ $lang['im'] }}";
				var y = "{{ $lang['tc'] }}";
				var z = "{{ $lang['cpm'] }}";
				document.getElementById('xf').textContent = x;
				document.getElementById('yf').textContent = y;
				document.getElementById('ansf').textContent = z;
			} else if (methodf === 'im') {
				var x = "{{ $lang['cpm'] }}";
				var y = "{{ $lang['tc'] }}";
				var z = "{{ $lang['im'] }}";
				document.getElementById('xf').textContent = x;
				document.getElementById('yf').textContent = y;
				document.getElementById('ansf').textContent = z;
			} else {
				var x = "{{ $lang['cpm'] }}";
				var y = "{{ $lang['im'] }}";
				var z = "{{ $lang['tc'] }}";
				document.getElementById('xf').textContent = x;
				document.getElementById('yf').textContent = y;
				document.getElementById('ansf').textContent = z;
			}

		}else{
			var method = '{{ $_POST['method'] }}';
			if (method === 'cpm') {
				var x = "{{ $lang['im'] }}";
				var y = "{{ $lang['tc'] }}";
				var z = "{{ $lang['cpm'] }}";
				document.getElementById('x').textContent = x;
				document.getElementById('y').textContent = y;
				document.getElementById('ans').textContent = z;
			} else if (method === 'im') {
				var x = "{{ $lang['cpm'] }}";
				var y = "{{ $lang['tc'] }}";
				var z = "{{ $lang['im'] }}";
				document.getElementById('x').textContent = x;
				document.getElementById('y').textContent = y;
				document.getElementById('ans').textContent = z;
			} else {
				var x = "{{ $lang['cpm'] }}";
				var y = "{{ $lang['im'] }}";
				var z = "{{ $lang['tc'] }}";
				document.getElementById('x').textContent = x;
				document.getElementById('y').textContent = y;
				document.getElementById('ans').textContent = z;
			}

		}

		var checkbox = '{{ isset($_POST['checkbox']) ? $_POST['checkbox'] : '' }}';
			if (checkbox == 'on') {
				var compElements = document.querySelectorAll('.comp');
				var singleElements = document.querySelectorAll('.single');

				compElements.forEach(function(element) {
					element.classList.remove('hidden');
				});

				singleElements.forEach(function(element) {
					element.classList.add('hidden');
				});
			} else {
				var compElements = document.querySelectorAll('.comp');
				var singleElements = document.querySelectorAll('.single');

				compElements.forEach(function(element) {
					element.classList.add('hidden');
				});

				singleElements.forEach(function(element) {
					element.classList.remove('hidden');
				});
			}
    @endif

    @if(isset($error))
         var checkbox = '{{ isset($_POST['checkbox']) ? $_POST['checkbox'] : '' }}';
        if (checkbox == 'on') {
        var compElements = document.querySelectorAll('.comp');
        var singleElements = document.querySelectorAll('.single');
        compElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
        singleElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        } else {
            var compElements = document.querySelectorAll('.comp');
            var singleElements = document.querySelectorAll('.single');

            compElements.forEach(function(element) {
                element.classList.add('hidden');
            });
            singleElements.forEach(function(element) {
                element.classList.remove('hidden');
            });
        }
    @endif
    @if(isset($error))
         var methodf = '{{ isset($_POST['methodf']) ? $_POST['methodf'] : '' }}';
        if (methodf === 'cpm') {
            var x = "{{ $lang['im'] }}";
            var y = "{{ $lang['tc'] }}";
            var z = "{{ $lang['cpm'] }}";
            
            document.getElementById('xf').textContent = x;
            document.getElementById('yf').textContent = y;
        } else if (methodf === 'im') {
            var x = "{{ $lang['cpm'] }}";
            var y = "{{ $lang['tc'] }}";
            var z = "{{ $lang['im'] }}";
            document.getElementById('xf').textContent = x;
            document.getElementById('yf').textContent = y;
        } else {
            var x = "{{ $lang['cpm'] }}";
            var y = "{{ $lang['im'] }}";
            var z = "{{ $lang['tc'] }}";
            document.getElementById('xf').textContent = x;
            document.getElementById('yf').textContent = y;
        }

    @endif
    @if(isset($error))
         var method = '{{ isset($_POST['method']) ? $_POST['method'] : '' }}';

        if (method === 'cpm') {
            var x = "{{ $lang['im'] }}";
            var y = "{{ $lang['tc'] }}";
            var z = "{{ $lang['cpm'] }}";
            document.getElementById('x').textContent = x;
            document.getElementById('y').textContent = y;
        } else if (method === 'im') {
            var x = "{{ $lang['cpm'] }}";
            var y = "{{ $lang['tc'] }}";
            var z = "{{ $lang['im'] }}";
            document.getElementById('x').textContent = x;
            document.getElementById('y').textContent = y;
        } else {
            var x = "{{ $lang['cpm'] }}";
            var y = "{{ $lang['im'] }}";
            var z = "{{ $lang['tc'] }}";
            document.getElementById('x').textContent = x;
            document.getElementById('y').textContent = y;
        }

    @endif
    @if(isset($error))
         var methods = '{{ isset($_POST['methods']) ? $_POST['methods'] : '' }}';
        var lang = {
            'cpm': "{{ $lang['cpm'] }}",
            'im': "{{ $lang['im'] }}",
            'tc': "{{ $lang['tc'] }}"
        };

        if (methods == 'cpm') {
            var x = lang['im'];
            var y = lang['tc'];
            var z = lang['cpm'];
            document.getElementById('xs').textContent = x;
            document.getElementById('ys').textContent = y;
        } else if (methods == 'im') {
            var x = lang['cpm'];
            var y = lang['tc'];
            var z = lang['im'];
            document.getElementById('xs').textContent = x;
            document.getElementById('ys').textContent = y;
        } else {
            var x = lang['cpm'];
            var y = lang['im'];
            var z = lang['tc'];
            document.getElementById('xs').textContent = x;
            document.getElementById('ys').textContent = y;
        }

    @endif

</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>