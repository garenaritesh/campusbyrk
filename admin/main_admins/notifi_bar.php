<?php

include("main_adminpanel.php");

$sql = "select * from contacts_forms";
$noti = mysqli_query($db, $sql);

// Checking Reply Is Empty Or Not
$sql = "select * from contacts_forms where reply='over'";
$res = mysqli_query($db, $sql);
$check_reply = mysqli_num_rows($res);

// echo date("Y-m-d", strtotime($noti_row['form_date'])

if (isset($_REQUEST['reply_back'])) {

    $contact_id = $_REQUEST['contacts_id'];
    $reply = $_REQUEST['reply'];

    $sql = "update contacts_forms set reply='$reply' where contacts_id = '$contact_id'";
    $res = mysqli_query($db, $sql);

    // Send notification About The Query 
    $user_email_d = $_REQUEST['user'];
    $sender = $_REQUEST['sender'];

    mysqli_query($db, "insert into notification(user,message,sender) values('$user_email_d','$reply','$sender')");


    header("location:notifi_bar.php");

}

?>




            <!-- Title -->
            <h4>Contact Forms</h4>

            <div class="container">
                <?php
                if ($check_reply > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                        <div class="contacts">
                            <div class="top">
                                <i class='bx bxs-user-pin'></i> <span></span>
                                <p><?php echo $row['email']; ?></p> <span></span>
                                <p><?php echo date("Y-m-d", strtotime($row['date'])) ?></p>
                            </div>
                            <div class="msgs">
                                <?php echo $row['msg']; ?>
                            </div>
                            <div class="reply">
                                <form action="#" method="post">
                                    <input type="text" name="contacts_id" value="<?php echo $row['contacts_id']; ?>" hidden>
                                    <input type="text" name="reply" id="reply" placeholder="Reply">

                                    <!-- Notification Form Data To For Check Reply by Pssmate Worker or admin -->
                                    <input type="hidden" name="user" value="<?php echo $row['email']; ?>">
                                    <input type="hidden" name="sender" value="ByPAdmin">

                                    <button name="reply_back"><i class='bx bx-send'></i></button>
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                } else { ?>
                    <h1>Data Not Found</h1>
                <?php } ?>

            </div>


        </div>

        <!-- Main Content OF Right Bar -->

    </div>


    <!-- Javascript file link here -->

</body>

</html>