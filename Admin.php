<?php 
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] === 'user'){
    header('Location: Login.php');
    exit();
}

require_once 'config.php';
$db = new PDO($dsn,$user,$password,$options);

$sql = "SELECT username , user_id, role FROM student_data";
$result = $db->query($sql);
$result -> execute();
$result = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
        <meta name="description" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Admin</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
        <div>
            <h3>Hello <?php echo $_SESSION['username'] ;?>
             Let's make every visit to the website a special experience.<h3>
        </div>
        <table>
            <h1>User Data</h1>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>User ID</th>
                    <th>Role</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $student_data) :?>
                <tr>
                <td><?php echo htmlspecialchars($student_data['username']); ?></td>
                <td><?php echo htmlspecialchars($student_data['user_id']); ?></td>
                <td><?php echo htmlspecialchars($student_data['role']); ?></td>
                <td>
                    <form action="update.php" method="post">
                        <input type="hidden" name="up" value="<?php echo $student_data['user_id']; ?>">
                        <button type="submit">Update User</button>
                    </form>
                    
                </td>
                <td>
                    <form action="delete_account.php" method="post">
                        <input type="hidden" name="de" value="<?php echo $student_data['user_id']; ?>">
                        <button type="submit">Delete User</button>
                    </form>
                </td>
                </tr>
            <?php endforeach; ?> 
            </tbody>
        </table>
        <input type="button" value="log-out" onclick="window.location.href='Logout.php'"><br>
    </body>
</html>