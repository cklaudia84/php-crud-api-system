<?php
namespace App;

use System\Request as Req;
use System\Response as Resp;
use App\Services\ProductService as Srv;

class ProductController
{
	public static function main($filter) 
	{
		return Srv::getProducts($filter);
	}
	public static function create($categoryId) 
	{
		if(Req::hasPostMethod())
        {
			$product = Srv::createProductByPostBody();
			Srv::createProduct($categoryId, $product);
			
            Resp::send('Product created', 201);
        }
        else
        {
            Resp::send('Wrong method', 400);
        }
	}
	public static function get($id) 
	{
		if($id)
		{
			$product = Srv::getProductById($id);
		
			if($product)
			{
				return $product;

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
				$product = Srv::createProductByPostBody(true);
				Srv::updateProduct($id, $product);
				return 'Product updated';
			}
			Resp::send('Wrong parameters', 400);
		}
		Resp::send('Wrong method', 405);
	}
}

