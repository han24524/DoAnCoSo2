<?php
    // Kết nối CSDL
    $conn = new mysqli('localhost', 'root', '', 'website_film');

    if (!$conn) {
        die('Kết nối không thành công!');
    }    

?>