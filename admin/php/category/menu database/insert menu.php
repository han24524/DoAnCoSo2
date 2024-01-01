<?php
        include('../../database.php');
// ------------------  Thêm dữ liệu phim  ------------------------------
    if(isset($_POST['btn-insert-menu'])){
        $add_name_menu=$_POST['addNamemenu'];
        $add_password=$_POST['addPassword'];
        $add_email=$_POST['addEmail'];

        $sql = "SELECT parent.name_menu AS parent_menu, child.name_menu AS child_menu
                FROM menu child
                LEFT JOIN menu parent ON child.parent_id_menu = parent.id_menu;

                VALUES ('$add_name_menu', '$add_password', '$add_email')";

        $result = mysqli_query($conn, $sql);

        if($result){
            header('Location: ../../admin.php'); // Thay đổi đường dẫn tùy thuộc vào trang của bạn
            exit();

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

?>