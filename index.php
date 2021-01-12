<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", "On");
require_once "File.php";

if (isset($_GET['reset'])) {
	$_SESSION['data'] = NULL;
	session_destroy();
	echo "Session cleared. <a href='?'>[Back]</a>";
	exit;
}

if (isset($_SESSION['data']) && !is_null($_SESSION['data'])){
	echo "<a href='?reset'>[RESET]</a>" . File::displayTable();
}else{
?>
<form enctype="multipart/form-data" method="post" action="upload.php">
CSV File: <input type="file" name="file" id="file">
<input type="submit" value="submit">
</form>
<?php
}
?>