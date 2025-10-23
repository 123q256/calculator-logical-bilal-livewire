<style>
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
       <div class="lg:w-[90%] md:w-[90%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12 current_gpa">
                            <strong class="col-8"><?=$lang['14']?> <?=$lang['4']?></strong>
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
                    <ul class="semester border rounded-lg p-3 mt-2">
                        <p><strong class="font-s-20 text-blue"><?=$lang['semester']?> 1</strong></p>
                        <li style="list-style:none">
                            <div class="row mt-3">
                                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                                    <strong class="col-span-4 text-[14px] px-1"><?=$lang['course']?></strong>
                                    <strong class="col-span-4 text-[14px] px-1"><?=$lang['credit']?></strong>
                                    <strong class="col-span-4 text-[14px] px-1"><?=$lang['grade']?></strong>
                                </div>
                            </div>
                            <div class="row addCourse" id="accept_row1">
                                <ul class="get_html">
                                </ul>
                                <div class="col-12 pb-2 mt-3">
                                    <button type="button" title="Add New Course" class="col-6 col-md-4 units_active p-3 border radius-5 cursor-pointer add_course bg-[#2845F5] text-white rounded-lg">
                                        <strong class="flex items-center  justify-center"><span class=" font-s-18 pe-2">+</span> <?=$lang['add_course']?></strong>
                                    </button>
                                    <button type="button" title="Add New Semester" class="col-6 col-md-4 units_active p-3 border radius-5 cursor-pointer add_semester bg-[#2845F5] text-white rounded-lg">
                                        <strong class="flex items-center  justify-center"><span class=" font-s-18 pe-2">+</span> <?=$lang['add_semester']?></strong>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="w-full text-center mt-1 flex justify-center flex-wrap calculate_reset">
                <button type="submit" name="submit" value="calculate" class="calculate mt-2 bg-[#2845F5] text-white p-3 rounded-lg">Calculate</button>
            </div>
            @if ($type=='widget')
                @include('inc.widget-button')
            @endif
        </div>
    </div>
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full">
                    <div class="w-full">
                        <div class="w-full text-center mt-4">
                            <div class="bg-[#ffffff] inner_knob rounded-lg p-2" style="border: 1px solid #c1b8b899;">
                                <p class="text-[32px] mt-2"><b class="final_cpga">0.00</b></p>
                                <p><strong class="text-[25px]"><?=$lang['cum']?></strong></p>
                                <strong class="text-[25px]"><?=$lang['10']?></strong>
                            </div>
                        </div>
                        <p class="text-center text-blue text-[18px] mt-2"><strong><?=$lang['total_g']?> = <span class="text-[25px] total_g">0.0</span></strong></p>
                        <p class="text-center text-blue border-b pb-2 text-[18px]"><strong><?=$lang['total_h']?> = <span class="text-[25px] total_h">0.0</span></strong></p>
                        <ul class="semester_res pt-2">
                            <li class="w-full pb-2 semester1 mt-3" style="list-style:none">
                                <strong class="w-full text-blue font-s-20"><?=$lang['semester']?> 1</strong>
                                <div class="w-full overflow-auto mt-2">
                                    <table class="w-full" cellspacing="0" style="border-collapse:collapse">
                                        <thead>
                                            <tr class="bg-[#F6FAFC]">
                                                <td class="text-blue p-2 border"><strong><?=$lang['course']?></strong></td>
                                                <td class="text-blue p-2 border"><strong><?=$lang['grade']?></strong></td>
                                                <td class="text-blue p-2 border"><strong><?=$lang['credit']?></strong></td>
                                                <td class="text-blue p-2 border"><strong><?=$lang['11']?></strong></td>
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
                                            <tr class="bg-[#F6FAFC]">
                                                <td class="p-2 border text-blue-500" colspan="2"><strong><?=$lang['12']?></strong></td>
                                                <td class="border p-2" colspan="2"><strong class="text-blue hour1">0.0</strong></td>
                                            </tr>
                                            <tr class="bg-[#F6FAFC]">
                                                <td class="p-2 border text-blue-500" colspan="2"><strong><?=$lang['10']?></strong></td>
                                                <td class="border p-2" colspan="2"><strong class="text-blue gpa1">0.0</strong></td>
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
        // if (final_cpga>0 && final_cpga <=5) {
        //     $('.download_pdf').css('display','block');
        // }else{
        //     alert("Please fill required fields.");
        //     return false;
        // }
        calculate();
        document.querySelector('.result').style.display = 'block';
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
        var html='<li class="row relative grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4" style="list-style:none">'+
            '<div class="col-span-4">'+
                '<input type="text" id="'+id+'subject'+counter+'" class="input" placeholder="<?=$lang['13']?>">'+
            '</div>'+
            '<div class="col-span-3">'+
                '<input type="number" step="any" min="1" id="'+id+'cradits'+counter+'" class="input" placeholder="Credit">'+
            '</div>'+
            '<div class="col-span-4 gpa_weight">'+
                '<select id="'+id+'grade'+counter+'" class="input grade">'+
                    '<option value="" selected disabled><?=$lang['grade']?></option>'+
                    '<option value="4.33">A+</option>'+
                    '<option value="4.0">A</option>'+
                    '<option value="3.67">A-</option>'+
                    '<option value="3.33">B+</option>'+
                    '<option value="3.0">B</option>'+
                    '<option value="2.67">B-</option>'+
                    '<option value="2.33">C+</option>'+
                    '<option value="2.0">C</option>'+
                    '<option value="1.67">C-</option>'+
                    '<option value="1.33">D+</option>'+
                    '<option value="1.0">D</option>'+
                    '<option value="0.67">D-</option>'+
                    '<option value="0.0">F</option>'+
                '</select>'+
             
            '</div>'+
            '<div class="col-span-1 flex items-center">'+
                '<img src="<?=asset('images/close.png')?>" alt="GPA Remove Course" class="remove">'+
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
                '<strong class="col-4 font-s-14"><?=$lang['credit']?></strong>'+
                '<strong class="col-4 font-s-14"><?=$lang['grade']?></strong>'+
            '</div>'+
            '<div class="row addCourse mt-2" id="accept_row'+count+'">'+
                '<ul class="get_html">'+
                '</ul>'+
                '<div class="col-12 pb-2 mt-3">'+
                    '<button type="button" title="Add New Course" class="col-6 col-md-4 units_active p-3 border radius-5 cursor-pointer text-blue add_course bg-[#99EA48] rounded-lg"><strong class="flex items-center  justify-center "><span class=" font-s-18 pe-2">+</span> <?=$lang['add_course']?></strong></button>'+
                    '<button type="button" title="Add New Semester" class="col-6 col-md-4 units_active p-3 border radius-5 cursor-pointer text-blue add_semester bg-[#99EA48] rounded-lg"><strong class="flex items-center  justify-center"><span class=" font-s-18 pe-2">+</span> <?=$lang['add_semester']?></strong></button>'+
                '</div>'+
            '</div>'+
        '</li>';
        $('.semester').append(semester);
    }
</script>
@endpush
