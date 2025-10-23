<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                <input type="hidden" name="sim_adv" value="{{ isset(request()->sim_adv) ? request()->sim_adv : 'simple' }}" id="sim_adv">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? '' :'tagsUnit' }} simp_cal" id="simp_cal">
                            {{$cal_name}}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white adv_cal {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'tagsUnit' :'' }}" id="adv_cal">
                            3D {{$lang['5']}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-6 nether_calc {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'hidden' :'block' }}">
                <label for="cal" class="font-s-14 text-blue">{{$lang['calculate']}}</label>
                <select name="cal" id="cal" class="input my-2">
                    <option selected="selected" value="1">{{$lang['2']}}</option>
                    <option value="2" {{ isset(request()->cal) && request()->cal === "2" ? 'selected' : '' }}>{{$lang['3']}}</option>
                </select>
            </div> 
            <div class="col-span-6 nether_calc {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'hidden' :'block' }}">
                <label for="x" class="font-s-14 text-blue">X</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x" id="x" class="input" aria-label="input" placeholder="2" value="{{ isset(request()->x)?request()->x:'100' }}" />
                </div>
            </div>
            <div class="col-span-6 nether_calc {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'hidden' :'block' }}">
                <label for="y" class="font-s-14 text-blue">Y</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y" id="y" class="input" aria-label="input" placeholder="1080" value="{{ isset(request()->y)?request()->y:'200' }}" />
                </div>
            </div>
            <div class="col-span-6 nether_calc {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'hidden' :'block' }}">
                <label for="z" class="font-s-14 text-blue">Z</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="z" id="z" class="input" aria-label="input" placeholder="1080" value="{{ isset(request()->z)?request()->z:'300' }}" />
                </div>
            </div>

            <div class="col-span-6 td_calc  {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'block' :'hidden' }}">
                <label for="x1" class="font-s-14 text-blue">X1</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x1" id="x1" class="input" aria-label="input" placeholder="2" value="{{ isset(request()->x1)?request()->x1:'200' }}" />
                </div>
            </div>
            <div class="col-span-6 td_calc {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'block' :'hidden' }}">
                <label for="x2" class="font-s-14 text-blue">X2</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x2" id="x2" class="input" aria-label="input" placeholder="2" value="{{ isset(request()->x2)?request()->x2:'300' }}" />
                </div>
            </div>
            <div class="col-span-6 td_calc {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'block' :'hidden' }}">
                <label for="y1" class="font-s-14 text-blue">Y1</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y1" id="y1" class="input" aria-label="input" placeholder="1080" value="{{ isset(request()->y1)?request()->y1:'400' }}" />
                </div>
            </div>
            <div class="col-span-6 td_calc {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'block' :'hidden' }}">
                <label for="y2" class="font-s-14 text-blue">Y2</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y2" id="y2" class="input" aria-label="input" placeholder="1080" value="{{ isset(request()->y2)?request()->y2:'500' }}" />
                </div>
            </div>
            <div class="col-span-6 td_calc {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'block' :'hidden' }}">
                <label for="z1" class="font-s-14 text-blue">Z1</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="z1" id="z1" class="input" aria-label="input" placeholder="1080" value="{{ isset(request()->z1)?request()->z1:'600' }}" />
                </div>
            </div>
            <div class="col-span-6 td_calc {{ isset(request()->sim_adv) && request()->sim_adv !== 'simple'  ? 'block' :'hidden' }}">
                <label for="z2" class="font-s-14 text-blue">Z2</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="z2" id="z2" class="input" aria-label="input" placeholder="1080" value="{{ isset(request()->z2)?request()->z2:'700' }}" />
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
                    <div class="w-full my-2">
                        @if(request()->sim_adv === 'simple')
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                <table class="w-full">
                                    @php
                                        $x=$detail['x'];
                                        $y=$detail['y'];
                                        $z=$detail['z'];
                                        $comment=$detail['comment'];
                                        if(request()->cal==='1'){
                                            $head='Nether Coordinates';
                                        }elseif(request()->cal==='2'){
                                            $head='Overworld Coordinates';
                                        }
                                    @endphp
                                    <tr>
                                        <td colspan="2"><strong>{{$head}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">X</td>
                                        <td class="border-b py-2">{{$x}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">Y</td>
                                        <td class="border-b py-2">{{$y}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">Z</td>
                                        <td class="border-b py-2">{{$z}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-2"></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">X,Y,Z</td>
                                        <td class="border-b py-2">{{$x.', '.$y.', '.$z}}</td>
                                    </tr>
                                </table>
                            </div>
                            @if(isset($comment))
                                <p>{{$comment}}</p>
                            @endif
                        @else
                            <div class="text-center">
                                <p class="font-s-20"><strong>{{$lang['4']}}</strong></p>
                                <p class="font-s-32 bg-sky px-3 py-2 radius-10 d-inline-block mt-3"><strong class="text-blue">{{$detail['distance']}}</strong></p>
                            </div>        
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        var td_calc = document.querySelectorAll('.td_calc');
        var nether_calc = document.querySelectorAll('.nether_calc');
        document.getElementById('simp_cal').addEventListener('click', function() {
            this.classList.add('tagsUnit');
            document.getElementById('adv_cal').classList.remove('tagsUnit');
            document.getElementById('sim_adv').value = "simple";
            nether_calc.forEach(element => {
                element.style.display = "block";
            });
            td_calc.forEach(element => {
                element.style.display = "none";
            });
        });
        document.getElementById('adv_cal').addEventListener('click', function() {
            this.classList.add('tagsUnit');
            document.getElementById('simp_cal').classList.remove('tagsUnit');
            document.getElementById('sim_adv').value = "advance";
            nether_calc.forEach(element => {
                element.style.display = "none";
            });
            td_calc.forEach(element => {
                element.style.display = "block";
            });
        });
    </script>
@endpush