<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


            <div class="col-span-12">
                <span class="font-s-14 text-blue">{{ $lang['2'] }}:</span>
                <div class="w-full py-2">
                    <input type="number" step="any" name="choices[]" value="{{ isset($_POST['choices[]'])?$_POST['choices[]']:'45' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12">
                <span class="font-s-14 text-blue">{{ $lang['3'] }}:</span>
                <div class="w-full py-2">
                    <input type="number" step="any" name="choices[]" value="{{ isset($_POST['choices[]'])?$_POST['choices[]']:'15' }}" class="input" aria-label="input" />
                </div>
            </div>
            @isset($detail)
            <div class="col-span-12" >
                @php
                    function ordinalSuffix($number) {
                        if (in_array($number % 100, [11, 12, 13])) {
                            return $number . 'th';
                        }
                        switch ($number % 10) {
                            case 1:
                                return $number . 'st';
                            case 2:
                                return $number . 'nd';
                            case 3:
                                return $number . 'rd';
                            default:
                                return $number . 'th';
                        }
                    }
                @endphp
                @for ($i = 2; $i < count($_POST['choices']); $i++)
                    <div class="col-span-12">
                        <span class="font-s-14 text-blue">Number of choices for the {{ordinalSuffix($i+1)}} thing:</span>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="choices[]" value="{{ $detail['choices'][$i] }}" class="input" aria-label="input" />
                        </div>
                    </div>
                @endfor
            </div>
            @endisset
            <div class="col-span-12" >
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4" id="newRows">
                </div>
            </div>
            <div class="col-span-12 text-end mt-3">
                <button type="button" id="newRow" title="Add New Room" onclick="add_row(this)" class="px-3 py-2 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><span>+</span>{{$lang[6]}}</button>
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
                                <table class="w-full text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['answer'], 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full  text-[16px]">
                                <p class="mt-2"><strong>{{$lang['9']}}</strong></p>
                                <p class="mt-2">{{$lang['1']}}</p>
                                <p class="mt-2">
                                    @php
                                        foreach ($detail['choices'] as $key => $value) {
                                            echo $value;
                                            if ($key < count($detail['choices']) - 1) {
                                                echo " × ";
                                            }
                                        }
                                    @endphp
                                    = {{round($detail['answer'], 2) }}
                                </p>
                                <p class="mt-2">{{$lang['5']}} {{count($detail['choices'])}} {{$lang['6']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            let x = {{ isset($detail) ? (count($_POST['choices'])+1) : 3 }};
            function add_row() {
                function ordinalSuffix(number) {
                    if ([11, 12, 13].includes(number % 100)) {
                        return number + 'th';
                    }
                    switch (number % 10) {
                        case 1:
                            return number + 'st';
                        case 2:
                            return number + 'nd';
                        case 3:
                            return number + 'rd';
                        default:
                            return number + 'th';
                    }
                }
                if (11 > x) {
                    let newX = ordinalSuffix(x);
                    var read = `
                        <div class="col-span-12">
                            <span class="font-s-14 text-blue">Number of choices for the `+ newX +` thing:</span>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="choices[]" value="{{ isset($_POST['choices[]'])?$_POST['choices[]']:'7' }}" class="input" aria-label="input" />
                            </div>
                        </div>
                    `;
                    document.getElementById('newRows').insertAdjacentHTML('beforeend', read);
                } else {
                    alert('Only Ten Fields are Allowed');
                }
                x++;
            }
        </script>
    @endpush
</form>