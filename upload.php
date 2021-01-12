<?php
session_start();
error_reporting(E_ERROR);
ini_set("display_errors", "On");

require_once "File.php";

if (isset($_POST)) {
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.23/datatables.min.css"/>
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.23/datatables.min.js"></script>
		<script src="code.js"></script>
	</head>
	<body>
<?php
File::UploadCSV($_FILES);
?>
	</body>
</html>
<?php
}