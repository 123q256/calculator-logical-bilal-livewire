<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-2 md:gap-4 lg:gap-4">
                
            <div class="col-12 mt-0 mt-lg-2">
                <label for="x" class="font-s-14 text-blue">{{$lang['x']}} (,):</label>
                <div class="w-100 py-2">
                    <textarea aria-label="textarea input" id="x" name="x" class="textareaInput" placeholder="12, 23, 45">{{ isset($_POST['x'])?$_POST['x']:'12,32,12,3,4,12,5,12' }}</textarea>
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
                        <div class="w-full">
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{$lang['sum']}}</strong></td>
                                        <td class="py-2 border-b">{{(isset($detail['sum']))?$detail['sum']:'00'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{$lang['how']}}</strong></td>
                                        <td class="py-2 border-b">{{(isset($detail['total_nbr']))?$detail['total_nbr']:'00'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{$lang['nbrs']}}</strong></td>
                                        <td class="py-2 border-b">{{(isset($detail['numbers']))?$detail['numbers']:'00'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{$lang['max']}}</strong></td>
                                        <td class="py-2 border-b">{{(isset($detail['max']))?$detail['max']:'00'}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{$lang['min']}}</strong></td>
                                        <td class="py-2 border-b">{{(isset($detail['min']))?$detail['min']:'00'}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>