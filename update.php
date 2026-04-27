<?php
require 'db.php';
$pdo = getpdo();
?>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){

if(isset($_POST["update"])){

$id = $_POST["select_id"];
$title =$_POST["change_title"];

if(trim($title) ===""){
    
    echo '入力してください';
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
}
?>
