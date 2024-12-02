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
                    <h3>Brand List</h3>
                    <!-- <p class="text-subtitle text-muted">A sortable, searchable, paginated table without
                        dependencies thanks to simple-datatables.</p> -->
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Brand Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Brand List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section" >
           <div class="col-md-12 col-12">
            <div class="card">
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

                    <table class="table table-striped" id="table_filter">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Brand Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($brandList as $key => $data )
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$data->brand_name }}</td>

                                <td>
                                   <a href="/admin/brandDelete/{{$data->brand_id}}" 
                                    class="btn btn-outline-danger" 
                                    onclick="return confirm('Are you sure you want to delete this user?');">
                                    Delete
                                    </a>  

                                </td>

                            </tr>
                         @endforeach         
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </section>
    </div>
</div>

@endsection