<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-9 lg:col-span-9">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-10">
                        <label for="conversion" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="w-full py-2">
                            <select name="units" class="input" id="conversion" aria-label="select">
                                <option value="A Sequence" {{ isset($_POST['units']) && $_POST['units']=='A Sequence'?'selected':'' }}>{{$lang[3]}}</option>
                                <option value="One Number" {{ isset($_POST['units']) && $_POST['units']=='One Number'?'selected':'' }}>{{$lang[4]}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-10">
                        <div class="items-center justify-center mt-0 mt-lg-2 py-2 {{ isset($_POST['units']) && $_POST['units']!='A Sequence'?'hidden':'flex' }}" id="two">
                            <div>F<sub>n</sub>&nbsp;for&nbsp;n&nbsp;=&nbsp;</div>
                            <div>
                                <input type="number" step="any" name="first_term" id="first_term" class="input" aria-label="input" value="<?= isset($_POST['first_term']) ? $_POST['first_term'] : '10' ?>" />
                            </div>
                            <div class="px-2">to</div>
                            <div>
                                <input type="number" step="any" name="second_term" id="second_term" class="input" aria-label="input" value="<?= isset($_POST['second_term']) ? $_POST['second_term'] : '15' ?>" />
                            </div>
                        </div>
                        <div class="items-center justify-center mt-0 mt-lg-2 py-2 {{ isset($_POST['units']) && $_POST['units']=='One Number'?'flex':'hidden' }}" id="one">
                            <div>F<sub>n</sub> for n = </div>
                            <div>
                                <input type="number" step="any" name="n" id="n" class="input" aria-label="input" value="<?= isset($_POST['n']) ? $_POST['n'] : '10' ?>" />
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-3 lg:col-span-3 text-center flex items-center">
                    <div>
                    <p class="font-s-20"><strong>F<sub>0</sub> = 0, F<sub>1</sub> = 1,</strong></p>
                    <p class="font-s-20"><strong>F<sub>n</sub> = F<sub>n-1</sub> + F<sub>n-2</sub></strong></p>
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
                        @if($_POST['units'] === "A Sequence")
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" colspan="2"><strong>F<sub class="font-s-14">{{$_POST['first_term']}}</sub> to F<sub class="font-s-14">{{$_POST['second_term']}}</sub> = </strong> {{implode(" , ", $detail['fibonacci_sequence'])}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>n</strong></td>
                                        <td class="py-2 border-b"><strong>Fn</strong></td>
                                    </tr>
                                    @foreach($detail['fibonacci_sequence'] as $key => $value)
                                        <tr>
                                            <td class="py-2 border-b" width="60%">{{ $key + $_POST['first_term'] }}</td>
                                            <td class="py-2 border-b">{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @else
                            <div class="w-full text-center font-s-20">
                                <p class="my-3">
                                    <strong class="bg-sky px-3 py-2 text-[32px] rounded-lg text-blue">
                                        F<sub class="font-s-14">{{ $_POST['n'] }}</sub> = {{ $detail['answer'] }}
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
            document.getElementById('conversion').addEventListener('change', function() {
                if (this.value === 'A Sequence') {
                    document.getElementById('two').style.display = 'flex';
                    document.getElementById('one').style.display = 'none';
                } else {
                    document.getElementById('one').style.display = 'flex';
                    document.getElementById('two').style.display = 'none';
                }
            });
        </script>
    @endpush
</form>