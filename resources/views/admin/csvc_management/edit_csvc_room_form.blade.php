@extends('layouts.admin_index')
    @section('edit_csvc_room')

    <script>
        
       
        Swal.fire({
        title: "Chỉnh Sửa CSVC",
        icon: "info",
        html: `
            <style>
               

                .list1{
                    justify-content: space-between;
                }
                .item1{
                    width:40%;
                    margin-left:3rem;
                }
                .item2{
                    width:40%;
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
                .so_luong{
                width: 80% !important;
                margin-left:3rem;
                margin-bottom:1rem;
                }
                .back a{
                    color:white; 
                   
                }
            </style>
            
        <form class="edit_csvc_forrm" id="edit_csvc_forrm" action="{{route('csvc_management.update_csvc')}}" method="POST">
            @csrf
            <div class="form-row d-flex list1" >
                <div class="form-group col-md-2 item1">
                        <label for="ten_csvc" class="label_form">Tên CSVC</label>
                        <input type="text" class="form-control " id="ten_csvc" name="ten_csvc" value="{{$csvc->ten_csvc}}">
                </div>

                <div class="form-group col-md-2 item2">
                        <label for="so_luong" class="label_form">Số Lượng</label>
                        <input type="text" class="form-control input_form" id="so_luong" name="so_luong" value="{{$csvc->so_luong}}" >
                </div>
                
            </div>

            

            
            <div class="room--tools d-flex">
                <button  button type="submit" class="btn btn-primary register save_csvc" name="register"><i class="fa-regular fa-floppy-disk"></i>Lưu</button>
                <input type="hidden" name="ma_csvc" value="{{$ma_csvc}}">
            <div class="back">
                    <a href="{{route('csvc_management')}}"><i class="fa-solid fa-rotate-left"></i><span>Hủy</span></a>
            </div>
        </div>

            
        `,

  
 
        showConfirmButton: false,
        customClass: {
                          container: 'swal2-borderless'
                      }
   
    });
 document.getElementById("edit_csvc_forrm").addEventListener("submit", function(event) {
        var  ma_csvc= document.getElementById("ma_csvc").value;
        var ten_csvc = document.getElementById("ten_csvc").value;
        var so_luong = document.getElementById("so_luong").value;
      //  var form = document.getElementById("form_hocky")
        if ( ma_csvc== "" || ten_csvc=="" || so_luong=="") {
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