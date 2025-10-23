{{-- footer --}}
<footer class="bg-[#1A1A1A]">
    <div class="mx-auto w-full max-w-screen-xl lg:p-4 md:p-4 p-[35px] pb-6 pt-10 lg:pb-8 lg:pt-10 footer_bg_image">
        <div class="md:flex md:justify-between w-full">
            <div class="mb-6 md:mb-0  md:w-[40%] w-full">
                <a href="{{ url('/') }}" class="flex items-center space-x-4 rtl:space-x-reverse w-[40%]">
                    <img src="{{ asset('assets/images/logo-dark.png') }}" class="h-10" title="Footer-Logo"
                        alt="Footer-Logo" />
                    <div>
                        <span class="font-[500] text-[24px] leading-[36.46px] tracking-wide text-white ">Calculator
                        </span>
                        <p class="font-[500] text-[17px]   tracking-wide text-white pl-2">Logical</p>
                    </div>
                </a>
                <div class="lg:w-[380px] my-7">
                    <p class="text-[16px] text-opacity-90 leading-[30px] text-white">
                        Experience effortless calculations for any need with our comprehensive Logical calculator
                        resource. Whether you're solving simple equations or complex formulas, our platform is designed
                        to make every calculation easy and accessible.
                    </p>
                </div>
                <div class="flex gap-x-6 items-center mt-12">
                    <div class="w-[30px] h-[30px] flex justify-center items-center">
                        <img src="{{ asset('assets/images/svgs/linkedin.svg') }}" class="cursor-pointer"
                            title="linkedin" alt="linkedin" />
                    </div>
                    <div class="w-[30px] h-[30px] flex justify-center items-center">
                        <img src="{{ asset('assets/images/svgs/pointer.svg') }}" class="" title="linkedin"
                            alt="linkedin" />
                    </div>
                    <div class="w-[30px] h-[30px] flex justify-center items-center">

                        <img src="{{ asset('assets/images/svgs/facebook.svg') }}" class="" title="linkedin"
                            alt="linkedin" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3  md:w-[60%] w-full">
                <div>
                    <p class="py-3 mb-3 text-[16px] font-[500] leading-[20.83px] text-[#F7BB0D]">
                        Calculators
                    </p>
                    @php
                        $databaseData = getDatabaseData();
                    @endphp
                    <ul class="text-[#C8C8C8] leading-[20.83px] text-[16px]">

                        @foreach ($databaseData as $item)
                            <li class="mb-2">
                                <a class="hover:underline" href="{{ url(Str::lower($item->cat_name)) }}/">
                                    {{ $item->cat_name }}</a>
                            </li>
                        @endforeach
                        <li class="mb-2">
                            <a class="hover:underline" href="{{ url('unit-converter') }}">
                                Unit Converter</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <p class="py-3 mb-3 text-[16px] font-[500] leading-[20.83px] text-[#F7BB0D]">
                        Quick Links
                    </p>
                    <ul class="text-[#C8C8C8] leading-[20.83px] text-[16px]">
                        <li class="mb-2">
                            <a class="hover:underline" href="{{ url('/') }}">Home</a>
                        </li>

                        <li class="mb-2">
                            <a class="hover:underline" href="{{ url('content-disclaimer') }}">Content Disclaimer</a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="{{ url('terms-of-service') }}">Terms and conditions</a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="{{ url('privacy-policy') }}">Privacy policy </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="{{ url('editorial-Policies') }}">Editorial Policies </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <p class="py-3 mb-3 text-[16px] font-[500] leading-[20.83px] text-[#F7BB0D]">
                        Keep in Touch
                    </p>
                    <ul class="leading-[20.83px] text-[#C8C8C8] text-[16px]">
                        <li class="mb-2">
                            <a class="hover:underline" href="{{ url('about-us') }}">About Us</a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="{{ url('contact-us') }}">Contact Us</a>
                        </li>
                        <li class="mt-2 mb-[18px] hover:text-[#fff] duration-300">
                            <a class="hover:underline" href="{{ url('blog') }}">Blogs</a>
                        </li>
                        <li class=" mb-[18px] hover:text-[#fff] duration-300">
                            <a class="hover:underline" href="{{ url('feedback') }}">Feedback</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 w-full border-white  lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-center">
            <span class="text-[16px] text-[#AEAEAE] sm:text-center ">© 2025
                <a href="{{ url('/') }}" class="hover:underline">Calculator Logical</a>. All Rights Reserved.
            </span>
        </div>
    </div>
</footer>
