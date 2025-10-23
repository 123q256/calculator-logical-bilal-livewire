<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="z" class="font-s-14 text-blue">{!! $lang['1'] !!} (Z):</label>
                    <input type="number" step="any" name="z" id="z" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->z)?request()->z:'2' }}" />
                </div>
                <div class="space-y-2 relative">
                    <label for="n" class="font-s-14 text-blue">{!! $lang['2'] !!} (N):</label>
                    <input type="number" step="any" name="n" id="n" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->n)?request()->n:'4' }}" />
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
                <div class="w-full  p-3 rounded-lg mt-3">
                    <div class="w-full mt-2">
                        <p><strong>{{ $lang['3'] }}</strong></p>
                        <p class="text-[#119154] text-3xl font-semibold my-2">
                            {{ $detail['a'] }} <span class="text-[#119154] text-xl">u</span>
                        </p>
                        <p><strong>{{ $lang['3'] }} (SI)</strong></p>
                        <p class="text-[#119154] text-3xl mt-2 font-semibold">
                            {{ $detail['asi'] }} x10<sup class="text-[#119154]">-27</sup> <span class="text-[#119154] text-xl">kg</span>
                        </p>
                
                        <div class="grid  grid-cols-1 overflow-auto mt-2">
                            <table class="w-full border-collapse">
                                <tr>
                                    <td class="border-b py-2">{{ $lang['4'] }}</td>
                                    <td class="border-b py-2 font-semibold">{{ $detail['a'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{ $lang['5'] }}</td>
                                    <td class="border-b py-2 font-semibold">
                                        <sup>{{ $detail['a'] }}</sup>
                                        <sub>{{ request()->z }}</sub>
                                        {{ $detail['symbol'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 text-blue-600 font-semibold" colspan="2">
                                        @php
                                            if(isset($detail['stable'])){
                                                echo 'Stable atom';
                                            } elseif(isset($detail['unstable'])){
                                                echo 'Unstable, radioactive atom.';
                                            } elseif(isset($detail['unobserved'])){
                                                echo 'Unobserved atom. Try another combination of protons and neutrons.';
                                            }
                                        @endphp
                                    </td>
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>