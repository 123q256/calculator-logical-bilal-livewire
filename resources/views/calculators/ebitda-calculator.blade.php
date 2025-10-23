<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

        <div class="col-12 col-lg-9 mx-auto mt-2  w-full">
            <input type="hidden" name="unit_type" id="unit_type" value="simple">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="imperial">
                        {{$lang['Simple']}}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric {{((isset($detail['extended']))?$detail['extended']:' ')}}" id="metric">
                        {{$lang['Extended']}}
                    </div>
                </div>
            </div>
        </div>

            <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12" id="simple">
                        <div class="grid grid-cols-12 mt-3  gap-4">
                            <div class="col-span-6">
                                <label for="x" class="font-s-14 text-blue">{{ $lang['r'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" name="x" id="x" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['x'])?$_POST['x']:'50' }}" />
                                    <span class="input_unit">{{ $currancy}}</span>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="y" class="font-s-14 text-blue">{{ $lang['e'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" name="y" id="y" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['y'])?$_POST['y']:'50' }}" />
                                    <span class="input_unit">{{ $currancy}}</span>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="a" class="font-s-14 text-blue">{{ $lang['a'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" name="a" id="a" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['a'])?$_POST['a']:'50' }}" />
                                    <span class="input_unit">{{ $currancy}}</span>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="d" class="font-s-14 text-blue">{{ $lang['d'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" name="d" id="d" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['d'])?$_POST['d']:'50' }}" />
                                    <span class="input_unit">{{ $currancy}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 hidden" id="extended">
                        <div class="grid grid-cols-12 mt-3  gap-4">
                            <div class="col-span-6">
                                <label for="rev" class="font-s-14 text-blue">{{ $lang['r'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" name="rev" id="rev" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['rev'])?$_POST['rev']:'50' }}" />
                                    <span class="input_unit">{{ $currancy}}</span>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="net" class="font-s-14 text-blue">{{ $lang['n_p'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" name="net" id="net" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['net'])?$_POST['net']:'50' }}" />
                                    <span class="input_unit">{{ $currancy}}</span>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="Interest" class="font-s-14 text-blue">{{ $lang['Interest'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" name="Interest" id="Interest" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['Interest'])?$_POST['Interest']:'50' }}" />
                                    <span class="input_unit">{{ $currancy}}</span>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="Taxes" class="font-s-14 text-blue">{{ $lang['Taxes'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" name="Taxes" id="Taxes" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['Taxes'])?$_POST['Taxes']:'50' }}" />
                                    <span class="input_unit">{{ $currancy}}</span>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="ae" class="font-s-14 text-blue">{{ $lang['a'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" name="ae" id="ae" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['ae'])?$_POST['ae']:'50' }}" />
                                    <span class="input_unit">{{ $currancy}}</span>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="de" class="font-s-14 text-blue">{{ $lang['d'] }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" name="de" id="de" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['de'])?$_POST['de']:'50' }}" />
                                    <span class="input_unit">{{ $currancy}}</span>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['ebitda'] }} </strong></td>
                                    <td class="py-2 border-b"> 
                                    @if ($detail['ebitda'] != '')
                                    <b>{{ $detail['ebitda'] }} {{$currancy }}</b>
                                    @else
                                        <b>0.0 {{$currancy }}</b>
                                    @endif
                                    </td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['margin'] }} </strong></td>
                                    <td class="py-2 border-b">
                                    @if ($detail['margin'] != '')
                                    <b>{{ $detail['margin'] }} {{$currancy }}</b>
                                    @else
                                        <b>0.0 {{$currancy }}</b>
                                    @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
@push('calculatorJS')
<script>
@if(isset($detail))
 @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'simple')
 document.querySelectorAll('.imperial').forEach(function(element) {
            document.getElementById('imperial').classList.add('tagsUnit')
                document.querySelectorAll('.metric').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "simple"
                var priceElasticity = document.getElementById('simple');
                var revenue = document.getElementById('extended');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.remove('hidden');
                    revenue.classList.add('hidden');
                }
        })
        @endif

@if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'extended')
        document.querySelectorAll('.metric').forEach(function(element) {
            document.getElementById('metric').classList.add('tagsUnit')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })

                document.getElementById('unit_type').value = "extended"
                var priceElasticity = document.getElementById('simple');
                var revenue = document.getElementById('extended');

                if (priceElasticity && revenue) {   
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
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
            document.getElementById('unit_type').value = "simple"
            var priceElasticity = document.getElementById('simple');
            var revenue = document.getElementById('extended');
            
            if (priceElasticity && revenue) {
                priceElasticity.classList.remove('hidden');
                revenue.classList.add('hidden');
            }
        })
    })
    document.querySelectorAll('.metric').forEach(function(element) {
        element.addEventListener('click', function() {
            this.classList.add('tagsUnit')
            document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                imperialElement.classList.remove('tagsUnit')
            })
          
            document.getElementById('unit_type').value = "extended"
            var priceElasticity = document.getElementById('extended');
            var revenue = document.getElementById('simple');
            
            if (priceElasticity && revenue) {
                priceElasticity.classList.remove('hidden');
                revenue.classList.add('hidden');
            }
        })
    })
});

@if(isset($error))
var type = "{{$_POST['unit_type']}}";
if (type == "simple") {
    document.querySelectorAll('.imperial').forEach(function(element) {
            document.getElementById('imperial').classList.add('tagsUnit')
                document.querySelectorAll('.metric').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "simple"
                var priceElasticity = document.getElementById('simple');
                var revenue = document.getElementById('extended');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.remove('hidden');
                    revenue.classList.add('hidden');
                }
        })
        } else {
            document.querySelectorAll('.metric').forEach(function(element) {
            document.getElementById('metric').classList.add('tagsUnit')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "extended"
                var priceElasticity = document.getElementById('simple');
                var revenue = document.getElementById('extended');

                if (priceElasticity && revenue) {   
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
                }
        })
        }
 @endif

</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>