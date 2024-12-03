@extends('layouts.student_index')

    @section('room_content')
                <style>
                        .alert-room-registration{
                            width: 25% !important;
                            /*margin-left: 15rem;*/
                            font-family: 'Play', sans-serif !important; 
                            color: rgb(29, 36, 132) !important;
                            margin-top: 3.5rem !important;
                        }
                </style>

            <form action="{{ route('student.register.room_registration') }}" method="get" class="form__search--room mb-3">

                @if(Session::has('error'))
                    <div class="alert-room-registration alert-add alert alert-danger">{{ Session::get('error') }}</div>
                @endif
                    <div class = "wrapper__search w-25">
                        <div class="input-group mb-3 " >
                            <label class="input-group-text cursor" for="inputGroupSelect01">Tên Dãy</label>
                            <select class="form-select cursor" id="inputGroupSelect01" name="tenday">
                                {{-- <option selected">Chọn...</option> --}}
                                <option value="0" {{request() -> tenday == "0" ? 'selected' : ''}}>Tất cả</option>
                                @if(count($buildings) > 0)
                                    @foreach ($buildings as $row )
                                            <option value="{{$row -> ten_day}}" {{request() -> tenday == $row->ten_day ? 'selected' : ''}}>{{ $row -> ten_day }}</option>
                                            {{-- //{{ request() ->maday =='0' ? 'selected' :false }} --}}
                                    @endforeach
                                @else
                                            <option value="">Không có dữ liệu...</option>
                                @endif
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text cursor" for="inputGroupSelect01">Tên Loại Phòng</label>
                            <select class="form-select cursor" id="inputGroupSelect01" name ="tenloaiphong">
                                {{-- <option selected>Chọn...</option> --}}
                                <option value="0"  {{request() -> maday == "0" ? 'selected' : ''}}>Tất cả</option>
                                @if(count($room_type) > 0)
                                    @foreach ($room_type as $row )
                                        <option value="{{ $row -> ten_loai_phong}}"  {{request() -> tenloaiphong == $row->ten_loai_phong ? 'selected' : ''}}>{{ $row->ten_loai_phong}}</option>
                                    @endforeach
                                @else
                                            <option value="">Không có dữ liệu...</option>
                                @endif
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text cursor" for="inputGroupSelect01">Trạng Thái</label>
                            <select class="form-select cursor" id="inputGroupSelect01" name = "trangthai">
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

                        {{-- <div class="input-group mb-3">
                            <label class="input-group-text cursor" for="inputGroupSelect01">Tùy Chọn</label>
                            <select class="form-select cursor" id="inputGroupSelect01" name = "tuychon">
                                <option value="0" {{request() -> tuychon == "0" ? 'selected' : ''}}>Tất cả</option>
                                <option value="1" {{request() -> tuychon == "1" ? 'selected' : ''}}>Còn Trống</option>
                                <option value="2" {{request() -> tuychon == "2" ? 'selected' : ''}}>Hết Chỗ</option>
                        
                            </select>
                        </div> --}}
                        
                        <div class="w-100 d-flex input-search">
                            <div class="input-group mb-3">
                                <label class="input-group-text cursor" for="inputGroupSelect01">Phòng Nam/ Nữ</label>
                                <select class="form-select cursor" id="inputGroupSelect01" name ="namornu" >
                                     <option value="0" {{request() -> namorrnu == "0" ? 'selected' : ''}}>Tất cả</option>
                                        @if(count($gender) > 0)
                                            @foreach ($gender as $row )
                                                    <option value="{{$row -> phong_nam_nu}}" {{request() -> namornu == $row -> phong_nam_nu? 'selected' : ''}}>{{ $row->phong_nam_nu}}</option>
                                            @endforeach
                                        @else
                                                    <option value="">Không có dữ liệu...</option>
                                        @endif
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
                
                
                
            </form>
                    <div style="margin-left:-1rem; margin-top:-1.3rem;">
                        {{$rooms -> appends(request() -> all()) ->links()}}
                    </div>
                    <table class="table table-hover table__room">
                        <thead>
                        <tr>
                            <th scope="col" class="table__room--title align-middle">STT</th>
                            <th scope="col" class="table__room--title align-middle">Mã Phòng</th>
                            <th scope="col" class="table__room--title2 align-middle">Tên Phòng</th>
                            <th scope="col" class="table__room--title1 align-middle">Tên Loại Phòng</th>
                            <th scope="col" class="table__room--title align-middle"> Dãy</th>
                            <th scope="col" class="table__room--title align-middle"> Khu</th>
                            <th scope="col" class="table__room--title2 align-middle">Phòng nam / nữ</th>
                            <th scope="col" class="table__room--title align-middle">Đơn Giá</th>
                            <th scope="col" class="table__room--title align-middle">Sức Chứa</th>
                            <th scope="col" class="table__room--title align-middle">Số Chỗ Thực Tế</th>
                            <th scope="col" class="table__room--title align-middle">Đã Ở</th>
                            <th scope="col" class="table__room--title align-middle">Còn Trống</th>
                            <th scope="col" class="table__room--title3 align-middle" >Trạng Thái</th>
                            <th scope="col" class="table__room--title align-middle" colspan="2">Hành Động</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                            @php $count = ($rooms->currentPage() - 1) * $rooms->perPage() + 1; @endphp
                            @if(count($rooms )> 0)
                                @foreach ($rooms as $row )
                                    <tr>
                                        <td class="align-middle">{{$count++}}</td>
                                        <td  class="align-middle text-center">{{$row ->ma_phong}}</td>
                                        <td class="align-middle text-center">{{$row ->ten_phong}}</td>
                                        <td  class="align-middle ">{{$row ->ten_loai_phong}}</td>
                                        <td class="align-middle  text-center">{{$row ->ma_day}}</td>
                                        <td class="align-middle  text-center">{{$row ->ma_khu==null ?'Đã xóa' :$row->ma_khu}}</td>
                                        <td class="align-middle  text-center">{{$row ->phong_nam_nu}}</td>
                                        <td class="align-middle  text-center">{{$row ->don_gia}}</td>
                                        <td class="align-middle  text-center">{{$row ->suc_chua}}</td>
                                        <td class="align-middle  text-center">{{$row ->so_cho}}</td>
                                        <td class="align-middle  text-center">{{$row ->da_o}}</td>
                                        <td class="align-middle  text-center">{{$row ->con_trong}}</td>
                                        <td class="align-middle ">{{$row ->trang_thai}}</td>
                                        {{-- <td class=""><a href="" class="">Đăng Ký</a></td>
                                         <td class=""> <a  class="">Chuyển Phòng</a></td> 
                                         <td class=""> <a  class="">Trả Phòng</a></td>  --}}
                                         <td class ="col__register">
                                            @if($id_form !=null)
                                                <form action="" class="form__register" disabled>
                                                    @csrf
                                                    {{-- @method('PATCH') --}}
                                                    <input type="submit" name="action" value="Đăng Ký" class="button__register" disabled/>
                                                    <input type="hidden" name="maphong_register" value="{{ $row->ma_phong }}"/>
                                                </form>
                                            
                                            @else
                                            <form action="{{ route('student.register.create_form',['maphong_register' => $row->ma_phong])}}" method="POST" class="form__register">
                                                @csrf
                                                {{-- @method('PATCH') --}}
                                                <input type="submit" name="action" value="Đăng Ký" class="button__register"/>
                                                <input type="hidden" name="maphong_register" value="{{ $row->ma_phong }}"/>
                                            </form>
                                            @endif
                                        </td>
                
                                        <td class ="col_change">
                                            @if($id_form ==null ||  $id_not_approved_register !=null || $id_unapprove_changes_form !=null)

                                                <form action="" class="form__change" disabled >
                                                    @csrf
                                                    <input type="submit" name="action" value="Chuyển Phòng" class="button__change" disabled />
                                                    <input type="hidden" name="maphong_move" value ="@php echo $row -> ma_phong @endphp">
                                                </form>
                                            
                                            @else
                                                
                                                <form action="{{ route('student.register.create_form_changes',['maphong_register' => $row->ma_phong])}}" method ="post" class="form__change" >
                                                    @csrf
                                                    <input type="submit" name="action" value="Chuyển Phòng" class="button__change"  />
                                                    <input type="hidden" name="maphong_move" value ="@php echo $row -> ma_phong @endphp">
                                                </form>
                                            
                                            @endif
                                        </td>

                                       
                                    </tr>
                                @endforeach
                            
                            @else
                                <tr>
                                    <td colspan="14" class="text-center">Không có dữ liệu</td>
                                </tr>
                             @endif
                        
                    </table>
       
                    
        @endsection