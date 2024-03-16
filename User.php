<?php 
session_start();

if(!isset($_SESSION['user_id'])){
    header('Location: Login.php');
    exit();
}

require_once 'Config.php';
$db = new PDO($dsn,$user,$password,$options);

$sql = "SELECT * FROM registered_courses ";
$result = $db->query($sql);
$result = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
        <meta name="description" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>User Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
    <h1>User Dashboard</h1>
        <div>
            <h3>Hello <?php echo $_SESSION['username'] ;?>
             Let's make every visit to the website a special experience.<h3>
        </div>

        <h2>Registered Courses:</h2>

        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Course_Name</th>
                    <th>Course_Id</th>
                    <th>Course_Hours</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($result as $registered_courses) :?>
                <tr>
                <td><?php echo htmlspecialchars($registered_courses['user_id']); ?></td>
                <td><?php echo htmlspecialchars($registered_courses['course_name']); ?></td>
                <td><?php htmlspecialchars($registered_courses['course_id']); ?></td>
                <td><?php htmlspecialchars($registered_courses['course_hours']); ?></td>
                <a href="deletecourse.php?courseid=<?php echo $registered_courses['iser_id']; ?>">Delete Course</a>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table><br>
        <a href="add.php">Back to add course</a>
    </body>
</html>
