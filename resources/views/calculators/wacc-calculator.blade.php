<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @if (isset($error))
           <div class="col-12 mx-auto mt-2  w-full">
                <input type="hidden" name="unit_type" id="unit_type" value="lbs">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    @if($_POST['unit_type'] == 'capm')
                    <div class="lg:w-1/3 w-full px-1 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit test11" id="test11">
                            WACC Calculator
                        </div>
                    </div>
                    @elseif($_POST['unit_type'] == '')
                    <div class="lg:w-1/3 w-full px-1 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit test11" id="test11">
                            WACC Calculator
                        </div>
                    </div>
                    @else

                    <div class="lg:w-1/3 w-full px-1 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  test11" id="test11">
                            WACC Calculator
                        </div>
                    </div>

                    @endif


                    @if($_POST['unit_type'] == 'cd')
                    <div class="lg:w-1/3 w-full px-1 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags tagsUnit hover:text-white test12" id="test12">
                            Cost of Equity
                        </div>
                    </div>
                    @else
                    <div class="lg:w-1/3 w-full px-1 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white test12" id="test12">
                            Cost of Equity
                        </div>
                    </div>
                    @endif

                    @if($_POST['unit_type'] == 'debt')
                    <div class="lg:w-1/3 w-full px-1 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags tagsUnit hover:text-white test13" id="test13">
                            Cost of Debt
                        </div>
                    </div>
                    @else
                    <div class="lg:w-1/3 w-full px-1 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white test13" id="test13">
                            Cost of Debt
                        </div>
                    </div>
                    @endif
                
                
                </div>
            </div>
           @else
               @if(isset($detail))
                    <div class="col-12 mx-auto mt-2  w-full">
                            <input type="hidden" name="unit_type" id="unit_type" value="lbs">
                            <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                                @if($_POST['unit_type'] == 'capm')
                                <div class="lg:w-1/3 w-full px-1 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit test11" id="test11">
                                        WACC Calculator
                                    </div>
                                </div>
                                @elseif($_POST['unit_type'] == '')
                                <div class="lg:w-1/3 w-full px-1 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit test11" id="test11">
                                        WACC Calculator
                                    </div>
                                </div>
                                @else

                                <div class="lg:w-1/3 w-full px-1 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  test11" id="test11">
                                        WACC Calculator
                                    </div>
                                </div>

                                @endif


                                @if($_POST['unit_type'] == 'cd')
                                <div class="lg:w-1/3 w-full px-1 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags tagsUnit hover:text-white test12" id="test12">
                                        Cost of Equity
                                    </div>
                                </div>
                                @else
                                <div class="lg:w-1/3 w-full px-1 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white test12" id="test12">
                                        Cost of Equity
                                    </div>
                                </div>
                                @endif

                                @if($_POST['unit_type'] == 'debt')
                                <div class="lg:w-1/3 w-full px-1 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags tagsUnit hover:text-white test13" id="test13">
                                        Cost of Debt
                                    </div>
                                </div>
                                @else
                                <div class="lg:w-1/3 w-full px-1 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white test13" id="test13">
                                        Cost of Debt
                                    </div>
                                </div>
                                @endif
                            
                            
                            </div>
                    </div>
               @else
                <div class="col-12 mx-auto mt-2  w-full">
                            <input type="hidden" name="unit_type" id="unit_type" value="lbs">
                        <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                            <div class="lg:w-1/3 w-full px-1 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit test11" id="test11">
                                    WACC Calculator
                                </div>
                            </div>
                            <div class="lg:w-1/3 w-full px-1 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white test12" id="test12">
                                    Cost of Equity
                                </div>
                            </div>
                            <div class="lg:w-1/3 w-full px-1 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white test13" id="test13">
                                    Cost of Debt
                                </div>
                            </div>
                        </div>
                    </div>
               
               @endif
           @endif
        <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 " id="test1">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="a" class="font-s-14 text-blue">{{ $lang['a'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" class="input" name="a" id="a" value="{{ isset($_POST['a'])?$_POST['a']:'50000' }}" placeholder="00">
                            <span class="text-blue input_unit">{{$currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="b" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" class="input" name="b" id="b" value="{{ isset($_POST['b'])?$_POST['b']:'9' }}" placeholder="00">
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="c" class="font-s-14 text-blue">{{ $lang['c'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" class="input" name="c" id="c" value="{{ isset($_POST['c'])?$_POST['c']:'30000' }}" placeholder="00">
                            <span class="text-blue input_unit">{{$currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="d" class="font-s-14 text-blue">{{ $lang['d'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" class="input" name="d" id="d" value="{{ isset($_POST['d'])?$_POST['d']:'13' }}" placeholder="00">
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="e" class="font-s-14 text-blue">{{ $lang['e'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" class="input" name="e" id="e" value="{{ isset($_POST['e'])?$_POST['e']:'13' }}" placeholder="00">
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-span-12  hidden" id="test2">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <p class="col-span-12 px-2"><strong>{{ $lang['capm']}}</strong></p>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="risk" class="font-s-14 text-blue">{{ $lang['risk'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" class="input" name="risk" id="risk" value="{{ isset($_POST['risk'])?$_POST['risk']:'13' }}" placeholder="00">
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="beta" class="font-s-14 text-blue">{{ $lang['beta'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" class="input" name="beta" id="beta" value="{{ isset($_POST['beta'])?$_POST['beta']:'13' }}" placeholder="00">
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="eq" class="font-s-14 text-blue">{{ $lang['erisk'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" class="input" name="eq" id="eq" value="{{ isset($_POST['eq'])?$_POST['eq']:'13' }}" placeholder="00">
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-span-12  hidden" id="test3">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <p class="col-span-12 px-2"><strong>{{ $lang['cd']}} {{ $lang['calculator']}}</strong></p>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="rate" class="font-s-14 text-blue">{{ $lang['int'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" class="input" name="rate" id="rate" value="{{ isset($_POST['rate'])?$_POST['rate']:'13' }}" placeholder="00">
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="tax" class="font-s-14 text-blue">{{ $lang['tax'] }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" class="input" name="tax" id="tax" value="{{ isset($_POST['tax'])?$_POST['tax']:'13' }}" placeholder="00">
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
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
                    @if($_POST['unit_type'] == 'capm')
                    <div class="w-full  mt-2">
                        <table class="w-full lg:text-[18px] md:text-[18px] text-[14px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['wacc'] }} (WACC) </strong></td>
                                <td class="py-2 border-b">  {{ $detail['wacc'] }} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['pfe'] }} (PFE = E/V) </strong></td>
                                <td class="py-2 border-b">  {{ $detail['pfe'] }} %</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['pfd'] }} (PFD = D/V) </strong></td>
                                <td class="py-2 border-b">  {{ $detail['pfd'] }} %</td>
                            </tr>
                        </table>
                  </div>
                  @elseif($_POST['unit_type'] == 'debt')
                    <div class="w-full text-center text-[25px]">
                        <p>{{ $lang['eq'] }}</p>
                        <p class="my-3"><strong class="bg-sky px-3 py-2 font-s-32 radius-10 text-blue">
                            @if(isset($detail['eq']))
                            {{ $detail['eq'] }} %
                            @else
                            0.0 %
                            @endif
                        </strong>
                        </p>
                    </div>
                  @else
                    <div class="col-12 text-center text-[25px]">
                        <p>{{ $lang['cd'] }}</p>
                        <p class="my-3"><strong class="bg-sky px-3 py-2 font-s-32 radius-10 text-blue">
                            @if(isset($detail['cd']))
                            {{ $detail['cd'] }} %
                            @else
                            0.0 %
                            @endif
                        </strong>
                        </p>
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
 @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'capm')
        document.querySelectorAll('.test11').forEach(function(element) {
        document.getElementById('test11').classList.add('tagsUnit')
        document.querySelectorAll('.test12 ,.test13').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "capm"
                var test1 = document.getElementById('test1');
                var test2 = document.getElementById('test2');
                var test3 = document.getElementById('test3');
                
                if (test1 && test2 && test3) {
                    test1.classList.remove('hidden');
                    test2.classList.add('hidden');
                    test3.classList.add('hidden');
                }
            
        })
@endif
@if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'cd')
        document.querySelectorAll('.test12').forEach(function(element) {
            document.getElementById('test12').classList.add('tagsUnit')
            document.querySelectorAll('.test11,.test13').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
              
                document.getElementById('unit_type').value = "cd"
                var test1 = document.getElementById('test1');
                var test2 = document.getElementById('test2');
                var test3 = document.getElementById('test3');
                
                if (test1 && test2 && test3) {
                    test1.classList.add('hidden');
                    test2.classList.remove('hidden');
                    test3.classList.add('hidden');
                }
        })
@endif
@if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'debt')
        document.querySelectorAll('.test13').forEach(function(element) {
            document.getElementById('test13').classList.add('tagsUnit')
            document.querySelectorAll('.test11,.test12').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
              
                document.getElementById('unit_type').value = "debt"
                var test1 = document.getElementById('test1');
                var test2 = document.getElementById('test2');
                var test3 = document.getElementById('test3');
                
                if (test1 && test2 && test3) {
                    test1.classList.add('hidden');
                    test2.classList.add('hidden');
                    test3.classList.remove('hidden');
                }
        })
@endif
@endisset

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.test11').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.test12 ,.test13').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "capm"
                var test1 = document.getElementById('test1');
                var test2 = document.getElementById('test2');
                var test3 = document.getElementById('test3');
                
                if (test1 && test2 && test3) {
                    test1.classList.remove('hidden');
                    test2.classList.add('hidden');
                    test3.classList.add('hidden');
                }
            })
        })
        document.querySelectorAll('.test12').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.test11,.test13').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
              
                document.getElementById('unit_type').value = "cd"
                var test1 = document.getElementById('test1');
                var test2 = document.getElementById('test2');
                var test3 = document.getElementById('test3');
                
                if (test1 && test2 && test3) {
                    test1.classList.add('hidden');
                    test2.classList.remove('hidden');
                    test3.classList.add('hidden');
                }
            })
        })
        document.querySelectorAll('.test13').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.test11,.test12').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
              
                document.getElementById('unit_type').value = "debt"
                var test1 = document.getElementById('test1');
                var test2 = document.getElementById('test2');
                var test3 = document.getElementById('test3');
                
                if (test1 && test2 && test3) {
                    test1.classList.add('hidden');
                    test2.classList.add('hidden');
                    test3.classList.remove('hidden');
                }
            })
        })
    });


    
