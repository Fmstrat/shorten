<?php
class googl {
	const api = 'https://www.googleapis.com/urlshortener/v1/url';
	private $key = null;
	
	public function __construct($key = null) {
		if(defined('GOOGLE_API_KEY')) {
			$this->setKey(GOOGLE_API_KEY);
		}
		
		if(!is_null($key)) {
			$this->setKey($key);
		}
	}
	
	public function setKey($key) {
		$this->key = $key;
	}
	
	public function s($url) {
		$data = $this->shorten($url);
		return isset($data->id) ? $data->id : $url;
	}
	
	public function shorten($url) {
		$key = '';
		$data = array();
		$data['longUrl'] = $url;
		
		if(!is_null($this->key)) {
			$key = '?key='.$this->key;
		}
		
		return $this->fetch(self::api.$key,$data);
	}
	
	public function expand($url) {
		$key = is_null($this->key) ? '' : "&key={$this->key}";
		return $this->fetch(self::api.'?shortUrl='.urlencode($url)."$key&projection=FULL");
	}
	
	private function fetch($url, $data = array()) {
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		
		if(!empty($data)) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		}
		
		$r = curl_exec($ch);
		curl_close($ch);
		
		return json_decode($r);
	}
}
?>
