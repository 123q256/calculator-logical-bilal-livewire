<style>
    @media (max-width: 380px) {
        .calculator-box{
            padding-left: 0.5rem; 
            padding-right: 0.5rem; 
        }
    }
    .velocitytab .v_active{
        border-bottom: 3px solid var(--light-blue);
    }
    .velocitytab .v_active strong{
        color: var(--light-blue);
    }
    .velocitytab p{
        position: relative;
        top: 2px;
    }
    .active{
        background-color: var(--light-blue);;
        color: white;
    }
    .select2 {
        width: 100% !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 6px !important;
    }
    .select2-container .select2-selection--single {
        height: 40px !important;
        border: 1px solid #D2D4D8 !important;
        border-radius: 10px !important;
    }
    .select2-selection__rendered{
        padding-top: 5px !important; 
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="row mx-auto">
        @if (isset($error))
            <p class="text-center font-s-18"><strong class="text-danger">{{ $error }}</strong></p>
        @endif
        @php
            $request = request();
        @endphp
        <div class="col-lg-9 mx-auto">
            <div class="row align-items-center">
                <strong class="col-lg-2 font-s-14">{{ $lang['to_cal'] ?? "To Calculate" }} :</strong>
                <div class="col-lg-8 d-flex {{$device == 'desktop' ? 'justify-content-around' : 'justify-content-between' }} my-3 velocitytab border-b-dark position-relative">
                    <p class="cursor-pointer veloTabs {{ isset($_POST['main']) && $_POST['main'] !== '1' ? ''  : 'v_active' }} " id="Document"><strong>{{ $lang['1'] ?? "Document" }}</strong></p>
                    <p class="cursor-pointer veloTabs {{ isset($_POST['main']) && $_POST['main'] == '2' ? 'v_active'  : '' }} " id="Book"><strong>{{ $lang['2'] ?? "Book" }}</strong></p>
                    <p class="cursor-pointer veloTabs {{ isset($_POST['main']) && $_POST['main'] == '3' ? 'v_active'  : '' }} " id="Speech"><strong>{{ $lang['3'] ?? "Speech"}}</strong></p>
                    <p class="cursor-pointer veloTabs {{ isset($_POST['main']) && $_POST['main'] == '4' ? 'v_active'  : '' }} " id="Language"><strong>{{ $lang['4'] ?? "Language"}}</strong></p>
                </div>
                <input type="hidden" name="main" id="main" value="{{ isset($_POST['main'])?$_POST['main']: '1' }}">
            </div>
        </div>
        <div class="col-lg-7 px-lg-2 mx-auto">

            <div class="row document {{$request->main != 2 && $request->main != 3  && $request->main != 4 ? '' : 'd-none'}}">
                <div class="col-6 px-2">
                    <label for="page" class="font-s-14 text-blue">{{ $lang['5'] ?? "Pages" }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" type="any" name="page" id="page" class="input" value="{{ isset($_POST['page'])?$_POST['page']:'' }}" aria-label="input" placeholder="00"/>
                    </div>
                </div>
                <div class="col-6 px-2">
                    <label for="size" class="font-s-14 text-blue">{{ $lang['6'] ?? "Size" }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="size" id="size" class="input text-blue font-s-16">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = ["10","11","12","13","14"];
                                $val = ["10","11","12","13","14"];
                                optionsList($val,$name,isset($_POST['size'])?$_POST['size']:"12");
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-6 px-2">
                    <label for="font" class="font-s-14 text-blue">{{ $lang['7'] ?? "Font" }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="font" id="font" class="input text-blue font-s-16">
                            @php
                                $name = ["Times New Roman","Calibri","Courier","Garamond","Verdana","Arial","Helvetica","Century Gothic","Candara","Cambria"];
                                $val = ["Times","Calibri","Courier","Garamond","Verdana","Arial","Helvetica","Century Gothic","Candara","Cambria"];
                                optionsList($val,$name,isset($_POST['font'])?$_POST['font']:"Times");
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-6 px-2 custom_font {{$request->font == 'custom' ? '' : 'd-none'}}">
                    <label for="custom_font" class="font-s-14 text-blue">{{ $lang['cus'] ?? "Add Your Own Font" }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="text" type="any" name="custom_font" id="custom_font" class="input" value="{{ isset($_POST['custom_font'])?$_POST['custom_font']:'' }}" aria-label="input" placeholder="Times New Roman"/>
                    </div>
                </div>
                <div class="col-6 px-2">
                    <label for="space" class="font-s-14 text-blue">{{ $lang['8'] ?? "Spacing" }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="space" id="space" class="input text-blue font-s-16">
                            @php
                                $name = ["Single","1.5","Double"];
                                $val = ["single","1.5","double",];
                                optionsList($val,$name,isset($_POST['space'])?$_POST['space']:"single");
                            @endphp
                        </select>
                    </div>
                </div>
            </div>

            <div class=" books {{$request->main != 2 && $request->main != 3 ? 'd-none' : 'row'}}">
                {{-- <div class="mt-0 my-lg-2 text-center">
                    <input type="radio" name="stype" id="input" value="input" checked {{ isset($_POST['stype']) && $_POST['stype'] === 'input' ? 'checked' : '' }}>
                    <label for="input" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['9'] ?? "Input" }}</label>
                    <input type="radio" name="stype" id="select" value="select" {{ isset($_POST['stype']) && $_POST['stype'] === 'select' ? 'checked' : '' }}>
                    <label for="select" class="font-s-14 text-blue">{{ $lang['10'] ?? "Select"}}</label>
                </div> --}}
                <div class="col-lg-8 mx-auto px-2 Title">
                    <label for="title" class="font-s-14 text-blue">{{ $lang['11'] ?? "Title" }}</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="title" id="title" class="input text-blue font-s-16 sle_books {{$request->main == 2 ? '' : 'd-none'}}">
                            @php
                                $name = ["Empty","Quran","The Bible (KJV)","The Great Gatsby","Harry Potter (Series)","Average Novel","The Hobbit" , "The Lord of the Rings","War and Peace" , "Pride and Prejudice","Rich Dad Poor Dad","Great Expectations","Shakespearean Tragedy Play"];
                                $val = ["Empty","Quran","Bible","Gatsby","Harry","Av_noval","Hobbit","Rings","Peace" , "Pride","Rich","Great_Ex","Shakespearean"];
                                optionsList($val,$name,isset($_POST['title'])?$_POST['title']:"Quran");
                            @endphp
                        </select>
                        <select name="sp_title" id="sp_title" class="input text-blue font-s-16 speech {{$request->main == 3 ? '' : 'd-none'}}">
                            @php
                                $name = ["Empty","A More Perfect Union","Gettysburg Address","I Have A Dream","We Shall Fight on the Beaches"];
                                $val = ["Empty","Perfect","Gettysburg","Dream","Beaches"];
                                optionsList($val,$name,isset($_POST['sp_title'])?$_POST['sp_title']:"Perfect");
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 px-2 title2 {{$request->title == 'custom' ? '' : 'd-none'}}">
                    <label for="title2" class="font-s-14 text-blue">{{ $lang['11'] ?? "Add Your Own Title" }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="text" type="any" name="title2" id="title2" class="input" value="{{ isset($_POST['title2'])?$_POST['title2']:'' }}" aria-label="input" placeholder="{{ $lang['11'] ?? "Add Your Own Title" }}"/>
                    </div>
                </div>
                <span class="text-center text-gray">----------- OR -----------</span>
                {{-- or --}}
                <div class="col-lg-8 mx-auto px-2">
                    <label for="page2" class="font-s-14 text-blue" id="p_m">{{ $lang['5'] ?? "Pages" }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" type="any" name="page2" id="page2" class="input" value="{{ isset($_POST['page2'])?$_POST['page2']:'' }}" aria-label="input" placeholder="00"/>
                    </div>
                </div>
            </div>

            <div class="langu {{$request->main != 4 ? 'd-none' : 'row'}}">
                <div class="add_related col-8 mx-auto">
                    <label for="lang" class="font-s-14 text-blue ">{{ $lang['13'] ?? "Language" }}</label>
                    <div class="py-1">
                        <select class='form-control select2 ' name='lang' id="lang">
                            @php
                                $name = [
                                    "English", "French", "German", "Russian", "Spanish", "Japanese", "Korean", "Portuguese", "Swedish", "Italian", "Hindi", "Urdu", "Arabic", "Turkish", "Chinese"
                                ];

                                $val = [
                                    "English", "French", "German", "Russian", "Spanish", "Japanese", "Korean", "Portuguese", "Swedish", "Italian", "Hindi", "Urdu", "Arabic", "Turkish", "Chinese"
                                ];
                                optionsList($val, $name, isset($_POST['lang']) ? $_POST['lang'] : "English");
                            @endphp
                        </select>
                    </div>
                </div>
            </div>
        </div>

        
        @if ($type=='calculator')
            @include('inc.button')
        @endif
    </div>
    @isset($detail)   
        <div class="col-12 bg-light-blue result p-3 radius-10 mt-3 overflow-auto">
            <div class="d-flex justify-content-between">
                <p class="text-blue font-s-21"><strong>{{$lang['res']}}:</strong></p>
                @if ($type=='calculator')
                    @include('inc.copy-pdf')
                @endif      
            </div>
            <div class="row">
                <div class="text-center">
                    <p class="font-s-18"><strong>{{$lang['ans_key'] ?? "Word Count"}}</strong></p>
                    <p class="font-s-25 bg-white px-3 py-2 radius-10 d-inline-block my-1"><strong class="text-blue">{{$detail['counter']}}</strong></p>
                </div>
            </div>
        </div>
    @endisset
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            "use strict";
            $('.select2').select2();
        });
    </script>

    @push('calculatorJS')
       <script>
            var title2 = document.querySelector('.title2');
            var Title = document.querySelector('.Title');
            // document.getElementById('title').addEventListener('change',function(){
            //     var font = this.value;
            //     if(font == "custom"){
            //         document.querySelector('.title2').style.display = "block";
            //         Title.classList.remove('col-lg-8');
            //         Title.classList.add('col-lg-6');
            //     }else{
            //         document.querySelector('.title2').style.display = "none";
            //         Title.classList.add('col-lg-8');
            //         Title.classList.remove('col-lg-6');
            //     }
            // })
            // document.getElementById('sp_title').addEventListener('change',function(){
            //     var font = this.value;
            //     if(font == "custom"){
            //         document.querySelector('.title2').style.display = "block";
            //         Title.classList.remove('col-lg-8');
            //         Title.classList.add('col-lg-6');
            //     }else{
            //         document.querySelector('.title2').style.display = "none";
            //         Title.classList.add('col-lg-8');
            //         Title.classList.remove('col-lg-6');
            //     }
            // })

            // document.getElementById('font').addEventListener('change',function(){
            //     var font = this.value;
            //     if(font == "custom"){
            //         document.querySelector('.custom_font').style.display = "block";
            //     }else{
            //         document.querySelector('.custom_font').style.display = "none";
            //     }
            // })

            document.addEventListener('DOMContentLoaded', function () {
                const tabs = document.querySelectorAll('.veloTabs');
                tabs.forEach(tab => {
                    tab.addEventListener('click', function () {
                        tabs.forEach(t => t.classList.remove('v_active'));
                        tab.classList.add('v_active');
                        let time_type;
                        if (tab.id == 'Document') {
                            time_type = 1;
                        } else if (tab.id == 'Book') {
                            time_type = 2;
                        } else if (tab.id == 'Speech') {
                            time_type = 3;
                        } else if (tab.id == 'Language') {
                            time_type = 4;
                        }
                        if (time_type == 1) {
                            document.getElementById('main').value = 1;
                            document.querySelectorAll('.document').forEach(element => {
                                element.classList.add("row");
                                element.classList.remove("d-none");
                            });
                            document.querySelectorAll('.books').forEach(element => {
                                element.classList.remove("row");
                                element.classList.add("d-none");
                            });
                            document.querySelectorAll('.langu').forEach(element => {
                                element.classList.add("d-none");
                                element.classList.remove("row");
                            });
                        } else if (time_type == 2) {
                            document.getElementById('main').value = 2;
                            document.querySelectorAll('.document').forEach(element => {
                                element.classList.remove("row");
                                element.classList.add("d-none");
                            });
                            document.querySelectorAll('.books').forEach(element => {
                                element.classList.add("row");
                                element.classList.remove("d-none");
                            });
                            document.querySelectorAll('.sle_books').forEach(element => {
                                element.classList.remove("d-none");
                                element.classList.add("d-block");
                            });
                            document.querySelectorAll('.speech').forEach(element => {
                                element.classList.add("d-none");
                                element.classList.remove("d-block");
                            });
                            document.querySelectorAll('.langu').forEach(element => {
                                element.classList.add("d-none");
                                element.classList.remove("row");
                            });
                            document.querySelector("#p_m").innerHTML = "{{ $lang['5'] ?? 'Pages'}}";
                        } else if (time_type == 3) {
                            document.getElementById('main').value = 3;
                            document.querySelectorAll('.document').forEach(element => {
                                element.classList.remove("row");
                                element.classList.add("d-none");
                            });
                            document.querySelectorAll('.books').forEach(element => {
                                element.classList.add("row");
                                element.classList.remove("d-none");
                            });
                            document.querySelectorAll('.sle_books').forEach(element => {
                                element.classList.add("d-none");
                                element.classList.remove("d-block");
                            });
                            document.querySelectorAll('.speech').forEach(element => {
                                element.classList.remove("d-none");
                                element.classList.add("d-block");
                            });
                            document.querySelectorAll('.langu').forEach(element => {
                                element.classList.add("d-none");
                                element.classList.remove("row");
                            });
                            document.querySelector("#p_m").innerHTML = "{{ $lang['12'] ?? 'Minutes'}}";

                        } else if (time_type == 4) {
                            document.getElementById('main').value = 4;
                            document.querySelectorAll('.document').forEach(element => {
                                element.classList.remove("row");
                                element.classList.add("d-none");
                            });
                            document.querySelectorAll('.books').forEach(element => {
                                element.classList.remove("row");
                                element.classList.add("d-none");
                            });
                            document.querySelectorAll('.langu').forEach(element => {
                                element.classList.remove("d-none");
                                element.classList.add("row");
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</form>