<?php
session_start();
$connect = "";
include 'connectdb.php';

if (isset($_POST['sign_up'])) {
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $gender = $_POST["gender"];
    if ($gender == 1) {
        $path = 'img/icons/user_male.png';
    }
    if ($gender == 2) {
        $path = 'img/icons/user_female.png';
    }
    $age = $_POST["age"];
    $about_user = $_POST["about_user"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];
    $date_registration = date("Y-m-d", time());
    $role = 2;

    setcookie('last_name', $last_name, time() + 60 * 5, '/');
    setcookie('first_name', $first_name, time() + 60 * 5, '/');
    setcookie('gender', $gender, time() + 60 * 5, '/');
    setcookie('age', $age, time() + 60 * 5, '/');
    setcookie('about_user', $about_user, time() + 60 * 5, '/');
    setcookie('phone', $phone, time() + 60 * 5, '/');
    setcookie('email', $email, time() + 60 * 5, '/');
    setcookie('password', $password, time() + 60 * 5, '/');

    echo $date_registration;

    if ($password === $password_confirm) {
        if (isset($_FILES['avatar']['name']) && $_FILES['avatar']['name']) {
            if ($_FILES['avatar']['type'] === 'image/jpeg' || $_FILES['avatar']['type'] === 'image/png') {
                date_default_timezone_set('Europe/Moscow');
                $path = 'img/uploads/user_avatars/' . date("d.m.Y_H-i-s", time()) . '_' . $_FILES['avatar']['name'];
                if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
                    $_SESSION['error_upload_avatar'] = "<p>Произошла ошибка при загрузке файла!<br>Попробуйте снова.</p>";
                    header("Location: ../pages/registration.php");
                }
            } else {
                $_SESSION['wrong_avatar_extension'] = "<p>Недопустимое расширение файла аватара!<br>Вы можете использовать файлы с расширением .jpg, .jpeg, .png.</p>";
                header("Location: ../pages/registration.php");
            }
        } else {
            if ($gender == 1) {
                $path = 'img/icons/user_male.png';
            }
            if ($gender == 2) {
                $path = 'img/icons/user_female.png';
            }
        }
        $users_count = mysqli_query($connect, "SELECT is_login('$email') as user_cnt") or die(mysqli_error($connect));
        $count = mysqli_fetch_assoc($users_count);
        if ($count['user_cnt'] > 0) {
            $_SESSION['error_double_login'] = "<p>Пользователь с таким логином уже существует!<br>Авторизуйтесь или используйте другой логин.</p>";
            header("Location: ../pages/registration.php");
        } else {
            if (!isset($_POST["age"]) || $_POST["age"] == null) {
                mysqli_query($connect, "CALL insert_new_user('$email', '$password', '$last_name', '$first_name', '$gender', null ,'$phone','$path', '$role', '$about_user', '$date_registration')") or die(mysqli_error($connect));
            } else {
                mysqli_query($connect, "CALL insert_new_user('$email', '$password', '$last_name', '$first_name', '$gender','$age','$phone','$path', '$role', '$about_user', '$date_registration')") or die(mysqli_error($connect));
            }
            setcookie('last_name', $last_name, time() - 1, '/');
            setcookie('first_name', $first_name, time() - 1, '/');
            setcookie('gender', $gender, time() - 1, '/');
            setcookie('age', $age, time() - 1, '/');
            setcookie('about_user', $about_user, time() - 1, '/');
            setcookie('phone', $phone, time() - 1, '/');
            setcookie('email', $email, time() - 1, '/');
            setcookie('password', $password, time() - 1, '/');

            include '../phpmailer/PHPMailer.php';
            include '../phpmailer/SMTP.php';
            include '../phpmailer/Exception.php';

            $to = "<$email>";
            $title = "Спасибо за регистрацию на ASTROFORUM!";
            $text = "<p>Спасибо, что выбираете нас!</p>
                     <p>Мы будем стараться радовать вас новым контентом в области астрономии.</p>";

            $headers = "Content-type: text/html; charset=windows-1251 \r\n";
            $headers .= "From: От кого письмо <from@example.com>\r\n";
            $headers .= "Reply-To: reply-to@example.com\r\n";

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            try {
                $mail->isSMTP();
                $mail->CharSet = "UTF-8";
                $mail->SMTPAuth = true;
                $mail->Debugoutput = function ($str, $level) {
                    $GLOBALS['status'][] = $str;
                };

                $mail->Host = 'smtp.yandex.ru';
                $mail->Username = 'alvissonik@yandex.ru';
                $mail->Password = 'obxfodvsbnpxdrep';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('alvissonik@yandex.ru', 'Astroforum');

                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = $title;

                $mail->Body = "$text";

                if ($mail->send()) {
                    $result = "success";
                } else {
                    $result = "error";
                }
            } catch (Exception $e) {
                $result = "error";
                $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
            }

            $_SESSION['message_successful_signup'] = "<p>Регистрация прошла успешно!<br>Чтобы войти в аккаунт, авторизуйтесь.</p>";
            header("Location: ../pages/authorization.php");
        }
    } else {
        $_SESSION['wrong_password_confirm'] = "<p>Пароли не совпадают!<br>Попробуйте снова.</p>";
        header("Location: ../pages/registration.php");
    }
}
