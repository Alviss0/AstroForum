<?php
$connect = "";
include 'connectdb.php';

if (isset($_GET['id'])) {
    $profile_id = $_GET['id'];
    $profile = mysqli_query($connect, "SELECT * FROM user_info WHERE id = '$profile_id'") or die(mysqli_error($connect));
    $profile_info = mysqli_fetch_assoc($profile);
    if (isset($profile_info['id'])) {
        $avatar = '../' . $profile_info['avatar'];
        $first_name = $profile_info['first_name'];
        $last_name = $profile_info['last_name'];
        $age = $profile_info['age'];
        $gender = $profile_info['gender_value'];
        $email = $profile_info['email'];
        $phone = $profile_info['phone'];
        $about = $profile_info['about'];
        $date_registration = date('d.m.Y', strtotime($profile_info['date_registration']));
        $role_id = $profile_info['role_id'];

        echo
        "
        <div class='profile-block'>
             <div class='user-title'>
                  <div class='user-avatar'>
                       <img src='$avatar'>
                  </div>
                  <div class='user-main-info'>
                       <h1>$last_name $first_name</h1>
                       <p><b>Пол: </b>$gender</p>
                       <p><b>Возраст: </b>";
        if (!isset($age) || $age == null) {
            echo "<span class='empty' > не указан </span > ";
        } else {
            echo $age . " лет";
        }
        echo "</p>
                       <p><b>E-mail: </b>$email</p>
                       <p><b>Телефон: </b>$phone</p>
                  </div>
             </div>
             <div class='user-info'>
                  <h2>О себе:</h2>
                  <p>";
        if (!isset($about) || $about == null) {
            echo "<span class='empty' > не указано </span > ";
        } else {
            echo $about;
        }

        echo "</p>
                   <p><i>Пользователь сайта с $date_registration</i></p>
             </div>
             <div class='user-article-list'>";
        if ($profile_id === $_SESSION['user']['user_id']) {
            echo "<h2> Мои статьи:</h2>";
        } else {
            echo "<h2> Статьи автора:</h2>";
        }
        include '../includes/user_articles_list.php';
        echo "</div>";
        if ($profile_id === $_SESSION['user']['user_id']) {
            if ($role_id === '1') {
                echo "<div class='statistic-block'>
                       <h2>Статистика:</h2>
                       <ul class='users-list'>";
                include 'user_list.php';
                echo "</ul>
                   </div>";
            }
            echo "<div class='button-block'>
                        <a href='#popup-update' class='popup-link'>Редактировать профиль</a>
                        <a href='../includes/logout.php'>Выйти из профиля</a>
                        <a href='#popup-delete' class='popup-link'>Удалить аккаунт</a>
                    </div>
                </div>
";
        }
    } else {
        echo '<p class="empty">Такой страницы не существует</p>';
    }
} else {
    echo '<p class="empty">Такой страницы не существует</p>';
}
