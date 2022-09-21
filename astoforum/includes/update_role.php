<?php
session_start();
$connect = "";
include 'connectdb.php';

if(isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $new_role_id = $_POST['role'];
    mysqli_query($connect, "CALL update_user_role('$user_id', '$new_role_id')") or die(mysqli_error($connect));
    header("Location: ../pages/profile.php?id=" . $_SESSION['user']['user_id']);
}
