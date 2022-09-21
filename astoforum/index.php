<?php
session_start();
if (isset($_SESSION['user'])) {
    $current_profile = $_SESSION['user']['user_id'];
    $link = "pages/profile.php?id=" . $current_profile;
    $name_link = "Мой профиль";
} else {
    $link = "pages/authorization.php";
    $name_link = "Войти";
}
?>
<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&amp;display=swap"
          rel="stylesheet">
    <link href="https://allfont.ru/allfont.css?fonts=a_avanteotl-heavy" rel="stylesheet" type="text/css"/>
    <link rel='stylesheet' href='css/main-style.css'>
    <link rel='stylesheet' href='css/popup-style.css'>
    <title>Astronomus</title>
</head>
<body>

<header>
    <div class='wrapper'>
        <div class='logo'>
            <img src='img/icons/logo.png'>
        </div>
        <div class='header-menu'>
            <a href='pages/news.php'>Новости</a>
            <a href='pages/topics.php'>Статьи</a>
            <a href='pages/about_us.php'>О нас</a>
            <a href='<?= $link ?>'><?= $name_link ?></a>
        </div>
    </div>
    <div class='header-bottom'>
        <div class='gradient'></div>
        <img src='img/icons/header.jpg'>
        <div class='wrapper'>
            <div class='promo-block'>
                <h1>Космос - это наше все . . .</h1>
                <p>Это наш дом. Это мы. Все, кого вы любите, все, кого вы знаете, все, о ком вы когда-либо слышали, все
                    когда-либо существовавшие люди прожили свои жизни на ней. Множество наших наслаждений и страданий,
                    тысячи самоуверенных религий, идеологий и экономических доктрин, каждый охотник и собиратель, каждый
                    созидатель и разрушитель цивилизаций, каждый святой и грешник в истории нашего вида жили здесь — на
                    соринке, подвешенной в солнечном луче.</p>
                <p>Карл Саган</p>
            </div>
        </div>
    </div>
</header>

<main>
    <div class='wrapper'>
        <div class='main-block'>
            <h1 class='background-text'>Только у нас Только у нас Только у нас Только у нас Только у нас Только у нас
                Только у нас Только у нас
                Только у нас Только у нас Только у нас Только у нас Только у нас Только у нас Только у нас Только у нас
                Только у нас Только у нас Только у нас Только у нас</h1>
            <div class='slider-block'>
                <h2>Самые интересные темы</h2>
                <div class='slider'>
                    <div class='hidden'>
                        <div class='slides' style='left: 0'>
                            <div class='slide-item'>
                                <img src='img/icons/topic1.jpg'>
                                <div class='slide-text'>
                                    <h1>Практическая астрономия</h1>
                                    <a>Подробнее</a>
                                </div>
                            </div>
                            <div class='slide-item'>
                                <img src='img/icons/topic2.jpg'>
                                <div class='slide-text'>
                                    <h1>Общие сведения</h1>
                                    <a>Подробнее</a>
                                </div>
                            </div>
                            <div class='slide-item'>
                                <img src='img/icons/topic3.jpg'>
                                <div class='slide-text'>
                                    <h1>Теоретическая астрономия</h1>
                                    <a>Подробнее</a>
                                </div>
                            </div>
                            <div class='slide-item'>
                                <img src='img/icons/topic4.jpg'>
                                <div class='slide-text'>
                                    <h1>Астрономическое оборудование</h1>
                                    <a>Подробнее</a>
                                </div>
                            </div>
                            <div class='slide-item'>
                                <img src='img/icons/topic5.jpg'>
                                <div class='slide-text'>
                                    <h1>Недавние открытия</h1>
                                    <a>Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='btn-slide slide-left'>
                        <img src='img/icons/btn-left.png'>
                    </div>
                    <div class='btn-slide slide-right'>
                        <img src='img/icons/btn-right.png'>
                    </div>
                </div>
                <h2>Лучшие научные статьи</h2>
                <div class='slider'>
                    <div class='hidden'>
                        <div class='slides'>
                            <div class='slide-item'>
                                <img src='img/icons/article1.jpg'>
                                <div class='slide-text'>
                                    <p>Автор: Максим Иванов</p>
                                    <h1>Когда Земля налетит на небесную ось или разоблачение всяких слухов</h1>
                                    <a>Подробнее</a>
                                </div>
                            </div>
                            <div class='slide-item'>
                                <img src='img/icons/article2.jpg'>
                                <div class='slide-text'>
                                    <p>Автор: Андрей Шишкин</p>
                                    <h1>Как представлять себе расширение Вселенной?</h1>
                                    <a>Подробнее</a>
                                </div>
                            </div>
                            <div class='slide-item'>
                                <img src='img/icons/article3.jpg'>
                                <div class='slide-text'>
                                    <p>Автор: Елена Степанова</p>
                                    <h1>Нерешенные астрономические загадки и вопросы</h1>
                                    <a>Подробнее</a>
                                </div>
                            </div>
                            <div class='slide-item'>
                                <img src='img/icons/article4.jpg'>
                                <div class='slide-text'>
                                    <p>Автор: Юлия Горошина</p>
                                    <h1>Земля стала вращаться быстрее</h1>
                                    <a>Подробнее</a>
                                </div>
                            </div>
                            <div class='slide-item'>
                                <img src='img/icons/article5.jpg'>
                                <div class='slide-text'>
                                    <p>Автор: Вадим Насонов</p>
                                    <h1>Автоматический длинноволновый радиотелескоп на Луне</h1>
                                    <a>Подробнее</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='btn-slide slide-left'>
                        <img src='img/icons/btn-left.png'>
                    </div>
                    <div class='btn-slide slide-right'>
                        <img src='img/icons/btn-right.png'>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer>
    <div class='wrapper'>
        <div class='footer-block'>
            <div class='footer-item'>
                <h2>Меню</h2>
                <a href='pages/news.php'>Новости</a>
                <a href='pages/topics.php'>Статьи</a>
                <a href='pages/about_us.php'>О нас</a>
                <a href='pages/authorization.php'>Вход</a>
            </div>
            <div class='logo'>
                <img src='img/icons/logo.png'>
            </div>
            <div class='footer-item'>
                <h2>Социальные сети</h2>
                <a class='social-item' href='https://vk.com'>
                    <div class='icon vk'></div>
                    <p>Vkontakte</p>
                </a>
                <a class='social-item' href='https://web.telegram.org/z/'>
                    <div class='icon telegram'></div>
                    <p>Telegram</p>
                </a>
                <a class='social-item' href='https://twitter.com/'>
                    <div class='icon twitter'></div>
                    <p>Twitter</p>
                </a>
                <a class='social-item' href='https://ru-ru.facebook.com/'>
                    <div class='icon facebook'></div>
                    <p>Facebook</p>
                </a>
            </div>
        </div>
    </div>
</footer>

<?php if (isset($_SESSION['message_delete_user'])): ?>
    <div id="popup-message" class="popup open">
        <div class="popup-body">
            <div class="popup-content popup-message">
                <a href="#" class="popup-close close-popup"></a>
                <p><?= $_SESSION['message_delete_user']; ?></p>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['message_delete_user']); endif; ?>

<script src='js/slider.js'></script>
<script src='js/cut_words.js'></script>
<script src='js/popup.js'></script>
</body>
</html>