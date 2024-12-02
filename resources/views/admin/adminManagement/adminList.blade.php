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
                    <h3>Sub Admin List</h3>
                    <!-- <p class="text-subtitle text-muted">A sortable, searchable, paginated table without
                        dependencies thanks to simple-datatables.</p> -->
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sub Admin List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <!-- <div class="card-header">
                    <h5 class="card-title">
                     User List 
                    </h5>
                </div> -->
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
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>User Control</th>
                                <th>Product  Control</th>

                                <th>Status</th>
                                <th>Active/Deactive</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($adminList as $key => $data )
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$data->fname}}  {{$data->lname}} </td>
                                <td>{{$data->email }}</td>

                         
                                <td>
                                   @if($data->user_permissions == 1)
                                   <a href="/admin/cngPermission/user_permissions/{{$data->id}}/0" class="btn btn-outline-warning">Deactive</a>
                                   @else
                                   <a href="/admin/cngPermission/user_permissions/{{$data->id}}/1" class="btn btn-outline-success">Active</a>
                                   @endif
                                </td>

                                <td>
                                   @if($data->product_permissions == 1)
                                   <a href="/admin/cngPermission/product_permissions/{{$data->id}}/0" class="btn btn-outline-warning">Deactive</a>
                                   @else
                                   <a href="/admin/cngPermission/product_permissions/{{$data->id}}/1" class="btn btn-outline-success">Active</a>
                                   @endif
                                </td>

                                <td>
                                   @if($data->status == 1)
                                    <span class="badge bg-success">Active</span>
                                   @else
                                   <span class="badge bg-danger">Deactive</span>
                                   @endif
                                </td>

                                <td>
                                   @if($data->status == 1)
                                   <a href="/admin/cngStatus/{{$data->id}}/0" class="btn btn-outline-warning">Deactive</a>
                                   @else
                                   <a href="/admin/cngStatus/{{$data->id}}/1" class="btn btn-outline-success">Active</a>
                                   @endif
                                </td>

                                <td>
                                   <a href="/admin/userDelete/{{$data->id}}" 
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

        </section>
    </div>
</div>

@endsection