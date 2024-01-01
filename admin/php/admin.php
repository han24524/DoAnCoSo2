<?php
    session_start();
    // Kiểm tra session admin_id
    if (!isset($_SESSION['admin_id'])) {
        header("Location: login.php");
        exit;
    }

    // Kiểm tra nút logout được nhấn
    if (isset($_GET['logout'])) {
        // Xóa biến phiên và hủy phiên làm việc
        unset($_SESSION['admin_id']);
        session_destroy();

        // Chuyển hướng người dùng về trang đăng nhập
        header("Location: login.php");
        exit;
    }

    // Include file kết nối CSDL
    include('database.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
</head>
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Thêm CSS cho class active */
    .active {
        display: block;
    }

    /* Ẩn các div khi chưa click */
    .content {
        display: none;
        animation: fadeIn 0.5s ease; /* Thêm animation vào content */

    }
</style>

<body>
    <div class="header">
        <div class="side-nav">
            <div class="user">
                <img src="../image/ava.png" class="">
                <div class="user-infor">
                    <span>ADMIN</span><br>
                    <u><?php echo $_SESSION['admin_name']; ?></u>
                </div>
            </div>
            <ul id="menu-list">
                <li onclick="showContent('user')"><img src="../image/user.png"><span>Quản Lý Người Dùng</span></li>
                <li onclick="showContent('film')"><img src="../image/film.png"><span>Quản Lý Phim</span></li>
                <li onclick="showContent('menu')"><img src="../image/menu.png"><span>Quản Lý Menu</span></li>
                <li onclick="showContent('report')"><img src="../image/report.png"><span>Thống Kê & Báo Cáo</span></li>
            </ul>
            <br><br><br><br><br><br><br>
            
            <ul>
                <li><img src="../image/logout.png"><a href="?logout=1"><span>Log Out</span></a></li>
            </ul>
        </div>
    </div>


    <!--   --------   BODY   ------------------- -->

    <div class="container-body">
        <!-- Các div tương ứng với mỗi li -->
        <div class="content user">
            <?php include('category/user.php'); ?>
        </div>
        <div class="content film">
            <?php include('category/film.php'); ?>
        </div>
        <div class="content menu">
            <?php include('category/menu.php'); ?>
        </div>
        <div class="content comment">
            <?php include('category/comment.php'); ?>
        </div>
        <div class="content report">
            <?php include('category/report.php'); ?>
        </div>
        <div class="content password">
            <?php include('category/password.php'); ?>
        </div>
        <div class="content logout">
            <a href="?logout=1"><img src="../image/logout.png"><span>Log Out</span></a>
        </div>
    </div>


    <script>
        function showContent(contentName) {
            // Ẩn tất cả các div content
            var contents = document.querySelectorAll('.content');
            contents.forEach(function (content) {
                content.style.display = 'none';
            });

            // Hiển thị div content tương ứng với li được click
            var targetContent = document.querySelector('.content.' + contentName);
            if (targetContent) {
                targetContent.style.display = 'block';
                targetContent.style.width = '100%';
            }
        }
    </script>
</body>
</html>

<?php
    // Đóng kết nối CSDL
    include('database.php');
?>