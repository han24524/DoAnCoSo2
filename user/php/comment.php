<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
    <form action="" method="post">
      <label> Tên: <input type="text" name="user-name" require></label><br>
      <label> Bình luận: 
        <textarea name="comment" require></textarea>
      </label><br>
      <input type="button"  name="submit" value="Gửi">
    </form>
</body>
</html>

<?php
  if(isset($_POST['Submit'])) {
    print "<h2>Gửi bình luận thành công</h2>";

    $user_name = $_POST["user-name"];
    $comment = $_POST["comment"];
    
    // Cmt trước
    $old = fopen("comment.txt", "r+t");
    $old_comment = fread($old, 1024);

    // thêm cmt mới
    $write = fopen("comment.txt", "w+");

    $string = "<dic class='comment'><span>'".$user_name."</span><br>
              <span>".date("Y/m/d")." | ".date("h:i A")."</span><br>
              <span>".$comment/"</span></div>\n".$old_comment;

    fwrite($write, $string);
    fclose($write);
    fclose($old);
  }
?>