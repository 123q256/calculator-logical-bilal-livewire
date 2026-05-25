@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')

    <div x-data @scroll-to-top.window="window.scrollTo({ top: 1, behavior: 'smooth' })"
        class="max-w-[90%] mx-auto lg:px-0 px-5 mt-10 mb-5">

        <section class=" bg-white">
               <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 justify-center">
            
            <div class="max-w-2xl mx-auto text-center">
                        <h2 class="text-xl sm:text-2xl font-bold mb-5 leading-tight">Get in Touch with Us!
                        </h2>
                        <p class="text-sm leading-relaxed mb-8">
                            If you have any questions about our content or calculators, our team is here to help. Don't
                            hesitate to
                            reach out with any queries!
                        </p>
                        @if (isset($error))
                            <p class="text-sm text-center"><strong class="text-red-500">{{ $error }}</strong></p>
                        @endif
                        @if (isset($done))
                            <p class="text-sm text-center"><strong class="text-blue-500">{{ $done }}</strong></p>
                        @endif
                        <livewire:contact.contact-us />
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection
