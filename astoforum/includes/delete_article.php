<?php
session_start();
$connect = "";
include 'connectdb.php';

if (isset($_POST['delete_article']) && isset($_SESSION['user'])) {
    $article_id = $_GET['id'];
    $article = mysqli_query($connect, "SELECT * FROM article WHERE id = '$article_id'") or die(mysqli_error($connect));
    $article_info = mysqli_fetch_assoc($article);
    $topic_id = $article_info['topic_id'];
    $article_title = $article_info['title'];
    $prohibited_symbols = array('/','\\', '?', ':','*', '<', '>', '"', '|');
    $right_title = str_replace($prohibited_symbols, '', $article_title);
    unlink('../img/uploads/article_texts/' . $right_title . '.txt');

    mysqli_query($connect, "CALL delete_article('$article_id')") or die(mysqli_error($connect));
    $_SESSION['message_delete_article'] = "<p>Статья была успешно удалена</p>";
    header('Location: ../pages/articles.php?id=' . $topic_id);
}

