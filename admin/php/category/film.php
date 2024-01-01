<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link rel="stylesheet" href="../css/film.css?v=<?php echo time(); ?>">

</head>

<body>
    <?php
        include('database.php');
    ?>

    <div class="container-search">
        <div class="input-field">
            <i class="ri-search-line"></i>
            <input type="search" name="text-search-f" id="text-search-f" placeholder="Tìm kiếm...">
        </div>
        <input type="submit" value="Tìm Kiếm" id="btn-search">
        <input type="submit" value="Thêm" id="btn-insert" onclick="panelInsert()">
        <input type="submit" value="Xóa" id="btn-delete" onclick="panelDelete()">
    </div>

<!------------- panel thêm phim ---------------->
    <div id="panel_insert" class="panel-insert">
        <div class="modal-content-insert">
            <span class="close" onclick="closePanelInsert()">&times;</span>
            <h2>Thêm thông tin phim</h2>
            <!-- Form để thêm thông tin phim -->
            <form method="post" class="form-insert-film" action="category/film database/insert film.php">
                <!-- Các trường thêm thông tin -->
                <div>
                    <label for="addName">Tên phim:</label><br>
                    <input type="text" id="addName" name="addName" required>
                </div>
                <div>
                    <label for="addGenre">Thể loại:</label><br>
                    <input type="text" id="addGenre" name="addGenre" required>
                </div>
                <div>                
                    <label for="addCountry">Quốc gia:</label><br>
                    <input type="text" id="addCountry" name="addCountry" required>
                </div>
                <div>
                    <label for="addStatus">Trạng thái:</label><br>
                    <input type="text" id="addStatus" name="addStatus" required>
                </div>
                <div>
                    <label for="addReleaseYear">Năm Phát hành:</label><br>
                    <input type="text" id="addReleaseYear" name="addReleaseYear" required>
                </div>
                <div>
                    <label for="addDirector">Đạo diễn:</label><br>
                    <input type="text" id="addDirector" name="addDirector" required></div>
                <div>
                    <label for="addActorName">Diễn viên:</label><br>
                    <input type="text" id="addActorName" name="addActorName" required>
                </div>
            
                <div>
                    <label for="addUpdatedEpisode">Phát sóng:</label><br>
                    <input type="text" id="addUpdatedEpisode" name="addUpdatedEpisode" required>
                </div>
                <div></div>
                <!-- Nút để xác nhận sửa thông tin -->
                <button type="submit" name="btn-insert">Lưu</button>

                <div>
                    <label for="addUrlMovie">URL phim:</label><br>
                    <input type="text" id="addUrlMovie" name="addUrlMovie" required>
                </div>
                <div>
                    <label for="addDescription">Mô tả:</label><br>
                    <textarea id="addDescription" name="addDescription" required></textarea>
                </div>

            </form>
        </div>
    </div>

<!-- -----------  panel xóa phim  ------------->

    <div id="panel_delete" class="panel-delete">
        <div class="modal-content-delete">
            <span class="close" onclick="closePanelDelete()">&times;</span>
            <h2>Xóa thông tin phim</h2>
            <!-- Form để thêm thông tin phim -->
            <form method="post" id="delete-form" action="category/film database/delete film.php">
                <!-- Các trường thêm thông tin -->
                <div>
                    <label for="delID">ID phim:</label>
                    <input type="text" id="delID" name="delID" required><br>
                </div><br>
                <div>
                    <div id="panelAskFilm">
                        Bạn có chắc muốn xóa phim này không? Dữ liệu không thể phục hồi sau khi xóa!
                    </div><br>
                    <button type="submit" name="btn-delete" 
                            class="btn-xoa" style="margin:auto; width:20%;" onclick="confirmDelete()">Xóa
                    </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" value="Không" class="btn-khong" onclick="closePanelDelete()">
                </div>
            </form>
        </div>
    </div>
