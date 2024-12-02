@extends('customer.layouts.head')
@section('content')
<main class="main">
    <div class="page-header text-center"
        style="background-image: url('/customer/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Account<span>{{Auth::guard('customer')->user()->fname}} {{Auth::guard('customer')->user()->lname}}</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                           
                           <li class="nav-item">
                                <a class="nav-link active" id="tab-account-link" data-toggle="tab" href="#tab-account"
                                    role="tab" aria-controls="tab-account" aria-selected="true">Account Details</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-password"
                                    role="tab" aria-controls="tab-account" aria-selected="true">Change Password</a>
                            </li>

                            <li class="nav-item">
                                <a href="/orderList" class="nav-link" id="tab-orders-link" href="#tab-orders"
                                    role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                            </li>

                            <li class="nav-item">
                                <a href="/cart" class="nav-link" id="tab-orders-link" href="#tab-orders"
                                    role="tab" aria-controls="tab-orders" aria-selected="false">View Cart</a>
                            </li>
                    
                            <li class="nav-item">
                                <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-toggle="modal" class="nav-link" href="#">Sign Out</a>
                            </li>


                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">                     
                            <div class="tab-pane fade" id="tab-orders" role="tabpanel"
                                aria-labelledby="tab-orders-link">
                                <p>No order has been made yet.</p>

                                <!-- <a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a> -->
                            </div>

                            <div class="tab-pane fade show active" id="tab-account" role="tabpanel"
                                aria-labelledby="tab-account-link">

                                You can change your details from your account dashboard.

                                <form id="account" action="#">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control"  value="{{$userData->fname}}" name="fname" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" value="{{$userData->lname}}" name="lname"  required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Email address</label>
                                    <input type="email" value="{{$userData->email}}" name="email" disabled class="form-control" required>

                                    <label>Contact Number*</label>
                                    <input type="number" value="{{$userData->contact}}" name="contact"  class="form-control">

                                    <label>Address</label>
                                    <input type="text" value="{{$userData->address}}" name="address" class="form-control">

                                 
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>                               
                            </div><!-- .End .tab-pane -->


                            <div class="tab-pane fade" id="tab-password" role="tabpanel"
                                aria-labelledby="tab-account-link">
                                <form id="password" action="#" method="POST">
                                    @csrf
                                    <label>Current password</label>
                                    <input type="password" name="current_password" class="form-control" required>

                                    <label>New password</label>
                                    <input type="password" name="new_password" class="form-control" required>

                                    <label>Confirm new password</label>
                                    <input type="password" name="new_password_confirmation" class="form-control mb-2" required>

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>CHANGE PASSWORD</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>        
                            </div><!-- .End .tab-pane -->                       
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->

    
</main><!-- End .main -->

<script>
    $('#account').on('submit', function (e) {
        e.preventDefault(); 

        const formData = $(this).serialize();

        $.ajax({
            url: '/updateAccountDetails', 
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.success) {
                       Swal.fire({
                            position: "center",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Display validation errors
                    const errors = xhr.responseJSON.errors;
                    for (const key in errors) {
                    
                        Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: errors[key][0],
                                footer: ''
                        });

                    }
                } else if (xhr.status === 401) {
                                        
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: xhr.responseJSON.message,
                                footer: ''
                            });

                } else {

                    Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: 'Something went wrong. Please try again.',
                                footer: ''
                            });
                }
            },
        });
    });    




    $('#password').on('submit', function (e) {
        e.preventDefault(); 

        const formData = $(this).serialize();

        $.ajax({
            url: '/updatePassword', 
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.success) {
                    $('#password')[0].reset()
                       Swal.fire({
                            position: "center",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Display validation errors
                    const errors = xhr.responseJSON.errors;
                    for (const key in errors) {
                    
                        Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: errors[key][0],
                                footer: ''
                        });

                    }
                } else if (xhr.status === 401) {
                                        
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: xhr.responseJSON.message,
                                footer: ''
                            });

                } else {

                    Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: 'Something went wrong. Please try again.',
                                footer: ''
                            });
                }
            },
        });
    });    

</script>

@endsection