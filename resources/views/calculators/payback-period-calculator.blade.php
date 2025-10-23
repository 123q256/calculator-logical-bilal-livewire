<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @if (isset($error))
           <div class="col-12 p-2 mt-lg-3">
               <div class="row align-items-center bg-white text-center border radius-10 p-1">
                   @if($_POST['unit_type'] == 'same')
                   <div class="lg:w-1/2 w-full px-1 py-1">
                    <div class="bg-white px-1 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit same" id="same">
                        {{$lang['1']}}
                    </div>
                </div>
                   @else
                   <div class="lg:w-1/2 w-full px-1 py-1">
                    <div class="bg-white px-1 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  same" id="same">
                        {{$lang['1']}}
                    </div>
                </div>
                   @endif

                   @if($_POST['unit_type'] == 'not_same')
                   <div class="lg:w-1/2 w-full px-1 py-1">
                    <div class="bg-white px-1 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit not_same" id="not_same">
                            {{ $lang['8'] }}
                    </div>
                </div>
                   @else
                   <div class="lg:w-1/2 w-full px-1 py-1">
                    <div class="bg-white px-1 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  not_same" id="not_same">
                            {{ $lang['8'] }}
                    </div>
                </div>
                   @endif
               </div>
           </div>
           @else
               @if(isset($detail))
               <div class="col-12 mx-auto mt-2 w-full">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    @if($_POST['unit_type'] == 'same')
                    <div class="lg:w-1/2 w-full px-1 py-1">
                        <div class="bg-white px-1 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit same" id="same">
                            {{$lang['1']}}
                        </div>
                    </div>
                    @elseif($_POST['unit_type'] == '')
                    <div class="lg:w-1/2 w-full px-1 py-1">
                        <div class="bg-white px-1 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit same" id="same">
                            {{$lang['1']}}
                        </div>
                    </div>
                    @else
                    <div class="lg:w-1/2 w-full px-1 py-1">
                        <div class="bg-white px-1 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  same" id="same">
                            {{$lang['1']}}
                        </div>
                    </div>
                    @endif

                    @if($_POST['unit_type'] == 'not_same')
                    <div class="lg:w-1/2 w-full px-1 py-1">
                        <div class="bg-white px-1 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit not_same" id="not_same">
                                {{ $lang['8'] }}
                        </div>
                    </div>
                    @else
                    <div class="lg:w-1/2 w-full px-1 py-1">
                        <div class="bg-white px-1 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white not_same" id="not_same">
                                {{ $lang['8'] }}
                        </div>
                    </div>

                    @endif

                 </div>
              </div>
               @else
               <div class="col-12 mx-auto mt-2 w-full">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-1 py-1">
                            <div class="bg-white px-1 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit same" id="same">
                                {{$lang['1']}}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-1 py-1">
                            <div class="bg-white px-1 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white not_same" id="not_same">
                                    {{ $lang['8'] }}
                            </div>
                        </div>
                    </div>
              </div>
               @endif
           @endif
           <input type="hidden" name="unit_type" id="unit_type" value="same">
           <input type="hidden" name="currancy" value="{{$currancy}}">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 " id="firsts">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <p class="py-2 col-span-12"><strong>{{ $lang[1]}}</strong></p>
                        <div class="col-span-6">
                            <label for="initial" class="label">{{ $lang['2'] }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="initial" id="initial" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['initial'])?$_POST['initial']:'100000' }}" min="1" />
                                <span class="text-blue input_unit">{{ $currancy}}</span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="cash" class="label">{{ $lang['4'] }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="cash" id="cash" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['cash'])?$_POST['cash']:'30000' }}" min="1" />
                                <span class="text-blue input_unit">/ year</span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="add_sub" class="label">&nbsp;</label>
                            <div class="w-full py-2 relative">
                                <select class="input" name="add_sub" id="add_sub">
                                    <option value="in"  {{ isset($_POST['add_sub']) && $_POST['add_sub']=='in'?'selected':''}}> {{$lang['5']}} </option>
                                    <option value="de"  {{ isset($_POST['add_sub']) && $_POST['add_sub']=='de'?'selected':''}}> {{$lang['6']}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="in_de" class="label">{{ $lang['4'] }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="in_de" id="in_de" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['in_de'])?$_POST['in_de']:'5' }}" min="0" />
                                <span class="text-blue input_unit">% / year</span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="year" class="label">{{ $lang['7'] }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" name="year" id="year" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['year'])?$_POST['year']:'5' }}" min="1" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="discount" class="label">{{ $lang['3'] }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="discount" id="discount" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['discount'])?$_POST['discount']:'5' }}" min="1" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 hidden" id="second">
                    <div class="grid grid-cols-12 mt-3  gap-4  more_years" >
                        <input type="hidden" name="currancy1" value="{{$currancy}}">
                        <input type="hidden" name="count" id="count" value="6">
                        <p class="col-span-12"><strong>{{ $lang[8]}}</strong></p>
                        <div class="col-span-6">
                            <label for="initial2" class="label">{{ $lang['2'] }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="initial2" id="initial2" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['initial2'])?$_POST['initial2']:'5' }}" min="1" />
                                <span class="text-blue input_unit">{{ $currancy}}</span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="discount2" class="label">{{ $lang['3'] }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="discount2" id="discount2" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['discount2'])?$_POST['discount2']:'5' }}" min="1" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                        <p class="col-span-12"><strong>{{ $lang[4]}}</strong></p>
                        <div class="col-span-6">
                            <label for="year1" class="label">{{ $lang['9'] }} 1</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="year1" id="year1" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['year1'])?$_POST['year1']:'5' }}" min="1" />
                                <span class="text-blue input_unit">{{ $currancy}}</span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="year2" class="label">{{ $lang['9'] }} 2</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="year2" id="year2" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['year2'])?$_POST['year2']:'5' }}" min="1" />
                                <span class="text-blue input_unit">{{ $currancy}}</span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="year3" class="label">{{ $lang['9'] }} 3</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="year3" id="year3" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['year3'])?$_POST['year3']:'5' }}" min="1" />
                                <span class="text-blue input_unit">{{ $currancy}}</span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="year4" class="label">{{ $lang['9'] }} 4</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="year4" id="year4" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['year4'])?$_POST['year4']:'5' }}" min="1" />
                                <span class="text-blue input_unit">{{ $currancy}}</span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="year5" class="label">{{ $lang['9'] }} 5</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="year5" id="year5" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['year5'])?$_POST['year5']:'5' }}" min="1" />
                                <span class="text-blue input_unit">{{ $currancy}}</span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="year6" class="label">{{ $lang['9'] }} 6</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="year6" id="year6" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['year6'])?$_POST['year6']:'5' }}" min="1" />
                                <span class="text-blue input_unit">{{ $currancy}}</span>
                            </div>
                        </div>

                        @isset($_POST['count'])
                        @for ($i = 6; $i < $_POST['count']; $i++)
                            <div class="col-span-6">
                                <label for="year{{$i+1}}" class="label">{{ $lang['9'] }} {{$i +1}}</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" name="year{{$i+1}}" id="year{{$i+1}}" class="input" aria-label="input" placeholder="00" value="{{$_POST['year'.($i+1)]}}" min="1" />
                                    <span class="text-blue input_unit">{{ $currancy}}</span>
                                </div>
                            </div>
                        @endfor
                    @endisset
                    
                    </div>
                    <div class="col-12 text-end mt-3">
                        <button type="button" name="submit" id="add_year" class="px-3 py-2 mx-1 addmore text-white  bg-[#2845F5] rounded-lg">{{$lang[10]}}</button>
                    </div>
                </div>
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
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full mt-2">
                        <table class="w-full font-s-18">
                            @if(isset($detail['not_back']))
                            <p class="mt-2">{{ $lang[11] }} <strong> {{$detail['ave_i']}} years</strong> {{$lang[12]}}  <strong> {{$currancy.$detail['ave_cash']}} / year</strong> </p>
                            <p> {{$lang[13]}} <strong>{{$detail['ave_i']}} </strong> {{$lang[14]}} </strong>{{$detail['back']}} years</p></p>
                           @else
                           <tr>
                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[15] }} </td>
                             <td class="py-2 border-b">  {{$detail['back']}}  years</td>
                            </tr>
                         @endif
                         @if(isset($detail['dis_not_back']))
                         <p class="mt-2">{{ $lang[16] }} {{$_POST['discount2']}}%, {{$lang[17]}}  <strong>{{$detail['ave_i']}} years</strong> {{$lang[18]}} <strong>{{$currancy.$detail['ave_cash_d']}} / year</strong></p>
                         <p>{{$lang[13]}}<strong> {{$detail['ave_i']}} </strong> {{$lang[14]}} <strong class="">{{$detail['dis_back']}} years</strong></p>
                        @else
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[19] }} </td>
                                <td class="py-2 border-b">  {{$detail['dis_back']}}  years</td>
                            </tr>
                        @endif
                        </table>
                  </div>
                    <div class="w-full md:w-[60%] lg:w-[60%]  text-[14px] mt-3 overflow-auto">
                            <table class="w-full ">
                                <tr class="">
                                    <td class="py-2 border-b"><strong>Years</strong></td>
                                    <td class="py-2 border-b"><strong>{{$lang[4]}}</strong></td>
                                    <td class="py-2 border-b"><strong>{{$lang[20]}}</strong></td>
                                    <td class="py-2 border-b"><strong>{{$lang[21]}}</strong></td>
                                    <td class="py-2 border-b"><strong>{{$lang[22]}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">Year 0</td>
                                    <td class="py-2 border-b">{{$currancy}}-{{number_format($detail['total'],2)}}</td>
                                    <td class="py-2 border-b">{{$currancy}}-{{number_format($detail['total'],2)}}</td>
                                    <td class="py-2 border-b">{{$currancy}}-{{number_format($detail['total'],2)}}</td>
                                    <td class="py-2 border-b">{{$currancy}}-{{number_format($detail['total'],2)}}</td>
                                </tr>
                                {!!$detail['table'] !!}
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script>

 @if(isset($error))
       // Define your initial value for j
   var numbers = {{$_POST['count']+1}};
        if(numbers){
            var j = numbers;
        }else{
            var j=7;
        }
function add_year(i) {
    var lang_9 = "Year"; 
    var currency = "$";  
    var html = '<div class="col-span-6">' +
        '<label for="year' + i + '" class="label">' + lang_9 + ' ' + i + '</label>' +
        '<div class="w-full py-2 relative">' +
        '<input type="number" step="any" name="year' + i + '" id="year' + i + '" class="input" aria-label="input" placeholder="00" value="50" min="1" />' +
        '<span class="text-blue input_unit">' + currency + '</span>' +
        '</div>' +
        '</div>';
    document.querySelector('.more_years').insertAdjacentHTML('beforeend', html);
    document.getElementById('count').value = i;
    j++;
}
document.getElementById('add_year').addEventListener('click', function() {
    add_year(j);
});
      

@elseif(isset($detail))
   var numbers = {{$_POST['count']+1}};
        if(numbers){
            var j = numbers;
        }else{
            var j=7;
        }
function add_year(i) {
    var lang_9 = "Year"; 
    var currency = "$"; 
    var html = '<div class="col-span-6">' +
        '<label for="year' + i + '" class="label">' + lang_9 + ' ' + i + '</label>' +
        '<div class="w-full py-2 relative">' +
        '<input type="number" step="any" name="year' + i + '" id="year' + i + '" class="input" aria-label="input" placeholder="00" value="50" min="1" />' +
        '<span class="text-blue input_unit">' + currency + '</span>' +
        '</div>' +
        '</div>';
    document.querySelector('.more_years').insertAdjacentHTML('beforeend', html);
    document.getElementById('count').value = i;
    j++;
}
document.getElementById('add_year').addEventListener('click', function() {
    add_year(j);
});
      

@else
var j = 7;
function add_year(i) {
    var lang_9 = "Year"; 
    var currency = "$";  
    var html = '<div class="col-span-6">' +
        '<label for="year' + i + '" class="label">' + lang_9 + ' ' + i + '</label>' +
        '<div class="w-full py-2 relative">' +
        '<input type="number" step="any" name="year' + i + '" id="year' + i + '" class="input" aria-label="input" placeholder="00" value="50" min="1" />' +
        '<span class="text-blue input_unit">' + currency + '</span>' +
        '</div>' +
        '</div>';
    document.querySelector('.more_years').insertAdjacentHTML('beforeend', html);
    document.getElementById('count').value = i;
    j++;
}
document.getElementById('add_year').addEventListener('click', function() {
    add_year(j);
});
@endif

@if(isset($detail))
 @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'same')
            document.querySelectorAll('.not_same').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "same"
                var firsts = document.getElementById('firsts');
                var second = document.getElementById('second');
                
                if (firsts && second) {
                    firsts.classList.remove('hidden');
                    second.classList.add('hidden');
                }
