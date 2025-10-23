<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-12 mt-3  gap-4" id="price-elasticity">
                        <div class="col-span-12 input-field hidden">
                            <div class="col-lg-12 col-12 px-2 pe-lg-12">
                                <label for="method" class="font-s-14 text-blue">{{ $lang['met'] }}:</label>
                                <div class="w-100 py-2 position-relative">
                                    <select name="method" id="method" class="input">
                                        <option value="1" {{ isset($_POST['method']) && $_POST['method']=='1'?'selected':''}}>{{$lang['m1']}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12  midpoint">
                            <div class="grid grid-cols-12 mt-3  gap-4">
                            <div class="col-span-6">
                                <label for="i_p" class="font-s-14 text-blue">{{ $lang['i_p'] }}</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" name="i_p" id="i_p" value="{{((isset($_POST['i_p']))?$_POST['i_p']:'')}}" class="input">
                                    <span class="text-blue input-unit">{{$currancy }}</span>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="n_p" class="font-s-14 text-blue">{{ $lang['n_p'] }}</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" name="n_p" id="n_p" value="{{ isset($_POST['n_p'])?$_POST['n_p']:'' }}" class="input">
                                    <span class="text-blue input-unit"> {{$currancy }}</span>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="i_q" class="font-s-14 text-blue">{{ $lang['i_q'] }}</label>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" name="i_q" id="i_q" value="{{ isset($_POST['i_q'])?$_POST['i_q']:'' }}" class="input">
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="n_q" class="font-s-14 text-blue">{{ $lang['n_q'] }}</label>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" name="n_q" id="n_q" value="{{ isset($_POST['n_q'])?$_POST['n_q']:'' }}" class="input">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-span-12   hidden change">
                            <div class="col-lg-6 col-12 px-2 pe-lg-4">
                                <label for="quantity" class="font-s-12 text-blue">{{ $lang['p_h'] }}:</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" name="quantity" id="p_h" value="{{ isset($_POST['quantity'])?$_POST['quantity']:'8.823' }}" class="input" placeholder="00">
                                    <span class="text-blue input-unit">%</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 px-2 ps-lg-4">
                                <label for="prince" class="font-s-12 text-blue">{{ $lang['q_ch'] }}:</label>
                                <div class="w-100 py-2 position-relative">
                                    <input type="number" step="any" name="prince" id="prince" value="{{ isset($_POST['prince'])?$_POST['prince']:'16.66' }}" class="input" placeholder="00">
                                    <span class="text-blue input-unit">%</span>
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
                    <div class="w-full text-[16px]">
                        @if(!isset($detail['rev']))
                            <p class="col py-3 border-b">{{ $lang['ans']}}  = <strong>{{ $detail['PED']}}</strong></p>
                            <p class="col py-3 border-b">{{ $lang['ans_type']}}  = <strong>{{ $detail['type']}}</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  my-2">
                                <img src="{{ asset('images/' . $detail['type'] . '.png') }}" alt="{{ $detail['type'] }} Image" width="250px" height="100%" loading="lazy" decoding="async">
                            </div>
                            <p class="col py-3 border-b">{{ $lang['sum']}} <span>{{ $lang['aone']}} {{ $detail['PED']}}% {{ $lang['bcz']}}</span></p>
                        @endif
                        @if(isset($_POST['method'])=='1' || isset($_POST['method'])=='2' || isset($detail['rev']))
                                <table class="w-full">
                                <tbody>
                                    <tr>
                                    <td class="py-3 border-b" width="50%">{{ $lang['i_r'] }}</td>
                                    <td class="py-3 border-b"> = {{ (isset($detail['i_r']) ? $detail['i_r'] . $currancy : '00 ' . $currancy) }}
                                    </td>
                                    </tr>
                                    <tr>
                                    <td class="py-3 border-b" width="50%">{{ $lang['f_r'] }}</td>
                                    <td class="py-3 border-b"> = {{ ((isset($detail['f_r']))?$detail['f_r'].$currancy:'00 ' . $currancy) }}</td>
                                    </tr>
                                    <tr>
                                    <td class="py-3 border-b" width="50%">{{ $lang['i_rev'] }}</td>
                                    <td class="py-3 border-b"> =  {{ ((isset($detail['r_percent']))?$detail['r_percent'].'% ':'00 %') }}</td>
                                    </tr>
                                </tbody>
                                </table>
                        @endif
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
 @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'Price Elasticity')

 document.querySelectorAll('.imperial').forEach(function(element) {
    document.getElementById('imperial').classList.add('units_active')
                document.querySelectorAll('.metric').forEach(function(metricElement) {
                    metricElement.classList.remove('units_active')
                })
                document.getElementById('unit_type').value = "Price Elasticity"
                var priceElasticity = document.getElementById('revenue');
                var revenue = document.getElementById('price-elasticity');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
                }
        var method = document.getElementById('method').value;
        if (method === '1' || method === '2') {
            document.querySelectorAll('.midpoint').forEach(function(el) {
                el.classList.remove('hidden');
            });
            document.querySelectorAll('.revenue, .change').forEach(function(el) {
                el.classList.add('hidden');
            });
        }
        if (method === '3') {
            document.querySelectorAll('.midpoint, .revenue').forEach(function(el) {
                el.classList.add('hidden');
            });
            document.querySelectorAll('.change').forEach(function(el) {
                el.classList.remove('hidden');
            });
        }

        })

        @endif

