<?php
class yourls {
	private $key = null;
	private $root = null;
	
	public function __construct($key = null, $root = null) {
		if(!is_null($key)) {
			$this->setKey($key);
		}
		if(!is_null($root)) {
			$this->setRoot($root);
		}
	}
	
	public function setKey($key) {
		$this->key = $key;
	}

	public function setRoot($root) {
		$this->root = $root;
	}
	
	public function s($url) {
		$data = $this->shorten($url);
		return isset($data->shorturl) ? $data->shorturl : $url;
	}
	
	public function shorten($url) {
		$data = array(
			'url' => $url,
			'format' => 'json',
			'action' => 'shorturl',
			'signature' => $this->key
		);
		
		return $this->fetch($this->root,$data);
	}
	
	private function fetch($root, $data = array()) {
		$url = $root."/yourls-api.php";
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		
		if(!empty($data)) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		
		$r = curl_exec($ch);
		curl_close($ch);
		
		return json_decode($r);
	}
}
?>
