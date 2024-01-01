<?php
// Bao gồm mã kết nối cơ sở dữ liệu ở đây
include('database.php');

if (isset($_POST['text-search-f'])) {
    $timPhim = $_POST['text-search-f'];

    // Giả sử $conn là một kết nối MySQLi hợp lệ
    $sql = $conn->prepare("SELECT * FROM movie WHERE name LIKE ?");
    $searchTerm = "%$timPhim%";
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
