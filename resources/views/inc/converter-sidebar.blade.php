<style>
    .font-s-14 {
        font-size: 14px
    }

    .font-s-14:hover {
        text-decoration: underline;
    }

    .unit-select {
        height: auto;
        padding: 5px;
        border-radius: 0;
        border: none;
    }
</style>

<div class="border border-gray-400 rounded ">
    <p class="py-2 px-3 font-s-18 bg-gray radius-t-10"><strong><label for="unit_search">Search a
                Converter</label></strong></p>

    <livewire:search.unit-search />

</div>
<div class="border border-gray-400 rounded-lg pb-2 mt-3">
    <p class="py-2 px-3 font-s-18 bg-gray radius-t-10"><strong>All Converters</strong></p>
    <div class="related px-3 custom-scroll overflow-auto" style="height: 300px">
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('length-converter') }}/" class="text-back text-decoration-none">Length Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('volume-converter') }}/" class="text-back text-decoration-none">Volume Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('temperature-converter') }}/" class="text-back text-decoration-none">Temperature
                Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('weight-and-mass-converter') }}/" class="text-back text-decoration-none">Weight & Mass
                Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('area-converter') }}/" class="text-back text-decoration-none">Area Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('pressure-converter') }}/" class="text-back text-decoration-none">Pressure Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('volume-dry-converter') }}/" class="text-back text-decoration-none">Volume Dry Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('time-converter') }}/" class="text-back text-decoration-none">Time Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('energy-converter') }}/" class="text-back text-decoration-none">Energy Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('force-converter') }}/" class="text-back text-decoration-none">Force Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('speed-converter') }}/" class="text-back text-decoration-none">Speed Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('angle-converter') }}/" class="text-back text-decoration-none">Angle Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('fuel-consumption-converter') }}/" class="text-back text-decoration-none">Fuel Consumption
                Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('data-storage-converter') }}/" class="text-back text-decoration-none">Data Storage
                Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('acceleration-converter') }}/" class="text-back text-decoration-none">Acceleration
                Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('density-converter') }}/" class="text-back text-decoration-none">Density Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('velocity-angular-converter') }}/" class="text-back text-decoration-none">Velocity Angular
                Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('acceleration-angular-converter') }}/" class="text-back text-decoration-none">Acceleration
                Angular Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('specific-volume-converter') }}/" class="text-back text-decoration-none">Specific Volume
                Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('moment-of-inertia-converter') }}/" class="text-back text-decoration-none">Moment of
                Inertia Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('moment-of-force-converter') }}/" class="text-back text-decoration-none">Moment of Force
                Converter</a>
        </p>
        <p class="py-2 text-[15px] border-sidebar">
            <a href="{{ url('torque-converter') }}/" class="text-back text-decoration-none">Torque Converter</a>
        </p>
    </div>
</div>

@if (isset($all_converter) && isset($a[0]))
    <div class="border rounded-lg pb-2 mt-3">
        <p class="py-2 px-3 text-[14px] bg-gray radius-t-10"><strong>{{ $lang['other1'] }} <font color="#4e342e">
                    {{ $lang['other2'] }}</font></strong></p>
        <div class="related px-3 custom-scroll overflow-auto">
            @php
                $toShow = 0;
                $url_check = request()->getRequestUri();
                $url_check = explode('/', $url_check);
                if (count($url_check) == 3) {
                    $url_check = $url_check[1] . '/' . $url_check[2];
                } else {
                    $url_check = request()->getRequestUri();
                }
            @endphp
            @foreach ($all_converter as $value)
                @php
                    $value = (array) $value;
                    $plz_check = explode('/', $value['cal_link']);
                @endphp
                @if (count($plz_check) != 3 && $value['cal_link'] != $url_check && $cal_cat == $value['cal_cat'])
                    @php
                        $cal_title = explode('/', $value['cal_link']);
                        $cal_title_ = explode('-', $cal_title[1]);
                        $cal_title = '';
                        foreach ($cal_title_ as $key => $value_) {
                            $cal_title .= $value_ . ' ';
                        }
                        $toShow++;
                        if ($toShow == 10) {
                            break;
                        }
                    @endphp
                    <p class="py-2 text-[15px] border-sidebar">
                        <a href="{{ url($value['cal_link']) }}/" title="{{ $cal_title }}"
                            class="text-back text-decoration-none">{{ $cal_title }}</a>
                    </p>
                @endif
            @endforeach
        </div>
    </div>
@endif
