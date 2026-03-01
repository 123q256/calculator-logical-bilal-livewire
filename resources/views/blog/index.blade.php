@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')

    <main class="max-w-6xl mx-auto px-4 sm:px-8 py-8 sm:py-12">
        <div class="mb-10">
            <h1 class="text-3xl sm:text-4xl font-bold text-neutral-950">Our Blog</h1>
            <p class="text-gray-500 mt-2"> Welcome to our blog, where we share insights, tips, and the latest trends across a
                variety of topics. Whether you're looking for advice, updates, or expert opinions, you'll find valuable
                information here.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @if ($posts)
                @forelse ($posts as $post)
                    <a href="{{ url('blog/' . $post->post_url) }}"
                        class="group bg-white rounded-2xl border border-black/10 overflow-hidden hover:shadow-xl hover:border-blue-600/30 transition">
                        <div class="aspect-video bg-gray-200 overflow-hidden">
                            <img src="{{ url('images/' . $post->post_img) }}" alt="{{ $post->post_title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="p-6">
                            <p class="text-blue-600 text-sm font-medium">
                                {{ \Carbon\Carbon::parse($post->post_time)->format('d F Y') }}</p>
                            <h2 class="text-xl font-semibold text-neutral-950 mt-2 group-hover:text-blue-600 transition">
                                {{ \Illuminate\Support\Str::limit($post->post_title, 50, $end = '...') }}</h2>
                            <p class="text-gray-500 text-sm mt-2 line-clamp-2">
                                {{ \Illuminate\Support\Str::limit($post->short_des, 68, $end = '...') }}</p>
                        </div>
                    </a>

                @empty
                    <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 max-w-5xl mx-auto text-center">
                        <p class="text-center text-red-900"> Not Available</p>
                    </div>
                @endforelse
            @endif
        </div>
    </main>
@endsection
