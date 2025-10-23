<style>
    .display_none{
        display: none;
    }
</style>
@php
    $naam = request()->naam;
    $naam2 = request()->naam2;
    $naam3 = request()->naam3;
    $naam4 = request()->naam4;
@endphp
<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">
            
                {{-- WEEK1 --}}

                <div class="addweek1 row">
                    <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">
                        <label for="naam" class="font-s-14 text-blue">{{$lang['1t']}}:</label>
                        <div class="w-100 py-2">                                  
                            <input type="text" step="any" name="naam" id="naam" class="input text-center" aria-label="input"
                            value="{{ isset(request()->naam) ? request()->naam : 'Table1' }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="s_date" class="font-s-14 text-blue">{{$lang['2t']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="date" step="any" name="s_date" id="s_date" class="input" aria-label="input"
                                value="{{ isset(request()->s_date) ? request()->s_date : date('') }}" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="e_date" class="font-s-14 text-blue">{{$lang['3t']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="date" step="any" name="e_date" id="e_date" class="input" aria-label="input"
                                value="{{ isset(request()->e_date) ? request()->e_date : date('') }}" />
                            </div>
                        </div>
                        <div class="col-6 text-center  my-2">
                            <span class="p-2"><strong>{{$lang['in']}}</strong></span>
                        </div>
                        <div class="col-6 text-center  my-2">
                            <span class="p-2"><strong>{{$lang['out']}}</strong></span>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row1">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 mon">MON:</div>
                            <div class="cspace-y-2 12h">
                                <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="cspace-y-2 12h">
                                <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="cspace-y-2 time pe-lg-2">
                                <select name="inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="cspace-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="cspace-y-2 12h ps-lg-2">
                                <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="cspace-y-2 12h">
                                <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="cspace-y-2 time">
                                <select name="outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="cspace-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4  r1_lunch1 hidden">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4  r1_lunch2 hidden">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row2 mt-2">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 tue">TUE:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch1 hidden  gap-4">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch2 hidden  gap-4">    
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row3 mt-2">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 wed">WED:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch1 hidden   gap-4">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch2 hidden   gap-4">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row4 mt-2">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 thu">THU:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch1 hidden   gap-4">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch2 hidden   gap-4">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row5 mt-2">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4  mt-2">
                            <div class="space-y-2 fri">FRI:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch1 hidden   gap-4">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch2 hidden   gap-4">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row6 mt-2">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 sat">SAT:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch1 hidden   gap-4">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7 r1_lunch2 hidden   gap-4">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row7 mt-2">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7   gap-4">
                            <div class="space-y-2 sun">SUN:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  r1_lunch1 hidden   gap-4">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  r1_lunch2 hidden   gap-4">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                </div>    
                {{-- WEEK2 --}}
                <div class="hidden addweek2 mt-2">
                    <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">
                        <label for="naam2"><strong class="text-blue">{{$lang['7t']}}</strong></label>
                        <div class="w-100 py-2">                                  
                            <input type="text" step="any" name="naam2" id="naam2" class="input text-center" aria-label="input"
                            value="{{ isset(request()->naam2) ? request()->naam2 : 'Table2' }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="s2_date" class="font-s-14 text-blue">{{$lang['2t']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="date" step="any" name="s2_date" id="s2_date" class="input" aria-label="input"
                                value="{{ isset(request()->s2_date) ? request()->s2_date : date('') }}" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="e2_date" class="font-s-14 text-blue">{{$lang['3t']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="date" step="any" name="e2_date" id="e2_date" class="input" aria-label="input"
                                value="{{ isset(request()->e2_date) ? request()->e2_date : date('') }}" />
                            </div>
                        </div>
                        <div class="space-y-2 text-center  my-2">
                            <span class="p-2"><strong>{{$lang['in']}}</strong></span>
                        </div>
                        <div class="space-y-2 text-center  my-2">
                            <span class="p-2"><strong>{{$lang['out']}}</strong></span>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row1">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 mon">MON:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t2outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t2out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t2outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t2outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t2outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t2outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t2outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row2">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 tue">TUE:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t2outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t2out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t2outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t2outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t2outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t2outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t2outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row3">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 wed">WED:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t2outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t2out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t2outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t2outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t2outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t2outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t2outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row4">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 thu">THU:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t2outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t2out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t2outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t2outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t2outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t2outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t2outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row5">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 fri">FRI:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t2outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t2out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t2outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t2outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t2outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t2outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t2outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row6">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 sat">SAT:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t2outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t2out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t2outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t2outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t2outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t2outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t2outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row7">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 sun">SUN:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t2outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t2outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t2out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t2inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t2outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t2outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t2outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t2inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t2inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t2outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t2outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t2outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t2outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- WEEK3 --}}
                <div class="hidden addweek3 mt-2">
                    <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">
                        <label for="naam3"><strong class="text-blue">{{$lang['6t']}}</strong></label>
                        <div class="w-100 py-2">                                  
                            <input type="text" step="any" name="naam3" id="naam3" class="input text-center" aria-label="input"
                            value="{{ isset(request()->naam3) ? request()->naam3 : 'Table3' }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2 pe-lg-3">
                            <label for="s3_date" class="font-s-14 text-blue">{{$lang['2t']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="date" step="any" name="s3_date" id="s3_date" class="input" aria-label="input"
                                value="{{ isset(request()->s3_date) ? request()->s3_date : date('') }}" />
                            </div>
                        </div>
                        <div class="space-y-2 ps-lg-3">
                            <label for="e3_date" class="font-s-14 text-blue">{{$lang['3t']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="date" step="any" name="e3_date" id="e3_date" class="input" aria-label="input"
                                value="{{ isset(request()->e3_date) ? request()->e3_date : date('') }}" />
                            </div>
                        </div>
                        <div class="space-y-2 text-center pe-lg-3 my-2">
                            <span class="p-2"><strong>{{$lang['in']}}</strong></span>
                        </div>
                        <div class="space-y-2 text-center ps-lg-3 my-2">
                            <span class="p-2"><strong>{{$lang['out']}}</strong></span>
                        </div>
                   </div>
                    <div class="row d-flex align-items-center row1">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 mon">MON:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t3outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t3out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t3outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t3outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t3outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t3outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t3outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row2">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 tue">TUE:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t3outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t3out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t3outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t3outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t3outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t3outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t3outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row3">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 wed">WED:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t3outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t3out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t3outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t3outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t3outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t3outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t3outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row4">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 thu">THU:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t3outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t3out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t3outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t3outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t3outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t3outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t3outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row5">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 fri">FRI:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t3outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t3out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t3outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t3outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t3outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t3outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t3outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row6">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 sat">SAT:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t3outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t3out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t3outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t3outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t3outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t3outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t3outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row7">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 sun">SUN:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t3outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t3outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t3out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t3inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t3outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t3outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t3outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t3inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t3inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t3outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t3outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t3outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t3outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- WEEK4 --}}
                <div class="hidden addweek4 mt-2">
                    <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">
                        <label for="naam4"><strong class="text-blue">{{$lang['5t']}}</strong></label>
                        <div class="w-100 py-2">                                  
                            <input type="text" step="any" name="naam4" id="naam4" class="input text-center" aria-label="input"
                            value="{{ isset(request()->naam4) ? request()->naam4 : 'Table4' }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2 pe-lg-3">
                            <label for="s4_date" class="font-s-14 text-blue">{{$lang['2t']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="date" step="any" name="s4_date" id="s4_date" class="input" aria-label="input"
                                value="{{ isset(request()->s4_date) ? request()->s4_date : date('') }}" />
                            </div>
                        </div>
                        <div class="space-y-2 ps-lg-3">
                            <label for="e4_date" class="font-s-14 text-blue">{{$lang['3t']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="date" step="any" name="e4_date" id="e4_date" class="input" aria-label="input"
                                value="{{ isset(request()->e4_date) ? request()->e4_date : date('') }}" />
                            </div>
                        </div>
                        <div class="space-y-2 text-center pe-lg-3 my-2">
                            <span class="p-2"><strong>{{$lang['in']}}</strong></span>
                        </div>
                        <div class="space-y-2 text-center ps-lg-3 my-2">
                            <span class="p-2"><strong>{{$lang['out']}}</strong></span>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row1">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 mon">MON:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t4outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t4out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t4outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t4outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t4outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t4outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t4outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row2">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 tue">TUE:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t4outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t4out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t4outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t4outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t4outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t4outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t4outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row3">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 wed">WED:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t4outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t4out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t4outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t4outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t4outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t4outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t4outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row4">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 thu">THU:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t4outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t4out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t4outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t4outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t4outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t4outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t4outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row5">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 fri">FRI:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t4outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t4out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t4outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t4outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t4outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t4outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t4outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row6">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 sat">SAT:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t4outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t4out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t4outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t4outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t4outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t4outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t4outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center row7">
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4">
                            <div class="space-y-2 sun">SUN:</div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4inmin[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4in[]" value="" placeholder="in" class="input fahad">
                            </div>
                            <div class="space-y-2 12h ps-lg-2">
                                <input type="number" name="t4outhour[]" value="1" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 12h">
                                <input type="number" name="t4outmin[]" value="5" placeholder="_ _"
                                class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampm[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 display_none ps-lg-2">
                                <input type="number" min="0" max="2400" name="t4out[]" value="" placeholder="out" class="input fahad">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch1 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ">
                                <input type="number" name="t4inminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml1[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1 ps-lg-2">
                                <input type="number" name="t4outhourl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch1">
                                <input type="number" name="t4outminl1[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml1[]" class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24h hidden ps-lg-2">
                                <input type="number" name="t4outlunch1[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                        <div class="grid grid-cols-7 mt-4 lg:grid-cols- md:grid-cols-7  gap-4 r1_lunch2 hidden mt-2">
                            <div class="space-y-2 "></div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4inminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time pe-lg-2">
                                <select name="t4inampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden pe-lg-2">
                                <input type="number" min="0" max="2400" name="t4inlunch2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2 ps-lg-2">
                                <input type="number" name="t4outhourl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 12h lunch2">
                                <input type="number" name="t4outminl2[]" value="1" placeholder="_ _" class="input">
                            </div>
                            <div class="space-y-2 time">
                                <select name="t4outampml2[]"  class="input">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                            </div>
                            <div class="space-y-2 24lh2 hidden ps-lg-2">
                                <input type="number" name="t4outlunch2[]" min="0" max="2400" value="1" placeholder="_ _" class="input">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- advance option --}}
                <div class="px-md-5 px-2 mb-3 mt-3">
                    <input type="checkbox" name="checkbox" id="check" class="filled-in"/>
                    <label for="check">{{$lang['8t']}}</label>
                </div>
                <div class="row advanceopt hidden">
                    <div class="grid grid-cols-1  lg:grid-cols-1 md:grid-cols-1  gap-4">
                        <div class="space-y-2">
                            <select name="selection0" id="selection1" class="input" aria-label="input select">
                                <option value="1" id="op1">{{$lang['10t']}}</option>
                                <option value="2">{{$lang['11t']}}</option>
                                <option value="3">{{$lang['12t']}}</option>
                                <option value="4">{{$lang['13t']}}</option>
                            </select>
                        </div>
                    </div>
                    {{-- days --}}
                    <div class="space-y-22 days mt-2">
                        <div class="grid grid-cols-3  lg:grid-cols-3 md:grid-cols-3  gap-4">
                            <div class="space-y-2">
                                <p class="bg-black text-white px-1">Weeks per Timesheet:</p>
                                <select name="table_selection" id="timesheet" class="input" aria-label="input select">
                                    <option value="1">1 {{$lang['15t']}}/{{$lang['16t']}}</option>
                                        <option value="2">2 {{$lang['15t']}}/{{$lang['16t']}}</option>
                                        <option value="3">3 {{$lang['15t']}}/{{$lang['16t']}}</option>
                                        <option value="4">4 {{$lang['15t']}}/{{$lang['16t']}}</option>
                                </select>
                            </div>
                            <div class="space-y-2 px-2">
                                <p class="bg-black text-white px-1">{{$lang['17t']}}:</p>
                                <select name="selection1" id="hidedays" class="input">
                                    <option value="1">1 {{$lang['18t']}}/{{$lang['15t']}}</option>
                                    <option value="2">2 {{$lang['19t']}}/{{$lang['15t']}}</option>
                                    <option value="3">3 {{$lang['19t']}}/{{$lang['15t']}}</option>
                                    <option value="4">4 {{$lang['19t']}}/{{$lang['15t']}}</option>
                                    <option value="5">5 {{$lang['19t']}}/{{$lang['15t']}}</option>
                                    <option value="6">6 {{$lang['19t']}}/{{$lang['15t']}}</option>
                                    <option value="7" selected>7 {{$lang['19t']}}/{{$lang['15t']}}</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <p class="bg-black text-white px-1">{{$lang['20t']}}:</p>
                                <select name="selection2" id="textchange" class="input" aria-label="input select">
                                    <option value="1">1, 2, 3, etc.</option>
                                    <option value="2" selected>Mon, Tue, Wed, etc.</option>
                                    <option value="3">Sun, Mon, Tues, etc.</option>
                                    <option value="4">M, T, W, etc.</option>
                                    <option value="5">Mo, Tu, We, etc.</option>
                                </select>
                            </div>
                        </div>
                        <div class="space-y-2 mt-2">
                            <p class="bg-black text-white px-1">{{$lang['21t']}}:</p>
                            <select name="selection3" id="format" class="input" aria-label="input select">
                                <option value="1">12 {{$lang['22t']}} (Yes am/pm)</option>
                                <option value="2">24 {{$lang['22t']}} (No am/pm)</option>
                            </select>
                        </div>
                    </div>
                    {{-- lunch --}}
                    <div class="col-12 lunch mt-2 hidden ">
                        {{-- <div class="d-lg-flex justify-content-between"> --}}
                        <div class="grid grid-cols-3  lg:grid-cols-3 md:grid-cols-3  gap-4">
                            <div>
                                <input class="with-gap" name="lunch" value="1" type="radio" checked="" id="lunch" aria-label="input field">
                                <label for="lunch">{{$lang['24t']}}</label>
                            </div>
                            <div>
                                <input class="with-gap" name="lunch" value="2" type="radio" id="lunch1" aria-label="input field">
                                <label for="lunch1">1 {{$lang['25t']}}</label>
                            </div>
                            <div>
                                <input class="with-gap" name="lunch" value="3" type="radio" id="lunch2" aria-label="input field">
                                <label for="lunch2">2 {{$lang['25t']}}</label>
                            </div>
                        </div>
                        <div class="my-2">
                            <input type="checkbox" name="advancedcheck" value="true" id="check12" class="filled-in"/>
                            <label for="check12">{{$lang['26t']}}</label>
                        </div>
                        <div class="advanceopt1 hidden">
                            <p class="pb-2">{{$lang['27t']}}:</p>
                            <div class="grid grid-cols-3  lg:grid-cols-3 md:grid-cols-3  gap-4">
                                <div class="space-y-2 pe-2">
                                    <p class="bg-black text-white px-1"> {{$lang['28t']}} 1</p>
                                    <input type="number" name="paid_lunch1" value="8" min="0" max="59" placeholder="00"
                                        class="input ">
                                </div>
                                <div class="space-y-2 ps-2">
                                    <p class="bg-black text-white px-1"> {{$lang['28t']}} 2</p>
                                    <input type="number" name="paid_lunch2" value="8" min="0" max="59" placeholder="00"
                                        class="input ">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- advance overtime --}}
                    <div class="justify-content-between overtime my-3 gap-3 hidden ">
                        <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                            <div class="space-y-2">
                                <p class="bg-black text-white px-1">{{$lang['23t']}}</p>
                                <input type="number" name="hour_rate" value="8" placeholder=""
                                    class="input">
                            </div>
                            <div class="space-y-2 px-2">
                                <p class="bg-black text-white px-1"> {{$lang['29t']}}:</p>
                                <select name="overtime" class="input" aria-label="input select" data-gtm-form-interact-field-id="5">
                                    <option value="0" selected="">{{$lang['20t']}}</option>
                                    <option value="1">{{$lang['31t']}} 8 {{$lang['32t']}}</option>
                                    <option value="2">{{$lang['31t']}} 40 {{$lang['32t']}}</option>
                                </select>
                            </div>
                            <div class="space-y-2 mt-1">
                                <legend class="bg-black text-white px-1">{{$lang['33t']}}:</legend>
                                <input type="text" name="overtime_pay" value="1.5" placeholder=""
                                    class="input">
                            </div>
                        </div>
                    </div>
                    {{-- sick hour --}}
                    <div class="space-y-2 sick_hour my-3 hidden ">
                        <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                            <div class="space-y-2">
                                <div class="align-self-center fw-semibold pt-1 m-0">{{$lang['35t']}}:</div>
                            </div>
                            <div class="space-y-2">
                                <div class="align-self-center fw-semibold pt-1 m-0">{{$lang['36t']}}:</div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4">

                            <div class="flex space-x-2">
                                <div class="self-center font-semibold pt-1 text-end">Week 1:</div>
                                <div>
                                    <input type="number" name="sick_h" value="1" class="border rounded px-2 py-1 w-16">
                                </div>
                                <span>:</span>
                                <div>
                                    <input type="number" name="sick_m" value="8" class="border rounded px-2 py-1 w-16">
                                </div>
                            </div>
                        
                            <div class="flex space-x-2">
                                <div class="self-center font-semibold pt-1 text-end">Week 1:</div>
                                <div>
                                    <input type="number" name="v_h" value="1" class="border rounded px-2 py-1 w-16">
                                </div>
                                <span>:</span>
                                <div>
                                    <input type="number" name="v_m" value="8" class="border rounded px-2 py-1 w-16">
                                </div>
                            </div>
                        
                            {{-- Week 2 --}}
                            <div class="flex space-x-2 hidden week2">
                                <div class="self-center font-semibold pt-1 text-end">Week 2:</div>
                                <div>
                                    <input type="number" name="t2sick_h" value="1" class="border rounded px-2 py-1 w-16">
                                </div>
                                <span>:</span>
                                <div>
                                    <input type="number" name="t2sick_m" value="8" class="border rounded px-2 py-1 w-16">
                                </div>
                            </div>
                        
                            <div class="flex space-x-2 hidden week2">
                                <div class="self-center font-semibold pt-1 text-end">Week 2:</div>
                                <div>
                                    <input type="number" name="t2v_h" value="1" class="border rounded px-2 py-1 w-16">
                                </div>
                                <span>:</span>
                                <div>
                                    <input type="number" name="t2v_m" value="8" class="border rounded px-2 py-1 w-16">
                                </div>
                            </div>
                        
                            {{-- Week 3 --}}
                            <div class="flex space-x-2 hidden week3">
                                <div class="self-center font-semibold pt-1 text-end">Week 3:</div>
                                <div>
                                    <input type="number" name="t3sick_h" value="1" class="border rounded px-2 py-1 w-16">
                                </div>
                                <span>:</span>
                                <div>
                                    <input type="number" name="t3sick_m" value="8" class="border rounded px-2 py-1 w-16">
                                </div>
                            </div>
                        
                            <div class="flex space-x-2 hidden week3">
                                <div class="self-center font-semibold pt-1 text-end">Week 3:</div>
                                <div>
                                    <input type="number" name="t3v_h" value="1" class="border rounded px-2 py-1 w-16">
                                </div>
                                <span>:</span>
                                <div>
                                    <input type="number" name="t3v_m" value="8" class="border rounded px-2 py-1 w-16">
                                </div>
                            </div>
                        
                            {{-- Week 4 --}}
                            <div class="flex space-x-2 hidden week4">
                                <div class="self-center font-semibold pt-1 text-end">Week 4:</div>
                                <div>
                                    <input type="number" name="t4sick_h" value="1" class="border rounded px-2 py-1 w-16">
                                </div>
                                <span>:</span>
                                <div>
                                    <input type="number" name="t4sick_m" value="8" class="border rounded px-2 py-1 w-16">
                                </div>
                            </div>
                        
                            <div class="flex space-x-2 hidden week4">
                                <div class="self-center font-semibold pt-1 text-end">Week 4:</div>
                                <div>
                                    <input type="number" name="t4v_h" value="1" class="border rounded px-2 py-1 w-16">
                                </div>
                                <span>:</span>
                                <div>
                                    <input type="number" name="t4v_m" value="8" class="border rounded px-2 py-1 w-16">
                                </div>
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
    @else
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full my-2">
                    <div class="col-lg-8 font-s-18">
                        @if(isset($detail['count_days']))
                            <table>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['19']}}</strong></td>
                                    <td class="border-b py-2">{{$detail['from']}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['20']}}</strong></td>
                                    <td class="border-b py-2">{{$detail['to']}}</td>
                                </tr>
                            </table>
                            <div class="col-12">
                                <p class="mt-2"><strong>{{$detail['years']}} {{$lang['32']}} , {{$detail['months']}} {{$lang['33']}} 
                                , {{$detail['days']}} {{$lang['34']}}
                                    </strong></p>
                                <p class="mt-2"><strong> {{$lang['35']}} {{number_format(floor($detail['diff']/2.628e+6))}} {{$lang['33']}}
                                , {{$detail['days']}} {{$lang['34']}}
                                    </strong></p>
                                <p class="mt-2"><strong> {{$lang['35']}} {{number_format(floor($detail['t_days']/7))}} {{$lang['39']}}
                                , {{number_format(floor($detail['t_days']%7))}} {{$lang['34']}}
                                    </strong></p>
                                <p class="mt-2"><strong>{{$lang['35']}} {{$detail['t_days']}} {{$lang['34']}}
                                </strong></p>
                                <p class="mt-2"><strong>{{$lang['35']}} {{$detail['t_days']*24}} {{$lang['36']}}
                                </strong></p>
                                <p class="mt-2"><strong>{{$lang['35']}} {{$detail['t_days']*24*60}} {{$lang['37']}}
                                </strong></p>
                                <p class="mt-2"><strong>{{$lang['35']}} {{$detail['t_days']*24*60*60}} {{$lang['38']}}
                                </strong></p>
                            </div>
                            <p class="font-s-20">{{$lang['21']}}:</p>
                            <table class="w-100">
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['22']}} :</strong></td>
                                    <td class="border-b py-2">{{$detail['getworkdays']['workdays']}}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>{{$lang['23']}} :</strong></td>
                                    <td class="border-b py-2">{{$detail['getworkdays']['weekend']}}</td>
                                </tr>
                                @if(request()->holiday_c=='yes')
                                    <tr>
                                        <td class="border-b py-2"><strong>Holidays {{(($detail['getworkdays']['holidays']!=0)?"<span class='view_holi'>(View Detail)</span>":'')}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['getworkdays']['holidays']}}</td>
                                    </tr>
                                @endif
                                @if(request()->holiday_c=='yes' && $detail['getworkdays']['holidays']!=0)
                                        <tr>
                                            <td colspan="2" class="pt-3"><strong>{{$lang['25']}} {{$detail['from']}} and {{$detail['to']}}</strong></td>
                                        </tr>
                                    @if($count=count($detail['getworkdays']['get_holi']))
                                        @for ($i=0; $i <$count ; $i++)
                                            <tr>
                                                <td class="border-b py-2">{{$detail['getworkdays']['dis_holi'][$i]}} :</td>
                                                <td class="border-b py-2">{{$detail['getworkdays']['get_holi'][$i]}}</td>
                                            </tr>
                                        @endfor
                                    @endif
                                    </table>
                                @endif
                            </table>
                        @else
                            @if(isset(request()->cal_bus))
                                <p class="my-2"><strong>{{$detail['date']}}</strong></p>
                                @if(request()->method=='+')
                                    <p class="mb-2">{{$lang['28']}} {{request()->days}} {{$lang['22']}} {{$lang['29']}} {{$detail['from']}} {{$lang['30']}} {{$detail['from_s']}} {{$lang['26']}} {{$detail['date_e']}}</p>
                                @else
                                    <p class="mb-2">{{$lang['28']}} {{request()->days}} {{$lang['22']}} before {{$detail['from']}} {{$lang['30']}} {{$detail['date_e']}} {{$lang['31']}} {{$detail['from_s']}} and</p>
                                @endif
                                <table class="w-100">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['22t']}} :</strong></td>
                                        <td class="border-b py-2">{{request()->days}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['23t']}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['weekends']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['24t']}} {{(($detail['holidays']!=0)?"<span class='view_holi'>(View Detail)</span>":'')}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['holidays']}}</td>
                                    </tr>
                                    @if($_POST['weekend_c']=='yes' && $detail['holidays']!=0)
                                        {{-- <div class="col s12 margin_top_10 display_none holi_detail"> --}}
                                            <tr>
                                                <td colspan="2" class="pt-2">{{$lang['25']}} {{$detail['from']}} {{$lang['26']}} {{$detail['date']}}</td>
                                            </tr>
                                            {{-- <table class="highlight striped col m10 s12 font_size18 font_s16_m"> --}}
                                        @php $count=count($detail['get_holi'])@endphp
                                            @for ($i=0; $i <$count ; $i++)
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{$detail['dis_holi'][$i]}} :</strong></td>
                                                    <td class="border-b py-2">{{$detail['get_holi'][$i]}}</td>
                                                </tr>
                                            @endfor
                                    @endif
                                </table>
                            @else
                                <p class="font-s-20"><strong>{{request()->naam}}</strong></p>
                                <table class="w-100">
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['46t']}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['from']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['37t']}} :</strong></td>
                                        <td class="border-b py-2">{{$detail['to']}}</td>
                                    </tr>
                                    @if (!empty($detail['sick_time']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['38t']}} :</strong></td>
                                            <td class="border-b py-2">{{($detail['sick_time'])}}</td>
                                        </tr>
                                    @endif
                                    @if (!empty($detail['total_time']))
                                        <tr>
                                            <td colspan="2" class="border-b py-2">{{($detail['total_time'])}}</td>
                                            {{-- <td class="border-b py-2"><strong>{{$lang['38t']}}</strong></td> --}}
                                        </tr>    
                                    @endif
                                    @if (!empty($detail['sick_pay']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['39t']}} :</strong></td>
                                            <td class="border-b py-2">{{round($detail['sick_pay'])}}</td>
                                        </tr>
                                    @endif
                                    @if (!empty($detail['v_time']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['41t']}} :</strong></td>
                                            <td class="border-b py-2">{{($detail['v_time'])}}</td>
                                        </tr>
                                    @endif
                                    @if (!empty($detail['vacation_pay']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['40t']}} :</strong></td>
                                            <td class="border-b py-2">{{round($detail['vacation_pay'])}}</td>
                                        </tr>
                                    @endif
                                    @if (!empty($detail['regular_time']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['42t']}} :</strong></td>
                                            <td class="border-b py-2">{{($detail['regular_time'])}}</td>
                                        </tr>
                                    @endif
                                    @if (!empty($detail['overtime2_first']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['43t']}} :</strong></td>
                                            <td class="border-b py-2">{{($detail['overtime2_first'])}}</td>
                                        </tr>
                                    @endif
                                    @if (!empty($detail['overtime3_first']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['44t']}} :</strong></td>
                                            <td class="border-b py-2">{{($detail['overtime3_first'])}}</td>
                                        </tr>
                                    @endif
                                    @if (!empty($detail['overtime4_first']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['34t']}} :</strong></td>
                                            <td class="border-b py-2">{{($detail['overtime4_first'])}}</td>
                                        </tr>
                                    @endif
                                    @if (!empty($detail['overtime5_first']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['33t']}} :</strong></td>
                                            <td class="border-b py-2">{{($detail['overtime5_first'])}}</td>
                                        </tr>
                                    @endif
                                    @if (!empty($detail['overtime6_first']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td>
                                            <td class="border-b py-2">{{($detail['overtime6_first'])}}</td>
                                        </tr>
                                    @endif
                                    @if (!empty($detail['total_pay']))
                                        <tr>
                                            {{-- <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td> --}}
                                            <td colspan="2" class="border-b py-2">{{round($detail['total_pay'])}}</td>
                                        </tr>
                                    @endif
                                </table>
                                <table class="w-100 my-3">
                                    <tr>
                                        @if ($detail['days']) 
                                            <td width="30%" class="border-b py-2"><strong>{{$lang['19t']}}</strong></td>
                                        @endif
                                        @if ($detail['ans_arr']) 
                                            <td width="30%" class="border-b py-2"><strong>{{$lang['42t']}}</strong></td>
                                        @endif
                                        @if ($detail['ansl1_arr']) 
                                            <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}}</strong></td>
                                        @endif
                                        @if ($detail['ansl21_arr']) 
                                            <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}} r1</strong></td>
                                        @endif
                                        @if ($detail['ansl2_arr']) 
                                            <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}} r2</strong></td>
                                        @endif
                                        @if ($detail['overall_time'])
                                            <td width="30%" class="border-b py-2"><strong>{{$lang['44t']}}</strong></td>
                                        @endif
                                    </tr>
                                    @foreach (($detail['ans_arr']) as $index => $value)
                                        <tr>
                                            @if ($detail['days'])
                                                <td class="border-b py-2">{{ ($detail['days'])[$index]}}</td>
                                            @endif
                                            @if ($detail['ans_arr'])
                                                <td class="border-b py-2">{{($detail['ans_arr'])[$index]}}</td>
                                            @endif
                                            @if ($detail['ansl1_arr'])
                                                <td class="border-b py-2">{{($detail['ansl1_arr'])[$index]}}</td>
                                            @endif
                                            @if ($detail['ansl21_arr'])
                                                <td class="border-b py-2">{{($detail['ansl21_arr'])[$index]}}</td>
                                            @endif
                                            @if ($detail['ansl2_arr'])
                                                <td class="border-b py-2">{{($detail['ansl2_arr'])[$index]}}</td>
                                            @endif
                                            @if ($detail['overall_time'])
                                                <td class="border-b py-2">{{($detail['overall_time'])[$index]}}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
            
                                @if ($detail['table_selection']=="2" || $detail['table_selection']=="3" || $detail['table_selection']=="4") 
                                    <p class="font-s-20 mt-3"><strong>{{request()->naam2}}</strong></p>
                                    <table class="w-100">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['46t']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['fromt2']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['37t']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['tot2']}}</td>
                                        </tr>
                                        @if (!empty($detail['sick_timet2']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['38t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['sick_timet2'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['total_timet2']))
                                            <tr>
                                                <td colspan="2" class="border-b py-2">{{($detail['total_timet2'])}}</td>
                                                {{-- <td class="border-b py-2"><strong>{{$lang['38t']}}</strong></td> --}}
                                            </tr>    
                                        @endif
                                        @if (!empty($detail['sick_payt2']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['39t']}} :</strong></td>
                                                <td class="border-b py-2">{{round($detail['sick_payt2'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['v_timet2']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['41t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['v_timet2'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['vacation_payt2']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['40t']}} :</strong></td>
                                                <td class="border-b py-2">{{round($detail['vacation_payt2'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['regular_timet2']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['42t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['regular_timet2'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime2_firstt2']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['43t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime2_firstt2'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime3_firstt2']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['44t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime3_firstt2'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime4_firstt2']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['34t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime4_firstt2'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime5_firstt2']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['33t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime5_firstt2'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime6_firstt2']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime6_firstt2'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['total_payt2']))
                                            <tr>
                                                {{-- <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td> --}}
                                                <td colspan="2" class="border-b py-2">{{round($detail['total_payt2'])}}</td>
                                            </tr>
                                        @endif
                                    </table>
                                    <table class="w-100 my-3">
                                        <tr>
                                            @if ($detail['dayst2']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['19t']}}</strong></td>
                                            @endif
                                            @if ($detail['ans_arrt2']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['42t']}}</strong></td>
                                            @endif
                                            @if ($detail['ansl1_arrt2']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}}</strong></td>
                                            @endif
                                            @if ($detail['ansl21_arrt2']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}} r1</strong></td>
                                            @endif
                                            @if ($detail['ansl2_arrt2']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}} r2</strong></td>
                                            @endif
                                            @if ($detail['overall_timet2'])
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['44t']}}</strong></td>
                                            @endif
                                        </tr>
                                        @foreach (($detail['ans_arrt2']) as $index => $value)
                                            <tr>
                                                @if ($detail['dayst2'])
                                                    <td class="border-b py-2">{{ ($detail['dayst2'])[$index]}}</td>
                                                @endif
                                                @if ($detail['ans_arrt2'])
                                                    <td class="border-b py-2">{{($detail['ans_arrt2'])[$index]}}</td>
                                                @endif
                                                @if ($detail['ansl1_arrt2'])
                                                    <td class="border-b py-2">{{($detail['ansl1_arrt2'])[$index]}}</td>
                                                @endif
                                                @if ($detail['ansl21_arrt2'])
                                                    <td class="border-b py-2">{{($detail['ansl21_arrt2'])[$index]}}</td>
                                                @endif
                                                @if ($detail['ansl2_arrt2'])
                                                    <td class="border-b py-2">{{($detail['ansl2_arrt2'])[$index]}}</td>
                                                @endif
                                                @if ($detail['overall_timet2'])
                                                    <td class="border-b py-2">{{($detail['overall_timet2'])[$index]}}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
            
                                @if ($detail['table_selection']=="3" || $detail['table_selection']=="4")
                                    <p class="font-s-20 mt-3"><strong>{{request()->naam3}}</strong></p>
                                    <table class="w-100">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['46t']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['fromt3']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['37t']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['tot3']}}</td>
                                        </tr>
                                        @if (!empty($detail['sick_timet3']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['38t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['sick_timet3'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['total_timet3']))
                                            <tr>
                                                <td colspan="2" class="border-b py-2">{{($detail['total_timet3'])}}</td>
                                                {{-- <td class="border-b py-2"><strong>{{$lang['38t']}}</strong></td> --}}
                                            </tr>    
                                        @endif
                                        @if (!empty($detail['sick_payt3']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['39t']}} :</strong></td>
                                                <td class="border-b py-2">{{round($detail['sick_payt3'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['v_timet3']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['41t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['v_timet3'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['vacation_payt3']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['40t']}} :</strong></td>
                                                <td class="border-b py-2">{{round($detail['vacation_payt3'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['regular_timet3']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['42t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['regular_timet3'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime2_firstt3']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['43t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime2_firstt3'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime3_firstt3']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['44t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime3_firstt3'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime4_firstt3']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['34t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime4_firstt3'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime5_firstt3']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['33t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime5_firstt3'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime6_firstt3']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime6_firstt3'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['total_payt3']))
                                            <tr>
                                                {{-- <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td> --}}
                                                <td colspan="2" class="border-b py-2">{{round($detail['total_payt3'])}}</td>
                                            </tr>
                                        @endif
                                    </table>
                                    <table class="w-100 my-3">
                                        <tr>
                                            @if ($detail['dayst3']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['19t']}}</strong></td>
                                            @endif
                                            @if ($detail['ans_arrt3']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['42t']}}</strong></td>
                                            @endif
                                            @if ($detail['ansl1_arrt3']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}}</strong></td>
                                            @endif
                                            @if ($detail['ansl21_arrt3']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}} r1</strong></td>
                                            @endif
                                            @if ($detail['ansl2_arrt3']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}} r2</strong></td>
                                            @endif
                                            @if ($detail['overall_timet3'])
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['44t']}}</strong></td>
                                            @endif
                                        </tr>
                                        @foreach (($detail['ans_arrt3']) as $index => $value)
                                            <tr>
                                                @if ($detail['dayst3'])
                                                    <td class="border-b py-2">{{ ($detail['dayst3'])[$index]}}</td>
                                                @endif
                                                @if ($detail['ans_arrt3'])
                                                    <td class="border-b py-2">{{($detail['ans_arrt3'])[$index]}}</td>
                                                @endif
                                                @if ($detail['ansl1_arrt3'])
                                                    <td class="border-b py-2">{{($detail['ansl1_arrt3'])[$index]}}</td>
                                                @endif
                                                @if ($detail['ansl21_arrt3'])
                                                    <td class="border-b py-2">{{($detail['ansl21_arrt3'])[$index]}}</td>
                                                @endif
                                                @if ($detail['ansl2_arrt3'])
                                                    <td class="border-b py-2">{{($detail['ansl2_arrt3'])[$index]}}</td>
                                                @endif
                                                @if ($detail['overall_timet3'])
                                                    <td class="border-b py-2">{{($detail['overall_timet3'])[$index]}}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
            
                                @if ($detail['table_selection']=="4")
                                    <p class="font-s-20 mt-3"><strong>{{request()->naam4}}</strong></p>
                                    <table class="w-100">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['46t']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['fromt4']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['37t']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['tot4']}}</td>
                                        </tr>
                                        @if (!empty($detail['sick_timet4']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['38t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['sick_timet4'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['total_timet4']))
                                            <tr>
                                                <td colspan="2" class="border-b py-2">{{($detail['total_timet4'])}}</td>
                                                {{-- <td class="border-b py-2"><strong>{{$lang['38t']}}</strong></td> --}}
                                            </tr>    
                                        @endif
                                        @if (!empty($detail['sick_payt4']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['39t']}} :</strong></td>
                                                <td class="border-b py-2">{{round($detail['sick_payt4'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['v_timet4']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['41t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['v_timet4'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['vacation_payt4']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['40t']}} :</strong></td>
                                                <td class="border-b py-2">{{round($detail['vacation_payt4'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['regular_timet4']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['42t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['regular_timet4'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime2_firstt4']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['43t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime2_firstt4'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime3_firstt4']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['44t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime3_firstt4'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime4_firstt4']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['34t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime4_firstt4'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime5_firstt4']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['33t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime5_firstt4'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['overtime6_firstt4']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td>
                                                <td class="border-b py-2">{{($detail['overtime6_firstt4'])}}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['total_payt4']))
                                            <tr>
                                                {{-- <td class="border-b py-2"><strong>{{$lang['45t']}} :</strong></td> --}}
                                                <td colspan="2" class="border-b py-2">{{round($detail['total_payt4'])}}</td>
                                            </tr>
                                        @endif
                                    </table>
                                    <table class="w-100 my-3">
                                        <tr>
                                            @if ($detail['dayst4']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['19t']}}</strong></td>
                                            @endif
                                            @if ($detail['ans_arrt4']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['42t']}}</strong></td>
                                            @endif
                                            @if ($detail['ansl1_arrt4']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}}</strong></td>
                                            @endif
                                            @if ($detail['ansl21_arrt4']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}} r1</strong></td>
                                            @endif
                                            @if ($detail['ansl2_arrt4']) 
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['11t']}} r2</strong></td>
                                            @endif
                                            @if ($detail['overall_timet4'])
                                                <td width="30%" class="border-b py-2"><strong>{{$lang['44t']}}</strong></td>
                                            @endif
                                        </tr>
                                        @foreach (($detail['ans_arrt4']) as $index => $value)
                                            <tr>
                                                @if ($detail['dayst4'])
                                                    <td class="border-b py-2">{{ ($detail['dayst4'])[$index] }}</td>
                                                @endif
                                                @if ($detail['ans_arrt4'])
                                                    <td class="border-b py-2">{{($detail['ans_arrt4'])[$index]}}</td>
                                                @endif
                                                @if ($detail['ansl1_arrt4'])
                                                    <td class="border-b py-2">{{($detail['ansl1_arrt4'])[$index]}}</td>
                                                @endif
                                                @if ($detail['ansl21_arrt4'])
                                                    <td class="border-b py-2">{{($detail['ansl21_arrt4'])[$index]}}</td>
                                                @endif
                                                @if ($detail['ansl2_arrt4'])
                                                    <td class="border-b py-2">{{($detail['ansl2_arrt4'])[$index]}}</td>
                                                @endif
                                                @if ($detail['overall_timet4'])
                                                    <td class="border-b py-2">{{($detail['overall_timet4'])[$index]}}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="w-full text-center mt-3 mb-5">
                    <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                        @if (app()->getLocale() == 'en')
                            RESET
                        @else
                            {{ $lang['reset'] ?? 'RESET' }}
                        @endif
                    </a>
                </div>
            </div>
        <space-y-2  >  </div>

    @endif
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@push('calculatorJS')
    <script>
        $('#check').click(function(){
            if($(this).is(":checked")) {
		        $(".advanceopt").show().removeClass('hidden');
		    } else {
                $(".advanceopt").hide();
		    }
        });
        $('#check12').click(function(){
            if($(this).is(":checked")) {
                $(".advanceopt1").addClass('row').removeClass('hidden');
            } else {
                $(".advanceopt1").addClass('hidden').removeClass('row');
            }
        });
        $('#selection1').change(function(){
            var selection1 = $(this).val();
            if(selection1 == 1){
                $('.days').removeClass('hidden').addClass('d-md-flex');
                $('.lunch').addClass('hidden').removeClass('d-block');
                $('.overtime').addClass('hidden').removeClass('d-md-flex');
                $('.sick_hour').addClass('hidden').removeClass('d-block');
            }else if(selection1 == 2){
                $('.lunch').removeClass('hidden');
                $('.days').addClass('hidden').removeClass('d-md-flex');
                $('.overtime').addClass('hidden').removeClass('d-md-flex');
                $('.sick_hour').addClass('hidden').removeClass('d-block');
            }else if(selection1 == 3){
                $('.overtime').removeClass('hidden').addClass('d-md-flex');
                $('.lunch').addClass('hidden').removeClass('d-block');                
                $('.sick_hour').addClass('hidden').removeClass('d-block');
                $('.days').addClass('hidden').removeClass('d-md-flex');
            }else{
                $('.sick_hour').removeClass('hidden');
                $('.lunch').addClass('hidden').removeClass('d-block');                
                $('.overtime').addClass('hidden').removeClass('d-md-flex');
                $('.days').addClass('hidden').removeClass('d-md-flex');
            }
        });
        $('#timesheet').change(function(){
            var timesheet = $(this).val();
            if(timesheet == 1){
                // $('.week').removeClass('hidden').addClass('d-md-flex');
                $('.addweek2').addClass('hidden').removeClass('row');
                $('.addweek3').addClass('hidden').removeClass('row');
                $('.addweek4').addClass('hidden').removeClass('row');
                $('.week2').removeClass('d-lg-flex').addClass('hidden');
                $('.week3').removeClass('d-lg-flex').addClass('hidden');
                $('.week4').removeClass('d-lg-flex').addClass('hidden');
            }else if(timesheet == 2){
                // $('.lunch').removeClass('hidden');
                $('.addweek2').removeClass('hidden').addClass('row');
                $('.addweek3').addClass('hidden').removeClass('row');
                $('.addweek4').addClass('hidden').removeClass('row');
                $('.week2').removeClass('hidden').addClass('d-lg-flex');
            }else if(timesheet == 3){
                // $('.overtime').removeClass('hidden').addClass('row');
                // $('.lunch').addClass('hidden').removeClass('row');                
                $('.addweek3').removeClass('hidden').addClass('row');
                $('.addweek2').removeClass('hidden').addClass('row');
                $('.addweek4').addClass('hidden').removeClass('row');
                $('.week3').removeClass('hidden').addClass('d-lg-flex');
                $('.week2').removeClass('hidden').addClass('d-lg-flex');
            }else{
                $('.addweek1').removeClass('hidden').addClass('row');  
                $('.addweek2').removeClass('hidden').addClass('row');                
                $('.addweek3').removeClass('hidden').addClass('row');
                $('.addweek4').removeClass('hidden').addClass('row');
                $('.week2').removeClass('hidden').addClass('d-lg-flex');
                $('.week3').removeClass('hidden').addClass('d-lg-flex');
                $('.week4').removeClass('hidden').addClass('d-lg-flex');
            }
        });
        $('#textchange').change(function(){
            var textchange = $(this).val();
            if(textchange == 1){
                $('.mon').text('1');
                $('.tue').text('2');
                $('.wed').text('3');
                $('.thu').text('4');
                $('.fri').text('5');
                $('.sat').text('6');
                $('.sun').text('7');
            }
            else if(textchange == 2){
                $('.mon').text('Mon');
                $('.tue').text('Tue');
                $('.wed').text('Wed');
                $('.thu').text('Thu');
                $('.fri').text('Fri');
                $('.sat').text('Sat');
                $('.sun').text('Sun');
            }
            else if(textchange == 3){
                $('.mon').text('Sun');
                $('.tue').text('Mon');
                $('.wed').text('Tue');
                $('.thu').text('Wed');
                $('.fri').text('Thu');
                $('.sat').text('Fri');
                $('.sun').text('Sat');
            }
            else if(textchange == 4){
                $('.mon').text('M');
                $('.tue').text('T');
                $('.wed').text('W');
                $('.thu').text('T');
                $('.fri').text('F');
                $('.sat').text('S');
                $('.sun').text('S');
            }
            else if(textchange == 5){
                $('.mon').text('Mo');
                $('.tue').text('Tu');
                $('.wed').text('We');
                $('.thu').text('Th');
                $('.fri').text('Fr');
                $('.sat').text('Sa');
                $('.sun').text('Su');
            }
        });
        $('#lunch').click(function(){
            if($(this).is(":checked")) {
		        $(".lunch1").hide();
		        $(".lunch2").hide();
		        $(".tlunch1").addClass('hidden').removeClass('d-flex');
		        $(".tlunch2").addClass('hidden').removeClass('d-flex');
		        $(".r1_lunch1").addClass('hidden').removeClass('d-md-flex');
		        $(".r1_lunch2").addClass('hidden').removeClass('d-md-flex');
		    }
        });
        $('#lunch1').click(function(){
            if($(this).is(":checked")) {
		        $(".lunch1").show();
		        $(".lunch2").hide();
                $(".tlunch1").addClass('d-flex').removeClass('hidden');
		        $(".tlunch2").addClass('hidden').removeClass('d-flex');
                $(".r1_lunch1").addClass('d-md-flex').removeClass('hidden');
		        $(".r1_lunch2").addClass('hidden').removeClass('d-md-flex');
		    }
        });
        $('#lunch2').click(function(){
            if($(this).is(":checked")) {
		        $(".lunch1").show();
		        $(".lunch2").show();
                $(".tlunch1").addClass('d-flex').removeClass('hidden');
		        $(".tlunch2").addClass('d-flex').removeClass('hidden');
                $(".r1_lunch1").addClass('d-md-flex').removeClass('hidden');
		        $(".r1_lunch2").addClass('d-md-flex').removeClass('hidden');
		    }
        });
        $('#format').change(function(){
            var format = $(this).val();
            if(format == 1){
                $('.display_none').hide();
                $('.12h').show();
                $('.24h').hide();
                $('.time').addClass('d-inline-flex').removeClass('hidden');
                    $('#lunch').click(function(){
                        if($(this).is(":checked")) {
                            $(".lunch1").hide();
                            $(".lunch2").hide();
                            $(".tlunch1").addClass('hidden').removeClass('d-flex');
                            $(".tlunch2").addClass('hidden').removeClass('d-flex');
                            $(".24h").hide();
                            $(".24lh2").hide();
                            $(".r1_lunch1").addClass('hidden').removeClass('d-md-flex');
		                    $(".r1_lunch2").addClass('hidden').removeClass('d-md-flex');
                        }
                    });
                    $('#lunch1').click(function(){
                        if($(this).is(":checked")) {
                            $(".lunch1").show();
                            $(".lunch2").hide();
                            $(".tlunch1").addClass('d-flex').removeClass('hidden');
                            $(".tlunch2").addClass('hidden').removeClass('d-flex');
                            $(".24h").hide();
                            $(".24lh2").hide();
                            $(".r1_lunch1").addClass('d-md-flex').removeClass('hidden');
		                    $(".r1_lunch2").addClass('hidden').removeClass('d-md-flex');
                        }
                    });
                    $('#lunch2').click(function(){
                        if($(this).is(":checked")) {
                            $(".lunch1").show();
                            $(".lunch2").show();
                            $(".tlunch1").addClass('d-flex').removeClass('hidden');
                            $(".tlunch2").addClass('d-flex').removeClass('hidden');
                            $(".24h").hide();
                            $(".24lh2").hide();
                            $(".r1_lunch1").addClass('d-md-flex').removeClass('hidden');
		                    $(".r1_lunch2").addClass('d-md-flex').removeClass('hidden');
                        }
                    });
            }else{
                    $('.12h').hide();
                    $('.24h').show();
                    $('.display_none').show();  
                    $('.time').addClass('hidden').removeClass('d-inline-flex');
                    $('#lunch').click(function(){
                        if($(this).is(":checked")) {
                            $(".lunch1").hide();
                            $(".lunch2").hide();
                            $(".tlunch1").addClass('hidden').removeClass('d-flex');
                            $(".tlunch2").addClass('hidden').removeClass('d-flex');
                            $(".24h").hide();
                            $(".24lh2").hide();
                            $(".r1_lunch1").addClass('hidden').removeClass('d-md-flex');
		                    $(".r1_lunch2").addClass('hidden').removeClass('d-md-flex');
                        }
                    });
                    $('#lunch1').click(function(){
                        if($(this).is(":checked")) {
                            $(".lunch1").hide();
                            $(".lunch2").hide();
                            $(".tlunch1").addClass('hidden').removeClass('d-flex');
                            $(".tlunch2").addClass('hidden').removeClass('d-flex');
                            $(".24h").show();
                            $(".24lh2").hide();
                            $(".r1_lunch1").addClass('d-md-flex').removeClass('hidden');
		                    $(".r1_lunch2").addClass('hidden').removeClass('d-md-flex');
                        }
                    });
                    $('#lunch2').click(function(){
                        if($(this).is(":checked")) {
                            $(".lunch1").hide();
                            $(".lunch2").hide();
                            $(".tlunch1").addClass('hidden').removeClass('d-flex');
                            $(".tlunch2").addClass('hidden').removeClass('d-flex');
                            $(".24h").show();
                            $(".24lh2").show();
                            $(".r1_lunch1").addClass('d-md-flex').removeClass('hidden');
		                    $(".r1_lunch2").addClass('d-md-flex').removeClass('hidden');
                        }
                    });
                }
        });
        $('#hidedays').change(function(){
            var hidedays = $(this).val();
            if(hidedays == 1){
                $('.row1').show();
                $('.row2').hide();
                $('.row3').hide();
                $('.row4').hide();
                $('.row5').hide();
                $('.row6').hide();
                $('.row7').hide();
            }
            else if(hidedays == 2){
                $('.row1').show();
                $('.row2').show();
                $('.row3').hide();
                $('.row4').hide();
                $('.row5').hide();
                $('.row6').hide();
                $('.row7').hide();
            }
            else if(hidedays == 3){
                $('.row1').show();
                $('.row2').show();
                $('.row3').show();
                $('.row4').hide();
                $('.row5').hide();
                $('.row6').hide();
                $('.row7').hide();
            }
            else if(hidedays == 4){
                $('.row1').show();
                $('.row2').show();
                $('.row3').show();
                $('.row4').show();
                $('.row5').hide();
                $('.row6').hide();
                $('.row7').hide();
            }
            else if(hidedays == 5){
                $('.row1').show();
                $('.row2').show();
                $('.row3').show();
                $('.row4').show();
                $('.row5').show();
                $('.row6').hide();
                $('.row7').hide();
            }
            else if(hidedays == 6){
                $('.row1').show();
                $('.row2').show();
                $('.row3').show();
                $('.row4').show();
                $('.row5').show();
                $('.row6').show();
                $('.row7').hide();
            }
            else if(hidedays == 7){
                $('.row1').show();
                $('.row2').show();
                $('.row3').show();
                $('.row4').show();
                $('.row5').show();
                $('.row6').show();
                $('.row7').show();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

@endpush
