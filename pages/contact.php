<?php
include("../hf/pages.php");

// User Data
$sql = "select * from users where email = '$user'";
$ress = mysqli_query($db, $sql);
$user_data = mysqli_fetch_assoc($ress);

// Contact Message Send Script
if (isset($_REQUEST['send_msg'])) {
    $reply = $_REQUEST['reply'];
    $msg = $_REQUEST['msg'];
    $user_id = $_REQUEST['user_id'];

    $sql = "insert into contacts_forms(user_id,email,msg,reply) values('$user_id','$user','$msg','$reply')";
    $res = mysqli_query($db, $sql);
    header("location:contact.php");

}

?>

<!-- About Page Content Here -->
<section class="contact">
    <h4 class="contact_title">
        Contact <span>Us</span>
        <line></line>
    </h4>
    <div class="contact_content">
        <div class="left">
            <div class="banner">
                <img src="../admin/assets/contact.png" alt="">
            </div>
        </div>
        <div class="right">
            <div class="auto_slogo">
                <h4>Our Platform</h4>
                <p>54709 Willms Station <br>
                    Suite 350, Washington, USA</p>
                <p>Tel: (415) 555-0132 <br>
                    Email: admin@forever.com</p>
            </div>
            <div class="auto_slogo">
                <form action="#" method="post">
                    <input type="text" name="user_id" value="<?php echo $user_data['user_id'] ?>" hidden>
                    <input type="text" name="reply" value="over" hidden>
                    <textarea name="msg" placeholder="Enter Message that you want to say..." cols="5" rows="5"
                        required></textarea>
                    <button name="send_msg">Send</button>
                </form>
            </div>
        </div>
    </div>
    </div>


</section>


<!-- Toast notification Here -->





<script>
    function showToast(message, type = "success") {
        const toastContainer = document.getElementById("toast-container");
        const toast = document.createElement("div");
        toast.classList.add("toast");
        if (type === "error") toast.classList.add("error");
        toast.innerText = message;

        toastContainer.appendChild(toast);
        setTimeout(() => {
            toast.style.animation = "fadeOut 0.5s forwards";
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }
</script>

<?php

include("../hf/footer.php");

?>