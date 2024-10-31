<?php

	ini_set('display_errors', true);
	
	require('config.php');
	require('lastfm.php');
	
	$lf = new lastFm($apiKey);
	
	if(isset($_POST['user']) && isset($_POST['limit']))
	{
		$user = $_POST['user'];
		$limit = $_POST['limit'];
	}
	else
	{
	
		$user = "";
		$limit = "";
	
	} 
	
	$tracks = $lf->getRecentTracks($user, $limit);
	
	Header("content-type: application/xml");
	
	echo $tracks;
?>