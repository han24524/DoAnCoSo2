<?php 
        include('../../database.php');
    // ------------------  Xóa dữ liệu phim  ------------------------------
    if(isset($_POST['btn-delete-menu'])){
        $delmenu_ID=$_POST['delmenu_ID'];
    
        $sql = "DELETE FROM menu WHERE menu_id='$delmenu_ID'";
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