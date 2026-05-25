@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)
@section('content')
    <!-- Scroll to Top Button -->
     <!-- search-calculator  -->
    @include('layouts.include.search-calculator')
     <!-- category  -->
    @include('layouts.include.category')
     <!-- used-calculators  -->
    @include('layouts.include.used_calculators')
     <!-- why_choose_calculator  -->
    @include('layouts.include.why_choose_calculator')
     <!-- free_tools  -->
    @include('layouts.include.free_tools')
     <!-- about_calculator  -->
    @include('layouts.include.about_calculator')
     <!-- testimonials  -->
    @include('layouts.include.testimonials')
     <!-- cta_banner  -->
    @include('layouts.include.cta_banner')
     <!-- featured_in  -->
    @include('layouts.include.featured_in')
     <!-- FAQs  -->
    @include('layouts.include.faqs')
@endsection
