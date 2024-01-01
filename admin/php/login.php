<?php
session_start();

// Include file kết nối CSDL
include('database.php');

if (isset($_POST['login'])) {
    $admin = $_POST['name'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM admin WHERE admin_name = '$admin' AND admin_pass = '$pass' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Lưu thông tin admin vào session
            $_SESSION['admin_id'] = $row['admin_id'];
            $_SESSION['admin_name'] = $row['admin_name'];

            echo "Đăng nhập thành công ";

            // Chuyển hướng đến trang dashboard
            header("Location: admin.php");
            exit;
        } else {
            echo "Tên đăng nhập hoặc mật khẩu chưa đúng";
        }
    } else {
        echo "Lỗi truy vấn: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="container">
        <div class="myform">
            <form method="post">
                <h2>ADMIN LOGIN</h2>
                <input name="name" type="text" placeholder="Admin Name">
                <input name="pass" type="password" placeholder="Password">
                <button name="login" type="submit">LOGIN</button>
            </form>
        </div>
        <div class="image">
            <img src="../image/image.jpg">
        </div>
    </div>

</body>
</html>
