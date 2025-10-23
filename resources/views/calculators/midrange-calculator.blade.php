<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
    @if (isset($error))
    <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
    @endif
    <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        <div class="grid grid-cols-12 mt-3  gap-4">
        <div class="col-span-12">
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
                <div class="w-full bg-light-blue result p-3 radius-10 mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]">
                                <strong>{{ $lang['3'] }}</strong>
                            </p>
                        <div class="flex justify-center">
                            <p class="text-[25px] bg-[#2845F5]  px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-white">{{ round($detail['ans'],5) }}</strong>
                            </p>
                        </div>
                    </div>
                        <p class="w-full mt-3 text-[20px]"><?=$lang['4']?>:</p>
                        <p class="w-full mt-2"><?=$lang['5']?>:</p>
                        <p class="w-full mt-2">\( \text{<?=$lang['3']?>}= \dfrac{\text{Max }+\text{ Min}}{2}\)</p>
                        <p class="w-full mt-2">\( \text{Max }= <?=$detail['max']?>\)</p>
                        <p class="w-full mt-2">\( \text{Min }= <?=$detail['min']?>\)</p>
                        <p class="w-full mt-2">\( \text{<?=$lang['3']?>}= \dfrac{<?=$detail['max']?>+<?=$detail['min']?>}{2}\)</p>
                        <p class="w-full mt-2">\( \text{<?=$lang['3']?>}= \dfrac{<?=$detail['max']+$detail['min']?>}{2}\)</p>
                        <p class="w-full mt-2">\( \text{<?=$lang['3']?>}= <?=$detail['ans']?>\)</p>
                        <p class="w-full mt-3 text-[20px] text-blue"><?=$lang['6']?>:</p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2">
                            <table class="w-full text-[20px]">
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['7']?></td>
                                    <td class="py-2 border-b"><?=$detail['min']?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['8']?></td>
                                    <td class="py-2 border-b"><?=$detail['max']?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['9']?></td>
                                    <td class="py-2 border-b"><?=$detail['range']?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['10']?></td>
                                    <td class="py-2 border-b"><?=$detail['count']?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['11']?></td>
                                    <td class="py-2 border-b"><?=$detail['sum']?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['12']?></td>
                                    <td class="py-2 border-b"><?=$detail['median']?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">Mode</td>
                                    <td class="py-2 border-b"><?php
                                        foreach ($detail['mode'] as $key => $value) {
                                            echo "$value ";
                                        }
                                    ?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['13']?></td>
                                    <td class="py-2 border-b"><?=round($detail['SD'],2)?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><?=$lang['14']?></td>
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
    <script>
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>