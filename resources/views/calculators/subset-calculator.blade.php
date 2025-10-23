<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 mb-1 flex items-center">
                <p class="font-s-14 text-blue pe-lg-2 pe-2">
                    {{$lang['calculate']}} {{$lang['1']}}:
                </p>
                <p class="elements">
                    <input type="radio" name="cal_by" id="elements" value="elements" {{ isset($_POST['cal_by']) && $_POST['cal_by']==='cardinality' ? '':'checked' }}>
                    <label for="elements" class="font-s-14 pe-lg-3 pe-2">{{$lang['2']}}</label>
                </p>
                <p class="cardinality">
                    <input type="radio" name="cal_by" id="cardinality" value="cardinality" {{ isset($_POST['cal_by']) && $_POST['cal_by']==='cardinality' ? 'checked':'' }}>
                    <label for="cardinality" class="font-s-14">{{$lang['3']}}</label>
                </p>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal_by']) && $_POST['cal_by']==='cardinality' ? 'hidden':'' }}" id="setInput">
                <label for="set" class="font-s-14 text-blue">{{$lang[4]}} (,):</label>
                <div class="w-full py-2">
                    <textarea aria-label="textarea input" id="set" name="set" class="textareaInput">{{ isset($_POST['set'])?$_POST['set']:'1,2,3,4,5' }}</textarea>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal_by']) && $_POST['cal_by']==='cardinality' ? 'block':'hidden' }}" id="cardinalInput">
                <label for="cardinal" class="font-s-14 text-blue">{{$lang[5]}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="cardinal" id="cardinal" class="input" value="{{ isset($_POST['cardinal'])?$_POST['cardinal']:'5' }}" aria-label="input"/>
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
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['6']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['subsets']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang['7']}}</strong></td>
                                    <td class="py-2 border-b">{{$detail['pro_subsets']}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{$lang['8']}}</strong></p>
                            @php $ne = $detail['ne']; $value1 = 1; @endphp
                            <p class="mt-2"><strong>{{ $ne[0] }}</strong> {{ $lang['9'] }} <strong>{{ $lang['10'] }}</strong> {{ $lang['11'] }}.</p>
                            @foreach($ne as $key => $value)
                                @if($key != 0)
                                    <p class="mt-2"><strong>{{ $value }}</strong> {{ $lang['9'] }} <strong>{{ $value1 }}</strong> {{ $lang['11'] }}.</p>
                                    @php $value1++; @endphp
                                @endif
                            @endforeach
                        </div>
                        @isset($detail['pw'])
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-2">{{$detail['pw']}}</p>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.querySelectorAll('.elements').forEach(function(element) {
                element.addEventListener("click", function() {
                    document.getElementById('setInput').style.display = 'block';
                    document.getElementById('cardinalInput').style.display = 'none';
                });
            });
            document.querySelectorAll('.cardinality').forEach(function(element) {
                element.addEventListener("click", function() {
                    document.getElementById('cardinalInput').style.display = 'block';
                    document.getElementById('setInput').style.display = 'none';
                });
            });
        </script>
    @endpush
</form>