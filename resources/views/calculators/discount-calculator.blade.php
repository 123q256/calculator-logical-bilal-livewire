<style>
    @media (max-width: 380px) {
       .calculator-box{
           padding-right: 0rem;
           padding-left: 0rem;
       }
   }
   .velocitytab .v_active{
       border-bottom: 3px solid var(--light-blue);
   }
   .veloTabs:hover{
       background: #dcdcdc73;
   }
   .velocitytab .v_active strong{
       color: var(--light-blue);
   }
   .velocitytab p{
       position: relative;
       top: 2px
   }
   input[type="date"],input[type="time"]{
       min-width: 85%;
       margin: 0px auto;
   }
   .gap-10{
       gap: 20px;
   }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
   @csrf
 
   <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
       @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    @php
                    $myLang = app()->getLocale();
                    $request = request();
                    @endphp
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                    @if ($myLang == 'id')
                        <div class="space-y-2 relative">
                            <label for="id_rp" class="font-s-14 text-blue">Harga Awal (rupiah):</label>
                            <input type="number" step="any" name="id_rp" id="id_rp" class="input" aria-label="input" placeholder="99" value="{{ isset($_POST['id_rp']) ? $_POST['id_rp'] : '3212' }}" />
                            <span class="text-blue input_unit">Rp</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="id_p" class="font-s-14 text-blue">Diskon (%):</label>
                            <input type="number" step="any" name="id_p" id="id_p" class="input" aria-label="input" placeholder="99" value="{{ isset($_POST['id_p']) ? $_POST['id_p'] : '21' }}" />
                            <span class="text-blue input-unit">Rp</span>
                        </div>
                    @elseif($myLang == 'tr')
                        <div class="space-y-2 relative">
                            <label for="typet" class="font-s-14 text-blue">İşlem Türü :</label>
                            <select class="input" name="typet" id="typet">
                                <option value="1" {{ isset($_POST['typet']) && $_POST['typet'] == '1' ? 'selected' : '' }}>
                                    Normal fiyat ve indirim oranı girerek indirim hesaplama </option>
                                <option value="2" {{ isset($_POST['typet']) && $_POST['typet'] == '2' ? 'selected' : '' }}>
                                    Normal fiyat ve indirimli fiyat girerek indirim hesaplama </option>
                                <option value="3" {{ isset($_POST['typet']) && $_POST['typet'] == '3' ? 'selected' : '' }}>
                                    Normal fiyat ve indirim miktarı girerek indirim hesaplama</option>
                                <option value="4" {{ isset($_POST['typet']) && $_POST['typet'] == '4' ? 'selected' : '' }}>
                                    İndirimli fiyat ve indirim oranı girerek indirim hesaplama </option>
                                <option value="5" {{ isset($_POST['typet']) && $_POST['typet'] == '5' ? 'selected' : '' }}>
                                    İndirimli fiyat ve indirim miktarı girerek indirim hesaplama</option>
                            </select>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="tx" class="font-s-14 text-blue">Normal Fiyat:</label>
                            <input type="number" step="any" name="tx" id="tx" class="input" aria-label="input" placeholder="Örnek: 3212"  value="{{ isset($_POST['tx']) ? $_POST['tx'] : '21' }}" />
                            <span class="text-blue input_unit">Rp</span>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="ty" class="font-s-14 text-blue">İndirim Oranı (%)</label>
                            <input type="number" step="any" name="ty" id="ty" class="input" aria-label="input" placeholder="Örnek: 21" value="{{ isset($_POST['ty']) ? $_POST['ty'] : '21' }}" />
                        <span class="text-blue input_unit">Rp</span>
                        </div>
                    @elseif($myLang == 'ar')
                       <div class="grid grid-cols-1  gap-4">
                            <label for="first1" class=" px-2 my-1">
                                <span>كم سيصبح السعر بعد الخصم</span>
                                @if(isset($_POST['form_a']) && $_POST['form_a']=="first1")
                                    <input class="with-gap" id="first1"  name="form_a" type="radio" value="first1" checked>
                                @else
                                    <input class="with-gap" id="first1"  name="form_a" type="radio" value="first1" checked>
                                @endif
                            </label>
                            <label for="sec" class=" px-2 my-1">
                                <span>كم كان السعر قبل الخصم</span>
                                @if(isset($_POST['form_a']) && $_POST['form_a']=="sec")
                                    <input class="with-gap" id="sec"  name="form_a" type="radio" value="sec" checked>
                                @else
                                    <input class="with-gap" id="sec"  name="form_a" type="radio" value="sec">
                                @endif
                            </label>
                            <label for="thir" class=" px-2 my-1">
                                <span>معرفة نسبة الخصم</span>
                                @if(isset($_POST['form_a']) && $_POST['form_a']=="thir")
                                    <input class="with-gap" id="thir"  name="form_a" type="radio" value="thir" checked>
                                @else
                                    <input class="with-gap"  id="thir" name="form_a" type="radio" value="thir">
                                @endif
                            </label>
                       </div>
                        <div class="space-y-2 relative first1 {{isset(request()->form_a) && request()->form_a == 'sec' ? 'd-none' : ''}}">
                            <label for="first1" class="font-s-14 text-blue">ادخل سعر السلعة الأصلي</label>
                            <input type="number" step="any" name="first1" id="first1" class="input"
                            aria-label="input" placeholder="Örnek: 21"
                            value="{{ isset($_POST['first1']) ? $_POST['first1'] : '10' }}" />
                        </div>
                        <div class="space-y-2 relative seci  {{isset(request()->form_a) && request()->form_a !== 'first1' ? '' : 'd-none'}}">
                            <label for="sec" class="font-s-14 text-blue">أدخل سعر السلعة بعد الخصم</label>
                            <input type="number" step="any" name="sec" id="sec" class="input" aria-label="input" placeholder="Örnek: 21" value="{{ isset($_POST['sec']) ? $_POST['sec'] : '20' }}" />
                        </div>
                        <div class="space-y-2 relative thiri text-end {{isset(request()->form_a) && request()->form_a == 'thir' ? 'd-none' : ''}}">
                            <label for="thir" class="font-s-14 text-blue">أدخل نسبة الخصم (%)</label>
                            <input type="number" step="any" name="thir" id="thir" class="input"
                                    aria-label="input" placeholder="Örnek: 21"
                                    value="{{ isset($_POST['thir']) ? $_POST['thir'] : '30' }}" />
                        </div>
                    @else
                </div>
                <div class="grid grid-cols-1    gap-4" id="advance">
                    <div class="space-y-2">
                        <label for="type" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                        <select name="type" id="type" class="input">
                            <option value="1"
                                {{ isset($_POST['type']) && $_POST['type'] == '1' ? 'selected' : '' }}>%
                                {{ $lang['14'] }}</option>
                            <option value="2"
                                {{ isset($_POST['type']) && $_POST['type'] == '2' ? 'selected' : '' }}>%
                                {{ $lang['11'] }} 2 {{ $lang['12'] }}</option>
                            <option value="3"
                                {{ isset($_POST['type']) && $_POST['type'] == '3' ? 'selected' : '' }}>%
                                {{ $lang['11'] }} 3 {{ $lang['12'] }}</option>
                            <option value="4"
                                {{ isset($_POST['type']) && $_POST['type'] == '4' ? 'selected' : '' }}>
                                {{ $lang['13'] }}</option>
                            <option value="5"
                                {{ isset($_POST['type']) && $_POST['type'] == '5' ? 'selected' : '' }}>2
                                {{ $lang['15'] }} 1</option>
                            <option value="6"
                                {{ isset($_POST['type']) && $_POST['type'] == '6' ? 'selected' : '' }}>3
                                {{ $lang['15'] }} 2</option>
                            <option value="7"
                                {{ isset($_POST['type']) && $_POST['type'] == '7' ? 'selected' : '' }}>4
                                {{ $lang['15'] }} 3</option>
                            <option value="8"
                                {{ isset($_POST['type']) && $_POST['type'] == '8' ? 'selected' : '' }}>
                                {{ $lang['16'] }}</option>
                            <option value="9"
                                {{ isset($_POST['type']) && $_POST['type'] == '9' ? 'selected' : '' }}>
                                {{ $lang['17'] }}</option>
                            <option value="10"
                                {{ isset($_POST['type']) && $_POST['type'] == '10' ? 'selected' : '' }}>
                                {{ $lang['18'] }}</option>
                        </select>
                    </div>
                </div>

                    <p class="px-2 input_line my-4">{{$lang['input_line']}}</p>
                <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">

                    <div class="space-y-2 original relative">
                        <label for="amount" class="font-s-14 text-blue">{{ $lang['original'] }}</label>
                        <input type="number" step="any" name="amount" id="amount" class="input"
                        aria-label="input" placeholder="00" oninput="checkInputs()" min="0"
                        value="{{ isset($_POST['amount']) ? $_POST['amount'] : '' }}" />
                       <span class="text-blue input_unit fa-dollar">{{ $currancy }}</span>
                    </div>
                    <div class="space-y-2 hidden dis_p relative">
                        <label for="dis_p" class="font-s-14 text-blue">{{ $lang['discount'] }}</label>
                        <input type="number" step="any" name="dis_p" id="dis_p" class="input"  min="0" aria-label="input" placeholder="00"  value="{{ isset($_POST['dis_p']) ? $_POST['dis_p'] : '' }}" />
                     <span class="text-blue input_unit fa-dollar ">{{ $currancy }}</span>
                    </div>
                    <div class="space-y-2 hidden dis relative">
                        <label for="off" class="font-s-14 text-blue "><span class="firsts"></span> {{ $lang['20'] }} (%)</label>
                        <input type="number" step="any" name="off" id="off" class="input"  min="0" max="100" aria-label="input" placeholder="00" oninput="checkInputs()" value="{{ isset($_POST['off']) ? $_POST['off'] : '' }}" />
                        <span class="text-blue input-unit">%</span>
                    </div>
                    <div class="space-y-2 pay relative">
                        <label for="pay" class="font-s-14 text-blue "> You Pay</label>
                        <input type="number" step="any" name="pay" id="pay" class="input" min="0" aria-label="input" oninput="checkInputs()"value="{{ isset($_POST['pay']) ? $_POST['pay'] : '' }}" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>
                    <div class="space-y-2 saving relative">
                        <label for="saving" class="font-s-14 text-blue ">
                            You're saving</label>
                            <input type="number" step="any" name="saving" id="saving" class="input"  min="0"
                            aria-label="input" oninput="checkInputs()"
                            value="{{ isset($_POST['saving']) ? $_POST['saving'] : '' }}" />
                        <span class="text-blue input-unit">{{ $currancy }}</span>
                    </div> 
                    <div class="space-y-2 hidden dis2 relative">
                        <label for="off2" class="font-s-14 text-blue">2nd {{ $lang['20'] }} (%)</label>
                            <input type="number" step="any" name="off2" id="off2" class="input"  min="0"
                            aria-label="input" placeholder="400"
                            value="{{ isset($_POST['off2']) ? $_POST['off2'] : '400' }}" />
                    </div> 
                    <div class="space-y-2 hidden dis3 relative">
                        <label for="off3" class="font-s-14 text-blue">3rd {{ $lang['20'] }} (%)</label>
                        <input type="number" step="any" name="off3" id="off3" class="input" min="0" 
                        aria-label="input" placeholder="400"
                        value="{{ isset($_POST['off3']) ? $_POST['off3'] : '400' }}" />
                    </div> 
                    <div class="space-y-2 hidden p1 relative">
                        <label for="p1" class="font-s-14 text-blue">{{ $lang['12'] }} 1</label>
                        <input type="number" step="any" name="p1" id="p1" class="input" min="0"
                        aria-label="input" placeholder="400"
                        value="{{ isset($_POST['p1']) ? $_POST['p1'] : '400' }}" />
                        <span class="text-blue input_unit fa-dollar ">{{ $currancy }}</span>
                    </div> 
                    <div class="space-y-2 hidden p2 relative">
                        <label for="p2" class="font-s-14 text-blue">{{ $lang['12'] }} 2</label>
                        <input type="number" step="any" name="p2" id="p2" class="input" min="0" aria-label="input" placeholder="500" value="{{ isset($_POST['p2']) ? $_POST['p2'] : '500' }}" />
                        <span class="text-blue input_unit fa-dollar ">{{ $currancy }}</span>
                    </div> 
                    <div class="space-y-2 hidden p3 relative">
                        <label for="p3" class="font-s-14 text-blue">{{ $lang['12'] }} 3</label>
                        <input type="number" step="any" name="p3" id="p3" class="input" min="0" aria-label="input" placeholder="500" value="{{ isset($_POST['p3']) ? $_POST['p3'] : '500' }}" />
                        <span class="text-blue input-unit fa-dollar ">{{ $currancy }}</span>
                    </div>  
                    <div class="space-y-2 hidden p4 relative">
                        <label for="p4" class="font-s-14 text-blue">{{ $lang['12'] }} 4</label>
                        <input type="number" step="any" name="p4" id="p4" class="input" min="0"
                        aria-label="input" placeholder="500"
                        value="{{ isset($_POST['p4']) ? $_POST['p4'] : '500' }}" />
                    <span class="text-blue input-unit fa-dollar ">{{ $currancy }}</span>
                    </div>  
                    <div class="space-y-2  multi relative">
                        <label for="nbr" class="font-s-14 text-blue">{{ $lang['21'] }} </label>
                        <input type="number" step="any" name="nbr" id="nbr" class="input" min="0"
                        aria-label="input" placeholder="3000"
                        value="{{ isset($_POST['nbr']) ? $_POST['nbr'] : '3000' }}" />
                    </div>  
                    <div class="space-y-2  multi relative">
                        <label for="up" class="font-s-14 text-blue">{{ $lang['22'] }} </label>
                        <input type="number" step="any" name="up" id="up" class="input"  min="0" aria-label="input" placeholder="4000" value="{{ isset($_POST['up']) ? $_POST['up'] : '4000' }}" />
                        <span class="text-blue input-unit fa-dollar ">{{ $currancy }}</span>
                    </div>  
                    <div class="space-y-2  multi relative">
                        <label for="fix" class="font-s-14 text-blue">{{ $lang['23'] }} </label>
                        <input type="number" step="any" name="fix" id="fix" class="input"  min="0" aria-label="input" placeholder="4000" value="{{ isset($_POST['fix']) ? $_POST['fix'] : '4000' }}" />
                        <span class="text-blue input-unit fa-dollar ">{{ $currancy }}</span>
                    </div>  

                </div>
                <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">

                    <div class="space-y-2   relative">
                        <div class="mt-0 mt-lg-2">
                            <input type="radio" name="tax" id="yes" value="yes" checked {{ isset($_POST['tax']) && $_POST['tax'] === 'yes' ? 'checked' : '' }}>
                            <label for="yes" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['25'] }}:</label>
                            <input type="radio" name="tax" id="no" value="no" {{ isset($_POST['tax']) && $_POST['tax'] === 'no' ? 'checked' : '' }}>
                            <label for="no" class="font-s-14 text-blue">{{ $lang['26'] }}:</label>
                        </div>
                    </div>  
                    <div class="space-y-2   relative {{isset($_POST['tax']) && $_POST['tax'] == 'no' ? '' : 'hidden' }} sales">
                        <label for="sale" class="font-s-14 text-blue">{{ $lang['27'] }}</label>
                        <input type="number" step="any" name="sale" id="sale" class="input"
                        aria-label="input" placeholder="2500"
                        value="{{ isset($_POST['sale']) ? $_POST['sale'] : '6' }}" />
                    <span class="text-blue input_unit fa-dollar ">%</span>
                    </div> 
                    @endif
                </div>
           </div>
            @if ($type == 'calculator')
            @include('inc.button')
           @endif
           @if ($type=='widget')
           @include('inc.widget-button')
            @endif
        </div>



   @isset($detail)
   <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if(isset($detail['arabic']))
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                    @else
                        @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                        @endif
                    @endif
                    
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full p-3 radius-10 mt-3">
                            @if (isset($detail['nor']))
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                    <table class="w-full">
                                        <tr>
                                            <td class="py-2 border-b">Normal Fiyat</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['nor'] }} TL</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">İndirimli Fiyat</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['ind'] }} TL</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">İndirim Miktarı</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['mik'] }} TL</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">İndirim Oranı (%)</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['ora'] }}%</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif(isset($detail['arabic']))
                                @if (isset($detail['third']))
                                    <div class=" mt-2 ms-auto  text-end">
                                        <p class="mt-2 text-end"><strong>المدخلات</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $_POST['thir'] }} %</td>
                                                <td class="py-2 border-b" width="70%">:نسبة الخصم</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $_POST['first1'] }} </td>
                                                <td class="py-2 border-b" width="70%">: السعر قبل الخصم</td>
                                            </tr>
                                        </table>
                                        <p class="mt-2 text-end"><strong>النتيجة</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['dis'] }}</td>
                                                <td class="py-2 border-b" width="70%">:السعر بعد الخصم يصبح</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['third'] }} </td>
                                                <td class="py-2 border-b" width="70%"> :قيمة الخصم</td>
                                            </tr>
                                        </table>
                                    </div>
                                @elseif(isset($detail['first']))
                                    <div class="col-lg-8 mt-2 ms-auto  text-end">
                                        <p class="mt-2 text-end"><strong>المدخلات</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $_POST['thir'] }} %</td>
                                                <td class="py-2 border-b" width="70%">:نسبة الخصم</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $_POST['sec'] }} </td>
                                                <td class="py-2 border-b" width="70%"> :السعر بعد الخصم</td>
                                            </tr>
                                        </table>
                                        <p class="mt-2 text-end"><strong>النتيجة</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['dis'] }} %</td>
                                                <td class="py-2 border-b" width="70%">:اقيمة الخصم</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['first'] }} </td>
                                                <td class="py-2 border-b" width="70%">:السعر قبل الخصم كان</td>
                                            </tr>
                                        </table>
                                    </div>
                                @elseif(isset($detail['thirl']))
                                    <div class="col-lg-8 mt-2 ms-auto text-end">
                                        <p class="mt-2 text-end"><strong>المدخلات</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $_POST['first1'] }} </td>
                                                <td class="py-2 border-b" width="70%">:السعر قبل الخصم</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $_POST['sec'] }} </td>
                                                <td class="py-2 border-b" width="70%"> :السعر بعد الخصم</td>
                                            </tr>
                                        </table>
                                        <p class="mt-2 text-end"><strong>النتيجة</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['dis'] }} </td>
                                                <td class="py-2 border-b" width="70%">:اقيمة الخصم</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $detail['thirl'] }} % </td>
                                                <td class="py-2 border-b" width="70%">:نسبة الخصم على سعر السلعة</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            @elseif(isset($detail['discount_id']))
                                <p class="mt-2 font-s-18"><strong>Diskon Anda</strong></p>
                                <div class="col-lg-8 mt-2">
                                    <table class="w-full">
                                        <tr>
                                            <td class="py-2 border-b">Harga Sebelum Diskon</td>
                                            <td class="py-2 border-b"><strong>{{ number_format($_POST['id_rp'], 2) }} Rp</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">Besar Diskon</td>
                                            <td class="py-2 border-b"><strong>{{ number_format($detail['discount_id'], 2) }} Rp  ({{ $_POST['id_p'] }} %)</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">Harga Setelah Diskon</td>
                                            <td class="py-2 border-b"><strong>{{ number_format($_POST['id_rp'] - $detail['discount_id'], 2) }} Rp</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @else
                                <div class="mt-2">
                                    {{-- @if ($_POST['type'] == 1)
                                        <div class="col-lg-8 mt-2">
                                            <table class="w-100 font-s-18">
                                                <tr>
                                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['original'] }}
                                                        </strong></td>
                                                    <td class="py-2 border-b"> {{ $_POST['cur'] . ' ' . $detail['amount'] }}</td>
                                                </tr> 
                                                <tr>
                                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['20'] }}
                                                        </strong>
                                                    </td>
                                                    <td class="py-2 border-b">{{ $detail['off'] }} %</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif --}}
                                    <div class="col-lg-8 mt-2">
                                        <table class="w-full">
                                            <p class="mt-2"><strong>{{ $lang['28'] }}</strong></p>
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['discount'] }}
                                                    </strong>
                                                </td>
                                                <td class="py-2 border-b"> {{ isset($_POST['cur']) ? $_POST['cur'] : '' }}
                                                    {{ $detail['pay'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['save'] }} </strong>
                                                </td>
                                                <td class="py-2 border-b">{{ isset($_POST['cur']) ? $_POST['cur'] : '' }}
                                                    {{ $detail['Ans'] }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    @if (isset($detail['ave']))
                                        <div class="col-lg-8">
                                            <table class="w-full">
                                                <tr>
                                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['29'] }}
                                                        </strong>
                                                    </td>
                                                    <td class="py-2 border-b">{{ $_POST['cur'] . ' ' . $detail['ave'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 " width="70%"><strong>{{ $detail['per'] }} %
                                                        {{ $lang['30'] }} {{ $detail['stand'] }} </strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif
                                    @if (isset($detail['effect']))
                                        <div class="col-lg-8">
                                            <table class="w-full">
                                                <tr>
                                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['31'] }}
                                                        {{ $detail['effect'] }}%, {{ $lang['32'] }}
                                                        {{ $detail['sum'] }} </strong></td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                                {{-- <div class="col-12 mt-5">
                                    <div id="chart" style="width:100%; height:450px;"></div>
                                </div> --}}
                            @endif
                    </div>
                </div>
            </div>
        </div>
   @endisset
</form>

@push('calculatorJS')
   <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
   <script src="https://code.highcharts.com/highcharts.js"></script>
   <script>
       @if(app()->getLocale() == 'ar')
           @if(!isset($detail))
               document.getElementById('first1').addEventListener('click',function(){
                   document.querySelector('.first1').style.display = 'block';
                   document.querySelector('.seci').style.display = 'none';
                   document.querySelector('.thiri').style.display = 'block';
               });
               document.getElementById('sec').addEventListener('click',function(){
                   document.querySelector('.first1').style.display = 'none';
                   document.querySelector('.seci').style.display = 'block';
                   document.querySelector('.thiri').style.display = 'block';

               });
               document.getElementById('thir').addEventListener('click',function(){
                   document.querySelector('.first1').style.display = 'block';
                   document.querySelector('.seci').style.display = 'block';
                   document.querySelector('.thiri').style.display = 'none';
               });
           @endif
       @endif
       @if (isset($detail))
           var type = "{{ $_POST['unit_type'] }}";
           if (type == "advance") {
               document.addEventListener('DOMContentLoaded', function() {
                   var myChart = Highcharts.chart('chart', {
                       chart: {
                           type: 'column'
                       },
                       title: {
                           text: '{{ $lang['33'] }}'
                       },
                       xAxis: {
                           categories: ['{{ $lang['34'] }}', '{{ $lang['35'] }}']
                       },
                       yAxis: {
                           allowDecimals: false,
                           min: 0,
                           title: {
                               text: '{{ $lang['36'] }}'
                           },
                           labels: {
                               formatter: function() {
                                   return '{{ $_POST['cur'] }} ' + this.value;
                               }
                           }
                       },
                       tooltip: {
                           // pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
                           @if (isset($detail['tax']))
                               formatter: function() {
                                   return '<b>' + this.x + '</b><br/>' +
                                       this.series.name + ': <?= $_POST['cur'] ?> ' + this.y +
                                       '<br/>' +
                                       'Total: <?= $_POST['cur'] ?>' + this.point.stackTotal;
                               }
                           @else
                               formatter: function() {
                                   return '<b>' + this.x + '</b><br/>' +
                                       this.series.name + ': <?= $_POST['cur'] ?> ' + this.y;
                               }
                           @endif
                       },
                       plotOptions: {
                           column: {
                               stacking: 'normal'
                           }
                       },
                       @if (isset($detail['tax']))
                           series: [{
                                   name: '{{ $lang['38'] }}',
                                   data: [{{ $detail['tax'] }}, {{ $detail['taxt'] }}],
                                   color: 'rgba(101,188,240,1)',
                               },
                               {
                                   name: '{{ $lang['37'] }}',
                                   data: [{{ $detail['amount'] }}, {{ $detail['payt'] }}],
                                   color: 'rgb(0,118,169)',
                               }
                           ]
                       @else
                           series: [{
                               name: '{{ $lang['36'] }}',
                               data: [{{ $detail['amount'] }}, {{ $detail['payt'] }}],
                               color: 'rgb(0,118,169)',
                           }]
                       @endif
                   });
               });
           }
       @endif

       @if (isset($detail))
           var type = "{{ $_POST['types'] }}";
           if (type == "percent") {
               document.querySelectorAll('.percent').forEach(function(percentElement) {
                   percentElement.textContent = '%';
               });
               document.querySelectorAll('.save').forEach(function(saveElement) {
                   saveElement.style.display = 'block';
               });

           } else {
               document.querySelectorAll('.percent').forEach(function(percentElement) {
                   percentElement.textContent = '{{ $currancy }}';
               });
               document.querySelectorAll('.save').forEach(function(saveElement) {
                   saveElement.style.display = 'none';
               });
           }
       @endif
       @if (isset($error))
           var type = "{{ $_POST['types'] }}";
           if (type == "percent") {
               document.querySelectorAll('.percent').forEach(function(percentElement) {
                   percentElement.textContent = '%';
               });
               document.querySelectorAll('.save').forEach(function(saveElement) {
                   saveElement.style.display = 'block';
               });

           } else {
               document.querySelectorAll('.percent').forEach(function(percentElement) {
                   percentElement.textContent = '{{ $currancy }}';
               });
               document.querySelectorAll('.save').forEach(function(saveElement) {
                   saveElement.style.display = 'none';
               });
           }
       @endif
       document.querySelectorAll('.percent_off').forEach(function(element) {
           element.addEventListener('click', function() {
               document.querySelectorAll('.percent').forEach(function(percentElement) {
                   percentElement.textContent = '%';
               });
               document.querySelectorAll('.save').forEach(function(saveElement) {
                   saveElement.style.display = 'block';
               });
           });
       });

       @if($myLang !== 'ar' )
           var salesElements = document.querySelectorAll('.sales');
           document.getElementById('yes').addEventListener('click', function() {
               salesElements.forEach(function(element) {
                   element.style.display = 'none';
               });
           });
           document.getElementById('no').addEventListener('click', function() {
               salesElements.forEach(function(element) {
                   element.style.display = 'block';
               });
           });
       @endif

       @if (isset($detail) || isset($error))
           var salesElements = document.querySelectorAll('.sales');
           document.getElementById('yes').addEventListener('click', function() {
               salesElements.forEach(function(element) {
                   element.style.display = 'none';
               });
           });
           document.getElementById('no').addEventListener('click', function() {
               salesElements.forEach(function(element) {
                   element.style.display = 'block';
               });
           });
       @endif

       @if($myLang !== 'ar' )
           var type = document.getElementById('type').value;
           function setDisplay(selector, display) {
               document.querySelectorAll(selector).forEach(function(element) {
                   element.style.display = display;
               });
           }
           if (type == '1') {
               setDisplay('.dis_p', 'none');
               setDisplay('.given', 'block');
               setDisplay('.original', 'block');
               setDisplay('.dis', 'block');
               setDisplay('.dis2', 'none');
               setDisplay('.dis3', 'none');
               setDisplay('.p1', 'none');
               setDisplay('.p2', 'none');
               setDisplay('.p3', 'none');
               setDisplay('.p4', 'none');
               setDisplay('.multi', 'none');
               document.querySelectorAll('.mix').forEach(function(element) {
                   element.textContent = '%';
               });
               document.querySelectorAll('.fix').forEach(function(element) {
                   element.textContent = '(%)';
               });
               document.querySelectorAll('.firsts').forEach(function(element) {
                   element.textContent = '';
               });
           }
           document.getElementById('type').addEventListener('change', function() {
               var type = document.getElementById('type').value;
               function setDisplay(selector, display) {
                   document.querySelectorAll(selector).forEach(function(element) {
                       element.style.display = display;
                   });
               }

               if(type == '1'){
                   document.getElementById('off').removeAttribute('disabled');
                   document.getElementById('amount').removeAttribute('disabled');
                   setDisplay('.input_line', 'block');
               }else{
                   setDisplay('.input_line', 'none');
                   document.getElementById('off').removeAttribute('disabled');
                   document.getElementById('off').style.backgroundColor = 'white';
                   document.getElementById('amount').removeAttribute('disabled');
                   document.getElementById('amount').style.backgroundColor = 'white';
               }
               if(type == '4'){
                   setDisplay('.input_line', 'block');
               }
               if (type == '1') {
                   setDisplay('.input_line', 'block');
                   setDisplay('.dis_p', 'none');
                   setDisplay('.given', 'block');
                   setDisplay('.original', 'block');
                   setDisplay('.dis', 'block');
                   setDisplay('.dis2', 'none');
                   setDisplay('.dis3', 'none');
                   setDisplay('.p1', 'none');
                   setDisplay('.p2', 'none');
                   setDisplay('.p3', 'none');
                   setDisplay('.saving', 'block');
                   setDisplay('.pay', 'block');
                   setDisplay('.p4', 'none');
                   setDisplay('.multi', 'none');
                   document.querySelectorAll('.mix').forEach(function(element) {
                       element.textContent = '%';
                   });
                   document.querySelectorAll('.fix').forEach(function(element) {
                       element.textContent = '(%)';
                   });
                   document.querySelectorAll('.firsts').forEach(function(element) {
                       element.textContent = '';
                   });
               }
               if (type == '2') {
                   setDisplay('.input_line', 'none');
                   setDisplay('.saving', 'none');
                   setDisplay('.pay', 'none');
                   setDisplay('.dis_p', 'none');
                   setDisplay('.given', 'none');
                   setDisplay('.original', 'none');
                   setDisplay('.dis', 'block');
                   setDisplay('.dis2', 'none');
                   setDisplay('.dis3', 'none');
                   setDisplay('.p1', 'block');
                   setDisplay('.p2', 'block');
                   setDisplay('.p3', 'none');
                   setDisplay('.p4', 'none');
                   setDisplay('.multi', 'none');

                   document.querySelectorAll('.mix').forEach(function(element) {
                       element.textContent = '%';
                   });
                   document.querySelectorAll('.fix').forEach(function(element) {
                       element.textContent = '(%)';
                   });
                   document.querySelectorAll('.firsts').forEach(function(element) {
                       element.textContent = '';
                   });

               }
               if (type == '3') {
                   setDisplay('.input_line', 'none');
                   setDisplay('.saving', 'none');
                   setDisplay('.pay', 'none');
                   setDisplay('.dis_p', 'none');
                   setDisplay('.given', 'none');
                   setDisplay('.original', 'none');
                   setDisplay('.dis', 'block');
                   setDisplay('.dis2', 'none');
                   setDisplay('.dis3', 'none');
                   setDisplay('.p1', 'block');
                   setDisplay('.p2', 'block');
                   setDisplay('.p3', 'block');
                   setDisplay('.p4', 'none');
                   setDisplay('.multi', 'none');
                   document.querySelectorAll('.mix').forEach(function(element) {
                       element.textContent = '%';
                   });
                   document.querySelectorAll('.fix').forEach(function(element) {
                       element.textContent = '(%)';
                   });
                   document.querySelectorAll('.firsts').forEach(function(element) {
                       element.textContent = '';
                   });
               }
               if (type == '4') {
                   setDisplay('.input_line', 'block');
                   setDisplay('.saving', 'block');
                   setDisplay('.pay', 'block');
                   setDisplay('.dis_p', 'none');
                   setDisplay('.given', 'none');
                   setDisplay('.original', 'block');
                   setDisplay('.dis', 'block');
                   setDisplay('.dis2', 'none');
                   setDisplay('.dis3', 'none');
                   setDisplay('.p1', 'none');
                   setDisplay('.p2', 'none');
                   setDisplay('.p3', 'none');
                   setDisplay('.p4', 'none');
                   setDisplay('.multi', 'none');
                   document.querySelectorAll('.mix').forEach(function(element) {
                       element.textContent = '$';
                   });
                   document.querySelectorAll('.fix').forEach(function(element) {
                       element.textContent = '';
                   });
                   document.querySelectorAll('.firsts').forEach(function(element) {
                       element.textContent = '';
                   });
               }
               if (type == '5') {
                   setDisplay('.saving', 'none');
                   setDisplay('.pay', 'none');
                   setDisplay('.dis_p', 'none');
                   setDisplay('.given', 'none');
                   setDisplay('.original', 'none');
                   setDisplay('.dis', 'none');
                   setDisplay('.dis2', 'none');
                   setDisplay('.dis3', 'none');
                   setDisplay('.p1', 'block');
                   setDisplay('.p2', 'block');
                   setDisplay('.p3', 'none');
                   setDisplay('.p4', 'none');
                   setDisplay('.multi', 'none');
               }
               if (type == '6') {
                   setDisplay('.saving', 'none');
                   setDisplay('.pay', 'none');
                   setDisplay('.dis_p', 'none');
                   setDisplay('.given', 'none');
                   setDisplay('.original', 'none');
                   setDisplay('.dis', 'none');
                   setDisplay('.dis2', 'none');
                   setDisplay('.dis3', 'none');
                   setDisplay('.p1', 'block');
                   setDisplay('.p2', 'block');
                   setDisplay('.p3', 'block');
                   setDisplay('.p4', 'none');
                   setDisplay('.multi', 'none');
               }
               if (type == '7') {
                   setDisplay('.saving', 'none');
                   setDisplay('.pay', 'none');
                   setDisplay('.dis_p', 'none');
                   setDisplay('.given', 'none');
                   setDisplay('.original', 'none');
                   setDisplay('.dis', 'none');
                   setDisplay('.dis2', 'none');
                   setDisplay('.dis3', 'none');
                   setDisplay('.p1', 'block');
                   setDisplay('.p2', 'block');
                   setDisplay('.p3', 'block');
                   setDisplay('.p4', 'block');
                   setDisplay('.multi', 'none');

               }
               if (type == '8') {
                   setDisplay('.saving', 'none');
                   setDisplay('.pay', 'none');
                   setDisplay('.dis_p', 'none');
                   setDisplay('.given', 'none');
                   setDisplay('.original', 'block');
                   setDisplay('.dis', 'block');
                   setDisplay('.dis2', 'block');
                   setDisplay('.dis3', 'none');
                   setDisplay('.p1', 'none');
                   setDisplay('.p2', 'none');
                   setDisplay('.p3', 'none');
                   setDisplay('.p4', 'none');
                   setDisplay('.multi', 'none');
                   document.querySelectorAll('.mix').forEach(function(element) {
                       element.textContent = '%';
                   });
                   document.querySelectorAll('.fix').forEach(function(element) {
                       element.textContent = '(%)';
                   });
                   document.querySelectorAll('.firsts').forEach(function(element) {
                       element.textContent = '1st';
                   });
               }
               if (type == '9') {
                   setDisplay('.saving', 'none');
                   setDisplay('.pay', 'none');
                   setDisplay('.dis_p', 'none');
                   setDisplay('.given', 'none');
                   setDisplay('.original', 'block');
                   setDisplay('.dis', 'block');
                   setDisplay('.dis2', 'block');
                   setDisplay('.dis3', 'block');
                   setDisplay('.p1', 'none');
                   setDisplay('.p2', 'none');
                   setDisplay('.p3', 'none');
                   setDisplay('.p4', 'none');
                   setDisplay('.multi', 'none');
                   document.querySelectorAll('.mix').forEach(function(element) {
                       element.textContent = '%';
                   });
                   document.querySelectorAll('.fix').forEach(function(element) {
                       element.textContent = '(%)';
                   });
                   document.querySelectorAll('.firsts').forEach(function(element) {
                       element.textContent = '1st ';
                   });

               }
               if (type == '10') {
                   setDisplay('.saving', 'none');
                   setDisplay('.pay', 'none');
                   setDisplay('.dis_p', 'none');
                   setDisplay('.given', 'none');
                   setDisplay('.original', 'none');
                   setDisplay('.dis', 'none');
                   setDisplay('.dis2', 'none');
                   setDisplay('.dis3', 'none');
                   setDisplay('.p1', 'none');
                   setDisplay('.p2', 'none');
                   setDisplay('.p3', 'none');
                   setDisplay('.p4', 'none');
                   setDisplay('.multi', 'block');
               }
           });
           function checkInputs() {
               const inputs = [
                   document.getElementById('amount'),
                   document.getElementById('off'),
                   document.getElementById('pay'),
                   document.getElementById('saving'),
               ];

               let filledCount = 0;
               inputs.forEach(input => {
                   if (input.value.trim() !== '') {
                       filledCount++;
                   }
               });

               if (filledCount === 2) {
                   inputs.forEach(input => {
                       if (input.value.trim() === '') {
                           input.disabled = true;
                           input.style.backgroundColor = 'gainsboro';
                       }
                   });
               } else {
                   inputs.forEach(input => {
                       input.disabled = false;
                       input.style.backgroundColor = '';
                   });
               }
           }

       @endif

       @if (isset($detail) || isset($error))
           var type = "{{ $_POST['type'] }}";
           if (type == '1') {
               setDisplay('.input_line', 'block');
               setDisplay('.dis_p', 'none');
               setDisplay('.given', 'block');
               setDisplay('.original', 'block');
               setDisplay('.dis', 'block');
               setDisplay('.dis2', 'none');
               setDisplay('.dis3', 'none');
               setDisplay('.p1', 'none');
               setDisplay('.p2', 'none');
               setDisplay('.p3', 'none');
               setDisplay('.saving', 'block');
               setDisplay('.pay', 'block');
               setDisplay('.p4', 'none');
               setDisplay('.multi', 'none');
               document.querySelectorAll('.mix').forEach(function(element) {
                   element.textContent = '%';
               });
               document.querySelectorAll('.fix').forEach(function(element) {
                   element.textContent = '(%)';
               });
               document.querySelectorAll('.firsts').forEach(function(element) {
                   element.textContent = '';
               });
           }
           if (type == '2') {
               setDisplay('.saving', 'none');
               setDisplay('.pay', 'none');
               setDisplay('.dis_p', 'none');
               setDisplay('.given', 'none');
               setDisplay('.original', 'none');
               setDisplay('.dis', 'block');
               setDisplay('.dis2', 'none');
               setDisplay('.dis3', 'none');
               setDisplay('.p1', 'block');
               setDisplay('.p2', 'block');
               setDisplay('.p3', 'none');
               setDisplay('.p4', 'none');
               setDisplay('.multi', 'none');
               setDisplay('.input_line', 'none');

               document.querySelectorAll('.mix').forEach(function(element) {
                   element.textContent = '%';
               });
               document.querySelectorAll('.fix').forEach(function(element) {
                   element.textContent = '(%)';
               });
               document.querySelectorAll('.firsts').forEach(function(element) {
                   element.textContent = '';
               });

           }
           if (type == '3') {
               setDisplay('.input_line', 'none');

               setDisplay('.saving', 'none');
               setDisplay('.pay', 'none');
               setDisplay('.dis_p', 'none');
               setDisplay('.given', 'none');
               setDisplay('.original', 'none');
               setDisplay('.dis', 'block');
               setDisplay('.dis2', 'none');
               setDisplay('.dis3', 'none');
               setDisplay('.p1', 'block');
               setDisplay('.p2', 'block');
               setDisplay('.p3', 'block');
               setDisplay('.p4', 'none');
               setDisplay('.multi', 'none');
               document.querySelectorAll('.mix').forEach(function(element) {
                   element.textContent = '%';
               });
               document.querySelectorAll('.fix').forEach(function(element) {
                   element.textContent = '(%)';
               });
               document.querySelectorAll('.firsts').forEach(function(element) {
                   element.textContent = '';
               });
           }
           if (type == '4') {
               setDisplay('.input_line', 'block');

               setDisplay('.saving', 'block');
               setDisplay('.pay', 'block');
               setDisplay('.dis_p', 'none');
               setDisplay('.given', 'none');
               setDisplay('.original', 'block');
               setDisplay('.dis', 'block');
               setDisplay('.dis2', 'none');
               setDisplay('.dis3', 'none');
               setDisplay('.p1', 'none');
               setDisplay('.p2', 'none');
               setDisplay('.p3', 'none');
               setDisplay('.p4', 'none');
               setDisplay('.multi', 'none');
               document.querySelectorAll('.mix').forEach(function(element) {
                   element.textContent = '$';
               });
               document.querySelectorAll('.fix').forEach(function(element) {
                   element.textContent = '';
               });
               document.querySelectorAll('.firsts').forEach(function(element) {
                   element.textContent = '';
               });
           }
           if (type == '5') {
               setDisplay('.saving', 'none');
               setDisplay('.pay', 'none');
               setDisplay('.dis_p', 'none');
               setDisplay('.given', 'none');
               setDisplay('.original', 'none');
               setDisplay('.dis', 'none');
               setDisplay('.dis2', 'none');
               setDisplay('.dis3', 'none');
               setDisplay('.p1', 'block');
               setDisplay('.p2', 'block');
               setDisplay('.p3', 'none');
               setDisplay('.p4', 'none');
               setDisplay('.multi', 'none');
               setDisplay('.input_line', 'none');

           }
           if (type == '6') {
               setDisplay('.input_line', 'none');
               setDisplay('.saving', 'none');
               setDisplay('.pay', 'none');
               setDisplay('.dis_p', 'none');
               setDisplay('.given', 'none');
               setDisplay('.original', 'none');
               setDisplay('.dis', 'none');
               setDisplay('.dis2', 'none');
               setDisplay('.dis3', 'none');
               setDisplay('.p1', 'block');
               setDisplay('.p2', 'block');
               setDisplay('.p3', 'block');
               setDisplay('.p4', 'none');
               setDisplay('.multi', 'none');
           }
           if (type == '7') {
               setDisplay('.saving', 'none');
               setDisplay('.pay', 'none');
               setDisplay('.dis_p', 'none');
               setDisplay('.given', 'none');
               setDisplay('.original', 'none');
               setDisplay('.dis', 'none');
               setDisplay('.dis2', 'none');
               setDisplay('.dis3', 'none');
               setDisplay('.p1', 'block');
               setDisplay('.p2', 'block');
               setDisplay('.p3', 'block');
               setDisplay('.p4', 'block');
               setDisplay('.multi', 'none');
               setDisplay('.input_line', 'none');
           }
           if (type == '8') {
               setDisplay('.saving', 'none');
               setDisplay('.pay', 'none');
               setDisplay('.dis_p', 'none');
               setDisplay('.given', 'none');
               setDisplay('.original', 'block');
               setDisplay('.dis', 'block');
               setDisplay('.dis2', 'block');
               setDisplay('.dis3', 'none');
               setDisplay('.p1', 'none');
               setDisplay('.p2', 'none');
               setDisplay('.p3', 'none');
               setDisplay('.p4', 'none');
               setDisplay('.multi', 'none');
               setDisplay('.input_line', 'none');

               document.querySelectorAll('.mix').forEach(function(element) {
                   element.textContent = '%';
               });
               document.querySelectorAll('.fix').forEach(function(element) {
                   element.textContent = '(%)';
               });
               document.querySelectorAll('.firsts').forEach(function(element) {
                   element.textContent = '1st';
               });
           }
           if (type == '9') {
               setDisplay('.saving', 'none');
               setDisplay('.pay', 'none');
               setDisplay('.dis_p', 'none');
               setDisplay('.given', 'none');
               setDisplay('.original', 'block');
               setDisplay('.dis', 'block');
               setDisplay('.dis2', 'block');
               setDisplay('.dis3', 'block');
               setDisplay('.p1', 'none');
               setDisplay('.p2', 'none');
               setDisplay('.p3', 'none');
               setDisplay('.p4', 'none');
               setDisplay('.multi', 'none');
               setDisplay('.input_line', 'none');

               document.querySelectorAll('.mix').forEach(function(element) {
                   element.textContent = '%';
               });
               document.querySelectorAll('.fix').forEach(function(element) {
                   element.textContent = '(%)';
               });
               document.querySelectorAll('.firsts').forEach(function(element) {
                   element.textContent = '1st ';
               });

           }
           if (type == '10') {
               setDisplay('.saving', 'none');
               setDisplay('.pay', 'none');
               setDisplay('.dis_p', 'none');
               setDisplay('.given', 'none');
               setDisplay('.original', 'none');
               setDisplay('.dis', 'none');
               setDisplay('.dis2', 'none');
               setDisplay('.dis3', 'none');
               setDisplay('.p1', 'none');
               setDisplay('.p2', 'none');
               setDisplay('.p3', 'none');
               setDisplay('.p4', 'none');
               setDisplay('.multi', 'block');
               setDisplay('.input_line', 'none');

           }

           function checkInputs() {
               const inputs = [
                   document.getElementById('amount'),
                   document.getElementById('off'),
                   document.getElementById('pay'),
                   document.getElementById('saving'),
               ];

               let filledCount = 0;
               inputs.forEach(input => {
                   if (input.value.trim() !== '') {
                       filledCount++;
                   }
               });

               if (filledCount === 2) {
                   inputs.forEach(input => {
                       if (input.value.trim() === '') {
                           input.disabled = true;
                           input.style.backgroundColor = 'gainsboro';
                       }
                   });
               } else {
                   inputs.forEach(input => {
                       input.disabled = false;
                       input.style.backgroundColor = '';
                   });
               }
           }
           document.addEventListener('DOMContentLoaded', function() {
               checkInputs();
               checkInput();
           });
       @endif
   </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>