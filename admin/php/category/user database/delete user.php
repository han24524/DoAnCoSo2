<?php 
        include('../../database.php');
    // ------------------  Xóa dữ liệu phim  ------------------------------
    if(isset($_POST['btn-delete-user'])){
        $delUser_ID=$_POST['delUser_ID'];
    
        $sql = "DELETE FROM user WHERE user_id='$delUser_ID'";
        $result = mysqli_query($conn, $sql);
    
        if($result){
            header('Location: ../../admin.php'); // Thay đổi đường dẫn tùy thuộc vào trang của bạn
            exit();
            echo '<script>alert("Xóa dữ liệu thành công")</script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>