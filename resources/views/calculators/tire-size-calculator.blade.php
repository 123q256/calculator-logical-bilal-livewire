<style>
    .pacetabs{
        left: 16.6%;
    }
    @media (max-width: 991px){
        .pacetabs{
            left: 0;
        }
    }
    .d-center{
        display: flex;
        align-items: center;
        justify-content: center
    }
    .px-10{
        padding-left: 10px;
        padding-right: 10px
    }
    .go_plus{
        text-decoration: underline
    }
    .go_plus:hover{
        cursor: pointer
    }
    #gotosize{
        display: none
    }
    .tire_wrap{
        position: relative;
        display: inline-block;
    }
    #ww{
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        -webkit-transition: width 1s,height 1s,top 1s,left 1s;
        transition: width 1s,height 1s,top 1s,left 1s,transform .5s;
    }
    #tt{
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        z-index: 1;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
        border-radius: 93px;
        overflow: hidden;
    }
    #aa{
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
        z-index: 2;
        border-radius: 100%;
    }
    #cc{
        width: 185px;
        height: 185px;
        overflow: hidden;
        position: relative;
        display: inline-block;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #cal_comp1 {
        display: inline-block;
        vertical-align: top;
        position: relative;
        margin-bottom: 50px;
    }
    #vis_arrow {
        position: absolute;
        left: 0px;
        bottom: 5px;
        -webkit-transform: rotate(43deg);
        transform: rotate(43deg);
    }
    #t_wheel {
        border: 1px solid #a0a0a0;
        border-bottom: none;
        position: absolute;
        right: 50px;
        top: -15px;
        height: 100px;
        width: 85px;
        text-align: center;
        z-index: 2;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s,right 1s;
    }
    #t_side {
        border: 1px solid #a0a0a0;
        border-left: none;
        position: absolute;
        right: 10px;
        bottom: 2px;
        height: 50px;
        width: 80px;
        text-align: right;
        z-index: 2;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #vis_revs {
        position: absolute;
        bottom: -20px;
        width: 100%;
        text-align: center;
    }
    #vis_side {
        padding: 2px 0px 5px 3px;
        height: 10px;
        display: inline-block;
        margin: 25px -12px 0px 0px;
        -webkit-transition: margin 1s;
        transition: margin 1s;
    }
    #vis_wheel {
        padding: 0px 5px 0px 5px;
        width: 20px;
        margin: -10px auto 0px auto;
    }
    #cal_visualizer {
        float: left;
        width: 100%;
        text-align: center;
        font-size: 12px;
        position: relative;
    }
    #cal_wrap {
        position: relative;
        width: 100%;
        min-height: 421px;
        margin-top: 25px;
        /* float: right; */
        overflow: hidden;
        border-radius: 2px;
        text-align: center;
        z-index: 1;
        border-radius: 10px
    }
    #cal_viewer {
        padding-top: 30px;
        clear: both;
        height: 225px;
    }
    #cal_comp2 {
        display: inline-block;
        vertical-align: top;
        position: relative;
        margin-bottom: 50px;
        padding: 0px 0px 0px 30px;
    }
    #tctc {
        width: 63px;
        height: 185px;
        position: relative;
        display: inline-block;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #tt_width {
        border: 1px solid #a0a0a0;
        border-top: none;
        position: absolute;
        bottom: -15px;
        height: 12px;
        width: 98%;
        text-align: center;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #tt_height {
        border: 1px solid #a0a0a0;
        border-right: none;
        position: absolute;
        left: -20px;
        top: 0px;
        height: 97%;
        width: 15px;
        text-align: center;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #show_tires {
        height: 20px;
        text-align: center;
        font-size: 16px;
        padding: 10px 0px 10px 0px;
    }
    #cc img {
        width: 100%;
        height: 100%;
        border: none
    }
    .getcalcs {
        width: 150px;
        height: 32px;
        padding-top: 5px;
        margin: 20px auto 25px auto;
        background-color: #2083d4;
        border-radius: 2px;
        text-align: center;
        font-size: 20px;
        line-height: 26px;
        color: #f0f0f0;
    }
    #CompVisualizer {
        width: 100%;
        text-align: center;
        font-size: 12px;
        display: none;
    }
    #Viewer {
        padding-top: 30px;
        clear: both;
        background-color: #dddddd57;
    }
    #ShowCompTires {
        text-align: center;
        font-size: 16px;
        padding: 10px 0px 10px 0px;
    }
    #ShowCompTires span {
        width: 21px;
        height: 21px;
        background-image: url(/images/imgsprite.png);
        background-position: -11px -39px;
        background-size: 135px;
        display: none;
    }

    #spin2 {
        -webkit-transition: all .5s;
        transition: all .5s;
    }
    #comp2 {
        display: inline-block;
        vertical-align: top;
        position: relative;
        margin-bottom: 50px;
        padding: 0px 35px 0px 35px;
    }
    #tc1 {
        width: 63px;
        height: 185px;
        position: relative;
        display: inline-block;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #tt_width1 {
        border: 1px solid #a0a0a0;
        border-top: none;
        position: absolute;
        bottom: -15px;
        height: 12px;
        width: 98%;
        text-align: center;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #viswidth1 {
        margin-top: 6px;
        padding: 0px 5px 0px 5px;
        background-color: #f0f0f0;
        display: inline-block;
    }
    #tt_height1 {
        border: 1px solid #a0a0a0;
        border-right: none;
        position: absolute;
        left: -20px;
        top: 0px;
        height: 97%;
        width: 15px;
        text-align: center;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #visheight1 {
        padding: 5px 0px 8px 0px;
        background-color: #f0f0f0;
        height: 10px;
        display: inline-block;
        margin: 80px 0px 0px -12px;
        -webkit-transition: margin 1s;
        transition: margin 1s;
    }
    #tc2 {
        width: 63px;
        height: 185px;
        overflow: hidden;
        position: relative;
        display: inline-block;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #tt_width2 {
        border: 1px solid #f1a400;
        border-top: none;
        position: absolute;
        bottom: -15px;
        height: 12px;
        width: 98%;
        text-align: center;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #tt_height2 {
        border: 1px solid #f1a400;
        border-left: none;
        position: absolute;
        right: -20px;
        top: 0px;
        height: 98%;
        width: 15px;
        text-align: center;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #viswidth2 {
        margin-top: 6px;
        padding: 0px 5px 0px 5px;
        background-color: #f0f0f0;
        display: inline-block;
    }
    #visheight2 {
        padding: 5px 0px 8px 3px;
        background-color: #f0f0f0;
        height: 10px;
        display: inline-block;
        margin: 80px -12px 0px 0px;
        -webkit-transition: margin 1s;
        transition: margin 1s;
    }
    #comp1 {
        display: inline-block;
        vertical-align: top;
        position: relative;
        margin-bottom: 50px;
    }
    #c1 {
        width: 185px;
        height: 185px;
        overflow: hidden;
        position: relative;
        display: inline-block;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #t_wheel1 {
        border: 1px solid #a0a0a0;
        border-bottom: none;
        position: absolute;
        right: 50px;
        top: -15px;
        height: 100px;
        width: 85px;
        text-align: center;
        z-index: 2;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s,right 1s;
    }
    #vis_wheel1 {
        padding: 0px 5px 0px 5px;
        background-color: #f0f0f0;
        width: 20px;
        margin: -6px auto 0px auto;
    }
    #vis_side1 {
        padding: 2px 0px 5px 3px;
        background-color: #f0f0f0;
        height: 10px;
        display: inline-block;
        margin: 25px -12px 0px 0px;
        -webkit-transition: margin 1s;
        transition: margin 1s;
    }

    #vis_revs1 {
        position: absolute;
        bottom: -20px;
        width: 100%;
        text-align: center;
    }
    #c2 {
        width: 185px;
        height: 185px;
        overflow: hidden;
        display: inline-block;
        position: relative;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #vis_arrow1 {
        position: absolute;
        left: 0px;
        bottom: 5px;
        -webkit-transform: rotate(43deg);
        transform: rotate(43deg);
    }
    #vis_arrow2 {
        position: absolute;
        right: 6px;
        bottom: 15px;
        -webkit-transform: rotate(-43deg);
        transform: rotate(-43deg);
    }
    #t_wheel2 {
        border: 1px solid #f1a400;
        border-bottom: none;
        position: absolute;
        right: 50px;
        top: -15px;
        height: 100px;
        width: 85px;
        text-align: center;
        z-index: 2;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #t_side2 {
        border: 1px solid #f1a400;
        border-right: none;
        position: absolute;
        left: 10px;
        bottom: 2px;
        height: 50px;
        width: 80px;
        text-align: left;
        z-index: 2;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #vis_wheel2 {
        padding: 0px 5px 0px 5px;
        background-color: #f0f0f0;
        width: 20px;
        margin: -6px auto 0px auto;
    }
    #vis_side2 {
        padding: 2px 3px 5px 0px;
        background-color: #f0f0f0;
        height: 10px;
        display: inline-block;
        margin: 25px 0px 0px -8px;
        -webkit-transition: margin 1s;
        transition: margin 1s;
    }
    #vis_revs2 {
        position: absolute;
        bottom: -20px;
        width: 100%;
        text-align: center;
    }
    #comparespeed {
        margin: 20px 0px 20px 0px;
        display: inline-block;
        text-align: center
    }
    .bigtext {
        font-size: 16px;
    }
    #reading {
        display: inline-block;
        vertical-align: top;
        margin-left: -9px;
    }
    #actual {
        display: inline-block;
        vertical-align: top;
    }
    #comparespeed input {
        display: inline-block;
        border: none;
        background-color: #f3964c;
        margin: 3px 0px 0px 5px;
        border-radius: 2px;
        height: 20px;
        text-align: center;
        width: 70px;
    }
    #a1 {
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
        z-index: 2;
        border-radius: 100%;
    }
    #t1 {
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        z-index: 1;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
        border-radius: 93px;
        overflow: hidden;
    }
    #t2 {
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        z-index: 1;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
        border-radius: 93px;
        overflow: hidden;
    }
    #a2 {
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
        z-index: 2;
        border-radius: 100%;
    }
    #c1 img, #c2 img {
        width: 100%;
        height: 100%;
    }
    #w1 {
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        -webkit-transition: width 1s,height 1s,top 1s,left 1s;
        transition: width 1s,height 1s,top 1s,left 1s;
    }
    #w2 {
        width: 185px;
        height: 185px;
        position: absolute;
        left: 0px;
        top: 0px;
        -webkit-transition: width 1s,height 1s,top 1s,left 1s;
        transition: width 1s,height 1s,top 1s,left 1s;
    }
    #resultstab {
        float: right;
        text-align: left;
        width: 100%;
        -webkit-transition: all .5s;
        transition: all .5s;
    }
    #ShowAlternate {
        height: 30px;
        text-align: center;
        font-size: 16px;
        padding: 10px 0px 10px 0px;
    }
    #SizeTabWrap {
        height: 26px;
        display: none;
    }
    #SizeTabWrap a {
        padding: 5px 10px 5px 10px;
        margin-right: 5px;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
        color: #333;
        display: inline-block;
        vertical-align: top;
        min-width: 40px;
        text-align: center;
        text-decoration: none;
    }
    #SizeTabWrap a:hover{
        cursor: pointer
    }
    .num_selected {
        background-color: #f0f0f0;
    }
    .num_unselected {
        background-color: #d0d0d0;
    }
    #DisplayTires1 {
        position: relative;
        right: 0px;
        -moz-transition: -moz-transform .5s;
        -webkit-transition: -webkit-transform .5s;
        transition: transform .5s;
    }
    #SizeTable {
        width: 100%;
        text-align: left;
        border-spacing: 0px 5px;
        overflow: hidden;
        color: #222;
        background: #f0f0f0;
    }
    .dontshow {
        display: none;
    }
    .dia {
        background-color: #fff;
    }
    .diaover {
        background-color: #f5f5f5;
    }
    #SizeTable td:nth-child(1) {
        padding-left: 5px;
    }
    #SizeTable td:nth-child(2) {
        border-left: 1px solid #e5e5e5;
        border-right: 1px solid #e5e5e5;
        background-color: #f5f5f5;
    }
    #SizeTable td {
        line-height: 1;
        text-align: left;
        border-bottom: 1px solid #e5e5e5;
        padding: 17px 5px 0px 5px;
        height: 32px;
        vertical-align: top;
    }
    #DisplayTires1 a {
        text-decoration: underline;
        cursor: inherit;
    }

    .SizeLink {
        color: #0059d8;
        text-decoration: underline;
    }
    #SizeTable td span {
        font-size: 11px;
        margin: 1px 10px 0px 0px;
        font-weight: normal;
    }
    .greyspan {
        color: #a0a0a0;
    }
    #MoreSizes {
        text-decoration: underline;
        cursor: pointer;
        margin: 5px;
        text-align: center;
    }
    #SizeChange {
        text-align: center;
        margin: 20px 0px 10px 0px;
    }
    #CalcEquivs {
        margin: 0px auto 0px auto;
        display: none;
    }
    .sep {
        height: 10px;
    }
    #mconvert {
        position: relative;
        width: 80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        border-radius: 13px;
    }
    #slid {
        position: absolute;
        top: 0;
        left: 0;
        width: 45px;
        height: 100%;
        border-radius: 13px;
        background: #9b9b9b4d
    }
    #mm {
        float: left;
        padding: 5px;
    }
    #in {
        float: left;
        padding: 5px;
    }
    #mconvert:hover{
        cursor: pointer
    }
    #calctab {
        position: relative;
    }
    #t_side1 {
        border: 1px solid #a0a0a0;
        border-left: none;
        position: absolute;
        right: 10px;
        bottom: 2px;
        height: 50px;
        width: 80px;
        text-align: right;
        z-index: 2;
        -webkit-transition: width 1s,height 1s;
        transition: width 1s,height 1s;
    }
    #a2 img{
        width: 173px;
        height: 173px
    }
    .result_area{
        margin: 20px 0;
        text-align: center;
        border-radius: 5px
    }
    #comparespeed span {
        font-size: 11px;
    }
