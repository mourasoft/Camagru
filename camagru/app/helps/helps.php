<?php
function debug($var)
{
	echo '<pre>' . print_r($var) . '</pre>';
}
function redirect($to)
{
	header("Location:" . URLROOT . $to);
}
function gen_token($len)
{
	$alpha = "0123456789abcdefjhijklmnopqrstovwxyzABCDEFJHIJKLMNOPQRSTVWXYZ";
	return substr(str_shuffle(str_repeat($alpha, $len)), 0, $len);
}