<!-- -----------  sửa phim  ------------------->
    <table class="table-user">
        <tr>
            <th>ID phim</th>
            <th>Tên phim</th>
            <th>Mô tả</th>
            <th>Thể loại</th>
            <th>Quốc gia</th>
            <th>Trạng thái</th>
            <th>Năm Phát hành</th>
            <th>Đạo diễn</th>
            <th>Diễn viên</th>
            <th>Phát sóng</th>
            <th>URL phim</th>
            <th>Chỉnh sửa</th>
        </tr>
        <?php
            // Truy vấn dữ liệu từ CSDL
            $sql = "SELECT * FROM movie";
            $result = $conn->query($sql);

            // Hiển thị dữ liệu từ CSDL trong bảng
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id_movie'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td name='description'>" . $row['description'] . "</td>";
                    echo "<td>" . $row['genre'] . "</td>";
                    echo "<td>" . $row['country'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['release_year'] . "</td>";
                    echo "<td>" . $row['director'] . "</td>";
                    echo "<td>" . $row['actor_name'] . "</td>";
                    echo "<td>" . $row['updated_episode'] . "</td>";
                    echo "<td><img src='" . $row['url_movie'] . "'></td>";
                    echo "<td onclick='panelUpdate(\"" . $row['id_movie'] . "\", 
                        \"" . $row['name'] . "\", \"" . $row['description'] . "\", 
                        \"" . $row['genre'] . "\", \"" . $row['country'] . "\", 
                        \"" . $row['status'] . "\", \"" . $row['release_year'] . "\", 
                        \"" . $row['director'] . "\", \"" . $row['actor_name'] . "\",
                        \"" . $row['updated_episode'] . "\", \"" . $row['url_movie'] . "\")'
                        style='cursor: pointer;'>
                        <i class='ri-pencil-fill'></i>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='12'>Không có dữ liệu</td></tr>";
            }
        ?>
    </table>

