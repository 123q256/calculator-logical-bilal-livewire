<style>
	[type="radio"].with-gap:checked+span:before{
		border: 2px solid #13699E;
	}
	[type="radio"].with-gap:checked+span:after{
		background: #13699E;
	}
	.width_20_per{
		width: 20%;
		float: left;
		padding: 3px;
		font-weight: 400;
		text-align: center;
		font-size: 20px;
		cursor: pointer;
	}
	.width_20_per span{
		display: block;
		height: 40px;
		background: #e0e0e0;
		line-height: 40px;
		color: #000;
		border: 1px solid #ddd;
		border-radius: 5px;
	}
	.width_20_per label{
		background:#99EA48;
		color: #13689E;
		cursor: pointer;
		display: block;
		height: 40px;
		line-height: 40px;
		margin-left: 0px !important;
		border: 1px solid #ddd;
		border-radius: 3px;
	}
	#showOutput{
		background: #99EA48;
	}
	.width_20_per label span{
		border: none;
		color: #99EA48;
		border-radius: 0px;
		background: transparent !important;
	}
	.mbl_content{
		height: 420px;
		overflow: auto;
	}
	.blue_btn{
		background: #99EA48 !important;
		color: #000000 !important;
	}
	.grey_color{
		background: #cdd2d4 !important;
	}
	@media(max-width: 480px){
		.width_20_per label{
			height: 35px;
			line-height: 35px;
		}
		.width_20_per span{
			height: 35px;
			line-height: 30px;
		}
		.width_20_per{
			font-size: 16px;
			cursor: pointer;
		}
		.width_20_per label span{
			padding-left: 23px !important;
		}
	}
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


	<div class="w-full mx-auto p-4 lg:p-8 md:p-8 bg-white rounded-lg shadow-md space-y-6 mb-3">
		@if (isset($error))
		<p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
	   @endif
	   <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
			<div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
					<div id="showInput" class="col-12 bg-sky text-end font-s-20 p-2">&nbsp;</div>
					<div id="showOutput" class="col-12 font-s-20 white-text text-end p-2 blue_btn">0</div>
					<div class="row padding_0 mt-2">
						<div class="col-lg width_20_per">
							<label for="scirdsettingd">
								<input id="scirdsettingd" class="" type="radio" name="scirdsetting" value="deg" onclick="DegorRad='degree';" checked=""> Deg
							</label>
						</div>
						<div class="col-lg width_20_per">
							<label for="scirdsettingr">
								<input id="scirdsettingr" class="" type="radio" name="scirdsetting" value="deg" onclick="DegorRad='radians';" checked=""> Rad
							</label>
						</div>
						<div class="col-lg width_20_per"><span onclick="calculator('sin')">sin</span></div>
						<div class="col-lg width_20_per"><span onclick="calculator('cos')">cos</span></div>
						<div class="col-lg width_20_per"><span onclick="calculator('tan')">tan</span></div>
					</div>
					<div class="row">
						<div class="width_20_per"><span onclick="calculator('pi')">π</span></div>
						<div class="width_20_per"><span onclick="calculator('e')">e</span></div>
						<div class="width_20_per"><span onclick="calculator('asin')">sin<sup>-1</sup></span></div>
						<div class="width_20_per"><span onclick="calculator('acos')">cos<sup>-1</sup></span></div>
						<div class="width_20_per"><span onclick="calculator('atan')">tan<sup>-1</sup></span></div>
					</div>
					<div class="row">
						<div class="width_20_per"><span onclick="calculator('ln')">ln</span></div>
						<div class="width_20_per"><span onclick="calculator('log')">log</span></div>
						<div class="width_20_per"><span onclick="calculator('apow')"><sup>y</sup>√x</span></div>
						<div class="width_20_per"><span onclick="calculator('3x')"><sup>3</sup>√x</span></div>
						<div class="width_20_per"><span onclick="calculator('sqrt')">√x</span></div>
					</div>
					<div class="row">
						<div class="width_20_per"><span onclick="calculator('ex')">e<sup>x</sup></span></div>
						<div class="width_20_per"><span onclick="calculator('10x')">10<sup>x</sup></span></div>
						<div class="width_20_per"><span onclick="calculator('pow')">x<sup>y</sup></span></div>
						<div class="width_20_per"><span onclick="calculator('x3')">x<sup>3</sup></span></div>
						<div class="width_20_per"><span onclick="calculator('x2')">x<sup>2</sup></span></div>
					</div>
					<div class="row">
						<div class="width_20_per"><span onclick="calculator('(')">(</span></div>
						<div class="width_20_per"><span onclick="calculator(')')">)</span></div>
						<div class="width_20_per"><span onclick="calculator('1/x')">1/x</span></div>
						<div class="width_20_per"><span onclick="calculator('pc')">%</span></div>
						<div class="width_20_per"><span onclick="calculator('n!')">n!</span></div>
					</div>
					<div class="row">
						<div class="width_20_per"><span onclick="calculator(7)" class="blue_btn">7</span></div>
						<div class="width_20_per"><span onclick="calculator(8)" class="blue_btn">8</span></div>
						<div class="width_20_per"><span onclick="calculator(9)" class="blue_btn">9</span></div>
						<div class="width_20_per"><span onclick="calculator('+')">+</span></div>
						<div class="width_20_per "><span onclick="calculator('bk')" class="grey_color flex justify-center text-center" style="display: flex"><img src="<?=asset('images/delete.png')?>" style="margin-top: 7px;" class="object-contain" alt="del"></span></div>
					</div>
					<div class="row">
						<div class="width_20_per"><span onclick="calculator(4)" class="blue_btn">4</span></div>
						<div class="width_20_per"><span onclick="calculator(5)" class="blue_btn">5</span></div>
						<div class="width_20_per"><span onclick="calculator(6)" class="blue_btn">6</span></div>
						<div class="width_20_per"><span onclick="calculator('-')">–</span></div>
						<div class="width_20_per"><span onclick="calculator('C')" class="grey_color">AC</span></div>
					</div>
					<div class="row">
						<div class="width_20_per"><span onclick="calculator(1)" class="blue_btn">1</span></div>
						<div class="width_20_per"><span onclick="calculator(2)" class="blue_btn">2</span></div>
						<div class="width_20_per"><span onclick="calculator(3)" class="blue_btn">3</span></div>
						<div class="width_20_per"><span onclick="calculator('*')">×</span></div>
						<div class="width_20_per"><span onclick="calculator('M+')">M+</span></div>
					</div>
					<div class="row">
						<div class="width_20_per"><span onclick="calculator(0)" class="blue_btn">0</span></div>
						<div class="width_20_per"><span onclick="calculator('.')" class="blue_btn">.</span></div>
						<div class="width_20_per"><span onclick="calculator('=')" class="blue_btn">=</span></div>
						<div class="width_20_per"><span onclick="calculator('/')">÷</span></div>
						<div class="width_20_per"><span onclick="calculator('M-')">M-</span></div>
					</div>
					<div class="row">
						<div class="width_20_per"><span onclick="calculator('+/-')">±</span></div>
						<div class="width_20_per"><span onclick="calculator('RND')">RND</span></div>
						<div class="width_20_per"><span onclick="calculator('ans')">Ans</span></div>
						<div class="width_20_per"><span onclick="calculator('EXP')">EXP</span></div>
						<div class="width_20_per"><span onclick="calculator('MR')" id="scimrc">MR</span></div>
					</div>
					<div id="ShowHistory"></div>
				</div>

			</div>
		</div>
		@if ($type=='widget')
		@include('inc.widget-button')
		 @endif
	 </div>

	 
    @isset($detail)
        <div class="col-12 bg-light-blue result p-3 radius-10 mt-3">
            <div class="d-flex justify-content-between">
                <p class="text-blue font-s-21"><strong>{{$lang['res']}}:</strong></p>
                @if ($type=='calculator')
                    @include('inc.copy-pdf')
                @endif      
            </div>
            <div class="row">

            </div>
            <div class="col-12 text-center mt-3">
                <button type="submit" href="{{url()->current()}}/" class="calculate">{{ $lang['reset'] }}</button>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
<script src="<?=url('assets/js/new-calculator.js?var=2.2')?>"></script>
@endpush