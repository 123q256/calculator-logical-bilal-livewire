<div x-data="{
    x: @entangle('x').live,
    order: @entangle('order').live
}">
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="x" class="label">{{$lang[1] ?? 'Enter Numbers'}} (,):</label>
                <div class="w-full py-2">
                    <textarea aria-label="textarea input" id="x" name="x" placeholder="12, 23, 45" class="textareaInput" x-model="x"></textarea>
                </div>
            </div>
            <div class="col-span-12">
                <label for="order" class="label">{{$lang['2'] ?? 'Order'}}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="order" id="order" x-model="order">
                        <option value="1">{{$lang[3] ?? 'Least to Greatest'}}</option>
                        <option value="2">{{$lang[4] ?? 'Greatest to Least'}}</option>
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
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="45%"><strong>
                                        @if($order == '1')
                                            {{$lang['5'] ?? 'Least to Greatest'}}
                                        @else
                                            {{$lang['6'] ?? 'Greatest to Least'}}
                                        @endif
                                    </strong></td>
                                    <td class="py-2 border-b">
                                        @php
                                            $i=0;
                                            foreach ($detail['ans'] as $key => $value) {
                                                $i++;
                                                if ($i==count($detail['ans'])) {
                                                    echo $key;
                                                }else{
                                                    if ($detail['order']==1) {
                                                        echo $key.' < ';
                                                    }else{
                                                        echo $key.' > ';
                                                    }
                                                }
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{ $lang[7] ?? 'Steps to Sort' }}</strong></p>
                            <p class="mt-2">{{ $lang[9] ?? 'Step-by-step Solution' }}</p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-100 text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{$lang[10] ?? 'Original Number'}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$lang[11] ?? 'Decimal Value'}}</strong></td>
                                    </tr>
                                    @php
                                        $i=0;
                                        foreach ($detail['solve'] as $key => $value) {
                                            echo "<tr><td class='py-2 border-b'>".$key."</td><td class='py-2 border-b'>".$value."</td></tr>";
                                        }
                                    @endphp
                                </table>
                            </div>
                            <p class="mt-2">{{ $lang[12] ?? 'Numbers ordered from' }} {{(($order==1)?'Least to Greatest':'Greatest to Least')}}</p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-100 font-s-16">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[10] ?? 'Original Number'}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$lang[11] ?? 'Decimal Value'}}</strong></td>
                                    </tr>
                                    @php
                                        $i=0;
                                        foreach ($detail['ans'] as $key => $value) {
                                            echo "<tr><td class='py-2 border-b'>".$key."</td><td class='py-2 border-b'>".$value."</td></tr>";
                                        }
                                        @endphp
                                </table>
                            </div>
                            <p class="mt-2">{{ $lang[13] ?? 'Final Order from' }} {{(($order==1)?'Least to Greatest':'Greatest to Least')}}</p>
                            <p class="mt-2">
                                @php
                                    $i=0;
                                    foreach ($detail['ans'] as $key => $value) {
                                        $i++;
                                        if ($i==count($detail['ans'])) {
                                            echo $key;
                                        }else{
                                            if ($detail['order']==1) {
                                                echo $key.' < ';
                                            }else{
                                                echo $key.' > ';
                                            }
                                        }
                                    }
                                @endphp
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endisset
</form>
</div>
