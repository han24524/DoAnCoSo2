<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GLASSMOON - Website xem phim</title>
    <link rel="shortcut icon" href="https://o.remove.bg/downloads/518cdd08-0e9a-4429-af07-22a2b9755e51/b0eb89900aa4843b784a771063a90e9a-removebg-preview.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="menu.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
  <!--============== CSS =============-->
    <link rel="stylesheet" href="menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">
  <!--============== Bootstrap link =============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
  <!-- _____ Slick Slider _____ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css">

    <style>
        body{
            background-color: rgb(24 22 22 / 91%);
        }
    </style>

<body>
    <?php 
        include('database.php');
    ?>
    <!-- ///////////////////////////////////////////////////////////// -->

    <form action="index.php" method="post">
        <div class="header">
            <div class="logo">
                <a href="index.php"><img src="https://scontent.fdad2-1.fna.fbcdn.net/v/t1.15752-9/373469746_848480470159004_6271955549055870085_n.png?_nc_cat=101&ccb=1-7&_nc_sid=8cd0a2&_nc_ohc=Z5iPsTiRNu0AX9mfbtL&_nc_ht=scontent.fdad2-1.fna&oh=03_AdT7bM3RIx6SxkpO_s3CwLUqoDFp8Fy2XISTuz8zknf5rg&oe=65769348" alt=""></a>
            </div>
            <div class="menu">
                <?php
                echo (buildMenu($menuItems));
                ?>
            </div>
            <div class="search">
                <button class="searchbtn" id="searchsubmit" type="submit"><i class="ri-search-2-line"></i></button>
                <input class="searchtext" type="text" placeholder="Tìm: tên phim, đạo diễn, diễn viên">
            </div>
            <div class="login">
                <button class="loginmenu" id="loginmenu" type="submit">Đăng nhập</button>
            </div>
        </div>
        <!-- /////////////////////////////////  BODY  /////////////////////////////////////////////// -->
        <div class="container-body">
            <div class="advertisement">
                <p>Cú pháp tìm kiếm phim nhanh nhất trên Google:<b style="color:coral;"> [Tên phim + GlassMoon.Net]</b></p>
                <p style="color:#FFC436;"><i class="ri-megaphone-fill"></i> Chúc bạn có một trải nghiệm vui vẻ và thật đáng nhớ !</p>
            </div>
            <div class="slide-film">
                <h2>PHIM MỚI CẬP NHẬT ></h2>
                <?php
                    // Đường dẫn đến file HTML
                    $slide_update = 'slide update.html';
                    
                    // Đọc nội dung của file HTML và gán vào biến
                    $update = file_get_contents($slide_update);
                    
                    // Hiển thị nội dung của biến
                    echo $update;
                ?>
            </div>

            <!-- ////////////////////  main BODY  ///////////// -->
            <div class="main-body">
                <div class="main-body-left">

                    <div class="section-highlight">
                        <?php
                            // Đường dẫn đến file HTML
                            $slide_highlight = 'slide highlight.html';
                            
                            // Đọc nội dung của file HTML và gán vào biến
                            $highlight = file_get_contents($slide_highlight);
                            
                            // Hiển thị nội dung của biến
                            echo $highlight;
                        ?>

                    <div class="section-update">
                        <h2>PHIM NỔI BẬT > <span style="color: red;">Tất cả</span></h2>
<!-- TAO SỬA NHIÊU ĐÂY THÔI -->
                        <div class="section-update section">
                            <?php
                                $conn = new mysqli('localhost', 'root', '', 'website_film');

                                if ($conn->connect_error) {
                                    die("Kết nối thất bại: " . $conn->connect_error);
                                }

                                $sql = "SELECT * FROM movie WHERE release_year=2023";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo 
                                        "<div class='section-update content'>
                                            <span class='status_movie'>{$row["status"]}</span>
                                            <img class='url_movie' src='{$row["url_movie"]}' alt=''>
                                            <p class='name_movie'>{$row["name"]}</p>
                                        </div>";
                                    }
                                } else {
                                    echo "<p>Không có kết quả.</p>";
                                }
                            ?>
                        </div>
<!-- TỚI ĐÂY -->
                    </div>

                    <div class="section-nominate">
                        PHIM ĐỀ CỬ
                    </div>

                    <div class="section-extend">
                        PHIM THEO NĂM 2023 2022 2021 2020 ....
                    </div>
                </div>


            </div>
            <div class="main-body-right">
                    <h2>BẢNG XẾP HẠNG</h2>
                    <div class="tab-film">
                        BẢNG XẾP HẠNG THEO NĂM<br>
                        BẢNG XẾP HẠNG THEO THÁNG<br>
                        BẢNG XẾP HẠNG THEO TUẦN
                    </div>
                </div>

        </div>

        <div class="container-footer">
            <div class="extend-part">
                <div class="logo">
                    <img src="https://scontent.fdad2-1.fna.fbcdn.net/v/t1.15752-9/373469746_848480470159004_6271955549055870085_n.png?_nc_cat=101&ccb=1-7&_nc_sid=8cd0a2&_nc_ohc=Z5iPsTiRNu0AX9mfbtL&_nc_ht=scontent.fdad2-1.fna&oh=03_AdT7bM3RIx6SxkpO_s3CwLUqoDFp8Fy2XISTuz8zknf5rg&oe=65769348" alt="">
                </div>
                <div class="extend-content">
                    <label>XEM PHIM</label>
                    <label>THUẬT NGỮ TRONG PHIM</label>
                    <label>BÁO LỖI</label>
                    <label>RIÊNG TƯ</label>
                </div>
                <div class="contact">
                    <i class="ri-facebook-fill"></i>
                    <i class="ri-twitter-fill"></i>
                    <i class="ri-twitch-fill"></i>
                    <i class="ri-youtube-fill"></i>
                    <i class="ri-arrow-up-double-line"></i>
                </div>
            </div>

            <div class="footer">
                <p>
                    hanh dong - phieu luu - kinh di - vien tuong - vu tru - lang man -
                    hoc duong - vo thuat - co trang - hien dai - chien tranh - gia dinh <br>
                    - hoat hinh - bao luc - nhe nhang - hai huoc - trinh tham - phieu luu - 
                    tam ly - khoa hoc - gia tuong - linh di - suc manh - tuoi tre
                </p>
                <p>GlassMoon.Net không chịu trách nhiệm đối với bất kỳ nội dung nào được đăng tải trong trang web này.</p>
                <p>Mọi nội dung đều được sưu tầm và nhúng vào website tương tự như công cụ tìm kiếm Google.</p>
                <p>Disclaimer: This site does not store any files on its server. All contents are provided by non-affiliated third parties.</p>
                <p>Liên hệ: info.glassmoon@gmail.com</p>
            </div>

        </div>

    </form>
</body>
  <!-- ___________ Slick Slider ______________ -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>

</html>