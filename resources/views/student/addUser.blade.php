<form action="" method="POST" class="add_cbql">
    @csrf
    <label for="mssv">MSSV</label>
    <input type="text" name="mssv" id="mssv" value=""> 
    <label for="hoten">Tên</label>
    <input type="text" name="hoten" id="hoten" value=""> 
    <label for="email">email</label>
    <input type="text" name="email" id="email" value=""> 
    <label for="pass">pass</label>
    <input type="text" name="pass" id="pass" value=""> 
    <label for="nganhhoc">Ngành học</label>
    <input type="text" name="nganhhoc" id="nganhhoc" value=""> 
    <label for="ngaysinh">ngày sinh</label>
    <input type="date" name="ngaysinh" id="gioitinh" value=""> 
    <label for="gioitinh">Giới tính</label>
    <input type="text" name="gioitinh" id="gioitinh" value=""> 
    <label for="sv_ktx">SV_KTX</label>
    <input type="text" name="sv_ktx" id="sv_ktx" value=""> 
    <input type="submit" name="" value="Thêm" >
</form>