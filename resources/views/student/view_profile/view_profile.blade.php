@extends('layouts.student_index')

    @section('view_profile')
        <style>
            @import url('https://fonts.cdnfonts.com/css/play');
            .swal2-borderless .swal2-modal {
            /* background-color:#0d7395; */
            background-color:rgb(14, 75, 131);
            /* background-color:#0d3595; */
            color: white;
            border: 2px solid rgb(246, 246, 246);
            border-radius: 1rem;
            font-family: 'Play', sans-serif !important;       
                                            
        };
        </style>
        <div class="profile d-flex" >
            <div class="info">
                <table class="table__profile--sv">
                    <thead>
                    <tr>
                        <th scope="col" class="col-2 profile__title--sv align-middle">Tiêu Đề</th>
                        <th scope="col" class="col-3 profile__title--sv">Thông Tin</th>
                    </tr>
                    </thead>
    
                    <tbody>
                    
                        <tr>
                            <th scope="row">MSSV</th>
                            <td class="align-middle ">{{ $profile -> mssv}}</td>
                        </tr>
    
                        <tr>
                            <th scope="row">Họ tên</th>
                            <td class="align-middle ">{{ $profile -> ho_tenSV }}</td> 
                    </tr>
    
                        <tr>
                            <th scope="row">Giới tính</th>
                            <td class="align-middle">{{ $profile -> gioi_tinh }}</td> 
                    </tr>
    
                        <tr>
                            <th scope="row">Ngành học</th>
                            <td class="align-middle ">{{ $profile -> nganh_hoc }}</td> 
                    </tr>
    
                        <tr>
                            <th scope="row">Ngày sinh</th>
                            <td class="align-middle ">{{ date('d-m-Y',strtotime($profile -> ngay_sinh)) }}</td> 
                    </tr>
    
                        <tr>
                            <th scope="row">Email</th>
                            <td class="align-middle">{{ $profile -> email}}</td> 
                    </tr>
                    
                    </tbody>

                </table>
            </div>
      

        
            <div class="form__table">
                <div class="d-flex align-items-start w-100">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      <button class="nav-link active " id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" >Đơn Đăng Ký Phòng</button>
                      <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Đơn Chuyển Phòng</button>
                      <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Đơn Trả Phòng</button>
                      {{-- <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button> --}}
                    </div>
                    <div class="tab-content w-100" id="v-pills-tabContent ">
                      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        @if( $form )
                                <table class="table__form--register">
                                    
                                        <tbody>
                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Tên Đơn</th>
                                            <td colspan="2" class="text-end"> {{ $form->ten_loai }}</td>
                                        </tr>

                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Mã Phòng</th>
                                            <td colspan="2" class="text-end">{{ $form->ma_phong == null ?'Đã xóa':$form->ma_phong }}</td>
                                        </tr>

                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">MSSV</th>
                                            <td colspan="2" class="text-end">{{ $form->mssv }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Học Kỳ</th>
                                            <td colspan="2" class="text-end">{{ $form->hoc_ky }}</td>
                                        </tr>

                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Năm Học</th>
                                            <td colspan="2" class="text-end">{{ $form->nam_hoc }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Ngày Tạo</th>
                                            <td colspan="2" class="text-end">{{date('d-m-Y',strtotime($form-> ngay_tao)) }}</td>
                                        
                                        </tr>

                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Ngày Duyệt</th>
                                            <td colspan="2" class="text-end">{{ $form->ngay_duyet }}</td>
                                        </tr>

                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Trạng Thái</th>
                                            <td colspan="2" class="text-end">{{ $form->trang_thai == NULL ? "Chưa duyệt" : "Đã duyệt" }}</td>
                                        </tr>
                                        </tbody>
                                            <div><span style="color: red">Tổng đơn: </span>{{$countform}}</div>
                                </table>
                                    @if($form->trang_thai == NULL)
                                            <button type="button" class="btn btn-outline-danger cancle-form" onclick="showDialog(' {{ route('student.profile.cancle_form')}} ')">Hủy</button>
                                    @endif
                                
                            @else
                                <span>...</span>
                                
                            @endif
                      </div>
                      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            @if( $form_changes )
                                    <table class="table__form--register">
                                    
                                            <tbody>
                                            <tr>
                                                <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Tên Đơn</th>
                                                <td colspan="2" class="text-end"> {{ $form_changes->ten_loai }}</td>
                                            </tr>

                                            <tr>
                                                <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Mã Phòng</th>
                                                <td colspan="2" class="text-end">{{ $form_changes->ma_phong ==null ?'Đã xóa':$form_changes->ma_phong}}</td>
                                            </tr>

                                            <tr>
                                                <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">MSSV</th>
                                                <td colspan="2" class="text-end">{{ $form_changes->mssv }}</td>
                                            </tr>
                                            
                                            <tr>
                                                <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Học Kỳ</th>
                                                <td colspan="2" class="text-end">{{ $form_changes->hoc_ky }}</td>
                                            </tr>

                                            <tr>
                                                <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Năm Học</th>
                                                <td colspan="2" class="text-end">{{ $form_changes->nam_hoc }}</td>
                                            </tr>
                                            
                                            <tr>
                                                <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Ngày Tạo</th>
                                                <td colspan="2" class="text-end">{{date('d-m-Y',strtotime($form_changes-> ngay_tao)) }}</td>
                                            
                                            </tr>

                                            <tr>
                                                <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Ngày Duyệt</th>
                                                <td colspan="2" class="text-end">{{ $form_changes->ngay_duyet }}</td>
                                            </tr>

                                            <tr>
                                                <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Trạng Thái</th>
                                                <td colspan="2" class="text-end">{{ $form_changes->trang_thai == NULL ? "Chưa duyệt" : "Đã duyệt" }}</td>
                                            </tr>
                                            </tbody>
                                            <div><span style="color: red">Tổng đơn: </span>{{$countChangesForm}}</div>
                                    </table>
                               
                                    @if($form_changes->trang_thai == NULL)
                                            <button type="button" class="btn btn-outline-danger cancle-form" onclick="showDialog(' {{ route('student.profile.cancle_form_changes')}} ')">Hủy</button>
                                    @endif

                            @else
                                    <span>....</span>
                        
                            @endif
                      </div>

                      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            @if( $form_give_back)
                                <table class="table__form--register">
                                
                                        <tbody>
                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Tên Đơn</th>
                                            <td colspan="2" class="text-end"> {{  $form_give_back->ten_loai }}</td>
                                        </tr>

                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Mã Phòng</th>
                                            <td colspan="2" class="text-end">{{  $form_give_back->ma_phong ==null?'Đã xóa': $form_give_back->ma_phong}}</td>
                                        </tr>

                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">MSSV</th>
                                            <td colspan="2" class="text-end">{{  $form_give_back->mssv }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Học Kỳ</th>
                                            <td colspan="2" class="text-end">{{  $form_give_back->hoc_ky }}</td>
                                        </tr>

                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Năm Học</th>
                                            <td colspan="2" class="text-end">{{  $form_give_back->nam_hoc }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Ngày Tạo</th>
                                            <td colspan="2" class="text-end">{{date('d-m-Y',strtotime($form_give_back-> ngay_tao)) }}</td>
                                        
                                        </tr>

                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Ngày Duyệt</th>
                                            <td colspan="2" class="text-end">{{  $form_give_back->ngay_duyet }}</td>
                                        </tr>

                                        <tr>
                                            <th style =" border:0.2rem  rgb(211, 211, 211); border-style: none solid none none">Trạng Thái</th>
                                            <td colspan="2" class="text-end">{{  $form_give_back ->trang_thai == NULL ? "Chưa duyệt" : "Đã duyệt" }}</td>
                                        </tr>
                                        </tbody>
                                        <div><span style="color: red">Tổng đơn: </span>{{$countGiveBackForm}}</div>
                                </table>
                        
                                @if( $form_give_back->trang_thai == NULL)
                                        <button type="button" class="btn btn-outline-danger cancle-form" onclick="showDialog(' {{ route('student.register.student.profile.cancle_form_giveback')}} ')">Hủy</button>
                                @endif
                            @else
                                <span>....</span>
                            @endif
               
                    </div>  
                </div>
            </div>
             
                @if(($form != NULL && $form->trang_thai ==1) || ($form_changes != NULL && $form_changes->trang_thai  == 1 ) )
                        <button type="button" class="btn btn-danger give__back--room" onclick="showDialog2(' {{ route('student.register.create_give_back_room')}}')">Trả phòng</button>
                @endif
            </div>
    
            </div>
      
            <script>
                function showDialog(url){
                    event.preventDefault();
                    Swal.fire({
                        title: 'Xác nhận',
                        text: 'Bạn có chắc chắn muốn hủy?',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#04AA6D',
                        cancelButtonColor: 'rgb(246, 81, 81)',
                        confirmButtonText: 'Có',
                        cancelButtonText: 'Không',
                        customClass: {
                            container: 'swal2-borderless'
                        }
                    }).then((result) => {
      
                        if (result.isConfirmed) {

                            window.location.href =  `${url}`;
                                Swal.fire({
                                icon: 'success',
                                text: 'Hủy đơn thành công',
                                showConfirmButton: false,
                                timer: 2500
                                });
                            }
                    })
                }

                function showDialog2(url){
                    event.preventDefault();
                    Swal.fire({
                        title: 'Xác nhận',
                        text: 'Bạn có chắc chắn muốn trả phòng?',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#04AA6D',
                        cancelButtonColor: 'rgb(246, 81, 81)',
                        confirmButtonText: 'Có',
                        cancelButtonText: 'Không',
                        customClass: {
                            container: 'swal2-borderless'
                        }
                    }).then((result) => {
      
                        if (result.isConfirmed) {

                            window.location.href =  `${url}`;
                                Swal.fire({
                                icon: 'success',
                                text: 'Thành Công ! Vui lòng đợi duyệt',
                                showConfirmButton: false,
                                timer: 2500
                                });
                            }
                        })
                }
            </script>
        
    @endsection