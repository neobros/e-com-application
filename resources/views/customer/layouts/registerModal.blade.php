    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form id="login" method="POST" action="/login">
                                    @csrf
                                        <div class="form-group">
                                            <label for="singin-email">Username or email address *</label>
                                            <input type="text" class="form-control"  name="email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control"  name="password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                            </div>

                                            <a href="#" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>                    
                                </div>

                                

                                <script>
                                    $('#login').on('submit', function (e) {
                                        e.preventDefault(); 

                                        const formData = $(this).serialize();

                                        $.ajax({
                                            url: '/login', 
                                            method: 'POST',
                                            data: formData,
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                            },
                                            success: function (response) {
                                                if (response.success) {
                                                    window.location.href = '/'; // Redirect to dashboard or desired location
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
                                                    alert('Something went wrong. Please try again.');
                                                }
                                            },
                                        });
                                    });    
                                </script>



                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <form id="registerModel" method="POST" action="/register">
                                    @csrf
                                        <div class="form-group">
                                            <label for="register-email">Your First Name *</label>
                                            <input type="text" class="form-control"  name="fname" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="register-email">Your Last Name *</label>
                                            <input type="text" class="form-control"  name="lname" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control"  name="email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-email">Address  *</label>
                                            <input type="text" class="form-control"  name="address" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="register-email">Contact Number *</label>
                                            <input type="number" value="" class="form-control"  name="contact" required>
                                        </div>      

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Confirm Password *</label>
                                            <input type="password" class="form-control" name="password_confirmation" required>
                                        </div><!-- End .form-group -->
                                        

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                   

                                    <script>
                                        $(document).ready(function () {
                                            $('#registerModel').on('submit', function (e) {
                                                e.preventDefault();

                                                $('.form-group').removeClass('has-error');
                                                $('.form-group .error-message').remove();

                                                const formData = $(this).serialize();

                                                $.ajax({
                                                    url: '/register', 
                                                    method: 'POST',
                                                    data: formData,
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                                    },
                                                    success: function (response) {
                                                        //alert(response.message); 
                                                        window.location.href = '/'; 
                                                    },
                                                    error: function (xhr) {
                                                        if (xhr.status === 422) {
                                                            const errors = xhr.responseJSON.errors;

                                                            // Display validation errors
                                                            for (const key in errors) {
                                                                const field = $('[name="' + key + '"]');
                                                                field.closest('.form-group')
                                                                    .addClass('has-error')
                                                                    .append('<span class="error-message text-danger">' + errors[key][0] + '</span>');
                                                            }
                                                        } else {
                                                            alert('Something went wrong. Please try again.');
                                                        }
                                                    },
                                                });
                                            });
                                        });
                                    </script>

                                </div>
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->