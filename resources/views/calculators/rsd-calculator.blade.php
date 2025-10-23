<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
            
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="col-12 px-2 mb-3 text-center d-flex align-items-center justify-content-start">
                <p class="font-s-14 text-blue me-2 mb-0">{{ $lang[19] }}</p>
                @if (isset($_POST['form']))
                    @if ($_POST['form']=='raw')
                        <input name="form" id="form" value="raw" class="r_data" type="radio" checked />
                    @else
                        <input name="form" id="form" value="raw" class="r_data" type="radio" />
                    @endif
                @else
                    <input name="form" id="form" value="raw" class="r_data" type="radio" checked />
                @endif
                <label for="form" class="font-s-14 text-blue pe-lg-3 px-1 mb-0">{{ $lang['1'] }}</label>
                
                @if (isset($_POST['form']) && $_POST['form']=='summary')
                    <input name="form" id="form1" value="summary" class="s_data" type="radio" checked />
                @else
                    <input name="form" id="form1" value="summary" class="s_data" type="radio" />
                @endif
                <label for="form1" class="font-s-14 text-blue ps-1 mb-0">{{ $lang['2'] }}</label>
            </div>
            
            <div class="grid grid-cols-1  gap-4">
                <div class="space-y-2 raw {{ isset($_POST['form']) && $_POST['form']=='summary' ? 'hidden':'' }}">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['5'] }} ({{ $lang['6'] }})</label>
                    <textarea name="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54">{{ isset($_POST['x'])?$_POST['x']:'12, 23, 45, 33, 65, 54, 54' }}</textarea>
                </div>
            </div>
            <div class="space-y-2  summary {{ !isset($_POST['form']) || $_POST['form']!='summary' ? 'hidden':'' }}">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">

                    <div class="space-y-2">
                        <label for="mean" class="font-s-14 text-blue mean">{{ $lang['3'] }}:</label>
                        <input type="number" step="any" name="mean" id="mean" value="{{ isset($_POST['mean'])?$_POST['mean']:'20.75' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2">
                        <label for="deviation" class="font-s-14 text-blue deviation">{{ $lang['4'] }}:</label>
                        <input type="number" step="any" name="deviation" id="deviation" value="{{ isset($_POST['deviation'])?$_POST['deviation']:'8.3016' }}" class="input" aria-label="input" placeholder="00" />
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
            <div class="rounded-lg  flex items-center mt-3 justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="font-s-20">
                                <strong>{{ $lang['7'] }}</strong>
                            </p>
                            <p class="px-3 py-2  my-3">
                                <strong class="text-white bg-[#2845F5] text-[30px] rounded-lg  px-3 py-2">{{ round($detail['rsd'],5) }}%</strong>
                            </p>
                        </div>
                        @if ($detail['form']=='raw')
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[8] ?></td>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?= $detail['min'] ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[9] ?></td>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?= $detail['max'] ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[10] ?></td>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?= $detail['range'] ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[11] ?></td>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?= $detail['count'] ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[12] ?></td>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?= $detail['sum'] ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[13] ?></td>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?= $detail['median'] ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[14] ?></td>
                                        <td class="py-2 border-b">
                                            <strong class="text-[#2845F5]">
                                                <?php
                                                    foreach ($detail['mode'] as $key => $value) {
                                                        echo "$value ";
                                                    }
                                                ?>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[3] ?></td>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?= round($detail['mean'], 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[15] ?></td>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?= round($detail['SD'], 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[16] ?></td>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?= round($detail['svar'], 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[17] ?></td>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?= round($detail['PSD'], 4) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><?= $lang[18] ?></td>
                                        <td class="py-2 border-b"><strong class="text-[#2845F5]"><?= round($detail['pvar'], 4) ?></strong></td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.querySelector('.s_data').addEventListener('click', function() {
            document.querySelector('.summary').style.display = 'block';
            document.querySelector('.raw').style.display = 'none';
        });

        document.querySelector('.r_data').addEventListener('click', function() {
            document.querySelector('.summary').style.display = 'none';
            document.querySelector('.raw').style.display = 'block';
        });

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>