<style>
    ul li{
        list-style-type: none;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <p class="d-inline text-blue pe-4 font-s-14">{{$lang['17']}}</p>
                    <input type="radio" name="type" id="first" value="first" checked {{ isset($_POST['type']) && $_POST['type'] === 'first' ? 'checked' : '' }}>
                    <label for="first" class="font-s-14 text-blue pe-lg-3 pe-2">{{$lang['18']}} </label>
                    <input type="radio" name="type" id="second" value="second" {{ isset($_POST['type']) && $_POST['type'] === 'second' ? 'checked' : '' }}>
                    <label for="second" class="font-s-14 text-blue">{{$lang['19']}} </label>
                </div>
                <div class="col-span-12 {{ isset($_POST['type']) && $_POST['type'] === 'second' ? 'hidden' : 'flex' }}" id="calculator">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-6">
                            <label for="firsti" class="font-s-14 text-blue"><?=$lang[1]?> :</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="first" id="firsti" class="input" aria-label="input" value="{{ isset($_POST['first'])?$_POST['first']:'34' }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="secondi" class="font-s-14 text-blue"><?=$lang[2]?> :</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="second" id="secondi" class="input" aria-label="input" value="{{ isset($_POST['second'])?$_POST['second']:'50' }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 {{ isset($_POST['type']) && $_POST['type'] === 'second' ? 'd-block' : 'hidden' }}" id="converter">
                    <ul class="get_html">
                        <li class="flex gap-3">
                            <div class="col-span-4">
                                <label for="sub_name" class="font-s-14 text-blue"><?= $lang[10] ?></label>
                                <div class="py-2">
                                    <input type="text" name="sub_name[]" id="sub_name" class="input" placeholder="<?= $lang[10] ?>">
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="s_marks" class="font-s-14 text-blue"><?= $lang[11] ?></label>
                                <div class="py-2">
                                    <input type="number" name="s_marks[]" id="s_marks" class="input" placeholder="<?= $lang[11] ?>">
                                </div>
                            </div>
                            <div class="col-span-4 gpa_weight">
                                <label for="gpa_weight" class="font-s-14 text-blue"><?= $lang[12] ?></label>
                                <div class="py-2">
                                    <input type="number" name="a_marks[]" id="gpa_weight" class="input" placeholder="<?= $lang[12] ?>">
                                </div>
                            </div>
                        </li>
                        <div class="khali_div">



                        </div>
                    </ul>
                    <div class="my-2">
                        <button type="button" title="Add New Course" id="btn7" class="units_active border p-2 cursor-pointer bg-[#99EA48] rounded-lg"><b><span class="font_size20">+</span> <?= $lang[13] ?></b></button>
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
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['4']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?= round($detail['percent'], 2) ?> %</strong></p>
                            </div>
                        </div>
                            <?php if ($detail['type'] == "second") { ?>
                                <div class="w-full mb-3">
                                    <div class="w-full md:w-[60%] lg:w-[60%] ">
                                        <p class="text-[20px] py-2"><strong><?= $lang[14] ?></strong></p>
                                        <p class="text-blue font-s-18"><strong><?= round($detail['total_scored'], 2) ?></strong></p>
                                    </div>
                                    <div class="w-full md:w-[60%] lg:w-[60%] ">
                                        <p class="text-[20px] py-2"><strong><?= $lang[15] ?></strong></p>
                                        <p class="text-blue font-s-18"><strong><?= round($detail['total_marks'], 2) ?></strong></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="">
                                <?php if ($detail['type'] == "first") { ?>
                                    <p class="font-s-18"><strong><?= $lang[5] ?></strong></p>
                                    <div>
                                        <strong><?= $lang[4] ?> = </strong>
                                        <span class="fraction d-flex">
                                            <span class="num">{{ $lang[6]." ". $lang[7]}}</span> 
                                            <span class="visually-hidden"></span>
                                            <span class="den">{{ $lang[6]." ". $lang[7] }}</span>
                                        </span>× 100 
                                    </div>
                                    <div>
                                        <strong><?= $lang[4] ?> = </strong>
                                        <span class="fraction d-flex">
                                            <span class="num">{{ $_POST['first']}}</span> 
                                            <span class="visually-hidden"></span>
                                            <span class="den">{{ $_POST['second'] }}</span>
                                        </span>× 100 
                                    </div>
                                    
                                    <p class="mt-2"><strong> <?= $lang[4] ?> = <?= round($detail['percent'], 2) ?> %</strong></p>
                                <?php } elseif ($detail['type'] == "second") { ?>
                                    <table class="w-100">
                                        <tr>
                                            <td class="border-b py-2"><strong><?= $lang[10] ?></strong></td>
                                            <td class="border-b py-2"><strong><?= $lang[11] ?></strong></td>
                                            <td class="border-b py-2"><strong><?= $lang[12] ?></strong></td>
                                        </tr>
                                        <?php
                                        foreach (($detail['s_array']) as $index => $value) {
                                        ?>
                                            <tr>
                                                <td class="border-b py-2"><?= $detail['name_array'][$index] ?></td>
                                                <td class="border-b py-2"><?= $detail['s_array'][$index] ?></td>
                                                <td class="border-b py-2"><?= $detail['a_array'][$index] ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="w-full text-center my-[25px]">
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
</form>
@push('calculatorJS')
    <script>
        document.getElementById('first').addEventListener('click', function() {
                document.getElementById('converter').style.display = 'none';
                document.getElementById('calculator').style.display = 'flex';
            });

            document.getElementById('second').addEventListener('click', function() {
                document.getElementById('converter').style.display = 'block';
                document.getElementById('calculator').style.display = 'none';
            });

            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove')) {
                    var parentLi = event.target.closest('.get_html li');
                    if (parentLi) {
                        parentLi.remove();
                        x--;
                    }
                }
            });

            var x = 0;
            document.getElementById('btn7').addEventListener('click', function() {
                if (x < 5) {
                    var read =
                        `<li class="flex gap-3 mt-2">
                            <div class="col-lg-4 px-1">
                                <input type="text" name="sub_name[]" class="input" placeholder="${lang[10]}">
                            </div>
                            <div class="col-lg-4 px-1">
                                <input type="number" name="s_marks[]" class="input" placeholder="${lang[11]}">
                            </div>
                            <div class="col-lg-4 px-1 gpa_weight">
                                <input type="number" name="a_marks[]" class="input" placeholder="${lang[12]}">
                            </div>
                            <img src="{{asset('images/close.png')}}" alt="GPA Remove Course" class="mt-2 remove right max-width object-contain" width="20px" height="20px">
                        </li>`;
                    document.querySelector('.khali_div').insertAdjacentHTML('beforeend', read);
                    x++;
                } else {
                    alert(lang[16]);
                }
            });

            function asset(path) {
                // Implement this function to return the correct asset URL based on the path provided
                return path; // Adjust this as needed
            }

            var lang = {
                10: 'Subject Name',  // Replace with actual language translations
                11: 'Score Marks',   // Replace with actual language translations
                12: 'Average Marks', // Replace with actual language translations
                16: 'Maximum limit reached' // Replace with actual language translations
            };

    </script>
@endpush
