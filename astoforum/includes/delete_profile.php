<?php
session_start();
$connect = "";
include 'connectdb.php';

if (isset($_POST['delete_user']) && isset($_SESSION['user'])) {
    if (isset($_GET['id'])) {
        $user_id_to_delete = $_GET['id'];
        $user_delete = mysqli_query($connect, "SELECT email, avatar FROM user_info WHERE id = '$user_id_to_delete'");
        $user_delete_info = mysqli_fetch_assoc($user_delete);
        $email = $user_delete_info['email'];
        $avatar = $user_delete_info['avatar'];
        if ($avatar !== 'img/icons/user_male.png' && $avatar !== 'img/icons/user_female.png') {
            unlink('../' . $avatar);
        }
        mysqli_query($connect, "CALL delete_user('$email')") or die(mysqli_error($connect));
        $_SESSION['message_delete_user'] = "<p>Аккаунт $email был успешно удален</p>";
        header('Location: ../pages/profile.php?id=' . $_SESSION['user']['user_id']);
    } else {
        $avatar = $_SESSION['user']['avatar'];
        $email = $_SESSION['user']['email'];
        if ($avatar !== 'img/icons/user_male.png' && $avatar !== 'img/icons/user_female.png') {
            unlink('../' . $_SESSION['user']['avatar']);
        }
        mysqli_query($connect, "CALL delete_user('$email')") or die(mysqli_error($connect));
        $_SESSION['message_delete_user'] = "<p>Аккаунт $email был успешно удален</p>";
        include 'logout.php';
    }
}
