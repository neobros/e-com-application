@extends('customer.layouts.head')
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

<main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Default</li> -->
                </ol>
                <!-- 
                    <nav class="product-pager ml-auto" aria-label="Product">
                        <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                            <i class="icon-angle-left"></i>
                            <span>Prev</span>
                        </a>

                        <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                            <span>Next</span>
                            <i class="icon-angle-right"></i>
                        </a>
                    </nav> -->
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="product-gallery product-gallery">
                                <div class="row">
                                    <figure class="product-main-image">
                                        <img style="" id="product-zoom"
                                            src="{{ asset('uploads/' . $productData->image) }}" alt="product image">
                                    </figure><!-- End .product-main-image -->
                                </div><!-- End .row -->
                            </div><!-- End .product-gallery -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-8">
                            <div class="product-details">
                                <h1 class="product-title">{{$productData->item_name}}</h1><!-- End .product-title -->
                                <div class="product-price">
                                    $ {{$productData->sell_price}}
                                </div><!-- End .product-price -->

                                <div class="details-filter-row details-row-size">
                                    <label for="size">Storage:</label>
                                    <div class="select-custom">
                                        <select name="storage" id="storage" class="form-control">
                                            <option value="" selected="selected">Select</option>
                                            @php
                                            $storageData = json_decode($productData->storage, true);
                                            @endphp
                                            @foreach($storageData as $data)

                                            @if($data == "64GB")
                                            <option value="64GB">64GB</option>
                                            @endif

                                            @if($data == "128GB")
                                            <option value="128GB">128GB</option>
                                            @endif

                                            @if($data == "256GB")
                                            <option value="256GB">256GB</option>
                                            @endif

                                            @if($data == "512GB")
                                            <option value="512GB">512GB</option>
                                            @endif

                                            @if($data == "1TB")
                                            <option value="1TB">1TB</option>
                                            @endif

                                            @if($data == "2TB")
                                            <option value="2TB">2TB</option>
                                            @endif

                                            @endforeach

                                        </select>
                                    </div><!-- End .select-custom -->

                                    <a href="#" class="size-guide"><i class="icon-th-list"></i>Select storage</a>
                                </div><!-- End .details-filter-row -->


                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="quantity" class="form-control" value="1" min="1"
                                            max="{{$productData->quantity}}" step="1" data-decimals="0" required>
                                    </div><!-- End .product-details-quantity -->   
                                    
                                    
                                </div><!-- End .details-filter-row -->

                                <div class="product-details-action">
                                    @if(Auth::guard('customer')->check())
                                    @if(count($cartDetails) > 0)
                                    <a href="javascript:void(0);" class="btn-product btn-cart"><span>Item Added
                                            Already</span></a>

                                    @else
                            
                                    <a href="javascript:void(0);"
                                        onclick="addToCart({{ $productData->product_id  }} , this)"
                                        class="btn-product btn-cart"><span>add to cart</span></a>
                                    @endif

                                    @else
                                    <a href="javascript:void(0);" onclick="needLogin()"
                                        class="btn-product btn-cart"><span>add to cart</span></a>
                                    @endif

                                    <div class="details-action-wrapper">
                                    <a href="#" class="size-guide"><i class="icon-th-list"></i>Rate Product</a>                            
                                    </div><!-- End .details-action-wrapper -->

                                    <div class="details-action-wrapper">

                                    @if(Auth::guard('customer')->check())
                                        <div class="rate" data-product-id="{{ $productData->product_id }}">
                                            <input type="radio" id="star5" name="rate" value="5" @if( isset($rateData->rate_count) && $rateData->rate_count == 5) checked @endif />
                                            <label for="star5" title="text">5 stars</label>

                                            <input type="radio" id="star4" name="rate" value="4" @if(isset($rateData->rate_count) && $rateData->rate_count == 4) checked @endif />
                                            <label for="star4" title="text">4 stars</label>

                                            <input type="radio" id="star3" name="rate" value="3" @if(isset($rateData->rate_count) && $rateData->rate_count == 3) checked @endif />
                                            <label for="star3" title="text">3 stars</label>

                                            <input type="radio" id="star2" name="rate" value="2" @if(isset($rateData->rate_count) && $rateData->rate_count == 2) checked @endif />
                                            <label for="star2" title="text">2 stars</label>

                                            <input type="radio" id="star1" name="rate" value="1" @if(isset($rateData->rate_count) && $rateData->rate_count == 1) checked @endif />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    @else  
                                        <div  onclick="needLogin()" class="rate" data-product-id="{{ $productData->product_id }}">
                                            <input  type="radio" id="star5" name="rate" value="5" disabled  />
                                            <label for="star5" title="text">5 stars</label>

                                            <input type="radio" id="star4" name="rate" value="4" disabled  />
                                            <label for="star4" title="text">4 stars</label>

                                            <input type="radio" id="star3" name="rate" value="3" disabled  />
                                            <label for="star3" title="text">3 stars</label>

                                            <input type="radio" id="star2" name="rate" value="2" disabled  />
                                            <label for="star2" title="text">2 stars</label>

                                            <input type="radio" id="star1" name="rate" value="1" disabled  />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    @endif
                              
                                    </div><!-- End .details-action-wrapper -->

                                </div><!-- End .product-details-action -->

                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Category:</span>

                                      
                                        <a href="#">{{$productData->brand_name}}</a>

                                        
                                    </div><!-- End .product-cat -->

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">Share:</span>
                                        <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="Twitter" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                    </div>
                                </div><!-- End .product-details-footer -->
                            </div><!-- End .product-details -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End .product-details-top -->

                <div class="product-details-tab">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab"
                                role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                        </li>
                        <!-- <li class="nav-item">
                                <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                            </li> -->
                        <li class="nav-item">
                            <a class="nav-link" id="product-shipping-link" data-toggle="tab"
                                href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab"
                                aria-selected="false">Shipping & Returns</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab"
                                role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                        </li> -->
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                            aria-labelledby="product-desc-link">
                            <div class="product-desc-content">

                                {!! $productData->description !!}

                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                            aria-labelledby="product-info-link">
                            <div class="product-desc-content">
                                <h3>Information</h3>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque
                                    volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non,
                                    semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum.
                                    Aliquam porttitor mauris sit amet orci. </p>

                                <h3>Fabric & care</h3>
                                <ul>
                                    <li>Faux suede fabric</li>
                                    <li>Gold tone metal hoop handles.</li>
                                    <li>RI branding</li>
                                    <li>Snake print trim interior </li>
                                    <li>Adjustable cross body strap</li>
                                    <li> Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
                                </ul>

                                <h3>Size</h3>
                                <p>one size</p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                            aria-labelledby="product-shipping-link">
                            <div class="product-desc-content">
                                <h3>Delivery & returns</h3>
                                <p>We deliver to over 100 countries around the world. For full details of the delivery
                                    options we offer, please view our <a href="#">Delivery information</a><br>
                                    We hope you’ll love every purchase, but if you ever need to return an item you can
                                    do so within a month of receipt. For full details of how to make a return, please
                                    view our <a href="#">Returns information</a></p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                            aria-labelledby="product-review-link">
                            <div class="reviews">
                                <h3>Reviews (2)</h3>
                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">Samanta J.</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 80%;"></div>
                                                    <!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                            </div><!-- End .rating-container -->
                                            <span class="review-date">6 days ago</span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4>Good, perfect size</h4>

                                            <div class="review-content">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum
                                                    dolores assumenda asperiores facilis porro reprehenderit animi culpa
                                                    atque blanditiis commodi perspiciatis doloremque, possimus,
                                                    explicabo, autem fugit beatae quae voluptas!</p>
                                            </div><!-- End .review-content -->

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div><!-- End .review-action -->
                                        </div><!-- End .col-auto -->
                                    </div><!-- End .row -->
                                </div><!-- End .review -->

                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">John Doe</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 100%;"></div>
                                                    <!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                            </div><!-- End .rating-container -->
                                            <span class="review-date">5 days ago</span>
                                        </div><!-- End .col -->
                                        <div class="col">
                                            <h4>Very good</h4>

                                            <div class="review-content">
                                                <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum
                                                    blanditiis laudantium iste amet. Cum non voluptate eos enim, ab
                                                    cumque nam, modi, quas iure illum repellendus, blanditiis
                                                    perspiciatis beatae!</p>
                                            </div><!-- End .review-content -->

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div><!-- End .review-action -->
                                        </div><!-- End .col-auto -->
                                    </div><!-- End .row -->
                                </div><!-- End .review -->
                            </div><!-- End .reviews -->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .product-details-tab -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

 <script>

    const rateInputs = document.getElementsByName('rate');
    const rateDisplay = document.getElementById('rateValue');
    const productId = document.querySelector('.rate').getAttribute('data-product-id');

    // Add event listeners to each radio button
    rateInputs.forEach((input) => {
        input.addEventListener('change', () => {
            $.ajax({
                url: '/updateRate',
                type: 'POST',  
                data: {
                    _token: '{{ csrf_token() }}',
                    rate_count: input.value,
                    product_id: productId,

                },
                success: function (response) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Rate added successfully!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function (xhr) {
                }

            });

        });
    });


    function addToCart(product_id, button) {

        var quantity = document.getElementById("quantity").value;
        var storage = document.getElementById("storage").value;
        
        if (!storage) {

            Swal.fire({
                    icon: "error",
                    title: "",
                    text: "Please select a storage",
                    footer: ''
                });
            return;  
        }

        $.ajax({
            url: '/addToCart',  
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',  
                product_id: product_id,   
                quantity: quantity,           
                storage: storage                   
            },
            success: function(response) {

             if(response.success == 1)
             {
         
                Swal.fire({
                    icon: "success",
                    position: "center",
                    text: response.message,
                    footer: ''
                });

                $(button).html('<span>Item Added Already</span>');
                $(button).attr('onclick', ''); // Remove the onclick attribute to disable future clicks
                // Disable the button to prevent further interaction
                $(button).prop('disabled', true);
                // Optionally, add a CSS class to change button appearance
                $(button).addClass('disabled');
            
             }
             else
             {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: {!! json_encode(\Session::get('delete')) !!},
                    footer: ''
                });

             }

            },
            error: function(xhr) {

                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: 'Something went wrong. Please try again.',
                    footer: ''
                });
            }
        });
    }
</script>

@endsection