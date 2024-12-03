@extends('layouts.admin_index')
    @section('add_csvc_room')

        
    <script>
        
       
        Swal.fire({
        title: "Thêm CSVC Vào Phòng",
        icon: "info",
        html: `
            <style>
               

                .list1{
                    justify-content: space-between;
                    width:95% !important;
                }
                .item1{
                    width:50%;
                    margin-left:1.5rem;
                    height:6vh !important;
                }
                .item2{
                    width:40%;
                }
                .select_tencsvc{
                    height : 4.5vh;

                }
                .form-control {
                    margin-top:0.2rem;
                    margin-bottom:0.5rem;
                    text-align: center;
                    height:4vh;
                }
                .label_form{
                    margin-top:0.5rem;
                    margin-bottom:0.5rem;
                }

                .room--tools{
                    margin-top:0.4rem;
                    justify-content: space-between;
                    
                }
                .back{
                width:20%;
                display:flex;
                align-items: center;
                justify-content: center;
                background-color:rgb(255, 71, 71);
                border-radius: 0.5rem;
                margin-right:5rem;
                
                }
                .save_csvc{
                    margin-left :8rem;
                    witdh:20%;
                }
               
                .back a{
                    color:white; 
                   
                }
            </style>
            
        <form class="edit_csvc_forrm" id="add_csvc_forrm" action="{{route('csvc_management.insert')}}" method="POST">
            @csrf
            <div class="form-row d-flex list1" id="form_add">
                <div class="form-group col-md-2 item1">
                    <label for="ten_csvc" class="label_form">Tên CSVC</label>
                    <select class="form-select cursor select_tencsvc align-middle" id="ten_csvc" name = "ten_csvc">
                                <option selected disabled >Chọn...</option>
                                @foreach ($csvc as $cs)
                                        <option value="{{ $cs->ma_csvc }}">{{ $cs->ten_csvc }}</option>
                                 @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2 item2">
                        <label for="so_luong" class="label_form">Số Lượng</label>
                        <input type="text" class="form-control input_form" id="so_luong" name="so_luong" value="" >
                </div>

            </div>
            <div class="form-row d-flex list1" >
                <div class="form-group col-md-2 item1">
                        <label for="ten_phong" class="label_form">Phòng</label>
                        <select class="form-select cursor align-middle" id="ten_phong" name = "ten_phong">
                                <option selected disabled >Chọn...</option>
                                @foreach ($phong as $p)
                                        <option value="{{ $p->ten_phong }}">{{ $p->ten_phong }}</option>
                                 @endforeach
                               
                    </select>
                </div>

                <div class="form-group col-md-2 item2">
                        <label for="day" class="label_form">Dãy</label>
                        <select class="form-select cursor align-middle" id="day" name = "day">
                                <option selected disabled >Chọn...</option>
                                @foreach ($day as $d)
                                        <option value="{{ $d->ma_day }}">{{ $d->ten_day}}</option>
                                 @endforeach        
                    </select>
                </div>

            </div>
            
            
            <div class="room--tools d-flex">
                <button  button type="submit" class="btn btn-primary register save_csvc" name="register"><i class="fa-regular fa-floppy-disk"></i>Lưu</button>
                <input type="hidden" name="ma_csvc" value="">
            <div class="back">
                    <a href="{{route('csvc_management')}}"><i class="fa-solid fa-rotate-left"></i><span>Hủy</span></a>
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
 document.getElementById("add_csvc_forrm").addEventListener("submit", function(event) {
        var  ten_phong= document.getElementById("ten_phong").value;
        var  day= document.getElementById("day").value;
        var ten_csvc = document.getElementById("ten_csvc").value;
        var so_luong = document.getElementById("so_luong").value;
      //  var form = document.getElementById("form_hocky")
        if ( ten_phong== "Chọn..." || ten_csvc == "Chọn..." || so_luong==""|| day =="Chọn...") {
            event.preventDefault(); 

           Swal.fire({
                icon: 'error',
                title: 'Thất bại!',
                text: 'Vui lòng không bỏ trống thông tin',
                showConfirmButton: false,
                timer: 2000
              
          });
          setTimeout(() => {
                window.location.reload(true);
               
            }, 2500)
        }
    
    });

</script>
    @endsection