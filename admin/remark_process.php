<?php

include("db.php");


// Send Remark Msg TO User {

$email = $_REQUEST['user'];
$msg = $_REQUEST['message'];
$sender = $_REQUEST['sender'];
$form_id = $_REQUEST['form_id'];
$remark = $_REQUEST['remark'];
$remarkString = implode(',', $remark);

$sql1 = "insert into notification(user,message,sender,remark,form_id) values('$email','$msg','$sender','$remarkString','$form_id')";
$remark = mysqli_query($db, $sql1);

if($remark){

    $sql2 = "update train_forms set status='Remark' where email = '$email'";
    $status = mysqli_query($db,$sql2);
    header("location:train_form.php");

}
else {
    echo "Failed To Remark Send ! Please Try Again";
}



?>