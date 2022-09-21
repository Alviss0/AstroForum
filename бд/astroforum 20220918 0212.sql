--
-- Скрипт сгенерирован Devart dbForge Studio 2019 for MySQL, Версия 8.1.22.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 18.09.2022 2:12:58
-- Версия сервера: 5.7.25
-- Версия клиента: 4.1
--

-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

--
-- Удалить функцию `is_login`
--
DROP FUNCTION IF EXISTS is_login;

--
-- Удалить процедуру `delete_comment`
--
DROP PROCEDURE IF EXISTS delete_comment;

--
-- Удалить процедуру `delete_user`
--
DROP PROCEDURE IF EXISTS delete_user;

--
-- Удалить процедуру `insert_new_comment`
--
DROP PROCEDURE IF EXISTS insert_new_comment;

--
-- Удалить процедуру `insert_new_user`
--
DROP PROCEDURE IF EXISTS insert_new_user;

--
-- Удалить процедуру `update_comment`
--
DROP PROCEDURE IF EXISTS update_comment;

--
-- Удалить процедуру `update_user`
--
DROP PROCEDURE IF EXISTS update_user;

--
-- Удалить процедуру `update_user_role`
--
DROP PROCEDURE IF EXISTS update_user_role;

--
-- Удалить представление `comment_info`
--
DROP VIEW IF EXISTS comment_info CASCADE;

--
-- Удалить таблицу `comment`
--
DROP TABLE IF EXISTS comment;

--
-- Удалить представление `article_info`
--
DROP VIEW IF EXISTS article_info CASCADE;

--
-- Удалить процедуру `delete_article`
--
DROP PROCEDURE IF EXISTS delete_article;

--
-- Удалить процедуру `insert_new_article`
--
DROP PROCEDURE IF EXISTS insert_new_article;

--
-- Удалить процедуру `update_article`
--
DROP PROCEDURE IF EXISTS update_article;

--
-- Удалить таблицу `article`
--
DROP TABLE IF EXISTS article;

--
-- Удалить процедуру `delete_topic`
--
DROP PROCEDURE IF EXISTS delete_topic;

--
-- Удалить процедуру `insert_new_topic`
--
DROP PROCEDURE IF EXISTS insert_new_topic;

--
-- Удалить процедуру `update_topic`
--
DROP PROCEDURE IF EXISTS update_topic;

--
-- Удалить таблицу `topic`
--
DROP TABLE IF EXISTS topic;

--
-- Удалить представление `user_info`
--
DROP VIEW IF EXISTS user_info CASCADE;

--
-- Удалить таблицу `user`
--
DROP TABLE IF EXISTS user;

--
-- Удалить таблицу `gender`
--
DROP TABLE IF EXISTS gender;

--
-- Удалить таблицу `role`
--
DROP TABLE IF EXISTS role;

