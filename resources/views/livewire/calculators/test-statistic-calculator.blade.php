<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2">
                    <label for="operations" class="col-span-12 label my-4">Select Format</label>
                    <div class="col-span-12 position-relative">
                    <input type="radio" wire:model.live="test_radio" id="test_radio" value="data" class="cursor-pointer">
                    <label for="test_radio" class="cursor-pointer">Enter the data in row</label>
                    </div>
                    <div class="col-span-12 position-relative">
                    <input type="radio" wire:model.live="test_radio" id="test_radio1" value="sem" class="cursor-pointer">
                    <label for="test_radio1" class="cursor-pointer">Enter mean, SEM and n</label>
                    </div>
                    <div class="col-span-12 position-relative">
                    <input type="radio" wire:model.live="test_radio" id="test_radio2" value="sd" class="cursor-pointer">
                    <label for="test_radio2" class="cursor-pointer">Enter mean, SD and n</label>
                    </div>

                    <div class="col-span-12">
                        @if($test_radio === 'data')
                            <div class="grid grid-cols-12 mt-3 gap-8" id="section1">
                                <div class="col-span-6 px-2">
                                    <label for="row_data" class="font-s-14 text-blue">Group One</label>
                                    <div class="w-full py-2">
                                        <textarea wire:model.live="row_data" id="row_data" class="form-control px-2 py-2 h-[200px]" placeholder="e.g. 78, 82, 86..."></textarea>
                                    </div>
                                </div>
                                <div class="col-span-6 px-2">
                                    <label for="row_data1" class="font-s-14 text-blue">Group Two</label>
                                    <div class="w-full py-2">
                                        <textarea wire:model.live="row_data1" id="row_data1" class="form-control px-2 py-2 h-[200px]" placeholder="e.g. 69, 50, 34..."></textarea>
                                    </div>
                                </div>
                            </div>
                        @elseif($test_radio === 'sem')
                            <div class="col-span-12" id="section2">
                                <div class="grid grid-cols-12 mt-3 gap-8">
                                    <div class="col-span-6">
                                        <div class="col-6 col-lg-12 px-2 my-3">
                                            <label class="font-s-14 text-blue">Group 1</label>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="mean" class="font-s-14 text-blue">Mean (x̄)</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="mean" id="mean" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="sem" class="font-s-14 text-blue">SEM</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="sem" id="sem" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="n" class="font-s-14 text-blue">Sample Size (n)</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="n" id="n" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-6">
                                        <div class="col-6 col-lg-12 px-2 my-3">
                                            <label class="font-s-14 text-blue">Group 2</label>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="mean1" class="font-s-14 text-blue">Mean (x̄)</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="mean1" id="mean1" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="sem1" class="font-s-14 text-blue">SEM</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="sem1" id="sem1" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="n1" class="font-s-14 text-blue">Sample Size (n)</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="n1" id="n1" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($test_radio === 'sd')
                            <div class="col-span-12" id="section3">
                                <div class="grid grid-cols-12 mt-3 gap-8">
                                    <div class="col-span-6">
                                        <div class="col-6 col-lg-12 px-2 my-3">
                                            <label class="font-s-14 text-blue">Group 1</label>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="mean_sec" class="font-s-14 text-blue">Mean (x̄)</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="mean_sec" id="mean_sec" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="sd_sec" class="font-s-14 text-blue">Standard Deviation (SD)</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="sd_sec" id="sd_sec" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="n_sec" class="font-s-14 text-blue">Sample Size (n)</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="n_sec" id="n_sec" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-6">
                                        <div class="col-6 col-lg-12 px-2 my-3">
                                            <label class="font-s-14 text-blue">Group 2</label>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="mean_sec1" class="font-s-14 text-blue">Mean (x̄)</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="mean_sec1" id="mean_sec1" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="sd_sec1" class="font-s-14 text-blue">Standard Deviation (SD)</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="sd_sec1" id="sd_sec1" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-12 px-2">
                                            <label for="n_sec2" class="font-s-14 text-blue">Sample Size (n)</label>
                                            <div class="w-100 py-2">
                                                <input type="number" step="any" wire:model.live="n_sec2" id="n_sec2" class="input" placeholder="00" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            @php
                                $res_test_radio = $detail['test_radio'] ?? $test_radio;
                            @endphp
                            <div class="w-full">
                                <div class="w-full mt-2">
                                    <p class="my-2">Values derived from inputs are:</p>
                                    <div class="w-full lg:w-[50%] mt-2 overflow-auto">
                                        <table class="w-full font-s-16">
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>T-test</strong></td>
                                                <td class="py-2 border-b">{{ round($detail['tValue'], 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>Df</strong></td>
                                                <td class="py-2 border-b">{{ round($detail['df'], 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>Standard Error of Difference</strong></td>
                                                <td class="py-2 border-b">{{ round($detail['standardError'], 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>P value</strong></td>
                                                <td class="py-2 border-b">{{ round($detail['pValue'], 5) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full mt-3">
                                <div class="w-full lg:w-[70%] mt-2 overflow-auto">
                                    <table class="w-full font-s-16 text-center">
                                        <tr>
                                            <td class="py-2 border-b"><strong>Group</strong></td>
                                            <td class="py-2 border-b"><strong>Group One</strong></td>
                                            <td class="py-2 border-b"><strong>Group Two</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>Mean</strong></td>
                                            <td class="py-2 border-b">{{ round($detail['mean1'], 2) }}</td>
                                            <td class="py-2 border-b">{{ round($detail['mean2'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>SD</strong></td>
                                            <td class="py-2 border-b">{{ round($detail['sd1'], 2) }}</td>
                                            <td class="py-2 border-b">{{ round($detail['sd2'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>SEM</strong></td>
                                            <td class="py-2 border-b">{{ round($detail['sem1'], 2) }}</td>
                                            <td class="py-2 border-b">{{ round($detail['sem2'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>N</strong></td>
                                            <td class="py-2 border-b">{{ round($detail['n1'], 2) }}</td>
                                            <td class="py-2 border-b">{{ round($detail['n2'], 2) }}</td>
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
</div>
