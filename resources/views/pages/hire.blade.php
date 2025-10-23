@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
<style>
	.top_hire{
		background-image: url(<?=url('/img/hire_back.png')?>);
		background-origin: content-box;
		background-repeat: no-repeat;
		background-size: cover;
		height: 220px;
		width: 100%;
	}
	.inner_top{
		position: relative;
		width: 100%;
		height: 100%;
		background:#1877b1bf;
	}
	.img_cover,.img_cover1{
		opacity: 0.6;
		transition: 0.5;
		cursor: pointer;
	}
	.img_cover:hover,.img_cover1:hover{
		opacity: 1;
	}
	.hire_ser{
		position: relative;
		top: 30px;
	}
	.btm_hire{
		background-image: url(<?=url('img/btm-back.png')?>);
		background-origin: content-box;
		background-repeat: no-repeat;
		background-size: cover;
		height: auto;
		padding-bottom:20px; 
	}
	.provide{
		font-size:30px;
		font-weight: 100;
	}
	.height_50{
		height: 50px;
		line-height: 50px;
		margin-right: 15px;
	}
	.hire_form input,.hire_form textarea{
		width: 100% !important;
		height: 42px !important;
		background:#F0F3F4 !important;
		border-radius: 5px !important;
		padding: 0px 10px !important;
		border: 1px solid #c3c3c3 !important;
		font-size: 17px !important;
		box-sizing: border-box !important;
	}
	.hire_form input:focus,.hire_form textarea:focus{
		background: #fff !important;
		-webkit-box-shadow: 0 4px 5px 0 rgba(0, 0, 0, 0.14), 0 1px 10px 0 rgba(0, 0, 0, 0.12), 0 2px 4px -1px rgba(0, 0, 0, 0.3) !important;
    	box-shadow: 0 4px 5px 0 rgba(0, 0, 0, 0.14), 0 1px 10px 0 rgba(0, 0, 0, 0.12), 0 2px 4px -1px rgba(0, 0, 0, 0.3) !important;
	}
	.hire_form textarea{
		padding: 10px !important;
		height: 150px !important;
		outline: none;
	}
	.error{
		background:#4caf5073;
		font-size: 22px;
		color: #000000a3;
		border-radius: 10px;
		padding:10px !important;
	}
	.input-field .btn-small{
		height: 45px;
		line-height: 45px;
		font-size: 22px;
	}
	h1{
		cursor: pointer;
	}
	@media(max-width: 500px){
		.hire_form input,.hire_form textarea{
			width: 100% !important;
			box-sizing: border-box !important;
			font-size: 14px !important
		}
		.m_t_m_50{
			margin-top: 50px !important;
		}
		.font_s38{
			font-size: 28px;
		}
		.font_size28{
			font-size: 22px;
		}
		.hire_ser div .s12{
			margin-top: 20px;
		}
		.hire_ser div{
			margin-bottom: 20px;
		}
		.provide{
			font-size: 30px;
		}
		.hire_form{
			padding: 0px;
		}
		.font_size18{
			font-size: 16px;
		}
		.img_cover{
			text-align: center;
		}
	}
</style>
<div class="row top_hire">
    <div class="col-12 inner_top">
        <h1 class="px-2 mb-2 font-s-32 text-white text-center mt-4">What We Do?</h1>
        <p class="w-100 text-white text-center">We Provide always our best services for our clients</p>
        <div class="container hire_ser">
            <div class="row bg-white shadow py-3">
                <div class="col-lg-3 col-12 text-center">
                    <img src="<?=url('img/bulid.png')?>" class="img_cover1" width="60" height="60" alt="Bulid Custom Calculator">
                    <p class="p-2 font-s-16">Bulid Custom Calculator</p>
                </div>
                <div class="col-lg-3 col-12 text-center">
                    <img src="<?=url('img/excal.png')?>" class="img_cover1" width="60" height="60" alt="Excel to Web Calculator">
                    <p class="p-2 font-s-16">Excel to Web Calculator</p>
                </div>
                <div class="col-lg-3 col-12 text-center">
                    <img src="<?=url('img/hire-search.png')?>" class="img_cover1" width="60" height="60" alt="Research and Bulid Calculator">
                    <p class="p-2 font-s-16">Research and Bulid Calculator</p>
                </div>
                <div class="col-lg-3 col-12 text-center">
                    <img src="<?=url('img/calapp.png')?>" class="img_cover1" width="60" height="60" alt="Calculator in App">
                    <p class="p-2 font-s-16">Calculator in App</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="btm_hire">
    <br><br><br><br>
    <div class="container row">
        <p class="col-12 font-s-21 mt-3 m_t_m_50"><b>Why should you Hire Us?</b></p>
        <div class="col-lg-8 content">
            <p class="mt-2">Now, you can make your own custom calculator according to your requirements at this authorized platform! We are here to offer certain services in the development of Wordpress plug-in, converter or any other type of calculator.</p>
            <p class="mt-3 pb-2">We develop calculators corresponding to your business or any other-related requirements. So, if you would like to get a calculator of your choice, feel-free to contact us 24/7. Furthermore, our team does a well of research for your needs to provide you the precise outcomes. And, if any additional suitable queries are found during research, then the editorial team will contact you on the provided email. Simply, fill-up the given form below to make your custom calculator now!</p>
        </div>
        <div class="col-lg-4 p-3">
            <img src="<?=url('img/back-hire.png')?>" width="100%" alt="Desktop and Mobile">
        </div>
    </div>
