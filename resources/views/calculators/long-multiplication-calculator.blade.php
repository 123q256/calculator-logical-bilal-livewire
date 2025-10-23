<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php $request = request(); @endphp
            <div class="col-span-12">
                <label for="first" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="first" id="first" class="input" value="{{ isset($request->first)?$request->first:'1234' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="second" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="second" id="second" class="input" value="{{ isset($request->second)?$request->second:'123' }}" aria-label="input"/>
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
                        <style>
                            .result .tableAns tr td{ 
                                border: 1px solid #ddd;
                                padding: 10px 15px 
                            }
                            .bdr_btm{
                                border-bottom: 3px solid #000 !important;
                            }
                            .bdr_top{
                                border-top: 3px solid #000 !important;
                            }
                        </style>
                        <div class="w-full">
                            @php
                                $first = $request->first;
                                $second = $request->second;
                            @endphp
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['answer1']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['4']}}</strong></p>
                                @isset($detail['line1'])
                                    <p class="mt-2">{{$detail['line1']}}</p>
                                    <p class="mt-2">{{$detail['line2']}}</p>
                                @endisset
                                <div class="w-full md:w-[60%] lg:w-[60%] my-3 tableAns overflow-auto">
                                    <table style="border-collapse: collapse">
                                        <tr>
                                            @php
                                                $upper = ($detail['upper']);
                                                $countLen=count($upper);
                                                echo "<td width='10px' height='10px'></td>";
                                                for ($col=0; $col <= ($detail['col']-$countLen); $col++) { 
                                                    echo "<td width='20px' height='20px'></td>";
                                                }
                                                for ($col=0; $col < $countLen; $col++) { 
                                                    echo "<td width='10px' height='10px'>".$upper[$col]."</td>";
                                                }
                                            @endphp
                                        </tr>
                                        <tr class="bdr_btm">
                                            @php
                                                $lower = ($detail['lower']);
                                                $countLen=count($lower);
                                                echo "<td>x</td>";
                                                for ($col=0; $col <= ($detail['col']-$countLen); $col++) { 
                                                    echo "<td></td>";
                                                }
                                                for ($col=0; $col < $countLen; $col++) { 
                                                    echo "<td>".$lower[$col]."</td>";
                                                }
                                            @endphp
                                        </tr>
                                        @php
                                            for ($row=0; $row < count($detail['m_j']); $row++) { 
                                                echo "<tr>";
                                                $countLen=strlen($detail['m_j'][$row]);
                                                $nbrs=str_split($detail['m_j'][$row]);
                                                echo "<td>+</td>";
                                                for ($col=0; $col <= ($detail['col']-$countLen-$row); $col++) { 
                                                    echo "<td></td>";
                                                }
                                                foreach ($nbrs as $key => $value) {
                                                    echo "<td>".$value."</td>";
                                                }
                                                for ($col=0; $col < $row; $col++) { 
                                                    echo "<td></td>";
                                                }
                                                echo "</tr>";
                                            }
                                        @endphp
                                        <tr class="bdr_top">
                                            @php
                                                $final = ($detail['final']);
                                                $countLen=count($final);
                                                echo "<td>=</td>";
                                                for ($col=0; $col <= ($detail['col']-$countLen); $col++) { 
                                                    echo "<td></td>";
                                                }
                                                for ($col=0; $col < $countLen; $col++) { 
                                                    echo "<td>".$final[$col]."</td>";
                                                }
                                            @endphp
                                        </tr>
                                    </table>
                                    @isset($detail['line3'])
                                        <p class="mt-2">{{$detail['line3']}}</p>
                                        <p class="mt-2">{{$lang[3]}} = {{$detail['answer1']}}</p>
                                    @endisset
                                    <p class="mb-3 mt-2 text-center">{{$first}} × {{$second}} = {{$detail['answer1']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>