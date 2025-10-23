<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        
                <input type="hidden" name="unit_type" id="unit_type" value="uk">
                <div class="flex flex-wrap items-center bg-blue-100 border  border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="imperial">
                            {{$lang['uk']}}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="metric">
                            {{$lang['aus']}}
                        </div>
                    </div>
                </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-4 gap-4" id="test2">
                <div class="space-y-2">
                    <label for="uk_method" class="font-s-14 text-blue">{{ $lang['t_cal'] }}:</label>
                    <select name="uk_method" id="uk_method" class="input">
                        <option value="single" {{ isset($_POST['uk_method']) && $_POST['uk_method']=='single'?'selected':''}}  >{{$lang['s'] }}</option>
                        <option value="add" {{ isset($_POST['uk_method']) && $_POST['uk_method']=='add'?'selected':''}}  >{{ $lang['a']}}</option>
                        <option value="first" {{ isset($_POST['uk_method']) && $_POST['uk_method']=='first'?'selected':''}}  >{{ $lang['f'] }}</option>
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="value" class="font-s-14 text-blue">{{ $lang['purchase_price'] }}:</label>
                    <input type="number" step="any" class="input" name="value" id="value" value="{{ isset($_POST['value'])?$_POST['value']:'5000000' }}" placeholder="5000000">
                    <span class=" input_unit">£</span>
                </div>
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-4  gap-4 hidden"  id="test1">

                <div class="space-y-2 relative">
                    <label for="ausval" class="font-s-14 text-blue">{{ $lang['purchase_price'] }}:</label>
                    <input type="number" step="any" id="ausval" class="input" name="ausval" value="{{ isset($_POST['ausval'])?$_POST['ausval']:'20' }}" placeholder="20">
                    <span class=" input_unit">£</span>
                </div>
                <div class="space-y-2 relative">
                    <label for="aus_method" class="font-s-14 text-blue">{{ $lang['state'] }}:</label>
                    <select name="aus_method" id="aus_method" class="input">
                        <option value="nsw" {{ isset($_POST['aus_method']) && $_POST['aus_method']=='nsw'?'selected':''}} >{{$lang['nsw']}}</option>
                        <option value="act" {{ isset($_POST['aus_method']) && $_POST['aus_method']=='act'?'selected':''}} >{{$lang['act']}}</option>
                        <option value="nt" {{ isset($_POST['aus_method']) && $_POST['aus_method']=='nt'?'selected':''}} >{{$lang['nt']}}</option>
                        <option value="qld" {{ isset($_POST['aus_method']) && $_POST['aus_method']=='qld'?'selected':''}} >{{$lang['qld']}}</option>
                        <option value="sa"  {{ isset($_POST['aus_method']) && $_POST['aus_method']=='sa'?'selected':''}} >{{$lang['sa']}}</option>
                        <option value="tas" {{ isset($_POST['aus_method']) && $_POST['aus_method']=='tas'?'selected':''}} >{{$lang['tas']}}</option>
                        <option value="vic" {{ isset($_POST['aus_method']) && $_POST['aus_method']=='vic'?'selected':''}} >{{$lang['vic']}}</option>
                        <option value="wa" {{ isset($_POST['aus_method']) && $_POST['aus_method']=='wa'?'selected':''}} >{{$lang['wa']}}</option>
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="first" class="font-s-14 text-blue">{{ $lang['f'] }}:</label>
                    <select name="first" id="first" class="input">
                        <option value="no" {{ isset($first)=='no'?'selected':''}} >{{ $lang['no']}}</option>
                        <option value="yes" {{ isset($first)=='yes'?'selected':''}} >{{ $lang['yes']}}</option>
                    </select>
                </div>
                <div class="space-y-2 relative">
                    <label for="property" class="font-s-14 text-blue">{{ $lang['property'] }}:</label>
                    <select name="property" id="property" class="input">
                        <option value="live" {{ isset($_POST['property']) && $_POST['property']=='live'?'selected':''}} >{{ $lang['pa']}}</option>
                        <option value="invest" {{ isset($_POST['property']) && $_POST['property']=='invest'?'selected':''}} >{{ $lang['pb']}}</option>
                        <option value="land" {{ isset($_POST['property']) && $_POST['property']=='land'?'selected':''}} >{{ $lang['pc']}}</option>
                    </select>
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
                    <div class="w-full lg:p-3 md:p-3 rounded-lg mt-3">
                        @if(isset($detail['Add']))
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b" style="width: 70%"><strong>{{ $lang['stamp_duty'] }} </strong></td>
                                    <td class="py-2 border-b">
                                        @if(isset($detail['stamp_duty']))
                                        {{"£".$detail['stamp_duty']}}
                                        @else
                                        £0
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" style="width: 70%"><strong>{{ $lang['effective_data'] }} </strong></td>
                                    <td class="py-2 border-b">
                                        @if(isset($detail['percent']))
                                        {{ $detail['percent']."%" }}
                                        @else
                                        0%
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto  mt-2">
                            <table class="w-full text-base">
                                <tr>
                                    <td class="py-2 border-b font-bold">{{ $lang['tax_bnad']}}</td>
                                    <td class="py-2 border-b font-bold">%</td>
                                    <td class="py-2 border-b font-bold">{{ $lang['taxable_sum']}}</td>
                                    <td class="py-2 border-b font-bold">{{ $lang['tax']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">less than £125k</td>
                                    <td class="py-2 border-b">0</td>
                                    @if ($detail['a'] != '')
                                    <td class="py-2 border-b">£ {{ $detail['as'] }}</td>
                                    <td class="py-2 border-b">£{{ $detail['a'] }}</td>
                                    @else
                                    <td class="py-2 border-b">£0</td>
                                    <td class="py-2 border-b">£0</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">£125k to £250k</td>
                                    <td class="py-2 border-b">2</td>
                                    @if ($detail['b'] != '')
                                    <td class="py-2 border-b">£{{ $detail['bs'] }}</td>
                                    <td class="py-2 border-b">£{{ $detail['b'] }}</td>
                                    @else
                                    <td class="py-2 border-b">£0</td>
                                    <td class="py-2 border-b">£0</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">£250k to £925k</td>
                                    <td class="py-2 border-b">5</td>
                                    @if ($detail['c'] != '')
                                    <td class="py-2 border-b">£{{ $detail['cs'] }}</td>
                                    <td class="py-2 border-b">£{{ $detail['c'] }}</td>
                                    @else
                                    <td class="py-2 border-b">£0</td>
                                    <td class="py-2 border-b">£0</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">£925k to £1.5m</td>
                                    <td class="py-2 border-b">10</td>
                                    @if ($detail['d'] != '')
                                    <td class="py-2 border-b">£{{ $detail['ds'] }}</td>
                                    <td class="py-2 border-b">£{{ $detail['d'] }}</td>
                                    @else
                                    <td class="py-2 border-b">£0</td>
                                    <td class="py-2 border-b">£0</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">rest over £1.5m</td>
                                    <td class="py-2 border-b">12</td>
                                    @if ($detail['e'] != '')
                                    <td class="py-2 border-b">£{{ $detail['es'] }}</td>
                                    <td class="py-2 border-b">£{{ $detail['e'] }}</td>
                                    @else
                                    <td class="py-2 border-b">£0</td>
                                    <td class="py-2 border-b">£0</td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                        @endif
                        @if(isset($detail['Sub']))
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto  mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b"><p>{{ $lang['t_a']}}</p></td>
                                    <td class="py-2 border-b"><b>{{ (($detail['aus_a']!='')? "$".$detail['aus_a']:'$0.0')}}</b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><p>{{ $lang['1st_ans']}}</p></td>
                                    <td class="py-2 border-b"><b>{{ (($detail['aus_b']!='')? "$".$detail['aus_b']:'$0.0')}}</b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><p>{{ $lang['2nd_ans']}}</p></td>
                                    <td class="py-2 border-b"><b>{{ (($detail['aus_c']!='')? "$".$detail['aus_c']:'$0.0')}}</b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><p>{{ $lang['3rd_ans']}}</p></td>
                                    <td class="py-2 border-b"><b>{{ (($detail['aus_d']!='')? "$".$detail['aus_d']:'$0.0')}}</b></td>
                                </tr>
                            </table>
                        </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
</form>

@push('calculatorJS')

<script>
@if(isset($detail))
 @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'uk')
        document.querySelectorAll('.imperial').forEach(function(element) {
        document.getElementById('imperial').classList.add('tagsUnit')
            document.querySelectorAll('.metric').forEach(function(metricElement) {
                metricElement.classList.remove('tagsUnit')
            })
            document.getElementById('unit_type').value = "uk"
            var priceElasticity = document.getElementById('test1');
            var revenue = document.getElementById('test2');
            
            if (priceElasticity && revenue) {
                priceElasticity.classList.add('d-none');
                revenue.classList.remove('d-none');
            }
        })
@endif
@if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'aus')
        document.querySelectorAll('.metric').forEach(function(element) {
            document.getElementById('metric').classList.add('tagsUnit')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "aus"
                var priceElasticity = document.getElementById('test1');
                var revenue = document.getElementById('test2');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.remove('hidden');
                    revenue.classList.add('hidden');
                }
        })
        @endif
