@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')

    <div x-data @scroll-to-top.window="window.scrollTo({ top: 1, behavior: 'smooth' })"
        class="max-w-[90%] mx-auto lg:px-0 px-5 my-10">

        <section class=" bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                    <div >
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-5 leading-tight">Get in Touch with Us!
                        </h2>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">
                            If you have any questions about our content or calculators, our team is here to help. Don't
                            hesitate to
                            reach out with any queries!
                        </p>

                        <!-- Social Icons -->
                        <div class="flex items-center gap-3">
                            <!-- LinkedIn -->
                            <a href="#"
                                class="w-10 h-10 rounded-full flex items-center justify-center text-white hover:opacity-80 transition-opacity"
                                style="background:#3B4FE8;">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z" />
                                    <circle cx="4" cy="4" r="2" />
                                </svg>
                            </a>
                            <!-- Pinterest -->
                            <a href="#"
                                class="w-10 h-10 rounded-full flex items-center justify-center text-white hover:opacity-80 transition-opacity"
                                style="background:#3B4FE8;">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 0 1 .083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z" />
                                </svg>
                            </a>
                            <!-- Facebook -->
                            <a href="#"
                                class="w-10 h-10 rounded-full flex items-center justify-center text-white hover:opacity-80 transition-opacity"
                                style="background:#3B4FE8;">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                </svg>
                            </a>
                        </div>
                    </div>



                    <div >
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
