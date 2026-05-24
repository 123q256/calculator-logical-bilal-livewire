<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[100%] w-full">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="setDimen('two')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab {{ $dimen === 'two' ? 'tagsUnit' : '' }}">
                            for (x , y)
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div wire:click="setDimen('three')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab {{ $dimen === 'three' ? 'tagsUnit' : '' }}">
                            for (x , y , z)
                        </div>
                    </div>
                </div>
            </div>


            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 mt-4">

                <div class="col-span-12">
                    <label for="EnterEq" class="font-s-14 text-blue" id="functionText">
                        @if ($dimen === 'three')
                            {{ $lang['1'] }} f(x, y, z):
                        @else
                            {{ $lang['1'] }} f(x, y):
                        @endif
                    </label>
                    <div class="w-100 py-2">
                        <input type="text" wire:model.live="EnterEq" name="EnterEq" id="EnterEq" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="{{ $dimen === 'three' ? 'col-span-4' : 'col-span-6' }}" id="u1Value">
                    <label for="u1" class="font-s-14 text-blue">U1:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="u1" name="u1" id="u1" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="{{ $dimen === 'three' ? 'col-span-4' : 'col-span-6' }}" id="u2Value">
                    <label for="u2" class="font-s-14 text-blue">U2:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="u2" name="u2" id="u2" class="input" aria-label="input" />
                    </div>
                </div>
                @if($dimen === 'three')
                <div class="col-span-4" id="u3Value">
                    <label for="u3" class="font-s-14 text-blue">U3:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="u3" name="u3" id="u3" class="input" aria-label="input" />
                    </div>
                </div>
                @endif
                <div class="{{ $dimen === 'three' ? 'col-span-4' : 'col-span-6' }}" id="xValue">
                    <label for="x" class="font-s-14 text-blue">x {{ $lang['2'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="x" name="x" id="x" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="{{ $dimen === 'three' ? 'col-span-4' : 'col-span-6' }}" id="yValue">
                    <label for="y" class="font-s-14 text-blue">y {{ $lang['2'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="y" name="y" id="y" class="input" aria-label="input" />
                    </div>
                </div>
                @if($dimen === 'three')
                <div class="col-span-4" id="zValue">
                    <label for="z" class="font-s-14 text-blue">z {{ $lang['2'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="z" name="z" id="z" class="input" aria-label="input" />
                    </div>
                </div>
                @endif
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
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            @php
                                $EnterEq = str_replace('+', 'plus', $EnterEq);
                            @endphp
                            <div class="w-full text-[16px]">
                                @if ($dimen === 'two')
                                    <p class="mt-3 text-[18px]">
                                        \( D({{ $detail['enter'] }})_{\vec u}({{ $x . ',' . $y }})\) ≈ \(
                                        {{ $detail['ans'] }}\)
                                    </p>
                                    <p class="mt-3"><strong>{{ $lang['4'] }}</strong></p>
                                    <p class="mt-3">{{ $lang['5'] }} \({{ $detail['enter'] }}\) {{ $lang['6'] }}
                                        \((x,y)=({{ $x . ',' . $y }})\) {{ $lang['7'] }} \(\vec u
                                        =({{ $u1 . ',' . $u2 }})\)
                                    </p>
                                    <p class="mt-3">{{ $lang['8'] }}.</p>
                                    <p class="mt-3">\( ∇f = \left( \frac{\partial f}{\partial x},\frac{\partial
                                        f}{\partial
                                        y}\right)\)</p>
                                    <p class="mt-3">\(\frac{\partial f}{\partial x} = {{ $detail['difs1'] }}\)</p>
                                    <p class="mt-3">\(\frac{\partial f}{\partial y} = {{ $detail['difs2'] }}\)</p>
                                    <p class="mt-3">Put the points</p>
                                    <p class="mt-3">\(∇f({{ $x . ',' . $y }}) =
                                        ({{ $detail['x1'] . ',' . $detail['y1'] }})\)
                                    </p>
                                    <p class="mt-3">\(∇({{ $detail['enter'] }})|_{(x,y)=({{ $x . ',' . $y }})} =
                                        ({{ $detail['x1'] . ',' . $detail['y1'] }})\)</p>
                                    <p class="mt-3">{{ $lang['9'] }}:</p>
                                    <p class="mt-3">\( |\vec u| = \sqrt{({{ $u1 . ')^2 + (' . $u2 . ')^2' }})} =
                                        {{ round($detail['mag'], 5) }}\)</p>
                                    <p class="mt-3">{{ $lang['10'] }}:</p>
                                    <p class="mt-3">\( |\vec u| \text{ becomes }= \left( \frac{ {{ $u1 }} }{
                                        {{ round($detail['mag'], 5) }} },\frac{ {{ $u2 }} }{
                                        {{ round($detail['mag'], 5) }} } \right)\)</p>
                                    <p class="mt-3">{{ $lang['11'] }}:</p>
                                    <p class="mt-3">\(D({{ $detail['enter'] }})_{\vec u}({{ $x . ',' . $y }}) =
                                        \left({{ $detail['x1'] . ',' . $detail['y1'] }}\right) . \left( \frac{
                                        {{ $u1 }}
                                        }{ {{ round($detail['mag'], 5) }} },\frac{ {{ $u2 }} }{
                                        {{ round($detail['mag'], 5) }} } \right)\)</p>
                                    <p class="mt-3">\(D({{ $detail['enter'] }})_{\vec u}({{ $x . ',' . $y }}) = \left(
                                        ({{ $detail['x1'] }} \times \frac{ {{ $u1 }} }{
                                        {{ round($detail['mag'], 5) }} }) + ( {{ $detail['y1'] }} \times\frac{
                                        {{ $u2 }} }{ {{ round($detail['mag'], 5) }} }) \right)\)</p>
                                    <p class="mt-3">{{ $lang['3'] }}:</p>
                                    <p class="mt-3">\(D({{ $detail['enter'] }})_{\vec u}({{ $x . ',' . $y }}) =
                                        {{ $detail['ans'] }}\)</p>
                                @else
                                    <p class="mt-3 text-[18px]">
                                        \( D({{ $detail['enter'] }})_{\vec u}({{ $x . ',' . $y . ',' . $z }}) \) ≈ \(
                                        {{ $detail['ans'] }} \)
                                    </p>
                                    <p class="mt-3"><strong>{{ $lang['4'] }}</strong></p>
                                    <p class="mt-3">{{ $lang['5'] }} \({{ $detail['enter'] }}\) {{ $lang['6'] }}
                                        \((x,y,z)=({{ $x . ',' . $y . ',' . $z }})\) {{ $lang['7'] }} \(\vec u
                                        =({{ $u1 . ',' . $u2 . ',' . $u3 }})\)</p>
                                    <p class="mt-3">{{ $lang['8'] }}.</p>
                                    <p class="mt-3">\( ∇f = \left( \frac{\partial f}{\partial x},\frac{\partial
                                        f}{\partial
                                        y},\frac{\partial f}{\partial z}\right)\)</p>
                                    <p class="mt-3">\( \frac{\partial f}{\partial x} = {{ $detail['difs1'] }}\)</p>
                                    <p class="mt-3">\( \frac{\partial f}{\partial y} = {{ $detail['difs2'] }}\)</p>
                                    <p class="mt-3">\( \frac{\partial f}{\partial z} = {{ $detail['difs3'] }}\)</p>
                                    <p class="mt-3">Put the points</p>
                                    <p class="mt-3">\( ∇f({{ $x . ',' . $y . ',' . $z }}) =
                                        ({{ $detail['x1'] . ',' . $detail['y1'] . ',' . $detail['z1'] }})\)</p>
                                    <p class="mt-3">\(
                                        ∇({{ $detail['enter'] }})|_{(x,y,z)=({{ $x . ',' . $y . ',' . $z }})} =
                                        ({{ $detail['x1'] . ',' . $detail['y1'] . ',' . $detail['z1'] }})\)</p>
                                    <p class="mt-3">{{ $lang['9'] }}:</p>
                                    <p class="mt-3">\( |\vec u| =
                                        \sqrt{({{ $u1 . ')^2 + (' . $u2 . ')^2 + (' . $u3 . ')^2' }})} =
                                        {{ round($detail['mag'], 5) }}\)</p>
                                    <p class="mt-3">{{ $lang['10'] }}:</p>
                                    <p class="mt-3">\( |\vec u| \text{ becomes }= \left( \frac{ {{ $u1 }} }{
                                        {{ round($detail['mag'], 5) }} },\frac{ {{ $u2 }} }{
                                        {{ round($detail['mag'], 5) }} },\frac{ {{ $u3 }} }{
                                        {{ round($detail['mag'], 5) }} } \right)\)</p>
                                    <p class="mt-3">{{ $lang['11'] }}:</p>
                                    <p class="mt-3">\( D({{ $detail['enter'] }})_{\vec
                                        u}({{ $x . ',' . $y . ',' . $z }}) =
                                        \left({{ $detail['x1'] . ',' . $detail['y1'] . ',' . $detail['z1'] }}\right) .
                                        \left( \frac{
                                        {{ $u1 }} }{ {{ round($detail['mag'], 5) }} },\frac{
                                        {{ $u2 }}
                                        }{ {{ round($detail['mag'], 5) }} },\frac{ {{ $u3 }} }{
                                        {{ round($detail['mag'], 5) }} } \right)\)</p>
                                    <p class="mt-3">\( D({{ $detail['enter'] }})_{\vec
                                        u}({{ $x . ',' . $y . ',' . $z }}) =
                                        \left( ({{ $detail['x1'] }} \times \frac{ {{ $u1 }} }{
                                        {{ round($detail['mag'], 5) }} }) + ( {{ $detail['y1'] }} \times\frac{
                                        {{ $u2 }} }{ {{ round($detail['mag'], 5) }} }) + (
                                        {{ $detail['z1'] }}
                                        \times\frac{ {{ $u3 }} }{ {{ round($detail['mag'], 5) }} }) \right)\)
                                    </p>
                                    <p class="mt-3">{{ $lang['3'] }}:</p>
                                    <p class="mt-3">\( D({{ $detail['enter'] }})_{\vec
                                        u}({{ $x . ',' . $y . ',' . $z }}) =
                                        {{ $detail['ans'] }}\)</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                // Initial render
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</form>

</div>
