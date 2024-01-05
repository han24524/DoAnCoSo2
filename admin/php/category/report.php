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
        <option value="3">Top phim trong tháng</option>
        <option value="4">Top phim trong năm</option>
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
      if (loai_thong_ke === 0 || loai_thong_ke === 2) {
        document.getElementsByName('forThang')[0].style.display = 'inline';
        document.getElementsByName('thang')[0].style.display = 'inline';
      } else {
        document.getElementsByName('forThang')[0].style.display = 'none';
        document.getElementsByName('thang')[0].style.display = 'none';
      }
    } 

    function thucHienThongKe() {
      var xhr = new XMLHttpRequest();

      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            var responseData = JSON.parse(xhr.responseText);
            xuLyTK(responseData);
          } else {
            console.error('Lỗi HTTP: ' + xhr.status);
          }
        }
      };

      xhr.open("GET", "getData.php", true);
      xhr.send();
    }

    function xuLyTK(data) {
      var month = document.getElementById("thang").value;
      var year = document.getElementById("nam").value;
      
      // xữ lý dữ liệu trong bản
      var loai_thong_ke = document.getElementById('thongKe').selectedIndex;
      if (loai_thong_ke === 0 || loai_thong_ke === 1) {
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
        for (var i = 0; i < data.length; i++) {
          var nam_kt = data[i]['viewTime'].split("-")[0];
          // console.log(nam_kt + " vs nam: " + year);
          if (nam_kt === year) {
            var thang_kt = data[i]['viewTime'].split("-")[1];
            if (thang_kt < 10) {
              thang_kt = thang_kt.split("0")[1];
            }
            
            if (loai_thong_ke === 0 && thang_kt == month) {
              var ngay_kt = data[i]['viewTime'].split("-")[2];

              for (var j = 0; j < hang.length; j++) {
                if (ngay_kt == hang[j]) {
                  var temp = hang[j] - 1;
                  cot[temp] += 1;
                  break;
                }
              }
            } else if (loai_thong_ke === 1) {
              for (var j = 0; j < hang.length; j++) {
                if (thang_kt == hang[j]) {
                  var temp = hang[j] - 1;
                  cot[temp] += 1;
                  break;
                }
              }
            }
          }
        } 
      } else {
        var ds = [];
        for (var i = 0; i < data.length; i++) {
          var nam_kt = data[i]['viewTime'].split("-")[0];
          var ten = data[i]['name'];
          // console.log(nam_kt + " vs nam: " + year);
          if (nam_kt === year) {
            var thang_kt = data[i]['viewTime'].split("-")[1];
            if (thang_kt < 10) {
              thang_kt = thang_kt.split("0")[1];
            }
            
            if (loai_thong_ke === 2 && thang_kt == month) {
              if (ten in ds) {
                ds[ten]++; 
              } else {
                ds[ten] = 1;
              }
            } else if (loai_thong_ke === 3) {
              if (ten in ds) {
                ds[ten]++;  
              } else {
                ds[ten] = 1;
              }
            }
          }
        } 

        var hang = [];
        var cot = [];

        var pairs = [];
        for (var key in ds) {
          if (ds.hasOwnProperty(key)) {
            pairs.push([key, ds[key]]);
          }
        }

        pairs.sort(function(a, b) {
          return b[1] - a[1];
        });

        var sortedObj = {};
        for (var i = 0; i < pairs.length; i++) {
          sortedObj[pairs[i][0]] = pairs[i][1];
        }

        for (var prop in sortedObj) {
          var value = ds[prop];
          hang.push(prop);
          cot.push(value);
          if (hang.length === 9) {
            break;
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