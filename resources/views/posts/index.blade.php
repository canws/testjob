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
                    @if ($errors->has('post_error'))
                        <span class="alert alert-danger">{{ $errors->first('post_error') }}</span>
                    @endif
                    @if (count($posts)>0)
                        <table class="table-bordered table-stripped w-100">
                            <thead>
                                <tr>
                                    <th class="p-2 text-uppercase">sr.no</th>
                                    <th class="p-2 text-uppercase">image</th>
                                    <th class="p-2 text-uppercase">title</th>
                                    <th class="p-2 text-uppercase">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($posts as $key => $post)
                                    <tr>
                                        <td class="p-2">{{$key+1}}</td>
                                        <td class="p-2">
                                            <img src="{{ asset('storage/'.$post->featured_image) }}" class="table_image"/>
                                        </td>
                                        <td class="p-2">{{$post->title}}</td>
                                        <td class="p-2">
                                            <a href="{{ route('view_post', $post->id) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('edit_post', $post->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                                            <form method="post" action="{{ url('/delete-post') }}" class="d-inline-block">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$post->id}}"/>
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    @else
                        <div class="alert alert-danger m-0">No posts found!</div>     
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection