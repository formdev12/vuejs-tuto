<?php

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // should do a check here to match $_SERVER['HTTP_ORIGIN'] to a
    // whitelist of safe domains
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}

$route = $_SERVER['REQUEST_URI'];

$routes = explode('/', $route);

$result = ['name'=>"hello world!"];

header('Content-Type: application/json');

switch ($routes[1]) {
	case 'posts':
		
		break;
	case 'users':
		$users = require('./users.php');
		
		if (!isset($routes[2])){
			echo $users;
			exit;
		}
		
		$myusers = json_decode($users, true);
		$userID = (int) $routes[2];

		foreach($myusers as $user)
		{
			if ($user['id'] == $userID )
			{
				echo json_encode($user);
				exit;
			}
		}
		if ($userID >= 1)
		{
			header('HTTP/1.1 404 Not Found');
			echo '[]';
			exit;
		}
		

		break;
	case 'products':
		$products = require('./products.php');

		if (!isset($routes[2])){
			echo $products;
			exit;
		}
		
		$myproducts = json_decode($products, true);
	
		$productID = (int) $routes[2];

		foreach($myproducts as $product)
		{
			if ($product['id'] == $productID )
			{
				echo json_encode($product);
				exit;
			}
		}
		if ($productID >= 1)
		{
			header('HTTP/1.1 404 Not Found');
			echo '[]';
			exit;
		}

		break;
	case 'login':
		require __DIR__."/login.php";

		break;
	default:
		echo json_encode(['app' => 'Welcome', 'version' => '1.0']);
		break;
}


