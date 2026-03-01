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
        'posts' => $posts,
    ])
@endsection

@push('calculatorJS')
    <script>
        window.addEventListener('open-share-link', event => {
            const url = event.detail.url;
            window.open(url, '_blank', 'noopener,noreferrer,width=600,height=500');
        });
    </script>
@endpush
