<style>
    .integral_input{
        height: 30px;
        background: var(--white);
        padding-left: 5px;
        border: 1px solid #D2D4D8;
        border-radius: 5px;
        color: var(--black);
        font-size: 15px;
        box-sizing: border-box;
        width: 35px;
        outline: 0;
    }
    .integ_symb{
        font-size: 7rem;
        line-height: normal;
    }
    .bracket_symbol{
        font-size: 5rem;
    }
    @media (max-width: 480px){
        .integ_symb{
            font-size: 4rem;
        }
        .bracket_symbol{
            font-size: 3rem;
        }
        #lby,#lbx{
            margin-top: 5px !important
        }
        #ubx,#uby{
            margin-bottom: 0px !important
        }
    }
    .topCancel{
        top: 0px;
        right: 0px;
        background-color: red;
        border-radius: 50%
    }
    .topCancel:hover{
        background-color: rgb(167, 74, 74);
    }
    .object-fit-contain{
        object-fit: contain
    }
    .gap-10{
        gap: 10px
    }
    .cropBtn{
        position: absolute;
        top: 0%;
        left: 0%;
    }

    .croppie-container {
        height: auto !important
    }

    .icon_animation {
        display: inline-block;
        position: relative;
        width: 100%;
        height: 80px;
    }
    .icon_animation samp {
        display: inline-block;
        position: absolute;
        left: 0; /* Adjusted to start from the left edge */
        background: #EEF1F5;
        animation: icon_animation 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        height: 8px;
    }
    .main_area .icon_sty:hover .icon_animation samp {
        background: #fff;
    }

    .icon_animation samp:nth-child(1) {
        top: 10px;
        animation-delay: -0.24s;
    }
    .icon_animation samp:nth-child(2) {
        top: 28px;
        left: 0; /* Starts from the left edge */
        animation-delay: -0.12s;
    }
    .icon_animation samp:nth-child(3) {
        top: 47px;
        animation-delay: 0s;
    }

    .icon_animation samp:nth-child(4) {
        top: 66px; /* Adjusted for 4th element */
        animation-delay: 0.12s; /* Slightly delayed */
    }
    .icon_animation samp:nth-child(5) {
        top: 85px; /* Adjusted for 5th element */
        animation-delay: 0.24s; /* Further delayed */
    }

    @keyframes icon_animation {
        0% {
            left: 0;
            width: 0;
        }
        50%, 100% {
            left: 0; /* Stays at the left edge */
            width: 100%; /* Expands to full width */
        }
    }

    #responseContainer{
        line-height: 2
    }
    .position-absolute{
        position: absolute
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST" enctype="multipart/form-data" id="uploader">
    <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1w  gap-2 md:gap-4 lg:gap-4">

            @php 
                $request = request();
            @endphp
            <div class="{{ isset($request->fileNames) ? 'hidden': 'flex items-center' }} align-items-center justify-content-center" id="inputsField">
                <div>
                    <input type="text" name="ubx" id="ubx" class="integral_input" value="{{ isset($request->ubx)?$request->ubx:'' }}" aria-label="input" autocomplete="off" style="margin-left: -10px;margin-bottom: 5px;"/>
                    <p class="text-blue integ_symb">∫</p>
                    <input type="text" name="lbx" id="lbx" class="integral_input" value="{{ isset($request->lbx)?$request->lbx:'' }}" aria-label="input" autocomplete="off" style="margin-left: -10px;margin-top: -5px;"/>
                </div>
                <div class="mx-2">
                    <input type="text" name="uby" id="uby" class="integral_input" value="{{ isset($request->uby)?$request->uby:'' }}" aria-label="input" autocomplete="off" style="margin-bottom: 5px;"/>
                    <p class="text-blue integ_symb">∫</p>
                    <input type="text" name="lby" id="lby" class="integral_input" value="{{ isset($request->lby)?$request->lby:'' }}" aria-label="input" autocomplete="off" style="margin-top: -5px;"/>
                </div>
                <p class="text-blue bracket_symbol">(</p>
                @if($device == "desktop")
                    <div class="col-lg-6">
                        <label for="EnterEq" class="font-s-14 text-blue">Function:</label>
                        <div class="py-2 position-relative">
                            <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'x^2 + 3xy^2 + xy' }}" aria-label="input" autocomplete="off"/>
                        </div>
                    </div>
                @else
                    <div>
                        <div class="d-flex align-items-center justify-content-between px-1">
                            <label for="EnterEq" class="font-s-14 text-blue">Function:</label>
                        </div>
                        <div class="position-relative">
                            <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'x^2 + 3xy^2 + xy' }}" aria-label="input" autocomplete="off"/>
                        </div>
                    </div>
                @endif
                <input type="file" class="hidden" name="fiLes" id="clickUpload" accept=".jpg,.jpeg,.png, .JPG, .JPEG, .PNG" multiple>
                <p class="text-blue bracket_symbol">)</p>
                <div>
                    <label for="with" class="font-s-14 text-blue">W.R.T:</label>
                    <div class="w-100 py-2">
                        <select name="with" class="input" id="with" aria-label="select">
                            <option value="xy">dxdy</option>
                            <option value="yx" {{ isset($request->with) && $request->with=='yx'?'selected':'' }}>dydx</option>
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
                        @if(isset($request->fileNames))
                            @isset($request->fileNamesw)
                                <p class="font-s-18 px-1"><b class="text-blue text-decoration-underline">Your Image</b></p>
                                <div class="w-full bg-white radius-10 p-2 my-2">
                                    <div class="col-lg-2 col-3 border bg-gray radius-10">
                                        <img loading="lazy" decoding="async" src="{{ asset('source/'.$request->fileNames) }}" alt="upload image" height="70px" width="100%" class="object-fit-contain radius-10">
                                        <input type="hidden" name="imageName" id="imageName" value="{{$request->fileNames}}">
                                    </div>
                                </div>
                            @endisset
                            {{-- <p class="font-s-18 px-1"><b class="text-blue text-decoration-underline">Answer</b></p> --}}
                            <div class="w-full bg-white radius-10 p-3 mt-2 mere_li overflow-auto pt-2" id="responseContainer">
                                <div class="w-full" id="textEffect">
                                    <div class="icon_animation">
                                        <samp></samp>
                                        <samp></samp>
                                        <samp></samp>
                                        <samp></samp>
                                        <samp></samp>
                                    </div>
                                </div>
                            </div>
                        @else
                            @php
                                $EnterEq= $request->EnterEq;
                                $with= $request->with;
                                $form= $request->form;
                                $lbx= $request->lbx;
                                $ubx= $request->ubx;
                                $lby= $request->lby;
                                $uby= $request->uby;
                            @endphp
                            <div class="w-full font-16">
                                <p class="mt-3 font-s-18"><strong>{{$lang['8']}}</strong></p>
                                <p class="mt-3 font-s-18">\( =<?=$detail['final']?>+ \mathrm{constant} \)</p>
                                @if($detail['def']=='def')
                                    <p class="mt-3 font-s-18"><strong>{{$lang['9']}}</strong></p>
                                    <p class="mt-3 font-s-18">\( =<?=$detail['finaln']?> \)</p>
                                @endif
                                <p class="mt-3"><strong>{{$lang['7']}}</strong></p>
                                <p class="mt-3">\( <?=$detail['enter']?> \)</p>
                                <p class="mt-3"><strong>{{$lang['10']}}</strong></p>
                                <p class="mt-3"><?=$lang['11']?>:</p>
                                <p class="mt-3 mb-3">\(<?=$detail['en1']?>\)</p>
                                <div class="w-full res_step">
                                    <?=$detail['step1']?>
                                </div>
                                <p class="mt-3"><?=$lang['12']?>:</p>
                                <p class="mt-3 mb-3">\(<?=$detail['en2']?>\)</p>
                                <div class="w-full res_step">
                                    <?=$detail['step2']?>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
        </script>
        @if (isset($detail) && isset($request->fileNames))
            <script>
                async function sendMessage() {
                    const messageElement = document.getElementById("questionEdit");
                    const userImageInput = document.getElementById("imageName");

                    const message = messageElement ? messageElement.innerText : '';
                    const userImage = userImageInput ? userImageInput.value : '';

                    const responseContainer = document.getElementById("responseContainer");
                    Array.from(responseContainer.children).forEach(child => {
                        if (child.id !== "textEffect") {
                            responseContainer.removeChild(child);
                        }
                    });
                    document.getElementById("textEffect").classList.remove("hidden");
                    try {
                        const response = await fetch('/api/double-integral/', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ message, userImage }) 
                        });
                        const data = await response.json();
                        document.getElementById("textEffect").classList.add("hidden");
                        const chatGPTMessage = document.createElement("div");
                        chatGPTMessage.className = "message chatgpt-message";
                        responseContainer.appendChild(chatGPTMessage);
                        const responseText = data.response;
                        let index = 0;
                        let currentContent = '';
                        function typeWriter() {
                            if (index < responseText.length) {
                                currentContent += responseText.charAt(index);
                                chatGPTMessage.innerHTML = currentContent;
                                renderMathInElement(chatGPTMessage, {
                                    delimiters: [
                                        { left: "\\(", right: "\\)", display: false },
                                        { left: "\\[", right: "\\]", display: true }
                                    ]
                                });
                                index++;
                                setTimeout(typeWriter, 5);
                            }
                        }
                        typeWriter();
                    } catch (error) {
                        document.getElementById("textEffect").classList.add("hidden");
                        const errorMessage = document.createElement("div");
                        errorMessage.className = "message error-message";
                        errorMessage.textContent = "Error: " + error.message;
                        responseContainer.appendChild(errorMessage);
                    }
                    const userInputElement = document.getElementById("userInput");
                    if (userInputElement) {
                        userInputElement.value = "";
                    }
                }
                sendMessage();
            </script>
        @endif
        <script>
            function clear_input() {
                var check = confirm("Are you sure you want to clear Equation?");
                if (check === true) {
                    document.getElementById('EnterEq').value = '';
                }
            }
            document.querySelectorAll('.keyBtn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var val = this.value;
                    var enterEq = document.getElementById('EnterEq');
                    enterEq.value += val;
                    var equ = enterEq.value;
                    EquPreview(equ, 0);
                });
            });
            document.querySelectorAll('.keyboardImg').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.querySelectorAll('.keyboard').forEach(function(keyboard) {
                        if (keyboard.style.display === 'none' || keyboard.style.display === '') {
                            keyboard.style.display = 'block';
                            keyboard.style.transition = 'display 1.5s ease-out';
                        } else {
                            keyboard.style.display = 'none';
                            keyboard.style.transition = 'display 1.5s ease-out';
                        }
                    });
                });
            });
            document.querySelectorAll('#indInput').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.querySelectorAll('.bound').forEach(function(keyboard) {
                        keyboard.style.display = 'none';
                        keyboard.style.transition = 'display 1.5s ease-out';
                    });
                });
            });
            document.querySelectorAll('#defInput').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.querySelectorAll('.bound').forEach(function(keyboard) {
                        keyboard.style.display = 'block';
                        keyboard.style.transition = 'display 1.5s ease-out';
                    });
                });
            });
        </script>
    
    @endpush
</form>