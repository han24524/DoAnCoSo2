<?php
include('database.php');

if (isset($_POST['text-search-user'])) {
    $timKhachHang = $_POST['text-search-user'];

    // Giả sử $conn là một kết nối MySQLi hợp lệ
    $sql = $conn->prepare("SELECT * FROM user WHERE name LIKE ?");
    $searchTerm = "%$timKhachHang%";
    $sql->bind_param("s", $searchTerm);
    $sql->execute();
    $result = $sql->get_result();

    $response = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
        echo json_encode($response);
    } else {
        $response['error'] = 'Không có dữ liệu';
        die(json_encode($response));
    }
} else {
    $response['error'] = 'Chưa nhập dữ liệu tìm kiếm';
    die(json_encode($response));
}
?>
