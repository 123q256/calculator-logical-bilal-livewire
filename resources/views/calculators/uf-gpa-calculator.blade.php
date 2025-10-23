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
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <ul class=" semester">
                            <li style="list-style:none">
                                <div class="row mt-3">
                                    <strong class="col-4 font-s-14 font_s12_m padding_0"><?=$lang['credit']?></strong>
                                    <strong class="col-4 font-s-14 font_s12_m"><?=$lang['grade']?></strong>
                                    <strong class="col-4 font-s-14 font_s12_m"><?=$lang['g_p']?></strong>
                                </div>
                                <div class="row addCourse" id="accept_row1">
                                    <ul class="get_html">

                                    </ul>
                                    <div class="col-12 pb-2 mt-3">
                                        <button type="button" title="Add New Course" class=" p-3 border radius-5 text-white cursor-pointer add_course bg-[#2845F5] rounded-lg">
                                            <strong class="flex items-center" ><span class=" font-s-18 pe-2" >+</span> <?=$lang['add_course']?></strong>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
            </div>
    </div>
 
    <div class="w-full pb-2 mt-3 flex justify-center">
        <button type="button" title="calculate" class=" p-3 border radius-5 cursor-pointer text-white bg-[#2845F5] rounded-lg calculate">
            <strong class="flex items-center" > calculate</strong>
        </button>
    </div>


    @if ($type=='widget')
    @include('inc.widget-button')
    @endif
</div>
<div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result  hidden">

        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full  p-3  mt-3  ">
                    <div class="col-12">
                        <div class="col-12 text-center mt-4">
                            <div class="bg-sky inner_knob radius-10 p-2">
                                <p class="text-[32px] mt-2"><b class="final_cpga">0.00</b></p>
                                <p><strong class="text-[25px]"><?=$lang['cum']?></strong></p>
                                <strong class="text-[25px]"><?=$lang['gpa']?></strong>
                            </div>
                        </div>
                        <p class="text-center text-blue text-[18px] mt-2"><strong><?=$lang['total_g']?> = <span class="text-[25px] total_g">0.0</span></strong></p>
                        <p class="text-center text-blue  text0[18px]"><strong><?=$lang['total_h']?> = <span class="text-[25px] total_h">0.0</span></strong></p>
                        <p class="text-center text-blue text-[18px] border-b pb-2"><strong><?=$lang['dpc']?> = <span class="text-[25px] dpc">0.0</span></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
@push('calculatorJS')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function calculate() {
            var total_grade = parseFloat(0);
            var total_hour = parseFloat(0);
            var total_gpa = parseFloat(0);
            var semester = document.querySelector('.semester').children.length;
            var s_grade = parseFloat(0);
            var s_hour = parseFloat(0);
            var len = document.querySelector('#accept_row1 .get_html').children.length;
            
            for (var m = 1; m <= len; m++) {
                var grade = document.getElementById('grade' + m).value;
                var hour = document.getElementById('cradits' + m).value;
                if (grade && hour) {
                    grade = hour * grade;
                    document.getElementById('g_p' + m).value = grade.toFixed(3);
                    s_grade += parseFloat(grade);
                    s_hour += parseFloat(hour);
                }
            }

            if (s_grade != 0) {
                var gpa = (s_grade / s_hour).toPrecision(3);
                total_gpa += parseFloat(gpa);
                total_grade += parseFloat(s_grade);
                total_hour += parseFloat(s_hour);
                document.querySelector('.total_g').textContent = s_grade.toFixed(2);
                document.querySelector('.total_h').textContent = s_hour;
                document.querySelector('.final_cpga').textContent = gpa;
                if (gpa < 2) {
                    var dpc = ((s_hour * 2) - s_grade).toFixed(3);
                    document.querySelector('.dpc').textContent = dpc;
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {

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

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove')) {
                    e.target.closest('.get_html li').remove();
                    i--;
                }
            });

            var i = 3;
            document.querySelectorAll('.add_course').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    var id = e.target.closest('.addCourse').id;
                    var len = document.querySelector('#' + id + ' .get_html').children.length;
                    var id_ = id.split('w');
                    ++len;
                    add_fields(len, id_[1]);
                });
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('close')) {
                    if (j != 0) {
                        e.target.closest('.semester li').remove();
                        j--;
                    }
                }
            });

            function add_fields(counter, id) {
                var html = '<li class="row relative" style="list-style:none"> <div class="grid grid-cols-12 gap-3" >' +
                                '<div class="col-span-4 mt-3">' +
                                    '<input id="cradits' + counter + '" onkeyup="calculate()" type="number" max="100" min="0" step="any" class="input" placeholder="<?=$lang['credit']?>">' +
                                '</div>' +
                                '<div class="col-span-4 mt-3 letter">' +
                                    '<select id="grade' + counter + '" class="input grade" onchange="calculate()">' +
                                        '<option value="" selected disabled><?=$lang['grade']?></option>' +
                                        '<option value="4.0">A</option>' +
                                        '<option value="3.67">A-</option>' +
                                        '<option value="3.33">B+</option>' +
                                        '<option value="3.0">B</option>' +
                                        '<option value="2.67">B-</option>' +
                                        '<option value="2.33">C+</option>' +
                                        '<option value="2.0">C</option>' +
                                        '<option value="1.67">C-</option>' +
                                        '<option value="1.33">D+</option>' +
                                        '<option value="1.0">D</option>' +
                                        '<option value="0.67">D-</option>' +
                                        '<option value="0.0">E</option>' +
                                        '<option value="0.0">WE</option>' +
                                        '<option value="0.0">S-U</option>' +
                                    '</select>' +
                                '</div>' +
                                '<div class="col-span-3 mt-3  gpa_weight">' +
                                    '<input id="g_p' + counter + '" onkeyup="calculate()" type="number" min="0" step="any" class="input" placeholder="00">' +
                                '</div>' +
                                '<div class="col-span-1 mt-3 flex items-center gpa_weight">' +
                                    '<img src="<?=url('images/close.png')?>" alt="GPA Remove Course" class="remove mt-5">' +
                                '</div>' +
                            '</li>';
                document.querySelector('#accept_row' + id + ' ul').insertAdjacentHTML('beforeend', html);
            }

            add_fields(1, 1);
            add_fields(2, 1);
            add_fields(3, 1);
            add_fields(4, 1);
        });
    </script>
@endpush
