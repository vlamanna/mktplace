<?php

class Cakemail
{
	private static $apiKey = "ae30ba06868a7980d2b98ff393afc412";
	private static $apiUrl = "https://api.wbsrvc.com";
	private static $userKey = "3f00d9cb45db9a242382b6ca38f99961";
	
	private static function apiCall($url, $params)
	{
		try {
			$params['user_key'] = self::$userKey;
		
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, self::$apiUrl . $url); 
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('apikey:' . self::$apiKey));
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			
			$result = curl_exec($ch);
			
			if ($result === false) {
				throw new Exception('Curl error: ' . curl_error($ch));
			} else {
				if (!$result = json_decode($result, true)) {
					throw new Exception('API Key Validation Error for ' . self::$apiKey . '. Contact your administrator!');
				} 
			
				if ($result['status'] != 'success') {
					throw new Exception($result['data']);
				}
			
			}
			
			curl_close($ch);
			
			return $result->data;
		} catch (Exception $e) {
			curl_close($ch);
			return array('error' => $e->getMessage());
		}
	}
	
	public static function sendEmail($email, $subject, $htmlContent, $textContent)
	{
		self::apiCall('/Relay/Send', array(
			'email'			=> $email,
			'encoding'		=> "utf-8",
			'subject'		=> $subject,
			'sender_email'	=> "info@themeup.co",
			'sender_name'	=> "ThemeUp!",
			'html_message'	=> $htmlContent,
			'text_message'	=> $textContent
		));
	}
}