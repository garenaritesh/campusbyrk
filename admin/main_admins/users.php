<?php

include("main_adminpanel.php");

$users = "select * from users";
$res = mysqli_query($db, $users);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Our Users </title>
    <meta http-equiv="refresh" content="5">


</head>

<body>

    <style>
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>



    <h2 style="text-align: center;">User Data (Auto Refresh)</h2>
    <table id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contacts</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows(mysqli_query($db, $users)) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <!-- Data will be dynamically populated here -->
                    <tr>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?> | <br> <?php echo $row['phone']; ?></td>
                        <td><i class='bx bx-trash-alt'></i></td>
                    </tr>

                <?php }
            } else {
                echo "Users Not Founds";
            } ?>
        </tbody>
    </table>


    <!-- Javascript Content Here -->


</body>

</html>