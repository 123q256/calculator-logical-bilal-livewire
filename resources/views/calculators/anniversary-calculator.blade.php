@php
    if (isset($_POST['submit'])) {
        $one = $_POST['one'];
    } elseif (isset($_GET['res_link'])) {
        $one = $_GET['one'];
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto   space-y-6 ">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[70%] md:w-[70%] mt-4 w-full mx-auto ">
                <div class="w-full mx-auto my-2 ">
                    <input type="hidden" name="one" id="one" value="one">
                    <div
                        class="grid grid-cols-1  lg:grid-cols-3 md:grid-cols-3  lg:gap-4 md:gap-4 flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 ">
                        <div class="space-y-2  px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  wed {{ isset($_POST['one']) && $_POST['one'] !== 'one' ? '' : 'tagsUnit' }}"
                                id="wed">
                                {{ $lang['2'] }}
                            </div>
                        </div>
                        <div class="space-y-2  px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white rel {{ isset($_POST['one']) && $_POST['one'] == 'two' ? 'tagsUnit' : '' }}"
                                id="rel">
                                {{ $lang['3'] }}
                            </div>
                        </div>
                        <div class="space-y-2  px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white other {{ isset($_POST['one']) && $_POST['one'] == 'three' ? 'tagsUnit' : '' }}"
                                id="other">
                                {{ $lang['4'] }}
                            </div>

                        </div>
                    </div>
                    <div class="grid grid-cols-1  mt-5 lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2 relative">
                            <label for="date" class="font-s-14 text-blue label">
                                @if (isset($_POST['one']) && $_POST['one'] == 'one')
                                    {{ $lang['5'] }}
                                @elseif (isset($_POST['one']) && $_POST['one'] == 'two')
                                    {{ $lang['38'] }}
                                @else
                                    {{ $lang['39'] }}
                                @endif
                                :
                            </label>
                            <input type="date" name="date" id="date" class="input" aria-label="input"
                                value="{{ isset($_POST['date']) ? $_POST['date'] : date('') }}" />
                        </div>
                        <div class="space-y-2 relative">
                            <label for="current_date" class="font-s-14 text-blue">{{ $lang['37'] }}:</label>
                            <input type="date" step="any" name="current_date" id="current_date" class="input"
                                aria-label="input"
                                value="{{ isset($_POST['current_date']) ? $_POST['current_date'] : date('Y-m-d') }}" />
                        </div>
                    </div>
                </div>
                @if ($type == 'calculator')
                    @include('inc.button')
                @endif
                @if ($type == 'widget')
                    @include('inc.widget-button')
                @endif
            </div>
        </div>
    </div>

        @isset($detail)
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                            <div class="flex flex-col md:flex-row">
                                <div class=" w-full text-lg">
                                    @if ($one === 'one')
                                        <table class="w-full">
                                            <tr>
                                                <td class="w-3/5 border-b py-2 font-semibold">{{ $lang['7'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['anniversaryDate'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 font-semibold">{{ $lang['8'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['daysUntilAnniversary'] }} Days</td>
                                            </tr>
                                        </table>
                                        <table class="w-full mt-3">
                                            <tr>
                                                <td class="w-3/5 border-b py-2">{{ $lang['9'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }}
                                                    {{ $lang['10'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['11'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }}
                                                    {{ $lang['12'] }}, {{ $detail['monthsMarried'] }}
                                                    {{ $lang['13'] }}, and {{ $detail['daysMarried'] }}
                                                    {{ $lang['14'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['15'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] + 1 }}
                                                    {{ $lang['16'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['17'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }}
                                                    {{ $lang['12'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['18'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['monthsMarried'] }}
                                                    {{ $lang['13'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['19'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_weeks'] - 1 }}
                                                    {{ $lang['20'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['21'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_days'] }}
                                                    {{ $lang['14'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['22'] }}:</td>
                                                <td class="border-b py-2">{{ $lang['23'] }}</td>
                                            </tr>
                                        </table>
                                    @elseif($one === 'two')
                                        <table class="w-full">
                                            <tr>
                                                <td class="w-3/5 border-b py-2 font-semibold">{{ $lang['7'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['anniversaryDate'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 font-semibold">{{ $lang['8'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['daysUntilAnniversary'] }} Days</td>
                                            </tr>
                                        </table>
                                        <table class="w-full mt-3">
                                            <tr>
                                                <td class="w-3/5 border-b py-2">{{ $lang['9'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }}
                                                    {{ $lang['24'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['25'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }}
                                                    {{ $lang['12'] }}, {{ $detail['monthsMarried'] }}
                                                    {{ $lang['13'] }}, and {{ $detail['daysMarried'] }}
                                                    {{ $lang['14'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['26'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] + 1 }}
                                                    {{ $lang['16'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['27'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }}
                                                    {{ $lang['12'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['28'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['monthsMarried'] }}
                                                    {{ $lang['13'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['29'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_weeks'] - 1 }}
                                                    {{ $lang['20'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['30'] }}:</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_days'] }} Days</td>
                                            </tr>
                                        </table>
                                    @else
                                        <table class="w-full">
                                            <tr>
                                                <td class="w-3/5 border-b py-2 font-semibold">{{ $lang['7'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['anniversaryDate'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 font-semibold">{{ $lang['8'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['daysUntilAnniversary'] }} Days</td>
                                            </tr>
                                        </table>
                                        <table class="w-full mt-3">
                                            <tr>
                                                <td class="w-3/5 border-b py-2">{{ $lang['9'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }}
                                                    {{ $lang['31'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['32'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }}
                                                    {{ $lang['12'] }}, {{ $detail['monthsMarried'] }}
                                                    {{ $lang['13'] }}, and {{ $detail['daysMarried'] }}
                                                    {{ $lang['14'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['33'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['yearsMarried'] }}
                                                    {{ $lang['12'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['34'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['monthsMarried'] }}
                                                    {{ $lang['13'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['35'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_weeks'] - 1 }}
                                                    {{ $lang['20'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang['36'] }} :</td>
                                                <td class="border-b py-2">{{ $detail['marriage_age_days'] }}
                                                    {{ $lang['14'] }}</td>
                                            </tr>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endisset
</form>
@push('calculatorJS')
    <script>
        document.querySelectorAll('.wed').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('one').value = 'one'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.label').forEach(function(hours) {
                    hours.innerHTML = "{{ $lang['5'] }}"
                });
                document.querySelectorAll('.rel').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.other').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                });
            })
        });
        document.querySelectorAll('.rel').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('one').value = 'two'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.label').forEach(function(hours1) {
                    hours1.innerHTML = "{{ $lang['38'] }}"
                });
                document.querySelectorAll('.wed').forEach(function(hours1) {
                    hours1.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.other').forEach(function(hours1) {
                    hours1.classList.remove('tagsUnit')
                });
            })
        });
        document.querySelectorAll('.other').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('one').value = 'three'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.wed').forEach(function(hours1) {
                    hours1.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.label').forEach(function(hours1) {
                    hours1.innerHTML = "{{ $lang['39'] }}"
                });
                document.querySelectorAll('.rel').forEach(function(hours1) {
                    hours1.classList.remove('tagsUnit')
                });
            })
        });
    </script>
@endpush
