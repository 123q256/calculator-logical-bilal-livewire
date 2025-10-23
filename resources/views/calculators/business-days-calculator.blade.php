@if(app()->getLocale() !== "en")
    <form class="row position-relative" action="{{ url()->current() }}/" method="POST">
        @csrf
                @php $request = request(); @endphp
                <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="col-lg-10 mx-auto">
                        <div class="row align-items-center bg-tabs border-blue font-s-12 text-center border radius-10 px-1">
                            <div class="col-md-4 py-1 px-2">
                                <div class="bg-white px-3 py-2 cursor-pointer radius-5 pacetab {{ isset($request->dateTypes) && $request->dateTypes === 'date_duration' ? 'tagsUnit':'' }}" id="date_cal">{{$lang['n1']}}</div>
                            </div>
                            <div class="col-md-4 py-1 px-2">
                                <div class="bg-white px-3 py-2 cursor-pointer radius-5 pacetab {{ isset($request->dateTypes) && $request->dateTypes === 'date_calculator' ? 'tagsUnit':'' }}" id="time_cal">
                                {{$lang['n2']}}
                                </div>
                            </div>
                            <div class="col-md-4 py-1 px-2">
                                <div class="bg-white px-3 py-2 cursor-pointer radius-5 pacetab {{ isset($request->dateTypes) && $request->dateTypes !== 'business_days' ? '':'tagsUnit' }}" id="business">{{$lang['n3']}}</div>
                            </div>
                            <input type="hidden" name="dateTypes" value="{{ isset($request->dateTypes) ? $request->dateTypes:'business_days' }}" id="dateTypes">
                        </div>
                    </div>
                    <div class="col-12 {{ isset($request->dateTypes) && $request->dateTypes === 'date_duration' ? '':'hidden' }}" id="date_duration">
                        <div class="row">
                            <div class="col-12 mt-4">
                                <label for="s_date_duration" class="font-s-14 text-blue">{{$lang['n6']}}:</label>
                                <div class="w-100 py-2">                                  
                                    <input type="date" step="any" name="s_date_duration" id="s_date_duration" class="input" aria-label="input"
                                    value="{{ isset(request()->s_date_duration) ? request()->s_date_duration : date('Y-m-d') }}"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="e_date_duration" class="font-s-14 text-blue">{{$lang['n8']}}:</label>
                                <div class="w-100 py-2">                                  
                                    <input type="date" step="any" name="e_date_duration" id="e_date_duration" class="input" aria-label="input"
                                    value="{{ isset(request()->e_date_duration) ? request()->e_date_duration : date('Y-m-d') }}"/>
                                </div>
                            </div>
                            <div class="col-12">                               
                                <input type="checkbox" name="checkbox_duration" id="checkbox_duration" {{ isset(request()->checkbox_duration) && request()->checkbox_duration != 'checked'  ? 'checked' :'' }}
                                value="{{ isset(request()->checkbox_duration) ? request()->checkbox_duration : date('Y-m-d') }}"/>
                                <label for="checkbox_duration" class="font-s-14 text-blue">{{$lang['n9']}}:</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 {{ isset($request->dateTypes) && $request->dateTypes === 'date_calculator' ? '':'hidden' }}" id="date_calculator">
                        <div class="row">
                            <div class="col-lg-6 col-12 mt-4 pe-lg-4">
                                <label for="add_date_date" class="font-s-14 text-blue">{{$lang['n6']}}:</label>
                                <div class="w-100 py-2">                                  
                                    <input type="date" step="any" name="add_date_date" id="add_date_date" class="input" aria-label="input"
                                    value="{{ isset(request()->add_date_date) ? request()->add_date_date : date('Y-m-d') }}"/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 mt-4 ps-lg-4">
                                <label for="date_method" class="font-s-14 text-blue"> <?= $lang['n19'] ?> / {{$lang['n20']}}:</label>
                                <div class="w-100 py-2">                                  
                                <select name="date_method" id="date_method" class="input">
                                    <option value="add"><?= $lang['n19'] ?> (+)</option>
                                    <option value="sub"><?= $lang['n21'] ?> (-)</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 mt-2 pe-lg-4">
                                <div class="row">
                                    <div class="col-lg-6 pe-1">
                                        <label for="date_years" class="font-s-14 text-blue">{{$lang['n12']}}:</label>
                                        <div class="w-100 py-2">                                  
                                            <input type="number" step="any" name="date_years" id="date_years" class="input" aria-label="input"
                                            value="{{ isset(request()->date_years) ? request()->date_years : '' }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 ps-1">
                                        <label for="date_months" class="font-s-14 text-blue">{{$lang['n13']}}:</label>
                                        <div class="w-100 py-2">                                  
                                            <input type="number" step="any" name="date_months" id="date_months" class="input" aria-label="input"
                                            value="{{ isset(request()->date_months) ? request()->date_months : '' }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row inc_time {{ isset(request()->inctime) && request()->inctime !== 'time_in'  ? 'row' :'hidden' }}">
                                    <div class="col-lg col-12 px-2">
                                        <div class="w-100 py-2">                                  
                                            <input type="number" step="any" name="add_hrs_f" id="add_hrs_f" class="input" aria-label="input"
                                            value="{{ isset(request()->add_hrs_f) ? request()->add_hrs_f : ''}}" placeholder="HH"/>
                                        </div>
                                    </div>
                                    <div class="col-lg col-12 px-2">
                                        <div class="w-100 py-2">                                  
                                            <input type="number" step="any" name="add_min_f" id="add_min_f" class="input" aria-label="input"
                                            value="{{ isset(request()->add_min_f) ? request()->add_min_f : ''}}" placeholder="MM"/>
                                        </div>
                                    </div>
                                    <div class="col-lg col-12 px-2">
                                        <div class="w-100 py-2">                                  
                                            <input type="number" step="any" name="add_sec_f" id="add_sec_f" class="input" aria-label="input"
                                            value="{{ isset(request()->add_sec_f) ? request()->add_sec_f : ''}}" placeholder="SS"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 mt-2 ps-lg-4">
                                <div class="row">
                                    <div class="col-lg-6 pe-1">
                                        <label for="date_weeks" class="font-s-14 text-blue">{{$lang['n15']}}:</label>
                                        <div class="w-100 py-2">                                  
                                            <input type="number" step="any" name="date_weeks" id="date_weeks" class="input" aria-label="input"
                                            value="{{ isset(request()->date_weeks) ? request()->date_weeks : '' }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 ps-1">
                                        <label for="date_days" class="font-s-14 text-blue">{{$lang['n14']}}:</label>
                                        <div class="w-100 py-2">                                  
                                            <input type="number" step="any" name="date_days" id="date_days" class="input" aria-label="input"
                                            value="{{ isset(request()->date_days) ? request()->date_days : '' }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row inc_time {{ isset(request()->inctime) && request()->inctime !== 'time_in'  ? 'row' :'hidden' }}">
                                    <div class="col-lg col-12 px-2">
                                        <div class="w-100 py-2">                                  
                                            <input type="number" step="any" name="add_hrs_s" id="add_hrs_s" class="input" aria-label="input"
                                            value="{{ isset(request()->add_hrs_s) ? request()->add_hrs_s : ''}}" placeholder="HH"/>
                                        </div>
                                    </div>
                                    <div class="col-lg col-12 px-2">
                                        <div class="w-100 py-2">                                  
                                            <input type="number" step="any" name="add_min_s" id="add_min_s" class="input" aria-label="input"
                                            value="{{ isset(request()->add_min_s) ? request()->add_min_s : ''}}" placeholder="MM"/>
                                        </div>
                                    </div>
                                    <div class="col-lg col-12 px-2">
                                        <div class="w-100 py-2">                                  
                                            <input type="number" step="any" name="add_sec_s" id="add_sec_s" class="input" aria-label="input"
                                            value="{{ isset(request()->add_sec_s) ? request()->add_sec_s : ''}}" placeholder="SS"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 checkinput pe-lg-4 {{ isset(request()->checkbox) && request()->checkbox !== 'checked'  ? 'd-block' :'hidden' }}">                               
                                <label for="repeat" class="font-s-14 text-blue">{{$lang['n22'] }}:</label>
                                <div class="w-100 py-2">
                                    <input type="number" name="repeat" id="repeat" class="input" {{ isset(request()->repeat) && request()->repeat != 'checked'  ? 'checked' :'' }}    
                                    value="{{ isset(request()->repeat) ? request()->repeat : '' }}"/>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="col-6">                               
                                    <input type="checkbox" name="checkbox" id="checkbox" {{ isset(request()->checkbox) && request()->checkbox != 'checked'  ? 'checked' :'' }}
                                    value="{{ isset(request()->checkbox) ? request()->checkbox : date('Y-m-d') }}"/>
                                    <label for="checkbox" class="font-s-14 text-blue">{{$lang['n23'] }}:</label>
                                </div>
                                <div class="col-6 text-end">                               
                                    <p class="font-s-14 text-blue cursor-pointer text-decoration-underline" id="inctime">
                                        @if (isset(request()->inctime) && request()->inctime != 'time_in')
                                            {{$lang['n24'] }}
                                        @else
                                            {{$lang['n25'] }}
                                        @endif
                                    </p>
                                    <input type="hidden" name="inctime" value="time_in" id="incnametime"> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 {{ isset($request->dateTypes) && $request->dateTypes !== 'business_days' ? 'hidden':'' }}" id="business_days">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="col-lg-6 mx-auto bg-white radius-10">
                                    <div class="row align-items-center bg-white text-center border radius-10 p-1">
                                        <p class="col-6 py-1 cursor-pointer radius-5 tab {{ isset($request->sim_adv) && $request->sim_adv !== 'simple' ? '':'tagsUnit' }}" data-value="simp_cal" id="simp_cal">{{$lang['n27']}}</p>
                                        <p class="col-6 py-1 cursor-pointer radius-5 tab {{ isset($request->sim_adv) && $request->sim_adv !== 'simple' ? 'tagsUnit':'' }}" data-value="adv_cal" id="adv_cal">{{$lang['n28']}}</p>
                                        <input type="hidden" name="sim_adv" value="{{ isset($request->sim_adv) ? $request->sim_adv:'simple' }}" id="sim_adv">
                                    </div>
                                </div>
                            </div>
                            <div class="simple  {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'hidden' :'d-block' }}">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mt-lg-4 mt-2 pe-lg-4">
                                        <label for="s_date" class="font-s-14 text-blue">{{$lang['n6']}}:</label>
                                        <div class="w-100 py-2">                                  
                                            <input type="date" step="any" name="s_date" id="s_date" class="input" aria-label="input"
                                            value="{{ isset(request()->s_date) ? request()->s_date : date('Y-m-d') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mt-lg-4 mt-2 ps-lg-4">
                                        <label for="e_date" class="font-s-14 text-blue">{{$lang['n6']}}:</label>
                                        <div class="w-100 py-2">                                  
                                            <input type="date" step="any" name="e_date" id="e_date" class="input" aria-label="input"
                                            value="{{ isset(request()->e_date) ? request()->e_date : date('Y-m-d') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-6">                               
                                        <input type="checkbox" name="end_inc" id="end_inc" {{ isset(request()->end_inc) && request()->end_inc != 'checked'  ? 'checked' :'' }}/>
                                        <label for="end_inc" class="font-s-14 text-blue">{{$lang['n29'] }}:</label>
                                    </div>
                                    <div class="col-6 ps-lg-4">                               
                                        <input type="checkbox" name="sat_inc" id="sat_inc" {{ isset(request()->sat_inc) && request()->sat_inc != 'checked'  ? 'checked' :'' }}/>
                                        <label for="sat_inc" class="font-s-14 text-blue">{{$lang['n30'] }}?</label>
                                    </div>
                                    <p class="mt-2 font-s-14">{{$lang['n31']}}</p>
                                    <div class="col-6 mt-2">
                                        <input type="radio" name="holiday_c" id="bedtime" value="no" checked {{ isset($_POST['holiday_c']) && $_POST['holiday_c'] === 'no' ? 'checked' : '' }}>
                                        <label for="bedtime" class="font-s-14 text-blue pe-lg-3 pe-2">{!! $lang['n32'] !!}:</label>
                                    </div>
                                    <div class="col-6 mt-2 ps-lg-4">
                                        <input type="radio" name="holiday_c" id="wkup" value="yes" {{ isset($_POST['holiday_c']) && $_POST['holiday_c'] === 'yes' ? 'checked' : '' }}>
                                        <label for="wkup" class="font-s-14 text-blue">{!! $lang['n33'] !!}:</label>
                                    </div>
                                    <div class="holiday my-3  {{ isset($_POST['holiday_c']) && $_POST['holiday_c'] === 'yes' ? 'd-block' : 'hidden' }}">
                                        <div class="d-lg-flex">
                                            <div class="col-lg-6">
                                                <label class="d-block">
                                                    <input name="nyd" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">New Year's Day</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="mlkd" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">M. L. King Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="psd" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">President's Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="memd" type="checkbox" class="filled-in" />
                                                    <span class="black-text">Memorial Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="ind" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">Independence Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="labd" type="checkbox" class="filled-in" />
                                                    <span class="black-text">Labor Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="cold" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">Columbus Day (US)</span>
                                                </label>
                                                
                                            </div>
                                            <div class="col-lg-6 ps-lg-4">
                                                <label class="d-block">
                                                    <input name="vetd" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">Veteran's Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="thankd" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">Thanksgiving (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="blkf" type="checkbox" class="filled-in" />
                                                    <span class="black-text">Black Friday (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="cheve" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">Christmas Eve</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="chirs" type="checkbox" class="filled-in" />
                                                    <span class="black-text">Christmas</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="nye" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">New Year's Eve</span>
                                                </label>
                                            </div>
                                        </div>
                                        <p class="fw-bold mb-3 mt-2">If not in the list, define the holidays below:</p>
                                        <div class="d-lg-flex">
                                            <div class="w-25 pe-lg-3">
                                                <label for="no">Holiday</label>
                                                <input type="text" class="input my-2" id="no" value="{{ isset(request()->n0) ? request()->n0 : '' }}" name="n0">
                                            </div>
                                            <div class="w-25 ">
                                                <label for="mo">Month</label>
                                                <select class="input my-2" id="mo" name="m0">
                                                    <option selected value>--</option>
                                                    <option value="01">Jan</option>
                                                    <option value="02">Feb</option>
                                                    <option value="03">Mar</option>
                                                    <option value="04">Apr</option>
                                                    <option value="05">May</option>
                                                    <option value="06">Jun</option>
                                                    <option value="07">Jul</option>
                                                    <option value="08">Aug</option>
                                                    <option value="09">Sep</option>
                                                    <option value="10">Oct</option>
                                                    <option value="11">Nov</option>
                                                    <option value="12">Dec</option>
                                                </select>
                                            </div>
                                            <div class="w-25 ps-lg-3">
                                                <label for="do">Day</label>
                                                <select class="input my-2" id="do" name="d0">
                                                    <option selected value>--</option>
                                                    <option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="total_i" value="0" id="total_i">
                                        <div class="add_holiday">
                                            
                                        </div>
                                        <div class="mt-3">
                                            <button type="button" class="tagsUnit p-2 border radius-5 cursor-pointer add_more">{{$lang['n34']}}</button>
                                        </div>
                                    </div>
                                    <p class="mt-2 font-s-14">{{$lang['n35']}}</p>
                                    <div class="col-lg-6 col-12 mt-2 pe-lg-4">
                                        <label for="ex_in" class="font-s-14 text-blue"> {{ $lang['n36'] }}:</label>
                                        <div class="w-100 py-2">
                                            <select name="ex_in" id="ex_in" class="input">
                                                <option value="1">{{$lang['n37']}}</option>
                                                <option value="2">{{$lang['n38']}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mt-2 ps-lg-4">
                                        <label for="satting" class="font-s-14 text-blue"> {{ $lang['39'] }}:</label>
                                        <div class="w-100 py-2">                                  
                                            <select name="satting" id="satting" class="input">
                                                <option value="2" id="second">{{$lang['n40']}}</option>
                                                <option value="4" id="four" disabled>{{$lang['n41']}}</option>
                                                <option value="5" id="five">{{$lang['n42']}}</option>
                                                <option value="6" id="six">{{$lang['n43']}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" {{ isset($_POST['satting']) && $_POST['satting'] === '6' ? 'd-block' : 'hidden' }}" id="select_days">
                                        <div class="row mt-3">
                                            <div class="col-lg-6">
                                                <label class="d-block">
                                                    <input name="sun" type="checkbox" class="filled-in" aria-label="input field">
                                                    <span class="black-text">{{$lang['n44']}}</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="mon" type="checkbox" class="filled-in" aria-label="input field">
                                                    <span class="black-text">{{$lang['n45']}}</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="tue" type="checkbox" class="filled-in" aria-label="input field">
                                                    <span class="black-text">{{$lang['n36']}}</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="wed" type="checkbox" class="filled-in" aria-label="input field">
                                                    <span class="black-text">{{$lang['n37']}}</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-6 ps-lg-4">
                                                <label class="d-block">
                                                    <input name="thu" type="checkbox" class="filled-in" aria-label="input field">
                                                    <span class="black-text">{{$lang['n38']}}</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="fri" type="checkbox" class="filled-in" aria-label="input field">
                                                    <span class="black-text">{{$lang['n39']}}</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="sat" type="checkbox" class="filled-in" aria-label="input field">
                                                    <span class="black-text">{{$lang['n40']}}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- advance --}}
                            <div class="advance  {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'd-block' :'hidden' }}">
                                <div class="row">
                                    <div class="col-lg-6 col-12 mt-4 pe-lg-4">
                                        <label for="add_date" class="font-s-14 text-blue">{{$lang['n6']}}:</label>
                                        <div class="w-100 py-2">                                  
                                            <input type="date" step="any" name="add_date" id="add_date" class="input" aria-label="input"
                                            value="{{ isset(request()->add_date) ? request()->add_date : date('Y-m-d') }}"/>
                                        </div>
                                    </div> 
                                    <div class="col-lg-6 col-12 mt-4 ps-lg-4">
                                        <label for="method" class="font-s-14 text-blue"> {{ $lang['n19'] }} / {{$lang['n20']}}:</label>
                                        <div class="w-100 py-2">                                  
                                            <select name="method" id="method" class="input">
                                            <option value="+">{{ $lang['n19'] }} (+)</option>
                                            <option value="-">{{ $lang['n21'] }} (-)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-12 pe-2 inthree ">
                                            <label for="years" class="font-s-14 text-blue">{{$lang['n46']}}:</label>
                                            <div class="w-100 py-2">                                  
                                                <input type="number" min="1" name="years" id="years" class="input" aria-label="input"
                                                value="{{ isset(request()->years) ? request()->years : ''}}"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-12 px-2 inthree">
                                            <label for="months" class="font-s-14 text-blue">{{$lang['n47']}}:</label>
                                            <div class="w-100 py-2">                                  
                                                <input type="number" min="1" name="months" id="months" class="input" aria-label="input"
                                                value="{{ isset(request()->months) ? request()->months : ''}}"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-12 px-2 inthree">
                                            <label for="weeks" class="font-s-14 text-blue">{{$lang['n48']}}:</label>
                                            <div class="w-100 py-2">                                  
                                                <input type="number" min="1" name="weeks" id="weeks" class="input" aria-label="input"
                                                value="{{ isset(request()->weeks) ? request()->weeks : ''}}"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-12 ps-2">
                                            <label for="days" class="font-s-14 text-blue">{{$lang['n14']}}:</label>
                                            <div class="w-100 py-2">                                  
                                                <input type="number" min="1" name="days" id="days" class="input" aria-label="input"
                                                value="{{ isset(request()->days) ? request()->days : ''}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">                               
                                        <input type="checkbox" name="cal_bus" id="cal_bus" {{ isset(request()->cal_bus) && request()->cal_bus != 'checked'  ? 'checked' :'' }}/>
                                        <label for="cal_bus" class="font-s-14 text-blue">{{$lang['n49'] }}</label>
                                    </div>
                                    <div class=" checkrow {{ isset(request()->cal_bus) && request()->cal_bus === 'checked'  ? 'row' :'hidden' }}">
                                        <p class="mt-2 font-s-14">{{$lang['n50']}}</p>
                                        <div class="col-6 mt-2">
                                            <input type="radio" name="weekend_c" id="weekr" value="no" {{ isset($_POST['weekend_c']) && $_POST['weekend_c'] === 'no' ? 'checked' : '' }}>
                                            <label for="weekr" class="font-s-14 text-blue">{!! $lang['n51'] !!}:</label>
                                        </div>
                                        <div class="col-6 mt-2 ps-lg-4">
                                            <input type="radio" name="weekend_c" id="weekr2" value="yes" {{ isset($_POST['weekend_c']) && $_POST['weekend_c'] === 'yes' ? 'checked' : '' }}>
                                            <label for="weekr2" class="font-s-14 text-blue">{!! $lang['n52'] !!}:</label>
                                        </div>
                                    </div>
                                    <div class="week my-3 {{ isset(request()->weekend_c) && request()->weekend_c === 'yes'  ? 'd-block' :'hidden' }}">
                                        <div class="d-lg-flex">
                                            <div class="col-lg-6">
                                                <label class="d-block">
                                                    <input name="nyd" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">New Year's Day</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="mlkd" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">M. L. King Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="psd" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">President's Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="memd" type="checkbox" class="filled-in" />
                                                    <span class="black-text">Memorial Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="ind" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">Independence Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="labd" type="checkbox" class="filled-in" />
                                                    <span class="black-text">Labor Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="cold" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">Columbus Day (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="vetd" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">Veteran's Day (US)</span>
                                                </label>
                                            </div>
                                            <div class="col-lg-6 ps-lg-4">
                                                <label class="d-block">
                                                    <input name="thankd" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">Thanksgiving (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="blkf" type="checkbox" class="filled-in" />
                                                    <span class="black-text">Black Friday (US)</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="cheve" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">Christmas Eve</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="chirs" type="checkbox" class="filled-in" />
                                                    <span class="black-text">Christmas</span>
                                                </label>
                                                <label class="d-block my-2">
                                                    <input name="nye" checked type="checkbox" class="filled-in" />
                                                    <span class="black-text">New Year's Eve</span>
                                                </label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="total_j" value="0" id="total_j">
                                        <p class="fw-bold my-2">{{(($lang=='en')?'If not in the list,':'')}} {{$lang['n53']}}</p>
                                        <div class="d-lg-flex">
                                            <div class="w-25 pe-lg-3">
                                                <label for="one">Holiday</label>
                                                <input type="text" class="input my-2" id="one" value="{{ isset(request()->n0) ? request()->n0 : '' }}" name="n[]">
                                            </div>
                                            <div class="w-25 ">
                                                <label for="three">Month</label>
                                                <select class="input my-2" id="three" name="m[]">
                                                    <option selected value>--</option>
                                                    <option value="01">Jan</option>
                                                    <option value="02">Feb</option>
                                                    <option value="03">Mar</option>
                                                    <option value="04">Apr</option>
                                                    <option value="05">May</option>
                                                    <option value="06">Jun</option>
                                                    <option value="07">Jul</option>
                                                    <option value="08">Aug</option>
                                                    <option value="09">Sep</option>
                                                    <option value="10">Oct</option>
                                                    <option value="11">Nov</option>
                                                    <option value="12">Dec</option>
                                                </select>
                                            </div>
                                            <div class="w-25 ps-lg-3">
                                                <label for="two">Day</label>
                                                <select class="input my-2" id="two" name="d[]">
                                                    <option selected value>--</option>
                                                    <option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="add_holidayW">
            
                                        </div>
                                        <div class="mt-3">
                                            <button type="button" class="px-3 py-2 radius-5 border tagsUnit add_moreW">{{$lang['n54']}}</button>
                                        </div>
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

        @isset($detail)
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 bg-[#F4F4F4] rounded-lg  space-y-6 result">
            <div class="">
                        @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                        @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mb-2">
                            @if($request->dateTypes === 'date_duration')
                                <div class="col-lg-8 font-s-18">
                                    <table class="w-100">
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{$lang['n10']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['from']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="60%" class="border-b py-2"><strong>{{$lang['n11']}} :</strong></td>
                                            <td class="border-b py-2">{{$detail['to']}}</td>
                                        </tr>
            
                                        <tr class="border_btm_tr">
                                            <td class="border-b py-2">
                                                {{$detail['years']}} {{ $lang['n12'] }} , {{$detail['months']}} {{ $lang['n13'] }} , {{$detail['days']}} {{ $lang['n14'] }}
                                            </td>
                                            <td class="border-b py-2">
                                                {{$detail['days']*24}} {{ $lang['n16'] }}
                                            </td>
                                        </tr>
                                        <tr class="border_btm_tr">
                                            <td class="border-b py-2">
                                                {{number_format(floor($detail['days']/7))}} {{ $lang['n15'] }}, {{number_format(floor($detail['days']%7))}} {{ $lang['n14'] }}
                                            </td>
                                            <td class="border-b py-2">
                                                {{$detail['days']*24*60}} {{ $lang['n17'] }}
                                            </td>
                                        </tr>
                                        <tr class="border_btm_none mbl_btm_bdr">
                                            <td class="border-b py-2">
                                                {{$detail['days']}} {{ $lang['n14'] }}
                                            </td>
                                            <td class="border-b py-2">
                                                {{$detail['days']*24*60*60}} {{ $lang['n18'] }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($request->dateTypes === 'date_calculator')
                                <div class="col-lg-8 font-s-18">
                                    <table class="w-100">
                                        <tr>
                                            @if ($detail['repeat'] > 1)
                                                <td class="border-b py-2"><strong><?= $lang['n26'] ?> 1 :</strong></td>
                                            @else
                                                <td class="border-b py-2"><strong><?= $lang['n26'] ?> :</strong></td>
                                            @endif
                                            <td class="border-b py-2">
                                                <?=$detail['ans'][0]?>
                                            </td>
                                        </tr>
                                        @if ($detail['repeat'] > 1)
                                            @php
                                                $new_array = array_slice($detail['ans'], 1);
                                                $i = 2;
                                            @endphp
                                            @foreach ($new_array as  $value)
                                                <tr>
                                                    <td class="border-b py-2"><strong><?= $lang['n26'] ?> <?= $i++; ?> :</strong></td>
                                                    <td class="border-b py-2">
                                                        <?= $value ?>
                                                    </td>
                                                </div>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                            @else
                                @if(isset($detail['count_days']))
                                    <div class="col-lg-8 font-s-18">
                                        <table class="w-100">
                                            <tr class="col">
                                                <td class="border-b py-2"><strong>{{$lang['n10']}}</strong></td>
                                                <td class="border-b py-2">
                                                    {{$detail['from']}}</td>
                                            </tr>
                                            <tr>
                                                <td class=" py-2"><strong>{{$lang['n11']}}</strong></td>
                                                <td class=" py-2">
                                                    {{$detail['to']}}</td>
                                            </tr>
                                        <tr>
                                            <td colspan="2" class="border-b py-2"> 
                                                {{$detail['getworkdays']  ['workdays']}} {{$lang['n14']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="border-b py-2">
                                                {{$lang['35']}} {{$detail['getworkdays']['workdays']*8}} {{$lang['n16']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="border-b py-2">
                                                {{$lang['35']}} {{$detail['getworkdays']['workdays']*8*60}} {{$lang['n17']}} 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="border-b py-2">
                                                {{$lang['35']}} {{$detail['getworkdays']['workdays']*8*60*60}} {{$lang['n18']}} 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2"><strong>{{$lang['n55']}}</strong></td>
                                        </tr>
                                        {{-- <div class="col-lg-8 font-s-18"> --}}
                                            {{-- <div class="col s12 m3"></div> --}}
                                                <tr>
                                                    <td class="border-b py-2">Total Days</td>
                                                    <td class="border-b py-2">{{$detail['t_days']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">Business Days</td>
                                                    <td class="border-b py-2">{{$detail['getworkdays']['workdays']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">Weekend Days</td>
                                                    <td class="border-b py-2">{{$detail['getworkdays']['weekend']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">Work Hours</td>
                                                    <td class="border-b py-2">{{$detail['getworkdays']['workdays'] * 8 }}h</td>
                                                </tr>
                                                @if($_POST['holiday_c']=='yes')
                                                    <tr>
                                                        <td class="border-b py-2">Holidays {{(($detail['getworkdays']['holidays']!=0)?"<span class='view_holi'>(View result)</span>":'')}}</td>
                                                        <td class="border-b py-2">{{$detail['getworkdays']['holidays']}}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    @if ($detail['t_days'] && $detail['ans2'])
                                                        <td class="border-b py-2">
                                                            <strong class="">{{$detail['t_days']}}</strong> Calendar Days – <strong class="">{{$detail['ans2']}}</strong> Skipped Days
                                                        </td>
                                                    @endif
                                                    @if (!empty($detail['weekends_days'])) 
                                                        <td class="border-b py-2">{{$detail['weekends_days']}} Weekend Days</td>
                                                    @endif
                                                    @if (!empty($detail['holi_days'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['holi_days']}}</strong> holidays</td>
                                                    @endif
                                                    @if (!empty($detail['sun_day'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['sun_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['mon_day']))
                                                        <td class="border-b py-2"><strong>{{$detail['mon_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['tue_day']))
                                                        <td class="border-b py-2"><strong>{{$detail['tue_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['wed_day'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['wed_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['thu_day'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['thu_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['fri_day'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['fri_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['sat_day'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['sat_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['res_days']))
                                                        <td class="border-b py-2" id="resu">Result: </td>
                                                        <td class="border-b py-2"> {{$detail['res_days']}} Days</td>
                                                    @endif
                                                </tr>
                                            {{-- </div> --}}
                                            @if($_POST['holiday_c']=='yes' && $detail['getworkdays']['holidays']!=0)
                                                {{-- <div class="col s12 margin_top_10 display_none holi_result"> --}}
                                                    <tr>
                                                        <td class="border-b py-2"><strong>{{$lang['n56']}} {{$detail['from']}} and {{$detail['to']}}</strong>
                                                        </td>
                                                    </tr>
                                                    {{-- <table class="table text-center w-75 mx-auto"> --}}
                                                @php $count=count($detail['getworkdays']['get_holi']); @endphp
                                                @for ($i=0; $i <$count ; $i++) 
                                                    <tr>
                                                        <td class="border-b py-2">{{$detail['getworkdays']['dis_holi'][$i]}}</td>
                                                        <td class="border-b py-2"><strong>{{$detail['getworkdays']['get_holi'][$i]}}</strong></td>
                                                    </tr>                                
                                                @endfor
                                                {{-- </table> --}}
                                                {{-- </div> --}}
                                            @endif
                                        </table>
                                    </div>
                                @else
                                    <div class="col-lg-8 font-s-18">
                                        <table class="w-100">
                                            @if(isset(request()->cal_bus))
                                                <tr>
                                                    <td colspan="2" width="60%" class="border-b py-2">{{$detail['date']}}</td>
                                                </tr>
                                                <tr>
                                                    @if($_POST['method']=='+')
                                                        <td colspan="2" class="border-b py-2">{{$lang['n57']}} {{$_POST['days']}} {{$lang['n58']}} {{$lang['n59']}} {{$detail['from']}} {{$lang['n60']}} {{$detail['from_s']}} {{$lang['n61']}} {{$detail['date_e']}}</td>
                                                    @else
                                                        <td colspan="2" class="border-b py-2">{{$lang['n57']}} {{$_POST['days']}} {{$lang['n58']}} before {{$detail['from']}} {{$lang['n60']}} {{$detail['date_e']}} {{$lang['n62']}} {{$detail['from_s']}} {{$lang['n61']}}</td>
                                                    @endif
                                                </tr>
                                                {{-- <div class="col s12">
                                                    <div class="col s12 m3"></div>
                                                    <table class="table text-center w-75 mx-auto"> --}}
                                                <tr>
                                                    <td class="border-b py-2">{{$lang['n58']}}</td>
                                                    <td class="border-b py-2">{{$_POST['days']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{$lang['n63']}}</td>
                                                    <td class="border-b py-2">{{$detail['weekends']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{$lang['n64']}} {{(($detail['holidays']!=0)?"<span class='view_holi'>(View result)</span>":'')}}</td>
                                                    <td class="border-b py-2">{{$detail['holidays']}}</td>
                                                </tr>
                                                    {{-- </table>
                                                </div> --}}
                                                @if($_POST['weekend_c']=='yes' && $detail['holidays']!=0)
                                                {{-- <div class="col s12 margin_top_10 display_none holi_result"> --}}
                                                    <tr>
                                                        <td class="border-b py-2"><strong>{{$lang['n56']}} {{$detail['from']}} {{$lang['n61']}} {{$detail['date']}}</strong></td>
                                                    </tr>
                                                    {{-- <table class="table text-center w-75 mx-auto"> --}}
                                                @php $count=count($detail['get_holi']); @endphp
                                                    @for ($i=0; $i <$count ; $i++)
                                                        <tr>
                                                            <td class="border-b py-2">{{$detail['dis_holi'][$i]}}</td>
                                                            <td class="border-b py-2">{{$detail['get_holi'][$i]}}</td>
                                                        </tr>
                                                    @endfor
                                                {{-- </table> --}}
                                                {{-- </div> --}}
                                                @endif
                                            @else
                                                <tr>
                                                <td width="60%" class="border-b py-2">{{$lang['n10']}}</td> 
                                                <td class="border-b py-2">{{$detail['from']}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="border-b py-2">{{$detail['des']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{$lang['n65']}}</td>
                                                    <td class="border-b py-2">{{$detail['date']}}</td>
                                                </td>
                                            @endif
                                        </table>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        @push('calculatorJS')
            <script>
                document.getElementById('date_cal').addEventListener('click', function() {
                    this.classList.add('tagsUnit');
                    document.getElementById('time_cal').classList.remove('tagsUnit');
                    document.getElementById('business').classList.remove('tagsUnit');
                    document.getElementById('dateTypes').value = "date_duration";
                    ['#date_duration'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#date_calculator', '#business_days'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                });
                document.getElementById('time_cal').addEventListener('click', function() {
                    this.classList.add('tagsUnit');
                    document.getElementById('date_cal').classList.remove('tagsUnit');
                    document.getElementById('business').classList.remove('tagsUnit');
                    document.getElementById('dateTypes').value = "date_calculator";
                    ['#date_calculator'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#date_duration', '#business_days'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                });
                document.getElementById('business').addEventListener('click', function() {
                    this.classList.add('tagsUnit');
                    document.getElementById('date_cal').classList.remove('tagsUnit');
                    document.getElementById('time_cal').classList.remove('tagsUnit');
                    document.getElementById('dateTypes').value = "business_days";
                    ['#business_days'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#date_duration', '#date_calculator'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                });
                var checkinput = document.querySelector('.checkinput');
                var inc_time = document.querySelectorAll('.inc_time');
                document.getElementById('inctime').addEventListener('click', function() {
                    var input = document.getElementById('incnametime');
                    if (input.value === 'time_in') {
                        input.value = 'time_out';
                        inc_time.forEach(element => {
                            element.classList.add("row");
                            element.classList.remove("hidden");
                        });
                        document.getElementById('inctime').innerHTML = "{{$lang['n24']}}";
                    } else {
                        input.value = 'time_in';
                        inc_time.forEach(element => {
                            element.classList.add("hidden");
                            element.classList.remove("row");
                        });
                        document.getElementById('inctime').innerHTML = "{{$lang['n25']}}";
                    }
                });
                document.getElementById('checkbox').addEventListener('click', function() {
                    var checkbox = document.getElementById('checkbox');
                    if (checkbox.checked) {
                        document.querySelector('.checkinput').style.display = "block";
                    } else {
                        document.querySelector('.checkinput').style.display = "none";
                    }
                });
                document.addEventListener('DOMContentLoaded', function() {
                    'use strict';
                    let i = 0;
                    function addChoti(i) {
                        const html = `
                        <div class="d-flex gap-3">
                            <div class="w-25 pe-lg-3">
                                <label for="n${i}">Holiday</label>
                                <input type="text" class="input my-2" id="n${i}" value="{{ isset(request()->n0) ? request()->n0 : '' }}" name="n${i}">
                            </div>
                            <div class="w-25 ">
                                <label for="m${i}">Month</label>
                                <select class="input my-2" id="m${i}" name="m${i}">
                                    <option selected value>--</option>
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04">Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                            </div>
                            <div class="w-25 ps-lg-3">
                                <label for="d${i}">Day</label>
                                <select class="input my-2" id="d${i}" name="d${i}">
                                    <option selected value>--</option>
                                    <option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                                </select>
                            </div>
                        </div>`;
                        
                        document.querySelector('.add_holiday').insertAdjacentHTML('beforeend', html);
                        document.getElementById('total_i').value = i;
                    }
                    document.querySelector('.add_more').addEventListener('click', function() {
                        i++;
                        addChoti(i);
                    });
                });
                document.addEventListener('DOMContentLoaded', function() {
                    'use strict';
                    let j = 0;
                    function add_chotiW(j) {
                        const html = `
                        <div class="d-lg-flex gap-3">
                            <div class="w-25 pe-lg-3">
                                <label for="n${j}">Holiday</label>
                                <input type="text" class="input my-2" id="n${j}" value="{{ isset(request()->n0) ? request()->n0 : '' }}" name="n${j}">
                            </div>
                            <div class="w-25 ">
                                <label for="m${j}">Month</label>
                                <select class="input my-2" id="m${j}" name="m${j}">
                                    <option selected value>--</option>
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04">Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                            </div>
                            <div class="w-25 ps-lg-3">
                                <label for="d${j}">Day</label>
                                <select class="input my-2" id="d${j}" name="d${j}">
                                    <option selected value>--</option>
                                    <option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                                </select>
                            </div>
                        </div>`;
                        
                        document.querySelector('.add_holidayW').insertAdjacentHTML('beforeend', html);
                        document.getElementById('total_j').value = j;

                    }
                    document.querySelector('.add_moreW').addEventListener('click', function() {
                        j++;
                        add_chotiW(j);
                    });
                });
                document.getElementById('simp_cal').addEventListener('click', function() {
                    this.classList.add('tagsUnit');
                    document.getElementById('adv_cal').classList.remove('tagsUnit');
                    document.getElementById('sim_adv').value = "simple";
                    document.querySelectorAll('.simple').forEach(element => {
                        element.style.display = "block";
                    });
                    document.querySelectorAll('.advance').forEach(element => {
                        element.style.display = "none";
                    });
                });
                document.getElementById('cal_bus').addEventListener('click', function() {
                    var checkbox = document.getElementById('cal_bus');
                    if (checkbox.checked) {
                        document.querySelector('.checkrow').classList.add('row');
                        document.querySelector('.checkrow').classList.remove('hidden');
                        document.querySelectorAll('.inthree').forEach(element => {
                            element.style.display = "none"
                        });
                    } else {
                        document.querySelector('.checkrow').classList.add('hidden');  
                        document.querySelector('.checkrow').classList.remove('row');
                        document.querySelectorAll('.inthree').forEach(element => {
                            element.style.display = "block";
                        });  
                    }
                });
                document.getElementById('weekr').addEventListener('click', function() {
                    var bedtime = document.getElementById('weekr');
                    if(bedtime.checked) {
                        document.querySelector('.week').style.display = "none";
                    }
                });
                document.getElementById('weekr2').addEventListener('click', function() {
                    var bedtime = document.getElementById('weekr2');
                    if(bedtime.checked) {
                        document.querySelector('.week').style.display = "block";
                    }
                });
                document.getElementById('adv_cal').addEventListener('click', function() {
                    this.classList.add('tagsUnit');
                    document.getElementById('simp_cal').classList.remove('tagsUnit');
                    document.getElementById('sim_adv').value = "advance";
                    document.querySelectorAll('.simple').forEach(element => {
                        element.style.display = "none";
                    });
                    document.querySelectorAll('.advance').forEach(element => {
                        element.style.display = "block";
                    });
                });
                document.getElementById('wkup').addEventListener('click', function() {
                    var wkup = document.getElementById('wkup');
                    if (wkup.checked) {
                        document.querySelector('.holiday').style.display = "block";
                    }
                });
                document.getElementById('satting').addEventListener('change', function() {
                    var wkup = this.value;
                    if (wkup === '6') {
                        document.getElementById('select_days').classList.add('d-block');
                        document.getElementById('select_days').classList.remove('hidden');
                    }else{
                        document.getElementById('select_days').classList.add('hidden');
                        document.getElementById('select_days').classList.remove('d-block');
                    }
                });
                document.getElementById('bedtime').addEventListener('click', function() {
                    var bedtime = document.getElementById('bedtime');
                    if(bedtime.checked) {
                        document.querySelector('.holiday').style.display = "none";
                    }
                });
            </script>
        @endpush
    </form>
@else
    <form class="row position-relative" action="{{ url()->current() }}/" method="POST">
        @csrf
        @if(!isset($detail))
        
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 bg-[#1670a712] rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                <input type="hidden" name="sim_adv" value="{{ isset(request()->sim_adv) ? request()->sim_adv : 'simple' }}" id="sim_adv">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  pacetab {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? '' :'tagsUnit' }}" id="simp_cal">
                                {{ $lang['50'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'tagsUnit' :'' }}" id="adv_cal">
                                {{ $lang['51'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">

                <div class="grid grid-cols-1   gap-4 simple  {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'hidden' :'d-block' }} ">
                  <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="s_date" class="font-s-14 text-blue">{{$lang['2']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="date" step="any" name="s_date" id="s_date" class="input" aria-label="input"
                                value="{{ isset(request()->s_date) ? request()->s_date : date('Y-m-d') }}"/>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="e_date" class="font-s-14 text-blue">{{$lang['2']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="date" step="any" name="e_date" id="e_date" class="input" aria-label="input"
                                value="{{ isset(request()->e_date) ? request()->e_date : date('Y-m-d') }}"/>
                            </div>
                        </div>
                  </div>
                    <div class="col-6">                               
                        <input type="checkbox" name="end_inc" id="end_inc" {{ isset(request()->end_inc) && request()->end_inc != 'checked'  ? 'checked' :'' }}/>
                        <label for="end_inc" class="font-s-14 text-blue">{{$lang[4] }}:</label>
                    </div>
                    <div class="col-6 ps-lg-4">                               
                        <input type="checkbox" name="sat_inc" id="sat_inc" {{ isset(request()->sat_inc) && request()->sat_inc != 'checked'  ? 'checked' :'' }}/>
                        <label for="sat_inc" class="font-s-14 text-blue">{{$lang[5] }}?</label>
                    </div>
                    <p class="mt-2 font-s-14">{{$lang['6']}}</p>
                    <div class="col-6 mt-2">
                        <input type="radio" name="holiday_c" id="bedtime" value="no" checked {{ isset($_POST['holiday_c']) && $_POST['holiday_c'] === 'no' ? 'checked' : '' }}>
                        <label for="bedtime" class="font-s-14 text-blue pe-lg-3 pe-2">{!! $lang['7'] !!}:</label>
                    </div>
                    <div class="col-6 mt-2 ps-lg-4">
                        <input type="radio" name="holiday_c" id="wkup" value="yes" {{ isset($_POST['holiday_c']) && $_POST['holiday_c'] === 'yes' ? 'checked' : '' }}>
                        <label for="wkup" class="font-s-14 text-blue">{!! $lang['8'] !!}:</label>
                    </div>
                    <div class="holiday my-3  {{ isset($_POST['holiday_c']) && $_POST['holiday_c'] === 'yes' ? 'd-block' : 'hidden' }}">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <div class="space-y-2">
                                <label class="d-block">
                                    <input name="nyd" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">New Year's Day</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="mlkd" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">M. L. King Day (US)</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="psd" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">President's Day (US)</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="memd" type="checkbox" class="filled-in" />
                                    <span class="black-text">Memorial Day (US)</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="ind" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">Independence Day (US)</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="labd" type="checkbox" class="filled-in" />
                                    <span class="black-text">Labor Day (US)</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="cold" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">Columbus Day (US)</span>
                                </label>
                                </div>
                                
                            </div>
                            <div class="space-y-2">
                                <div class="space-y-2">
                                <label class="d-block">
                                    <input name="vetd" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">Veteran's Day (US)</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="thankd" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">Thanksgiving (US)</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="blkf" type="checkbox" class="filled-in" />
                                    <span class="black-text">Black Friday (US)</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="cheve" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">Christmas Eve</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="chirs" type="checkbox" class="filled-in" />
                                    <span class="black-text">Christmas</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="nye" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">New Year's Eve</span>
                                </label>
                                </div>
                            </div>
                        </div>
                        <p class="fw-bold mb-3 mt-2">If not in the list, define the holidays below:</p>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="space-y-2">
                                <label for="no">Holiday</label>
                                <input type="text" class="input my-2" id="no" value="{{ isset(request()->n0) ? request()->n0 : '' }}" name="n0">
                            </div>
                            <div class="space-y-2">
                                <label for="mo">Month</label>
                                <select class="input my-2" id="mo" name="m0">
                                    <option selected value>--</option>
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04">Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label for="do">Day</label>
                                <select class="input my-2" id="do" name="d0">
                                    <option selected value>--</option>
                                    <option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="total_i" value="0" id="total_i">
                        <div class="add_holiday">
                            
                        </div>
                        <div class="mt-3">
                            <button type="button" class="tagsUnit p-2 border radius-5 cursor-pointer add_more">{{$lang['11']}}</button>
                        </div>
                    </div>
                    <p class="mt-2 font-s-14">{{$lang['9']}}</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="ex_in" class="font-s-14 text-blue"> {{ $lang[42] }}:</label>
                            <div class="w-100 py-2">
                                <select name="ex_in" id="ex_in" class="input">
                                    <option value="1">{{$lang[43]}}</option>
                                    <option value="2">{{$lang[44]}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="satting" class="font-s-14 text-blue"> {{ $lang[45] }}:</label>
                            <div class="w-100 py-2">                                  
                                <select name="satting" id="satting" class="input">
                                    <option value="2" id="second">{{$lang[46]}}</option>
                                    <option value="4" id="four" disabled>{{$lang[47]}}</option>
                                    <option value="5" id="five">{{$lang[48]}}</option>
                                    <option value="6" id="six">{{$lang[49]}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" {{ isset($_POST['satting']) && $_POST['satting'] === '6' ? 'd-block' : 'hidden' }}" id="select_days">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <div class="space-y-2">
                                <label class="d-block">
                                    <input name="sun" type="checkbox" class="filled-in" aria-label="input field">
                                    <span class="black-text">{{$lang['18']}}</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="mon" type="checkbox" class="filled-in" aria-label="input field">
                                    <span class="black-text">{{$lang['41']}}</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="tue" type="checkbox" class="filled-in" aria-label="input field">
                                    <span class="black-text">{{$lang['42']}}</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="wed" type="checkbox" class="filled-in" aria-label="input field">
                                    <span class="black-text">{{$lang['43']}}</span>
                                </label>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="space-y-2">
                                <label class="d-block">
                                    <input name="thu" type="checkbox" class="filled-in" aria-label="input field">
                                    <span class="black-text">{{$lang['44']}}</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="fri" type="checkbox" class="filled-in" aria-label="input field">
                                    <span class="black-text">{{$lang['45']}}</span>
                                </label>
                                </div>
                                <div class="space-y-2">
                                <label class="d-block my-2">
                                    <input name="sat" type="checkbox" class="filled-in" aria-label="input field">
                                    <span class="black-text">{{$lang['46']}}</span>
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- advance --}}
                <div class=" grid grid-cols-1  advance  gap-4 {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'd-block' :'hidden' }}">
                   <div class=" grid grid-cols-2 gap-4 lg:grid-cols-2 md:grid-cols-2">
                        <div class="col-lg-6 col-12 mt-4 pe-lg-4">
                            <label for="add_date" class="font-s-14 text-blue">{{$lang['2']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="date" step="any" name="add_date" id="add_date" class="input" aria-label="input"
                                value="{{ isset(request()->add_date) ? request()->add_date : date('Y-m-d') }}"/>
                            </div>
                        </div> 
                        <div class="col-lg-6 col-12 mt-4 ps-lg-4">
                            <label for="method" class="font-s-14 text-blue"> {{ $lang['13'] }} / {{$lang['14']}}:</label>
                            <div class="w-100 py-2">                                  
                                <select name="method" id="method" class="input">
                                <option value="+">Add (+)</option>
                                <option value="-">Subtract (-)</option>
                                </select>
                            </div>
                        </div>
                   </div>
                     <div class=" grid grid-cols-4 gap-4 ">
                        <div class="space-y-2 inthree ">
                            <label for="years" class="font-s-14 text-blue">{{$lang['32']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="number" min="1" name="years" id="years" class="input" aria-label="input"
                                value="{{ isset(request()->years) ? request()->years : ''}}"/>
                            </div>
                        </div>
                        <div class="space-y-2 inthree">
                            <label for="months" class="font-s-14 text-blue">{{$lang['33']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="number" min="1" name="months" id="months" class="input" aria-label="input"
                                value="{{ isset(request()->months) ? request()->months : ''}}"/>
                            </div>
                        </div>
                        <div class="space-y-2 inthree">
                            <label for="weeks" class="font-s-14 text-blue">{{$lang['39']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="number" min="1" name="weeks" id="weeks" class="input" aria-label="input"
                                value="{{ isset(request()->weeks) ? request()->weeks : ''}}"/>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="days" class="font-s-14 text-blue">{{$lang['34']}}:</label>
                            <div class="w-100 py-2">                                  
                                <input type="number" min="1" name="days" id="days" class="input" aria-label="input"
                                value="{{ isset(request()->days) ? request()->days : ''}}"/>
                            </div>
                        </div>
                    </div>


                    <div class="col-6">                               
                        <input type="checkbox" name="cal_bus" id="cal_bus" {{ isset(request()->cal_bus) && request()->cal_bus != 'checked'  ? 'checked' :'' }}/>
                        <label for="cal_bus" class="font-s-14 text-blue">{{$lang['15'] }}</label>
                    </div>
                    <div class=" checkrow {{ isset(request()->cal_bus) && request()->cal_bus === 'checked'  ? 'row' :'hidden' }}">
                        <p class="mt-2 font-s-14">{{$lang['16']}}</p>
                        <div class="col-6 mt-2">
                            <input type="radio" name="weekend_c" id="weekr" value="no" {{ isset($_POST['weekend_c']) && $_POST['weekend_c'] === 'no' ? 'checked' : '' }}>
                            <label for="weekr" class="font-s-14 text-blue">{!! $lang['17'] !!}:</label>
                        </div>
                        <div class="col-6 mt-2 ps-lg-4">
                            <input type="radio" name="weekend_c" id="weekr2" value="yes" {{ isset($_POST['weekend_c']) && $_POST['weekend_c'] === 'yes' ? 'checked' : '' }}>
                            <label for="weekr2" class="font-s-14 text-blue">{!! $lang['18'] !!}:</label>
                        </div>
                    </div>
                    <div class="week my-3 {{ isset(request()->weekend_c) && request()->weekend_c === 'yes'  ? 'd-block' :'hidden' }}">
                        <div class="d-lg-flex">
                            <div class="col-lg-6">
                                <label class="d-block">
                                    <input name="nyd" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">New Year's Day</span>
                                </label>
                                <label class="d-block my-2">
                                    <input name="mlkd" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">M. L. King Day (US)</span>
                                </label>
                                <label class="d-block my-2">
                                    <input name="psd" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">President's Day (US)</span>
                                </label>
                                <label class="d-block my-2">
                                    <input name="memd" type="checkbox" class="filled-in" />
                                    <span class="black-text">Memorial Day (US)</span>
                                </label>
                                <label class="d-block my-2">
                                    <input name="ind" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">Independence Day (US)</span>
                                </label>
                                <label class="d-block my-2">
                                    <input name="labd" type="checkbox" class="filled-in" />
                                    <span class="black-text">Labor Day (US)</span>
                                </label>
                                <label class="d-block my-2">
                                    <input name="cold" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">Columbus Day (US)</span>
                                </label>
                                <label class="d-block my-2">
                                    <input name="vetd" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">Veteran's Day (US)</span>
                                </label>
                            </div>
                            <div class="col-lg-6 ps-lg-4">
                                <label class="d-block">
                                    <input name="thankd" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">Thanksgiving (US)</span>
                                </label>
                                <label class="d-block my-2">
                                    <input name="blkf" type="checkbox" class="filled-in" />
                                    <span class="black-text">Black Friday (US)</span>
                                </label>
                                <label class="d-block my-2">
                                    <input name="cheve" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">Christmas Eve</span>
                                </label>
                                <label class="d-block my-2">
                                    <input name="chirs" type="checkbox" class="filled-in" />
                                    <span class="black-text">Christmas</span>
                                </label>
                                <label class="d-block my-2">
                                    <input name="nye" checked type="checkbox" class="filled-in" />
                                    <span class="black-text">New Year's Eve</span>
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="total_j" value="0" id="total_j">
                        <p class="fw-bold my-2">{{(($lang=='en')?'If not in the list,':'')}} {{$lang['9']}}</p>
                        <div class=" grid grid-cols-3 gap-4 ">

                            <div class="w-25 pe-lg-3">
                                <label for="one">Holiday</label>
                                <input type="text" class="input my-2" id="one" value="{{ isset(request()->n0) ? request()->n0 : '' }}" name="n0">
                            </div>
                            <div class="w-25 ">
                                <label for="three">Month</label>
                                <select class="input my-2" id="three" name="m0">
                                    <option selected value>--</option>
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04">Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                            </div>
                            <div class="w-25 ps-lg-3">
                                <label for="two">Day</label>
                                <select class="input my-2" id="two" name="d0">
                                    <option selected value>--</option>
                                    <option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                                </select>
                            </div>
                        </div>

                        <div class="add_holidayW">
    
                        </div>
                        <div class="mt-3">
                            <button type="button" class="px-3 py-2 radius-5 border tagsUnit add_moreW">{{$lang['11']}}</button>
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
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 mt-5 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                @if(isset($detail['count_days']))
                                    <div class="col-lg-8 font-s-18">
                                        <table class="w-100">
                                            <tr class="col">
                                                <td class="border-b py-2"><strong>{{$lang['19']}}</strong></td>
                                                <td class="border-b py-2">
                                                    {{$detail['from']}}</td>
                                            </tr>
                                            <tr>
                                                <td class=" py-2"><strong>{{$lang['20']}}</strong></td>
                                                <td class=" py-2">
                                                    {{$detail['to']}}</td>
                                            </tr>
                                        <tr>
                                            <td colspan="2" class="border-b py-2"> 
                                                {{$detail['getworkdays']  ['workdays']}} {{$lang['34']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="border-b py-2">
                                                {{$lang['35']}} {{$detail['getworkdays']['workdays']*8}} {{$lang['36']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="border-b py-2">
                                                {{$lang['35']}} {{$detail['getworkdays']['workdays']*8*60}} {{$lang['37']}} 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="border-b py-2">
                                                {{$lang['35']}} {{$detail['getworkdays']['workdays']*8*60*60}} {{$lang['38']}} 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2"><strong>{{$lang['21']}}</strong></td>
                                        </tr>
                                        {{-- <div class="col-lg-8 font-s-18"> --}}
                                            {{-- <div class="col s12 m3"></div> --}}
                                                <tr>
                                                    <td class="border-b py-2">Total Days</td>
                                                    <td class="border-b py-2">{{$detail['t_days']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">Business Days</td>
                                                    <td class="border-b py-2">{{$detail['getworkdays']['workdays']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">Weekend Days</td>
                                                    <td class="border-b py-2">{{$detail['getworkdays']['weekend']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">Work Hours</td>
                                                    <td class="border-b py-2">{{$detail['getworkdays']['workdays'] * 8 }}h</td>
                                                </tr>
                                                @if($_POST['holiday_c']=='yes')
                                                    <tr>
                                                        <td class="border-b py-2">Holidays {{(($detail['getworkdays']['holidays']!=0)?"<span class='view_holi'>(View result)</span>":'')}}</td>
                                                        <td class="border-b py-2">{{$detail['getworkdays']['holidays']}}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    @if ($detail['t_days'] && $detail['ans2'])
                                                        <td class="border-b py-2">
                                                            <strong class="">{{$detail['t_days']}}</strong> Calendar Days – <strong class="">{{$detail['ans2']}}</strong> Skipped Days
                                                        </td>
                                                    @endif
                                                    @if (!empty($detail['weekends_days'])) 
                                                        <td class="border-b py-2">{{$detail['weekends_days']}} Weekend Days</td>
                                                    @endif
                                                    @if (!empty($detail['holi_days'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['holi_days']}}</strong> holidays</td>
                                                    @endif
                                                    @if (!empty($detail['sun_day'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['sun_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['mon_day']))
                                                        <td class="border-b py-2"><strong>{{$detail['mon_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['tue_day']))
                                                        <td class="border-b py-2"><strong>{{$detail['tue_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['wed_day'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['wed_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['thu_day'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['thu_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['fri_day'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['fri_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['sat_day'])) 
                                                        <td class="border-b py-2"><strong>{{$detail['sat_day']}}</strong></td>
                                                    @endif
                                                    @if (!empty($detail['res_days']))
                                                        <td class="border-b py-2" id="resu">Result: </td>
                                                        <td class="border-b py-2"> {{$detail['res_days']}} Days</td>
                                                    @endif
                                                </tr>
                                            {{-- </div> --}}
                                            @if($_POST['holiday_c']=='yes' && $detail['getworkdays']['holidays']!=0)
                                                {{-- <div class="col s12 margin_top_10 display_none holi_result"> --}}
                                                    <tr>
                                                        <td class="border-b py-2"><strong>{{$lang['25']}} {{$detail['from']}} and {{$detail['to']}}</strong>
                                                        </td>
                                                    </tr>
                                                    {{-- <table class="table text-center w-75 mx-auto"> --}}
                                                @php $count=count($detail['getworkdays']['get_holi']); @endphp
                                                @for ($i=0; $i <$count ; $i++) 
                                                    <tr>
                                                        <td class="border-b py-2">{{$detail['getworkdays']['dis_holi'][$i]}}</td>
                                                        <td class="border-b py-2"><strong>{{$detail['getworkdays']['get_holi'][$i]}}</strong></td>
                                                    </tr>                                
                                                @endfor
                                                {{-- </table> --}}
                                                {{-- </div> --}}
                                            @endif
                                        </table>
                                    </div>
                                @else
                                    <div class="col-lg-8 font-s-18">
                                        <table class="w-100">
                                            @if(isset(request()->cal_bus))
                                                <tr>
                                                    <td colspan="2" width="60%" class="border-b py-2">{{$detail['date']}}</td>
                                                </tr>
                                                <tr>
                                                    @if($_POST['method']=='+')
                                                        <td colspan="2" class="border-b py-2">{{$lang['28']}} {{$_POST['days']}} {{$lang['22']}} {{$lang['29']}} {{$detail['from']}} {{$lang['30']}} {{$detail['from_s']}} {{$lang['26']}} {{$detail['date_e']}}</td>
                                                    @else
                                                        <td colspan="2" class="border-b py-2">{{$lang['28']}} {{$_POST['days']}} {{$lang['22']}} before {{$detail['from']}} {{$lang['30']}} {{$detail['date_e']}} {{$lang['31']}} {{$detail['from_s']}} and</td>
                                                    @endif
                                                </tr>
                                                {{-- <div class="col s12">
                                                    <div class="col s12 m3"></div>
                                                    <table class="table text-center w-75 mx-auto"> --}}
                                                <tr>
                                                    <td class="border-b py-2">{{$lang['22']}}</td>
                                                    <td class="border-b py-2">{{$_POST['days']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{$lang['23']}}</td>
                                                    <td class="border-b py-2">{{$detail['weekends']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{$lang['24']}} {{(($detail['holidays']!=0)?"<span class='view_holi'>(View result)</span>":'')}}</td>
                                                    <td class="border-b py-2">{{$detail['holidays']}}</td>
                                                </tr>
                                                    {{-- </table>
                                                </div> --}}
                                                @if($_POST['weekend_c']=='yes' && $detail['holidays']!=0)
                                                {{-- <div class="col s12 margin_top_10 display_none holi_result"> --}}
                                                    <tr>
                                                        <td class="border-b py-2"><strong>{{$lang['25']}} {{$detail['from']}} {{$lang['26']}} {{$detail['date']}}</strong></td>
                                                    </tr>
                                                    {{-- <table class="table text-center w-75 mx-auto"> --}}
                                                @php $count=count($detail['get_holi']); @endphp
                                                    @for ($i=0; $i <$count ; $i++)
                                                        <tr>
                                                            <td class="border-b py-2">{{$detail['dis_holi'][$i]}}</td>
                                                            <td class="border-b py-2">{{$detail['get_holi'][$i]}}</td>
                                                        </tr>
                                                    @endfor
                                                {{-- </table> --}}
                                                {{-- </div> --}}
                                                @endif
                                            @else
                                                <tr>
                                                <td width="60%" class="border-b py-2">{{$lang['19']}}</td> 
                                                <td class="border-b py-2">{{$detail['from']}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="border-b py-2">{{$detail['des']}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{$lang['27']}}</td>
                                                    <td class="border-b py-2">{{$detail['date']}}</td>
                                                </td>
                                            @endif
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="w-full text-center mt-3">
                                <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                    @if (app()->getLocale() == 'en')
                                        RESET
                                    @else
                                        {{ $lang['reset'] ?? 'RESET' }}
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @push('calculatorJS')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    'use strict';
                    let i = 0;
                    function addChoti(i) {
                        const html = `
                           <div class=" grid grid-cols-3 gap-4 ">
                            <div class="w-25 pe-lg-3">
                                <label for="n${i}">Holiday</label>
                                <input type="text" class="input my-2" id="n${i}" value="{{ isset(request()->n0) ? request()->n0 : '' }}" name="n${i}">
                            </div>
                            <div class="w-25 ">
                                <label for="m${i}">Month</label>
                                <select class="input my-2" id="m${i}" name="m${i}">
                                    <option selected value>--</option>
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04">Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                            </div>
                            <div class="w-25 ps-lg-3">
                                <label for="d${i}">Day</label>
                                <select class="input my-2" id="d${i}" name="d${i}">
                                    <option selected value>--</option>
                                    <option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                                </select>
                            </div>
                        </div>`;
                        
                        document.querySelector('.add_holiday').insertAdjacentHTML('beforeend', html);
                        document.getElementById('total_i').value = i;
                    }
                    document.querySelector('.add_more').addEventListener('click', function() {
                        i++;
                        addChoti(i);
                    });
                });
                document.addEventListener('DOMContentLoaded', function() {
                    'use strict';
                    let j = 0;
                    function add_chotiW(j) {
                        const html = `
                          <div class=" grid grid-cols-3 gap-4 ">
                            <div class="w-25 pe-lg-3">
                                <label for="n${j}">Holiday</label>
                                <input type="text" class="input my-2" id="n${j}" value="{{ isset(request()->n0) ? request()->n0 : '' }}" name="n${j}">
                            </div>
                            <div class="w-25 ">
                                <label for="m${j}">Month</label>
                                <select class="input my-2" id="m${j}" name="m${j}">
                                    <option selected value>--</option>
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04">Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                            </div>
                            <div class="w-25 ps-lg-3">
                                <label for="d${j}">Day</label>
                                <select class="input my-2" id="d${j}" name="d${j}">
                                    <option selected value>--</option>
                                    <option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                                </select>
                            </div>
                        </div>`;
                        
                        document.querySelector('.add_holidayW').insertAdjacentHTML('beforeend', html);
                        document.getElementById('total_j').value = j;

                    }
                    document.querySelector('.add_moreW').addEventListener('click', function() {
                        j++;
                        add_chotiW(j);
                    });
                });
                document.getElementById('simp_cal').addEventListener('click', function() {
                    this.classList.add('tagsUnit');
                    document.getElementById('adv_cal').classList.remove('tagsUnit');
                    document.getElementById('sim_adv').value = "simple";
                    document.querySelectorAll('.simple').forEach(element => {
                        element.style.display = "block";
                    });
                    document.querySelectorAll('.advance').forEach(element => {
                        element.style.display = "none";
                    });
                });
                document.getElementById('cal_bus').addEventListener('click', function() {
                    var checkbox = document.getElementById('cal_bus');
                    if (checkbox.checked) {
                        document.querySelector('.checkrow').classList.add('row');
                        document.querySelector('.checkrow').classList.remove('hidden');
                        document.querySelectorAll('.inthree').forEach(element => {
                            element.style.display = "none"
                        });
                    } else {
                        document.querySelector('.checkrow').classList.add('hidden');  
                        document.querySelector('.checkrow').classList.remove('row');
                        document.querySelectorAll('.inthree').forEach(element => {
                            element.style.display = "block";
                        });  
                    }
                });
                document.getElementById('weekr').addEventListener('click', function() {
                    var bedtime = document.getElementById('weekr');
                    if(bedtime.checked) {
                        document.querySelector('.week').style.display = "none";
                    }
                });
                document.getElementById('weekr2').addEventListener('click', function() {
                    var bedtime = document.getElementById('weekr2');
                    if(bedtime.checked) {
                        document.querySelector('.week').style.display = "block";
                    }
                });
                document.getElementById('adv_cal').addEventListener('click', function() {
                    this.classList.add('tagsUnit');
                    document.getElementById('simp_cal').classList.remove('tagsUnit');
                    document.getElementById('sim_adv').value = "advance";
                    document.querySelectorAll('.simple').forEach(element => {
                        element.style.display = "none";
                    });
                    document.querySelectorAll('.advance').forEach(element => {
                        element.style.display = "block";
                    });
                });
                document.getElementById('wkup').addEventListener('click', function() {
                    var wkup = document.getElementById('wkup');
                    if (wkup.checked) {
                        document.querySelector('.holiday').style.display = "block";
                    }
                });
                document.getElementById('satting').addEventListener('change', function() {
                    var wkup = this.value;
                    if (wkup === '6') {
                        document.getElementById('select_days').classList.add('d-block');
                        document.getElementById('select_days').classList.remove('hidden');
                    }else{
                        document.getElementById('select_days').classList.add('hidden');
                        document.getElementById('select_days').classList.remove('d-block');
                    }
                });
                document.getElementById('bedtime').addEventListener('click', function() {
                    var bedtime = document.getElementById('bedtime');
                    if(bedtime.checked) {
                        document.querySelector('.holiday').style.display = "none";
                    }
                });
            </script>
        @endpush
    </form>
@endif
