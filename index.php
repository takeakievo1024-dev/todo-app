<?php

//POSTの処理がおこなわれた時に動く
if($_SERVER['REQUEST_METHOD'] === 'POST'){

//$_POSTに値が入っているか確認
if(isset($_POST["text"])){
//値を代入
$text = $_POST["text"];


//空文字チェック
if(trim($text) === ""){

echo "入力してください";

}else{
try{
//new PDO()でDBにアクセスできる状態にする。
$pdo = new PDO('mysql:host=localhost;dbname=todo_app;charset=utf8',
'root',
'');
//SQL文でDBに入力情報を書き込む。   
$sql = "INSERT INTO tasks(title) VALUES(?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$text]);
}catch(Exception $e){
    echo "DBに書き込みが失敗しました";
}
}
}
}
?>

<body>
<form method = "POST" action = "index.php">
    <input type = "text" name = "text">
    <input type = "submit" value = "送信"><br>


</body>