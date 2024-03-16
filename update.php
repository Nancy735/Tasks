<!DOCTYPE html>
<html>
    <head>
        <meta name="description" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>User Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
        <h2>Update password</h2>
        <form method="post">
            <label for="new_pass">New Password:</label>
            <input type="password" id="new_pass" name="new_pass" required><br>

            <?php if($_SESSION["role"] === "user"): ?>
            <label for="old_pass">Old Password:</label>
            <input type="password" id="old_pass" name="old_pass" required><br>
            <?php endif; ?>

            <input type="submit" name="update_pass" value="Update Password"><br>
        </form>
    </body>
</html>
<?php
 session_start();

 if(!isset($_SESSION['user_id'])){
    header('Location: Login.php');
    exit();
 }

 require_once 'config.php';
 $db = new PDO($dsn , $user , $password , $options);
 $user_id = $_SESSION['user_id'];

 if($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['role'] == 'user'){
    $oldpass = htmlspecialchars($_POST['old_pass']);
    $sql = "SELECT password FROM student_data WHERE user_id = :user_id";
    $stmt = $db -> prepare($sql);
    $stmt -> bindParam(':user_id', $user_id);
    $stmt -> execute();
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    if(isset($_POST['update_pass'])){
        $newpass = htmlspecialchars($_POST['new_pass']);
        $hashedPass = password_hash($newPass, PASSWORD_BCRYPT);
        $sql = "UPDATE student_data SET password = :new_pass WHERE user_id = :user_id";
        $stmt = $db -> prepare($sql);
        $stmt -> bindParam(':user_id', $user_id);
        $stmt -> bindParam(':new_pass', $newpass);
        $stmt -> execute();
        echo "updated successfully!";
        header('Location: User.php');
        exit();
    }
    else{
        echo "Incorrect old password. Please try again.";
    }
 }
 if($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['role'] === 'admin'){
    if(isset($_POST['up'])){
        if(isset($_POST['update_pass'])){
            $newpass = htmlspecialchars($_POST['new_pass']);
            $hashedPass = password_hash($newPass, PASSWORD_BCRYPT);
            $sql = "UPDATE student_data SET password = :new_pass WHERE user_id = :user_id";
            $stmt = $db -> prepare($sql);
            $stmt -> bindParam(':user_id', $user_id);
            $stmt -> bindParam(':new_pass', $newpass);
            $stmt -> execute();
            echo "updated successfully Admona!";
            header('Location: Admin.php');
            exit();
        }
    }
 }
?>