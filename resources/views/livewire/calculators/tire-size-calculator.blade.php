<div>
<style>
    .pacetabs{
        left: 16.6%;
    }
    @media (max-width: 991px){
        .pacetabs{
            left: 0;
        }
    }
    .d-center{
        display: flex;
        align-items: center;
        justify-content: center
    }
    .px-10{
        padding-left: 10px;
        padding-right: 10px
    }
    .go_plus{
        text-decoration: underline
    }
    .go_plus:hover{
        cursor: pointer
    }
    #gotosize{
        display: none
    }
    .tire_wrap{
        position: relative;
        display: inline-block;
    }
    #ww{
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        transition: all 0.5s ease;
    }
    #tt{
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        z-index: 1;
        border-radius: 93px;
        overflow: hidden;
        transition: all 0.5s ease;
    }
    #aa{
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        z-index: 2;
        border-radius: 100%;
        transition: all 0.5s ease;
    }
    #cc{
        width: 185px;
        height: 185px;
        overflow: hidden;
        position: relative;
        display: inline-block;
        transition: all 0.5s ease;
    }
    #cal_comp1 {
        display: inline-block;
        vertical-align: top;
        position: relative;
        margin-bottom: 50px;
    }
    #vis_arrow {
        position: absolute;
        left: 0px;
        bottom: 5px;
        -webkit-transform: rotate(43deg);
        transform: rotate(43deg);
    }
    #t_wheel {
        border: 1px solid #a0a0a0;
        border-bottom: none;
        position: absolute;
        right: 50px;
        top: -15px;
        height: 100px;
        width: 85px;
        text-align: center;
        z-index: 2;
        transition: all 0.5s ease;
    }
    #t_side {
        border: 1px solid #a0a0a0;
        border-left: none;
        position: absolute;
        right: 10px;
        bottom: 2px;
        height: 50px;
        width: 80px;
        text-align: right;
        z-index: 2;
        transition: all 0.5s ease;
    }
    #vis_revs {
        position: absolute;
        bottom: -20px;
        width: 100%;
        text-align: center;
    }
    #vis_side {
        padding: 2px 0px 5px 3px;
        height: 10px;
        display: inline-block;
        margin: 25px -12px 0px 0px;
        transition: all 0.5s ease;
    }
    #vis_wheel {
        padding: 0px 5px 0px 5px;
        width: 20px;
        margin: -10px auto 0px auto;
    }
    #cal_visualizer {
        float: left;
        width: 100%;
        text-align: center;
        font-size: 12px;
        position: relative;
    }
    #cal_wrap {
        position: relative;
        width: 100%;
        min-height: 421px;
        margin-top: 25px;
        overflow: hidden;
        border-radius: 10px;
        text-align: center;
        z-index: 1;
    }
    #cal_viewer {
        padding-top: 30px;
        clear: both;
        height: 225px;
    }
    #cal_comp2 {
        display: inline-block;
        vertical-align: top;
        position: relative;
        margin-bottom: 50px;
        padding: 0px 0px 0px 30px;
    }
    #tctc {
        width: 63px;
        height: 185px;
        position: relative;
        display: inline-block;
        transition: all 0.5s ease;
    }
    #tt_width {
        border: 1px solid #a0a0a0;
        border-top: none;
        position: absolute;
        bottom: -15px;
        height: 12px;
        width: 98%;
        text-align: center;
        transition: all 0.5s ease;
    }
    #tt_height {
        border: 1px solid #a0a0a0;
        border-right: none;
        position: absolute;
        left: -20px;
        top: 0px;
        height: 97%;
        width: 15px;
        text-align: center;
        transition: all 0.5s ease;
    }
    #show_tires {
        height: 20px;
        text-align: center;
        font-size: 16px;
        padding: 10px 0px 10px 0px;
        cursor: pointer;
    }
    #cc img {
        width: 100%;
        height: 100%;
        border: none
    }
    #CompVisualizer {
        width: 100%;
        text-align: center;
        font-size: 12px;
    }
    #Viewer {
        padding-top: 30px;
        clear: both;
        background-color: #dddddd57;
    }
    #ShowCompTires {
        text-align: center;
        font-size: 16px;
        padding: 10px 0px 10px 0px;
        cursor: pointer;
    }
    #comp2 {
        display: inline-block;
        vertical-align: top;
        position: relative;
        margin-bottom: 50px;
        padding: 0px 35px 0px 35px;
    }
    #tc1, #tc2 {
        width: 63px;
        height: 185px;
        position: relative;
        display: inline-block;
        transition: all 0.5s ease;
    }
    #tt_width1, #tt_width2 {
        border: 1px solid #a0a0a0;
        border-top: none;
        position: absolute;
        bottom: -15px;
        height: 12px;
        width: 98%;
        text-align: center;
        transition: all 0.5s ease;
    }
    #tt_width2 { border-color: #f1a400; }
    #tt_height1, #tt_height2 {
        border: 1px solid #a0a0a0;
        border-right: none;
        position: absolute;
        left: -20px;
        top: 0px;
        height: 97%;
        width: 15px;
        text-align: center;
        transition: all 0.5s ease;
    }
    #tt_height2 { border-color: #f1a400; left: auto; right: -20px; border-right: 1px solid #f1a400; border-left: none; }
    #comp1 {
        display: inline-block;
        vertical-align: top;
        position: relative;
        margin-bottom: 50px;
    }
    #c1, #c2 {
        width: 185px;
        height: 185px;
        overflow: hidden;
        position: relative;
        display: inline-block;
        transition: all 0.5s ease;
    }
    #t_wheel1, #t_wheel2 {
        border: 1px solid #a0a0a0;
        border-bottom: none;
        position: absolute;
        right: 50px;
        top: -15px;
        height: 100px;
        width: 85px;
        text-align: center;
        z-index: 2;
        transition: all 0.5s ease;
    }
    #t_wheel2 { border-color: #f1a400; }
    #t_side2 {
        border: 1px solid #f1a400;
        border-right: none;
        position: absolute;
        left: 10px;
        bottom: 2px;
        height: 50px;
        width: 80px;
        text-align: left;
        z-index: 2;
        transition: all 0.5s ease;
    }
    #t_side1 {
        border: 1px solid #a0a0a0;
        border-left: none;
        position: absolute;
        right: 10px;
        bottom: 2px;
        height: 50px;
        width: 80px;
        text-align: right;
        z-index: 2;
        transition: all 0.5s ease;
    }
    #comparespeed {
        margin: 20px 0px 20px 0px;
        display: inline-block;
        text-align: center
    }
    .bigtext { font-size: 16px; }
    #reading, #actual { display: inline-block; vertical-align: top; }
    #reading { margin-left: -9px; }
    #comparespeed input {
        display: inline-block;
        border: none;
        background-color: #f3964c;
        margin: 3px 0px 0px 5px;
        border-radius: 2px;
        height: 20px;
        text-align: center;
        width: 70px;
    }
    #c1 img, #c2 img { width: 100%; height: 100%; }
    #w1, #w2, #t1, #t2, #a1, #a2 { transition: all 0.5s ease; }
    .result_area{
        margin: 20px 0;
        text-align: center;
        border-radius: 5px;
        padding: 8px;
    }
    #mconvert {
        position: relative;
        width: 80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        border-radius: 13px;
        cursor: pointer;
        border: 1px solid #ddd;
        background: #f9f9f9;
        margin: 0 auto;
    }
    #slid {
        position: absolute;
        top: 0;
        width: 45px;
        height: 100%;
        border-radius: 13px;
        background: #9b9b9b4d;
        transition: left 0.3s ease;
    }
    #mm, #in { float: left; padding: 5px; z-index: 1; }
    [x-cloak] { display: none !important; }
