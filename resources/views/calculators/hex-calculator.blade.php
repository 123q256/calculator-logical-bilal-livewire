<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @php 
               $request = request();
               if (!isset($request->options)) {
                   $request->options = "1";
               }
           @endphp

           <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
            <input type="hidden" name="type" value="{{ isset($request->type) && $request->type === 'second' ? 'second':'first' }}" id="type">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab {{ isset($request->type) && $request->type === 'second' ? '':'tagsUnit' }}" id="imperial" data-value="first">
                            {{ $lang['10'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab {{ isset($request->type) && $request->type === 'second' ? 'tagsUnit':'' }}" id="metric" data-value="second">
                            {{ $lang['11'] }}
                    </div>
                </div>
            </div>
        </div>
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12 row {{ isset($request->type) && $request->type === 'second' ? 'hidden':'' }}" id="hexCalculator">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-3"></div>
                <div class="col-span-9">
                    <label for="bnr_frs" class="font-s-14 text-blue">{{$lang["6"]}}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="bnr_frs" id="bnr_frs" class="input" value="{{ isset($request->bnr_frs) ? $request->bnr_frs : '8AB' }}" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-3">
                    <label for="bnr_slc" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-full py-2">
                        <select name="bnr_slc" class="input" id="bnr_slc" aria-label="select">
                            <option value="add">+</option>
                            <option value="sub" {{ isset($request->bnr_slc) && $request->bnr_slc=='sub'?'selected':'' }}>-</option>
                            <option value="mult" {{ isset($request->bnr_slc) && $request->bnr_slc=='mult'?'selected':'' }}>*</option>
                            <option value="divd" {{ isset($request->bnr_slc) && $request->bnr_slc=='divd'?'selected':'' }}>/</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-9">
                    <label for="bnr_sec" class="font-s-14 text-blue">{{$lang["7"]}}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="bnr_sec" id="bnr_sec" class="input" value="{{ isset($request->bnr_sec) ? $request->bnr_sec : 'B78' }}" aria-label="input" />
                    </div>
                </div>
                </div>
            </div>
            <div class="col-span-12 row {{ isset($request->type) && $request->type === 'second' ? '':'hidden' }}" id="hexConverter">
                <div class="col-12 mt-0 mt-lg-2 flex justify-around ">
                    <p id="hex_to_dec">
                        <input type="radio" name="options" id="option1" value="1" {{ isset($request->options) && $request->options==='1' ? 'checked':'' }}>
                        <label for="option1" class="font-s-14"><?=$lang[12]?></label>
                    </p>
                    <p id="dec_to_hex">
                        <input type="radio" name="options" id="option2" value="2" {{ isset($request->options) && $request->options==='2' ? 'checked':'' }}>
                        <label for="option2" class="font-s-14"><?=$lang[13]?></label>
                    </p>
                </div>
                <div class="col-12 mt-0 mt-lg-2 flex justify-around ">
                    <p id="hex_to_dec">
                        <input type="radio" name="options" id="option3" value="3" {{ isset($request->options) && $request->options==='3' ? 'checked':'' }}>
                        <label for="option3" class="font-s-14"><?=$lang[14]?></label>
                    </p>
                    <p id="hex_to_dec">
                        <input type="radio" name="options" id="option4" value="4" {{ isset($request->options) && $request->options==='4' ? 'checked':'' }}>
                        <label for="option4" class="font-s-14"><?=$lang[15]?></label>
                    </p>
                </div>
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="nmbr" class="font-s-14 text-blue">{{$lang["16"]}}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="nmbr" id="nmbr" class="input" value="{{ isset($request->nmbr) ? $request->nmbr : '34A' }}" aria-label="input" />
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
                            @php
                                $type= $request->type;
                                $bnr_frs= $request->bnr_frs;
                                $bnr_sec= $request->bnr_sec;
                                $bnr_slc= $request->bnr_slc;
                                $options= $request->options;
                                $nmbr= $request->nmbr;
                            @endphp
                            @if($detail['type']=="first")
                                <div class="col-lg-6 mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><strong><?=$lang[17]?></strong></td>
                                            <td class="py-2 border-b"><?=$detail['hx']?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><?=$lang[3]?></td>
                                            <td class="py-2 border-b"><?=$detail['dc']?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><?=$lang[2]?></td>
                                            <td class="py-2 border-b"><?=$detail['bn']?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><?=$lang[5]?></td>
                                            <td class="py-2 border-b"><?=$detail['oc']?></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><?=$lang[17]?></td>
                                            <td class="py-2 border-b"><?=$detail['hx']?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full text-[16px]">
                                    <p class="mt-3"><strong><?=$lang[18]?>:</strong></p>
                                    <p class="mt-3"><?=$lang[19]?></p>
                                    <p class="mt-3"><?php echo $detail['first_ans1']." ".$detail['op']." ".$detail['second_ans1']." = ".$detail['hx']; ?></p>
                                    <p class="mt-3"><?=$lang[20]?></p>
                                    <p class="mt-3"><?php echo $detail['first_ans']." ".$detail['op']." ".$detail['second_ans']." = ".$detail['dc']; ?></p>
                                </div>
                            @else
                                <div class="w-full text-center my-2">
                                    <p><strong class="bg-[#2845F5] text-white  px-3 py-2 text-[21px] rounded-lg text-blue"><?=$detail['answer']." ".$detail['text'] ?></strong></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @isset($detail)
            <script>
                var repeatElement = document.querySelectorAll('.repeat');
                repeatElement.forEach(function(repeatElement) {
                    repeatElement.addEventListener('click', function() {
                        var elementsToToggle = document.querySelectorAll('#step_cal');
                        elementsToToggle.forEach(function(element) {
                            if (element.style.display === 'none' || element.style.display === '') {
                                element.style.display = 'block';
                                element.style.maxHeight = '0';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-out';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = element.scrollHeight + 'px';
                                });
                                setTimeout(function() {
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            } else {
                                element.style.maxHeight = element.scrollHeight + 'px';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-in';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = '0';
                                });
                                setTimeout(function() {
                                    element.style.display = 'none';
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            }
                        });
                    });
                });
                var repeatElement1 = document.querySelectorAll('.repeat1');
                repeatElement1.forEach(function(repeatElement) {
                    repeatElement.addEventListener('click', function() {
                        var elementsToToggle = document.querySelectorAll('#step_cal1');
                        elementsToToggle.forEach(function(element) {
                            if (element.style.display === 'none' || element.style.display === '') {
                                element.style.display = 'block';
                                element.style.maxHeight = '0';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-out';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = element.scrollHeight + 'px';
                                });
                                setTimeout(function() {
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            } else {
                                element.style.maxHeight = element.scrollHeight + 'px';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-in';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = '0';
                                });
                                setTimeout(function() {
                                    element.style.display = 'none';
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            }
                        });
                    });
                });
                var repeatElement2 = document.querySelectorAll('.repeat2');
                repeatElement2.forEach(function(repeatElement) {
                    repeatElement.addEventListener('click', function() {
                        var elementsToToggle = document.querySelectorAll('#step_cal2');
                        elementsToToggle.forEach(function(element) {
                            if (element.style.display === 'none' || element.style.display === '') {
                                element.style.display = 'block';
                                element.style.maxHeight = '0';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-out';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = element.scrollHeight + 'px';
                                });
                                setTimeout(function() {
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            } else {
                                element.style.maxHeight = element.scrollHeight + 'px';
                                element.style.overflow = 'hidden';
                                element.style.transition = 'max-height 0.7s ease-in';
                                requestAnimationFrame(function() {
                                    element.style.maxHeight = '0';
                                });
                                setTimeout(function() {
                                    element.style.display = 'none';
                                    element.style.maxHeight = '';
                                    element.style.overflow = '';
                                    element.style.transition = '';
                                }, 700);
                            }
                        });
                    });
                });
            </script>
        @endisset
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
                        ['#hexCalculator'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                        ['#hexConverter'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                    } else {
                        ['#hexCalculator'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#hexConverter'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                    }
                });
            });
            document.getElementById('option1').addEventListener('click', function() {
                document.getElementById('nmbr').value = '34A';
                setHexInput();
            });
            document.getElementById('option2').addEventListener('click', function() {
                document.getElementById('nmbr').value = '42';
                setDecInput();
            });
            document.getElementById('option3').addEventListener('click', function() {
                document.getElementById('nmbr').value = '54f';
                setHexInput();
            });
            document.getElementById('option4').addEventListener('click', function() {
                document.getElementById('nmbr').value = '101010';
                setBinInput();
            });
            function setHexInput() {
                document.getElementById('nmbr').addEventListener('keypress', function(e) {
                    if ((e.which >= 48 && e.which <= 57) || // 0-9
                        (e.which >= 97 && e.which <= 102) || // a-f
                        (e.which >= 65 && e.which <= 70)) { // A-F
                    return true;
                    } else {
                    e.preventDefault();
                    }
                });
            }
            function setDecInput() {
                document.getElementById('nmbr').addEventListener('keypress', function(e) {
                    if (e.which >= 48 && e.which <= 57) { // 0-9
                    return true;
                    } else {
                    e.preventDefault();
                    }
                });
            }
            function setBinInput() {
                document.getElementById('nmbr').addEventListener('keypress', function(e) {
                    if (e.which == 48 || e.which == 49 || e.which == 8) { // 0, 1, backspace
                    return true;
                    } else {
                    e.preventDefault();
                    }
                });
            }
            document.getElementById('bnr_frs').addEventListener('keypress', function(e) {
                if ((e.which >= 48 && e.which <= 57) || // 0-9
                    (e.which >= 97 && e.which <= 102) || // a-f
                    (e.which >= 65 && e.which <= 70)) { // A-F
                    return true;
                } else {
                    e.preventDefault();
                }
            });
            document.getElementById('bnr_sec').addEventListener('keypress', function(e) {
                if ((e.which >= 48 && e.which <= 57) || // 0-9
                    (e.which >= 97 && e.which <= 102) || // a-f
                    (e.which >= 65 && e.which <= 70)) { // A-F
                    return true;
                } else {
                    e.preventDefault();
                }
            });
            document.querySelectorAll('.bnry_inputs').forEach(function(element) {
                element.addEventListener('paste', function(e) {
                    var data = e.clipboardData.getData('Text');
                    if (data.length > 0) {
                    e.preventDefault();
                    }
                });
            });
            document.getElementById('nmbr').addEventListener('paste', function(e) {
                var datai = e.clipboardData.getData('Text');
                if (datai.length > 0) {
                    e.preventDefault();
                }
            });
        </script>
    @endpush
</form>