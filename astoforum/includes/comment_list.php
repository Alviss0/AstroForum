<?php
$connect = "";
include 'connectdb.php';

$article_id = $_GET['id'];
$result = mysqli_query($connect, "SELECT * FROM comment_info WHERE article_id = '$article_id'") or die(mysqli_error($connect));
$is_empty = true;

while ($row = $result->fetch_assoc())
{
    $is_empty = false;
    $comment_id = $row['id'];
    $date = date('d.m.Y', strtotime($row['date']));
    $author_id = $row['author_id'];
    $author_avatar = '../' . $row['avatar'];
    $author_first_name = $row['first_name'];
    $author_last_name = $row['last_name'];
    $content = $row['content'];

    $id_for_update = 'comment' . $comment_id;


    echo "<div class='comment-item'>
                    <div class='comment-top'>
                            <p class='date'>$date</p>";
        if(isset($_SESSION['user']['user_id']) && ($author_id === $_SESSION['user']['user_id'] || $_SESSION['user']['role_id'] === '1')) {
            echo            "<div class='delete-update-button-block'>
                                <a href='#popup-delete-comment' data-id='$comment_id' title='Удалить' class='button delete popup-link popup-delete-from'></a>
                                <a href='#popup-update-comment' data-id='$comment_id' title='Редактировать' class='button update popup-link popup-update-from' onclick='insertCommentText($id_for_update)'></a>
                            </div>";
        };
        echo        "</div>
                        <div class='comment-author'>
                            <div class='comment-author-picture'>
                                <img src='$author_avatar'>
                            </div>
                            <p><a class='profile-link-dark' href='../pages/profile.php?id=$author_id'>$author_first_name $author_last_name</a></p>
                        </div>

                        <div id='$id_for_update' class='comment-content'>$content</div>
                   </div>";
}
if($is_empty) {
    echo "<p class='empty'>Комментариев пока нет</p>";
}

