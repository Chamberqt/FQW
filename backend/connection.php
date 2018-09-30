<?php
	$connection = mysql_connect("localhost", "admin", "admin"); //Подключение к БД ("сервер, имя_пользователя, пароль")
	$db = mysql_select_db("wrcproject"); //Выбор БД ("название БД")
	mysql_query(" SET NAMES 'utf8' "); //Выбор кодировки БД

	if(!$connection || !$db) { //Проверка подключения
		exit(mysql_error());
		echo "Подключение не удалось";
	} else {
		
	}
?>