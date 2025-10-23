<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="nbr" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="nbr" id="nbr">
                        <option value="2">2</option>
                        <option value="3" {{ isset($_POST['nbr']) && $_POST['nbr']=='3'?'selected':'' }}>3</option>
                        <option value="4" {{ isset($_POST['nbr']) && $_POST['nbr']=='4'?'selected':'' }}>4</option>
                        <option value="5" {{ isset($_POST['nbr']) && $_POST['nbr']=='5'?'selected':'' }}>5</option>
                        <option value="6" {{ isset($_POST['nbr']) && $_POST['nbr']=='6'?'selected':'' }}>6</option>
                        <option value="7" {{ isset($_POST['nbr']) && $_POST['nbr']=='7'?'selected':'' }}>7</option>
                        <option value="8" {{ isset($_POST['nbr']) && $_POST['nbr']=='8'?'selected':'' }}>8</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="a1" class="label">{{$lang['2']}} A:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="a1" id="a1" class="input" value="{{ isset($_POST['a1']) ? $_POST['a1'] : '2' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="z1" class="label">&nbsp;</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="z1" id="z1" class="input" value="{{ isset($_POST['z1']) ? $_POST['z1'] : '3' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="a2" class="label">{{$lang['2']}} B:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="a2" id="a2" class="input" value="{{ isset($_POST['a2']) ? $_POST['a2'] : '4' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="z2" class="label">&nbsp;</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="z2" id="z2" class="input" value="{{ isset($_POST['z2']) ? $_POST['z2'] : '5' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] >= 3 ? '':'hidden' }} three">
                <label for="a3" class="label">{{$lang['2']}} C:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="a3" id="a3" class="input" value="{{ isset($_POST['a3']) ? $_POST['a3'] : '6' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] >= 3 ? '':'hidden' }} three">
                <label for="z3" class="label">&nbsp;</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="z3" id="z3" class="input" value="{{ isset($_POST['z3']) ? $_POST['z3'] : '7' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] >= 4 ? '':'hidden' }} four">
                <label for="a4" class="label">{{$lang['2']}} D:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="a4" id="a4" class="input" value="{{ isset($_POST['a4']) ? $_POST['a4'] : '8' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] >= 4 ? '':'hidden' }} four">
                <label for="z4" class="label">&nbsp;</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="z4" id="z4" class="input" value="{{ isset($_POST['z4']) ? $_POST['z4'] : '9' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] >= 5 ? '':'hidden' }} five">
                <label for="a5" class="label">{{$lang['2']}} E:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="a5" id="a5" class="input" value="{{ isset($_POST['a5']) ? $_POST['a5'] : '10' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] >= 5 ? '':'hidden' }} five">
                <label for="z5" class="label">&nbsp;</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="z5" id="z5" class="input" value="{{ isset($_POST['z5']) ? $_POST['z5'] : '11' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] >= 6 ? '':'hidden' }} six">
                <label for="a6" class="label">{{$lang['2']}} F:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="a6" id="a6" class="input" value="{{ isset($_POST['a6']) ? $_POST['a6'] : '12' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] >= 6 ? '':'hidden' }} six">
                <label for="z6" class="label">&nbsp;</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="z6" id="z6" class="input" value="{{ isset($_POST['z6']) ? $_POST['z6'] : '13' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] >= 7 ? '':'hidden' }} seven">
                <label for="a7" class="label">{{$lang['2']}} G:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="a7" id="a7" class="input" value="{{ isset($_POST['a7']) ? $_POST['a7'] : '14' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] >= 7 ? '':'hidden' }} seven">
                <label for="z7" class="label">&nbsp;</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="z7" id="z7" class="input" value="{{ isset($_POST['z7']) ? $_POST['z7'] : '15' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] === '8' ? '':'hidden' }} eight">
                <label for="a8" class="label">{{$lang['2']}} H:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="a8" id="a8" class="input" value="{{ isset($_POST['a8']) ? $_POST['a8'] : '16' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 {{ isset($_POST['nbr']) && $_POST['nbr'] === '8' ? '':'hidden' }} eight">
                <label for="z8" class="label">&nbsp;</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="z8" id="z8" class="input" value="{{ isset($_POST['z8']) ? $_POST['z8'] : '17' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="dil" class="label">{{$lang['3']}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="dil" id="dil" class="input" value="{{ isset($_POST['dil']) ? $_POST['dil'] : '3' }}" aria-label="input" />
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    @for($i=0; $i < $_POST['nbr'] ; $i++)
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[4]}} O{{$detail['abc'][$i]}}</strong></td>
                                            <td class="py-2 border-b">({{$detail['aval'][$i]*$_POST['dil']}} , {{$detail['zval'][$i]*$_POST['dil']}})</td>
                                        </tr>
                                    @endfor
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('nbr').addEventListener('change', function() {
                if(this.value === '2'){
                    ['.three', '.four', '.five', '.six', '.seven', '.eight'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if (this.value === '3'){
                    ['.four', '.five', '.six', '.seven', '.eight'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.three'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else if (this.value === '4'){
                    ['.five', '.six', '.seven', '.eight'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.three', '.four'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else if (this.value === '5'){
                    ['.six', '.seven', '.eight'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.three', '.four', '.five'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else if (this.value === '6'){
                    ['.seven', '.eight'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.three', '.four', '.five', '.six'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else if (this.value === '7'){
                    ['.eight'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.three', '.four', '.five', '.six', '.seven'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else{
                    ['.three', '.four', '.five', '.six', '.seven', '.eight'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>
