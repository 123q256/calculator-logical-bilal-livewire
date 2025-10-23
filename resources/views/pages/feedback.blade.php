@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div x-data @scroll-to-top.window="window.scrollTo({ top: 1, behavior: 'smooth' })"
            class="py-5 lg:py-8 px-4 mx-auto max-w-screen-md">
            <div class="w-full  mx-auto py-2 rounded-lg text-center mb-[5px]">
                <h1 class="text-2xl md:text-4xl font-semibold text-[#000000]">Feedback</h1>
                <p class="text-1xl lg:text-1xl md:text-1xl text-[#000000] mt-2">Let us know if you have any questions
                    corresponding to our content and calculators. The team of calculator-logical will be there 24/7 to help
                    you. Feel free to contact us for any queries!</p>
                <div class="flex justify-center mt-4"> </div>
            </div>
            <livewire:feedback.feedback-form />
        </div>
    </section>
@endsection
