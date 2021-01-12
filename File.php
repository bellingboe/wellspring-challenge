<?php

Class File {
	
	public static function saveRecord($i, $train, $route, $run, $op) {
		$arr = [0 => $train,
				1 => $route,
				2 => $run,
				3 => $op];
		$_SESSION['data'][$i] = $arr;
	}
	
	public static function randomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
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
						$train = $line[0];
						$route = $line[1];
						$run = $line[2];
						$op = $line[3];
						File::saveRecord($i, $train, $route, $run, $op);
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
	
	protected static function displayTable() {
		echo "<a href='index.php?reset'>[RESET]</a><br><br><table class='sortable'>\r\n";
		echo "<thead>
            <tr>
                <th>TRAIN</th>
                <th>ROUTE NAME</th>
                <th>RUN NAME</th>
                <th>OPERATOR ID</th>
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
	}

	
}