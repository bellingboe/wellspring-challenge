<?php

Class File {
	
	public static function saveRecord($i, $arr) {
		foreach($_SESSION['cols'] as $k=>$v) {
			$data[$k] = $arr[$k];
		}
		$_SESSION['data'][$i] = $data;
	}
	
	public static function saveHeader($i, $text) {
		$_SESSION['cols'][$i] = $text;
	}
	
	public static function heading() {
		include "heading.php";
	}
	
	public static function footing() {
		echo "</body></html>";
	}
	
	public static function uploadCSV($files) {
		$_SESSION['data'] = null;
		$filename = $files["file"]["name"];
		$filetemp = $files["file"]["tmp_name"];
		$ext = substr($filename, strrpos($filename,"."), (strlen($filename)-strrpos($filename,".")));
		try {
			if ($file = fopen($filetemp,"r")) { 
				$i = 0;
				while ($line = fgetcsv($file ,1024,",","'")) {
					if ($i == 0) {
						$_SESSION['column_headers'] = $line;
					} else {
						$data = [];
						$column_count = count($_SESSION['column_headers']);
						for ($x=0; $x<=($column_count-1); $x++) {
							File::saveHeader($x, $_SESSION['column_headers'][$x]);
						}
						foreach($_SESSION['cols'] as $k=>$v) {
							$data[$k] = $line[$k];
						}
						File::saveRecord($i, $data);
					}
					$i++;
				}
			} else {
				echo "error";
			}
		} catch (Exception $e) {
			var_dump($e->getMessage());
		}
		
		self::displayTable();
	}
	
	public static function displayTable() {
		File::heading();
		echo "<a href='index.php?reset'>[RESET]</a><br><br><table class='sortable'>\r\n";
		echo "<thead>
            <tr>";
			
			foreach($_SESSION['cols'] as $k=>$v) {
				echo "<th>".ucfirst(strtolower(str_replace("_","&nbsp;",$v)))."</th>";
			}
			
                echo "
            </tr>
        </thead>";
		foreach($_SESSION['data'] as $k=>$v) {
			$train = $v[0];
			$route = $v[1];
			$run = $v[2];
			$op = $v[3];
			echo "<tr><td>$train</td><td>$route</td><td>$run</td><td>$op</td></tr>\r\n";
		}
		echo "</tbody></table>\r\n";
		File::footing();
	}

	
}