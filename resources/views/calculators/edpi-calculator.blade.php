<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <label for="game" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <select name="game" id="game" class="input my-2">
                    <option value="1" selected>CS:GO</option>
                    <option value="2" {{ isset($_POST['game']) && $_POST['game'] === "2" ? 'selected' : '' }}>Call of Duty</option>
                    <option value="3" {{ isset($_POST['game']) && $_POST['game'] === "3" ? 'selected' : '' }}>Valorant</option>
                    <option value="4" {{ isset($_POST['game']) && $_POST['game'] === "4" ? 'selected' : '' }}>Fortnite</option>
                    <option value="5" {{ isset($_POST['game']) && $_POST['game'] === "5" ? 'selected' : '' }}>Overwatch</option>
                    <option value="6" {{ isset($_POST['game']) && $_POST['game'] === "6" ? 'selected' : '' }}>Apex Legends</option>
                </select>
            </div> 
            <div class="col-span-12 {{ isset($_POST['game']) && $_POST['game'] === "1" ? 'row' : 'row'}} cs_og">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="dpi" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="text" name="dpi" id="dpi" class="input" aria-label="input" value="{{ isset($_POST['dpi'])?$_POST['dpi']:'600' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="sen" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="text" name="sen" id="sen" class="input" aria-label="input" value="{{ isset($_POST['sen'])?$_POST['sen']:'0.12' }}" />
                    </div>
                </div>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['game']) && $_POST['game'] !== "1" ? 'hidden' : 'row'}} call_of_duty" >
                <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="row" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <select name="row" id="row" class="input my-2">
                        <option value="0" selected>Off</option>
                        <option value="1" {{ isset($_POST['row']) && $_POST['row'] === "1" ? 'selected' : '' }}>On</option>
                    </select>
                </div> 
                <div class="col-span-12 md:col-span-6 lg:col-span-6 {{ isset($_POST['row']) && $_POST['row'] === "1" ? 'hidden' : 'd-inline' }}" id="window">
                    <label for="win" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <select name="win" id="win" class="input my-2">
                        <option value="0.03" {{ isset($_POST['win']) && $_POST['win'] === "0.03" ? 'selected' : '' }}>1</option>
                            <option value="0.06" {{ isset($_POST['win']) && $_POST['win'] === "0.06" ? 'selected' : '' }}>2</option>
                            <option value="0.25" {{ isset($_POST['win']) && $_POST['win'] === "0.25" ? 'selected' : '' }}>3</option>
                            <option value="0.5" {{ isset($_POST['win']) && $_POST['win'] === "0.5" ? 'selected' : '' }}>4</option>
                            <option value="0.75" {{ isset($_POST['win']) && $_POST['win'] === "0.75" ? 'selected' : '' }}>5</option>
                            <option value="1"  {{ isset($_POST['win']) && $_POST['win'] === "1" ? 'selected' : 'selected' }}>6</option>
                            <option value="1.5" {{ isset($_POST['win']) && $_POST['win'] === "1.5" ? 'selected' : '' }}>7</option>
                            <option value="2" {{ isset($_POST['win']) && $_POST['win'] === "2" ? 'selected' : '' }}>8</option>
                            <option value="2.5" {{ isset($_POST['win']) && $_POST['win'] === "2.5" ? 'selected' : '' }}>9</option>
                            <option value="3" {{ isset($_POST['win']) && $_POST['win'] === "3" ? 'selected' : '' }}>10</option>
                            <option value="3.5" {{ isset($_POST['win']) && $_POST['win'] === "3.5" ? 'selected' : '' }}>11</option>
                    </select>
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                          <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="text-[18px] w-full">
                              <tr>
                                <td class="border-b py-2"><strong>{{$lang['7']}} :</strong></td>
                                <td class="border-b py-2">{{$detail['ans']}}</td>
                              </tr>
                              <tr>
                                <td class="border-b py-2"><strong>{{$lang['8']}} :</strong></td>
                                <td class="border-b py-2">{{$detail['type']}}</td>
                              </tr>
                              <tr>
                                <td class="border-b py-2"><strong>Cm/360° :</strong></td>
                                <td class="border-b py-2">{{$detail['cm']}}</td>
                              </tr>
                              <tr>
                                <td class="border-b py-2"><strong>In/360° :</strong></td>
                                <td class="border-b py-2">{{$detail['in']}}</td>
                              </tr>
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
       document.getElementById('game').addEventListener('change', function(){
            var value = this.value;
            var defult = document.querySelector('.cs_og');
            var call = document.querySelector('.call_of_duty');
            if(value == 1){
                defult.classList.add('row');
                defult.classList.remove('hidden');
                call.classList.add('row');
                call.classList.remove('hidden');
            }else{
                defult.classList.add('row');
                defult.classList.remove('hidden');
                call.classList.add('hidden');
                call.classList.remove('row');
            }
        });
       document.getElementById('row').addEventListener('change', function(){
            var value = this.value;
            var defult = document.getElementById('window');
            if(value == 1){
                defult.classList.add('hidden');
                defult.classList.remove('d-inline');
            }else{
                defult.classList.add('d-inline');
                defult.classList.remove('hidden');
            }
        });
    </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>