--
-- Создать таблицу `role`
--
CREATE TABLE role (
  id int(11) NOT NULL AUTO_INCREMENT,
  value varchar(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 3,
AVG_ROW_LENGTH = 8192,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать таблицу `gender`
--
CREATE TABLE gender (
  id int(11) NOT NULL AUTO_INCREMENT,
  value varchar(255) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 3,
AVG_ROW_LENGTH = 8192,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать таблицу `user`
--
CREATE TABLE user (
  id int(11) NOT NULL AUTO_INCREMENT,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  first_name varchar(255) NOT NULL,
  gender_id int(11) NOT NULL,
  age int(11) DEFAULT NULL,
  phone varchar(255) NOT NULL,
  avatar varchar(500) NOT NULL,
  role_id int(11) NOT NULL,
  about varchar(5000) DEFAULT NULL,
  date_registration date NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 31,
AVG_ROW_LENGTH = 8192,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать индекс `email` для объекта типа таблица `user`
--
ALTER TABLE user
ADD UNIQUE INDEX email (email);

--
-- Создать индекс `email_2` для объекта типа таблица `user`
--
ALTER TABLE user
ADD UNIQUE INDEX email_2 (email);

--
-- Создать внешний ключ
--
ALTER TABLE user
ADD CONSTRAINT FK_user_gender_id FOREIGN KEY (gender_id)
REFERENCES gender (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Создать внешний ключ
--
ALTER TABLE user
ADD CONSTRAINT FK_user_role_id FOREIGN KEY (role_id)
REFERENCES role (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Создать представление `user_info`
--
CREATE
VIEW user_info
AS
SELECT
  `user`.`id` AS `id`,
  `user`.`email` AS `email`,
  `user`.`password` AS `password`,
  `user`.`last_name` AS `last_name`,
  `user`.`first_name` AS `first_name`,
  `user`.`gender_id` AS `gender_id`,
  `user`.`age` AS `age`,
  `user`.`phone` AS `phone`,
  `user`.`avatar` AS `avatar`,
  `user`.`role_id` AS `role_id`,
  `user`.`about` AS `about`,
  `role`.`value` AS `role_value`,
  `gender`.`value` AS `gender_value`,
  `user`.`date_registration` AS `date_registration`
FROM ((`user`
  JOIN `gender`
    ON ((`user`.`gender_id` = `gender`.`id`)))
  JOIN `role`
    ON ((`user`.`role_id` = `role`.`id`)));

--
-- Создать таблицу `topic`
--
CREATE TABLE topic (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  picture varchar(500) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 12,
AVG_ROW_LENGTH = 4096,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

DELIMITER $$

--
-- Создать процедуру `update_topic`
--
CREATE PROCEDURE update_topic (IN _id int(11), _new_title varchar(255), _new_picture varchar(500))
BEGIN

  UPDATE topic
  SET title = _new_title,
      picture = _new_picture
  WHERE id = _id;

END
$$

--
-- Создать процедуру `insert_new_topic`
--
CREATE PROCEDURE insert_new_topic (IN _title varchar(255), _picture varchar(500))
BEGIN

  INSERT INTO topic (title, picture)
    VALUES (_title, _picture);

END
$$

--
-- Создать процедуру `delete_topic`
--
CREATE PROCEDURE delete_topic (IN _id int(11))
BEGIN

  DELETE
    FROM topic
  WHERE id = _id;

END
$$

DELIMITER ;

--
-- Создать таблицу `article`
--
CREATE TABLE article (
  id int(11) NOT NULL AUTO_INCREMENT,
  topic_id int(11) NOT NULL,
  picture varchar(500) NOT NULL,
  title varchar(255) NOT NULL,
  content varchar(10000) NOT NULL,
  author_id int(11) NOT NULL,
  date datetime NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 11,
AVG_ROW_LENGTH = 8192,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать внешний ключ
--
ALTER TABLE article
ADD CONSTRAINT FK_article_topic_id FOREIGN KEY (topic_id)
REFERENCES topic (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Создать внешний ключ
--
ALTER TABLE article
ADD CONSTRAINT FK_article_user_id FOREIGN KEY (author_id)
REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$

--
-- Создать процедуру `update_article`
--
CREATE PROCEDURE update_article (IN _id int(11), _title varchar(255), _picture varchar(500), _date datetime, _content varchar(10000))
BEGIN

  UPDATE article
  SET title = _title,
      picture = _picture,
      date = _date,
      content = _content
  WHERE id = _id;

END
$$

--
-- Создать процедуру `insert_new_article`
--
CREATE PROCEDURE insert_new_article (IN
_topic_id int(11),
_title varchar(255),
_picture varchar(500),
_content varchar(10000),
_author_id int(11),
_date datetime)
BEGIN

  INSERT INTO article (topic_id, title, picture, content, author_id, date)
    VALUES (_topic_id, _title, _picture, _content, _author_id, _date);

END
$$

--
-- Создать процедуру `delete_article`
--
CREATE PROCEDURE delete_article (IN _id int(11))
BEGIN

  DELETE
    FROM article
  WHERE id = _id;

END
$$

DELIMITER ;

--
-- Создать представление `article_info`
--
CREATE
VIEW article_info
AS
SELECT
  `article`.`id` AS `id`,
  `article`.`topic_id` AS `topic_id`,
  `article`.`picture` AS `picture`,
  `article`.`title` AS `title`,
  `article`.`content` AS `content`,
  `article`.`author_id` AS `author_id`,
  `article`.`date` AS `date`,
  `user`.`last_name` AS `last_name`,
  `user`.`first_name` AS `first_name`,
  `topic`.`title` AS `topic_title`,
  `user`.`avatar` AS `avatar`
FROM ((`article`
  JOIN `user`
    ON ((`article`.`author_id` = `user`.`id`)))
  JOIN `topic`
    ON ((`article`.`topic_id` = `topic`.`id`)))
ORDER BY `article`.`date` DESC;

--
-- Создать таблицу `comment`
--
CREATE TABLE comment (
  id int(11) NOT NULL AUTO_INCREMENT,
  author_id int(11) NOT NULL,
  article_id int(11) NOT NULL,
  date datetime NOT NULL,
  content varchar(2000) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB,
AUTO_INCREMENT = 26,
AVG_ROW_LENGTH = 5461,
CHARACTER SET utf8,
COLLATE utf8_general_ci;

--
-- Создать внешний ключ
--
ALTER TABLE comment
ADD CONSTRAINT FK_comment_article_id FOREIGN KEY (article_id)
REFERENCES article (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Создать внешний ключ
--
ALTER TABLE comment
ADD CONSTRAINT FK_comment_user_id FOREIGN KEY (author_id)
REFERENCES user (id) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Создать представление `comment_info`
--
CREATE
VIEW comment_info
AS
SELECT
  `comment`.`id` AS `id`,
  `comment`.`author_id` AS `author_id`,
  `comment`.`article_id` AS `article_id`,
  `comment`.`date` AS `date`,
  `comment`.`content` AS `content`,
  `user`.`last_name` AS `last_name`,
  `user`.`first_name` AS `first_name`,
  `user`.`avatar` AS `avatar`,
  `article`.`title` AS `article_title`,
  `topic`.`title` AS `topic_title`,
  `article`.`topic_id` AS `topic_id`
FROM (((`comment`
  JOIN `user`
    ON ((`comment`.`author_id` = `user`.`id`)))
  JOIN `article`
    ON ((`comment`.`article_id` = `article`.`id`)))
  JOIN `topic`
    ON ((`article`.`topic_id` = `topic`.`id`)));

DELIMITER $$

--
-- Создать процедуру `update_user_role`
--
CREATE PROCEDURE update_user_role (IN _id int(11), _role_id int(11))
BEGIN

  UPDATE user
  SET role_id = _role_id
  WHERE id = _id;

END
$$

--
-- Создать процедуру `update_user`
--
CREATE PROCEDURE update_user (IN
_id int(11),
_new_email varchar(255),
_last_name varchar(255),
_first_name varchar(255),
_gender_id int(11),
_age int(11),
_phone varchar(255),
_avatar varchar(500),
_about varchar(5000))
BEGIN

  UPDATE user
  SET email = _new_email,
      last_name = _last_name,
      first_name = _first_name,
      gender_id = _gender_id,
      age = _age,
      phone = _phone,
      avatar = _avatar,
      about = _about
  WHERE id = _id;

END
$$

--
-- Создать процедуру `update_comment`
--
CREATE PROCEDURE update_comment (IN _id int(11), _date datetime, _content varchar(2000))
BEGIN

  UPDATE comment
  SET content = _content,
      date = _date
  WHERE id = _id;

END
$$

--
-- Создать процедуру `insert_new_user`
--
CREATE PROCEDURE insert_new_user (IN
_email varchar(255),
_password varchar(255),
_last_name varchar(255),
_first_name varchar(255),
_gender_id int(11),
_age int(11),
_phone varchar(255),
_avatar varchar(500),
_role_id int(11),
_about varchar(5000),
_date_registration date)
BEGIN

  INSERT INTO user (email, password, last_name, first_name, gender_id, age, phone, avatar, role_id, about, date_registration)
    VALUES (_email, _password, _last_name, _first_name, _gender_id, _age, _phone, _avatar, _role_id, _about, _date_registration);

END
$$

--
-- Создать процедуру `insert_new_comment`
--
CREATE PROCEDURE insert_new_comment (IN _author_id int(11), _article_id int(11), _date datetime, _content varchar(2000))
BEGIN

  INSERT INTO comment (author_id, article_id, date, content)
    VALUES (_author_id, _article_id, _date, _content);

END
$$

--
-- Создать процедуру `delete_user`
--
CREATE PROCEDURE delete_user (IN _email varchar(255))
BEGIN

  DELETE
    FROM user
  WHERE email = _email;

END
$$

--
-- Создать процедуру `delete_comment`
--
CREATE PROCEDURE delete_comment (IN _id int(11))
BEGIN

  DELETE
    FROM comment
  WHERE id = _id;

END
$$

--
-- Создать функцию `is_login`
--
CREATE FUNCTION is_login (_email varchar(255))
RETURNS int(11)
BEGIN
  DECLARE is_exist int;
  SELECT
    COUNT(*) INTO is_exist
  FROM user
  WHERE (email = _email);
  RETURN is_exist;
END
$$

DELIMITER ;

-- 
-- Вывод данных для таблицы role
--
INSERT INTO role VALUES
(1, 'администратор'),
(2, 'пользователь');

-- 
-- Вывод данных для таблицы gender
--
INSERT INTO gender VALUES
(1, 'мужской'),
(2, 'женский');

-- 
-- Вывод данных для таблицы topic
--
INSERT INTO topic VALUES
(4, 'Теоретическая астрономия', 'img/uploads/topic_pictures/02.09.2022_20-36-43_bbb.jpg'),
(5, 'Астрономическое оборудование', 'img/uploads/topic_pictures/02.09.2022_20-36-53_topic4.jpg'),
(8, 'Практическая астрономия', 'img/uploads/topic_pictures/02.09.2022_20-37-09_article3.jpg'),
(10, 'Общие сведения', 'img/uploads/topic_pictures/02.09.2022_20-36-00_topic2.jpg');

-- 
-- Вывод данных для таблицы user
--
INSERT INTO user VALUES
(25, 'spectrumrrr@gmail.com', '123', 'Петров', 'Петр', 1, 21, '89221243851', 'img/uploads/user_avatars/02.09.2022_01-01-00_aaa.jpg', 1, '', '2022-08-31'),
(28, 'borisova@mail.ru', '123', 'Борисова', 'Юлия', 2, 24, '456546', 'img/uploads/user_avatars/01.09.2022_18-54-53_topic3.jpg', 2, 'я Юля', '2022-09-01');

-- 
-- Вывод данных для таблицы article
--
INSERT INTO article VALUES
(2, 10, 'img/uploads/article_pictures/02.09.2022_21-47-36_article4.jpg', 'Как представлять себе расширение Вселенной?', 'Сразу скажу, что интерес у меня к этому вопросу не умозрительный, а сугубо практический, связанный с идеями по моделированию возникновения первых протозвёзд во Вселенной. Представлять себе расширение Вселенной можно двумя способами. Будем считать, что на наблюдаемом масштабе пространства Вселенная глобально плоская.\r\n\r\nСпособ первый,  геометрический. Представим себе, что мы живём на поверхности гигантской трёхмерной сферы, вложенной в четырёхмерное пространство. И радиус этой сферы понемногу увеличивается. Кому не нравится аналогия с трёхмерной сферой, пусть представляет, что мы живём в гигантском трёхмерном торе (который можно представить себе как периодический трёхмерный куб). При этом способе представления на нашем локальном участке Вселенной ничего не происходит. Вселенная расширяется где-то там далеко и на местном масштабе это нас особо не касается.\r\n\r\nСпособ второй, физический. Представим себе, что Вселенная составлена из мельчайших частиц вакуума. Эти частицы обладают ненулевой энергией и возникают повсюду здесь и сейчас, расталкивая при этом пространство. В этом случае мы можем локально наблюдать некоторые эффекты, которые в силу своей малости заметить за небольшое время мы не можем.\r\n\r\nЭти два способа различаются не только представлением у нас в голове, а сугубо физически. Представим себе в космосе два зеркала и между ними туда сюда бегает свет. При первом способе представления ничего не произойдёт. При втором способе и зеркала раздвинутся друг от друга подальше, и свет потеряет свою энергию просто потому, что Вселенная расширяется. При этом способе представления закон сохранения энергии не действует.\r\n\r\nОпять же напомню, что интерес у меня чисто практический, поскольку первичная концентрация материи может быть связана с потерей или приобретением энергии. Но настоятельно прошу этого вопроса в этой теме не касаться.     ', 25, '2022-09-02 00:00:00'),
(3, 5, 'img/uploads/article_pictures/17.09.2022_21-56-44_topic4.jpg', 'Аберрация сферического вогнутого зеркала', 'В нескольких книгах по телескопам например: Сикорук Телескопы для любителей астрономии и подобных неоднократно мусолят что для\r\nвизуальных телескопов нужен учет волновой аберрации.Как следствие сделаны таблицы с рекомендациями отношения диаметра к фокусу сферических зеркал для визуально безупречной картинки.\r\nГлянем на расчет аберраций:\r\n\r\nВизуально видно, что нужен учет самой большой аберрации сферической продольной а не волновой.\r\nВо-первых она самая большая, во вторых остальные это ее следствие и вообще разве не нужно стремление сделать фокус зеркала на плоскости?\r\nВ итоге как пример "отличного" оптического зеркала из\r\nкниги Сикорук Телескопы для любителей астрономии Стр 132.\r\n\r\nЧто это за астрономическое зеркало D=250 мм фокус которого гуляет на 5 мм?\r\nО каком фокусе речь? Участок зеркала 10 мм диаметром там размазывает луч на всю матрицу 5 на 5 мм с пикселем 5 мкм.\r\nВ оптике для расчета зеркал падающий луч принят параллельный с плоским фронтом?\r\nТогда если в этом участке зеркала светит очень яркий источник, то он засветит всю матрицу. Почему такие дичайшие искажения это названо "безупречное зеркало"? Почему такие аберрации годны для визуального наблюдения? Разве не нужно стремиться чтобы зеркало строило подобное изображение на плоскости с максимальной продольной аберрацией меньше четверти волны используемого света?\r\n\r\nМожет добиваются чтобы продольная аберрация строила изображение на вогнутой поверхности сетчатки? Тогда продольная должна рисовать окружность к примеру, а не быть любой кривой в пределах допуска.\r\n\r\n', 25, '2022-09-18 00:00:03'),
(4, 10, 'img/icons/article-picture.jpg', 'Земля стала вращаться быстрее и никто не знает почему', 'Недавно учёные зафиксировали самый короткий день на Земле с момента начала отслеживания продолжительности суток с помощью атомных часов. Согласно имеющимся данным, 29 июня 2022 года Земля совершила оборот вокруг своей оси на 1,59 миллисекунды быстрее 24 часов.\r\n\r\nСутки длятся 24 часа, потому что Земля совершает полный оборот вокруг своей оси примерно каждые 86 400 000 миллисекунд. В краткосрочной перспективе скорость вращения может колебаться на доли миллисекунд изо дня в день. Это означает, что продолжительность дня может изменяться, но обычно лишь незначительно. Наша планета также переживает долгосрочные изменения. Ранее было замечено, что планета вращается медленнее, и для завершения суток требуется больше времени. По мнению учёных, с каждым столетием скорость вращения планеты снижается на несколько миллисекунд.\r\n\r\nОднако в последние годы эта долгосрочная тенденция изменилась. Скорость вращения Земли растёт, и ей требуется всё меньше времени для завершения полного оборота. Это означает, что продолжительность суток сокращается. В декабре 2020 года портал Time and Date сообщил, что в течение года Земля пережила 28 самых коротких суток с момента начала использования атомных часов для отслеживания продолжительности суток в 1960-х годах. Рекордно короткий день был зафиксирован 19 июля 2020 года, когда Земля завершила оборот на 1,47 миллисекунды быстрее 24 часов. Это значение оставалось рекордным до 29 июня 2022 года, когда земные сутки завершились на 1,59 миллисекунды быстрее положенного.\r\n\r\nУ учёных есть несколько версий относительно того, по каким причинам скорость вращения Земли увеличилась. Предполагается, что на это могут влиять разные процессы, происходящие на Земле, во внешних слоях атмосферы, океанах, климате и др. Также существует версия, согласно которой вращение Земли ускорилось вслед за неравномерным движением географических полюсов планеты и её оси вращения. Если тенденция к ускорению вращения Земли сохранится, учёным придётся отнять секунду от показаний атомных часов, чего прежде ещё никогда не делалось.', 28, '2022-09-02 00:00:00'),
(5, 5, 'img/icons/article-picture.jpg', 'Как представлять себе расширение Вселенной?', 'Недавно учёные зафиксировали самый короткий день на Земле с момента начала отслеживания продолжительности суток с помощью атомных часов. Согласно имеющимся данным, 29 июня 2022 года Земля совершила оборот вокруг своей оси на 1,59 миллисекунды быстрее 24 часов.\r\n\r\n Источник изображения: Reid Wiseman / NASA \r\nИсточник изображения: Reid Wiseman / NASA\r\nСутки длятся 24 часа, потому что Земля совершает полный оборот вокруг своей оси примерно каждые 86 400 000 миллисекунд. В краткосрочной перспективе скорость вращения может колебаться на доли миллисекунд изо дня в день. Это означает, что продолжительность дня может изменяться, но обычно лишь незначительно. Наша планета также переживает долгосрочные изменения. Ранее было замечено, что планета вращается медленнее, и для завершения суток требуется больше времени. По мнению учёных, с каждым столетием скорость вращения планеты снижается на несколько миллисекунд.\r\n\r\nОднако в последние годы эта долгосрочная тенденция изменилась. Скорость вращения Земли растёт, и ей требуется всё меньше времени для завершения полного оборота. Это означает, что продолжительность суток сокращается. В декабре 2020 года портал Time and Date сообщил, что в течение года Земля пережила 28 самых коротких суток с момента начала использования атомных часов для отслеживания продолжительности суток в 1960-х годах. Рекордно короткий день был зафиксирован 19 июля 2020 года, когда Земля завершила оборот на 1,47 миллисекунды быстрее 24 часов. Это значение оставалось рекордным до 29 июня 2022 года, когда земные сутки завершились на 1,59 миллисекунды быстрее положенного.\r\n\r\nУ учёных есть несколько версий относительно того, по каким причинам скорость вращения Земли увеличилась. Предполагается, что на это могут влиять разные процессы, происходящие на Земле, во внешних слоях атмосферы, океанах, климате и др. Также существует версия, согласно которой вращение Земли ускорилось вслед за неравномерным движением географических полюсов планеты и её оси вращения. Если тенденция к ускорению вращения Земли сохранится, учёным придётся отнять секунду от показаний атомных часов, чего прежде ещё никогда не делалось.', 28, '2022-09-18 00:11:25'),
(7, 4, 'img/uploads/article_pictures/17.09.2022_23-58-21_article1.jpg', 'ddddd', 'ddddd', 25, '2022-09-17 23:58:21');

-- 
-- Вывод данных для таблицы comment
--
INSERT INTO comment VALUES
(14, 25, 3, '2022-09-17 00:00:00', 'Интересно было прочитать'),
(21, 25, 7, '2022-09-17 00:00:00', 'comment');

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;