<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 flex items-center space-x-6 border-b pb-2 mb-2">
                        <span class="text-blue-700 font-semibold">A, B - {{ $lang[1] ?? 'Dominant alleles' }}</span>
                        <span class="text-blue-700 font-semibold">a, b - {{ $lang[2] ?? 'Recessive alleles' }}</span>
                    </div>

                    {{-- Parent 1 (Mother) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="mtype1" class="font-s-14 text-blue">{!! $lang['3'] ?? 'Mother' !!} Gene A:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="mtype1" id="mtype1" class="input">
                                <option value="0">AA</option>
                                <option value="1">Aa</option>
                                <option value="2">aa</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="mtype2" class="font-s-14 text-blue">{!! $lang['3'] ?? 'Mother' !!} Gene B:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="mtype2" id="mtype2" class="input">
                                <option value="0">BB</option>
                                <option value="1">Bb</option>
                                <option value="2">bb</option>
                            </select>
                        </div>
                    </div>

                    {{-- Parent 2 (Father) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="ftype1" class="font-s-14 text-blue">{!! $lang['4'] ?? 'Father' !!} Gene A:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="ftype1" id="ftype1" class="input">
                                <option value="0">AA</option>
                                <option value="1">Aa</option>
                                <option value="2">aa</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="ftype2" class="font-s-14 text-blue">{!! $lang['4'] ?? 'Father' !!} Gene B:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="ftype2" id="ftype2" class="input">
                                <option value="0">BB</option>
                                <option value="1">Bb</option>
                                <option value="2">bb</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @if ($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full overflow-auto">
                                <table class="w-full md:w-[60%] lg:w-[60%]" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2">AABB</td>
                                        <td class="border-b"><strong>{{ $detail['finalRes']*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">AABb</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][1]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">AAbb</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][2]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">AaBB</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][3]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">AaBb</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][4]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">Aabb</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][5]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">aaBB</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][6]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">aaBb</td>
                                        <td class="border-b"><strong>{{ $detail['tablResults'][7]*100 }}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">aabb</td>
                                        <td><strong>{{ $detail['tablResults'][8]*100 }}%</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="mt-2"><strong class="text-blue font-s-18">{{ $lang[5] }}</strong></p>
                            <div class="w-full overflow-auto">
                                {!! $detail['table'] !!}
                            </div>
                            <p class="mt-2"><strong class="text-blue font-s-18">{{ $lang[6] }}</strong></p>
                            <div class="w-full overflow-auto">
                                <table class="w-full md:w-[60%] lg:w-[60%]" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2"><b>{{ $lang['res'] }}</b></td>
                                        <td class="border-b"><b>{{ $lang[7] }}</b></td>
                                        <td class="border-b"><b>{{ $lang[8] }}</b></td>
                                    </tr>
                                    <tr><td class="border-b py-2">AABB</td><td class="border-b">AABB</td><td class="border-b">AB</td></tr>
                                    <tr><td class="border-b py-2">AABb</td><td class="border-b">AABb</td><td class="border-b">AB</td></tr>
                                    <tr><td class="border-b py-2">AaBB</td><td class="border-b">AaBB</td><td class="border-b">AB</td></tr>
                                    <tr><td class="border-b py-2">AaBb</td><td class="border-b">AaBb</td><td class="border-b">AB</td></tr>
                                    <tr><td class="border-b py-2">AAbb</td><td class="border-b">AAbb</td><td class="border-b">Ab</td></tr>
                                    <tr><td class="border-b py-2">Aabb</td><td class="border-b">Aabb</td><td class="border-b">Ab</td></tr>
                                    <tr><td class="border-b py-2">aaBB</td><td class="border-b">aaBB</td><td class="border-b">aB</td></tr>
                                    <tr><td class="border-b py-2">aaBb</td><td class="border-b">aaBb</td><td class="border-b">aB</td></tr>
                                    <tr><td class="py-2">aabb</td><td>aabb</td><td>ab</td></tr>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
