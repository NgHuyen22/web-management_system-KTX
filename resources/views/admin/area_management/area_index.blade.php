@extends('layouts.admin_index')

@section('area_content')
    {{-- <div class="main__home">
    <p>welcom to admin</p>
</div> --}}

<div class="main__container--title">
    <h2 style="color : #0d3595">Danh Sách Khu KTX Đại học Cần Thơ</h2>
</div>

<div class="tool__area">
    <div class="main__container--add ">
        <div id="add__area--icon">
            <a href="{{route('area_management.add_area')}}">
                <i class="fa-regular fa-square-plus add"></i>
            </a>
        </div>
    </div>

        <form action="" method="get" class="form__search mb-3">
            @csrf

            <div class="form__search--row  container d-flex">
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
                            <button type ="submit" class="button__search search__icon btn btn-primary btn-block ">Tìm</button>
                        </div>
                </div>
                
            </div> 

        </form>
</div>

<div class="main__container--table">
    <table class = "table__area" border =1 >
        <tr>
            <th>STT</th>
            <th>Mã Khu</th>
            <th>Tên Khu</th>
            <th colspan = "2">Hành Động</th>
            </tr>
        <tr>
            {{-- đếm số ptu trong mảng nhỏ nhỏ hơn 0 trả về rỗng --}}
            @php $count = 1; @endphp
            @if(count($area) >0 )         
                @foreach ($area as $row )
                     <tr>
                        <td>{{$count++}}</td>
                        <td>{{$row->ma_khu}}</td>
                        <td>{{$row->ten_khu}}</td>
                        <td class="col__action">
                            <a href="{{ route('area_management.form_edit_area', ['makhu' => $row->ma_khu]) }}" class="area__link--edit">Sửa</a>
                        </td>
                         <td class="col__action"> 
                            <a  class="area__link--delete"  onclick="deleteArea('{{ route('area_management.delete_area', ['makhu' => $row->ma_khu]) }}')">Xóa</a>
                        </td> 
                </tr>
                @endforeach
        @else
             <tr>
                <td colspan ="6">Không có dữ liệu</td>
            </tr>        
        @endif
    </table>

    <script>
            function deleteArea (url) {
                event.preventDefault();
                      Swal.fire({
                      title: 'Xác nhận',
                      text: 'Bạn có chắc chắn muốn xóa?',
                      icon: 'info',
                      showCancelButton: true,
                      confirmButtonColor:' #04AA6D',
                      cancelButtonColor: 'rgb(246, 81, 81)',
                      confirmButtonText: 'Xóa',
                      cancelButtonText: 'Hủy',
                      customClass: {
                          container: 'swal2-borderless'
                      }
                  }).then((result) => {
      
                          if (result.isConfirmed) {

                            window.location.href =  `${url}`;
                                Swal.fire({
                                icon: 'success',
                                text: 'Xóa thành công',
                                showConfirmButton: false,
                                timer: 2500
                                });
                            }
                    })

            }

</script>      
@endsection

