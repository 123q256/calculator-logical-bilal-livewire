<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

               <div class="col-span-12">
                    <label for="initial" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="initial" id="initial" class="input" aria-label="input" value="<?= isset($_POST['initial']) ? $_POST['initial'] : '5' ?>" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="final" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="final" id="final" class="input" aria-label="input" value="<?= isset($_POST['final']) ? $_POST['final'] : '19' ?>" />
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang[3] }} is</strong></td>
                                        <td class="py-2 border-b">{{round($detail['answer'])}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] mt-2">
                                <p><strong>{{$lang[5]}}</strong></p>
                                <p class="mt-2">{{$lang[1]}} = {{$_POST['initial']}}</p>
                                <p class="mt-2">{{$lang[2]}} = {{$_POST['final']}}</p>
                                <p class="mt-2"><strong>{{$lang[4]}}</strong></p>
                                <p class="mt-2">Formula = {{$lang[2]}} - {{$lang[1]}}</p>
                                <p class="mt-2">{{$lang[3]}} = {{$_POST['final']}} - {{$_POST['initial']}}</p>
                                <p class="mt-2">{{$lang[3]}} = {{round($detail['answer'])}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>