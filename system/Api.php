<?php
namespace System;

class Api 
{
	public static function serve($controller, $action, $param)
	{
		self::setupErrorHandler();
		Response::setupHeaders();
		
		$className = self::getControllerClassName($controller);
		if($className && class_exists($className))
		{
			if(method_exists($className, $action))
			{
				try 
				{
					$result = call_user_func([$className, $action], $param);
					Response::send($result);
				}
				catch (\Exception $ex)
				{
					$message = $ex->getMessage();
					Response::send('Technical error', $message, 500);
				}
			}
			else	
			{
				Response::send('Wrong parameters', 400);
			}
		}
		else
		{
			Response::send('Resource not found', 404);
		}
	}
	private static function getControllerClassName($controller)
	{
		if($controller)
		{
			return 'App\\'.ucfirst($controller) .'Controller';
		}
		return '';
	}
	private static function setupErrorHandler()
	{
		set_error_handler(function($errno, $errstr)
		{
			Response::send($errstr, 500);
		});
	}
}
