<?php

function send_token($data,$token,$id){

	$sender = 'noreplay.camagru@gmail.com';
    $recipient = $data['email'];

    $subject = "Camagru verification mail";
    $link = URLROOT."/account/verify/".$id.'/'.$token;
	$message = 'hey ' . $data['username'] . '<br>this is the link' . $link;
	$message .= '<br><br><a href='.$link.'></a>';
	$message .= '<br><br>thanks';
    $headers = 'From: Camagru <' . $sender.">\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "content-Type: text/html; charset=ISO-8859-1\r\n"; 

    mail($recipient, $subject, $message, $headers);
}