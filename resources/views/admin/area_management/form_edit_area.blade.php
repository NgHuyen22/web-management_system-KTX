@extends('layouts.admin_index')

@section('edit_area')
    <div class="title">
        <h3>Chỉnh Sửa Khu KTX</h3>
    </div>
    
    <form action="{{route('area_management.update_area')}}" method="post"  class="form__add" id="form__save"> 
        {{-- {{ csrf_field() }} --}}
        @csrf

        @if(Session::has('success'))
            <div class="update-success alert alert-success">{{ Session :: get('success') }}</div>
         @endif

        @if(Session::has('error'))
            <div class="update-error alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        
        <div class="wrapper__form">
                <div class="area__item">
                    <div class="area__item--one">
                        <label for="makhu">Mã Khu</label> 
                    </div>
                    <div class="area__item--one">
                        <input type ="text" name="makhu" id="makhu"  value =" @php if($hienmakhu ) echo $makhu @endphp"  readonly><br> 
                    </div>
                    {{-- @error('makhu')
                        <span style="color:red;" class="error_area">{{ $message }}</span>
                    @enderror --}}
                </div>
                <div class="area__item2">
                    <div class="area__item--two">
                        <label for="tenkhu">Tên Khu</label>
                    </div>
                    <div class="area__item--two">
                        <input type="text" name="tenkhu" id="tenkhu" value="@php if($hienmakhu) echo $tenkhu @endphp"><br>
                    </div>

                    {{-- @error('tenkhu')
                        <span style="color:red;" class="error_area">{{ $message }}</span>
                    @enderror --}}

                </div>
                
                <div class="save-area__button">
                    <input type ="submit" value="Lưu" name="luu" >   
                    {{-- <a href=""><i class="fa-regular fa-floppy-disk"></i></a> --}}
                </div>
        </div>
        <div class="back-area">
            <a href="{{asset('/area_management')}}">Trở lại</a>
        </div>
    </form>
{{-- </div> --}}


<script>
        document.getElementById("form__save").addEventListener("submit", function(event) {
            var makhu = document.getElementById("makhu").value;
            var tenkhu = document.getElementById("tenkhu").value;
            // console.log('213213123');
            if (makhu === "" || tenkhu === "" ) {

                event.preventDefault(); // Ngăn form gửi đi khi dữ liệu không hợp lệ

                Swal.fire({
                    icon: 'error',
                    title: 'Thất bại !!',
                    text: 'Vui lòng xem lại thông tin',
                    showConfirmButton: false,
                    timer: 2500
                    });  
                if (makhu === "") {
                    // tạo span ẩn gán cho makhuErrror
                    var makhuError = document.createElement("span");
                    // makhuError.style.color = "blue";
                    makhuError.className = "error_area"; //thiết lập lớp css cho th đó tên error_area
                    makhuError.textContent = "Vui lòng nhập mã khu!";
                    document.getElementById("makhu").parentNode.appendChild(makhuError);
                    //chèn ptu makhuError này vào cuối ptu cha của nó
                }

                
                if (tenkhu === "") {
                    var tenkhuError = document.createElement("span");
                    // tenkhuError.style.color = "red";
                    tenkhuError.className = "error_area";
                    tenkhuError.textContent = "Vui lòng nhập tên khu!";
                    document.getElementById("tenkhu").parentNode.appendChild(tenkhuError);
                }

            } else {
                Swal.fire({
                    icon: 'success',
                    text: 'Cập nhật thành công',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        });
</script>
@endsection