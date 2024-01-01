<?php
        include('../../database.php');
// ------------------  Thêm dữ liệu phim  ------------------------------
    if(isset($_POST['btn-insert'])){
        $add_name_movie=$_POST['addName'];
        $add_description=$_POST['addDescription'];
        $add_genre=$_POST['addGenre'];
        $add_country=$_POST['addCountry'];
        $add_status=$_POST['addStatus'];
        $add_release_year=$_POST['addReleaseYear'];
        $add_director=$_POST['addDirector'];
        $add_actor_name=$_POST['addActorName'];
        $add_updated_episode=$_POST['addUpdatedEpisode'];
        $add_url_movie=$_POST['addUrlMovie'];

        $sql = "INSERT INTO movie (name, description, genre, country, status, 
                            release_year, director, actor_name, updated_episode, url_movie) 

                VALUES ('$add_name_movie', '$add_description', '$add_genre', '$add_country', 
                        '$add_status', '$add_release_year', '$add_director', '$add_actor_name', 
                        '$add_updated_episode', '$add_url_movie')";

        $result = mysqli_query($conn, $sql);

        if($result){
            header('Location: ../../admin.php'); // Thay đổi đường dẫn tùy thuộc vào trang của bạn
            exit();
            echo '<script>alert("Thêm dữ liệu thành công")</script>';

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

?>