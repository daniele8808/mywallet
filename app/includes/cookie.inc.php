<?php
	//if (!isset($_COOKIE['mywallet'])) {
	//	$_COOKIE['mywallet'] = 0;
	//}
	//$mywallet = $_COOKIE['mywallet'] + 1;
	//setcookie('mywallet', $mywallet, time() + 3600 * 24 * 365);
	//	
	//$spese = array();

	session_start();
	$user = $_SESSION['user'] = '';
	$_SESSION['loggedIn'] = '';
	$_SESSION['mail'] = '';
	$_SESSION['password'] = '';	
	