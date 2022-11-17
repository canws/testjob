@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-block table-responsive">
            <div class="card border-0">
                <div class="card-header bg-white p-3 d-flex alignt-items-center justify-content-between">
                    <p class="fw-bold m-0 text-capitalize">post list</p>
                    <a href="{{ route('add_post') }}" class="btn btn-primary text-capitalize">add post</a>
                </div>
                <div class="card-body p-3">
                    <table class="table-bordered table-stripped w-100">
                        <thead>
                            <tr>
                                <th class="p-2 text-uppercase">sr.no</th>
                                <th class="p-2 text-uppercase">image</th>
                                <th class="p-2 text-uppercase">title</th>
                                <th class="p-2 text-uppercase">body</th>
                                <th class="p-2 text-uppercase">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $key => $post)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->body}}</td>
                                    <td>{{$post->body}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection