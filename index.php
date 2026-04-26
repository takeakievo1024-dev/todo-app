<?php
//new PDO()でDBにアクセスできる状態にする。
$pdo = new PDO('mysql:host=localhost;dbname=todo_app;charset=utf8',
'root',
'',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);



//POSTの処理がおこなわれた時に動く
if($_SERVER['REQUEST_METHOD'] === 'POST'){

if(isset($_POST["update"])){

$id = $_POST["select_id"];
$title =$_POST["change_title"];
if(trim($title) ===""){
    echo "入力してください";
}else{
try{
$sql = "UPDATE tasks SET title = ? WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$title,$id]);
header("Location:index.php");
exit;}
catch(Exception $e){
    echo "更新ができません";
}
}
}


elseif(isset($_POST["delete"])){
try{
$id = $_POST["delete_id"];
//sqlの削除文を書き込む
$sql = "DELETE FROM tasks WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
header("Location:index.php");
exit;}
catch(Exception $e){
    echo "削除ができません";
}

}
    
elseif (isset($_POST["insert"])){
//値を代入
$text = $_POST["text"];

//空文字チェック
if(trim($text) === ""){
echo "入力してください";
}else{
try{

//SQL文でDBに入力情報を書き込む。   
$sql = "INSERT INTO tasks(title) VALUES(?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$text]);
header("Location:index.php");
exit;
}catch(Exception $e){
    echo "DBに書き込みが失敗しました";
}
}
}
}

?>


<body>

<div style="text-align:center;">
<form method = "POST" action = "index.php">
    <input type = "text" name = "text">
    <input type = "submit" name = "insert" value = "送信"><br>
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

<ul>
    
<?php foreach($todos as $todo):?>
<li><?=htmlspecialchars($todo['title'],ENT_QUOTES,'UTF-8')?>
<form method ="POST" action ="index.php" style = "display:inline;">
    
    <input type ="hidden" name = "delete_id" value = "<?= $todo['id'] ?>">
    <input type = "submit" name = "delete" value = "削除">
</form>
<form method ="POST" action ="index.php" style = "display:inline;">
    <input type ="hidden" name = "select_id" value ="<?=$todo['id'] ?>">
    <input type = "text" name = "change_title" value ="<?=$todo['title']?>" >
    <input type ="submit" name = "update" value = "更新">
</form>

</li>

<?php endforeach;?>
</ul>
</body>

