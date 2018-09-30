<?php
session_start();
require 'connection.php';
if (isset($_POST['move_to'])) {
	$note_id = $noteres['note_id'];
	$query2 =  "UPDATE notes SET status = 'archive' WHERE note_id = '$note_id'";
	mysql_query($query2);
	echo "<script>location.href = 'http://likeagk' </script>";
}

?>