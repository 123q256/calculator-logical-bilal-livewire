@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)
@section('content')
    <style>
        .cursor-pointer {
            cursor: pointer !important;
        }
        .border-bb {
            border: 1px solid #D2D4D8 !important;
        }
        .autosearch-activeclass {
            background-color: #1670a712;
        }
        .search_bars_div {
            border: 1px solid #D2D4D8 !important;
        }
    </style>
     <div class="lg:text-[35px] md:text-[35px] text-[30px] pt-5 font-[700] text-[#2845F5] text-center ">
        <h1 class="text-[#2845F5]">Calculator <span class="text-[#1A1A1A]">Logical</span> </h1>
    </div>
    <!-- Search bar -->
        <div class="max-w-[670px] mx-auto mt-2 px-5">
        @livewire('search.calculator-search')
    </div>

    {{-- calculator --}}
    @include('includes.calculator')
    {{-- about category --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-5 md:my-5 my-3" id="targetDiv">
        <div class="py-5">
            <h2 class="text-center lg:text-[36px] md:text-[36px] text-[25px] font-[700] leading-[46.87px]">
                About Categories
            </h2>
            <p class="text-[15px] text-opacity-60 lg:mt-5 mt-3 leading-[20.83px] text-center font-[500]">
                Explore a variety of calculators tailored to fit your unique needs. From mathematics to health and finance,
                <br class="lg:block hidden" />
                each category is designed to provide quick solutions and help simplify your tasks.
            </p>
        </div>

        <div class="grid self-center lg:grid-cols-5 md:grid-cols-3 grid-cols-2 gap-x-5 gap-y-5">
            @foreach ($allcategories as $category)
                <a href="{{ url(Str::lower($category->cat_name)) }}/">
                    <div class="bg-[#2845F5] group text-center  justify-center rounded-[20px] p-4 hover:shadow-2xl transition-transform"
                        style="box-shadow: 0px 0px 20px 0px #00000026; transform: scale(1)"
                        onmouseover="this.style.transform='scale(1.01)';" onmouseout="this.style.transform='scale(1)';">
                        <div class=" flex justify-center items-center rounded-full">
                            <img src="{{ asset('images/category/' . $category->img) }}" width="50"
                                alt="{{ $category->cat_name }}" title="{{ $category->cat_name }}" />
                        </div>
                        <p class="text-[16px] mt-3  tracking-wide text-white text-opacity-90 font-[600] leading-[33.85px]">
                            {{ $category->cat_name }}
                        </p>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
    {{-- About Calculator --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <div class="py-5">
            <h2 class="text-center text-[36px] font-[700] leading-[46.87px]">
                About Calculator
            </h2>
            <p class="text-[16px] text-black text-opacity-60 lg:mt-2 mt-2 text-left font-[500]">
                Calculator Logical is your one-stop shop for all of your everyday calculations, including health, finances,
                statistics, math, physics, and chemistry.
            </p>
            <p class="text-[16px] text-black text-opacity-60 lg:mt-2 mt-2 text-left font-[500]">

                Everyone should have free, immediate access to computations and we are committed to delivering current
                results and solving mathematical problems with unparalleled correctness and efficiency. Regardless of
                whether you are working on simple math tasks or exploring more intricate mathematics, this platform is
                intended to make your mathematical pursuits more efficient.
            </p>
            <p class="text-[16px] text-black text-opacity-60 lg:mt-2 mt-2 text-left font-[500]">

                Calculator Logical's tools guarantee accuracy in all areas of calculations, demonstrating our dedication to
                you. If you have a problem with these calculators, please contact us. The Calculator Logical may increase
                your mathematical productivity.
            </p>
        </div>
    </div>


    {{-- Popular Calculators --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <h2 class="text-[25px] text-[#2845F5] pb-4 font-[700] leading-[23.85px]">
            Popular Calculators
        </h2>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
            <a href="{{ config('set.url') }}/bmi-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000]  text-[16px] font-[500] leading-[23.44px]">
                        BMI Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/weightloss-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Weight Loss Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/tdee-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        TDEE Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/calorie-deficit-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Calorie Deficit Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/percentage-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Percentage Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/fraction-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Fraction Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/integral-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Integral Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/ovulation-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Ovulation Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/pregnancy-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Pregnancy Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>

        </div>
    </div>
    {{-- Health Calculators --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <h2 class="text-[25px] pb-4 font-[700] leading-[23.85px]">
            Health Calculators
        </h2>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
            <a href="{{ config('set.url') }}/ffmi-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000]  text-[16px] font-[500] leading-[23.44px]">
                        FFMI Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/alc-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        ALC Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/anc-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        ANC Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/bsa-calculator" class="abc_cal overflow-hidden rounded-lg "
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        BSA Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/bmr-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        BMR Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/rmr-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        RMR Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/macro-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Macro Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/tdee-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        TDEE Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ url('health') }}" class="pr-btn">
                <div
                    class="flex justify-between h-[47px] premium-btn bg-[#2845F5] rounded-[7px] px-6 py-3 items-center text-white">
                    <p class="text-[#ffffff] text-[18px] font-[500] leading-[23.44px]">
                        view More
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
        </div>
    </div>
    {{-- Finance Calculators --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <h2 class="text-[25px] pb-4 font-[700] leading-[23.85px]">
            Finance Calculators
        </h2>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
            <a href="{{ config('set.url') }}/cpm-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000]  text-[16px] font-[500] leading-[23.44px]">
                        CPM Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/ebitda-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        EBITDA Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/vat-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        VAT Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/tip-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Tip Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/salary-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Salary Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/discount-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Discount Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/profit-margin-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Margin Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/wacc-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        WACC Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ url('finance') }}" class="pr-btn">
                <div
                    class="flex justify-between premium-btn h-[47px] bg-[#2845F5] rounded-[7px] px-6 py-3 items-center text-white">
                    <p class="text-[#ffffff] text-[18px] font-[500] leading-[23.44px]">
                        view More
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
        </div>
    </div>
    {{-- Math Calculators --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <h2 class="text-[25px] pb-4 font-[700] leading-[23.85px]">
            Math Calculators
        </h2>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
            <a href="{{ config('set.url') }}/fraction-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000]  text-[16px] font-[500] leading-[23.44px]">
                        Fraction Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/modulo-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Modulo Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/average-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Average Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/centroid-triangle-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Centroid Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/gpa-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        GPA Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/percentage-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Percentage Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/midpoint-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Midpoint Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/slope-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Slope Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ url('math') }}" class="pr-btn">
                <div
                    class="flex justify-between premium-btn h-[47px] bg-[#2845F5] rounded-[7px] px-6 py-3 items-center text-white">
                    <p class="text-[#ffffff] text-[18px] font-[500] leading-[23.44px]">
                        view More
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
        </div>
    </div>
    {{-- Physics Calculators --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <h2 class="text-[25px] pb-4 font-[700] leading-[23.85px]">
            Physics Calculators
        </h2>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
            <a href="{{ config('set.url') }}/work-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000]  text-[16px] font-[500] leading-[23.44px]">
                        Work Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/momentum-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Momentum Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/velocity-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Velocity Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/acceleration-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Acceleration Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/kinematics-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Kinematics Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/force-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Force Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/enthalpy-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Enthalpy Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/horsepower-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Horsepower Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ url('physics') }}" class="pr-btn">
                <div
                    class="flex justify-between premium-btn h-[47px] bg-[#2845F5] rounded-[7px] px-6 py-3 items-center text-white">
                    <p class="text-[#ffffff] text-[18px] font-[500] leading-[23.44px]">
                        view More
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
        </div>
    </div>
    {{-- Chemistry Calculators --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <h2 class="text-[25px] pb-4 font-[700] leading-[23.85px]">
            Chemistry Calculators
        </h2>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
            <a href="{{ config('set.url') }}/calorimetry-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000]  text-[16px] font-[500] leading-[23.44px]">
                        Calorimetry Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/ph-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        pH Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/titration-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Titration Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/molarity-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Molarity Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/ppm-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        PPM Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/molality-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Molality Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/stoichiometry-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Stoichiometry Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/cfu-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        CFU Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ url('chemistry') }}" class="pr-btn">
                <div
                    class="flex justify-between premium-btn h-[47px] bg-[#2845F5] rounded-[7px] px-6 py-3 items-center text-white">
                    <p class="text-[#ffffff] text-[18px] font-[500] leading-[23.44px]">
                        view More
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
        </div>
    </div>
    {{-- Statistics Calculators --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <h2 class="text-[25px] pb-4 font-[700] leading-[23.85px]">
            Statistics Calculators
        </h2>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
            <a href="{{ config('set.url') }}/probability-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000]  text-[16px] font-[500] leading-[23.44px]">
                        Probability Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/interquartile-range-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        IQR Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/anova-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Anova Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/invnorm-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        InvNorm Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/combination-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Combination Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/hypergeometric-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Hypergeometric Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/permutation-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Permutation Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/variance-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Variance Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ url('statistics') }}" class="pr-btn">
                <div
                    class="flex justify-between premium-btn h-[47px] bg-[#2845F5] rounded-[7px] px-6 py-3 items-center text-white">
                    <p class="text-[#ffffff] text-[18px] font-[500] leading-[23.44px]">
                        view More
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
        </div>
    </div>
    {{-- Everyday Life Calculators --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <h2 class="text-[25px] pb-4 font-[700] leading-[23.85px]">
            Everyday Life Calculators
        </h2>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
            <a href="{{ config('set.url') }}/age-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000]  text-[16px] font-[500] leading-[23.44px]">
                        Age Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/edpi-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        eDPI Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/vorici-chromatic-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Vorici Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/love-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Love Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/mpg-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        MPG Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/download-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Download Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/era-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        ERA Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/stair-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Stair Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ url('everyday-life') }}" class="pr-btn">
                <div
                    class="flex justify-between premium-btn h-[47px] bg-[#2845F5] rounded-[7px] px-6 py-3 items-center text-white">
                    <p class="text-[#ffffff] text-[18px] font-[500] leading-[23.44px]">
                        view More
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
        </div>
    </div>

    {{-- Construction Calculators --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <h2 class="text-[25px] pb-4 font-[700] leading-[23.85px]">
            Construction Calculators
        </h2>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
            <a href="{{ config('set.url') }}/roof-pitch-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000]  text-[16px] font-[500] leading-[23.44px]">
                        Roof Pitch Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/acreage-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Acreage Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/cylinder-volume-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Cylinder Volume Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/decking-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Decking Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/mulch-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Mulch Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/concrete-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Concrete Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/cubic-yard-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Cubic Yard Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/pipe-volume-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Pipe Volume Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ url('construction') }}" class="pr-btn">
                <div
                    class="flex justify-between premium-btn h-[47px] bg-[#2845F5] rounded-[7px] px-6 py-3 items-center text-white">
                    <p class="text-[#ffffff] text-[18px] font-[500] leading-[23.44px]">
                        view More
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
        </div>
    </div>

    {{-- Timedate Calculators --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <h2 class="text-[25px] pb-4 font-[700] leading-[23.85px]">
            Timedate Calculators
        </h2>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
            <a href="{{ config('set.url') }}/date-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000]  text-[16px] font-[500] leading-[23.44px]">
                        Date Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/time-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Time Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/time-span-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Time Span Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/time-card-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Time Card Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/business-days-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Business Days Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/add-time-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Add Time Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/military-time-converter" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Military Time Converter
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/hours-ago-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Time Ago Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ url('timedate') }}" class="pr-btn">
                <div
                    class="flex justify-between premium-btn h-[47px] bg-[#2845F5] rounded-[7px] px-6 py-3 items-center text-white">
                    <p class="text-[#ffffff] text-[18px] font-[500] leading-[23.44px]">
                        view More
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
        </div>
    </div>

    {{-- pets Calculators --}}
    <div class="lg:max-w-[960px] md:max-w-[960px] max-w-[960px] mx-auto  px-5 lg:my-10 md:my-10 my-5 ">
        <h2 class="text-[25px] pb-4 font-[700] leading-[23.85px]">
            Pets Calculators
        </h2>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-3">
            <a href="{{ config('set.url') }}/dog-pregnancy-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000]  text-[16px] font-[500] leading-[23.44px]">
                        Dog Pregnancy Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/benadryl-for-dogs-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Benadryl for Dogs Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/cat-calorie-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Cat Calorie Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/dog-food-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Dog Food Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
            <a href="{{ config('set.url') }}/puppy-weight-calculator" class="abc_cal overflow-hidden rounded-lg"
                style="border:1px solid #00000059;">
                <div class="flex justify-between overflow-hidden h-[47px] bg-[#EFF3F4]  px-6 py-3 items-center">
                    <p class="text-[#000000] text-[16px] font-[500] leading-[23.44px]">
                        Puppy Weight Calculator
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>


            <a href="{{ url('pets') }}" class="pr-btn">
                <div
                    class="flex justify-between premium-btn h-[47px] bg-[#2845F5] rounded-[7px] px-6 py-3 items-center text-white">
                    <p class="text-[#ffffff] text-[18px] font-[500] leading-[23.44px]">
                        view More
                    </p>
                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12L7 6.5L1 1" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>

                </div>
            </a>
        </div>
    </div>

   
    {{-- About Calculation --}}
    <div class="max-w-[1140px] mx-auto px-5 lg:my-10 md:my-10 my-5">
        <div class="py-5">
            <h2 class="text-center text-[36px] font-[700] leading-[46.87px]">
                About Calculation
            </h2>
            <p class="text-[15px] text-opacity-60 lg:mt-5 mt-3 leading-[20.83px] text-center font-[500]">
                Calculator Logical offers quick, precise solutions for all your daily calculations, from health to finance
                <br class="lg:block hidden" />
                to scientific equations. Simplify your tasks with tools designed for accuracy and ease.
            </p>
        </div>
        <div class="lg:flex md:flex w-full gap-x-4 mt-5">
            <div class="lg:w-[60%] md:w-[50%] w-full lg:mb-0 md:mb-0 mb-5 rounded-[15px]"
                style="background-image: url('{{ asset('assets/images/all_basic_bg.png') }}');background-size: cover;background-position: center;">
                <h3
                    class="lg:text-[28px] md:text-[20px] text-[17px] lg:pt-1 md:pt-1 pt-5 mt-4 mb-1 font-[600] text-center lg:leading-[39.06px] md:leading-[30.06px] leading-[28.06px]">
                    All Basic, Advance, Scientific and <br />
                    Business Level Calculation
                </h3>
                <img src="images/Group 323156.png" alt="" />
                <div class="flex justify-center">
                    <img src="{{ asset('assets/images/all_basic_calcalutor.png') }}" alt="all-basic-calcalutor" title="all-basic-calcalutor" />
                </div>
            </div>
            <div class="lg:w-[40%] md:w-[50%]  w-full gap-y-4 flex flex-col">
                <div class="rounded-[15px] bg-[#DFFFE0] h-[256px]"
                    style="background-image: url('{{ asset('assets/images/important_calculator.png') }}');background-size: cover;">
                    <h3
                        class="lg:text-[28px] md:text-[20px] text-[17px] pt-4 pb-1 font-[600] text-center leading-[30.06px]">
                        Important Calculation
                    </h3>
                </div>
                <div class="rounded-[15px] bg-[#FFF6DB] h-[256px]">
                    <h3
                        class="lg:text-[28px] md:text-[20px] text-[17px] pt-4 pb-1 font-[600] text-center leading-[30.06px]">
                        Health Maintenance
                    </h3>
                    <div class="">
                        <div class="w-full relative mt-3">
                            <img class="w-full" src="{{ asset('assets/images/health_maintance_bg.png') }}"
                                alt="health-maintance" title="health-maintance"/>
                            <div class="flex justify-center absolute bottom-5 left-1/2 transform -translate-x-1/2 items-center bg-white p-4 rounded-[8px]"
                                style="box-shadow: 0px 18px 36px -18px #00000026;box-shadow: 0px 30px 60px -12px #32325d1a;">
                                <img src="{{ asset('assets/images/heart.png') }}" alt="heart" title="heart"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="bg-[#EEE1FF] flex rounded-[18px] px-10 py-8 my-4 flex  items-center  lg:flex-row md:flex-row flex-col ">
            <div class="lg:w-[80%] md:w-[80%] w-full">
                <h2
                    class="lg:text-[32px] md:text-[32px] text-[28px] font-[600] lg:leading-[41.66px] md:leading-[41.66px] leading-[36.66px]">
                    Your Mathematical Logics are Here
                </h2>
                <p class="text-[15px] font-[500] leading-[20.83px] mt-5 text-[#1A1A1A]">
                    Explore a world where calculations meet clarity. From financial forecasts to scientific formulas, every
                    tool on Calculator Logical is crafted to simplify complex math and enhance understanding. We’ve
                    carefully designed each calculator to be intuitive and efficient, ensuring you get precise answers
                    effortlessly. Let Calculator Logical support you on your journey to mastering mathematical challenges.
                </p>
            </div>
            <div
                class="flex lg:justify-center md:justify-center justify-end items-center lg:w-[20%] md:w-[20%] w-full text-end mt-5">
                <a href="{{ url('math') }}"
                    class="bg-[#1A1A1A] text-[#fff] hover:bg-[#2845F5] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3">
                    View Here
                </a>
            </div>
        </div>

        <div class="lg:my-10 md:my-10 my-5">
            <h2 class="lg:text-[36px] md:text-[36px] text-[26px] font-[700] text-center">
                Purpose Of Calculator
            </h2>
            <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 lg:mt-10 md:mt-10 mt-4">
                <div class="p-4">
                    <div class="flex justify-center">
                        <img src="{{ asset('assets/images/purpose_1.png') }}" alt="purpose_1" title="purpose_1" />
                    </div>
                    <h3 class="text-[20px] leading-[26.04px] text-center font-[600] my-5">
                        Education
                    </h3>
                    <p class="text-[16px] text-center leading-[20.83px] font-[500] text-[#1A1A1A]">
                        Boost your academic potential with tools that simplify equations and calculations.
                </div>
                <div class="p-4">
                    <div class="flex justify-center">
                        <img src="{{ asset('assets/images/purpose_2.png') }}" alt="purpose_2" title="purpose_2" />
                    </div>
                    <h3 class="text-[20px] leading-[26.04px] text-center font-[600] my-5">
                        Health
                    </h3>
                    <p class="text-[16px] text-center leading-[20.83px] font-[500] text-[#1A1A1A]">
                        Get quick insights into your fitness and nutrition with our health calculators. Manage your
                        well-being with ease.
                    </p>
                </div>

                <div class="p-4">
                    <div class="flex justify-center">
                        <img src="{{ asset('assets/images/purpose_3.png') }}" alt="purpose_3"  title="purpose_3"/>
                    </div>
                    <h3 class="text-[20px] leading-[26.04px] text-center font-[600] my-5">
                        Finance
                    </h3>
                    <p class="text-[16px] text-center leading-[20.83px] font-[500] text-[#1A1A1A]">
                        Easily manage finances and make informed decisions with our reliable financial tools.
                    </p>
                </div>
                <div class="p-4">
                    <div class="flex justify-center">
                        <img src="{{ asset('assets/images/purpose_4.png') }}" alt="purpose_4" title="purpose_4" />
                    </div>
                    <h3 class="text-[20px] leading-[26.04px] text-center font-[600] my-5">
                        Business
                    </h3>
                    <p class="text-[16px] text-center leading-[20.83px] font-[500] text-[#1A1A1A]">
                        Maximize business operations with calculators for profit margins and taxes. Drive success with
                        dependable tools.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-[#1A1A1A]">
        <div class="max-w-[1140px] mx-auto  px-5 my-10 py-14"
            style="background-image: url('{{ asset('assets/images/footer-bg-img.png') }}');background-size: cover;background-position: center;">
            <div class="flex lg:flex-row flex-col">
                <div class="lg:w-[50%]">
                    <h2
                        class="lg:text-[46px] md:text-[46px] text-[35px]  md:leading-[59.89px] lg:leading-[39.89px] font-[600] tracking-wider text-white">
                        All
                        Calculators <br class="hidden lg:block md:block" /><span class="text-[#F7BB0D]">Free</span>
                    </h2>
                    <p
                        class="text-[16px]  text-white text-opacity-90 leading-[20.83px] text-justify lg:mt-8 md:mt-8 mt-6 mb-12">
                        Explore a comprehensive range of free calculators designed to meet your daily needs. Whether it’s
                        health, finance, or academic assistance, our tools deliver quick and accurate results, helping you
                        make well-informed decisions effortlessly. Start solving today!
                    </p>
                    <div class="flex gap-x-6">
                        <a href="javascript:void(0);"
                            class="bg-transparent scroll-link border border-white hover:border-[#F7BB0D] text-white hover:bg-[#F7BB0D] hover:text-black duration-200 text-[16px] rounded-[44px] px-6 py-3.5">
                            All Category
                    </a>
                        {{-- <a href="{{ url('all-category') }}"
                            class="bg-[#F7BB0D] hover:bg-black hover:text-white text-black duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3.5">
                            All Category
                    </a>  --}}
                    </div>
                </div>
                <div class="lg:w-[50%] lg:flex hidden justify-end">
                    <img src="{{ asset('assets/images/unlock_img.png') }}" alt="unlock_img" title="unlock_img" />
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-[1140px] mx-auto  px-5 my-10">
        {{-- Popular Blogs --}}
        @if ($posts)
            <section class="xl:pt-12 xl:pb-5 lg:pt-16 lg:pb-4 pt-6 pb-3">
                <div class="mx-auto max-w-7xl lg:px-4 md:px-4 sm:px-6 lg:px-8">
                    <h2 class="font-manrope text-4xl font-bold text-gray-900 text-center lg:mb-16 md:mb-16 mb-9">
                        Popular Blogs
                    </h2>
                    <div
                        class="flex justify-center gap-y-4 lg:gap-y-0 flex-wrap md:flex-wrap lg:flex-nowrap lg:flex-row lg:justify-between lg:gap-x-8">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($posts as $post)
                            @php
                                $i++;
                                if ($i == 7) {
                                    break;
                                }
                            @endphp

                            <div class="group w-full max-lg:max-w-xl lg:w-1/3 rounded-2xl">
                                <div class="relative group">
                                    <a href="{{ url('blog/' . $post->post_url) }}/">
                                        <img src="{{ url('images/' . $post->post_img) }}"
                                            alt="{{ $post->post_title }}"
                                            class="rounded-2xl w-full h-48 object-cover " />
                                        <!-- Backdrop on hover -->
                                        <div
                                            class="absolute rounded-3xl inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <span class="text-white text-[36px] leading-[50px] font-semibold">Read</span>
                                        </div>
                                    </a>
                                </div>

                                <div class="py-5">
                                    <div class="flex justify-between items-center">
                                        <span class="text-[#4177EB]">&nbsp;</span>
                                        <span
                                            class="text-[#A3A3A3] font-[600] mb-5 block">{{ \Carbon\Carbon::parse($post->post_time)->format('d F Y') }}</span>
                                    </div>
                                    <a href="{{ url('blog/' . $post->post_url) }}/">
                                        <h3 class="text-[16px] text-[#1A1A1A] font-[600] leading-[20px] mb-5"
                                            style="min-height: 40px;">
                                            {{ \Illuminate\Support\Str::limit($post->post_title, 50, $end = '...') }}
                                        </h3>
                                    </a>
                                    <p class="text-[#A3A3A3] leading-6 mb-5" style="min-height: 40px;">
                                        {{ \Illuminate\Support\Str::limit($post->short_des, 68, $end = '...') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </div>
@endsection
@push('calculatorJS')
    {{-- home page search  --}}
    <script>
        function autocomplete(inp, arr) {
            arr = Object.entries(arr);
            var currentFocus;
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                a = document.createElement("div");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class",
                    "absolute autosearchcomplete-items space-y-1 max-h-80 overflow-y-auto text-start bg-white rounded-lg shadow-inner mt-[28px] w-full top-[20px]"
                    );
                this.parentNode.appendChild(a);
                for (i = 0; i < arr.length; i++) {
                    if (arr[i][1][0].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        // if (arr[i][1][0].toUpperCase().indexOf(val.toUpperCase()) !== -1) {
                        b = document.createElement("div");
                        b.innerHTML = " <a href='" + window.location.origin + '/' + arr[i][1][1] +
                            "' class='block items-center py-2 rounded  border-bb   group hover:shadow-sm hover:bg-gray-50'> <strong class=' ms-3 whitespace-nowrap' >" +
                            arr[i][1][0].substr(0, val.length) + "</strong>" + arr[i][1][0].substr(val.length) +
                            ' </a>';

                        b.addEventListener("click", function(e) {
                            closeAllLists();
                            var href = this.querySelector('a').getAttribute('href');
                            window.location.href = href;
                        });
                        a.appendChild(b);
                    }
                }
                document.querySelectorAll('.suggestion').forEach(function(element) {
                    element.style.display = 'none';
                });
            });
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    // console.log('keydown');
                    currentFocus++;
                    addActive(x);
                } else if (e.keyCode == 38) {
                    currentFocus--;
                    addActive(x);
                } else if (e.keyCode == 13) {
                    // e.preventDefault();
                    if (currentFocus > -1) {
                        if (x) x[currentFocus].click();
                    }
                }
                document.querySelectorAll('.recently_calculators').forEach(function(element) {
                    element.style.display = 'none';
                });

            });

            function addActive(x) {
                if (!x) return false;
                console.log('keydown');

                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                x[currentFocus].classList.add("autosearch-activeclass");
            }

            function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autosearch-activeclass");
                }
            }

            function closeAllLists(elmnt) {
                var x = document.getElementsByClassName("autosearchcomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }
        autocomplete(document.getElementById("search-bars"), searchCalculators);


        let searchimg_index = document.querySelector(".searchsvg");
        let searchinput = document.querySelector(".searchinput");
        if (searchimg_index) {
            searchimg_index.addEventListener("click", function() {
                searchinput.focus();
            });
        }
        // show_calculator
        function show_calculator(button) {
            const value = button.value;
            // You can use this value to perform specific actions
            if (value === "scientific") {
                $('#scientific_calculator').hide();
                $('#simple_calculator').show();
                $('#left_calulator').show();
                // Show scientific calculator
            } else if (value === "simple") {
                $('#scientific_calculator').show();
                $('#simple_calculator').hide();
                $('#left_calulator').hide();
                // Show simple calculator
            }
        }
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector(".scroll-link").addEventListener("click", function (e) {
            e.preventDefault(); // Prevent default anchor behavior
            const target = document.getElementById("targetDiv");
            if (target) {
                target.scrollIntoView({ behavior: "smooth", block: "start" });
            }
        });
    });
    </script>


@endpush
