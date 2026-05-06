<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        {{-- Dimension A --}}
                        <div class="mt-2">
                            <label for="a" class="label">{{ $lang['1'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="a" id="a" class="input" />
                            </div>
                        </div>

                        {{-- Dimension B --}}
                        <div class="mt-2">
                            <label for="b" class="label">{{ $lang['2'] }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="b" id="b" class="input" />
                            </div>
                        </div>

                        {{-- Columns Fixture --}}
                        <div class="mt-2">
                            <label for="columns_fixture" class="label">{{ $lang['3'] }}:</label>
                            <div class="w-100 py-2"> 
                                <select wire:model.live="columns_fixture" id="columns_fixture" class="input">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                        {{-- Rows Fixture --}}
                        <div class="mt-2">
                            <label for="rows_fixture" class="label">{{ $lang['4'] }}:</label>
                            <div class="w-100 py-2"> 
                                <select wire:model.live="rows_fixture" id="rows_fixture" class="input">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                        {{-- Include (Only shown for certain configurations if needed, but let's keep it consistent) --}}
                        <div class="mt-2">
                            <label for="include" class="label">{{ $lang['5'] }}:</label>
                            <div class="w-100 py-2"> 
                                <select wire:model.live="include" id="include" class="input">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        {{-- Units --}}
                        <div class="mt-2">
                            <label for="units" class="label">{{ $lang['6'] }}:</label>
                            <div class="w-100 py-2"> 
                                <select wire:model.live="units" id="units" class="input">
                                    <option value="mm">mm</option>
                                    <option value="cm">cm</option>
                                    <option value="m">m</option>
                                    <option value="in">in</option>
                                    <option value="ft">ft</option>
                                    <option value="yd">yd</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Image Preview --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 flex items-center justify-center">
                        <div class="p-2 mt-4 radius-5">
                            <img src="{{ asset($image_path) }}" alt="Recessed Lighting Diagram" class="max-w-full h-auto rounded-lg shadow-sm" width="300" height="250">
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
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
                            <div class="w-full">
                                <div class="w-full  lg:w-[80%] lg:text-[18px] md:text-[18px] text-[16px]  overflow-auto">
                                    <table class="w-full">
                                        @if ($columns_fixture == 1 && $rows_fixture == 1) 
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['a_not'], 2) }} {{ $units }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['b_not'], 2) }} {{ $units }}</td>
                                            </tr>
                                        @elseif ($columns_fixture == 1 && ($rows_fixture == 2 || $rows_fixture == 3)) 
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['a_not'], 2) }} {{ $units }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['a_i'], 2) }} {{ $units }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['b_not'], 2) }} {{ $units }}</td>
                                            </tr>
                                        @elseif (($columns_fixture == 2 || $columns_fixture == 3) && $rows_fixture == 1) 
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['a_not'], 2) }} {{ $units }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['b_not'], 2) }} {{ $units }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['b_i'], 2) }} {{ $units }}</td>
                                            </tr>
                                        @elseif ($columns_fixture == 2 && $rows_fixture == 2) 
                                            @if ($include === 'yes') 
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['a_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['a_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['b_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['b_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['12'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['y_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['13'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['x_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                            @else 
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['a_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2 text-blue-600 font-bold"><strong>{{ $lang['9'] }} :</strong></td>
                                                    <td class="border-b py-2 text-blue-600 font-bold">{{ number_format($detail['a_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['b_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2 text-blue-600 font-bold"><strong>{{ $lang['11'] }} :</strong></td>
                                                    <td class="border-b py-2 text-blue-600 font-bold">{{ number_format($detail['b_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                            @endif
                                        @elseif ($columns_fixture == 2 && $rows_fixture == 3) 
                                            @if ($include === 'yes') 
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['a_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['a_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['b_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['b_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['12'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['y_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['15'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['y_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['14'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['x_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                            @else 
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['a_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['a_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['b_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['b_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                            @endif
                                        @elseif ($columns_fixture == 3 && $rows_fixture == 2) 
                                            @if ($include === 'yes') 
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['a_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['a_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['b_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['b_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['12'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['y_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['13'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['x_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['14'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['x_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                            @else 
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['a_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['a_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['b_not'], 2) }} {{ $units }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ number_format($detail['b_i'], 2) }} {{ $units }}</td>
                                                </tr>
                                            @endif
                                        @elseif ($columns_fixture == 3 && $rows_fixture == 3) 
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['7'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['a_not'], 2) }} {{ $units }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['9'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['a_i'], 2) }} {{ $units }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['8'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['b_not'], 2) }} {{ $units }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang['11'] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['b_i'], 2) }} {{ $units }}</td>
                                            </tr>
                                        @endif
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

@push('calculatorJS')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('scroll-to-result', () => {
                setTimeout(() => {
                    const el = document.getElementById('result-section');
                    if (el) {
                        const offset = el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    }
                }, 100);
            });
        });
    </script>
@endpush
