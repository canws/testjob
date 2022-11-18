@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-block table-responsive">
            <div class="card border-0">
                <div class="card-header bg-white p-3">
                    <p class="fw-bold m-0 text-capitalize">users list</p>
                </div>
                <div class="card-body p-3">
                    @if (count($users)>0)
                        <table class="table-bordered table-stripped w-100">
                            <thead>
                                <tr>
                                    <th class="p-2 text-uppercase">sr.no</th>
                                    <th class="p-2 text-uppercase">name</th>
                                    <th class="p-2 text-uppercase">email</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td class="p-2">{{$key+1}}</td>
                                        <td class="p-2">{{$user->name}}</td>
                                        <td class="p-2">{{$user->email}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                        <div class=" mt-4 d-flex justify-content-center">
                            {!! $users->links() !!}
                        </div>
                    @else
                        <div class="alert alert-danger m-0">No posts found!</div>     
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection