<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                
            <div class="col-span-12">
                <label for="first" class="font-s-14 text-blue">1<sup>st</sup> {{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="first" id="first" class="input" aria-label="input" value="<?= isset($_POST['first']) ? $_POST['first'] : '350' ?>" />
                </div>
            </div>
            <div class="col-span-12">
                <label for="second" class="font-s-14 text-blue">2<sup>nd</sup> {{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="second" id="second" class="input" aria-label="input" value="<?= isset($_POST['second']) ? $_POST['second'] : '140' ?>" />
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
                            <div class="w-full text-center">
                                <p><strong class="bg-[#2845F5] text-white px-3 py-2 text-[22px] rounded-lg text-blue">
                                    @if($_POST['first'] < $_POST['second'])
                                        {{$_POST['first']}} <strong>{{$lang[3]}}</strong> {{$_POST['second']}}
                                    @elseif($_POST['first'] > $_POST['second'])
                                        {{$_POST['first']}} <strong>{{$lang[4]}}</strong> {{$_POST['second']}}
                                    @else
                                        {{$_POST['first']}} <strong>{{$lang[5]}}</strong> {{$_POST['second']}}
                                    @endif
                                </strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>