</style>

<div class="row relative">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="col-12 col-lg-9 mx-auto mt-2 w-full md:w-[70%] lg:w-[70%] pacetabs">
            <input type="hidden" name="calculator_name" id="calculator_name" value="calculator1">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div  onclick="change_tab(this);tab1();" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit pacetab tiretab" id="tab1">
                        Tire Calculator
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div  onclick="change_tab(this);tab2()" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab tiretab" id="tab2">
                        Tire Comparison
                    </div>
                </div>
            </div>
      </div>
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div id="calctop">
                <form name="tirecalc">
                    <div class="col-12 d-center px-2">
                        <span class="text-center px-10"><strong>Sizes</strong></span>
                        <input type="number" name="sw" class="input">
                        <span class="text-center px-10"><strong>/</strong></span>
                        <input type="number" name="as" class="input">
                        <span class="text-center px-10"><strong>R</strong></span>
                        <input type="number" name="rim" class="input">
                    </div>
                    <div id="Equivalent" class="col-12 d-center px-2 mt-3">
                        <a class="go_plus" onclick="tab3()">Convert to Different Wheel Size?</a>
                        <input type="hidden" name="nrim" value="">
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="button" name="submit" class="calculate px-6 py-3 sm:px-10 sm:py-4 font-semibold text-[#ffffff] bg-[#2845F5] rounded-[30px] focus:outline-none focus:ring-2 text-sm sm:text-base" onclick='calculate_tire(tirecalc,tirecalc.sw.value,tirecalc.as.value,tirecalc.rim.value,tirecalc.nrim.value,"","TireSizeCalc");scroll_to_result()'>{!! $lang['calculate'] !!}</button>
                    </div>
                    <div class="col-12 font-s-20 px-2 result_area p-2 bg-[#2845F5] text-white">Result</div>
                    <div id="calcspecs" style="display: block">
                        <div class="col-12 d-center px-2 mt-2">
                        <div class="col-4 col-md-3 specCat2"><strong>Diameter</strong></div>
                        <input type="text" class="input" name="diameter">
                        </div>
                        <div class="col-12 d-center px-2 mt-2">
                        <div class="col-4 col-md-3 specCat2"><strong>Width</strong></div>
                        <input type="text" class="input" name="width">
                        </div>
                        <div class="col-12 d-center px-2 mt-2">
                        <div class="col-4 col-md-3 specCat2"><strong>Sidewall</strong></div>
                        <input type="text" class="input" name="sidewall">
                        </div>
                        <div class="col-12 d-center px-2 mt-2">
                        <div class="col-4 col-md-3 specCat2"><strong>Circum.</strong></div>
                        <input type="text" class="input" name="circumference">
                        </div>
                        <div class="col-12 d-center px-2 mt-2">
                        <div class="col-4 col-md-3" s3 id="rev1"><strong>Revs/Mile</strong></div>
                        <input type="text" class="input" name="revs">
                        </div>
                        <input type="hidden" name="diameter2" value='31.3"'>
                        <input type="hidden" name="width2" value='10.2"'>
                        <input type="hidden" name="rim2" value="17">
                    </div>
                    <div id="CalcEquivs" class="px-2" style="display: none;">
                        <div class="col-12 center fw-bold font_size18" style="margin-bottom:20px">Tire Size Equivalents</div>
                        <div class="col-12 d-center">
                        <div class="col-5 specCat2" id="rev1" style="padding-left:0"><strong>Equal Inches Size</strong></div>
                        <input class="input" id="eqin">
                        </div>
                        <div class="col-12 d-center mt-2">
                        <div class="col-5 specCat2" id="rev1" style="padding-left:0"><strong>Equal Metric Size</strong></div>
                        <input class="input" id="eqmet">
                        </div>
                    </div>
                </form>
            </div>
            <div id="calctab" style="transition: all 0.5s ease 0s">
                <div id="calctop2" style="display: none">
                    <form name="tirecompare">
                        <div class="col-12 d-center mt-2 px-2">
                            <span class="col-2 text-center px-10"><strong>Size 1</strong></span>
                            <input type="number" name="sw" class="input">
                            <span class="col-2 text-center px-10"><strong>/</strong></span>
                            <input type="number" name="as" class="input">
                            <span class="col-2 text-center px-10"><strong>R</strong></span>
                            <input type="number" name="rim" class="input">
                        </div>
                        <div class="col-12 d-center px-2 mt-2">
                            <span class="col-2 text-center px-10"><strong>Size 2</strong></span>
                            <input type="number" name="swb" class="input">
                            <span class="col-2 text-center px-10"><strong>/</strong></span>
                            <input type="number" name="asb" class="input">
                            <span class="col-2 text-center px-10"><strong>R</strong></span>
                            <input type="number" name="rimb" class="input">
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="button" name="submit" class="calculate bg-[#99EA48] p-3 rounded-lg" onclick="compare_tire(tirecompare,tirecompare.sw.value,tirecompare.as.value,tirecompare.rim.value,tirecompare.swb.value,tirecompare.asb.value,tirecompare.rimb.value,'','TireSizeCalc');scroll_to_result1()">{!! $lang['calculate'] !!}</button>
                        </div>
                        <div class="col-12 font-s-25 px-2 fw-bold result_area result_area1 bg-[#99EA48]">Result</div>
                        <div id="comparecalc">
                        <div class="specCat"></div>
                        <div class="row mt-2">
                            <div class="col-4 col-md-3"></div>
                            <div class="col-4 col-md-5"><strong>Size 1</strong></div>
                            <div class="col-4 col-md-4"><strong>Size 2</strong></div> 
                        </div>
                        <div class="col-12 d-center px-2">
                            <span class="col-4 col-md-3 px-10"><strong>Diameter</strong></span>
                            <input type="text" name="diameter" class="tire1 input mt-2 me-2">
                            <input type="text" name="diameterb" class="tire2 input mt-2">
                            <input type="text" name="pdiameterb" class="diff input mt-2">
                        </div>
                        <div class="col-12 d-center px-2">
                            <span class="col-4 col-md-3 px-10"><strong>Width</strong></span>
                            <input type="text" name="width" class="tire1 input mt-2 me-2">
                            <input type="text" name="widthb" class="tire2 input mt-2">
                            <input type="text" name="pwidthb" class="diff input mt-2">
                        </div>
                        <div class="col-12 d-center px-2">
                            <span class="col-4 col-md-3 px-10"><strong>Sidewall</strong></span>
                            <input type="text" name="sidewall" class="tire1 input mt-2 me-2">
                            <input type="text" name="sidewallb" class="tire2 input mt-2">
                            <input type="text" name="psidewallb" class="diff input mt-2">
                        </div>
                        <div class="col-12 d-center px-2">
                            <span class="col-4 col-md-3 px-10"><strong>Circum.</strong></span>
                            <input type="text" name="circumference" class="tire1 input mt-2 me-2">
                            <input type="text" name="circumferenceb" class="tire2 input mt-2">
                            <input type="text" name="pcircumferenceb" class="diff input mt-2">
                        </div>
                        <div class="col-12 d-center px-2">
                            <span class="col-4 col-md-3 px-10" id="rev2"><strong>Revs/Mile</strong></span>
                            <input type="text" name="revs" class="tire1 input mt-2 me-2">
                            <input type="text" name="revsb" class="tire2 input mt-2">
                            <input type="text" name="prevsb" class="diff input mt-2">
                        </div>
                        </div>
                    </form>
                </div>
                <div class="col-12 px-2 mt-3">
                    <div id="mconvert" class="col-12 border" onclick="m_convert('mm','flip');ga('send','event','mConvert','calc');">
                        <div id="slid"></div>
                        <span id="in">inches</span>
                        <span id="mm">mm</span>
                    </div>
                </div>
            </div>
            <div id="cal_wrap" style="margin-top: 25px">
                <div id="cal_visualizer">
                    <div id="show_tires" onclick="showVisual();ga('send', 'event', 'Visualizer', 'tabclicked')">
                        Tire Size Visualizer
                        <span id="spin"></span>
                    </div>
                    <div id="cal_viewer">
                        <div id="cal_comp2">
                        <div class="tire_wrap">
                            <div id="tctc"><img src="{!!asset('images/tire_front.jpg')!!}" alt="Tire Front View" width="63px" height="185px" /></div>
                            <div id="tt_width"><div id="viswidth">Width</div></div>
                            <div id="tt_height"><div id="visheight">Dia.</div></div>
                        </div>
                        </div>
                        <div id="cal_comp1">
                        <div class="tire_wrap">
                            <div id="cc">
                            <div id="tt">
                                <img src="{!!asset('images/tire_without_rim.jpg')!!}" alt="Tire Side View" />
                                <div id="ww"><img src="{!!asset('images/full_tire.jpg')!!}" alt="Wheel Side View" /></div>
                            </div>
                            <div id="aa">
                                <img src="{!!asset('images/arrow_angle.png')!!}" alt="full tire show" width="185px" height="185px" />
                                <div id="vis_arrow">Circ.</div>
                            </div>
                            </div>
                            <div id="t_wheel"><div id="vis_wheel">Rim</div></div>
                            <div id="t_side"><div id="vis_side">Wall</div></div>
                            <div id="vis_revs">Revs/Mile</div>
                        </div>
                        </div>
                    </div>
                    <div id="gotosize"></div>
                    <br /><br />
                    <div id="trypresscalc"></div>
                    <br />
                    <div id="trysparetire"></div>
                </div>
                <div id="CompVisualizer">
                    <div id="ShowCompTires" onclick="showCompVisual()">
                        Tire Size Comparison Visualizer
                        <span id="spin2"></span>
                    </div>
                    <div id="Viewer">
                        <div id="comp2">
                        <div class="tire_wrap" id="ttire1">
                            <div id="tc1"><img src="{!!asset('images/tire_front1.jpg')!!}" alt="Tire 1 Front View" /></div>
                            <div id="tt_width1"><div id="viswidth1">Width</div></div>
                            <div id="tt_height1"><div id="visheight1">Dia.</div></div>
                        </div>
                        <div class="tire_wrap" id="ttire2">
                            <div id="tc2"><img src="{!!asset('images/tire_front2.jpg')!!}" alt="Tire 2 Front View" /></div>
                            <div id="tt_width2"><div id="viswidth2">Width</div></div>
                            <div id="tt_height2"><div id="visheight2">Dia.</div></div>
                        </div>
                        </div>
                        <div id="comp1">
                        <div class="tire_wrap" id="tire1">
                            <div id="c1">
                            <div id="t1">
                                <img src="{!!asset('images/tire_without_rim.jpg')!!}" alt="Tire 1 Side View" />
                                <div id="w1"><img src="{!!asset('images/full_tire.jpg')!!}" alt="Tire 1 Wheel" /></div>
                            </div>
                            <div id="a1">
                                <img src="{!!asset('images/arrow_angle1.png')!!}" alt="Arrow Image of Tire" />
                                <div id="vis_arrow1">Circ.</div>
                            </div>
                            </div>
                            <div id="t_wheel1"><div id="vis_wheel1">Rim</div></div>
                            <div id="t_side1"><div id="vis_side1">Wall</div></div>
                            <div id="vis_revs1">Revs/Mile</div>
                        </div>
                        <div class="tire_wrap" id="tire2">
                            <div id="c2">
                            <div id="t2">
                                <img src="{!!asset('images/tire_without_rim.jpg')!!}" alt="Tire 2 Side View" />
                                <div id="w2"><img src="{!!asset('images/full_tire.jpg')!!}" alt="Tire 2 Wheel" /></div>
                            </div>
                            <div id="a2">
                                <img src="{!!asset('images/arrow_angle2.png')!!}" alt="Image of Arrow Angle two" />
                                <div id="vis_arrow2">Circ.</div> 
                            </div>
                            </div>
                            <div id="t_wheel2"><div id="vis_wheel2">Rim</div></div>
                            <div id="t_side2"><div id="vis_side2">Wall</div></div>
                            <div id="vis_revs2">Revs/Mile</div>
                        </div>
                        </div>
                        <div id="trywheelcalc"></div>
                    </div>
                    <div id="comparespeed">
                        <div class="bigtext">
                        Speedometer Error<br />
                        <span>(Set Size1 to OEM Size)</span>
                        </div>
                        <br />
                        <form name="speed">
                        <div id="reading">
                            <b>Reading</b><a>20 mph</a><a>30 mph</a><a>40 mph</a><a>50 mph</a><a>60 mph</a><a>70 mph</a><a>80 mph</a><a>90 mph</a>
                        </div>
                        <div id="actual">
                            <b>Actual</b><input type="text" name="spd20" />
                            <input type="text" name="spd30" />
                            <input type="text" name="spd40" /><input type="text" name="spd50" />
                            <input type="text" name="spd60" /><input type="text" name="spd70" />
                            <input type="text" name="spd80" /><input type="text" name="spd90" />
                        </div>
                        </form>
                    </div>
                </div>
                <div id="resultstab" style="display: block">
                    <div id="ShowAlternate">Alternate Tire Sizes</div>
                    <div id="SizeTabWrap"></div>
                    <div id="DisplayTires1" class="overflow-auto"></div>
                    <div id="SizeChange">
                        <select id="changeRim" class="input" onchange="changeRim();">
                            <option value="0">More Wheel Sizes</option>
                            <option value="14">14"</option>
                            <option value="15">15"</option>
                            <option value="16">16"</option>
                            <option value="17">17"</option>
                            <option value="18">18"</option>
                            <option value="19">19"</option>
                            <option value="20">20"</option>
                            <option value="21">21"</option>
                            <option value="22">22"</option>
                            <option value="23">23"</option>
                            <option value="24">24"</option>
                            <option value="26">26"</option>
                        </select>
                    </div>
                </div>
            </div>
       </div>
    </div>
        @if ($type=='widget')
        @include('inc.widget-button')
        @endif
    @push('calculatorJS')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            var tirepage, g = function(e) {
                return document.getElementById(e)
            };
            function setCookie(e, i, t) {
                var a = new Date;
                a.setDate(a.getDate() + t);
                var l = escape(i) + (null == t ? "" : ";expires=" + a.toUTCString());
                document.cookie = e + "=" + l + ";path=/"
            }
            function getCookie(e) {
                var i, t, a, l = document.cookie.split(";");
                for (i = 0; i < l.length; i++)
                    if (t = l[i].substr(0, l[i].indexOf("=")),
                    a = l[i].substr(l[i].indexOf("=") + 1),
                    (t = t.replace(/^\s+|\s+$/g, "")) == e)
                        return unescape(a)
            }
            var http1 = !1
              , http1 = new XMLHttpRequest;
            function tab1() {
                g("calctop2").style.display = "none",
                g("calctop").style.display = "block",
                g("CompVisualizer").style.display = "none",
                g("cal_visualizer").style.display = "block",
                g("tab1").innerHTML = "Tire Calculator",
                g("Equivalent").innerHTML = '<a class="go_plus" onclick="tab3()">Convert to Different Wheel Size?</a><input type="hidden" name="nrim" value="">',
                g("calcspecs").style.display = "block",
                g("CalcEquivs").style.display = "none",
                setCookie("Calculator", "Calc", 90),
                (window.innerWidth > 767 || document.documentElement.clientWidth > 767) && (g("resultstab").style.display = "block")
            }
            function tab2() {
                g("calctop2").style.display = "block",
                g("calctop").style.display = "none",
                g("cal_visualizer").style.display = "none",
                g("CompVisualizer").style.display = "block",
                g("resultstab").style.display = "none",
                setCookie("Calculator", "Comp", 90)
            }
            function tab3() {
                g("Equivalent").innerHTML = '<span class="col-5"><strong>New Wheel Size</strong></span><input type="number" name="nrim" class="input">',
                g("calcspecs").style.display = "none",
                g("CalcEquivs").style.display = "block",
                g("tab1").innerHTML = "Tire Calculator"
            }
            window.matchMedia("(min-width: 768px)").matches && (viewport = document.querySelector("meta[name=viewport]")).setAttribute("content", "width=1250");
            var csi = "";
            function calculate_tire(e, i, t, a, l, s, r) {
                g("SizeTabWrap").style.display = "block";
                var n = getCookie("mconvert");
                "yes" == s && "yes" == getCookie("equal") && (tab3(),
                l = getCookie("carwheel")),
                "HeightCalc" == r && (l = ""),
                t = (t = (t = (t = (t = t.replace("950", "9.5")).replace("1050", "10.5")).replace("1150", "11.5")).replace("1250", "12.5")).replace("1350", "13.5");
                var o = parseFloat(i)
                  , d = parseFloat(t)
                  , v = parseFloat(a)
                  , u = parseFloat(l);
                if ("" != l && (g("tab1").setAttribute("onclick", "tab1();calculate_tire(tirecalc,tirecalc.sw.value,tirecalc.as.value,tirecalc.rim.value,tirecalc.nrim.value,'','" + r + "')"),
                r += "Equal"),
                o > 0 && d > 0 && v > 0) {
                    if (e.sw.value = o,
                    e.as.value = d,
                    e.rim.value = v,
                    o > 89) {
                        if (e.circumference.value = Math.round((2 * o * d / 2540 + v) * 3.14 * 10) / 10 + '"',
                        e.sidewall.value = Math.round(o * d / 100 / 25.4 * 10) / 10 + '"',
                        e.revs.value = Math.round(63360 / ((2 * o * d / 2540 + v) * 3.14)),
                        e.rim2.value = v,
                        g("des") && (g("des").innerHTML = "X"),
                        void 0 == r || -1 != r.search("Calc") ? (e.diameter.value = Math.round((2 * o * d / 2540 + v) * 10) / 10 + '"',
                        e.width.value = Math.round(o / 25.4 * 10) / 10 + '"',
                        e.diameter2.value = Math.round((2 * o * d / 2540 + v) * 10) / 10 + '"',
                        e.width2.value = Math.round(o / 25.4 * 10) / 10 + '"') : (e.diameter.value = Math.round((2 * o * d / 2540 + v) * 10) / 10,
                        e.width.value = Math.round(o / 25.4 * 10) / 10,
                        e.diameter2.value = Math.round((2 * o * d / 2540 + v) * 10) / 10,
                        e.width2.value = Math.round(o / 25.4 * 10) / 10),
                        g("viswidth").innerHTML = Math.round(o / 25.4 * 10) / 10 + '"',
                        g("visheight").innerHTML = Math.round((2 * o * d / 2540 + v) * 10) / 10 + '"',
                        g("vis_wheel").innerHTML = v + '"',
                        g("vis_side").innerHTML = e.sidewall.value,
                        g("vis_arrow").innerHTML = e.circumference.value,
                        g("vis_revs").innerHTML = e.revs.value + " Revs/Mile",
                        g("eqin").value = parseFloat(e.diameter.value) + "X" + parseFloat(e.width.value) + "R" + v,
                        g("eqmet").value = o + "/" + d + "R" + v,
                        "" != l) {
                            g("eqin").value = parseFloat(e.diameter.value) + "X" + parseFloat(e.width.value) + "R" + u,
                            nas = Math.round((parseFloat(e.diameter.value) - l) / 2 * 2540 / o),
                            g("eqmet").value = o + "/" + nas + "R" + u,
                            g("vis_wheel").innerHTML = u + '"',
                            g("vis_side").innerHTML = Math.round((parseFloat(e.diameter.value) - u) / 2 * 10) / 10 + '"';
                            var c, h, p, _ = o + "-" + nas + "R" + u;
                            e.rim2.value = u,
                            e.nrim.value = u,
                            cal_viewer("nrim", "met"),
                            setCookie("carwheel", u, 90),
                            setCookie("equal", "yes", 90);
                            var m = u
                        } else {
                            cal_viewer();
                            var _ = o + "-" + d + "R" + v
                              , m = v;
                            setCookie("carwheel", v, 90),
                            setCookie("equal", "no", 90)
                        }
                    }
                    if (o < 90) {
                        if (e.circumference.value = Math.round(3.14 * o * 10) / 10 + '"',
                        e.sidewall.value = Math.round((o - v) / 2 * 10) / 10 + '"',
                        e.revs.value = Math.round(63360 / (3.14 * o)),
                        e.rim2.value = v,
                        g("des") && (g("des").innerHTML = "/"),
                        void 0 == r || -1 != r.search("Calc") ? (e.width2.value = Math.round((parseFloat(e.diameter.value) - v) / 2 * 100 / d),
                        e.diameter2.value = Math.round(25.4 * d),
                        e.diameter.value = o + '"',
                        e.width.value = d + '"') : (e.diameter.value = o,
                        e.width.value = d,
                        e.width2.value = Math.round((parseFloat(e.diameter.value) - v) / 2 * 100 / d),
                        e.diameter2.value = Math.round(25.4 * d)),
                        g("viswidth").innerHTML = e.width.value,
                        g("visheight").innerHTML = e.diameter.value,
                        g("vis_wheel").innerHTML = v + '"',
                        g("vis_side").innerHTML = e.sidewall.value,
                        g("vis_arrow").innerHTML = e.circumference.value,
                        g("vis_revs").innerHTML = e.revs.value + " Revs/Mile",
                        g("eqin").value = parseFloat(e.diameter.value) + "X" + parseFloat(e.width.value) + "R" + v,
                        Eas = Math.round((parseFloat(e.diameter.value) - a) / 2 * 100 / d),
                        g("eqmet").value = Math.round(25.4 * d) + "/" + Eas + "R" + v,
                        "" != l) {
                            g("eqin").value = parseFloat(e.diameter.value) + "X" + parseFloat(e.width.value) + "R" + u,
                            Eas = Math.round((parseFloat(e.diameter.value) - l) / 2 * 100 / d),
                            g("eqmet").value = Math.round(25.4 * d) + "/" + Eas + "R" + u,
                            g("vis_wheel").innerHTML = u + '"',
                            g("vis_side").innerHTML = Math.round((parseFloat(e.diameter.value) - u) / 2 * 10) / 10 + '"';
                            var _ = o + "-" + d + "R" + u;
                            e.rim2.value = u,
                            e.nrim.value = u,
                            cal_viewer("nrim", "in"),
                            setCookie("carwheel", u, 90),
                            setCookie("equal", "yes", 90);
                            var m = u
                        } else {
                            cal_viewer();
                            var _ = o + "-" + d + "R" + v
                              , m = v;
                            setCookie("carwheel", v, 90),
                            setCookie("equal", "no", 90)
                        }
                        _ = _.replace(".5R", ".50R")
                    }
                    var w = Math.round(parseFloat(e.diameter.value))
                      , y = parseFloat(e.diameter.value);
                    parseFloat(e.width.value);
                    var b = w + "-" + m + "-" + y;
                    (w < 30 ? 22 == m ? (c = 20,
                    h = 23,
                    p = 24) : 23 == m ? (c = 22,
                    h = 24,
                    p = 26) : 24 == m ? (c = 20,
                    h = 22,
                    p = 23) : (c = m - 1,
                    h = m + 1,
                    p = m + 2) : 16.5 == m ? (c = 15,
                    h = 16,
                    p = 17) : 15 == m ? (c = 16,
                    h = 17,
                    p = 18) : 16 == m ? (c = 15,
                    h = 17,
                    p = 18) : 17 == m ? (c = 16,
                    h = 18,
                    p = 20) : 18 == m ? (c = 17,
                    h = 20,
                    p = 22) : 19 == m ? (c = 18,
                    h = 20,
                    p = 22) : 20 == m ? (c = 18,
                    h = 22,
                    p = 24) : 21 == m ? (c = 20,
                    h = 22,
                    p = 24) : 22 == m ? (c = 20,
                    h = 24,
                    p = 26) : 23 == m ? (c = 24,
                    h = 26,
                    p = 28) : 24 == m ? (c = 22,
                    h = 26,
                    p = 28) : 26 == m ? (c = 24,
                    h = 28,
                    p = 30) : 28 == m ? (c = 24,
                    h = 26,
                    p = 30) : 30 == m ? (c = 24,
                    h = 26,
                    p = 28) : (c = m - 1,
                    h = m + 1,
                    p = m + 2),
                    g("SizeTabWrap").innerHTML = '<a id="num' + m + '" class="num_unselected" onclick="get_tire_sizes(\'' + w + "-" + m + "-" + y + "','" + w + "','" + m + "');ga('send','event','CalcRimTabs','" + _ + "','" + m + "')\">" + m + '" Wheel</a><a id="num' + c + '" class="num_unselected" onclick="get_tire_sizes(\'' + w + "-" + c + "-" + y + "','" + w + "','" + c + "');ga('send','event','CalcRimTabs','" + _ + "','" + c + "')\">" + c + '"</a><a id="num' + h + '" class="num_unselected" onclick="get_tire_sizes(\'' + w + "-" + h + "-" + y + "','" + w + "','" + h + "');ga('send','event','CalcRimTabs','" + _ + "','" + h + "')\">" + h + '"</a><a id="num' + p + '" class="num_unselected" onclick="get_tire_sizes(\'' + w + "-" + p + "-" + y + "','" + w + "','" + p + "');ga('send','event','CalcRimTabs','" + _ + "','" + p + "')\">" + p + '"</a>',
                    "yes" == s) ? (get_tire_sizes(b, w, m),
                    find_tire_cookies(getCookie("displaytires")),
                    "Comp" != getCookie("Calculator") && ga("send", "event", "CookieUsed", r, _)) : (setCookie("wheel", v, 90),
                    g("cal_wrap").style.cssText = "-webkit-transition:all .5s;transition:all .5s",
                    g("calctab").style.cssText = "-webkit-transition:all .5s;transition:all .5s",
                    g("DisplayTires1").style.cssText = "-webkit-transform:-webkit-translate3d(350px,0,0);transform:translate3d(350px,0,0)",
                    setTimeout(function() {
                        get_tire_sizes(b, w, m)
                    }, 600),
                    find_tire_cookies(_),
                    "ChangeRimEqual" == r ? ga("send", "event", "ChangeRim", _) : ga("send", "event", "CalcUsed", r, _)),
                    setCookie("height", o, 90),
                    setCookie("width", d, 90),
                    setCookie("diameter", Math.round(parseFloat(e.diameter.value)), 90),
                    setCookie("actual", parseFloat(e.diameter.value), 90),
                    "mm" == n && m_convert("mm", "", "calc")
                } else
                    alert("Please fill all fields with numbers only.")
            }
            function compare_tire(e, i, t, a, l, s, r, n, o) {
                getCookie("mconvert"),
                t = (t = (t = (t = (t = t.replace("950", "9.5")).replace("1050", "10.5")).replace("1150", "11.5")).replace("1250", "12.5")).replace("1350", "13.5"),
                s = (s = (s = (s = (s = s.replace("950", "9.5")).replace("1050", "10.5")).replace("1150", "11.5")).replace("1250", "12.5")).replace("1350", "13.5");
                var d = parseFloat(i)
                  , v = parseFloat(t)
                  , u = parseFloat(a)
                  , c = parseFloat(l)
                  , h = parseFloat(s)
                  , p = parseFloat(r);
                if (d > 0 && v > 0 && u > 0 && c > 0 && h > 0 && p > 0) {
                    e.sw.value = d,
                    e.as.value = v,
                    e.rim.value = u,
                    e.swb.value = c,
                    e.asb.value = h,
                    e.rimb.value = p,
                    d > 89 && (e.diameter.value = Math.round((2 * d * v / 2540 + u) * 10) / 10 + '"',
                    e.circumference.value = Math.round((2 * d * v / 2540 + u) * 3.14 * 10) / 10 + '"',
                    e.width.value = Math.round(d / 25.4 * 10) / 10 + '"',
                    e.sidewall.value = Math.round(d * v / 100 / 25.4 * 10) / 10 + '"',
                    e.revs.value = Math.round(63360 / ((2 * d * v / 2540 + u) * 3.14)),
                    g("viswidth1").innerHTML = e.width.value,
                    g("visheight1").innerHTML = e.diameter.value,
                    g("vis_wheel1").innerHTML = u + '"',
                    g("vis_side1").innerHTML = e.sidewall.value,
                    g("vis_arrow1").innerHTML = e.circumference.value,
                    g("vis_revs1").innerHTML = e.revs.value + " Revs/Mile"),
                    d < 90 && (e.diameter.value = d + '"',
                    e.circumference.value = Math.round(3.14 * d * 10) / 10 + '"',
                    e.width.value = v + '"',
                    e.sidewall.value = Math.round((d - u) / 2 * 10) / 10 + '"',
                    e.revs.value = Math.round(63360 / (3.14 * d)),
                    g("viswidth1").innerHTML = e.width.value,
                    g("visheight1").innerHTML = e.diameter.value,
                    g("vis_wheel1").innerHTML = u + '"',
                    g("vis_side1").innerHTML = e.sidewall.value,
                    g("vis_arrow1").innerHTML = e.circumference.value,
                    g("vis_revs1").innerHTML = e.revs.value + " Revs/Mile"),
                    c > 89 && (e.diameterb.value = Math.round((2 * c * h / 2540 + p) * 10) / 10 + '"',
                    e.circumferenceb.value = Math.round((2 * c * h / 2540 + p) * 3.14 * 10) / 10 + '"',
                    e.widthb.value = Math.round(c / 25.4 * 10) / 10 + '"',
                    e.sidewallb.value = Math.round(c * h / 100 / 25.4 * 10) / 10 + '"',
                    e.revsb.value = Math.round(63360 / ((2 * c * h / 2540 + p) * 3.14)),
                    g("viswidth2").innerHTML = e.widthb.value,
                    g("visheight2").innerHTML = e.diameterb.value,
                    g("vis_wheel2").innerHTML = p + '"',
                    g("vis_side2").innerHTML = e.sidewallb.value,
                    g("vis_arrow2").innerHTML = e.circumferenceb.value,
                    g("vis_revs2").innerHTML = e.revsb.value + " Revs/Mile"),
                    c < 90 && (e.diameterb.value = c + '"',
                    e.circumferenceb.value = Math.round(3.14 * c * 10) / 10 + '"',
                    e.widthb.value = h + '"',
                    e.sidewallb.value = Math.round((c - p) / 2 * 10) / 10 + '"',
                    e.revsb.value = Math.round(63360 / (3.14 * c)),
                    g("viswidth2").innerHTML = e.widthb.value,
                    g("visheight2").innerHTML = e.diameterb.value,
                    g("vis_wheel2").innerHTML = p + '"',
                    g("vis_side2").innerHTML = e.sidewallb.value,
                    g("vis_arrow2").innerHTML = e.circumferenceb.value,
                    g("vis_revs2").innerHTML = e.revsb.value + " Revs/Mile"),
                    setCookie("preheight", d, 90),
                    setCookie("prewidth", v, 90),
                    setCookie("prewheel", u, 90),
                    setCookie("compheight", c, 90),
                    setCookie("compwidth", h, 90),
                    setCookie("compwheel", p, 90),
                    setCookie("compdiameter", Math.round(parseFloat(e.diameterb.value)), 90),
                    setCookie("compactual", parseFloat(e.diameterb.value), 90);
                    var _ = parseFloat(e.diameter.value)
                      , m = parseFloat(e.diameterb.value);
                    speed.spd20.value = Math.round(m / _ * 200) / 10,
                    speed.spd30.value = Math.round(m / _ * 300) / 10,
                    speed.spd40.value = Math.round(m / _ * 400) / 10,
                    speed.spd50.value = Math.round(m / _ * 500) / 10,
                    speed.spd60.value = Math.round(m / _ * 600) / 10,
                    speed.spd70.value = Math.round(m / _ * 700) / 10,
                    speed.spd80.value = Math.round(m / _ * 800) / 10,
                    speed.spd90.value = Math.round(m / _ * 900) / 10,
                    (pdia = Math.round((parseFloat(e.diameterb.value) / parseFloat(e.diameter.value) - 1) * 1e3) / 10) > 0 ? e.pdiameterb.value = "+" + pdia + "%" : e.pdiameterb.value = pdia + "%",
                    (pwidth = Math.round((parseFloat(e.widthb.value) / parseFloat(e.width.value) - 1) * 1e3) / 10) > 0 ? e.pwidthb.value = "+" + pwidth + "%" : e.pwidthb.value = pwidth + "%",
                    (pcircumference = pdia) > 0 ? e.pcircumferenceb.value = "+" + pcircumference + "%" : e.pcircumferenceb.value = pcircumference + "%",
                    (psidewall = Math.round((parseFloat(e.sidewallb.value) / parseFloat(e.sidewall.value) - 1) * 1e3) / 10) > 0 ? e.psidewallb.value = "+" + psidewall + "%" : e.psidewallb.value = psidewall + "%",
                    (prevs = e.revsb.value - e.revs.value) > 0 ? e.prevsb.value = "+" + prevs : e.prevsb.value = prevs,
                    parseFloat(e.diameterb.value),
                    parseFloat(e.diameterb.value),
                    parseFloat(e.widthb.value);
                    var w = c + "-" + h + "R" + p;
                    w = w.replace(".5R", ".50R"),
                    "yes" == n ? "Comp" == getCookie("Calculator") && ga("send", "event", "CookieUsed", o, "Compare") : (ga("send", "event", "CalcUsed", o, "Compare"),
                    find_tire_cookies(w)),
                    comp_viewer(),
                    "mm" == getCookie("mconvert") && m_convert("mm", "", "comp")
                } else
                    alert("Please fill all fields with numbers only.")
            }
            var http2 = !1
              , http2 = new XMLHttpRequest
              , http3 = !1
              , http3 = new XMLHttpRequest;
            function find_tire_cookies(e, i) {
                function t() {
                    if (-1 == csi.search(e))
                        var i = 2;
                    else
                        var i = 1;
                    2 == i && "" != csi && void 0 != csi ? (window.matchMedia("(max-width:767px)").matches && choosesize(),
                    g("gotosize").innerHTML = "") : (http3.abort(),
                    http3.open("POST", "{{ url('') }}/peechy-to-dekho/", !0),
                    http3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"),
                    http3.send("api-name=sizes2&url=sizes2/" + e + ".htm"),
                    http3.onreadystatechange = function() {
                        if (4 == http3.readyState) {
                            if (404 === http3.status || 300 === http3.status)
                                window.matchMedia("(max-width:767px)").matches && choosesize(),
                                g("gotosize").innerHTML = "";
                            else {
                                tirepage = http3.responseText,
                                window.matchMedia("(max-width:767px)").matches && choosetire(),
                                getCookie("tiretype"),
                                getCookie("tiretypetext");
                                var i = e;
                                if (tirecalc.sw.value < 90)
                                    var t = i = i.replace("-", "X");
                                else
                                    var t = i.replace("-", "/");
                                g("gotosize").innerHTML = "<a onclick=\"ga('send','event','SeeAllTiresLow',gotosize)\" href=\"/tiresizes/" + i + '.htm">Browse ' + t + " Tires</a>"
                            }
                        }
                    }
                    )
                }
                "slide" == i && window.innerWidth > 767 && slideMenu("goTop", 40),
                "" == csi ? (http2.onreadystatechange = function() {
                    4 == http2.readyState && (csi = http2.responseText,
                    t())
                }
                ,
                http2.open("POST", "{{ url('') }}/peechy-to-dekho/", !0),
                http2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"),
                http2.send("api-name=sizes")) : t(),
                setCookie("displaytires", e, 90)
            }
            function get_tire_sizes(e, i, t) {
                if ("mm" == getCookie("mconvert"))
                    var a = "-mm.htm";
                else
                    var a = ".htm";
                g("DisplayTires1").style.cssText = "-webkit-transform:-webkit-translate3d(0px,0,0);transform:translate3d(0px,0,0)",
                i > 55 || i < 19 || t < 13 || t > 30 ? g("DisplayTires1").innerHTML = '<br><br><div style="text-align:center"><br><b>No Sizes Available<br>Within 3% of Diameter</b></div><br><br>' : (http1.abort(),
                http1.open("POST", "{{ url('') }}/peechy-to-dekho/", !0),
                http1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"),
                http1.send("api-name=sizes3&url=sizes3/" + e + a),
                http1.onreadystatechange = function() {
                    if (4 == http1.readyState) {
                        if (404 === http1.status)
                            g("DisplayTires1").innerHTML = '<table id="SizeTable"><tbody><tr><th>Size</th><th>Diameter</th><th>Width</th><th>Wheel</th></tr></tbody></table></div><br><br><div style="text-align:center"><br><b>No Sizes Available<br>Within 3% of Diameter</b></div><br><br>';
                        else {
                            // console.log(http1);
                            g("DisplayTires1").innerHTML = http1.responseText,
                            Array.from(document.getElementsByClassName("SizeLink")).forEach(function(e) {
                                console.log(document.getElementsByClassName("SizeLink")),
                                e.setAttribute("href", "javascript:void(0);")
                            });
                            var e = g("SizeTable").getElementsByTagName("tr");
                            if ("mm" == getCookie("mconvert"))
                                for (var i = 1; i < e.length; i++) {
                                    var t = parseFloat(e[i].childNodes[2].innerHTML)
                                      , a = e[i].childNodes[1].className
                                      , l = parseFloat(tirecalc.width.value);
                                    t < l + 3 && t > l - 3 && "diaon" == a ? (e[i].childNodes[2].className = "diaon",
                                    e[i].childNodes[0].className = "diaon bold") : t < l + 11 && t > l - 11 && "diaon" == a ? (e[i].childNodes[2].className = "diaon",
                                    e[i].childNodes[0].className = "diaon") : t < l + 11 && t > l - 11 && (e[i].childNodes[2].className = "diaover",
                                    e[i].childNodes[0].className = "diaover")
                                }
                            else
                                for (var i = 1; i < e.length; i++) {
                                    var t = parseFloat(e[i].childNodes[2].innerHTML)
                                      , a = e[i].childNodes[1].className
                                      , l = 10 * parseFloat(tirecalc.width.value);
                                    t < (l + 2) / 10 && t > (l - 2) / 10 && "diaon" == a ? (e[i].childNodes[2].className = "diaon",
                                    e[i].childNodes[0].className = "diaon bold") : t < (l + 5) / 10 && t > (l - 5) / 10 && "diaon" == a ? (e[i].childNodes[2].className = "diaon",
                                    e[i].childNodes[0].className = "diaon") : t < (l + 5) / 10 && t > (l - 5) / 10 && (e[i].childNodes[2].className = "diaover",
                                    e[i].childNodes[0].className = "diaover")
                                }
                        }
                    }
                }
                );
                for (var l = g("SizeTabWrap").getElementsByTagName("a"), s = 0; s < l.length; s++)
                    l[s].className = "num_unselected";
                g("num" + t).className = "num_selected"
            }
            function sortType(e, i, t, a) {
                if (void 0 !== i) {
                    if (15 == e)
                        setCookie("ShowFilters", a, 1),
                        window.location.href = g("getAll").getAttribute("href");
                    else {
                        var l = ""
                          , s = i.replace(/ \(.*\)/i, "");
                        "cookie" == t && (t = http3.responseText,
                        setCookie("tiretype", e, 90),
                        setCookie("tiretypetext", i, 90)),
                        -1 == t.search(">" + s + "<") ? "Filter Tire Results" == s || "All Tire Types" == s ? (e = 14,
                        l = "") : (e = 14,
                        l = '<div id="typealert" class="red">No "' + s + '" Tires - Filter Removed</div>',
                        setCookie("tiretype", e, 90),
                        setCookie("tiretypetext", "Remove Filters", 90)) : l = "Filter Tire Results" == s || "Remove Filters" == s || "All Tire Types" == s ? "" : '<div id="typealert">"' + s + '" Filter ON</div>';
                        var r = []
                          , n = 1;
                        if (14 == e)
                            for (t = t.split("<!--split-->"); void 0 !== t[n]; )
                                -1 == t[n].search("SeeAllTires") && (r[n] = t[n]),
                                n++;
                        else
                            for (t = t.split("<!--split-->"); void 0 !== t[n]; )
                                -1 !== t[n].search(">" + s + "<") && (r[n] = t[n]),
                                n++;
                        t[n -= 1],
                        r = r.join("<!--split-->"),
                        g("typefilter").blur(),
                        g("typefilter").value = e,
                        g("alertwrap").innerHTML = l;
                        var o = parseInt(g("typefilter").options[g("typefilter").selectedIndex].text.match(/\d+/i));
                        o = (o + 1) * 180,
                        g("scroll").style.width = o + "px"
                    }
                }
            }
            function changeRim() {
                g("tab1") && (tab3(),
                tirecalc.nrim.value = g("changeRim").value),
                calculate_tire(tirecalc, tirecalc.sw.value, tirecalc.as.value, tirecalc.rim.value, g("changeRim").value, "", "ChangeRim")
            }
            function choosetire() {
                g("resultstab").style.display = "none"
            }
            function choosesize() {
                g("resultstab").style.display = "block"
            }
            function showVisual() {
                g("cal_viewer").style.display = "block",
                g("cal_visualizer").style.height = "300px",
                g("show_tires").setAttribute("onclick", "hideVisual()"),
                g("spin").style.transform = "rotateX(180deg)"
            }
            function hideVisual() {
                g("cal_viewer").style.display = "none",
                g("cal_visualizer").style.height = "40px",
                g("show_tires").setAttribute("onclick", "showVisual()"),
                g("spin").style.transform = "rotateX(0deg)"
            }
            function showCompVisual() {
                g("Viewer").style.display = "block",
                g("ShowCompTires").setAttribute("onclick", "hideCompVisual()"),
                g("spin2").style.transform = "rotateX(180deg)"
            }
            function hideCompVisual() {
                g("Viewer").style.display = "none",
                g("ShowCompTires").setAttribute("onclick", "showCompVisual()"),
                g("spin2").style.transform = "rotateX(0deg)"
            }
            var tabCookie = getCookie("tabsize1");
            void 0 == tabCookie && (tabCookie = 0);
            var tabCookie2 = getCookie("tabsize2");
            function cal_viewer(e, i) {
                var t = parseFloat(tirecalc.sw.value)
                  , a = parseFloat(tirecalc.as.value)
                  , l = parseFloat(tirecalc.rim.value);
                if (parseFloat(tirecalc.diameter.value),
                "nrim" == e) {
                    var l = parseFloat(tirecalc.nrim.value);
                    "met" == i && (a = Math.round((parseFloat(tirecalc.diameter.value) - l) / 2 * 2540 / t))
                }
                if (document.all && !window.atob)
                    var s = .5
                      , r = 185;
                else if (window.matchMedia("(max-width:767px)").matches)
                    var s = .42
                      , r = 155;
                else
                    var s = .5
                      , r = 185;
                if (t > 89)
                    var n = Math.round(t * a / 100 / 25.4 * 2 + l);
                else
                    var n = t;
                if (t > 89)
                    var o = Math.round((t * a / 100 / 25.4 * 2 + l) * 10 * s);
                else
                    var o = 10 * t * s;
                var d = r / o
                  , v = r;
                if (t > 89)
                    var u = Math.round(t / 25.4 * 10 * s * d);
                else
                    var u = Math.round(10 * a * s * d);
                if (isNaN(o) || a < 6 || t > 44 && t < 90 || t < 45 && a > 16 || t < 21 || t > 89 && a < 25 || l > 28 || l < 10 || t - l < 5 || n - l < 5 || t > 375 || t > 89 && a > 95 || n > 44 && n < 90 || o + u > 305)
                    g("cc").innerHTML = '<div style="position:absolute;top:45%;left:35%;font-size:8px;text-align:center">Image Not<br>Available<div id="vis_arrow"></div></div>',
                    g("tctc").innerHTML = '<div style="position:absolute;top:45%;left:5%;font-size:8px;text-align:center">Image Not<br>Available</div>',
                    g("tt_height").style.display = "none",
                    g("tt_width").style.display = "none",
                    g("t_side").style.display = "none",
                    g("t_wheel").style.display = "none",
                    g("vis_revs").style.display = "none";
                else {
                    -1 !== g("cc").innerHTML.search("Image Not") && (g("cc").innerHTML = '<div id="tt"><img src="{{ url('') }}/images/tire_without_rim.jpg" alt="Tire Side View"><div id="ww"><img src="{{ url('') }}/images/tire_rim.png" alt="Wheel Side View"></div></div><div id="aa"><img src="{{ url('') }}/images/arrow_angle.png" alt=" Arrow Angle of Tire"><div id="vis_arrow"></div></div>',
                    g("tctc").innerHTML = '<img src="{{ url('') }}/images/tire_front.jpg" alt="Tire Front View"></div>',
                    g("vis_arrow").innerHTML = tirecalc.circumference.value),
                    g("ww").innerHTML = '<img src="{{ url('') }}/images/tire_rim.png" alt="Wheel Side View">',
                    g("tt_height").style.display = "block",
                    g("tt_width").style.display = "block",
                    g("t_side").style.display = "block",
                    g("t_wheel").style.display = "block",
                    g("vis_revs").style.display = "block";
                    var c = Math.round(l / 17 * 370 * s)
                      , h = Math.round(-(((c = Math.round(c * d)) - v) / 2 * 1))
                      , p = Math.round((o - l * s * 10) / 2);
                    g("cc").style.width = v + "px",
                    g("cc").style.height = v + "px",
                    g("tt").style.width = v + "px",
                    g("tt").style.height = v + "px",
                    g("tt").style.borderRadius = Math.round(v / 2) + 50 + "px",
                    g("aa").style.width = "260px",
                    g("aa").style.height = "260px",
                    g("aa").style.border = "40px solid black",
                    g("aa").style.left = "-40px",
                    g("aa").style.top = "-40px",
                    g("ww").style.width = c + "px",
                    g("ww").style.height = c + "px",
                    g("ww").style.top = h + "px",
                    g("ww").style.left = h + "px",
                    g("tctc").style.width = u + "px",
                    g("tctc").style.height = v + "px",
                    g("visheight").style.cssText = "margin-top:" + (Math.round(v / 2) - 15) + "px",
                    g("vis_side").style.cssText = "margin-top:" + Math.round(p * d / 2) + "px",
                    g("t_side").style.height = p * d - 1 + "px",
                    g("t_side").style.width = Math.round(v / 2) - 10 + "px",
                    g("t_wheel").style.width = Math.round(l * s * 10) * d - 1 + "px",
                    g("t_wheel").style.right = p * d + "px",
                    g("t_wheel").style.height = Math.round(v / 2) + "px"
                }
            }
            function comp_viewer() {
                var e = parseFloat(tirecompare.sw.value)
                  , i = parseFloat(tirecompare.as.value)
                  , t = parseFloat(tirecompare.rim.value)
                  , a = parseFloat(tirecompare.diameter.value);
                if ("" != tirecompare.diameterb.value)
                    var l = parseFloat(tirecompare.diameterb.value);
                else
                    var l = 0;
                if (a >= l) {
                    if (document.all && !window.atob)
                        var s = .5
                          , r = 185
                          , n = Math.round(r / (10 * a) * 1e3) / 1e3;
                    else if (window.matchMedia("(max-width:767px)").matches)
                        var s = .42
                          , r = 155
                          , n = Math.round(r / (10 * a) * 1e3) / 1e3;
                    else
                        var s = .5
                          , r = 185
                          , n = Math.round(r / (10 * a) * 1e3) / 1e3
                } else if (document.all && !window.atob)
                    var n = .5
                      , r = 185
                      , s = Math.round(r / (10 * l) * 1e3) / 1e3;
                else if (window.matchMedia("(max-width:767px)").matches)
                    var n = .42
                      , r = 155
                      , s = Math.round(r / (10 * l) * 1e3) / 1e3;
                else
                    var n = .5
                      , r = 185
                      , s = Math.round(r / (10 * l) * 1e3) / 1e3;
                if (e > 89)
                    var o = Math.round(e * i / 100 / 25.4 * 2 + t);
                else
                    var o = e;
                if (e > 89)
                    var d = Math.round((e * i / 100 / 25.4 * 2 + t) * 10 * s);
                else
                    var d = 10 * e * s;
                if (a >= l)
                    var v = r / d
                      , u = r;
                else
                    var v = r / r
                      , u = d;
                if (e > 89)
                    var c = Math.round(e / 25.4 * 10 * s * v);
                else
                    var c = Math.round(10 * i * s * v);
                if (isNaN(d) || i < 6 || e > 44 && e < 90 || e < 45 && i > 16 || e < 21 || e > 89 && i < 25 || t > 28 || t < 10 || e - t < 5 || o - t < 5 || e > 375 || e > 89 && i > 95 || o > 44 && o < 90 || d + c > 305)
                    g("c1").innerHTML = '<div style="position:absolute;top:45%;left:35%;font-size:8px;text-align:center">Image Not<br>Available<div id="vis_arrow1"></div></div>',
                    g("tc1").innerHTML = '<div style="position:absolute;top:45%;left:5%;font-size:8px;text-align:center">Image Not<br>Available</div>',
                    g("tt_height1").style.display = "none",
                    g("tt_width1").style.display = "none",
                    g("t_side1").style.display = "none",
                    g("t_wheel1").style.display = "none",
                    g("t_wheel1").style.display = "none",
                    g("vis_revs1").style.display = "none";
                else {
                    -1 !== g("c1").innerHTML.search("Image Not") && (g("c1").innerHTML = '<div id="t1"><img src="{{ url('') }}/images/tire_without_rim.jpg" alt="Tire 1 Side View"><div id="w1"><img src="{{ url('') }}/images/tire_rim.png" alt="Tire 1 Wheel"></div></div><div id="a1"><img src="{{ url('') }}/images/arrow_angle1.png" alt="Arrow Tire Image"><div id="vis_arrow1"></div></div>',
                    g("tc1").innerHTML = '<img src="{{ url('') }}/images/tire_front1.jpg" alt="Tire 1 Front View">',
                    g("vis_arrow1").innerHTML = tirecompare.circumference.value),
                    g("w1").innerHTML = '<img src="{{ url('') }}/images/tire_rim.png" alt="Tire 1 Wheel">',
                    g("tt_height1").style.display = "block",
                    g("tt_width1").style.display = "block",
                    g("t_side1").style.display = "block",
                    g("t_wheel1").style.display = "block",
                    g("t_wheel1").style.display = "block",
                    g("vis_revs1").style.display = "block";
                    var h = Math.round(t / 17 * 370 * s)
                      , p = Math.round(-(((h = Math.round(h * v)) - u) / 2 * 1))
                      , _ = Math.round((d - t * s * 10) / 2);
                    g("c1").style.width = u + "px",
                    g("c1").style.height = u + "px",
                    g("t1").style.width = u + "px",
                    g("t1").style.height = u + "px",
                    g("t1").style.borderRadius = Math.round(u / 2) + "px",
                    g("a1").style.width = "260px",
                    g("a1").style.height = "260px",
                    g("a1").style.border = "40px solid #f0f0f0",
                    g("a1").style.left = "-40px",
                    g("a1").style.top = "-40px",
                    g("w1").style.width = h + "px",
                    g("w1").style.height = h + "px",
                    g("w1").style.top = p + "px",
                    g("w1").style.left = p + "px",
                    g("tc1").style.width = c + "px",
                    g("tc1").style.height = u + "px",
                    g("visheight1").style.cssText = "margin-top:" + (Math.round(u / 2) - 15) + "px",
                    g("vis_side1").style.cssText = "margin-top:" + Math.round(_ * v / 2) + "px",
                    g("t_side1").style.height = _ * v - 1 + "px",
                    g("t_side1").style.width = Math.round(u / 2) - 10 + "px",
                    g("t_wheel1").style.width = Math.round(t * s * 10) * v - 1 + "px",
                    g("t_wheel1").style.right = _ * v + "px",
                    g("t_wheel1").style.height = Math.round(u / 2) + "px"
                }
                var m = parseFloat(tirecompare.swb.value)
                  , w = parseFloat(tirecompare.asb.value)
                  , y = parseFloat(tirecompare.rimb.value);
                if (m > 89)
                    var b = Math.round(m * w / 100 / 25.4 * 2 + y);
                else
                    var b = m;
                if (m.toString(),
                w.toString(),
                y.toString(),
                m > 89)
                    var f = Math.round((m * w / 100 / 25.4 * 2 + y) * 10 * n);
                else
                    var f = 10 * m * n;
                if (a >= l)
                    var T = r / r
                      , x = f;
                else
                    var T = r / f
                      , x = r;
                if (m > 89)
                    var k = Math.round(m / 25.4 * 10 * n * T);
                else
                    var k = Math.round(10 * w * n * T);
                if (isNaN(f) || w < 6 || m > 44 && m < 90 || m < 45 && w > 16 || m < 21 || m > 89 && w < 25 || y > 28 || y < 10 || m - y < 5 || b - y < 5 || m > 375 || m > 89 && w > 95 || b > 44 && b < 90 || f + k > 305)
                    g("c2").innerHTML = '<div style="position:absolute;top:45%;left:35%;font-size:8px;text-align:center">Image Not<br>Available<div id="vis_arrow2"></div></div>',
                    g("tc2").innerHTML = '<div style="position:absolute;top:45%;left:5%;font-size:8px;text-align:center">Image Not<br>Available</div>',
                    g("tt_height2").style.display = "none",
                    g("tt_width2").style.display = "none",
                    g("t_side2").style.display = "none",
                    g("t_wheel2").style.display = "none",
                    g("t_wheel2").style.display = "none",
                    g("vis_revs2").style.display = "none";
                else {
                    -1 !== g("c2").innerHTML.search("Image Not") && (g("c2").innerHTML = '<div id="t2"><img src="{{ url('') }}/images/tire_without_rim.jpg" alt="Tire 2 Side View"><div id="w2"><img src="{{ url('') }}/images/tire_rim.png" alt="Tire 2 Wheel"></div></div><div id="a2"><img src="{{ url('') }}/images/arrow_angle2.jpg" alt=""><div id="vis_arrow2"></div></div>',
                    g("tc2").innerHTML = '<img src="{{ url('') }}/images/tire_front2.jpg" alt="Tire 2 Front View">',
                    g("vis_arrow2").innerHTML = tirecompare.circumferenceb.value),
                    g("w2").innerHTML = '<img src="{{ url('') }}/images/tire_rim.png" alt="Tire 2 Wheel">',
                    g("tt_height2").style.display = "block",
                    g("tt_width2").style.display = "block",
                    g("t_side2").style.display = "block",
                    g("t_wheel2").style.display = "block",
                    g("t_wheel2").style.display = "block",
                    g("vis_revs2").style.display = "block";
                    var M = Math.round(y / 17 * 370 * n)
                      , H = Math.round(-(((M = Math.round(M * T)) - x) / 2 * 1))
                      , L = Math.round((f - y * n * 10) / 2);
                    g("c2").style.width = x + "px",
                    g("c2").style.height = x + "px",
                    g("t2").style.width = x + "px",
                    g("t2").style.height = x + "px",
                    g("t2").style.borderRadius = Math.round(x / 2) + "px",
                    g("a2").style.width = "260px",
                    g("a2").style.height = "260px",
                    g("a2").style.border = "40px solid #f0f0f0",
                    g("a2").style.left = "-40px",
                    g("a2").style.top = "-40px",
                    g("w2").style.width = M + "px",
                    g("w2").style.height = M + "px",
                    g("w2").style.top = H + "px",
                    g("w2").style.left = H + "px",
                    g("tc2").style.width = k + "px",
                    g("tc2").style.height = x + "px",
                    g("visheight2").style.cssText = "margin-top:" + (Math.round(x / 2) - 15) + "px",
                    g("vis_side2").style.cssText = "margin-top:" + Math.round(L * T / 2) + "px",
                    g("t_side2").style.height = Math.round(L * T - 1) + "px",
                    g("t_side2").style.width = Math.round(x / 2) - 10 + "px",
                    g("t_wheel2").style.width = Math.round(Math.round(y * n * 10) * T - 1) + "px",
                    g("t_wheel2").style.right = Math.round(L * T) + "px",
                    g("t_wheel2").style.height = Math.round(x / 2) + "px"
                }
            }
            function m_convert(e, i, t) {
                var a = tirecalc
                  , l = tirecompare
                  , s = parseFloat(g("vis_wheel").innerHTML);
                if ("mm" == e) {
                    if (g("mconvert").setAttribute("onclick", "m_convert('in','','')"),
                    g("slid").style.left = "40px",
                    g("slid").style.width = "38px",
                    setCookie("mconvert", "mm", 90),
                    "" != a.sw.value && a.diameter.value.search('"') > -1) {
                        if ("flip" == i) {
                            var r = Math.round(parseFloat(a.diameter.value))
                              , n = parseFloat(a.diameter.value);
                            parseFloat(a.width.value),
                            get_tire_sizes(r + "-" + s + "-" + n, r, s)
                        }
                        var o = Math.round(25.4 * parseFloat(a.diameter.value));
                        if (a.sw.value > 89)
                            var d = a.sw.value;
                        else
                            var d = Math.round(25.4 * parseFloat(a.width.value));
                        var v = Math.round(25.4 * parseFloat(a.sidewall.value))
                          , u = Math.round(25.4 * parseFloat(a.circumference.value))
                          , c = Math.round(.621371 * parseFloat(a.revs.value));
                        a.diameter.value = o,
                        a.width.value = d,
                        a.sidewall.value = v,
                        a.circumference.value = u,
                        a.revs.value = c,
                        g("rev1").innerHTML = "<strong>Revs/km</strong>",
                        g("vis_revs").innerHTML = c + " Revs/km",
                        g("visheight").innerHTML = o,
                        g("viswidth").innerHTML = a.sw.value,
                        g("vis_side").innerHTML = v,
                        g("vis_arrow").innerHTML = u
                    }
                    if ("" != l.sw.value && "" != l.swb.value && l.diameter.value.search('"') > -1) {
                        var h = Math.round(25.4 * parseFloat(l.diameter.value));
                        if (l.sw.value > 89)
                            var p = l.sw.value;
                        else
                            var p = Math.round(25.4 * parseFloat(l.width.value));
                        var _ = Math.round(25.4 * parseFloat(l.sidewall.value))
                          , m = Math.round(25.4 * parseFloat(l.circumference.value))
                          , w = Math.round(.621371 * parseFloat(l.revs.value))
                          , y = Math.round(25.4 * parseFloat(l.diameterb.value));
                        if (l.swb.value > 89)
                            var b = l.swb.value;
                        else
                            var b = Math.round(25.4 * parseFloat(l.widthb.value));
                        var f = Math.round(25.4 * parseFloat(l.sidewallb.value))
                          , T = Math.round(25.4 * parseFloat(l.circumferenceb.value))
                          , x = Math.round(.621371 * parseFloat(l.revsb.value));
                        l.diameter.value = h,
                        l.width.value = p,
                        l.sidewall.value = _,
                        l.circumference.value = m,
                        l.revs.value = w,
                        l.diameterb.value = y,
                        l.widthb.value = b,
                        l.sidewallb.value = f,
                        l.circumferenceb.value = T,
                        l.revsb.value = x,
                        l.prevsb.value = x - w,
                        g("rev2").innerHTML = "<strong>Revs/km</strong>",
                        g("vis_revs1").innerHTML = w + " Revs/km",
                        g("vis_revs2").innerHTML = x + " Revs/km",
                        g("visheight1").innerHTML = h,
                        g("viswidth1").innerHTML = p,
                        g("vis_side1").innerHTML = _,
                        g("vis_arrow1").innerHTML = m,
                        g("visheight2").innerHTML = y,
                        g("viswidth2").innerHTML = b,
                        g("vis_side2").innerHTML = f,
                        g("vis_arrow2").innerHTML = T,
                        g("reading").innerHTML = "<b>Speed</b><a>10 km/h</a><a>30 km/h</a><a>50 km/h</a><a>70 km/h</a><a>90 km/h</a><a>110 km/h</a><a>130 km/h</a><a>150 km/h</a>",
                        speed.spd20.value = Math.round(y / h * 100) / 10,
                        speed.spd30.value = Math.round(y / h * 300) / 10,
                        speed.spd40.value = Math.round(y / h * 500) / 10,
                        speed.spd50.value = Math.round(y / h * 700) / 10,
                        speed.spd60.value = Math.round(y / h * 900) / 10,
                        speed.spd70.value = Math.round(y / h * 1100) / 10,
                        speed.spd80.value = Math.round(y / h * 1300) / 10,
                        speed.spd90.value = Math.round(y / h * 1500) / 10
                    }
                } else
                    "in" == e && (g("mconvert").setAttribute("onclick", "m_convert('mm','flip','')"),
                    g("slid").style.left = "0",
                    g("slid").style.width = "45px",
                    setCookie("mconvert", "in", 90),
                    "" != a.sw.value && ("calc" == t || "" == t) && calculate_tire(tirecalc, tirecalc.sw.value, tirecalc.as.value, tirecalc.rim.value, tirecalc.nrim.value, "", "TireSizeCalc"),
                    "" != l.sw.value && "" != l.swb.value && ("comp" == t || "" == t) && compare_tire(tirecompare, tirecompare.sw.value, tirecompare.as.value, tirecompare.rim.value, tirecompare.swb.value, tirecompare.asb.value, tirecompare.rimb.value, "", "TireSizeCalc"),
                    g("rev1").innerHTML = "<strong>Revs/Mile</strong>",
                    g("rev2").innerHTML = "<strong>Revs/Mile</strong>",
                    g("vis_revs").innerHTML = g("vis_revs").innerHTML.replace("Revs/km", "Revs/Mile"),
                    g("vis_revs1").innerHTML = g("vis_revs1").innerHTML.replace("Revs/km", "Revs/Mile"),
                    g("vis_revs2").innerHTML = g("vis_revs2").innerHTML.replace("Revs/km", "Revs/Mile"),
                    g("reading").innerHTML = "<b>Speed</b><a>20 mph</a><a>30 mph</a><a>40 mph</a><a>50 mph</a><a>60 mph</a><a>70 mph</a><a>80 mph</a><a>90 mph</a>")
            }
            function change_tab(e) {
                $(".tiretab").removeClass("tagsUnit"),
                $(e).addClass("tagsUnit")
            }
            function show() {
                var e, i = g("SizeTable").getElementsByTagName("tr");
                for (e = 0; e < i.length; e++)
                    i[e].style.display = "table-row"
            }
            function scroll_to_result() {
                $("html, body").animate({
                    scrollTop: $(".result_area").offset().top
                })
            }
            function scroll_to_result1() {
                $("html, body").animate({
                    scrollTop: $(".result_area1").offset().top
                })
            }
            void 0 == tabCookie2 && (tabCookie2 = 0);

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-71543033-1', 'auto');
            ga('send', 'pageview');
        </script>
    @endpush
</div>

{{-- </form> --}}