@extends('admin.layouts.head')
@section('content')
<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit User</h3>
                    <p class="text-subtitle text-muted">Please update user data.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Horizontal form layout section start -->
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">User Data</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="/admin/updateUser" >
                                   @csrf

                                   <input type="hidden" id="first-name-horizontal"
                                   class="form-control" value="{{$userData->id}}" name="id">

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">First Name</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal"
                                                    class="form-control" value="{{$userData->fname}}" name="fname" placeholder="First Name">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Last Name</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal"
                                                    class="form-control" value="{{$userData->lname}}" name="lname" placeholder="Last Name">
                                            </div>
                                        
                                            <div class="col-md-4">
                                                <label for="email-horizontal">Email</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input readonly type="email" id="email-horizontal" class="form-control"
                                                    name="email-id"  value="{{$userData->email}}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="contact-info-horizontal">Mobile</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="number" id="contact-info-horizontal"
                                                    class="form-control" value="{{$userData->contact}}"  name="contact" placeholder="Mobile">
                                            </div>

                                            <!-- <div class="col-md-4">
                                                <label for="password-horizontal">Password</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="password" id="password-horizontal"
                                                    class="form-control" name="password" placeholder="Password">
                                            </div> -->
                                           
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">Submit</button>
                                                <!-- <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>             
            </div>
        </section>
        <!-- // Basic Horizontal form layout section end -->

    


       
    </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <!-- <p>2023 &copy; Mazer</p> -->
                </div>
                <div class="float-end">
                    <!-- <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                        by <a href="https://saugi.me">Saugi</a></p> -->
                </div>
            </div>
        </footer>

</div>

@endsection