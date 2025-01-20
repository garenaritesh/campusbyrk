<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

include("../admin/db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';



if (isset($_POST['change_password'])) {


    $email = $_POST['email'];

    // Main Script OF PHP Very Secure Code Here
    // Don't Change without give permission

    $sql = "select * from users where email = '$email'";
    $res = mysqli_query($db, $sql);
    $check_email = mysqli_num_rows($res);
    $email_data = mysqli_fetch_assoc($res);

    if ($check_email > 0) {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'passmatestudentcare@gmail.com';
        $mail->Password = 'yajncncenlhsalxs'; // Your Gmail Password Of Sending Email Id Or Account
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('passmatestudentcare@gmail.com');
        $mail->addAddress($_POST['email']); // Add a recipient

        $mail->isHTML(true);

        $email_user_id = $email_data['user_id'];
        $mail->Subject = $_POST['subject'];
        $mail->Body = "<button><a href='http://localhost/projects/pass/users/changepass_form.php?update_pass=$email_user_id'>Change Password</a></button>";
        $mail->send();

        echo "
        <script>alert('Send Mail successFully');
          document.location.href = 'change_password.php'</script>
    
         ";
    } else {
        echo "<script>
              alert('Email Not Exist');

              window.location.href = 'forgot_password.php';
              </script>
           ";
    }

}

?>

<!-- <button><a href="http://localhost/projects/pass/users/changepass_form.php?update_pass=<?php echo $email_data['user_id'];?>">Change Password</a></button> -->