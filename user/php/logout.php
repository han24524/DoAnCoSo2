<?php
    // Khởi động session
    session_start();

    // Hủy session
    session_destroy();

    // Chuyển hướng người dùng về trang đăng nhập hoặc trang chính của bạn
    header("Location: login.php");
    exit;
?>
