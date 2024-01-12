<?php

	if ($_SERVER['HTTP_HOST'] == 'localhost')
	{
		define('HOST', 'localhost');
		define('USER', 'root');
		define('PASS', 'Larrycom4&40');
		define('DB', 'CECISTYLE');
	}
	else
	{
		define('HOST', 'localhost');
		define('USER', 'i6720977_wp1');
		define('PASS', 'di=%5wQ%#T;W');
		define('DB', 'CECISTYLE');
	}
	
	function connectToDB()
	{
		$conn = mysqli_connect(HOST,USER,PASS,DB);
		return $conn;
	}

?>