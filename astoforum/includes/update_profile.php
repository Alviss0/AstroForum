<?php
session_start();
$connect = "";
include 'connectdb.php';

if (isset($_POST['update-user'])) {
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $about = $_POST["about"];
    $phone = $_POST["phone"];
    $email = $_SESSION['user']['email'];
    $new_email = $_POST["email"];
    if (isset($_POST['delete_avatar'])) {
        $delete_avatar = $_POST['delete_avatar'];
    }
    $new_avatar = $_FILES['new_avatar']['name'];
    $role_id = $_SESSION['user']['role_id'];
    $role = $_SESSION['user']['role_value'];
    $user_id = $_SESSION['user']['user_id'];
    $date_registration = $_SESSION['user']['date_registration'];
    $path = $_SESSION['user']['avatar'];

    if (isset($_FILES['new_avatar']['name']) && $_FILES['new_avatar']['name']) {
        if ($_FILES['new_avatar']['type'] === 'image/jpeg' || $_FILES['new_avatar']['type'] === 'image/png') {
            date_default_timezone_set('Europe/Moscow');
            $path = 'img/uploads/user_avatars/' . date("d.m.Y_H-i-s", time()) . '_' . $_FILES['new_avatar']['name'];
            if (!move_uploaded_file($_FILES['new_avatar']['tmp_name'], '../' . $path)) {
                $_SESSION['error_upload_avatar'] = "<p>Произошла ошибка при загрузке файла!<br>Попробуйте снова.</p>";
                header("Location: ../pages/profile.php");
            } else {
                if ($_SESSION['user']['avatar'] !== 'img/icons/user_male.png' && $_SESSION['user']['avatar'] !== 'img/icons/user_female.png') {
                    unlink('../' . $_SESSION['user']['avatar']);
                }
            }
        } else {
            $_SESSION['wrong_avatar_extension'] = "<p>Недопустимое расширение файла аватара!<br>Вы можете использовать файлы с расширением .jpg, .jpeg, .png.</p>";
            header("Location: ../pages/profile.php");
        }
    } else if (isset($_POST['delete_avatar'])) {
         //else {
            unlink('../' . $_SESSION['user']['avatar']);
            if ($gender == 1) $path = 'img/icons/user_male.png';
            if ($gender == 2) $path = 'img/icons/user_female.png';
        //}
    }
    if ($_SESSION['user']['avatar'] == 'img/icons/user_male.png' || $_SESSION['user']['avatar'] == 'img/icons/user_female.png') {
        if ($gender !== $_SESSION['user']['gender_id']) {
            if ($gender == 1) $path = 'img/icons/user_male.png';
            if ($gender == 2) $path = 'img/icons/user_female.png';
        }
    }

    $can_update = true;

    if ($email !== $new_email) {
        $users_count = mysqli_query($connect, "SELECT is_login('$new_email') as user_cnt") or die(mysqli_error($connect));
        $count = mysqli_fetch_assoc($users_count);
        if ($count['user_cnt'] > 0) {
            $can_update = false;
            $_SESSION['error_double_login'] = "<p>Пользователь с таким логином уже существует!<br>Авторизуйтесь или используйте другой логин.</p>";
            header("Location: ../pages/profile.php");
        }
    }
    if ($can_update) {
        if (!isset($_POST["age"]) || $_POST["age"] == null) {
            mysqli_query($connect, "CALL update_user('$user_id', '$new_email', '$last_name', '$first_name', '$gender', null ,'$phone','$path', '$about')") or die(mysqli_error($connect));
        } else {
            mysqli_query($connect, "CALL update_user('$user_id', '$new_email', '$last_name', '$first_name', '$gender','$age','$phone','$path', '$about')") or die(mysqli_error($connect));
        }

        $user_info = mysqli_query($connect, "SELECT * FROM user_info WHERE email = '$new_email'") or die(mysqli_error($connect));
        $info = mysqli_fetch_assoc($user_info);

        $_SESSION["user"] = [
            'user_id' => $user_id,
            'email' => $info['email'],
            'last_name' => $info['last_name'],
            'first_name' => $info['first_name'],
            'gender_id' => $info['gender_id'],
            'gender_value' => $info['gender_value'],
            'age' => $info['age'],
            'phone' => $info['phone'],
            'avatar' => $info['avatar'],
            'role_id' => $role_id,
            'role_value' => $role,
            'about' => $info['about'],
            'date_registration' => $date_registration
        ];
        $_SESSION['message_successful_update'] = "<p>Изменения данных прошли успешно!</p>";
        header("Location: ../pages/profile.php?id=" . $_SESSION['user']['user_id']);
    }
}