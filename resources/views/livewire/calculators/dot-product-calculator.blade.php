<div>
    <style>
        .input-unit {
            top: 2px;
        }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-1  mt-2  gap-4">
                    <div class="col-12">
                        <label for="input1" class="font-s-14 text-blue">{{ $lang['7'] }} :</label>
                        <div class="py-2">
                            <input type="text" wire:model.live="input1" id="input1" class="input mt-1 mt-lg-0">
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="input2" class="font-s-14 text-blue">{{ $lang['13'] }} :</label>
                        <div class="">
                            <input type="text" wire:model.live="input2" id="input2" class="input mt-3 mt-lg-0">
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
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            @php
                                $components = $detail['components'];
                                $components2 = $detail['components2'];
                                $length = min(count($components), count($components2));
                                $mgntd_a = $detail['mgntd_a'] ?? '';
                                $mgntd_b = $detail['mgntd_b'] ?? '';
                                $prod = $detail['prod'] ?? '';
                                $angle = $detail['angle'] ?? '';
                                $deg = $detail['deg'] ?? '';
                            @endphp
                            <div class="row my-2">
                                <div class="w-full md:w-[80%] lg:w-[80%]  text-[18px]">
                                    <table class="w-full">
                                        <tr>
                                            <td width="70%" class="border-b py-2"><b>{{ $lang['15'] }} :</b></td>
                                            <td class="border-b py-2">{{ $detail['prod'] }} <span class="text-[20px]"></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full md:w-[80%] lg:w-[80%]  text-[18px]">
                                    <table class="col-lg-8 ">
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['16'] }} A => |A|</td>
                                            <td class="border-b py-2">{{ $detail['mgntd_a'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['16'] }} B => |B|</td>
                                            <td class="border-b py-2">{{ $detail['mgntd_b'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['17'] }} (α)</td>
                                            <td class="border-b py-2">{{ $detail['deg'] }} deg</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="overflow-x-auto">
                                <p class="mt-2 text-[18px]"><b>{{ $lang['20'] }}:</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B =
                                    @for ($i = 0; $i < $length; $i++)
                                        ({{ $components[$i] }} * {{ $components2[$i] }})
                                        @if ($i < $length - 1)
                                            +
                                        @endif
                                    @endfor \)
                                </p>
                                <p class="mt-2">\( \vec A \cdot \vec B =
                                    @for ($i = 0; $i < $length; $i++)
                                        ({{ $components[$i] * $components2[$i] }})
                                        @if ($i < $length - 1)
                                            +
                                        @endif
                                    @endfor \)
                                </p>
                                <p class="mt-2">\( \vec A \cdot \vec B = {{ $prod }} \)</p>

                                <p class="mt-2"><b>{{ $lang['16'] }} A:</b></p>
                                <p class="mt-2">\( |A| = \sqrt{
                                    @for ($i = 0; $i < $length; $i++)
                                        ({{ $components[$i] }})^2
                                        @if ($i < $length - 1)
                                            +
                                        @endif
                                    @endfor } \)
                                </p>
                                <p class="mt-2">\( |A| = \sqrt{
                                    @for ($i = 0; $i < $length; $i++)
                                        ({{ pow($components[$i], 2) }})
                                        @if ($i < $length - 1)
                                            +
                                        @endif
                                    @endfor }
                                    \) = {{ $mgntd_a }}</p>

                                <p class="mt-2"><b>{{ $lang['16'] }} B:</b></p>
                                <p class="mt-2">\( |B| = \sqrt{
                                    @for ($i = 0; $i < $length; $i++)
                                        ({{ $components2[$i] }})^2
                                        @if ($i < $length - 1)
                                            +
                                        @endif
                                    @endfor } \)
                                </p>
                                <p class="mt-2">\( |B| = \sqrt{
                                    @for ($i = 0; $i < $length; $i++)
                                        ({{ pow($components2[$i], 2) }})
                                        @if ($i < $length - 1)
                                            +
                                        @endif
                                    @endfor }
                                    \) = {{ $mgntd_b }}</p>

                                <p class="mt-2"><b>{{ $lang['17'] }} A {{ $lang['21'] }} B:</b></p>
                                <p class="mt-2">\( \cos\theta = (\vec A \cdot \vec B) / (|A||B|) \)</p>
                                <p class="mt-2">\( \cos\theta = ({{ $prod }}) / ({{ $mgntd_a }} * {{ $mgntd_b }}) \)
                                </p>
                                <p class="mt-2">\( \cos\theta = {{ $angle }} \)</p>
                                <p class="mt-2">\( \theta = (\cos)^{-1} {{ $angle }} \)</p>
                                <p class="mt-2">\( \theta = {{ $deg }} \text{ deg} \)</p>
</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @if (isset($detail))
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.hook('morph.updated', () => {
                    if (window.MathJax) {
                        MathJax.typesetPromise();
                    }
                });
            });
        </script>
    @endif
</div>
