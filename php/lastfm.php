<?php

class lastFm
{
	
	var $apiKey;
	
	function __construct($apiKey)
	{
		
		$this->apiKey = $apiKey;
		
	}
	
	function getRecentTracks($user = "", $limit = 10)
	{
		
		$curl = curl_init("http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=".$user."&limit=".$limit."&api_key=".$this->apiKey);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_TIMEOUT, 3);
		
		$data = curl_exec($curl);
		
		curl_close($curl);
		
		return $data;
		
	}
		
}
	
?>