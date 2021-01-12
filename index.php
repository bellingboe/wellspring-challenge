<?php
session_start();

if (isset($_GET['reset'])) {
	$_SESSION['data'] = NULL;
	session_destroy();
	echo "Session cleared. <a href='?'>[Back]</a>";
	exit;
}

if ($_SESSION['data']){
	echo "<a href='?reset'>[RESET]</a>" . var_dump($_SESSION['data']);
}else{
?>
<form enctype="multipart/form-data" method="post" action="upload.php">
CSV File: <input type="file" name="file" id="file">
<input type="submit" value="submit">
</form>
<?php
}
?>