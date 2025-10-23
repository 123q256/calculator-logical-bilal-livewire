<style>
    .grade_format,.close{
        cursor: pointer;
    }
    .grade_format img{
        width: 12px;
        height: 12px
    }
    .grade_type{
        background-color: #fff;
        position: absolute;
        width: 160px;
        right: 20px;
        top: 25px;
        z-index: 2;
        padding: 5px;
        border-radius: 10px;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)
    }
    .grade_type div{
        padding: 5px;
        font-size: 17px;
        cursor: pointer;
    }
    .grade_type p{
        display: inline
    }
    .grade_type img{
        width: 20px;
        height: 20px;
    }
    .remove{
        position: absolute;
        top: 5px;
        right: 0;
    }
    .current_inp{
        transition: display 0.5s ease-in-out;
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

            <div class="col-span-12 p-2 border rounded-lg  mt-2">
                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 current_gpa">
                        <strong class="col-8"><?=$lang['14']?> <?=$lang['4']?></strong>
                    </div>
                    <div class="col-span-12 row current_inp">
                        <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-2 pe-1">
                            <label for="c_gpa" class="text-blue font-s-14"><?=$lang['3']?></label>
                            <input type="number" step="any" min="1" max="5" id="c_gpa" class="input mt-2" placeholder="0.0">
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 mt-2 ps-1">
                            <label for="c_credit" class="text-blue font-s-14"><?=$lang['5']?></label>
                            <input type="number" step="any" min="1" id="c_credit" class="input mt-2" placeholder="0.0">
                        </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-span-12">
            <ul class="semester border rounded-lg p-3 mt-2">
                <li style="list-style:none">
                    <div class="grid grid-cols-12  row">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 pe-2">
                            <p><strong class="text-[20px] text-blue"><?=$lang['semester']?> 1</strong></p>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 ps-2 mt-2 relative">
                            <div class="flex items-center justify-end">
                                <strong class="text-blue font-s-18 grade_format"><?=$lang['6']?>: <span class="grade_text" type="1"><?=$lang['7']?></span></strong>
                                <div class="grade_format ps-2">
                                    <img src="<?=asset('images/angle_down1.png')?>" class="image" alt="gpa">
                                </div>
                            </div>
                            <div class="grade_type hidden">
                                <div class="border-b">
                                    <strong class="text-blue"><?=$lang['6']?></strong>
                                </div>
                                <div class="flex items-center border-b" type="1">
                                    <img src="<?=asset('images/letter.png')?>" class="image" alt="<?=$lang['6']?> <?=$lang['7']?>">
                                    <p class="ps-2"><?=$lang['7']?></p>
                                </div>
                                <div class="flex items-center border-b" type="2">
                                    <img src="<?=asset('images/percentage.png')?>" class="image" alt="<?=$lang['6']?> <?=$lang['8']?>">
                                    <p class="ps-2"><?=$lang['8']?></p>
                                </div>
                                <div class="flex items-center" type="3">
                                    <img src="<?=asset('images/point.png')?>" class="image" alt="<?=$lang['6']?> <?=$lang['9']?>">
                                    <p class="ps-2"><?=$lang['9']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <strong class="col-4 font-s-14 px-1"><?=$lang['course']?></strong>
                        <strong class="col-4 font-s-14 px-1"><?=$lang['grade']?></strong>
                        <strong class="col-4 font-s-14 px-1"><?=$lang['credit']?></strong>
                    </div>
                    <div class="row addCourse" id="accept_row1">
                        <ul class="get_html">

                        </ul>
                        <div class="row pb-2 mt-3 flex justify-between">
                            <button type="button" title="Add New Course" class="col-6 col-md-4 units_active  border radius-5 cursor-pointer add_course bg-[#2845F5] text-white rounded-lg p-3">
                                <strong class="flex items-center  justify-center "><span class="  text-[18px] pe-2">+</span> <?=$lang['add_course']?></strong>
                            </button>
                            <button type="button" title="Add New Semester" class="col-6 col-md-4 units_active  border radius-5 cursor-pointer add_semester bg-[#2845F5] text-white rounded-lg p-3">
                                <strong class="flex items-center  justify-center "><span class="  text-[18px] pe-2">+</span> <?=$lang['add_semester']?></strong>
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
             </div>
                </div>
           </div>
           <div class="col-12 text-center mt-1 d-flex justify-content-center flex-wrap calculate_reset">
            <button type="submit" name="submit" value="calculate" class="calculate mt-2 bg-[#2845F5] text-white p-3  rounded-lg">Calculate</button>
           </div>
           @if ($type=='widget')
           @include('inc.widget-button')
            @endif
        </div>
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result hidden">

      
            <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3 ">
                        <div class="w-full">
                            <div class="w-full text-center mt-4">
                                <div class="bg-[#F6FAFC] inner_knob rounded-lg p-2" style="border: 1px solid #c1b8b899;">
                                    <p class="text-[32px] mt-2"><b class="final_cpga">0.00</b></p>
                                    <p><strong class="text-[25px]"><?=$lang['cum']?></strong></p>
                                    <strong class="text-[25px]"><?=$lang['10']?></strong>
                                </div>
                            </div>
                            <p class="text-center text-blue-500 text-[18px] mt-2"><strong><?=$lang['total_g']?> = <span class="text-[25px] total_g">0.0</span></strong></p>
                            <p class="text-center text-blue-500 border-b pb-2 text-[18px]"><strong><?=$lang['total_h']?> = <span class="text-[25px] total_h">0.0</span></strong></p>
                            <ul class="semester_res pt-2">
                                <li class="w-full pb-2 semester1 mt-3" style="list-style:none">
                                    <strong class="w-full text-blue-500 text-[20px]"><?=$lang['semester']?> 1</strong>
                                    <div class="w-full overflow-auto mt-2">
                                        <table class="w-full" cellspacing="0" style="border-collapse:collapse">
                                            <thead>
                                                <tr class="bg-[#F6FAFC]">
                                                    <td class="text-blue-500 p-2 border"><strong><?=$lang['course']?></strong></td>
                                                    <td class="text-blue-500 p-2 border"><strong><?=$lang['grade']?></strong></td>
                                                    <td class="text-blue-500 p-2 border"><strong><?=$lang['credit']?></strong></td>
                                                    <td class="text-blue-500 p-2 border"><strong><?=$lang['11']?></strong></td>
                                                </tr>
                                            </thead>
                                            <tbody class="table1">
                                                <tr>
                                                    <td class="p-2 border 1subject1">Course 1</td>
                                                    <td class="p-2 border 1grade1">0.0</td>
                                                    <td class="p-2 border 1credit1">0.0</td>
                                                    <td class="p-2 border 1tgrade1">0.0</td>
                                                </tr>
                                                <tr>
                                                    <td class="p-2 border 1subject2">Course 2</td>
                                                    <td class="p-2 border 1grade2">0.0</td>
                                                    <td class="p-2 border 1credit2">0.0</td>
                                                    <td class="p-2 border 1tgrade2">0.0</td>
                                                </tr>
                                                <tr>
                                                    <td class="p-2 border 1subject3">Course 3</td>
                                                    <td class="p-2 border 1grade3">0.0</td>
                                                    <td class="p-2 border 1credit3">0.0</td>
                                                    <td class="p-2 border 1tgrade3">0.0</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="bg-sky">
                                                    <td class="p-2 border text-blue-500" colspan="2"><strong><?=$lang['12']?></strong></td>
                                                    <td class="border p-2" colspan="2"><strong class="text-blue-500 hour1">0.0</strong></td>
                                                </tr>
                                                <tr class="bg-sky">
                                                    <td class="p-2 border text-blue-500" colspan="2"><strong><?=$lang['10']?></strong></td>
                                                    <td class="border p-2" colspan="2"><strong class="text-blue-500 gpa1">0.0</strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </li>
                            </ul>
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
		for (var k = 1; k <=semester; k++) {
			var s_grade=parseFloat(0);
			var s_hour=parseFloat(0);
			var len=$('#accept_row'+k+' .get_html').children().length;
			var table='';
			for (var m = 1; m <= len; m++) {
				var grade=$('#'+k+'grade'+m).val();
				var hour=$('#'+k+'cradits'+m).val();
				var subject=$('#'+k+'subject'+m).val();
				var widget=$('#'+k+'weight'+m).val();
				if (type=='1') {
					if (grade!=null && hour!=null) {
						if (subject=='') {
							subject="Course "+m;
						}
						table+='<tr><td class="border p-2">'+subject+'</td><td class="border p-2">'+grade+'</td><td class="border p-2">'+hour+'</td><td class="border p-2">'+(hour * grade).toFixed(2)+'</td></tr>';
						grade=hour * grade;
						s_grade=s_grade + parseFloat(grade);
						s_hour=s_hour + parseFloat(hour)
					}
				}
				var grade=$('#'+k+'percent'+m).val();
				if (type=='2') {
					if (grade!=null && hour!=null) {
						if (grade<50) {
							grade=0.0;
						}else if (grade>=50 && grade<=54) {
							grade=1.0;
						}else if (grade>=55 && grade<=59) {
							grade=1.50;
						}else if (grade>=60 && grade<=64) {
							grade=2.0;
						}else if (grade>=65 && grade<=69) {
							grade=2.50;
						}else if (grade>=70 && grade<=74) {
							grade=3.0;
						}else if (grade>=75 && grade<=79) {
							grade=3.40;
						}else if (grade>=80 && grade<=84) {
							grade=3.70
						}else if (grade>=85) {
							grade=4;
						}
						if (subject=='') {
							subject="Course "+m;
						}
						table+='<tr><td class="border p-2">'+subject+'</td><td class="border p-2">'+grade+'</td><td class="border p-2">'+hour+'</td><td class="border p-2">'+(hour * grade).toFixed(2)+'</td></tr>';
						grade=hour * grade;
						s_grade=s_grade + parseFloat(grade);
						s_hour=s_hour + parseFloat(hour)
					}
				}
				var grade=$('#'+k+'point'+m).val();
				if (type=='3') {
					if (grade!=null && hour!=null) {
						if (subject=='') {
							subject="Course "+m;
						}
						table+='<tr><td class="border p-2">'+subject+'</td><td class="border p-2">'+grade+'</td><td class="border p-2">'+hour+'</td><td class="border p-2">'+(hour * grade).toFixed(2)+'</td></tr>';
						grade=hour * grade;
						s_grade=s_grade + parseFloat(grade);
						s_hour=s_hour + parseFloat(hour)
					}
				}
			}
			if (s_grade!=0) {
				$('.table'+k).html(table);
				var gpa= (s_grade / s_hour).toPrecision(3);
				total_gpa=total_gpa + parseFloat(gpa);
				total_grade=total_grade + parseFloat(s_grade);
				total_hour=total_hour + parseFloat(s_hour);
				var current_gpa=$('#c_gpa').val();
				var current_hour=$('#c_credit').val();
				if (current_gpa!='' && current_hour!='') {
					var c_grade= current_hour * current_gpa;
					total_grade=total_grade + parseFloat(c_grade);
					total_hour=total_hour + parseFloat(current_hour);
				}
				$('.grade'+k).text((s_grade).toFixed(2));
				$('.hour'+k).text(s_hour);
				$('.gpa'+k).text(gpa);
				var cgpa=(total_grade / total_hour).toPrecision(3);
				$('.final_cpga').text(cgpa);
				$('.total_h').text(total_hour);
				$('.total_g').text((total_grade).toFixed(2));
			}
		}
	}

    $('.current_gpa').click(function(){
        $('.current_inp').slideToggle('fast');
    })

    $('.calculate').click(function(e){
        e.preventDefault();
        $('.download_pdf').css('display','none');
        var final_cpga=$('.final_cpga').text();
        if (final_cpga>0 && final_cpga <=5) {
            $('.download_pdf').css('display','block');
            $('body,html').animate({
                scrollTop: $('.result').offset().top
            },1000)
        }else{
            alert("Please fill required fields.");
            return false;
        }
        calculate();
        document.querySelector('.result').style.display = 'block';
    })

    $('.grade_type div').click(function(){
        var text=$(this).attr('type');
        if (text=='1') {
            $('.grade_text').text('Letter');
            $('.grade_text').attr('type','1');
            $('.letter').css('display','block');
            $('.percentage').css('display','none');
            $('.point').css('display','none');
        }
        if (text=='2') {
            $('.grade_text').text('Percentage');
            $('.grade_text').attr('type','2');
            $('.letter').css('display','none');
            $('.percentage').css('display','block');
            $('.point').css('display','none');
        }
        if (text=='3') {
            $('.grade_text').text('Point Value');
            $('.grade_text').attr('type','3');
            $('.letter').css('display','none');
            $('.percentage').css('display','none');
            $('.point').css('display','block');
        }
        $('.grade_type').slideToggle('fast');
        $('.grade_format img').toggleClass('rotate');
    });

    $('.grade_format').click(function(){
        $('.grade_type').slideToggle('fast');
        $('.grade_format img').toggleClass('rotate');
    })

    $(document).on('click','.remove',function(){
        $(this).parents('.get_html li').remove();
        i--;
    });

    var j=1;
    $(document).on('click','.add_semester',function(){
        $(this).hide();
        j++;
        add_semester(j);
        semester_res(j);
        add_fields(1,j);
        add_fields(2,j);
        add_fields(3,j);
        var type=$('.grade_text').attr('type');
        if (type=='1') {
            $('.letter').css('display','block');
            $('.percentage').css('display','none');
            $('.point').css('display','none');
        }
        if (type=='2') {
            $('.letter').css('display','none');
            $('.percentage').css('display','block');
            $('.point').css('display','none');
        }
        if (type=='3') {
            $('.letter').css('display','none');
            $('.percentage').css('display','none');
            $('.point').css('display','block');
        }
        if ($('.tab').attr('type')=="2") {
            $('.gpa_weight .select-wrapper input.select-dropdown').attr('disabled','disabled');
        } else {
            $('.gpa_weight .select-wrapper input.select-dropdown').removeAttr("disabled");
        }
    });

    var i=3;
    $(document).on('click','.add_course',function(){
        var id=$(this).parents('.addCourse').attr('id');
        var len=$('#'+id+' .get_html').children().length;
        var id_=id.split('w');
        ++len;
        add_fields(len,id_[1]);
        var type=$('.grade_text').attr('type');
        if (type=='1') {
            $('.letter').css('display','block');
            $('.percentage').css('display','none');
            $('.point').css('display','none');
        }
        if (type=='2') {
            $('.letter').css('display','none');
            $('.percentage').css('display','block');
            $('.point').css('display','none');
        }
        if (type=='3') {
            $('.letter').css('display','none');
            $('.percentage').css('display','none');
            $('.point').css('display','block');
        }
        if ($('.switch').attr('switch')=="off") {
            $('.gpa_weight .select-wrapper input.select-dropdown').attr('disabled','disabled');
        } else {
            $('.gpa_weight .select-wrapper input.select-dropdown').removeAttr("disabled");
        }
    });

    $(document).on('click','.close',function(){
        if (j!=0) {
            $(this).parents('.semester li').remove();
            j--;
        }
    });

    function add_fields(counter,id){
        var html='<li class="row relative" style="list-style:none">'+
                    '<div class="grid grid-cols-12">'+
                        '<div class="col-span-4 mt-4 px-1">'+
                        '<input type="text" id="'+id+'subject'+counter+'" class="input" placeholder="<?=$lang['13']?>">'+
                        '</div>'+
                        '<div class="col-span-4 mt-4 px-1 letter">'+
                            '<select id="'+id+'grade'+counter+'" class="input grade">'+
                                '<option value="" selected disabled><?=$lang['grade']?> A-F</option>'+
                                '<option value="4.0">A+</option>'+
                                '<option value="3.70">A</option>'+
                                '<option value="3.40">B+</option>'+
                                '<option value="3.00">B</option>'+
                                '<option value="2.50">B-</option>'+
                                '<option value="2.00">C+</option>'+
                                '<option value="1.50">C</option>'+
                                '<option value="1.0">D</option>'+
                                '<option value="0.0">F</option>'+
                            '</select>'+
                        '</div>'+
                        '<div class="col-span-4 mt-4 px-1 point hidden">'+
                            '<input id="'+id+'point'+counter+'" type="number" max="5" min="0" step="any" class="input" placeholder="<?=$lang['grade']?> 0.0">'+
                        '</div>'+
                        '<div class="col-span-4 mt-4 px-1 percentage hidden">'+
                            '<input id="'+id+'percent'+counter+'" type="number" max="100" min="0" step="any" class="input" placeholder="<?=$lang['grade']?> %">'+
                        '</div>'+
                        '<div class="col-span-3 mt-4 px-1">'+
                            '<select id="'+id+'cradits'+counter+'" class="input" onchange="calculate()">'+
                                '<option value="" selected disabled><?=$lang['credit']?></option>'+
                                '<option value="1">1</option>'+
                                '<option value="1.5">1.5</option>'+
                                '<option value="2">2</option>'+
                                '<option value="2.5">2.5</option>'+
                                '<option value="3">3</option>'+
                                '<option value="3.5">3.5</option>'+
                                '<option value="4">4</option>'+
                                '<option value="4.5">4.5</option>'+
                                '<option value="5">5</option>'+
                            '</select>'+
                        '</div>'+
                        '<div class="col-span-1 mt-4 px-1 flex items-center">'+
                            '<img src="<?=asset('images/close.png')?>" alt="GPA Remove Course" class="remove mt-5">'+
                        '</div>'+
                    '</div>'+
                '</li>';
                $('#accept_row'+id+' ul').append(html);
    }

    add_fields(1,1);
    add_fields(2,1);
    add_fields(3,1);

    function semester_res(id){
        var html='<li class="col-12 pb-2 semester'+id+' mt-3" style="list-style:none">'+
                        '<strong class="col-12 text-blue font-s-20"><?=$lang["semester"]?> '+id+'</strong>'+
                        '<div class="col-12 overflow-auto mt-2">'+
                            '<table class="col-12" cellspacing="0" style="border-collapse:collapse">'+
                                '<thead>'+
                                    '<tr class="bg-white">'+
                                        '<td class="text-blue border p-2"><strong><?=$lang["course"]?></strong></td>'+
                                        '<td class="text-blue border p-2"><strong><?=$lang["grade"]?></strong></td>'+
                                        '<td class="text-blue border p-2"><strong><?=$lang["credit"]?></strong></td>'+
                                        '<td class="text-blue border p-2"><strong><?=$lang["11"]?></strong></td>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody class="table'+id+'">'+
                                    '<tr>'+
                                        '<td class="border p-2 1subject1">Course 1</td>'+
                                        '<td class="border p-2 1grade1">0.0</td>'+
                                        '<td class="border p-2 1credit1">0.0</td>'+
                                        '<td class="border p-2 1tgrade1">0.0</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td class="border p-2 1subject2">Course 2</td>'+
                                        '<td class="border p-2 1grade2">0.0</td>'+
                                        '<td class="border p-2 1credit2">0.0</td>'+
                                        '<td class="border p-2 1tgrade2">0.0</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td class="border p-2 1subject3">Course 3</td>'+
                                        '<td class="border p-2 1grade3">0.0</td>'+
                                        '<td class="border p-2 1credit3">0.0</td>'+
                                        '<td class="border p-2 1tgrade3">0.0</td>'+
                                    '</tr>'+
                                '</tbody>'+
                                '<tfoot>'+
                                    '<tr class="bg-white">'+
                                        '<td class="border p-2 text-blue" colspan="2"><strong><?=$lang["12"]?></strong></td>'+
                                        '<td class="border p-2" colspan="2"><strong class="text-blue hour1">0.0</strong></td>'+
                                    '</tr>'+
                                    '<tr class="bg-white">'+
                                        '<td class="border p-2 text-blue" colspan="2"><strong><?=$lang["10"]?></strong></td>'+
                                        '<td class="border p-2" colspan="2"><strong class="text-blue gpa1">0.0</strong></td>'+
                                    '</tr>'+
                                '</tfoot>'+
                            '</table>'+
                        '</div>'+
                    '</li>';
        $('.semester_res').append(html);
    }

    function add_semester(count){
        var semester='<li style="list-style:none" class="mt-3">'+
                        '<div class="row">'+
                            '<div class="col-5 col-md-3">'+
                                '<strong class="font-s-20 text-blue"><?=$lang['semester']?> '+count+'</strong>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row mt-3">'+
                            '<strong class="col-4 font-s-14"><?=$lang['course']?></strong>'+
                            '<strong class="col-4 font-s-14"><?=$lang['grade']?></strong>'+
                            '<strong class="col-4 font-s-14"><?=$lang['credit']?></strong>'+
                        '</div>'+
                        '<div class="row addCourse mt-2" id="accept_row'+count+'">'+
                            '<ul class="get_html">'+
                            '</ul>'+
                            '<div class="row flex justify-between pb-2 mt-3">'+
                                '<button type="button" title="Add New Course" class="col-6 col-md-4 units_active p-2 border radius-5 cursor-pointer text-blue add_course bg-[#2845F5] text-white rounded-lg p-3"><strong class="flex items-center  justify-content-center"><span class=" text-[18px] pe-2">+</span> <?=$lang['add_course']?></strong></button>'+
                                '<button type="button" title="Add New Semester" class="col-6 col-md-4 units_active p-2 border radius-5 cursor-pointer text-blue add_semester bg-[#2845F5] text-white rounded-lg p-3"><strong class="flex items-center  justify-content-center"><span class=" text-[18px] pe-2">+</span> <?=$lang['add_semester']?></strong></button>'+
                            '</div>'+
                        '</div>'+
                    '</li>';
        $('.semester').append(semester);
    }
</script>
@endpush

