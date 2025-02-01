<?php

include("../hf/users_h.php");



// Mark all notifications as read when the page is loaded
$update_sql = "UPDATE notification SET is_read = 1 WHERE user = '$user' AND is_read = 0";
mysqli_query($db, $update_sql);

// Fetch all notifications
$sql = "SELECT * FROM notification WHERE user = '$user' ORDER BY date DESC";
$res = mysqli_query($db, $sql);

// Count unread notifications (should be 0 now since we marked all as read)
$sql_unread = "SELECT COUNT(*) as unread_count FROM notification WHERE user = '$user' AND is_read = 0";
$unread_count_result = mysqli_query($db, $sql_unread);
$unread_count = mysqli_fetch_assoc($unread_count_result)['unread_count'];

// Fetch user information
$sql_user = "SELECT * FROM users WHERE email = '$user'";
$user_info = mysqli_fetch_assoc(mysqli_query($db, $sql_user));

// User Data
$sql_user = "SELECT * FROM users WHERE email = '$user'";
$user_info = mysqli_fetch_assoc(mysqli_query($db, $sql_user));

$allnotifi = mysqli_num_rows(mysqli_query($db, "select * from notification where user = '$user'"));

?>

<!-- User Notification -->
<div class="user_info">
    <div class="user_img">
        <?php if ($user_info['user_pic'] == ''): ?>
            <img src="../admin/assets/user_img.jpg" alt="">
        <?php else: ?>
            <img src="../admin/images/<?php echo $user_info['user_pic']; ?>" alt="">
        <?php endif; ?>
    </div>
    <div class="user_dtl">
        <h1><?php echo $user_info['name'] ?: 'Passmate User'; ?></h1>
        <p>Passmate Member Since <?php echo date("Y", strtotime($user_info['date'])); ?></p>
    </div>
</div>

<!-- User Tabs -->
<div class="user_tabs">
    <ul class="tab">
        <li><a href="../pages/user_account.php">Passes</a></li>
        <li><a href="orders.php">Orders</a></li>
        <li><a href="user_info.php">Account</a></li>
        <li class="c_tab"><a href="notification.php">Notification (<?php echo $allnotifi; ?>)</a></li>
        <li><a href="setting.php">Setting</a></li>
    </ul>
</div>

<!-- Notifications Section -->
<section class="slider">
    <?php if (mysqli_num_rows($res) > 0): ?>
        <?php while ($notification = mysqli_fetch_assoc($res)): ?>
            <div class="row">
                <div class="notifi_box <?php echo $notification['is_read'] == 0 ? 'unread' : ''; ?>">
                    <div class="top">
                        <img src="../admin/assets/about.webp" alt=""> <span class="dot"></span>
                        <p class="sender">By <?php echo $notification['sender']; ?></p><span class="dot"></span>
                        <p class="date"><?php echo date("Y-m-d", strtotime($notification['date'])); ?></p>
                    </div>
                    <div class="msgs">
                        <p><?php echo $notification['message']; ?></p>
                    </div>
                    <div class="bottom">
                        <?php if ($notification['forms'] == 'train'): ?>
                            <p>Remark Process</p>
                            <a href="../pages/remark_form.php?update_form=<?php echo $notification['form_id']; ?>">
                                <button>Update Application</button>
                            </a>
                        <?php elseif ($notification['forms'] == 'bus'): ?>
                            <p>Remark Process</p>
                            <a href="../pages/bus_remark_form.php?update_form=<?php echo $notification['form_id']; ?>">
                                <button>Update Application</button>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No notifications available.</p>
    <?php endif; ?>
</section>

<?php include("../hf/footer.php"); ?>