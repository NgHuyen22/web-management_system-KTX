
document.getElementById("form__add").addEventListener("submit", function(event) {
    var makhu = document.getElementById("makhu").value;
    var tenkhu = document.getElementById("tenkhu").value;

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
            text: 'Thêm thành công',
            showConfirmButton: false,
            timer: 2500
        });
    }
});

