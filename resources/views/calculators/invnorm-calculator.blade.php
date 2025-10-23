<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">
                
                <div class="col-span-12">
                    <label for="p" class="font-s-14 text-blue">{{ $lang['1'] }} ({{ $lang['9'] }})</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" min="0" max="1" name="p" id="p" value="{{ isset($_POST['p'])?$_POST['p']:'0.13' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="mean" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="mean" id="mean" value="{{ isset($_POST['mean'])?$_POST['mean']:'0' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="sd" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="sd" id="sd" value="{{ isset($_POST['sd'])?$_POST['sd']:'4' }}" class="input" aria-label="input" placeholder="00" />
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
                                $request = request();
                                $sd = $request->sd;
                                $mean = $request->mean;
                                $p = $request->p;
                            @endphp
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue"><?=$lang['4']?></strong></td>
                                        <td class="py-2 border-b"><strong>P(z < <?=$detail['blow']?>)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue"><?=$lang['5']?></strong></td>
                                        <td class="py-2 border-b"><strong>P(z > <?=$detail['above']?>)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue"><?=$lang['6']?></strong></td>
                                        <td class="py-2 border-b"><strong>P(z < <?=$detail['ll1']?> & z > <?=$detail['ul1']?>)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong class="text-blue"><?=$lang['7']?></strong></td>
                                        <td class="py-2 border-b"><strong>P(z < <?=$detail['ll']?> & z > <?=$detail['ul']?>)</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-3">
                                <label for="which"><strong class="text-blue">{{ $lang['8'] }}:</strong></label>
                                <div class="w-full py-2">
                                    <select name="which" id="which" class="input" autocomplete="off">
                                        <option value="1"><?=$lang['4']?></option>
                                        <option value="2"><?=$lang['5']?></option>
                                        <option value="3"><?=$lang['6']?></option>
                                        <option value="4"><?=$lang['7']?></option>
                                    </select>
                                </div>
                            </div>
                            <canvas id="normal" class="w-full md:w-[50%] lg:w-[50%]" height="200"></canvas>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script>
            var ctx,h,w,box;
            var inset = 20;
            function rect(x1,y1,x2,y2){
                this.x1=x1
                this.x2=x2
                this.y1=y1
                this.y2=y2
            }

            function linTran(x0,xf,y0,yf) {
                r = new Array(2)
                r[1]=(yf-y0)/(xf-x0);
                r[0] = (yf+y0)/2- r[1] * (xf+x0)/2;
                return r;
            }
            function init() {
                canvas = document.getElementById('normal'); 
                ctx = canvas.getContext('2d');
                h = canvas.height 
                w = canvas.width
                var x1 = inset
                var x2 = x1+w - 2*inset
                
                var y1 = inset
                var y2 = y1+ h - 2*inset
                box = new rect(x1,y1,x2,y2)

                
            }

            function drawchart() {
                
                var pVal = parseFloat(<?=$p?>);
                var M = parseFloat(<?=$mean?>);
                var sd = parseFloat(<?=$sd?>)
                var tail = false
                
                ll = parseFloat(<?=$detail['above']?>);
                ul=999999;
                z=(M-ll)/sd;
                pVal=Math.round(ZeePro(z)*10000)/10000;
                
                if(sd<=0) return
                
                ctx.clearRect(0,0,w,h)
                ctx.fillStyle="#eeeeee2e"
                ctx.fillRect(0,0,w,h)
                
                finaldram(ctx,box,M,sd,ll,ul,tail)
                
            }
            document.getElementById('which').addEventListener('change', function() {
                var which = document.getElementById('which').value;
                var pVal = parseFloat(<?=$p?>);
                var M = parseFloat(<?=$mean?>);
                var sd = parseFloat(<?=$sd?>)
                var tail = false
                if (which==1) {
                    
                    ll = parseFloat(<?=$detail['above']?>);
                    ul=999999;
                    z=(M-ll)/sd;
                    pVal=Math.round(ZeePro(z)*10000)/10000;
                }else if(which==2){
                    ul = parseFloat(<?=$detail['blow']?>);
                    ll=-999999
                    z=(M-ul)/sd
                    var p = 1-ZeePro(z)
                    pVal=Math.round(p*10000)/10000
                }else if(which==3){
                    tail = true
                    ll = parseFloat(<?=$detail['blow']?>)
                    ul = parseFloat(<?=$detail['above']?>)
                    z1=(ll-M)/sd
                    z2 = (ul-M)/sd

                    zp = ZeePro(z1) +(1- ZeePro(z2))
                    pVal=Math.round(zp*10000)/10000
                }else{
                    ll = parseFloat(<?=$detail['ll']?>)
                    ul = parseFloat(<?=$detail['ul']?>)
                    z1=(ll-M)/sd
                    z2 = (ul-M)/sd
                    zp = ZeePro(z2) - ZeePro(z1)
                    pVal=Math.round(zp*10000)/10000
                }
                if(sd<=0) return
                
                ctx.clearRect(0,0,w,h)
                ctx.fillStyle="#eeeeee2e"
                ctx.fillRect(0,0,w,h)
                
                finaldram(ctx,box,M,sd,ll,ul,tail)
            })
            function ZeePro(z) {

                if (z < -7) {
                    return 0.0;
                }
                if (z > 7) {
                    return 1.0;
                }


                if (z < 0.0) {
                    flag = true;
                }
                else {
                    flag = false;
                }

                z = Math.abs(z);
                b = 0.0;
                s = Math.sqrt(2) / 3 * z;
                HH = 0.5;
                for (let i = 0; i < 12; i++) {
                    a = Math.exp(-HH * HH / 9) * Math.sin(HH * s) / HH;
                    b = b + a;
                    HH = HH + 1.0;
                }
                p = .5 - b / Math.PI;
                if (!flag) {
                    p = 1.0 - p;
                }
                return p;
            }
            function finaldram(ctx,box,M,sd,lFill,hFill, tail) {
                ctx.beginPath()
                
                var w = box.x2-box.x1
                var h = box.y2-box.y1
                
                var v = sd*sd
                var constant = 1/Math.sqrt(2*Math.PI*v)
                var x=M
                
                var maxDensity = constant
                
                var r = linTran(0,1.1*maxDensity,h,box.y1)
                
                var Ay=r[0]
                var by=r[1]

                
                var lowX = M - 3.5*sd
                var highX = M + 3.5*sd

                var r = linTran(lowX,highX,box.x1,box.x2)
                
                var Ax=r[0]; var bx=r[1]


                var x0 = lowX*bx+Ax
                var xf=highX*bx+Ax
                
            ctx.moveTo(xf,Ay)
            ctx.lineTo(x0,Ay)
            
                var inc = 1/bx

            var dmax = 0
            


            for (var i=lowX;i<=highX;i+=inc*.5){
                    xp=bx*i +Ax
                    d =  constant*Math.exp(-Math.pow((i-M),2)/(2*v))
                    dmax = Math.max(dmax,d)
                
                    dp= by*d+Ay
                    ctx.lineTo(xp,dp) 
                    if (tail) {
                        if(i>=hFill || i <= lFill) {
                            ctx.moveTo(xp,Ay)   
                            ctx.lineTo(xp,dp+1)
                        }
                    }
                    else 
                        if(i<=hFill && i >=lFill) {
                            ctx.moveTo(xp,Ay) 
                            ctx.lineTo(xp,dp+1)
                        }
                }
                
                ctx.textAlign = "center";
                ctx.font = "14px Roboto sans-serif";
                ctx.strokeStyle = "#2845F5"
                ctx.strokeStyle = "#2845F5"
                
                y = Ay+ 15
                ctx.fillStyle = "black";
                for (var i = M - 3*sd;i<=M+3*sd;i+=sd) {
                    x=bx*i+Ax
                    ctx.moveTo(x,Ay)
                    ctx.lineTo(x,Ay+4)
                    var xlab = Math.round(1000*i)
                    xlab=xlab/1000
                    ctx.fillText(xlab, x, y+2);
                }
                ctx.stroke();
                //ctx.closePath()
                
                
            }
            init();
            drawchart();
        </script>
    @endif
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>