@endif
@if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'not_same')
document.querySelectorAll('.same').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
              
                document.getElementById('unit_type').value = "not_same"
                var firsts = document.getElementById('firsts');
                var second = document.getElementById('second');
                
                if (firsts && second) {
                    firsts.classList.add('hidden');
                    second.classList.remove('hidden');
                }
 @endif
@endisset


@if(isset($error))
 @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'same')
            document.querySelectorAll('.not_same').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "same"
                var firsts = document.getElementById('firsts');
                var second = document.getElementById('second');
                
                if (firsts && second) {
                    firsts.classList.remove('hidden');
                    second.classList.add('hidden');
                }
@endif
@if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'not_same')
document.querySelectorAll('.same').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
              
                document.getElementById('unit_type').value = "not_same"
                var firsts = document.getElementById('firsts');
                var second = document.getElementById('second');
                
                if (firsts && second) {
                    firsts.classList.add('hidden');
                    second.classList.remove('hidden');
                }
 @endif
@endisset

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.same').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.not_same').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "same"
                var firsts = document.getElementById('firsts');
                var second = document.getElementById('second');
                
                if (firsts && second) {
                    firsts.classList.remove('hidden');
                    second.classList.add('hidden');
                }
            })
        })
        document.querySelectorAll('.not_same').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.same').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
              
                document.getElementById('unit_type').value = "not_same"
                var firsts = document.getElementById('firsts');
                var second = document.getElementById('second');
                
                if (firsts && second) {
                    firsts.classList.add('hidden');
                    second.classList.remove('hidden');
                }
            })
        })
    });
</script>