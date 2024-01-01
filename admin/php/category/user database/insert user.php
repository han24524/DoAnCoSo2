<?php
        include('../../database.php');
// ------------------  Thêm dữ liệu phim  ------------------------------
    if(isset($_POST['btn-insert-user'])){
        $add_name_user=$_POST['addNameUser'];
        $add_password=$_POST['addPassword'];
        $add_email=$_POST['addEmail'];

        $sql = "INSERT INTO user (name, password, email) 

                VALUES ('$add_name_user', '$add_password', '$add_email')";

        $result = mysqli_query($conn, $sql);

        if($result){
            header('Location: ../../admin.php'); // Thay đổi đường dẫn tùy thuộc vào trang của bạn
            exit();

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

?>