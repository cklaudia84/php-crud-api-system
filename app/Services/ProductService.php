<?php
namespace App\Services;

use System\Request as Req;
use \System\Database as DB;

class ProductService 
{
	public static function getProducts($filter)
	{
		$where = ($filter != 'all' ? "WHERE stock > 0 AND visible != 0" : '');
		$sql = "SELECT prod.id, prod.name, price, stock, category, cat.name AS category_name 
			FROM api__products AS prod
			INNER JOIN api__categories AS cat ON cat.id = prod.category
				". $where ." ORDER BY prod.name";
		$items = DB::query($sql);
		
		foreach($items as &$prod)
		{
			$prod = self::normalize($prod);
		}	
		return $items;
	}
	public static function getProductById($id)
	{
			$sql = "SELECT prod.id, prod.name, price, stock, category, cat.name AS category_name 
					FROM api__products AS prod
					INNER JOIN api__categories AS cat ON cat.id = prod.category 
					WHERE prod.id = :id AND stock > 0 AND visible != 0";
		$product = DB::query($sql, ['id' => $id], false);
		
		if($product)
		{
			$product = self::normalize($product);
		}
		return $product;
	}
	public static function getProductsInCategory($categoryId) 
	{
			$sql = "SELECT prod.id, prod.name, price, stock 
			FROM api__products AS prod
			INNER JOIN api__categories AS cat ON cat.id = prod.category
			WHERE stock > 0 AND visible != 0 AND category = :category
			ORDER BY prod.name";
		
		return DB::query($sql, ['category' => $categoryId]);
	}

	public static function createProduct($categoryId, $product)
	{
		$sql = "INSERT INTO api__products VALUES (NULL, :category, :name, :price, :stock)";
		$product['category'] = $categoryId;
		return DB::execute($sql, $product);
	}
	public static function updateProduct($id, $product)
	{
		$fields = [];
		$values = ['id' => $id];
		
		if($product['name'])
		{
			$fields[] = "name = :name";
			$values['name'] = $product['name'];
		}
		if($product['price'])
		{
			$fields[] = "price = :price";
			$values['price'] = $product['price'];
		}
		if($product['stock'])
		{
			$fields[] = "stock = :stock";
			$values['stock'] = $product['stock'];
		}
		if($product['category'])
		{
			$fields[] = "category = :category";
			$values['category'] = $product['category'];
		}
		
		$fields = implode(", ", $fields);
		DB::execute("UPDATE api__products SET ". $fields ." WHERE id = :id", $values);
	}
	public static function createProductByPostBody($forUpdate = false)
	{
		$product = 
		[
			'name' => Req::post('name'),
			'price' => Req::post('price'),
			'stock' => Req::post('stock',$forUpdate ? '' : '0')
		];
		if($forUpdate)
		{
			$product['category'] = Req::post('category');
		}
		return $product;
	}
	private static function normalize($prod)
	{
		$prod['category']=
				[
					'id' => $prod['category'],
					'name' => $prod['category_name']
				];
		unset($prod['category_name']);
		
		return $prod;
	}
}
