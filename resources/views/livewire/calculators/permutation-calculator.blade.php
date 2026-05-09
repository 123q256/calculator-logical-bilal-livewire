<div>
<style>
    [x-cloak] { display: none !important; }
</style>

<form wire:submit.prevent="calculate" x-data="{ 
    name: @entangle('name'),
    get nLabel() {
        if (this.name == '0') return '{{ $lang['6'] ?? 'Types to choose from' }}';
        if (this.name == '1') return '{{ $lang['6_1'] ?? 'How many different numbers are possible' }}';
        if (this.name == '2') return '{{ $lang['6_2'] ?? 'How many different balls can be selected' }}';
        return '{{ $lang['6_3'] ?? 'How many different Objects are there' }}';
    },
    get rLabel() {
        if (this.name == '0') return '{{ $lang['7'] ?? 'Number Chosen' }}';
        if (this.name == '1') return '{{ $lang['7_1'] ?? 'How many numbers are used' }}';
        if (this.name == '2') return '{{ $lang['7_2'] ?? 'How many balls do you select' }}';
        return '{{ $lang['7_3'] ?? 'How many Objects will you choose' }}';
    }
}">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[45%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 gap-4 mt-3">
                <div class="px-2">
                    <label for="name" class="label">{{ $lang['1'] ?? 'Scenario' }}:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="name" id="name" class="input cursor-pointer">
                            <option value="0">{{ $lang['2'] ?? 'Standard Permutation' }}</option>
                            <option value="1">{{ $lang['3'] ?? 'Pick a number' }}</option>
                            <option value="2">{{ $lang['4'] ?? 'Lottery' }}</option>
                            <option value="3">{{ $lang['5'] ?? 'Pick objects' }}</option>
                        </select>
                    </div>
                </div>

                <div class="px-2">
                    <label class="label" x-text="nLabel + '?'"></label>
                    <div class="w-full py-2 relative">
                        <input type="number" wire:model.live="n" id="n" class="input" placeholder="00" />
                        <span class="input_unit n_icon">(n)</span>
                    </div>
                </div>

                <div class="px-2">
                    <label class="label" x-text="rLabel + '?'"></label>
                    <div class="w-full py-2 relative">
                        <input type="number" wire:model.live="r" id="r" class="input" placeholder="00" />
                        <span class="input_unit n_icon">(r)</span>
                    </div>
                </div>

                <div class="px-2">
                    <label for="find" class="label">{{ $lang['12'] ?? 'Calculation Type' }}:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="find" id="find" class="input cursor-pointer">
                            <option value="2">{{ $lang['8'] ?? 'Permutations' }}</option>
                            <option value="3">{{ $lang['9'] ?? 'Permutations with repetition' }}</option>
                        </select>
                    </div>
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full">
                    @php
                        $perm = $detail['perm'];
                        $s1 = $detail['s1'];
                        $s2 = $detail['s2'];
                        $nr = $detail['nr'];
                        $n = $detail['n'];
                        $r = $detail['r'];
                        $find = $detail['find'];
                        $n_fact = $detail['n_fact'];
                        $r_fact = $detail['r_fact'];
                        $nr_fact = $detail['nr_fact'];
                    @endphp 

                    @if (isset($detail['perms']))
                        <div class="text-center mt-4">
                            <p class="text-[22px]"><strong>{{ $lang['8'] ?? 'Permutations P(n, r)' }}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[30px] bg-[#2845F5] px-4 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $perm }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 space-y-4">
                            <p class="font-s-20"><b class="text-blue">{{ $lang['11'] ?? 'Step by Step Solution' }}:</b></p>
                            <p class="p-3 bg-gray-50 rounded italic">P(n, r) = n! / (n - r)!</p>
                            
                            <div class="space-y-2">
                                <p><strong>{{ $lang['12'] ?? 'Calculate' }} n!</strong></p>
                                <p>{{ $n }}! = {{ $s1 }}</p>
                                <p>{{ $n }}! = {{ $n_fact }}</p>
                            </div>

                            <div class="space-y-2 border-t pt-4">
                                <p><strong>{{ $lang['12'] ?? 'Calculate' }} (n - r)!</strong></p>
                                <p>(n - r)! = ({{ $n }} - {{ $r }})! = {{ $nr }}!</p>
                                <p>{{ $nr }}! = {{ $s2 }}</p>
                                <p>{{ $nr }}! = {{ $nr_fact }}</p>
                            </div>

                            <div class="space-y-2 border-t pt-4">
                                <p><strong>{{ $lang['13'] ?? 'Final Calculation' }}</strong></p>
                                <p>P(n, r) = n! / (n - r)!</p>
                                <p>P({{ $n }}, {{ $r }}) = {{ $n_fact }} / {{ $nr_fact }}</p>
                                <p class="text-xl"><strong>P({{ $n }}, {{ $r }}) = {{ $perm }}</strong></p>
                            </div>
                        </div>

                    @elseif(isset($detail['p_w_r']))
                        @php
                            $perm_rep = $detail['perm_rep'];
                        @endphp
                        <div class="text-center">
                            <p class="text-[22px]"><strong>{{ $lang['9'] ?? 'Permutations with repetition' }}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[30px] bg-[#2845F5] px-4 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $perm_rep }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 space-y-4">
                            <p class="font-s-20"><b class="text-blue">{{ $lang['10'] ?? 'Step by Step Solution' }}:</b></p>
                            <p class="font-semibold">{{ $lang['14'] ?? 'Permutation with Repetition Formula' }}:</p>
                            <p class="p-3 bg-gray-50 rounded italic">P(n, r) = n<sup>r</sup></p>
                            
                            <div class="space-y-2">
                                <p><strong>{{ $lang['12'] ?? 'Calculate' }} n<sup>r</sup></strong></p>
                                <p>{{ $n }}<sup>{{ $r }}</sup> = {{ $perm_rep }}</p>
                            </div>

                            <div class="space-y-2 border-t pt-4">
                                <p><strong>{{ $lang['13'] ?? 'Final Result' }}</strong></p>
                                <p>P({{ $n }}, {{ $r }}) = {{ $n }}<sup>{{ $r }}</sup></p>
                                <p class="text-xl"><strong>P({{ $n }}, {{ $r }}) = {{ $perm_rep }}</strong></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
