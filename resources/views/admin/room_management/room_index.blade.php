@extends('layouts.admin_index')

    @section('room_content')
            @if(Session::has('error'))
                <div class="alert-login alert-add alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            
            <form action="{{ route('room_management') }}" method="get" class="form__search--room mb-3">
                    <div class = "wrapper__search w-25">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01"  style="cursor: pointer;">Mã Dãy</label>
                            <select class="form-select" id="inputGroupSelect01" name="maday"  style="cursor: pointer;">
                                <option value="0" >Tất cả</option>
                                @if(count($buildings) > 0)
                                    @foreach ($buildings as $row )
                                        <option value="{{ $row->ma_day }}"  {{request() -> maday == $row -> ma_day ? 'selected' : ''}}>{{ $row->ma_day }}</option> {{--kiem tra gia tri trc do có bang vs ma day trong csdl kh nếu có thì nó sẽ thêm selected vào option này nếu kh sẽ trống--}}
                                    @endforeach
                                @else
                                            <option value="">Không có dữ liệu...</option>
                                @endif
                            </select>
                        </div>
                        
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01"  style="cursor: pointer;">Mã Phòng</label>
                            <select class="form-select" id="inputGroupSelect01" name = "maphong"  style="cursor: pointer;">
                                <option value="0"  {{request() -> maphong == "0" ? 'selected' : ''}}>Tất cả</option>
                                @if(count($roomAll) > 0)
                                    @foreach ($roomAll as $row )
                                            <option value="{{ $row -> ma_phong }}"   {{request() -> maphong == $row -> ma_phong ? 'selected' : ''}}>{{ $row -> ma_phong }}</option>
                                    @endforeach 
                                @else
                                            <option value="">Không có dữ liệu...</option>
                                @endif
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01" style="cursor: pointer;">Tên Loại Phòng</label>
                            <select class="form-select" id="inputGroupSelect01" name ="tenloaiphong"  style="cursor: pointer;">
                                <option value="0"  {{request() -> tenloaiphong == "0" ? 'selected' : ''}}>Tất cả</option>
                                @if(count($room_type_name) > 0)
                                        @foreach ($room_type_name as $row )
                                            <option value="{{ $row->ten_loai_phong}}"   {{request() -> tenloaiphong == $row->ten_loai_phong ? 'selected' : ''}}>{{ $row->ten_loai_phong}}</option>
                                        @endforeach
                                @else
                                            <option value="">Không có dữ liệu...</option>
                                @endif
                            </select>
                        </div>
                        {{-- <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01" style="cursor: pointer;">Mã Loại Phòng</label>
                            <select class="form-select" id="inputGroupSelect01" name ="maloaiphong"  style="cursor: pointer;">
                                <option value="0"  {{request() -> namornu == "0" ? 'selected' : ''}}>Tất cả</option>
                                @if(count($room_type) > 0)
                                        @foreach ($room_type as $row )
                                            <option value="{{ $row->ma_loai_phong}}"   {{request() -> maloaiphong == $row->ma_loai_phong ? 'selected' : ''}}>{{ $row->ma_loai_phong}}</option>
                                        @endforeach
                                @else
                                            <option value="">Không có dữ liệu...</option>
                                @endif
                            </select>
                        </div> --}}
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01" style="cursor: pointer;">Khu</label>
                            <select class="form-select" id="inputGroupSelect01" name ="khu"  style="cursor: pointer;">
                                <option value="0"  {{request() -> khu == "0" ? 'selected' : ''}}>Tất cả</option>
                                {{-- <option value="{{}}" {{request() -> khu == "1" ? 'selected' : ''}}></option> --}}
                                @if(count($khu) > 0)
                                    @foreach ($khu as $row )
                                    <option value="{{ $row->ma_khu}}"   {{request() -> khu == $row->ma_khu ? 'selected' : ''}}>{{ $row->ma_khu}}</option>
                                    @endforeach
                                @else
                                     <option value="">Không có dữ liệu...</option>
                                @endif
                                    <option value="1" {{request() -> khu == "1" ? 'selected' : ''}}>Đã xóa</option>
                                
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text cursor" for="inputGroupSelect01"  style="cursor: pointer;">Trạng Thái</label>
                            <select class="form-select cursor" id="inputGroupSelect01" name = "trangthai"  style="cursor: pointer;">
                                <option value="0" {{request() -> trangthai == "0" ? 'selected' : ''}}>Tất cả</option>
                                @if(count($status) > 0)
                                    @foreach ($status as $row )
                                            <option value="{{$row -> trang_thai}}" {{request() -> trangthai == $row -> trang_thai ? 'selected' : ''}}>{{ $row -> trang_thai }}</option>
                                    @endforeach 
                                @else
                                            <option value="">Không có dữ liệu...</option>
                                @endif
                            </select>
                        </div>

                        <div class="w-100 d-flex input-search">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupSelect01"  style="cursor: pointer;">Phòng Nam/ Nữ</label>
                                <select class="form-select" id="inputGroupSelect01" name ="namornu"  style="cursor: pointer;">
                                     <option value="0" {{request() -> namornu == "0" ? 'selected' : ''}}>Tất cả</option>
                                     <option value="Nam" {{request() -> namornu == "Nam" ? 'selected' : ''}}>Nam</option>
                                     <option value="Nữ" {{request() -> namornu == "Nữ" ? 'selected' : ''}}>Nữ</option>
                                         {{-- @if(count($gender) > 0) 
                                            @foreach ($gender as $row )
                                                    <option>{{ $row->phong_nam_nu}}</option>
                                            @endforeach
                                        @else
                                                    <option value="">Không có dữ liệu...</option>
                                        @endif  --}}
                                </select>
                            </div>

                            <div class="search__all  w-25 d-flex">
                                    <div class="search__room col-2  ">
                                        <button type ="submit" class="search__room--button btn btn-primary btn-block ">Tìm</button>
                                    </div>
                                    {{-- <div class="search-icon ">
                                                <a href="">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </a>
                                        </div> --}}
                            </div>   
                        </div>
                </div> 
                    <div class="d-flex">
                        <div id="add__room--icon">
                            <a href="{{ route('room_management.add_room') }}">
                                <i class="fa-regular fa-square-plus room"></i>
                            </a>
                        </div>
                        <div class="pageper__room">
                            {{$rooms ->appends(request() ->all())-> links()}}
                        </div>
                    </div>
            </form>
                
                    <table class="table table-hover table__room">
                        <thead>
                        <tr>
                            <th scope="col" class="table__room--title align-middle">STT</th>
                            <th scope="col" class="table__room--title">Mã Phòng</th>
                            <th scope="col" class="table__room--title">Tên Phòng</th>
                            <th scope="col" class="table__room--title">Mã Loại</th>
                            <th scope="col" class="table__room--title">Tên Loại</th>
                            <th scope="col" class="table__room--title">Dãy</th>
                            <th scope="col" class="table__room--title">Khu</th>
                            <th scope="col" class="table__room--title">Phòng nam / nữ</th>
                            <th scope="col" class="table__room--title">Đơn Giá</th>
                            <th scope="col" class="table__room--title">Sức Chứa</th>
                            <th scope="col" class="table__room--title">Số Chỗ Thực Tế</th>
                            <th scope="col" class="table__room--title">Đã Ở</th>
                            <th scope="col" class="table__room--title">Còn Trống</th>
                            <th scope="col" class="table__room--title">Trạng Thái</th>
                            <th scope="col" class="table__room--title" colspan="2">Hành Động</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                            @php $count = ($rooms->currentPage() - 1) * $rooms->perPage() + 1; @endphp
                            @if(count($rooms )> 0)
                            @foreach ($rooms as $row )
                            <tr>
                                        <td class="align-middle text-center">{{ $count++}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->ma_phong}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->ten_phong}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->ma_loai}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->ten_loai_phong}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->ma_day}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->ma_khu == null ? 'Đã xóa': $row->ma_khu}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->phong_nam_nu}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->don_gia}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->suc_chua}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->so_cho}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->da_o}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->con_trong}}</td>
                                        <td style="text-align:center" class="align-middle">{{$row ->trang_thai}}</td>
                                        <td>
                                            <form action="{{ route('room_management.form_edit', ['maphong' => $row ->ma_phong]) }}" method ="post" class="form__edit--room">
                                                @csrf
                                                <input type ="submit" name ="action" value ="Sửa" class="button__edit--room"/>
                                                <input type = "hidden" name ="id" value ="@php echo $row -> ma_phong @endphp"/>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('room_management.delete_room', ['maphong' => $row -> ma_phong]) }}" method ="get" class="delete__room">
                                                {{-- <input type ="submit" name ="action" value ="Xóa" class="button__delete--room"/> --}}
                                                <input type = "hidden" name ="id" value ="@php echo $row -> ma_phong @endphp"/>
                                                 <button type="button" class="button__delete--room" onclick="confirmDelete('{{ route('room_management.delete_room', ['maphong' => $row->ma_phong]) }}')">Xóa</button>
                                            </form>
                                        </td>

                                            
                                    </tr>
                                @endforeach
                            
                            @else
                                <tr>
                                    <td colspan="15" class="text-center">Không có dữ liệu</td>
                                </tr>
                             @endif
                        
                            </table>
              
                            {{-- thêm appends để thêm các biến vào mỗi trang, mỗi trang đều dùng dc các biến trên --}}
                            {{--links đẻ tạo các trang--}}
                            {{-- {{$rooms ->appends(request() ->all())-> links()}} --}}

            <script>
                     function confirmDelete(url) {
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
                            window.location.href = url;
                            Swal.fire({
                                icon: 'success',
                                text: 'Xóa thành công',
                                showConfirmButton: false,
                                timer: 2500
                            });
                        }
                    });
                }
            </script>
                 
        @endsection