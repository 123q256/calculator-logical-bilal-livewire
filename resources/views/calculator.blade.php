@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
    @php
        $detail = session('calculator_result');
    @endphp
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-wrap mx-4 justify-center">
            <div class=" w-full lg:w-[70%] md:w-[70%]  pt-4  mx-auto lg:py-5 md:py-5  relative">
                <div class="">
                    <h1
                        class="lg:text-[30] md:text-[30px] text-[18px] font-[700] px-2 leading-[40.68px] text-left">
                        {{ $cal_name }}
                    </h1>
                    @if (isset($lang['after_title']))
                        <p class="lg:text-[18px] md:text-[18px] text-[16px] text-left my-3 px-2">{{ $lang['after_title'] }}
                        </p>
                    @endif
                </div>
                <livewire:component.breadcrumb :calData="$cal_data" :calCat="$cal_data->cal_cat" :brudcumParent="$cal_data->parent" />

                <div class="form-border px-2  w-full" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;"
                    >

                    @php
                        $langArray = json_decode($cal_data->lang_keys, true);
                    @endphp
                    @livewire('calculators.' . $page, [
                        'lang' => $langArray,
                        'currancy' => $currancy,
                    ])

                    {{-- @if ($detail)
                        <livewire:component.calculator-result-actions :detail="$detail" :calculator-name="$cal_name" :calculator-link="$cal_data->cal_link"
                            :pageUrl="url()->current()" />
                    @endif --}}

                </div>
                {{-- About Calculator --}}
                <div class="max-w-full mx-auto   px-3 my-5">
                    <div class="content overflow-x-auto">
                        {!! $content !!}
                    </div>
                </div>
             
            </div>
            <div class="w-full lg:w-[25%] md:w-[25%] ml-5  pt-4 hidden md:block lg:block">
                <div class="mt-[40px]"></div>
                <livewire:component.RelatedCalculator :relatedCal="$cal_data->related_cal" :calName="$cal_name" />

            </div>
        </div>
    </div>
    <!-- Feedback Modal -->
    <div id="default-modalfeed" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black/50">
        <div class="relative w-full max-w-xl mx-auto p-4">
            <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200">
                <!-- Modal Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b">
                    <h3 class="text-2xl font-semibold text-[#2845F5]">
                        Give Us Your Feedback
                    </h3>
                    <button type="button"
                        class="text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-full p-1 transition"
                        data-modal-hide="default-modalfeed">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="px-6 py-6">
                    <livewire:feedback.calculator-feedback :calName="$cal_name" />
                </div>
            </div>
        </div>
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
