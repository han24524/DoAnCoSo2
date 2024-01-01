<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link rel="stylesheet" href="../css/user.css?v=<?php echo time(); ?>">

</head>
<body>
    <?php 
        include('database.php');
    ?>
    <div class="container-search">
        <div class="input-field">
            <i class="ri-search-line"></i>
            <input type="search" name="text-search-user" id="text-search-user" placeholder="Tìm kiếm...">
        </div>
        <input type="submit" value="Tìm Kiếm" id="btn-search-user"  class="btn-search">
        <input type="submit" value="Thêm" id="btn-insert-user" onclick="panelInsertUser()">
        <input type="submit" value="Xóa" id="btn-delete-user" onclick="panelDeleteUser()">
    </div>

<!------------- panel thêm người dùng ---------------->
<div id="panel_insert_user" class="panel-insert">
        <div class="modal-content-insert-user">
            <span class="close" onclick="closePanelInsertUser()">&times;</span>
            <h2>Thêm thông tin người dùng</h2>
            <!-- Form để thêm thông tin phim -->
            <form method="post" class="form-insert-user"  action="category/user database/insert user.php">
                <!-- Các trường thêm thông tin -->
                <div>
                    <label for="addNameUser">Tên người dùng:</label>
                    <input type="text" id="addNameUser" name="addNameUser" required>
                                
                    <label for="addEmail">Email:</label>
                    <input type="text" id="addEmail" name="addEmail" required>
                
                    <label for="addPassword">Mật khẩu:</label>
                    <input type="text" id="addPassword" name="addPassword" required>
                </div>
                
                <!-- Nút để xác nhận sửa thông tin -->
                <button type="submit" name="btn-insert-user">Lưu</button>

            </form>
        </div>
    </div>

<!-- -----------  panel xóa người dùng  ------------->

<div id="panel_delete_user" class="panel-delete">
        <div class="modal-content-delete">
            <span class="close" onclick="closePanelDeleteUser()">&times;</span>
            <h2>Xóa thông tin người dùng</h2>
            <!-- Form để thêm thông tin phim -->
            <form method="post" id="delete-form" action="category/user database/delete user.php">
                <!-- Các trường thêm thông tin -->
                <div>
                    <label for="delUser_ID">ID người dùng:</label>
                    <input type="text" id="delUser_ID" name="delUser_ID" required><br>
                </div><br>
                <div>
                    <div id="panelAskUser">
                        Bạn có chắc muốn xóa người dùng này không? Dữ liệu không thể phục hồi sau khi xóa!
                    </div><br>
                    <button type="submit" name="btn-delete-user" 
                            class="btn-xoa" style="margin:auto; width:20%;" onclick="confirmDeleteUser()">Xóa
                    </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Không" class="btn-khong" onclick="closePanelDeleteUser()">
                </div>
            </form>
        </div>
    </div>

    <table class="table-user">
        <tr>
            <th>ID người dùng</th>
            <th>Tên người dùng</th>
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Chỉnh sửa</th>
        </tr>
        <?php
            // Truy vấn dữ liệu từ CSDL
            $sql = "SELECT * FROM user";
            $result = $conn->query($sql);

            // Hiển thị dữ liệu từ CSDL trong bảng
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td onclick='panelUpdateUser(\"" . $row['user_id'] . "\", 
                    \"" . $row['name'] . "\", \"" . $row['email'] . "\", 
                    \"" . $row['password']. "\")'
                    style='cursor: pointer;'><i class='ri-pencil-fill'></i></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
            }
        ?>
    </table>

