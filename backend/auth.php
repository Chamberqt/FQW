<?php session_start(); //начало сессии
require 'connection.php'; //подключение к бд

//login
if(isset($_POST['sisubmit'])) {
	if(!$_POST['silogin'] == "" && !$_POST['sipass'] == "") { //если не пустое
		$silogin = trim($_POST['silogin']); //убираем пробелы от логина
		$sipass = trim(md5($_POST['sipass']));//убираем пробелы от пароля + md5
		$query = "SELECT * FROM users WHERE email = '$silogin' AND password = '$sipass' ";
		$result = mysql_query($query);
		$res = mysql_fetch_array($result);
		if($res['email']) { //проверяем существует ли пользователь с таким email
			$_SESSION['user_id'] = $res['user_id'];
			$_SESSION['user'] = $silogin; //создаем сессию с пользователем
			echo "<script>location.href = 'http://likeagk' </script>";
		}
		else {
			mysql_error();
			print('Неверный логин или пароль');
			echo "<script>location.href = 'http://likeagk' </script>";
		}
	}
}

//Registration
if(isset($_POST['susubmit'])) { //нажатие кнопки Регистрация
	$sulogin = strip_tags(trim($_POST['sulogin']));
	$supass = strip_tags(trim(md5($_POST['supass'])));
	$query = mysql_query("SELECT * FROM users  WHERE email = '$sulogin'");
	if (mysql_num_rows($query) > 0) {
		exit('Введенный логин уже существует.');
	}
	else { //в инном случае создаем новую запись в бд
		$query2 = mysql_query("INSERT INTO users(email, password) VALUE ('$sulogin', '$supass')");

		if ($query2) { //если успешно
			print('Вы успешно зарегестрировались.');
			echo "<script>location.href = 'http://likeagk' </script>";
		}
		else {//в случае ошибки
			exit('Извините регистрация не удалась.');
		}
	}
}

//Logout
if(isset($_POST['logout'])) {
	session_unset();
	session_destroy();
	echo "<script>location.href = 'http://likeagk' </script>";
}
?>