@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')

<div class="container-fluid mx-auto  container-fluid mt-[20px]">
    <div class="w-full max-w-7xl mx-auto bg-black py-8 rounded-lg text-center">
        <h1 class="text-2xl lg:text-5xl md:text-5xl font-semibold text-[#E8FFF1]">{{ ucfirst($category) }} Calculators</h1>
        <div class="flex justify-center mt-4">
    </div>
</div>
<div class="flex flex-col items-center py-1 mb-5">
    <div class="mt-2 w-full max-w-7xl bg-right bg-cover bg-[#ebf6e0] rounded-lg">
        <div class="flex flex-col lg:flex-row">
            <div class=" w-full  order-1 lg:order-2  px-[20px] lg:px-[30px] md:px-[30px]  pt-[20px] lg:pt-[30px] md:pt-[30px]   rounded-lg mb-6 lg:mb-0">
                <p class="text-gray-600 mb-6 mt-4 ">
                    {{ $des }}
                </p>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row">
               <div class="lg:w-[100%]  md:w-[100%] w-full  order-2 lg:order-1 p-[20px] lg:p-[40px] md:p-[40px]   rounded-lg inset-0  bg-center bg-no-repeat filter" style="background-image: url('{{ asset('new_page/finance_bg.svg') }}');">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4   Everyday-Life">

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
                 <a href="{{ url($cal_link) }}/" class="bg-white py-5 px-6 rounded-[12px] shadow text-center block hover:underline hover:text-black">{{ $cal_title }}</a>
                    <?php  } } ?>
                </div>
            </div>
          
        </div>
    </div>
</div>

@endsection
