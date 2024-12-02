@extends('admin.layouts.head')
@section('content')

<link rel="stylesheet" href="/summernote/summernote-lite.min.css">

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
                    <h3>Add sub admins</h3>
                    <p class="text-subtitle text-muted">Please add Details.</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add sub admins</li>
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
                        <!-- <div class="card-header">
                            <h4 class="card-title">User Data</h4>
                        </div> -->
                        <div class="card-content">
                            <div class="card-body">

                            @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <strong>{{ \Session::get('success') }}</strong>
                            </div>
                            @endif
                            @if (\Session::has('unsucces'))
                                <div class="alert alert-danger">
                                    <strong>{{ \Session::get('unsucces') }}</strong>
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        
                                <form class="form form-horizontal" method="POST" action="/admin/adminManagement/storeAdmin" enctype="multipart/form-data">
                                   @csrf
                                    <div class="form-body">
                                        <div class="row">

                                            <!-- <div class="col-md-4">
                                                <label for="first-name-horizontal">Admin name</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <select  name="brand_id" class="form-select" id="mainCategory">
                                                
                                                </select>
                                            </div> -->

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Admin Name</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="first-name-horizontal"
                                                    class="form-control" value="" name="fname" placeholder="Admin Name" required>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Email</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="email" id="first-name-horizontal"
                                                    class="form-control"  name="email" placeholder="Email" required>
                                            </div>

                                            
                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Permissions</label>
                                            </div>

                                            <div class="col-md-8 form-group">
                                                <label class="selectgroup-item">
                                                    <input                                                        
                                                        type="checkbox" name="userControl" value="1" class="selectgroup-input">
                                                    <span class="selectgroup-button">User Control</span>
                                                </label>    
                                                
                                                <label class="selectgroup-item">
                                                    <input                                                        
                                                        type="checkbox" name="productControl" value="1" class="selectgroup-input">
                                                    <span class="selectgroup-button">Product Control</span>
                                                </label> 
                                            </div>
                                            

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Password</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="password" id="first-name-horizontal"
                                                    class="form-control"  name="password" placeholder="password" required>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="first-name-horizontal">Confirm Password</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="password" id="first-name-horizontal"
                                                    class="form-control"  name="password_confirmation" placeholder="password_confirmation" required>
                                            </div>



                                                                                     
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/summernote/summernote-lite.min.js"></script>
<script>
    $('#summernote').summernote({
        tabsize: 2,
        height: 120,
    })
    

</script>

<script>
$(document).ready(function() {
    // Max number of files allowed
    var maxFiles = 4;

    $('#photo').on('change', function() {
        var files = $(this)[0].files;
        var preview = $('#imagePreview');

        // Clear previous previews
        preview.empty();

        // Loop through selected files and show previews
        $.each(files, function(index, file) {
            if (index < maxFiles) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.append(`
                        <div class="col-md-3">
                            <img src="` + e.target.result + `" class="img-thumbnail mb-2" style="width: 100%; height: auto;">
                        </div>
                    `);
                }
                reader.readAsDataURL(file);
            }
        });
    });
});
</script>


@endsection