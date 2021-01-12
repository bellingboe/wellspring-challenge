<?php
session_start();
error_reporting(E_ERROR);
ini_set("display_errors", "On");

require_once "File.php";

if (isset($_POST)) {
	File::UploadCSV($_FILES);
}