<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

function debug($var)
{
	echo '<pre>' . print_r($var) . '</pre>';
}
function redirect($to)
{
	header("Location:" . URLROOT . $to);
	exit();
}

function gen_token($len)
{
	$alpha = "0123456789abcdefjhijklmnopqrstovwxyzABCDEFJHIJKLMNOPQRSTVWXYZ";
	return substr(str_shuffle(str_repeat($alpha, $len)), 0, $len);
}

if (!function_exists('setFlash')) {
	function setFlash($type, $msg)
	{
		$_SESSION['flash'][$type] = $msg;
	}
}

if (!function_exists('getFlash')) {
	function getFlash()
	{
		$var = $_SESSION['flash'] ? $_SESSION['flash'] : null;
		if ($var) unset($_SESSION['flash']);
		return $var;
	}
}
if (!function_exists('isLogged')) {
	function isLogged()
	{
		if (isset($_SESSION['auth']))
			return true;
		else
			return false;
	}
}
