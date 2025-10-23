<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php $request = request(); @endphp
            <p class="col-span-12 text-center my-3">Input 3 values containing at least one side to the following six (6) fields.</p>
            <div class="col-span-6">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-6">
                        <label for="a" class="label">a:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="a" id="a" class="input" value="{{ isset($request->a)?$request->a:'5' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="b" class="label">b:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="b" id="b" class="input" value="{{ isset($request->b)?$request->b:'13' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="c" class="label">c:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="c" id="c" class="input" value="{{ isset($request->c)?$request->c:'' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="A" class="label">A:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="A" id="A" class="input" value="{{ isset($request->A)?$request->A:'' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="B" class="label">B:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="B" id="B" class="input" value="{{ isset($request->B)?$request->B:'' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="C" class="label">C</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="C" id="C" class="input" value="{{ isset($request->C)?$request->C:'45' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="unit" class="label">Angle in:</label>
                        <div class="w-full py-2">
                            <select name="unit" class="input" id="unit" aria-label="select">
                                <option value="1">deg °</option>
                                <option value="2" {{ isset($request->unit) && $request->unit=='2'?'selected':'' }}>rad</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6">
                @if($device === "desktop")
                    <div class="w-full text-center mt-2">
                        <img src="{{asset('images/new_tri.png')}}" height="100%" width="80%" alt="triangle image" loading="lazy" decoding="async">
                    </div>
                @endif
                @if($device === "mobile")
                    <div class="w-full text-center mt-3">
                        <img src="{{asset('images/new_tri.png')}}" height="100%" width="50%" alt="triangle image" loading="lazy" decoding="async">
                    </div>
                @endif
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
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['area']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['8'] }} P</strong></td>
                                        <td class="py-2 border-b">{{$detail['peri']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] }} s</strong></td>
                                        <td class="py-2 border-b">{{$detail['semi']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['9'] }} h<sub class="font-s-14">a</sub></strong></td>
                                        <td class="py-2 border-b">{{$detail['ha']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['9'] }} h<sub class="font-s-14">b</sub></strong></td>
                                        <td class="py-2 border-b">{{$detail['hb']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['9'] }} h<sub class="font-s-14">c</sub></strong></td>
                                        <td class="py-2 border-b">{{$detail['hc']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['10'] }} m<sub class="font-s-14">a</sub></strong></td>
                                        <td class="py-2 border-b">{{$detail['ma']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['10'] }} m<sub class="font-s-14">b</sub></strong></td>
                                        <td class="py-2 border-b">{{$detail['mb']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['10'] }} m<sub class="font-s-14">c</sub></strong></td>
                                        <td class="py-2 border-b">{{$detail['mc']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['11'] }} r</strong></td>
                                        <td class="py-2 border-b">{{$detail['inr']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['12'] }} R</strong></td>
                                        <td class="py-2 border-b">{{$detail['circ']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['3']}}:</strong></p>
                                @if($detail['comb']==1)
                                    <p class="mt-3">{{$lang['14']}}</p>
                                    <p class="mt-3">\( ∠A = cos^{-1}(\frac{b^2 + c^2 - a^2}{2bc}) \)</p>
                                    <p class="mt-3">\( ∠A = cos^{-1}(\frac{ {{$detail['b']}}^2 + {{$detail['c']}}^2 - {{$detail['a']}}^2}{2\times {{$detail['b']}} \times {{$detail['c']}} }) \)</p>
                                    <p class="mt-3">\( ∠A = {{round($detail['Ar'],5)}} \text{ rad } = {{round($detail['Ad'],5)}}° = {{$detail['At']['deg'].'°'.$detail['At']['min']."'".$detail['At']['sec'].'"'}} \)</p>
                
                                    <p class="mt-3">\( ∠B = cos^{-1}(\frac{a^2 + c^2 - b^2}{2ac}) \)</p>
                                    <p class="mt-3">\( ∠B = cos^{-1}(\frac{ {{$detail['a']}}^2 + {{$detail['c']}}^2 - {{$detail['b']}}^2}{2\times {{$detail['a']}} \times {{$detail['c']}} }) \)</p>
                                    <p class="mt-3">\( ∠B = {{round($detail['Br'],5)}} \text{ rad } = {{round($detail['Bd'],5)}}° = {{$detail['Bt']['deg'].'°'.$detail['Bt']['min']."'".$detail['Bt']['sec'].'"'}} \)</p>
                
                                    <p class="mt-3">\( ∠C = cos^{-1}(\frac{a^2 + b^2 - c^2}{2ab}) \)</p>
                                    <p class="mt-3">\( ∠C = cos^{-1}(\frac{ {{$detail['a']}}^2 + {{$detail['b']}}^2 - {{$detail['c']}}^2}{2\times {{$detail['a']}} \times {{$detail['b']}} }) \)</p>
                                    <p class="mt-3">\( ∠C = {{round($detail['Cr'],5)}} \text{ rad } = {{round($detail['Cd'],5)}}° = {{$detail['Ct']['deg'].'°'.$detail['Ct']['min']."'".$detail['Ct']['sec'].'"'}} \)</p>
                                @elseif($detail['comb']==2)
                                    <p class="mt-3">{{$lang['13']}}.</p>
                                    <p class="mt-3">\( ∠B = sin^{-1}(\frac{b\times sin(A)}{a}) \)</p>
                                    <p class="mt-3">\( ∠B = sin^{-1}(\frac{ {{$detail['b']}} \times sin({{round($detail['Ar'],5)}})}{ {{$detail['a']}} }) \)</p>
                                    <p class="mt-3">\( ∠B = {{round($detail['Br'],5)}} \text{ rad } = {{round($detail['Bd'],5)}}° = {{$detail['Bt']['deg'].'°'.$detail['Bt']['min']."'".$detail['Bt']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( ∠C = 180° - A - B \)</p>
                                    <p class="mt-3">\( ∠C = {{round($detail['Cr'],5)}} \text{ rad } = {{round($detail['Cd'],5)}}° = {{$detail['Ct']['deg'].'°'.$detail['Ct']['min']."'".$detail['Ct']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( c = \frac{a \times sin(C)}{sin(A)} \)</p>
                                    <p class="mt-3">\( c = \frac{ {{$detail['a']}} \times sin({{round($detail['Cr'],5)}})}{sin({{round($detail['Ar'],5)}})} \)</p>
                                    <p class="mt-3">\( c = {{$detail['c']}} \)</p>
                                @elseif($detail['comb']==3)
                                    <p class="mt-3">{{$lang['15']}}.</p>
                                    <p class="mt-3">\( ∠A = sin^{-1}(\frac{a\times sin(B)}{b}) \)</p>
                                    <p class="mt-3">\( ∠A = sin^{-1}(\frac{ {{$detail['a']}} \times sin({{round($detail['Br'],5)}})}{ {{$detail['b']}} }) \)</p>
                                    <p class="mt-3">\( ∠A = {{round($detail['Ar'],5)}} \text{ rad } = {{round($detail['Ad'],5)}}° = {{$detail['At']['deg'].'°'.$detail['At']['min']."'".$detail['At']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( ∠C = 180° - A - B \)</p>
                                    <p class="mt-3">\( ∠C = {{round($detail['Cr'],5)}} \text{ rad } = {{round($detail['Cd'],5)}}° = {{$detail['Ct']['deg'].'°'.$detail['Ct']['min']."'".$detail['Ct']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( c = \frac{b \times sin(C)}{sin(B)} \)</p>
                                    <p class="mt-3">\( c = \frac{ {{$detail['b']}} \times sin({{round($detail['Cr'],5)}})}{sin({{round($detail['Br'],5)}})} \)</p>
                                    <p class="mt-3">\( c = {{$detail['c']}} \)</p>
                                @elseif($detail['comb']==4)
                                    <p class="mt-3">{{$lang['16']}}.</p>
                                    <p class="mt-3">\( c=\sqrt{b^2 + a^2 - 2ba.cos(C)} \)</p>
                                    <p class="mt-3">\( c=\sqrt{ {{$detail['b']}}^2 + {{$detail['a']}}^2 - 2{{$detail['b']}}\times{{$detail['a']}}.cos({{round($detail['Cr'],5)}})} \)</p>
                                    <p class="mt-3">\( c= {{$detail['c']}} \)</p>
                                    <p class="mt-3">\( ∠A = cos^{-1}(\frac{c^2 + b^2 - a^2}{2cb}) \)</p>
                                    <p class="mt-3">\( ∠A = cos^{-1}(\frac{ {{$detail['c']}}^2 + {{$detail['b']}}^2 - {{$detail['a']}}^2}{2\times{{$detail['c']}}\times{{$detail['b']}} }) \)</p>
                                    <p class="mt-3">\( ∠A = {{round($detail['Ar'],5)}} \text{ rad } = {{round($detail['Ad'],5)}}° = {{$detail['At']['deg'].'°'.$detail['At']['min']."'".$detail['At']['sec'].'"'}} \)</p>
                
                                    <p class="mt-3">\( ∠B = cos^{-1}(\frac{c^2 + a^2 - b^2}{2ca}) \)</p>
                                    <p class="mt-3">\( ∠B = cos^{-1}(\frac{ {{$detail['c']}}^2 + {{$detail['a']}}^2 - {{$detail['b']}}^2}{2\times{{$detail['c']}}\times{{$detail['a']}} }) \)</p>
                                    <p class="mt-3">\( ∠B = {{round($detail['Br'],5)}} \text{ rad } = {{round($detail['Bd'],5)}}° = {{$detail['Bt']['deg'].'°'.$detail['Bt']['min']."'".$detail['Bt']['sec'].'"'}} \)</p>
                                @elseif($detail['comb']==5)
                                    <p class="mt-3">{{$lang['17']}}.</p>
                                    <p class="mt-3">\( ∠C = 180° - A - B \)</p>
                                    <p class="mt-3">\( ∠C = {{round($detail['Cr'],5)}} \text{ rad } = {{round($detail['Cd'],5)}}° = {{$detail['Ct']['deg'].'°'.$detail['Ct']['min']."'".$detail['Ct']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( b = \frac{a\times sin(B)}{sin(A)} \)</p>
                                    <p class="mt-3">\( b = \frac{ {{$detail['a']}} \times sin({{round($detail['Br'],5)}})}{sin({{round($detail['Ar'],5)}})} \)</p>
                                    <p class="mt-3">\( b = {{$detail['b']}} \)</p>
                                    <p class="mt-3">\( c = \frac{a\times sin(C)}{sin(A)} \)</p>
                                    <p class="mt-3">\( c = \frac{ {{$detail['a']}} \times sin({{round($detail['Cr'],5)}})}{sin({{round($detail['Ar'],5)}})} \)</p>
                                    <p class="mt-3">\( c = {{$detail['c']}} \)</p>
                                @elseif($detail['comb']==6)
                                    <p class="mt-3">{{$lang['17']}}.</p>
                                    <p class="mt-3">\( ∠C = 180° - A - B \)</p>
                                    <p class="mt-3">\( ∠C = {{round($detail['Cr'],5)}} \text{ rad } = {{round($detail['Cd'],5)}}° = {{$detail['Ct']['deg'].'°'.$detail['Ct']['min']."'".$detail['Ct']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( a = \frac{b\times sin(A)}{sin(B)} \)</p>
                                    <p class="mt-3">\( a = \frac{ {{$detail['b']}} \times sin({{round($detail['Ar'],5)}})}{sin({{round($detail['Br'],5)}})} \)</p>
                                    <p class="mt-3">\( a = {{$detail['a']}} \)</p>
                                    <p class="mt-3">\( c = \frac{b\times sin(C)}{sin(B)} \)</p>
                                    <p class="mt-3">\( c = \frac{ {{$detail['b']}} \times sin({{round($detail['Cr'],5)}})}{sin({{round($detail['Br'],5)}})} \)</p>
                                    <p class="mt-3">\( c = {{$detail['c']}} \)</p>
                                @elseif($detail['comb']==7)
                                    <p class="mt-3">{{$lang['17']}}.</p>
                                    <p class="mt-3">\( ∠C = 180° - A - B \)</p>
                                    <p class="mt-3">\( ∠C = {{round($detail['Cr'],5)}} \text{ rad } = {{round($detail['Cd'],5)}}° = {{$detail['Ct']['deg'].'°'.$detail['Ct']['min']."'".$detail['Ct']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( a = \frac{c\times sin(A)}{sin(C)} \)</p>
                                    <p class="mt-3">\( a = \frac{ {{$detail['c']}} \times sin({{round($detail['Ar'],5)}})}{sin({{round($detail['Cr'],5)}})} \)</p>
                                    <p class="mt-3">\( a = {{$detail['a']}} \)</p>
                                    <p class="mt-3">\( c = \frac{c\times sin(B)}{sin(C)} \)</p>
                                    <p class="mt-3">\( c = \frac{ {{$detail['c']}} \times sin({{round($detail['Br'],5)}})}{sin({{round($detail['Cr'],5)}})} \)</p>
                                    <p class="mt-3">\( c = {{$detail['c']}} \)</p>
                                @elseif($detail['comb']==8)
                                    <p class="mt-3">{{$lang['17']}}.</p>
                                    <p class="mt-3">\( ∠B = 180° - A - C \)</p>
                                    <p class="mt-3">\( ∠B = {{round($detail['Br'],5)}} \text{ rad } = {{round($detail['Bd'],5)}}° = {{$detail['Bt']['deg'].'°'.$detail['Bt']['min']."'".$detail['Bt']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( b = \frac{a\times sin(B)}{sin(A)} \)</p>
                                    <p class="mt-3">\( b = \frac{ {{$detail['a']}} \times sin({{round($detail['Br'],5)}})}{sin({{round($detail['Ar'],5)}})} \)</p>
                                    <p class="mt-3">\( b = {{$detail['b']}} \)</p>
                                    <p class="mt-3">\( c = \frac{a\times sin(C)}{sin(A)} \)</p>
                                    <p class="mt-3">\( c = \frac{ {{$detail['a']}} \times sin({{round($detail['Cr'],5)}})}{sin({{round($detail['Ar'],5)}})} \)</p>
                                    <p class="mt-3">\( c = {{$detail['c']}} \)</p>
                                @elseif($detail['comb']==9)
                                    <p class="mt-3">{{$lang['17']}}.</p>
                                    <p class="mt-3">\( ∠B = 180° - A - C \)</p>
                                    <p class="mt-3">\( ∠B = {{round($detail['Br'],5)}} \text{ rad } = {{round($detail['Bd'],5)}}° = {{$detail['Bt']['deg'].'°'.$detail['Bt']['min']."'".$detail['Bt']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( a = \frac{b\times sin(A)}{sin(B)} \)</p>
                                    <p class="mt-3">\( a = \frac{ {{$detail['b']}} \times sin({{round($detail['Ar'],5)}})}{sin({{round($detail['Br'],5)}})} \)</p>
                                    <p class="mt-3">\( a = {{$detail['a']}} \)</p>
                                    <p class="mt-3">\( c = \frac{b\times sin(C)}{sin(B)} \)</p>
                                    <p class="mt-3">\( c = \frac{ {{$detail['b']}} \times sin({{round($detail['Cr'],5)}})}{sin({{round($detail['Br'],5)}})} \)</p>
                                    <p class="mt-3">\( c = {{$detail['c']}} \)</p>
                                @elseif($detail['comb']==10)
                                    <p class="mt-3">{{$lang['17']}}.</p>
                                    <p class="mt-3">\( ∠B = 180° - A - C \)</p>
                                    <p class="mt-3">\( ∠B = {{round($detail['Br'],5)}} \text{ rad } = {{round($detail['Bd'],5)}}° = {{$detail['Bt']['deg'].'°'.$detail['Bt']['min']."'".$detail['Bt']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( a = \frac{c\times sin(A)}{sin(C)} \)</p>
                                    <p class="mt-3">\( a = \frac{ {{$detail['c']}} \times sin({{round($detail['Ar'],5)}})}{sin({{round($detail['Cr'],5)}})} \)</p>
                                    <p class="mt-3">\( a = {{$detail['a']}} \)</p>
                                    <p class="mt-3">\( b = \frac{c\times sin(B)}{sin(C)} \)</p>
                                    <p class="mt-3">\( b = \frac{ {{$detail['c']}} \times sin({{round($detail['Br'],5)}})}{sin({{round($detail['Cr'],5)}})} \)</p>
                                    <p class="mt-3">\( b = {{$detail['b']}} \)</p>
                                @elseif($detail['comb']==11)
                                    <p class="mt-3">{{$lang['17']}}.</p>
                                    <p class="mt-3">\( ∠A = 180° - B - C \)</p>
                                    <p class="mt-3">\( ∠A = {{round($detail['Ar'],5)}} \text{ rad } = {{round($detail['Ad'],5)}}° = {{$detail['At']['deg'].'°'.$detail['At']['min']."'".$detail['At']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( b = \frac{a\times sin(B)}{sin(A)} \)</p>
                                    <p class="mt-3">\( b = \frac{ {{$detail['a']}} \times sin({{round($detail['Br'],5)}})}{sin({{round($detail['Ar'],5)}})} \)</p>
                                    <p class="mt-3">\( b = {{$detail['b']}} \)</p>
                                    <p class="mt-3">\( c = \frac{a\times sin(C)}{sin(A)} \)</p>
                                    <p class="mt-3">\( c = \frac{ {{$detail['a']}} \times sin({{round($detail['Cr'],5)}})}{sin({{round($detail['Ar'],5)}})} \)</p>
                                    <p class="mt-3">\( c = {{$detail['c']}} \)</p>
                                @elseif($detail['comb']==12)
                                    <p class="mt-3">{{$lang['17']}}.</p>
                                    <p class="mt-3">\( ∠A = 180° - B - C \)</p>
                                    <p class="mt-3">\( ∠A = {{round($detail['Ar'],5)}} \text{ rad } = {{round($detail['Ad'],5)}}° = {{$detail['At']['deg'].'°'.$detail['At']['min']."'".$detail['At']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( a = \frac{b\times sin(A)}{sin(B)} \)</p>
                                    <p class="mt-3">\( a = \frac{ {{$detail['b']}} \times sin({{round($detail['Ar'],5)}})}{sin({{round($detail['Br'],5)}})} \)</p>
                                    <p class="mt-3">\( a = {{$detail['a']}} \)</p>
                                    <p class="mt-3">\( c = \frac{b\times sin(C)}{sin(B)} \)</p>
                                    <p class="mt-3">\( c = \frac{ {{$detail['b']}} \times sin({{round($detail['Cr'],5)}})}{sin({{round($detail['Br'],5)}})} \)</p>
                                    <p class="mt-3">\( c = {{$detail['c']}} \)</p>
                                @elseif($detail['comb']==13)
                                    <p class="mt-3">{{$lang['17']}}.</p>
                                    <p class="mt-3">\( ∠A = 180° - B - C \)</p>
                                    <p class="mt-3">\( ∠A = {{round($detail['Ar'],5)}} \text{ rad } = {{round($detail['Ad'],5)}}° = {{$detail['At']['deg'].'°'.$detail['At']['min']."'".$detail['At']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( a = \frac{c\times sin(A)}{sin(C)} \)</p>
                                    <p class="mt-3">\( a = \frac{ {{$detail['c']}} \times sin({{round($detail['Ar'],5)}})}{sin({{round($detail['Cr'],5)}})} \)</p>
                                    <p class="mt-3">\( a = {{$detail['a']}} \)</p>
                                    <p class="mt-3">\( b = \frac{c\times sin(B)}{sin(C)} \)</p>
                                    <p class="mt-3">\( b = \frac{ {{$detail['c']}} \times sin({{round($detail['Br'],5)}})}{sin({{round($detail['Cr'],5)}})} \)</p>
                                    <p class="mt-3">\( b = {{$detail['b']}} \)</p>
                                @endif
                                <p class="mt-3">\( {{$lang['6']}} = \frac{ab.sin(C)}{2} \)</p>
                                <p class="mt-3">\( {{$lang['6']}} = \frac{ {{$detail['a'].'\times'.$detail['b']}}.sin({{round($detail['Cr'],5)}})}{2} = {{$detail['area']}} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['8']}} p} = a + b + c \)</p>
                                <p class="mt-3">\( \text{ {{$lang['8']}} p} = {{$detail['a']}} + {{$detail['b']}} + {{$detail['c']}} = {{$detail['peri']}} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['7']}} s} = \frac{a + b + c}{2} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['7']}} s} = \frac{ {{$detail['a']}} + {{$detail['b']}} + {{$detail['c']}} }{2} = {{$detail['semi']}} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['9']}} }h_a=\frac{2 \times \text{ Area}}{a} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['9']}} }h_a=\frac{2 \times {{$detail['area']}} }{ {{$detail['a']}} } = {{$detail['ha']}} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['9']}} }h_b=\frac{2 \times \text{ Area}}{b} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['9']}} }h_b=\frac{2 \times {{$detail['area']}} }{ {{$detail['b']}} } = {{$detail['hb']}} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['9']}} }h_c=\frac{2 \times \text{ Area}}{c} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['9']}} }h_c=\frac{2 \times {{$detail['area']}} }{ {{$detail['c']}} } = {{$detail['hc']}} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['10']}} }m_a=\sqrt{(\frac{a}{2})^2 + c^2 - ac.cos(B)} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['10']}} }m_a=\sqrt{(\frac{ {{$detail['a']}} }{2})^2 + {{$detail['c']}}^2 - {{$detail['a'].'\times'.$detail['c']}}.cos({{round($detail['Br'],5)}})} = {{$detail['ma']}} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['10']}} }m_b=\sqrt{(\frac{b}{2})^2 + a^2 - ab.cos(C)} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['10']}} }m_b=\sqrt{(\frac{ {{$detail['b']}} }{2})^2 + {{$detail['a']}}^2 - {{$detail['a'].'\times'.$detail['b']}}.cos({{round($detail['Cr'],5)}})} = {{$detail['mb']}} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['10']}} }m_c=\sqrt{(\frac{c}{2})^2 + b^2 - bc.cos(A)} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['10']}} }m_c=\sqrt{(\frac{ {{$detail['c']}} }{2})^2 + {{$detail['b']}}^2 - {{$detail['b'].'\times'.$detail['c']}}.cos({{round($detail['Ar'],5)}})} = {{$detail['mc']}} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['11']}} r}=\frac{area}{s} = \frac{ {{$detail['area']}} }{ {{$detail['semi']}} } = {{$detail['inr']}} \)</p>
                                <p class="mt-3">\( \text{ {{$lang['12']}} R}=\frac{a}{2.sin(A)} = \frac{ {{$detail['a']}} }{2 \times sin({{round($detail['Ar'],5)}})} = {{$detail['circ']}} \)</p>
                                @if($detail['comb']==2 && isset($detail['comb2']))
                                    <p class="mt-3">{{$lang['2']}} 2</p>
                                    <p class="mt-3">{{$lang['5']}} a = {{$detail['a']}}</p>
                                    <p class="mt-3">{{$lang['5']}} b = {{$detail['b']}}</p>
                                    <p class="mt-3">{{$lang['5']}} c = {{round($detail['c1'],5)}}</p>
                                    <p class="mt-3">{{$lang['4']}} ∠A = {{round($detail['Ar'],5)}} rad = {{round($detail['Ad'],5)}}° = {{$detail['At']['deg'].'°'.$detail['At']['min']."'".$detail['At']['sec'].'"'}}</p>
                                    <p class="mt-3">{{$lang['4']}} ∠B = {{round($detail['Br1'],5)}} rad = {{round($detail['Bd1'],5)}}° = {{$detail['Bt1']['deg'].'°'.$detail['Bt1']['min']."'".$detail['Bt1']['sec'].'"'}}</p>
                                    <p class="mt-3">{{$lang['4']}} ∠C = {{round($detail['Cr1'],5)}} rad = {{round($detail['Cd1'],5)}}° = {{$detail['Ct1']['deg'].'°'.$detail['Ct1']['min']."'".$detail['Ct1']['sec'].'"'}}</p>
                                    <div class="col-12 mt-3">
                                        <table class="col-6 mx-auto">
                                            <tr>
                                                <td class="py-2 border-b">{{$lang['6']}}</td>
                                                <td class="py-2 border-b">{{$detail['area1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{$lang['8']}} p</td>
                                                <td class="py-2 border-b">{{$detail['peri1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{$lang['7']}} s</td>
                                                <td class="py-2 border-b">{{$detail['semi1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{$lang['9']}} h<sub class="font-s-14">a</sub></td>
                                                <td class="py-2 border-b">{{$detail['ha1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{$lang['9']}} h<sub class="font-s-14">b</sub></td>
                                                <td class="py-2 border-b">{{$detail['hb1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{$lang['9']}} h<sub class="font-s-14">c</sub></td>
                                                <td class="py-2 border-b">{{$detail['hc1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{$lang['10']}} m<sub class="font-s-14">a</sub></td>
                                                <td class="py-2 border-b">{{$detail['ma1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{$lang['10']}} m<sub class="font-s-14">b</sub></td>
                                                <td class="py-2 border-b">{{$detail['mb1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{$lang['10']}} m<sub class="font-s-14">c</sub></td>
                                                <td class="py-2 border-b">{{$detail['mc1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{$lang['11']}} r</td>
                                                <td class="py-2 border-b">{{$detail['inr1']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{$lang['12']}} R</td>
                                                <td class="py-2 border-b">{{$detail['circ1']}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="mt-3">{{$lang['13']}}.</p>
                                    <p class="mt-3">\( ∠B = 180° - sin^{-1}(\frac{b\times sin(A)}{a}) \)</p>
                                    <p class="mt-3">\( ∠B = 180° - sin^{-1}(\frac{ {{$detail['b']}} \times sin({{round($detail['Ar'],5)}})}{ {{$detail['a']}} }) \)</p>
                                    <p class="mt-3">\( ∠B = {{round($detail['Br1'],5)}} \text{ rad } = {{round($detail['Bd1'],5)}}° = {{$detail['Bt1']['deg'].'°'.$detail['Bt1']['min']."'".$detail['Bt1']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( ∠C = 180° - A - B \)</p>
                                    <p class="mt-3">\( ∠C = {{round($detail['Cr1'],5)}} \text{ rad } = {{round($detail['Cd1'],5)}}° = {{$detail['Ct1']['deg'].'°'.$detail['Ct1']['min']."'".$detail['Ct1']['sec'].'"'}} \)</p>
                                    <p class="mt-3">\( c = \frac{a \times sin(C)}{sin(A)} \)</p>
                                    <p class="mt-3">\( c = \frac{ {{$detail['a']}} \times sin({{round($detail['Cr1'],5)}})}{sin({{round($detail['Ar'],5)}})} \)</p>
                                    <p class="mt-3">\( c = {{round($detail['c1'],5)}} \)</p>
                                    <p class="mt-3">\( {{$lang['6']}} = \frac{ab.sin(C)}{2} \)</p>
                                    <p class="mt-3">\( {{$lang['6']}} = \frac{ {{$detail['a'].'\times'.$detail['b']}}.sin({{round($detail['Cr1'],5)}})}{2} = {{$detail['area1']}} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['8']}} p} = a + b + c \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['8']}} p} = {{$detail['a']}} + {{$detail['b']}} + {{round($detail['c1'],5)}} = {{$detail['peri1']}} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['7']}} s} = \frac{a + b + c}{2} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['7']}} s} = \frac{ {{$detail['a']}} + {{$detail['b']}} + {{round($detail['c1'],5)}} }{2} = {{$detail['semi1']}} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['9']}} }h_a=\frac{2 \times \text{ Area}}{a} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['9']}} }h_a=\frac{2 \times {{$detail['area1']}} }{ {{$detail['a']}} } = {{$detail['ha1']}} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['9']}} }h_b=\frac{2 \times \text{ Area}}{b} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['9']}} }h_b=\frac{2 \times {{$detail['area1']}} }{ {{$detail['b']}} } = {{$detail['hb1']}} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['9']}} }h_c=\frac{2 \times \text{ Area}}{c} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['9']}} }h_c=\frac{2 \times {{$detail['area1']}} }{ {{round($detail['c1'],5)}} } = {{$detail['hc1']}} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['10']}} }m_a=\sqrt{(\frac{a}{2})^2 + c^2 - ac.cos(B)} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['10']}} }m_a=\sqrt{(\frac{ {{$detail['a']}} }{2})^2 + {{round($detail['c1'],5)}}^2 - {{$detail['a'].'\times'.round($detail['c1'],5)}}.cos({{round($detail['Br1'],5)}})} = {{$detail['ma1']}} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['10']}} }m_b=\sqrt{(\frac{b}{2})^2 + a^2 - ab.cos(C)} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['10']}} }m_b=\sqrt{(\frac{ {{$detail['b']}} }{2})^2 + {{$detail['a']}}^2 - {{$detail['a'].'\times'.$detail['b']}}.cos({{round($detail['Cr1'],5)}})} = {{$detail['mb1']}} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['10']}} }m_c=\sqrt{(\frac{c}{2})^2 + b^2 - bc.cos(A)} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['10']}} }m_c=\sqrt{(\frac{ {{round($detail['c1'],5)}} }{2})^2 + {{$detail['b']}}^2 - {{$detail['b'].'\times'.round($detail['c1'],5)}}.cos({{round($detail['Ar'],5)}})} = {{$detail['mc1']}} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['11']}} r}=\frac{area}{s} = \frac{ {{$detail['area1']}} }{ {{$detail['semi1']}} } = {{$detail['inr1']}} \)</p>
                                    <p class="mt-3">\( \text{ {{$lang['12']}} R}=\frac{a}{2.sin(A)} = \frac{ {{$detail['a']}} }{2 \times sin({{round($detail['Ar'],5)}})} = {{$detail['circ1']}} \)</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({"SVG": {linebreaks: { automatic: true }} });
        </script>
    @endpush
</form>