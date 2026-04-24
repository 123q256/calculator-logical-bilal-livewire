<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover:bg-[#2845F5] hover:text-white {{ $calc == 'one' ? 'tagsUnit' : '' }}" wire:click="setCalc('one')">
                                {{ $lang['1'] ?? 'Simple' }}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover:bg-[#2845F5] hover:text-white {{ $calc == 'two' ? 'tagsUnit' : '' }}" wire:click="setCalc('two')">
                                {{ $lang['2'] ?? 'Advance' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 mt-4  gap-2">
                @if($calc == 'one')
                <div class="col-span-12 simple ">
                    <label for="appli" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Application' }}:</label>
                    <div class="w-full py-2"> 
                        <select wire:model.live="appli" id="appli" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full">
                            <option value="a">{{$lang[4] ?? 'Residential'}}</option>
                            <option value="b">{{$lang[5] ?? 'Commercial'}}</option>
                            <option value="c">{{$lang[6] ?? 'ADA'}}</option>
                            <option value="d">{{$lang[7] ?? 'Public'}}</option>
                            <option value="e">{{$lang[8] ?? 'International'}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 simple">
                    <div class="w-full">
                        <div class="w-full mt-0 mt-lg-2">
                            <label for="r_type" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Ramp Type' }}:</label>
                            <div class="w-full py-2"> 
                                <select wire:model.live="r_type" id="r_type" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full">
                                    <option value="st">{{$lang[10] ?? 'Straight'}}</option>
                                    <option value="dl">{{$lang[11] ?? 'Dog-Leg'}}</option>
                                    <option value="sb">{{$lang[12] ?? 'Switch-Back'}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full mt-0 mt-lg-2">
                            <label for="no" class="font-s-14 text-blue">{{ $lang['13'] ?? 'Rise' }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="no" id="no" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                                <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit')">{{ $unit }} ▾</label>
                                @if($showDropdown === 'unit')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit', '{{ $name }}')"> {{ $name }}</p>
                                   @endforeach
                                </div>
                                @endif
                            </div>
                         </div>
                    </div>
                </div>
                @else
                <div class="col-span-12 md:col-span-6 lg:col-span-6 advance">
                    <div class="w-full">
                        <div class="w-full mt-0 mt-lg-2">
                            <label for="no1" class="font-s-14 text-blue">{{ $lang['13'] ?? 'Rise' }} (a):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="no1" id="no1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                                <label for="unit0" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit0')">{{ $unit0 }} ▾</label>
                                @if($showDropdown === 'unit0')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit0', '{{ $name }}')"> {{ $name }}</p>
                                   @endforeach
                                </div>
                                @endif
                            </div>
                         </div>
                         <div class="w-full mt-0 mt-lg-2">
                            <label for="no2" class="font-s-14 text-blue">{{ $lang['15'] ?? 'Run' }} (b):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="no2" id="no2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                                <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit1')">{{ $unit1 }} ▾</label>
                                @if($showDropdown === 'unit1')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit1', '{{ $name }}')"> {{ $name }}</p>
                                   @endforeach
                                </div>
                                @endif
                            </div>
                         </div>
                         <div class="w-full mt-0 mt-lg-2">
                            <label for="width" class="font-s-14 text-blue">{{ $lang['16'] ?? 'Width' }} (w):</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                                <label for="unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit2')">{{ $unit2 }} ▾</label>
                                @if($showDropdown === 'unit2')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (["cm","m","in","ft","yd"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit2', '{{ $name }}')"> {{ $name }}</p>
                                   @endforeach
                                </div>
                                @endif
                            </div>
                         </div>
                    </div>
                </div>
                @endif
                <div class="col-span-12 md:col-span-6 lg:col-span-6 flex items-center justify-center">
                    <img src="{{ $calc == 'one' ? asset('images/rampsimple.webp') : asset('images/advanceramp.webp') }}" alt="Ramp Picture" class="max-width" width="{{ $calc == 'one' ? '300px' : '250px' }}" height="{{ $calc == 'one' ? '80px' : '200px' }}">
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

    <hr>
            
    @isset($detail)
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="row py-2">
                        @if ($calc == 'one')
                            <div class="d-full">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto font-s-18  pe-lg-4">
                                  <div>
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2 flex items-center">
                                                <img src="{{asset('images/deg.webp')}}" alt="image of degree" width="30px" height="30px" class="max-width pe-2">
                                                {{$lang[18] ?? 'Slope Angle'}} :</td>
                                            <td class="border-b py-2">
                                                {{ $detail['deg'] ?? 0}}°
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 flex items-center">
                                                <img src="{{asset('images/percent.webp')}}" alt="image of grade" width="30px" height="30px" class="max-width pe-2">
                                                {{$lang[19] ?? 'Slope Grade'}} :
                                            </td>
                                            <td class="border-b py-2">
                                                {{ $detail['grade'] ?? 0}}%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 flex items-center">
                                                <img src="{{asset('images/lenght.webp')}}" alt="mode" width="30px" height="30px" class="max-width pe-2">
                                                {{$lang[20] ?? 'Ramp Length'}} :
                                            </td>
                                            <td class="border-b py-2">
                                                {{ ($detail['ramplenght'] ?? 0) . ($detail['unit'] ?? '')}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class=" py-2 flex items-center">
                                                <img src="{{asset('images/lenght.webp')}}" alt="image of grade" width="30px" height="30px" class="max-width pe-2">
                                                {{$lang[21] ?? 'Run'}} :
                                            </td>
                                            <td class=" py-2">{{ ($detail['runs'] ?? 0) . ($detail['unit'] ?? '')}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full flex items-center justify-center">
                                    @if($appli == 'a')
                                        <img src="{{asset('images/ramp1.webp')}}" alt="image of lenght"
                                        width="250px" height="100px">
                                    @elseif($appli == 'b')
                                        <img src="{{asset('images/ramp2.webp')}}" alt="image of lenght2"
                                        width="250px" height="100px">
                                    @elseif($appli == 'c')
                                        <img src="{{asset('images/ramp3.webp')}}" alt="image of lenght3"
                                        width="250px" height="100px">
                                    @elseif($appli == 'd')
                                        <img src="{{asset('images/ramp4.webp')}}" alt="image of lenght4"
                                        width="250px" height="100px">
                                    @else
                                        <img src="{{asset('images/ramp5.webp')}}" alt="image of lenght5"
                                        width="250px" height="100px">
                                    @endif
                                </div>
                            </div>
                        </div>
                            <div class="w-fill md:w-[70%] lg:w-[70%] my-3">
                                @if($r_type == 'st')
                                    <img src="{{asset('images/ramp11.png')}}" alt="image of lenght" class="max-width"
                                    width="450px" height="60px" >
                                @elseif($r_type == 'sb')
                                    <img src="{{asset('images/ramp180.png')}}" alt="image of lenght" class="max-width"
                                    width="450px" height="100px" >
                                @endif
                                @if($r_type == 'dl')
                                    <img src="{{asset('images/ramp90.png')}}" alt="image of lenght" class="max-width"
                                    width="300px" height="430px" >
                                @endif
                            </div>
                            <div class="w-full">
                                <div class="w-fill md:w-[70%] lg:w-[70%] font-s-18">
                                    <table class="w-full">
                                        <tr>
                                            <td colspan="2"><strong>{{$lang[22] ?? 'Equivalent angles'}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[23] ?? 'Radian'}} :</td>
                                            <td class="border-b py-2">{{ $detail['rad'] ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[24] ?? 'Milliradian'}} :</td>
                                            <td class="border-b py-2">{{ $detail['millirad'] ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[25] ?? 'Microradian'}} :</td>
                                            <td class="border-b py-2">{{ $detail['microrad'] ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[26] ?? 'π-Radian'}} :</td>
                                            <td class="border-b py-2">{{ $detail['pirad'] ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[27] ?? 'Gradian'}} :</td>
                                            <td class="border-b py-2">{{ $detail['gradian'] ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[28] ?? 'Turns'}} :</td>
                                            <td class="border-b py-2">{{ $detail['turns'] ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang[29] ?? 'Minute of arc'}} :</td>
                                            <td class="border-b py-2">{{ $detail['minarc'] ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">{{$lang[30] ?? 'Second of arc'}} :</td>
                                            <td class="py-2">{{ $detail['secarc'] ?? 0}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="w-full md:w-[90%] lg:w-[90%] text-[16px] overflow-auto ">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2 flex items-center">
                                            <img src="{{asset('images/hypotenuse.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[31] ?? 'Hypotenuse'}} (c)
                                        </td>
                                        <td class="border-b py-2">
                                            {{ $detail['Hypotenuse'] ?? 0}} <span class="font-s-14">cm</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 flex items-center">
                                            <img src="{{asset('images/alpha2.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[32] ?? 'Alpha'}}
                                        </td>
                                        <td class="border-b py-2">
                                            {{ $detail['alpha'] ?? 0}}<sup>o</sup>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 flex items-center">
                                            <img src="{{asset('images/beta.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[33] ?? 'Beta'}}
                                        </td>
                                        <td class="border-b py-2">
                                            {{ $detail['beta'] ?? 0}}<sup>o</sup>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 flex items-center">
                                            <img src="{{asset('images/area1.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[34] ?? 'Surface Area'}}
                                        </td>
                                        <td class="border-b py-2">
                                            {{ $detail['area'] ?? 0}} <span class="font-s-14">cm</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 flex items-center">
                                            <img src="{{asset('images/volume.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[35] ?? 'Volume'}}
                                        </td>
                                        <td class="border-b py-2">{{ $detail['volume'] ?? 0}} <span class="font-s-14">cm</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 flex items-center">
                                            <img src="{{asset('images/ratio2.webp')}}" alt="image of grade" class="max-width pe-2" width="30px" height="30px">
                                            {{$lang[36] ?? 'Surface-to-volume ratio'}}
                                        </td>
                                        <td class="border-b py-2">
                                            {{ $detail['sv'] ?? 0}} <span class="font-s-14">cm</span>
                                        </td>
                                    </tr>
                                </table>
                                <div class="text-[16px] overflow-auto mt-4">
                                    <p class="my-2 text-center"><strong><?=$lang[37] ?? 'Calculation'?></strong></p>
                                    <p class=""><strong><?=$lang[31] ?? 'Hypotenuse'?>:</strong></p>
                                    <p class="mt-2 ">$$ <?=$lang[31] ?? 'Hypotenuse'?> (c) = \sqrt{a^2 + b^2} $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[31] ?? 'Hypotenuse'?> (c) = \sqrt{(<?=$detail['no1'] ?? 0?>)^2 + (<?=$detail['no2'] ?? 0?>)^2} $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[31] ?? 'Hypotenuse'?> (c) = \sqrt{<?=pow($detail['no1'] ?? 0, 2)?> + <?=pow($detail['no2'] ?? 0, 2)?>} $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[31] ?? 'Hypotenuse'?> (c) = \sqrt{<?=$detail['Hypotenuse1'] ?? 0?>} $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[31] ?? 'Hypotenuse'?> (c) = {<?=$detail['Hypotenuse'] ?? 0?>} $$</p>
                                    <p class="mt-2"><strong><?=$lang[32] ?? 'Alpha'?>:</strong></p>
                                    <p class="mt-2 ">$$ <?=$lang[38] ?? 'Angle'?> \alpha = \cos \theta^{-1} \left( \frac{b^2 + c^2 - a^2}{2bc} \right) $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[38] ?? 'Angle'?> \alpha = \cos \theta^{-1} \left( \frac{(<?=$detail['no2'] ?? 0?>)^2 + (<?=$detail['Hypotenuse'] ?? 0?>)^2 - (<?=$detail['no1'] ?? 0?>)^2}{2(<?=$detail['no2'] ?? 0?>)(<?=$detail['Hypotenuse'] ?? 0?>)} \right) $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[38] ?? 'Angle'?> \alpha = \cos \theta^{-1} \left( \frac{<?=(pow($detail['no2'] ?? 0, 2) + pow($detail['Hypotenuse'] ?? 0, 2)) - ($detail['no1'] ?? 0)?>}{<?=2*($detail['no2'] ?? 0)*($detail['Hypotenuse'] ?? 0)?>} \right) $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[38] ?? 'Angle'?> \alpha = \cos \theta^{-1} (<?=$detail['alpha2'] ?? 0?>) $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[38] ?? 'Angle'?> \alpha = (<?=$detail['alpha'] ?? 0?>) $$</p>
                                    <p class="mt-2"><strong><?=$lang[33] ?? 'Beta'?>:</strong></p>
                                    <p class="mt-2 ">$$ <?=$lang[18] ?? 'Slope Angle'?> \beta = 90^\circ - \alpha $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[18] ?? 'Slope Angle'?> \beta = (<?=90 - ($detail['alpha'] ?? 0)?>) $$</p>
                                    <p class="mt-2"><strong><?=$lang[34] ?? 'Surface Area'?>:</strong></p>
                                    <p class="mt-2 ">$$ <?=$lang[39] ?? 'Surface Area'?> (A) = a \times b + w \times (a + b + c) $$</p>
                                    <p class="mt-2">$$ <?=$lang[39] ?? 'Surface Area'?> (A) = <?=$detail['no1'] ?? 0?> \times <?=$detail['no2'] ?? 0?>+ <?=$detail['width'] ?? 0?> \times (<?=$detail['no1'] ?? 0?> + <?=$detail['no2'] ?? 0?> + <?=$detail['Hypotenuse'] ?? 0?>) $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[39] ?? 'Surface Area'?> (A) = <?=$detail['area'] ?? 0?> $$</p>
                                    <p class="mt-2"><strong><?=$lang[35] ?? 'Volume'?>:</strong></p>
                                    <p class="mt-2 ">$$ <?=$lang[35] ?? 'Volume'?> (V) = (a \times b \times w) \div 2 $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[35] ?? 'Volume'?> (V) = (<?=$detail['no1'] ?? 0?> \times <?=$detail['no2'] ?? 0?> \times <?=$detail['width'] ?? 0?>) \div 2 $$</p>
                                    <p class="mt-2 ">$$ <?=$lang[35] ?? 'Volume'?> (V) = <?=$detail['volume'] ?? 0?> $$</p>
                                    <p class="mt-2"><strong><?=$lang[36] ?? 'Surface-to-volume ratio'?>:</strong></p>
                                    <p class="mt-2"><strong>$$ <?=$lang[40] ?? 'Ratio'?> (A/V) = <?=$detail['area'] ?? 0?> \div <?=$detail['volume'] ?? 0?> $$</strong></p>
                                    <p class="mt-2 "><strong>$$ <?=$lang[40] ?? 'Ratio'?> (A/V) = <?=$detail['sv'] ?? 0?> $$</strong></p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>

@script
<script>
    $wire.on('math-updated', () => {
        setTimeout(() => {
            if (window.MathJax) {
                if (window.MathJax.typesetPromise) {
                    const el = document.getElementById('result-section');
                    MathJax.typesetClear();
                    MathJax.typesetPromise(el ? [el] : []).then(() => {
                    }).catch(err => console.error('MathJax v3 error:', err));
                } else if (window.MathJax.Hub) {
                    window.MathJax.Hub.Queue(["Typeset", window.MathJax.Hub, "result-section"]);
                }
            }
        }, 200); 
    });
</script>
@endscript
</div>
