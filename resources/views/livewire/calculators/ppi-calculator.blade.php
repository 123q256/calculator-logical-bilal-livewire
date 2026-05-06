<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="h" class="font-s-14 text-blue">{{ $lang['horizontal'] }}</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" wire:model.live="h" id="h" class="input" aria-label="input" placeholder="1920" />
                        <span class="text-blue input_unit">pixels</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="v" class="font-s-14 text-blue">{{ $lang['vertical'] }}</label>
                    <div class="w-100 py-2 relative">
                        <input type="number"  step="any" wire:model.live="v" id="v" class="input" aria-label="input" placeholder="1080" />
                        <span class="text-blue input_unit">pixels</span>
                    </div>
                </div>
                <div class="col-span-12 ">
                    <label for="d" class="font-s-14 text-blue">{{ $lang['screen_size'] }}</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="d" id="d" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                            <span x-text="$wire.unit"></span> ▾
                        </label>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'in'); open = false">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'cm'); open = false">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'ft'); open = false">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'm'); open = false">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit', 'yd'); open = false">yd</p>
                        </div>
                    </div>
                </div>
                <p class="col-span-12 font-bold mt-4">Optional</p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="com" class="font-s-14 text-blue">{{ $lang['comp'] }}:</label>
                    <select id="com" wire:model.live="myName" class="input my-2">
                        <option value="empty">Select a device...</option>
                        <option value="1920x1080x21.5">Apple iMac 21"</option>
                        <option value="2560x1440x27">Apple iMac 27"</option>
                        <option value="5120x2880x27">Apple iMac 27" (Retina 5K)</option>
                        <option value="1366x768x11.6">Apple MacBook Air 11"</option>
                        <option value="1440x900x13.3">Apple MacBook Air 13"</option>
                        <option value="1280x800x13.3">Apple MacBook Pro 13"</option>
                        <option value="1440x900x15.4">Apple MacBook Pro 15"</option>
                        <option value="2560x1600x13.3">Apple MacBook Pro Retina 13"</option>
                        <option value="2880x1800x15.4">Apple MacBook Pro Retina 15"</option>
                        <option value="3840x2160x28">Dell P2815Q 4K Monitor</option>
                        <option value="2560x1700x12.58">Google Chromebook Pixel</option>
                    </select>
                </div> 
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="mbl" class="font-s-14 text-blue">{{ $lang['phone'] }}:</label>
                    <select id="mbl" wire:model.live="myName2" class="input my-2">
                        <option value="empty">Select a device...</option>
                        <option value="640x960x3.5">Apple iPhone 4/S</option>
                        <option value="640x1136x4">Apple iPhone 5/S</option>				
                        <option value="1334x750x4.7">Apple iPhone 6 </option>				
                        <option value="1920x1080x5.5">Apple iPhone 6 Plus</option>				
                        <option value="1280x768x4.7">Google Nexus 4 </option>
                        <option value="1920x1080x4.95">Google Nexus 5 </option>
                        <option value="1440x2560x6">Google Nexus 6 </option>
                        <option value="1080x1920x4.7">HTC One</option>
                        <option value="768x1280x4.5">Nokia Lumia 920</option>
                        <option value="720x1280x5.55">Samsung Galaxy Note II</option>
                        <option value="720x1280x4.8">Samsung Galaxy S3</option>
                        <option value="1080x1920x5">Samsung Galaxy S4</option>				
                        <option value="1920x1080x5.1">Samsung Galaxy S5</option>
                    </select>
                </div> 
                <div class="col-span-12 ">
                    <label for="tab" class="font-s-14 text-blue">{{ $lang['tab'] }}:</label>
                    <select id="tab" wire:model.live="myName3" class="input my-2">
                        <option value="empty">Select a device...</option>
                        <option value="800x1280x7">Amazon Kindle Fire HD</option>
                        <option value="768x1024x7.9">Apple iPad mini 1</option>
                        <option value="1536x2048x7.9">Apple iPad mini 2,3</option>
                        <option value="1536x2048x9.7">Apple iPad Air 1,2</option>
                        <option value="1136x640x4">Apple iPod Touch (Retina)</option>
                        <option value="1920x1200x7.02">Google Nexus 7 (2013)</option>
                        <option value="2048x1536x8.9">Google Nexus 9 </option>
                        <option value="2560x1600x10.055">Google Nexus 10 </option>
                        <option value="768x1366x10.6">Microsoft Surface RT</option>
                        <option value="1920x1080x10.6">Microsoft Surface Pro 1,2</option>				
                        <option value="2160x1440x12">Microsoft Surface Pro 3</option>				
                        <option value="800x1280x10.1">Samsung Galaxy Note 10.1</option>
                    </select>
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
<hr>
    @isset($detail)
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
       <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full my-2">
                        <div class="w-full mb-md-0 mb-3">
                            <div class="w-full bg-[#F6FAFC] p-3 rounded-lg border">
                                <div class="grid grid-cols-12 mt-3  gap-4">
                                    <div class="col-span-12 md:col-span-9 lg:col-span-9 border-lg-end pe-lg-2 border-sm-bottom pb-lg-0 pb-2">
                                        <p>{{$lang['2']}}</p>
                                    </div>
                                    <div class="col-span-12 md:col-span-3 lg:col-span-3 pt-lg-0 pt-2">
                                        <div class="ps-lg-4 col">
                                            <span class="d-lg-block">{{$lang['per_inch']}}</span>
                                            <strong class="font-s-25 text-green ps-lg-0 ps-4">{{(($detail['PPI']) ? $detail['PPI'] : '00')}}</strong>
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <div class="w-full bg-[#F6FAFC] p-3 rounded-lg border mt-3">
                                <div class="grid grid-cols-12 mt-3  gap-4">
                                    <div class="col-span-12 md:col-span-9 lg:col-span-9 border-lg-end pe-lg-2 border-sm-bottom pb-lg-0 pb-2">
                                        <p class="margin_top_10">{{$lang['3']}}</p>
                                    </div>
                                    <div class="col-span-12 md:col-span-3 lg:col-span-3 pt-lg-0 pt-2">
                                        <div class="ps-lg-4 col">
                                            <span class="d-lg-block">{{$lang['dot']}}</span>
                                            <strong class="font-s-25 text-green ps-lg-0 ps-5">{{(($detail['Pixls']) ? $detail['Pixls'] : '00')}} <span class="font-s-18">(mm)</span></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex p-2 items-center">
                            <p><strong class="text-blue pe-lg-4">{{$lang['display']}} :</strong></p>
                            <p class="border-lg-end pe-lg-3">{{$detail['screen_in']}}</p>
                            <p class="ps-lg-3">{{$detail['screen_cm']}}</p>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <p class="ps-2"><strong>{{$lang['4']}}</strong></p>
                            <div class="ms-3">
                                <div class="border-b py-2 flex justify-between items-center">
                                    <p>{{$lang['total']}} :</p>
                                    <p>{{$detail['mpx']}} MPX</p>
                                </div>
                                <div class="border-b py-2 flex justify-between items-center">
                                    <p>{{$lang['PPI']}}<sup>2</sup> :</p>
                                    <p>{{$detail['PPIS']}}</p>
                                </div>
                                <div class="border-b py-2 flex justify-between items-center">
                                    <p>{{$lang['dia']}} :</p>
                                    <p>{{$detail['dia']}} Pixels</p>
                                </div>
                                <div class="d-flex pt-2 justify-between items-center">
                                    <p>{{$lang['ar']}} :</p>
                                    <p>{{$detail['ratio']}} Pixels</p>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 mt-3  gap-4">
                            <style>
                                .overline { text-decoration: overline; }
                                .fraction { display: inline-flex; flex-direction: column; vertical-align: middle; text-align: center; padding: 0 5px; }
                                .num { border-bottom: 1px solid; padding: 0 5px; }
                                .den { padding: 0 5px; }
                                .font-s-21 { font-size: 21px; }
                            </style>
                            <p class="text-[20px] col-span-12"><strong>{{$lang['5']}}</strong></p>
                            <p class="col-span-12">{{$lang['6']}}</p>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="text-center my-3">
                                    <p class="font-s-21">diagonal = √<span class="overline">width² + height²</span></p>
                                </div>
                                <p class="padding_0">{{$lang['7']}}</p>
                                <div class="flex items-center justify-center mt-3">
                                    <p class="font-s-21 flex items-center">
                                        PPI = 
                                        <span class="fraction">
                                            <span class="num">diagonal in pixels</span>
                                            <span class="den">diagonal in inches</span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-3 text-center">
                                <img src="{{asset('images/ppi_dia1.webp')}}" alt="Screen Diagram" class="max-width" width="330px" height="200px">
                            </div>
                        </div>
                        <div class="w-full ps-3 mt-4">
                            <p>{{$lang['8']}}</p>
                            <p class="mt-3">{{$lang['9']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
