<!DOCTYPE html>
<html>
<head>
        <meta name="description" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>User Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <label for="course_n">Course_Name:</label>
            <input type="text" name="course_n" id="course_n" required><br>
            <label for="course_id">Course_Id:</label>
            <input type="text" name="course_id" id="course_id" required><br>
            <label for="course_h">Course_Hours:</label>
            <input type="number" name="course_h" id="course_h" required><br>
            <input type="button" value="add course" onclick="window.location.href='User.php'"><br>
            <a href="Logout.php">log-out</a><br>
            <a href="delete.php">delete account?</a><br>
            <a href="update.php">update your data</a><br>
        </form>
    </body>
</html>
<?php
 session_start();
 if($_SERVER['REQUEST_METHOD'] === "POST"){

    $course_name = htmlspecialchars($_SESSION['course_n']);
    $course_id = htmlspecialchars($_SESSION['course_id']);
    $course_hours = htmlspecialchars($_SESSION['course_h']);
    $userid = $_SESSION['user_id'];

    require_once 'config.php';
    $db = new PDO($dsn , $user , $password , $options);

    $sql = "INSERT INTO registered_courses (course_name , course_id , course_hours ,user_id) VALUES (:course_n , :course_id , :course_h , :userid)";
    $stmt = $db->prepare($sql);
    $stmt ->execute(array(
        ':course_n' => $course_name,
        ':course_id' => $course_id,
        ':course_h' => $course_hours,
        ':userid' => $userid
    ));
 }
?>
