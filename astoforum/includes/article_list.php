<?php
$connect = "";
include 'connectdb.php';

if (isset($_GET['id'])) {
    $topic_id = $_GET['id'];
    $result = mysqli_query($connect, "SELECT * FROM article_info WHERE topic_id = '$topic_id'") or die(mysqli_error($connect));
    $is_empty = true;

    while ($row = $result->fetch_assoc()) {
        $is_empty = false;
        $article_id = $row['id'];
        $topic = $row['topic_title'];
        $author_id = $row['author_id'];
        $last_name = $row['last_name'];
        $first_name = $row['first_name'];
        $date = date('d.m.Y', strtotime($row['date']));
        $title = $row['title'];
        $picture = '../' . $row['picture'];
        $content = $row['content'];
        $cut_content = $content;
        if (strlen($content) > 150) {
            $cut_content = mb_substr($content, 0, 147) . '...';
        }

        echo "<div class='article-item'>
                  <div class='picture'>
                      <img src='$picture'>
                  </div>
                  <div class='article-info'>";

        if (isset($_SESSION['user']['user_id']) && ($author_id === $_SESSION['user']['user_id'] || $_SESSION['user']['role_id'] === '1')) {
            echo "<div class='delete-update-button-block'>
                       <a href='#popup-delete-article' data-id='$article_id' title='Удалить' class='button delete popup-link popup-delete-from'></a>
                       <a href='#popup-update-article' data-id='$article_id' title='Редактировать' class='button update popup-link popup-update-from' onclick='insertArticleInfo(`$title`, `$content`)'></a>
                  </div>";
        };

        echo "<p class='publish-info'>Автор: $first_name $last_name</p>
                    <p class='publish-info'>$date</p>
                    <h3>$title</h3>
                    <p>$cut_content</p>
                    <a href='./article.php?id=$article_id'>Читать</a>   
               </div>
          </div>";
    }
    if ($is_empty) {
        echo "<p class='empty'>Тут пока пусто</p>";
    }
}

