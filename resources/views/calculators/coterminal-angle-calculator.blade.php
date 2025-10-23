<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="want" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2">
                        <select class="input" aria-label="select" name="want" id="want">
                            <option value="1">{{$lang['2']}}</option>
                            <option value="2" {{ isset($_POST['want']) && $_POST['want']=='2'?'selected':'' }}>{{$lang['3']}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="unit" class="label">{{ $lang['4'] }}:</label>
                    <div class="w-full py-2">
                        <select class="input" aria-label="select" name="unit" id="unit">
                            <option value="1">{{$lang['5']}}°</option>
                            <option value="2" {{ isset($_POST['unit']) && $_POST['unit']=='2'?'selected':'' }}>π {{$lang['6']}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="angle" class="label">{{$lang[7]}}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="angle" id="angle" class="input" value="{{ isset($_POST['angle'])?$_POST['angle']:'55' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 angle2_show {{ isset($_POST['want']) && $_POST['want']==='2' ? 'd-block':'d-none' }}">
                    <label for="angle2" class="label">{{$lang[7]}} 2:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="angle2" id="angle2" class="input" value="{{ isset($_POST['angle2'])?$_POST['angle2']:'75' }}" aria-label="input"/>
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
                        @if ($detail['want']==1 && $detail['unit']==1)
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['angle']+360}}°, {{$detail['angle']+(360*2)}}°, {{$detail['angle']+(360*3)}}°, {{$detail['angle']+(360*4)}}° ....</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['angle']-360}}°, {{$detail['angle']-(360*2)}}°, {{$detail['angle']-(360*3)}}°, {{$detail['angle']-(360*4)}}° ....</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" colspan="2"><strong>{{$detail['angle']}}° = {{$detail['upr'].'/'.$detail['btm']}} π ≈ {{$detail['rad']}} π</strong></td>
                                    </tr>
                                </table>
                            </div>
                        @elseif ($detail['want']==1 && $detail['unit']==2)
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" colspan="2">Coterminal angle in [0, 2π) range: <strong>{{$detail['two']}} π</strong>, located in the <strong>{{$detail['q']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['8']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['pos']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['9']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['neg']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" colspan="2">{{$detail['angle']}} π = {{$detail['deg']}}°</td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="w-full text-center my-2">
                                <p>
                                    <strong class="bg-white px-3 py-2 font-s-21 radius-10 text-blue">
                                        @if($detail['check']==1)
                                            {{$lang['10']}}
                                        @else
                                            {{$lang['11']}}
                                        @endif
                                    </strong>
                                </p>
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
            document.getElementById('want').addEventListener('change', function() {
                if(this.value === "1"){
                    ['.angle2_show'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                }else{
                    ['.angle2_show'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>