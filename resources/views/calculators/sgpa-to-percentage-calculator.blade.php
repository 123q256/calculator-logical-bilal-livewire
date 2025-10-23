<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
           @php $request = request(); @endphp
           <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
            <input type="hidden" name="type" value="{{ isset($request->type) && $request->type === 'second' ? 'second':'first' }}" id="type">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab {{ isset($request->type) && $request->type === 'second' ? '':'tagsUnit' }}" id="imperial" data-value="first">
                            {{ $lang['4'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab {{ isset($request->type) && $request->type === 'second' ? 'tagsUnit':'' }}" id="metric" data-value="second">
                            {{ $lang['5'] }}
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12 mt-5   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 {{ isset($request->type) && $request->type === 'second' ? 'hidden':'' }}" id="simpleInput">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="selection" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <select name="selection" class="input" id="selection" aria-label="select">
                            <option value="1">{{"SGPA ".$lang[2]}}</option>
                            <option value="2" {{ isset($request->selection) && $request->selection == '2' ? 'selected' : '' }}>{{"SGPA ".$lang[3]." CGPA"}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2 {{ isset($request->type) && $request->type === 'first' && isset($request->selection) && $request->selection === '2' ? 'hidden' : '' }} sgpa1">
                    <label for="sgp" class="font-s-14 text-blue">Enter Your SGPA:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="sgp" id="sgp" class="input" value="{{ isset($request->sgp)?$request->sgp:'3' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="finch2 {{ isset($request->type) && $request->type === 'first' && isset($request->selection) && $request->selection === '2' ? '' : 'hidden' }}">
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="sgp" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="number_of_semesters" id="number_of_semesters" class="input" value="{{ isset($request->number_of_semesters)?$request->number_of_semesters:'8' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="sgp" class="font-s-14 text-blue">{{ $lang['8'] }} SGPAs {{ $lang['9'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="sum" id="sum" class="input" value="{{ isset($request->sum)?$request->sum:'3.7' }}" aria-label="input"/>
                        </div>
                    </div>
                </div>
            </div>
            <div id="advancedInput" class="col-span-12 {{ isset($request->type) && $request->type === 'second' ? '':'hidden' }}">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="sgpa1" class="font-s-14 text-blue">Enter Semester 1 SGPA:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="sgpa[]" id="sgpa1" class="input" value="{{ isset($_POST['sgpa[]'])?$_POST['sgpa[]']:'3' }}" aria-label="input"/>
                    </div>
                </div>
                <div id="cd2">
                    @isset($request->sgpa)
                        @for ($i = 1; $i < count($request->sgpa); $i++)
                            <div class="col-12 mt-0 mt-lg-2">
                                <span class="font-s-14 text-blue">Enter Semester {{$i+1}} SGPA:</span>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" name="sgpa[]" class="input" value="{{$request->sgpa[$i]}}" aria-label="input"/>
                                </div>
                            </div>
                        @endfor
                    @endisset
                </div>
                <div class="col-12 text-end mt-3" id="btn2">
                    <button type="button" name="submit" id="newRow" title="Add More Fields" onclick="add_row(this)" class="px-3 py-2 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><span>+</span>{{$lang[6]}}</button>
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
                            @isset($detail['percentage'])
                                <div class="w-full text-center text-[20px]">
                                    <p>CGPA</p>
                                    <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[25px] rounded-lg text-blue">{{$detail['percentage']}}</strong></p>
                                </div>
                            @endisset
                            @isset($detail['final_gpa'])
                                <div class="w-full text-center text-[20px]">
                                    <p>{{$lang[10]}}</p>
                                    <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[25px] rounded-lg text-blue">{{$detail['final_gpa']}}%</strong></p>
                                </div>
                            @endisset
                            @isset($detail['final_result'])
                                <div class="w-full text-center text-[20px]">
                                    <p>{{$lang[11]}} CGPA {{$lang[12]}}</p>
                                    <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[25px] rounded-lg text-blue">{{$detail['final_result']}}</strong></p>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab').forEach(function(tab) {
                        tab.classList.remove('tagsUnit');
                    });
                    this.classList.add('tagsUnit');
                    let val = this.dataset.value;
                    document.getElementById('type').value = val;
                    if (val === 'second') {
                        ['#advancedInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#simpleInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                    } else {
                        ['#simpleInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#advancedInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                    }
                });
            });
            document.getElementById('selection').addEventListener('change', function() {
                var findValue = this.value
                switch (findValue) {
                    case '1':
                        ['.finch1', '.sgpa1'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['.finch2'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        break;
                    case '2':
                        ['.finch2'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['.finch1', '.sgpa1'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        break;
                }
            });
            let x = {{ isset($request->sgpa) ? (count($request->sgpa)+1) : 2 }};
            // let x = 2;
            function add_row() {
                if (12 >= x) {
                    var read = `
                        <div class="col-12 mt-0 mt-lg-2">
                            <span class="font-s-14 text-blue">Enter Semester `+ x +` SGPA:</span>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="sgpa[]" value="{{ isset($_POST['sgpa[]'])?$_POST['sgpa[]']:'`+ x +`' }}" class="input" aria-label="input" />
                            </div>
                        </div>
                    `;
                    document.getElementById('cd2').insertAdjacentHTML('beforeend', read);
                } else {
                    alert('Only Twelve Fields are Allowed');
                }
                x++;
            }
        </script>
    @endpush
</form>