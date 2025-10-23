@php
    if (isset($_POST['submit'])) {
        $method=$_POST['method'];
    }elseif(isset($_GET['res_link'])){
        $method=$_GET['method'];
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select class="input " name="method" id="method" aria-label="input select">
                        <option value="1"
                            {{ isset($_POST['method']) && $_POST['method'] === '1' ? 'selected' : 'selected' }}>{{ $lang['2'] }}
                        </option>
                        <option value="2"
                            {{ isset($_POST['method']) && $_POST['method'] === '2' ? 'selected' : '' }}>{{ $lang['3'] }}</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="year" class="font-s-14 text-blue cat">
                        @if(isset($_POST['from']) && $_POST['from'] === '2')
                            {{ $lang['5'] }}    
                        @else
                            {{ $lang['4'] }}
                        @endif
                        ({{ $lang['6'] }}) 
                    :</label>
                    <input type="number" name="year" id="year" class="input" aria-label="input"  value="{{ isset($_POST['year'])?$_POST['year']:'4' }}" />
                </div>
                <div class="space-y-2">
                    <label for="month" class="font-s-14 text-blue">({{ $lang['7'] }}):</label>
                    <input type="number" name="month" id="month" class="input" aria-label="input" value="{{ isset($_POST['month'])?$_POST['month']:'4' }}" />
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
                    <div class="w-full bg-light-blue result p-3 rounded-lg mt-3">
                        <div class="flex justify-center">
                            <div class="w-full lg:w-auto text-center text-lg">
                                @if($method == 1)
                                    <p>{{$lang[8]}}</p>
                                @else
                                    <p>{{$lang[9]}}</p>
                                @endif
                                <p class="bg-[#2845F5] text-white inline-block rounded-lg px-3 py-2 my-3">
                                    <strong class="text-blue lg:text-4xl md:text-4xl">{{$detail['ans']}} {{$lang['6']}}</strong>
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
        document.getElementById('method').addEventListener('change', function() {
            var method = this.value;
            var cat = document.querySelector('.cat');
            if (method == 1) {
                cat.innerHTML = '{{$lang['4']}} ({{ $lang['6'] }}) ';
            }else{
                cat.innerHTML = '{{$lang['5']}} ({{ $lang['6'] }}) ';
            }
        })
    </script>
@endpush