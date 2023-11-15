<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<div class="section-update">
    <h2>PHIM NỔI BẬT > <span style="color: red;">Tất cả</span></h2>
    <?php
    // Mở lại kết nối đến MySQL
    $conn = new mysqli('localhost', 'root', '', 'website_film');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Truy vấn dữ liệu từ bảng "movie"
    $sql = "SELECT * FROM movie";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Xuất dữ liệu mỗi dòng
        while($row = $result->fetch_assoc()) {
            echo "<div class='section-update section'>
                    <span class='status_movie'>" . $row["status"] . "</span>
                    <img class='url_movie' src='" . $row["url_movie"] . "' alt=''>
                    <p class='name_movie'>" . $row["name"] . "</p>
                </div>";
        }
    } else {
        echo "<p>Không có kết quả.</p>";
    }

    // Đóng kết nối
    $conn->close();
    ?>
</div>
</div>
</body>

</html>