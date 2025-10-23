<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
  
 <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
            @php
                $request = request();
                if (!isset($request->waist)) {
                    $request->waist = "42";
                }
                if (!isset($request->bust)) {
                    $request->bust = "42";
                }
                if (!isset($request->hips)) {
                    $request->hips = "42";
                }
            @endphp
            <div class="col-span-12">
                <label for="waist" class="label">{!! $lang['3'] !!}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="waist" id="waist">
                        <option value="30" {{ isset($request->waist) && $request->waist=='30'?'selected':'' }}>58 cm (< 23 in)</option>
                        <option value="32" {{ isset($request->waist) && $request->waist=='32'?'selected':'' }}>58-61 cm (23-24 in)</option>
                        <option value="34" {{ isset($request->waist) && $request->waist=='34'?'selected':'' }}>62-64 cm (24-25 in)</option>
                        <option value="36" {{ isset($request->waist) && $request->waist=='36'?'selected':'' }}>65-68 cm (25-26.5 in)</option>
                        <option value="38" {{ isset($request->waist) && $request->waist=='38'?'selected':'' }}>69-72 cm (26.5-28 in)</option>
                        <option value="40" {{ isset($request->waist) && $request->waist=='40'?'selected':'' }}>73-77 cm (28-30 in)</option>
                        <option value="42" {{ isset($request->waist) && $request->waist=='42'?'selected':'' }}>78-81 cm (30-32 in)</option>
                        <option value="44" {{ isset($request->waist) && $request->waist=='44'?'selected':'' }}>82-85 cm (32-33.5 in)</option>
                        <option value="46" {{ isset($request->waist) && $request->waist=='46'?'selected':'' }}>86-90 cm (33.5-35.5 in)</option>
                        <option value="48" {{ isset($request->waist) && $request->waist=='48'?'selected':'' }}>91-95 cm (35.5-37.5 in)</option>
                        <option value="50" {{ isset($request->waist) && $request->waist=='50'?'selected':'' }}>96-102 cm (37.5-40 in)</option>
                        <option value="52" {{ isset($request->waist) && $request->waist=='52'?'selected':'' }}>103-108 cm (40-42.5 in)</option>
                        <option value="54" {{ isset($request->waist) && $request->waist=='54'?'selected':'' }}>109-114 cm (42.5-45 in)</option>
                        <option value="56" {{ isset($request->waist) && $request->waist=='56'?'selected':'' }}>>114 cm (>45 in)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="bust" class="label">{!! $lang['2'] !!}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="bust" id="bust">
                        <option value="30" {{ isset($request->bust) && $request->bust=='30'?'selected':'' }}>74 cm (29 in)</option>
                        <option value="32" {{ isset($request->bust) && $request->bust=='32'?'selected':'' }}>74-77 cm (29-30 in)</option>
                        <option value="34" {{ isset($request->bust) && $request->bust=='34'?'selected':'' }}>78-81 cm (31-32 in)</option>
                        <option value="36" {{ isset($request->bust) && $request->bust=='36'?'selected':'' }}>82-85 cm (32-33.5 in)</option>
                        <option value="38" {{ isset($request->bust) && $request->bust=='38'?'selected':'' }}>86-89 cm (33.5-35 in)</option>
                        <option value="40" {{ isset($request->bust) && $request->bust=='40'?'selected':'' }}>90-93 cm (35-36.5 in)</option>
                        <option value="42" {{ isset($request->bust) && $request->bust=='42'?'selected':'' }}>94-97 cm (36.5-38 in)</option>
                        <option value="44" {{ isset($request->bust) && $request->bust=='44'?'selected':'' }}>98-102 cm (38-40 in)</option>
                        <option value="46" {{ isset($request->bust) && $request->bust=='46'?'selected':'' }}>103-107 cm (40-42 in)</option>
                        <option value="48" {{ isset($request->bust) && $request->bust=='48'?'selected':'' }}>108-113 cm (42-44.5 in)</option>
                        <option value="50" {{ isset($request->bust) && $request->bust=='50'?'selected':'' }}>114-119 cm (44.5-47 in)</option>
                        <option value="52" {{ isset($request->bust) && $request->bust=='52'?'selected':'' }}>120-125 cm (47-49 in)</option>
                        <option value="54" {{ isset($request->bust) && $request->bust=='54'?'selected':'' }}>126-131 cm (49-51.5 in)</option>
                        <option value="56" {{ isset($request->bust) && $request->bust=='56'?'selected':'' }}>>131 cm (>51.5 in)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="hips" class="label">{!! $lang['4'] !!}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="hips" id="hips">
                        <option value="30" {{ isset($request->hips) && $request->hips=='30'?'selected':'' }}>< 80 cm (< 31.5 in)</option>
                        <option value="32" {{ isset($request->hips) && $request->hips=='32'?'selected':'' }}>80-84 cm (31.5-33 in)</option>
                        <option value="34" {{ isset($request->hips) && $request->hips=='34'?'selected':'' }}>85-89 cm (33-35 in)</option>
                        <option value="36" {{ isset($request->hips) && $request->hips=='36'?'selected':'' }}>90-94 cm (35-37 in)</option>
                        <option value="38" {{ isset($request->hips) && $request->hips=='38'?'selected':'' }}>95-97 cm (37-38 in)</option>
                        <option value="40" {{ isset($request->hips) && $request->hips=='40'?'selected':'' }}>98-101 cm (38-40 in)</option>
                        <option value="42" {{ isset($request->hips) && $request->hips=='42'?'selected':'' }}>102-104 cm (40-41 in)</option>
                        <option value="44" {{ isset($request->hips) && $request->hips=='44'?'selected':'' }}>105-108 cm (41-42.5 in)</option>
                        <option value="46" {{ isset($request->hips) && $request->hips=='46'?'selected':'' }}>109-112 cm (42.5-44 in)</option>
                        <option value="48" {{ isset($request->hips) && $request->hips=='48'?'selected':'' }}>113-116 cm (44-45.5 in)</option>
                        <option value="50" {{ isset($request->hips) && $request->hips=='50'?'selected':'' }}>117-122 cm (45.5-48 in)</option>
                        <option value="52" {{ isset($request->hips) && $request->hips=='52'?'selected':'' }}>123-128 cm (48-50 in)</option>
                        <option value="54" {{ isset($request->hips) && $request->hips=='54'?'selected':'' }}>129-134 cm (50-53 in)</option>
                        <option value="56" {{ isset($request->hips) && $request->hips=='56'?'selected':'' }}>>134 cm (>53 in)</option>
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            @isset($detail['firstText'])
                                @php
                                    $msg=$detail['firstText'];
                                    $msg=$lang['5']."🙂.";
                                @endphp
                                <p class="mt-2 font-s-18">{!! $msg !!}</p>
                            @endisset
                            @isset($detail['secondText'])
                                <p class="mt-2">{!! $lang['8'] !!}</p>
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b">&nbsp;</td>
                                            <td class="py-2 border-b"><strong>{!! $lang['2'] !!}</strong></td>
                                            <td class="py-2 border-b"><strong>{!! $lang['4'] !!}</strong></td>
                                            <td class="py-2 border-b"><strong>{!! $lang['3'] !!}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">USA</td>
                                            <td class="py-2 border-b">{{ $detail['usBust'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['usHips'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['usWaist'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">UK</td>
                                            <td class="py-2 border-b">{{ $detail['ukBust'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['ukHips'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['ukWaist'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">EU</td>
                                            <td class="py-2 border-b">{{ $detail['euBust'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['euHips'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['euWaist'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{!! $lang['9'] !!}</td>
                                            <td class="py-2 border-b">{{ $detail['internationalBust'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['internationalHips'] }}</td>
                                            <td class="py-2 border-b">{{ $detail['internationalWaist'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endisset
                            @isset($detail['usaSize'])
                                <p class="my-2"><strong>{!! $lang['6'] !!}</strong></p>
                                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div class="flex flex-wrap items-center me-2">
                                                <img src="{{ url('images/USA.png') }}" width="30px">
                                                <span class="pt-1 ms-2">USA</span>
                                            </div>
                                            <div><strong class="text-green text-[25px]">{{ $detail['usaSize'] }}</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div class="flex flex-wrap items-center me-2">
                                                <img src="{{ url('images/UK.png') }}" width="30px">
                                                <span class="pt-1 ms-2">UK</span>
                                            </div>
                                            <div><strong class="text-green text-[25px]">{{ $detail['ukSize'] }}</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div class="flex flex-wrap items-center me-2">
                                                <img src="{{ url('images/Europe.png') }}" width="30px">
                                                <span class="pt-1 ms-2">Europe (DE/AT/NL/SE/DK)</span>
                                            </div>
                                            <div><strong class="text-green text-[25px]">{{ $detail['euroSize'] }}</strong></div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div class="flex flex-wrap items-center me-2">
                                                <img src="{{ url('images/International.png') }}" width="30px">
                                                <span class="pt-1 ms-2">{!! $lang['9'] !!}</span>
                                            </div>
                                            <div><strong class="text-green text-[25px]">{{ $detail['internationalSize'] }}</strong></div>
                                        </div>
                                    </div>
                                </div>
                            @endisset
                            <p class="mt-2">
                                <strong>{!! $lang['10'] !!}:</strong>{!! $lang['11'] !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>