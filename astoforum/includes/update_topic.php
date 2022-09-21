<?php
session_start();
$connect = "";
include 'connectdb.php';

if (isset($_GET['id'])) {
    $topic_id = $_GET['id'];
    $topic = mysqli_query($connect, "SELECT * FROM topic WHERE id = '$topic_id'") or die(mysqli_error($connect));
    $topic_info = mysqli_fetch_assoc($topic);
    $title = $topic_info['title'];
    $path = $topic_info['picture'];

    $new_title = $_POST['title'];
    if (isset($_POST['delete_picture'])) {
        $delete_picture = $_POST['delete_picture'];
    }

    if (isset($_FILES['new_picture']['name']) && $_FILES['new_picture']['name']) {
        date_default_timezone_set('Europe/Moscow');
        $path = 'img/uploads/topic_pictures/' . date("d.m.Y_H-i-s", time()) . '_' . $_FILES['new_picture']['name'];
        if (!move_uploaded_file($_FILES['new_picture']['tmp_name'], '../' . $path)) {
            $_SESSION['error_upload_avatar'] = "<p>Произошла ошибка при загрузке файла!<br>Попробуйте снова.</p>";
            header("Location: ../pages/topics.php");
        } else {
            if ($topic_info['picture'] !== 'img/icons/topic-picture.jpg') {
                unlink('../' . $topic_info['picture']);
            }
        }
    } else if (isset($delete_picture)) {
        if ($topic_info['picture'] !== 'img/icons/topic-picture.jpg') {
            unlink('../' . $topic_info['picture']);
        }
        $path = 'img/icons/topic-picture.jpg';
    }

    mysqli_query($connect, "CALL update_topic('$topic_id', '$new_title', '$path')") or die(mysqli_error($connect));
    header('Location: ../pages/topics.php');
}
