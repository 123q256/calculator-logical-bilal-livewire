<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <div class="grid grid-cols-12 mt-3 gap-3 ">
                    <div class="col-span-4">
                        <label for="A" class="label">A:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="A" id="A" class="input"
                                value="{{ isset($_POST['A']) ? $_POST['A'] : '2' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="B" class="label">B:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="B" id="B" class="input"
                                value="{{ isset($_POST['B']) ? $_POST['B'] : '-6' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="C" class="label">C:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="C" id="C" class="input"
                                value="{{ isset($_POST['C']) ? $_POST['C'] : '-13' }}" aria-label="input" />
                        </div>
                    </div>
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full text-[16px]">
                            <p class="mt-2 text-[18px]"><strong>{{$detail['roots']}}</strong></p>
                            <p class="mt-2"><strong><?= $lang['sol'] ?>:</strong></p>
                            <p class="mt-2">
                                \( Standard \ Form: <?= $_POST['A'] ?>x^2 <?= $detail['B'] < 0 ? $detail['B'] : ' + ' . $detail['B'] ?>x
                                <?= $detail['C'] < 0 ? $detail['C'] : ' + ' . $detail['C'] ?> = 0 \)
                            </p>
                            <p class="mt-2">
                                \( a = <?= $_POST['A'] ?>, \ b = <?= $detail['B'] ?>, \ c = <?= $detail['C'] ?> \)
                            </p>
                            <?php if ($_POST['A'] != 1) { ?>
                            <p class="mt-2">
                                \( a \ne 1 \ \text{<?= $lang['divide'] ?>} \ <?= $_POST['A'] ?> \)
            
                            </p>
                            <p class="mt-2">
                                \( { x^2}<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?> x}{ <?= $_POST['A'] ?> } =
                                <?= $detail['C'] < 0 ? ' ' : ' - ' ?> \frac{
                                <?= $detail['C'] < 0 ? $detail['C'] * -1 : $detail['C'] ?>}{ <?= $_POST['A'] ?> } \)
                            </p>
                            <p class="mt-2">
                                <?= $lang['half'] ?> \( x \) <?= $lang['add_s'] ?>
                            </p>
                            <p class="mt-2">
                                \( { x^2}<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?> x}{ <?= $_POST['A'] ?> } + \frac{
                                <?= pow($detail['B'], 2) ?> }{ <?= pow($_POST['A'] * 2, 2) ?> } = <?= $detail['C'] < 0 ? ' ' : ' - ' ?>
                                \frac{ <?= $detail['C'] < 0 ? $detail['C'] * -1 : $detail['C'] ?>}{ <?= $_POST['A'] ?> } + \frac{
                                <?= pow($detail['B'], 2) ?> }{ <?= pow($_POST['A'] * 2, 2) ?> } \)
            
                            </p>
                            <p class="mt-2">
                                \( ({ x }<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?>}{ <?= $_POST['A'] * 2 ?> })^2 =
                                <?= $detail['C'] < 0 ? ' ' : ' - ' ?> \frac{
                                <?= $detail['C'] < 0 ? $detail['C'] * -1 : $detail['C'] ?>}{ <?= $_POST['A'] ?> } + \frac{
                                <?= pow($detail['B'], 2) ?> }{ <?= pow($_POST['A'] * 2, 2) ?> } \)
            
                            </p>
                            <p class="mt-2">
                                <?php
                                $right_side = pow($_POST['A'] * 2, 2) / $_POST['A'];
                                $right_side = $detail['C'] * -1 * $right_side + pow($detail['B'], 2);
                                ?>
                                \( ({ x }<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?>}{ <?= $_POST['A'] * 2 ?> })^2 =
                                <?= $detail['C'] < 0 ? ' ' : ' - ' ?> \frac{ <?= $right_side ?> }{ <?= pow($_POST['A'] * 2, 2) ?> } \)
                            </p>
                            <p class="mt-2">
                                <?php if ($right_side < 0) {
                                    $right_side = $right_side * -1;
                                    $i = '\, i';
                                } ?>
                                <?php if ($right_side != 0) { ?>
                                \( { x }<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?>}{ <?= $_POST['A'] * 2 ?> } = \pm \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> \frac{ <?= $right_side ?> }{ <?= pow($_POST['A'] * 2, 2) ?> }}
                                <?= @$i ?> \) </p>
                            <p class="mt-2">
                                \( { x } = <?= $detail['B'] < 0 ? ' + ' : ' - ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?>}{ <?= $_POST['A'] * 2 ?> } \pm \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> \frac{ <?= $right_side ?> }{ <?= pow($_POST['A'] * 2, 2) ?> }}
                                <?= @$i ?> \)
                            </p>
                            <p class="mt-2"> \( { x₁ } = <?= $detail['B'] < 0 ? ' + ' : ' - ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?>}{ <?= $_POST['A'] * 2 ?> } + \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> \frac{ <?= $right_side ?> }{ <?= pow($_POST['A'] * 2, 2) ?> }}
                                <?= @$i ?> , { x₁ = <?= $detail['x1'] ?> } <?= @$i ?> \)</p>
                            <p class="mt-2">\( { x₂ } = <?= $detail['B'] < 0 ? ' + ' : ' - ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?>}{ <?= $_POST['A'] * 2 ?> } - \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> \frac{ <?= $right_side ?> }{ <?= pow($_POST['A'] * 2, 2) ?> }}
                                <?= @$i ?> , { x₂ = <?= $detail['x2'] ?> } <?= @$i ?> \)</p>
                            <?php } ?>
                            <p class="mt-2">
                                <?php if ($right_side == 0) { ?>
                                \( { x }<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?>}{ <?= $_POST['A'] * 2 ?> } = \pm \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> { <?= $right_side ?> }} \)
            
                            </p>
                            <p class="mt-2">
                                \( { x } = <?= $detail['B'] < 0 ? ' + ' : ' - ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?>}{ <?= $_POST['A'] * 2 ?> } , { x =
                                <?= $detail['x1'] ?> }\)
                                <?php } ?>
                            </p>
                            <p class="mt-2">
                                <?php }
                            if ($_POST['A'] == 1) { ?>
                                \( { x^2}<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> {
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?> x} =
                                <?= $detail['C'] < 0 ? ' ' : ' - ' ?> {
                                <?= $detail['C'] < 0 ? $detail['C'] * -1 : $detail['C'] ?>}\)
                            </p>
                            <p class="mt-2">
                                <?= $lang['half'] ?> \( x \) <?= $lang['add_s'] ?>
                                <?php if (is_int(($detail['B'] / 2))) { ?>
                                \( { x^2}<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> {
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?> x} + { <?= pow($detail['B'] / 2, 2) ?> }
                                = <?= $detail['C'] < 0 ? ' ' : ' - ' ?> {
                                <?= $detail['C'] < 0 ? $detail['C'] * -1 : $detail['C'] ?>} + { <?= pow($detail['B'] / 2, 2) ?> } \)
            
                            </p>
                            <p class="mt-2">
                                \(({ x }<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> {
                                <?= $detail['B'] < 0 ? ($detail['B'] * -1) / 2 : $detail['B'] / 2 ?> })^2 =
                                <?= $detail['C'] < 0 ? ' ' : ' - ' ?> { <?= $detail['C'] < 0 ? $detail['C'] * -1 : $detail['C'] ?> }
                                + { <?= pow($detail['B'] / 2, 2) ?> } \)
                            </p>
                            <p class="mt-2">
                                <?php
                                $right_side = $detail['C'] * -1 + pow($detail['B'] / 2, 2);
                                if ($right_side < 0) {
                                    $right_side = $right_side * -1;
                                    $i = '\, i';
                                }
                                ?>
                            </p>
                            <p class="mt-2">
                                <?php if ($right_side != 0) { ?>
                                \( { x }<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> {
                                <?= $detail['B'] < 0 ? ($detail['B'] * -1) / 2 : $detail['B'] / 2 ?>} = \pm \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> { <?= $right_side ?> }} <?= @$i ?> \)
                            </p>
                            <p class="mt-2">
                                \( { x } = <?= $detail['B'] < 0 ? ' ' : ' - ' ?> {
                                <?= $detail['B'] < 0 ? ($detail['B'] * -1) / 2 : $detail['B'] / 2 ?>} \pm \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> { <?= $right_side ?> }} <?= @$i ?> \)
                            </p>
                            <p class="mt-2">
            
                                \( { x₁ } = <?= $detail['B'] < 0 ? ' ' : ' - ' ?> {
                                <?= $detail['B'] < 0 ? ($detail['B'] * -1) / 2 : $detail['B'] / 2 ?>} + \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> { <?= $right_side ?> }} <?= @$i ?> , { x₁ =
                                <?= $detail['x1'] ?> } <?= @$i ?> \)
                            </p>
                            <p class="mt-2">
            
                                \( { x₂ } = <?= $detail['B'] < 0 ? ' ' : ' - ' ?> {
                                <?= $detail['B'] < 0 ? ($detail['B'] * -1) / 2 : $detail['B'] / 2 ?>} - \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> { <?= $right_side ?> }} <?= @$i ?> , { x₂ =
                                <?= $detail['x2'] ?> } <?= @$i ?>\)
                            </p>
                            <p class="mt-2">
                                <?php }
                                    if ($right_side == 0) { ?>
                                \( { x }<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> {
                                <?= $detail['B'] < 0 ? ($detail['B'] * -1) / 2 : $detail['B'] / 2 ?>} = \pm \sqrt{ {
                                <?= $right_side ?> }} \)
                            </p>
                            <p class="mt-2">
            
                                \( { x } = <?= $detail['B'] < 0 ? ' + ' : ' - ' ?> {
                                <?= $detail['B'] < 0 ? ($detail['B'] * -1) / 2 : $detail['B'] / 2 ?>}\)
                                <?php } ?>
                            </p>
                            <p class="mt-2">
                                <?php } else { ?>
                                \( { x^2}<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> {
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?> x} + \frac{ <?= pow($detail['B'], 2) ?>
                                }{4} = <?= $detail['C'] < 0 ? ' ' : ' - ' ?> {
                                <?= $detail['C'] < 0 ? $detail['C'] * -1 : $detail['C'] ?>} + \frac{ <?= pow($detail['B'], 2) ?>
                                }{4} \)
                            </p>
                            <p class="mt-2">
                                \(({ x }<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?> }{2})^2 =
                                <?= $detail['C'] < 0 ? ' ' : ' - ' ?> { <?= $detail['C'] < 0 ? $detail['C'] * -1 : $detail['C'] ?> }
                                + \frac{ <?= pow($detail['B'], 2) ?> }{4} \)
                                <?php
                                $right_side = $detail['C'] * -1 * 4 + pow($detail['B'], 2);
                                if ($right_side < 0) {
                                    $right_side = $right_side * -1;
                                    $i = '\, i';
                                }
                                ?>
                            </p>
                            <p class="mt-2">
                                <?php if ($right_side != 0) { ?>
                                \( { x }<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?> }{2} = \pm \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> \frac{ <?= $right_side ?> }{4}} <?= @$i ?> \)
                            </p>
                            <p class="mt-2">\( { x } =<?= $detail['B'] < 0 ? ' ' : ' - ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?> }{2} \pm \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> \frac{ <?= $right_side ?> }{4}} <?= @$i ?> \)</p>
                            <p class="mt-2">\( {x₁} =<?= $detail['B'] < 0 ? ' ' : ' - ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?> }{2} + \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> \frac{ <?= $right_side ?> }{4}} <?= @$i ?>, { x₁ =
                                <?= $detail['x1'] ?> } <?= @$i ?> \)</p>
                            <p class="mt-2">\( {x₂} =<?= $detail['B'] < 0 ? ' ' : ' - ' ?> \frac{
                                <?= $detail['B'] < 0 ? $detail['B'] * -1 : $detail['B'] ?> }{2} - \sqrt{
                                <?= $right_side < 0 ? ' - ' : ' ' ?> \frac{ <?= $right_side ?> }{4}} <?= @$i ?>, { x₂ =
                                <?= $detail['x2'] ?> } <?= @$i ?> \)</p>
                            <p class="mt-2">
                                <?php }
                                    if ($right_side == 0) { ?>
                                \( { x }<?= $detail['B'] < 0 ? ' - ' : ' + ' ?> {
                                <?= $detail['B'] < 0 ? ($detail['B'] * -1) / 2 : $detail['B'] / 2 ?>} = \pm \sqrt{ {
                                <?= $right_side ?> }} \)
                            </p>
                            <p class="mt-2">
                                \( { x } = <?= $detail['B'] < 0 ? ' + ' : ' - ' ?> {
                                <?= $detail['B'] < 0 ? ($detail['B'] * -1) / 2 : $detail['B'] / 2 ?>}\)
                                <?php } ?>
                                <?php } ?>
                                <?php }
                                    ?>
                            </p>
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
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    @endpush
</form>
