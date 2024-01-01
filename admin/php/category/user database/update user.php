<?php
        include('../../database.php');
// ------------------  Sửa dữ liệu phim  ------------------------------
    // Lấy dữ liệu từ form submit
        $userId = $_POST['editUserId'];
        $name = $_POST['editNameUser'];
        $email=$_POST['editEmail'];
        $password=$_POST['editPassword'];

        // Thực hiện câu truy vấn UPDATE để sửa dữ liệu trong CSDL
        $sql = "UPDATE user SET name='$name', email='$email', password='$password'
                WHERE user_id='$userId'";

        $result = mysqli_query($conn, $sql);

        if($result){
            header('Location: ../../admin.php'); // Thay đổi đường dẫn tùy thuộc vào trang của bạn
            exit();
            echo '<script>alert("Cập nhật dữ liệu thành công")</script>';
        
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

?>