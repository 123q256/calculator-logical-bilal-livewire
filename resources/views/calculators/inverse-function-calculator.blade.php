<style>
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

    #responseContainer ol,#responseContainer ul{
        padding-left: 20px
    }

    .mere_li p, .mere_li li:not(:has(p)){
        font-size: 17px;
        letter-spacing: .5px;
        line-height: 1.5;
        color: #000000;
    }

    .mere_li p:not(:first-child),.mere_li ol p,.mere_li ul p, .mere_li li:not(:has(p)) {
        margin-top: 12px;
    }

    #responseContainer h3,#responseContainer h2{
        font-size: 22px;
        font-weight: 600 !important;
        margin-top: 12px;
        letter-spacing: .5px;
        line-height: 1.5;
        color: #000000;
    }

    @keyframes blink {
    0%, 100% {
      border-color: transparent;
    }
    50% {
      border-color: #2845F5;
    }
  }

  #exampleLoadBtn {
    animation: blink 1s infinite;
    border: 2px solid transparent; /* Default border transparent */
    background: #1670a712;
    padding: 10x 15px;
    border-radius: 5px;
    cursor: pointer;
    color: #000000;
  }
</style>
<form class="row w-100" action="{{ url()->current() }}/" method="POST" id="myForm">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @isset($detail)
               <style>
                   #exampleLoadBtn{
                       background: #1670a712
                   }
               </style>
           @endisset
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


                <div class="col-span-12">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12 md:col-span-8 lg:col-span-8 flex items-center">
                        <label for="equ" class="label" id="heading2">{{ $lang[1] }} y = f(x) =</label>
                        </div>
                        <div class="col-span-12 md:col-span-4 lg:col-span-4 flex justify-end items-center">
                        <button type="button" class="flex items-center p-1" id="exampleLoadBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right size-4 me-1" style="transform: rotate(180deg);"><path d="M7 7h10v10"></path><path d="M7 17 17 7"></path></svg>
                            Load Example
                        </button>
                        </div>
                    </div>
                    <div class="w-100 py-2">
                        <input type="text" name="equ" id="equ" class="input" value="{{ isset($_POST['equ']) ? $_POST['equ'] : '(x+4)/(2x-5)' }}" aria-label="input" />
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
                    <div class="row">
                        <div class="col-12 text-[16px]">
                            <p class="mt-3 font-s-21">\( {{$detail['res']}} \)</p>
                            <p class="mt-3"><strong>Solution:</strong></p>
                            <p class="mt-3">{{$lang['3']}} \(y={{$detail['enter']}}\)</p>
                            <p class="mt-3">{{$lang['4']}} \(x\).</p>
                            <p class="mt-3">{{$lang['5']}}.</p>
                            <p class="mt-3">{{$lang['6']}}: \(y={{$detail['enter']}}\) {{$lang['7']}} \(x={{$detail['enter2']}}\)</p>
                            <p class="mt-3">{{$lang['8']}}: \(x={{$detail['enter2']}}\) {{$lang['9']}} \(y\)</p>
                            <p class="mt-3">\(y={{$detail['res']}}\)</p>
                        </div>
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
    @endpush
</form>