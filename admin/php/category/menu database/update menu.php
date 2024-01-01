<?php
        include('../../database.php');
// ------------------  Sửa dữ liệu phim  ------------------------------
    // Lấy dữ liệu từ form submit
        $menuId = $_POST['editmenuId'];
        $name = $_POST['editNamemenu'];
        $email=$_POST['editEmail'];
        $password=$_POST['editPassword'];

        // Thực hiện câu truy vấn UPDATE để sửa dữ liệu trong CSDL
        $sql = "UPDATE menu SET name='$name', email='$email', password='$password'
                WHERE menu_id='$menuId'";

        $result = mysqli_query($conn, $sql);

        if($result){
            header('Location: ../../admin.php'); // Thay đổi đường dẫn tùy thuộc vào trang của bạn
            exit();
            echo '<script>alert("Cập nhật dữ liệu thành công")</script>';
        
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

?>