</style>

<div class="row relative" x-data="{ visual: true, compVisual: true }">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif

        {{-- Tabs --}}
        <div class="col-12 col-lg-9 mx-auto mt-2 w-full md:w-[70%] lg:w-[70%] pacetabs">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div wire:click="setTab(1)" :class="{ 'bg-[#2845F5] text-white': $wire.activeTab == 1 || $wire.activeTab == 3, 'bg-white text-blue-600': $wire.activeTab == 2 }" 
                         class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 font-bold">
                        Tire Calculator
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div wire:click="setTab(2)" :class="{ 'bg-[#2845F5] text-white': $wire.activeTab == 2, 'bg-white text-blue-600': $wire.activeTab != 2 }" 
                         class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 font-bold">
                        Tire Comparison
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:w-[90%] md:w-[90%] w-full mx-auto ">
            
            {{-- Calculator Tab --}}
            <div x-show="$wire.activeTab == 1 || $wire.activeTab == 3" x-cloak id="calctop">
                <form>
                    <div class="col-12 d-center px-2">
                        <span class="text-center px-10"><strong>Sizes</strong></span>
                        <input type="number" wire:model="sw" class="input @error('sw') border-red-500 @enderror">
                        <span class="text-center px-10"><strong>/</strong></span>
                        <input type="number" wire:model="as" class="input @error('as') border-red-500 @enderror">
                        <span class="text-center px-10"><strong>R</strong></span>
                        <input type="number" wire:model="rim" class="input @error('rim') border-red-500 @enderror">
                    </div>
                    @if($errors->has('sw') || $errors->has('as') || $errors->has('rim'))
                        <div class="text-red-500 text-xs text-center mt-1">Please enter all tire size values.</div>
                    @endif
                    
                    <div id="Equivalent" class="col-12 d-center px-2 mt-3">
                        @if($activeTab == 3)
                            <span class="col-5"><strong>New Wheel Size</strong></span>
                            <input type="number" wire:model="nrim" class="input">
                        @else
                            <a class="go_plus" wire:click="setTab(3)">Convert to Different Wheel Size?</a>
                        @endif
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="button" wire:click="calculateTire" class="calculate px-6 py-3 font-semibold text-[#ffffff] bg-[#2845F5] rounded-[30px] uppercase">Calculate</button>
                    </div>

                    <div class="col-12 font-s-20 px-2 result_area p-2 bg-white border border-[#2845F5] text-[#2845F5] mt-6">Result</div>

                    <div id="calcspecs" x-show="$wire.activeTab == 1">
                        @foreach(['Diameter', 'Width', 'Sidewall', 'Circum.', 'Revs/Mile'] as $label)
                            @php 
                                $key = $label == 'Circum.' ? 'circumference' : ($label == 'Revs/Mile' ? 'revs' : strtolower($label));
                            @endphp
                            <div class="col-12 d-center px-2 mt-2">
                                <div class="col-4 col-md-3 specCat2"><strong>{{ $label }}</strong></div>
                                <input type="text" class="input" value="{{ $calcResults[$key] ?? '' }}{{ $key != 'revs' ? ($unit == 'in' ? '"' : ' mm') : '' }}" readonly>
                            </div>
                        @endforeach
                    </div>

                    <div id="CalcEquivs" x-show="$wire.activeTab == 3" class="px-2 mt-4">
                        <div class="col-12 center fw-bold font_size18 text-center mb-4">Tire Size Equivalents</div>
                        <div class="col-12 d-center">
                            <div class="col-5 specCat2"><strong>Equal Inches Size</strong></div>
                            <input class="input" value="{{ $calcResults['diameter_in'] ?? '' }}X{{ $calcResults['width_in'] ?? '' }}R{{ $nrim ?: $rim }}" readonly>
                        </div>
                        <div class="col-12 d-center mt-2">
                            <div class="col-5 specCat2"><strong>Equal Metric Size</strong></div>
                            <input class="input" value="{{ $sw }}/{{ $as }}R{{ $nrim ?: $rim }}" readonly>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Comparison Tab --}}
            <div x-show="$wire.activeTab == 2" x-cloak id="calctop2">
                <form>
                    <div class="col-12 d-center mt-2 px-2">
                        <span class="col-2 text-center px-10"><strong>Size 1</strong></span>
                        <input type="number" wire:model="sw1" class="input @error('sw1') border-red-500 @enderror">
                        <span class="col-2 text-center px-10"><strong>/</strong></span>
                        <input type="number" wire:model="as1" class="input @error('as1') border-red-500 @enderror">
                        <span class="col-2 text-center px-10"><strong>R</strong></span>
                        <input type="number" wire:model="rim1" class="input @error('rim1') border-red-500 @enderror">
                    </div>
                    <div class="col-12 d-center px-2 mt-2">
                        <span class="col-2 text-center px-10"><strong>Size 2</strong></span>
                        <input type="number" wire:model="sw2" class="input @error('sw2') border-red-500 @enderror">
                        <span class="col-2 text-center px-10"><strong>/</strong></span>
                        <input type="number" wire:model="as2" class="input @error('as2') border-red-500 @enderror">
                        <span class="col-2 text-center px-10"><strong>R</strong></span>
                        <input type="number" wire:model="rim2" class="input @error('rim2') border-red-500 @enderror">
                    </div>
                    @if($errors->any())
                        <div class="text-red-500 text-xs text-center mt-2">Please fill all fields for both tires.</div>
                    @endif

                    <div class="col-12 text-center mt-4">
                        <button type="button" wire:click="calculateComparison" class="calculate px-6 py-3 font-semibold text-[#ffffff] bg-[#2845F5] rounded-[30px] uppercase">Calculate</button>
                    </div>
                    
                    <div class="col-12 font-s-25 px-2 fw-bold result_area p-2 bg-white border border-[#2845F5] text-[#2845F5] mt-6">Result</div>
                    
                    <div id="comparecalc">
                        <div class="row mt-2 text-center">
                            <div class="col-4 col-md-3"></div>
                            <div class="col-4 col-md-4"><strong>Size 1</strong></div>
                            <div class="col-4 col-md-4"><strong>Size 2</strong></div> 
                        </div>
                        @foreach(['Diameter', 'Width', 'Sidewall', 'Circum.', 'Revs/Mile'] as $label)
                            @php 
                                $key = $label == 'Circum.' ? 'circumference' : ($label == 'Revs/Mile' ? 'revs' : strtolower($label));
                            @endphp
                            <div class="col-12 d-center px-2 mt-2">
                                <span class="col-4 col-md-3 px-10"><strong>{{ $label }}</strong></span>
                                <input type="text" class="input me-2" value="{{ $compareResults['tire1'][$key] ?? '' }}" readonly>
                                <input type="text" class="input me-2" value="{{ $compareResults['tire2'][$key] ?? '' }}" readonly>
                                <input type="text" class="input" style="background: white; border: 1px solid {{ str_contains($compareResults['diff'][$key] ?? '', '+') ? '#2845F5' : '#ffcccb' }}; color: {{ str_contains($compareResults['diff'][$key] ?? '', '+') ? '#2845F5' : 'red' }}; width: 60px" value="{{ $compareResults['diff'][$key] ?? '' }}" readonly>
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>

            {{-- Unit Converter --}}
            <div class="col-12 px-2 mt-6">
                <div id="mconvert" wire:click="toggleUnit">
                    <div id="slid" :style="$wire.unit == 'mm' ? 'left: 35px' : 'left: 0'"></div>
                    <span id="in">inches</span>
                    <span id="mm">mm</span>
                </div>
            </div>

            {{-- Visualizer Section --}}
            <div id="cal_wrap">
                
                {{-- Calculator Visualizer --}}
                <div x-show="$wire.activeTab != 2" x-cloak id="cal_visualizer">
                    <div id="show_tires" @click="visual = !visual">
                        Tire Size Visualizer
                    </div>
                    <div id="cal_viewer" x-show="visual">
                        <div id="cal_comp2">
                            <div class="tire_wrap" style="{{ $visStyles['tctc'] ?? '' }}">
                                <div id="tctc" style="{{ $visStyles['tctc'] ?? '' }}"><img src="{!!asset('images/tire_front.jpg')!!}" alt="Front" /></div>
                                <div id="tt_width"><div id="viswidth">Width</div></div>
                                <div id="tt_height"><div id="visheight" style="{{ $visStyles['visheight'] ?? '' }}">Dia.</div></div>
                            </div>
                        </div>
                        <div id="cal_comp1">
                            <div class="tire_wrap" style="{{ $visStyles['cc'] ?? '' }}">
                                <div id="cc" style="{{ $visStyles['cc'] ?? '' }}">
                                    <div id="tt" style="{{ $visStyles['tt'] ?? '' }}">
                                        <img src="{!!asset('images/tire_without_rim.jpg')!!}" alt="Side" />
                                        <div id="ww" style="{{ $visStyles['ww'] ?? '' }}"><img src="{!!asset('images/tire_rim.png')!!}" alt="Rim" /></div>
                                    </div>
                                    <div id="aa">
                                        <img src="{!!asset('images/arrow_angle.png')!!}" alt="Arrow" />
                                        <div id="vis_arrow">Circ.</div>
                                    </div>
                                </div>
                                <div id="t_wheel" style="{{ $visStyles['t_wheel'] ?? '' }}"><div id="vis_wheel">Rim</div></div>
                                <div id="t_side" style="{{ $visStyles['t_side'] ?? '' }}"><div id="vis_side" style="{{ $visStyles['vis_side'] ?? '' }}">Wall</div></div>
                                <div id="vis_revs">{{ $calcResults['revs'] ?? '' }} Revs/{{ $unit == 'in' ? 'Mile' : 'km' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Comparison Visualizer --}}
                {{-- Comparison Visualizer --}}
                <div x-show="$wire.activeTab == 2" x-cloak id="CompVisualizer">
                    <div id="ShowCompTires" @click="compVisual = !compVisual">
                        Tire Size Comparison Visualizer
                    </div>
                    <div id="Viewer" x-show="compVisual">
                        <div id="comparespeed">
                            <div class="bigtext">
                                Speedometer Error<br />
                                <span>(Set Size1 to OEM Size)</span>
                            </div>
                            <br />
                            <form name="speed">
                                <div id="reading">
                                    <b>Reading</b>
                                    @foreach([20,30,40,50,60,70,80,90] as $s)
                                        <a class="px-2">{{ $s }} {{ $unit == 'in' ? 'mph' : 'km/h' }}</a>
                                    @endforeach
                                </div>
                                <div id="actual">
                                    <b>Actual</b>
                                    @foreach([20,30,40,50,60,70,80,90] as $s)
                                        <input type="text" value="{{ $speedometer[$s] ?? '' }}" readonly>
                                    @endforeach
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="resultstab" class="mt-8 border-t pt-6" x-show="$wire.activeTab != 2">
                    <div id="ShowAlternate" class="text-center font-bold text-lg mb-4">Alternate Tire Sizes</div>
                    
                    <div id="DisplayTires1" class="overflow-auto min-h-[100px] bg-gray-50 rounded-lg p-4">
                        {!! $alternateSizes !!}
                    </div>

                    <div id="SizeChange" class="text-center mt-6">
                        <select class="input w-full max-w-[300px]" wire:change="changeRim($event.target.value)">
                            <option value="0">More Wheel Sizes</option>
                            @foreach([14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 26] as $r)
                                <option value="{{ $r }}">{{ $r }}"</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
       </div>
    </div>
</div>
</div>
