<?php
class polr {
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
		return substr($data, 0, 4) === "http" ? $data : $url;
	}
	
	public function shorten($url) {
		$data = array(
			'url' => $url,
			'key' => $this->key
		);
		
		return $this->fetch($this->root,$data);
	}
	
	private function fetch($root, $data = array()) {
		$url = $root."/api/v2/action/shorten";
    $qry_str = "";
    if(!empty($data)) {
      $qry_str = "?key=".$data['key']."&url=".$data['url'];
		}
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url.$qry_str);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		
		
		$r = curl_exec($ch);
		curl_close($ch);
		
		return $r;
	}
}
?>
