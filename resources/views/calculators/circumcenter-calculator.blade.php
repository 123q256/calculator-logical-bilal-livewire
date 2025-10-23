<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <label for="x1" class="label">{{$lang['1']}} x₁</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="x1" id="x1" class="input" value="{{ isset($_POST['x1'])?$_POST['x1']:'4' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="y1" class="label">{{$lang['1']}} y₁</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="y1" id="y1" class="input" value="{{ isset($_POST['y1'])?$_POST['y1']:'3' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="x2" class="label">{{$lang['1']}} x₂</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="x2" id="x2" class="input" value="{{ isset($_POST['x2'])?$_POST['x2']:'7' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="y2" class="label">{{$lang['1']}} y₂</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="y2" id="y2" class="input" value="{{ isset($_POST['y2'])?$_POST['y2']:'5' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="x3" class="label">{{$lang['1']}} x₃</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="x3" id="x3" class="input" value="{{ isset($_POST['x3'])?$_POST['x3']:'9' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="y3" class="label">{{$lang['1']}} y₃</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="y3" id="y3" class="input" value="{{ isset($_POST['y3'])?$_POST['y3']:'1' }}" aria-label="input"/>
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
                            <div class="w-full text-center  text-[20px]">
                                <p>{{$lang['2']}}</p>
                                <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg text-blue">({{round($detail['x'],5)}} , {{round($detail['y'],5)}})</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>