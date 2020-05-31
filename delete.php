<?php
// 1.GETでid値を取得
$id = $_GET["id"];


// ２．DB接続など
try {
  $pdo = new PDO('mysql:dbname=b_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

// ３．DELETE*FROM a_table WHERE id=:id;
$sql = 'DELETE FROM a_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

// 4.データ表示
$view="";
if($status==false){
    //execute(SQL実行時にエラーがある場合)
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]); 
}else{
  //５．index.phpへリダイレクト 書くときにLocation: in この:　のあとは半角スペースがいるので注意！！
  header("Location: select.php");
  exit;
}

?>