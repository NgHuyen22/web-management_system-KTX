@extends('layouts.admin_index')
    @section('student_management')

        @if(Session::has('error'))
                <div class="alert-student-management alert-add alert alert-danger ">{{ Session::get('error') }}</div>
        @endif
      <div class="tool_student-management ">
              <form action="" method="get" class="search__keywords mb-3">
                @csrf

                <div class="container d-flex">
                    <div class="search_kw search">
                        <input type="search" class="form-control" name="keywords" placeholder="Từ khóa tìm kiếm..." value="{{request() ->keywords}}">
                    </div>
                
                    {{-- <div class="search__icon">
                            <a href="">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                    </div> --}}
                    <div class=" w-50">
                            <div class="col-2 w-100 search__button-st">
                                <button type ="submit" class=" btn btn-primary btn-block ">Tìm</button>
                            </div>
                    </div>      
                </div> 
            </form>

            {{-- <form action="{{ route('student_management.checked_delete_sv')}}"> --}}
                  <button type="submit" class="btn btn-danger delete__button" onclick="showDiaLogResult('{{ route('student_management.checked_delete_sv')}}')"><i class="fa-solid fa-trash-can-arrow-up delete__icon"></i>Delete</button>
            {{-- </form> --}}
          
      </div>

      <section class="intro student_management_list" id="" >
            <div class="bg-image h-100" style="background-color: #6095F0;">
              <div class="mask d-flex align-items-center h-100">
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-12">
                      <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                              <thead>
                                <tr>
                                  <th scope="col">
                                    {{-- <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    </div> --}}
                              </th>
                              <th scope="col" class="align-middle text-center">STT</th>
                              <th scope="col" class="align-middle text-center">MSSV</th>
                              <th scope="col" class="align-middle text-center">Họ Tên</th>
                              <th scope="col" class="align-middle text-center">Giới Tính</th>
                              <th scope="col" class="align-middle text-center">Ngành Học</th>
                              <th scope="col" class="align-middle text-center">Ngày Sinh</th>
                              <th scope="col" class="align-middle text-center">Email</th>
                              <th scope="col" class="align-middle text-center">Mã Phòng</th>
                              {{-- <th scope="col" class="align-middle text-center">Hành Động</th> --}}
                            </tr>
                          </thead>
                          <tbody>            
                            @php $count = ($profile_sv->currentPage() - 1) * $profile_sv->perPage() + 1; @endphp
                            @if(count(  $profile_sv ) > 0)
                            @foreach (  $profile_sv  as $row )
                                    <tr>
                                      <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                              </div>
                                        </th>
                                        <td class="align-middle text-center">{{$count++}}</td>
                                        <td class="align-middle text-center">{{$row-> mssv}}</td>
                                        <td class="align-middle text-center">{{$row-> ho_tenSV}}</td>
                                        <td class="align-middle text-center">{{$row-> email}}</td>
                                        <td class="align-middle text-center">{{$row-> nganh_hoc}}</td>
                                        <td class="align-middle text-center">{{date('d-m-Y',strtotime($row -> ngay_sinh))}}</td>
                                        <td class="align-middle text-center">{{$row-> email}}</td>
                                        <td class="align-middle text-center">{{$row-> ma_phong ==null ?'Đã xóa': $row-> ma_phong}}</td>                              
                                        {{-- <td >
                                          <form action="{{ route('student_management.delete_sv')}}" method="post" id="deleteForm">
                                              @csrf
                                              <button type="submit" class="btn btn-danger btn-sm px-3 delete_action--icon" >
                                                      <i class="fas fa-times"></i>
                                              </button>
                                              <input type = "hidden" name ="mssv" value ="{{$row-> mssv}}"/>
                                          </form>
                                        </td>    --}}
                                    </tr>
                                    @endforeach
                            @else
                                    <tr>
                                          <td colspan ="11" class="align-middle text-center">Không có dữ liệu</td>
                                    </tr> 
                            @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>  
            <div class="perpage-total d-flex">

                <div class="perpage">
                  {{$profile_sv ->appends(request() ->all())-> links()}}
                </div>
                <div class="total">
                      Tổng sinh viên : {{ $all_students }}
                      {{-- Số lượng : {{ count($profile_sv) }} --}}
                </div>
            </div>

            <script>
               document.getElementById('deleteForm').addEventListener('submit', function(event) {
                  // event.preventDefault();
                  
                            Swal.fire({
                                icon: 'success',
                                text: 'Xóa thành công',
                                showConfirmButton: false,
                                timer: 2500
                            });
                })

    
             function showDiaLogResult(url) {
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
                      const checkboxes = document.querySelectorAll('.form-check-input:checked');
                      const mssvValues = [];
                        checkboxes.forEach(checkbox => {
                            mssvValues.push(checkbox.parentElement.parentElement.nextElementSibling.nextElementSibling.textContent);
                        });
                        if (mssvValues.length > 0) {
                            let urlWithQuery = url + '?';
                            mssvValues.forEach((mssv, index) => {
                                if (index !== 0) {
                                    urlWithQuery += '&';
                                }
                                    urlWithQuery += 'mssv[]=' + encodeURIComponent(mssv);
                            });
                            window.location.href = urlWithQuery;
                              Swal.fire({
                                icon: 'success',
                                text: 'Xóa thành công !',
                                showConfirmButton: false,
                                timer: 2500
                                  });
                        }else{
                            Swal.fire({
                              icon: 'error',
                              title: 'Thất bại !!',
                              text: 'Vui lòng chọn nội dung cần xóa !',
                              showConfirmButton: false,
                              timer: 2500
                          });
                        }
                      }
              });
          }

            </script>
    @endsection