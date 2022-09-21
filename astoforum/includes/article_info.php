<?php
$connect = "";
include 'connectdb.php';
$article_id = $_GET['id'];

$article = mysqli_query($connect, "SELECT * FROM article_info WHERE id = '$article_id'") or die(mysqli_error($connect));
$article_info = mysqli_fetch_assoc($article);
$title = $article_info['title'];
$picture = '../' . $article_info['picture'];
$author_first_name = $article_info['first_name'];
$author_last_name = $article_info['last_name'];
$author_id = $article_info['author_id'];
$author_avatar = '../' . $article_info['avatar'];
$content = $article_info['content'];

date_default_timezone_set('Europe/Moscow');

$prohibited_symbols = array('/','\\', '?', ':','*', '<', '>', '"', '|');
$right_title = str_replace($prohibited_symbols, '', $title);
$file_name = '../img/uploads/article_texts/' . $right_title . '.txt';
$file_text = "Автор статьи: $author_first_name $author_last_name

$title

$content";

$fp = fopen("$file_name", "w");
fwrite($fp, $file_text);
fclose($fp);

echo "<div class='article-title'>
          <img src='$picture'>
          <div class='title-text'>
               <h1>$title</h1>
               <div class='additional-info'>
                     <div class='author-block'>
                          <div class='author-avatar'>
                               <img src='$author_avatar'>
                           </div>
                           <p><a class='profile-link-light' href='../pages/profile.php?id=$author_id'>$author_first_name<br>$author_last_name</a></p>
                     </div>
                     <div class='time-to-read'>
                          <div class='time-icon'></div>
                          <p>Время прочтения: <span>0</span> мин</p>
                     </div>
               </div>
          </div>
      </div>
      <div class='article-text'>
           <pre>$content</pre>
           <a href='$file_name' class='download-link' download>Скачать статью</a>
      </div>";
