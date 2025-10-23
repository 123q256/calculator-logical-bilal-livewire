<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php $request = request(); @endphp
            <div class="col-span-12 md:col-span-7 lg:col-span-7">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-6 text-center">
                        <p>&nbsp;</p>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="y" id="y" class="input" value="{{ isset($request->y)?$request->y:'23' }}" aria-label="input"/>
                        </div>
                        <label for="y" class="font-s-14 text-blue text-center d-block">{{$lang['y']}}</label>
                    </div>
                    <div class="col-span-6 mx-2 text-center" style="border-left: 3px solid #000;border-top: 3px solid #000;">
                        <p>&nbsp;</p>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="x" id="x" class="input" value="{{ isset($request->x)?$request->x:'357' }}" aria-label="input"/>
                        </div>
                        <label for="x" class="font-s-14 text-blue text-center d-block">{{$lang['x']}}</label>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-5 lg:col-span-5">
                <p>{{$lang['x']}} ÷ {{$lang['y']}} = {{$lang['q']}} <b>R</b> {{$lang['r']}}</p>
                <p>Example: 25 ÷ 7 = 3 <b>R</b> 4</p>
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
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['q']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['q']}}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['r']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['r']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full text-[16px]">
                                    <p class="mt-2"><strong>Solution:</strong></p>
                                    <p class="mt-2">{{$request->x.' ÷ '.$request->y}} = ?</p>
                                    <p class="mt-2">Division a ÷ b</p>
                                    <p class="mt-2">(1) a ÷ b = q <b>R</b> r</p>
                                    <p class="mt-2">(2) a = b * q + r</p>
                                    <p class="mt-2">{{$lang['q']}} = q</p>
                                    <p class="mt-2">{{$lang['r']}} = r</p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>