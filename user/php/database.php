<?php
    // Kết nối CSDL
    $conn = new mysqli('localhost', 'root', '', 'website_film');

    if (!$conn) {
        die('Kết nối không thành công!');
    }

    // Xây dựng menu đa cấp
    function buildMenu($items, $parentIdMenu = NULL, $level = 1)
    {
        // Tạo class CSS dựa trên cấp độ
        $menuClass = "menu-level-$level";

        $menu = "";
        $hasChild = false; // Biến kiểm tra xem có mục con không

        foreach ($items as $item) {
            if ($item['parent_id_menu'] == $parentIdMenu) {
                if (!$hasChild) {
                    // Nếu có mục con, mở thẻ ul ở đầu tiên
                    $menu .= "<ul class='$menuClass'>";
                    $hasChild = true;
                }

                if ($item['parent_id_menu'] == 2) {
                    $menu .= "<li class='$menuClass-child'><a href='nam.php?dk=" . $item['name_menu'] . "'>" . $item['name_menu'] . "</a>";
                } else if ($item['parent_id_menu'] == 3) { 
                    $menu .= "<li class='$menuClass-child'><a href='theLoai.php?dk=" . $item['name_menu'] . "'>" . $item['name_menu'] . "</a>";
                } else if ($item['parent_id_menu'] == 4) { 
                    $menu .= "<li class='$menuClass-child'><a href='top.php?dk=" . $item['name_menu'] . "'>" . $item['name_menu'] . "</a>";
                } else if ($item['parent_id_menu'] == 5) { 
                    $menu .= "<li class='$menuClass-child'><a href='quocGia.php?dk=" . $item['name_menu'] . "'>" . $item['name_menu'] . "</a>";
                } else {
                    $menu .= "<li class='$menuClass-child'><a>" . $item['name_menu'] . "</a>";
                }

                $childMenu = buildMenu($items, $item['id_menu'], $level + 1);
                if (!empty($childMenu)) {
                    $menu .= $childMenu;
                }
                $menu .= '</li>';
            }
        }

        if ($hasChild) {
            // Nếu có mục con, đóng thẻ ul ở cuối
            $menu .= '</ul>';
        }
        return $menu;
    }

    // Truy vấn dữ liệu từ bảng 'menu'
    $sql = "SELECT * FROM menu";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $menuItems = array();
        while ($row = $result->fetch_assoc()) {
            $menuItems[] = $row;
        }
    } else {
        echo "Không có dữ liệu menu.";
    }
?>