<?php
namespace System;

class Database 
{
	public static function execute($sql, $params = null)
	{
		$db = self::get();
		$query = $db->prepare($sql);
		return $query->execute($params);
	}
	public static function query($sql, $params = null, $all = true)
	{
		$db = self::get();
		$query = $db->prepare($sql);
		$query->execute($params);
		
		if($all)
		{
			return $query->fetchAll(\PDO::FETCH_ASSOC);
		}
		else
		{
			return $query->fetch(\PDO::FETCH_ASSOC);
		}
	}
	public static function get()
	{
		if(!self::$pdo)
		{
			$dsn = DB_TYPE .':host='. DB_HOST .';dbname='. DB_NAME .';charset=utf8mb4';
			self::$pdo = new \PDO($dsn, DB_USER, DB_PASS);
			self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		return self::$pdo;
	}
	
	private static $pdo = null;
}
