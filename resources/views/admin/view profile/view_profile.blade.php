@extends('layouts.admin_index')

    @section('view_profile')

 
    <table class="table__profile">
        <thead>
        <tr>
            <th scope="col" class="col-2 table__profile--title align-middle">Tiêu Đề</th>
            <th scope="col" class="col-3 table__profile--title">Thông Tin</th>
           
           
        </tr>
        </thead>

        <tbody>
           
            <tr>
                <th scope="row">MSCB</th>
                <td class="align-middle text-center">{{ $profile -> mscb}}</td>
            </tr>

            <tr>
                <th scope="row">Họ tên</th>
                <td class="align-middle text-center">{{ $profile -> hoten }}</td> 
           </tr>

            <tr>
                <th scope="row">Giới tính</th>
                <td class="align-middle text-center">{{ $profile -> gioitinh }}</td> 
           </tr>

            <tr>
                <th scope="row">Chức vụ</th>
                <td class="align-middle text-center">{{ $profile -> chucvu }}</td> 
           </tr>

            <tr>
                <th scope="row">Email</th>
                <td class="align-middle text-center">{{ $profile -> email}}</td> 
           </tr>
           
        </tbody>
        
        
        
    @endsection