<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">


                <div class="col-span-6 left">
                    <label for="method" class="font-s-14 text-blue">{{$lang['1']}}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="method" id="method" class="input">
                            <option value="normalize"  {{ isset($_POST['method']) && $_POST['method']=='normalize'?'selected':''}}  >{{$lang[2]}}</option>
                            <option value="find"  {{ isset($_POST['method']) && $_POST['method']=='find'?'selected':''}}  >{{$lang[3]}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6 left">
                    <label for="dimen" class="font-s-14 text-blue">{{$lang['4']}}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="dimen" id="dimen" class="input">
                            <option value="3d"  {{ isset($_POST['dimen']) && $_POST['dimen'] =='3d'?'selected':'selected'}}  >3D</option>
                            <option value="2d"  {{ isset($_POST['dimen']) && $_POST['dimen'] =='2d'?'selected':''}}  >2D</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 flex justify-center">
                        <div class="" id="uv_3d">
                        <img src="{{ asset('images/uv_3d.png')}}" class="uv_img" width="130px" alt="Unit Vector - 3d">
                        </div>
                        <div class="hidden" id="uv_2d">
                        <img src="{{ asset('images/uv_2d.png')}}" class="uv_img" width="130px" alt="Unit Vector - 2d">
                        </div>
                </div>
                <div class="col-span-6 left " id="find2">
                    <label for="find" class="font-s-14 text-blue">{{$lang['5']}}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="find" id="find" class="input">
                            <option value="x"  {{ isset($_POST['find']) && $_POST['find']=='x'?'selected':''}}  >x</option>
                            <option value="y"  {{ isset($_POST['find']) && $_POST['find']=='y'?'selected':''}}  >y</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6 left " id="find3">
                    <label for="find1" class="font-s-14 text-blue">{{$lang['5']}}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="find1" id="find1" class="input">
                            <option value="x"  {{ isset($_POST['find1']) && $_POST['find1']=='x'?'selected':''}}  >x</option>
                            <option value="y"  {{ isset($_POST['find1']) && $_POST['find1']=='y'?'selected':''}}  >y</option>
                            <option value="z"  {{ isset($_POST['find1']) && $_POST['find1']=='z'?'selected':''}}  >z</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6" id="fx">
                    <label for="fx" class="font-s-14 text-blue">x</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="fx" id="fx" class="input" aria-label="input" placeholder="0" value="{{ isset($_POST['fx'])?$_POST['fx']:'0.3' }}" />
                    </div>
                </div>
                <div class="col-span-6" id="fy">
                    <label for="fy" class="font-s-14 text-blue">y</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="fy" id="fy" class="input" aria-label="input" placeholder="0" value="{{ isset($_POST['fy'])?$_POST['fy']:'0.2' }}" />
                    </div>
                </div>
                <div class="col-span-6 " id="fz">
                    <label for="fz" class="font-s-14 text-blue">y</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="fz" id="fz" class="input" aria-label="input" placeholder="0" value="{{ isset($_POST['fz'])?$_POST['fz']:'0.4' }}" />
                    </div>
                </div>
                <div class="col-span-6 " id="x">
                    <label for="x" class="font-s-14 text-blue">y</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="x" id="x" class="input" aria-label="input" placeholder="0" value="{{ isset($_POST['x'])?$_POST['x']:'2' }}" />
                    </div>
                </div>
                <div class="col-span-6 " id="y">
                    <label for="y" class="font-s-14 text-blue">y</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="y" id="y" class="input" aria-label="input" placeholder="0" value="{{ isset($_POST['y'])?$_POST['y']:'3' }}" />
                    </div>
                </div>
                <div class="col-span-6" id="z">
                    <label for="z" class="font-s-14 text-blue">z</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="z" id="z" class="input" aria-label="input" placeholder="0" value="{{ isset($_POST['z'])?$_POST['z']:'5' }}" />
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
                        @php
                            @$vx=$detail['vx'];
                            @$vy=$detail['vy'];
                            @$vz=$detail['vz'];
                            @$ex=$detail['fx'];
                            @$ey=$detail['fy'];
                            @$ez=$detail['fz'];
                            @$deg=$detail['deg'];
                            @$magnitude=$detail['magnitude'];
                            @$x=$detail['x'];
                            @$y=$detail['y'];
                            @$z=$detail['z'];
                            @endphp
                            <p class="mt-2"><strong>{{$lang[6]}}</strong></p>
                            @if(isset($_POST['method']) && $_POST['method']=="normalize")
                                <p class="mt-2"><strong>\( (x, y<?=($_POST['dimen']==='3d')?', z':''?>) = (<?=round($vx,5)?>, <?=round($vy,5)?><?=($_POST['dimen']==='3d')?', '.round($vz,5):''?>) \)</strong></p>
                                <div class="col s12">
                                <p class="mt-2"><strong><?=$lang[7]?>:</strong></p>
                                @if(isset($_POST['dimen']) && $_POST['dimen']=="2d")
                                    <p class="mt-2"><strong><?=$lang[8]?>:</strong></p>
                                    <p class="mt-2">\( (x, y) = (<?=$x?>, <?=$y?>) \)</p>
                                @elseif(isset($_POST['dimen']) && $_POST['dimen']=="3d")
                                    <p class="mt-2"><strong><?=$lang[8]?>:</strong></p>
                                    <p class="mt-2">\( (x, y, z) = (<?=$x?>, <?=$y?>, <?=$z?>) \)</p>
                                @endif
                                <p class="mt-2"><strong><?=$lang[9]?>:</strong></p>
                                <p class="mt-2">\( |\vec v| = <?=$magnitude?> \)</p>
                                <p class="mt-2">(<?=$lang[10]?> <a href="https://technical-calculator.com/vector-magnitude-calculator/" target="_blank">Vector Magnitude Calculator</a> <?=$lang[11]?>)</p>
                                @if(isset($_POST['dimen']) && $_POST['dimen']=="2d")
                                    <p class="mt-2"><strong><?=$lang[12]?> θ:</strong></p>
                                    <p class="mt-2">\( θ = <?=$deg?> \) <span class="font_size16"><strong>deg</strong></span></p>
                                @endif
                                <p class="mt-2"><?=$lang[13]?>.</p>
                                <p class="mt-2"><?=$lang[14]?>:</p>
                                <p class="mt-2">\( \vec e = \left (\dfrac{<?=$x?>}{<?=$magnitude?>}, \dfrac{<?=$y?>}{<?=$magnitude?>}<?=($_POST['dimen']==='3d')?", \dfrac{$z}{{$magnitude}}":""?> \right ) \)</p>
                                <p class="mt-2">\( \vec e \approx (<?=$vx?>, <?=$vy?><?=($_POST['dimen']==='3d')?", $vz":""?>) \)</p>
                                </div>
                            @elseif(isset($_POST['method']) && $_POST['method']=="find")
                                @if(isset($_POST['dimen']) && $_POST['dimen']=="2d")
                                    <p class="mt-2"><strong>\( (x, y) = (<?=(isset($ex))?"\color{#ff6d00}{{".round($ex,3)."}}":$fx?>, <?=(isset($ey))?"\color{#ff6d00}{{".round($ey,3)."}}":$fy?>) \)</strong></p>
                                @elseif(isset($_POST['dimen']) && $_POST['dimen']=="3d")
                                    <p class="mt-2"><strong>\( (x, y, z) = (<?=(isset($ex))?"\color{#ff6d00}{{".round($ex,3)."}}":$fx?>, <?=(isset($ey))?"\color{#ff6d00}{{".round($ey,3)."}}":$fy?>, <?=(isset($ez))?"\color{#ff6d00}{{".round($ez,3)."}}":$fz?>) \)</strong></p>
                                @endif
                                <p class="mt-2"><strong>{{ $lang[15]}}</strong></p>
                                <p class="mt-2"><strong>\( 1 \)</strong></p>
                                @if(isset($_POST['dimen']) && $_POST['dimen']=="2d")
                                    <p class="mt-2"><strong>{{ $lang[12]}} θ</strong></p>
                                    <p class="mt-2"><strong>\( θ = {{round($deg,3)}} \) <span class="font_size20">deg</span></strong></p>
                                @endif
                            @endif
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
@push('calculatorJS')
@if(isset($detail))
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
@endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var methodElement = document.getElementById('method');
            var dimenElement = document.getElementById('dimen');
            
            if (methodElement.value === 'normalize' && dimenElement.value === '3d') {
                var xElement = document.getElementById('x');
                var yElement = document.getElementById('y');
                var zElement = document.getElementById('z');
                var find2Element = document.getElementById('find2');
                var find3Element = document.getElementById('find3');
                var fxElement = document.getElementById('fx');
                var fyElement = document.getElementById('fy');
                var fzElement = document.getElementById('fz');

                xElement.style.display = 'block';
                yElement.style.display = 'block';
                zElement.style.display = 'block';
                find2Element.style.display = 'none';
                find3Element.style.display = 'none';
                fxElement.style.display = 'none';
                fyElement.style.display = 'none';
                fzElement.style.display = 'none';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('dimen').addEventListener('change', function() {
                var dimenValue = this.value;
                var methodValue = document.getElementById('method').value;

                if (dimenValue === '2d') {
                    if (methodValue === 'normalize') {
                        document.getElementById('uv_2d').style.display = 'block';
                        document.getElementById('z').style.display = 'none';
                        document.getElementById('uv_3d').style.display = 'none';
                    } else if (methodValue === 'find') {
                        document.getElementById('find2').style.display = 'block';
                        document.getElementById('uv_2d').style.display = 'block';
                        document.getElementById('find3').style.display = 'none';
                        document.getElementById('uv_3d').style.display = 'none';

                        var findValue = document.getElementById('find').value;
                        if (findValue === 'x') {
                            document.getElementById('fy').style.display = 'block';
                            document.getElementById('fx').style.display = 'none';
                        } else if (findValue === 'y') {
                            document.getElementById('fx').style.display = 'block';
                            document.getElementById('fy').style.display = 'none';
                        }
                    }
                } else if (dimenValue === '3d') {
                    if (methodValue === 'normalize') {
                        document.getElementById('z').style.display = 'block';
                        document.getElementById('uv_3d').style.display = 'block';
                        document.getElementById('uv_2d').style.display = 'none';
                    } else if (methodValue === 'find') {
                        document.getElementById('find3').style.display = 'block';
                        document.getElementById('uv_3d').style.display = 'block';
                        document.getElementById('find2').style.display = 'none';
                        document.getElementById('uv_2d').style.display = 'none';

                        var find1Value = document.getElementById('find1').value;
                        if (find1Value === 'x') {
                            document.getElementById('fy').style.display = 'block';
                            document.getElementById('fz').style.display = 'block';
                            document.getElementById('fx').style.display = 'none';
                        } else if (find1Value === 'y') {
                            document.getElementById('fx').style.display = 'block';
                            document.getElementById('fz').style.display = 'block';
                            document.getElementById('fy').style.display = 'none';
                        } else if (find1Value === 'z') {
                            document.getElementById('fx').style.display = 'block';
                            document.getElementById('fy').style.display = 'block';
                            document.getElementById('fz').style.display = 'none';
                        }
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('method').addEventListener('change', function() {
                var methodValue = this.value;
                var dimenValue = document.getElementById('dimen').value;

                if (methodValue === 'normalize') {
                    if (dimenValue === '2d') {
                        document.getElementById('x').style.display = 'block';
                        document.getElementById('y').style.display = 'block';
                        document.getElementById('find2').style.display = 'none';
                        document.getElementById('find3').style.display = 'none';
                        document.getElementById('fx').style.display = 'none';
                        document.getElementById('fy').style.display = 'none';
                        document.getElementById('z').style.display = 'none';
                    } else if (dimenValue === '3d') {
                        document.getElementById('x').style.display = 'block';
                        document.getElementById('y').style.display = 'block';
                        document.getElementById('z').style.display = 'block';
                        document.getElementById('find2').style.display = 'none';
                        document.getElementById('find3').style.display = 'none';
                        document.getElementById('fx').style.display = 'none';
                        document.getElementById('fy').style.display = 'none';
                        document.getElementById('fz').style.display = 'none';
                    }
                } else if (methodValue === 'find') {
                    if (dimenValue === '2d') {
                        document.getElementById('find2').style.display = 'block';
                        document.getElementById('fx').style.display = 'block';
                        document.getElementById('find3').style.display = 'none';
                        document.getElementById('x').style.display = 'none';
                        document.getElementById('y').style.display = 'none';
                    } else if (dimenValue === '3d') {
                        document.getElementById('find3').style.display = 'block';
                        document.getElementById('fx').style.display = 'block';
                        document.getElementById('fy').style.display = 'block';
                        document.getElementById('find2').style.display = 'none';
                        document.getElementById('x').style.display = 'none';
                        document.getElementById('y').style.display = 'none';
                        document.getElementById('z').style.display = 'none';
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('find').addEventListener('change', function() {
                var findValue = this.value;
                var fx = document.getElementById('fx');
                var fy = document.getElementById('fy');

                if (findValue === 'x') {
                    fy.style.display = 'block';
                    fx.style.display = 'none';
                } else if (findValue === 'y') {
                    fx.style.display = 'block';
                    fy.style.display = 'none';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('find1').addEventListener('change', function() {
                var find1Value = this.value;
                var fx = document.getElementById('fx');
                var fy = document.getElementById('fy');
                var fz = document.getElementById('fz');

                if (find1Value === 'x') {
                    fy.style.display = 'block';
                    fz.style.display = 'block';
                    fx.style.display = 'none';
                } else if (find1Value === 'y') {
                    fx.style.display = 'block';
                    fz.style.display = 'block';
                    fy.style.display = 'none';
                } else if (find1Value === 'z') {
                    fx.style.display = 'block';
                    fy.style.display = 'block';
                    fz.style.display = 'none';
                }
            });
        });
        
        @if(isset($detail) || isset($error))
            
                var dimenValue = document.getElementById('dimen').value;
                var methodValue = document.getElementById('method').value;

                var dimen = document.getElementById('dimen').value;
                var method = document.getElementById('method').value;

                if (dimen === '2d') {
                    if (method === 'normalize') {
                        document.getElementById('uv_2d').style.display = 'block';
                        document.getElementById('z').style.display = 'none';
                        document.getElementById('uv_3d').style.display = 'none';
                    } else if (method === 'find') {
                        document.getElementById('find2').style.display = 'block';
                        document.getElementById('uv_2d').style.display = 'block';
                        document.getElementById('find3').style.display = 'none';
                        document.getElementById('uv_3d').style.display = 'none';

                        var findValue = document.getElementById('find').value;
                        if (findValue === 'x') {
                            document.getElementById('fy').style.display = 'block';
                            document.getElementById('fx').style.display = 'none';
                        } else if (findValue === 'y') {
                            document.getElementById('fx').style.display = 'block';
                            document.getElementById('fy').style.display = 'none';
                        }
                    }
                } else if (dimen === '3d') {
                    if (method === 'normalize') {
                        document.getElementById('z').style.display = 'block';
                        document.getElementById('uv_3d').style.display = 'block';
                        document.getElementById('uv_2d').style.display = 'none';
                    } else if (method === 'find') {
                        document.getElementById('find3').style.display = 'block';
                        document.getElementById('uv_3d').style.display = 'block';
                        document.getElementById('find2').style.display = 'none';
                        document.getElementById('uv_2d').style.display = 'none';

                        var find1Value = document.getElementById('find1').value;
                        if (find1Value === 'x') {
                            document.getElementById('fy').style.display = 'block';
                            document.getElementById('fz').style.display = 'block';
                            document.getElementById('fx').style.display = 'none';
                        } else if (find1Value === 'y') {
                            document.getElementById('fx').style.display = 'block';
                            document.getElementById('fz').style.display = 'block';
                            document.getElementById('fy').style.display = 'none';
                        } else if (find1Value === 'z') {
                            document.getElementById('fx').style.display = 'block';
                            document.getElementById('fy').style.display = 'block';
                            document.getElementById('fz').style.display = 'none';
                        }
                    }
                }

                if (methodValue === 'normalize') {
                    if (dimenValue === '2d') {
                        document.getElementById('x').style.display = 'block';
                        document.getElementById('y').style.display = 'block';
                        document.getElementById('find2').style.display = 'none';
                        document.getElementById('find3').style.display = 'none';
                        document.getElementById('fx').style.display = 'none';
                        document.getElementById('fy').style.display = 'none';
                        document.getElementById('z').style.display = 'none';
                    } else if (dimenValue === '3d') {
                        document.getElementById('x').style.display = 'block';
                        document.getElementById('y').style.display = 'block';
                        document.getElementById('z').style.display = 'block';
                        document.getElementById('find2').style.display = 'none';
                        document.getElementById('find3').style.display = 'none';
                        document.getElementById('fx').style.display = 'none';
                        document.getElementById('fy').style.display = 'none';
                        document.getElementById('fz').style.display = 'none';
                    }
                } else if (methodValue === 'find') {
                    if (dimenValue === '2d') {
                        document.getElementById('find2').style.display = 'block';
                        document.getElementById('fx').style.display = 'block';
                        document.getElementById('find3').style.display = 'none';
                        document.getElementById('x').style.display = 'none';
                        document.getElementById('y').style.display = 'none';
                    } else if (dimenValue === '3d') {
                        document.getElementById('find3').style.display = 'block';
                        document.getElementById('fx').style.display = 'block';
                        document.getElementById('fy').style.display = 'block';
                        document.getElementById('find2').style.display = 'none';
                        document.getElementById('x').style.display = 'none';
                        document.getElementById('y').style.display = 'none';
                        document.getElementById('z').style.display = 'none';
                    }
                }

                var findValue = document.getElementById('find').value;
                var fx = document.getElementById('fx');
                var fy = document.getElementById('fy');

                if (findValue === 'x') {
                    fy.style.display = 'block';
                    fx.style.display = 'none';
                } else if (findValue === 'y') {
                    fx.style.display = 'block';
                    fy.style.display = 'none';
                }

                var find1Value = document.getElementById('find1').value;
                var fx = document.getElementById('fx');
                var fy = document.getElementById('fy');
                var fz = document.getElementById('fz');

                if (find1Value === 'x') {
                    fy.style.display = 'block';
                    fz.style.display = 'block';
                    fx.style.display = 'none';
                } else if (find1Value === 'y') {
                    fx.style.display = 'block';
                    fz.style.display = 'block';
                    fy.style.display = 'none';
                } else if (find1Value === 'z') {
                    fx.style.display = 'block';
                    fy.style.display = 'block';
                    fz.style.display = 'none';
                }
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>