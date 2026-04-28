<div>
    <style>
        .fractionUpDown {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            font-size: .9em;
        }
        .fractionUpDown .num {
            top: 0;
            padding: 0 .3rem;
            display: block;
            white-space: nowrap;
            border-bottom: 1px solid currentColor;
        }
        .visually-hidden {
            width: 1px;
            height: 1px;
            margin: -1px;
            padding: 0;
            border: 0;
            position: absolute;
            clip: rect(0 0 0 0);
            overflow: hidden;
        }
        .fractionUpDown .den {
            line-height: 15px;
            display: block;
            width: 100%;
            white-space: nowrap;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[50%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-6">
                    {{-- Formula Display --}}
                    <div class="text-center py-4 bg-blue-50 rounded-lg">
                        <p class="text-xl font-semibold">
                            k = <span class="fractionUpDown">
                                <span class="num">y</span>
                                <span class="den">x</span>
                            </span>
                        </p>
                    </div>

                    {{-- Inputs --}}
                    <div class="space-y-2">
                        <label for="y" class="font-s-14 text-blue">{{ $lang['1'] }} (y):</label>
                        <input type="text" inputmode="decimal" wire:model.live="y" id="y" class="input" placeholder="3" />
                    </div>

                    <div class="space-y-2">
                        <label for="x" class="font-s-14 text-blue">{{ $lang['2'] }} (x):</label>
                        <input type="text" inputmode="decimal" wire:model.live="x" id="x" class="input" placeholder="5" />
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

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                  <div class="">
        @if ($type == 'calculator')
            @include('inc.copy-pdf')
        @endif
        <div class="rounded-lg  flex items-center justify-center">
            <div class="w-full mt-3">
                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                    <table class="w-full font-s-18">
                        <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{$lang[3]}} (K)</strong></td>
                            <td class="py-2 border-b"> {{ $detail['ans'] }}</td>
                        </tr>
                    </table>
                </div>
                <div class="w-full font-s-16">
                    <p class="mt-2">
                        {{$lang[3]}} (K) =
                            <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                <span class="num">y</span>
                                <span class="visually-hidden"> / </span>
                                <span class="den">x</span>
                            </span>
                    </p>
                    <p class="mt-2">
                        {{$lang[3]}} (K) =
                            <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                <span class="num">{{ $y }}</span>
                                <span class="visually-hidden"> / </span>
                                <span class="den">{{ $x }}</span>
                            </span>
                    </p>
                    <p class="mt-2">{{$lang[3]}} (K) = {{$detail['ans']}} </p>
                </div>
            </div>
        </div>
    </div>
            </div>
        @endisset
    </form>
</div>
