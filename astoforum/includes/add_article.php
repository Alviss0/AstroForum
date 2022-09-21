<?php
session_start();
$connect = '';
include 'connectdb.php';

if(isset($_POST['add_article'])) {
    $topic_title = $_GET['topic'];
    $topic_id = $_GET['id'];
    $article_title = $_POST['article_title'];
    $article_text = $_POST['article_text'];
    date_default_timezone_set('Europe/Moscow');
    $date = date("Y-m-d H:i:s", time());
    $author_id = $_SESSION['user']['user_id'];
    if(isset($_FILES['article_picture']['name']) && $_FILES['article_picture']['name']) {
        $path = 'img/uploads/article_pictures/' . date("d.m.Y_H-i-s", time()) . '_' . $_FILES['article_picture']['name'];
        if (!move_uploaded_file($_FILES['article_picture']['tmp_name'], '../' . $path)) {
            $_SESSION['error_upload_avatar'] = "<p>Произошла ошибка при загрузке файла!<br>Попробуйте снова.</p>";
            header("Location: ../pages/topics.php");
        }
    }
    else {
        $path = 'img/icons/article-picture.jpg';
    }

    mysqli_query($connect, "CALL insert_new_article('$topic_id', '$article_title','$path', '$article_text', '$author_id', '$date')") or die(mysqli_error($connect));
    $_SESSION['message_successful_add_article'] = "<p>Новая статья добавлена.</p>";
    header("Location: ../pages/articles.php?id=" . $topic_id);
}