<?php

class Curl
{
	public static function makeSecureCall($url, $data) {
		$request = curl_init();
		
		curl_setopt_array($request, array
		(
			CURLOPT_URL => $url,
			CURLOPT_POST => TRUE,
			CURLOPT_POSTFIELDS => http_build_query($data),
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HEADER => FALSE,
			CURLOPT_SSL_VERIFYPEER => TRUE,
			CURLOPT_CAINFO => 'cert/cacert.pem',
		));
		
		$response = array();
		$response['data'] = curl_exec($request);
		$status['status'] = curl_getinfo($request, CURLINFO_HTTP_CODE);
		
		curl_close($request);
		
		return $response;
	}
}