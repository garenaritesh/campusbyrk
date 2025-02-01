<?php
include("main_adminpanel.php");
// Sending Messages To all Users

if (isset($_REQUEST['send_msg'])) {
    $messages = $_REQUEST['message'];
    $sender = 'Admin';

    // Fetch all users from platform
    $sql_users = "select email from users";
    $res = mysqli_query($db, $sql_users);

    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $email = $row['email'];
            $sql = "insert into notification(user,message,sender) values('$email','$messages','$sender')";
            mysqli_query($db, $sql);
        }
        echo "Notification sent to all users successfully.";
    } else {
        echo "Error fetching users: " . mysqli_error($db);
    }


}

?>




            <!-- Title -->
            <h4>Notification Forms</h4>

            <div class="container">
                <form action="#" method="post">
                    <h3>Sending Messages To users</h3>
                    <textarea name="message" id="" rows="10" placeholder="Message" required></textarea>
                    <button name="send_msg">Send</button>
                </form>
            </div>


        </div>

        <!-- Main Content OF Right Bar -->

    </div>


    <!-- Javascript file link here -->

</body>

</html>