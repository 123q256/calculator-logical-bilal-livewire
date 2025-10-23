<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
                
                <div class="col-span-12 flex items-center justify-between">
                    <div class="grid grid-cols-12  gap-4">
                    <p class="col-span-12 md:col-span-6 lg:col-span-6">{{ $lang['1'] }}</p>

                        <div class=" col-span-12 md:col-span-6 lg:col-span-6 d-flex align-items-center">
                            @if (isset($_POST['form']))
                                @if ($_POST['form']=='raw')
                                    <input name="form" id="form" class="r_data" value="raw" type="radio" checked />
                                @else
                                    <input name="form" id="form" class="r_data" value="raw" type="radio" />
                                @endif
                            @else
                                <input name="form" id="form" class="r_data" value="raw" type="radio" checked />
                            @endif
                            <label for="form" class="font-s-14  pe-lg-3 px-1">{{ $lang['2'] }}</label>
                            @if (isset($_POST['form']) && $_POST['form']=='summary')
                                <input name="form" id="form1" class="s_data" value="summary" type="radio" checked />
                            @else
                                <input name="form" id="form1" class="s_data" value="summary" type="radio" />
                            @endif
                            <label for="form1" class="font-s-14  ps-1">{{ $lang['3'] }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 summary {{ isset($_POST['form']) && $_POST['form']=='summary' ? '' : 'hidden' }}">
                    <div class="grid grid-cols-12  gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="deviation" class="font-s-14 "><?=$lang['4']?> σ:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="deviation" id="deviation" value="{{ isset($_POST['deviation'])?$_POST['deviation']:'8.3016' }}" class="input" aria-label="input" placeholder="e.g. 8.3016" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 sample">
                            <label for="sample" class="font-s-14 "><?=$lang['5']?> (n):</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="sample" id="sample" value="{{ isset($_POST['sample'])?$_POST['sample']:'4' }}" class="input" aria-label="input" placeholder="e.g. 4" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12  raw {{ isset($_POST['form']) && $_POST['form']=='summary' ? 'hidden' : '' }}">
                    <label for="x" class="font-s-14 ">{{ $lang['6'] }} ({{ $lang['7'] }})</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54">{{ isset($_POST['x'])?$_POST['x']:'12, 23, 45, 33, 65, 54, 54' }}</textarea>
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
                                <div class="text-center">
                                    <p class="text-[25]"><strong>{{ $lang['14'] }}</strong></p>
                                    <div class="flex justify-center">
                                    <p class="text-[30px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['se'] }}</strong>
                                    </p>
                                </div>
                            </div>
                                @php
                                    $request = request();
                                @endphp
                                @if ($detail['form']=='raw')
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2">
                                        <table class="w-full text-[18px]">
                                            <tr>
                                                <td class=" py-2 border-b"><?=$lang['9']?> n</td>
                                                <td class="py-2 border-b"><strong>{{ $detail['count'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class=" py-2 border-b"><?=$lang['10']?> ∑ x</td>
                                                <td class="py-2 border-b"><strong>{{ $detail['sum'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class=" py-2 border-b"><?=$lang['11']?> x̄</td>
                                                <td class="py-2 border-b"><strong>{{ $detail['mean'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class=" py-2 border-b"><?=$lang['4']?> σ</td>
                                                <td class="py-2 border-b"><strong>{{ $detail['e'] }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="w-full mt-3 text-[20px] "><?=$lang['12']?></p>
                                    <p class="w-full mt-2"><?=$lang['8']?> : (<?=$request->x?>)</p>
                                    <p class="w-full mt-2"><?=$lang['9']?> : <?=$detail['count']?></p>
                                    <p class="w-full mt-2"><?=$lang['13']?> = σ / √n </p>
                                    <p class="w-full mt-2"> σ = <?=$lang['4']?> </p>
                                    <p class="w-full mt-2"> σ =√( ∑ (x - x̄)² / n - 1 )</p>
                                    <p class="w-full mt-2"> x = <?=$lang['15']?></p>
                                    <p class="w-full mt-2"> x̄ = <?=$lang['11']?></p>
                                    <p class="w-full mt-2"> n = <?=$lang['9']?></p>
                                    <p class="w-full mt-2"> σ = √(1/<?=$detail['count']?>-1) * (<?=$detail['v1']?>)</p>
                                    <p class="w-full mt-2"> σ = √(1/<?=$detail['v2']?>) * (<?=$detail['v']?>)</p>
                                    <p class="w-full mt-2"> σ = √(1/<?=$detail['v2']?>) * (<?=$detail['v3']?>)</p>
                                    <p class="w-full mt-2"> σ = √(1/<?=$detail['v2']?>) * (<?=$detail['c']?>)</p>
                                    <p class="w-full mt-2"> σ = √(<?=$detail['v4']?>) * (<?=$detail['c']?>)</p>
                                    <p class="w-full mt-2"> σ = √<?=$detail['v5']?></p>
                                    <p class="w-full mt-2"> σ = √<?=$detail['rv']?></p>
                                    <p class="w-full mt-2"> <?=$lang['14']?> = σ / √n</p>
                                    <p class="w-full mt-2"> <?=$lang['14']?> = <?=$detail['rv']?> / √<?=$detail['count']?></p>
                                    <p class="w-full mt-2"> <?=$lang['14']?> = <?=$detail['rv']?> / <?=$detail['v6']?></p>
                                    <p class="w-full mt-2  text-[20px]"> <?=$lang['14']?> = <?=$detail['v7']?></p>
                                @else
                                    <p class="w-full mt-3 text-[20px] "><?=$lang['12']?></p>
                                    <p class="w-full mt-2"> σ = <?=$request->deviation?></p>
                                    <p class="w-full mt-2"> n = <?=$request->sample?></p>
                                    <p class="w-full mt-2"><?=$lang['13']?> = σ / √n </p>
                                    <p class="w-full mt-2"><?=$lang['14']?> = <?=$request->deviation?> / √ <?=$request->sample?> </p>
                                    <p class="w-full mt-2"><?=$lang['14']?> = <?=$request->deviation?> / <?=$detail['sn']?> </p>
                                    <p class="w-full mt-2 text-[20px] "><strong><?=$lang['14']?> = <?=$detail['se']?></strong> </p>
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