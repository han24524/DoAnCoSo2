<?php
session_start(); // Bắt đầu phiên làm việc

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['admin'])) {
    // Người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập hoặc trang chính
    header("Location: ../login.php"); // Thay 'login.php' bằng đường dẫn tới trang đăng nhập hoặc trang chính của bạn
    exit();
}

// Người dùng đã đăng nhập, thực hiện đăng xuất bằng cách xóa biến phiên và hủy phiên làm việc
unset($_SESSION['admin']);
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập hoặc trang chính
header("Location: ../login.php"); // Thay 'login.php' bằng đường dẫn tới trang đăng nhập hoặc trang chính của bạn
exit();
?>