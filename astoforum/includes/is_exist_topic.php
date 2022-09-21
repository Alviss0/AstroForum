<?php

$connect = "";
include 'connectdb.php';

if(isset($_GET['id'])){
    $topic_id = $_GET['id'];
    $topic = mysqli_query($connect, "SELECT title FROM topic WHERE id = '$topic_id'") or die(mysqli_error($connect));
    $topic_info = mysqli_fetch_assoc($topic);
    $title = $topic_info['title'];
}
