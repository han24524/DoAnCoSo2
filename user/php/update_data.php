<?php
session_start();
// Include mã kết nối cơ sở dữ liệu
include('database.php');

// Lấy giá trị từ POST hoặc từ các nguồn khác
if (isset($_SESSION['user_id'])) {
    // Nếu đã đăng nhập
    $id_user = $_SESSION['user_id'];
} else {
    // Nếu chưa đăng nhập
    $id_user = null;
}

if (isset($_POST['id_movie'])) {
    $id_movie = $_POST['id_movie'];
}

$viewTime = date('Y-m-d');

$sql = "INSERT INTO views (id_user, id_movie, viewTime)
        VALUES ('$id_user', '$id_movie', '$viewTime')";

$result = mysqli_query($conn, $sql);
// Đóng kết nối cơ sở dữ liệu
$conn->close();
