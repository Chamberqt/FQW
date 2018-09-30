<?php
session_start();
require 'connection.php';

if(isset($_POST['save_created_note'])) {
	$user_id = $_SESSION['user_id'];
	$note_title = strip_tags($_POST['note_title']);
	$note_text = strip_tags($_POST['note_text']);
	$note_stat = 'active';

	if ($note_title == '' && $note_text == '') {
		echo "<script>alert('Вы ничего не ввели');</script>";
		echo "<script>location.href = 'http://likeagk' </script>";
		exit();
	}
	$query = mysql_query("INSERT INTO notes(user_id, title, note_text, status) VALUE ('$user_id', '$note_title', '$note_text', '$note_stat')");
	echo "<script>location.href = 'http://likeagk' </script>";
}

?>