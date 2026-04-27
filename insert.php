<?php
require 'db.php';
$pdo = getpdo();
?>

<?php
//POSTの処理がおこなわれた時に動く
if($_SERVER['REQUEST_METHOD'] === 'POST'){
if (isset($_POST["text"])){
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