<?php
$connect = "";
include 'connectdb.php';
if ($_SESSION['user']['role_id'] === '1') {
    $email = $_SESSION['user']['email'];
    $result = mysqli_query($connect, "SELECT id, avatar, last_name, first_name, email, phone, role_id, role_value, date_registration FROM user_info WHERE email NOT LIKE '$email'") or die(mysqli_error($connect));
    $is_empty = true;

    while ($row = $result->fetch_assoc())
    {
        $is_empty = false;
        $user_id = $row['id'];
        $avatar = '../' . $row['avatar'];
        $last_name = $row['last_name'];
        $first_name = $row['first_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $role_value = $row['role_value'];
        $role_id = $row['role_id'];
        $date_registration = date('d.m.Y', strtotime($row['date_registration']));

        echo "              <li class='user-item'>
                                <div class='user-info-block'>
                                <div class='user-info-block drop-list'>
                                    <div class='main-info'>
                                        <div class='author-avatar'>
                                            <img src='$avatar'>
                                        </div>
                                        <p><a class='profile-link-dark' href='../pages/profile.php?id=$user_id'>$last_name $first_name</a><br><i>Дата регистрации: $date_registration</i></p>
                                    </div>
                                    <p>$email</p>
                                    <p>$phone</p>
                                    <p>$role_value</p>
                                    </div>
                                    <div class='delete-update-button-block'>
                                        <a href='#popup-delete' data-id='$user_id' title='Удалить' class='button delete popup-link popup-delete-from'></a>
                                        <a href='#popup_update_role' data-id='$user_id' title='Редактировать' class='button update popup-link popup-update-from'></a>
                                    </div>
                                </div>
                                <ul class='user-articles-list submenu-list'>
                                    <li>
                                        <div class='article'>
                                            <div class='article-icon'>
                                                <img src='../img/icons/topic1.jpg'>
                                            </div>
                                            <div class='article-title-block'>
                                                <h3>Земля стала вращаться быстрее</h3>
                                                <div class='arrow'></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class='article'>
                                            <div class='article-icon'>
                                                <img src='../img/icons/topic2.jpg'>
                                            </div>
                                            <div class='article-title-block'>
                                                <h3>Как представлять себе расширение Вселенной?</h3>
                                                <a class='arrow' href='#'></a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
              ";
    }
    if($is_empty) {
        echo "<p class='empty'>Тут пока пусто</p>";
    }

}

