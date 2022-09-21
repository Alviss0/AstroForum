<?php
session_start();
$connect = "";
include 'connectdb.php';

if(isset($_GET['id'])){
    $comment_id = $_GET['id'];
    $content = $_POST['comment'];
    date_default_timezone_set('Europe/Moscow');
    $date = date("Y-m-d H:i:s", time());
    $comment = mysqli_query($connect, "SELECT * FROM comment_info WHERE id = '$comment_id'") or die(mysqli_error($connect));
    $comment_info = mysqli_fetch_assoc($comment);

    $article_id = $comment_info['article_id'];

    mysqli_query($connect, "CALL update_comment('$comment_id', '$date', '$content')") or die(mysqli_error($connect));
    header("Location: ../pages/article.php?id=" . $article_id);
}
