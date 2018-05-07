<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$dbname = 'tasks';
	
	$pdo = new mysqli($host, $user, $pass, $dbname);

	if (mysqli_connect_errno()) {
    	printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    	exit();
	}

	mysqli_set_charset($pdo, "utf8");
