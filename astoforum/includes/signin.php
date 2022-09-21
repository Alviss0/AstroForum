<?php
session_start();
$connect = "";
include 'connectdb.php';

if (isset($_POST['sign_in'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    setcookie('email', $email, time() + 60 * 5, '/');
    $_COOKIE['email'] = $email;
    setcookie('password', $password, time() + 60 * 5, '/');
    $_COOKIE['password'] = $password;

    $users_count = mysqli_query($connect, "SELECT COUNT(*) AS user_cnt FROM user_info WHERE (email = '$email' AND password = '$password')") or die(mysqli_error($connect));
    $count = mysqli_fetch_assoc($users_count);

    if ($count['user_cnt'] > 0) {

        $user = mysqli_query($connect, "SELECT * FROM user_info WHERE email = '$email'") or die(mysqli_error($connect));
        $user_info = mysqli_fetch_assoc($user);

            $_SESSION["user"] = [
                'user_id' => $user_info['id'],
                'email' => $user_info['email'],
                'last_name' => $user_info['last_name'],
                'first_name' => $user_info['first_name'],
                'gender_id' => $user_info['gender_id'],
                'gender_value' => $user_info['gender_value'],
                'age' => $user_info['age'],
                'phone' => $user_info['phone'],
                'avatar' => $user_info['avatar'],
                'role_id' => $user_info['role_id'],
                'role_value' => $user_info['role_value'],
                'about' => $user_info['about'],
                'date_registration' => date('d.m.Y', strtotime($user_info['date_registration']))
            ];

        setcookie('email', $email, time() - 1, '/');
        setcookie('password', $password, time() - 1, '/');
        header("Location: ../pages/profile.php?id="  . $_SESSION['user']['user_id']);
    } else {
        $_SESSION['error_authorization'] = "<p>Логин или пароль неверные!<br>Попробуйте снова или зарегистрируйтесь.</p>";
        header("Location: ../pages/authorization.php");
    }
}