<?php
namespace System;

class Request 
{
	public static function get($name, $default = null)
	{
		if(isset($_GET[$name]) && !empty($_GET[$name]))
		{
			return $_GET[$name];
		}
		return $default;
	}
	public static function post($name, $default = '')
	{
		if(isset($_POST[$name]) && !empty($_POST[$name]))
		{
			return $_POST[$name];
		}
		return $default;
	}
	public static function hasPostMethod()
	{
		return strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
	}
	public static function getControllerName()
	{
		return self::get(CONTROLLER_PARAM_NAME);
	}
	public static function getAction()
	{
		return self::get(ACTION_PARAM_NAME, ACTION_DEFAULT);
	}
	public static function getActionParamValue()
	{
		return self::get(PARAM_PARAM_NAME);
	}
}
