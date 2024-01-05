<?php 
    session_start(); // Khởi động session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILM</title>

    <link rel="shortcut icon" href="https://o.remove.bg/downloads/518cdd08-0e9a-4429-af07-22a2b9755e51/b0eb89900aa4843b784a771063a90e9a-removebg-preview.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="menu.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
  <!--============== CSS =============-->
    <link rel="stylesheet" href="../css/menuExtra.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/menu.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/film.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">

    <style>
        body{
            background-color: rgb(24 22 22 / 91%);
        }
        .section-update b, .section-update a{
            font-size: 25px;
            color: #999;
            cursor: pointer;
            text-decoration: none;
        }
        a:hover{
            text-decoration: underline;
        }
        .menu{
            width: 55%;
        }

        .main-body-left{
            grid-area: h2;
            width: 75%;
            background-color: black;
        }
        .main-body-right{
            grid-area: h3;
            width: 25%;

        }
        .section-update a:hover > i {
            left: 30px;
        }
        .section-update .section{
            grid-template-columns: repeat(auto-fit, 14rem);
            width: 95%;
        }
        .section-extend{
            width: 95%;
        }
        @media screen and (max-width:1130px) {
            .main-body{
                flex-wrap: wrap;
                height: auto;
            }
            .main-body-left{
                width: 100%;
            }
            
            .main-body-right{
                width: 100%;
                margin-top: 50px;
            }

        }
    </style>


</head>
<body>
<?php 
    include('database.php');
