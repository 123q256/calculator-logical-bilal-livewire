<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="x" class="label">{{$lang[1]}} (,):</label>
                <div class="w-full py-2">
                    <textarea aria-label="textarea input" id="x" name="x" placeholder="12, 23, 45" class="textareaInput">{{ isset($_POST['x'])?$_POST['x']:'5/3, 3 1/2, 33%, 1.33, -3/8, 13' }}</textarea>
                </div>
            </div>
            <div class="col-span-12">
                <label for="order" class="label">{{$lang['2']}}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="order" id="order">
                        <option value="1">{{$lang[3]}}</option>
                        <option value="2" {{ isset($_POST['order']) && $_POST['order'] == '2' ? 'selected' : '' }}>{{$lang[4]}}</option>
                    </select>
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
                        <div class="w-full mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="45%"><strong>
                                        @if($_POST['order'] == '1')
                                            {{$lang['5']}}
                                        @else
                                            {{$lang['6']}}
                                        @endif
                                    </strong></td>
                                    <td class="py-2 border-b">
                                        @php
                                            $i=0;
                                            foreach ($detail['ans'] as $key => $value) {
                                                $i++;
                                                if ($i==count($detail['ans'])) {
                                                    echo $key;
                                                }else{
                                                    if ($detail['order']==1) {
                                                        echo $key.' < ';
                                                    }else{
                                                        echo $key.' > ';
                                                    }
                                                }
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{ $lang[7] }}</strong></p>
                            <p class="mt-2">{{ $lang[9] }}</p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-100 text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{$lang[10]}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$lang[11]}}</strong></td>
                                    </tr>
                                    @php
                                        $i=0;
                                        foreach ($detail['solve'] as $key => $value) {
                                            echo "<tr><td class='py-2 border-b'>".$key."</td><td class='py-2 border-b'>".$value."</td></tr>";
                                        }
                                    @endphp
                                </table>
                            </div>
                            <p class="mt-2">{{ $lang[12] }} {{(($_POST['order']==1)?'Least to Greatest':'Greatest to Least')}}</p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-100 font-s-16">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang[10]}}</strong></td>
                                        <td class="py-2 border-b"><strong>{{$lang[11]}}</strong></td>
                                    </tr>
                                    @php
                                        $i=0;
                                        foreach ($detail['ans'] as $key => $value) {
                                            echo "<tr><td class='py-2 border-b'>".$key."</td><td class='py-2 border-b'>".$value."</td></tr>";
                                        }
                                        @endphp
                                </table>
                            </div>
                            <p class="mt-2">{{ $lang[13] }} {{(($_POST['order']==1)?'Least to Greatest':'Greatest to Least')}}</p>
                            <p class="mt-2">
                                @php
                                    $i=0;
                                    foreach ($detail['ans'] as $key => $value) {
                                        $i++;
                                        if ($i==count($detail['ans'])) {
                                            echo $key;
                                        }else{
                                            if ($detail['order']==1) {
                                                echo $key.' < ';
                                            }else{
                                                echo $key.' > ';
                                            }
                                        }
                                    }
                                @endphp
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endisset
</form>