<?php
namespace App\Services;

use System\Request as Req;
use System\Database as DB;

class CategoryService 
{
	public static function getCategories($filter) 
	{
		$where = ($filter != 'all' ? 'WHERE visible = 1' : '');
		return DB::query("SELECT * FROM api__categories ". $where ." ORDER BY name");
	}
	public static function getCategoryById($id)
	{
		return DB::query("SELECT * FROM api__categories WHERE id= :id", ['id' => $id], false);
	}
	public static function createCategory($category)
	{
		return DB::execute("INSERT INTO api__categories VALUES (NULL, :name, :visible)", $category);
	}
	public static function updateCategory($id, $category)
	{
		$fields = [];
		$values = ['id' => $id];
		
		if($category['name'])
		{
			$fields[] = "name = :name";
			$values['name'] = $category['name'];
		}
		if($category['visible'] || $category['visible'] === '0')
		{
			$fields[] = "visible = :visible";
			$values['visible'] = $category['visible'];
		}
		$fields = implode(", ", $fields);
		DB::execute("UPDATE api__categories SET ". $fields ." WHERE id = :id", $values);
	}
	public static function createCategoryByPostBody($forUpdate = false)
	{
		$category =
		[
			'name' => Req::post('name'),
			'visible' => Req::post('visible', $forUpdate ? '' : '1')
		];
		return $category;
	}
}
