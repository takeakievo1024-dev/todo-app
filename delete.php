<?php
require 'db.php';
$pdo = getpdo();
?>

<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){


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

