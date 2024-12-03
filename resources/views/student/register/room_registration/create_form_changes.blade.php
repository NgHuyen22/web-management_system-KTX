@extends('layouts.student_index')
@section('create_form')



    <script>
        
        //  
        Swal.fire({
        title: "Đơn Đăng Ký Chuyển Phòng",
        icon: "info",
        html: `
            <style>
               

                .list1{
                    justify-content: space-between;
                }
                .item1{
                    width:40%;
                }
                .item2{
                    width:53%;
                }
                
                .form-control {
                    margin-top:0.2rem;
                    margin-bottom:0.5rem;
                    text-align: center;
                    height:4vh;
                }
                .label_form{
                    margin-top:0.5rem;
                }

                .room--tools{
                    margin-top:0.4rem;
                    justify-content: space-between;
                    
                }
                .back{
                width:15%;
                display:flex;
                align-items: center;
                justify-content: center;
                background-color:rgb(255, 71, 71);
                border-radius: 0.5rem;
                
                }
                .back a{
                    color:white;
                }
            </style>
            @if(Session::has('error'))
                 <div class="alert-register alert-add alert alert-danger">{{ Session::get('error') }}</div>
            @endif
        <form class="room_registraion--form" id="room_registraion--form" action="{{ route('student.register.changes_room')}}" method="POST">
            @csrf
            <div class="form-row d-flex list1" >
                <div class="form-group col-md-2 item1">
                        <label for="mssv" class="label_form">MSSV</label>
                        <input type="text" class="form-control " id="mssv" name="mssv" value="{{ substr(Session('student_id'),0,8) }}" readonly>
                </div>

                <div class="form-group col-md-2 item2">
                        <label for="maphong" class="label_form">Mã phòng</label>
                        <input type="text" class="form-control input_form" id="maphong" name="maphong" value="{{ $maphong}}" readonly>
                </div>
            </div>

            <div class="form-row d-flex list1" >
                    <div class="form-group col-md-2 item1">
                        <label for="tenphong" class="label_form">Phòng</label>
                        <input type="text" class="form-control" id="tenphong" name="tenphong" value="{{ $tenphong}}" readonly>
                    </div>

                    <div class="form-group col-md-2 item2">
                        <label for="tenday" class="label_form">Dãy</label>
                        <input type="text" class="form-control" id="tenday" name="tenday" value="{{ $tenday}}" readonly>
                    </div>
            </div>

            <div class="form-row d-flex list1" >
                <div class="form-group col-md-2 item1">
                    <label for="tenkhu" class="label_form">Khu</label>
                    <input type="text" class="form-control" id="tenkhu" name="tenkhu" value="{{ $khu }}" readonly>
                </div>

                    <div class="form-group col-md-2 item2">
                        <label for="loaiphong" class="label_form">Loại phòng</label>
                        <input type="text" class="form-control" id="loaiphong" name="loaiphong" value="{{ $loaiphong}}" readonly>
                    </div>  
            </div>

            <div class="form-row d-flex list1" >
                <div class="form-group col-md-2 item1">
                    <label for="nam_or_nu" class="label_form">Phòng nam/nữ</label>
                    <input type="text" class="form-control" id="nam_or_nu" name="nam_or_nu" value="{{ $gender}}" readonly>
                </div>

                    <div class="form-group col-md-2 item2">
                        <label for="dongia" class="label_form">Đơn giá</label>
                        <input type="text" class="form-control" id="dongia" name="dongia" value="{{ $gia}}" readonly>
                    </div>  
            </div>

            <div class="form-row d-flex list1" id="form_hocky">
                <div class="form-group col-md-2 item1">
                    <label for="hk" class="label_form">Học kỳ</label>
                    <select class="form-select cursor" id="hk" name = "hk">
                                <option selected disabled>Chọn...</option>
                                <option value="1" {{request() -> hk == "1" ? 'selected' : ''}}>1</option>
                                <option value="2" {{request() -> hk == "2" ? 'selected' : ''}}>2</option>
                    </select>
                </div>

                    <div class="form-group col-md-2 item2">
                        <label for="nh" class="label_form">Năm học</label>
                        <input type="text" class="form-control" id="nh" name="nh" value="{{ $namhoc}}" readonly>
                    </div>  
            </div>

            <div class="room--tools d-flex">
                <button  button type="submit" class="btn btn-primary register" name="register">Đăng ký</button>
            
            <div class="back">
                    <a href="{{ route('student.register.room_registration') }}"><i class="fa-solid fa-rotate-left"></i><span>Hủy</span></a>
            </div>
        </div>

            
        `,

  
        // showCloseButton: true,
        // showCancelButton: true,
        // focusConfirm: false,
        // confirmButtonText: `Đăng ký`,
        // cancelButtonText: `Hủy`,
        // confirmButtonColor:' #04AA6D',
        // cancelButtonColor: 'rgb(246, 81, 81)'
        showConfirmButton: false,
        customClass: {
                          container: 'swal2-borderless'
                      }
   
    });
 document.getElementById("room_registraion--form").addEventListener("submit", function(event) {
        var hocky = document.getElementById("hk").value;
        var namhoc = document.getElementById("nh").value;
      //  var form = document.getElementById("form_hocky")
        if (hocky == "Chọn...") {
            event.preventDefault(); 

           Swal.fire({
                icon: 'error',
                title: 'Thất bại!',
                text: 'Vui lòng chọn học kỳ.',
                showConfirmButton: false,
                timer: 2000
              
          });
          setTimeout(() => {
                window.location.reload(true);
                /*if(hocky != "Chọn..."){
                    Swal.fire({
                    icon: 'success',
                    text: 'Đăng ký thành công',
                    showConfirmButton: false,
                    timer: 2000
                });*/
            }, 2500)
        }
    
    });

</script>
    
@endsection