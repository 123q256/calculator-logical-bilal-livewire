<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                if (!isset($detail)) {
                    $_POST['unit'] = "m";
                }
            @endphp
            <div class="col-span-6">
                <label for="slct1" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="slct1" id="slct1">
                        <option value="1" {{ isset($_POST['slct1']) && $_POST['slct1']=='1'?'selected':'' }}>{{$lang['2']}} (r)</option>
                        <option value="2" {{ isset($_POST['slct1']) && $_POST['slct1']=='2'?'selected':'' }}>{{$lang['3']}} (V)</option>
                        <option value="3" {{ isset($_POST['slct1']) && $_POST['slct1']=='3'?'selected':'' }}>{{$lang['4']}} (A)</option>
                        <option value="4" {{ isset($_POST['slct1']) && $_POST['slct1']=='4'?'selected':'' }}>{{$lang['5']}} (C)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="rad" class="label" id="textChanged">
                    @if(isset($_POST['slct1']) && $_POST['slct1']=='2')
                        {{$lang['3']}} (V)
                    @elseif(isset($_POST['slct1']) && $_POST['slct1']=='3')
                        {{$lang['4']}} (A)
                    @elseif(isset($_POST['slct1']) && $_POST['slct1']=='4')
                        {{$lang['5']}} (C)
                    @else
                        {{$lang['2']}} (r):
                    @endif
                </label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="rad" id="rad" class="input" value="{{ isset($_POST['rad'])?$_POST['rad']:'7' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="pi" class="label">pi π:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="pi" id="pi" class="input" value="{{ isset($_POST['pi'])?$_POST['pi']:'3.1415926535898' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="unit" class="label">{{ $lang['6'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" name="unit" id="unit">
                        <option value="cm" {{ isset($_POST['unit']) && $_POST['unit']=='cm'?'selected':'' }}>cm</option>
                        <option value="m" {{ isset($_POST['unit']) && $_POST['unit']=='m'?'selected':'' }}>m</option>
                        <option value="in" {{ isset($_POST['unit']) && $_POST['unit']=='in'?'selected':'' }}>in</option>
                        <option value="ft" {{ isset($_POST['unit']) && $_POST['unit']=='ft'?'selected':'' }}>ft</option>
                        <option value="yd" {{ isset($_POST['unit']) && $_POST['unit']=='yd'?'selected':'' }}>yd</option>
                    </select>
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
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['2']}} (r)</td>
                                        <td class="py-2 border-b">{{$detail['rad']}} {{$_POST['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['3']}} (V)</td>
                                        <td class="py-2 border-b">{{$detail['vol']}} {{$_POST['unit']}}<sup class="font-s-14">3</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['4']}} (A)</td>
                                        <td class="py-2 border-b">{{$detail['area']}} {{$_POST['unit']}}<sup class="font-s-14">2</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['5']}} (C)</td>
                                        <td class="py-2 border-b">{{ $detail['c'] }} {{$_POST['unit']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <p class="mt-3 text-[18px]"><strong>{{$lang['7']}} Pi π</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                                <table class="w-100 text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['3']}} (V)</td>
                                        <td class="py-2 border-b">{{$detail['v1']}} π {{$_POST['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['4']}} (A)</td>
                                        <td class="py-2 border-b">{{$detail['s1']}} π {{$_POST['unit']}}<sup class="font-s-14">2</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{$lang['5']}} (C)</td>
                                        <td class="py-2 border-b">{{$detail['c1']}} π {{$_POST['unit']}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('slct1').addEventListener('change', function() {
                if(this.value === "1"){
                    document.getElementById('textChanged').textContent = "{{$lang['2']}} (r):";
                }else if(this.value === "2"){
                    document.getElementById('textChanged').textContent = "{{$lang['3']}} (V):";
                }else if(this.value === "3"){
                    document.getElementById('textChanged').textContent = "{{$lang['4']}} (A):";
                }else{
                    document.getElementById('textChanged').textContent = "{{$lang['5']}} (C):";
                }
            });
        </script>
    @endpush
</form>