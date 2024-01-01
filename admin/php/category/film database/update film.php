<?php
        include('../../database.php');
// ------------------  Sửa dữ liệu phim  ------------------------------
    // Lấy dữ liệu từ form submit
        $edit_movieId = $_POST['editMovieId'];
        $edit_name = $_POST['editName'];
        $edit_description=$_POST['editDescription'];
        $edit_genre=$_POST['editGenre'];
        $edit_country=$_POST['editCountry'];
        $edit_status=$_POST['editStatus'];
        $edit_release_year=$_POST['editReleaseYear'];
        $edit_director=$_POST['editDirector'];
        $edit_actor_name=$_POST['editActorName'];
        $edit_updated_episode=$_POST['editUpdatedEpisode'];
        $edit_url_movie=$_POST['editUrlMovie'];

        // Thực hiện câu truy vấn UPDATE để sửa dữ liệu trong CSDL
        $sql = "UPDATE movie SET name='$edit_name', description='$edit_description', genre='$edit_genre', 
                country='$edit_country', status='$edit_status', release_year='$edit_release_year', 
                director='$edit_director', actor_name='$edit_actor_name', 
                updated_episode='$edit_updated_episode', url_movie='$edit_url_movie'
                WHERE id_movie='$edit_movieId'";

        $result = mysqli_query($conn, $sql);

        if($result){
            header('Location: ../../admin.php'); // Thay đổi đường dẫn tùy thuộc vào trang của bạn
            exit();
            echo '<script>alert("Cập nhật dữ liệu thành công")</script>';
        
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

?>