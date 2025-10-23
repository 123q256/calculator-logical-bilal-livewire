<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="eq" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2">
                        <input type="text" name="eq" id="eq" class="input"
                            value="{{ isset($_POST['eq']) ? $_POST['eq'] : 'x^4 - 16x^3 + 90x^2 - 224x + 245 = 6' }}"
                            aria-label="input" />
                    </div>
                </div>
            </div>
        </div>
        @if ($type == 'calculator')
            @include('inc.button')
        @endif
        @if ($type == 'widget')
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
                            @php
                                $eq = $detail['eq'];
                                $s2 = $detail['s2'];
                                $sum = $detail['sum'];
                                $prod = $detail['prod'];
                            @endphp
                            <div class="w-full">
                                @php
                                    $s2 = explode('###', $s2);
                                    $count = count($s2);
                                @endphp
                                @for ($i = $count - 1; $i >= 0; $i--)
                                    <p class="mt-3 text-[18px]">
                                        <strong>
                                            \( {{ 'x = ' . preg_replace('/frac/', 'dfrac', $s2[$i]) }} \)
                                        </strong>
                                    </p>
                                @endfor
                            </div>
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                        <td class="py-2 border-b">\( {{ preg_replace('/frac/', 'dfrac', $sum) }} \)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['5'] }}</strong></td>
                                        <td class="py-2 border-b">\( {{ preg_replace('/frac/', 'dfrac', $prod) }} \)</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endisset
    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({"SVG": {linebreaks: { automatic: true }} });
        </script>
    @endpush
</form>
