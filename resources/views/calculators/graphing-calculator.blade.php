<style>
    .width_20_per {
        width: 20%;
        float: left;
        padding: 3px;
        font-weight: 400;
        text-align: center;
        font-size: 20px;
        cursor: pointer;
    }

    .width_20_per span {
        display: block;
        height: 40px;
        background: #e6e6e6;
        line-height: 40px;
        color: #000;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .blue_btn {
        background: #2845F5 !important;
        color: #000 !important;
    }

    .grey_color {
        background: #cdd2d4 !important;
    }

    #wrapper {
        height: 100%;
        overflow: hidden;
    }

    #toolbar {
        position: absolute;
        left: 5px;
        top: 5px;
        width: 36px;
        background: #EDEDED;
        z-index: 10;
    }

    #tool_select img {
        border: 1px solid transparent;
        opacity: 0.5;
        border-radius: 5px;
    }

    #tool_select img:hover {
        opacity: 1.0;
    }

    #tool_select a.toolbar_selected img {
        border: 1px solid #CCC;
        opacity: 1.0 !important;
        background: #FFF;
        -webkit-box-shadow: inset 0px -900px 50px -900px rgba(150, 150, 150, 0.3), inset 0px 1px 0px 0px #FFF;
        box-shadow: inset 0px -900px 40px -900px rgba(150, 150, 150, 0.3), inset 0px 1px 0px 0px #FFF;
    }

    #sidewrapper {
        width: 350px;
        z-index: 5;
        background: #F6F6F6;
    }

    #graph_sidebar {
        margin: 5px 10px;
    }

    #hideSidebar,
    #showSidebar {
        z-index: 11;
        font-size: 15pt;
        font-weight: bold;
        width: 36px;
        background: #F7F7F7;
    }

    #showSidebar {
        display: none;
    }

    #hideSidebar {
        display: inline;
    }

    #showSidebar a,
    #hideSidebar a {
        color: #666;
        text-decoration: none;
        display: block;
        padding-top: 0px;
        text-align: left;
        padding-right: 13px;
        float: left;
        padding-left: 13px;
    }

    #showSidebar a {
        text-align: left;
        padding-left: 13px;
    }

    .graph_input_wrapper {
        margin-bottom: 5px;
        padding: 4px 6px;
        margin: 1px 0px;
        font-family: "Droid Serif", "Georgia", serif;
        font-size: 12pt;
    }

    .active_equation {
        background: #F0F0F0;
        padding: 10px 5px;
        border: 1px solid #CCC;
        border-radius: 5px;
        text-shadow: 1px 1px 0px #FAFAFA;
        -webkit-box-shadow: inset 0px -900px 50px -900px rgba(150, 150, 150, 0.3), inset 0px 1px 0px 0px #FFF;
        box-shadow: inset 0px -900px 40px -900px rgba(150, 150, 150, 0.3), inset 0px 1px 0px 0px #FFF;
    }

    .graph_equation_display span {
        padding-right: 5px;
    }

    .graph_color_indicator {
        height: 22px;
        width: 22px;
        border: 1px solid #BBB;
        float: right;
        margin-top: 3.5px
    }

    #graph_inputs input {
        height: 30px;
        background: var(--white);
        padding-left: 10px;
        border: 1px solid #D2D4D8;
        border-radius: 10px;
        color: var(--black);
        font-size: 15px;
        box-sizing: border-box;
        width: 70%;
        outline: 0;
    }

    #settings_button {
        padding: 5px 6px;
        height: 16px;
        vertical-align: bottom;
    }

    #settings_button img {
        height: 100%;
        opacity: 0.5;
    }

    #settings {
        display: none;
        margin: 10px 0px;
        overflow: visible !important
    }

    #graph_wrapper {
        position: relative;
        top: 0px;
        left: 0px;
        height: 100%;
        width: 100%;
        z-index: 2;
    }

    #graph_wrapper:hover {
        cursor: crosshair;
    }

    #graph_wrapper:active {
        cursor: move;
    }

    #graph {
        width: 100%;
        height: 100%;
    }

    .option {
        color: #0082b1;
        border: 1px solid #BBB;
        background: #fff;
        border-radius: 5px;
        padding: 5px 10px;
        display: inline-block;
    }

    .option_selected {
        font-weight: bold;
        color: #fff;
        background: #0082b1;
        border: 1px solid #ddd;
    }

    textarea {
        border: 1px dashed #56ADFF;
        outline: none;
        resize: none;
        overflow: hidden;
        white-space: nowrap;
        font-family: 'times new roman', georgia, serif;
        font-size: 14pt;
        min-width: 1em;
        height: 1em;
        padding: 0.2em
    }

    textarea:focus {
        border: 1px solid #56ADFF;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    /* .hidden {
        display: none;
    } */

    @media(max-width: 480px) {
        #graph_wrapper {
            width: 100%;
        }

        #sidewrapper {
            width: 100%;
        }
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[100%] md:w-[100%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div id="sidewrapper" class="left col-span-12 md:col-span-6 lg:col-span-6">
                    <div id="graph_sidebar">
                        <div id="graph_inputs">

                        </div>
                        <br />
                        <div id="buttonbar" class="flex items-center">
                            <a class="bg-[#2845F5] text-white d-inline-flex  rounded px-3 py-2 me-1"
                                href="javascript:void(0)" onclick="jsgui.evaluate()"><?= $lang['submit'] ?></a>
                            <a class="bg-[#2845F5] text-white d-inline-flex  rounded px-3 py-2 me-1"
                                href="javascript:void(0)" onclick="jsgui.addInput()"><img
                                    src="<?= url('images/plus.png') ?>" alt="plus" width="20px"
                                    height="20px"></a>
                            <a class="bg-[#2845F5] text-white d-inline-flex  rounded px-3 py-2"
                                href="javascript:void(0)" onclick="$('#settings').toggle(400)"><img
                                    src="<?= url('images/setting.png') ?>" alt="setting" width="20px"
                                    height="20px"></a>
                        </div>

                        <div id="settings">
                            <div id="angle_select" class="options_list">
                                <p class="font_size16 padding_5"><strong>Unit:</strong></p>
                                <a href="javascript:void(0)" onclick="jsgui.setAngles('degrees')"
                                    id="angle_select_degrees" class="option">DEG</a>
                                <a href="javascript:void(0)" onclick="jsgui.setAngles('radians')"
                                    id="angle_select_radians" class="option option_selected">RAD</a>
                                <a href="javascript:void(0)" onclick="jsgui.setAngles('gradians')"
                                    id="angle_select_gradians" class="option">GRAD</a>
                            </div>

                            <div id="gridlines_select" class="options_list">
                                <p class="font_size16 padding_5"><strong>Gridlines:</strong></p>
                                <a href="javascript:void(0)" onclick="jsgui.setGridlines('normal')"
                                    id="gridlines_select_normal" class="option option_selected">NORMAL</a>
                                <a href="javascript:void(0)" onclick="jsgui.setGridlines('less')"
                                    id="gridlines_select_less" class="option">LESS</a>
                                <a href="javascript:void(0)" onclick="jsgui.setGridlines('off')"
                                    id="gridlines_select_off" class="option">OFF</a>
                            </div>

                            <div id="quality_select" class="options_list">
                                <p class="font_size16 padding_5"><strong>Precision:</strong></p>
                                <a href="javascript:void(0)" onclick="jsgui.setQuality(0.1)" id="quality_select_01"
                                    class="option">LOW</a>
                                <a href="javascript:void(0)" onclick="jsgui.setQuality(0.5)" id="quality_select_05"
                                    class="option">MED</a>
                                <a href="javascript:void(0)" onclick="jsgui.setQuality(1)" id="quality_select_1"
                                    class="option option_selected">HIGH</a>
                                <a href="javascript:void(0)" onclick="jsgui.setQuality(5)" id="quality_select_5"
                                    class="option">ULTRA</a>
                            </div>
                        </div>

                    </div>
                    <div class="col s12 padding_0">
                        <!-- next line -->
                        <div class="width_20_per"><span></span></div>
                        <div class="width_20_per"><span value="x^2">x<sup>2</sup></span></div>
                        <div class="width_20_per"><span value="y^2">y<sup>2</sup></span></div>
                        <div class="width_20_per"><span value="del" class="grey_color"><img
                                    src="<?= url('images/delete.png') ?>" style="margin-top: 7px;    margin-left: 17px;"
                                    alt="del"></span></div>
                        <div class="width_20_per"><span value="clear" class="grey_color">AC</span></div>
                        <!-- next line -->
                        <div class="width_20_per"><span value="7" class="blue_btn">7</span></div>
                        <div class="width_20_per"><span value="8" class="blue_btn">8</span></div>
                        <div class="width_20_per"><span value="9" class="blue_btn">9</span></div>
                        <div class="width_20_per"><span value="+">+</span></div>
                        <div class="width_20_per"><span value="abs(">abs</span></div>
                        <!-- next line -->
                        <div class="width_20_per"><span value="4" class="blue_btn">4</span></div>
                        <div class="width_20_per"><span value="5" class="blue_btn">5</span></div>
                        <div class="width_20_per"><span value="6" class="blue_btn">6</span></div>
                        <div class="width_20_per"><span value="-">-</span></div>
                        <div class="width_20_per"><span value="log(">log</span></div>
                        <!-- next line -->
                        <div class="width_20_per"><span value="1" class="blue_btn">1</span></div>
                        <div class="width_20_per"><span value="2" class="blue_btn">2</span></div>
                        <div class="width_20_per"><span value="3" class="blue_btn">3</span></div>
                        <div class="width_20_per"><span value="*">x</span></div>
                        <div class="width_20_per"><span value="log10(">log<sub>10</sub></span></div>
                        <!-- next line -->
                        <div class="width_20_per"><span value="0" class="blue_btn">0</span></div>
                        <div class="width_20_per"><span value="00" class="blue_btn">00</span></div>
                        <div class="width_20_per"><span value="." class="blue_btn">.</span></div>
                        <div class="width_20_per"><span value="/">÷</span></div>
                        <div class="width_20_per"><span value="3.14159265">π</span></div>
                        <!-- next line -->
                        <div class="width_20_per"><span value="sin(">sin</span></div>
                        <div class="width_20_per"><span value="cos(">cos</span></div>
                        <div class="width_20_per"><span value="tan(">tan</span></div>
                        <div class="width_20_per"><span value="(">(</span></div>
                        <div class="width_20_per"><span value=")">)</span></div>
                        <!-- next line -->
                        <div class="width_20_per"><span value="csc(">csc</span></div>
                        <div class="width_20_per"><span value="sec(">sec</span></div>
                        <div class="width_20_per"><span value="cot(">cot</span></div>
                        <div class="width_20_per"><span value="^">x<sup>y</sup></span></div>
                        <div class="width_20_per"><span value="sqrt(">√</span></div>
                        <!-- next line -->
                        <div class="width_20_per"><span value="asin(">sin<sup>-1</sup></span></div>
                        <div class="width_20_per"><span value="acos(">cos<sup>-1</sup></span></div>
                        <div class="width_20_per"><span value="atan(">tan<sup>-1</sup></span></div>
                        <div class="width_20_per"><span value="e">e</span></div>
                        <div class="width_20_per"><span value="exp(">e<sup>x</sup></span></div>
                    </div>
                </div>
                <?php if($device=='desktop'){ ?>
                <div id="graph_wrapper" class="left canvas_div_pdf col-span-12 md:col-span-6 lg:col-span-6">
                    <div id="toolbar" class="d-none d-md-block">
                        <div id="tool_select">
                            <div id="hideSidebar"><a href="javascript:void(0)"
                                    onclick="jsgui.hideSidebar()">&laquo;</a></div>
                            <div id="showSidebar"><a href="javascript:void(0)"
                                    onclick="jsgui.showSidebar()">&raquo;</a></div>
                            <a href="javascript:void(0)" onclick="jsgui.setTool('pointer')" id="tool_select_pointer"
                                class="toolbar_option toolbar_selected">
                                <img src="<?= url('images/pointer.png') ?>" alt="Pointer" title="Pointer" /></a>
                            <a href="javascript:void(0)" onclick="jsgui.setTool('trace')" id="tool_select_trace"
                                class="toolbar_option">
                                <img src="<?= url('images/trace.png') ?>" alt="Trace" title="Trace" /></a>
                            <a href="javascript:void(0)" onclick="jsgui.setTool('vertex')" id="tool_select_vertex"
                                class="toolbar_option">
                                <img src="<?= url('images/minmax.png') ?>" alt="Local Minima/Maxima"
                                    title="Local Minima/Maxima" /></a>
                            <a href="javascript:void(0)" onclick="jsgui.setTool('root')" id="tool_select_root"
                                class="toolbar_option">
                                <img src="<?= url('images/root.png') ?>" alt="Root" title="Root" /></a>
                            <a href="javascript:void(0)" onclick="jsgui.setTool('intersect')"
                                id="tool_select_intersect" class="toolbar_option">
                                <img src="<?= url('images/intersect.png') ?>" alt="Intersect"
                                    title="Intersect" /></a>
                            <a href="javascript:void(0)" onclick="jsgui.setTool('derivative')"
                                id="tool_select_derivative" class="toolbar_option">
                                <img src="<?= url('images/derivative.png') ?>" alt="Derivative"
                                    title="Derivative" /></a>
                            <a href="javascript:void(0)" onclick="jsgui.setTool('zoomin')" id="tool_select_zoomin"
                                class="toolbar_option">
                                <img src="<?= url('images/zoomin.png') ?>" alt="Zoom In" title="Zoom In" /></a>
                            <a href="javascript:void(0)" onclick="jsgui.setTool('zoomout')" id="tool_select_zoomout"
                                class="toolbar_option">
                                <img src="<?= url('images/zoomout.png') ?>" alt="Zoom Out" title="Zoom Out" /></a>
                            <a href="javascript:void(0)" onclick="openFullscreen()" class="toolbar_option">
                                <img src="<?= url('images/fullscreen.png') ?>" alt="Full Screen"
                                    title="Full Screen" /></a>
                        </div>
                    </div>
                    <canvas id="graph">Sorry, your browser does not support this application. The following
                        browsers are supported:<br /><br />
                        <a href="http://www.google.com/chrome/">Google Chrome</a><br /><a
                            href="http://www.mozilla.com/firefox/">Mozilla Firefox</a><br />
                        <a href="http://www.opera.com/">Opera</a></canvas>
                </div>
                <?php } ?>
            </div>
        </div>
        @if ($type == 'widget')
            @include('inc.widget-button')
        @endif
    </div>


    @push('calculatorJS')
        {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
        <script type="text/javascript" src="https://www.yerich.net/jquery.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.2/underscore-min.js">
        </script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/1.3.0/math.min.js"></script>
        <script type="text/javascript" src="{{ url('js/calc.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/jsgcalc.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/jsgui.js') }}"></script>
        <script>
            var elem = document.getElementById("graph_wrapper");

            function openFullscreen() {
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.mozRequestFullScreen) {
                    /* Firefox */
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) {
                    /* Chrome, Safari & Opera */
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) {
                    /* IE/Edge */
                    elem.msRequestFullscreen();
                }
            }
            $(document).ready(function() {
                $('.width_20_per span').click(function() {
                    var val = $(this).attr('value');
                    if (val != 'del' && val != 'clear') {
                        $('.active_equation input').val($('.active_equation input').val() + val);
                    } else if (val == 'del') {
                        var str = $('.active_equation input').val();
                        $('.active_equation input').val(str.slice(0, -1));
                    } else if (val == 'clear') {
                        $('.active_equation input').val('');
                    }
                    $('.active_equation input').focus();
                });
            });
        </script>
    @endpush
</form>
