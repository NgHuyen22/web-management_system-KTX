@extends('layouts.student_index')

    @section('pay')
    @if(Session::has('error'))
        <div class="alert-pay alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    <ul class="nav nav-tabs pay_tool" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Phí Phòng</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Phí Điện,Nước</button>
        </li>
       
      </ul>
      <div class="tab-content content_pay" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <form action="{{route('pay.processing')}}" id="pay_form" method="POST">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tên Hóa Đơn</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="ten_hd" value="Phí Phòng" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">MSSV</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="mssv" value="{{$mssv}}" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Mã Phòng</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="ma_phong">
                </div>
                
                {{-- <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Nội Dung</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
                </div> --}}
                <button type="button" class="btn btn-light">
                    <img src="{{asset('images/sacombank.jpg')}}" class="card-img-top img_bank" alt="sacombank">
                </button>
                <button type="button" class="btn btn-light">
                    <img src="{{asset('images/logo-tpbank-2.jpg')}}" class="card-img-top img_bank" alt="sacombank">
                </button>
                <div class="ip_money">
                    <label for="account">TK Người Nhận</label>
                    <input class="form-control form-control-sm" id="account"  type="text" aria-label=".form-control-sm example" value="070118425778" readonly>
                    <label for="money">Nhập số tiền</label>
                    <input class="form-control form-control-sm" id="money" name="money" type="text" aria-label=".form-control-sm example">
                </div>
                <div style="margin-top:2rem !important;">
                   

                        <button type="submit" class="btn btn-primary">Thanh Toán</button>
                       
                </div>
            </form>
            <span style="color:red">Ghi chú : <span style="color:black !important">Nội dung theo dạng <span style="font-style: italic; color:black !important">MaPhong - MSSV - HoTen</span> . Nếu sai thông tin vui lòng liên hệ qua email nva@ctu.edu.vn</span></span>
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
      </div>

<script>
    document.getElementById("pay_form").addEventListener("submit", function(event) {
    var ten_hd = document.getElementById("exampleFormControlInput1").value;
    // var maphong = document.getElementById("exampleInputEmail1").value;
    // var content = document.getElementById("exampleFormControlTextarea1").value;
    var account = document.getElementById("account").value;
    var money = document.getElementById("money").value;

    if (ten_hd == ''  || account == '' || money == '') {
        event.preventDefault();

        Swal.fire({
            icon: 'error',
            title: 'Thất bại!',
            text: 'Vui lòng không để trống thông tin',
            showConfirmButton: false,
            timer: 2000
        });
    } else {
        event.preventDefault();
        Swal.fire({
            title: 'Xác nhận',
            text: 'Xác nhận thanh toán?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#04AA6D',
            cancelButtonColor: 'rgb(246, 81, 81)',
            confirmButtonText: 'Thanh Toán',
            cancelButtonText: 'Hủy',
            customClass: {
                container: 'swal2-borderless'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("pay_form").submit();
                  Swal.fire({
                      icon: 'success',
                      text: 'Giao dịch thành công !',
                      showConfirmButton: false,
                      timer: 2500
                  });
            }
        });
        // Di chuyển dòng này vào đây
        // event.preventDefault();
    }
});

            
      </script>
    @endsection