<!-- -----------  sửa người dùng  ------------------->
<div id="panel_update_user" class="panel-update">
        <div class="modal-content-update-user">
            <span class="close" onclick="closePanelUpdateUser()">&times;</span>
            <h2>Chỉnh sửa thông tin phim</h2>
            <!-- Form để sửa thông tin phim -->
            <form method="post" class="form-update-user" action="category/user database/update user.php">
                <!-- Các trường sửa thông tin -->
                <input type="hidden" id="editUserId" name="editUserId">
                
                <div>
                    <label for="editNameUser">Tên người dùng:</label>
                    <input type="text" id="editNameUser" name="editNameUser" required>
                                
                    <label for="editEmail">Email:</label>
                    <input type="text" id="editEmail" name="editEmail" required>
                
                    <label for="editPassword">Mật khẩu:</label>
                    <input type="text" id="editPassword" name="editPassword" required>
                </div>
                <!-- Nút để xác nhận sửa thông tin -->
                <button type="submit"   name="btn-update-user">Lưu</button>

            </form>
        </div>
    </div>

    <script>
        // Dùng biến isInsertPanelOpen và isUpdatePanelOpen để kiểm tra xem modal nào đang mở, 
        // và chỉ thực hiện đóng modal khi modal tương ứng đang mở.
        var isInsertUserPanelOpen = false;
        var isUpdateUserPanelOpen = false;
        var isDeleteUserPanelOpen = false;

        function panelInsertUser() {
            var div = document.getElementById('panel_insert_user');
            togglePanelUser(div, 'insert');
        }

        function closePanelInsertUser() {
            document.getElementById('panel_insert_user').style.display = 'none';
            isInsertPanelOpen = false;
        }

        function panelDeleteUser() {
            var div = document.getElementById('panel_delete_user');
            togglePanelUser(div, 'delete');
        }

        function closePanelDeleteUser() {
            document.getElementById('panel_delete_user').style.display = 'none';
            isInsertPanelOpen = false;
        }

        function confirmDeleteUser() {
            document.getElementById('panelAskUser').style.display = 'block';
            return false; // Prevent form submission
        }

        function closePanelDeleteUser() {
            document.getElementById('panel_delete_user').style.display = 'none';
        }

        function panelUpdateUser(userId, name, email, password) {
            document.getElementById('editUserId').value = userId;
            document.getElementById('editNameUser').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPassword').value = password;
            document.getElementById('panel_update_user').style.display = 'block';
            isUpdatePanelOpen = true;
        }

        function closePanelUpdateUser() {
            document.getElementById('panel_update_user').style.display = 'none';
            isUpdateUserPanelOpen = false;
        }

        function togglePanelUser(div, panelType) {
            if (div.style.display === 'none') {
                div.style.display = 'block';

                if (panelType === 'insert') {
                    isInsertUserPanelOpen = true;
                    isUpdateUserPanelOpen = false;
                    isDeleteUserPanelOpen = false;
                } else if (panelType === 'delete') {
                    isInsertUserPanelOpen = false;
                    isUpdateUserPanelOpen = false;
                    isDeleteUserPanelOpen = true;
                }
            } else {
                div.style.display = 'none';

                if (panelType === 'insert') {
                    isInsertUserPanelOpen = false;
                    isDeleteUserPanelOpen = false;
                } else if (panelType === 'delete') {
                    isDeleteUserPanelOpen = false;
                }
            }
        }

        function timKiemKhachHang() {
            var searchText = document.getElementById("text-search-user").value;

            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    // console.log(xhr.responseText);
                    if (xhr.status === 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        handleResponseData_user(responseData);
                    } else {
                        console.error('Lỗi HTTP: ' + xhr.status);
                    }
                }
            };


            xhr.open("POST", "search_user.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("text-search-user=" + searchText);
        }

        function handleResponseData_user(data) {
            var tableHTML = generateMovieTable_user(data);
            document.getElementsByClassName("table-user")[0].innerHTML = tableHTML;
        }

        function generateMovieTable_user(data) {
            var tableHTML = "<tr><th>ID người dùng</th><th>Tên người dùng</th><th>Email</th><th>Mật khẩu</th><th>Chỉnh sửa</th></tr>";

            if (data.length > 0) {
                data.forEach(function(row) {
                    tableHTML += "<tr>";
                    tableHTML += "<td>" + row['user_id'] + "</td>";
                    tableHTML += "<td>" + row['name'] + "</td>";
                    tableHTML += "<td>" + row['email'] + "</td>";
                    tableHTML += "<td>" + row['password'] + "</td>";
                    tableHTML += "<td onclick='panelUpdate(\"" + row['user_id'] + "\", \"" + row['name'] + "\", \"" + row['email'] + "\", \"" + row['password'] + "\")' style='cursor: pointer;'><i class='ri-pencil-fill'></i></td>";
                    tableHTML += "</tr>";
                });
            } else {
                tableHTML += "<tr><td colspan='12'>Không có dữ liệu</td></tr>";
            }

            return tableHTML;
        }

        document.getElementById('btn-search-user').addEventListener('click', timKiemKhachHang);
    </script>


</body>
</html>

<?php 
    // Đóng kết nối CSDL
    $conn->close();
?>