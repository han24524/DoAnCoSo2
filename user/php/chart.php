<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .tab {
      overflow: hidden;
      padding-bottom: 20px;
    }

    .tab button {
      background-color: transparent;
      color: #ccc;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 10px 6px;
      transition: 0.3s;
      font-size: 18px;
    }

    .tab button:hover {
      background-color: #ddd;
      color: #000;
    }

    .tab button.active {
      color: #000;
      background-color: #ccc;
    }

    /* .tabcontent-container {
      position: relative;
      height: 100%;
      width: 100%;
    } */

    .tabcontent {
      /* position: absolute; */
      top: 0;
      width: 100%;
      /* height: 100%; */
      transition: transform 0.3s ease-in-out;
      display: none; /* Ẩn tất cả các tabcontent khi chưa được chọn */
    }
    .tabcontent.show {
      display: flex;
      flex-direction: column;
      /* height: 30rem; */
      width: 100%;
      gap: 20px;
      transform: translateY(0);
    }

    .week {
      display: flex;
      justify-content: space-between;
    }

    .week img {
      width: 5rem;
      height: 100%;
    }
    .week:hover{
      cursor: pointer;
      opacity: 0.5;
    }
    .status{
      color: yellow;
    }
  </style>
</head>

<body>
  <div class="tab">
    <button type="button" class="tablinks" onclick="openTab(event, 'Tab1')">THEO TUẦN</button>
    <button type="button" class="tablinks" onclick="openTab(event, 'Tab2')">THEO THÁNG</button>
    <button type="button" class="tablinks" onclick="openTab(event, 'Tab3')">THEO NĂM</button>
  </div>

  <div class="tabcontent-container">
    <div id="Tab1" class="tabcontent show">
    <?php
        $conn = new mysqli('localhost', 'root', '', 'website_film');

        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM movie WHERE country='Trung Quốc'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo 
                "<a class='week' href='film.php?id={$row['id_movie']}'
                  style='text-decoration:none; '>
                <div class='week-content'>
                    <p class='name_movie'>{$row["name"]}</p>
                    &nbsp; <span class='updated_episode'>{$row["updated_episode"]}</span> &nbsp;
                    <span class='status'>{$row["status"]}</span><br><br><br>
                    <span class='genre'>{$row["genre"]}</span><br>
                    <span class='actor_name'>{$row["actor_name"]}</span>
                  </div>
                    <img class='url_movie' src='{$row["url_movie"]}' alt=''>
                </a>";
            }
        } else {
            echo "<p>Không có kết quả.</p>";
        }
      ?>
    </div>

    <div id="Tab2" class="tabcontent">
    <?php
          $conn = new mysqli('localhost', 'root', '', 'website_film');

          if ($conn->connect_error) {
              die("Kết nối thất bại: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM movie WHERE country='Hàn Quốc'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo 
                  "<a class='week' href='film.php?id={$row['id_movie']}'
                      style='text-decoration:none; '>
                    <div class='week-content'>
                      <p class='name_movie'>{$row["name"]}</p>
                      &nbsp; <span class='updated_episode'>{$row["updated_episode"]}</span> &nbsp;
                      <span class='status'>{$row["status"]}</span><br><br><br>
                      <span class='genre'>{$row["genre"]}</span><br>
                      <span class='actor_name'>{$row["actor_name"]}</span>
                    </div>
                    <img class='url_movie' src='{$row["url_movie"]}' alt=''>
                  </a>";
              }
          } else {
              echo "<p>Không có kết quả.</p>";
          }
        ?>
    </div>

    <div id="Tab3" class="tabcontent">
    <?php
          $conn = new mysqli('localhost', 'root', '', 'website_film');

          if ($conn->connect_error) {
              die("Kết nối thất bại: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM movie WHERE country='Mỹ'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo 
                  "<a class='week' href='film.php?id={$row['id_movie']}'
                      style='text-decoration:none; '>
                    <div class='week-content'>
                      <p class='name_movie'>{$row["name"]}</p>
                      &nbsp; <span class='updated_episode'>{$row["updated_episode"]}</span> &nbsp;
                      <span class='status'>{$row["status"]}</span><br><br><br>
                      <span class='genre'>{$row["genre"]}</span><br>
                      <span class='actor_name'>{$row["actor_name"]}</span>
                    </div>
                    <img class='url_movie' src='{$row["url_movie"]}' alt=''>
                  </a>";
              }
          } else {
              echo "<p>Không có kết quả.</p>";
          }
        ?>
    </div>
  </div>

  <script>
    function openTab(evt, tabName) {
      var i, tabcontent, tablinks;

      // Lấy tất cả các nội dung của tab
      tabcontent = document.getElementsByClassName("tabcontent");

      // Ẩn tất cả các nội dung
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].className = "tabcontent hide-down";
      }

      // Hiển thị nội dung của tab được chọn
      var selectedTab = document.getElementById(tabName);
      selectedTab.className = "tabcontent show";

      // Cập nhật lớp CSS cho tab hiện tại và tab mới
      currentTab.className = "tabcontent " + direction;
      selectedTab.className = "tabcontent show";

      // Xóa lớp active khỏi các nút tab
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      // Thêm lớp active vào nút tab hiện tại
      evt.currentTarget.className += " active";
    }

    // Mặc định ẩn tất cả các tab ngoại trừ tab đầu tiên
    document.addEventListener("DOMContentLoaded", function () {
      var tabs = document.getElementsByClassName("tabcontent");
      for (var i = 1; i < tabs.length; i++) {
        tabs[i].classList.add("hide-down");
      }

      <?php
        // Đặt tab mặc định dựa trên dữ liệu từ file index.php hoặc file khác
        $defaultTab = isset($_GET['tab']) ? $_GET['tab'] : 'Tab1';
        echo "openTab(event, '{$defaultTab}');";
      ?>
    });
  </script>
</body>

</html>
