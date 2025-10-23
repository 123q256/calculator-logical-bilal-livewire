<style>
    input{
        background-color: transparent;
        outline: none
    }
	table.scorecard {
        margin: 0 auto; 
        width:100%; 
        font-size:12px; 
        border:1px solid; 
        text-align: center; 
        table-layout: fixed; 
        margin-bottom: 20px;
    }
	table.scorecard th {border-bottom:1px solid black; background-color:#d3313a; height:30px; color: #fff}
	table.scorecard th:not(:last-child) {border-right:1px solid black;border-bottom:1px solid black;}
	table.scorecard td {height:35px; background: rgba(255, 255, 255, 0.5);}
	table.scorecard tr td:not(:last-child) {border-right:1px solid;}
	table.scorecard tr:nth-child(2) td:nth-child(even) {border-bottom:1px solid;}
	table.scorecard tr:nth-child(2) td:last-child {border-bottom:1px solid;}
	table.scorecard tr{border:none}
	table.scorecard input{text-align: center; border: none !important;padding: 0px !important; height: 1.25rem !important}
    .pins{justify-content: center;display: flex;flex-wrap: wrap; gap: 8px}
	.buttons input{height: 2.75rem !important;padding: 5px 22px;font-family: "Roboto", "Helvetica", "Arial", sans-serif;line-height: 1.75;border-radius: 4px;border: 1px solid rgba(0, 0, 0, 0.23)!important;width: 4rem; background-color: #fff; visibility: visible;}
    .buttons input:hover{background-color: rgba(255, 255, 255, 0.5);}
</style>
<form class="row" action="{{ url()->current() }}/" method="POST" autocomplete="off">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[100%] md:w-[100%] w-full mx-auto ">
            <div class="col-12 mt-3  gap-4">

            <div id="scorecard" class="text-center">
                <table id="scorecardTable" class="scorecard" cellpadding="1" cellspacing="0">
                    <tbody><tr></tr>
                    <tr>
                        <td colspan="3">
                            <div>
                                <input id="input1-1" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input1-2" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input2-1" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input2-2" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input3-1" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input3-2" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input4-1" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input4-2" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input5-1" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input5-2" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input6-1" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input6-2" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input7-1" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input7-2" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input8-1" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input8-2" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input9-1" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input9-2" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input10-1" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3">
                            <div>
                                <input id="input10-2" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="3" style="border-bottom:1px solid">
                            <div>
                                <input id="input10-3" size="1" maxlength="1" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="9" rowspan="9" style="border-left:1px solid;">
                            <div>
                                <input id="bowl_result" value="0" size="5" maxlength="3" type="text" style="font-size: 18px ;font-weight: 500" aria-label="input field">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div>
                                <input id="input1-res" size="3" maxlength="3" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="6">
                            <div>
                                <input id="input2-res" size="3" maxlength="3" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="6">
                            <div>
                                <input id="input3-res" size="3" maxlength="3" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="6">
                            <div>
                                <input id="input4-res" size="3" maxlength="3" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="6">
                            <div>
                                <input id="input5-res" size="3" maxlength="3" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="6">
                            <div>
                                <input id="input6-res" size="3" maxlength="3" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="6">
                            <div>
                                <input id="input7-res" size="3" maxlength="3" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="6">
                            <div>
                                <input id="input8-res" size="3" maxlength="3" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="6">
                            <div>
                                <input id="input9-res" size="3" maxlength="3" type="text" aria-label="input field">
                            </div>
                        </td>
                        <td colspan="9">
                            <div>
                                <input id="input10-res" size="3" maxlength="3" type="text" aria-label="input field">
                            </div>
                        </td>
                    </tr>
                </tbody></table>
            </div>
            <div  class="pins">
                <div class="buttons" >
                    <input id="e-0" value="0" onclick="calc(0)" type="button" class="green_button" >
                </div>
                <div class="buttons">
                    <input id="e-1" value="1" onclick="calc(1)" type="button" class="green_button" >
                </div>
                <div class="buttons">
                    <input id="e-2" value="2" onclick="calc(2)" type="button" class="green_button" >
                </div>
                <div class="buttons">
                    <input id="e-3" value="3" onclick="calc(3)" type="button" class="green_button" >
                </div>
                <div class="buttons">
                    <input id="e-4" value="4" onclick="calc(4)" type="button" class="green_button" >
                </div>
                <div class="buttons">
                    <input id="e-5" value="5" onclick="calc(5)" type="button" class="green_button" >
                </div>
                <div class="buttons">
                    <input id="e-6" value="6" onclick="calc(6)" type="button" class="green_button" >
                </div>
                <div class="buttons">
                    <input id="e-7" value="7" onclick="calc(7)" type="button" class="green_button" >
                </div>
                <div class="buttons">
                    <input id="e-8" value="8" onclick="calc(8)" type="button" class="green_button" >
                </div>
                <div class="buttons">
                    <input id="e-9" value="9" onclick="calc(9)" type="button" class="green_button" >
                </div>
                <div class="buttons">
                    <input id="e-X" value="X" onclick="calc('X')" type="button" class="red_button" >
                </div>
                <div class="buttons">
                    <input id="e-div" value="/" onclick="calc('/')" type="button" class="red_button"  disabled="disabled">
                </div>
            </div>
            <div class="errClass" id="dynErrDisp" style="display: none;"></div>
            <div id="calciScroll"></div>

            <div class="col-12 text-center mt-[30px]">
                <a href="{{ url()->current() }}/" class="calculate px-6 py-3 sm:px-10 sm:py-4 text-white font-semibold bg-[#2845F5] rounded-[30px] focus:outline-none focus:ring-2 text-sm sm:text-base" id="">
                    New Game
                </a>
            </div>
       </div>
    </div>
    @if ($type=='widget')
    @include('inc.widget-button')
    @endif
</div>

    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="d-flex justify-content-between">
                <p class="text-blue font-s-21"><strong>{{$lang['res']}}:</strong></p>
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            </div>
            <div class="row my-2">
            </div>
        </div>
    @endisset
</form>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src=<?=asset('assets/js/bowling-score.js')?>></script>
