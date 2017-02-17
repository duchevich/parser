<?php 
	function curl_get($url, $referer = 'https://www.google.com'){
		$ch = curl_init();
		$curl_log = fopen("curl_log.txt", 'w+');
		curl_setopt($curl_desc, CURLOPT_STDERR, $curl_log);
		curl_setopt($curl_desc, CURLOPT_VERBOSE, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36");
		curl_setopt($ch, CURLOPT_REFERER, $referer);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_COOKIEFILE, '');
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	    
	    curl_setopt($ch, CURLOPT_TIMEOUT, 10000); // times out after 4s
   
		$data = curl_exec($ch);
		curl_close ($ch );
		return $data;
	}
 ?>