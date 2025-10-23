<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <p><strong>{{ $lang[3] }}</strong></p>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="first" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="35" value="{{ isset($_POST['first'])?$_POST['first']:'35' }}" />
                    <span class="input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="second" class="label">{{ $lang['2'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="second" id="second" class="input" aria-label="input" placeholder="15" value="{{ isset($_POST['second'])?$_POST['second']:'15' }}" />
                    <span class="input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-12">
                <p class="py-2"><strong>{{ $lang[4] }}</strong></p>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="third" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="third" id="third" class="input" aria-label="input" placeholder="45" value="{{ isset($_POST['third'])?$_POST['third']:'45' }}" />
                    <span class="input_unit">{{ $currancy }}</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="four" class="label">{{ $lang['2'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="four" id="four" class="input" aria-label="input" placeholder="25" value="{{ isset($_POST['four'])?$_POST['four']:'25' }}" />
                    <span class="input_unit">{{ $currancy }}</span>
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
                    <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                        <table class="w-full text-[18px]">
                            <p class="mt-3"><strong><?= $lang[3] ?></strong></p>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['5'] }}</strong></td>
                                <td class="py-2 border-b">{{$detail['X_A']}}  {{ $lang[10] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['6'] }}</strong></td>
                                <td class="py-2 border-b">{{$detail['X_B']}} {{ $lang[9] }}</td>
                            </tr>
                        </table>
                        <table class="w-full text-[18px]">
                            <p class="mt-2"><strong><?= $lang[4] ?></strong></p>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['5'] }}</strong></td>
                                <td class="py-2 border-b">{{$detail['Y_A']}}  {{ $lang[10] }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['6'] }}</strong></td>
                                <td class="py-2 border-b">{{$detail['Y_B']}} {{ $lang[9] }}</td>
                            </tr>
                            
                        </table>
                    </div>
            
                    <div class="col-12 font-s-16">
                        <p class="mt-3"><strong>{{$lang[8] }}</strong></p>
                        <p class="mt-3"><strong>{{ $lang[3] }}</strong></p>
                        <p class="mt-3">{{$lang[7]}} = {{ $lang[1] }} / {{ $lang[2]}}</p>
                        <p class="mt-3">{{$lang[7]}} = {{ isset($_POST['first'])?$_POST['first']:'' }} / {{ isset($_POST['second'])?$_POST['second']:'' }}</p>
                        <p class="mt-3">{{$lang[7]}} = {{ $detail['X_B'] }}</p>
                        <p class="mt-3"> {{$lang[11]}},</p>
                        <p class="mt-3"> {{$lang[6]}} <strong>{{ $detail['X_B'] }}</strong> ({{$lang[9]}}) </p>
            
                        <p class="mt-3">{{$lang[7]}} = {{ $lang[2]}} / {{ $lang[1] }}</p>
                        <p class="mt-3">{{$lang[7]}} = {{ isset($_POST['second'])?$_POST['second']:'' }} / {{ isset($_POST['first'])?$_POST['first']:'' }}</p>
                        <p class="mt-3">{{$lang[7]}}= {{ $detail['X_A'] }}</p>
                        <p class="mt-3"> {{$lang[12]}},</p>
                        <p class="mt-3"> {{$lang[5]}} <strong>{{ $detail['X_A'] }}</strong> ({{$lang[10]}})</p>
                        <p class="mt-3"><strong>{{ $lang[4] }}</strong></p>
                        <p class="mt-3">{{$lang[7]}} = {{ $lang[1] }} / {{ $lang[2]}}</p>
                        <p class="mt-3">{{$lang[7]}} = {{ isset($_POST['third'])?$_POST['third']:'' }} / {{ isset($_POST['four'])?$_POST['four']:'' }}</p>
                        <p class="mt-3">{{$lang[7]}} = {{ $detail['Y_B']}}</p>
                        <p class="mt-3"> {{$lang[11]}},</p>
                        <p class="mt-3"> {{$lang[6]}} <strong>{{ $detail['Y_B'] }}</strong> ({{$lang[9]}})</p>
            
                        <p class="mt-3">{{$lang[7]}} = {{ $lang[2]}} / {{ $lang[1] }}</p>
                        <p class="mt-3">{{$lang[7]}}= {{ isset($_POST['four'])?$_POST['four']:'' }} / {{ isset($_POST['third'])?$_POST['third']:'' }}</p>
                        <p class="mt-3">{{$lang[7]}} = {{ $detail['Y_A'] }}</p>
                        <p class="mt-3"> {{$lang[12]}},</p>
                        <p class="mt-3"> {{$lang[5]}} <strong>{{ $detail['Y_A'] }}</strong> ({{$lang[10]}})</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>