@extends('layouts.admin_index')

    @section('approve_request')
  

      <div class="statistical-dropdown">
          <div class="btn-group dropend  dropdown__form"> 

                    <button type="button" class="btn btn-danger dropdown__from--button "></button>
                    <button type="button" class="btn btn-secondary dropdown-toggle icon_button" data-bs-toggle="dropdown" aria-expanded="false">
                        Chọn
                    </button>
        
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="#"  onclick="showbutton()">
                          <i class="fa-solid fa-house-circle-check register-icon"></i>
                            <span>Đơn Đăng Ký Ở</span>
                        </a>
                    </li>
                      <li>
                          <a class="dropdown-item" href="#" onclick="showChangesbutton()">
                              <i class="fa-solid fa-reply move-icon"></i>
                              <span>Đơn Chuyển Phòng</span>
                          </a>
                      </li>
                      <li>
                          <a class="dropdown-item" href="#" onclick="showGiveBackbutton()">
                              <i class="fa-solid fa-rectangle-xmark give-back-icon"></i>
                              <span>Đơn Trả Phòng</span>
                              
                          </a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                          <a class="dropdown-item" href="#" onclick="showCsvcRepairbutton()">
                              <i class="fa-solid fa-wrench"></i>
                              <span>Đơn Sửa Chửa CSVC</span>
                          </a>
                      </li>
                  </ul>
              </div>  
              <div class="statistical">
                @php
                if($countAllForm ==0){
                    
                    echo '<div class="progress statistical-percentage" id="percentage_all_form" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" ';
                    echo '<div class="progress-bar bg-secondary" style="width: 100%;"></div>';
                    echo '</div>';
                }

                if($countAllRoomRegistration == 0){

                
                  echo '<div class="progress statistical-percentage" id="percentage_room_registration" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" ';
                  echo '<div class="progress-bar bg-secondary" style="width: 100%;"></div>';
                  echo '</div>';
                }
                
                if ($countAllChangeRoom == 0) {
                  
                    echo '<div class="progress statistical-percentage" id="percentage_change_room" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="display:none">';
                    echo '<div class="progress-bar bg-secondary" style="width: 100%;"></div>';
                    echo '</div>';
                }

                if ($countAllGiveBackRoom == 0) {
                    
                
                    echo '<div class="progress statistical-percentage" id="percentage_giveback_room" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="display:none">';
                    echo '<div class="progress-bar bg-secondary" style="width: 100%;"></div>';
                    echo '</div>';
                }
                if ($countAllCsvcRepairForm == 0) { 
                    echo '<div class="progress statistical-percentage" id="percentage_csvc_repair_form" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="display:none">';
                    echo '<div class="progress-bar bg-secondary" style="width: 100%;"></div>';
                    echo '</div>';
                }
                @endphp
                {{-- all --}}
                    <div class="progress statistical-percentage" id="percentage_all_form" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-danger" style="width: <?php  if($countAllForm != 0) echo ($countUnapprove / $countAllForm) * 100; else echo $countUnapprove; ?>%;"></div>
                            <div class="progress-bar bg-info " style="width: <?php if($countAllForm != 0) echo ($countApproved / $countAllForm) * 100; else echo $countApproved ?>%;";  background-color:  rgb(63, 111, 244) !important;"></div>
                    </div>
                  {{-- dk_phong --}}
                    <div class="progress statistical-percentage" id="percentage_room_registration" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="display:none">
                            <div class="progress-bar bg-danger" style="width: <?php  if($countAllRoomRegistration != 0) echo($countUnapproveRoomRegistration / $countAllRoomRegistration) * 100; else echo $countUnapproveRoomRegistration; ?>%;"></div>
                            <div class="progress-bar bg-info " style="width: <?php  if($countAllRoomRegistration != 0) echo($countApproveRoomRegistration / $countAllRoomRegistration) * 100; else echo $countApproveRoomRegistration; ?>%;";  background-color:  rgb(63, 111, 244) !important;"></div>
                    </div>
                   {{-- chuyen_phong --}}
                      <div class="progress statistical-percentage" id="percentage_change_room" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="display:none">
                              <div class="progress-bar bg-danger" style="width: <?php if ($countAllChangeRoom != 0)  echo  ($countUnapproveChangeRoom / $countAllChangeRoom) * 100; else echo $countUnapproveChangeRoom;?>%;"></div>
                              <div class="progress-bar bg-info " style="width: <?php  if ($countAllChangeRoom != 0) echo ($countApproveChangeRoom / $countAllChangeRoom) * 100; else echo $countApproveChangeRoom; ?>%;";  background-color:  rgb(63, 111, 244) !important;"></div>
                      </div>

                      {{-- tra phong --}}
                      <div class="progress statistical-percentage" id="percentage_giveback_room" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="display:none">
                              <div class="progress-bar bg-danger" style="width: <?php  if ($countAllGiveBackRoom != 0)  echo  ($countUnapproveGiveBackRoom / $countAllGiveBackRoom) * 100; else echo $countUnapproveGiveBackRoom; ?>%;"></div>
                              <div class="progress-bar bg-info " style="width: <?php  if ($countAllGiveBackRoom != 0)  echo ($countApproveGiveBackRoom / $countAllGiveBackRoom) * 100; else $countApproveGiveBackRoom; ?>%;";  background-color:  rgb(63, 111, 244) !important;"></div>
                      </div>

                      {{-- csvc --}}
                      <div class="progress statistical-percentage" id="percentage_csvc_repair_form" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="display:none">
                              <div class="progress-bar bg-danger" style="width: <?php  if ($countAllCsvcRepairForm != 0)  echo  ($countUnapproveCsvcRepaiForm / $countAllCsvcRepairForm) * 100; else echo $countUnapproveCsvcRepaiForm; ?>%;"></div>
                              <div class="progress-bar bg-info " style="width: <?php  if ($countAllCsvcRepairForm != 0)  echo ($countApproveCsvcRepaiForm / $countAllCsvcRepairForm) * 100; else $countApproveCsvcRepaiForm; ?>%;";  background-color:  rgb(63, 111, 244) !important;"></div>
                      </div>
            

                   
                  
                    <div class="note">
                        <div> <i class="fa-regular fa-square unapprove-icon"></i><span>Đơn chưa duyệt</span></div>
                        <div><i class="fa-regular fa-square approved-icon"></i><span>Đơn đã duyệt</span></div>
                    </div>

              </div>
              
      </div>
              {{-- đơn đăng ký ở --}}
              <div class="approve--button" id="approve--button" style="display: none;" >
                    <button type="button" class="btn btn-outline-danger" id ="not_approve--button" onclick="showList()">Chưa duyệt</button>
                    <button type="button" class="btn btn-outline-primary" id ="approved--button" onclick="showList_appoved()">Đã duyệt</button>
              </div>
              
              
              <section class="intro list_room_registration" id="not_approve--list" style="display: none;">
                <div class="bg-image h-100" style="background-color: #6095F0;">
                        <div class="mask d-flex align-items-center h-100">
                          <div class="container">
                            <div class="row justify-content-center">
                              <div class="col-12">
                                <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                                  <div class="card-body">
                                    <div class="table-responsive">
                                      <table class="table table-borderless mb-0">
                                        <thead>
                                          <tr>
                                            <th scope="col">
                                              {{-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                              </div> --}}
                                            </th>
                                            <th scope="col" class="align-middle text-center">STT</th>
                                            <th scope="col" class="align-middle text-center">ID</th>
                                            <th scope="col" class="align-middle text-center">Mã Loại Đơn</th>
                                            <th scope="col" class="align-middle text-center">Tên Loại Đơn</th>
                                            <th scope="col" class="align-middle text-center">Mã Phòng</th>
                                            <th scope="col" class="align-middle text-center">MSSV</th>
                                            <th scope="col" class="align-middle text-center">Học Kỳ</th>
                                            <th scope="col" class="align-middle text-center">Năm Học</th>
                                            <th scope="col" class="align-middle text-center">Ngày Tạo</th>
                                            <th scope="col" class="align-middle text-center">Ngày Duyệt</th>
                                            <th scope="col" class="align-middle text-center">Trạng Thái</th>
                                            <th scope="col" class="align-middle text-center" colspan="2">Hành Động</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                              @php $count = 1; @endphp
                                              @if(count($listNullStt) > 0)
                                                  @foreach ($listNullStt as $row )
                                                  <tr>
                                                          <th scope="row">
                                                            <div class="form-check">
                                                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                                              </div>
                                                          </th>
                                                          <td class="align-middle text-center">{{$count++}}</td>
                                                          <td class="align-middle text-center">{{$row-> id}}</td>
                                                          <td class="align-middle text-center">{{$row-> ma_loai}}</td>
                                                          <td class="align-middle text-center">{{$row-> ten_loai}}</td>
                                                          <td class="align-middle text-center">{{$row-> ma_phong == null ?'Đã xóa' :$row-> ma_phong}}</td>
                                                          <td class="align-middle text-center">{{$row-> mssv}}</td>
                                                          <td class="align-middle text-center">{{$row-> hoc_ky}}</td>
                                                          <td class="align-middle text-center">{{$row-> nam_hoc}}</td>
                                                          <td class="align-middle text-center">{{$row-> ngay_tao}}</td>
                                                          <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                                          <td class="align-middle text-center">{{ $row->trang_thai == NULL ? "Chưa duyệt" : $row->trang_thai }}</td>
                                                          
                                                          <td>
                                                            <form action=" {{ route('approve_request.room_registration')}}" class="accept_request--form" method="POST">
                                                              @csrf
                                                                <button type="submit" class="btn btn-danger btn-sm px-3 accept_request" id="button_acp" onclick="showDialog('{{ route('approve_request.room_registration')}}')">
                                                                  <i class="fa-solid fa-check"></i>
                                                                </button>
                                                                <input type="hidden" name="id" value="{{$row -> id }}"/>
                                                            </form>
                                                          </td>

                                                          <td >
                                                            <button type="button" class="btn btn-danger btn-sm px-3 ">
                                                              <i class="fas fa-times"></i>
                                                            </button>
                                                          </td>
                                                        </tr>
                                                  @endforeach
                                              @else
                                                  <tr>
                                                    <td colspan ="12" class="align-middle text-center">Không có dữ liệu</td>
                                                  </tr> 
                                                  @endif
                                                  
                                                </tbody>
                                              </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </section>

                    {{-- Đã duyệt --}}
                  <section class="intro list_room_registration" id="approved--list" style="display: none;">
                      <div class="bg-image h-100" style="background-color: #6095F0;">
                        <div class="mask d-flex align-items-center h-100">
                          <div class="container">
                            <div class="row justify-content-center">
                              <div class="col-12">
                                <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                                  <div class="card-body">
                                    <div class="table-responsive">
                                      <table class="table table-borderless mb-0">
                                        <thead>
                                          <tr>
                                            <th scope="col">
                                              {{-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                              </div> --}}
                                            </th>
                                            <th scope="col" class="align-middle text-center">STT</th>
                                            <th scope="col" class="align-middle text-center">ID</th>
                                            <th scope="col" class="align-middle text-center">Mã Loại Đơn</th>
                                            <th scope="col" class="align-middle text-center">Tên Loại Đơn</th>
                                            <th scope="col" class="align-middle text-center">Mã Phòng</th>
                                            <th scope="col" class="align-middle text-center">MSSV</th>
                                            <th scope="col" class="align-middle text-center">Học Kỳ</th>
                                            <th scope="col" class="align-middle text-center">Năm Học</th>
                                            <th scope="col" class="align-middle text-center">Ngày Tạo</th>
                                            <th scope="col" class="align-middle text-center">Ngày Duyệt</th>
                                            <th scope="col" class="align-middle text-center">Trạng Thái</th>
                                            {{-- <th scope="col" class="align-middle text-center" >Hành Động</th> --}}
                                          </tr>
                                        </thead>
                                        <tbody>  
                                          @php $count = 1; @endphp
                                              @if(count($listStt) > 0)
                                                  @foreach ($listStt as $row )
                                                      <tr>
                                                          <th scope="row">
                                                            <div class="form-check">
                                                              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                                            </div>
                                                          </th>
                                                          <td class="align-middle text-center">{{$count++}}</td>
                                                          <td class="align-middle text-center">{{$row-> id}}</td>
                                                          <td class="align-middle text-center">{{$row-> ma_loai}}</td>
                                                          <td class="align-middle text-center">{{$row-> ten_loai}}</td>
                                                          <td class="align-middle text-center">{{$row-> ma_phong == null ?'Đã xóa' :$row-> ma_phong}}</td>
                                                          <td class="align-middle text-center">{{$row-> mssv}}</td>
                                                          <td class="align-middle text-center">{{$row-> hoc_ky}}</td>
                                                          <td class="align-middle text-center">{{$row-> nam_hoc}}</td>
                                                          <td class="align-middle text-center">{{$row-> ngay_tao}}</td>
                                                          <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                                          <td class="align-middle text-center">  {{ $row->trang_thai == 1? "Đã duyệt" : $row->trang_thai }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                        <tr>
                                                          <td colspan ="11" class="align-middle text-center">Không có dữ liệu</td>
                                                        </tr> 
                                                @endif
                                                        
                                                      </tbody>
                                                    </table>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </section>
                                  
                                  {{-- đơn chuyển phòng --}}
                  <div class="approve--button" id="approve__changes--button" style="display: none;" >
                        <button type="button" class="btn btn-outline-danger" id ="not_approve__changes--button" onclick="showUnapprovedChangesList()">Chưa duyệt</button>
                        <button type="button" class="btn btn-outline-primary" id ="approved__changes--button" onclick="showApprovedChangesList()">Đã duyệt</button>
                  </div>
                    
                      <section class="intro list_room_registration" id="unapproved__changes--list" style="display: none;">
                      <div class="bg-image h-100" style="background-color: #6095F0;">
                        <div class="mask d-flex align-items-center h-100">
                          <div class="container">
                            <div class="row justify-content-center">
                              <div class="col-12">
                                <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                                  <div class="card-body">
                                    <div class="table-responsive">
                                      <table class="table table-borderless mb-0">
                                        <thead>
                                          <tr>
                                            <th scope="col">
                                              {{-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                              </div> --}}
                                        </th>
                                        <th scope="col" class="align-middle text-center">STT</th>
                                        <th scope="col" class="align-middle text-center">ID</th>
                                        <th scope="col" class="align-middle text-center">Mã Loại Đơn</th>
                                        <th scope="col" class="align-middle text-center">Tên Loại Đơn</th>
                                        <th scope="col" class="align-middle text-center">Mã Phòng</th>
                                        <th scope="col" class="align-middle text-center">MSSV</th>
                                        <th scope="col" class="align-middle text-center">Học Kỳ</th>
                                        <th scope="col" class="align-middle text-center">Năm Học</th>
                                        <th scope="col" class="align-middle text-center">Ngày Tạo</th>
                                        <th scope="col" class="align-middle text-center">Ngày Duyệt</th>
                                        <th scope="col" class="align-middle text-center">Trạng Thái</th>
                                        <th scope="col" class="align-middle text-center" colspan="2">Hành Động</th>
                                      </tr>
                                    </thead>
                                    
                                    <tbody>            
                                      @php $count = 1; @endphp
                                      @if(count($unapprove_changes_list) > 0)
                                      @foreach ($unapprove_changes_list as $row )
                                              <tr>
                                                <th scope="row">
                                                      <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                                        </div>
                                                  </th>
                                                  <td class="align-middle text-center">{{$count++}}</td>
                                                  <td class="align-middle text-center">{{$row-> id}}</td>
                                                  <td class="align-middle text-center">{{$row-> ma_loai}}</td>
                                                  <td class="align-middle text-center">{{$row-> ten_loai}}</td>
                                                  <td class="align-middle text-center">{{$row-> ma_phong == null ?'Đã xóa' :$row-> ma_phong}}</td>
                                                  <td class="align-middle text-center">{{$row-> mssv}}</td>
                                                  <td class="align-middle text-center">{{$row-> hoc_ky}}</td>
                                                  <td class="align-middle text-center">{{$row-> nam_hoc}}</td>
                                                  <td class="align-middle text-center">{{$row-> ngay_tao}}</td>
                                                  <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                                  <td class="align-middle text-center">{{ $row->trang_thai == NULL ? "Chưa duyệt" : $row->trang_thai }}</td>
                                                  
                                                  <td>
                                                    {{-- <form action="" class="accept_request--form" method="POST">
                                                      @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm px-3 accept_request" id="button_acp" onclick="">
                                                          <i class="fa-solid fa-check"></i>
                                                        </button>
                                                        <input type="hidden" name="id" value="{{$row -> id }}"/>
                                                        
                                                      </form> --}}
                                                      <form action=" {{ route('approve_request.room_registration')}}" class="accept_request--form" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm px-3 accept_request" id="button_acp" onclick="showDialog('{{ route('approve_request.room_registration')}}')">
                                                              <i class="fa-solid fa-check"></i>
                                                        </button>
                                                        <input type="hidden" name="id" value="{{$row -> id }}"/>
                                                      </form>
                                                </td>
                                                <td >
                                                  <button type="button" class="btn btn-danger btn-sm px-3 ">
                                                    <i class="fas fa-times"></i>
                                                    </button>
                                                </td>   
                                              </tr>
                                              @endforeach
                                      @else
                                      <tr>
                                              <td colspan ="12" class="align-middle text-center">Không có dữ liệu</td>
                                            </tr> 
                                            @endif
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                      
                      <section class="intro list_room_registration" id="approved__changes--list" style="display: none;">
                        <div class="bg-image h-100" style="background-color: #6095F0;">
                          <div class="mask d-flex align-items-center h-100">
                            <div class="container">
                              <div class="row justify-content-center">
                                <div class="col-12">
                                  <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                                    <div class="card-body">
                                      <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                          <thead>
                                            <tr>
                                              <th scope="col">
                                          {{-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                          </div> --}}
                                        </th>
                                        <th scope="col" class="align-middle text-center">STT</th>
                                        <th scope="col" class="align-middle text-center">ID</th>
                                        <th scope="col" class="align-middle text-center">Mã Loại Đơn</th>
                                        <th scope="col" class="align-middle text-center">Tên Loại Đơn</th>
                                        <th scope="col" class="align-middle text-center">Mã Phòng</th>
                                        <th scope="col" class="align-middle text-center">MSSV</th>
                                        <th scope="col" class="align-middle text-center">Học Kỳ</th>
                                        <th scope="col" class="align-middle text-center">Năm Học</th>
                                        <th scope="col" class="align-middle text-center">Ngày Tạo</th>
                                        <th scope="col" class="align-middle text-center">Ngày Duyệt</th>
                                        <th scope="col" class="align-middle text-center">Trạng Thái</th>
                                        
                                      </tr>
                                    </thead>

                                    <tbody>  
                                      @php $count = 1; @endphp
                                          @if(count($approve_changes_list) > 0)
                                              @foreach ($approve_changes_list as $row )
                                              <tr>
                                                      <th scope="row">
                                                        <div class="form-check">
                                                              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                                            </div>
                                                          </th>
                                                          <td class="align-middle text-center">{{$count++}}</td>
                                                          <td class="align-middle text-center">{{$row-> id}}</td>
                                                          <td class="align-middle text-center">{{$row-> ma_loai}}</td>
                                                          <td class="align-middle text-center">{{$row-> ten_loai}}</td>
                                                          <td class="align-middle text-center">{{$row-> ma_phong == null ?'Đã xóa' :$row-> ma_phong}}</td>
                                                          <td class="align-middle text-center">{{$row-> mssv}}</td>
                                                          <td class="align-middle text-center">{{$row-> hoc_ky}}</td>
                                                          <td class="align-middle text-center">{{$row-> nam_hoc}}</td>
                                                          <td class="align-middle text-center">{{$row-> ngay_tao}}</td>
                                                          <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                                          <td class="align-middle text-center">{{ $row->trang_thai == 1? "Đã duyệt" : $row->trang_thai }}</td>
                                                        </tr>
                                              @endforeach
                                          @else
                                          <tr>
                                            <td colspan ="11" class="align-middle text-center">Không có dữ liệu</td>
                                          </tr> 
                                          @endif
                          
                                        </tbody>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

              {{-- trả phòng --}}
              <div class="approve--button" id="approve__giveback--button" style="display: none;" >
                    <button type="button" class="btn btn-outline-danger" id ="unapprove__giveback--button" onclick="showUnapprovedGiveBackList()">Chưa duyệt</button>
                    <button type="button" class="btn btn-outline-primary" id ="approved__giveback--button" onclick="showApprovedGiveBackList()">Đã duyệt</button>
              </div>

              <section class="intro list_room_registration" id="unapproved__giveback--list" style="display: none;">
                <div class="bg-image h-100" style="background-color: #6095F0;">
                  <div class="mask d-flex align-items-center h-100">
                    <div class="container">
                      <div class="row justify-content-center">
                        <div class="col-12">
                          <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                  <thead>
                                    <tr>
                                      <th scope="col">
                                        {{-- <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                        </div> --}}
                                  </th>
                                  <th scope="col" class="align-middle text-center">STT</th>
                                  <th scope="col" class="align-middle text-center">ID</th>
                                  <th scope="col" class="align-middle text-center">Mã Loại Đơn</th>
                                  <th scope="col" class="align-middle text-center">Tên Loại Đơn</th>                                 
                                  <th scope="col" class="align-middle text-center">Mã Phòng</th>
                                  <th scope="col" class="align-middle text-center">MSSV</th>
                                  <th scope="col" class="align-middle text-center">Học Kỳ</th>
                                  <th scope="col" class="align-middle text-center">Năm Học</th>
                                  <th scope="col" class="align-middle text-center">Ngày Tạo</th>
                                  <th scope="col" class="align-middle text-center">Ngày Duyệt</th>
                                  <th scope="col" class="align-middle text-center">Trạng Thái</th>
                                  <th scope="col" class="align-middle text-center" colspan="2">Hành Động</th>
                                </tr>
                              </thead>

                              <tbody>            
                                @php $count = 1; @endphp
                                @if(count($unapprove_giveback_list ) > 0)
                                @foreach ($unapprove_giveback_list  as $row )
                                        <tr>
                                          <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                                  </div>
                                            </th>
                                            <td class="align-middle text-center">{{$count++}}</td>
                                            <td class="align-middle text-center">{{$row-> id}}</td>
                                            <td class="align-middle text-center">{{$row-> ma_loai}}</td>
                                            <td class="align-middle text-center">{{$row-> ten_loai}}</td>
                                            <td class="align-middle text-center">{{$row-> ma_phong == null ?'Đã xóa' :$row-> ma_phong}}</td>
                                            <td class="align-middle text-center">{{$row-> mssv}}</td>
                                            <td class="align-middle text-center">{{$row-> hoc_ky}}</td>
                                            <td class="align-middle text-center">{{$row-> nam_hoc}}</td>
                                            <td class="align-middle text-center">{{$row-> ngay_tao}}</td>
                                            <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                            <td class="align-middle text-center">{{ $row->trang_thai == NULL ? "Chưa duyệt" : $row->trang_thai }}</td>
                                            
                                            <td>
                                              {{-- <form action="" class="accept_request--form" method="POST">
                                                @csrf
                                                  <button type="submit" class="btn btn-danger btn-sm px-3 accept_request" id="button_acp" onclick="">
                                                    <i class="fa-solid fa-check"></i>
                                                  </button>
                                                  <input type="hidden" name="id" value="{{$row -> id }}"/>
                                                  
                                                </form> --}}
                                                <form action="{{ route('approve_request.room_registration.giveback_form')}}" class="accept_request--form" method="POST">
                                                  @csrf
                                                  <button type="submit" class="btn btn-danger btn-sm px-3 accept_request" id="button_acp" onclick="showDialog('{{ route('approve_request.room_registration.giveback_form')}}')">
                                                          <i class="fa-solid fa-check"></i>
                                                  </button>
                                                  <input type="hidden" name="id" value="{{$row -> id }}"/>
                                                </form>
                                          </td>
                                          <td >
                                            <button type="button" class="btn btn-danger btn-sm px-3 ">
                                              <i class="fas fa-times"></i>
                                              </button>
                                          </td>   
                                        </tr>
                                        @endforeach
                                @else
                                        <tr>
                                              <td colspan ="12" class="align-middle text-center">Không có dữ liệu</td>
                                        </tr> 
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>

                <section class="intro list_room_registration" id="approved__giveback--list" style="display: none;">
                      <div class="bg-image h-100" style="background-color: #6095F0;">
                        <div class="mask d-flex align-items-center h-100">
                          <div class="container">
                            <div class="row justify-content-center">
                              <div class="col-12">
                                <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                                  <div class="card-body">
                                    <div class="table-responsive">
                                      <table class="table table-borderless mb-0">
                                        <thead>
                                          <tr>
                                            <th scope="col">
                                        {{-- <div class="form-check">
                                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                        </div> --}}
                                      </th>
                                      <th scope="col" class="align-middle text-center">STT</th>
                                      <th scope="col" class="align-middle text-center">ID</th>
                                      <th scope="col" class="align-middle text-center">Mã Loại Đơn</th>
                                      <th scope="col" class="align-middle text-center">Tên Loại Đơn</th>
                                      <th scope="col" class="align-middle text-center">Mã Phòng</th>
                                      <th scope="col" class="align-middle text-center">MSSV</th>
                                      <th scope="col" class="align-middle text-center">Học Kỳ</th>
                                      <th scope="col" class="align-middle text-center">Năm Học</th>
                                      <th scope="col" class="align-middle text-center">Ngày Tạo</th>
                                      <th scope="col" class="align-middle text-center">Ngày Duyệt</th>
                                      <th scope="col" class="align-middle text-center">Trạng Thái</th>
                                      
                                    </tr>
                                  </thead>

                                  <tbody>  
                                    @php $count = 1; @endphp
                                        @if(count($approve_giveback_list) > 0)
                                            @foreach ($approve_giveback_list as $row )
                                            <tr>
                                                    <th scope="row">
                                                      <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                                          </div>
                                                        </th>
                                                        <td class="align-middle text-center">{{$count++}}</td>
                                                        <td class="align-middle text-center">{{$row-> id}}</td>
                                                        <td class="align-middle text-center">{{$row-> ma_loai}}</td>
                                                        <td class="align-middle text-center">{{$row-> ten_loai}}</td>
                                                        <td class="align-middle text-center">{{$row-> ma_phong == null ?'Đã xóa' :$row-> ma_phong}}</td>
                                                        <td class="align-middle text-center">{{$row-> mssv}}</td>
                                                        <td class="align-middle text-center">{{$row-> hoc_ky}}</td>
                                                        <td class="align-middle text-center">{{$row-> nam_hoc}}</td>
                                                        <td class="align-middle text-center">{{$row-> ngay_tao}}</td>
                                                        <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                                        <td class="align-middle text-center">{{ $row->trang_thai == 1? "Đã duyệt" : $row->trang_thai }}</td>
                                                  </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                          <td colspan ="11" class="align-middle text-center">Không có dữ liệu</td>
                                        </tr> 
                                        @endif
                        
                                      {{-- </tbody> --}}
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            {{-- đơn đăng kí sửa chửa csvc --}}
          <div class="approve--button" id="approve_csvc" style="display: none;" >
                  <button type="button" class="btn btn-outline-danger" id ="unapprove_csvc_repair" onclick="showUnapproveCsvcList()">Chưa duyệt</button>
                  <button type="button" class="btn btn-outline-primary" id ="approved_csvc_repair" onclick="showApprovedCsvcList()">Đã duyệt</button>
          </div>
          
          <section class="intro list_room_registration" id="unapprove__csvc--list" style="display: none;">
            <div class="bg-image h-100" style="background-color: #6095F0;">
              <div class="mask d-flex align-items-center h-100">
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-12">
                      <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                              <thead>
                                <tr>
                                  <th scope="col">
                                    {{-- <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    </div> --}}
                              </th>
                              <th scope="col" class="align-middle text-center">STT</th>
                              <th scope="col" class="align-middle text-center">ID</th>
                              <th scope="col" class="align-middle text-center">Mã Loại Đơn</th>
                              <th scope="col" class="align-middle text-center">Tên Loại Đơn</th>
                              <th scope="col" class="align-middle text-center">Tên CSVC</th>
                              <th scope="col" class="align-middle text-center">Số Lượng</th>
                              <th scope="col" class="align-middle text-center">Tình Trạng</th>
                              {{-- <th scope="col">Tên Loại Đơn</th> --}}
                              <th scope="col" class="align-middle text-center">Mã Phòng</th>
                              <th scope="col" class="align-middle text-center">Tên SV</th>
                              <th scope="col" class="align-middle text-center">Học Kỳ</th>
                              <th scope="col" class="align-middle text-center">Năm Học</th>
                              <th scope="col" class="align-middle text-center">Ngày Tạo</th>
                              <th scope="col" class="align-middle text-center">Ngày Duyệt</th>
                              <th scope="col" class="align-middle text-center">Trạng Thái</th>
                              <th scope="col" class="align-middle text-center" colspan="2">Hành Động</th>
                            </tr>
                          </thead>
                          <tbody>  
                            @php $count = 1; @endphp
                                @if(count($unapproved_csvc_list ) > 0)
                                    @foreach ($unapproved_csvc_list  as $row )
                                      <tr>
                                            <th scope="row">
                                              <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                                  </div>
                                                </th>
                                                        <td class="align-middle text-center">{{$count++}}</td>
                                                        <td class="align-middle text-center">{{ $row -> id}}</td>
                                                          <td class="align-middle text-center">{{ $row -> ma_loai }}</td>
                                                          <td class="align-middle text-center">{{ $row -> ten_loai }}</td>
                                                          <td class="align-middle text-center">{{$row-> ten_csvc }}</td>
                                                          <td class="align-middle text-center">{{$row-> so_luong}}</td>
                                                          <td class="align-middle text-center">{{$row-> tinh_trang }}</td>
                                                          <td class="align-middle text-center">{{$row-> vi_tri_sua}}</td>
                                                          <td class="align-middle text-center">{{$row-> ho_tenSV}}</td>
                                                          <td class="align-middle text-center">{{$row-> hoc_ky}}</td>
                                                          <td class="align-middle text-center">{{$row-> nam_hoc}}</td>
                                                          <td class="align-middle text-center">{{date('d-m-Y',strtotime($row-> ngay_tao))}}</td>
                                                          <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                                          <td class="align-middle text-center">{{ $row->trang_thai == NULL ? "Chưa duyệt" : "Đã duyệt"}}</td>
                                                          <td >
                                                            <form action="{{route('approve_request.acp_csvc_repair_register')}}" class="accept_request--form" method="POST">
                                                                  @csrf
                                                                  <button type="submit" class="btn btn-danger btn-sm px-3 accept_request" id="button_acp" onclick="showDialog('{{route('approve_request.acp_csvc_repair_register')}}')">
                                                                          <i class="fa-solid fa-check"></i>
                                                                  </button>
                                                                   <input type="hidden" name="id" value="{{$row -> id }}"/>
                                                            </form>
                                                      </td>
                                                      <td >
                                                            <button type="button" class="btn btn-danger btn-sm px-3 ">
                                                                  <i class="fas fa-times"></i>
                                                              </button>
                                                      </td>   
                                              </tr>
                                    @endforeach
                                @else
                                {{-- <tr>
                                  <td colspan ="15" class="align-middle text-center">Không có dữ liệu</td>
                                </tr>  --}}
                                @if(count($unapproved_csvc_listNull ) > 0)
                                    @foreach ($unapproved_csvc_listNull  as $row )
                                       <tr>
                                        <th scope="row">
                                          <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                              </div>
                                            </th>
                                                    <td class="align-middle text-center">{{$count++}}</td>
                                                    <td class="align-middle text-center">{{ $row -> id}}</td>
                                                      <td class="align-middle text-center">{{ $row -> ma_loai }}</td>
                                                      <td class="align-middle text-center">{{ $row -> ten_loai }}</td>
                                                      <td class="align-middle text-center">{{$row-> ma_csvc ==null ? 'Đã xóa': $row-> ma_csvc}}</td>
                                                      <td class="align-middle text-center">{{$row-> so_luong}}</td>
                                                      <td class="align-middle text-center">{{$row-> tinh_trang }}</td>
                                                      <td class="align-middle text-center">{{$row-> vi_tri_sua}}</td>
                                                      <td class="align-middle text-center">{{$row-> ho_tenSV}}</td>
                                                      <td class="align-middle text-center">{{$row-> hoc_ky}}</td>
                                                      <td class="align-middle text-center">{{$row-> nam_hoc}}</td>
                                                      <td class="align-middle text-center">{{date('d-m-Y',strtotime($row-> ngay_tao))}}</td>
                                                      <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                                      <td class="align-middle text-center">{{ $row->trang_thai == NULL ? "Chưa duyệt" : "Đã duyệt"}}</td>
                                                      <td >
                                                        <form action="{{route('approve_request.acp_csvc_repair_register')}}" class="accept_request--form" method="POST">
                                                              @csrf
                                                              <button type="submit" class="btn btn-danger btn-sm px-3 accept_request" id="button_acp" onclick="showDialog('{{route('approve_request.acp_csvc_repair_register')}}')">
                                                                      <i class="fa-solid fa-check"></i>
                                                              </button>
                                                               <input type="hidden" name="id" value="{{$row -> id }}"/>
                                                        </form>
                                                  </td>
                                                  <td >
                                                        <button type="button" class="btn btn-danger btn-sm px-3 ">
                                                              <i class="fas fa-times"></i>
                                                          </button>
                                                  </td>   
                                          </tr>
                                    @endforeach
                                    @else
                                          <tr>
                                            <td colspan ="14" class="align-middle text-center">Không có dữ liệu</td>
                                          </tr>
                                    @endif
                                

                                  </tbody>
                            @endif
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {{-- @if($approved_csvc_list !=null) --}}
          <section class="intro list_room_registration" id="approved__csvc--list" style="display: none;">
            <div class="bg-image h-100" style="background-color: #6095F0;">
              <div class="mask d-flex align-items-center h-100">
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-12">
                      <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                  <thead>
                                          <tr>
                                            <th scope="col">
                                              {{-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                              </div> --}}
                                        </th>
                                        <th scope="col" class="align-middle text-center">STT</th>
                                        <th scope="col" class="align-middle text-center">ID</th>
                                        <th scope="col" class="align-middle text-center">Mã Loại Đơn</th>
                                        <th scope="col" class="align-middle text-center">Tên Loại Đơn</th>
                                        <th scope="col" class="align-middle text-center">Tên CSVC</th>
                                        <th scope="col" class="align-middle text-center">Số Lượng</th>
                                        <th scope="col" class="align-middle text-center">Tình Trạng</th>
                                        <th scope="col" class="align-middle text-center">Mã Phòng</th>
                                        <th scope="col" class="align-middle text-center">Tên SV</th>
                                        <th scope="col" class="align-middle text-center">Học Kỳ</th>
                                        <th scope="col" class="align-middle text-center">Năm Học</th>
                                        <th scope="col" class="align-middle text-center">Ngày Tạo</th>
                                        <th scope="col" class="align-middle text-center">Ngày Duyệt</th>
                                        <th scope="col" class="align-middle text-center">Trạng Thái</th>
                                        {{-- <th scope="col" class="align-middle text-center">Hành Động</th> --}}
                                      </tr>
                              </thead>
                              <tbody>  
                                @php $count = 1; @endphp
                                    @if(count($approved_csvc_list ) > 0)
                                        @foreach ($approved_csvc_list  as $row )
                                          <tr>
                                                <th scope="row">
                                                  <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                                      </div>
                                                    </th>
                                                            <td class="align-middle text-center">{{$count++}}</td>
                                                            <td class="align-middle text-center">{{ $row -> id}}</td>
                                                              <td class="align-middle text-center">{{ $row -> ma_loai }}</td>
                                                              <td class="align-middle text-center">{{ $row -> ten_loai }}</td>
                                                              <td class="align-middle text-center">{{$row-> ten_csvc }}</td>
                                                              <td class="align-middle text-center">{{$row-> so_luong}}</td>
                                                              <td class="align-middle text-center">{{$row-> tinh_trang }}</td>
                                                              <td class="align-middle text-center">{{$row-> vi_tri_sua}}</td>
                                                              <td class="align-middle text-center">{{$row-> ho_tenSV}}</td>
                                                              <td class="align-middle text-center">{{$row-> hoc_ky}}</td>
                                                              <td class="align-middle text-center">{{$row-> nam_hoc}}</td>
                                                              <td class="align-middle text-center">{{date('d-m-Y',strtotime($row-> ngay_tao))}}</td>
                                                              <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                                              <td class="align-middle text-center">{{ $row->trang_thai == NULL ? "Chưa duyệt" : "Đã duyệt"}}</td>
                                                              <td >
                                                          
                                                          {{-- <td >
                                                                <button type="button" class="btn btn-danger btn-sm px-3 ">
                                                                      <i class="fas fa-times"></i>
                                                                  </button>
                                                          </td>    --}}
                                                  </tr>
                                        @endforeach       
                                   @else
                                      @php $count = 1; @endphp
                                        @if(count($approved_csvc_listNull ) > 0)
                                            @foreach ($approved_csvc_listNull  as $row )
                                              <tr>
                                                  <th scope="row">
                                                    <div class="form-check">
                                                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" />
                                                        </div>
                                                      </th>
                                                              <td class="align-middle text-center">{{$count++}}</td>
                                                              <td class="align-middle text-center">{{ $row -> id}}</td>
                                                                <td class="align-middle text-center">{{ $row -> ma_loai }}</td>
                                                                <td class="align-middle text-center">{{ $row -> ten_loai }}</td>
                                                                <td class="align-middle text-center">{{$row->ma_csvc ==null ?'Đã xóa':$row->ma_csvc }}</td>
                                                                <td class="align-middle text-center">{{$row-> so_luong}}</td>
                                                                <td class="align-middle text-center">{{$row-> tinh_trang }}</td>
                                                                <td class="align-middle text-center">{{$row-> vi_tri_sua}}</td>
                                                                <td class="align-middle text-center">{{$row-> ho_tenSV}}</td>
                                                                <td class="align-middle text-center">{{$row-> hoc_ky}}</td>
                                                                <td class="align-middle text-center">{{$row-> nam_hoc}}</td>
                                                                <td class="align-middle text-center">{{date('d-m-Y',strtotime($row-> ngay_tao))}}</td>
                                                                <td class="align-middle text-center">{{$row-> ngay_duyet}}</td>
                                                                <td class="align-middle text-center">{{ $row->trang_thai == NULL ? "Chưa duyệt" : "Đã duyệt"}}</td>
                                                                <td >
                                                            
                                                            {{-- <td >
                                                                  <button type="button" class="btn btn-danger btn-sm px-3 ">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                            </td>    --}}
                                                    </tr>
                                          @endforeach
                                       @else
                                                     <tr>
                                                        <td colspan ="14" class="align-middle text-center">Không có dữ liệu...</td>
                                                    </tr>   
                                        @endif
                                      </tbody>
                                    @endif
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        {{-- @else --}}
            {{-- @if($approved_csvc_listNull !=null) --}}
           
                                  
                                   
          {{-- @endif --}}
        

      
  <script>
              //  đăng ký ở
      function showbutton() {
          var button = document.getElementById("approve--button");
          var changes_button = document.getElementById("approve__changes--button");
          var  giveback_button = document.getElementById("approve__giveback--button");
          var register_repair_button = document.getElementById("approve_csvc");
          var list1 = document.getElementById("not_approve--list");
          var list2 = document.getElementById("approved--list");
          var listchanges1 = document.getElementById("approved__changes--list");
          var listchanges2 = document.getElementById("unapproved__changes--list");
          var list_giveback1 = document.getElementById("unapproved__giveback--list");
          var list_giveback2 = document.getElementById("approved__giveback--list");
          var csvc_repair_list = document.getElementById("unapprove__csvc--list");
          var  csvc_repair_list2= document.getElementById("approved__csvc--list");
          
          var  percentage_all_form= document.getElementById("percentage_all_form");
          var  percentage_room_registration= document.getElementById("percentage_room_registration");
          var  percentage_change_room= document.getElementById("percentage_change_room");
          var  percentage_giveback_room= document.getElementById("percentage_giveback_room");
          var  percentage_giveback_room= document.getElementById("percentage_giveback_room");
          var  percentage_csvc_repair_form= document.getElementById("percentage_csvc_repair_form");
          
         
            if (button.style.display === "none") {
              button.style.display = "block";
              changes_button.style.display = "none";
              giveback_button.style.display = "none";
              register_repair_button.style.display = "none";
              listchanges1.style.display = "none";
              listchanges2.style.display = "none";
              list_giveback1.style.display = "none";
              list_giveback2.style.display = "none";
              csvc_repair_list.style.display = "none";
              csvc_repair_list2.style.display = "none";
              percentage_all_form.style.display = "none";
              percentage_change_room.style.display = "none";
              percentage_giveback_room.style.display = "none";
              percentage_csvc_repair_form.style.display = "none";
              percentage_room_registration.style.display = "flex";
              
            } else {
              button.style.display = "none";
              list1.style.display = "none";
              list2.style.display = "none";
              percentage_room_registration.style.display = "none";
              percentage_change_room.style.display = "none";
              percentage_giveback_room.style.display = "none";
              percentage_csvc_repair_form.style.display = "none";
              percentage_all_form.style.display = "flex";
            }
       }
         
  
      function showList() {
        var list = document.getElementById("not_approve--list");
        var list2 = document.getElementById("approved--list");
          if (list.style.display === "none") {
            list.style.display = "block";
            list2.style.display="none";
          } else {
            list.style.display = "none";
          }
      }
      
      function showList_appoved() {
        var list = document.getElementById("approved--list");
        var list2 = document.getElementById("not_approve--list");
        if (list.style.display === "none") {
          list.style.display = "block";
          list2.style.display="none";
        } else {
          list.style.display = "none";
          }
      }
                  
      // đơn chuyển phòng
      function showChangesbutton(){
        var button = document.getElementById("approve__changes--button");
        var register_button= document.getElementById("approve--button");
        var  giveback_button = document.getElementById("approve__giveback--button");
        var register_repair_button = document.getElementById("approve_csvc");
        var list = document.getElementById("approved--list");
        var list2 = document.getElementById("not_approve--list");
        var listchanges1 = document.getElementById("approved__changes--list");
        var listchanges2 = document.getElementById("unapproved__changes--list");
        var list_giveback1 = document.getElementById("unapproved__giveback--list");
        var list_giveback2 = document.getElementById("approved__giveback--list");
        var csvc_repair_list = document.getElementById("unapprove__csvc--list");
        var csvc_repair_list2= document.getElementById("approved__csvc--list");

        var  percentage_all_form= document.getElementById("percentage_all_form");
        var  percentage_room_registration= document.getElementById("percentage_room_registration");
        var  percentage_change_room= document.getElementById("percentage_change_room");
        var  percentage_giveback_room= document.getElementById("percentage_giveback_room");
        var  percentage_csvc_repair_form= document.getElementById("percentage_csvc_repair_form");
        
        if (button.style.display === "none") {
          button.style.display = "block";
          register_button.style.display = "none";
          giveback_button.style.display = "none";
          register_repair_button.style.display = "none";
          list.style.display = "none";
          list2.style.display = "none";
          list_giveback1.style.display = "none";
          list_giveback2.style.display = "none";
          csvc_repair_list.style.display = "none";
          csvc_repair_list2.style.display = "none";
          percentage_all_form.style.display = "none";
          percentage_room_registration.style.display = "none";
          percentage_giveback_room.style.display = "none";
          percentage_csvc_repair_form.style.display = "none";
          percentage_change_room.style.display = "flex";
          
        } else {
          button.style.display = "none";
          listchanges1.style.display = "none";
          listchanges2.style.display = "none";
          percentage_room_registration.style.display = "none";
          percentage_change_room.style.display = "none";
          percentage_giveback_room.style.display = "none";
          percentage_csvc_repair_form.style.display = "none";
          percentage_all_form.style.display = "flex";
        }
      }

      function showApprovedChangesList() {
        var list = document.getElementById("approved__changes--list");
        var list1= document.getElementById("unapproved__changes--list");
          if (list.style.display === "none") {
            list.style.display = "block";
            list1.style.display="none";
          } else {
            list.style.display = "none";
          }
      }

      function showUnapprovedChangesList() {
        var list = document.getElementById("unapproved__changes--list");
        var list2 = document.getElementById("approved__changes--list");
          if (list.style.display === "none") {
            list.style.display = "block";
            list2.style.display="none";
          } else {
            list.style.display = "none";
          }
      }
      //đơn trả phòng
        function showGiveBackbutton(){
            var button = document.getElementById("approve__giveback--button");
            var reagister_button = document.getElementById("approve--button");
            var changes_button = document.getElementById("approve__changes--button");
            var register_repair_button = document.getElementById("approve_csvc");
            var list = document.getElementById("approved--list");
            var list2 = document.getElementById("not_approve--list");
            var listchanges1 = document.getElementById("approved__changes--list");
            var listchanges2 = document.getElementById("unapproved__changes--list");
            var listgiveback1 = document.getElementById("unapproved__giveback--list")
            var listgiveback2 = document.getElementById("approved__giveback--list");
            var csvc_repair_list = document.getElementById("unapprove__csvc--list");
            var csvc_repair_list2= document.getElementById("approved__csvc--list");

          var  percentage_all_form= document.getElementById("percentage_all_form");
          var  percentage_room_registration= document.getElementById("percentage_room_registration");
          var  percentage_change_room= document.getElementById("percentage_change_room");
          var  percentage_giveback_room= document.getElementById("percentage_giveback_room");
          var  percentage_csvc_repair_form= document.getElementById("percentage_csvc_repair_form");
          // console.log();
            if (button.style.display === "none") {
              button.style.display = "block";
              reagister_button.style.display = "none";
              changes_button.style.display = "none";
              register_repair_button.style.display = "none";
              list.style.display = "none";
              list2.style.display = "none";
              listchanges1.style.display = "none";
              listchanges2.style.display = "none";
              csvc_repair_list.style.display = "none";
              csvc_repair_list2.style.display = "none";
              percentage_all_form.style.display = "none";
              percentage_room_registration.style.display = "none";
              percentage_change_room.style.display = "none";
              percentage_csvc_repair_form.style.display = "none";
              percentage_giveback_room.style.display = "flex";

            
            } else {
              button.style.display = "none";
              listgiveback1.style.display = "none";
              listgiveback2.style.display = "none";
              percentage_room_registration.style.display = "none";
              percentage_change_room.style.display = "none";
              percentage_giveback_room.style.display = "none";
              percentage_csvc_repair_form.style.display = "none";
              percentage_all_form.style.display = "flex";
            }
      }

      function  showUnapprovedGiveBackList(){
          var list = document.getElementById("unapproved__giveback--list");
          var list2 = document.getElementById("approved__giveback--list");
            if (list.style.display === "none") {
              list.style.display = "block";
              list2.style.display="none";
            } else {
              list.style.display = "none";
            }
      }

      function  showApprovedGiveBackList(){
        var list = document.getElementById("approved__giveback--list");
        var list2 = document.getElementById("unapproved__giveback--list");
            if (list.style.display === "none") {
              list.style.display = "block";
              list2.style.display="none";
            } else {
              list.style.display = "none";
            }
      }

      //sửa chửa csvc
      function showCsvcRepairbutton(){
            var button = document.getElementById("approve_csvc");
            var register_button= document.getElementById("approve--button");
            var changes_button = document.getElementById("approve__changes--button");
            var  giveback_button = document.getElementById("approve__giveback--button");
            var list = document.getElementById("approved--list");
            var list2 = document.getElementById("not_approve--list");
            var listchanges1 = document.getElementById("approved__changes--list");
            var listchanges2 = document.getElementById("unapproved__changes--list");
            var listgiveback1 = document.getElementById("unapproved__giveback--list")
            var listgiveback2 = document.getElementById("approved__giveback--list");
            var csvc_repair_list = document.getElementById("unapprove__csvc--list");
            var csvc_repair_list2= document.getElementById("approved__csvc--list");

            var  percentage_all_form= document.getElementById("percentage_all_form");
            var  percentage_room_registration= document.getElementById("percentage_room_registration");
            var  percentage_change_room= document.getElementById("percentage_change_room");
            var  percentage_giveback_room= document.getElementById("percentage_giveback_room");
            var  percentage_csvc_repair_form= document.getElementById("percentage_csvc_repair_form");

              if (button.style.display === "none") {
                button.style.display = "block";
                register_button.style.display = "none";
                changes_button.style.display = "none";
                giveback_button.style.display = "none";
                list.style.display = "none";
                list2.style.display = "none";
                listchanges1.style.display = "none";
                listchanges2.style.display = "none";
                listgiveback1.style.display = "none";
                listgiveback2.style.display = "none";
                percentage_all_form.style.display = "none";
                percentage_room_registration.style.display = "none";
                percentage_change_room.style.display = "none";
                percentage_giveback_room.style.display = "none";
                percentage_csvc_repair_form.style.display = "flex";
        
        
                } else {
                  button.style.display = "none";
                  csvc_repair_list.style.display = "none";
                  csvc_repair_list2.style.display = "none";
                  percentage_csvc_repair_form.style.display = "none";
                  percentage_room_registration.style.display = "none";
                  percentage_change_room.style.display = "none";
                  percentage_giveback_room.style.display = "none";
                  percentage_all_form.style.display = "flex";
                  
                }

      }
      function showUnapproveCsvcList(){
        var list = document.getElementById("unapprove__csvc--list");
        var list2 = document.getElementById("approved__csvc--list");
          if (list.style.display === "none") {
            list.style.display = "block";
            list2.style.display="none";
          } else {
            list.style.display = "none";
          }
      }

      function showApprovedCsvcList(){
        var list = document.getElementById("unapprove__csvc--list");
        var list2 = document.getElementById("approved__csvc--list");
          if (list2.style.display === "none") {
            list2.style.display = "block";
            list.style.display="none";
          } else {
            list2.style.display = "none";
          }
      }
      //kết quả
      function showDialog(url){
        //event.preventDefault();
        window.location.href =  `${url}`;
        Swal.fire({
          icon: 'success',
          text: 'Đơn đã được duyệt !',
          showConfirmButton: false,
                timer: 2000
               });
       }

       
  </script>
   
    @endsection