<?php
	function getIp(){
		$ip = null;
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	
	$headers = getallheaders();
	$userAgent = $headers['User-Agent'];
	$language = $headers['Accept-Language'];
	$ip = getIp();
	
	$osStartingIndex = stripos($userAgent, '(');
	$osEndIndex = stripos($userAgent, ')');
	$os = substr($userAgent, $osStartingIndex+1, $osEndIndex - $osStartingIndex - 1);
	
	$languageEndIndex = stripos($language, ',');
	$language = substr($language, 0, $languageEndIndex);
	
	$data = array(
		"ip" => $ip,
		"OS" => $os,
		"language" => $language,
	);
	
	$jsonData = json_encode($data);

	echo $jsonData;