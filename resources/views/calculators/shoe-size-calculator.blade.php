<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
        {{-- <div class="col-12 col-lg-8 mx-auto">
            <div class="row">
                @if (isset($error))
                    <p class="text-danger font-s-18"><strong>{{ $error }}</strong></p>
                @endif
                <div class="col-lg-6 col-12 px-2 mt-2 pe-lg-3">
                    <label for="gen" class="font-s-14 text-blue one_text">{{$lang['1']}}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="gen" id="gen">
                            <option selected value="ad">{{ $lang[2] }}</option>
                            <option value="c">{{ $lang[3] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 mt-2 pe-lg-3">
                    <label for="country" class="font-s-14 text-blue one_text">{{$lang['4']}}:</label>
                    <div class="w-100 py-2">
                        <select class="input" name="country" id="country">
                            <option selected value="us">{{ $lang[5] }}</option>
                            <option value="uk">{{ $lang[6] }}</option>
                            <option value="eu">{{ $lang[7] }}</option>
                            <option value="ko">{{ $lang[8] }}</option>
                            <option value="mj">{{ $lang[9] }}</option>
                            <option value="fcm">{{ $lang[10] }}</option>
                            <option value="fin">{{ $lang[11] }}</option>
                            <option value="m">{{ $lang[12] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-12 px-2 pe-lg-3 mt-2">
                    <label for="size" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="size" id="size" class="input" aria-label="input"
                            value="{{ isset(request()->size) ? request()->size : '8' }}" />
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="gen" class="font-s-14 text-blue one_text">{{$lang['1']}}:</label>
                        <select class="input" name="gen" id="gen">
                            <option selected value="ad">{{ $lang[2] }}</option>
                            <option value="c">{{ $lang[3] }}</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="country" class="font-s-14 text-blue one_text">{{$lang['4']}}:</label>
                        <select class="input" name="country" id="country">
                            <option selected value="us">{{ $lang[5] }}</option>
                            <option value="uk">{{ $lang[6] }}</option>
                            <option value="eu">{{ $lang[7] }}</option>
                            <option value="ko">{{ $lang[8] }}</option>
                            <option value="mj">{{ $lang[9] }}</option>
                            <option value="fcm">{{ $lang[10] }}</option>
                            <option value="fin">{{ $lang[11] }}</option>
                            <option value="m">{{ $lang[12] }}</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="size" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                        <input type="number" step="any" name="size" id="size" class="input" aria-label="input"
                        value="{{ isset(request()->size) ? request()->size : '8' }}" />
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
        

        @if(isset($detail))

          {{-- result --}}
          <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue rounded-lg mt-6">
                    @php
                        $gen       = request()->gen;
                        $country   = request()->country;
                    @endphp
                    <div class="my-4">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto text-base">
                            <table class="w-full">
                                <tr>
                                    @if($detail['gen'] == 'c')
                                        <td class="border-b border-gray-300 py-3"><strong>{{ $lang[3] }}</strong></td>
                                    @elseif ($detail['gen'] == 'ad')
                                        <td class="border-b border-gray-300 py-3"><strong>{{ $lang[2] }}</strong></td>
                                    @endif
                                    @if ($detail['country'] == 'us')
                                        <td class="border-b border-gray-300 py-3">{{ number_format($detail['us'], 1) }}</td>
                                    @elseif ($detail['country'] == 'uk')
                                        <td class="border-b border-gray-300 py-3">{{ number_format($detail['uk'], 1) }}</td>
                                    @elseif ($detail['country'] == 'eu')
                                        <td class="border-b border-gray-300 py-3">{{ number_format($detail['eu'], 1) }}</td>
                                    @elseif ($detail['country'] == 'ko')
                                        <td class="border-b border-gray-300 py-3">{{ number_format($detail['ko'], 1) }}</td>
                                    @elseif ($detail['country'] == 'mj')
                                        <td class="border-b border-gray-300 py-3">{{ number_format($detail['mj'], 1) }}</td>
                                    @elseif ($detail['country'] == 'fin')
                                        <td class="border-b border-gray-300 py-3">{{ number_format($detail['fin'], 1) }}</td>
                                    @elseif ($detail['country'] == 'fcm')
                                        <td class="border-b border-gray-300 py-3">{{ number_format($detail['fcm'], 1) }}</td>
                                    @elseif ($detail['country'] == 'm')
                                        <td class="border-b border-gray-300 py-3">{{ number_format($detail['m'], 1) }}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center py-3"><strong>{{ $lang[14] }}</strong></th>
                                </tr>
                                @if ($detail['gen'] == 'ad')
                                    <tr>
                                        <td class="border-b border-gray-300 py-3">{{ $lang[20] }}</td>
                                        <td class="border-b border-gray-300 py-3 text-right">{{ number_format($detail['wo'], 1) }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="border-b border-gray-300 py-3">{{ $lang[15] }}</td>
                                    <td class="border-b border-gray-300 py-3 text-right">{{ number_format($detail['us'], 1) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-300 py-3">{{ $lang[16] }}</td>
                                    <td class="border-b border-gray-300 py-3 text-right">{{ number_format($detail['eu'], 1) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-300 py-3">{{ $lang[17] }}</td>
                                    <td class="border-b border-gray-300 py-3 text-right">{{ number_format($detail['uk'], 1) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-300 py-3">{{ $lang[18] }}</td>
                                    <td class="border-b border-gray-300 py-3 text-right">{{ number_format($detail['mj'], 1) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-300 py-3">{{ $lang[19] }}</td>
                                    <td class="border-b border-gray-300 py-3 text-right">{{ number_format($detail['ko'], 1) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-300 py-3">{{ $lang[12] }}</td>
                                    <td class="border-b border-gray-300 py-3 text-right">{{ number_format($detail['m'], 1) }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-300 py-3">{{ $lang[10] }}</td>
                                    <td class="border-b border-gray-300 py-3 text-right">{{ number_format($detail['fcm'], 1) }} cm</td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-300 py-3">{{ $lang[11] }}</td>
                                    <td class="border-b border-gray-300 py-3 text-right">{{ number_format($detail['fin'], 1) }} in</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



        
    @endif
</form>
