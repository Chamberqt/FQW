<?php
include_once 'backend/auth.php';
require 'backend/create_note.php';
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>FQWProject</title>

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<!--NAVIGATION-->
			<div class="col-12 navigation">
				<nav class="navbar navbar-light bg-light">
					<a href="index.php" class="navbar-brand">FQWProject</a>
					<form id="search" class="form-inline">
						<input class="form-control mr-sm-2" type="search" aria-label="Search">
						<button class="btn btn-warning my-2 my-sm-0" type="submit">Поиск</button>
					</form>
					<?php 
					if(isset($_SESSION['user'])) { ?>
					<div class="if-logged-in">
						<form action="backend/auth.php" method="POST">
							<?php echo $_SESSION['user']; ?> 
							<button type="submit" name="logout" class="btn btn-danger">Выйти</button>
						</form>
					</div>
					<?php 
				}
				else { ?>
				<div class="login ">
					<button type="button" class="btn btn-dark" data-toggle="modal" data-target=".login-form">Войти</button>
					<div class="modal fade login-form" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="login-form modal-content">
								<form method="POST" action="backend/auth.php">
									<div class="form-group">
										<input type="email" name="silogin" class="form-control" id="login-email" aria-describedby="emailHelp" placeholder="Ваш Email" autofocus>

									</div>
									<div class="form-group">
										<input type="password" name="sipass" class="form-control" id="login-password" placeholder="Ваш пароль">
									</div>
									<button type="submit" name="sisubmit" class="btn btn-dark">Войти</button>
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="register ">
					<button type="button" class="btn btn-dark" data-toggle="modal" data-target=".sign-up-form">Регистрация</button>
					<div class="modal fade sign-up-form" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-sm">
							<div class="login-form modal-content">
								<form action="backend/auth.php" method="POST">
									<div class="form-group">
										<input type="email" name="sulogin" id="singup-email" class="form-control" aria-describedby="emailHelp" placeholder="Введите Email" autofocus>
									</div>
									<div class="form-group">
										<input type="password" name="supass" id="singup-password" class="form-control" placeholder="Введите пароль">
									</div>
									<button type="submit" name="susubmit" class="btn btn-dark">Зарегестрироваться</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</nav>
		</div>
	</div>


	<div class="row">
		<!--SIDEBAR SECTION-->
		<div class="col-2 sidebar">
			<button type="button" name="create_note" class="create-note btn btn-warning" data-toggle="modal" data-target="#create_note">Создать заметку</button>

			<div class="modal fade" id="create_note" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Новая заметка</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="backend/create_note.php" method="POST">
								<div class="form-group">
									<label for="recipient-name" class="col-form-label">Название:</label>
									<input type="text" name="note_title" class="form-control" id="recipient-name">
									
								</div>
								<div class="form-group">
									<textarea rows="15" name="note_text" class="form-control" id="message-text"></textarea>
								</div>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
								<button type="submit" name="save_created_note" class="btn btn-success">Сохранить</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<ul class="sidebar-nav">
				<li></i><a href="index.php"><i class="fa fa-lightbulb" aria-hidden="true"></i>Заметки</a></li>
				<li></i><a href="archive.php"><i class="fa fa-archive" aria-hidden="true"></i>Архив</a></li>
			</ul>
		</div>

		<!--MAIN SECTION-->
		<div class="col-10 main">
			<div class="row">
				<?php require 'backend/while_note.php'; ?>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="js/main.js"></script>

</body>
</html>


