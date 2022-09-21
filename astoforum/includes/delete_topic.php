<?php
session_start();
$connect = "";
include 'connectdb.php';

if (isset($_GET['id'])) {
    $topic_id = $_GET['id'];
    $topic = mysqli_query($connect, "SELECT * FROM topic WHERE id = '$topic_id'") or die(mysqli_error($connect));
    $topic_info = mysqli_fetch_assoc($topic);
    $topic_title = $topic_info['title'];
    $topic_picture = $topic_info['picture'];
    if($topic_picture !== 'img/icons/topic-picture.jpg') {
        unlink('../' . $topic_picture);
    }
    mysqli_query($connect, "CALL delete_topic('$topic_id')") or die(mysqli_error($connect));
    $_SESSION['message_delete_topic'] = "<p>Тема '$topic_title' была успешно удалена.</p>";
    header('Location: ../pages/topics.php');
}
