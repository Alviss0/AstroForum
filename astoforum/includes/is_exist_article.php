<?php

$connect = "";
include 'connectdb.php';

if(isset($_GET['id'])){
    $article_id = $_GET['id'];
    $article = mysqli_query($connect, "SELECT title FROM article WHERE id = '$article_id'") or die(mysqli_error($connect));
    $article_info = mysqli_fetch_assoc($article);
    $article_title = $article_info['title'];
    if(isset($article_title)) {
        $topic = mysqli_query($connect, "SELECT topic_id, topic_title FROM article_info WHERE id = '$article_id'") or die(mysqli_error($connect));
        $topic_info = mysqli_fetch_assoc($topic);
        $topic_id = $topic_info['topic_id'];
        $topic_title = $topic_info['topic_title'];
    }
}
