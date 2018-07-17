<?php 
require '../vendor/autoload.php';

$orderID = (int)$_GET['order_number'];
$clientLogin = $_GET['client_login'];
$order = new AppWidget\soap\Orders($clientLogin, $orderID);
echo json_encode($order->getStatusFromResponse());