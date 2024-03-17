<?php
 session_start();

 if(!isset($_SESSION['user_id']) ){
    header('Location: Login.php');
    exit();
 }

  require_once 'config.php';
  $db = new PDO($dsn, $user, $password, $options);
 if($_SESSION['role'] === 'admin' && isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $sql = "DELETE FROM student_data WHERE user_id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt -> bindParam(':user_id',$user_id);
    $stmt ->execute();
 }
?>