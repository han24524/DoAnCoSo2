<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Đăng kí tài khoản</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/log in.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="https://o.remove.bg/downloads/518cdd08-0e9a-4429-af07-22a2b9755e51/b0eb89900aa4843b784a771063a90e9a-removebg-preview.png">

</head>
<body>
<?php
    session_start(); // Khởi động session
    
    // Kết nối CSDL
    $conn = new mysqli('localhost', 'root', '', 'website_film');

    if (!$conn) {
        die('Kết nối không thành công!');
    }

//  ĐĂNG KÍ
    if (isset($_POST['btn-regester'])) {
        $tenuser = $_POST['regester-text'];
        $email = $_POST['email-text'];
        $pass  = $_POST['regester-password'];
        $repass  = $_POST['regester-password-2'];
        if ($pass == $repass) {
            $sql = "INSERT INTO user (name, password, email) VALUES ('$tenuser','$pass', '$email')";
            $result = mysqli_query($conn, $sql);
            echo "Đăng ký thành công";
        } else {
            echo "Mật khẩu không khớp";
        }
    }
    
// ĐĂNG NHẬP
        if (isset($_POST['btn-login'])) {
            $tendn = $_POST['login-text'];
            $mkdn = $_POST['login-password'];
            $sql = "SELECT * FROM user WHERE name='$tendn' AND password='$mkdn'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $dem = mysqli_num_rows($result);

                if ($dem == 1) {
                    // Lấy thông tin người dùng từ kết quả truy vấn
                    $row = mysqli_fetch_assoc($result);

                    // Lưu thông tin người dùng vào session
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['name'];

                    // Chuyển qua trang hiển thị
                    header("Location: index.php");
                    exit;
                } else {
                    echo "Tên đăng nhập hoặc mật khẩu chưa đúng";
                }
            } else {
                echo "Lỗi truy vấn: " . mysqli_error($conn);
            }
        }


        // Đóng kết nối CSDL
        $conn->close();

    ?>

    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="" method="post" class="sign-in-form">

                    <h2 class="title">Đăng Nhập</h2>
                    <div class="input-field">
                        <i class='bx bx-user'></i>
                        <input name="login-text" type="text" id="text" placeholder="Tên đăng nhập">
                    </div>

                    <div class="input-field">
                        <i class='bx bxs-lock-alt'></i>
                        <input name="login-password" type="password" id="password" placeholder="Mật khẩu">
                    </div>
                    <input type="submit" value="Đăng Nhập"  class="btn-login" name="btn-login">
                    <p class="social-text">Hoặc đăng nhập bằng cách khác</p>
                    
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class='bx bxl-facebook-circle'></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class='bx bx-envelope'></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class='bx bxl-linkedin'></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class='bx bxl-twitter'></i>
                        </a>
                    </div><br>
                    <div>
                        <a href="index.php" class="turn-to-home">Trang Chủ</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="../../admin/php/login.php" class="turn-to-home">Admin</a>
                    </div>
                </form>
                <form action="" method="post" class="sign-up-form">

                    <h2 class="title">Đăng Kí</h2>
                    <div class="input-field">
                        <i class='bx bx-user'></i>
                        <input name="regester-text" type="text" id="text" placeholder="Tên đăng kí">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-envelope'></i>
                        <input name="email-text" type="email" id="text" placeholder="Email">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt'></i>
                        <input name="regester-password" type="password" id="password" placeholder="Mật khẩu">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt'></i>
                        <input name="regester-password-2" type="password" id="password" placeholder="Nhập lại mật khẩu">
                    </div>
                    <input type="submit" value="Đăng Kí"  class="btn-regester" name="btn-regester">
                    <p class="social-text">Hoặc đăng kí bằng cách khác</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class='bx bxl-facebook-circle'></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class='bx bx-envelope'></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class='bx bxl-linkedin'></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class='bx bxl-twitter'></i>
                        </a>
                    </div>
                    <a href="index.php" class="turn-to-home">Trang Chủ</a>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Mê xem phim!</h3>
                    <p>Bạn đam mê điện ảnh và muốn khám phá thế giới đa dạng của nghệ 
                        thuật điện ảnh từ mọi thể loại? Hãy đến với chúng tôi tại 
                        YOORA, nơi bạn có thể trải nghiệm hàng ngàn bộ phim 
                        độc đáo và hấp dẫn.
                    </p>
                    <button class="btn-transparent" id="sign-up-btn">ĐĂNG KÍ</button>
                </div>
                <img src="../image/img2.png" class="image" alt="">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Mải xem phim!</h3>
                    <p> Với một thư viện phim đa dạng từ các thể loại như hành động, 
                        hài hước, kinh điển, kinh dị và nhiều thể loại khác, chúng tôi 
                        mang đến cho bạn sự đa dạng và lựa chọn không giới hạn.
                    </p>
                    <button class="btn-transparent" id="sign-in-btn">ĐĂNG NHẬP</button>
                </div>
                <img src="../image/img1.png" class="image" alt="">
            </div>
        </div>
    </div>
    
    <script src="../js/log in.js"></script>
</body>
</html>