<?php
namespace App;

class ProductController
{
	public static function main() 
	{
		echo 'Product/ Main';
	}
	public static function create() 
	{
		echo 'Product/ Second';
	}
	public static function get($id) 
	{
		echo 'Product/Get : '. $id;
	}
}

