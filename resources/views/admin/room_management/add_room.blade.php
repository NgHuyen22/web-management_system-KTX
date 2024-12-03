@extends('layouts.admin_index')
    @section('add_room')
        
        <h3 class="add__room--title">Thêm Phòng</h3>
         {{-- kiem tra ton tai 1 phien bien success vs error kh --}}
       @if(Session::has('success')) 
            <div class="alert-addRoom alert alert-success">{{ Session :: get('success') }}</div>
        @endif

        @if(Session::has('error'))
            <div class="alert-addRoom alert-add alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <form class="form__add--room" id="form__add--room" action="{{ route('room_management.save_room')}}" method="POST">
            @csrf
            <div class="form-row d-flex list1" >
                <div class="form-group col-md-2 item1">
                        <label for="inputMP">Mã Phòng</label>
                        <input type="text" class="form-control" id="inputMP" name="maphong" >
                </div>

                <div class="form-group col-md-2 item2">
                        <label for="inputTP">Tên Phòng</label>
                        <input type="text" class="form-control" id="inputTP" name="tenphong">
                </div>
            </div>

            <div class="form-row d-flex list1" >
                <div class="form-group col-md-2 item1">
                        <label for="inputML">Mã Loại Phòng</label>
                        <select id="inputML" class="form-select" name="maloaiphong">
                            <option selected disabled>Chọn...</option>
                            @if(count($room_type) > 0)
                                    @foreach ($room_type as $row )
                                        <option>{{ $row->ma_loai_phong}}</option>
                                    @endforeach
                            @else
                                        <option value="">Không có dữ liệu...</option>
                            @endif

                        </select>
                        
                </div>

                <div class="form-group col-md-2 item2">
                        <label for="inputMD">Mã Dãy</label>
                        <select id="inputMD" class="form-select" name="maday">
                                <option selected disabled>Chọn...</option>
                                @if(count($buildings) > 0)
                                        @foreach ($buildings as $row )
                                            <option>{{ $row -> ma_day }}</option>
                                        @endforeach
                                @else
                                        <option value="">Không có dữ liệu...</option>
                                @endif
                        </select>
                </div>
            </div>

            <div class="form-row d-flex list1" >
                <div class="form-group col-md-2 item1" >
                        <label for="inputNN">Phòng Nam / Nữ</label>
                        <select id="inputNN" class="form-select" name="phongnam_nu">
                                <option selected disabled>Chọn...</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                {{-- @if(count($gender) > 0)
                                    @foreach ($gender as $row )
                                        <option>{{ $row -> phong_nam_nu }}</option>
                                    @endforeach
                                @else
                                    <option value="">Không có dữ liệu...</option>
                                @endif --}}
                        </select>
                </div>
            
                <div class="form-group col-md-2 item2" >
                        <label for="inputTT">Trạng Thái</label>
                        <select id="inputTT" class="form-select" name="trangthai">
                                <option selected disabled>Chọn...</option>
                                <option value="Chưa sử dụng">Chưa sử dụng</option>
                                <option value="Đang sử dụng">Đang sử dụng</option>
                                {{-- @if(count($status) > 0)
                                        @foreach ($status as $row )
                                            <option>{{ $row -> trang_thai }}</option>
                                        @endforeach
                                @else
                                    <option value="">Không có dữ liệu...</option>
                                @endif --}}
                        </select>
                </div>
            </div>

            <div class="form-row d-flex list2"  style ="text-align:center;" >
                <div class="form-group col-md-2">
                    <label for="inputSC">Số Chỗ Thực Tế</label>
                    <input type="text" class="form-control" id="inputSC" name="socho_tt">
                </div>

                    <div class="form-group col-md-2"  style ="text-align:center;" >
                        <label for="inputDO">Đã Ở</label>
                        <input type="text" class="form-control" id="inputDO" name="da_o">
                    </div>

                    
                    <div class="form-group col-md-2"  style ="text-align:center;" >
                        <label for="inputCT">Còn Trống</label>
                        <input type="text" class="form-control" id="inputCT" name="controng">
                    </div>
                    
                </div>
                <div class="room--tools">
                    <button  button type="submit" class="btn btn-primary" name="save_room">Lưu</button>

                    {{-- <div class="add__building">
                            <a href=""><i class="fa-regular fa-building"></i><span style="margin-left:0.2rem"> Cập nhật dãy</span></a>
                    </div> --}}
                    
                    <div class="back">
                            <a href="{{ route('room_management') }}"><i class="fa-solid fa-rotate-left"></i><span>Trở về</span></a>
                    </div>
                </div>
          </form>


          <script>
            //Lắng nghe sự kiện thay đổi giá trị của ô "Số Chỗ Thực Tế" và ô "Đã Ở"
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

          
                document.getElementById("form__add--room").addEventListener('submit', function(event){
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
                } 
                else {
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
