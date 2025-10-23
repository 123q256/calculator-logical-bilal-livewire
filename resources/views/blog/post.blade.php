@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)
@section('content')
    @livewire('blog.share-modal', [
        'post_id' => $post->post_id,
        'post_title' => $post->post_title,
        'post_des' => $post->post_des,
        'post_cat' => $post->post_cat,
        'post_time' => $post->post_time,
        'post_url' => $post->post_url,
        'meta_title' => $post->meta_title,
        'meta_des' => $post->meta_des,
        'post_img' => $post->post_img,
        'short_des' => $post->short_des,
        'show_hide' => $post->show_hide,
        'pageUrl' => url()->current(),
    ])
    {{-- related calculator  --}}
    <div class="max-w-screen-xl mx-auto">
        <section class="xl:pt-5 xl:pb-5 lg:pt-8 lg:pb-4  pb-3">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="font-manrope text-4xl font-bold text-gray-900 text-center lg:mb-16 md:mb-16 mb-12">
                    Popular Blogs
                </h2>
                <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-8">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($posts as $post)
                        @php
                            $i++;
                        @endphp
                        @php
                            $post_cat = strtolower($post->post_cat);
                        @endphp

                        <div class="group w-full max-lg:max-w-xl rounded-2xl">
                            <div class="relative group">
                                <a href="{{ url('blog/' . $post->post_url) }}/">
                                    <img src="{{ url('images/' . $post->post_img) }}" alt="{{ $post->post_title }}"
                                        class="rounded-2xl w-full h-48 object-cover" /></a>
                                <!-- Backdrop on hover -->
                                <div
                                    class="absolute rounded-3xl inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a href="{{ url('blog/' . $post->post_url) }}/"> <span
                                            class="text-white text-[36px] leading-[50px] font-semibold">Read</span></a>
                                </div>
                            </div>

                            <div class="py-5 px-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-[#4177EB]">&nbsp;</span>
                                    <span
                                        class="text-[#A3A3A3] font-[600] mb-5 block">{{ \Carbon\Carbon::parse($post->post_time)->format('d F Y') }}</span>
                                </div>
                                <h3 class="text-[16px] text-[#1A1A1A] font-[600] leading-[20px] mb-5"
                                    style="min-height: 40px;">
                                    {{ \Illuminate\Support\Str::limit($post->post_title, 60, $end = '...') }}
                                </h3>
                                <p class="text-[#A3A3A3] leading-6 mb-5" style="min-height: 40px;">
                                    {{ \Illuminate\Support\Str::limit($post->short_des, 68, $end = '...') }}

                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

@push('calculatorJS')
    <script>
        window.addEventListener('open-share-link', event => {
            const url = event.detail.url;
            window.open(url, '_blank', 'noopener,noreferrer,width=600,height=500');
        });
    </script>
@endpush
