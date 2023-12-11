<?php
include 'db.php';
$db = new Database();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST">
    <input type="text" name="email" id="">
    <input type="password" name="password" id="">
    <input type="submit" value="submit">
</form>
<table>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Password</th>
        <th colspan="2"> Action</th>
    </tr>

    <tr>
        <?php 
        $users = $db->selectUser();
        foreach ($users as $user) { ?>
            <td><?php echo $users['id'];?></td>
            <td><?php echo $users['email'];?></td>
            <td><?php echo $users['password'];?></td>
            <td><a href="edit.php?id=<?php echo $users['id'];?>">Edit</a></td>
            <td><a href="delete.php?id=<?php echo $users['id'];?>">Delete</a></td>
    </tr> <?php }?>
</table>



</body>
</html>