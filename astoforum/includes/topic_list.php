<?php
$connect = "";
include 'connectdb.php';

$result = mysqli_query($connect, "SELECT * FROM topic") or die(mysqli_error($connect));
$is_empty = true;

while ($row = $result->fetch_assoc())
{
    $is_empty = false;
    $topic_id = $row['id'];
    $title = $row['title'];
    $picture = '../' . $row['picture'];

    echo "<div class='topic-item'>";
               if(isset($_SESSION['user']) && $_SESSION['user']['role_id'] === '1'):
    echo       "<div class='delete-update-button-block'>
                    <a href='#popup-delete-topic' data-id='$topic_id' class='button delete popup-link popup-delete-from' title='Удалить'></a>
                    <a href='#popup-update-topic' data-id='$topic_id' data-title='$title' class='button update popup-link popup-update-from' title='Редактировать'></a>
               </div>";
               endif;
    echo       "<img src='$picture'>
               <div class='topic-title'>
                    <h1>$title</h1>
                    <a href='./articles.php?id=$topic_id'>Подробнее</a>
               </div>
           </div>";
}
if($is_empty) {
    echo "<p class='empty'>Тут пока пусто</p>";
}

