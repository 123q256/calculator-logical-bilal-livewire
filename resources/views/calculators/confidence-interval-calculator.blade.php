<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12 text-center mb-2 justify-center flex">
                        <img src="{{ url('images/c_i_e.svg') }}" alt="{{ $lang['5'].' '.$lang['17'] }}" width="100" height="75">
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="x" class="font-s-14 text-blue">{{ $lang['1'] }} (x̅)</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="x" id="x" value="{{ isset($_POST['x'])?$_POST['x']:'20.6' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="s" class="font-s-14 text-blue">{{ $lang['2'] }} (s)</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="s" id="s" value="{{ isset($_POST['s'])?$_POST['s']:'3.2' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="n" class="font-s-14 text-blue">{{ $lang['3'] }} (n)</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="n" id="n" min="1" value="{{ isset($_POST['n'])?$_POST['n']:'50' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="cl" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" name="cl" id="cl" min="0" max="99.99" value="{{ isset($_POST['cl'])?$_POST['cl']:'95' }}" class="input" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="rs" name="z" value="1.959964">
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
                    @php
                        $request = request();
                        $x=trim($request->x);
                        $s=trim($request->s);
                        $n=trim($request->n);
                        $cl=trim($request->cl);
                        $z=trim($request->z);
                    @endphp
                    <div class="w-full">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['5'] }}</td>
                                    <td class="p-2 border-b"><b>{{ $detail['ci'] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['6'] }}</td>
                                    <td class="p-2 border-b"><b>{{ $detail['ci1'] }} to {{ $detail['ci2'] }}</b></td>
                                </tr>
                            </table>
                        </div>
                        <p class="col-7 mt-3"><?=$lang['7']?> (μ) <?=$lang['8']?> x̅ ± E <?=$lang['9']?> <?=$cl?>% <?=$lang['10']?>.</p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b text-blue"><?=$lang['11']?></td>
                                    <td class='py-2 border-b'><strong><?=$detail['se']?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b text-blue"><?=$lang['12']?> (Z)</td>
                                    <td class='py-2 border-b'><strong><?=$detail['zscore']?> σ</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b text-blue"><?=$lang['13']?></td>
                                    <td class='py-2 border-b'><strong><?=$detail['rtpv']?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b text-blue"><?=$lang['14']?></td>
                                    <td class='py-2 border-b'><strong><?=$detail['lb']?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b text-blue"><?=$lang['15']?></td>
                                    <td class='py-2 border-b'><strong><?=$detail['ub']?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b text-blue"><?=$lang['16']?> (E)</td>
                                    <td class='py-2 border-b'><strong><?=$detail['moe']?></strong></td>
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>