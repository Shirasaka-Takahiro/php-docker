<?php

  $dsn = 'mysql:host=mysql;dbname=blog';
  $user = 'root';
  $pass = 'password';

  $post_no = $error = $name = $content = '';
  //comment
  if (@$_POST['submit']) {
    $post_no = strip_tags($_POST['post_no']);
    $name = strip_tags($_POST['name']);
    $content = strip_tags($_POST['content']);
    if (!$name) $error .= '名前がありません<br>';
    if (!$content) $error .= 'コメントがありません<br>';
    if (!$error) {
      $pdo = new PDO($dsn, $user, $pass);
      $sql = $pdo->prepare("INSERT INTO comment(post_no, name, content) VALUES(?,?,?)");
      $sql->execute(array($post_no, $name, $content));
      header('Location: blog.php');
      exit(); }

      } else {
      $post_no = strip_tags($_GET['no']);
    }
  

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>コメント投稿 | Special Blog</title>
<link rel="stylesheet" href="blog.css">
</head>
<body>
<form method="post" action="comment.php">
  <div class="post">
    <h2>コメント投稿</h2>
    <p>お名前</p>
    <p><input type="text" name="name" size="40" value="<?php echo $name ?>"></p>
    <p>コメント</p>
    <p><textarea name="content" rows="8" cols="40"><?php echo $content ?></textarea></p>
    <p>
      <input type="hidden" name="post_no" value="<?php echo $post_no ?>">
      <input name="submit" type="submit" value="投稿">
    </p>
    <p><?php echo $error ?></p>
  </div>
</form>
</body>
</html>