@if(isset($error))
var type = "{{$_POST['unit_type']}}";
if (type == "capm") {
    document.querySelectorAll('.test11').forEach(function(element) {
        document.getElementById('test11').classList.add('tagsUnit')
        document.querySelectorAll('.test12 ,.test13').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "capm"
                var test1 = document.getElementById('test1');
                var test2 = document.getElementById('test2');
                var test3 = document.getElementById('test3');
                
                if (test1 && test2 && test3) {
                    test1.classList.remove('hidden');
                    test2.classList.add('hidden');
                    test3.classList.add('hidden');
                }
            
        })
        } else if (type == "cd") {
            document.querySelectorAll('.test12').forEach(function(element) {
            document.getElementById('test12').classList.add('tagsUnit')
            document.querySelectorAll('.test11,.test13').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
              
                document.getElementById('unit_type').value = "cd"
                var test1 = document.getElementById('test1');
                var test2 = document.getElementById('test2');
                var test3 = document.getElementById('test3');
                
                if (test1 && test2 && test3) {
                    test1.classList.add('hidden');
                    test2.classList.remove('hidden');
                    test3.classList.add('hidden');
                }
        })
        }else{
            document.querySelectorAll('.test13').forEach(function(element) {
            document.getElementById('test13').classList.add('tagsUnit')
            document.querySelectorAll('.test11,.test12').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
              
                document.getElementById('unit_type').value = "debt"
                var test1 = document.getElementById('test1');
                var test2 = document.getElementById('test2');
                var test3 = document.getElementById('test3');
                
                if (test1 && test2 && test3) {
                    test1.classList.add('hidden');
                    test2.classList.add('hidden');
                    test3.classList.remove('hidden');
                }
        })
            
        }
 @endif

</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>