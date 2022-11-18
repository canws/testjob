@extends('layouts.app')

@section('content')
@push('style')
    <style>
        main.py-4{
            padding: 0px !important;
        }
    </style>
@endpush
@if ($post)
    <div class="d-block post_banner position-relative" style="background:url('{{ asset('storage/'.$post->featured_image) }}')">
        <div class="post_banner_overlay position-absolute top-0 start-0 end-0 bottom-0 d-flex align-items-center justify-content-center">
            <h2 class="text-white">{{$post->title}}</h2>
        </div>
    </div>
    <div class="container py-5">
        <div class="post-content text-start">
            <h2 class="text-center mb-4">{{$post->title}}</h2>
            @php
                echo htmlspecialchars_decode($post->body);
            @endphp
        </div>
    </div>
@endif
@endsection