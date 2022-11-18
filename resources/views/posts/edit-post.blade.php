@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-block table-responsive">
            <div class="card border-0">
                <div class="card-header bg-white p-3">
                    <p class="fw-bold m-0 text-capitalize">edit post: [ <em>{{$post->title}}</em> ]</p>
                </div>
                <div class="card-body p-3">
                    @if ($errors->has('post_error'))
                        <span class="alert alert-danger">{{ $errors->first('post_error') }}</span>
                    @endif
                    <form method="post" action="{{ url('update-post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $post->id }}">
                            <div class="form-group col-xxl-6 col-xl-5 col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label for="title" class="text-capitalize mb-2">title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title" value="{{ $post->title }}" name="title" id="title">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-xxl-6 col-xl-5 col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label for="featured_image" class="text-capitalize mb-2">featured image</label>
                                <input type="file" class="form-control @error('featured_image') is-invalid @enderror" name="featured_image" value="{{ old('featured_image') }}" accept="image/png, image/gif, image/jpeg">
                                @error('featured_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="image_name" value="{{$post->featured_image}}"/>
                            @if ($post->featured_image!="")
                                <div class="col-12 mb-2">
                                    <div class="d-block p-1 border rounded">
                                        <img class="image_preview rounded w-100" src="{{ asset('storage/'.$post->featured_image) }}"/>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group col-12 mb-2">
                                <label for="description" class="text-capitalize mb-2">description</label>
                                <textarea name="description" cols="30" rows="10"  value="{{ old('description') }}" class="@error('description') is-invalid @enderror" id="description">
                                    @php
                                        echo htmlspecialchars_decode($post->body);
                                    @endphp
                                </textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-12">
                                <button class="btn text-uppercase btn-success">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script>
        ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.error( error );
        });
    </script>
@endpush