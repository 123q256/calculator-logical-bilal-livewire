<style>
    .close_fifo {
        position: absolute;
        background: #13699E;
        width: 20px;
        height: 20px;
        border-radius: 50px;
    }
    .close_fifo:before, .close_fifo:after {
        position: absolute;
        left: 9px;
        top: 4px;
        content: ' ';
        height: 12px;
        width: 2px;
        background-color: #fff
    }
    .close_fifo:before {
        transform: rotate(45deg)
    }

    .close_fifo:after {
        transform: rotate(-45deg)
    }
    .gap-5{
        gap: 10px
    }
    .purchases{
        display: none;
        position: absolute;
        z-index: 3;
	}
    #add_more ul li{
        list-style-type: none;
    }
	.arrow{
	  border: solid;
	  margin-right: 5px;
	  margin-bottom: 2px;
	  border-width: 0 3px 3px 0;
	  display: inline-block;
	  padding: 3px;
	}
	.down {
	  transform: rotate(45deg);
	  -webkit-transform: rotate(45deg);
	}
	#add_row,#add_more{
		height: 30px;
		line-height: 26px;
		cursor: pointer;
		border: 1px solid;
		position: relative;
	}
	.overflow_scroll{
		height: 500px;
		overflow-y: scroll;
		padding-top: 10px;
	}
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
	<div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3 input_div">
		@if (isset($error))
		<p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
	   @endif
	   <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
			<div class="grid grid-cols-12 mt-3  gap-4">
            <p class="col-span-12">{{$lang['nbr_of']}}</p>
            <ul id="accept_units" class="ps-3 relative col-span-12">

                <li class="grid grid-cols-12 mt-3 items-center gap-5 ">
                    <div class="col-span-5">
                        <p class="text-blue font-s-14"><?=$lang['1']?></p>
                        <div class="py-2">
                            <input type="number" min="1" step="any" id="unit1" name="unit1" value="10" class="input" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-5">
                        <p class="text-blue font-s-14"><?=$lang['2']?></p>
                        <div class="py-2">
                            <input type="number" min="1" step="any" id="price1" name="price1" value="150" class="input" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <span class="fifo_remove close_fifo"></span>
                    </div>
                </li>
                <li class="grid grid-cols-12 gap-5  items-center mt-3">
                    <div class="col-span-5">
                        <p class="text-blue font-s-14"><?=$lang['1']?></p>
                        <div class="py-2">
                            <input type="number" min="1" step="any" id="unit2" name="unit2" value="15" class="input" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-5">
                        <p class="text-blue font-s-14"><?=$lang['2']?></p>
                        <div class="py-2">
                            <input type="number" min="1" step="any" id="price2" name="price2" value="100" class="input" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <span class="fifo_remove close_fifo"></span>
                    </div>
                </li>
                <li class="grid grid-cols-12 gap-5  items-center mt-3"> 
                    <div class="col-span-5">
                        <p class="text-blue font-s-14"><?=$lang['1']?></p>
                        <div class="py-2">
                            <input type="number" min="1" step="any" id="unit3" name="unit3" value="25" class="input" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-5">
                        <p class="text-blue font-s-14"><?=$lang['2']?></p>
                        <div class="py-2">
                            <input type="number" min="1" step="any" id="price3" name="price3" value="200" class="input" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <span class="fifo_remove close_fifo"></span>
                    </div>
                </li>
                <li class="grid grid-cols-12 gap-5  items-center mt-3">
                    <div class="col-span-5">
                        <p class="text-blue font-s-14"><?=$lang['1']?></p>
                        <div class="py-2">
                            <input type="number" min="1" step="any" id="unit4" name="unit4" value="" class="input" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-5">
                        <p class="text-blue font-s-14"><?=$lang['2']?></p>
                        <div class="py-2">
                            <input type="number" min="1" step="any" id="price4" name="price4" value="" class="input" placeholder="00" aria-label="input field">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <span class="fifo_remove close_fifo"></span>
                    </div>
                </li>
            </ul>
            <div class="col-span-12 gap-5 my-2 px-3 ml20">
				<div class="grid grid-cols-12 mt-3  gap-4">
                <p class="col-span-6 mb-2  text-blue cursor-pointer text-center bg-white border radius-10" id="add_row"><b class="p-5"><?=$lang['1by1']?></b></p>
                <div id="add_more" class="input cursor-pointer text-center border  col-span-6"> 
                    <b class="font_s12 text-blue text-center p-5"><i class="arrow down"></i><?=$lang['add_more']?></b>
                    <ul class="purchases text-blue text-center font-s-16 mb-3">
                        <li class="add_more bg-white py-2 px-2 " value="5">5 <?=$lang['purch']?></li>
                        <li class="add_more bg-white py-2 px-2 " value="10">10 <?=$lang['purch']?></li>
                        <li class="add_more bg-white py-2 px-2 " value="15">15 <?=$lang['purch']?></li>
                        <li class="add_more bg-white py-2 px-2 " value="20">20 <?=$lang['purch']?></li>
                        <li class="add_more bg-white py-2 px-2 " value="50">50 <?=$lang['purch']?></li>
                    </ul>
                </div>
				</div>
            </div>
            <div class="col-span-12 w-100 px-3">
                <p><?=$lang['unit_sold']?></p>
                <div class="py-2 w-100">
                    <input type="number" min="1" name="unit_sold" id="unit_sold" value="<?=((isset($_POST['unit_sold']))?$_POST['unit_sold']:'35')?>" class="input col-12" placeholder="00">
                </div>
            </div>

            <input type="hidden" id="for_checking" name="for_checking">
            <input type="hidden" id="total_sold" name="total_sold">
		
            <div class="col-span-12">
				<div class="grid grid-cols-12 mt-3  gap-4">
					<div class="col-span-6 text-center mt-3">
						<button type="button" class="calculate cal_fifo px-6 py-3 sm:px-10 sm:py-4 font-semibold text-[#ffffff] bg-[#2845F5] rounded-[30px] focus:outline-none focus:ring-2 text-sm sm:text-base ">{{ $lang['FIFO'] }}</button>
					</div>
					<div class="col-span-6 text-center mt-3">
						<button type="button" class="calculate cal_lifo px-6 py-3 sm:px-10 sm:py-4 font-semibold text-[#ffffff] bg-[#2845F5] rounded-[30px] focus:outline-none focus:ring-2 text-sm sm:text-base">{{ $lang['LIFO'] }}</button>
					</div>
				</div>
            </div>

		</div>
	</div>
 </div>
 <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result hidden">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
				<div class="w-full ">
					<div class="row my-2">
						<div id="addClass" class="flex gap-5">
							<div class="col-lg-4 print1 p-2 radius-5">
								<p class="font-s-16"><b><?=$lang['cogp']?></b></p>
								<div class="d-lg-flex align-items-center gap-5">
									<div>
										<img src="<?=asset('images/purch.webp')?>" alt="Cost of Goods Purchased" class="max-width" width="80px" height="80px">
									</div>
									<p><b id="cogp">0</b></p></p>
								</div>
							</div>
							<div class="col-lg-4 print1 p-2 radius-5">
								<p class="font-s-16"><b><?=$lang['cogs']?></b></p>
								<div class="d-lg-flex align-items-center gap-5">
									<div>
										<img src="<?=asset('images/sold.webp')?>" alt="Cost of Goods Sold" class="max-width" width="80px" height="80px">
									</div>
									<p><b id="first_sold">0</b></p></p>
								</div>
							</div>
							<div class="col-lg-4 print1 p-2 radius-5">
								<p class="font-s-16"><b><?=$lang['ending']?></b></p>
								<div class="d-lg-flex align-items-center gap-5">
									<div>
										<img src="<?=asset('images/inventory.webp')?>" alt="Ending Inventory Value" class="max-width" width="80px" height="80px">
									</div>
									<p><b id="ending">0</b></p></p>
								</div>
							</div>
						</div>
						<div class="table_parent overflow-auto mt-2">
							<table class="table w-100" id="myTable">
							</table>
						</div>
					</div>
					<div class="col-12 text-center mt-5">
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


</form>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
        $('#add_more').click(function(){
			$('.purchases').slideToggle("fast");
		});
		function add_units(counter){
		var html=
            `<li class="grid grid-cols-12 gap-5  items-center mt-3">
                    <div class="col-span-5">
                        <p class="text-blue font-s-14"><?=$lang['1']?></p>
                        <div class="py-2">
                            <input type="number" min="1" step="any" id="unit`+counter+`" name="unit`+counter+`" value="" class="input" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-5">
                        <p class="text-blue font-s-14"><?=$lang['2']?></p>
                        <div class="py-2">
                            <input type="number" min="1" step="any" id="price`+counter+`" name="price`+counter+`" value="" class="input" placeholder="00" aria-label="input field">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <span class="fifo_remove close_fifo"></span>
                    </div>
            </li>`;
			$('#accept_units').append(html);
		}
		var i=4;
		var count=4;
		$('#add_row').click(function(){
			i++;
			count++;
			add_units(i);
			var many=$('#accept_units li').length;
			$('#for_checking').val(many);
			if (many > 100) {
				alert('Purchases Number should not be less than 100.');
			}
			var len=$('#accept_units li').length;
			if (len>10) {
				$('#accept_units').addClass('overflow_scroll');
			}else{
				$('#accept_units').removeClass('overflow_scroll');
			}
		});

		$('.add_more').click(function(){
			var nbr=$(this).val();
			var many=$('#accept_units li').length;
			var total= parseInt(nbr) + parseInt(many);
			if (many > 100 || total >100) {
				alert('Purchases Number should be less than 100.');
			}
			else {
				for (var j = 1; j <= nbr; j++) {
					i++;
					count++;
					add_units(i);
				}
			}
			var len=$('#accept_units li').length;
			if (len>10) {
				$('#accept_units').addClass('overflow_scroll');
			}else{
				$('#accept_units').removeClass('overflow_scroll');
			}
		});
		$(document).on('click','.fifo_remove',function(){
			$(this).parents('#accept_units li').remove();
			var len=$('#accept_units li').length;
			if (len>10) {
				$('#accept_units').addClass('overflow_scroll');
			}else{
				$('#accept_units').removeClass('overflow_scroll');
			}
		});  
		$('#unit_sold').keyup(function(){
			var len=$('#accept_units li').length;
			var units=parseInt(0);
			for (var j = 1; j <= len; j++) {
				var check=$('#unit'+j+'').val();
				if (check!='') {
					units +=parseInt($('#unit'+j+'').val());
				}
			}
			var unit_sold=$('#unit_sold').val();
			$('#total_sold').val(unit_sold);
			if (unit_sold>units) {
				alert('Total Unit Sold must be less than or equal to Total Units.');
			}
		});
        $('.cal_lifo').click(function(){
			var unit_sold=$('#unit_sold').val();
			var t_unit_sold=parseInt($('#unit_sold').val());
			var for_checking=$('#for_checking').val();
			var check=true;
			if (unit_sold!='') {
				for (var m = 1; m <= count; m++) {
					var unit=$('#unit'+m+'').val();
					var price=$('#price'+m+'').val();
					if ((unit!='' && price=='') || (unit=='' && price!='')) {
						check=false;
					}
				}
				if (check==false) {
					alert('Please enter all units and its prices.');
				}else{
					var row_nbr=0;
					var total_amount=0;
					var first_sold=0;
					var table='<thead><tr class="color_blue"><td class="border-b py-2"><b><?=$lang['sr_no']?></b></td><td class="border-b py-2"><b><?=$lang['u_p']?></b></td><td class="border-b py-2"><b><?=$lang['ppu']?></b></td><td class="border-b py-2"><b><?=$lang['cogp']?></b></td><td class="border-b py-2"><b><?=$lang['us']?></b></td><td class="border-b py-2"><b><?=$lang['ur']?></b></td><td class="border-b py-2"><b><?=$lang['cogs']?></b></td><td class="border-b py-2"><b><?=$lang['iv']?></b></td></tr></thead>';
					var unit_sold=parseInt($('#unit_sold').val());
					var len=$('#accept_units li').length;
					for (var k=count; k >= 1 ; k--) { 
						var check=true;
						var unit=parseInt($('#unit'+k+'').val());
						var price=$('#price'+k+'').val();
						if(unit==null || price==undefined || price==null || unit==undefined || unit=='' || price==''){
							check=false;
						}
						if(check==true){
							row_nbr++;
							var total_get=parseInt(unit * price);
							var total_get_p=parseInt(unit * price);
							total_amount=total_amount + total_get;
							if (unit_sold > 0) {
								if (unit_sold >= unit) {
									total_get=parseInt(unit * price);
									first_sold=first_sold + total_get;
								}else if (unit_sold < unit && unit_sold>0){
									total_get=parseInt(unit_sold * price);
									first_sold=first_sold + total_get;
								}
								unit_sold=unit_sold - unit;
							}
							if (t_unit_sold >= unit && t_unit_sold!=0) {
								var n_u_sold = unit;
								var remain_unit=0;
								t_unit_sold = t_unit_sold - unit;
							}
							else if (t_unit_sold<unit && t_unit_sold!=0) {
								var n_u_sold=t_unit_sold;
								var remain_unit=unit - t_unit_sold;
								t_unit_sold=0;
							}else{
								var n_u_sold=0;
								var remain_unit=unit;
							}
							table +='<tr class="tr"><td class="border-b py-2">'+len+'</td><td class="border-b py-2">'+unit.toString()+'</td><td class="border-b py-2">'+price.toString()+'</td><td class="border-b py-2">'+total_get_p.toString()+'</td><td class="border-b py-2">'+n_u_sold.toString()+'</td><td class="border-b py-2">'+(remain_unit).toString()+'</td><td class="border-b py-2">'+(n_u_sold * price).toString()+'</td><td class="border-b py-2">'+(remain_unit * price).toString()+'</td></tr>';
							len--;
						}
					}
					var ending=total_amount-first_sold;
					var units=parseInt(0);
					for (var j = 1; j <= count; j++) {
						var check=$('#unit'+j+'').val();
						if (check!='' && check!=undefined) {
							units +=parseInt($('#unit'+j+'').val());
						}
					}
					if (row_nbr>10) {
						$('.table_parent').css({'height':'520px','overflow-y':'scroll'});
					}
					var sold=$('#unit_sold').val();
					var table_a = table.split("</thead>");
					var table_b = table_a[1].split("</tr>");
					var table_body='';
					for (var i = table_b.length; i >= 0; i--) {
						table_body+= table_b[i]+"</tr>";
					}
					
					var table_footer='<tr class="grey lighten-2"><td class="border-b py-2"><b><?=$lang['total']?></b></td><td class="border-b py-2"><b>'+units.toString()+'</b></td><td class="border-b py-2"><b>&nbsp;</b></td><td class="border-b py-2"><b>'+total_amount.toString()+'</b></td><td class="border-b py-2"><b>'+sold.toString()+'</b></td><td class="border-b py-2"><b>'+(units - sold).toString()+'</b></td><td class="border-b py-2"><b>'+first_sold.toString()+'</b></td><td class="border-b py-2"><b>'+ending.toString()+'</b></td></tr>';
					var table=table_a[0]+"</thead>"+table_body+table_footer;
					$('.table').html(table);
					$('.result').css('display','block');
					$('.input_div').css('display','none');
					$('#first_sold').text(first_sold);
					$('#ending').text(ending);
					$('#cogp').text(total_amount);
					$('body,html').animate({
						scrollTop: $('.result').offset().top
					},1000)
				}
			} else {
				alert('Please Fill All Fields.');
			}
		});
		$('.cal_fifo').click(function(){
			var unit_sold=$('#unit_sold').val();
			var for_checking=$('#for_checking').val();
			var check=true;
			if (unit_sold!='') {
				for (var m = 1; m <= i; m++) {
					var unit=$('#unit'+m+'').val();
					var price=$('#price'+m+'').val();
					if ((unit!='' && price=='') || (unit=='' && price!='')) {
						check=false;
					}
				}
				if (check==false) {
					alert('Please enter all units and its prices.');
				}else{
					var total_amount=0;
					var first_sold=0;
					var table='<thead><tr class="color_blue"><td class="border-b py-2"><b><?=$lang['sr_no']?></b></td><td class="border-b py-2"><b><?=$lang['u_p']?></b></td><td class="border-b py-2"><b><?=$lang['ppu']?></b></td><td class="border-b py-2"><b><?=$lang['cogp']?></b></td><td class="border-b py-2"><b><?=$lang['us']?></b></td><td class="border-b py-2"><b><?=$lang['ur']?></b></td><td class="border-b py-2"><b><?=$lang['cogs']?></b></td><td class="border-b py-2"><b><?=$lang['iv']?></b></td></tr></thead><tbody>';
					var unit_sold=parseInt($('#unit_sold').val());
					var t_unit_sold=parseInt($('#unit_sold').val());
					var row_nbr=0;
					for (var k=1; k <= i ; k++) { 
						var check=true;
						var unit=parseInt($('#unit'+k+'').val());
						var price=$('#price'+k+'').val();
						if(unit==null || price==undefined || price==null || unit==undefined || unit=='' || price==''){
							check=false;
						}
						if(check==true){
							row_nbr++;
							var total_get=parseInt(unit * price);
							var total_get_p=parseInt(unit * price);
							total_amount=total_amount + total_get;
							if (unit_sold > 0) {
								if (unit_sold >= unit) {
									total_get=parseInt(unit * price);
									first_sold=first_sold + total_get;
								}else if (unit_sold < unit && unit_sold>0){
									total_get=parseInt(unit_sold * price);
									first_sold=first_sold + total_get;
								}
								unit_sold=unit_sold - unit;
							}
							if (t_unit_sold >= unit && t_unit_sold!=0) {
								var n_u_sold = unit;
								var remain_unit=0;
								t_unit_sold = t_unit_sold - unit;
							}
							else if (t_unit_sold<unit && t_unit_sold!=0) {
								var n_u_sold=t_unit_sold;
								var remain_unit=unit - t_unit_sold;
								t_unit_sold=0;
							}else{
								var n_u_sold=0;
								var remain_unit=unit;
							}
							table +='<tr><td class="border-b py-2">'+k+'</td><b><td class="border-b py-2">'+unit.toString()+'</b></td><b><td class="border-b py-2">'+price.toString()+'</b></td><b><td class="border-b py-2">'+total_get_p.toString()+'</b></td><b><td class="border-b py-2">'+n_u_sold.toString()+'</b></td><b><td class="border-b py-2">'+(remain_unit).toString()+'</b></td><b><td class="border-b py-2">'+(n_u_sold * price).toString()+'</b></td><b><td class="border-b py-2">'+(remain_unit * price).toString()+'</b></td></tr>';
						}
					}
					var ending=total_amount-first_sold;
					var units=parseInt(0);
					for (var j = 1; j <= i; j++) {
						var check=$('#unit'+j+'').val();
						if (check!='' && check!=undefined) {
							units +=parseInt($('#unit'+j+'').val());
						}
					}
					if (row_nbr>10) {
						$('.table_parent').css({'height':'520px','overflow-y':'scroll'});
					}
					var sold=$('#unit_sold').val();
					table+='<tr class="grey lighten-2"><td class="border-b py-2"><b><?=$lang['total']?></b></td><td class="border-b py-2"><b>'+units.toString()+'</b></td><td class="border-b py-2"><b>&nbsp;</b></td><td class="border-b py-2"><b>'+total_amount.toString()+'</b></td><td class="border-b py-2"><b>'+sold.toString()+'</b></td><td class="border-b py-2"><b>'+(units - sold).toString()+'</b></td><td class="border-b py-2"><b>'+first_sold.toString()+'</b></td><td class="border-b py-2"><b>'+ending.toString()+'</b></td></tr>';
					$('.result').css('display','block');
					$('.input_div').css('display','none');
					$('.table').html(table);
					$('#first_sold').text(first_sold);
					$('#cogp').text(total_amount);
					$('#ending').text(ending);
					$('body,html').animate({
						scrollTop: $('.result').offset().top
					},1000)
				}
			} else {
				alert('Please Fill All Fields.');
			}
			// download
        function downloadPDF() {
            var n = document.querySelector('.result');
            html2pdf().from(n).set({
                margin: [15, 5, 5, 5],
                filename: "Result by technical-calculator.com.pdf",
                image: {
                    type: "jpeg",
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    logging: true,
                    dpi: 192,
                    letterRendering: true
                },
                jsPDF: {
                    unit: "mm",
                    format: "a4",
                    orientation: "p"
                },
                pagebreak: {
                    before: ".page-break",
                    avoid: "table"
                },
            }).toPdf().get("pdf").then(function(e) {
                var t = e.internal.getNumberOfPages();
                for (let pageNumber = 1; pageNumber <= t; pageNumber++) {
                    e.setPage(pageNumber);
                    e.setFontSize(8);
                    e.setTextColor(150);
                    e.text(15, 15, "Results from");
                    e.setTextColor(0, 0, 255);
                    e.textWithLink(" technical-calculator.com", 31, 15, {
                        url: "https://technical-calculator.com/"
                    });
                    var allMathText = "technical-calculator.com " + pageNumber + "/" + t;
                    var allMathTextWidth = e.getStringUnitWidth(allMathText) * 8;
                    e.textWithLink(allMathText, e.internal.pageSize.getWidth() - 65 - allMathTextWidth, e.internal.pageSize.getHeight() - 8, {
                        url: "https://technical-calculator.com/"
                    });
                }
            }).save().catch((e) => {
                console.error(e);
            });
        }

	});
	function printDiv() {
		var printContents = document.querySelector('.result').innerHTML;
		var originalContents = document.body.innerHTML;
		var printableDiv = document.createElement('div');
		printableDiv.className = 'printable';
		printableDiv.innerHTML = printContents;
		document.body.appendChild(printableDiv);

		var originalStyle = document.body.style.display;
		document.body.style.display = 'none';
		printableDiv.style.display = 'block';

		window.print();

		printableDiv.remove();
		document.body.style.display = originalStyle;
	}
	document.getElementById('printButton').addEventListener('click', printDiv);

	// feedback
	document.addEventListener('DOMContentLoaded', function() {
		document.getElementById('submitFeedback').addEventListener('click', function(event) {
			event.preventDefault(); 

			var email = document.getElementById('email').value;
			var message = document.getElementById('message').value;
			var name = document.getElementById('name').value;
			var submitButton = document.getElementById('submitFeedback');
			var csrfToken = document.querySelector('input[name="_token"]').value;
			var responseMessage = document.getElementById('response_message');

			if (!email || !message || !name) {
				responseMessage.textContent = 'All fields are required.';
				responseMessage.classList.add('text-danger');
				responseMessage.classList.remove('green-color');
				return;
			}
			var fullMessage = message + '. This feedback is from, " {{$cal_name}} "';

			submitButton.disabled = true;
			submitButton.textContent = 'Sending...';

			var xhr = new XMLHttpRequest();
			xhr.open('POST', '/contact/submit/', true);
			xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
			xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

			xhr.onreadystatechange = function() {
				if (xhr.readyState === 4) {
					submitButton.disabled = false;
					submitButton.textContent = 'Submit';
					// var responseMessage = document.getElementById('response_message');
					
					if (xhr.status >= 200 && xhr.status < 300) {
						var response = JSON.parse(xhr.responseText);
						responseMessage.textContent = response.message;
						responseMessage.classList.add('green-color');
						responseMessage.classList.remove('text-danger');
						document.getElementById('email').value = '';
						document.getElementById('message').value = '';
						document.getElementById('name').value = '';
					} else {
						responseMessage.textContent = 'An error occurred. Please try again later.';
						responseMessage.classList.add('text-danger');
						responseMessage.classList.remove('green-color');
					}
				}
			};

			var data = JSON.stringify({
				email: email,
				message: fullMessage,
				name: name,
				_token: csrfToken
			});

			xhr.send(data);
		});
	});

	let feedback = document.getElementById("popupDialog");
	if(feedback){
		let btn = document.getElementById("feedback");
		let span = document.getElementsByClassName("remove")[0];
		btn.onclick = function() {
			feedback.style.display = "block";
		}
		span.onclick = function() {
			feedback.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == feedback) {
				feedback.style.display = "none";
			}
		}
	}
</script>