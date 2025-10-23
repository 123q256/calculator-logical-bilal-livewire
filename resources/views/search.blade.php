@extends('layouts.app')
@section('title', $meta_title)
@section('meta_des', $meta_des)

@section('content')
    <div class="container d-flex justify-content-between px-3">
        <div class="me-0 me-lg-4 w-fit">
            <h1 class="text-blue mt-2">Calculator Search</h1>
            <div class="row bg-white shadow radius-5 px-3 pb-3 my-3">
                <form action="{{ url('search') }}/" method="POST" id="search_form_sa" class="col-lg-10 mx-auto mt-3" autocomplete="off">
                    @csrf
                    <div class="autocomplete_old position-relative mb-2">
                        <input id="search_ca" aria-label="search input" name="search_cal" type="text" placeholder="Search All Calculators" onfocus="document.onkeydown=null;" value="{{ isset($main) ? $main: ''; }}">
                        <button type="submit" class="search-page-btn">SEARCH</button>
                    </div>
                </form>
                @if (empty($results))
                    <p class="px-2 mt-3 font-s-18"><strong>No Result Found</strong></p>
                @else    
                    @php
                        $i=0;
                    @endphp
                    @foreach ($results as $value)
                        @php
                            $value = (array)$value;
                            $i++;
                            if ($i==11) {
                                break;
                            }
                            $url=$value['cal_link'];
                            $checkUrl=explode('/', $url);
                            if (count($checkUrl)==1) {
                                $checkUrl[0]='en';
                            }elseif(strlen($checkUrl[0])!=2){
                                $checkUrl[0]='en';
                            }
                        @endphp
                        @if($checkUrl[0]==app()->getLocale())
                            <a href="{{ url($value['cal_link']) }}/" class="col-12 p-2 mt-2 border-bottom text-decoration-none" title="{{$value['cal_title']}}">
                                <p class="text-blue"><?=str_ireplace($keys,'<b class="text-blue">'.ucwords($keys).'</b>',$value['cal_title'])?> - <span class="text-blue font-s-14"><?=$value['cal_cat']?></span></p>
                                <p class="font-s-14"><?=str_ireplace($keys,'<b>'.ucwords($keys).'</b>',$value['meta_des'])?></p>
                            </a>
                        @endif
                    @endforeach
                    @if (isset($related) && is_array($related) && count($related)>0)
                        <div class="col-12">
                            <div class="row">
                                <p class="px-2 mt-3 font-s-18"><strong>Related Calculator</strong></p>
                                @foreach ($related as $key => $value)
                                    @if (is_numeric($key))
                                        @php
                                            $value=explode('/', $value);
                                            if (count($value)<3) {
                                                continue;
                                            }
                                            $name=$value[0];
                                            $img=$value[1];
                                            $link=$value[2];
                                            if ($link=='age-calculator') {
                                                $link = 'calculate-age';
                                            }
                                            if (count($value)>3) {
                                                $link = '';
                                                foreach ($value as $key => $value1) {
                                                    if ($key<2) {
                                                        continue;
                                                    }
                                                    $link .= '/'.$value1;
                                                }
                                            }
                                        @endphp
                                        <p class="col-lg-6 px-2 py-1">
                                            <a href="{{ url($link) }}/" title="<?=$name?>" class="font-s-15"><?=$name?></a>
                                        </p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="side-bar d-none d-lg-block">
            {{-- @include('inc.sidebar') --}}
        </div>
    </div>
@endsection