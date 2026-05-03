<div>
    <style>
        .close_fifo {
            cursor: pointer;
            background: #13699E;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            transition: background 0.2s;
        }
        .close_fifo:hover {
            background: #0d4e75;
        }
        .purchases_dropdown {
            position: absolute;
            z-index: 50;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-top: 0.25rem;
        }
        .purchases_dropdown li {
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: background 0.1s;
        }
        .purchases_dropdown li:hover {
            background: #f7fafc;
        }
        .overflow_scroll {
            max-height: 500px;
            overflow-y: auto;
            padding-right: 0.5rem;
        }
    </style>

    <form wire:submit.prevent="calculate('FIFO')">
        <div id="input-form" class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <p class="col-span-12 font-bold   tracking-wide text-sm">{{ $lang['nbr_of'] ?? 'Inventory Purchases' }}</p>
                    
                    <div class="col-span-12 {{ count($purchases) > 6 ? 'overflow_scroll' : '' }}">
                        <ul class="space-y-4">
                            @foreach ($purchases as $index => $purchase)
                                <li class="grid grid-cols-12 gap-4 items-end  p-3 rounded-lg  relative group">
                                    <div class="col-span-5">
                                        <p class="font-semibold text-xs mb-1">{{ $lang['1'] ?? 'Units' }}</p>
                                        <input type="number" step="any" wire:model.live="purchases.{{ $index }}.units" class="input" placeholder="0" />
                                    </div>
                                    <div class="col-span-5">
                                        <p class="font-semibold text-xs mb-1">{{ $lang['2'] ?? 'Price per Unit' }} ({{ $currancy }})</p>
                                        <input type="number" step="any" wire:model.live="purchases.{{ $index }}.price" class="input" placeholder="0" />
                                    </div>
                                    <div class="col-span-2 flex justify-left mb-3">
                                        @if (count($purchases) > 1)
                                            <span wire:click="removeRow({{ $index }})" class="close_fifo" title="Remove row">✕</span>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Add More Actions -->
                    <div class="col-span-12 grid grid-cols-12 gap-4 mt-2">
                        <button type="button" wire:click="addRow" class="col-span-6 bg-white border  font-bold py-2 rounded-lg hover:bg-blue-50 transition">
                            + {{ $lang['1by1'] ?? 'Add 1 Row' }}
                        </button>
                        
                        <div class="col-span-6 relative" x-data="{ open: false }">
                            <button type="button" @click="open = !open" class="w-full bg-white border  font-bold py-2 rounded-lg hover:bg-blue-50 transition">
                                ▾ {{ $lang['add_more'] ?? 'Add Multiple' }}
                            </button>
                            <ul x-show="open" @click.away="open = false" class="purchases_dropdown" x-cloak>
                                <li wire:click="addMultipleRows(5); open = false">5 {{ $lang['purch'] ?? 'Purchases' }}</li>
                                <li wire:click="addMultipleRows(10); open = false">10 {{ $lang['purch'] ?? 'Purchases' }}</li>
                                <li wire:click="addMultipleRows(20); open = false">20 {{ $lang['purch'] ?? 'Purchases' }}</li>
                                <li wire:click="addMultipleRows(50); open = false">50 {{ $lang['purch'] ?? 'Purchases' }}</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Units Sold -->
                    <div class="col-span-12 pt-4 border-t border-gray-100">
                        <label for="unit_sold" class="font-bold  tracking-wide text-sm">{{ $lang['unit_sold'] ?? 'Total Units Sold' }}</label>
                        <div class="py-2">
                            <input type="number" step="any" wire:model.live="unit_sold" id="unit_sold" class="input" placeholder="0" />
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-span-12 grid grid-cols-12 gap-4 pt-4">
                        <div class="col-span-6">
                            <button type="button" wire:click="calculate('FIFO')" class="w-full py-4 font-bold text-white bg-blue-600 rounded-full hover:bg-blue-700 transition shadow-lg">
                                {{ $lang['FIFO'] ?? 'FIFO Method' }}
                            </button>
                        </div>
                        <div class="col-span-6">
                            <button type="button" wire:click="calculate('LIFO')" class="w-full py-4 font-bold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 transition shadow-lg">
                                {{ $lang['LIFO'] ?? 'LIFO Method' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    
                    <div class="rounded-lg space-y-8 mt-5">
                        <!-- Summary Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100 flex flex-col items-center text-center space-y-3">
                                <p class="text-blue-800 font-bold text-sm uppercase tracking-wider">{{ $lang['cogp'] ?? 'Cost of Goods Purchased' }}</p>
                                <img src="{{ asset('images/purch.webp') }}" alt="Purchased" class="w-16 h-16 object-contain opacity-80" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3500/3500833.png'">
                                <p class="text-2xl font-black text-blue-900">{{ $currancy }}{{ $detail['cogp'] + 0 }}</p>
                            </div>
                            
                            <div class="bg-orange-50 p-6 rounded-2xl border border-orange-100 flex flex-col items-center text-center space-y-3">
                                <p class="text-orange-800 font-bold text-sm uppercase tracking-wider">{{ $lang['cogs'] ?? 'Cost of Goods Sold' }} ({{ $detail['method'] }})</p>
                                <img src="{{ asset('images/sold.webp') }}" alt="Sold" class="w-16 h-16 object-contain opacity-80" onerror="this.src='https://cdn-icons-png.flaticon.com/512/1573/1573145.png'">
                                <p class="text-2xl font-black text-orange-900">{{ $currancy }}{{ $detail['cogs'] + 0 }}</p>
                            </div>
                            
                            <div class="bg-green-50 p-6 rounded-2xl border border-green-100 flex flex-col items-center text-center space-y-3">
                                <p class="text-green-800 font-bold text-sm uppercase tracking-wider">{{ $lang['ending'] ?? 'Ending Inventory Value' }}</p>
                                <img src="{{ asset('images/inventory.webp') }}" alt="Inventory" class="w-16 h-16 object-contain opacity-80" onerror="this.src='https://cdn-icons-png.flaticon.com/512/2897/2897785.png'">
                                <p class="text-2xl font-black text-green-900">{{ $currancy }}{{ $detail['ending'] + 0 }}</p>
                            </div>
                        </div>

                        <!-- Valuation Table -->
                        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                            <div class="p-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                                <h3 class="font-bold text-gray-800">{{ $detail['method'] }} Valuation Table</h3>
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase">{{ $detail['method'] }} Mode</span>
                            </div>
                            <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
                                <table class="w-full text-left text-sm relative border-collapse">
                                    <thead class="sticky top-0 z-10 bg-gray-50">
                                        <tr class="bg-gray-50 text-gray-600 font-bold border-b border-gray-200">
                                            <th class="px-4 py-3">{{ $lang['sr_no'] ?? 'Sr.' }}</th>
                                            <th class="px-4 py-3">{{ $lang['u_p'] ?? 'Purchased' }}</th>
                                            <th class="px-4 py-3">{{ $lang['ppu'] ?? 'Price' }}</th>
                                            <th class="px-4 py-3">{{ $lang['cogp'] ?? 'COGP' }}</th>
                                            <th class="px-4 py-3 text-orange-600">{{ $lang['us'] ?? 'Units Sold' }}</th>
                                            <th class="px-4 py-3 text-green-600">{{ $lang['ur'] ?? 'Remaining' }}</th>
                                            <th class="px-4 py-3 font-bold">{{ $lang['cogs'] ?? 'COGS' }}</th>
                                            <th class="px-4 py-3 font-bold">{{ $lang['iv'] ?? 'Value' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach ($detail['rows'] as $row)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-4 py-3 text-gray-500 font-medium">{{ $row['sr'] }}</td>
                                                <td class="px-4 py-3 font-semibold">{{ $row['units'] + 0 }}</td>
                                                <td class="px-4 py-3">{{ $currancy }}{{ $row['price'] + 0 }}</td>
                                                <td class="px-4 py-3">{{ $currancy }}{{ $row['cogp'] + 0 }}</td>
                                                <td class="px-4 py-3 text-orange-600 font-bold bg-orange-50/30">{{ $row['sold'] + 0 }}</td>
                                                <td class="px-4 py-3 text-green-600 font-bold bg-green-50/30">{{ $row['remaining'] + 0 }}</td>
                                                <td class="px-4 py-3 font-black text-orange-700">{{ $currancy }}{{ $row['cogs'] + 0 }}</td>
                                                <td class="px-4 py-3 font-black text-green-700">{{ $currancy }}{{ $row['iv'] + 0 }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-gray-900 text-white font-bold">
                                        <tr>
                                            <td class="px-4 py-4 uppercase tracking-wider">{{ $lang['total'] ?? 'Total' }}</td>
                                            <td class="px-4 py-4">{{ $detail['total_units'] + 0 }}</td>
                                            <td class="px-4 py-4">---</td>
                                            <td class="px-4 py-4">{{ $currancy }}{{ $detail['cogp'] + 0 }}</td>
                                            <td class="px-4 py-4 text-orange-400">{{ $detail['total_sold'] + 0 }}</td>
                                            <td class="px-4 py-4 text-green-400">{{ ($detail['total_units'] - $detail['total_sold']) + 0 }}</td>
                                            <td class="px-4 py-4 text-orange-400">{{ $currancy }}{{ $detail['cogs'] + 0 }}</td>
                                            <td class="px-4 py-4 text-green-400">{{ $currancy }}{{ $detail['ending'] + 0 }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-span-12 text-center mt-0">
                            <button type="button" wire:click="resetForm" class="px-10 py-3 font-bold text-white bg-blue-600 rounded-full hover:bg-blue-700 transition shadow-lg uppercase tracking-wider">
                                {{ $lang['reset'] ?? 'Reset' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
