<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="h" class="font-s-14 text-blue">{{ $lang['horizontal'] }}</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="h" id="h" class="input" aria-label="input" placeholder="1920" value="{{ isset($_POST['h'])?$_POST['h']:'1920' }}" />
                    <span class="text-blue input_unit">pixels</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="v" class="font-s-14 text-blue">{{ $lang['vertical'] }}</label>
                <div class="w-100 py-2 relative">
                    <input type="number"  step="any" name="v" id="v" class="input" aria-label="input" placeholder="1080" value="{{ isset($_POST['v'])?$_POST['v']:'1080' }}" />
                    <span class="text-blue input_unit">pixels</span>
                </div>
            </div>
            <div class="col-span-12 ">
                <label for="d" class="font-s-14 text-blue">{{ $lang['screen_size'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="d" id="d" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['d']) ? $_POST['d'] : '"21.5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'cm' }} ▾</label>
                    <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'cm' }}" id="unit" class="hidden">
                    <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'in')">in</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'cm')">cm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'ft')">ft</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'm')">m</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'yd')">yd</p>
                    </div>
                 </div>
            </div>
            <p class="col-span-12">Optional</p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-2">
                <label for="com" class="font-s-14 text-blue">{{ $lang['comp'] }}:</label>
                <select id="com" name="myName" class="input my-2">
                    <option selected value="empty">Select a device...</option>
                    <option value="1920x1080x21.5" {{ isset($_POST['myName']) && $_POST['myName'] === "1920x1080x21.5" ? 'selected' : '' }}>Apple iMac 21"</option>
                    <option value="2560x1440x27" {{ isset($_POST['myName']) && $_POST['myName'] === "2560x1440x27" ? 'selected' : '' }}>Apple iMac 27"</option>
                    <option value="5120x2880x27" {{ isset($_POST['myName']) && $_POST['myName'] === "5120x2880x27" ? 'selected' : '' }}>Apple iMac 27" (Retina 5K)</option>
                    <option value="1366x768x11.6" {{ isset($_POST['myName']) && $_POST['myName'] === "1366x768x11.6" ? 'selected' : '' }}>Apple MacBook Air 11"</option>
                    <option value="1440x900x13.3" {{ isset($_POST['myName']) && $_POST['myName'] === "1440x900x13.3" ? 'selected' : '' }}>Apple MacBook Air 13"</option>
                    <option value="1280x800x13.3" {{ isset($_POST['myName']) && $_POST['myName'] === "1280x800x13.3" ? 'selected' : '' }}>Apple MacBook Pro 13"</option>
                    <option value="1440x900x15.4" {{ isset($_POST['myName']) && $_POST['myName'] === "1440x900x15.4" ? 'selected' : '' }}>Apple MacBook Pro 15"</option>
                    <option value="2560x1600x13.3" {{ isset($_POST['myName']) && $_POST['myName'] === "2560x1600x13.3" ? 'selected' : '' }}>Apple MacBook Pro Retina 13"</option>
                    <option value="2880x1800x15.4" {{ isset($_POST['myName']) && $_POST['myName'] === "2880x1800x15.4" ? 'selected' : '' }}>Apple MacBook Pro Retina 15"</option>
                    <option value="3840x2160x28" {{ isset($_POST['myName']) && $_POST['myName'] === "3840x2160x28" ? 'selected' : '' }}>Dell P2815Q 4K Monitor</option>
                    <option value="2560x1700x12.58" {{ isset($_POST['myName']) && $_POST['myName'] === "2560x1700x12.58" ? 'selected' : '' }}>Google Chromebook Pixel</option>
                </select>
            </div> 
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="mbl" class="font-s-14 text-blue">{{ $lang['phone'] }}:</label>
                <select id="mbl" name="myName2" class="input mt-4">
                    <option selected value="empty">Select a device...</option>
                    <option value="640x960x3.5" {{ isset($_POST['myName2']) && $_POST['myName2'] === "640x960x3.5" ? 'selected' : '' }}>Apple iPhone 4/S</option>
                    <option value="640x1136x4" {{ isset($_POST['myName2']) && $_POST['myName2'] === "640x1136x4" ? 'selected' : '' }}>Apple iPhone 5/S</option>				
                    <option value="1334x750x4.7" {{ isset($_POST['myName2']) && $_POST['myName2'] === "1334x750x4.7" ? 'selected' : '' }}>Apple iPhone 6 </option>				
                    <option value="1920x1080x5.5" {{ isset($_POST['myName2']) && $_POST['myName2'] === "1920x1080x5.5" ? 'selected' : '' }}>Apple iPhone 6 Plus</option>				
                    <option value="1280x768x4.7" {{ isset($_POST['myName2']) && $_POST['myName2'] === "1280x768x4.7" ? 'selected' : '' }}>Google Nexus 4 </option>
                    <option value="1920x1080x4.95" {{ isset($_POST['myName2']) && $_POST['myName2'] === "1920x1080x4.95" ? 'selected' : '' }}>Google Nexus 5 </option>
                    <option value="1440x2560x6" {{ isset($_POST['myName2']) && $_POST['myName2'] === "1440x2560x6" ? 'selected' : '' }}>Google Nexus 6 </option>
                    <option value="1080x1920x4.7" {{ isset($_POST['myName2']) && $_POST['myName2'] === "1080x1920x4.7" ? 'selected' : '' }}>HTC One</option>
                    <option value="768x1280x4.5" {{ isset($_POST['myName2']) && $_POST['myName2'] === "768x1280x4.5" ? 'selected' : '' }}>Nokia Lumia 920</option>
                    <option value="720x1280x5.55" {{ isset($_POST['myName2']) && $_POST['myName2'] === "720x1280x5.55" ? 'selected' : '' }}>Samsung Galaxy Note II</option>
                    <option value="720x1280x4.8" {{ isset($_POST['myName2']) && $_POST['myName2'] === "720x1280x4.8" ? 'selected' : '' }}>Samsung Galaxy S3</option>
                    <option value="1080x1920x5" {{ isset($_POST['myName2']) && $_POST['myName2'] === "1080x1920x5" ? 'selected' : '' }}>Samsung Galaxy S4</option>				
                    <option value="1920x1080x5.1" {{ isset($_POST['myName2']) && $_POST['myName2'] === "1920x1080x5.1" ? 'selected' : '' }}>Samsung Galaxy S5</option>
                </select>
            </div> 
            <div class="col-span-12 ">
                <label for="tab" class="font-s-14 text-blue">{{ $lang['tab'] }}:</label>
                <select id="tab" name="myName3" class="input my-2">
                    <option selected value="empty">Select a device...</option>
                    <option value="800x1280x7" {{ isset($_POST['myName3']) && $_POST['myName3'] === "800x1280x7" ? 'selected' : '' }}>Amazon Kindle Fire HD</option>
                    <option value="768x1024x7.9" {{ isset($_POST['myName3']) && $_POST['myName3'] === "768x1024x7.9" ? 'selected' : '' }}>Apple iPad mini 1</option>
                    <option value="1536x2048x7.9" {{ isset($_POST['myName3']) && $_POST['myName3'] === "1536x2048x7.9" ? 'selected' : '' }}>Apple iPad mini 2,3</option>
                    <option value="1536x2048x9.7" {{ isset($_POST['myName3']) && $_POST['myName3'] === "1536x2048x9.7" ? 'selected' : '' }}>Apple iPad Air 1,2</option>
                    <option value="1136x640x4" {{ isset($_POST['myName3']) && $_POST['myName3'] === "1136x640x4" ? 'selected' : '' }}>Apple iPod Touch (Retina)</option>
                    <option value="1920x1200x7.02" {{ isset($_POST['myName3']) && $_POST['myName3'] === "1920x1200x7.02" ? 'selected' : '' }}>Google Nexus 7 (2013)</option>
                    <option value="2048x1536x8.9" {{ isset($_POST['myName3']) && $_POST['myName3'] === "2048x1536x8.9" ? 'selected' : '' }}>Google Nexus 9 </option>
                    <option value="2560x1600x10.055" {{ isset($_POST['myName3']) && $_POST['myName3'] === "2560x1600x10.055" ? 'selected' : '' }}>Google Nexus 10 </option>
                    <option value="768x1366x10.6" {{ isset($_POST['myName3']) && $_POST['myName3'] === "768x1366x10.6" ? 'selected' : '' }}>Microsoft Surface RT</option>
                    <option value="1920x1080x10.6" {{ isset($_POST['myName3']) && $_POST['myName3'] === "1920x1080x10.6" ? 'selected' : '' }}>Microsoft Surface Pro 1,2</option>				
                    <option value="2160x1440x12" {{ isset($_POST['myName3']) && $_POST['myName3'] === "2160x1440x12" ? 'selected' : '' }}>Microsoft Surface Pro 3</option>				
                    <option value="800x1280x10.1" {{ isset($_POST['myName3']) && $_POST['myName3'] === "800x1280x10.1" ? 'selected' : '' }}>Samsung Galaxy Note 10.1</option>
                </select>
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
                            <p class="text-[20px] col-span-12"><strong>{{$lang['5']}}</strong></p>
                            <p class="col-span-12">{{$lang['6']}}</p>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="text-center my-3">
                                    <p class="font-s-21">diagonal = <span class="overline">width²+height²</span></p>
                                </div>
                                <p class="padding_0">{{$lang['7']}}</p>
                                <div class="text-center mt-3">
                                    <p class="font-s-21">PPI = <span class="fraction"><span class="num">digonal in pixels</span> <span class="visually-hidden">/</span> <span class="den">digonal in inches</span></span></p>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-3 text-center">
                                <img src="{{asset('images/ppi_dia1.webp')}}" alt="Screen Diagram" class="max-width" width="330px" height="200px">
                            </div>
                        </div>
                        <div class="w-full ps-3">
                            <p>{{$lang['8']}}</p>
                            <p class="mt-3">{{$lang['9']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS') 
    <script>
       function handleInputChange() {
            var value = this.value;
            if (value !== 'empty') {
                var unit = document.getElementById('unit').value;
                value = value.split('x');
                document.getElementById('h').value = value[0];
                document.getElementById('v').value = value[1];
                if (unit === 'cm') {
                    value[2] = (value[2] * 2.54).toFixed(5);
                } else if (unit === 'm') {
                    value[2] = (value[2] / 39.37).toFixed(5);
                } else if (unit === 'ft') {
                    value[2] = (value[2] / 12).toFixed(5);
                } else if (unit === 'yd') {
                    value[2] = (value[2] / 36).toFixed(5);
                }
                document.getElementById('d').value = value[2];
            }
        }
        document.getElementById('com').addEventListener('change', handleInputChange);
        document.getElementById('tab').addEventListener('change', handleInputChange);
        
        document.getElementById('mbl').addEventListener('change', handleInputChange);
        
    </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>