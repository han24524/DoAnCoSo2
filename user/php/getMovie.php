<?php
// Bao gồm mã kết nối cơ sở dữ liệu ở đây
include('database.php');

// Giả sử $conn là một kết nối MySQLi hợp lệ
$sql = $conn->prepare("SELECT *
                        FROM views
                        INNER JOIN movie ON views.id_movie = movie.id_movie;");
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
?>