@endisset

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.imperial').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.metric').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "uk"
                var priceElasticity = document.getElementById('test1');
                var revenue = document.getElementById('test2');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
                }
            })
        })
        document.querySelectorAll('.metric').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
              
                document.getElementById('unit_type').value = "aus"
                var priceElasticity = document.getElementById('test1');
                var revenue = document.getElementById('test2');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.remove('hidden');
                    revenue.classList.add('hidden');
                }
            })
        })
    });


    
@if(isset($error))
var type = "{{$_POST['unit_type']}}";
if (type == "uk") {
    document.querySelectorAll('.imperial').forEach(function(element) {
        document.getElementById('imperial').classList.add('tagsUnit')
            document.querySelectorAll('.metric').forEach(function(metricElement) {
                metricElement.classList.remove('tagsUnit')
            })
            document.getElementById('unit_type').value = "uk"
            var priceElasticity = document.getElementById('test1');
            var revenue = document.getElementById('test2');
            
            if (priceElasticity && revenue) {
                priceElasticity.classList.add('hidden');
                revenue.classList.remove('hidden');
            }
        })
        } else {
            document.querySelectorAll('.metric').forEach(function(element) {
            document.getElementById('metric').classList.add('tagsUnit')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "aus"
                var priceElasticity = document.getElementById('test1');
                var revenue = document.getElementById('test2');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.remove('hidden');
                    revenue.classList.add('hidden');
                }
        })
        }
 @endif

</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>