@extends('layouts.student_index')

    @section('register_repair_csvc')

    @if(!$form)
   
          <div class="error_no_room">Bạn chưa có phòng ,Vui lòng đăng ký phòng !!</div>
    @else
    

      <div class="alert-form">

            <form action="" class="form__register_repair_csvc" id="form__register_repair_csvc"method="POST">
                @csrf
                    <label for="csvc"> <i class="fa-solid fa-asterisk asterisk"></i></label>
                    <select class="form-select select_csvc" id="csvc" name="csvc" aria-label="Default select example" id="csvc">
                        <option selected disabled>Chọn CSVC...</option>
                          @foreach ($csvc as $cs)
                                <option value="{{ $cs->ma_csvc }}">{{ $cs->ten_csvc }}</option>
                        @endforeach
                      </select>
                      <div class="tool_repair">
                            <label for="soluong" class="label">Số Lượng <i class="fa-solid fa-asterisk asterisk"></i></label>
                          <input class="form-control textbox" id="soluong" name="soluong" type="text"  aria-label="default input example" id="soluong">

                      </div>
                      <div class="tool_repair">
                          <label for="tinhtrang" class="label">Tình Trạng <i class="fa-solid fa-asterisk asterisk"></i></label>
                          <input class="form-control textbox" id="tinhtrang" name="tinhtrang" aria-label="default input example" id="tinhtrang">
                      </div>

                      <div class="tool_repair">
                          <label for="maphong" class="label">Vị Trí Sửa <i class="fa-solid fa-asterisk asterisk"></i></label>
                          <input class="form-control textbox" id="maphong"  type="text" aria-label="default input example" placeholder="{{ $maphong }}" disabled>
                          <input type="hidden" name="maphong" value="{{ $maphong }}">
                      </div>

                      <div class="tool_repair">
                          <label for="hk" class="label">Học Kỳ <i class="fa-solid fa-asterisk asterisk"></i></label>
                          <select class="form-select cursor" id="hk" name = "hk">
                                <option selected disabled>Chọn...</option>
                                <option value="1" {{request() -> hk == "1" ? 'selected' : ''}}>1</option>
                                <option value="2" {{request() -> hk == "2" ? 'selected' : ''}}>2</option>
                          </select>
                      </div>

                      <div class="tool_repair">
                          <label for="nh" class="label">Năm Học</label>
                          <input class="form-control textbox" id="nh" name="nh" aria-label="default input example" placeholder="{{ $namhoc }}" disabled>
                          <input type="hidden" name="nh" value="{{ $namhoc }}">
                      </div>

                    <button type="submit" class="btn btn-outline-primary button_register_repair">Đăng Ký</button>
            </form>

            @if(Session::has('error'))
                  <div class="alert-csvc_repair alert-add alert alert-danger">{{ Session::get('error') }}</div>
            @endif
      </div>
      @if($formRepair)
          <section class="intro " id="">
            <div class="bg-image h-100 " style="background-color: #6095F0;">
                    <div class="mask d-flex align-items-center h-100">
                      <div class="container">
                        <div class="row justify-content-center">
                          <div class="col-12">
                            <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                              <div class="card-body ">
                                <div class="table-responsive">
                                  <table class="table table-borderless mb-0 tabel_register_repair">
                                    <thead>
                                      <tr>
                                        
                                        <th scope="col" class="align-middle text-center">STT</th>
                                        <th scope="col" class="align-middle text-center">Tên Đơn</th>
                                        <th scope="col" class="align-middle text-center">Tên CSVC</th>
                                        {{-- <th scope="col">Tên Loại Đơn</th> --}}
                                        <th scope="col" class="align-middle text-center">Số Lượng Sửa</th>
                                        <th scope="col" class="align-middle text-center">Tình Trạng</th>
                                        <th scope="col" class="align-middle text-center">Vị Trí Sửa</th>
                                        <th scope="col" class="align-middle text-center">Họ Tên SV</th>
                                        <th scope="col" class="align-middle text-center">Ngày Đăng Ký</th>
                                        <th scope="col" class="align-middle text-center">Ngày Duyệt</th>
                                        <th scope="col" class="align-middle text-center">Trạng Thái</th>
                                        <th scope="col" class="align-middle text-center">Hành Động</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                          @php $count = 1; @endphp
                                          @if(count($allForm) > 0)
                                              @foreach ($allForm as $row )
                                                  <tr>
                                                          <td class="align-middle text-center">{{$count++}}</td>
                                                          <td class="align-middle text-center">{{ $row -> ten_loai }}</td>
                                                          <td class="align-middle text-center">{{$row-> ten_csvc }}</td>
                                                          <td class="align-middle text-center">{{$row-> so_luong}}</td>
                                                          <td class="align-middle text-center">{{$row-> tinh_trang }}</td>
                                                          <td class="align-middle text-center">{{$row-> vi_tri_sua}}</td>
                                                          <td class="align-middle text-center">{{$row-> ho_tenSV}}</td>
                                                          <td class="align-middle text-center">{{date('d-m-Y',strtotime($row-> ngay_tao))}}</td>
                                                          <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                                          <td class="align-middle text-center">{{ $row->trang_thai == NULL ? "Chưa sửa" : "Đã sửa"}}</td>
                                                          <td >
                                                        @if($check ==null)
                                                                <form action="{{route('student.register.cancle_csvc_repair_form')}}" method="POST" id="cancleForm" class="cancle_repair_form" >
                                                                  {{-- @method('PATCH') --}}
                                                                    @csrf
                                                                        <button type="submit" class="btn btn-danger btn-sm px-3 button_register_repair" >
                                                                          <i class="fas fa-times"></i>
                                                                      </button>
                                                                      <input type = "hidden" name ="ma_sua_csvc" value ="{{$row-> ma_sua_csvc}}"/>
                                                                </form>
                                                          @else
                                                                    <form action="" method="POST" id="cancleForm" class="cancle_repair_form" >
                                                                        {{-- @method('PATCH') --}}
                                                                          @csrf
                                                                              <button type="submit" class="btn btn-danger btn-sm px-3 button_register_repair" disabled>
                                                                                <i class="fas fa-times"></i>
                                                                            </button>
                                                                            <input type = "hidden" name ="ma_sua_csvc" value ="{{$row-> ma_sua_csvc}}"/>
                                                                      </form>
                                                            @endif
                                                          </td>   
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
              
          
            @elseif($formNull != null)
            <section class="intro " id="">
                <div class="bg-image h-100 " style="background-color: #6095F0;">
                        <div class="mask d-flex align-items-center h-100">
                          <div class="container">
                            <div class="row justify-content-center">
                              <div class="col-12">
                                <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                                  <div class="card-body ">
                                    <div class="table-responsive">
                                      <table class="table table-borderless mb-0 tabel_register_repair">
                                        <thead>
                                          <tr>
                                            
                                            <th scope="col" class="align-middle text-center">STT</th>
                                            <th scope="col" class="align-middle text-center">Tên Đơn</th>
                                            <th scope="col" class="align-middle text-center">Tên CSVC</th>
                                            {{-- <th scope="col">Tên Loại Đơn</th> --}}
                                            <th scope="col" class="align-middle text-center">Số Lượng Sửa</th>
                                            <th scope="col" class="align-middle text-center">Tình Trạng</th>
                                            <th scope="col" class="align-middle text-center">Vị Trí Sửa</th>
                                            <th scope="col" class="align-middle text-center">Họ Tên SV</th>
                                            <th scope="col" class="align-middle text-center">Ngày Đăng Ký</th>
                                            <th scope="col" class="align-middle text-center">Ngày Duyệt</th>
                                            <th scope="col" class="align-middle text-center">Trạng Thái</th>
                                            <th scope="col" class="align-middle text-center">Hành Động</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                              @php $count = 1; @endphp
                                              @if(count($formNull) > 0)
                                                  @foreach ($formNull as $row )
                                                      <tr>
                                                              <td class="align-middle text-center">{{$count++}}</td>
                                                              <td class="align-middle text-center">{{ $row -> ten_loai }}</td>
                                                              <td class="align-middle text-center">{{ $row-> ma_csvc == null?"csvc đã xóa":$row-> ma_csvc}}</td>
                                                              <td class="align-middle text-center">{{$row-> so_luong}}</td>
                                                              <td class="align-middle text-center">{{$row-> tinh_trang }}</td>
                                                              <td class="align-middle text-center">{{$row-> vi_tri_sua}}</td>
                                                              <td class="align-middle text-center">{{$row-> ho_tenSV}}</td>
                                                              <td class="align-middle text-center">{{date('d-m-Y',strtotime($row-> ngay_tao))}}</td>
                                                              <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                                              <td class="align-middle text-center">{{ $row->trang_thai == NULL ? "Chưa sửa" : "Đã sửa"}}</td>
                                                              <td >
                                                                @if($check ==null)
                                                                    <form action="{{route('student.register.cancle_csvc_repair_form')}}" method="POST" id="cancleForm" class="cancle_repair_form" >
                                                                      {{-- @method('PATCH') --}}
                                                                        @csrf
                                                                            <button type="submit" class="btn btn-danger btn-sm px-3 button_register_repair" >
                                                                              <i class="fas fa-times"></i>
                                                                          </button>
                                                                          <input type = "hidden" name ="ma_sua_csvc" value ="{{$row-> ma_sua_csvc}}"/>
                                                                    </form>
                                                                  @else
                                                                        <form action="" method="POST" id="cancleForm" class="cancle_repair_form" >
                                                                            {{-- @method('PATCH') --}}
                                                                              @csrf
                                                                                  <button type="submit" class="btn btn-danger btn-sm px-3 button_register_repair" disabled>
                                                                                    <i class="fas fa-times"></i>
                                                                                </button>
                                                                                <input type = "hidden" name ="ma_sua_csvc" value ="{{$row-> ma_sua_csvc}}"/>
                                                                          </form>
                                                                    @endif
                                                              </td>   
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
        @endif
     @endif


    
            <script>

          document.getElementById("form__register_repair_csvc").addEventListener("submit", function(event) {
                  var csvc = document.getElementById("csvc").value;
                  var soluong = document.getElementById("soluong").value;
                  var tinhtrang = document.getElementById("tinhtrang").value;
                  var hocky = document.getElementById("hk").value;
          
                  if (hocky == 'Chọn...' || csvc == 'Chọn CSVC...' || soluong == '' || tinhtrang == '') {
                      event.preventDefault();
          
                      Swal.fire({
                          icon: 'error',
                          title: 'Thất bại!',
                          text: 'Vui lòng không để trống thông tin',
                          showConfirmButton: false,
                          timer: 2000
                      });
                  } else {
                      Swal.fire({
                          icon: 'success',
                          text: 'Đăng ký thành công !',
                          showConfirmButton: false,
                          timer: 2000
                      });
                  }
              });

              document.getElementById("cancleForm").addEventListener("submit", function(event) {
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
                          document.getElementById("cancleForm").submit();
                          Swal.fire({
                              icon: 'success',
                              text: 'Hủy thành công !',
                              showConfirmButton: false,
                              timer: 2500
                          });
                      }
                  });
              });
          
            
          </script>
          
    @endsection