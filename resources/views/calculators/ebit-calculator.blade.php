<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['r'] }}:</label>
                    <input type="number" step="any" name="x" id="x" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['x'])?$_POST['x']:'413' }}" />
                    <span class="input_unit">{{ $currancy}}</span>
                </div>
                <div class="space-y-2">
                    <label for="y" class="font-s-14 text-blue">{{ $lang['o_e'] }}:</label>
                    <input type="number" step="any" name="y" id="y" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['y'])?$_POST['y']:'50' }}" />
                    <span class="input_unit">{{ $currancy}}</span>
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
          {{-- result --}}
          <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue p-6 rounded-lg mt-6">
                    <div class="w-full text-center text-xl">
                        <p class="my-6">
                            <strong class="px-6 py-2 text-3xl rounded-lg bg-[#2845F5] text-white">
                                {{ $detail['ebit'] }} {{$currancy }}
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>