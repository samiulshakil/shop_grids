@extends('frontend.layouts.master')

@section('mainContent')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Dashboard</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('website.home') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li>Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard" style="padding-top:90px; padding-bottom:90px">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.include.user_sidebar')
                </div>
                <div class="col-lg-9">
                    <h4 class="text-center">Hello <code>({{ Auth::user()->name }})</code> Welcome to User Dashboard</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
