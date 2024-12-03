@extends('layouts.student_index')
    @section('view_payment_status')

    @if($id_form !=null)
          @if($id_form_un !=null)
            <table class="table table-hover view_bill_room">
                  <tbody>
                          <tr>
                            <th scope="row">Phí Phòng</th>
                            <td>{{number_format($id_form_un ->don_gia, 0 , ',' ,'.')}} VND</td>
                            <th scope="row">Trạng Thái</th>
                            <td>@if($id_hd !=null) {{$id_hd ->trang_thai ==1?'Đã đóng':'Chưa đóng'}} @endif</td>
                            <th scope="row">Ngày Đóng</th>
                            <td>@if($id_hd !=null) {{date('d-m-Y',strtotime($id_hd-> ngaydongphi)) }} @endif</td>
                          </tr>
                  </tbody>
              </table>
            @endif
            <button type="button" class="btn btn-success">Xuất file</button>
      @else
          <div>Không có dữ liệu....</div>
      @endif
      
      
    @endsection
