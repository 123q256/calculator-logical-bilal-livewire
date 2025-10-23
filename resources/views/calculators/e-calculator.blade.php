<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="cal" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2">
                        <select class="input" aria-label="select" name="cal" id="cal">
                            <option value="ex">eˣ</option>
                            <option value="10x" {{ isset($_POST['cal']) && $_POST['cal']=='10x'?'selected':'' }}>10ˣ</option>
                            <option value="ax" {{ isset($_POST['cal']) && $_POST['cal']=='ax'?'selected':'' }}>aˣ</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 angle_show {{ isset($_POST['cal']) && $_POST['cal']==='ax' ? 'block':'hidden' }}">
                    <label for="a" class="font-s-14 text-blue">{{$lang[2]}}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="a" id="a" class="input" value="{{ isset($_POST['a'])?$_POST['a']:'5' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="x" class="font-s-14 text-blue">x:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x" id="x" class="input" value="{{ isset($_POST['x'])?$_POST['x']:'2' }}" aria-label="input"/>
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
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">
                                            <strong>
                                                @if($_POST['cal']==='ex')
                                                    e
                                                @elseif($_POST['cal']==='10x')
                                                    10
                                                @else
                                                    {{$_POST['a']}}
                                                @endif
                                                <sup class="font-s-14">{{$_POST['x']}}</sup>
                                            </strong>
                                        </td>
                                        <td class="py-2 border-b">{{round($detail['exp'], 2)}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 text-[16px] mt-2">
                                <p><strong>{{$lang[3]}}</strong></p>
                                @if($_POST['cal']==='ex')
                                    <p class="mt-2">e<sup class="font-s-14">x</sup> = ?</p>
                                    <p class="mt-2">(2.71828)<sup class="font-s-14">{{$_POST['x']}}</sup> = {{round($detail['exp'], 2)}}</p>
                                @elseif($_POST['cal']==='10x')
                                    <p class="mt-2">10<sup class="font-s-14">x</sup> = ?</p>
                                    <p class="mt-2">(10)<sup class="font-s-14">{{$_POST['x']}}</sup> = {{round($detail['exp'], 2)}}</p>
                                @else
                                    <p class="mt-2">a<sup class="font-s-14">x</sup> = ?</p>
                                    <p class="mt-2">({{$_POST['a']}})<sup class="font-s-14">{{$_POST['x']}}</sup> = {{round($detail['exp'], 2)}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('cal').addEventListener('change', function() {
                if(this.value === "ax"){
                    ['.angle_show'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else{
                    ['.angle_show'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>