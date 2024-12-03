<div class="l-navbar nav_menu--admin" id="nav-bar"> 
    <nav class="nav menu_admin">
        <div> <a href="{{URL::to('profile_cbql')}}" class="nav_logo"> <i class="fa-solid fa-user-pen" style="color:white;"></i> <span class="nav_logo-name ">Xem thông tin </span> </a>
            <div class="nav_list"> 
                <a href="{{URL::to('/area_management')}}" class="nav_link active"><i class="fa-solid fa-house" style = "color:white;" ></i><span class="nav_name ">Quản Lý Khu</span> </a>
                <a href="{{URL ::to('/room_management')}}" class="nav_link active"><i class="fa-solid fa-house-lock" style="color:white;"></i><span class="nav_name ">Quản Lý Phòng</span> </a>
                <a href="{{ route('bills_management') }}" class="nav_link"> <i class="fa-solid fa-money-bill-wave" style="color:white;"></i> <span class="nav_name ">Quản lý hóa đơn</span> </a>
                <a href="{{URL::to('/csvc_management')}}" class="nav_link"> <i class="fa-solid fa-hammer" style="color:white;"></i> <span class="nav_name">Quản lý CSVC</span> </a> 
                <a href="{{ route('approve_request')}}" class="nav_link"> <i class="fa-solid fa-clipboard" style="color:white;"></i> <span class="nav_name">Duyệt yêu cầu</span> </a> 
                <a href="{{ route('student_management')}}" class="nav_link"> <i class="fa-solid fa-user-plus" style="color:white;"></i><span class="nav_name">Quản lý sinh viên</span> </a> 
                <a href="{{URL::to('/')}}" class="nav_link"><i class="fa-solid fa-house" style="color:white"></i> <span class="nav_name">Trang Chủ</span> </a> 
            </div>
        </div> 
        <a href="{{route('admin.logout')}}" class="nav_link">  <i class="fa-solid fa-power-off" style='color:white;'></i> <span class="nav_name" style="font-size: 1rem;">Đăng xuất</span> </a>
    </nav>
</div>