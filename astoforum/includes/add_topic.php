<?php
$connect = '';
include 'connectdb.php';

if(isset($_POST['add_topic'])) {
    $topic_title = $_POST['topic_title'];
    if(isset($_FILES['topic_picture']['name']) && $_FILES['topic_picture']['name']) {
        date_default_timezone_set('Europe/Moscow');
        $path = 'img/uploads/topic_pictures/' . date("d.m.Y_H-i-s", time()) . '_' . $_FILES['topic_picture']['name'];
        if (!move_uploaded_file($_FILES['topic_picture']['tmp_name'], '../' . $path)) {
            $_SESSION['error_upload_avatar'] = "<p>Произошла ошибка при загрузке файла!<br>Попробуйте снова.</p>";
            header("Location: ../pages/topics.php");
        }
    }
    else {
        $path = 'img/icons/topic-picture.jpg';
    }
    mysqli_query($connect, "CALL insert_new_topic('$topic_title', '$path')") or die(mysqli_error($connect));
    $_SESSION['message_successful_add_topic'] = "<p>Новая тема добавлена.</p>";
    header("Location: ../pages/topics.php");
}
