@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')

    <div class="max-w-7xl mx-auto w-full  bg-white text-black  mb-10">
        <div class="max-w-7xl mx-auto flex flex-wrap px-4 ">

            <div class=" w-full lg:w-[65%] md:w-[65%]  pt-4">
                <div class="w-full ">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="{{ url('/unit-converter') }}/"
                                    class="inline-flex items-center md:text-[16px] text-[12px] font-bold text-gray-700 hover:text-blue-600  ">
                                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                    </svg>
                                    Unit Converter
                                </a>
                            </li>
                            <li>
                                @php
                                    $cate_ = explode(' ', strtolower($cal_cat));
                                    $category = '';
                                    foreach ($cate_ as $key => $value) {
                                        if ($value != 'converter') {
                                            $category .= $value . '-';
                                        } else {
                                            $category .= $value;
                                        }
                                    }
                                @endphp
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <a href="{{ url($category) }}/"
                                        class="ms-1 md:text-[16px] text-[12px] font-bold text-gray-700 hover:text-blue-600 md:ms-2  ">{{ $cal_cat }}</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span
                                        class="ms-1 md:text-[16px] text-[12px] font-bold text-gray-700 md:ms-2 ">{{ $cal_name }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="w-full">

                    <h1 class="text-1xl lg:text-2xl md:text-2xl font-semibold my-3 ">{{ $cal_name }}</h1>
                    @if (isset($lang['after_title']))
                        <p class="text-[16px] py-2">{{ $lang['after_title'] }}</p>
                    @endif
                    <div class="set_resultbox w-full p-2 md:p-2 lg:p-2 rounded-[20px]">
                        @livewire('sub-converter', ['lang' => $lang])

                    </div>
                    @if (!isset($a[0]))
                        <div class="grid grid-cols-12 bg-white shadow-lg rounded-lg mt-5 p-2  border-gray-400 ">
                            <p class="p-4 col-span-12 text-[18px] border-gray-400"><strong><?= $lang['other1'] ?>
                                    <?= $lang['other2'] ?></strong></p>
                            @php
                                $url_check = request()->getRequestUri();
                                $url_check = explode('/', $url_check);
                                if (count($url_check) == 3) {
                                    $url_check = $url_check[1] . '/' . $url_check[2];
                                } else {
                                    $url_check = request()->getRequestUri();
                                }
                            @endphp
                            @if (isset($all_converter))
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
                                        @endphp
                                        <div class="col-span-6 p-2 text-[15px] ">
                                            <a href="{{ url($value['cal_link']) }}/" class="underline"
                                                title="{{ $cal_title }}">{{ $cal_title }}</a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="side-bar mb-5 mt-[100px] w-full lg:w-[33%] md:w-[33%] ml-5  pt-4 hidden md:block">
                @include('inc.converter-sidebar')
            </div>
        </div>
    </div>
@endsection
