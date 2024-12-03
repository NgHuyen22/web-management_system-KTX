<div class="menu-index container-fluid">
    <div class="row flex-nowrap">
        <div class="side_bar col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark height-menu1">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 height-menu ">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Menu</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item w-100 ">
                        <a href="{{ route('student.profile')}}" class=" nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline" style="color: white;text-align:center;">Xem thông tin cá nhân</span>
                        </a>
                    </li>
                    <li style="width: 12rem;">
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2 "></i> <span class="ms-1 d-none d-sm-inline " style="color: white;text-align:center;" >Đăng ký</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100 ">
                                <a href="{{ route('student.register.room_registration')  }}" class="active nav-link px-0"> <span class=" chill-item d-none d-sm-inline" style="color: white;text-align:center;" >Đăng ký phòng</span> </a>
                            </li>
                        
                            {{-- <li class="">
                                <a href="#" class="active nav-link px-0 "> <span class="chill-item d-none d-sm-inline" style="color: white;text-align:center;">Chuyển phòng</span> </a>
                            </li>

                            <li>
                                <a href="#" class="active nav-link px-0"> <span class="d-none d-sm-inline" style="color: white;text-align:center;">Trả phòng</span> </a>
                            </li> --}}

                            <li>
                                <a href="{{ route('student.register.register_repair_csvc') }}" class="active nav-link px-0"> <span class="d-none d-sm-inline" style="color: white; text-align:center;"> Sửa chửa CSVC</span> </a>
                            </li>
                        </ul>
                    </li>
                 
                    <li style="width:12rem">
                        <a href="#submenu2 " data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline" style="color: white;text-align:center;" >Xem tình trạng đóng phí</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="{{route('view_payment_status1')}}" class="active nav-link px-0"> <span class="d-none d-sm-inline" style="color: white;text-align:center;">Xem phí phòng</span></a>
                            </li>
                            <li>
                                <a href="#" class="active nav-link px-0"> <span class="d-none d-sm-inline" style="color: white;text-align:center;">Xem phí điện, nước</span> </a>
                            </li>
                        </ul>
                    </li>
                    <li style="width:12rem">
                        {{-- <a href="{{route('pay')}}" data-bs-toggle="collapse" class="nav-link px-0 align-middle"> --}}
                            <a href="{{route('pay')}}" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline" style="color: white;text-align:center;">Thanh toán</span> </a>
                    </li>
                    <li style="width:12rem">
                        <a href="{{URL :: to('/student_index')}}" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline"style="color: white;text-align:center;">Trang chủ</span> </a>
                    </li>
                    <li>
                    
                        
                    </li>
                    {{-- <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline"style="color: white;text-align:center;">Trang chủ</span> </a>
                    </li> --}}
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false" style="margin-bottom: 5.5rem; margin-left:1.6rem">
                        <i class="fa-solid fa-circle-user"></i>
                        <span class="d-none d-sm-inline mx-1 text-center align-middle">{{ Session('hoten_sv')}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        {{-- <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li> --}}
                        {{-- <li>
                            <hr class="dropdown-divider">
                        </li> --}}
                        <li><a class="dropdown-item" href="{{ route('student.logout')}}">Đăng xuất</a></li>
                    </ul>
                </div>
                
            </div>
        </div>
        <div class="w-75 py-3 wrapper_img">
               {{-- @yield('content_home') --}}
               @yield('content_index')
               @yield('view_profile') 
               @yield('room_content')
               @yield('create_form')
               @yield('register_repair_csvc')
               @yield('view_payment_status')
               @yield('pay')
               {{-- @yield('add_content') --}}
           
        </div>
    </div>
</div>

<script>
    // $(document).ready(function() {
    //     $('.nav-link').click(function() {
    //         // Xóa lớp "active" khỏi tất cả các mục con
    //         $('.chill-item').removeClass('active');

    //         // Thêm lớp "active" cho mục con tương ứng với mục cha được nhấp vào
    //         $(this).next('.collapse').find('.chill-item').toggleClass('active');
    //     });
    // });

</script>