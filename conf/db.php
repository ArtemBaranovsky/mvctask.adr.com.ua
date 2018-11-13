<?php

/*
Database configuration file
*/

class DB{
	const USER	= "";	// custom settings
	const PASS	= "";	// custom settings
	const HOST	= "mysql.zzz.com.ua";
	const DB 	= "";	// custom settings
	
	public static function connToDB() {
		$user	= self::USER;
		$pass	= self::PASS;
		$host	= self::HOST;
		$db 	= self::DB;
		
		$conn = new PDO("mysql:dbname=$db;host=$host;charset=UTF8", $user, $pass);
		return $conn;
		
		}
}