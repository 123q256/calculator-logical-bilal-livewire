<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="seq1" class="label">{{$lang[1]}} (,):</label>
                    <div class="w-100 py-2">
                        <textarea aria-label="textarea input" id="seq1" name="seq1" class="textareaInput">{{ isset($_POST['seq1'])?$_POST['seq1']:'1,0,1,0,0' }}</textarea>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="seq2" class="label">{{$lang[2]}} (,):</label>
                    <div class="w-100 py-2">
                        <textarea aria-label="textarea input" id="seq2" name="seq2" class="textareaInput">{{ isset($_POST['seq2'])?$_POST['seq2']:'0.2,0.5,0.6' }}</textarea>
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
                        <div class="row">
                            <div class="col-12 text-center text-[20px]">
                                <p>{{$lang['4']}}</p>
                                <p class="my-3">
                                    <strong class="bg-[#2845F5] px-3 py-2 font-s-22 rounded-lg text-white">
                                        @php
                                            foreach($detail['conv'] as $key => $value){
                                                if(count($detail['conv'])===$key+1){
                                                    echo $value;
                                                }else{
                                                    echo $value.', ';
                                                }
                                            }
                                        @endphp
                                    </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>