</div>
<div class="bg-theme pb-3">
    <div class="container row">
        <p class="col-12 mt-4 provide text-center text-white">Functions we provide in a <strong class="text-white">Custom Calculator...</strong></p>
        <div class="col-lg-4 col-12 mt-3 px-2">
            <div class="img_cover mt-3 d-flex justify-content-end align-items-center" img="<?=url('img/responsive.png')?>" hd="Responsive to all devices" valu="Mobile, Laptop, Tab and Desktop.">
                <span class="font-s-18 text-center height_50 text-white">Responsive to all devices</span>
                <img src="<?=url('img/responsive.png')?>" height="40" width="40" class="right" alt="Responsive to all devices">
            </div>
            <div class="img_cover mt-3 d-flex justify-content-end align-items-center" img="<?=url('img/design.png')?>" hd="Professional design" valu="We provide the professional designs according to your website eg. color combination & box structured.">
                <span class="font-s-18 text-center height_50 text-white">Professional design</span>
                <img src="<?=url('img/design.png')?>" height="40" width="40" class="right" alt="Professional design">
            </div>
            <div class="img_cover mt-3 d-flex justify-content-end align-items-center" img="<?=url('img/settings.png')?>" hd="Setting page" valu="You can change, add and remove the values on this page.">
                <span class="font-s-18 text-center height_50 text-white">Setting page</span>
                <img src="<?=url('img/settings.png')?>" height="40" width="40" class="right" alt="Setting page">
            </div>
            <div class="img_cover mt-3 d-flex justify-content-end align-items-center" img="<?=url('img/result.png')?>" hd="Export result" valu="You can print, export the results as a MS files (pdf, word or excel sheets).">
                <span class="font-s-18 text-center height_50 text-white">Export result</span>
                <img src="<?=url('img/result.png')?>" height="40" width="40" class="right" alt="Export result">
            </div>
            <div class="img_cover mt-3 d-flex justify-content-end align-items-center" img="<?=url('img/email.png')?>" hd="Send result to User via Email" valu="You can send the results through Email, including templates, images, pdf, excel, and document files.">
                <span class="font-s-18 text-center height_50 text-white">Send result to User via Email</span>
                <img src="<?=url('img/email.png')?>" height="40" width="40" class="right" alt="Send result to User via Email">
            </div>
            <div class="img_cover mt-3 d-flex justify-content-end align-items-center" img="<?=url('img/chart.png')?>" hd="Graph/Chart in result" valu="We provide the graphical representation of the outcomes in the form of charts/graphs.">
                <span class="font-s-18 text-center height_50 text-white">Graph/Chart in result</span>
                <img src="<?=url('img/chart.png')?>" height="40" width="40" class="right" alt="Graph/Chart in result">
            </div>
        </div>
        <div class="col-lg-4 col-12 text-center">
            <img src="<?=url('img/bmi.png')?>" width="100%" alt="bmi custom calculator">
        </div>
        <input type="hidden" id="check" value="not">
        <div class="col-lg-4 col-12 mt-3 p-2 feat">
            <div class="mt-3 d-flex align-items-center">
                <img src="<?=url('img/settings.png')?>" height="50" class="left himg" alt="Features">
                <span class="font-s-18 text-center height_50 hhd text-white" style="margin-left: 15px;">Setting page</span>
            </div>
            <p class="w-100 font-s-16 mt-3 text-white hvalu">
                You can change, add and remove the values on this page
            </p>
        </div>
    </div>
