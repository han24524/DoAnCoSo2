<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider Movie 2023</title>

    <!-- Include the Slick CSS and JS files -->
    <link rel="stylesheet" href="../slide update.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include the Slick JS library -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <style>
        b1{
            width: 100%;
            font-size: 24px;
        }
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.8s;
        }

        .update-tab {
            width: 10rem;
            margin: 20px;
            text-align: center;
            position: relative;
        }

        .update-tab img {
            height: 35rem;
            margin: 0 auto;
        }

        .large-slide {
            width: 30rem; /* Đặt kích thước lớn cho slide ở giữa */
        }
        @keyframes fadeIn{
            from{
                opacity: 0;
            }
            to{
                opacity: 1;
            }
        }
        @media screen and (max-width:1310px){
            .update-tab img {
                width: 70%;
                height: 30rem;
            }
            b1{
                font-size: 20px;
            }
        }
        @media screen and (max-width:1290px){
            .update-tab img {
                width: 60%;
                height: 26rem;
            }
            b1{
                font-size: 18px;
            }
        }
        @media screen and (max-width:1100px){
            .update-tab img {                
                width: 50%;
                height: 22rem;
            }
            b1{
                font-size: 16px;
            }
        }
        @media screen and (max-width:900px){
            .update-tab img {
                width: 40%;
                height: 18rem;
            }
            b1{
                font-size: 14px;
            }
        }
        @media screen and (max-width:800px){
            .update-tab img {
                width: 30%;
                height: 12rem;
            }
            b1{
                font-size: 10px;
            }
        }
        @media screen and (max-width:600px){
            .update-tab img {
                width: 20%;
                height: 10rem;
            }
            b1{
                font-size: 10px;
            }
        }
    </style>
</head>

<body>

    <?php
    // Kết nối CSDL
    $conn = new mysqli('localhost', 'root', '', 'website_film');
    if ($conn->connect_error) {
        die('Kết nối không thành công: ' . $conn->connect_error);
    }

    // Truy vấn CSDL
    $sql = "SELECT id_movie, name, url_movie FROM movie WHERE release_year=2023 ORDER BY id_movie DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="center">';

        while ($row = $result->fetch_assoc()) {
            // Dữ liệu từ CSDL
            $id_movie = $row['id_movie'];
            $nameMovie = $row['name'];
            $urlMovie = $row['url_movie'];

            // Kiểm tra nếu là slide ở giữa
            $slideClass = ($result->num_rows % 2 == 0) ? 'large-slide' : '';

            // Hiển thị dữ liệu trong slider
            echo '<a href="film.php?id=' . $id_movie . '"
                    style="text-decoration:none; color:white;">
                    <div class="update-tab ' . $slideClass . '">
                        <img src="' . $urlMovie . '" alt="' . $nameMovie . '">
                        <b1>' . $nameMovie . '</b1>
                    </div>
                </a>';
        }

        echo '</div>';
    } else {
        echo 'Không có dữ liệu phim nào phù hợp với điều kiện.';
    }

    // Đóng kết nối CSDL
    $conn->close();
    ?>

    <script>
        // Sử dụng Slick để tạo slider
        $('.center').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1000,
        });
    </script>

</body>

</html>
