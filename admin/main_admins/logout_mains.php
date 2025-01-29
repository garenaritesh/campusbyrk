<?php

session_start();
if (session_destroy()) {
    header("location:main_admin_login.php");
}

?>