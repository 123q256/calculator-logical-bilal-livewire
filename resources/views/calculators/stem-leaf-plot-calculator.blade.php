<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="col-12 w-full md:w-[50%] lg:w-[50%]  mx-auto">
        <div class="row">
            @if(isset($error))
                <p class="font-s-18 text-center"><strong class="text-danger">{{ $error }}</strong></p>
            @endif
        </div>
    </div>
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   mt-3  gap-4">
                <div class="space-y-2 ">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['1'] }} ({{ $lang['2'] }}):</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 10, 12, 11, 15, 11, 14, 13, 17, 12, 22, 14, 11">{{ isset($_POST['x'])?$_POST['x']:'10, 12, 11, 15, 11, 14, 13, 17, 12, 22, 14, 11' }}</textarea>
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
                        
                    <div class="w-full  mt-3">
                        <div class="w-full">
                            <div class="col-12 font-s-18 mt-3"><strong class="text-blue">{{ $lang['3'] }}</strong></div>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto  mt-1">
                                @php
                                    $firstKey = array_key_first($detail['new']);
                                    $lastKey = array_key_last($detail['new']);
                                @endphp
                                <table class="w-full font-s-18">
                                        @for ($i=$firstKey; $i <= $lastKey; $i++)        
                                            <tr>
                                                <td class="py-2 border-b"><?=$i?>:</td>
                                                <td class="py-2 border-b">
                                                    @if (isset($detail['new'][$i]))
                                                        @foreach ($detail['new'][$i] as $key => $value)
                                                            {{ $value.' ' }}
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                        @endfor
                                </table>
                            </div>
                            <div class="col-12 font-s-18 mt-3"><strong class="text-blue">{{ $lang['4'] }}</strong></div>
                            <div class="w-full md:w-[50%] lg:w-[50%]  mt-1">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[5]?></td>
                                        <td class="py-2 border-b"><?=$detail['min']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[6]?></td>
                                        <td class="py-2 border-b"><?=$detail['max']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[7]?></td>
                                        <td class="py-2 border-b"><?=$detail['range']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[8]?></td>
                                        <td class="py-2 border-b"><?=$detail['count']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[9]?></td>
                                        <td class="py-2 border-b"><?=$detail['sum']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[10]?></td>
                                        <td class="py-2 border-b"><?=$detail['median']?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[11]?></td>
                                        <td class="py-2 border-b"><?php
                                            foreach ($detail['mode'] as $key => $value) {
                                                echo "$value ";
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[12]?></td>
                                        <td class="py-2 border-b"><?=round($detail['SD'],2)?></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?=$lang[13]?></td>
                                        <td class="py-2 border-b"><?=round($detail['var'],2)?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
@endpush