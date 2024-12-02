@extends('customer.layouts.head')
@section('content')
<main class="main">
        <div class="page-header text-center"
            style="background-image: url('/customer/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <table id="cartTable" class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>storage</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $totalCost = 0;
                                    @endphp
                                    @foreach($cartData as $data)

                                        @php
                                            $totalCost += $data->sell_price * $data->cartsQuantity;
                                        @endphp
                                    <tr  id="row{{ $data->cart_id }}" >
                                        <td class="product-col">
                                            <div class="product">
                                                <figure class="product-media">
                                                    <a href="#">
                                                        <img src="{{ asset('uploads/' . $data->image) }}"
                                                            alt="Product image">
                                                    </a>
                                                </figure>

                                                <h3 class="product-title">
                                                    <a href="#">{{$data->item_name}}</a>
                                                </h3><!-- End .product-title -->
                                            </div><!-- End .product -->
                                        </td>
                                        <td class="price-col">
                                            <div class="cart-product-quantity">
                                                <select name="size" id="size" class="form-control"
                                                    onchange="updateSize(this.value, {{ $data->cart_id }})">

                                   
                                                    @php
                                                    $storageData = json_decode($data->storage, true);
                                                    @endphp
                                                    @foreach($storageData as $dataStorage)

                                                  

                                                    @if($dataStorage == "64GB")
                                                    <option  @if($data->cartStorage == $dataStorage ) selected @endif value="64GB">64GB</option>
                                                    @endif

                                                    @if($dataStorage == "128GB")
                                                    <option @if($data->cartStorage == $dataStorage ) selected @endif value="128GB">128GB</option>
                                                    @endif

                                                    @if($dataStorage == "256GB")
                                                    <option @if($data->cartStorage == $dataStorage ) selected @endif value="256GB">256GB</option>
                                                    @endif

                                                    @if($dataStorage == "512GB")
                                                    <option @if($data->cartStorage == $dataStorage ) selected @endif value="512GB">512GB</option>
                                                    @endif

                                                    @if($dataStorage == "1TB")
                                                    <option @if($data->cartStorage == $dataStorage ) selected @endif value="1TB">1TB</option>
                                                    @endif

                                                    @if($dataStorage == "2TB")
                                                    <option @if($data->cartStorage == $dataStorage ) selected @endif value="2TB">2TB</option>
                                                    @endif

                                                    @endforeach

                                            </div>
                                            </select>
                                        </td>

                                        <td class="price-col">${{$data->sell_price}}</td>

                                        <td class="quantity-col">
                                            <div class="cart-product-quantity">
                                                <input  value="{{ $data->cartsQuantity ?? 1 }}" type="number"
                                                    class="form-control" value="1" min="1" max="{{ $data->quantity }}" step="1"
                                                    data-decimals="0" required
                                                    onchange="updateQuantity( this.value, {{ $data->cart_id }} , {{ $data->sell_price }})">
                                            </div><!-- End .cart-product-quantity -->
                                        </td>

                                        <td id="{{ $data->cart_id }}" class="total-col">${{$data->sell_price *
                                            $data->cartsQuantity }}</td>
                                        <td class="remove-col">
                                            <button class="btn-remove" onclick="removeRow({{ $data->cart_id }})">
                                                <i class="icon-close"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table><!-- End .table table-wishlist -->

                            <div class="cart-bottom">
                                <!-- <div class="cart-discount">
			            				<form action="#">
			            					<div class="input-group">
				        						<input type="text" class="form-control" required placeholder="coupon code">
				        						<div class="input-group-append">
													<button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
												</div>
			        						</div>
			            				</form>
			            			</div> -->

                                <!-- <a href="/viewCart" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a> -->
                            </div><!-- End .cart-bottom -->
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">


                            <form method="POST" action="/checkout">
                                @csrf
                                <div class="summary summary-cart">
                                    <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                                    <table class="table table-summary">
                                        <tbody>

                                            <tr class="summary-shipping">
                                                <td>Name:</td>
                                                <td>&nbsp; {{Auth::guard('customer')->user()->fname}}</td>
                                            </tr>

                                            
                                            <tr class="summary-shipping">
                                                <td>Phone Number:</td>
                                                <td>&nbsp; {{Auth::guard('customer')->user()->contact}}</td>
                                            </tr>

                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input checked type="radio" id="free-shipping" value="1"
                                                            name="shipping" class="custom-control-input">
                                                        <label class="custom-control-label" for="free-shipping">Free
                                                            Shipping</label>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>

                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="standart-shipping" value="0"
                                                            name="shipping" class="custom-control-input">
                                                        <label class="custom-control-label" for="standart-shipping">Take
                                                            Away</label>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>


                                            <tr class="summary-total">
                                                <td>Total:</td>
                                                <td id="totalPrice">${{ $totalCost}}</td>
                                            </tr><!-- End .summary-total -->
                                        </tbody>
                                    </table><!-- End .table table-summary -->

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED
                                        TO CHECKOUT</button>
                                </div><!-- End .summary -->

                            </form>

                            <!-- <a href="category.html" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a> -->

                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .cart -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

    <script>
        function updateSize(selectedStorage, cart_id) {
            $.ajax({
                url: '/updateCartSize',
                type: 'POST',  // Using GET method
                data: {
                    _token: '{{ csrf_token() }}',
                    selectedStorage: selectedStorage,
                    cart_id: cart_id
                },
                success: function (response) {
                    //document.getElementById("totalPrice").textContent = response.data + ".00";
                },
                error: function (xhr) {


                }
            });
        }


        function updateQuantity(quantity, cart_id, price  ) {
            var total = price * quantity;
          
            document.getElementById(cart_id).textContent = total; 
            $.ajax({
                url: '/updateQuantity',  
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', 
                    cart_id: cart_id,             
                    quantity: quantity          
                },
                success: function (response) {
                    document.getElementById("totalPrice").textContent =  "$"+response.data;
                },
                error: function (xhr) {

                }
            });
        }


        function removeRow(rowId) {
            Swal.fire({
                title: "Are you sure you want to remove this?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/removeCartRow',  
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', 
                            cart_id: rowId,                   
                        },
                        success: function (response) {
                            document.getElementById("totalPrice").textContent =  "$"+response.data;
                              // Show success message
                            Swal.fire({
                                title: "Deleted!",
                                text: "The row has been deleted.",
                                icon: "success"
                            });

                            // Remove the row
                            const row = document.getElementById(`row${rowId}`);
                            if (row) {
                                row.remove();
                            }
                        },
                        error: function (xhr) {

                        }
                    });

                  
                }
            });
        }

    </script>

@endsection