<!-- -----------  sửa phim  ------------------->
    <div id="panel_update" class="panel-update">
        <div class="modal-content-update">
            <span class="close" onclick="closePanelUpdate()">&times;</span>
            <h2>Chỉnh sửa thông tin phim</h2>
            <!-- Form để sửa thông tin phim -->
            <form method="post" class="form-update-film" action="category/film database/update film.php">
                <!-- Các trường sửa thông tin -->
                <input type="hidden" id="editMovieId" name="editMovieId">
                
                <div>
                    <label for="editName">Tên phim:</label><br>
                    <input type="text" id="editName" name="editName" required>
                </div>
                <div>
                    <label for="editGenre">Thể loại:</label><br>
                    <input type="text" id="editGenre" name="editGenre" required>
                </div>
                <div>                
                    <label for="editCountry">Quốc gia:</label><br>
                    <input type="text" id="editCountry" name="editCountry" required>
                </div>
                <div>
                    <label for="editStatus">Trạng thái:</label><br>
                    <input type="text" id="editStatus" name="editStatus" required>
                </div>
                <div>
                    <label for="editReleaseYear">Năm Phát hành:</label><br>
                    <input type="text" id="editReleaseYear" name="editReleaseYear" required>
                </div>
                <div>
                    <label for="editDirector">Đạo diễn:</label><br>
                    <input type="text" id="editDirector" name="editDirector" required></div>
                <div>
                    <label for="editActorName">Diễn viên:</label><br>
                    <input type="text" id="editActorName" name="editActorName" required>
                </div>
            
                <div>
                    <label for="editUpdatedEpisode">Phát sóng:</label><br>
                    <input type="text" id="editUpdatedEpisode" name="editUpdatedEpisode" required>
                </div>
                <div></div>
                <!-- Nút để xác nhận sửa thông tin -->
                <button type="submit"   name="btn-update">Lưu</button>

                <div>
                    <label for="editUrlMovie">URL phim:</label><br>
                    <input type="text" id="editUrlMovie" name="editUrlMovie" required>
                </div>
                <div>
                    <label for="editDescription">Mô tả:</label><br>
                    <textarea id="editDescription" name="editDescription" required></textarea>
                </div>

            </form>
        </div>
    </div>
   
    <script>
        // Dùng biến isInsertPanelOpen và isUpdatePanelOpen để kiểm tra xem modal nào đang mở, 
        // và chỉ thực hiện đóng modal khi modal tương ứng đang mở.
        var isInsertPanelOpen = false;
        var isUpdatePanelOpen = false;
        var isDeletePanelOpen = false;

        function panelInsert() {
            var div = document.getElementById('panel_insert');
            togglePanel(div, 'insert');
        }

        function closePanelInsert() {
            document.getElementById('panel_insert').style.display = 'none';
            isInsertPanelOpen = false;
        }

        function panelDelete() {
            var div = document.getElementById('panel_delete');
            togglePanel(div, 'delete');
        }

        function closePanelDelete() {
            document.getElementById('panel_delete').style.display = 'none';
            isInsertPanelOpen = false;
        }

        function confirmDelete() {
            document.getElementById('panelAskFilm').style.display = 'block';
            return false; // Prevent form submission
        }

        function closePanelDelete() {
            document.getElementById('panel_delete').style.display = 'none';
        }

        function panelUpdate(movieId, name, description, genre, country, status, releaseYear, 
                            director, actorName, updatedEpisode, urlMovie) {
            document.getElementById('editMovieId').value = movieId;
            document.getElementById('editName').value = name;
            document.getElementById('editDescription').value = description;
            document.getElementById('editGenre').value = genre;
            document.getElementById('editCountry').value = country;
            document.getElementById('editStatus').value = status;
            document.getElementById('editReleaseYear').value = releaseYear;
            document.getElementById('editDirector').value = director;
            document.getElementById('editActorName').value = actorName;
            document.getElementById('editUpdatedEpisode').value = updatedEpisode;
            document.getElementById('editUrlMovie').value = urlMovie;
            document.getElementById('panel_update').style.display = 'block';
            isUpdatePanelOpen = true;
        }

        function closePanelUpdate() {
            document.getElementById('panel_update').style.display = 'none';
            isUpdatePanelOpen = false;
        }

        function togglePanel(div, panelType) {
            if (div.style.display === 'none') {
                div.style.display = 'block';

                if (panelType === 'insert') {
                    isInsertPanelOpen = true;
                    isUpdatePanelOpen = false;
                    isDeletePanelOpen = false;
                } else if (panelType === 'delete') {
                    isInsertPanelOpen = false;
                    isUpdatePanelOpen = false;
                    isDeletePanelOpen = true;
                }
            } else {
                div.style.display = 'none';

                if (panelType === 'insert') {
                    isInsertPanelOpen = false;
                    isDeletePanelOpen = false;
                } else if (panelType === 'delete') {
                    isDeletePanelOpen = false;
                }
            }
        }

        // Đóng modal khi click bên ngoài modal
        window.onclick = function (event) {
            var insert = document.getElementById('panel_insert');
            var update = document.getElementById('panel_update');
            var deletes = document.getElementById('panel_delete');

            if (isInsertPanelOpen && event.target === insert) {
                closePanelInsert();
            }

            if (isUpdatePanelOpen && event.target === update) {
                closePanelUpdate();
            }

            if (isDeletePanelOpen && event.target === deletes) {
                closePanelDelete();
            }
        }

        function timKiemPhim() {
            var searchText = document.getElementById("text-search-f").value;

            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    // console.log(xhr.responseText);
                    if (xhr.status === 200) {
                        var responseData = JSON.parse(xhr.responseText);
                        handleResponseData(responseData);
                    } else {
                        console.error('Lỗi HTTP: ' + xhr.status);
                    }
                }
            };


            xhr.open("POST", "search_movies.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("text-search-f=" + searchText);
        }

        function handleResponseData(data) {
            var tableHTML = generateMovieTable(data);
            document.getElementsByClassName("table-user")[1].innerHTML = tableHTML;
        }

        function generateMovieTable(data) {
            var tableHTML = "<tr><th>ID phim</th><th>Tên phim</th><th>Mô tả</th><th>Thể loại</th><th>Quốc gia</th><th>Trạng thái</th><th>Năm Phát hành</th><th>Đạo diễn</th><th>Diễn viên</th><th>Phát sóng</th><th>URL phim</th><th>Chỉnh sửa</th></tr>";

            if (data.length > 0) {
                data.forEach(function(row) {
                    tableHTML += "<tr>";
                    tableHTML += "<td>" + row['id_movie'] + "</td>";
                    tableHTML += "<td>" + row['name'] + "</td>";
                    tableHTML += "<td name='description'>" + row['description'] + "</td>";
                    tableHTML += "<td>" + row['genre'] + "</td>";
                    tableHTML += "<td>" + row['country'] + "</td>";
                    tableHTML += "<td>" + row['status'] + "</td>";
                    tableHTML += "<td>" + row['release_year'] + "</td>";
                    tableHTML += "<td>" + row['director'] + "</td>";
                    tableHTML += "<td>" + row['actor_name'] + "</td>";
                    tableHTML += "<td>" + row['updated_episode'] + "</td>";
                    tableHTML += "<td><img src='" + row['url_movie'] + "'></td>";
                    tableHTML += "<td onclick='panelUpdate(\"" + row['id_movie'] + "\", \"" + row['name'] + "\", \"" + row['description'] + "\", \"" + row['genre'] + "\", \"" + row['country'] + "\", \"" + row['status'] + "\", \"" + row['release_year'] + "\", \"" + row['director'] + "\", \"" + row['actor_name'] + "\", \"" + row['updated_episode'] + "\", \"" + row['url_movie'] + "\")' style='cursor: pointer;'><i class='ri-pencil-fill'></i></td>";
                    tableHTML += "</tr>";
                });
            } else {
                tableHTML += "<tr><td colspan='12'>Không có dữ liệu</td></tr>";
            }

            return tableHTML;
        }


        document.getElementById('btn-search').addEventListener('click', timKiemPhim);
        
    </script>

</body>

</html>

<?php
    // Đóng kết nối CSDL
    $conn->close();
?>
