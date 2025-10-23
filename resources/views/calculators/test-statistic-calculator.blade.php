<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  mt-3  gap-2">
                <label for="operations" class="col-span-12 label my-4">Select Format</label>
                <div class="col-span-12 position-relative">
                    <input type="radio" name="test_radio" id="test_radio" value="data" checked>
                    <label for="test_radio">Enter the data in row</label>
                </div>
                <div class="col-span-12 position-relative">
                    <input type="radio" name="test_radio" id="test_radio1" value="sem">
                    <label for="test_radio1">Enter mean, SEM and n</label>
                </div>
                <div class="col-span-12 position-relative">
                    <input type="radio" name="test_radio" id="test_radio2" value="sd">
                    <label for="test_radio2">Enter mean, SD and n</label>
                </div>


                <div class="col-span-12">
                    <div class="grid grid-cols-12  mt-3  gap-8"  id="section1">
                            <div class="col-span-6 px-2" id="div1">
                                <label for="row_data" class="font-s-14 text-blue" id="text1">Group One </label>
                                <div class="w-full py-2">
                                    <textarea class="form-control px-2 py-2 h-[200px]"  name="row_data" id="row_data" placeholder="78
82
86
85
73
82">78
82
86
85
73
82</textarea>
                                </div>
                            </div>
                            <div class="col-span-6 px-2" id="div1">
                                <label for="row_data" class="font-s-14 text-blue" id="text1">Group Two</label>
                                <div class="w-100 py-2">
                                    <textarea class="form-control px-2 py-2  h-[200px]" rows="15" name="row_data1" id="row_data1" placeholder="69
