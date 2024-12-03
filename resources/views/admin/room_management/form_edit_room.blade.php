@extends('layouts.admin_index')
    @section('edit_room')
        
        <h3 class="update__room--title">Cập Nhật Phòng</h3>
         {{-- kiem tra ton tai 1 phien bien success vs error kh --}}
       @if(Session::has('success')) 
            <div class="alert-updateRoom alert alert-success">{{ Session :: get('success') }}</div>
        @endif

        @if(Session::has('error'))
            <div class="alert-updateRoom alert-add alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <form class="form__update--room" id="form__update--room" action="{{ route('room_management.update_room')}}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-row d-flex list1-room" >
                <div class="form-group col-md-2 item1-room">
                        <label for="inputMP">Mã Phòng</label>
                        {{-- <input type="text" class="form-control" id="inputMP" name="maphong" value="@php if($show_roomcode) echo $roomcode  @endphp"> --}}
                        {{-- <select class="form-control" id="inputMP" name = "maphong">
                            <option selected>@php if($show_roomcode) echo $roomcode @endphp</option>
                            @if(count($room_code) > 0)
                                @foreach ($room_code as $row )
                                    <option>{{ $row->ma_phong}}</option>
                                @endforeach
                            @else
                                    <option value="">Không có dữ liệu...</option>
                            @endif  
                        </select> --}}
                        <input type="text" class="form-control" id="inputMP" name="maphong" value="@php if($show_roomcode) echo $roomcode  @endphp" readonly>
                </div>

                <div class="form-group col-md-2 item2-room">
                        <label for="inputTP">Tên Phòng</label>
                        <input type="text" class="form-control" id="inputTP" name="tenphong" value="@php if($show_roomcode) echo $roomname  @endphp" readonly>
                        {{-- <select class="form-control" id="inputTP" name = "tenphong">
                            <option selected >@php if($show_roomcode) echo $roomname  @endphp</option>
                            @if(count($room_name) > 0)
                            @foreach ($room_name as $row )
                                    <option>{{ $row -> ten_phong }}</option>
                            @endforeach
                        @else
                                    <option value="">Không có dữ liệu...</option>
                        @endif
                        </select> --}}
                </div>
            </div>

            <div class="form-row d-flex list1-room" >
                <div class="form-group col-md-2 item1-room">
                        <label for="inputML">Mã Loại Phòng</label>
                        <select id="inputML" class="form-control" name="maloaiphong" >
                            <option selected disabled>@php if($show_roomcode) echo $typecode @endphp</option>
                            @if(count($room_type) > 0)
                                @foreach ($room_type as $row )
                                    <option>{{ $row->ma_loai_phong}}</option>
                                @endforeach
                            @else
                                    <option value="">Không có dữ liệu...</option>
                            @endif  
                        </select>
                </div>

                <div class="form-group col-md-2 item2-room ">
                        <label for="inputMD">Mã Dãy</label>
                        {{-- <select id="inputMD" class="form-control" name="maday">
                                <option selected>@php if($show_roomcode) echo $buildingcode @endphp</option>
                                @if(count($building_room) > 0)
                                    @foreach ($building_room as $row )
                                            <option>{{ $row -> ma_day }}</option>
                                    @endforeach
                                @else
                                            <option value="">Không có dữ liệu...</option>
                                @endif
                        </select> --}}
                        <input type="text" class="form-control" id="inputMD" name="maday" value="@php if($show_roomcode) echo $buildingcode @endphp" readonly>
                </div>
            </div>

            <div class="form-row d-flex list1-room" >
                <div class="form-group col-md-2 item1-room" >
                        <label for="inputNN">Phòng Nam / Nữ</label>
                        <select id="inputNN" class="form-control" name="phongnam_nu">
                                <option selected disabled>@php if($show_roomcode) echo $genderroom @endphp</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                {{-- @if(count($gender_room) > 0)
                                    @foreach ($gender_room as $row )
                                            <option>{{ $row->phong_nam_nu}}</option>
                                    @endforeach
                                @else
                                            <option value="">Không có dữ liệu...</option>
                                @endif --}}
                                
                        </select>
                </div>
            
                <div class="form-group col-md-2 item2-room" >
                        <label for="inputTT">Trạng Thái</label>
                        <select id="inputTT" class="form-control" name="trangthai">
                                <option selected disabled>@php if($show_roomcode) echo $statusroom @endphp</option>
                                <option value="Chưa sử dụng">Chưa sử dụng</option>
                                <option value="Đang sử dụng">Đang sử dụng</option>
                                {{-- @if(count($status_room) > 0)
                                    @foreach ($status_room as $row )
                                            <option>{{ $row -> trang_thai }}</option>
                                    @endforeach
                                @else
                                            <option value="">Không có dữ liệu...</option>
                                @endif --}}
                        </select>
                </div>
            </div>

            <div class="form-row d-flex list2-room"  style ="text-align:center;" >
                <div class="form-group col-md-2">
                    <label for="inputSC">Số Chỗ Thực Tế</label>
                    <input type="text" class="form-control" id="inputSC" name="socho_tt" value="@php if($show_roomcode) echo $numberseats  @endphp">
                </div>

                    <div class="form-group col-md-2"  style ="text-align:center;" >
                        <label for="inputDO">Đã Ở</label>
                        <input type="text" class="form-control" id="inputDO" name="da_o" value="@php if($show_roomcode) echo $currentroom  @endphp">
                    </div>

                    <div class="form-group col-md-2"  style ="text-align:center;" >
                        <label for="inputCT">Còn Trống</label>
                        <input type="text" class="form-control" id="inputCT" name="controng" value="@php if($show_roomcode) echo $emptyroom  @endphp">
                    </div>
                  
                </div>
                <div class="room__tools--room">
                    <button  type="submit" class="btn btn-primary" name="save_room">Lưu</button>

                    <div class="back__room">
                            <a href="{{ route('room_management') }}"><i class="fa-solid fa-rotate-left"></i><span>Trở về</span></a>
                    </div>
                </div>
          </form>


          <script>
           
                document.addEventListener('DOMContentLoaded', function () {
                    var soChoInput = document.getElementById('inputSC');
                    var daOInput = document.getElementById('inputDO');
                    var conTrongInput = document.getElementById('inputCT');
            
                    soChoInput.addEventListener('input', calculateConTrong);
                    daOInput.addEventListener('input', calculateConTrong);
            
                    // Hàm tính toán giá trị cho ô "Còn Trống"
                    function calculateConTrong() {
                        var soCho = parseInt(soChoInput.value) || 0;
                        var daO = parseInt(daOInput.value) || 0;
                        conTrongInput.value = soCho - daO;
                    }
                });

          
                document.getElementById("form__update--room").addEventListener('submit', function(event){
                var maphong = document.getElementById('inputMP').value;
                var tenphong = document.getElementById('inputTP').value;
                var maloai = document.getElementById('inputML').value;
                var nam_nu = document.getElementById('inputNN').value;
                var trangthai = document.getElementById('inputTT').value;
                var maday = document.getElementById('inputMD').value;
                var socho = document.getElementById('inputSC').value;
                var da_o = document.getElementById('inputDO').value;

                if (maphong === "" || tenphong === "" || maloai === "Chọn..." || maday === "Chọn..." || nam_nu === "Chọn..." || trangthai === "Chọn..." || socho === "" || da_o === "") {
                    event.preventDefault(); // Ngăn form gửi đi khi dữ liệu không hợp lệ

                    Swal.fire({
                        icon: 'error',
                        title: 'Thất bại !!',
                        text: 'Vui lòng xem lại thông tin',
                        showConfirmButton: false,
                        timer: 2500
                    });

                    if (maphong === "") {
                        var maphongError = document.createElement("span");
                        maphongError.style.color = "red";
                        maphongError.className = "error_room";
                        maphongError.textContent = "Vui lòng nhập mã phòng !";
                        document.getElementById("inputMP").parentNode.appendChild(maphongError);
                    }

                    if (tenphong === "") {
                        var tenphongError = document.createElement("span");
                        tenphongError.style.color = "red";
                        tenphongError.className = "error_room";
                        tenphongError.textContent = "Vui lòng nhập tên phòng !";
                        document.getElementById("inputTP").parentNode.appendChild(tenphongError);
                    }

                    if (maloai=== "Chọn...") {
                        var maloaiError = document.createElement("span");
                        maloaiError.style.color = "red";
                        maloaiError.className = "error_room";
                        maloaiError.textContent = "Vui lòng chọn mã loại phòng !";
                        document.getElementById("inputML").parentNode.appendChild(maloaiError);
                    }

                    if (maday === "Chọn...") {
                        var madayError = document.createElement("span");
                        madayError.style.color = "red";
                        madayError.className = "error_room";
                        madayError.textContent = "Vui lòng chọn mã dãy !";
                        document.getElementById("inputMD").parentNode.appendChild(madayError);
                    }

                    if (nam_nu === "Chọn...") {
                    var namnuError = document.createElement("span");
                    namnuError.style.color = "red";
                    namnuError.className = "error_room";
                    namnuError.textContent = "Vui lòng chọn nam/nữ !"; // Sửa tên biến ở đây
                    document.getElementById("inputNN").parentNode.appendChild(namnuError);
                }

                if (trangthai === "Chọn...") {
                    var trangthaiError = document.createElement("span");
                    trangthaiError.style.color = "red";
                    trangthaiError.className = "error_room";
                    trangthaiError.textContent = "Vui lòng chọn trạng thái !"; // Sửa tên biến ở đây
                    document.getElementById("inputTT").parentNode.appendChild(trangthaiError);
                }

                if (socho === "") {
                        var sochoError = document.createElement("span");
                        sochoError.style.color = "red";
                        sochoError.className = "error_room";
                        sochoError.textContent = "Vui lòng nhập số chỗ !";
                        document.getElementById("inputSC").parentNode.appendChild(sochoError);
                    }

                    if (da_o === "") {
                        var daOError = document.createElement("span");
                        daOError.style.color = "red";
                        daOError.className = "error_room";
                        daOError.textContent = "Vui lòng nhập đã ở !";
                        document.getElementById("inputDO").parentNode.appendChild(daOError);
                    }
                } else{
                  
                    Swal.fire({
                        icon: 'success',
                        text: 'Thêm thành công',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            });

        </script>
    @endsection
