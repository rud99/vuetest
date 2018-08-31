<?php

$order = $_POST['order'];
$pdo = new PDO("mysql:host=localhost; dbname=app; charset=utf8", "root", "");
$statement = $pdo->prepare("INSERT INTO order_table (customer_name) VALUES (:customer_name)");
$statement->execute([
	':customer_name' => $order['customer_name']
]);
$orderId = $pdo->lastInsertId();

$products = $_POST['products'];

foreach ($products as $product) {
	$statement = $pdo->prepare("INSERT INTO ordered_item (order_id, title, price, quantity) VALUES (:order_id, :title, :price, :quantity)");
	$statement->execute([
		':order_id' => $orderId,
		':title' 	=> $product['title'],
		':price' 	=> $product['price'],
		':quantity' => $product['quantity']
	]);
}
