<div>
    <style>
        .velocitytab .v_active {
            border-bottom: 3px solid var(--light-blue);
        }
        .veloTabs:hover {
            background: #dcdcdc73;
        }
        .velocitytab .v_active strong {
            color: var(--light-blue);
        }
        .gap-10 {
            gap: 20px;
        }
        .input_unit {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #2845F5;
            font-weight: 600;
        }
        .input:disabled {
            background-color: #c5c6caff !important;
            cursor: not-allowed;
            opacity: 0.7;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                @php $myLang = app()->getLocale(); @endphp

                @if ($myLang == 'id')
                    {{-- Indonesian Mode --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2 relative">
                            <label for="id_rp" class="font-s-14 text-blue">Harga Awal (rupiah):</label>
                            <input type="number" step="any" wire:model.live="id_rp" id="id_rp" class="input" placeholder="00">
                            <span class="input_unit text-blue">Rp</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="id_p" class="font-s-14 text-blue">Diskon (%):</label>
                            <input type="number" step="any" wire:model.live="id_p" id="id_p" class="input" placeholder="00">
                            <span class="input_unit text-blue">%</span>
                        </div>
                    </div>
                @elseif($myLang == 'tr')
                    {{-- Turkish Mode --}}
                    <div class="grid grid-cols-1 gap-4">
                        <div class="space-y-2">
                            <label for="typet" class="font-s-14 text-blue">İşlem Türü:</label>
                            <select wire:model.live="typet" id="typet" class="input">
                                <option value="1">Normal fiyat ve indirim oranı girerek indirim hesaplama</option>
                                <option value="2">Normal fiyat ve indirimli fiyat girerek indirim hesaplama</option>
                                <option value="3">Normal fiyat ve indirim miktarı girerek indirim hesaplama</option>
                                <option value="4">İndirimli fiyat ve indirim oranı girerek indirim hesaplama</option>
                                <option value="5">İndirimli fiyat ve indirim miktarı girerek indirim hesaplama</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2 relative">
                                <label for="tx" class="font-s-14 text-blue">{{ in_array($typet, [1, 2, 3]) ? 'Normal Fiyat' : 'İndirimli Fiyat' }}:</label>
                                <input type="number" step="any" wire:model.live="tx" id="tx" class="input" placeholder="00">
                                <span class="input_unit text-blue">{{ $currancy }}</span>
                            </div>
                            <div class="space-y-2 relative">
                                <label for="ty" class="font-s-14 text-blue">{{ in_array($typet, [1, 4]) ? 'İndirim Oranı (%)' : 'İndirim Miktarı' }}:</label>
                                <input type="number" step="any" wire:model.live="ty" id="ty" class="input" placeholder="00">
                                <span class="input_unit text-blue">{{ in_array($typet, [1, 4]) ? '%' : $currancy }}</span>
                            </div>
                        </div>
                    </div>
                @elseif($myLang == 'ar')
                    {{-- Arabic Mode --}}
                    <div class="grid grid-cols-1 gap-4 text-end">
                        <div class="flex flex-col space-y-2">
                            <label class="flex items-center justify-end space-x-2 space-x-reverse cursor-pointer">
                                <span>كم سيصبح السعر بعد الخصم</span>
                                <input type="radio" wire:model.live="form_a" value="first1" class="w-4 h-4 text-blue-600">
                            </label>
                            <label class="flex items-center justify-end space-x-2 space-x-reverse cursor-pointer">
                                <span>كم كان السعر قبل الخصم</span>
                                <input type="radio" wire:model.live="form_a" value="sec" class="w-4 h-4 text-blue-600">
                            </label>
                            <label class="flex items-center justify-end space-x-2 space-x-reverse cursor-pointer">
                                <span>معرفة نسبة الخصم</span>
                                <input type="radio" wire:model.live="form_a" value="thir" class="w-4 h-4 text-blue-600">
                            </label>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            @if ($form_a == 'first1')
                                <div class="space-y-2"><label class="font-s-14 text-blue">ادخل سعر السلعة الأصلي</label><input type="number" step="any" wire:model.live="first1" class="input text-end"></div>
                                <div class="space-y-2"><label class="font-s-14 text-blue">أدخل نسبة الخصم (%)</label><input type="number" step="any" wire:model.live="thir" class="input text-end"></div>
                            @elseif($form_a == 'sec')
                                <div class="space-y-2"><label class="font-s-14 text-blue">أدخل سعر السلعة بعد الخصم</label><input type="number" step="any" wire:model.live="sec" class="input text-end"></div>
                                <div class="space-y-2"><label class="font-s-14 text-blue">أدخل نسبة الخصم (%)</label><input type="number" step="any" wire:model.live="thir" class="input text-end"></div>
                            @else
                                <div class="space-y-2"><label class="font-s-14 text-blue">ادخل سعر السلعة الأصلي</label><input type="number" step="any" wire:model.live="first1" class="input text-end"></div>
                                <div class="space-y-2"><label class="font-s-14 text-blue">أدخل سعر السلعة بعد الخصم</label><input type="number" step="any" wire:model.live="sec" class="input text-end"></div>
                            @endif
                        </div>
                    </div>
                @else
                    {{-- Default Mode --}}
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label for="type_select" class="font-s-14 text-blue">{{ $lang['10'] ?? 'Calculation Type' }}</label>
                            <select wire:model.live="type_select" id="type_select" class="input">
                                <option value="1">% {{ $lang['14'] ?? 'Discount' }}</option>
                                <option value="2">% {{ $lang['11'] }} 2 {{ $lang['12'] }}</option>
                                <option value="3">% {{ $lang['11'] }} 3 {{ $lang['12'] }}</option>
                                <option value="4">{{ $lang['13'] }}</option>
                                <option value="5">2 {{ $lang['15'] }} 1</option>
                                <option value="6">3 {{ $lang['15'] }} 2</option>
                                <option value="7">4 {{ $lang['15'] }} 3</option>
                                <option value="8">{{ $lang['16'] }}</option>
                                <option value="9">{{ $lang['17'] }}</option>
                                <option value="10">{{ $lang['18'] }}</option>
                            </select>
                        </div>

                        <p class="px-2 text-gray-500 italic mb-4">Input two values to find the unknown values</p>

                        <div class="grid grid-cols-2 gap-4">
                            {{-- Row 1 --}}
                            @if (in_array($type_select, [1, 4, 8, 9]))
                                <div class="space-y-2 relative">
                                    <label class="font-s-14 text-blue">{{ $lang['original'] ?? 'Original Price' }}</label>
                                    <input type="number" step="any" wire:model.live="amount" class="input" @disabled($this->isInputDisabled('amount'))>
                                    <span class="input_unit text-blue">{{ $currancy }}</span>
                                </div>
                            @endif

                            @if (in_array((string)$type_select, ['1', '2', '3', '4', '8', '9']))
                                <div class="space-y-2 relative">
                                    <label class="font-s-14 text-blue">{{ in_array((string)$type_select, ['8', '9']) ? '1st ' : '' }}{{ $lang['20'] ?? 'Discount' }} {{ (string)$type_select === '4' ? "($currancy)" : '(%)' }}</label>
                                    <input type="number" step="any" wire:model.live="off" class="input" @disabled($this->isInputDisabled('off'))>
                                    <span class="input_unit text-blue">{{ (string)$type_select === '4' ? $currancy : '%' }}</span>
                                </div>
                            @endif

                            {{-- Row 2 (Pay/Saving) for Type 1 & 4 --}}
                            @if (in_array($type_select, [1, 4]))
                                <div class="space-y-2 relative">
                                    <label class="font-s-14 text-blue">You Pay</label>
                                    <input type="number" step="any" wire:model.live="pay" class="input" @disabled($this->isInputDisabled('pay'))>
                                    <span class="input_unit text-blue">{{ $currancy }}</span>
                                </div>
                                <div class="space-y-2 relative">
                                    <label class="font-s-14 text-blue">You're saving</label>
                                    <input type="number" step="any" wire:model.live="saving" class="input" @disabled($this->isInputDisabled('saving'))>
                                    <span class="input_unit text-blue">{{ $currancy }}</span>
                                </div>
                            @endif

                            {{-- Row 3+ (Extra fields) --}}
                            @if (in_array($type_select, [2, 3, 5, 6, 7]))
                                <div class="space-y-2 relative"><label class="font-s-14 text-blue">product 1</label><input type="number" step="any" wire:model.live="p1" class="input"><span class="input_unit text-blue">{{ $currancy }}</span></div>
                                <div class="space-y-2 relative"><label class="font-s-14 text-blue">product 2</label><input type="number" step="any" wire:model.live="p2" class="input"><span class="input_unit text-blue">{{ $currancy }}</span></div>
                                @if (in_array($type_select, [3, 6, 7]))
                                    <div class="space-y-2 relative"><label class="font-s-14 text-blue">product 3</label><input type="number" step="any" wire:model.live="p3" class="input"><span class="input_unit text-blue">{{ $currancy }}</span></div>
                                @endif
                                @if ($type_select == '7')
                                    <div class="space-y-2 relative"><label class="font-s-14 text-blue">product 4</label><input type="number" step="any" wire:model.live="p4" class="input"><span class="input_unit text-blue">{{ $currancy }}</span></div>
                                @endif
                            @endif

                            @if ($type_select == '8' || $type_select == '9')
                                <div class="space-y-2 relative"><label class="font-s-14 text-blue">2nd Discount (%)</label><input type="number" step="any" wire:model.live="off2" class="input"><span class="input_unit text-blue">%</span></div>
                            @endif
                            @if ($type_select == '9')
                                <div class="space-y-2 relative"><label class="font-s-14 text-blue">3rd Discount (%)</label><input type="number" step="any" wire:model.live="off3" class="input"><span class="input_unit text-blue">%</span></div>
                            @endif

                            @if ($type_select == '10')
                                <div class="space-y-2"><label class="font-s-14 text-blue">Quantity</label><input type="number" step="any" wire:model.live="nbr" class="input"></div>
                                <div class="space-y-2 relative"><label class="font-s-14 text-blue">Unit Price</label><input type="number" step="any" wire:model.live="up" class="input"><span class="input_unit text-blue">{{ $currancy }}</span></div>
                                <div class="space-y-2 relative"><label class="font-s-14 text-blue">Fixed Price</label><input type="number" step="any" wire:model.live="fix" class="input"><span class="input_unit text-blue">{{ $currancy }}</span></div>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-gray-100">
                            <div class="flex items-center space-x-6">
                                <span class="font-s-14 text-blue">Tax:</span>
                                <label class="flex items-center space-x-2 cursor-pointer"><input type="radio" wire:model.live="tax" value="yes" class="w-4 h-4 text-blue-600"> <span class="text-sm font-medium text-gray-700">No Tax</span></label>
                                <label class="flex items-center space-x-2 cursor-pointer"><input type="radio" wire:model.live="tax" value="no" class="w-4 h-4 text-blue-600"> <span class="text-sm font-medium text-gray-700">Add Sales Tax</span></label>
                            </div>
                            @if ($tax == 'no')
                                <div class="mt-4 lg:w-1/2 relative"><label class="font-s-14 text-blue">Sales Tax Rate (%)</label><input type="number" step="any" wire:model.live="sale" class="input"><span class="input_unit text-blue">%</span></div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            @if ($type == 'calculator') @include('inc.button') @endif
            @if ($type == 'widget') @include('inc.widget-button') @endif
        </div>

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                 <div class="">
                @if(isset($detail['arabic']))
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                    @else
                        @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                        @endif
                    @endif
                    
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full p-3 radius-10 mt-3">
                            @if (isset($detail['nor']))
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                    <table class="w-full">
                                        <tr>
                                            <td class="py-2 border-b">Normal Fiyat</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['nor'] }} TL</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">İndirimli Fiyat</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['ind'] }} TL</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">İndirim Miktarı</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['mik'] }} TL</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">İndirim Oranı (%)</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['ora'] }}%</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif(isset($detail['arabic']))
                                @if (isset($detail['third']))
                                    <div class=" mt-2 ms-auto  text-end">
                                        <p class="mt-2 text-end"><strong>المدخلات</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $thir }} %</td>
                                                <td class="py-2 border-b" width="70%">:نسبة الخصم</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $first1 }} </td>
                                                <td class="py-2 border-b" width="70%">: السعر قبل الخصم</td>
                                            </tr>
                                        </table>
                                        <p class="mt-2 text-end"><strong>النتيجة</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['dis'] }}</td>
                                                <td class="py-2 border-b" width="70%">:السعر بعد الخصم يصبح</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['third'] }} </td>
                                                <td class="py-2 border-b" width="70%"> :قيمة الخصم</td>
                                            </tr>
                                        </table>
                                    </div>
                                @elseif(isset($detail['first']))
                                    <div class="col-lg-8 mt-2 ms-auto  text-end">
                                        <p class="mt-2 text-end"><strong>المدخلات</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $thir }} %</td>
                                                <td class="py-2 border-b" width="70%">:نسبة الخصم</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $sec }} </td>
                                                <td class="py-2 border-b" width="70%"> :السعر بعد الخصم</td>
                                            </tr>
                                        </table>
                                        <p class="mt-2 text-end"><strong>النتيجة</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['dis'] }} %</td>
                                                <td class="py-2 border-b" width="70%">:اقيمة الخصم</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['first'] }} </td>
                                                <td class="py-2 border-b" width="70%">:السعر قبل الخصم كان</td>
                                            </tr>
                                        </table>
                                    </div>
                                @elseif(isset($detail['thirl']))
                                    <div class="col-lg-8 mt-2 ms-auto text-end">
                                        <p class="mt-2 text-end"><strong>المدخلات</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $first1 }} </td>
                                                <td class="py-2 border-b" width="70%">:السعر قبل الخصم</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $sec }} </td>
                                                <td class="py-2 border-b" width="70%"> :السعر بعد الخصم</td>
                                            </tr>
                                        </table>
                                        <p class="mt-2 text-end"><strong>النتيجة</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['dis'] }} </td>
                                                <td class="py-2 border-b" width="70%">:اقيمة الخصم</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['thirl'] }} % </td>
                                                <td class="py-2 border-b" width="70%">:نسبة الخصم على سعر السلعة</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            @elseif(isset($detail['discount_id']))
                                <p class="mt-2 font-s-18"><strong>Diskon Anda</strong></p>
                                <div class="col-lg-8 mt-2">
                                    <table class="w-full">
                                        <tr>
                                            <td class="py-2 border-b">Harga Sebelum Diskon</td>
                                            <td class="py-2 border-b"><strong>{{ number_format($id_rp, 2) }} Rp</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">Besar Diskon</td>
                                            <td class="py-2 border-b"><strong>{{ number_format($detail['discount_id'], 2) }} Rp  ({{ $id_p }} %)</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">Harga Setelah Diskon</td>
                                            <td class="py-2 border-b"><strong>{{ number_format($id_rp - $detail['discount_id'], 2) }} Rp</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @else
                                <div class="mt-2">
                                    {{-- @if ($_POST['type'] == 1)
                                        <div class="col-lg-8 mt-2">
                                            <table class="w-100 font-s-18">
                                                <tr>
                                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['original'] }}
                                                        </strong></td>
                                                    <td class="py-2 border-b"> {{ $_POST['cur'] . ' ' . $detail['amount'] }}</td>
                                                </tr> 
                                                <tr>
                                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['20'] }}
                                                        </strong>
                                                    </td>
                                                    <td class="py-2 border-b">{{ $detail['off'] }} %</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif --}}
                                    <div class="col-lg-8 mt-2">
                                        <table class="w-full">
                                            <p class="mt-2"><strong>{{ $lang['28'] }}</strong></p>
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['discount'] }}
                                                    </strong>
                                                </td>
                                                <td class="py-2 border-b"> {{ isset($currancy) ? $currancy : '' }}
                                                    {{ $detail['pay'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['save'] }} </strong>
                                                </td>
                                                <td class="py-2 border-b">{{ isset($currancy) ? $currancy : '' }}
                                                    {{ $detail['Ans'] }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    @if (isset($detail['ave']))
                                        <div class="col-lg-8">
                                            <table class="w-full">
                                                <tr>
                                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['29'] }}
                                                        </strong>
                                                    </td>
                                                    <td class="py-2 border-b">{{ $currancy . ' ' . $detail['ave'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 " width="70%"><strong>{{ $detail['per'] }} %
                                                        {{ $lang['30'] }} {{ $detail['stand'] }} </strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif
                                    @if (isset($detail['effect']))
                                        <div class="col-lg-8">
                                            <table class="w-full">
                                                <tr>
                                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['31'] }}
                                                        {{ $detail['effect'] }}%, {{ $lang['32'] }}
                                                        {{ $detail['sum'] }} </strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            
                            @endif
                    </div>
                </div>
            </div>
            </div>
        @endisset
    </form>
</div>
