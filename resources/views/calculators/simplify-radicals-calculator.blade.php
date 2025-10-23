<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="expression_unit" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="w-100 py-2">
                        <select name="expression_unit" id="expression_unit" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[2],$lang[3],$lang[4],$lang[5]];
                                $val = ["1","2","3","4"];
                                optionsList($val,$name,isset($_POST['expression_unit'])?$_POST['expression_unit'] : '1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 text-center">
                    <p class="simplify {{isset(request()->expression_unit) && request()->expression_unit == 1 ? 'block' : 'hidden'}}">
                        $$ a\sqrt[n]b$$
                    </p>
                     <p class="simplify1 {{isset(request()->expression_unit) && request()->expression_unit == 2 ? 'block' : 'hidden'}}">
                         $$ a\sqrt[n]b+c\sqrt[m]d=?$$
                    </p>
                     <p class="simplify2 {{isset(request()->expression_unit) && request()->expression_unit == 3 ? 'block' : 'hidden'}}">
                         $$ a\sqrt[n]b.c\sqrt[m]d=? $$
                    </p>
                     <p class="simplify3 {{isset(request()->expression_unit) && request()->expression_unit == 4 ? 'block' : 'hidden'}}">
                         $$ \frac{a\sqrt[n]b}{c\sqrt[m]d}=? $$
                    </p>
                  </div>
                <div class="col-span-6 num1">
                    <label for="num1" class="font-s-14 text-blue">a (<?=$lang[6]?>):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="num1" id="num1" class="input" aria-label="input" value="{{ isset($_POST['num1'])?$_POST['num1']:'5' }}" />
                    </div>
                </div>
                <div class="col-span-6 num2">
                    <label for="num2" class="font-s-14 text-blue r">b:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="num2" id="num2" class="input" aria-label="input"  value="{{ isset($_POST['num2'])?$_POST['num2']: '7' }}" />
                    </div>
                </div>
                <div class="col-span-6 num3">
                    <label for="num3" class="font-s-14 text-blue r">n:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="num3" id="num3" class="input" aria-label="input"  value="{{ isset($_POST['num3'])?$_POST['num3']: '7' }}" />
                    </div>
                </div>
                <div class="col-span-6 num4">
                    <label for="num4" class="font-s-14 text-blue r">c (<?=$lang[6]?>):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="num4" id="num4" class="input" aria-label="input"  value="{{ isset($_POST['num4'])?$_POST['num4']: '7' }}" />
                    </div>
                </div>
                <div class="col-span-6 num5">
                    <label for="num5" class="font-s-14 text-blue r">d:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="num5" id="num5" class="input" aria-label="input"  value="{{ isset($_POST['num5'])?$_POST['num5']: '7' }}" />
                    </div>
                </div>
                <div class="col-span-6 num6">
                    <label for="num6" class="font-s-14 text-blue r">m:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="num6" id="num6" class="input" aria-label="input"  value="{{ isset($_POST['num6'])?$_POST['num6']: '7' }}" />
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
                        @php
                            $shape = request()->shape;
                        @endphp
                        <div class="w-full my-2">
                            <div class="text-center">
                                <p class="text-[20px]"><strong><?=$lang[7]?>:</strong></p>
                                <div class="col-12">
                                    <div class="all_result">
                                        <p class="text-[20px] mt-2">
                                            
                                        </p>
                                    </div>
                                </div>
                                <?php
                                    $number1=$detail['num1'];
                                    $number2=$detail['num2'];
                                    $number3=$detail['num3'];
                                    $number4=$detail['num4'];
                                    $number5=$detail['num5'];
                                    $number6=$detail['num6'];
                                    $expression_unit=$detail['expression_unit'];
                                ?>      
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" async
    src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML">
</script>
    <script>
        var unit = $("#expression_unit").val();
        if(unit=="1"){
            $(".num1,.num2,.num3,.simplify").show();
            $(".num4,.num5,.num6,.simplify1,.simplify2,.simplify3").hide();
        }
        $("#expression_unit").on("change",function(){
            var w=$(this).val();
            if(w=="1"){
                $(".num1,.num2,.num3,.simplify").show();
                $(".num4,.num5,.num6,.simplify1,.simplify2,.simplify3").hide();
            }else if(w=="2"){
                $(".num1,.num2,.num3,.num4,.num5,.num6,.simplify1").show();
                $(".simplify,.simplify2,.simplify3").hide();
            }
            else if(w=="3"){
                $(".num1,.num2,.num3,.num4,.num5,.num6,.simplify2").show();
                $(".simplify,.simplify1,.simplify3").hide();
            }
            else if(w=="4"){
                $(".num1,.num2,.num3,.num4,.num5,.num6,.simplify3").show();
                $(".simplify,.simplify1,.simplify2").hide();
            }
        });

        @if(isset($detail))
            function addHtml(argument) {
            $('.all_result').append(argument);
            }
            function calculate() 
            {
            var a =<?php echo $number1; ?>;
            var b = <?php echo $number2; ?>;
            var c = <?php echo $number4; ?>;
            var d = <?php echo $number5; ?>;
            var n = <?php echo $number3; ?>;
            var m = <?php echo $number6 ?>;
            var option =<?php echo $expression_unit; ?>;
            var newRoot = n;
            var simplification_first;
            var simplification_second;
            var numberwrite = n;
            var mWrite = m;
            var num1Write, cWrite;
            var fline = '', sline = '', tline = '', lline = '';
            var number_in_front;
            var expresssion_first, expression_second;
            var operation = '';


            if (n == 2) {
                numberwrite = '';
            }
            if (m == 2) {
                mWrite = '';
            }
            if (isNaN(a) || a == 1) {
                a = 1;
                num1Write = '';
            } else {
                num1Write = a + ' * ';
            }
            if (isNaN(c) || c == 1) {
                c = 1;
                cWrite = '';
            } else {
                cWrite = c + ' * ';
            }

            expresssion_first = [a,n,b];
            expression_second = [c,m,d];

            if (!isNaN(b)) {
                if (isInteger(Math.pow(b,1/n)) && option == 1) {
                addHtml("<p class='font-s-25 mt-2 text-blue'>"+num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' = ' + (a * Math.pow(b,1/n))+"</p>");
                return;
                } else { 
                if (!isNaN(n)) {
                    simplification_first = getSimplification(b,n);
                }
                }
            }

            if (!isNaN(d)) {
                
                if (!isNaN(m)) {
                    simplification_second = getSimplification(d,m);
                }
            
            }

            if (!isNaN(b) && !isNaN(n) && (option == 1 || (!isNaN(d) && !isNaN(m)))) {
                ////////////////////////////////////////////////
                ///////////////////OPTION 1/////////////////////
                ////////////////////////////////////////////////

                if (option == 1) {
            
                fline += "<p class='font-s-25 mt-2 text-blue'>"+num1Write + '<sup>' + numberwrite + '</sup>√' + b+"</p>";

                /////////There is some simplification/////////

                if (simplification_first.length > 2) {
                    fline +=  ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ') =';
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+fline+"</p>");

                    sline += "<p>"+'= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')'+"</p>";
                    expresssion_first[0] = a*simplification_first[2][0];
                    expresssion_first[2] = b / Math.pow(simplification_first[2][0],n);

                    /////////Simplification on the root index/////////

                    if (simplification_first.length > 3) {
                    sline += ' =';
                    if (simplification_first[2][0] != 1) {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                    }

                    if (simplification_first[3][1] == 2) {
                        numberwrite = '';
                    } else {
                        numberwrite = simplification_first[3][1];
                    }
                    if (a * simplification_first[3][0] == 1) {
                        num1Write = '';
                    } else {
                        num1Write = a * simplification_first[3][0];
                    }
                    tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2];
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+tline+"</p>");
                    expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                    expresssion_first[1] = simplification_first[3][1];
                    } else {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                    }

                    if (expresssion_first[0] == 1) {
                    expresssion_first[0] = '';
                    } else {
                    expresssion_first[0] += ' * ';
                    }
                    if (expresssion_first[1] == 2) {
                    expresssion_first[1] = '';
                    }

                    lline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2];
                    if (lline != sline && lline != tline) {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+lline+"</p>");
                    }
                } else {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+fline+"</p>");

                    addHtml('<p class="font-s-20 mt-2"><?=$lang[8]?>.</p>');
                }
                }
                
                ////////////////////////////////////////////////
                ///////////////////OPTION 2/////////////////////
                ////////////////////////////////////////////////

                else if (option == 2) {
                
                if (c >= 0) {
                    operation = ' + ';
                } else {
                    operation = ' ';
                }
                if (isInteger(Math.pow(b,1/n)) && isInteger(Math.pow(d,1/m))) {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + (a * Math.pow(b,1/n)) + ' + ' + (c * Math.pow(d,1/m)) + ' = ' + (a * Math.pow(b,1/n) + c * Math.pow(d,1/m))+"</p>");
                }
                
                else if (isInteger(Math.pow(b,1/n))) {
                    fline += "<p class='font-s-25 mt-2 text-blue'>"+num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d+"</p>";
                    if (simplification_second.length > 2) {
                    fline += "<p class='font-s-25 mt-2 text-blue'>"+ ' = ' + Math.pow(b,1/n) + operation + cWrite + '<sup>' + mWrite + '</sup>√(' + simplification_second[1] + ') =';
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+fline+"</p>");

                    sline += "<p class='font-s-25 mt-2 text-blue'>"+'= ' + Math.pow(b,1/n) + operation + cWrite + simplification_second[2][0] + ' * ' + '<sup>' + mWrite + '</sup>√(' + simplification_second[2][1] + ')'+"</p>";
                    expression_second[0] = c*simplification_second[2][0];
                    expression_second[2] = d / Math.pow(simplification_second[2][0],m);

                    /////////Simplification on the root index/////////

                    if (simplification_second.length > 3) {
                        sline += ' =';
                        if (simplification_second[2][0] != 1) {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                        }

                        if (simplification_second[3][1] == 2) {
                        mWrite = '';
                        } else {
                        mWrite = simplification_second[3][1];
                        }
                        if (c * simplification_second[3][0] == 1) {
                        cWrite = '';
                        } else {
                        cWrite = c * simplification_second[3][0];
                        }
                        tline += '= ' + Math.pow(b,1/n) + operation + cWrite + '<sup>' + mWrite + '</sup>√' + simplification_second[3][2];
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+tline+"</p>");
                        expression_second[2] = Math.pow(expression_second[2], 1/(expression_second[1] / simplification_second[3][1]));
                        expression_second[1] = simplification_second[3][1];
                    } else {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                    }

                    if (expression_second[0] == 1) {
                        expression_second[0] = '';
                    } else {
                        expression_second[0] += ' * ';
                    }
                    if (expression_second[1] == 2) {
                        expression_second[1] = '';
                    }

                    lline += '= ' + Math.pow(b,1/n) + operation + expression_second[0] + '<sup>' + expression_second[1] + '</sup>√' + expression_second[2];
                    if (lline != sline && lline != tline) {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+lline+"</p>");
                    }
                    } else {
                    fline += ' = ' + Math.pow(b,1/n) + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d;
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+fline+"</p>")
                    }
                }
                
                else if (isInteger(Math.pow(d,1/m))) {
                    fline += num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d;
                    if (simplification_first.length > 2) {
                    fline +=  ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ')' + operation + Math.pow(d,1/m) + ' =';
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+fline+"</p>")

                    sline += '= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')' + operation + Math.pow(d,1/m);
                    expresssion_first[0] = a*simplification_first[2][0];
                    expresssion_first[2] = b / Math.pow(simplification_first[2][0],n);

                    /////////Simplification on the root index/////////

                    if (simplification_first.length > 3) {
                        sline += ' =';
                        if (simplification_first[2][0] != 1) {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                        }

                        if (simplification_first[3][1] == 2) {
                        numberwrite = '';
                        } else {
                        numberwrite = simplification_first[3][1];
                        }
                        if (a * simplification_first[3][0] == 1) {
                        num1Write = '';
                        } else {
                        num1Write = a * simplification_first[3][0];
                        }
                        tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2] + operation + Math.pow(d,1/m);
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+tline+"</p>");
                        expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                        expresssion_first[1] = simplification_first[3][1];
                    } else {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                    }

                    if (expresssion_first[0] == 1) {
                        expresssion_first[0] = '';
                    } else {
                        expresssion_first[0] += ' * ';
                    }
                    if (expresssion_first[1] == 2) {
                        expresssion_first[1] = '';
                    }

                    lline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2] + operation + Math.pow(d,1/m);
                    if (lline != sline && lline != tline) {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+lline+"</p>");
                    }
                    } else {
                    fline += ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + Math.pow(d,1/m);
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+fline+"</p>")
                    }
                }
                
                else {
                    fline += num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ';

                    /////////There is some simplification/////////

                    if (simplification_first.length > 2 && simplification_second.length > 2) {
                    fline += num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ')' + operation + cWrite + '<sup>' + mWrite + '</sup>√(' + simplification_second[1] + ') =';
                    addHtml("<p>"+fline+"</p>")
                    sline += '= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')' + operation + cWrite + simplification_second[2][0] + ' * ' + '<sup>' + mWrite + '</sup>√(' + simplification_second[2][1] + ')';

                    expresssion_first[0] = a*simplification_first[2][0];
                    expresssion_first[2] = b / Math.pow(simplification_first[2][0],n);
                    expression_second[0] = c*simplification_second[2][0];
                    expression_second[2] = d / Math.pow(simplification_second[2][0],m);
                    if (expresssion_first[0] == 1) {
                        expresssion_first[0] = '';
                    }
                    if (expresssion_first[1] == 2) {
                        expresssion_first[1] = '';
                    }
                    if (expression_second[0] == 1) {
                        expression_second[0] = '';
                    }
                    if (expression_second[1] == 2) {
                        expression_second[1] = '';
                    }

                    /////////Simplification on the root index/////////

                    if (simplification_first.length > 3 && simplification_second.length > 3) {
                        sline += ' =';
                        if (simplification_first[2][0] != 1 && simplification_second[2][0] != 1) {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                        }
                        if (simplification_first[3][1] == 2) {
                        numberwrite = '';
                        } else {
                        numberwrite = simplification_first[3][1];
                        }
                        if (a * simplification_first[3][0] == 1) {
                        num1Write = '';
                        } else {
                        num1Write = a * simplification_first[3][0];
                        }
                        if (simplification_second[3][1] == 2) {
                        mWrite = '';
                        } else {
                        mWrite = simplification_second[3][1];
                        }
                        if (a * simplification_second[3][0] == 1) {
                        cWrite = '';
                        } else {
                        cWrite = c * simplification_second[3][0];
                        }

                        expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                        expresssion_first[1] = simplification_first[3][1];
                        expression_second[2] = Math.pow(expression_second[2], 1/(expression_second[1] / simplification_second[3][1]));
                        expression_second[1] = simplification_second[3][1];

                        tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2] + operation + cWrite + '<sup>' + mWrite + '</sup>√' + simplification_second[3][2];
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+tline+"</p>");
                        
                    } else if (simplification_first.length > 3 && simplification_second.length <= 3) {
                        if (simplification_first[2][0] != 1 && simplification_second[2][0] != 1) {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                        }
                        if (simplification_first[3][1] == 2) {
                        numberwrite = '';
                        } else {
                        numberwrite = simplification_first[3][1];
                        }
                        if (a * simplification_first[3][0] == 1) {
                        num1Write = '';
                        } else {
                        num1Write = a * simplification_first[3][0];
                        }

                        expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                        expresssion_first[1] = simplification_first[3][1];

                        tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2] + operation + expression_second[0] + '<sup>' + expression_second[1]+ '</sup>√' + expression_second[2];
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+tline+"</p>");

                    } else if (simplification_first.length <= 3 && simplification_second.length > 3) {
                        if (simplification_first[2][0] != 1 && simplification_second[2][0] != 1) {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                        }
                        if (simplification_second[3][1] == 2) {
                        mWrite = '';
                        } else {
                        mWrite = simplification_second[3][1];
                        }
                        if (a * simplification_second[3][0] == 1) {
                        cWrite = '';
                        } else {
                        cWrite = c * simplification_second[3][0];
                        }

                        expression_second[2] = Math.pow(expression_second[2], 1/(expression_second[1] / simplification_second[3][1]));
                        expression_second[1] = simplification_second[3][1];
                        
                        tline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1]+ '</sup>√' + expresssion_first[2] + operation + cWrite + '<sup>' + mWrite + '</sup>√' + simplification_second[3][2];
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+tline+"</p>");

                    } else {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                    }
                    } else if (simplification_first.length > 2 && simplification_second.length <= 2) {
                    if (c == 1) {
                        cWrite ='';
                    }
                    fline += num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ')' + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' =';
                    addHtml("<p>"+fline+"</p>")
                    sline += '= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')' + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d;

                    expresssion_first[0] = a*simplification_first[2][0];
                    expresssion_first[2] = b / Math.pow(simplification_first[2][0],n);

                    if (simplification_first.length > 3) {
                        sline += ' =';

                        expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                        expresssion_first[1] = simplification_first[3][1];

                        if (simplification_first[2][0] != 1) {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                        }
                        if (simplification_first[3][1] == 2) {
                        numberwrite = '';
                        } else {
                        numberwrite = simplification_first[3][1];
                        }
                        if (a * simplification_first[3][0] == 1) {
                        num1Write = '';
                        } else {
                        num1Write = a * simplification_first[3][0];
                        }

                        tline +="<p class='font-s-25 mt-2 text-blue'>"+'= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2] + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d+"</p>";

                        addHtml(tline);
                    } else {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                    }
                    } else if (simplification_first.length <= 2 && simplification_second.length > 2) {
                    if (a == 1) {
                        num1Write ='';
                    }
                    fline += num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√(' + simplification_second[1] + ') =';
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+fline+"</p>")
                    sline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + simplification_second[2][0] + ' * ' + '<sup>' + mWrite + '</sup>√(' + simplification_second[2][1] + ')';

                    expression_second[0] = c*simplification_second[2][0];
                    expression_second[2] = d / Math.pow(simplification_second[2][0],m);

                    if (simplification_second.length > 3) {
                        sline += ' =';

                        expression_second[2] = Math.pow(expression_second[2], 1/(expression_second[1] / simplification_second[3][1]));
                        expression_second[1] = simplification_second[3][1];

                        if (simplification_second[2][0] != 1) {
                        addHtml("<p>"+sline+"</p>");
                        }
                        if (simplification_second[3][1] == 2) {
                        mWrite = '';
                        } else {
                        mWrite = simplification_second[3][1];
                        }
                        if (a * simplification_second[3][0] == 1) {
                        cWrite = '';
                        } else {
                        cWrite = c * simplification_second[3][0];
                        }

                        tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + simplification_second[3][2];

                        addHtml(tline);
                    } else {
                        addHtml("<p>"+sline+"</p>");
                    }

                    } else if (b == d && n == m) {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + (a+c) + '<sup>' + numberwrite + '</sup>√' + b+"</p>");
                    return;
                    } else {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+num1Write + '<sup>' + numberwrite + '</sup>√' + b + operation + cWrite + '<sup>' + mWrite + '</sup>√' + d+"</p>");
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+'<?=$lang[8]?>.'+"</p>");
                    }

                    if (simplification_first.length > 2 || simplification_second.length > 2) {
                    number_in_front = expresssion_first[0] + expression_second[0];

                    if (expresssion_first[0] == 1) {
                        expresssion_first[0] = '';
                    } else {
                        expresssion_first[0] += ' * ';
                    }
                    if (expresssion_first[1] == 2) {
                        expresssion_first[1] = '';
                    }
                    if (expression_second[0] == 1) {
                        expression_second[0] = '';
                    } else {
                        expression_second[0] += ' * ';
                    }
                    if (expression_second[1] == 2) {
                        expression_second[1] = '';
                    }

                    lline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2] + operation + expression_second[0] + '<sup>' + expression_second[1] + '</sup>√' + expression_second[2];
                    if (lline != sline && lline != tline) {
                        addHtml("<p>"+lline+"</p>");
                    }
                    }

                    if (expresssion_first[1] == expression_second[1] && expresssion_first[2] == expression_second[2]) {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+'= ' + number_in_front + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2]+"</p>");
                    }
                }
                }
                
                ////////////////////////////////////////////////
                ///////////////////OPTION 3/////////////////////
                ////////////////////////////////////////////////

                else if (option == 3) {
                if (isInteger(Math.pow(b,1/n)) && isInteger(Math.pow(d,1/m))) {
                    addHtml("<p>"+num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' * ' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + num1Write + Math.pow(b,1/n) + ' * ' + cWrite + Math.pow(d,1/m) + ' = ' + (a * Math.pow(b,1/n) * c * Math.pow(d,1/m)))+"</p>";
                    return;
                } else if (isInteger(Math.pow(b,1/n))) {
                    addHtml("<p>"+num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' * ' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + num1Write + Math.pow(b,1/n) + ' * ' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' ='+"</p>");
                    a = a * Math.pow(b,1/n) * c;
                    num1Write = a + ' * ';
                    if (a == 1) {
                    num1Write = '';
                    }
                    b = d
                    n = m;
                    numberwrite = mWrite;
                } else if (isInteger(Math.pow(d,1/m))) {
                    addHtml("<p>"+num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' * ' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' * ' + cWrite + Math.pow(d,1/m) + ' ='+"</p>");
                    a = a * c * Math.pow(d,1/m);
                    num1Write = a + ' * ';
                    if (a == 1) {
                    num1Write = '';
                    }
                } else {
                    newRoot = simply_lcm(n,m);
                    if (newRoot == 2) {
                    newRoot = '';
                    }
                    number_in_front = a * c;
                    if (number_in_front == 1) {
                    number_in_front = '';
                    } else {
                    number_in_front += ' * ';
                    }
                    addHtml("<p>"+num1Write + '<sup>' + numberwrite + '</sup>√' + b + ' * ' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = ' + number_in_front + '<sup>' + newRoot + '</sup>√(' + (Math.pow(b,simply_lcm(n,m)/n)) + ' * ' + (Math.pow(d,simply_lcm(n,m)/m)) + ') = '+"</p>");

                    b = Math.pow(b,simply_lcm(n,m)/n) * Math.pow(d,simply_lcm(n,m)/m);
                    a = a * c;
                    num1Write = a + ' * ';
                    n = simply_lcm(n,m);
                    numberwrite = n;
                    expresssion_first = [a,n,b];
                    if (a == 1) {
                    num1Write = '';
                    }
                    if (n == 2) {
                    numberwrite = '';
                    }
                }
                fline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b;

                simplification_first = getSimplification(b,n);

                if (isInteger(Math.round(Math.pow(b,1/n), 5))) {
                    fline += ' = ' + Math.round(Math.pow(b,1/n), 5);
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+fline+"</p>")
                    return;
                } else if (simplification_first.length > 2) {
                    fline +=  ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ') =';
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+fline+"</p>")

                    sline += '= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')';
                    expresssion_first[0] = a*simplification_first[2][0];
                    expresssion_first[2] = b / Math.pow(simplification_first[2][0],n);

                    /////////Simplification on the root index/////////

                    if (simplification_first.length > 3) {
                    sline += ' =';
                    if (simplification_first[2][0] != 1) {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                    }

                    if (simplification_first[3][1] == 2) {
                        numberwrite = '';
                    } else {
                        numberwrite = simplification_first[3][1];
                    }
                    if (a * simplification_first[3][0] == 1) {
                        num1Write = '';
                    } else {
                        num1Write = a * simplification_first[3][0];
                    }
                    tline +="<p class='font-s-25 mt-2 text-blue'>"+ '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2]+"</p>";
                    addHtml(tline);
                    expresssion_first[2] = Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1]));
                    expresssion_first[1] = simplification_first[3][1];
                    } else {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                    }

                    if (expresssion_first[0] == 1) {
                    expresssion_first[0] = '';
                    } else {
                    expresssion_first[0] += ' * ';
                    }
                    if (expresssion_first[1] == 2) {
                    expresssion_first[1] = '';
                    }

                    lline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2];
                    if (lline != sline && lline != tline) {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+lline+"</p>");
                    }
                } else {
                    addHtml("<p>"+fline+"</p>")
                }
                }
                
                ////////////////////////////////////////////////
                ///////////////////OPTION 4/////////////////////
                ////////////////////////////////////////////////

                else if (option == 4) {
                if (n == m && b == d) {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+'(' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ') = ' + (a / c)+"</p>");
                    return;
                } else if (isInteger(Math.pow(b,1/n)) && isInteger(Math.pow(d,1/m))) {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+'(' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ' = (' + num1Write + Math.pow(b,1/n) + ') / (' + cWrite + Math.pow(d,1/m) + ') = ' + (Math.round((a*Math.pow(b,1/n)) / (c*Math.pow(d,1/m)),3))+"</p>");
                    return;
                } else if (isInteger(Math.pow(b,1/n))) {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+'(' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ') = (' + num1Write + Math.pow(b,1/n) + ') * (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ') ='+"</p>");
                    a = Math.round(a * Math.pow(b,1/n) / (c * d), 5);
                    num1Write = a + ' * ';
                    if (a == 1) {
                    num1Write = '';
                    }
                    b = Math.pow(d,m-1);
                    n = m;
                    numberwrite = mWrite;
                } else if (isInteger(Math.pow(d,1/m))) {
                    addHtml("<p>"+'(' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ') = (' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + Math.pow(d,1/m) + ') ='+"</p>");
                    a = Math.round(a / (c * Math.pow(d,1/m)), 5);
                    num1Write = a + ' * ';
                    if (a == 1) {
                    num1Write = '';
                    }
                } else {
                    newRoot = simply_lcm(n,m);
                    if (newRoot == 2) {
                    newRoot = '';
                    }
                    number_in_front = Math.round(a / (c * d), 5);
                    if (number_in_front == 1) {
                    number_in_front = '';
                    } else {
                    number_in_front += ' * ';
                    }
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+'(' + num1Write + '<sup>' + numberwrite + '</sup>√' + b + ') / (' + cWrite + '<sup>' + mWrite + '</sup>√' + d + ') = ' + number_in_front + '<sup>' + newRoot + '</sup>√(' + (Math.pow(b,simply_lcm(n,m)/n)) + ' * ' + (Math.pow(d,simply_lcm(n,m)/m)) + '<sup>' + (m-1) + '</sup>) = '+"</p>");

                    b = Math.round(Math.pow(b,simply_lcm(n,m)/n) * Math.pow(d,(simply_lcm(n,m)/m)*(m-1)), 5);
                    a = Math.round(a / (c*d), 5);
                    num1Write = a + ' * ';
                    n = simply_lcm(n,m);
                    numberwrite = n;
                    expresssion_first = [a,n,b];
                    if (a == 1) {
                    num1Write = '';
                    }
                    if (n == 2) {
                    numberwrite = '';
                    }
                }
                fline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + b;

                simplification_first = getSimplification(b,n);

                if (simplification_first.length > 2) {
                    fline +=  ' = ' + num1Write + '<sup>' + numberwrite + '</sup>√(' + simplification_first[1] + ') =';
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+fline+"</p>")
                    sline += '= ' + num1Write + simplification_first[2][0] + ' * ' + '<sup>' + numberwrite + '</sup>√(' + simplification_first[2][1] + ')';
                    expresssion_first[0] = Math.round(a*simplification_first[2][0], 5);
                    expresssion_first[2] = b / Math.pow(simplification_first[2][0],n);

                    /////////Simplification on the root index/////////

                    if (simplification_first.length > 3) {
                    sline += ' =';
                    if (simplification_first[2][0] != 1) {
                        addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                    }

                    if (simplification_first[3][1] == 2) {
                        numberwrite = '';
                    } else {
                        numberwrite = simplification_first[3][1];
                    }
                    if (a * simplification_first[3][0] == 1) {
                        num1Write = '';
                    } else {
                        num1Write = Math.round(a * simplification_first[3][0], 5);
                    }
                    tline += '= ' + num1Write + '<sup>' + numberwrite + '</sup>√' + simplification_first[3][2];
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+tline+"</p>");
                    expresssion_first[2] = Math.round(Math.pow(expresssion_first[2], 1/(expresssion_first[1] / simplification_first[3][1])), 5);
                    expresssion_first[1] = simplification_first[3][1];
                    } else {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+sline+"</p>");
                    }

                    if (expresssion_first[0] == 1) {
                    expresssion_first[0] = '';
                    } else {
                    expresssion_first[0] += ' * ';
                    }
                    if (expresssion_first[1] == 2) {
                    expresssion_first[1] = '';
                    }

                    lline += '= ' + expresssion_first[0] + '<sup>' + expresssion_first[1] + '</sup>√' + expresssion_first[2];
                    if (lline != sline && lline != tline) {
                    addHtml("<p class='font-s-25 mt-2 text-blue'>"+lline+"</p>");
                    }
                } else {
                    addHTml("<p>"+fline+"</p>")
                }
                }
            }
            };
            calculate();
            function compareNumbers(x, y) 
            {
            return x - y;
            }

            function isInteger(_n){
            return _n % 1 === 0; 
            }

            function primesimplify(num) 
            {
            var root = Math.sqrt(num),
                result = arguments[1] || [], //get unnamed paremeter from recursive calls
                x = 2;

            if (num % x) { //if not divisible by 2
                x = 3; //assign first odd
                while ((num % x) && ((x = x + 2) < root)) {} //iterate odds
            }
            //if no factor found then num is prime
            x = (x <= root) ? x : num;
            result.push(x); //push latest prime factor

            //if num isn't prime factor make recursive call
            return (x === num) ? result : primesimplify(num / x, result);
            }

            function forpower(primeFactors)
            {
            var i, array = [], power = 1, isShorter = false, exponents = [];
            for(i = 0; i < primeFactors.length ;i++)
            {
                if(i != primeFactors.length - 1 && primeFactors[i] == primeFactors[i + 1])
                {
                power++;
                } else
                {
                if(power != 1)
                {
                    array.push(primeFactors[i] + '<sup>' + power + '</sup>');
                    isShorter = true;
                } else
                {
                    array.push(primeFactors[i]);
                }

                exponents.push(power);
                
                power = 1;
                }
            }
            return [array, isShorter, exponents];
            }

            function getSimplification(x, root)
            {
                var simplification = [];
                var primeFactors = primesimplify(x); 
                var to_power;
                var valuesPulled = [];
                var i,j;
                var numberInFront = 1, numberUnder = 1;
                var newRoot, newUnder;
                var to_powerUnderAfter;
                var factorizationRoot, factorizationUnder;
                var simplifyRoot = [], divideRootBy = 1;

                if(primeFactors.length === 1)
                {
                    simplification.push('prime');
                } else 
                {
                    simplification.push(primeFactors.join(' * '));
                    to_power = forpower(primeFactors);

                    if(to_power[1])
                    {
                    simplification.push(to_power[0].join(' * '));

                    for (i = 0; i < to_power[2].length; i++) {
                        for (j = 0; j < Math.floor(to_power[2][i] / root); j++) {
                        valuesPulled.push(to_power[0][i][0]);
                        }
                    }

                    for (i = 0; i < valuesPulled.length; i++) {
                        numberInFront *= valuesPulled[i];
                    }
                    numberUnder = Math.round(x / Math.pow(numberInFront, root), 5);


                    factorizationRoot = primesimplify(root);
                    factorizationUnder = primesimplify(numberUnder);
                    to_powerUnderAfter = forpower(factorizationUnder);

                    for (i = 0; i < factorizationRoot.length; i++) {
                        for (j = 0; j < to_powerUnderAfter[2].length; j++) {
                        if (to_powerUnderAfter[2][j] % factorizationRoot[i] == 0) {
                            simplifyRoot.push(1)
                        } else {
                            simplifyRoot.push(0);
                        }
                        }
                        if (!simplifyRoot.includes(0)) {
                        divideRootBy *= factorizationRoot[i];
                        for (j = 0; j < to_powerUnderAfter[2].length; j++) {
                            to_powerUnderAfter[2][j] /= factorizationRoot[i];
                        }
                        }
                        simplifyRoot = [];
                    }

                    newRoot = Math.round(root / divideRootBy, 5);
                    newUnder = Math.round(Math.pow(numberUnder, 1/divideRootBy), 5);

                    if (numberInFront != 1 || newRoot !== root) {
                        simplification.push([]);
                        simplification[2].push(numberInFront);
                        simplification[2].push(to_powerUnderAfter[0].join(' * '));
                        if (newRoot !== root) {
                        simplification.push([]);
                        simplification[3].push(numberInFront);
                        simplification[3].push(newRoot);
                        simplification[3].push(newUnder);
                        }
                    }
                    }
                }
                return simplification;
            }

            function simplify_gcf(a,b) {
            a = Math.abs(a);
            b = Math.abs(b);
            if(b > a) {
                var temp = a;
                a = b;
                b = temp;
            }
            for(;;) {
                if (b == 0) {
                    return a;
                }
                a = a % b;
                // a = b.mod(a);
                if (a == 0) {
                    return b;
                }
                b = b % a;
            }
            }

            function simply_lcm(a,b) {
            return Math.abs((a*b) / simplify_gcf(a,b));
            }
        @endif

    </script>