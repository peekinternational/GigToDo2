<?php
session_start();
include("includes/db.php");
include("functions/payment.php");
include("functions/processing_fee.php");
if(!isset($_SESSION['seller_user_name'])){
	echo "<script>window.open('login.php','_self');</script>";
}

$login_seller_user_name = $_SESSION['seller_user_name'];
$select_login_seller = $db->select("sellers",array("seller_user_name" => $login_seller_user_name));
$row_login_seller = $select_login_seller->fetch();
$login_seller_id = $row_login_seller->seller_id;

if(isset($_POST['paystack'])){

	$sub_total = 0;
	$select_cart =  $db->select("cart",array("seller_id" => $login_seller_id));
	$count_cart = $select_cart->rowCount();
	while($row_cart = $select_cart->fetch()){
		$proposal_price = $row_cart->proposal_price;
		$proposal_qty = $row_cart->proposal_qty;
		$cart_total = $proposal_price * $proposal_qty;
		$sub_total += $cart_total;
	}
	$processing_fee = processing_fee($sub_total);

	$data = [];
	$data['amount'] = $sub_total + $processing_fee;
	$data['redirect_url'] = "$site_url/paystack_order?cart_seller_id=$login_seller_id";
	$payment = new Payment();
	$payment->paystack($data);

}else{
	echo "<script>window.open('index','_self')</script>";
}