50
34
18
66
55">69
50
34
18
66
55</textarea>
                                </div>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <div class="col hidden" id="section2">
                            <div class="grid grid-cols-12  mt-3  gap-8">
                                <div class="col-span-6">
                                    <div class="col-6 col-lg-12 px-2 my-3" id="div2">
                                        <label for="first" class="font-s-14 text-blue" id="text2">Group 1
                                            
                                        </label>
                                    </div>
                                    <div class="col-6 col-lg-12 px-2" id="div3">
                                        <label for="mean" class="font-s-14 text-blue" id="text3"> Mean (x̄)</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" name="mean" id="mean" value="100" class="input" aria-label="input" placeholder="00" />
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-12 px-2" id="div4">
                                        <label for="sem" class="font-s-14 text-blue" id="text4"> SEM</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" name="sem" id="sem" value="3" class="input" aria-label="input" placeholder="00"/>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-12 px-2" id="div5">
                                        <label for="n" class="font-s-14 text-blue" id="text5"> Sample Size (n)</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" name="n" id="n" value="5" class="input" aria-label="input" placeholder="00" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <div class="col-6 col-lg-12 px-2 my-3" id="group2-container">
                                        <label for="group2" id="group2-label" class="font-s-14 text-blue">Group 2</label>
                                    </div>
                                    
                                
                                    <div class="col-6 col-lg-12 px-2" id="div3">
                                        <label for="mean1" class="font-s-14 text-blue" id="text3"> Mean (x̄)</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" name="mean1" id="mean1" value="50" class="input" aria-label="input" placeholder="00" />
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-12 px-2" id="div4">
                                        <label for="sem1" class="font-s-14 text-blue" id="text4"> SEM</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" name="sem1" id="sem1" value="30" class="input" aria-label="input" placeholder="00"/>
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-12 px-2" id="div5">
                                        <label for="n1" class="font-s-14 text-blue" id="text5"> Sample Size (n)</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" name="n1" id="n1" value="17" class="input" aria-label="input" placeholder="00" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col hidden" id="section3">
                            <div class="grid grid-cols-12  mt-3  gap-8">
                                <div class="col-span-6">
                                    <div class="col-6 col-lg-12 px-2 my-3" id="div6">
                                        <label for="first" class="font-s-14 text-blue" id="text6"> Group 1</label>
                                    </div>
                                    
                                    <div class="col-6 col-lg-12 px-2" id="div7">
                                        <label for="mean_sec" class="font-s-14 text-blue" id="text7"> Mean (x̄)</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" name="mean_sec" id="mean_sec" value="100" class="input" aria-label="input" placeholder="00" />
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-12 px-2" id="div8">
                                        <label for="sd_sec" class="font-s-14 text-blue" id="text8"> Standard Deviation (SD) </label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" name="sd_sec" id="sd_sec" value="3" class="input" aria-label="input" placeholder="00" />
                                        </div>
                                    </div>
                                    <div class="col-6 col-lg-12 px-2" id="div9">
                                        <label for="n_sec" class="font-s-14 text-blue" id="text9"> Sample Size (n)</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" name="n_sec" id="n_sec" value="5" class="input" aria-label="input" placeholder="00" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                <div class="col-6 col-lg-12 px-2 my-3" id="group3-container">
                                    <label for="group3" id="group3-label" class="font-s-14 text-blue">Group 2</label>
                                </div>
                                <div class="col-6 col-lg-12 px-2 " id="div7">
                                    <label for="mean_sec1" class="font-s-14 text-blue" id="text7"> Mean (x̄)</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="mean_sec1" id="mean_sec1" value="50" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12 px-2 " id="div8">
                                    <label for="sd_sec1" class="font-s-14 text-blue" id="text8"> Standard Deviation (SD) </label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="sd_sec1" id="sd_sec1" value="30" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                </div>
                                <div class="col-6 col-lg-12 px-2 " id="div9">
                                    <label for="n_sec2" class="font-s-14 text-blue" id="text9"> Sample Size (n)</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" name="n_sec2" id="n_sec2" value="17" class="input" aria-label="input" placeholder="00" />
                                    </div>
                                </div>
                                </div>
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
                        @if($detail['test_radio'] == 'data') 
                        <div class="w-full">
                            <div class="w-full md:w-[70%] lg:w-[70%] mt-2">
                                <p class="my-2">Values derived from inputs are:</p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1">
                                <table class="w-100 font-s-16">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>T-test  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['tValue'], 2)   }}</td>
                                </tr>
                                
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>Df  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['df'], 2)  }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>Standard Error of Difference  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['standardError'], 2)   }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong> P value  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['pValue'], 5)   }}</td>
                                </tr>
                                
                                </table>
                            </div>
                        </div>
                        </div>
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[70%] lg:w-[70%] mt-2">
                                <table class="w-full  font-s-16 text-center">
                                    <tr>
                                        <td class="py-2 border-b"><strong> Group</strong></td>
                                        <td class="py-2 border-b"><strong> Group One</strong></td>
                                        <td class="py-2 border-b"><strong> Group Two</strong></td>
                                    </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>Mean </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['mean1'], 2)  }}</td>
                                    <td class="py-2 border-b"> {{ round($detail['mean2'], 2)  }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>SD </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['sd1'], 2)  }}</td>
                                    <td class="py-2 border-b"> {{ round($detail['sd2'], 2)  }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>SEM </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['sem1'], 2)  }}</td>
                                    <td class="py-2 border-b"> {{ round($detail['sem2'], 2)   }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>N </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['n1'], 2) }}</td>
                                    <td class="py-2 border-b"> {{ round($detail['n2'], 2) }}</td>
                                </tr>
                                </table>
                            </div>
                        </div>
                        @elseif($detail['test_radio'] == 'sem') 
                        <div class="w-full">
                            <div class="w-full md:w-[70%] lg:w-[70%] mt-2">
                                <p class="my-2">Values derived from inputs are:</p>
                                <table class="w-full font-s-16">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>T-test  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['tValue'], 2)  }}</td>
                                </tr>
                                
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>Df  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['df'], 2)  }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>Standard Error of Difference  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['standardError'], 2)   }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong> P value  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['pValue'], 5) }}</td>
                                </tr>
                                
                                </table>
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            
                            <div class="w-full md:w-[70%] lg:w-[70%] mt-2">
                                <table class="w-full  font-s-16 text-center">
                                    <tr>
                                        <td class="py-2 border-b"><strong> Group</strong></td>
                                        <td class="py-2 border-b"><strong> Group One</strong></td>
                                        <td class="py-2 border-b"><strong> Group Two</strong></td>
                                    </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>Mean </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['mean1'], 2)}}</td>
                                    <td class="py-2 border-b"> {{ round($detail['mean2'], 2)  }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>SD </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['sd1'], 2)  }}</td>
                                    <td class="py-2 border-b"> {{ round($detail['sd2'], 2)  }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>SEM </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['sem1'], 2)  }}</td>
                                    <td class="py-2 border-b"> {{ round($detail['sem2'], 2)  }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>N </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['n1'], 2)  }}</td>
                                    <td class="py-2 border-b"> {{ round($detail['n2'], 2)  }}</td>
                                </tr>
                                </table>
                            </div>
                        </div>
                        @elseif($detail['test_radio'] == 'sd') 
                        <div class="w-full">
                            <div class="w-full md:w-[70%] lg:w-[70%] mt-2">
                                <p class="my-2">Values derived from inputs are:</p>
                                <table class="w-full font-s-16">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>T-test  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['tValue'], 2)  }}</td>
                                </tr>
                            
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>Df  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['df'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>Standard Error of Difference  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['standardError'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong> P value  </strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['pValue'], 5)  }}</td>
                                </tr>
                                
                                </table>
                            </div>
                        </div>
                        <div class="w-full mt-3">
                            
                            <div class="w-full md:w-[70%] lg:w-[70%] mt-2">
                                <table class="w-full  font-s-16 text-center">
                                    <tr>
                                        <td class="py-2 border-b "><strong> Group</strong></td>
                                        <td class="py-2 border-b "><strong> Group One</strong></td>
                                        <td class="py-2 border-b "><strong> Group Two</strong></td>
                                    </tr>
                                <tr>
                                    <td class="py-2 border-b "><strong>Mean </strong></td>
                                    <td class="py-2 border-b "> {{ round($detail['mean1'], 2) }}</td>
                                    <td class="py-2 border-b "> {{ round($detail['mean2'], 2)  }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b "><strong>SD </strong></td>
                                    <td class="py-2 border-b "> {{ round($detail['sd1'], 2)  }}</td>
                                    <td class="py-2 border-b "> {{ round($detail['sd2'], 2)  }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b "><strong>SEM </strong></td>
                                    <td class="py-2 border-b "> {{ round($detail['sem1'], 2) }}</td>
                                    <td class="py-2 border-b "> {{ round($detail['sem2'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b "><strong>N </strong></td>
                                    <td class="py-2 border-b "> {{ round($detail['n1'], 2)  }}</td>
                                    <td class="py-2 border-b "> {{ round($detail['n2'], 2)  }}</td>
                                </tr>
                                </table>
                            </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        const radios = document.querySelectorAll('input[name="test_radio"]');
        const section1 = document.getElementById('section1');
        const section2 = document.getElementById('section2');
        const section3 = document.getElementById('section3');

        radios.forEach(radio => {
            radio.addEventListener('change', function () {
                   
                if (this.value === 'data') {
                   
                    section1.classList.remove('hidden');
                    section2.classList.add('hidden');
                    section3.classList.add('hidden');
                } else if (this.value === 'sem') {
                    section1.classList.add('hidden');
                    section2.classList.remove('hidden');
                    section3.classList.add('hidden');
                } else if (this.value === 'sd') {
                    section1.classList.add('hidden');
                    section2.classList.add('hidden');
                    section3.classList.remove('hidden');
                }
            });
        });
    });


    @if(isset($detail))
         var value = "{{$detail['test_radio']}}";
        const test_radio = document.getElementById('test_radio');
        const test_radio1 = document.getElementById('test_radio1');
        const test_radio2 = document.getElementById('test_radio2');
        const section11 = document.getElementById('section1');
        const section22 = document.getElementById('section2');
        const section33 = document.getElementById('section3');
            if (value === 'data') {
                test_radio.checked = true;
                section11.classList.remove('hidden');
                section22.classList.add('hidden');
                section33.classList.add('hidden');
            } else if (value === 'sem') {
                test_radio1.checked = true;
                section11.classList.add('hidden');
                section22.classList.remove('hidden');
                section33.classList.add('hidden');
            } else if (value === 'sd') {
                test_radio2.checked = true;
                section11.classList.add('hidden');
                section22.classList.add('hidden');
                section33.classList.remove('hidden');
            }
    @endif
    @if(isset($error))
         var value = "{{$_POST['test_radio']}}";
        const test_radio = document.getElementById('test_radio');
        const test_radio1 = document.getElementById('test_radio1');
        const test_radio2 = document.getElementById('test_radio2');
        const section11 = document.getElementById('section1');
        const section22 = document.getElementById('section2');
        const section33 = document.getElementById('section3');
            if (value === 'data') {
                test_radio.checked = true;
                section11.classList.remove('hidden');
                section22.classList.add('hidden');
                section33.classList.add('hidden');
            } else if (value === 'sem') {
                test_radio1.checked = true;
                section11.classList.add('hidden');
                section22.classList.remove('hidden');
                section33.classList.add('hidden');
            } else if (value === 'sd') {
                test_radio2.checked = true;
                section11.classList.add('hidden');
                section22.classList.add('hidden');
                section33.classList.remove('hidden');
            }
    @endif
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>