?>
    <div class="header">
        <div class="logo">
            <a href="index.php"><img src="../image/ava.png" alt=""></a>
        </div>
        <div class="menu">
            <?php
            echo (buildMenu($menuItems));
            ?>
        </div>
        <div class="search">
            <form action="search.php" method="get" style="display:flex; width:100%;">
                <button class="searchbtn" name="searchbtn" type="submit"><i class="ri-search-2-line"></i></button>
                <input class="searchtext" type="text" name="search_query" placeholder="Tìm: tên phim, đạo diễn, diễn viên">
            </form>
        </div>            
        <div class="login">
        <?php
            if (isset($_SESSION['user_id'])) {
                // Nếu đã đăng nhập, hiển thị icon user và thông tin người dùng
                echo ('<input type="checkbox" id="checkbox">');
                echo ('<label for="checkbox" class="container_user_infor" style="display:flex; flex-direction:column;align-items: center;">');
                echo '<i class="ri-user-heart-line"></i>';
                echo '<span class="username">' . $_SESSION['username'] . '</span>';
                echo ('</label>');
                echo ('<div class="user_infor">
                            <a href="user.php">Thông tin</a><br>
                            <a href="logout.php">Thoát</a>
                        </div>');

            } else {
                // Nếu chưa đăng nhập, hiển thị nút đăng nhập
                echo '<a class="loginmenu" href="login.php">Đăng nhập</a>';
            }
        ?>
        </div>
        <div class="menu_extra">
            <label for="nav-pc-input" href="#" id="menu_extra" class="menu_extra menu"><i class="ri-menu-fold-line"></i></label>
            
            <input type="checkbox"  hidden  name="" class="nav-input"   id="nav-pc-input">
            <label for="nav-pc-input" class="nav-overlay"></label>

            <nav class="nav-pc">
                <label for="nav-pc-input" class="nav-close"><i class="ri-close-line"></i></label>
                <ul class="nav-list">
                <?php
                    if (isset($_SESSION['user_id'])) {
                        // Nếu đã đăng nhập, hiển thị icon user và thông tin người dùng
                        echo ('<input type="checkbox" id="checkbox">');
                        echo ('<label for="checkbox" class="container_user_infor" 
                                style="font-size:3rem; color:black; width:90%;">');
                        echo '<i class="ri-user-heart-line"></i>';
                        echo '<span class="username"    style="font-size:28px; color:black;margin-left: 15px;">' 
                                . $_SESSION['username'] 
                                . '</span>';
                        echo ('</label><br>');

                        echo ('<div class="nav-menu">' . buildMenu($menuItems)) . '</div><br><br><br><br><br><br>';
                        echo ('<a href="logout.php">Thoát</a>');
        
                    } else {
                        // Nếu chưa đăng nhập, hiển thị nút đăng nhập
                        echo '<a class="loginmenu" href="login.php">Đăng nhập</a>';
                    }
                ?>

                </ul>
            </nav>
        </div>
    </div>
    <!-- /////////////////////////////////  BODY  /////////////////////////////////////////////// -->
    <div class="container-body">
        <div class="advertisement">
            <p>Cú pháp tìm kiếm phim nhanh nhất trên Google:<b style="color:coral;"> [Tên phim + Yoora.Net]</b></p>
            <p style="color:#FFC436;"><i class="ri-megaphone-fill"></i> Chúc bạn có một trải nghiệm vui vẻ và thật đáng nhớ !</p>
        </div>

        <!-- ////////////////////  DANH SÁCH NỘI DUNG SEARCH  ///////////// -->
        <div class="main-body">

            <!-- -------------------------  lEFT BODY  ---------------------- -->
            <div class="main-body-left">
                
                <div class="section-update">
                    <b><a href="index.php">
                        <i class="fa-solid fa-house"></i>Trang Chủ &nbsp;&nbsp;>&nbsp;&nbsp;</a><a>Thể loại</a></b>
                    <h2 style="color: #BE3144;"><?php echo $_GET['dk'] ?></span></h2>
                    <div class="section-update section">
                        <?php
                            $conn = new mysqli('localhost', 'root', '', 'website_film');

                            if ($conn->connect_error) {
                                die("Kết nối thất bại: " . $conn->connect_error);
                            }

                            $theLoai = $_GET['dk'];

                            $sql = "SELECT * FROM movie";
                            $result = $conn->query($sql);
                            $dem = 0;
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    if (stripos($row["genre"], $theLoai) !== false) {
                                        echo "<div class='section-update content'' onclick='redirectToFilmPage(";echo '$row["id_movie"];'; 
                                        echo ")'>
                                            <a href='film.php?id={$row['id_movie']}'  
                                            style='text-decoration:none; '>
                                                <span class='status_movie'>{$row["status"]}</span>
                                                <img class='url_movie' src='{$row["url_movie"]}' alt=''>
                                                <p class='name_movie'>{$row["name"]}</p>
                                                <i class='ri-play-circle-fill'></i>
                                            </a>
                                        </div>";
                                        $dem++;
                                    } 
                                }
                                if ($dem == 0) {
                                    echo "<p style='color: red'>Không dữ liệu</p>";
                                }
                            } 
                        ?>
                    </div>
                    <div class="pagination">
                        <a href="#">Previous</a>
                        <a href="#"class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                        <a href="#">Next</a>
                    </div>
                </div>


                <div class="section-extend">
                    <b>THEO NĂM</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>2023</span>&nbsp;&nbsp;
                    <span>2022</span>&nbsp;&nbsp;
                    <span>2021</span>&nbsp;&nbsp;
                    <span>2020</span>&nbsp;&nbsp;
                    <span>...</span>

                </div>

            </div>
            
            <!-- -------------------------  RIGHT BODY  ---------------------- -->
            <div class="main-body-right">
                <h2>&nbsp; BẢNG XẾP HẠNG</h2>
                <?php 
                    include('chart.php');
                ?>
            </div>

        </div>

    </div>
    

    <div class="container-footer">
        <div class="extend-part">
            <div class="logo">
                <img src="../image/ava.png" alt="">
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
            <p>Yoora.Net không chịu trách nhiệm đối với bất kỳ nội dung nào được đăng tải trong trang web này.</p>
            <p>Mọi nội dung đều được sưu tầm và nhúng vào website tương tự như công cụ tìm kiếm Google.</p>
            <p>Disclaimer: This site does not store any files on its server. All contents are provided by non-affiliated third parties.</p>
            <p>Liên hệ: info.yoora@gmail.com</p>
        </div>

    </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>

</html>