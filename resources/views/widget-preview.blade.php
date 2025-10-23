@extends('layouts.widget')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
<div class="flex flex-col">
    <h1 class="text-blue-400">{{ $cal_name }}</h1>
    <div class="calculator-box {{ isset($detail) ? 'bg-white shadow-lg' : 'bg-light-blue' }} rounded-lg p-3 mt-2">
        @include('calculators.' . $page)
    </div>
</div>
@endsection
