<?php
namespace System;

class Response 
{
	public static function setupHeaders()
	{
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json;charset=utf-8');
	}
	public static function send($data, $statusCode = 200)
	{
		http_response_code($statusCode);
		$response = ['data' => $data];
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		exit;
	}
}
