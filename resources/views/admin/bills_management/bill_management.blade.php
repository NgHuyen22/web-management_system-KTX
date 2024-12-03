@extends('layouts.admin_index')
    @section('bills')

        <ul class="nav nav-tabs bill_list" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Phí Phòng</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Phí Điện, Nước</button>
          </li>
     
        </ul>
        <div class="tab-content bill_table " id="myTabContent">
          <div class="tab-pane fade show active bill_content" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <table class="table table-hover bill_room">
              <thead>
                  
                  <tr>
                      <th scope="col">STT</th>    
                      <th scope="col">MSSV</th>
                      <th scope="col">Phòng</th>
                      <th scope="col">Đơn Giá</th>
                      <th scope="col">Ngày Đóng</th>
                      <th scope="col">Trạng Thái</th>
                  </tr>
              </thead>
              <tbody>
                @php $count = 1; @endphp
              {{-- @if($id !=null) --}}
                @if(count($id) > 0)
                    @foreach ($id as $row )
                        <tr>
                            <th scope="row">{{$count++}}</th>
                            <td>{{$row -> mssv==null ?'Đã xóa':$row -> mssv }}</td>
                            <td>{{$row -> ma_phong ==null?'Đã xóa' :$row -> ma_phong }}</td>
                            <td>{{number_format($row ->don_gia, 0 , ',' ,'.')}} VND</td>
                            <td>{{date('d-m-Y',strtotime($row -> ngaydongphi))}}</td>
                            <td>{{$row -> trang_thai ==1?'Đã đóng':'Chưa đóng' }}</td>
                          </tr>
                      @endforeach
                  @else
                         
                          @if(count($idNotNull) > 0)
                              @foreach ($idNotNull as $row )
                                  <tr>
                                      <th scope="row">{{$count++}}</th>
                                      <td>{{$row -> mssv==null ?'Đã xóa':$row -> mssv }}</td>
                                      <td>{{$row -> ma_phong ==null?'Đã xóa' :$row -> ma_phong }}</td>
                                      <td></td>
                                      <td>{{date('d-m-Y',strtotime($row -> ngaydongphi))}}</td>
                                      <td>{{$row -> trang_thai ==1?'Đã đóng':'Chưa đóng' }}</td>
                                  </tr>
                                @endforeach
                            @else
                                       <tr>
                                              <td colspan ="6" class="align-middle text-center">Không có dữ liệu...</td>
                                      </tr>  
                          @endif

                  @endif
              
              </tbody>
            </table>
          </div>

          <div class="tab-pane fade bill_content" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
              <table class="table table-hover">
                <thead>
                    
                    <tr>
                      <th scope="col">STT</th>
                      <th scope="col">Phòng</th>
                      <th scope="col">Dãy</th>
                      <th scope="col">Tháng</th>
                      <th scope="col">Loại</th>
                      <th scope="col">Chỉ Số Đầu</th>
                      <th scope="col">Chỉ Số Cuối</th>
                      <th scope="col">Chỉ Số Sử Dụng</th>
                      <th scope="col">Phí Sử Dụng</th>
                      <th scope="col">Thành Tiền</th>
                      <th scope="col">Ngày Đóng</th>
                      <th scope="col">Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td></td>
                          <td></td>
                          <td ></td>
                          <td>
                                <div class="col">Điện</div>
                                <div class="col">Nước</div>
                          </td>
                          <td >
                            <div class="col"></div>
                            <div class="col"></div>
                          </td>
                          <td >
                            <div class="col"></div>
                            <div class="col"></div>
                          </td>
                          <td>
                            <div class="col"></div>
                            <div class="col"></div>
                          </td>
                          <td>
                            <div class="col"></div>
                            <div class="col"></div>
                          </td>
                          <td></td>
                          <td></td>
                          <td></td>
                      
                        </tr>
                </tbody>
              </table>
            </div>
         
       
   
    @endsection