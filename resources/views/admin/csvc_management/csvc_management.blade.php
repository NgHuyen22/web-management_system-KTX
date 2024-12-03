@extends('layouts.admin_index')
    @section('csvc_management')
   
        @if(Session::has('error'))
            <div class="alert-csvc  alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        
        @if(Session::has('success'))
            <div class="alert-csvc  alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <ul class="nav nav-pills mb-3 nav_tabs list_nav" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">CSVC</button>
            </li>
            <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">CSVC Các Phòng</button>
            </li>
            <form action="" method="get" class="form__search mb-3">
                @csrf
    
                <div class="  container d-flex">
                    <div class=" search">
                        <input type="search" class="form-control" name="keywords" placeholder="Từ khóa tìm kiếm..." value="{{request() ->keywords}}">
                    </div>
                    
                    {{-- <div class="search__icon">
                            <a href="">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                    </div> --}}
                    <div class="search__icon w-50">
                            <div class="col-2 w-100">
                                <button type ="submit" class=" btn btn-primary btn-block ">Tìm</button>
                            </div>
                    </div>
                    
                </div> 
    
            </form>
            {{-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
            </li> --}}
        </ul>
        <div class="tab-content table_content_csvc" id="pills-tabContent">
            <div class="tab-pane fade show active content_csvc" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                 <table class="table">
                           <thead>
                                <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã CSVC</th>
                                        <th scope="col">Tên CSVC</th>
                                        <th scope="col">Số Lượng</th>
                                        <th scope="col" colspan="2"></th>
                                    </tr>
                             </thead>
                            <tbody class="table-group-divider">
                                                
                                    @php $count = 1; @endphp
                                    @if(count($allCsvcList) > 0)
                                        @foreach ($allCsvcList as $row )
                                        <tr>
                                            <th scope="row">{{$count++}}</th>
                                            <td>{{$row -> ma_csvc}}</td>
                                            <td>{{$row -> ten_csvc}}</td>
                                            <td>{{$row -> so_luong}}</td>
                                            <td>
                                                <div class="form-edit-delete d-flex">

                                               
                                                <form action="{{ route('csvc_management.edit_csvc',['ma_csvc' => $row->ma_csvc])}}" method="POST" class="edit_csvc_form">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-dark edit_csvc"><i class="fa-regular fa-pen-to-square edit_csvc-icon"></i>Sửa</button>
                                                </form>
                                                
                                                <form action="{{ route('csvc_management.delete_csvc')}}" method="POST" id="delete_csvc_form">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger delete_csvc"><i class="fa-regular fa-trash-can delete_csvc-icon"></i>Xóa</button>
                                                    <input type="hidden" name="ma_csvc" value="{{$row->ma_csvc}}">
                                                </form>
                                            </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                            <tr>
                                                <td colspan ="6" class="align-middle text-center">Không có dữ liệu</td>
                                            </tr> 
                                    @endif

                            </tbody>
                    </table>
                    <div><span>Tổng: {{$all_csvc }}</span></div>
            </div>
            
            <div class="tab-pane fade content_csvc" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                {{-- <button type="button" class="btn btn-light" onclick="refAdd('{{ route('csvc_management.add_csvc_room')}}')"><i class="fa-regular fa-square-plus"></i></button> --}}
                <form method="POST" action="{{ route('csvc_management.add_csvc_room') }}">
                    @csrf
                    <button type="submit" class="btn btn-light">
                        <i class="fa-regular fa-square-plus"></i>
                    </button>
                </form>
                
                <table class="table">
                    <thead>
                         <tr>
                                 <th scope="col">STT</th>
                                 <th scope="col">Mã CSVC</th>
                                 <th scope="col">Tên CSVC</th>
                                 <th scope="col">Số Lượng</th>
                                 <th scope="col"> Phòng</th>
                                 <th scope="col"> Dãy</th>
                                 <th scope="col" ></th>
                             </tr>
                      </thead>
                     <tbody class="table-group-divider">
                                         
                             @php $count = 1; @endphp
                             @if(count($allCsvc_RoomList) > 0)
                                 @foreach ($allCsvc_RoomList as $row )
                                 <tr>
                                     <th scope="row">{{$count++}}</th>
                                     <td>{{$row -> ma_csvc}}</td>
                                     <td>{{$row -> ten_csvc}}</td>
                                     <td>{{$row -> so_luong}}</td>
                                     <td>{{$row -> ten_phong}}</td>
                                     <td>{{$row -> ma_day}}</td>
                                     <td>
                                        

                                         <form action="{{route('csvc_management.delete_csvc_room')}}" method="POST" class="deleteForm">
                                            @csrf
                                            <button type="submit" class="btn btn-danger delete_csvc" ><i class="fa-regular fa-trash-can delete_csvc-icon"></i>Xóa</button>
                                            <input type="hidden" name="ma_csvc" value="{{$row->ma_csvc}}">
                                        </form>
                                    </td>
                                 </tr>
                                 @endforeach
                             @else
                                     <tr>
                                         <td colspan ="7" class="align-middle text-center">Không có dữ liệu</td>
                                     </tr> 
                             @endif

                     </tbody>
             </table>
            </div>
            {{-- <div class="tab-pane fade content_csvc" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div> --}}
         </div>
            
    <script>
            function showDiaLog(url){
                Swal.fire({
                        title: 'Xác nhận',
                        text: 'Bạn có chắc chắn muốn xóa?',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#04AA6D',
                        cancelButtonColor: 'rgb(246, 81, 81)',
                        confirmButtonText: 'Xóa',
                        cancelButtonText: 'Hủy',
                        customClass: {
                            container: 'swal2-borderless'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
            }

            document.getElementById("delete_csvc_form").addEventListener("submit", function(event) {
                event.preventDefault();
                  Swal.fire({
                      title: 'Xác nhận',
                      text: 'Bạn có chắc chắn muốn xóa?',
                      icon: 'info',
                      showCancelButton: true,
                      confirmButtonColor: '#04AA6D',
                      cancelButtonColor: 'rgb(246, 81, 81)',
                      confirmButtonText: 'Xóa',
                      cancelButtonText: 'Hủy',
                      customClass: {
                          container: 'swal2-borderless'
                      }
                  }).then((result) => {
                      if (result.isConfirmed) {
                        // openEvent(event);
                          // window.location.href = "{{ route('student.register.cancle_csvc_repair_form') }}"; 
                          document.getElementById("delete_csvc_form").submit();
                          Swal.fire({
                              icon: 'success',
                              text: 'Xóa thành công !',
                              showConfirmButton: false,
                              timer: 2000
                          });
                      }
                  });
              });

        // function refAdd(url){
        //     window.location.href = url;
        // }
        
    </script>

    @endsection
