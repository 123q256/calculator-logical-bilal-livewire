@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')


<div class="max-w-screen-xl mx-auto lg:px-0 px-5">
    <!-- back shadow divs -->
    <div class="absolute bottom-[-80px] left-[170px] sm:w-[60%] sm:left-[20px] sm:bottom-[-40px] md:w-[70%] md:left-[50px] md:bottom-[-50px] lg:w-[80%] lg:left-[100px]"
        style="
                    max-width: 351px;
                    height: 351px;
                    flex-shrink: 0;
                    border-radius: 351px;
                    opacity: 0.12;
                    background: #2845f5;
                    z-index: -2;
                    filter: blur(75px);
                ">
    </div>

    <div class="absolute bottom-[150px] right-[50px] sm:w-[60%] sm:right-[20px] sm:bottom-[80px] md:w-[70%] md:right-[30px] md:bottom-[100px] lg:w-[80%] lg:right-[50px]"
        style="
            max-width: 351px;
            height: 351px;
            flex-shrink: 0;
            border-radius: 351px;
            opacity: 0.12;
            background: #2845f5;
            z-index: -2;
            filter: blur(75px);
        ">
    </div>

    <!-- header -->
    <div class="flex w-full xl:my-20 lg:my-16 my-5 px-8">
        <div class="lg:w-[40%] w-full lg:text-left text-center">
            <h1
                class="lg:text-[42px] md:text-[42px] sm:text-[35px] text-[30px] lg:uppercase md:uppercase text-black lg:leading-[54.68px] font-[600]">
                All <span class="text-[#F7BB0D]">Free</span> <br />
                Mathematical Calculators
            </h1>
            <p class="text-[20px] lg:my-10 md:my-10 my-2 leading-[26.04px] font-[600] ">
                All Calculators for
                {{ ucfirst($category) }} Calculators
            </p>
            <div class="lg:flex md:flex grid grid-cols-2 gap-x-5  lg:justify-start justify-center lg:text-left text-center">
               <a href="{{ url('all-calculators') }}"
                    class="bg-[#1A1A1A] shadow-2xl lg:my-auto my-3  text-[#fff] hover:bg-[#2845F5] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3">
                    All Calculators
            </a>
                <a href="{{ url('all-category') }}"
                    class="bg-transparent border lg:my-auto my-3 border-black hover:border-[#2845F5] text-[#000] hover:bg-[#2845F5] hover:text-white duration-200 text-[16px] rounded-[44px] px-6 py-3">
                    All Category
        </a>
            </div>
        </div>
        <div class="w-[60%] lg:flex hidden justify-end">
            <img src="{{ asset('assets/images/categoryCalcultor/Mathematical-Calculators.png') }}" alt="" />
        </div>
    </div>
    <!-- calcuator listing -->
    <div class="xl:mb-10 lg:mb-8 mb-6 xl:mt-[70px] lg:mt-[60px] mt-[30px]">
        <div class="">
            <h1 class="text-center text-[36px] font-[700] leading-[46.87px]">
                All {{ ucfirst($category) }} Calculators
            </h1>
            <p class="text-[15px] text-opacity-60 lg:mt-7 mt-4 leading-[25.83px] lg:px-[150px] md:px-[150px] text-center font-[500]">
                {{ $des }}
            </p>
        </div>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 xl:my-[70px] lg:my-[60px] my-[30px]">
            <?php 
                     

            foreach ($calculators as $value) {
                $value = (array)$value;
                $cal_title = $value['cal_title'];
                $cal_link = $value['cal_link'];
                $cal_detail = $value['cal_detail'];
                $link = explode('/', $cal_link);
                    $category = ucwords(str_replace('-', ' ', $category)); // Pehle hyphen ko space se replace karo
                    $category = str_replace(' ', '-', $category);
                    $isHealthCategory = $value['cal_cat'] == $category;
                // }
                $isIndex = $value['no_index'] != 1;

                // dd($value['cal_cat']);
                $isLangKeySet = isset($lang_key);
                if ($isHealthCategory && $isIndex && (($isLangKeySet && $lang_key == $link[0]) || (!$isLangKeySet && count($link) == 1))) {
            ?>
          
          
            <div class=" justify-between px-2 py-5  border-[#DEDEDE] hover_border cursor-pointer items-center">
                <a href="{{ url($cal_link) }}/" class="flex justify-between items-center px-1 ">
                    <h3 class="hover:underline">{{ $cal_title }}</h3>
                    <svg width="6" height="11" viewBox="0 0 6 11" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 10L6 5.5L1 1" stroke="#2845F5" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
            <?php  } } ?>
          
        </div>

      
    </div>
</div>


@endsection