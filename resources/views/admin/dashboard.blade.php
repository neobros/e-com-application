@extends('admin.layouts.head')
@section('content')

<style>
    *{
        margin: 0;
        padding: 0;
    }
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;  
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
</style>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Profile Statistics</h3>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">                      
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Total Users</h6>
                                                <h6 class="font-extrabold mb-0">{{$totalUsers}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon green mb-2">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Total products</h6>
                                                <h6 class="font-extrabold mb-0">{{$totalProducts}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon red mb-2">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Total Brands</h6>
                                                <h6 class="font-extrabold mb-0">{{$totalBrands}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon red mb-2">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Total Sub Admins</h6>
                                                <h6 class="font-extrabold mb-0">{{$totalSubAdmin}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Profile Visit</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="/admin/assets/compiled/jpg/1.jpg" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold">{{Auth::guard('admin')->user()->fname}}</h5>
                                        <h6 class="text-muted mb-0">@if(Auth::guard('admin')->user()->role == 1 ) Super Admin @else Admin  @endif</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Recent Rates</h4>
                            </div>
                            <div class="card-content pb-4">

                                <div class="recent-message d-flex px-4 py-3">
                                   
                                @foreach($recentRateData as $rateData)
                                        <div class="name ms-4">
                                            <div class="rate">
                                                <input type="radio" id="star5_{{ $rateData->product_id }}" name="rate_{{ $rateData->product_id }}" value="5" 
                                                    {{ $rateData->rate_count == 5 ? 'checked' : '' }} />
                                                <label for="star5_{{ $rateData->product_id }}" title="text">5 stars</label>

                                                <input type="radio" id="star4_{{ $rateData->product_id }}" name="rate_{{ $rateData->product_id }}" value="4" 
                                                    {{ $rateData->rate_count == 4 ? 'checked' : '' }} />
                                                <label for="star4_{{ $rateData->product_id }}" title="text">4 stars</label>

                                                <input type="radio" id="star3_{{ $rateData->product_id }}" name="rate_{{ $rateData->product_id }}" value="3" 
                                                    {{ $rateData->rate_count == 3 ? 'checked' : '' }} />
                                                <label for="star3_{{ $rateData->product_id }}" title="text">3 stars</label>

                                                <input type="radio" id="star2_{{ $rateData->product_id }}" name="rate_{{ $rateData->product_id }}" value="2" 
                                                    {{ $rateData->rate_count == 2 ? 'checked' : '' }} />
                                                <label for="star2_{{ $rateData->product_id }}" title="text">2 stars</label>

                                                <input type="radio" id="star1_{{ $rateData->product_id }}" name="rate_{{ $rateData->product_id }}" value="1" 
                                                    {{ $rateData->rate_count == 1 ? 'checked' : '' }} />
                                                <label for="star1_{{ $rateData->product_id }}" title="text">1 star</label>
                                            </div>
                                            <h6 class="text-muted mb-0">{{ $rateData->item_name }}</h6>
                                        </div>
                                    @endforeach
                                </div>               
                            </div>
                        </div>
                        
                    </div>
                </section>
            </div>

            @include('admin.layouts.footer')


        </div>

@endsection