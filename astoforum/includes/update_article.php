<?php
session_start();
$connect = "";
include 'connectdb.php';

if(isset($_GET['id'])) {
    $article_id = $_GET['id'];
    $article = mysqli_query($connect, "SELECT * FROM article WHERE id = '$article_id'") or die(mysqli_error($connect));
    $article_info = mysqli_fetch_assoc($article);
    $topic_id = $article_info['topic_id'];
    $last_article_title = $article_info['title'];
    $path = $article_info['picture'];
    date_default_timezone_set('Europe/Moscow');
    $date = date("Y-m-d H:i:s", time());

    $article_title = $_POST['title'];
    $article_text = $_POST['article_text'];
    if (isset($_POST['delete_picture'])) {
        $delete_picture = $_POST['delete_picture'];
    }
    if (isset($_FILES['new_picture']['name']) && $_FILES['new_picture']['name']) {
        $path = 'img/uploads/article_pictures/' . date("d.m.Y_H-i-s", time()) . '_' . $_FILES['new_picture']['name'];
        if (!move_uploaded_file($_FILES['new_picture']['tmp_name'], '../' . $path)) {
            $_SESSION['error_upload_article_picture'] = "<p>Произошла ошибка при загрузке файла!<br>Попробуйте снова.</p>";
            header("Location: ../pages/articles.php?id=" . $topic_id);
        } else {
            if ($article_info['picture'] !== 'img/icons/article-picture.jpg') {
                unlink('../' . $article_info['picture']);
            }
        }
    } else if (isset($delete_picture)) {
        if ($article_info['picture'] !== 'img/icons/article-picture.jpg') {
            unlink('../' . $article_info['picture']);
        }
        $path = 'img/icons/article-picture.jpg';
    }

    $prohibited_symbols = array('/','\\', '?', ':','*', '<', '>', '"', '|');
    $right_title = str_replace($prohibited_symbols, '', $last_article_title);
    unlink('../img/uploads/article_texts/' . $right_title . '.txt');

    mysqli_query($connect, "CALL update_article('$article_id', '$article_title', '$path', '$date', '$article_text')") or die(mysqli_error($connect));
    $_SESSION['message_update_article'] = "<p>Статья была успешно изменена</p>";
    header('Location: ../pages/articles.php?id=' . $topic_id);
}