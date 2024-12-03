
<header class="header" id="header">
    <div class="headr__nav">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </div>
    <div class="header__content">
        
        <!-- <nav class="heading__nav">
            <ul id="list">
                <li class="list__item"><a href="admin.php">
                    <i class="fa-solid fa-house"></i>
                    Trang chủ
                </a>
            </li>
            <li class="list__item"><a href="admin.php?nav=dangxuat">
                <i class="fa-solid fa-power-off"></i>
                Đăng xuất
            </a>
        </li>
        <li class="list__item"><a href="admin.php?nav=hotro">
            <i class="fa-solid fa-question"></i>
            Hỗ Trợ
        </a>
    </li>
</ul>
</nav> -->
        <div class="heading__img">
            <i class="fa-solid fa-circle-user"></i>
            
            <span class="username">{{Session('hoten')}}</span>
        </div>

        <div class = heading__container>
            
            <div class="heading__content">
                <p class = "heading__content--sys" >Hệ Thống Quản Lý KTX</p> 
            </div>
            
            <div class="heading__logo">
                  <img src="{{asset('images/Logo_Dai_hoc_Can_Tho.svg.png')}}" alt="" class="heading__logo--img">
            </div>
        </div>
</header>