</div>
<div class="bg-white py-3">
    <div class="container row pb-2">
        <p class="col-12 mt-2 font-s-25 text-center"><b>Examples</b></p>
        <div class="col-12 content">
            <p class="text-center mt-2 font-s-18">Currently, we have around 200 calculators to help you in math, finance, stat, health & others and still working on. We provide the free widgets of our all the calculators that you can add on your site. Also, if you would like to get the custom calculator according to your needs, then contact us now!</p>
        </div>
        <div class="col-lg-3 col-12 px-2">
            <img src="<?=url('img/cal1.png')?>" width="100%" alt="example 1">
        </div>
        <div class="col-lg-3 col-12 px-2">
            <img src="<?=url('img/cal2.png')?>" width="100%" alt="example 2">
        </div>
        <div class="col-lg-3 col-12 px-2">
            <img src="<?=url('img/cal3.png')?>" width="100%" alt="example 3">
        </div>
        <div class="col-lg-3 col-12 px-2">
            <img src="<?=url('img/cal4.png')?>" width="100%" alt="example 4">
        </div>
    </div>
</div>
<div class="bg-theme py-3 mb-5">
    <div class="container row">
        <p class="col-12 text-center font-s-25 my-3"><strong class="text-white">Why Calculator-online.net?</strong></p>
        <div class="col-lg-3 col-12 mt-3 text-center px-2">
            <img src="<?=url('img/sketch-min.png')?>" alt="CUSTOM DESIGN" width="40" height="40">
            <p class="p-2 text-white" style="font-size: 23px">Custom Design</p>
            <p class="col-12 mt-2 text-white text-start">The calculator-online provide you a custom design for your website. Every element of your website is custom designed to fit the needs of the users. The website is made as the strategy and content comes first, then design is build around.</p>
        </div>
        <div class="col-lg-3 col-12 mt-3 text-center px-2">
            <img src="<?=url('img/responsive-min.png')?>" alt="RESPONSIVE" width="40" height="40">
            <p class="p-2 text-white" style="font-size: 23px">Responsive</p>
            <p class="col-12 mt-2 text-white text-start">We made a responsive interface for calculators that compatible to all the devices like Laptops, Desktop, Mobile phones, Tablet etc.</p>
        </div>
        <div class="col-lg-3 col-12 mt-3 text-center px-2">
            <img src="<?=url('img/universal.png')?>" alt="UNIVERSAL" width="40" height="40">
            <p class="p-2 text-white" style="font-size: 23px">Universal</p>
            <p class="col-12 mt-2 text-white text-start">Our aim to provide the universal web designs for your websites so that to make your website accessible to everyone or to meet the needs of the many individuals as possible.</p>
        </div>
        <div class="col-lg-3 col-12 mt-3 text-center px-2">
            <img src="<?=url('img/simple.png')?>" alt="SIMPLE TO INSTALL" width="40" height="40">
            <p class="p-2 text-white" style="font-size: 23px">Simple to Install</p>
            <p class="col-12 mt-2 text-white text-start">We made the custom calculators by considering your standard requirements and provide the user-friendly interface for convenient installation.</p>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.img_cover').forEach(function(imgCover) {
        imgCover.addEventListener('mouseenter', function() {
            var check = document.getElementById('check').value;
            if (check == 'not') {
                document.querySelector('.feat').style.display = 'none';
                var img = imgCover.getAttribute('img');
                var hd = imgCover.getAttribute('hd');
                var valu = imgCover.getAttribute('valu');
                document.querySelector('.himg').src = img;
                document.querySelector('.himg').alt = hd;
                document.querySelector('.hhd').textContent = hd;
                document.querySelector('.hvalu').textContent = valu;
                document.querySelector('.feat').style.display = 'block'; // Use fade-in animation if needed
                document.getElementById('check').value = 'yes';
            }
        });

        imgCover.addEventListener('mouseleave', function() {
            document.getElementById('check').value = 'not';
        });
    });
</script>
@endsection