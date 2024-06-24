<?php
namespace App;

use System\Request as Req;
use System\Response as Resp;
use App\Services\CategoryService as Srv;

class CategoryController 
{
	public static function main($filter)
	{
		return Srv::getCategories($filter);
	}
	public static function create()
	{
		if(Req::hasPostMethod())
		{
			$category = Srv::createCategoryByPostBody();
			Srv::createCategory($category);
			
			Resp::send('Category created', 201);
		}
		Resp::send('Wrong method', 405);
	}
	public static function get($id)
	{
		if($id)
		{
			$category = Srv::getCategoryById($id);
			
			if($category)
			{
				return $category;
			}
			Resp::send('Category not found', 404);
		}
		Resp::send('Wrong parameters', 400);
	}
	public static function update($id)
	{
		if(Req::hasPostMethod())
		{
			if($id)
			{
				$category = Srv::createCategoryByPostBody(true);
				Srv::updateCategory($id, $category);
				return 'Category updated';
			}
			Resp::send('Wrong parameters', 400);
		}
		Resp::send('Wrong method', 405);
	}
}
