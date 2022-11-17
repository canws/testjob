@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-block table-responsive">
            <div class="card border-0">
                <div class="card-header bg-white p-3 d-flex alignt-items-center justify-content-between">
                    <p class="fw-bold m-0 text-capitalize">post list</p>
                    <a href="" class="btn btn-primary text-capitalize">add post</a>
                </div>
                <div class="card-body p-3">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-xxl-6 col-xl-5 col-lg-6 col-md-6 col-sm-12">
                                <label for="title" class="text-capitalize mb-2">title</label>
                                <input type="text" class="form-control" placeholder="Enter title" name="title">
                            </div>
                            <div class="form-group col-xxl-6 col-xl-5 col-lg-6 col-md-6 col-sm-12">
                                <label for="title" class="text-capitalize mb-2">description</label>
                                <input type="text" class="form-control" placeholder="Enter description" name="description">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection