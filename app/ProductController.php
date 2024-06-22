<?php
namespace App;

use System\Request as Req;
use System\Response as Resp;
use System\Database as DB;


class ProductController
{
	public static function main() 
	{
		return ['Product', 'Main'];
	}
	public static function create() 
	{
		if(Req::hasPostMethod())
        {
            Resp::send(['Product', 'Create'], 201);
        }
        else
        {
            Resp::send('Wrong method', 400);
        }
	}
	public static function get($id) 
	{
		//throw new \Exception('Valami nem jó');
        return ['Product', 'Get', $id];
	}
}

