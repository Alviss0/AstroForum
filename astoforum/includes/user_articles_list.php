<?php
$connect = "";
include 'connectdb.php';
$user_id = $_GET['id'];
$articles = mysqli_query($connect, "SELECT * FROM article_info WHERE author_id = '$user_id'") or die(mysqli_error($connect));
$is_empty = true;

while ($article = $articles->fetch_assoc())
{
    $is_empty = false;
    $article_id = $article['id'];
    $article_title = $article['title'];
    $article_content = $article['content'];
    $picture = '../' . $article['picture'];
    if (strlen($article_content) > 150) {
        $article_content = mb_substr($article_content, 0, 147) . '...';
    }

    echo "
    <div class='article-item'>
         <div class='picture'>
              <img src='$picture'>
         </div>
         <div class='article-info'>
              <h3>$article_title</h3>
              <p>$article_content</p>
              <a href='../pages/article.php?id=$article_id'>Перейти</a>
         </div>
    </div>
    ";
}
if($is_empty) {
    echo "<p class='empty'>Тут пока пусто</p>";
}

