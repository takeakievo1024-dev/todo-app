<?php
require 'db.php';
$pdo = getpdo();
?>


<body>

<div style="text-align:center;">
<form method = "POST" action = "insert.php">
    <input type = "text" name = "text">
    <input type = "submit" value = "送信"><br>
</form>

<?php
//一覧表示を作る
//$sqlにtasksテーブルの中のカラムのtitleを指定。
$sql = "SELECT id,title FROM tasks";
//$stmtに$pdoのアクセス方法を使い$sqlを格納
$stmt = $pdo->prepare($sql);
//DBにアクセスする。
$stmt->execute();
//PHPで使える形に変換する
$todos = $stmt->fetchAll();
?>

<?php foreach($todos as $todo):?>
<ul>
<li><?=htmlspecialchars($todo['title'],ENT_QUOTES,'UTF-8');?></li>



<form method ="POST" action ="update.php" style = "display:inline;">
    <input type ="hidden" name = "select_id" value ="<?=$todo['id'] ?>">
    <input type = "text" name = "change_title" value ="<?=$todo['title']?>" >
    <input type ="submit" name = "update" value = "更新">
</form>

<form method ="POST" action ="delete.php" style = "display:inline;">
    <input type ="hidden" name = "delete_id" value = "<?= $todo['id'] ?>">
   <input type = "submit"  value = "削除">
</form>



</ul>

<?php endforeach; ?>

</body>


