<!-- <link rel="stylesheet" href="style.css"> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <!-- <link rel="stylesheet" href="./../../css/report.css"> -->
</head>
<body>
  <?php 
      include('database.php');

      // $currentDateTime = date("Y-m-d");
      // echo $currentDateTime;
  ?>

  <form class="tk">
    <label class="item" for="thongKe">Thống kê theo </label>
    <select class="item" name="thongKe" id="thongKe">
        <option value="1">Tháng</option>
        <option value="2">Năm</option>
    </select>
    <label class="item" for="thang" name='forThang'>Tháng</label>
    <input class="item" type="text" name="thang" id="thang"> 

    <label class="item" for="nam" name='forNam'>Năm</label>
    <input class="item" type="text" name="nam" id="nam">
    
    <input class="item" type="button" id="tk" value="Thống kê">
  </form>

  <div>
    <canvas id="myChart"></canvas>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    function chonLoaiThongKe() {
      var loai_thong_ke = document.getElementById('thongKe').selectedIndex;  
      if (loai_thong_ke === 0) {
        document.getElementsByName('forThang')[0].style.display = 'inline';
        document.getElementsByName('thang')[0].style.display = 'inline';
      } else {
        document.getElementsByName('forThang')[0].style.display = 'none';
        document.getElementsByName('thang')[0].style.display = 'none';
      }
    }

    function thucHienThongKe() {
      <?php
        $sql_tk = "SELECT * FROM views";
        $result_tk = $conn->query($sql_tk);

        if ($result_tk->num_rows > 0) {
          $data = array();

          while ($row = $result_tk->fetch_assoc()) {
              $data[] = $row;
          }

          $jsonData = json_encode($data);
        }
      ?>
      var jsonString = '<?php echo $jsonData; ?>';
      var jsonData = JSON.parse(jsonString);

      var month = document.getElementById("thang").value;
      if (month === '') {
        month = new Date().getMonth() + 1;
        if (month < 10) {
          month = "0" + month;
        }
      }
      var year = document.getElementById("nam").value;
      if (year === '') {
        year = new Date().getFullYear();
      }
      // xữ lý dữ liệu trong bản
      var loai_thong_ke = document.getElementById('thongKe').selectedIndex;
      var hang = [];
      var cot = [];
      // hàng
      if (loai_thong_ke === 0) {
        var daysInMonth = new Date(year, month, 0).getDate();
        for (var i = 1; i <= daysInMonth; i++) {
          hang.push(i);
          cot.push(0);
        }
      } else if (loai_thong_ke === 1) {
        for (var i = 1; i <= 12; i++) {
          hang.push(i);
          cot.push(0);
        }
      }
      
      // cột
      for (var i = 0; i < jsonData.length; i++) {
        var thang_kt = jsonData[i]['viewTime'].split("-")[1];
        if (thang_kt < 10) {
          thang_kt = thang_kt.split("0")[1];
        }
        console.log("tháng chọn: " + month + " tháng: " + thang_kt+" loai thong ke: ");
        if (loai_thong_ke === 0 && thang_kt == month) {
          var ngay_kt = jsonData[i]['viewTime'].split("-")[2];

          for (var j = 1; j < hang.length; j++) {
            if (ngay_kt == hang[j]) {
              var temp = hang[j] - 1;
              cot[temp] += 1;
              break;
            }
          }
        } else if (loai_thong_ke === 1) {
          for (var j = 1; j < hang.length; j++) {
            if (thang_kt == hang[j]) {
              var temp = hang[j] - 1;
              cot[temp] += 1;
              break;
            }
          }
        }
      } 
      
      // bảng thống kê
      if (window.myChart && typeof window.myChart.destroy === 'function') {
        window.myChart.destroy();
      }
      const ctx = document.getElementById('myChart');

      window.myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: hang,
          datasets: [{
            label: 'Lượt xem',
            data: cot,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    }

    document.getElementById("tk").addEventListener("click", thucHienThongKe);
    document.getElementById("thongKe").addEventListener("click", chonLoaiThongKe);
  </script>

  <?php 
      // Đóng kết nối CSDL
      $conn->close();
  ?>
</body>
</html>