<?php
session_start();
$connect = '';
include 'connectdb.php';

if(isset($_POST['add-comment'])) {
    $comment = $_POST['comment'];
    $article_id = $_GET['id'];
    $author_id = $_SESSION['user']['user_id'];
    date_default_timezone_set('Europe/Moscow');
    $date = date("Y-m-d H:i:s", time());

    mysqli_query($connect, "CALL insert_new_comment('$author_id', '$article_id','$date', '$comment')") or die(mysqli_error($connect));
    $_SESSION['message_successful_add_comment'] = "<p>Ваш комментарий успешно добавлен.</p>";
    header("Location: ../pages/article.php?id=" . $article_id);
}