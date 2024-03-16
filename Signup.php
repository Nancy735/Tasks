<?php
  session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="description" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>

        <form method="post">
            <label for="username">Userame: </label>
            <input type="text" name="username" id="username" placeholder="Your name" required>

            <label for="email">Email: </label>
            <input type="email" name="email" id="email" placeholder="Email or phone number" required>

            <label for="pass">Password: </label>
            <input type="password" name="pass" id="pass" placeholder="Enter a complex number" required>
            
            <label for="role">Role: </label>
            <input type="text" name="role" id="role" placeholder="user or admin" required>

            <input type="submit" value="Signup">
        </form>
    </body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $name = htmlspecialchars($_POST['username']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['pass'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $role = htmlspecialchars($_POST['role']);

    require_once 'config.php';
    $db = new PDO($dsn, $user, $password, $options);
        $sql = "INSERT INTO student_data (username, email, password, role) 
        VALUES (:uname, :email, :pass,:rol)";
        $insert = $db->prepare($sql);
        $insert->execute(array(
            ':uname' => $name,
            ':email' => $email,
            ':pass' => $hashed_password, // Store hashed password
            ':rol' => $role,
        ));
        
        if($insert){
            $_SESSION['username'] = $student_data['username'];
            $_SESSION['role'] = $student_data['role'];
            echo "successufuly connection!";
            header('Location:Login.php');
            exit();
        }else {
            echo "connection Error!";
        }
    }
?>
