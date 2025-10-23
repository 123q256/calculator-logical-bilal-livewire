@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')

    <div class="max-w-screen-xl mx-auto lg:px-0 px-5 lg:my-10 my-10"
        style="background-image: url('images/lineFrame-bg.png');background-size: cover;z-index: -5;">
        <div class="">
            <div class="py-5">
                <h1 class="text-center text-[36px] font-[700] leading-[46.87px]">
                    All Categories
                </h1>
                <p class="text-[15px] text-opacity-60 lg:mt-5 mt-3 leading-[22.83px] lg:px-[150px] md:px-[150px] text-center font-[500]">
                    Welcome to our All Categories section! Here, you can explore a wide range of topics, from Health and Math to Everyday-Life solutions. Whether you need tools for Finance, Physics, Chemistry, or Statistics, or you're interested in Construction, Pets, or Timedate essentials, you'll find calculators and resources tailored for each field. Dive in and discover helpful insights and calculations designed for everyday use!
                </p>
            </div>
        </div>
        <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-y-5 lgmy-20 my-10">

            @foreach ($allcategories as $category)
                <div class="bg-[#2845F5] rounded-[25px] p-6 mx-4 relative group"
                    style="box-shadow: 0px 0px 15px 0px #00000026">
                    <div class="flex justify-center mt-6 mb-4">
                        <img src="{{ asset('assets/images/icons/category-calculator-icon.svg') }}" alt="" />
                    </div>
                    <h1 class="text-[24px] font-[600] leading-[31.25px] uppercase text-white text-center">
                        {{ $category->cat_name }} <br />
                        CAlculator
                    </h1>
                    {{-- <p class="text-center my-3 text-[#E2E6FF] text-[16px] leading-[20.83px]">
            102 Calculators
        </p> --}}
                    <div class="py-5"></div>
                    <a href="{{ url(Str::lower($category->cat_name)) }}/">
                        <div class="text-[18px] box-shadow-default group-hover:shadow-lg w-full text-center absolute py-[12px] font-[700] text-white bg-none rounded-lg transition-all duration-500 transform group-hover:bg-white group-hover:text-black group-hover:scale-x-110 mx-auto -mt-10 -ml-[24.5px] -mr-2.5"
                            style="letter-spacing: 0.26em">
                            <h3 class="ml-[11px]">VIEW ALL</h3>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>


        {{-- <div class="bg-[#2845F5] rounded-[25px] p-4 mx-4" style="box-shadow: 0px 0px 15px 0px #00000026">
    <div class="flex items-center my-4 lg:flex-row md:flex-row flex-col   mt-4 mb-4 p-2">
        <div class="mb-2 pl-4 lg:w-[90%] md:w-[80%] w-full">
        <h1 class="lg:text-[32px] md:text-[32px] text-[20px] font-[600]  md:leading-[31.25px] lg:leading-[28.25px] uppercase text-white pb-2">
            Your Mathematical Conversions are Here
        </h1>
        <p class="my-3 text-[#E2E6FF] lg:text-[16px] md:text-[16px] text-[14px] leading-[20.83px] max-w-[900px] lg:pr-10 md:pr-10 pr-0 w-[100%]">
            Lorem Ipsum is simply dummy text of the printing and typesetting
            industry. Lorem Ipsum has been the industry's standard
            dummy text ever since the 1500s, when an unknown printer
            the industry's standard
            dummy text ever since the 1500s, when an unknown printer
        </p>
    </div>
    <div class="mt-6 mb-2  flex lg:justify-center justify-end lg:w-[10%] md:w-[20%] w-full">
        <a href="{{ url('conversioncalculator') }}"
        class="block py-2 lg:mx-3 md:mx-3 mx-5 w-[100px] text-center border bold border-white hover:border-[#2845F5] text-white hover:text-black rounded-[30px] bg-transparent hover:bg-[#ffffff]">
        View All</a>
</div> --}}


    </div>

    </div>

    </div>
    <div class="max-w-screen-xl mx-auto lg:px-0 px-5">
        @if ($posts)
            <section class="xl:pt-12 xl:pb-5 lg:pt-16 lg:pb-4 pt-6 pb-3">
                <div class="mx-auto max-w-7xl lg:px-4 md:px-4 sm:px-6 ">
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
                                        <img src="{{ url('images/' . $post->post_img) }}" alt="{{ $post->post_title }}"
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
                                        <h4 class="text-[16px] text-[#1A1A1A] font-[600] leading-[20px] mb-5"
                                            style="min-height: 40px;">
                                            {{ \Illuminate\Support\Str::limit($post->post_title, 50, $end = '...') }}
                                        </h4>
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
