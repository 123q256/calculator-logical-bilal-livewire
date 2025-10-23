<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            @php
            if (!isset($detail)) {
                $_POST['round'] = "8";
            }
            @endphp
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-3 md:col-span-4 lg:col-span-4  ">
                    <label for="bnr_slc" class="label">&nbsp;</label>
                </div>
                <div class="col-span-5 md:col-span-4 lg:col-span-4  ">
                    <label for="bnr_frs" class="label py-2 mb-3">{{$lang["6"]}}:</label>
                    <input type="text" name="bnr_frs" id="bnr_frs" class="input mt-2" value="{{ isset($_POST['bnr_frs']) ? $_POST['bnr_frs'] : '110111' }}" aria-label="input" />
                </div>
                <div class="col-span-4 md:col-span-4 lg:col-span-4 ">
                    <label for="bnr_tpe1" class="label">&nbsp;</label>
                    <select name="bnr_tpe1" class="input mt-2" id="bnr_tpe1" aria-label="select">
                        <option value="binary"><?php echo $lang["2"]; ?></option>
                        <option value="decimal" {{ isset($_POST['bnr_tpe1']) && $_POST['bnr_tpe1']=='decimal'?'selected':'' }}>{{$lang["3"]}}</option>
                        <option value="hexadecimal" {{ isset($_POST['bnr_tpe1']) && $_POST['bnr_tpe1']=='hexadecimal'?'selected':'' }}>{{$lang["4"]}}</option>
                        <option value="octal" {{ isset($_POST['bnr_tpe1']) && $_POST['bnr_tpe1']=='octal'?'selected':'' }}>{{$lang["5"]}}</option>
                    </select>
                </div>
        
            </div>
            <div class="grid grid-cols-12  mt-4 gap-4">
                <div class="col-span-3 md:col-span-4 lg:col-span-4 ">
                    <label for="bnr_slc" class="label">&nbsp;</label>
                    <select name="bnr_slc" class="input mt-2" id="bnr_slc" aria-label="select">
                        <option value="add">+</option>
                        <option value="sub" {{ isset($_POST['bnr_slc']) && $_POST['bnr_slc']=='sub'?'selected':'' }}>-</option>
                        <option value="mult" {{ isset($_POST['bnr_slc']) && $_POST['bnr_slc']=='mult'?'selected':'' }}>*</option>
                        <option value="divd" {{ isset($_POST['bnr_slc']) && $_POST['bnr_slc']=='divd'?'selected':'' }}>/</option>
                    </select>
                </div>
                <div class="col-span-5 md:col-span-4 lg:col-span-4 order-1 md:order-2">
                    <label for="bnr_sec" class="label">{{$lang["7"]}}:</label>
                    <input type="text" name="bnr_sec" id="bnr_sec" class="input mt-2" value="{{ isset($_POST['bnr_sec']) ? $_POST['bnr_sec'] : '11011' }}" aria-label="input" />
                </div>
                <div class="col-span-4 md:col-span-4 lg:col-span-4 order-2 ">
                    <label for="bnr_tpe2" class="label">&nbsp;</label>
                    <select name="bnr_tpe2" class="input mt-2" id="bnr_tpe2" aria-label="select">
                        <option value="binary"><?php echo $lang["2"]; ?></option>
                        <option value="decimal" {{ isset($_POST['bnr_tpe2']) && $_POST['bnr_tpe2']=='decimal'?'selected':'' }}>{{$lang["3"]}}</option>
                        <option value="hexadecimal" {{ isset($_POST['bnr_tpe2']) && $_POST['bnr_tpe2']=='hexadecimal'?'selected':'' }}>{{$lang["4"]}}</option>
                        <option value="octal" {{ isset($_POST['bnr_tpe2']) && $_POST['bnr_tpe2']=='octal'?'selected':'' }}>{{$lang["5"]}}</option>
                    </select>
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
                <div class="w-full bg-light-blue  rounded-lg mt-3">
                    <div class="flex flex-col">
                        <div class="lg:w-1/2 mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b w-3/5 font-bold">{{ $lang["2"] }}</td>
                                    <td class="py-2 border-b">{{ $detail['bn'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-3/5 font-bold">{{ $lang["3"] }}</td>
                                    <td class="py-2 border-b">{{ $detail['dc'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-3/5 font-bold">{{ $lang["4"] }}</td>
                                    <td class="py-2 border-b">{{ $detail['hx'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b w-3/5 font-bold">{{ $lang["5"] }}</td>
                                    <td class="py-2 border-b">{{ $detail['oc'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            function bnrVlChnge(q, v) {
                var value;
                switch (q.value) {
                    case "binary":
                        value = "101010";
                        break;
                    case "hexadecimal":
                        value = "54f";
                        break;
                    case "octal":
                        value = "124";
                        break;
                    default:
                        value = "42";
                }
                v.value = value;
            }
            document.getElementById("bnr_tpe1").addEventListener("change", function() {
                bnrVlChnge(this, document.getElementById("bnr_frs"));
            });
            document.getElementById("bnr_tpe2").addEventListener("change", function() {
                bnrVlChnge(this, document.getElementById("bnr_sec"));
            });
            document.querySelector("input#bnr_frs").addEventListener("keypress", function(e) {
                var inputType = document.querySelector("#bnr_tpe1").value;
                var validKeys = [];
                switch (inputType) {
                    case "binary":
                        validKeys = [48, 49, 8];
                        break;
                    case "hexadecimal":
                        validKeys = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 65, 66, 67, 68, 69, 70, 97, 98, 99, 100, 101, 102];
                        break;
                    case "octal":
                        validKeys = [48, 49, 50, 51, 52, 53, 54, 55];
                        break;
                    case "decimal":
                        validKeys = [48, 49, 50, 51, 52, 53, 54, 55, 56, 57];
                        break;
                    default:
                        validKeys = [];
                }
                if (validKeys.indexOf(e.which) === -1) {
                    e.preventDefault();
                }
            });
            document.querySelector("input#bnr_sec").addEventListener("keypress", function(e) {
                var inputType = document.querySelector("#bnr_tpe2").value;
                switch (inputType) {
                    case "binary":
                        if (e.which == 48 || e.which == 49 || e.which == 8) {
                            return true;
                        } else {
                            e.preventDefault();
                            return false;
                        }
                        break;
                    case "hexadecimal":
                        if (e.which == 48 || e.which == 49 || e.which == 50 || e.which == 51 || e.which == 52 || e.which == 53 || e.which == 54 || e.which == 55 || e.which == 56 || e.which == 57 || e.which == 97 || e.which == 65 || e.which == 98 || e.which == 66 || e.which == 99 || e.which == 67 || e.which == 100 || e.which == 68 || e.which == 101 || e.which == 69 || e.which == 101 || e.which == 70 || e.which == 102) {
                            return true;
                        } else {
                            e.preventDefault();
                            return false;
                        }
                        break;
                    case "octal":
                        if (e.which == 48 || e.which == 49 || e.which == 50 || e.which == 51 || e.which == 52 || e.which == 53 || e.which == 54 || e.which == 55) {
                            return true;
                        } else {
                            e.preventDefault();
                            return false;
                        }
                        break;
                    case "decimal":
                        if (e.which == 48 || e.which == 49 || e.which == 50 || e.which == 51 || e.which == 52 || e.which == 53 || e.which == 54 || e.which == 55 || e.which == 56 || e.which == 57) {
                            return true;
                        } else {
                            e.preventDefault();
                            return false;
                        }
                        break;
                    default:
                        return true;
                }
            });
            document.querySelectorAll(".bnry_inputs").forEach(function(element) {
                element.addEventListener("paste", function(e) {
                    var data = (e.clipboardData || window.clipboardData).getData("text");
                    if (data.length > 0) {
                        e.preventDefault();
                    }
                });
            });
        </script>
    @endpush
</form>