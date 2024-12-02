@extends('admin.layouts.head')
@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                    <h3>Item List</h3>
                    <!-- <p class="text-subtitle text-muted">A sortable, searchable, paginated table without
                        dependencies thanks to simple-datatables.</p> -->
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Item Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Item List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                    Search field
                    </h5>
                </div>
                <div class="card-body">
                <form method="get" id="search-form" class="form form-horizontal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="first-name-column">Item Name</label>
                                <input type="text" id="first-name-column" class="form-control"  name="item_name">
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="last-name-column">Brand Name</label>
                                <select name="brand_id" class="form-select" id="mainCategory">
                                    <option value="">--Select Brand--</option>
                                    @foreach($brandList as $key => $data)
                                        <option value="{{$data->brand_id}}">{{$data->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="city-column">User Name</label>
                                <input type="text" id="city-column" class="form-control" name="fname">
                            </div>
                        </div> -->

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="country-floating">Status</label>
                                <select name="status" class="form-select" id="status">
                                    <option value="">--Select Status--</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="company-column">Start Price</label>
                                <input type="number" id="company-column" class="form-control" name="startAmount">
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="email-id-column">End Price</label>
                                <input type="number" id="email-id-column" class="form-control" name="endAmount">
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="company-column">Start Date</label>
                                <input type="date" id="company-column" class="form-control" name="startDate">
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="email-id-column">End Date</label>
                                <input type="date" id="email-id-column" class="form-control" name="endDate">
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
       </section>

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
                    <div class="table-responsive">
                        <table class="table mb-0 table-lg" >
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item Name</th>
                                    <th>Brand Name</th>
                                    <th>Image</th>
                                    <th>Cost Price</th>
                                    <th>Sell Price</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Active/Deactive</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="product-table-body">
                                <!-- Dynamic product rows will be injected here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>

<script>

$(document).ready(function() {

    function searchProducts() {
        $.ajax({
            url: '/admin/itemManagement/searchProducts', 
            method: 'GET',
            data: $('#search-form').serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    var products = response.data;
                    var productTableBody = $('#product-table-body'); // Your table body

                    // Clear current product list
                    productTableBody.empty();

                    // Map each product to a table row
                    products.forEach(function(product, index) {
                        var statusBadge = product.status == 1 
                        ? `<span class="badge bg-success">Active</span>` 
                        : `<span class="badge bg-danger">Deactive</span>`;

                        @if(Auth::guard('admin')->user()->product_permissions == 1 ) 
                            var statusActionButton = product.status == 1 
                            ? `<a href="/admin/cngItemStatus/${product.product_id}/0" class="btn btn-outline-warning">Deactive</a>` 
                            : `<a href="/admin/cngItemStatus/${product.product_id}/1" class="btn btn-outline-success">Active</a>`;
                        @else

                        var statusActionButton = product.status == 1 
                        ? `<a href="javascript:void(0)" onclick="showNoPermissionAlert()" class="btn btn-outline-warning">Deactive</a>` 
                        : `<a href="javascript:void(0)" onclick="showNoPermissionAlert()" class="btn btn-outline-success">Active</a>`;
                        @endif


                        @if(Auth::guard('admin')->user()->product_permissions == 1 ) 
                            var row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${product.item_name}</td>
                                    <td>${product.brand_name}</td>
                                    <td><img src="/uploads/${product.image}" alt="Product Image" width="50"></td>
                                    <td>Rs ${product.cost_price}</td>
                                    <td>Rs ${product.sell_price}</td>
                                    <td>${product.quantity}</td>
                                    <td>${statusBadge}</td>
                                    <td>${statusActionButton}</td> <!-- New TD for status toggle -->
                                    
                                    <td>
                                        <a href="/admin/itemManagement/itemEdit/${product.product_id}" class="btn btn-outline-primary">Edit</a>
                                        <a href="/admin/itemDelete/${product.product_id}" class="btn btn-outline-danger">Delete</a>
                                    </td>
                                </tr>
                            `;
                            productTableBody.append(row);
                        @else

                            var row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${product.item_name}</td>
                                    <td>${product.brand_name}</td>
                                    <td><img src="/uploads/${product.image}" alt="Product Image" width="50"></td>
                                    <td>Rs ${product.cost_price}</td>
                                    <td>Rs ${product.sell_price}</td>
                                    <td>${product.quantity}</td>
                                    <td>${statusBadge}</td>
                                    <td>${statusActionButton}</td> <!-- New TD for status toggle -->
                                    
                                   <td>
                                    <a href="javascript:void(0)" onclick="showNoPermissionAlert()" class="btn btn-outline-primary">Edit</a>
                                    <a href="javascript:void(0)" onclick="showNoPermissionAlert()" class="btn btn-outline-danger">Delete</a>
                                  </td>
                                </tr>
                            `;
                            productTableBody.append(row);

                        @endif
                       
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error: ", error);
            }
        });
    }

    searchProducts();

    // Trigger search when user submits the form
    $('#search-form').on('submit', function(e) {
        e.preventDefault(); 
        searchProducts(); 
    });
});


function showNoPermissionAlert() {
    Swal.fire({
        icon: "error",
        title: "Permission Denied",
        text: "You have no permission, please log in as super admin.",
        footer: ""
    });
}


</script>
@endsection