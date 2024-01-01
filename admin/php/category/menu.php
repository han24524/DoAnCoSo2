<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link rel="stylesheet" href="../css/menu.css?v=<?php echo time(); ?>">

</head>
<body>
    <?php 
        include('database.php');
    ?>
    <div class="container-search">
        <label for="select-menu">Chọn Menu:</label>
            <select name="select-menu" id="select-menu" onclick="chon()">
                <option value="1" id="1">Xem Phim</option>
                <option value="2" id="2">Năm Phát Hành</option>
                <option value="3" id="3">Thể Loại</option>
                <option value="4" id="4">Top Phim</option>
                <option value="5" id="5">Quốc Gia</option>
            </select>
        <input type="submit" value="Chọn"  class="btn-search" onclick="">
        <!-- <input type="submit" value="Thêm" id="btn-insert-menu" onclick="panelInsertmenu()">
        <input type="submit" value="Xóa" id="btn-delete-menu" onclick="panelDeletemenu()"> -->
    </div>
    
    <?php
        for ($i = 2; $i < 6; $i++) {
            echo "<p id='ten-{$i}'></p>  
                <script>
                    let ten{$i} = document.getElementById('{$i}').innerHTML;
                    document.getElementById('ten-{$i}').innerHTML = ten{$i};
                </script>";
            echo "<table class='value-{$i}'>";
            $sql = "SELECT name_menu FROM menu WHERE parent_id_menu = {$i}";
            $result = $conn->query($sql);
            

            // Hiển thị dữ liệu từ CSDL trong bảng
            if ($result->num_rows > 0) {
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    $count++;
                    if ($count % 5 == 1) {
                        echo "<tr>";
                    }

                    echo "<td>" . $row['name_menu'] . "</td>";  

                    if ($count % 5 == 0) {
                        echo "</tr>";
                    }             
                }
            } else {
                echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
            }
            echo "</table>";
        } 
    ?>

    <script>
        function chon() {
            let e = document.getElementById('select-menu').selectedIndex;
            if (e == 1) {
                document.getElementsByClassName('value-2')[0].style.display = 'table';
                document.getElementsByClassName('value-3')[0].style.display = 'none';
                document.getElementsByClassName('value-4')[0].style.display = 'none';
                document.getElementsByClassName('value-5')[0].style.display = 'none';
            }
        }
    </script>
</body>
</html>

<?php 
    // Đóng kết nối CSDL
    $conn->close();
?>