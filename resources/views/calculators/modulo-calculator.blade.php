<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="x" class="font-s-14 text-blue">{{$lang['x']}}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x" id="x" class="input" value="{{ isset($_POST['x'])?$_POST['x']:'992' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="y" class="font-s-14 text-blue">{{$lang['y']}}</label>
                <div class="w-100 py-2">
                    <input type="text" step="any" name="y" id="y" class="input" value="{{ isset($_POST['y'])?$_POST['y']:'21' }}" aria-label="input"/>
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
                            <div class="w-full text-center text-[20px]">
                                <p>MOD</p>
                                <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[21px]  rounded-lg text-blue">
                                    @if(isset($detail['agya']))
                                        {{$_POST['x']}} mod {{$_POST['y']}} = {{$detail['mod']}}
                                    @else
                                        x mod y = r
                                    @endif
                                </strong></p>
                                <p class="text-center text-[16px] mt-2">{{$lang['mod_content']}}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    
    @endisset
</form>