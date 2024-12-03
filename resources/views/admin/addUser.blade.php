<form action="" method="POST" class="add_cbql">
        @csrf
        <label for="mscb">MSCB</label>
        <input type="text" name="mscb" id="mscb" value=""> 

        <label for="hoten">Tên</label>
        <input type="text" name="hoten" id="hoten" value=""> 
        <label for="gioitinh">Giới tính</label>
        <input type="text" name="gioitinh" id="gioitinh" value=""> 
        <label for="chucvu">chức vụ</label>
        <input type="text" name="chucvu" id="chucvu" value=""> 
        <label for="email">email</label>
        <input type="text" name="email" id="email" value=""> 
        <label for="pass">pass</label>
        <input type="text" name="pass" id="pass" value=""> 
        <input type="submit" name="" value="Thêm" >
</form>