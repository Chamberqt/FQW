<?php 
require "connection.php";
$user_id = $_SESSION['user_id'];
mysql_query("SET NAMES utf8");

$page = $_SERVER['PHP_SELF'];

if ($_SERVER['PHP_SELF'] == '/index.php') {
	$status = 'active';
}

elseif ($_SERVER['PHP_SELF'] == '/archive.php') {
	$status = 'archive';
}

$query = mysql_query("SELECT * FROM notes WHERE user_id = '$user_id' AND status ='$status' ORDER BY note_id DESC");
if (mysql_num_rows($query) > 0) {
	while ($noteres = mysql_fetch_array($query)) { ?>

	<!--NOTE-->
	<div class="note col-lg-3 col-md-4 col-sm-6">
		<div data-toggle="modal" data-target="<?php echo '#' . $noteres['note_id']; ?>" class="shadow p-3 mb-5 bg-white rounded ">
			<div class="title">
				<?php echo $noteres['title']; ?>
			</div>
			<div class="text">
				<?php echo $noteres['note_text']; ?>
			</div>
		</div>
	</div>

	<!--MODAL FOR NOTE-->
	<div class="modal fade" id="<?php echo $noteres['note_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle"><?php echo $noteres['title']; ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php echo $noteres['note_text']; ?>
				</div>
				<div class="modal-footer">
					<form method="POST" action="backend/move_to_arch.php">
						<button type="submit" name="remove" class="btn btn-danger">Удалить</button>
						<button type="submit" name="move_to" class="btn btn-warning">Отправить в архив</button>
						<button type="submit" name="save" class="btn btn-success">Сохранить</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php 
}
}
else {
	
	echo '<h1 style="margin-top: 20px; margin-left: 50px;"><b>Заметок нет</b></h1>';
}
?>



