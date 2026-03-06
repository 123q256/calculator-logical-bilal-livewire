@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
    <style>
        .contentAll a {
            text-decoration: underline;
        }
    </style>
    <div class="max-w-7xl mx-auto w-full bg-white text-black mb-10">
        <div class="max-w-7xl mx-auto flex flex-wrap  justify-center px-4">

            <div class=" w-full lg:w-[65%] md:w-[65%]  pt-4">
                <h1 class="text-2xl lg:text-2xl md:text-2xl font-semibold my-3 ">{{ $cal_name }}</h1>
                @if (isset($lang['after_title']))
                    <p class="font-s-16 py-2">{{ $lang['after_title'] }}</p>
                @endif
                <div class="container">
                    @include('inc.breadcrumb')
                </div>


                <div class="set_resultbox  w-full p-2 md:p-2 lg:p-2  rounded-[20px]  ">
                    <div class="grid grid-cols-12 gap-4 bg-white">
                        <div class="col-span-12">

                            @livewire('converter', ['page' => $page, 'device' => $device, 'lang' => $lang])
                        </div>
                    </div>
                </div>
                @if (!isset($a[0]))
                    <p class="p-2 text-[18px] m-5"><strong><?= $lang['1'] ?> <?= $lang['2'] ?></strong></p>
                    <div
                        class=" grid grid-cols-12 mb-5 p-4 md:p-6 lg:p-8 rounded-[16px] @if (count($all_sub) > 0) border border-gray-400 @endif contentAll">
                        @foreach ($all_sub as $value)
                            @php
                                $cal_title = explode('/', $value->cal_link);
                                $cal_title_ = explode('-', $cal_title[1]);
                                $cal_title = '';
                                foreach ($cal_title_ as $key => $value_) {
                                    $cal_title .= $value_ . ' ';
                                }
                            @endphp
                            <div class="col-span-12 md:col-span-6 p-2 text-[16px]">
                                <a href="{{ url($value->cal_link) }}/" class="p-1"
                                    title="{{ $cal_title }}">{{ $cal_title }}</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="side-bar mt-[100px] w-full lg:w-[33%] md:w-[33%] ml-5  pt-4 hidden md:block">
                @include('inc.converter-sidebar')
            </div>

        </div>
    </div>
@endsection
