@extends('layouts.base')
@section('title', 'Home')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-primary alert-dismissible alert-solid alert-label-icon shadow fade show" role="alert"
                style="zoom: 120%">
                <i class="ri-user-smile-line label-icon"></i><strong>Welcome {{ Auth::user()->name }}, </strong> You are
                logged in!
                {{-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
        </div>
    </div>
@endsection
