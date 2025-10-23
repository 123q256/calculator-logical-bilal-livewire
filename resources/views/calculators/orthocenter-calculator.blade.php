<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <p class="col-span-12"><strong><?=$lang[1]?> A:</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="x1" class="font-s-14 text-blue">x₁</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="x1" id="x1" class="input" value="{{ isset($_POST['x1'])?$_POST['x1']:'4' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="y1" class="font-s-14 text-blue">y₁</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="y1" id="y1" class="input" value="{{ isset($_POST['y1'])?$_POST['y1']:'3' }}" aria-label="input"/>
                    </div>
                </div>
                <p class="col-span-12"><strong><?=$lang[1]?> B:</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="x2" class="font-s-14 text-blue">x₂</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="x2" id="x2" class="input" value="{{ isset($_POST['x2'])?$_POST['x2']:'7' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="y2" class="font-s-14 text-blue">y₂</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="y2" id="y2" class="input" value="{{ isset($_POST['y2'])?$_POST['y2']:'5' }}" aria-label="input"/>
                    </div>
                </div>
                <p class="col-span-12"><strong><?=$lang[1]?> C:</strong></p>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="x3" class="font-s-14 text-blue">x₃</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="x3" id="x3" class="input" value="{{ isset($_POST['x3'])?$_POST['x3']:'9' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="y3" class="font-s-14 text-blue">y₃</label>
                    <div class="w-100 py-2">
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
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>x = </strong></td>
                                    <td class="py-2 border-b">{{$detail['x']}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>y = </strong></td>
                                    <td class="py-2 border-b">{{$detail['y']}}</td>
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