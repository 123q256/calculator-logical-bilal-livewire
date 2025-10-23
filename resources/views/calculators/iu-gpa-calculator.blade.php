<style>
    .remove{
        position: absolute;
        top: 5px;
        right: 0;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[90%] md:w-[90%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12 current_gpa">
                            <strong class="col-8"><?=$lang['6']?> <?=$lang['4']?></strong>
                        </div>
                        <div class="col-span-12 row current_inp">
                            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="c_gpa" class="text-blue font-s-14"><?=$lang['3']?></label>
                                    <input type="number" step="any" min="1" max="5" id="c_gpa" class="input mt-2" placeholder="0.0">
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="c_credit" class="text-blue font-s-14"><?=$lang['5']?></label>
                                    <input type="number" step="any" min="1" id="c_credit" class="input mt-2" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12">
                    <ul class="semester border radius-10 p-3 mt-2">
                        <li style="list-style:none">
                            <div class="row mt-3">
                                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                                    <strong class="col-span-4 text-[14px] font_s12_m padding_0"><?=$lang['credit']?></strong>
                                    <strong class="col-span-4 text-[14px] font_s12_m"><?=$lang['grade']?></strong>
                                    <strong class="col-span-4 text-[14px] font_s12_m"><?=$lang['g_p']?></strong>
                                </div>
                            </div>
                            <div class="row addCourse" id="accept_row1">
                                <ul class="get_html ">
                                    
                                </ul>
                                <div class="w-full pb-2 mt-3">
                                    <button type="button" title="Add New Course" class="units_active p-2  radius-5 cursor-pointer add_course">
                                        <strong class="flex items-center bg-[#2845F5] text-white p-3 rounded-lg"><span class="pe-2">+</span> <?=$lang['add_course']?></strong>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="w-full text-center mt-1 flex justify-center flex-wrap calculate_reset ">
                <button type="submit" name="submit" value="calculate" class="calculate mt-2 bg-[#2845F5] text-white p-3 rounded-lg">Calculate</button>
            </div>

            @if ($type=='widget')
                @include('inc.widget-button')
            @endif
        </div>
    </div>
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result hidden">
  
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full">
                    <div class="w-full">
                        <div class="w-full text-center mt-4">
                            <div class="bg-[#F6FAFC] inner_knob rounded-lg p-2" style="border: 1px solid #c1b8b899;">
                                <p class="text-[32px] mt-2"><b class="final_cpga">0.00</b></p>
                                <p><strong class="text-[25px]"><?=$lang['cum']?></strong></p>
                                <strong class="text-[25px]"><?=$lang['gpa']?></strong>
                            </div>
                        </div>
                        <p class="text-center text-blue-500 text-[18px] mt-2"><strong><?=$lang['total_g']?> = <span class="text-[25px] total_g">0.0</span></strong></p>
                        <p class="text-center text-blue-500 text-[18px]"><strong><?=$lang['total_h']?> = <span class="text-[25px] total_h">0.0</span></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</form>
@push('calculatorJS')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function calculate(){
            var total_grade=parseFloat(0);
            var total_hour=parseFloat(0);
            var total_gpa=parseFloat(0);
            var semester=$('.semester').children().length;
            var type=$('.grade_text').attr('type');
            var s_grade=parseFloat(0);
            var s_hour=parseFloat(0);
            var len=$('#accept_row1 .get_html').children().length;
            for (var m = 1; m <= len; m++) {
                var grade=$('#grade'+m).val();
                var hour=$('#cradits'+m).val();
                var subject=$('#subject'+m).val();
                var widget=$('#weight'+m).val();
                if (grade!=null && hour!=null) {
                    grade=hour * grade;
                    $('#g_p'+m).val(grade.toFixed(3));
                    s_grade=s_grade + parseFloat(grade);
                    s_hour=s_hour + parseFloat(hour)
                }
            }
            if (s_grade!=0) {
                var current_gpa=$('#c_gpa').val();
                var current_hour=$('#c_credit').val();
                if (current_gpa!='' && current_hour!='') {
                    var c_grade= current_hour * current_gpa;
                    s_grade=s_grade + parseFloat(c_grade);
                    s_hour=s_hour + parseFloat(current_hour);
                }
                var gpa= (s_grade / s_hour).toPrecision(3);
                total_gpa=total_gpa + parseFloat(gpa);
                total_grade=total_grade + parseFloat(s_grade);
                total_hour=total_hour + parseFloat(s_hour);
                $('.total_g').text((s_grade).toFixed(2));
                $('.total_h').text(s_hour);
                $('.final_cpga').text(gpa);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {

            $('.current_gpa').click(function(){
                $('.current_input').slideToggle('fast');
            })

            document.querySelector('.calculate').addEventListener('click', function(e) {
                e.preventDefault();
                calculate();
                document.querySelector('.result').style.display = 'block';
                var final_cpga=$('.final_cpga').text();

                if (final_cpga>0 && final_cpga <=5) {
                    $('body,html').animate({
                        scrollTop: $('.result').offset().top
                    },1000)
                }else{
                    alert("Please fill required fields.");
                }
            });

            $(document).on('click','.remove',function(){
                $(this).parents('.get_html li').remove();
                i--;
            });
            var i=3;
            $(document).on('click','.add_course',function(){
                var id=$(this).parents('.addCourse').attr('id');
                var len=$('#'+id+' .get_html').children().length;
                var id_=id.split('w');
                ++len;
                add_fields(len,id_[1]);
            });
            $(document).on('click','.close',function(){
                if (j!=0) {
                    $(this).parents('.semester li').remove();
                    j--;
                }
            });
            function add_fields(counter,id){
                var html = '<li class="row relative grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4" style="list-style:none">' +
                            '<div class="col-span-4">' +
                                '<input id="cradits' + counter + '" onkeyup="calculate()" type="number" max="100" min="0" step="any" class="input" placeholder="<?=$lang['credit']?>">' +
                            '</div>' +
                            '<div class="col-span-3 letter">' +
                                '<select id="grade' + counter + '" class="input grade" onchange="calculate()">' +
                                    '<option value="" selected disabled><?=$lang['grade']?></option>' +
                                    '<option value="4.0">A+</option>'+
                                    '<option value="4.0">A</option>'+
                                    '<option value="3.7">A-</option>'+
                                    '<option value="3.3">B+</option>'+
                                    '<option value="3.0">B</option>'+
                                    '<option value="2.7">B-</option>'+
                                    '<option value="2.3">C+</option>'+
                                    '<option value="2.0">C</option>'+
                                    '<option value="1.7">C-</option>'+
                                    '<option value="1.3">D+</option>'+
                                    '<option value="1.0">D</option>'+
                                    '<option value="0.7">D-</option>'+
                                    '<option value="0.0">F</option>'+
                                '</select>' +
                            '</div>' +
                            '<div class="col-span-4 gpa_weight">' +
                                '<input id="g_p' + counter + '" type="number" min="0" step="any" class="input" placeholder="00">' +
                             
                            '</div>' +
                            '<div class="col-span-1">' +
                                '<img src="<?=url('images/close.png')?>" alt="GPA Remove Course" class="remove">' +
                            '</div>' +
                        '</li>';
                $('#accept_row'+id+' ul').append(html);
            }
            add_fields(1,1);
            add_fields(2,1);
            add_fields(3,1);
        });
    </script>
@endpush