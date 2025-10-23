<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_des')">
    <link rel="canonical" href="{{ url()->current() }}/" />
    <link href="{{ url('assets/images/logo.png') }}" rel="icon" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}" />
    <link href="{{ url('css/flowbite.min.css') }}?v=0.0.3" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @if (isset($noindex))
        {!! $noindex !!}
    @endif
    @include('layouts/metas')
    <style>
        .active-tags {
            color: #2845F5 !important;
        }
    </style>
    @livewireStyles
</head>

<body>
    <button id="scrollToTopmove" class="scroll-to-tops hidden  fixed right-6 bottom-[12px]" style="z-index: 999999;">
        <img src="{{ url('assets/images/svgs/top_btn.svg') }}" alt=""></button>

    <!-- searchModal -->
    <div id="searchModal" class="modal fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden"
        style="z-index:999999;">
        <div class="rounded-lg p-6 max-w-[45rem] w-full animate-fadeIn absolute top-[110px]"
            style="background:transparent;">
            <!-- Close Button -->
            <button style="background-color: white; border-radius:20px;"
                class="close-modal absolute top-3 right-1 text-gray-500 hover:text-black focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <!-- Livewire Component INSIDE -->
            <livewire:search.search-two />
        </div>
    </div>
    @include('layouts/header')
    @section('content')
    @show
    @include('layouts/footer')
    <script src="{{ url('js/flowbite.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="{{ url('assets/js/website.js') }}"></script>
    <script src="{{ url('assets/js/add-calculator.js') }}"></script>

    @livewireScripts
    @stack('calculatorJS')
</body>

</html>
