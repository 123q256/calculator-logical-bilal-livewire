@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)
@section('content')
    <div class="max-w-screen-xl mx-auto mb-7 lg:px-8 md:px-8 px-4">
        <div class="flex w-full lg:mt-10 md:mt-10 mt-5 ">
            <div class=" w-full lg:text-left ">
                <h1 class="lg:text-[30px] md:text-[30px] text-[26px] font-[700] leading-[46.87px]">
                    All {{ ucfirst($category) }} Calculators
                </h1>
                <p class="text-[17px] text-opacity-60  mt-2 leading-[29.83px] text-left font-[500]">
                    {{ $des }}
                </p>
            </div>
        </div>
    </div>
    <div class="max-w-screen-xl mx-auto lg:px-8 md:px-8 px-4 mb-10">
        <ul class="list-disc pl-4  marker:text-black marker:text-[22px] grid lg:grid-cols-3 grid-cols-1  gap-4">
            <?php 
                foreach ($calculators as $value) {
                    $value = (array)$value;
                    $cal_title = $value['cal_title'];
                    $cal_link = $value['cal_link'];
                    $cal_detail = $value['cal_detail'];
                    $link = explode('/', $cal_link);
                        $category = ucwords(str_replace('-', ' ', $category));
                        $category = str_replace(' ', '-', $category);
                        $isHealthCategory = $value['cal_cat'] == $category;
                    $isIndex = $value['no_index'] != 1;
                    $isLangKeySet = isset($lang_key);
                    if ($isHealthCategory && $isIndex && (($isLangKeySet && $lang_key == $link[0]) || (!$isLangKeySet && count($link) == 1))) {
                ?>
            <li class="pl-1">
                <a href="{{ url($cal_link) }}/"
                    class="py-1 text-[18px] rounded-[12px] block hover:underline hover:text-black">
                    {{ $cal_title }}
                </a>
            </li>
            <?php  } } ?>
        </ul>
    </div>
@endsection
