<?php
session_start();
$connect = "";
include 'connectdb.php';

if (isset($_POST['delete_comment']) && isset($_SESSION['user'])) {
    $comment_id = $_GET['id'];
    $comment = mysqli_query($connect, "SELECT * FROM comment_info WHERE id = '$comment_id'") or die(mysqli_error($connect));
    $comment_info = mysqli_fetch_assoc($comment);
    $article_id = $comment_info['article_id'];

    mysqli_query($connect, "CALL delete_comment('$comment_id')") or die(mysqli_error($connect));
    $_SESSION['message_delete_comment'] = "<p>Комментарий был успешно удален</p>";
    header("Location: ../pages/article.php?id=" . $article_id);
}

