@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
<div class="h-[412px] blog_b_border">
    <h1
        class="2xl:text-[86px] xl:text-[65px] lg:text-[50px] text-[35px] text-white font-[700] text-center xl:pt-[70px] lg:pt-[60px] pt-[45px]">
        Blogs
    </h1>
    <div class="flex lg:justify-center md:justify-center justify-flex-center xl:mt-[50px] lg:mt-[50px] mt-[40px]">
        <div class="flex gap-x-5 gap-y-5 flex-wrap px-5">
            <a href="{{ url('blog') }}" class="lg:px-[24px] md:px-[24px] px-[15px] py-[12px]  font-[600] rounded-[11px] {{ Request::is('blog') ? 'bg-[#2845F5] text-[#ffffff]' : 'bg-white text-[#1A1A1A]' }} "
            style="box-shadow: 0px 2px 20px 0px #00000026">
            All
        </a>
        <a href="{{ url('blog/health') }}" class="lg:px-[24px] md:px-[24px] px-[15px] py-[12px]  font-[600] rounded-[11px] {{ Request::is('blog/health') ? 'bg-[#2845F5] text-[#ffffff]' : 'bg-white text-[#1A1A1A]' }} "
            style="box-shadow: 0px 2px 20px 0px #00000026">
            Health
        </a>
        <a href="{{ url('blog/math') }}" class="lg:px-[24px] md:px-[24px] px-[15px] py-[12px] text-[#1A1A1A] font-[600] rounded-[11px]  {{ Request::is('blog/math') ? 'bg-[#2845F5] text-[#ffffff]' : 'bg-white text-[#1A1A1A]' }}"
        style="box-shadow: 0px 2px 20px 0px #00000026">
        Math
        </a>
        <a href="{{ url('blog/Informative') }}" class="lg:px-[24px] md:px-[24px] px-[15px] py-[12px] text-[#1A1A1A] font-[600] rounded-[11px]  {{ Request::is('blog/Informative') ? 'bg-[#2845F5] text-[#ffffff]' : 'bg-white text-[#1A1A1A]' }}"
            style="box-shadow: 0px 2px 20px 0px #00000026">
            Informative
        </a>
       
        <a href="{{ url('blog/finance') }}" class="lg:px-[24px] md:px-[24px] px-[15px] py-[12px] text-[#1A1A1A] font-[600] rounded-[11px]  {{ Request::is('blog/finance') ? 'bg-[#2845F5] text-[#ffffff]' : 'bg-white text-[#1A1A1A]' }}"
        style="box-shadow: 0px 2px 20px 0px #00000026">
        Finance
    </a>
        </div>
    </div>
</div>
<div class="max-w-screen-xl mx-auto lg:px-0  md:px-5 px-1">
    <!-- blog listing -->
    <section class="xl:py-10 lg:py-6 py-6">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <h2 class="font-manrope xl:text-[48px] lg:text-[45px] text-[40px] font-[600] text-gray-900 text-center">
                All 
                {{ Request::is('blog/health') ? 'Health Blog' : '' }}
                {{ Request::is('blog/math') ? 'Mathematics Blog' : '' }}
                {{ Request::is('blog/Informative') ? 'Informative Blogs' : '' }}
                {{ Request::is('blog/finance') ? 'Finance Blogs' : '' }}
                {{ Request::is('blog') ? 'Blog' : '' }}
                
            </h2>
            <p
                class="text-[15px] w-[100%] max-w-[850px] mx-auto text-opacity-60 lg:mt-4 mt-3 lg:mb-[100px] mb-[40px] leading-[20.83px] text-center font-[500]">
                Welcome to our blog, where we share insights, tips, and the latest trends across a variety of topics. Whether you're looking for advice, updates, or expert opinions, you'll find valuable information here.
            </p>
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-8">
                {{-- @dd($posts); --}}
                @if($posts)
                @forelse ($posts as $post)
                <div class="group w-full max-lg:max-w-xl rounded-2xl">
                    <div class="relative group">
                       <a href="{{ url('blog/' . $post->post_url) }}/">
                         <img src="{{ url('images/' . $post->post_img) }}" alt="{{ $post->post_title }}"
                            class="rounded-t-lg w-full h-48 object-cover" />
                        </a>
                        <!-- Backdrop on hover -->
                        <div
                            class="absolute rounded-3xl inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="{{ url('blog/' . $post->post_url) }}/"> <span class="text-white text-[36px] leading-[50px] font-semibold">Read</span></a>
                        </div>
                    </div>

                    <div class="py-5 px-3">
                        <div class="flex justify-between items-center">
                            <span class="text-[#A3A3A3] font-[600] mb-5 block">{{ \Carbon\Carbon::parse($post->post_time)->format('d F Y') }}</span>
                        </div>
                        <h3 class="text-[16px] text-[#1A1A1A] font-[600] leading-[20px] mb-5" style="min-height: 40px;">
                            {{ \Illuminate\Support\Str::limit($post->post_title, 50, $end = '...') }} 
                        </h3>
                        <p class="text-[#A3A3A3] leading-6 mb-10" style="min-height: 40px;">
                            {{ \Illuminate\Support\Str::limit($post->short_des, 68, $end = '...') }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 max-w-5xl mx-auto text-center">
                   <p class="text-center text-red-900"> Not Available</p>
                </div>
                @endforelse
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