@if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'Revenue')
        document.querySelectorAll('.metric').forEach(function(element) {
            document.getElementById('metric').classList.add('units_active')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('units_active')
                })

                document.getElementById('unit_type').value = "Revenue"
                var priceElasticity = document.getElementById('price-elasticity');
                var revenue = document.getElementById('revenue');

                if (priceElasticity && revenue) {   
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
                }
        })
        @endif
@endisset
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('method').addEventListener('change', function() {
            var method = document.getElementById('method').value;
            if (method === '1' || method === '2') {
                document.querySelectorAll('.midpoint').forEach(function(el) {
                    el.classList.remove('hidden');
                });
                document.querySelectorAll('.revenue, .change').forEach(function(el) {
                    el.classList.add('hidden');
                });
            }
            if (method === '3') {
                document.querySelectorAll('.midpoint, .revenue').forEach(function(el) {
                    el.classList.add('hidden');
                });
                document.querySelectorAll('.change').forEach(function(el) {
                    el.classList.remove('hidden');
                });
            }
        });
        document.querySelectorAll('.imperial').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('units_active')
                document.querySelectorAll('.metric').forEach(function(metricElement) {
                    metricElement.classList.remove('units_active')
                })
                document.getElementById('unit_type').value = "Price Elasticity"
                var priceElasticity = document.getElementById('revenue');
                var revenue = document.getElementById('price-elasticity');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
                }
            })
        })
        document.querySelectorAll('.metric').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('units_active')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('units_active')
                })
                document.getElementById('unit_type').value = "Revenue"
                var priceElasticity = document.getElementById('price-elasticity');
                var revenue = document.getElementById('revenue');
                
                if (priceElasticity && revenue) {
                    priceElasticity.classList.add('hidden');
                    revenue.classList.remove('hidden');
                }
            })
        })
    });



    
@if(isset($error))
var type = "{{$_POST['unit_type']}}";
    if (type == "Price Elasticity") {
        document.querySelectorAll('.imperial').forEach(function(element) {
        document.getElementById('imperial').classList.add('units_active')
                    document.querySelectorAll('.metric').forEach(function(metricElement) {
                        metricElement.classList.remove('units_active')
                    })
                    document.getElementById('unit_type').value = "Price Elasticity"
                    var priceElasticity = document.getElementById('revenue');
                    var revenue = document.getElementById('price-elasticity');
                    
                    if (priceElasticity && revenue) {
                        priceElasticity.classList.add('hidden');
                        revenue.classList.remove('hidden');
                    }
            var method = document.getElementById('method').value;
            if (method === '1' || method === '2') {
                document.querySelectorAll('.midpoint').forEach(function(el) {
                    el.classList.remove('hidden');
                });
                document.querySelectorAll('.revenue, .change').forEach(function(el) {
                    el.classList.add('hidden');
                });
            }
            if (method === '3') {
                document.querySelectorAll('.midpoint, .revenue').forEach(function(el) {
                    el.classList.add('hidden');
                });
                document.querySelectorAll('.change').forEach(function(el) {
                    el.classList.remove('hidden');
                });
            }

            })

        } else if (type == "Revenue") {
            document.querySelectorAll('.metric').forEach(function(element) {
            document.getElementById('metric').classList.add('units_active')
                document.querySelectorAll('.imperial').forEach(function(imperialElement) {
                    imperialElement.classList.remove('units_active')
                })

                document.getElementById('unit_type').value = "Revenue"
                var priceElasticity = document.getElementById('price-elasticity');
                var revenue = document.getElementById('revenue');

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