<style>
    .input-unit{
        top: 2px;
    }
</style>
<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
     
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  mt-2  gap-4">
                <div class="col-12">
                    <label for="a_rep" class="font-s-14 text-blue"><?=$lang['7']?> :</label>
                    <div class="py-2">
                        <input type="text" name="input1" class="input mt-1 mt-lg-0" value="{{ isset($_POST['input1'])?$_POST['input1']: '4,6,8' }}">
                    </div>
                </div>
                <div class="col-12">
                    <label for="a_rep" class="font-s-14 text-blue"><?=$lang['13']?> :</label>
                    <div class="">
                        <input type="text" name="input2" class="input mt-3 mt-lg-0" value="{{ isset($_POST['input2'])?$_POST['input2']: '3,4,5' }}">
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
                        @php
                            $components= $detail['components'];
                            $components2= $detail['components2'];
                            $length = min(count($components), count($components2));
                            $mgntd_a=  isset($detail['mgntd_a']) ? $detail['mgntd_a'] : '';
                            $mgntd_b=  isset($detail['mgntd_b']) ? $detail['mgntd_b'] : '';
                            $prod=  isset($detail['prod']) ? $detail['prod'] : '';
                            $angle=  isset($detail['angle']) ? $detail['angle'] : '';
                            $deg=  isset($detail['deg']) ? $detail['deg'] : '';
                        @endphp
                        <div class="row my-2">
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                <table class="w-full">
                                    <tr>
                                        <td width="70%" class="border-b py-2"><b ><?=$lang['15']?> :</b></td>
                                        <td class="border-b py-2"><?=$detail['prod']?> <span class="text-[20px]"></span></td>
                                    </tr>
                                </table>
                            </div>
                                <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                    <table class="col-lg-8 ">
                                        <tr>
                                            <td class="border-b py-2"><?=$lang['16']?> A => |A|</td>
                                            <td class="border-b py-2"><?=$detail['mgntd_a']?></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><?=$lang['16']?> B => |B|</td>
                                            <td class="border-b py-2"><?=$detail['mgntd_b']?></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><?=$lang['17']?> (α)</td>
                                            <td class="border-b py-2"><?=$detail['deg']?> deg</td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="mt-2 text-[18px]"><b>{{$lang['20']}}:</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = 
                                    {{-- @dd($components2) --}}
                                    @for ($i = 0; $i < $length; $i++)
                                        ({{ $components[$i] }} * {{$components2[$i] }})
                                        @if ($i < $length - 1)
                                            +
                                        @endif
                                    @endfor \)
                                </p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = 
                                    @for ($i = 0; $i < $length; $i++)
                                        ({{ $components[$i] * $components2[$i] }})
                                        @if ($i < $length - 1)
                                            +
                                        @endif
                                    @endfor \)
                                </p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = <?=$prod?> \)</p>
                
                                <p class="mt-2"><b><?=$lang['16']?> A:</b></p>
                                <p class="mt-2">\( |A|  = \sqrt
                                        @for ($i = 0; $i < $length; $i++)
                                            ({{ $components[$i] }})^2
                                            @if ($i < $length - 1)
                                                +
                                            @endif
                                        @endfor \)
                                </p>
                                <p class="mt-2">\( |A|  = \sqrt 
                                        @for ($i = 0; $i < $length; $i++)
                                            ({{ pow($components[$i],2) }})
                                            @if ($i < $length - 1)
                                                +
                                            @endif
                                        @endfor 
                                    \)</p>
                                <p class="mt-2">\( |A|  = <?=$mgntd_a?> \)</p>
                                <p class="mt-2"><b><?=$lang['16']?> B:</b></p>
                                <p class="mt-2">\( |A|  = \sqrt
                                    @for ($i = 0; $i < $length; $i++)
                                        ({{ $components2[$i] }})^2
                                        @if ($i < $length - 1)
                                            +
                                        @endif
                                    @endfor \)
                                </p>
                                <p class="mt-2">\( |A|  = \sqrt 
                                    @for ($i = 0; $i < $length; $i++)
                                        ({{ pow($components2[$i],2) }})
                                        @if ($i < $length - 1)
                                            +
                                        @endif
                                    @endfor 
                                \)</p>
                                <p class="mt-2">\( |B|  = <?=$mgntd_b?> \)</p>
                                <p class="mt-2"><b><?=$lang['17']?> A <?=$lang['21']?> B:</b></p>
                                <p class="mt-2">\( cos\theta  = (\vec A \cdot \vec B) / (|A||B|) \)</p>
                                <p class="mt-2">\( cos\theta  = (<?=$prod?>) / (<?=$mgntd_a?>*<?=$mgntd_b?>) \)</p>
                                <p class="mt-2">\( cos\theta  = <?=$angle?> \)</p>
                                <p class="mt-2">\( \theta  =(cos)^{-1} <?=$angle?> \)</p>
                                <p class="mt-2">\( \theta  = <?=$deg?> \text{ deg} \)</p>
                           
                        </div>
                        <div class="col-12 text-center mt-[20px]">
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

@if(isset($detail))
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.js" ></link>
    <script defer src="{{ url('katex/auto-render.min.js') }}" 
    onload="renderMathInElement(document.body);"></script>
@endif
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>