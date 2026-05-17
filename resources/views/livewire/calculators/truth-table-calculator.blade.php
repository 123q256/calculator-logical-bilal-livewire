<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">

        <div class="col-12  mx-auto mt-2 lg:w-[50%] w-full">
            <div class="flex flex-wrap items-center bg-blue-100 border  border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/1 w-full px-2 py-1">
                    <div wire:click="loadExample" class="bg-white px-3 py-2  cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tagsUnit wed" id="load_example">
                            {{ $lang['2'] ?? 'Load Example' }}
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                
                    <div class="col-span-12">
                        <div class="w-full py-1">
                            <label for="eq" class="font-s-14 text-white" id="txt">{{ $lang[1] ?? 'Boolean Expression' }}:</label>
                            <input type="text" wire:model.live="eq" id="eq" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <table class="w-full inp_table border radius-5">
                            <tbody>
                            <tr>
                                <td colspan="2" class="border-b text-white py-2 text-center {{isset($detail) ? 'bg-light-blue' : 'tagsUnit'}}"><strong class="text-blue">{{ $lang['3'] ?? 'Operations' }}</strong></td>
                            </tr>
                            <tr>
                                <td class="border-b p-2">{{ $lang['4'] ?? 'Negation' }}</td>
                                <td class="border-b p-2">~</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2">{{ $lang['5'] ?? 'Conjunction' }}</td>
                                <td class="border-b p-2">&amp;</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2">{{ $lang['6'] ?? 'Disjunction' }}</td>
                                <td class="border-b p-2">v</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2">{{ $lang['7'] ?? 'Implication' }}</td>
                                <td class="border-b p-2">-&gt;</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2">{{ $lang['8'] ?? 'Biconditional' }}</td>
                                <td class="border-b p-2">&lt;-&gt;</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2">{{ $lang['9'] ?? 'NAND' }}</td>
                                <td class="border-b p-2">|</td>
                            </tr>
                            <tr>
                                <td class="border-b p-2">{{ $lang['10'] ?? 'Contradiction' }}</td>
                                <td class="border-b p-2">#</td>
                            </tr>
                            </tbody>
                        </table>
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
    @if(isset($detail['tableData']))
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center ">
                    <div class="w-full  my-[25px]">
                        <div class="row my-2 text-[18px]">
                            <p class="text-center font-s-20  mb-4"><strong>{{ $lang['11'] ?? 'Truth Table' }}</strong></p>
                            
                            <div class="text-[18px] text-center overflow-x-auto w-full">
                                <table class="truth">
                                    <thead>
                                        <tr>
                                            @foreach($detail['tableData']['cols'] as $colIndex => $col)
                                                @foreach($col['headers'] as $headerIndex => $char)
                                                    <th class="border-b py-2 {{ $headerIndex === count($col['headers']) - 1 && $colIndex !== count($detail['tableData']['cols']) - 1 ? 'div-col' : '' }}">
                                                        {!! $this->char_set($char) !!}
                                                    </th>
                                                @endforeach
                                                @if($colIndex !== count($detail['tableData']['cols']) - 1)
                                                    <th class="divider-space border-b py-2"></th>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($r = 0; $r < $detail['tableData']['row_count']; $r++)
                                            <tr>
                                                @foreach($detail['tableData']['cols'] as $colIndex => $col)
                                                    @foreach($col['rows'][$r] as $valIndex => $val)
                                                        @php
                                                            $isResultCell = ($col['type'] === 'formula' && $col['res_index'] === $valIndex);
                                                        @endphp
                                                        <td class="border-b py-2 {{ $isResultCell ? 'res' : '' }} {{ $valIndex === count($col['rows'][$r]) - 1 && $colIndex !== count($detail['tableData']['cols']) - 1 ? 'div-col' : '' }}">
                                                            {!! $this->char_set($val) !!}
                                                        </td>
                                                    @endforeach
                                                    @if($colIndex !== count($detail['tableData']['cols']) - 1)
                                                        <td class="divider-space border-b py-2"></td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>

<style>
    table.truth {
        border-collapse: collapse;
        margin: 20px auto;
        font-size: 18px;
        font-family: 'Outfit', 'Inter', sans-serif;
        text-align: center;
        color: #1e293b;
        border-radius: 8px;
        overflow: hidden;
        width: 100%;
        border: 1px solid #e2e8f0;
    }
 
</style>
</div>
