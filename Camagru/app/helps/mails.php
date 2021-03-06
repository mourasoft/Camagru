<?php

function send_token($data, $token, $id)
{

	$sender = 'noreplay.camagru@gmail.com';
	$recipient = $data['email'];

	$subject = "Camagru verification mail";
	$link = URLROOT . "/users/verify/" . $id . '/' . $token;
	$message = 'hey ' . $data['username'] . '<br>this is the link';
	$message .= '<br><br><a href=' . $link . '>click here</a>';
	$message .= '<br><br>thanks';
	$headers = 'From: Camagru <' . $sender . ">\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "content-Type: text/html; charset=ISO-8859-1\r\n";

	mail($recipient, $subject, $message, $headers);
}

function reset_pass($obj, $token)
{

	$sender = 'noreplay.camagru@gmail.com';
	$recipient = $obj->email;

	$subject = "Camagru reset password";
	$link = URLROOT . "/users/reset/" . $obj->id . '/' . $token;
	$message = 'hey ' . $obj->username . '<br>this is the link';
	$message .= '<br><br><a href=' . $link . '>click here</a>';
	$message .= '<br><br>thanks';
	$headers = 'From: Camagru <' . $sender . ">\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "content-Type: text/html; charset=ISO-8859-1\r\n";

	mail($recipient, $subject, $message, $headers);
}

function sendLike($email)
{
	$sender = 'noreplay.camagru@gmail.com';
	$recipient = $email;
	$subject = "New like";
	$message = 'someone has liked your picture.';
	$headers = 'From: Camagru <' . $sender . ">\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "content-Type: text/html; charset=ISO-8859-1\r\n";

	mail($recipient, $subject, $message, $headers);
}

function sendComment($email)
{

	$sender = 'noreplay.camagru@gmail.com';
	$recipient = $email;
	$subject = "New comment";
	$message = 'someone has commented on your picture.';
	$headers = 'From: Camagru <' . $sender . ">\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "content-Type: text/html; charset=ISO-8859-1\r\n";

	mail($recipient, $subject, $message, $headers);
}