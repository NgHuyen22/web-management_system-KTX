<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('admin/ad_css/admin_index.css')}}">
    <link rel="stylesheet" href="{{asset('admin/ad_css/view profile/view_profile.css')}}">
    <link rel="stylesheet" href="{{asset('admin/ad_css/area_management.css')}}">
    <link rel="stylesheet" href="{{asset('admin/ad_css/add_area.css')}}">
    <link rel="stylesheet" href="{{asset('admin/ad_css/update_area.css')}}">
    <link rel="stylesheet" href="{{asset('admin/ad_css/room_management/room_index.css')}}">
    <link rel="stylesheet" href="{{asset('admin/ad_css/bill_management/bill_management.css')}}">
    <link rel="stylesheet" href="{{asset('admin/ad_css/room_management/add_room.css')}}">
    <link rel="stylesheet" href="{{asset('admin/ad_css/room_management/update_room.css')}}">
    <link rel="stylesheet" href="{{asset('admin/ad_css/approve_request/approve_request.css')}}">
    <link rel="stylesheet" href="{{asset('admin/ad_css/student_management/student_management.css')}}">
    <link rel="stylesheet" href="{{asset('admin/ad_css/csvc_management/csvc_management.css')}}">
    
    

    {{-- <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="body-pd">

  
        @include ('admin.header')

        {{-- @include('admin.home') --}}
        @yield('content')
        @yield('view_profile')
        @yield('area_content')
        @yield('add_area')
        @yield('edit_area')
        @yield('delete_area')
        @yield('room_content')
        @yield('bills')
        @yield('add_room')
        @yield('edit_room')
        @yield('approve_request')
        @yield('csvc_management')
        @yield('student_management')
        @yield('edit_csvc_room')
        @yield('add_csvc_room')
        @include ('admin.menu')
        {{-- @include ('admin.main') --}}
        {{-- @include('sweetalert::alert') --}}

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="{{asset('admin/ad_js/menu.js')}}" ></script>
<script src="{{asset('admin/ad_js/button.js')}}"></script>
<script src="{{asset('admin/ad_js/swiper.js')}}"></script>
<script src="{{asset('admin/ad_js/swiper_images.js')}}"></script>
{{-- <script type="module" src="{{asset('admin/ad_js/alert.js')}}"></script> --}}




</body> 

</html>