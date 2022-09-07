<?php

if (isset($_POST['submit'])) {
	//header('Content-Type: application/json');
	$username = $_POST['email'];
	$password = $_POST['password'];
	
	if ( ($username == 'admin' ||
	      $username == 'admin@example.net')
	      && $password == 'motdepass123' ) {
		echo json_encode([
			'success' => true,
			'message' => 'Success, vous ếte connécté parfaitement.',
			'user' => [
				'name' => 'admin',
				'email' => 'admin@example.net',
				'id' => '1',
				'profile' => 'http://fake.localhost/assets/profile/1.png'
			]
		]);exit;
	} else {
		http_response_code(401);
		echo json_encode([
			'success' => false,
			'message' => 'Error, combinaison impossible.'
		]);exit;
	}
}
