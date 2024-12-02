<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="#"><img src="/admin/assets/compiled/svg/logo.svg" alt="Logo"
                            srcset=""></a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                        height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                opacity=".3"></path>
                            <g transform="translate(-210 -1)">
                                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                <circle cx="220.5" cy="11.5" r="4"></circle>
                                <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                </path>
                            </g>
                        </g>
                    </svg>
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark"
                            style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>

        
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item  @if(\Request::is('admin/dashboard'))) active @endif ">
                    <a href="/admin/dashboard" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>


                </li>

                <li class="sidebar-title">Customer  &amp; Section</li>

                <li class="sidebar-item  has-sub  @if(\Request::is('admin/userManagement*'))) active @endif">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-circle"></i>
                        <span>User Management</span>
                    </a>

                    <ul class="submenu ">

                        <li class="submenu-item  @if(\Request::is('admin/userManagement/userList'))) active @endif ">
                            <a href="/admin/userManagement/userList" class="submenu-link">User List</a>
                        </li>

                        <li class="submenu-item @if(\Request::is('admin/userManagement/deactivateUserList'))) active @endif ">
                            <a href="/admin/userManagement/deactivateUserList" class="submenu-link">Deactivate User List</a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-title">Product  &amp; Section</li>

                <li class="sidebar-item  has-sub  @if(\Request::is('admin/brandManagement*'))) active @endif">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-slack"></i>
                        <span>Brand Management</span>
                    </a>

                    <ul class="submenu ">

                        <li class="submenu-item  @if(\Request::is('admin/brandManagement/addBrand'))) active @endif ">
                            <a href="/admin/brandManagement/addBrand" class="submenu-link">Add Brand</a>
                        </li>

                        <li class="submenu-item @if(\Request::is('admin/brandManagement/brandList'))) active @endif ">
                            <a href="/admin/brandManagement/brandList" class="submenu-link">Brand List</a>
                        </li>

                    </ul>
                </li>
                
                <li class="sidebar-item  has-sub  @if(\Request::is('admin/itemManagement*'))) active @endif">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-diagram-3-fill"></i>
                        <span>Item Management</span>
                    </a>

                    <ul class="submenu ">

                        <li class="submenu-item  @if(\Request::is('admin/itemManagement/addItems'))) active @endif ">
                            <a href="/admin/itemManagement/addItems" class="submenu-link">Add Items</a>
                        </li>

                        <li class="submenu-item @if(\Request::is('admin/itemManagement/itemsList'))) active @endif ">
                            <a href="/admin/itemManagement/itemsList" class="submenu-link">Item List</a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-title">Other</li>

                @if(Auth::guard('admin')->user()->role == 1 ) 
                    <li class="sidebar-item  has-sub  @if(\Request::is('admin/adminManagement*'))) active @endif">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-add"></i>
                            <span>Admin Management</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item  @if(\Request::is('admin/adminManagement/addAdmin'))) active @endif ">
                                <a href="/admin/adminManagement/addAdmin" class="submenu-link">Add Sub Admin</a>
                            </li>

                            <li class="submenu-item @if(\Request::is('admin/adminManagement/adminList'))) active @endif ">
                                <a href="/admin/adminManagement/adminList" class="submenu-link">Admin List</a>
                            </li>
                        </ul>
                   </li>
                @else
                    <li class="sidebar-item  has-sub @if(\Request::is('admin/adminManagement*')) active @endif">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-add"></i>
                            <span>Admin Management</span>
                        </a>

                        <ul class="submenu">
                            <li class="submenu-item @if(\Request::is('admin/adminManagement/addAdmin')) active @endif ">
                                <a href="#"  class="submenu-link no_permission">Add Sub Admin</a>
                            </li>

                            <li class="submenu-item @if(\Request::is('admin/adminManagement/adminList')) active @endif ">
                                <a href="#" class="submenu-link no_permission">Admin List</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <div class="modal fade text-left modal-borderless" id="border-less" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Border-Less</h5>
                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Bonbon caramels muffin. Chocolate bar oat cake cookie pastry dragée
                                            pastry. Carrot cake
                                            chocolate tootsie roll chocolate bar candy canes biscuit.
                                            Gummies bonbon apple pie fruitcake icing biscuit apple pie jelly-o sweet
                                            roll. Toffee sugar
                                            plum sugar plum jelly-o jujubes bonbon dessert carrot cake. Cookie
                                            dessert tart muffin topping
                                            donut icing fruitcake. Sweet roll cotton candy dragée danish Candy canes
                                            chocolate bar cookie.
                                            Gingerbread apple pie oat cake. Carrot cake fruitcake bear claw. Pastry
                                            gummi bears
                                            marshmallow jelly-o.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Accept</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


        

                <li class="sidebar-item  ">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class='sidebar-link'>
                        <i class="bi bi-box-arrow-in-left"></i>
                        <span>Log Out</span>
                    </a>
                </li>

                <form id="logout-form" action="/admin/logout" method="POST" style="display: none;">
                    @csrf
                </form>

            </ul>
        </div>


    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.no_permission');

        links.forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();

                // Show SweetAlert notification
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: 'You have no permission. Please log in as Super Admin.',
                    footer: ''
                });
            });
        });
    });
</script>